<?php

namespace App\Http\Controllers;

use App\Empleados;
use Illuminate\Http\Request;
use App\Areas;
use App\Departamentos;
use App\User;
use App\Privilegios;
use Validator;
use App\Http\Requests\EmpleadosRequest;
use App\CursNoDanio;
use App\Novedades;
use App\Afp;
use App\Faenas;
use App\AreasEmpresa;
use App\DatosLaborales;
use App\Avisos;
use App\UsuariosHasPrivilegios;
use App\DatosVarios;
use App\InformacionContacto;
use App\Cursos;
use App\Licencias;
use App\Examenes;
use App\Planificacion;
use App\Isapre;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    public function index()
    {
        $afp=Afp::all();
        $areas=Areas::all();
        $departamentos=Departamentos::all();
        $empleados=Empleados::all();
        $faenas=Faenas::all();
        $areasEmpresa=AreasEmpresa::all();
        $datosvarios=DatosVarios::all();
        $isapre=Isapre::all();

        $licencias=Licencias::where('status','Activo')->get();
        $cursos=Cursos::where('status','Activo')->get();
        $examenes=Examenes::where('status','Activo')->get();

        $contador = 1;
        return view('empleados.index',compact('empleados', 'contador','areas','departamentos','afp','faenas','areasEmpresa','datosvarios','licencias','cursos','examenes','isapre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $afp=Afp::all();
        $examenes=Examenes::all();
        $areas=Areas::all();
        $departamentos=Departamentos::all();
        $cursos=Cursos::all();

        return view('empleados.create',compact('areas','departamentos','examenes','afp','cursos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadosRequest $request)
    {
        $email=User::where('email',$request->email)->count();

        if ($request->email=="") {
            flash('<i class="fa fa-check-circle-o"></i> Email no puede ser vacio!')->error()->important();
            return redirect()->to('empleados');
        } else {

            if ($email>0) {
                flash('<i class="fa fa-check-circle-o"></i> Este Email ya se encuentra registrado!')->error()->important();
                return redirect()->to('empleados');
            } else {

                $usuario = new User();
                $usuario->name=$request->nombres;
                $usuario->email=$request->email;
                $nueva_clave=bcrypt($request->rut);
                $usuario->password=$nueva_clave;
                $usuario->tipo_user=$request->tipo_user;    
                // $usuario->save();

                if($usuario->save()){
                    $empleado = new Empleados();
                    $empleado->id_usuario=$usuario->id;
                    $empleado->nombres=$request->nombres;
                    $empleado->apellidos=$request->apellidos;
                    $empleado->email=$usuario->email;
                    $empleado->rut=$request->rut;
                    $empleado->edad=$this->CalculaEdad($request->fecha_nac);
                    $empleado->cargo=$request->cargo;
                    $empleado->genero=$request->genero;
                    $empleado->status=$request->status;
                    $empleado->save();

                }else{
                    flash('<i class="fa fa-check-circle-o"></i> Ocurrió un error al registrar al usuario! Verifique los datos ingresados!')->error()->important();
                    return redirect()->to('empleados');
                }
                //informacion de contacto

                $contacto = new InformacionContacto();
                $contacto->id_empleado=$empleado->id;
                $contacto->nombre=$request->nombre;
                $contacto->apellido=$request->apellido;
                $contacto->telefono=$request->telefono;
                $contacto->email=$request->email_contacto;
                $contacto->direccion=$request->direccion;
                $contacto->save();

                //---fin de contacto

                //.---- datos varios

                $datos_varios= new DatosVarios();
                $datos_varios->id_empleado=$empleado->id;
                $datos_varios->segundo_nombre=$request->segundo_nombre;
                $datos_varios->segundo_apellido=$request->segundo_apellido;
                $datos_varios->fecha_nac=$request->fecha_nac;
                $datos_varios->save();

                //fin de datos varios
                //licencia
                //dd($request->id_licencia);
                if($request->id_licencia!=null){
                    if (count($request->id_licencia)>0) {
                        for($i=0; $i<count($request->id_licencia); $i++){
                            \DB::table('empleados_has_licencias')->insert([
                                'id_empleado' => $empleado->id,
                                'id_licencia' => $request->id_licencia[$i],
                                'fecha' => $request->fechae_licn[$i],
                                'fecha_vence' => $request->fechav_licn[$i]
                            ]);
                        }
                    }
                }
                //--- fin licencia
                //registrando a los empleados en multiples areas
                if (count($request->id_area)>0) {
                    for($i=0; $i<count($request->id_area); $i++){
                        \DB::table('empleados_has_areas')->insert([
                            'id_empleado' => $empleado->id,
                            'id_area' => $request->id_area[$i]
                        ]);
                    }
                }
                //registrando a los empleados en multiples departamentos

                // Si no hay departamentos, no registra nada. By:Javier
                if($request->id_departamento > 0){

                    for($i=0; $i<count($request->id_departamento); $i++){
                        \DB::table('empleados_has_departamentos')->insert([
                            'id_empleado' => $empleado->id,
                            'id_departamento' => $request->id_departamento[$i]
                        ]);
                    }
                }

                //registrando permisos

                //--- Privilegio del usuario Admin --//
                if ($request->tipo_user == 'Admin') {
                    for ($i=1; $i <=14; $i++) { 
                        \DB::table('usuarios_has_privilegios')->insert([
                        'id_usuario' => $usuario->id,
                        'id_privilegio' => $i
                        ]);
                    }
                    for ($i=15; $i <= 17; $i++) { 
                        \DB::table('usuarios_has_privilegios')->insert([
                        'id_usuario' => $usuario->id,
                        'id_privilegio' => $i
                        ]);
                    }
                    for ($i=18; $i <= 46; $i++) { 
                        \DB::table('usuarios_has_privilegios')->insert([
                        'id_usuario' => $usuario->id,
                        'id_privilegio' => $i
                        ]);
                    }
                }

                //--- Privilegio del usuario - Supervisor --//
                if ($request->tipo_user == 'Supervisor') {
                    for ($i=1; $i <=10; $i++) { 
                        \DB::table('usuarios_has_privilegios')->insert([
                        'id_usuario' => $usuario->id,
                        'id_privilegio' => $i
                        ]);
                    }
                    for ($i=11; $i <= 16; $i++) { 
                        \DB::table('usuarios_has_privilegios')->insert([
                        'id_usuario' => $usuario->id,
                        'id_privilegio' => $i,
                        'status' => 'No'
                        ]);
                    }

                    for ($i=17; $i <= 35; $i++) { 
                        \DB::table('usuarios_has_privilegios')->insert([
                        'id_usuario' => $usuario->id,
                        'id_privilegio' => $i,
                        ]);
                    }

                    for ($i=36; $i <= 46; $i++) { 
                        \DB::table('usuarios_has_privilegios')->insert([
                        'id_usuario' => $usuario->id,
                        'id_privilegio' => $i,
                        'status' => 'No'
                        ]);
                    }
                }
                

                //--- Privilegio del usuario - Planificacion --//
                if ($request->tipo_user == 'Planificacion') {
                    for ($i=1; $i <=14; $i++) { 
                        \DB::table('usuarios_has_privilegios')->insert([
                        'id_usuario' => $usuario->id,
                        'id_privilegio' => $i
                        ]);
                    }
                    for ($i=15; $i <= 17; $i++) { 
                        \DB::table('usuarios_has_privilegios')->insert([
                        'id_usuario' => $usuario->id,
                        'id_privilegio' => $i,
                        'status' => 'No'
                        ]);
                    }
                    for ($i=18; $i <= 35; $i++) { 
                        \DB::table('usuarios_has_privilegios')->insert([
                        'id_usuario' => $usuario->id,
                        'id_privilegio' => $i
                        ]);
                    }
                    for ($i=36; $i <= 46; $i++) { 
                        \DB::table('usuarios_has_privilegios')->insert([
                        'id_usuario' => $usuario->id,
                        'id_privilegio' => $i,
                        'status' => 'No'
                        ]);
                    }
                }


                //--- Privilegio del usuario con ID 4 - Recursos humanos --//
                if ($request->tipo_user == 'Recursos humanos') {
                    for($i=1; $i<=10; $i++){
                        \DB::table('usuarios_has_privilegios')->insert([
                            'id_usuario' => $usuario->id,
                            'id_privilegio' => $i,
                            'status' => 'No'
                        ]);
                    }

                    for($i=11; $i<=14; $i++){
                        \DB::table('usuarios_has_privilegios')->insert([
                            'id_usuario' => $usuario->id,
                            'id_privilegio' => $i,
                            'status' => 'Si'
                        ]);
                    }

                    for($i=15; $i<=46; $i++){
                        \DB::table('usuarios_has_privilegios')->insert([
                            'id_usuario' => $usuario->id,
                            'id_privilegio' => $i,
                            'status' => 'No'
                        ]);
                    }
                }
                

                //--- Privilegio del usuario - Empleado --//
                if ($request->tipo_user == 'Empleado') {

                    for($i=1; $i<=4; $i++){
                        \DB::table('usuarios_has_privilegios')->insert([
                            'id_usuario' => $usuario->id,
                            'id_privilegio' => $i,
                            'status' => 'No'
                        ]);
                    }
                    for($i=5; $i<=7; $i++){
                        \DB::table('usuarios_has_privilegios')->insert([
                            'id_usuario' => $usuario->id,
                            'id_privilegio' => $i,
                            'status' => 'Si'
                        ]);
                    }
                    for($i=8; $i<19; $i++){
                        \DB::table('usuarios_has_privilegios')->insert([
                            'id_usuario' => $usuario->id,
                            'id_privilegio' => $i,
                            'status' => 'No'
                        ]);
                    }
                    \DB::table('usuarios_has_privilegios')->insert([
                            'id_usuario' => $usuario->id,
                            'id_privilegio' => 19,
                            'status' => 'Si'
                        ]);
                    \DB::table('usuarios_has_privilegios')->insert([
                            'id_usuario' => $usuario->id,
                            'id_privilegio' => 20,
                            'status' => 'Si'
                        ]);

                    for($i=21; $i<35; $i++){
                        \DB::table('usuarios_has_privilegios')->insert([
                            'id_usuario' => $usuario->id,
                            'id_privilegio' => $i,
                            'status' => 'No'
                        ]);
                    }
                    \DB::table('usuarios_has_privilegios')->insert([
                            'id_usuario' => $usuario->id,
                            'id_privilegio' => 35,
                            'status' => 'Si'
                    ]);
                    for ($i=36; $i <= 46; $i++) { 
                        \DB::table('usuarios_has_privilegios')->insert([
                        'id_usuario' => $usuario->id,
                        'id_privilegio' => $i,
                        'status' => 'No'
                        ]);
                    }
                }
                

                /*for($i=18; $i<=20; $i++){
                    \DB::table('usuarios_has_privilegios')->insert([
                        'id_usuario' => $usuario->id,
                        'id_privilegio' => $i,
                        'status' => 'No'
                    ]);
                }*/
                //---areas empresa---
                if($request->id_area_e!=null){
                    if (count($request->id_area_e)>0) {
                        for ($i=0; $i < count($request->id_area_e) ; $i++) { 
                            $afp=\DB::table('empleados_has_areas_empresa')->insert([
                                'id_empleado' => $empleado->id,
                                'id_area_e' => $request->id_area_e[$i]
                            ]);
                        }
                    }
                }
                //----fin area empresa
                //--- faenas---
                if($request->id_faena!=null){
                    if (count($request->id_faena)>0) {
                        
                    for ($i=0; $i < count($request->id_faena) ; $i++) { 
                        $afp=\DB::table('empleados_has_faenas')->insert([
                            'id_empleado' => $empleado->id,
                            'id_faena' => $request->id_faena[$i]
                        ]);
                    }
                    # code...
                    }
                }
                //---fin faenas-----
                //----afp-----
                if($request->id_afp!=null){
                    if (count($request->id_afp)>0) {
                        for ($i=0; $i < count($request->id_afp) ; $i++) { 
                            $afp=\DB::table('empleados_has_afp')->insert([
                                'id_empleado' => $empleado->id,
                                'id_afp' => $request->id_afp[$i]
                            ]);
                        }
                    }
                }
                if($request->id_isapre!=null){
                    if (count($request->id_isapre)>0) {
                        for ($i=0; $i < count($request->id_isapre) ; $i++) { 
                            $afp=\DB::table('empleados_has_isapre')->insert([
                                'id_empleado' => $empleado->id,
                                'id_isapre' => $request->id_isapre[$i]
                            ]);
                        }
                    }
                }
                    //---fin afp
                    //---cursos------
                if($request->id_curso!=null){
                    if (count($request->id_curso)>0) {
                        for ($i=0; $i < count($request->id_curso); $i++) { 
                            $curso=\DB::table('empleados_has_cursos')->insert([
                                'id_empleado' => $empleado->id,
                                'id_curso' => $request->id_curso[$i],
                                'fecha' => $request->curso_fecha_realizado[$i],
                                'fecha_vence' => $request->curso_fecha_vencimiento[$i]
                            ]);
                        }
                    }
                }
                    //---fin de cursos----
                    //---examenes------
                if($request->id_examen!=null){
                    if (count($request->id_examen)>0) {
                        for ($i=0; $i < count($request->id_examen); $i++) { 
                            $curso=\DB::table('empleados_has_examenes')->insert([
                                'id_empleado' => $empleado->id,
                                'id_examen' => $request->id_examen[$i],
                                'fecha' => $request->examenes_fecha_realizado[$i],
                                'fecha_vence' => $request->examenes_fecha_vencimiento[$i]
                            ]);
                        }
                    }
                }
                //---fin de examenes----


                if($request->novedades == 'Si'){

                    $novedades=Novedades::create([
                        'titulo' => '',
                        'novedad' => '',
                        'tipo' => 'nuevo_user',
                        'fecha' => date(session('fecha_actual').'-m-d'),
                        'hora' => date('H:m:s'),
                        'id_usuario_n' => $usuario->id,
                        'id_empleado' => \Auth::User()->id
                    ]);
                }

                flash('<i class="fa fa-check-circle-o"></i> Usuario creado con éxito!')->success()->important();
                return redirect()->to('empleados');
            }
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd('show');
        $user=User::find($id);
        $privilegios=Privilegios::all();

        $areas=Areas::all();
        $afp=Afp::where('id','<>',0)->groupBy('afp')->get();
        $cursos=Cursos::where('status','Activo')->get();
        $licencias=Licencias::where('status','Activo')->get();
        $examenes=Examenes::where('status','Activo')->get();
        $empleado=Empleados::find($id);
        $departamentos=Departamentos::all();
        //dd($empleado->datoslaborales);
        return view('empleados.show', compact('empleado','areas','user','privilegios','departamentos','examenes','afp','cursos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        $licencias=Licencias::where('status','Activo')->get();
        $empleado=Empleados::find($id);
        $departamentos=Departamentos::all();
        $areasEmpresa=AreasEmpresa::all();
        $faenas=Faenas::all();
        $areas=Areas::all();
        $afp=Afp::all();    
        $cursos=Cursos::where('status','Activo')->get();
        $examenes=Examenes::where('status','Activo')->get();
        $isapre = Isapre::all();

        $contar_licencias = count($empleado->licencias);
        $contar_cursos = count($empleado->cursos);
        $contar_examenes = count($empleado->examenes);

        return view('empleados.edit',compact('empleado','areas','user','departamentos','faenas','areasEmpresa','afp','licencias','cursos','examenes','contar_licencias','contar_cursos','contar_examenes','isapre'));
    }
    
    protected function validator_edit_empleados(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255',
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'rut' => 'required|max:255',
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        if ($request->datos_personales==1) {
            $this->validator_edit_empleados($request->all())->validate();
            $empleado = Empleados::find($id);
            $email=User::where('email',$request->email)->where('id','<>',$request->id_usuario)->count();
            $rut=Empleados::where('rut',$request->rut)->where('id','<>',$request->id_empleado)->count();
            //dd($email);
            if ($email>0) {
                flash('<i class="icon-circle-check"></i> El correo ya esta en uso!')->warning()->important();
                return redirect()->back();
            }elseif ($rut>0) {
                flash('<i class="icon-circle-check"></i> El RUT ya esta en uso!')->warning()->important();
                return redirect()->back();
            } else {
                $usuario = User::find($empleado->id_usuario);

                $b_user = \DB::table('empleados')->join('users','users.id','=','empleados.id_usuario')
                ->select('empleados.id')->where('empleados.id',$id)->first();
                //dd($b_user);
                //buscando planificaciones creadas por el usuario
                $planificaciones=Planificacion::where('id_elaborado',$b_user->id)->get();
                if(count($planificaciones) > 0){
                    foreach($planificaciones as $key){
                        $p=Planificacion::find($key->id);
                        $p->elaborado=$request->nombres." ".$request->apellidos;
                        $p->save();
                    }
                }
                $planificaciones=Planificacion::where('id_aprobado',$b_user->id)->get();
                if(count($planificaciones) > 0){
                    foreach($planificaciones as $key){
                        $p=Planificacion::find($key->id);
                        $p->aprobado=$request->nombres." ".$request->apellidos;
                        $p->save();
                    }
                }

                $empleado = Empleados::find($request->id_empleado);
                $empleado->nombres=$request->nombres;
                $empleado->apellidos=$request->apellidos;
                $empleado->email=$request->email;
                $empleado->rut=$request->rut;
                $empleado->edad=$this->CalculaEdad($request->fecha_nac);
                $empleado->cargo=$request->cargo;
                $empleado->genero=$request->genero;
                $empleado->save();
                
                $usuario = User::find($request->id_usuario);
                $usuario->name=$request->nombres;
                $usuario->email=$request->email;
                if ($request->cambiar_password=="cambiar_password") {
                    $nueva_clave=bcrypt($request->password);
                    $usuario->password=$nueva_clave;
                }
                $usuario->save();

                \DB::table('datos_varios')->where('id_empleado', $request->id_empleado)
                ->update([
                    'segundo_nombre'=> $request->segundo_nombre,
                    'segundo_apellido'     => $request->segundo_apellido,
                    'fecha_nac' => $request->fecha_nac
                ]);
            }
            flash('<i class="fa fa-check-circle-o"></i> Datos de usuario actualizado con éxito!')->success()->important();
            return redirect()->to('empleados/'.$id.'/edit');
        } else if($request->datos_laboral==1){
            $empleado = Empleados::find($request->id_empleado);
            if (\Auth::User()->tipo_user=="Admin") {
                $empleado->status=$request->status;
            }
            $empleado->save();

            if($request->id_area!=null){
                if (count($request->id_area)>0) {
                $eliminar=\DB::table('empleados_has_areas')->where('id_empleado',$request->id_empleado)->delete();
                 //registrando a los empleados en multiples areas
                    for($i=0; $i<count($request->id_area); $i++){
                        \DB::table('empleados_has_areas')->insert([
                            'id_empleado' => $request->id_empleado,
                            'id_area' => $request->id_area[$i]
                        ]);
                    }
                //eliminando las areas asignadas a un empleado
                }
            }
            if($request->id_departamento!=null){
                if (count($request->id_departamento)>0) {
                    $eliminar=\DB::table('empleados_has_departamentos')->where('id_empleado',$empleado->id)->delete();
                    //registrando a los empleados en multiples departamentos
                    for($i=0; $i<count($request->id_departamento); $i++){
                        \DB::table('empleados_has_departamentos')->insert([
                            'id_empleado' => $request->id_empleado,
                            'id_departamento' => $request->id_departamento[$i]
                        ]);
                    }
                }
            }
            if($request->id_afp!=null){
                if (count($request->id_afp)>0) {
                    $eliminar=\DB::table('empleados_has_afp')->where('id_empleado',$request->id_empleado)->delete();
                    for ($i=0; $i < count($request->id_afp) ; $i++) { 
                        $afp=\DB::table('empleados_has_afp')->insert([
                            'id_empleado' => $request->id_empleado,
                            'id_afp' => $request->id_afp[$i]
                        ]);
                    }
                }
            }
            if($request->id_area_e!=null){
                if (count($request->id_area_e)>0) {
                $eliminar=\DB::table('empleados_has_areas_empresa')->where('id_empleado',$request->id_empleado)->delete();
                    for ($i=0; $i < count($request->id_area_e) ; $i++) { 
                        $afp=\DB::table('empleados_has_areas_empresa')->insert([
                            'id_empleado' => $request->id_empleado,
                            'id_area_e' => $request->id_area_e[$i]
                        ]);
                    }
                }
            }
            if($request->id_faena!=null){
                if (count($request->id_faena)>0) {
                    $eliminar=\DB::table('empleados_has_faenas')->where('id_empleado',$request->id_empleado)->delete();
                    for ($i=0; $i < count($request->id_faena) ; $i++) { 
                        $afp=\DB::table('empleados_has_faenas')->insert([
                            'id_empleado' => $request->id_empleado,
                            'id_faena' => $request->id_faena[$i]
                        ]);
                    }
                }
            }
            if($request->id_isapre!=null){
                if (count($request->id_isapre)>0) {
                    $eliminar=\DB::table('empleados_has_isapre')->where('id_empleado',$request->id_empleado)->delete();
                    for ($i=0; $i < count($request->id_isapre) ; $i++) { 
                        $afp=\DB::table('empleados_has_isapre')->insert([
                            'id_empleado' => $request->id_empleado,
                            'id_isapre' => $request->id_isapre[$i]
                        ]);
                    }
                }
            }
            flash('<i class="fa fa-check-circle-o"></i> Datos de usuario actualizado con éxito!')->success()->important();
            return redirect()->to('empleados/'.$id.'/edit');
        } else if ($request->editar_licencias==1) {
            //dd($request->all());
            if($request->id_licencia!=null){
                if (count($request->id_licencia)>0) {
                $eliminar=\DB::table('empleados_has_licencias')->where('id_empleado',$request->id_empleado)->delete();
                 //registrando a los empleados en multiples areas
                    for($i=0; $i<count($request->id_licencia); $i++){
                        \DB::table('empleados_has_licencias')->insert([
                            'id_empleado' => $request->id_empleado,
                            'id_licencia' => $request->id_licencia[$i],
                            'fecha' => $request->fechae_licn[$i],
                            'fecha_vence' => $request->fechav_licn[$i]
                        ]);
                    }
                }
                flash('<i class="fa fa-check-circle-o"></i> Datos de usuario actualizado con éxito!')->success()->important();
                return redirect()->to('empleados/'.$id.'/edit');
            } else {
                /*flash('<i class="fa fa-check-circle-o"></i> ¡No hubo cambios en licencias!')->warning()->important();*/
                return redirect()->to('empleados/'.$id.'/edit');
            }
        } else if ($request->editar_cursos==1) {
            if($request->id_curso!=null){
                if (count($request->id_curso)>0) {
                $eliminar=\DB::table('empleados_has_cursos')->where('id_empleado',$request->id_empleado)->delete();
                    for ($i=0; $i < count($request->id_curso); $i++) { 
                        $curso=\DB::table('empleados_has_cursos')->insert([
                            'id_empleado' => $request->id_empleado,
                            'id_curso' => $request->id_curso[$i],
                            'fecha' => $request->curso_fecha_realizado[$i],
                            'fecha_vence' => $request->curso_fecha_vencimiento[$i]
                        ]);
                    }
                }
                flash('<i class="fa fa-check-circle-o"></i> Datos de usuario actualizado con éxito!')->success()->important();
                return redirect()->to('empleados/'.$id.'/edit');
            } else {
                /*flash('<i class="fa fa-check-circle-o"></i> ¡No hubo cambios en cursos!')->warning()->important();*/
                return redirect()->to('empleados/'.$id.'/edit');
            }
        } else if ($request->editar_examenes==1) {
            if($request->id_examen!=null){
                if (count($request->id_examen)>0) {
                    $eliminar=\DB::table('empleados_has_examenes')->where('id_empleado',$request->id_empleado)->delete();
                    for ($i=0; $i < count($request->id_examen); $i++) { 
                        $curso=\DB::table('empleados_has_examenes')->insert([
                            'id_empleado' => $request->id_empleado,
                            'id_examen' => $request->id_examen[$i],
                            'fecha' => $request->examenes_fecha_realizado[$i],
                            'fecha_vence' => $request->examenes_fecha_vencimiento[$i]
                        ]);
                    }
                }
                flash('<i class="fa fa-check-circle-o"></i> Datos de usuario actualizado con éxito!')->success()->important();
                return redirect()->to('empleados/'.$id.'/edit');
            } else {
                /*flash('<i class="fa fa-check-circle-o"></i> ¡No hubo cambios en examenes!')->warning()->important();*/
                return redirect()->to('empleados/'.$id.'/edit');
            }
        } else if ($request->datos_contactos==1) {
            //dd($request->all());
            \DB::table('informacion_contacto')->where('id_empleado', $request->id_empleado)
                ->update([
                    'nombre'=> $request->nombre,
                    'apellido'     => $request->apellido,
                    'telefono' => $request->telefono,
                    'email'=> $request->email_contacto,
                    'direccion' => $request->direccion
                ]);
            flash('<i class="fa fa-check-circle-o"></i> Datos de usuario actualizado con éxito!')->success()->important();
            return redirect()->to('empleados/'.$id.'/edit');
        }
             
    }

    public function cambiar_status(Request $request)
    {
        dd($request->all());
        $usuario = Empleados::find($request->id_usuario);
        //dd($usuario);
        $usuario->status=$request->status;
        $usuario->save();

        flash('<i class="fa fa-check-circle"></i> Status del empleado '.$usuario->nombres.' cambiado exitosamente a '.$usuario->status.'!')->success()->important();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleados  $empleados
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->id_empleado!=1) {
            
            $empleado=Empleados::find($request->id_empleado);
            $user=User::find($empleado->id_usuario);
            $id_user=$user->id;
            if($id_user > 0){
                $privilegios=UsuariosHasPrivilegios::where('id_usuario', $user->id)->get();
                for ($i=0; $i < count($privilegios); $i++) { 
                    $privilegios[$i]->delete();
                }
                \DB::table('actividades_proceso')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('avisos_enviados')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('comentarios_vistos')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('datos_laborales')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('datos_varios')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('empleados')->where('id', $request->id_empleado)->delete();
                \DB::table('empleados_has_afp')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('empleados_has_areas')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('empleados_has_areas_empresa')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('empleados_has_cursos')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('empleados_has_departamentos')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('empleados_has_examenes')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('empleados_has_faenas')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('empleados_has_isapre')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('empleados_has_licencias')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('informacion_contacto')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('muros')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('notas')->where('id_empleado', $request->id_empleado)->delete();
                \DB::table('novedades')->where('id_empleado', $request->id_empleado)->delete();
                if ($user->delete()) {
                    flash('<i class="fa fa-check-circle"></i> El Empleado fue eliminado exitosamente!')->success()->important();
                }
            } else {
                flash('<i class="fa fa-check-circle"></i> El Empleado no pudo ser eliminado!')->warning()->important();
            }
            
        }else{
            flash('<i class="fa fa-check-circle"></i> No ha seleccionado ningún usuario para eliminar!')->warning()->important();
        }
        return redirect()->back();
    }

    protected function CalculaEdad( $fecha ) {
        list($Y,$m,$d) = explode("-",$fecha);
        return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
    }


    //--Consulta
    public function buscar_cliente($cliente)
    {
        return Clientes::where('ruf',$cliente)->get();
    }

    //--Ruta
    
    // Route::get('clientes/{cliente}/buscar_cliente','ClientesController@buscar_cliente');    

    //--JQUERY

    // function buscar_cliente(cliente) {
        
        // $.get('clientes/'+cliente+'/buscar_cliente',function (comentarios) {
            
        //     var id_nombre="#mis_comentarios";
        //     var nombre="";
        //     var num="";
        //     var numero=id_actividad;
        //     num=numero.toString();
        //     nombre=id_nombre.concat(num);
        //     //console.log(nombre);
        //     $(""+nombre+"").text(comentarios);
        // });
}

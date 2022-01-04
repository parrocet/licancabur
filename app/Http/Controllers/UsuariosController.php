<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Areas;
use App\Empleados;
use App\User;
use Validator;
use DB;
use App\Planificacion;
class UsuariosController extends Controller
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
        dd('hola33');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('hola22');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd('hola11');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo_user=\Auth::user()->tipo_user;
        $areas=Areas::all();
        $empleado=Empleados::where('id_usuario',$id)->first();
        $emp=Empleados::where('id_usuario',$id)->count();
        //dd($emp);
        //$empleado = Empleados::where('empleados.email',\Auth::User()->email)->first();
        if ($empleado==null) {
            //dd(\Auth::user()->tipo_user);
            $usuario=User::find($id);
            return view('usuarios.perfil',compact('areas','id','usuario','emp','tipo_user'));
        } else {
        //dd($empleado);
            return view('usuarios.perfil', compact('areas','empleado','id','emp','tipo_user'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('hola1');
    }


    protected function validator_perfil(array $data)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        if ($request->empleado_existe > 0) {
        
            $this->validator_perfil($request->all())->validate();
        
            $rut=Empleados::where('rut',$request->rut)->where('id','<>',$id)->count();
            $empleado=Empleados::find($id);
            $email=User::where('email',$request->email)->where('id','<>',$empleado->id_usuario)->count();
        
            if ($email > 0) {
                flash('<i class="icon-circle-check"></i> El correo ya esta en uso!')->warning()->important();
                return redirect()->back();
            }elseif ($rut > 0) {
                flash('<i class="icon-circle-check"></i> El RUT ya esta en uso!')->warning()->important();
                return redirect()->back();
            } else {
                $empleado = Empleados::find($id);
                $usuario = User::find($empleado->id_usuario);

                //buscando planificaciones creadas por el usuario
                $planificaciones=Planificacion::where('elaborado',$usuario->name)->get();
                if(count($planificaciones) > 0){
                    foreach($planificaciones as $key){
                        $p=Planificacion::find($key->id);
                        $p->elaborado=$request->nombres." ".$request->apellidos;
                        $p->save();
                    }
                }
                $planificaciones=Planificacion::where('aprobado',$usuario->name)->get();
                if(count($planificaciones) > 0){
                    foreach($planificaciones as $key){
                        $p=Planificacion::find($key->id);
                        $p->aprobado=$request->nombres." ".$request->apellidos;
                        $p->save();
                    }
                }

                $empleado->nombres=$request->nombres;
                $empleado->apellidos=$request->apellidos;
                $empleado->email=$request->email;
                $empleado->rut=$request->rut;
                $empleado->edad=$request->edad;
                $empleado->genero=$request->genero;
                if (\Auth::User()->tipo_user=="Admin") {
                    $empleado->status=$request->status;
                    $empleado->id_area=$request->id_area;
                }
                $empleado->save();

                $usuario->name=$request->nombres." ".$request->apellidos;
                $usuario->email=$request->email;
                if ($request->cambiar_password=="1") {
                    $nueva_clave=\Hash::make($request->password);
                    $usuario->password=$nueva_clave;
                }   
                $usuario->save();

                //dd($request->all());
                //dd($empleado->id);
                flash('<i class="fa fa-check-circle-o"></i> Perfil | Datos de usuario actualizado con éxito!')->success()->important();
                return redirect()->back();
            }
        
        }else{
            //dd($request->all());
                $usuario = User::find($request->id);
                $usuario->name=$request->nombres." ".$request->apellidos;
                $usuario->email=$request->email;
                if ($request->cambiar_password=="1") {
                    $nueva_clave=\Hash::make($request->password);
                    $usuario->password=$nueva_clave;
                }   
                $usuario->save();

                flash('<i class="fa fa-check-circle-o"></i> Perfil | Datos de usuario actualizado con éxito!')->success()->important();
                return redirect()->back();
            }
    }

    public function update_privilegios(Request $request, $id)
    {
        //dd($request->id_privilegio);
        $datos = $request['id_privilegio'];

        $usuario=User::find($id);
        
        foreach ($usuario->privilegios as $key) {
            $hallado=0;
            for ($i=0; $i < count($request->id_privilegio) ; $i++) { 
                if ($key->pivot->id_privilegio==$request->id_privilegio[$i]) {
                    $hallado=1;
                }
            }
            if ($hallado==1) {
                DB::table('usuarios_has_privilegios')
                    ->where('id_usuario',$key->pivot->id_usuario)
                    ->where('id_privilegio', $key->pivot->id_privilegio)
                    ->update(['status' => "Si"]);
            } else {
               $query=DB::table('usuarios_has_privilegios')
                    ->where('id_usuario',$key->pivot->id_usuario)
                    ->where('id_privilegio', $key->pivot->id_privilegio)
                    ->update(['status' => "No"]);
            }
        }

        flash('<i class="fa fa-check-circle-o"></i> Privilegios actualizado con éxito!')->success()->important();
            return redirect()->to('empleados/'.$id.'/edit');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('hola115');
    }
}

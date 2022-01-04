<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Planificacion;
use App\Actividades;
use App\Gerencias;
use App\User;

class PlanificacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$usuarios=Empelados::whereIn('tipo_user', ['Admin', 'Planificacion'])->get();
        $usuarios = \DB::table('empleados')->join('users','users.id','=','empleados.id_usuario')
                                ->select('empleados.*')
                                ->whereIn('users.tipo_user', ['Admin', 'Planificacion'])->get();
        $gerencias=Gerencias::all();
        $planificaciones=Planificacion::where('anio',session('fecha_actual'))->get();

        return View('planificaciones.index', compact('planificaciones','gerencias','usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        
        $fechaHoy = date($request->desde);
        $num_dia=num_dia($fechaHoy);
        $num_semana_actual=date('W', strtotime($fechaHoy));
        if ($num_dia==1 || $num_dia==2) {
            $num_semana_actual--;
        }

        $fechas = $request->desde." al ".$request->hasta1;
        $buscar = Planificacion::where('fechas',$fechas)->whereIn('id_gerencia',$request->id_gerencia)->count();
        //dd($buscar);
        if($buscar>0) {
            flash('<i class="icon-circle-check"></i> Error ya existe planificacion registradas en esta gerencia y/o fechas seleccionadas')->warning();
            return redirect()->to('planificaciones');
        } else {
            if ($request->anio_all==1) {
                //dd($request->all());
                $fechaInicio=strtotime(session('fecha_actual')."-01-01");
                $fechaFin=strtotime(session('fecha_actual')."-12-31");
                //Recorro las fechas y con la función strotime obtengo los lunes
                $contar=0;
                for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
                    //Sacar el dia de la semana con el modificador N de la funcion date
                    $dia = date('N', $i);
                    if($dia==3){
                        $fecha = date("Y-m-d", $i);
                        $fechas = date ("d-m-Y", $i)." al ".date("d-m-Y", strtotime($fecha."+ 6 days"));
                        $semana = date ("W", $i);
                        $datos = $request['id_gerencia'];
                        $mensaje="";
                        $x=0;
                        echo "semana: ".$semana."<br>";
                        //dd('semana '.$semana."--".$request->id_gerencia[0]."--".);
                        for($j=0 ; $j < count($request->id_gerencia) ; $j++){

                            $buscar = Planificacion::where('semana',$semana)->where('id_gerencia',$request->id_gerencia[$j])->where('anio',session('fecha_actual'))->count();
                            $gerencia=Gerencias::find($request->id_gerencia[$j]);
                            
                            
                            if($buscar == 0){

                                $buscar_elaborado = \DB::table('empleados')->join('users','users.id','=','empleados.id_usuario')
                                ->select('empleados.nombres','empleados.apellidos')
                                ->where('users.id',$request->elaborado)->first();

                                $elaborado = $buscar_elaborado->nombres." ". $buscar_elaborado->apellidos;

                                $buscar_aprobado = \DB::table('empleados')->join('users','users.id','=','empleados.id_usuario')
                                ->select('empleados.nombres','empleados.apellidos')
                                ->where('users.id',$request->aprobado)->first();

                                $aprobado = $buscar_aprobado->nombres." ". $buscar_aprobado->apellidos;
                                   
                                $planificacion = new Planificacion();
                                $planificacion->id_elaborado=$request->elaborado;
                                $planificacion->elaborado=$elaborado;
                                $planificacion->id_aprobado=$request->aprobado;
                                $planificacion->aprobado=$aprobado;
                                $planificacion->num_contrato=$request->num_contrato;
                                $planificacion->fechas=$fechas;
                                $planificacion->semana=$semana;
                                $planificacion->anio=session('fecha_actual');
                                $planificacion->revision=$request->revision;
                                $planificacion->id_gerencia=$request->id_gerencia[$j];
                                $planificacion->save();
                                $contar++;
                                
                            }else{
                                $gerencia=Gerencias::find($request->id_gerencia[$j]);
                                $mensaje.="Semana: ".$semana." en genrencia: ".$gerencia->gerencia." | ";
                                    
                            }
                        }
                    }
                }
                    
                if($contar > 0){
                    if($mensaje!=""){
                        flash('<i class="icon-circle-check"></i> Éxito! se registraron '.$contar.' planificaciones satisfactoriamente: sin embargo ya estaban registradas las planificaciones:'.$mensaje)-> success();        
                    }else{
                        flash('<i class="icon-circle-check"></i> Éxito! se registraron '.$contar.' planificaciones satisfactoriamente')-> success();    
                    }
                           
                }else{
                    flash('<i class="icon-circle-check"></i> Alerta! No se registraron planificaciones, ya se encontaban registradas')->error();
                }
                return redirect()->to('planificaciones');
            } else {
                $datos = $request['id_gerencia'];
                foreach($datos as $selected){

                    $buscar_elaborado = \DB::table('empleados')->join('users','users.id','=','empleados.id_usuario')
                        ->select('empleados.nombres','empleados.apellidos')
                        ->where('users.id',$request->elaborado)->first();

                    $elaborado = $buscar_elaborado->nombres." ". $buscar_elaborado->apellidos;

                    $buscar_aprobado = \DB::table('empleados')->join('users','users.id','=','empleados.id_usuario')
                    ->select('empleados.nombres','empleados.apellidos')
                    ->where('users.id',$request->aprobado)->first();

                    $aprobado = $buscar_aprobado->nombres." ". $buscar_aprobado->apellidos;

                    $planificacion = new Planificacion();
                    $planificacion->id_elaborado=$request->elaborado;
                    $planificacion->elaborado=$elaborado;
                    $planificacion->id_aprobado=$request->aprobado;
                    $planificacion->aprobado=$aprobado;
                    $planificacion->num_contrato=$request->num_contrato;
                    $planificacion->fechas=$fechas;
                    $planificacion->semana=$num_semana_actual;
                    $planificacion->anio=session('fecha_actual');
                    $planificacion->revision=$request->revision;
                    $planificacion->id_gerencia=$selected;
                    $planificacion->save();
                }
            }
            flash('<i class="icon-circle-check"></i> Éxito! Planificación registrada satisfactoriamente')->success();
            return redirect()->to('planificaciones');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd('hola mundo');
        $usuarios=User::whereIn('tipo_user', ['Admin', 'Planificacion'])->get();
        $gerencias=Gerencias::all();
        $planificacion=Planificacion::find($id);
        return view('planificaciones.edit',compact('planificacion','usuarios','gerencias'));
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
        $fechaHoy = date($request->desde);
        $num_dia=num_dia($fechaHoy);
        $num_semana_actual=date('W', strtotime($fechaHoy));
        if ($num_dia==1 || $num_dia==2) {
            $num_semana_actual--;
        }

        $fechas = $request->desde." al ".$request->hasta1;
        $plan = Planificacion::where('id',$id)->count();
        $buscar_gerencias = Planificacion::where([['fechas',$request->fechas_r],['id_gerencia',$request->id_gerencia]])->count();
        //dd($buscar_gerencias);
        if ($request->cambiar_gerencia==1) {
            //dd('f');
            if($buscar_gerencias>0) {
                flash('<i class="icon-circle-check"></i> Error ya existe planificación registradas en esta gerencia selecciondas')->warning();
                return redirect()->to('planificaciones');
            } else {

                $buscar_elaborado = \DB::table('empleados')->join('users','users.id','=','empleados.id_usuario')
                ->select('empleados.nombres','empleados.apellidos')
                ->where('users.id',$request->elaborado)->first();

                $elaborado = $buscar_elaborado->nombres." ". $buscar_elaborado->apellidos;

                $buscar_aprobado = \DB::table('empleados')->join('users','users.id','=','empleados.id_usuario')
                ->select('empleados.nombres','empleados.apellidos')
                ->where('users.id',$request->aprobado)->first();

                $aprobado = $buscar_aprobado->nombres." ". $buscar_aprobado->apellidos;

                $planificacion = Planificacion::find($request->id);
                $planificacion->id_elaborado=$request->elaborado;
                $planificacion->elaborado=$elaborado;
                $planificacion->id_aprobado=$request->aprobado;
                $planificacion->aprobado=$aprobado;
                $planificacion->num_contrato=$request->num_contrato;
                $planificacion->revision=$request->revision;
                $planificacion->id_gerencia=$request->id_gerencia;
                $planificacion->save();
            }
        } else {

            $buscar_elaborado = \DB::table('empleados')->join('users','users.id','=','empleados.id_usuario')
            ->select('empleados.nombres','empleados.apellidos')
            ->where('users.id',$request->elaborado)->first();

            $elaborado = $buscar_elaborado->nombres." ". $buscar_elaborado->apellidos;

            $buscar_aprobado = \DB::table('empleados')->join('users','users.id','=','empleados.id_usuario')
            ->select('empleados.nombres','empleados.apellidos')
            ->where('users.id',$request->aprobado)->first();

            $aprobado = $buscar_aprobado->nombres." ". $buscar_aprobado->apellidos;
                
            $planificacion = Planificacion::find($request->id);
            $planificacion->id_elaborado=$request->elaborado;
            $planificacion->elaborado=$elaborado;
            $planificacion->id_aprobado=$request->aprobado;
            $planificacion->aprobado=$aprobado;
            $planificacion->num_contrato=$request->num_contrato;
            $planificacion->revision=$request->revision;
            $planificacion->save();
        }
            flash('<i class="icon-circle-check"></i> Exito! Planificación modificada satisfactoriamente')->success();
            return redirect()->to('planificaciones');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $actividades=Actividades::where('id_planificacion',$request->id)->get()->count();
        if ($actividades == 0 || $actividades == null) {
            $planificacion=Planificacion::find($request->id);

            if ($planificacion->delete()) {
                flash('<i class="icon-circle-check"></i> Planificación eliminada satisfactoriamente!')->success()->important();
            }else{
                flash('<i class="icon-circle-check"></i> Ocurrió un problema al eliminar la planificación! Inténtelo nuevamente!')->danger()->important();
            }
            return redirect()->to('planificaciones');
        }else{
            flash('<i class="icon-circle-check"></i> Hay actividades registradas en esta planificación! Elimine las actividades registradas')->warning();
            return redirect()->to('planificaciones');
        }

    }
}

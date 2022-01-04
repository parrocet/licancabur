<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Planificacion;
use App\Actividades;
use App\Empleados;
use App\ActividadesProceso;
use App\Areas;
Use \Carbon\Carbon;
class AsignacionesController extends Controller
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
        // $date = Carbon::now();
        // dd($date->toRfc850String());
        //$planificaciones=planificacion::all();
        //averiguando en que semana estamos
            $fechaHoy = date(session('fecha_actual').'-m-d');
            $num_dia=num_dia($fechaHoy);
            $num_semana_actual=date('W', strtotime($fechaHoy));
            if ($num_dia==1 || $num_dia==2) {
                $num_semana_actual--;
            }
            // dd($num_dia);
        if (session('fecha_actual')!=date('Y')) {
            $planificaciones = Planificacion::where('anio',session('fecha_actual'))->get();
        } else {
            $planificaciones = Planificacion::where('semana','>=',$num_semana_actual)->where('anio',session('fecha_actual'))->get();
        }
        //$planificaciones=Actividades::groupBy('task')->orderBy('id','DESC')->get();
        return view('planificacion.asignaciones.index', compact('planificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $empleados=Empleados::all();
        $contador=1;
        $actividades=Actividades::all();
        return view('planificacion.asignaciones.create', compact('contador','actividades','empleados'));
    }


    public function buscar_empleado($id_empleado)
    {
        

        // return $actividades_proceso=ActividadesProceso::where('id_empleado',$id_empleado)->get(); $actividades=\DB::table('actividades')->whereIn('id',$actividades_proceso)->orderByRaw(\DB::raw("FIELD(id, ".implode(",",$actividades_proceso).")"))->get();

        return $empleado=\DB::table('empleados')->join('actividades_proceso','actividades_proceso.id_empleado','=','empleados.id')->join('actividades','actividades.id',"=","actividades_proceso.id_actividad")
        ->select('actividades.*')->where('empleados.id',$id_empleado)->get();
    }

    public function buscar_empleado2($activi)
    {
        

        return $actividades=\DB::table('actividades')->whereIn('id',$activi)->orderByRaw(\DB::raw("FIELD(id, ".implode(",",$actividades_proceso).")"))->get();
    }

    public function buscar_areas($id_planificacion)
    {
        $planificacion=Planificacion::find($id_planificacion);
            /*if (\Auth::user()->tipo_user!="Admin") {
                $id_area=array();
                $empleado=Empleados::where('id_usuario',\Auth::user()->id)->first();
                foreach ($empleado->areas as $key) {
                $cont=0;
                
                for ($i=0; $i < count($id_area); $i++) { 
                    if ($id_area[$i]==$key->id && $key->id_gerencia==$planificacion->id_gerencia) {
                        $cont++;
                    }
                    
                }
                if ($cont==0) {
                    $id_area[$i]=$key->id;
                }
                $i++;
                
            } else {
                # code...
            }*/
        if (\Auth::user()->tipo_user!="Admin") {
            $empleado=Empleados::where('id_usuario',\Auth::user()->id)->first();
            // return $areas=\DB::table('areas')
            //     ->join('empleados_has_areas','empleados_has_areas.id_area','areas.id')
            //     ->join('empleados','empleados.id','empleados_has_areas.id_empleado')
            //     ->where('empleados.id',$empleado->id)
            //     ->where('areas.id_gerencia',$planificacion->id_gerencia)
            //     ->select('areas.id','areas.area')->get();
            return $areas=\DB::table('planificacion')
                ->join('actividades','actividades.id_planificacion','=','planificacion.id')
                ->join('actividades_proceso','actividades_proceso.id_actividad','=','actividades.id')
                ->join('areas','areas.id_gerencia','=','planificacion.id_gerencia')
                ->join('empleados','empleados.id','actividades_proceso.id_empleado')
                ->where('empleados.id',$empleado->id)
                ->where('planificacion.id',$planificacion->id)
                ->where('areas.id_gerencia',$planificacion->id_gerencia)
                ->groupBy('areas.id')
                ->select('areas.id','areas.area')
                ->get();
        }else{

            return $areas=Areas::where('id_gerencia',$planificacion->id_gerencia)->get();
        }


        //dd($planificacion);
        //return $planificacion->id_gerencia;
    }

    public function buscar_dias($id_planificacion,$id_area)
    {
        if (\Auth::user()->tipo_user!="Admin") {
            $empleado=Empleados::where('id_usuario',\Auth::user()->id)->first();

            return $dias=\DB::table('planificacion')
                ->join('actividades','actividades.id_planificacion','=','planificacion.id')
                ->join('actividades_proceso','actividades_proceso.id_actividad','=','actividades.id')
                ->join('empleados','empleados.id','actividades_proceso.id_empleado')
                ->where('empleados.id',$empleado->id)
                ->where('planificacion.id',$id_planificacion)
                ->where('actividades.id_area',$id_area)
                ->groupBy('actividades.dia')
                ->select('actividades.dia')
                ->get();
        }else{

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    public function eliminar_asignacion($id_actividad,$id_empleado)
    {
        $asignacion=\DB::table('actividades_proceso')->where('id_actividad',$id_actividad)->where('id_empleado',$id_empleado)->delete();
        // $asignacion->delete();

        return $empleado=\DB::table('empleados')->join('actividades_proceso','actividades_proceso.id_empleado','=','empleados.id')->join('actividades','actividades.id',"=","actividades_proceso.id_actividad")->select('actividades.*')->where('empleados.id',$id_empleado)->get();

        // return $actividades=\DB::table('actividades')->get();
        // return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function buscar_tipo($id_area)
    {
        return $actividades=Actividades::where('id_area',$id_area)->groupBy('tipo')->get();
    }

    public function eliminar_asignacion_g($id_planificacion,$id_empleado,$id_area)
    {
        $actividades=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',$id_area)->get();
        if(count($actividades)>0){
            //dd($actividades);
        foreach ($actividades as $key) {
            $buscar=ActividadesProceso::where('id_actividad',$key->id)->where('id_empleado',$id_empleado)->first();
            if ($buscar!==null) {
                $buscar->delete();    
            }
            
        }
        }
        return count($actividades);
    }

    public function asignaciones_eliminar(Request $request)
    {
        $cont=0;
        for ($i=0; $i < count($request->selected); $i++) { 
            
        $buscar=ActividadesProceso::where('id_empleado',$request->id_empleado)->where('id_actividad',$request->selected[$i])->first();
        if ($buscar!==null) {
            $cont++;
            $buscar->delete();
        }
        }
        return $cont;
    }
}

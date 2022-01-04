<?php

namespace App\Http\Controllers;

use App\Planificacion;
use Illuminate\Http\Request;
use App\Actividades;
use App\Gerencias;
use App\Areas;
use App\Departamentos;
use App\ActividadesProceso;
use App\Http\Requests\PlanificacionRequest;
use App\Empleados;
Use \Carbon\Carbon;
// date_default_timezone_set('UTC');

ini_set('max_execution_time', 900);
set_time_limit(900);
class PlanificacionController extends Controller
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
        /*$actividad=Actividades::where('id',57)->first();
        dd($actividad);*/
        //obteniendo id_empleado
        
        $num=0;
        $dia=dia(date(session('fecha_actual').'-m-d'));
        $empleado=Empleados::where('id_usuario',\Auth::user()->id)->first();
        //dd($empleado);
        if (!is_null($empleado)) {
                

            $buscar=\DB::table('actividades_proceso')
                    ->join('actividades','actividades.id','actividades_proceso.id_actividad')
                    ->join('empleados','empleados.id','actividades_proceso.id_empleado')
                    ->join('areas','areas.id','actividades.id_area')
                    ->join('departamentos','departamentos.id','actividades.id_departamento')
                    ->where('id_empleado',$empleado->id)
                    ->where('actividades.fecha_vencimiento',date('Y-m-d'))
                    ->select('actividades.*','areas.area','departamentos.departamento')
                    ->get();
            //dd($buscar);
            //areas registradas
            $mis_areas=\DB::table('areas')->join('empleados_has_areas','empleados_has_areas.id_area','=','areas.id')->join('empleados','empleados.id','=','empleados_has_areas.id_empleado')->where('empleados.id',$empleado->id)->select('areas.id','areas.area')->get();
                //dd($mis_areas);
            //variables de conteo
            $dp=array();//arreglo para la duracion proyectada
            $dr=array();//arreglo para la duracion real 
            $totaldr=0;
            $totaldp=0;
            $i=0;
            //inicializando
            foreach ($mis_areas as $key) {
                $dp[$i]=0;
                $dr[$i]=0;
                $i++;
            }
            $k=0;
            foreach ($mis_areas as $key) {
                for ($j=0; $j < count($buscar); $j++) { 
                    if ($buscar[$j]->id_area==$key->id) {
                      if ($buscar[$j]->duracion_pro!="NULL") {
                            $dp[$k]+=$buscar[$j]->duracion_pro;
                            $totaldp+=$buscar[$j]->duracion_pro;
                        }
                      if ($buscar[$j]->duracion_real!="NULL") {
                            $dr[$k]+=$buscar[$j]->duracion_real;
                            $totaldr+=$buscar[$j]->duracion_real;
                        }  
                    }
                }
                $k++;
            }
        }
            //dd($dp);
            //dd("-----");
            //fin del conteo de duraciones

        $departamentos=Departamentos::where('id','<>',0)->get();
        $planificaciones=Planificacion::where('anio',session('fecha_actual'))->get();
        $actividadesProceso=ActividadesProceso::all();
        
        $empleados=Empleados::all();
        // dd(count($planificaciones));
        //consultando las planificaciones del empleado
        if (\Auth::user()->tipo_user=="Empleado") {

            $gerencias=array();
            $id_gerencia=array();
            $empleado=Empleados::where('id_usuario',\Auth::user()->id)->first();
            foreach ($empleado->areas as $key) {
                $cont=0;
            
                for ($i=0; $i < count($gerencias); $i++) { 
                    if ($gerencias[$i]==$key->gerencias->gerencia) {
                        $cont++;
                    }
                    
                }
                if ($cont==0) {
                    $gerencias[$i]=$key->gerencias->gerencia;
                    $id_gerencia[$i]=$key->id_gerencia;
                }
                $i++;
            }
            

            if (count($id_gerencia)==2) {
                $planificaciones=Planificacion::where('id_gerencia',$id_gerencia[0],$id_gerencia[1])->where('anio',session('fecha_actual'))->get();
            } elseif(count($id_gerencia)==1){
                $planificaciones=Planificacion::where('id_gerencia',$id_gerencia[0])->where('anio',session('fecha_actual'))->get();
            }
            //$actividades=Empleados::find(\Auth::user()->id);
            $actividadesProceso=ActividadesProceso::where('id_empleado',$empleado->id)->get();
            //averiguando en que semana estamos

            $fechaHoy = date(session('fecha_actual').'-m-d');
            $num_dia=num_dia($fechaHoy);
            $num_semana_actual=date('W', strtotime($fechaHoy));
            if ($num_dia==1 || $num_dia==2) {
                $num_semana_actual--;
            }

            // $date = Carbon::now();
            // dd($fechaHoy);

            // dd(Carbon::now());
            $gerencias=Gerencias::all();
            $gerencias1=Gerencias::where('gerencia','NPI')->first();
            $gerencias2=Gerencias::where('gerencia','CHO')->first();
            
            
            //Par mostrar las planificaciones de la semana actual
            $planificacion1 = Planificacion::where('semana',$num_semana_actual)->where('id_gerencia',1)->where('anio',session('fecha_actual'))->first();
            if(is_null($planificacion1)){
                $planificacion1=0;
            }
            $planificacion2 = Planificacion::where('semana',$num_semana_actual)->where('id_gerencia',2)->where('anio',session('fecha_actual'))->first();
            if(is_null($planificacion2)){
                $planificacion2=0;
            }
            //para prueba

            /*$planificacion1 = Planificacion::where('semana',38)->where('id_gerencia',1)->first();
            $planificacion2 = Planificacion::where('semana',38)->where('id_gerencia',2)->first();
            $num_semana_actual=38;*/
            //------------------------------
            $planificacion3 = Planificacion::where('semana',$num_semana_actual)->where('anio',session('fecha_actual'))->get();
           if(count($planificacion3)>0){

            $actividades=Actividades::where('id_planificacion',[$planificacion3[0]->id,$planificacion3[1]->id])->get();
            }else{
                $actividades=0;
            }
                    
            if(session('fecha_actual')!=date('Y')) {
                $planificacion = Planificacion::where('anio',session('fecha_actual'))->get();
            } else {
                $planificacion = Planificacion::where('semana','>=',$num_semana_actual)->where('anio',session('fecha_actual'))->get();
            }
            //dd('Numero de dia',$num_dia,'Numero de semana',$num_semana_actual);
            //$planificacion = Planificacion::all();
            //dd($empleado->id);

            $areas=\DB::table('areas')->join('empleados_has_areas','empleados_has_areas.id_area','=','areas.id')->join('empleados','empleados.id','=','empleados_has_areas.id_empleado')->where('empleados.id',$empleado->id)->select('areas.id','areas.area')->get();
            //actividades pm01
            $id_area=0;

            $actividadesProceso2=ActividadesProceso::where('id_empleado',$empleado->id)->get();
            $planificaciones2=\DB::table('planificacion')
                ->join('actividades','actividades.id_planificacion','=','planificacion.id')
                ->join('actividades_proceso','actividades_proceso.id_actividad','=','actividades.id')
                ->join('gerencias','gerencias.id','=','planificacion.id_gerencia')
                ->where('actividades_proceso.id_empleado',$empleado->id)
                ->where('planificacion.anio',session('fecha_actual'))
                ->groupBy('planificacion.id')
                ->select('planificacion.*','gerencias.gerencia')
                ->get();

            // dd(count($planificaciones2));



            return view("planificacion.index", compact('fechaHoy','num_semana_actual','actividades','departamentos','planificaciones','planificaciones2','actividadesProceso','actividadesProceso2','empleados','areas','id_area','planificacion','dr','dp','totaldr','totaldp','num_semana_actual','buscar','num'));
        } else {

            // dd('das');
                //averiguando en que semana estamos
            $fechaHoy = date(session('fecha_actual').'-m-d');
            $num_dia=num_dia($fechaHoy);
            $num_semana_actual=date('W', strtotime($fechaHoy));
            if ($num_dia==1 || $num_dia==2) {
                $num_semana_actual--;
            }
            
            $gerencias=Gerencias::all();
            $gerencias1=Gerencias::where('gerencia','NPI')->first();
            $gerencias2=Gerencias::where('gerencia','CHO')->first();
            
            
            //Par mostrar las planificaciones de la semana actual
            //dd(session('fecha_actual'));

            $planificacion1 = Planificacion::where('semana',$num_semana_actual)->where('id_gerencia',1)->where('anio',session('fecha_actual'))->first();
            if(is_null($planificacion1)){
                $planificacion1=0;
            }
            $planificacion2 = Planificacion::where('semana',$num_semana_actual)->where('id_gerencia',2)->where('anio',session('fecha_actual'))->first();
            if(is_null($planificacion2)){
                $planificacion2=0;
            }

            //para prueba

            /*$planificacion1 = Planificacion::where('semana',38)->where('id_gerencia',1)->first();
            $planificacion2 = Planificacion::where('semana',38)->where('id_gerencia',2)->first();
            $num_semana_actual=38;*/
            //------------------------------
            $planificacion3 = Planificacion::where('semana',$num_semana_actual)->where('anio',session('fecha_actual'))->get();
            
            if(is_null($planificacion3)){
                $actividades=Actividades::where('id_planificacion',[$planificacion3[0]->id,$planificacion3[1]->id])->get();
            }else{
                $actividades=0;
            }
                    
            // dd(count($actividades));
            if(session('fecha_actual')!=date('Y')) {
                $planificacion = Planificacion::where('anio',session('fecha_actual'))->get();
            } else {
                $planificacion = Planificacion::where('semana','>=',$num_semana_actual)->where('anio',session('fecha_actual'))->get();
            }
            //$planificacion = Planificacion::all();
            
            $areas=Areas::all();
            //actividades pm01
            $id_area=0;
            $envio=1;
            // dd($actividades->all());
            // dd(count($planificaciones));

        return view("planificacion.index", compact('fechaHoy','planificacion','planificacion1','planificacion2','areas','num_semana_actual','gerencias','gerencias1','gerencias2','actividades','id_area','envio','actividadesProceso','planificaciones','empleados','departamentos','num'));
        }
        
        
        
    }
    public function buscar_api(){
        return $id = Empleados::all();
    }
    public function api_fc(){
        $consulta = Empleados::where('id',\Auth::user()->id)->first();
        $count = count($consulta);

        $eventos = array();    

        //foreach($consulta as $key){
            foreach ($consulta->actividades as $resultado){
                $id = $resultado['id'];
                $title = $resultado['task'];
                $start = $resultado['fecha_vencimiento'];
                
                $eventos[] = array('id' => $id, 'title' => $title, 'start' => $start);
                
            }
        //}
            //dd($eventos);
        
        $arrayJson = json_encode($eventos, JSON_UNESCAPED_UNICODE);
        print_r($arrayJson);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $planificaciones=Planificacion::where('anio',session('fecha_actual'))->get();
        $actividadesProceso=ActividadesProceso::all();
        $empleados=Empleados::all();
        //consultando las planificaciones del empleado
        if (\Auth::user()->tipo_user=="Empleado") {
            $actividades=Empleados::find(\Auth::user()->id);
            //averiguando en que semana estamos
            $fechaHoy = date(session('fecha_actual').'-m-d');
            $num_semana_actual=date('W', strtotime($fechaHoy));

        return view("planificacion.index", compact('fechaHoy','num_semana_actual','actividades'));
        } else {
            //dd('das');
                //averiguando en que semana estamos
            $fechaHoy = date(session('fecha_actual').'-m-d');
            $num_dia=num_dia($fechaHoy);
            $num_semana_actual=date('W', strtotime($fechaHoy));
            if ($num_dia==1 || $num_dia==2) {
                $num_semana_actual--;
            }
            
            $gerencias=Gerencias::all();
            $gerencias1=Gerencias::where('gerencia','NPI')->first();
            $gerencias2=Gerencias::where('gerencia','CHO')->first();
            
            
            //Par mostrar las planificaciones de la semana actual
            $planificacion1 = Planificacion::where('semana',$num_semana_actual)->where('id_gerencia',1)->where('anio',session('fecha_actual'))->first();
            $planificacion2 = Planificacion::where('semana',$num_semana_actual)->where('id_gerencia',2)->where('anio',session('fecha_actual'))->first();
            //para prueba

            /*$planificacion1 = Planificacion::where('semana',38)->where('id_gerencia',1)->first();
            $planificacion2 = Planificacion::where('semana',38)->where('id_gerencia',2)->first();
            $num_semana_actual=38;*/
            //------------------------------
            //dd($planificacion1);
            
            $planificacion = Planificacion::where('semana','>=',$num_semana_actual)->where('anio',session('fecha_actual'))->get();
            //$planificacion = Planificacion::all();
            
            $areas=Areas::all();
            //actividades pm01
            $actividades=Actividades::where('id','<>',0)->orderBy('id','DESC')->get();
            $id_area=0;
            $envio=1;
            // dd($actividades->all());
        return view("planificacion.index", compact('fechaHoy','planificacion','planificacion1','planificacion2','areas','num_semana_actual','gerencias','gerencias1','gerencias2','actividades','id_area','envio','actividadesProceso','planificaciones'));
        }
        
        
        
    }

    public function view()
    {
        //consultando las planificaciones del empleado
        if (\Auth::user()->tipo_user=="Empleado") {
            $actividades=Empleados::find(\Auth::user()->id);
            //averiguando en que semana estamos
            $fechaHoy = date(session('fecha_actual').'-m-d');
            $num_semana_actual=date('W', strtotime($fechaHoy));

        return view("planificacion.index", compact('fechaHoy','num_semana_actual','actividades'));
        } else {
            //dd('das');
                //averiguando en que semana estamos
            $fechaHoy = date(session('fecha_actual').'-m-d');
            $num_dia=num_dia($fechaHoy);
            $num_semana_actual=date('W', strtotime($fechaHoy));
            if ($num_dia==1 || $num_dia==2) {
                $num_semana_actual--;
            }
            //dd($num_semana_actual);
            $gerencias=Gerencias::all();
            
            
            
            //Par mostrar las planificaciones de la semana actual
            $planificacion1 = null;
            //para prueba
            /*$planificacion1 = Planificacion::where('semana',38)->where('id_gerencia',1)->first();
            $planificacion2 = Planificacion::where('semana',38)->where('id_gerencia',2)->first();
            $num_semana_actual=38;*/
            //------------------------------
            //dd($planificacion1);
            $planificacion = Planificacion::where('semana','>=',$num_semana_actual)->where('anio',session('fecha_actual'))->get();
            $areas=Areas::all();
            //actividades pm01
            $actividades=Actividades::select('id_area','id',\DB::raw('task'))->where('tipo','PM02')->groupBy('task')->orderBy('id','DESC')->get();
            //dd($actividades->all());
            $id_area=0;
            $envio=1;
            
        return view("planificacion.index", compact('planificacion','planificacion1','areas','num_semana_actual','gerencias','actividades','id_area','envio'));

        }
        
        
        
    }

    public function buscar_areas($id_gerencia)
    {
        //return $areas=\DB::table('actividades')->join('planificacion','planificacion.id','=','actividades.id_planificacion')->join('gerencias','gerencias.id','=','planificacion.id_gerencia')->join('areas','areas.id','=','actividades.id_area')->select('areas.*')->where('actividades.id_planificacion', $id_gerencia)->groupBy('id')->get();

        //return $actividades=\DB::where('id_planificacion', $id_gerencia)->get();

        // return $empleados=\DB::table('empleados')->join('empleados_has_areas','empleados_has_areas.id_empleado','=','empleados.id')->join('areas','areas.id',"=","empleados_has_areas.id_area")
        // ->select('empleados.*')->where('areas.id',$id_area)->get();

        return $areas=Areas::where('id_gerencia',$id_gerencia)->get();
    }


    public function buscar(Request $request)
    {
        //dd($request->all());
        $planificaciones=Planificacion::where('id_gerencia',$request->id_gerencia)->where('semana',$request->semanas)->where('anio',session('fecha_actual'))->first();
        $gerencias=Gerencias::all();
        $areas=Areas::all();
        $id_area=$request->id_area;

        if(empty($planificaciones)){
            $encontrado=0;
        }else{
            $encontrado=1;
            //contando actividades por dia
        $mie=0;$jue=0;$vie=0;$sab=0;$dom=0;$lun=0;$mar=0;
        //variables para sumar totales de duracion
        $tiempos = array();
        //inicializando
        $tiempos[0][0]="Duración Proyectada";
        $tiempos[1][0]="Duración Real";
        for ($i=0; $i < 2; $i++) { 
            for ($j=1; $j < 8; $j++) { 
                $tiempos[$i][$j]=0;
            }
        }
        //miercoles
        $t1mie=0;$t2mie=0;
        //jueves
        $t1jue=0;$t2jue=0;
        //viernes
        $t1vie=0;$t2vie=0;
        //sabado
        $t1sab=0;$t2sab=0;
        //domingo
        $t1dom=0;$t2dom=0;
        //lunes
        $t1lun=0;$t2lun=0;
        //martes
        $t1mar=0;$t2mar=0;
        foreach ($planificaciones->actividades as $key) {
            if ($id_area==$key->id_area) {
                $dia=dia($key->fecha_vencimiento);
                switch ($dia) {
                    case 'Mié':
                        $mie++;
                        $t1mie+=$key->duracion_pro;
                        $t2mie+=$key->duracion_real;
                        $tiempos[0][1]+=$key->duracion_pro;
                        $tiempos[1][1]+=$key->duracion_real;
                        break;
                    case 'Jue':
                        $jue++;
                        $t1jue+=$key->duracion_pro;
                        $t2jue+=$key->duracion_real;
                        $tiempos[0][2]+=$key->duracion_pro;
                        $tiempos[1][2]+=$key->duracion_real;
                        break;
                    case 'Vie':
                        $vie++;
                        $t1vie+=$key->duracion_pro;
                        $t2vie+=$key->duracion_real;
                        $tiempos[0][3]+=$key->duracion_pro;
                        $tiempos[1][3]+=$key->duracion_real;
                        break;
                    case 'Sáb':
                        $sab++;
                        $t1sab+=$key->duracion_pro;
                        $t2sab+=$key->duracion_real;
                        $tiempos[0][4]+=$key->duracion_pro;
                        $tiempos[1][4]+=$key->duracion_real;
                        break;
                    case 'Dom':
                        $dom++;
                        $t1dom+=$key->duracion_pro;
                        $t2dom+=$key->duracion_real;
                        $tiempos[0][5]+=$key->duracion_pro;
                        $tiempos[1][5]+=$key->duracion_real;
                        break;
                    case 'Lun':
                        $lun++;
                        $t1lun+=$key->duracion_pro;
                        $t2lun+=$key->duracion_real;
                        $tiempos[0][6]+=$key->duracion_pro;
                        $tiempos[1][6]+=$key->duracion_real;
                        break;
                    case 'Mar':
                        $mar++;
                        $t1mar+=$key->duracion_pro;
                        $t2mar+=$key->duracion_real;
                        $tiempos[0][7]+=$key->duracion_pro;
                        $tiempos[1][7]+=$key->duracion_real;
                        break;
                }//cierre del switch
            }//fin del if
        }//fin del foreach
        }//fin del else
        

        //dd($planificaciones);
        
        $fecha=date(session('fecha_actual').'-m-d');
        $num_semana_actual=date('W', strtotime($fecha));

        return view('planificacion.index',compact('gerencias','areas','planificaciones','id_area','encontrado','num_semana_actual','tiempos'));
    }

    public function calcular_fechas($num_semana)
    {
        $anio=date(session('fecha_actual'));
        $siguiente=$num_semana+1;
        $fecha1=date("d-m-Y",strtotime($anio."-W".$num_semana."-3"));
        $fecha2=date("d-m-Y",strtotime($anio."-W".$siguiente."-2"));
        $fechas=$fecha1." al ".$fecha2;

        return $fechas;

    }

    public function buscar_pm01()
    {
        return $actividades=Actividades::where('tipo','PM02')->get();
    }
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanificacionRequest $request)
    {
        //dd($request->all());
        $planificacion= new Planificacion();

        $planificacion->fill($request->all())->save();

        flash('<i class="icon-circle-check"></i> Planificación registrada satisfactoriamente!')->success()->important();
        return redirect()->to('planificacion');
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
}

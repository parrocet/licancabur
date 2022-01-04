<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Exports\ActividadesExport;
use App\Exports\ActividadesCronoExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use PDF;
use App\Empleados;
use App\Gerencias;
use App\Actividades;
use App\Planificacion;
use App\Departamentos;
use App\Areas;
ini_set('max_execution_time', 2000);
set_time_limit(2000);
class ReportesController extends Controller
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
        //dd(session('fecha_actual'));
        // $planificacion=planificacion::where('id','<>',0)->groupBy('semana')->get();
        $planificacion=\DB::table('planificacion')
            ->join('actividades','actividades.id_planificacion','=','planificacion.id')
            ->join('gerencias','gerencias.id', '=', 'planificacion.id_gerencia')
            ->where('planificacion.id','<>',0)
            ->where('planificacion.anio',session('fecha_actual'))
            ->select('planificacion.*','gerencias.gerencia')
            ->groupBy('planificacion.semana')
            ->get();
        //dd($planificacion);
        
        $tipo=\DB::table('planificacion')
            ->join('actividades','actividades.id_planificacion','=','planificacion.id')
            ->where('planificacion.id','<>',0)
            ->where('planificacion.anio',session('fecha_actual'))
            ->select('actividades.tipo')
            ->groupBy('actividades.tipo')
            ->get();

        $dias=\DB::table('planificacion')
            ->join('actividades','actividades.id_planificacion','=','planificacion.id')
            ->where('planificacion.id','<>',0)
            ->where('planificacion.anio',session('fecha_actual'))
            ->select('actividades.dia')
            ->groupBy('actividades.dia')
            ->get();


        $empleado=Empleados::where('id_usuario',\Auth::user()->id)->first();
        $gerencias=array();
        $id_gerencia=array();

        // $departamentos=Departamentos::where('id','<>',1)->get();
        $departamentos=\DB::table('departamentos')
            ->join('actividades','actividades.id_departamento','=','departamentos.id')
            ->select('departamentos.*')
            ->groupBy('departamentos.departamento')
            ->get();
        $i=0;
        $nulo=0;
        
        if ($empleado==null || \Auth::user()->tipo_user=="Supervisor" || \Auth::user()->tipo_user=="Planificacion" || \Auth::user()->tipo_user=="Admin") {
            if (\Auth::user()->tipo_user=="G-NPI") {
                $gerencias=Gerencias::where([['id','>',0],['gerencia','NPI']])->get();
                $nulo=1;
                # code...
            } else if(\Auth::user()->tipo_user=="G-CHO"){
                $gerencias=Gerencias::where([['id','>',0],['gerencia','CHO']])->get();
                $nulo=1;
            } else {
                // $gerencias=Gerencias::where('id','>',0)->get();
                $gerencias=\DB::table('gerencias')
                ->join('planificacion','planificacion.id_gerencia','=','gerencias.id')
                ->join('actividades','actividades.id_planificacion','=','planificacion.id')
                ->where('planificacion.anio',session('fecha_actual'))
                ->select('gerencias.*')
                ->groupBy('gerencias.gerencia')
                ->get();
                $nulo=1;
                //dd($gerencias);
            }
            
        }else{
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

        }
        //dd($nulo);
        // dd($gerencias);
        return view('reportes.index',compact('gerencias','id_gerencia','nulo','planificacion','departamentos','tipo','dias'));
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
        if($request->crono){
            if($request->tipo_reporte=="Excel"){
                $obj= new ActividadesCronoExport();
                $obj->datos($request);
                return Excel::download($obj, 'Actividades.xlsx');
            }else{
                $gerencia=Gerencias::where('gerencia',$request->gerencias)->first();
                $areas=Areas::find($request->areas);
                $planificacion=Planificacion::where('semana',$request->planificacion)->where('id_gerencia',$gerencia->id)->where('anio',session('fecha_actual'))->first();
                $actividades=Actividades::where('id_planificacion', $planificacion->id)->where('id_area', $request->areas)->get();

                // ACTIVIDADES REALIZADAS
                $resultado=count($actividades);
                $cant_act=$resultado;
                $areas=$areas->area;

                $total_pm01=0;
                $acti_Nrealizadas_PM01=0;
                $acti_realizadas_PM01=0;

                $total_pm02=0;
                $acti_Nrealizadas_PM02=0;
                $acti_realizadas_PM02=0;

                $total_pm03=0;
                $acti_Nrealizadas_PM03=0;
                $acti_realizadas_PM03=0;

                $total_pm04=0;
                $acti_Nrealizadas_PM04=0;
                $acti_realizadas_PM04=0;

                for ($i=0; $i < count($actividades); $i++) { 

                    if ($actividades[$i]->tipo == "PM01") {
                        $total_pm01++;
                        if ($actividades[$i]->realizada == 'No') {
                            $acti_Nrealizadas_PM01++;
                        }else{
                            $acti_realizadas_PM01++;
                        }
                    }elseif($actividades[$i]->tipo == "PM02"){
                        $total_pm02++;
                        if ($actividades[$i]->realizada == 'No') {
                            $acti_Nrealizadas_PM02++;
                        }else{
                            $acti_realizadas_PM02++;
                        }
                    }elseif($actividades[$i]->tipo == "PM03"){
                        $total_pm03++;
                        if ($actividades[$i]->realizada == 'No') {
                            $acti_Nrealizadas_PM03++;
                        }else{
                            $acti_realizadas_PM03++;
                        }
                    }else{
                        $total_pm04++;
                        if ($actividades[$i]->realizada == 'No') {
                            $acti_Nrealizadas_PM04++;
                        }else{
                            $acti_realizadas_PM04++;
                        }
                    }
                }

                //DURACION DE LAS ACTIVIDADES

                $duracion_pro_pm01=0;
                $duracion_real_pm01=0;
                $duracion_pro_pm02=0;
                $duracion_real_pm02=0;
                $duracion_pro_pm03=0;
                $duracion_real_pm03=0;
                $duracion_pro_pm04=0;
                $duracion_real_pm04=0;

                for ($i=0; $i < count($actividades); $i++) { 

                    if ($actividades[$i]->tipo == "PM01") {

                        if ($actividades[$i]->duracion_pro > 0) {
                            $duracion_pro_pm01=$duracion_pro_pm01+$actividades[$i]->duracion_pro;
                        }

                        if ($actividades[$i]->duracion_real > 0) {
                            $duracion_real_pm01=$duracion_real_pm01+$actividades[$i]->duracion_real;
                        }

                    }elseif($actividades[$i]->tipo == "PM02"){
                        if ($actividades[$i]->duracion_pro > 0) {
                            $duracion_pro_pm02=$duracion_pro_pm02+$actividades[$i]->duracion_pro;
                        }

                        if ($actividades[$i]->duracion_real > 0) {
                            $duracion_real_pm02=$duracion_real_pm02+$actividades[$i]->duracion_real;
                        }
                       
                    }elseif($actividades[$i]->tipo == "PM03"){
                        if ($actividades[$i]->duracion_pro > 0) {
                            $duracion_pro_pm03=$duracion_pro_pm03+$actividades[$i]->duracion_pro;
                        }

                        if ($actividades[$i]->duracion_real > 0) {
                            $duracion_real_pm03=$duracion_real_pm03+$actividades[$i]->duracion_real;
                        }
                        
                    }else{
                        if ($actividades[$i]->duracion_pro > 0) {
                            $duracion_pro_pm04=$duracion_pro_pm04+$actividades[$i]->duracion_pro;
                        }

                        if ($actividades[$i]->duracion_real > 0) {
                            $duracion_real_pm04=$duracion_real_pm04+$actividades[$i]->duracion_real;
                        }
                    }
                }


            // dd($duracion_real_pm01);
            
            if (count($actividades)==0) {
                flash('<i class="icon-circle-check"></i> ¡No exiten datos para generar reporte PDF!')->error()->important();    
                return redirect()->to('reportes');
            } else if ($request->tipo_reporte=="PDF"){

                $pdf = PDF::loadView('reportes/crono/cronoPDF', array(
                    'resultado'=>$resultado,
                    'planificacion'=>$planificacion,
                    'cant_act'=>$cant_act, 
                    'areas'=>$areas, 
                    'actividades'=>$actividades,
                    'total_pm01' => $total_pm01,
                    'acti_Nrealizadas_PM01' => $acti_Nrealizadas_PM01,
                    'acti_realizadas_PM01' => $acti_realizadas_PM01,
                    'total_pm02' => $total_pm02,
                    'acti_Nrealizadas_PM02' => $acti_Nrealizadas_PM02,
                    'acti_realizadas_PM02' => $acti_realizadas_PM02,
                    'total_pm03' => $total_pm03,
                    'acti_Nrealizadas_PM03' => $acti_Nrealizadas_PM03,
                    'acti_realizadas_PM03' => $acti_realizadas_PM03,
                    'total_pm04' => $total_pm04,
                    'acti_Nrealizadas_PM04' => $acti_Nrealizadas_PM04,
                    'acti_realizadas_PM04' => $acti_realizadas_PM04,
                    'duracion_pro_pm01' => $duracion_pro_pm01,
                    'duracion_real_pm01' => $duracion_real_pm01,
                    'duracion_pro_pm02' => $duracion_pro_pm02,
                    'duracion_real_pm02' => $duracion_real_pm02,
                    'duracion_pro_pm03' => $duracion_pro_pm03,
                    'duracion_real_pm03' => $duracion_real_pm03,
                    'duracion_pro_pm04' => $duracion_pro_pm04,
                    'duracion_real_pm04' => $duracion_real_pm04
                ));
                $pdf->setPaper('A4', 'landscape');
                return $pdf->stream('Reporte_PDF.pdf');
                
                }
            }
        } else {
            //reportes general
            //dd($request->all());
            if($request->tipo_reporte=="Excel"){
               //dd($request->all());

                if ($request->planificacion!=0) {
                    $condicion_plan=" && planificacion.semana=".$request->planificacion." ";
                    //dd('Número de la semana',$condicion_plan);
                } else {
                    //dd('Todos PLanificación');
                    $condicion_plan="";
                }

                if ($request->gerencias!=0) {
                    $condicion_geren=" && gerencias.gerencia='".$request->gerencias."' ";
                } else {
                    //dd('Todos Gerencia');
                    $condicion_geren="";
                }

                if ($request->areas!=0) {
                    $condicion_areas=" && areas.id=".$request->areas." ";
                } else {
                    //dd('Todos Áreas');
                    $condicion_areas="";
                }

                if ($request->tipo!="0") {
                    $condicion_tipo=" && actividades.tipo='".$request->tipo."' ";
                } else {
                    //dd('Todos Tipo');
                    $condicion_tipo="";
                }

                if ($request->realizadas!="0") {
                    //dd('Día seleccionado',$request->realizadas);
                    $condicion_realizadas=" && actividades.realizada='".$request->realizadas."' ";
                } else {
                    $condicion_realizadas="";
                    //dd('Todos Días',$condicion_realizadas);
                }

                if ($request->dias!="0") {
                    //dd('Día seleccionado',$request->dias);
                    $condicion_dias=" && actividades.dia='".$request->dias."' ";
                    //dd('Todos Días 11',$condicion_dias);
                } else {
                    $condicion_dias="";
                    //dd('Todos Días',$condicion_dias);
                }

                if ($request->departamentos!="") {
                    $condicion_departamentos=" && departamentos.departamento='".$request->departamentos."' ";
                    //dd($condicion_departamentos);
                } else {
                    //dd('Todos Días',$condicion_dias);
                    $condicion_departamentos="";
                }
                //dd($condicion_tipo);
                $sql="SELECT planificacion.elaborado,planificacion.aprobado,planificacion.num_contrato,planificacion.fechas,planificacion.semana,planificacion.revision,gerencias.gerencia,planificacion.id,departamentos.departamento FROM planificacion,actividades,gerencias,areas,departamentos WHERE planificacion.id_gerencia = gerencias.id && actividades.id_area=areas.id && actividades.id_planificacion=planificacion.id && planificacion.anio=".session('fecha_actual')." ".$condicion_plan." ".$condicion_geren." ".$condicion_areas." ".$condicion_realizadas." ".$condicion_tipo." ".$condicion_dias." ".$condicion_departamentos."  group by planificacion.id";
                //dd($sql);

                $resultado=\DB::select($sql);

                //dd($resultado);
                if (count($resultado)==0) {                
                    flash('<i class="icon-circle-check"></i> No exiten datos registrados, para generar reporte Excel!')->warning()->important();
                    return redirect()->back();
                } else {                
                    $obj= new ActividadesExport();
                	$obj->datos($request);
                    return Excel::download($obj, 'Actividades.xlsx');
                }


            } else if ($request->tipo_reporte=="PDF"){
                //dd('prueba 1');

                if ($request->planificacion!=0) {
                    $condicion_plan=" && planificacion.semana=".$request->planificacion." ";
                    //dd('Número de la semana',$condicion_plan);
                } else {
                    //dd('Todos PLanificación');
                    $condicion_plan="";
                }

                if ($request->gerencias!=0) {
                    $condicion_geren=" && gerencias.gerencia='".$request->gerencias."' ";
                } else {
                    //dd('Todos Gerencia');
                    $condicion_geren="";
                }

                if ($request->areas!=0) {
                    $condicion_areas=" && areas.id=".$request->areas." ";
                } else {
                    //dd('Todos Áreas');
                    $condicion_areas="";
                }

                if ($request->tipo!="0") {
                    $condicion_tipo=" && actividades.tipo='".$request->tipo."' ";
                } else {
                    //dd('Todos Tipo',$request->tipo);
                    $condicion_tipo="";
                }

                if ($request->realizadas!="0") {
                    $condicion_realizadas=" && actividades.realizada='".$request->realizadas."' ";
                } else {
                    $condicion_realizadas="";
                    //dd('Todos Días',$condicion_realizadas);
                }

                if ($request->dias!="0") {
                    $condicion_dias=" && actividades.dia='".$request->dias."' ";
                    //dd('Todos Días 11',$condicion_dias);
                } else {
                    $condicion_dias="";
                    //dd('Todos Días 00',$condicion_dias);
                }

                if ($request->departamentos!=NULL) {
                    $condicion_departamentos=" && departamentos.departamento='".$request->departamentos."' ";
                    //dd('Todos Días 11',$condicion_dias);
                } else {
                    $condicion_departamentos="";
                    //dd('Todos Días 00',$condicion_dias);
                }

                $sql="SELECT planificacion.elaborado,planificacion.aprobado,planificacion.num_contrato,planificacion.fechas,planificacion.semana,planificacion.revision,gerencias.gerencia,planificacion.id FROM planificacion,actividades,gerencias,areas,departamentos WHERE planificacion.id_gerencia = gerencias.id && actividades.id_area=areas.id && actividades.id_planificacion=planificacion.id && planificacion.anio=".session('fecha_actual')." ".$condicion_plan." ".$condicion_geren." ".$condicion_areas." ".$condicion_realizadas." ".$condicion_tipo." ".$condicion_dias." ".$condicion_departamentos." group by planificacion.id";
                //dd($sql);
                $resultado=\DB::select($sql);
                //dd($resultado);
                /*como la consulta o acepta eloquent en el archivo blade.... 
                entonces crearemos un array para las planificaciones y actividades*/
                $planificacion=array();
                $actividades=array();
                $id_planificacion=array();
                $i=0;
                for ($i=0; $i < count($resultado); $i++) { 
                        
                    $planificacion[$i][0]=$resultado[$i]->elaborado;
                    $planificacion[$i][1]=$resultado[$i]->aprobado;
                    $planificacion[$i][2]=$resultado[$i]->num_contrato;
                    $planificacion[$i][3]=$resultado[$i]->fechas;
                    $planificacion[$i][4]=$resultado[$i]->semana;
                    $planificacion[$i][5]=$resultado[$i]->revision;
                    $planificacion[$i][6]=$resultado[$i]->gerencia;
                    $id_planificacion[$i]=$resultado[$i]->id;
                }
            
                $areas=array();
                $cant_act=array();//cantidad de actividades por planificacion
                $j=0;
                for ($i=0; $i < count($id_planificacion); $i++) { 
                    $sql2="SELECT actividades.id,actividades.task,actividades.descripcion,actividades.fecha_vencimiento,actividades.duracion_pro,actividades.cant_personas,actividades.duracion_real,actividades.dia,actividades.tipo,actividades.realizada,actividades.observacion1,actividades.observacion2,areas.area,departamentos.departamento FROM planificacion,actividades,gerencias,areas,departamentos WHERE planificacion.id=".$id_planificacion[$i]." && planificacion.id_gerencia = gerencias.id && actividades.id_area=areas.id && actividades.id_planificacion=planificacion.id && actividades.id_departamento=departamentos.id && 
                        planificacion.anio=".session('fecha_actual')." ".$condicion_plan." ".$condicion_geren." ".$condicion_areas." ".$condicion_realizadas." ".$condicion_tipo." ".$condicion_dias." ".$condicion_departamentos." order by actividades.dia";
                    //echo $sql2."<br>";

                    $resultado2=\DB::select($sql2);
                    //dd($resultado2);
                    //echo $sql2."<br>";
                    $cant_act[$i]=0;
                    $cant_mie=0;
                    $cant_jue=0;
                    $cant_vie=0;
                    $cant_sab=0;
                    $cant_dom=0;
                    $cant_lun=0;
                    $cant_mar=0;
                    $tdp_mie=0;//total duracion proyectada dia miercoles
                    $tdr_mie=0;//total duracion real dia miercoles
                    $tdp_jue=0;//total duracion proyectada dia jueves
                    $tdr_jue=0;//total duracion real dia jueves
                    $tdp_vie=0;//total duracion proyectada dia viernes
                    $tdr_vie=0;//total duracion real dia viernes
                    $tdp_sab=0;//total duracion proyectada dia sabado
                    $tdr_sab=0;//total duracion real dia sabado
                    $tdp_dom=0;//total duracion proyectada dia domingo
                    $tdr_dom=0;//total duracion real dia domingo
                    $tdp_lun=0;//total duracion proyectada dia lunes
                    $tdr_lun=0;//total duracion real dia lunes
                    $tdp_mar=0;//total duracion proyectada dia martes
                    $tdr_mar=0;//total duracion real dia martes
                    for ($j=0; $j < count($resultado2); $j++) { 
                        
                        $actividades[$i][$j][0]=$resultado2[$j]->task;
                        $actividades[$i][$j][1]=$resultado2[$j]->descripcion;
                        $actividades[$i][$j][3]=$resultado2[$j]->fecha_vencimiento;
                        $actividades[$i][$j][4]=$resultado2[$j]->duracion_pro;
                        $actividades[$i][$j][5]=$resultado2[$j]->cant_personas;
                        $actividades[$i][$j][6]=$resultado2[$j]->duracion_real;
                        $actividades[$i][$j][7]=$resultado2[$j]->dia;
                        $actividades[$i][$j][8]=$resultado2[$j]->tipo;
                        $actividades[$i][$j][9]=$resultado2[$j]->realizada;
                        $actividades[$i][$j][10]=$resultado2[$j]->observacion1;
                        $actividades[$i][$j][11]=$resultado2[$j]->observacion2;
                        $actividades[$i][$j][12]=$resultado2[$j]->area;
                        $actividades[$i][$j][13]=$resultado2[$j]->id;
                        $actividades[$i][$j][14]=$resultado2[$j]->departamento;
                        $areas[$i]=$resultado2[$j]->area;
                        $cant_act[$i]=$cant_act[$i]+1;//cantidad de actividades por por planificacion
                        if ($resultado2[$j]->dia=="Mié") {
                            $cant_mie++;
                            $tdp_mie+=$resultado2[$j]->duracion_pro;
                            $tdr_mie+=$resultado2[$j]->duracion_real;
                        }
                        if ($resultado2[$j]->dia=="Jue") {
                            $cant_jue++;
                            $tdp_jue+=$resultado2[$j]->duracion_pro;
                            $tdr_jue+=$resultado2[$j]->duracion_real;
                        }
                        if ($resultado2[$j]->dia=="Vie") {
                            $cant_vie++;
                            $tdp_vie+=$resultado2[$j]->duracion_pro;
                            $tdr_vie+=$resultado2[$j]->duracion_real;
                        }
                        if ($resultado2[$j]->dia=="Sáb") {
                            $cant_sab++;
                            $tdp_sab+=$resultado2[$j]->duracion_pro;
                            $tdr_sab+=$resultado2[$j]->duracion_real;
                        }
                        if ($resultado2[$j]->dia=="Dom") {
                            $cant_dom++;
                            $tdp_dom+=$resultado2[$j]->duracion_pro;
                            $tdr_dom+=$resultado2[$j]->duracion_real;
                        }
                        if ($resultado2[$j]->dia=="Lun") {
                            $cant_lun++;
                            $tdp_lun+=$resultado2[$j]->duracion_pro;
                            $tdr_lun+=$resultado2[$j]->duracion_real;
                        }
                        if ($resultado2[$j]->dia=="Mar") {
                            $cant_mar++;
                            $tdp_mar+=$resultado2[$j]->duracion_pro;
                            $tdr_mar+=$resultado2[$j]->duracion_real;
                        }
                        
                    }

                }
                //dd("-------------------");
                //dd(var_dump($resultado2));
                if (count(@$resultado)==0) {
                    flash('<i class="icon-circle-check"></i> ¡No exiten datos para generar reporte PDF!')->error()->important();    
                    return redirect()->to('reportes');
                } else {
                    $pdf = PDF::loadView('reportes/pdf/PDF', array('resultado'=>$resultado, 'planificacion'=>$planificacion, 'cant_act'=>$cant_act,'areas'=>$areas,'actividades'=>$actividades,'cant_mie' => $cant_mie,'cant_jue' => $cant_jue,'cant_vie' => $cant_vie,'cant_sab' => $cant_sab,'cant_dom' => $cant_dom,'cant_lun' => $cant_lun,'cant_mar' => $cant_mar,'tdp_mie' => $tdp_mie,'tdr_mie' => $tdr_mie,'tdp_jue' => $tdp_jue,'tdr_jue' => $tdr_jue,'tdp_vie' => $tdp_vie,'tdr_vie' => $tdr_vie,'tdp_sab' => $tdp_sab,'tdr_sab' => $tdr_sab,'tdp_dom' => $tdp_dom,'tdr_dom' => $tdr_dom,'tdp_lun' => $tdp_lun,'tdr_lun' => $tdr_lun,'tdp_mar' => $tdp_mar,'tdr_mar' => $tdr_mar));
                    $pdf->setPaper('A4', 'landscape');
                    return $pdf->stream('Reporte_PDF.pdf');

                }
            }
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gerencias;
use App\Planificacion;
use App\Actividades;
use App\Areas;
use PDF;
use App;
class EstadisticasController extends Controller
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
        $gerencias=array();
        if (\Auth::User()->tipo_user=="G-NPI") {
            $gerencias = Gerencias::where('gerencia','NPI')->get();
            $planificacion=planificacion::where('id','<>',0)->groupBy('semana')->where('anio',session('fecha_actual'))->get();
            //dd($gerencias);
        } else if (\Auth::User()->tipo_user=="G-CHO") {
            $gerencias = Gerencias::where('gerencia','CHO')->get();
            $planificacion=planificacion::where('id','<>',0)->groupBy('semana')->where('anio',session('fecha_actual'))->get();
        } else {
            $gerencias = Gerencias::all();
            $planificacion=planificacion::where('id','<>',0)->groupBy('semana')->where('anio',session('fecha_actual'))->get();
        }
        $contar=0;
        foreach($planificacion as $key){
            $contar+=$actividades=Actividades::where('id_planificacion',$key->id)->count();
        }
        return view('estadisticas.index', compact('gerencias','planificacion','contar'));
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
        if($request->areas!=""){
            $area=Areas::where('area',$request->areas)->first();
        }
        //dd($area->id);
        //$request->all();
        //------- obteniendo para la gerencia 1 - 2---------------
        $planificacion=Planificacion::where('id_gerencia',1)->where('semana',$request->planificacion)->where('anio',session('fecha_actual'))->first();
        $planificacion2=Planificacion::where('id_gerencia',2)->where('semana',$request->planificacion)->where('anio',session('fecha_actual'))->first();
        if($request->gerencias=="NPI") {
            //dd('Gerencia NPI seleccionada');
            if ($request->areas=="todas") {
                //dd('Gerencia NPI Todas las áreas seleccionada');
                $ews[] = array();
                $pcda[] = array();
                $agua[] = array();

                //------------EWS----------------
                $total_pm01=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',1)->where('tipo','PM01')->count();
                $total_pm01_ews= $total_pm01;
                $total_pm01_si=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',1)->where('tipo','PM01')->where('realizada','Si')->count();
                $total_pm01_no=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',1)->where('tipo','PM01')->where('realizada','No')->count();
                $ews[0]=$total_pm01;
                $ews[1]=$total_pm01_si;
                $ews[2]=$total_pm01_no;

                $total_pm02=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',1)->where('tipo','PM02')->count();
                $total_pm02_ews= $total_pm02;
                $total_pm02_si=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',1)->where('tipo','PM02')->where('realizada','Si')->count();
                $total_pm02_no=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',1)->where('tipo','PM02')->where('realizada','No')->count();
                $ews[3]=$total_pm02;
                $ews[4]=$total_pm02_si;
                $ews[5]=$total_pm02_no;

                $total_pm03=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',1)->where('tipo','PM03')->count();
                $total_pm03_ews= $total_pm03;
                $total_pm03_si=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',1)->where('tipo','PM03')->where('realizada','Si')->count();
                $total_pm03_no=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',1)->where('tipo','PM03')->where('realizada','No')->count();
                $ews[6]=$total_pm03;
                $ews[7]=$total_pm03_si;
                $ews[8]=$total_pm03_no;

                /*$total_pm04=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',1)->where('tipo','PM04')->count();
                $total_pm04_si=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',1)->where('tipo','PM04')->where('realizada','Si')->count();
                $total_pm04_no=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',1)->where('tipo','PM04')->where('realizada','No')->count();
                $ews[9]=$total_pm04;
                $ews[10]=$total_pm04_si;
                $ews[11]=$total_pm04_no;*/
            //---------FIN DE EWS------------
            //------------Planta Cero----------------
                $total_pm01=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',2)->where('tipo','PM01')->count();
                $total_pm01_planta=$total_pm01;
                $total_pm01_si=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',2)->where('tipo','PM01')->where('realizada','Si')->count();
                $total_pm01_no=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',2)->where('tipo','PM01')->where('realizada','No')->count();
                $pcda[0]=$total_pm01;
                $pcda[1]=$total_pm01_si;
                $pcda[2]=$total_pm01_no;

                $total_pm02=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',2)->where('tipo','PM02')->count();
                $total_pm02_planta=$total_pm02;
                $total_pm02_si=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',2)->where('tipo','PM02')->where('realizada','Si')->count();
                $total_pm02_no=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',2)->where('tipo','PM02')->where('realizada','No')->count();
                $pcda[3]=$total_pm02;
                $pcda[4]=$total_pm02_si;
                $pcda[5]=$total_pm02_no;

                $total_pm03=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',2)->where('tipo','PM03')->count();
                $total_pm03_planta=$total_pm03;
                $total_pm03_si=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',2)->where('tipo','PM03')->where('realizada','Si')->count();
                $total_pm03_no=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',2)->where('tipo','PM03')->where('realizada','No')->count();
                $pcda[6]=$total_pm03;
                $pcda[7]=$total_pm03_si;
                $pcda[8]=$total_pm03_no;

                //dd($pcda[0],$pcda[1],$pcda[2],$pcda[3],$pcda[4],$pcda[5],$pcda[6],$pcda[7],$pcda[8]);

                /*$total_pm04=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',2)->where('tipo','PM04')->count();
                $total_pm04_si=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',2)->where('tipo','PM04')->where('realizada','Si')->count();
                $total_pm04_no=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',2)->where('tipo','PM04')->where('realizada','No')->count();
                $pcda[9]=$total_pm04;
                $pcda[10]=$total_pm04_si;
                $pcda[11]=$total_pm04_no;*/
            //---------FIN DE Planta Cero------------
            //------------Agua y tranque----------------
                $total_pm01=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',3)->where('tipo','PM01')->count();
                $total_pm01_agua=$total_pm01;
                $total_pm01_si=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',3)->where('tipo','PM01')->where('realizada','Si')->count();
                $total_pm01_no=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',3)->where('tipo','PM01')->where('realizada','No')->count();
                $agua[0]=$total_pm01;
                $agua[1]=$total_pm01_si;
                $agua[2]=$total_pm01_no;

                $total_pm02=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',3)->where('tipo','PM02')->count();
                $total_pm02_agua=$total_pm02;
                $total_pm02_si=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',3)->where('tipo','PM02')->where('realizada','Si')->count();
                $total_pm02_no=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',3)->where('tipo','PM02')->where('realizada','No')->count();
                $agua[3]=$total_pm02;
                $agua[4]=$total_pm02_si;
                $agua[5]=$total_pm02_no;

                $total_pm03=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',3)->where('tipo','PM03')->count();
                $total_pm03_agua=$total_pm03;
                $total_pm03_si=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',3)->where('tipo','PM03')->where('realizada','Si')->count();
                $total_pm03_no=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',3)->where('tipo','PM03')->where('realizada','No')->count();
                $agua[6]=$total_pm03;
                $agua[7]=$total_pm03_si;
                $agua[8]=$total_pm03_no;

                /*$total_pm04=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',3)->where('tipo','PM04')->count();
                $total_pm04_si=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',3)->where('tipo','PM04')->where('realizada','Si')->count();
                $total_pm04_no=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',3)->where('tipo','PM04')->where('realizada','No')->count();
                $agua[9]=$total_pm04;
                $agua[10]=$total_pm04_si;
                $agua[11]=$total_pm04_no;*/
            //---------FIN DE AGUA Y TRANQUE------------
                //--------------------totales de NPI---------------
                $pm01_si_g1=$ews[1]+$pcda[1]+$agua[1];//total de pm01_si en NPI
                $pm01_no_g1=$ews[2]+$pcda[2]+$agua[2];//total de pm01_no en NPI

                $pm02_si_g1=$ews[4]+$pcda[4]+$agua[4];//total de pm02_si en NPI
                $pm02_no_g1=$ews[5]+$pcda[5]+$agua[5];//total de pm02_no en NPI

                $pm03_si_g1=$ews[7]+$pcda[7]+$agua[7];//total de pm03_si en NPI
                $pm03_no_g1=$ews[8]+$pcda[8]+$agua[8];//total de pm03_no en NPI

                $pm01_g1=$ews[0]+$pcda[0]+$agua[0];//total de pm01 en NPI
                $pm02_g1=$ews[3]+$pcda[3]+$agua[3];//total de pm02 en NPI
                $pm03_g1=$ews[6]+$pcda[6]+$agua[6];//total de pm03 en NPI

                //CÓDIGO DE LAS GRÁFICAS//
                $graf_pm02_g1 = app()->chartjs
                ->name('pieChartTest6')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['Realizadas: ', 'No Realizadas: '])
                ->datasets([
                    [
                        'backgroundColor' => ['#BDBDBD', '#D7CCC8'],
                        'hoverBackgroundColor' => ['#BDBDBD', '#D7CCC8'],
                        'data' => [$pm02_si_g1, $pm02_no_g1]
                    ]
                ])
                ->options([]);

                $graf_act_pm02_vs_act_pm03_g1 = app()->chartjs
                ->name('graf_act_pm02_vs_act_pm03_g1')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['TOTAL PM02', 'TOTAL PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['#48C9A9','#EF5350'],
                        'hoverBackgroundColor' => ['#48C9A9','#EF5350'],
                        'data' => [$pm02_g1, $pm03_g1]
                    ]
                ])
                ->options([]);

                $graf_total_act_g1 = app()->chartjs
                ->name('graf_total_act_g1')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'data' => [$pm01_g1,$pm02_g1, $pm03_g1]
                    ]
                ])
                ->options([]);

                $graf_total_ews= app()->chartjs
                ->name('graf_total_ews')
                ->type('pie')
                ->size(['width' => 200, 'height' => 120])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'data' => [$total_pm01_ews,$total_pm02_ews, $total_pm03_ews]
                    ]
                ])
                ->options([]);

                $graf_total_planta= app()->chartjs
                ->name('graf_total_planta')
                ->type('pie')
                ->size(['width' => 200, 'height' => 120])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'data' => [$total_pm01_planta,$total_pm02_planta, $total_pm03_planta]
                    ]
                ])
                ->options([]);

                $graf_total_agua= app()->chartjs
                ->name('graf_total_agua')
                ->type('pie')
                ->size(['width' => 200, 'height' => 120])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'data' => [$total_pm01_agua,$total_pm02_agua, $total_pm03_agua]
                    ]
                ])
                ->options([]);

                return view('estadisticas.show', compact('request','planificacion','ews','pcda','agua','pm02_si_g1','pm02_no_g1','pm02_g1','pm03_g1','pm01_si_g1','pm01_no_g1','pm02_si_g1','pm02_no_g1','pm03_si_g1','pm03_no_g1','graf_pm02_g1','graf_act_pm02_vs_act_pm03_g1','graf_total_act_g1','graf_total_ews','graf_total_planta','graf_total_agua'));
            } else{
                //dd($request->all());
                //dd('Gerencia NPI área XXX');
                $area=Areas::where('area',$request->areas)->first();
                $gerencias=Gerencias::where('gerencia',$request->gerencias)->first();
                //dd($gerencias->id);
                $planificacion_form=Planificacion::where('id_gerencia',$gerencias->id)->where('semana',$request->planificacion)->where('anio',session('fecha_actual'))->first();

                $count_area[] = array();
                //--------------------------------------
                //------------ÁREA----------------
                $total_pm01=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM01')->count();
                $total_pm01_area= $total_pm01;
                $total_pm01_si=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM01')->where('realizada','Si')->count();
                $total_pm01_no=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM01')->where('realizada','No')->count();
                $count_area[0]=$total_pm01;
                $count_area[1]=$total_pm01_si;
                $count_area[2]=$total_pm01_no;

                $total_pm02=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM02')->count();
                $total_pm02_area= $total_pm02;
                $total_pm02_si=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM02')->where('realizada','Si')->count();
                $total_pm02_no=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM02')->where('realizada','No')->count();
                $count_area[3]=$total_pm02;
                $count_area[4]=$total_pm02_si;
                $count_area[5]=$total_pm02_no;

                $total_pm03=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM03')->count();
                $total_pm03_area= $total_pm03;
                $total_pm03_si=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM03')->where('realizada','Si')->count();
                $total_pm03_no=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM03')->where('realizada','No')->count();
                $count_area[6]=$total_pm03;
                $count_area[7]=$total_pm03_si;
                $count_area[8]=$total_pm03_no;

                /*$total_pm04=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',$request->area)->where('tipo','PM04')->count();
                $total_pm04_si=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',$request->area)->where('tipo','PM04')->where('realizada','Si')->count();
                $total_pm04_no=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',$request->area)->where('tipo','PM04')->where('realizada','No')->count();
                $count_area[9]=$total_pm04;
                $count_area[10]=$total_pm04_si;
                $count_area[11]=$total_pm04_no;*/
            //---------FIN DE ÁREA------------
                $pm02_g1=$count_area[3];//total de pm02 en NPI
                $pm03_g1=$count_area[6];//total de pm03 en NPI

                //dd($count_area[1],$count_area[2],$count_area[3],$count_area[4],$count_area[5],$count_area[6],$count_area[7],$count_area[8]);

                //CÓDIGO DE LAS GRÁFICAS//
                $graf_act_pm02_vs_act_pm03_g1 = app()->chartjs
                ->name('graf_act_pm02_vs_act_pm03_g1')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['TOTAL PM02', 'TOTAL PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['#48C9A9','#EF5350'],
                        'hoverBackgroundColor' => ['#48C9A9','#EF5350'],
                        'data' => [54, 33]
                    ]
                ])
                ->options([]);

                $graf_total_act_g1 = app()->chartjs
                ->name('graf_total_act_g1')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'data' => [12,33, 43]
                    ]
                ])
                ->options([]);

                $graf_total= app()->chartjs
                ->name('graf_total')
                ->type('pie')
                ->size(['width' => 200, 'height' => 120])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'data' => [$total_pm01_area,$total_pm02_area,$total_pm03_area]
                    ]
                ])
                ->options([]);

                $gerencia = $request->gerencias;
                $area = $request->areas;

                return view('estadisticas.area', compact('gerencia','area','planificacion','count_area','graf_act_pm02_vs_act_pm03_g1','graf_total_act_g1','graf_total'));

            }
            
        } else if ($request->gerencias=="CHO") {
            //dd('Gerencia CHO seleccionada');
            if ($request->areas=="todas") {
                //dd('Gerencia CHO Todas las áreas seleccionada');
                $filtro[] = array();
                $ect[] = array();
                $colorados[] = array();
                //------------FILTRO Y PUERTO----------------
                $total_pm01=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',4)->where('tipo','PM01')->count();
                $total_pm01_filtro=$total_pm01;
                $total_pm01_si=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',4)->where('tipo','PM01')->where('realizada','Si')->count();
                $total_pm01_no=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',4)->where('tipo','PM01')->where('realizada','No')->count();
                $filtro[0]=$total_pm01;
                $filtro[1]=$total_pm01_si;
                $filtro[2]=$total_pm01_no;

                $total_pm02=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',4)->where('tipo','PM02')->count();
                $total_pm02_filtro=$total_pm02;
                $total_pm02_si=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',4)->where('tipo','PM02')->where('realizada','Si')->count();
                $total_pm02_no=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',4)->where('tipo','PM02')->where('realizada','No')->count();
                $filtro[3]=$total_pm02;
                $filtro[4]=$total_pm02_si;
                $filtro[5]=$total_pm02_no;

                $total_pm03=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',4)->where('tipo','PM03')->count();
                $total_pm03_filtro=$total_pm03;
                $total_pm03_si=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',4)->where('tipo','PM03')->where('realizada','Si')->count();
                $total_pm03_no=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',4)->where('tipo','PM03')->where('realizada','No')->count();
                $filtro[6]=$total_pm03;
                $filtro[7]=$total_pm03_si;
                $filtro[8]=$total_pm03_no;

                /*$total_pm04=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',4)->where('tipo','PM04')->count();
                $total_pm04_si=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',4)->where('tipo','PM04')->where('realizada','Si')->count();
                $total_pm04_no=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',4)->where('tipo','PM04')->where('realizada','No')->count();
                $filtro[9]=$total_pm04;
                $filtro[10]=$total_pm04_si;
                $filtro[11]=$total_pm04_no;*/
            //---------FIN DE FILTRO Y PUERTO------------
            //------------ECT----------------
                $total_pm01=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',5)->where('tipo','PM01')->count();
                $total_pm01_ECT=$total_pm01;
                $total_pm01_si=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',5)->where('tipo','PM01')->where('realizada','Si')->count();
                $total_pm01_no=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',5)->where('tipo','PM01')->where('realizada','No')->count();
                $ect[0]=$total_pm01;
                $ect[1]=$total_pm01_si;
                $ect[2]=$total_pm01_no;

                $total_pm02=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',5)->where('tipo','PM02')->count();
                $total_pm02_ECT=$total_pm02;
                $total_pm02_si=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',5)->where('tipo','PM02')->where('realizada','Si')->count();
                $total_pm02_no=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',5)->where('tipo','PM02')->where('realizada','No')->count();
                $ect[3]=$total_pm02;
                $ect[4]=$total_pm02_si;
                $ect[5]=$total_pm02_no;

                $total_pm03=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',5)->where('tipo','PM03')->count();
                $total_pm03_ECT=$total_pm03;
                $total_pm03_si=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',5)->where('tipo','PM03')->where('realizada','Si')->count();
                $total_pm03_no=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',5)->where('tipo','PM03')->where('realizada','No')->count();
                $ect[6]=$total_pm03;
                $ect[7]=$total_pm03_si;
                $ect[8]=$total_pm03_no;

                /*$total_pm04=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',5)->where('tipo','PM04')->count();
                $total_pm04_si=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',5)->where('tipo','PM04')->where('realizada','Si')->count();
                $total_pm04_no=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',5)->where('tipo','PM04')->where('realizada','No')->count();
                $ect[9]=$total_pm04;
                $ect[10]=$total_pm04_si;
                $ect[11]=$total_pm04_no;*/
                //---------FIN DE ECT------------
                //------------LOS COLORADOS----------------
                $total_pm01=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',6)->where('tipo','PM01')->count();
                $total_pm01_colorados=$total_pm01;
                $total_pm01_si=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',6)->where('tipo','PM01')->where('realizada','Si')->count();
                $total_pm01_no=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',6)->where('tipo','PM01')->where('realizada','No')->count();
                $colorados[0]=$total_pm01;
                $colorados[1]=$total_pm01_si;
                $colorados[2]=$total_pm01_no;

                $total_pm02=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',6)->where('tipo','PM02')->count();
                $total_pm02_colorados=$total_pm02;
                $total_pm02_si=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',6)->where('tipo','PM02')->where('realizada','Si')->count();
                $total_pm02_no=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',6)->where('tipo','PM02')->where('realizada','No')->count();
                $colorados[3]=$total_pm02;
                $colorados[4]=$total_pm02_si;
                $colorados[5]=$total_pm02_no;

                $total_pm03=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',6)->where('tipo','PM03')->count();
                $total_pm03_colorados=$total_pm03;
                $total_pm03_si=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',6)->where('tipo','PM03')->where('realizada','Si')->count();
                $total_pm03_no=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',6)->where('tipo','PM03')->where('realizada','No')->count();
                $colorados[6]=$total_pm03;
                $colorados[7]=$total_pm03_si;
                $colorados[8]=$total_pm03_no;

                /*$total_pm04=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',6)->where('tipo','PM04')->count();
                $total_pm04_si=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',6)->where('tipo','PM04')->where('realizada','Si')->count();
                $total_pm04_no=Actividades::where('id_planificacion',$planificacion2->id)->where('id_area',6)->where('tipo','PM04')->where('realizada','No')->count();
                $colorados[9]=$total_pm04;
                $colorados[10]=$total_pm04_si;
                $colorados[11]=$total_pm04_no;*/
                //---------FIN DE LOS COLORADOS------------
                //----------totales y graficos de CHO
                $pm01_si_g2=$filtro[1]+$ect[1]+$colorados[1];//total de pm01_si en CHO
                $pm01_no_g2=$filtro[2]+$ect[2]+$colorados[2];//total de pm01_no en CHO

                $pm02_si_g2=$filtro[4]+$ect[4]+$colorados[4];//total de pm02_si en CHO
                $pm02_no_g2=$filtro[5]+$ect[5]+$colorados[5];//total de pm02_no en CHO

                $pm03_si_g2=$filtro[7]+$ect[7]+$colorados[7];//total de pm03_si en CHO
                $pm03_no_g2=$filtro[8]+$ect[8]+$colorados[8];//total de pm03_no en CHO

                $pm01_g2=$filtro[0]+$ect[0]+$colorados[0];//total de pm01 en CHO
                $pm02_g2=$filtro[3]+$ect[3]+$colorados[3];//total de pm02 en CHO
                $pm03_g2=$filtro[6]+$ect[6]+$colorados[6];//total de pm03 en CHO
                 //CÓDIGO DE LAS GRÁFICAS//

                $graf_pm02_g2 = app()->chartjs
                ->name('pieChartTest6')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['Realizadas: ', 'No Realizadas: '])
                ->datasets([
                    [
                        'backgroundColor' => ['#BDBDBD', '#D7CCC8'],
                        'hoverBackgroundColor' => ['#BDBDBD', '#D7CCC8'],
                        'data' => [$pm02_si_g2, $pm02_no_g2]
                    ]
                ])
                ->options([]);

                $graf_act_pm02_vs_act_pm03_g2 = app()->chartjs
                ->name('graf_act_pm02_vs_act_pm03_g2')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['TOTAL PM02', 'TOTAL PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['#48C9A9','#EF5350'],
                        'hoverBackgroundColor' => ['#48C9A9','#EF5350'],
                        'data' => [$pm02_g2, $pm03_g2]
                    ]
                ])
                ->options([]);

                $graf_total_act_g2 = app()->chartjs
                ->name('graf_total_act_g2')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'data' => [$pm01_g2,$pm02_g2, $pm03_g2]
                    ]
                ])
                ->options([]);

                $graf_total_filtro= app()->chartjs
                ->name('graf_total_filtro')
                ->type('pie')
                ->size(['width' => 200, 'height' => 120])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'data' => [$total_pm01_filtro,$total_pm02_filtro, $total_pm03_filtro]
                    ]
                ])
                ->options([]);

                $graf_total_ect= app()->chartjs
                ->name('graf_total_ect')
                ->type('pie')
                ->size(['width' => 200, 'height' => 120])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'data' => [$total_pm01_ECT,$total_pm02_ECT, $total_pm03_ECT]
                    ]
                ])
                ->options([]);

                $graf_total_colorados= app()->chartjs
                ->name('graf_total_colorados')
                ->type('pie')
                ->size(['width' => 200, 'height' => 120])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'data' => [$total_pm01_colorados,$total_pm02_colorados, $total_pm03_colorados]
                    ]
                ])
                ->options([]);

                return view('estadisticas.show', compact('request','planificacion2','pm02_g2','pm03_g2','pm01_si_g2','pm01_no_g2','pm02_si_g2','pm02_no_g2','pm03_si_g2','pm03_no_g2','filtro','ect','colorados','graf_pm02_g2','graf_act_pm02_vs_act_pm03_g2','graf_total_act_g2','graf_total_filtro','graf_total_ect','graf_total_colorados'));
            } else {
                //dd('Gerencia CHO área Filtro-Puerto');
                //dd('Gerencia NPI área XXX');
                $area=Areas::where('area',$request->areas)->first();
                $gerencias=Gerencias::where('gerencia',$request->gerencias)->first();
                //dd($gerencias->id);
                $planificacion_form=Planificacion::where('id_gerencia',$gerencias->id)->where('semana',$request->planificacion)->where('anio',session('fecha_actual'))->first();
                //dd($planificacion_form->id);
                $count_area[] = array();
                //--------------------------------------
                //------------ÁREA----------------
                $total_pm01=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM01')->count();
                $total_pm01_area= $total_pm01;
                $total_pm01_si=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM01')->where('realizada','Si')->count();
                $total_pm01_no=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM01')->where('realizada','No')->count();
                $count_area[0]=$total_pm01;
                $count_area[1]=$total_pm01_si;
                $count_area[2]=$total_pm01_no;

                $total_pm02=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM02')->count();
                $total_pm02_area= $total_pm02;
                $total_pm02_si=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM02')->where('realizada','Si')->count();
                $total_pm02_no=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM02')->where('realizada','No')->count();
                $count_area[3]=$total_pm02;
                $count_area[4]=$total_pm02_si;
                $count_area[5]=$total_pm02_no;

                $total_pm03=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM03')->count();
                $total_pm03_area= $total_pm03;
                $total_pm03_si=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM03')->where('realizada','Si')->count();
                $total_pm03_no=Actividades::where('id_planificacion',$planificacion_form->id)->where('id_area',$area->id)->where('tipo','PM03')->where('realizada','No')->count();
                $count_area[6]=$total_pm03;
                $count_area[7]=$total_pm03_si;
                $count_area[8]=$total_pm03_no;

                //dd($total_pm01,$total_pm02,$total_pm03);

                /*$total_pm04=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',$request->area)->where('tipo','PM04')->count();
                $total_pm04_si=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',$request->area)->where('tipo','PM04')->where('realizada','Si')->count();
                $total_pm04_no=Actividades::where('id_planificacion',$planificacion->id)->where('id_area',$request->area)->where('tipo','PM04')->where('realizada','No')->count();
                $count_area[9]=$total_pm04;
                $count_area[10]=$total_pm04_si;
                $count_area[11]=$total_pm04_no;*/
            //---------FIN DE ÁREA------------
                $pm02_g1=$count_area[3];//total de pm02 en NPI
                $pm03_g1=$count_area[6];//total de pm03 en NPI

                //dd($count_area[0],$count_area[1],$count_area[2],$count_area[3],$count_area[4],$count_area[5],$count_area[6],$count_area[7],$count_area[8]);

                //CÓDIGO DE LAS GRÁFICAS//
                $graf_act_pm02_vs_act_pm03_g1 = app()->chartjs
                ->name('graf_act_pm02_vs_act_pm03_g1')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['TOTAL PM02', 'TOTAL PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['#48C9A9','#EF5350'],
                        'hoverBackgroundColor' => ['#48C9A9','#EF5350'],
                        'data' => [54, 33]
                    ]
                ])
                ->options([]);

                $graf_total_act_g1 = app()->chartjs
                ->name('graf_total_act_g1')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'data' => [12,33, 43]
                    ]
                ])
                ->options([]);

                $graf_total= app()->chartjs
                ->name('graf_total')
                ->type('pie')
                ->size(['width' => 200, 'height' => 120])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                        'data' => [$total_pm01_area,$total_pm02_area,$total_pm03_area]
                    ]
                ])
                ->options([]);

                $gerencia = $request->gerencias;
                $area = $request->areas;

                return view('estadisticas.area', compact('gerencia','area','planificacion','count_area','graf_act_pm02_vs_act_pm03_g1','graf_total_act_g1','graf_total'));
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {        
        


       //return view('estadisticas.show');
    }

    public function estadisticasHH() {

        $gerencias=array();
        if (\Auth::User()->tipo_user=="G-NPI") {
            $gerencias = Gerencias::where('gerencia','NPI')->get();
            $planificacion=planificacion::where('id','<>',0)->groupBy('semana')->where('anio',session('fecha_actual'))->get();
            //dd($gerencias);
        } else if (\Auth::User()->tipo_user=="G-CHO") {
            $gerencias = Gerencias::where('gerencia','CHO')->get();
            $planificacion=planificacion::where('id','<>',0)->groupBy('semana')->where('anio',session('fecha_actual'))->get();
        } else {
            $gerencias = Gerencias::all();
            $planificacion=planificacion::where('id','<>',0)->groupBy('semana')->where('anio',session('fecha_actual'))->get();
        }
        return view('estadisticas.filtro_hh', compact('gerencias','planificacion'));
    }

    public function estadisticasHH_show(Request $request) {
        //dd($request->all());
        
        if($request->areas!="todas"){
            $area=Areas::where('area',$request->areas)->first();
        }
        $anios=anios_planificacion();//arreglo de años de registros
        //dd($anios);
        //$gerencias= $request->gerencias;
        //$areas= $request->areas;
        $meses=array('-01-','-02-','-03-','-04-','-05-','-06-','-07-','-08-','-09-','-10-','-11-','-12-');
        if ($request->gerencias=="NPI") {
            # code...
            if ($request->areas=="todas") {
                //GERENCIA NPI
                //buscando HH en ews en el año actual
                
                //dd($meses);
                for ($i=0; $i < count($meses) ; $i++) { 
                    $buscar_ews=Actividades::where('tipo','PM01')->where('id_area',1)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm01_ews[$i]=$buscar_ews;
                     $buscar_ews=Actividades::where('tipo','PM02')->where('id_area',1)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm02_ews[$i]=$buscar_ews;
                     $buscar_ews=Actividades::where('tipo','PM03')->where('id_area',1)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm03_ews[$i]=$buscar_ews;
                }
                //dd($hh_pm01_ews);
                $graf_hh_ews_1 = app()->chartjs
                ->name('graf_hh_ews_1')
                ->type('line')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Diciembre'])
                ->datasets([
                    [
                        "label" => "PM01",
                        'borderColor' => "#F7C55F",
                        "pointBorderColor" => "#F7C55F",
                        "pointBackgroundColor" => "#F7C55F",
                        'data' => [$hh_pm01_ews[0],$hh_pm01_ews[1],$hh_pm01_ews[2],$hh_pm01_ews[3],$hh_pm01_ews[4],$hh_pm01_ews[5],$hh_pm01_ews[6],$hh_pm01_ews[7],$hh_pm01_ews[8],$hh_pm01_ews[9],$hh_pm01_ews[10],$hh_pm01_ews[11]],
                    ],
                    [
                        "label" => "PM02",
                        'borderColor' => "#48C9A9",
                        "pointBorderColor" => "#48C9A9",
                        "pointBackgroundColor" => "#48C9A9",
                        'data' => [$hh_pm02_ews[0],$hh_pm02_ews[1],$hh_pm02_ews[2],$hh_pm02_ews[3],$hh_pm02_ews[4],$hh_pm02_ews[5],$hh_pm02_ews[6],$hh_pm02_ews[7],$hh_pm02_ews[8],$hh_pm02_ews[9],$hh_pm02_ews[10],$hh_pm02_ews[11]],
                    ],
                    [
                        "label" => "PM03",
                        'borderColor' => "#EF5350",
                        "pointBorderColor" => "#EF5350",
                        "pointBackgroundColor" => "#EF5350",
                        'data' => [$hh_pm03_ews[0],$hh_pm03_ews[1],$hh_pm03_ews[2],$hh_pm03_ews[3],$hh_pm03_ews[4],$hh_pm03_ews[5],$hh_pm03_ews[6],$hh_pm03_ews[7],$hh_pm03_ews[8],$hh_pm03_ews[9],$hh_pm03_ews[10],$hh_pm03_ews[11]],
                    ]
                ])
                ->options([]);
                
                $graf_hh_ews_2 = app()->chartjs
                ->name('graf_hh_ews_2')
                ->type('bar')
                ->size(['width' => 800, 'height' => 400])
                ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
                ->datasets([
                    [
                        "label" => "PM02",
                        'backgroundColor' => "#48C9A9",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => [$hh_pm02_ews[0],$hh_pm02_ews[1],$hh_pm02_ews[2],$hh_pm02_ews[3],$hh_pm02_ews[4],$hh_pm02_ews[5],$hh_pm02_ews[6],$hh_pm02_ews[7],$hh_pm02_ews[8],$hh_pm02_ews[9],$hh_pm02_ews[10],$hh_pm02_ews[11]],
                    ],
                    [
                        "label" => "PM03",
                        'backgroundColor' => "#EF5350",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => [$hh_pm03_ews[0],$hh_pm03_ews[1],$hh_pm03_ews[2],$hh_pm03_ews[3],$hh_pm03_ews[4],$hh_pm03_ews[5],$hh_pm03_ews[6],$hh_pm03_ews[7],$hh_pm03_ews[8],$hh_pm03_ews[9],$hh_pm03_ews[10],$hh_pm03_ews[11]],
                    ]
                ])
                ->options([]);

                $graf_hh_ews_3 = app()->chartjs
                ->name('graf_hh_ews_3')
                ->type('bar')
                ->size(['width' => 800, 'height' => 400])
                ->labels(['HH 2019-2020'])
                ->datasets([
                    [
                        "label" => "PM02",
                        'backgroundColor' => ['#48C9A9'],
                        'data' => [22]
                    ],
                    [
                        "label" => "PM03",
                        'backgroundColor' => ['#EF5350'],
                        'data' => [34]
                    ]
                ])
                ->options([]);
                //-----------planta 0-----------------------
                for ($i=0; $i < count($meses) ; $i++) { 
                    $buscar_planta=Actividades::where('tipo','PM01')->where('id_area',2)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm01_planta[$i]=$buscar_planta;
                     $buscar_planta=Actividades::where('tipo','PM02')->where('id_area',2)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm02_planta[$i]=$buscar_planta;
                     $buscar_planta=Actividades::where('tipo','PM03')->where('id_area',2)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm03_planta[$i]=$buscar_planta;
                }
                $graf_hh_planta_1 = app()->chartjs
                ->name('graf_hh_planta_1')
                ->type('line')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
                ->datasets([
                    [
                        "label" => "PM01",
                        'borderColor' => "#F7C55F",
                        "pointBorderColor" => "#F7C55F",
                        "pointBackgroundColor" => "#F7C55F",
                        'data' => [$hh_pm01_planta[0],$hh_pm01_planta[1],$hh_pm01_planta[2],$hh_pm01_planta[3],$hh_pm01_planta[4],$hh_pm01_planta[5],$hh_pm01_planta[6],$hh_pm01_planta[7],$hh_pm01_planta[8],$hh_pm01_planta[9],$hh_pm01_planta[10],$hh_pm01_planta[11]],
                    ],
                    [
                        "label" => "PM02",
                        'borderColor' => "#48C9A9",
                        "pointBorderColor" => "#48C9A9",
                        "pointBackgroundColor" => "#48C9A9",
                        'data' => [$hh_pm02_planta[0],$hh_pm02_planta[1],$hh_pm02_planta[2],$hh_pm02_planta[3],$hh_pm02_planta[4],$hh_pm02_planta[5],$hh_pm02_planta[6],$hh_pm02_planta[7],$hh_pm02_planta[8],$hh_pm02_planta[9],$hh_pm02_planta[10],$hh_pm02_planta[11]],
                    ],
                    [
                        "label" => "PM03",
                        'borderColor' => "#EF5350",
                        "pointBorderColor" => "#EF5350",
                        "pointBackgroundColor" => "#EF5350",
                        'data' => [$hh_pm03_planta[0],$hh_pm03_planta[1],$hh_pm03_planta[2],$hh_pm03_planta[3],$hh_pm03_planta[4],$hh_pm03_planta[5],$hh_pm03_planta[6],$hh_pm03_planta[7],$hh_pm03_planta[8],$hh_pm03_planta[9],$hh_pm03_planta[10],$hh_pm03_planta[11]],
                   ]
               ])
                ->options([]);
                $graf_hh_planta_2 = app()->chartjs
                ->name('graf_hh_planta_2')
                ->type('bar')
                ->size(['width' => 800, 'height' => 400])
                ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
                ->datasets([
                    [
                        "label" => "PM02",
                        'backgroundColor' => "#48C9A9",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => [$hh_pm02_planta[0],$hh_pm02_planta[1],$hh_pm02_planta[2],$hh_pm02_planta[3],$hh_pm02_planta[4],$hh_pm02_planta[5],$hh_pm02_planta[6],$hh_pm02_planta[7],$hh_pm02_planta[8],$hh_pm02_planta[9],$hh_pm02_planta[10],$hh_pm02_planta[11]],
                    ],
                    [
                        "label" => "PM03",
                        'backgroundColor' => "#EF5350",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => [$hh_pm03_planta[0],$hh_pm03_planta[1],$hh_pm03_planta[2],$hh_pm03_planta[3],$hh_pm03_planta[4],$hh_pm03_planta[5],$hh_pm03_planta[6],$hh_pm03_planta[7],$hh_pm03_planta[8],$hh_pm03_planta[9],$hh_pm03_planta[10],$hh_pm03_planta[11]],
                    ]
                ])
                ->options([]);

                $graf_hh_planta_3 = app()->chartjs
                ->name('graf_hh_planta_3')
                ->type('bar')
                ->size(['width' => 800, 'height' => 400])
                ->labels(['HH 2019-2020'])
                ->datasets([
                    [
                        "label" => "PM02",
                        'backgroundColor' => ['#48C9A9'],
                        'data' => [22]
                    ],
                    [
                        "label" => "PM03",
                        'backgroundColor' => ['#EF5350'],
                        'data' => [34]
                    ]
                ])
                ->options([]);
                //----------agua y tranque
                for ($i=0; $i < count($meses) ; $i++) { 
                    $buscar_agua=Actividades::where('tipo','PM01')->where('id_area',3)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm01_agua[$i]=$buscar_agua;
                     $buscar_agua=Actividades::where('tipo','PM02')->where('id_area',3)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm02_agua[$i]=$buscar_agua;
                     $buscar_agua=Actividades::where('tipo','PM03')->where('id_area',3)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm03_agua[$i]=$buscar_agua;
                }
                $graf_hh_agua_1 = app()->chartjs
                ->name('graf_hh_agua_1')
                ->type('line')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
                ->datasets([
                    [
                        "label" => "PM01",
                        'borderColor' => "#F7C55F",
                        "pointBorderColor" => "#F7C55F",
                        "pointBackgroundColor" => "#F7C55F",
                        'data' => [$hh_pm01_agua[0], $hh_pm01_agua[1], $hh_pm01_agua[2], $hh_pm01_agua[3], $hh_pm01_agua[4], $hh_pm01_agua[5], $hh_pm01_agua[6], $hh_pm01_agua[7], $hh_pm01_agua[8], $hh_pm01_agua[9], $hh_pm01_agua[10], $hh_pm01_agua[11]],
                    ],
                    [
                        "label" => "PM02",
                        'borderColor' => "#48C9A9",
                        "pointBorderColor" => "#48C9A9",
                        "pointBackgroundColor" => "#48C9A9",
                        'data' => [$hh_pm02_agua[0], $hh_pm02_agua[1], $hh_pm02_agua[2], $hh_pm02_agua[3], $hh_pm02_agua[4], $hh_pm02_agua[5], $hh_pm02_agua[6], $hh_pm02_agua[7], $hh_pm02_agua[8], $hh_pm02_agua[9], $hh_pm02_agua[10], $hh_pm02_agua[11]],
                    ],
                    [
                        "label" => "PM03",
                        'borderColor' => "#EF5350",
                        "pointBorderColor" => "#EF5350",
                        "pointBackgroundColor" => "#EF5350",
                        'data' => [$hh_pm03_agua[0], $hh_pm03_agua[1], $hh_pm03_agua[2], $hh_pm03_agua[3], $hh_pm03_agua[4], $hh_pm03_agua[5], $hh_pm03_agua[6], $hh_pm03_agua[7], $hh_pm03_agua[8], $hh_pm03_agua[9], $hh_pm03_agua[10], $hh_pm03_agua[11]],
                    ]
                ])
                ->options([]);

                $graf_hh_agua_2 = app()->chartjs
                ->name('graf_hh_agua_2')
                ->type('bar')
                ->size(['width' => 800, 'height' => 400])
                ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
                ->datasets([
                    [
                        "label" => "PM02",
                        'backgroundColor' => "#48C9A9",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => [$hh_pm02_agua[0], $hh_pm02_agua[1], $hh_pm02_agua[2], $hh_pm02_agua[3], $hh_pm02_agua[4], $hh_pm02_agua[5], $hh_pm02_agua[6], $hh_pm02_agua[7], $hh_pm02_agua[8], $hh_pm02_agua[9], $hh_pm02_agua[10], $hh_pm02_agua[11]],
                    ],
                    [
                        "label" => "PM03",
                        'backgroundColor' => "#EF5350",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => [$hh_pm03_agua[0], $hh_pm03_agua[1], $hh_pm03_agua[2], $hh_pm03_agua[3], $hh_pm03_agua[4], $hh_pm03_agua[5], $hh_pm03_agua[6], $hh_pm03_agua[7], $hh_pm03_agua[8], $hh_pm03_agua[9], $hh_pm03_agua[10], $hh_pm03_agua[11]],
                    ]
                ])
                ->options([]);

                $graf_hh_agua_3 = app()->chartjs
                ->name('graf_hh_agua_3')
                ->type('bar')
                ->size(['width' => 800, 'height' => 400])
                ->labels(['HH 2019-2020'])
                ->datasets([
                    [
                        "label" => "PM02",
                        'backgroundColor' => ['#48C9A9'],
                        'data' => [22]
                    ],
                    [
                        "label" => "PM03",
                        'backgroundColor' => ['#EF5350'],
                        'data' => [34]
                    ]
                ])
                ->options([]);
                return view('estadisticas.estadisticas_hh', compact('request','graf_hh_ews_1','graf_hh_ews_2','graf_hh_ews_3','graf_hh_planta_1','graf_hh_planta_2','graf_hh_planta_3','graf_hh_agua_1','graf_hh_agua_2','graf_hh_agua_3','hh_pm01_ews','hh_pm02_ews','hh_pm03_ews','hh_pm01_planta','hh_pm02_planta','hh_pm03_planta','hh_pm01_agua','hh_pm02_agua','hh_pm03_agua'));
            } else {
                //npi individual
                for ($i=0; $i < count($meses) ; $i++) { 
                    $buscar=Actividades::where('tipo','PM01')->where('id_area',$area->id)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm01[$i]=$buscar;
                     $buscar=Actividades::where('tipo','PM02')->where('id_area',$area->id)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm02[$i]=$buscar;
                     $buscar=Actividades::where('tipo','PM03')->where('id_area',$area->id)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm03[$i]=$buscar;
                }
                 $graf_hh_1 = app()->chartjs
                ->name('graf_hh_filtro_1')
                ->type('line')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
                ->datasets([
                    [
                        "label" => "PM01",
                        'borderColor' => "#F7C55F",
                        "pointBorderColor" => "#F7C55F",
                        "pointBackgroundColor" => "#F7C55F",
                        'data' => [$hh_pm01[0],$hh_pm01[1],$hh_pm01[2],$hh_pm01[3],$hh_pm01[4],$hh_pm01[5],$hh_pm01[6],$hh_pm01[7],$hh_pm01[8],$hh_pm01[9],$hh_pm01[10],$hh_pm01[11]],
                    ],
                    [
                        "label" => "PM02",
                        'borderColor' => "#48C9A9",
                        "pointBorderColor" => "#48C9A9",
                        "pointBackgroundColor" => "#48C9A9",
                        'data' => [$hh_pm02[0],$hh_pm02[1],$hh_pm02[2],$hh_pm02[3],$hh_pm02[4],$hh_pm02[5],$hh_pm02[6],$hh_pm02[7],$hh_pm02[8],$hh_pm02[9],$hh_pm02[10],$hh_pm02[11]],
                    ],
                    [
                        "label" => "PM03",
                        'borderColor' => "#EF5350",
                        "pointBorderColor" => "#EF5350",
                        "pointBackgroundColor" => "#EF5350",
                        'data' => [$hh_pm03[0],$hh_pm03[1],$hh_pm03[2],$hh_pm03[3],$hh_pm03[4],$hh_pm03[5],$hh_pm03[6],$hh_pm03[7],$hh_pm03[8],$hh_pm03[9],$hh_pm03[10],$hh_pm03[11]],
                    ]
                ])
                ->options([]);

                $graf_hh_area_2 = app()->chartjs
                ->name('graf_hh_area_2')
                ->type('bar')
                ->size(['width' => 800, 'height' => 400])
                ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
                ->datasets([
                    [
                        "label" => "PM02",
                        'backgroundColor' => "#48C9A9",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => [$hh_pm02[0],$hh_pm02[1],$hh_pm02[2],$hh_pm02[3],$hh_pm02[4],$hh_pm02[5],$hh_pm02[6],$hh_pm02[7],$hh_pm02[8],$hh_pm02[9],$hh_pm02[10],$hh_pm02[11]],
                    ],
                    [
                        "label" => "PM03",
                        'backgroundColor' => "#EF5350",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => [$hh_pm03[0],$hh_pm03[1],$hh_pm03[2],$hh_pm03[3],$hh_pm03[4],$hh_pm03[5],$hh_pm03[6],$hh_pm03[7],$hh_pm03[8],$hh_pm03[9],$hh_pm03[10],$hh_pm03[11]],
                    ]
                ])
                ->options([]);

                $graf_hh_3 = app()->chartjs
                ->name('graf_hh_filtro_3')
                ->type('bar')
                ->size(['width' => 800, 'height' => 400])
                ->labels(['HH 2019-2020'])
                ->datasets([
                    [
                        "label" => "PM02",
                        'backgroundColor' => ['#48C9A9'],
                        'data' => [22]
                    ],
                    [
                        "label" => "PM03",
                        'backgroundColor' => ['#EF5350'],
                        'data' => [34]
                    ]
                ])
                ->options([]);

                return view('estadisticas.area_hh', compact('request','graf_hh_1','graf_hh_area_2','graf_hh_3','hh_pm01','hh_pm02','hh_pm03'));
            }
            
        } else if ($request->gerencias=="CHO"){
            # code...
            if ($request->areas=="todas") {
                //GERENCIA CHO
                for ($i=0; $i < count($meses) ; $i++) { 
                    $buscar=Actividades::where('tipo','PM01')->where('id_area',4)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm01_filtro[$i]=$buscar;
                     $buscar=Actividades::where('tipo','PM02')->where('id_area',4)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm02_filtro[$i]=$buscar;
                     $buscar=Actividades::where('tipo','PM03')->where('id_area',4)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm03_filtro[$i]=$buscar;
                }
                $graf_hh_filtro_1 = app()->chartjs
                ->name('graf_hh_filtro_1')
                ->type('line')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
                ->datasets([
                    [
                        "label" => "PM01",
                        'borderColor' => "#F7C55F",
                        "pointBorderColor" => "#F7C55F",
                        "pointBackgroundColor" => "#F7C55F",
                        'data' => [$hh_pm01_filtro[0],$hh_pm01_filtro[1],$hh_pm01_filtro[2],$hh_pm01_filtro[3],$hh_pm01_filtro[4],$hh_pm01_filtro[5],$hh_pm01_filtro[6],$hh_pm01_filtro[7],$hh_pm01_filtro[8],$hh_pm01_filtro[9],$hh_pm01_filtro[10],$hh_pm01_filtro[11]],
                    ],
                    [
                        "label" => "PM02",
                        'borderColor' => "#48C9A9",
                        "pointBorderColor" => "#48C9A9",
                        "pointBackgroundColor" => "#48C9A9",
                        'data' => [$hh_pm02_filtro[0],$hh_pm02_filtro[1],$hh_pm02_filtro[2],$hh_pm02_filtro[3],$hh_pm02_filtro[4],$hh_pm02_filtro[5],$hh_pm02_filtro[6],$hh_pm02_filtro[7],$hh_pm02_filtro[8],$hh_pm02_filtro[9],$hh_pm02_filtro[10],$hh_pm02_filtro[11]],
                    ],
                    [
                        "label" => "PM03",
                        'borderColor' => "#EF5350",
                        "pointBorderColor" => "#EF5350",
                        "pointBackgroundColor" => "#EF5350",
                        'data' => [$hh_pm03_filtro[0],$hh_pm03_filtro[1],$hh_pm03_filtro[2],$hh_pm03_filtro[3],$hh_pm03_filtro[4],$hh_pm03_filtro[5],$hh_pm03_filtro[6],$hh_pm03_filtro[7],$hh_pm03_filtro[8],$hh_pm03_filtro[9],$hh_pm03_filtro[10],$hh_pm03_filtro[11]],
                    ]
                ])
                ->options([]);

                $graf_hh_filtro_2 = app()->chartjs
                ->name('graf_hh_filtro_2')
                ->type('bar')
                ->size(['width' => 800, 'height' => 400])
                ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
                ->datasets([
                    [
                        "label" => "PM02",
                        'backgroundColor' => "#48C9A9",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => [$hh_pm02_filtro[0],$hh_pm02_filtro[1],$hh_pm02_filtro[2],$hh_pm02_filtro[3],$hh_pm02_filtro[4],$hh_pm02_filtro[5],$hh_pm02_filtro[6],$hh_pm02_filtro[7],$hh_pm02_filtro[8],$hh_pm02_filtro[9],$hh_pm02_filtro[10],$hh_pm02_filtro[11]],
                    ],
                    [
                        "label" => "PM03",
                        'backgroundColor' => "#EF5350",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => [$hh_pm03_filtro[0],$hh_pm03_filtro[1],$hh_pm03_filtro[2],$hh_pm03_filtro[3],$hh_pm03_filtro[4],$hh_pm03_filtro[5],$hh_pm03_filtro[6],$hh_pm03_filtro[7],$hh_pm03_filtro[8],$hh_pm03_filtro[9],$hh_pm03_filtro[10],$hh_pm03_filtro[11]],
                    ]
                ])
                ->options([]);

                $graf_hh_filtro_3 = app()->chartjs
                ->name('graf_hh_filtro_3')
                ->type('bar')
                ->size(['width' => 800, 'height' => 400])
                ->labels(['HH 2019-2020'])
                ->datasets([
                    [
                        "label" => "PM02",
                        'backgroundColor' => ['#48C9A9'],
                        'data' => [22]
                    ],
                    [
                        "label" => "PM03",
                        'backgroundColor' => ['#EF5350'],
                        'data' => [34]
                    ]
                ])
                ->options([]);
                //---------------ect
                for ($i=0; $i < count($meses) ; $i++) { 
                    $buscar=Actividades::where('tipo','PM01')->where('id_area',5)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm01_ect[$i]=$buscar;
                     $buscar=Actividades::where('tipo','PM02')->where('id_area',5)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm02_ect[$i]=$buscar;
                     $buscar=Actividades::where('tipo','PM03')->where('id_area',5)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm03_ect[$i]=$buscar;
                }
                $graf_hh_ect_1 = app()->chartjs
                ->name('graf_hh_ect_1')
                ->type('line')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
                ->datasets([
                    [
                        "label" => "PM01",
                        'borderColor' => "#F7C55F",
                        "pointBorderColor" => "#F7C55F",
                        "pointBackgroundColor" => "#F7C55F",
                        'data' => [$hh_pm01_ect[0],$hh_pm01_ect[1],$hh_pm01_ect[2],$hh_pm01_ect[3],$hh_pm01_ect[4],$hh_pm01_ect[5],$hh_pm01_ect[6],$hh_pm01_ect[7],$hh_pm01_ect[8],$hh_pm01_ect[9],$hh_pm01_ect[10],$hh_pm01_ect[11]],
                    ],
                    [
                        "label" => "PM02",
                        'borderColor' => "#48C9A9",
                        "pointBorderColor" => "#48C9A9",
                        "pointBackgroundColor" => "#48C9A9",
                        'data' => [$hh_pm02_ect[0],$hh_pm02_ect[1],$hh_pm02_ect[2],$hh_pm02_ect[3],$hh_pm02_ect[4],$hh_pm02_ect[5],$hh_pm02_ect[6],$hh_pm02_ect[7],$hh_pm02_ect[8],$hh_pm02_ect[9],$hh_pm02_ect[10],$hh_pm02_ect[11]],
                    ],
                    [
                        "label" => "PM03",
                        'borderColor' => "#EF5350",
                        "pointBorderColor" => "#EF5350",
                        "pointBackgroundColor" => "#EF5350",
                        'data' => [$hh_pm03_ect[0],$hh_pm03_ect[1],$hh_pm03_ect[2],$hh_pm03_ect[3],$hh_pm03_ect[4],$hh_pm03_ect[5],$hh_pm03_ect[6],$hh_pm03_ect[7],$hh_pm03_ect[8],$hh_pm03_ect[9],$hh_pm03_ect[10],$hh_pm03_ect[11]],
                    ]
                ])
                ->options([]);

                $graf_hh_ect_2 = app()->chartjs
                ->name('graf_hh_ect_2')
                ->type('bar')
                ->size(['width' => 800, 'height' => 400])
                ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
                ->datasets([
                    [
                        "label" => "PM02",
                        'backgroundColor' => "#48C9A9",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => [$hh_pm02_ect[0],$hh_pm02_ect[1],$hh_pm02_ect[2],$hh_pm02_ect[3],$hh_pm02_ect[4],$hh_pm02_ect[5],$hh_pm02_ect[6],$hh_pm02_ect[7],$hh_pm02_ect[8],$hh_pm02_ect[9],$hh_pm02_ect[10],$hh_pm02_ect[11]],
                    ],
                    [
                        "label" => "PM03",
                        'backgroundColor' => "#EF5350",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => [$hh_pm03_ect[0],$hh_pm03_ect[1],$hh_pm03_ect[2],$hh_pm03_ect[3],$hh_pm03_ect[4],$hh_pm03_ect[5],$hh_pm03_ect[6],$hh_pm03_ect[7],$hh_pm03_ect[8],$hh_pm03_ect[9],$hh_pm03_ect[10],$hh_pm03_ect[11]],
                    ]
                ])
                ->options([]);

                $graf_hh_ect_3 = app()->chartjs
                ->name('graf_hh_ect_3')
                ->type('bar')
                ->size(['width' => 800, 'height' => 400])
                ->labels(['HH 2019-2020'])
                ->datasets([
                    [
                        "label" => "PM02",
                        'backgroundColor' => ['#48C9A9'],
                        'data' => [22]
                    ],
                    [
                        "label" => "PM03",
                        'backgroundColor' => ['#EF5350'],
                        'data' => [34]
                    ]
                ])
                ->options([]);
                //--------------colorados
                for ($i=0; $i < count($meses) ; $i++) { 
                    $buscar=Actividades::where('tipo','PM01')->where('id_area',6)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm01_colorados[$i]=$buscar;
                     $buscar=Actividades::where('tipo','PM02')->where('id_area',6)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm02_colorados[$i]=$buscar;
                     $buscar=Actividades::where('tipo','PM03')->where('id_area',6)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm03_colorados[$i]=$buscar;
                }
                $graf_hh_colorados_1 = app()->chartjs
                ->name('graf_hh_colorados_1')
                ->type('line')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
                ->datasets([
                    [
                        "label" => "PM01",
                        'borderColor' => "#F7C55F",
                        "pointBorderColor" => "#F7C55F",
                        "pointBackgroundColor" => "#F7C55F",
                        'data' => [$hh_pm01_colorados[0],$hh_pm01_colorados[1],$hh_pm01_colorados[2],$hh_pm01_colorados[3],$hh_pm01_colorados[4],$hh_pm01_colorados[5],$hh_pm01_colorados[6],$hh_pm01_colorados[7],$hh_pm01_colorados[8],$hh_pm01_colorados[9],$hh_pm01_colorados[10],$hh_pm01_colorados[11]],
                    ],
                    [
                        "label" => "PM02",
                        'borderColor' => "#48C9A9",
                        "pointBorderColor" => "#48C9A9",
                        "pointBackgroundColor" => "#48C9A9",
                        'data' => [$hh_pm02_colorados[0],$hh_pm02_colorados[1],$hh_pm02_colorados[2],$hh_pm02_colorados[3],$hh_pm02_colorados[4],$hh_pm02_colorados[5],$hh_pm02_colorados[6],$hh_pm02_colorados[7],$hh_pm02_colorados[8],$hh_pm02_colorados[9],$hh_pm02_colorados[10],$hh_pm02_colorados[11]],
                    ],
                    [
                        "label" => "PM03",
                        'borderColor' => "#EF5350",
                        "pointBorderColor" => "#EF5350",
                        "pointBackgroundColor" => "#EF5350",
                        'data' => [$hh_pm03_colorados[0],$hh_pm03_colorados[1],$hh_pm03_colorados[2],$hh_pm03_colorados[3],$hh_pm03_colorados[4],$hh_pm03_colorados[5],$hh_pm03_colorados[6],$hh_pm03_colorados[7],$hh_pm03_colorados[8],$hh_pm03_colorados[9],$hh_pm03_colorados[10],$hh_pm03_colorados[11]],
                    ]
                ])
                ->options([]);

                $graf_hh_colorados_2 = app()->chartjs
                ->name('graf_hh_colorados_2')
                ->type('bar')
                ->size(['width' => 800, 'height' => 400])
                ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
                ->datasets([
                    [
                        "label" => "PM02",
                        'backgroundColor' => "#48C9A9",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => [$hh_pm02_colorados[0],$hh_pm02_colorados[1],$hh_pm02_colorados[2],$hh_pm02_colorados[3],$hh_pm02_colorados[4],$hh_pm02_colorados[5],$hh_pm02_colorados[6],$hh_pm02_colorados[7],$hh_pm02_colorados[8],$hh_pm02_colorados[9],$hh_pm02_colorados[10],$hh_pm02_colorados[11]],
                    ],
                    [
                        "label" => "PM03",
                        'backgroundColor' => "#EF5350",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => [$hh_pm03_colorados[0],$hh_pm03_colorados[1],$hh_pm03_colorados[2],$hh_pm03_colorados[3],$hh_pm03_colorados[4],$hh_pm03_colorados[5],$hh_pm03_colorados[6],$hh_pm03_colorados[7],$hh_pm03_colorados[8],$hh_pm03_colorados[9],$hh_pm03_colorados[10],$hh_pm03_colorados[11]],
                    ]
                ])
                ->options([]);

                $graf_hh_colorados_3 = app()->chartjs
                ->name('graf_hh_colorados_3')
                ->type('bar')
                ->size(['width' => 800, 'height' => 400])
                ->labels(['HH 2019-2020'])
                ->datasets([
                    [
                        "label" => "PM02",
                        'backgroundColor' => ['#48C9A9'],
                        'data' => [22]
                    ],
                    [
                        "label" => "PM03",
                        'backgroundColor' => ['#EF5350'],
                        'data' => [34]
                    ]
                ])
                ->options([]);

                return view('estadisticas.estadisticas_hh', compact('request','graf_hh_filtro_1','graf_hh_filtro_2','graf_hh_filtro_3','graf_hh_ect_1','graf_hh_ect_2','graf_hh_ect_3','graf_hh_colorados_1','graf_hh_colorados_2','graf_hh_colorados_3','hh_pm01_filtro','hh_pm02_filtro','hh_pm03_filtro','hh_pm01_ect','hh_pm02_ect','hh_pm03_ect','hh_pm01_colorados','hh_pm02_colorados','hh_pm03_colorados'));
            } else {
                //cho individual
                for ($i=0; $i < count($meses) ; $i++) { 
                    $buscar=Actividades::where('tipo','PM01')->where('id_area',$area->id)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm01[$i]=$buscar;
                     $buscar=Actividades::where('tipo','PM02')->where('id_area',$area->id)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm02[$i]=$buscar;
                     $buscar=Actividades::where('tipo','PM03')->where('id_area',$area->id)->where('fecha_vencimiento','like','%2020%')->where('fecha_vencimiento','like','%'.$meses[$i].'%')->sum('duracion_real');
                     $hh_pm03[$i]=$buscar;
                }
                $graf_hh_1 = app()->chartjs
                ->name('graf_hh_filtro_1')
                ->type('line')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
                ->datasets([
                    [
                        "label" => "MPM01",
                        'borderColor' => "#F7C55F",
                        "pointBorderColor" => "#F7C55F",
                        "pointBackgroundColor" => "#F7C55F",
                        'data' => [$hh_pm01[0],$hh_pm01[1],$hh_pm01[2],$hh_pm01[3],$hh_pm01[4],$hh_pm01[5],$hh_pm01[6],$hh_pm01[7],$hh_pm01[8],$hh_pm01[9],$hh_pm01[10],$hh_pm01[11]],
                    ],
                    [
                        "label" => "PM02",
                        'borderColor' => "#48C9A9",
                        "pointBorderColor" => "#48C9A9",
                        "pointBackgroundColor" => "#48C9A9",
                        'data' => [$hh_pm02[0],$hh_pm02[1],$hh_pm02[2],$hh_pm02[3],$hh_pm02[4],$hh_pm02[5],$hh_pm02[6],$hh_pm02[7],$hh_pm02[8],$hh_pm02[9],$hh_pm02[10],$hh_pm02[11]],
                    ],
                    [
                        "label" => "PM03",
                        'borderColor' => "#EF5350",
                        "pointBorderColor" => "#EF5350",
                        "pointBackgroundColor" => "#EF5350",
                        'data' => [$hh_pm03[0],$hh_pm03[1],$hh_pm03[2],$hh_pm03[3],$hh_pm03[4],$hh_pm03[5],$hh_pm03[6],$hh_pm03[7],$hh_pm03[8],$hh_pm03[9],$hh_pm03[10],$hh_pm03[11]],
                    ]
                ])
                ->options([]);

                $graf_hh_area_2 = app()->chartjs
                ->name('graf_hh_area_2')
                ->type('bar')
                ->size(['width' => 800, 'height' => 400])
                ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
                ->datasets([
                    [
                        "label" => "PM02",
                        'backgroundColor' => "#48C9A9",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => [$hh_pm02[0],$hh_pm02[1],$hh_pm02[2],$hh_pm02[3],$hh_pm02[4],$hh_pm02[5],$hh_pm02[6],$hh_pm02[7],$hh_pm02[8],$hh_pm02[9],$hh_pm02[10],$hh_pm02[11]],
                    ],
                    [
                        "label" => "PM03",
                        'backgroundColor' => "#EF5350",
                        'borderColor' => "rgba(38, 185, 154, 0.7)",
                        "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                        "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                        "pointHoverBackgroundColor" => "#fff",
                        "pointHoverBorderColor" => "rgba(220,220,220,1)",
                        'data' => [$hh_pm03[0],$hh_pm03[1],$hh_pm03[2],$hh_pm03[3],$hh_pm03[4],$hh_pm03[5],$hh_pm03[6],$hh_pm03[7],$hh_pm03[8],$hh_pm03[9],$hh_pm03[10],$hh_pm03[11]],
                    ]
                ])
                ->options([]);

                $graf_hh_3 = app()->chartjs
                ->name('graf_hh_filtro_3')
                ->type('bar')
                ->size(['width' => 800, 'height' => 400])
                ->labels(['HH 2019-2020'])
                ->datasets([
                    [
                        "label" => "PM02",
                        'backgroundColor' => ['#48C9A9'],
                        'data' => [22]
                    ],
                    [
                        "label" => "PM03",
                        'backgroundColor' => ['#EF5350'],
                        'data' => [34]
                    ]
                ])
                ->options([]);

                return view('estadisticas.area_hh', compact('request','graf_hh_1','graf_hh_area_2','graf_hh_3','hh_pm01','hh_pm02','hh_pm03'));
            }
        }
    }

    public function pdf_area_hh(Request $request) {
        //dd($request->areas);
        $gerencia = $request->gerencias;
        $area = $request->areas;
        //dd($gerencia,$area);
        $form = $request->all();
        $pm01[] = array();
        $pm01_enero = $request->pm01_enero;
        $pm01_febrero = $request->pm01_febrero;
        $pm01_marzo = $request->pm01_marzo;
        $pm01_abril = $request->pm01_abril;
        $pm01_mayo = $request->pm01_mayo;
        $pm01_junio = $request->pm01_junio;
        $pm01_julio = $request->pm01_julio;
        $pm01_agosto = $request->pm01_agosto;
        $pm01_septiembre = $request->pm01_septiembre;
        $pm01_octubre = $request->pm01_octubre;
        $pm01_noviembre = $request->pm01_noviembre;
        $pm01_diciembre = $request->pm01_diciembre;
        $pm01[0] = $pm01_enero;
        $pm01[1] = $pm01_febrero;
        $pm01[2] = $pm01_marzo;
        $pm01[3] = $pm01_abril;
        $pm01[4] = $pm01_mayo;
        $pm01[5] = $pm01_junio;
        $pm01[6] = $pm01_julio;
        $pm01[7] = $pm01_agosto;
        $pm01[8] = $pm01_septiembre;
        $pm01[9] = $pm01_octubre;
        $pm01[10] = $pm01_noviembre;
        $pm01[11] = $pm01_diciembre;

        $pm02[] =array();
        $pm02_enero = $request->pm02_enero;
        $pm02_febrero = $request->pm02_febrero;
        $pm02_marzo = $request->pm02_marzo;
        $pm02_abril = $request->pm02_abril;
        $pm02_mayo = $request->pm02_mayo;
        $pm02_junio = $request->pm02_junio;
        $pm02_julio = $request->pm02_julio;
        $pm02_agosto = $request->pm02_agosto;
        $pm02_septiembre = $request->pm02_septiembre;
        $pm02_octubre = $request->pm02_octubre;
        $pm02_noviembre = $request->pm02_noviembre;
        $pm02_diciembre = $request->pm02_diciembre;
        $pm02[0] = $pm02_enero;
        $pm02[1] = $pm02_febrero;
        $pm02[2] = $pm02_marzo;
        $pm02[3] = $pm02_abril;
        $pm02[4] = $pm02_mayo;
        $pm02[5] = $pm02_junio;
        $pm02[6] = $pm02_julio;
        $pm02[7] = $pm02_agosto;
        $pm02[8] = $pm02_septiembre;
        $pm02[9] = $pm02_octubre;
        $pm02[10] = $pm02_noviembre;
        $pm02[11] = $pm02_diciembre;

        $pm03[] = array();
        $pm03_enero = $request->pm03_enero;
        $pm03_febrero = $request->pm03_febrero;
        $pm03_marzo = $request->pm03_marzo;
        $pm03_abril = $request->pm03_abril;
        $pm03_mayo = $request->pm03_mayo;
        $pm03_junio = $request->pm03_junio;
        $pm03_julio = $request->pm03_julio;
        $pm03_agosto = $request->pm03_agosto;
        $pm03_septiembre = $request->pm03_septiembre;
        $pm03_octubre = $request->pm03_octubre;
        $pm03_noviembre = $request->pm03_noviembre;
        $pm03_diciembre = $request->pm03_diciembre;
        $pm03[0] = $pm03_enero;
        $pm03[1] = $pm03_febrero;
        $pm03[2] = $pm03_marzo;
        $pm03[3] = $pm03_abril;
        $pm03[4] = $pm03_mayo;
        $pm03[5] = $pm03_junio;
        $pm03[6] = $pm03_julio;
        $pm03[7] = $pm03_agosto;
        $pm03[8] = $pm03_septiembre;
        $pm03[9] = $pm03_octubre;
        $pm03[10] = $pm03_noviembre;
        $pm03[11] = $pm03_diciembre;

        $graf_hh_1 = app()->chartjs
        ->name('graf_hh_filtro_1')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
        ->datasets([
            [
                "label" => "MPM01",
                'borderColor' => "#F7C55F",
                "pointBorderColor" => "#F7C55F",
                "pointBackgroundColor" => "#F7C55F",
                'data' => [$pm01[0],$pm01[1],$pm01[2],$pm01[3],$pm01[4],$pm01[5],$pm01[6],$pm01[7],$pm01[8],$pm01[9],$pm01[10],$pm01[11]],
            ],
            [
                "label" => "PM02",
                'borderColor' => "#48C9A9",
                "pointBorderColor" => "#48C9A9",
                "pointBackgroundColor" => "#48C9A9",
                'data' => [$pm02[0],$pm02[1],$pm02[2],$pm02[3],$pm02[4],$pm02[5],$pm02[6],$pm02[7],$pm02[8],$pm02[9],$pm02[10],$pm02[11]],
            ],
            [
                "label" => "PM03",
                'borderColor' => "#EF5350",
                "pointBorderColor" => "#EF5350",
                "pointBackgroundColor" => "#EF5350",
                'data' => [$pm03[0],$pm03[1],$pm03[2],$pm03[3],$pm03[4],$pm03[5],$pm03[6],$pm03[7],$pm03[8],$pm03[9],$pm03[10],$pm03[11]],
            ]
        ])
        ->options([]);

        $graf_hh_area_2 = app()->chartjs
        ->name('graf_hh_area_2')
        ->type('bar')
        ->size(['width' => 800, 'height' => 400])
        ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
        ->datasets([
            [
                "label" => "PM02",
                'backgroundColor' => "#48C9A9",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$pm02[0],$pm02[1],$pm02[2],$pm02[3],$pm02[4],$pm02[5],$pm02[6],$pm02[7],$pm02[8],$pm02[9],$pm02[10],$pm02[11]],
            ],
            [
                "label" => "PM03",
                'backgroundColor' => "#EF5350",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$pm03[0],$pm03[1],$pm03[2],$pm03[3],$pm03[4],$pm03[5],$pm03[6],$pm03[7],$pm03[8],$pm03[9],$pm03[10],$pm03[11]],
            ]
        ])
        ->options([]);

        return view('estadisticas.reportes.pdf_area_hh', compact('gerencia','area','pm01','pm02','pm03','graf_hh_1','graf_hh_area_2'));
    }

    public function pdf_npi_hh(Request $request) {
        //dd($request->all());

        $form = $request->all();
        $ews_pm01[] = array();
        $ews_pm01_enero = $request->ews_pm01_enero;
        $ews_pm01_febrero = $request->ews_pm01_febrero;
        $ews_pm01_marzo = $request->ews_pm01_marzo;
        $ews_pm01_abril = $request->ews_pm01_abril;
        $ews_pm01_mayo = $request->ews_pm01_mayo;
        $ews_pm01_junio = $request->ews_pm01_junio;
        $ews_pm01_julio = $request->ews_pm01_julio;
        $ews_pm01_agosto = $request->ews_pm01_agosto;
        $ews_pm01_septiembre = $request->ews_pm01_septiembre;
        $ews_pm01_octubre = $request->ews_pm01_octubre;
        $ews_pm01_noviembre = $request->ews_pm01_noviembre;
        $ews_pm01_diciembre = $request->ews_pm01_diciembre;
        $ews_pm01[0] = $ews_pm01_enero;
        $ews_pm01[1] = $ews_pm01_febrero;
        $ews_pm01[2] = $ews_pm01_marzo;
        $ews_pm01[3] = $ews_pm01_abril;
        $ews_pm01[4] = $ews_pm01_mayo;
        $ews_pm01[5] = $ews_pm01_junio;
        $ews_pm01[6] = $ews_pm01_julio;
        $ews_pm01[7] = $ews_pm01_agosto;
        $ews_pm01[8] = $ews_pm01_septiembre;
        $ews_pm01[9] = $ews_pm01_octubre;
        $ews_pm01[10] = $ews_pm01_noviembre;
        $ews_pm01[11] = $ews_pm01_diciembre;

        $ews_pm02[] =array();
        $ews_pm02_enero = $request->ews_pm02_enero;
        $ews_pm02_febrero = $request->ews_pm02_febrero;
        $ews_pm02_marzo = $request->ews_pm02_marzo;
        $ews_pm02_abril = $request->ews_pm02_abril;
        $ews_pm02_mayo = $request->ews_pm02_mayo;
        $ews_pm02_junio = $request->ews_pm02_junio;
        $ews_pm02_julio = $request->ews_pm02_julio;
        $ews_pm02_agosto = $request->ews_pm02_agosto;
        $ews_pm02_septiembre = $request->ews_pm02_septiembre;
        $ews_pm02_octubre = $request->ews_pm02_octubre;
        $ews_pm02_noviembre = $request->ews_pm02_noviembre;
        $ews_pm02_diciembre = $request->ews_pm02_diciembre;
        $ews_pm02[0] = $ews_pm02_enero;
        $ews_pm02[1] = $ews_pm02_febrero;
        $ews_pm02[2] = $ews_pm02_marzo;
        $ews_pm02[3] = $ews_pm02_abril;
        $ews_pm02[4] = $ews_pm02_mayo;
        $ews_pm02[5] = $ews_pm02_junio;
        $ews_pm02[6] = $ews_pm02_julio;
        $ews_pm02[7] = $ews_pm02_agosto;
        $ews_pm02[8] = $ews_pm02_septiembre;
        $ews_pm02[9] = $ews_pm02_octubre;
        $ews_pm02[10] = $ews_pm02_noviembre;
        $ews_pm02[11] = $ews_pm02_diciembre;

        $ews_pm03[] = array();
        $ews_pm03_enero = $request->ews_pm03_enero;
        $ews_pm03_febrero = $request->ews_pm03_febrero;
        $ews_pm03_marzo = $request->ews_pm03_marzo;
        $ews_pm03_abril = $request->ews_pm03_abril;
        $ews_pm03_mayo = $request->ews_pm03_mayo;
        $ews_pm03_junio = $request->ews_pm03_junio;
        $ews_pm03_julio = $request->ews_pm03_julio;
        $ews_pm03_agosto = $request->ews_pm03_agosto;
        $ews_pm03_septiembre = $request->ews_pm03_septiembre;
        $ews_pm03_octubre = $request->ews_pm03_octubre;
        $ews_pm03_noviembre = $request->ews_pm03_noviembre;
        $ews_pm03_diciembre = $request->ews_pm03_diciembre;
        $ews_pm03[0] = $ews_pm03_enero;
        $ews_pm03[1] = $ews_pm03_febrero;
        $ews_pm03[2] = $ews_pm03_marzo;
        $ews_pm03[3] = $ews_pm03_abril;
        $ews_pm03[4] = $ews_pm03_mayo;
        $ews_pm03[5] = $ews_pm03_junio;
        $ews_pm03[6] = $ews_pm03_julio;
        $ews_pm03[7] = $ews_pm03_agosto;
        $ews_pm03[8] = $ews_pm03_septiembre;
        $ews_pm03[9] = $ews_pm03_octubre;
        $ews_pm03[10] = $ews_pm03_noviembre;
        $ews_pm03[11] = $ews_pm03_diciembre;

        //dd($hh_pm01_ews);
        $graf_hh_ews_1 = app()->chartjs
        ->name('graf_hh_ews_1')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Diciembre'])
        ->datasets([
            [
                "label" => "PM01",
                'borderColor' => "#F7C55F",
                "pointBorderColor" => "#F7C55F",
                "pointBackgroundColor" => "#F7C55F",
                'data' => [$ews_pm01[0],$ews_pm01[1],$ews_pm01[2],$ews_pm01[3],$ews_pm01[4],$ews_pm01[5],$ews_pm01[6],$ews_pm01[7],$ews_pm01[8],$ews_pm01[9],$ews_pm01[10],$ews_pm01[11]],
            ],
            [
                "label" => "PM02",
                'borderColor' => "#48C9A9",
                "pointBorderColor" => "#48C9A9",
                "pointBackgroundColor" => "#48C9A9",
                'data' => [$ews_pm02[0],$ews_pm02[1],$ews_pm02[2],$ews_pm02[3],$ews_pm02[4],$ews_pm02[5],$ews_pm02[6],$ews_pm02[7],$ews_pm02[8],$ews_pm02[9],$ews_pm02[10],$ews_pm02[11]],
            ],
            [
                "label" => "PM03",
                'borderColor' => "#EF5350",
                "pointBorderColor" => "#EF5350",
                "pointBackgroundColor" => "#EF5350",
                'data' => [$ews_pm03[0],$ews_pm03[1],$ews_pm03[2],$ews_pm03[3],$ews_pm03[4],$ews_pm03[5],$ews_pm03[6],$ews_pm03[7],$ews_pm03[8],$ews_pm03[9],$ews_pm03[10],$ews_pm03[11]],
            ]
        ])
        ->options([]);
        
        $graf_hh_ews_2 = app()->chartjs
        ->name('graf_hh_ews_2')
        ->type('bar')
        ->size(['width' => 800, 'height' => 400])
        ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
        ->datasets([
            [
                "label" => "PM02",
                'backgroundColor' => "#48C9A9",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$ews_pm02[0],$ews_pm02[1],$ews_pm02[2],$ews_pm02[3],$ews_pm02[4],$ews_pm02[5],$ews_pm02[6],$ews_pm02[7],$ews_pm02[8],$ews_pm02[9],$ews_pm02[10],$ews_pm02[11]],
            ],
            [
                "label" => "PM03",
                'backgroundColor' => "#EF5350",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$ews_pm03[0],$ews_pm03[1],$ews_pm03[2],$ews_pm03[3],$ews_pm03[4],$ews_pm03[5],$ews_pm03[6],$ews_pm03[7],$ews_pm03[8],$ews_pm03[9],$ews_pm03[10],$ews_pm03[11]],
            ]
        ])
        ->options([]);

        $planta_pm01[] = array();
        $planta_pm01_enero = $request->planta_pm01_enero;
        $planta_pm01_febrero = $request->planta_pm01_febrero;
        $planta_pm01_marzo = $request->planta_pm01_marzo;
        $planta_pm01_abril = $request->planta_pm01_abril;
        $planta_pm01_mayo = $request->planta_pm01_mayo;
        $planta_pm01_junio = $request->planta_pm01_junio;
        $planta_pm01_julio = $request->planta_pm01_julio;
        $planta_pm01_agosto = $request->planta_pm01_agosto;
        $planta_pm01_septiembre = $request->planta_pm01_septiembre;
        $planta_pm01_octubre = $request->planta_pm01_octubre;
        $planta_pm01_noviembre = $request->planta_pm01_noviembre;
        $planta_pm01_diciembre = $request->planta_pm01_diciembre;
        $planta_pm01[0] = $planta_pm01_enero;
        $planta_pm01[1] = $planta_pm01_febrero;
        $planta_pm01[2] = $planta_pm01_marzo;
        $planta_pm01[3] = $planta_pm01_abril;
        $planta_pm01[4] = $planta_pm01_mayo;
        $planta_pm01[5] = $planta_pm01_junio;
        $planta_pm01[6] = $planta_pm01_julio;
        $planta_pm01[7] = $planta_pm01_agosto;
        $planta_pm01[8] = $planta_pm01_septiembre;
        $planta_pm01[9] = $planta_pm01_octubre;
        $planta_pm01[10] = $planta_pm01_noviembre;
        $planta_pm01[11] = $planta_pm01_diciembre;

        $planta_pm02[] =array();
        $planta_pm02_enero = $request->planta_pm02_enero;
        $planta_pm02_febrero = $request->planta_pm02_febrero;
        $planta_pm02_marzo = $request->planta_pm02_marzo;
        $planta_pm02_abril = $request->planta_pm02_abril;
        $planta_pm02_mayo = $request->planta_pm02_mayo;
        $planta_pm02_junio = $request->planta_pm02_junio;
        $planta_pm02_julio = $request->planta_pm02_julio;
        $planta_pm02_agosto = $request->planta_pm02_agosto;
        $planta_pm02_septiembre = $request->planta_pm02_septiembre;
        $planta_pm02_octubre = $request->planta_pm02_octubre;
        $planta_pm02_noviembre = $request->planta_pm02_noviembre;
        $planta_pm02_diciembre = $request->planta_pm02_diciembre;
        $planta_pm02[0] = $planta_pm02_enero;
        $planta_pm02[1] = $planta_pm02_febrero;
        $planta_pm02[2] = $planta_pm02_marzo;
        $planta_pm02[3] = $planta_pm02_abril;
        $planta_pm02[4] = $planta_pm02_mayo;
        $planta_pm02[5] = $planta_pm02_junio;
        $planta_pm02[6] = $planta_pm02_julio;
        $planta_pm02[7] = $planta_pm02_agosto;
        $planta_pm02[8] = $planta_pm02_septiembre;
        $planta_pm02[9] = $planta_pm02_octubre;
        $planta_pm02[10] = $planta_pm02_noviembre;
        $planta_pm02[11] = $planta_pm02_diciembre;

        $planta_pm03[] = array();
        $planta_pm03_enero = $request->planta_pm03_enero;
        $planta_pm03_febrero = $request->planta_pm03_febrero;
        $planta_pm03_marzo = $request->planta_pm03_marzo;
        $planta_pm03_abril = $request->planta_pm03_abril;
        $planta_pm03_mayo = $request->planta_pm03_mayo;
        $planta_pm03_junio = $request->planta_pm03_junio;
        $planta_pm03_julio = $request->planta_pm03_julio;
        $planta_pm03_agosto = $request->planta_pm03_agosto;
        $planta_pm03_septiembre = $request->planta_pm03_septiembre;
        $planta_pm03_octubre = $request->planta_pm03_octubre;
        $planta_pm03_noviembre = $request->planta_pm03_noviembre;
        $planta_pm03_diciembre = $request->planta_pm03_diciembre;
        $planta_pm03[0] = $planta_pm03_enero;
        $planta_pm03[1] = $planta_pm03_febrero;
        $planta_pm03[2] = $planta_pm03_marzo;
        $planta_pm03[3] = $planta_pm03_abril;
        $planta_pm03[4] = $planta_pm03_mayo;
        $planta_pm03[5] = $planta_pm03_junio;
        $planta_pm03[6] = $planta_pm03_julio;
        $planta_pm03[7] = $planta_pm03_agosto;
        $planta_pm03[8] = $planta_pm03_septiembre;
        $planta_pm03[9] = $planta_pm03_octubre;
        $planta_pm03[10] = $planta_pm03_noviembre;
        $planta_pm03[11] = $planta_pm03_diciembre;

        //dd($hh_pm01_ews);
        $graf_hh_planta_1 = app()->chartjs
        ->name('graf_hh_planta_1')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Diciembre'])
        ->datasets([
            [
                "label" => "PM01",
                'borderColor' => "#F7C55F",
                "pointBorderColor" => "#F7C55F",
                "pointBackgroundColor" => "#F7C55F",
                'data' => [$planta_pm01[0],$planta_pm01[1],$planta_pm01[2],$planta_pm01[3],$planta_pm01[4],$planta_pm01[5],$planta_pm01[6],$planta_pm01[7],$planta_pm01[8],$planta_pm01[9],$planta_pm01[10],$planta_pm01[11]],
            ],
            [
                "label" => "PM02",
                'borderColor' => "#48C9A9",
                "pointBorderColor" => "#48C9A9",
                "pointBackgroundColor" => "#48C9A9",
                'data' => [$planta_pm02[0],$planta_pm02[1],$planta_pm02[2],$planta_pm02[3],$planta_pm02[4],$planta_pm02[5],$planta_pm02[6],$planta_pm02[7],$planta_pm02[8],$planta_pm02[9],$planta_pm02[10],$planta_pm02[11]],
            ],
            [
                "label" => "PM03",
                'borderColor' => "#EF5350",
                "pointBorderColor" => "#EF5350",
                "pointBackgroundColor" => "#EF5350",
                'data' => [$planta_pm03[0],$planta_pm03[1],$planta_pm03[2],$planta_pm03[3],$planta_pm03[4],$planta_pm03[5],$planta_pm03[6],$planta_pm03[7],$planta_pm03[8],$planta_pm03[9],$planta_pm03[10],$planta_pm03[11]],
            ]
        ])
        ->options([]);
        
        $graf_hh_planta_2 = app()->chartjs
        ->name('graf_hh_planta_2')
        ->type('bar')
        ->size(['width' => 800, 'height' => 400])
        ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
        ->datasets([
            [
                "label" => "PM02",
                'backgroundColor' => "#48C9A9",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$planta_pm02[0],$planta_pm02[1],$planta_pm02[2],$planta_pm02[3],$planta_pm02[4],$planta_pm02[5],$planta_pm02[6],$planta_pm02[7],$planta_pm02[8],$planta_pm02[9],$planta_pm02[10],$planta_pm02[11]],
            ],
            [
                "label" => "PM03",
                'backgroundColor' => "#EF5350",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$planta_pm03[0],$planta_pm03[1],$planta_pm03[2],$planta_pm03[3],$planta_pm03[4],$planta_pm03[5],$planta_pm03[6],$planta_pm03[7],$planta_pm03[8],$planta_pm03[9],$planta_pm03[10],$planta_pm03[11]],
            ]
        ])
        ->options([]);


        $agua_pm01[] = array();
        $agua_pm01_enero = $request->agua_pm01_enero;
        $agua_pm01_febrero = $request->agua_pm01_febrero;
        $agua_pm01_marzo = $request->agua_pm01_marzo;
        $agua_pm01_abril = $request->agua_pm01_abril;
        $agua_pm01_mayo = $request->agua_pm01_mayo;
        $agua_pm01_junio = $request->agua_pm01_junio;
        $agua_pm01_julio = $request->agua_pm01_julio;
        $agua_pm01_agosto = $request->agua_pm01_agosto;
        $agua_pm01_septiembre = $request->agua_pm01_septiembre;
        $agua_pm01_octubre = $request->agua_pm01_octubre;
        $agua_pm01_noviembre = $request->agua_pm01_noviembre;
        $agua_pm01_diciembre = $request->agua_pm01_diciembre;
        $agua_pm01[0] = $agua_pm01_enero;
        $agua_pm01[1] = $agua_pm01_febrero;
        $agua_pm01[2] = $agua_pm01_marzo;
        $agua_pm01[3] = $agua_pm01_abril;
        $agua_pm01[4] = $agua_pm01_mayo;
        $agua_pm01[5] = $agua_pm01_junio;
        $agua_pm01[6] = $agua_pm01_julio;
        $agua_pm01[7] = $agua_pm01_agosto;
        $agua_pm01[8] = $agua_pm01_septiembre;
        $agua_pm01[9] = $agua_pm01_octubre;
        $agua_pm01[10] = $agua_pm01_noviembre;
        $agua_pm01[11] = $agua_pm01_diciembre;

        $agua_pm02[] =array();
        $agua_pm02_enero = $request->agua_pm02_enero;
        $agua_pm02_febrero = $request->agua_pm02_febrero;
        $agua_pm02_marzo = $request->agua_pm02_marzo;
        $agua_pm02_abril = $request->agua_pm02_abril;
        $agua_pm02_mayo = $request->agua_pm02_mayo;
        $agua_pm02_junio = $request->agua_pm02_junio;
        $agua_pm02_julio = $request->agua_pm02_julio;
        $agua_pm02_agosto = $request->agua_pm02_agosto;
        $agua_pm02_septiembre = $request->agua_pm02_septiembre;
        $agua_pm02_octubre = $request->agua_pm02_octubre;
        $agua_pm02_noviembre = $request->agua_pm02_noviembre;
        $agua_pm02_diciembre = $request->agua_pm02_diciembre;
        $agua_pm02[0] = $agua_pm02_enero;
        $agua_pm02[1] = $agua_pm02_febrero;
        $agua_pm02[2] = $agua_pm02_marzo;
        $agua_pm02[3] = $agua_pm02_abril;
        $agua_pm02[4] = $agua_pm02_mayo;
        $agua_pm02[5] = $agua_pm02_junio;
        $agua_pm02[6] = $agua_pm02_julio;
        $agua_pm02[7] = $agua_pm02_agosto;
        $agua_pm02[8] = $agua_pm02_septiembre;
        $agua_pm02[9] = $agua_pm02_octubre;
        $agua_pm02[10] = $agua_pm02_noviembre;
        $agua_pm02[11] = $agua_pm02_diciembre;

        $agua_pm03[] = array();
        $agua_pm03_enero = $request->agua_pm03_enero;
        $agua_pm03_febrero = $request->agua_pm03_febrero;
        $agua_pm03_marzo = $request->agua_pm03_marzo;
        $agua_pm03_abril = $request->agua_pm03_abril;
        $agua_pm03_mayo = $request->agua_pm03_mayo;
        $agua_pm03_junio = $request->agua_pm03_junio;
        $agua_pm03_julio = $request->agua_pm03_julio;
        $agua_pm03_agosto = $request->agua_pm03_agosto;
        $agua_pm03_septiembre = $request->agua_pm03_septiembre;
        $agua_pm03_octubre = $request->agua_pm03_octubre;
        $agua_pm03_noviembre = $request->agua_pm03_noviembre;
        $agua_pm03_diciembre = $request->agua_pm03_diciembre;
        $agua_pm03[0] = $agua_pm03_enero;
        $agua_pm03[1] = $agua_pm03_febrero;
        $agua_pm03[2] = $agua_pm03_marzo;
        $agua_pm03[3] = $agua_pm03_abril;
        $agua_pm03[4] = $agua_pm03_mayo;
        $agua_pm03[5] = $agua_pm03_junio;
        $agua_pm03[6] = $agua_pm03_julio;
        $agua_pm03[7] = $agua_pm03_agosto;
        $agua_pm03[8] = $agua_pm03_septiembre;
        $agua_pm03[9] = $agua_pm03_octubre;
        $agua_pm03[10] = $agua_pm03_noviembre;
        $agua_pm03[11] = $agua_pm03_diciembre;

        $graf_hh_agua_1 = app()->chartjs
        ->name('graf_hh_agua_1')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Diciembre'])
        ->datasets([
            [
                "label" => "PM01",
                'borderColor' => "#F7C55F",
                "pointBorderColor" => "#F7C55F",
                "pointBackgroundColor" => "#F7C55F",
                'data' => [$agua_pm01[0],$agua_pm01[1],$agua_pm01[2],$agua_pm01[3],$agua_pm01[4],$agua_pm01[5],$agua_pm01[6],$agua_pm01[7],$agua_pm01[8],$agua_pm01[9],$agua_pm01[10],$agua_pm01[11]],
            ],
            [
                "label" => "PM02",
                'borderColor' => "#48C9A9",
                "pointBorderColor" => "#48C9A9",
                "pointBackgroundColor" => "#48C9A9",
                'data' => [$agua_pm02[0],$agua_pm02[1],$agua_pm02[2],$agua_pm02[3],$agua_pm02[4],$agua_pm02[5],$agua_pm02[6],$agua_pm02[7],$agua_pm02[8],$agua_pm02[9],$agua_pm02[10],$agua_pm02[11]],
            ],
            [
                "label" => "PM03",
                'borderColor' => "#EF5350",
                "pointBorderColor" => "#EF5350",
                "pointBackgroundColor" => "#EF5350",
                'data' => [$agua_pm03[0],$agua_pm03[1],$agua_pm03[2],$agua_pm03[3],$agua_pm03[4],$agua_pm03[5],$agua_pm03[6],$agua_pm03[7],$agua_pm03[8],$agua_pm03[9],$agua_pm03[10],$agua_pm03[11]],
            ]
        ])
        ->options([]);
        
        $graf_hh_agua_2 = app()->chartjs
        ->name('graf_hh_agua_2')
        ->type('bar')
        ->size(['width' => 800, 'height' => 400])
        ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
        ->datasets([
            [
                "label" => "PM02",
                'backgroundColor' => "#48C9A9",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$agua_pm02[0],$agua_pm02[1],$agua_pm02[2],$agua_pm02[3],$agua_pm02[4],$agua_pm02[5],$agua_pm02[6],$agua_pm02[7],$agua_pm02[8],$agua_pm02[9],$agua_pm02[10],$agua_pm02[11]],
            ],
            [
                "label" => "PM03",
                'backgroundColor' => "#EF5350",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$agua_pm03[0],$agua_pm03[1],$agua_pm03[2],$agua_pm03[3],$agua_pm03[4],$agua_pm03[5],$agua_pm03[6],$agua_pm03[7],$agua_pm03[8],$agua_pm03[9],$agua_pm03[10],$agua_pm03[11]],
            ]
        ])
        ->options([]);

        return view('estadisticas.reportes.pdf_npi_hh', compact('ews_pm01','ews_pm02','ews_pm03','graf_hh_ews_1','graf_hh_ews_2','planta_pm01','planta_pm02','planta_pm03','graf_hh_planta_1','graf_hh_planta_2','agua_pm01','agua_pm02','agua_pm03','graf_hh_agua_1','graf_hh_agua_2'));
    }

    public function pdf_cho_hh(Request $request) {
        //dd($request->all());
        $filtro_pm01[] = array();
        $filtro_pm01_enero = $request->filtro_pm01_enero;
        $filtro_pm01_febrero = $request->filtro_pm01_febrero;
        $filtro_pm01_marzo = $request->filtro_pm01_marzo;
        $filtro_pm01_abril = $request->filtro_pm01_abril;
        $filtro_pm01_mayo = $request->filtro_pm01_mayo;
        $filtro_pm01_junio = $request->filtro_pm01_junio;
        $filtro_pm01_julio = $request->filtro_pm01_julio;
        $filtro_pm01_agosto = $request->filtro_pm01_agosto;
        $filtro_pm01_septiembre = $request->filtro_pm01_septiembre;
        $filtro_pm01_octubre = $request->filtro_pm01_octubre;
        $filtro_pm01_noviembre = $request->filtro_pm01_noviembre;
        $filtro_pm01_diciembre = $request->filtro_pm01_diciembre;
        $filtro_pm01[0] = $filtro_pm01_enero;
        $filtro_pm01[1] = $filtro_pm01_febrero;
        $filtro_pm01[2] = $filtro_pm01_marzo;
        $filtro_pm01[3] = $filtro_pm01_abril;
        $filtro_pm01[4] = $filtro_pm01_mayo;
        $filtro_pm01[5] = $filtro_pm01_junio;
        $filtro_pm01[6] = $filtro_pm01_julio;
        $filtro_pm01[7] = $filtro_pm01_agosto;
        $filtro_pm01[8] = $filtro_pm01_septiembre;
        $filtro_pm01[9] = $filtro_pm01_octubre;
        $filtro_pm01[10] = $filtro_pm01_noviembre;
        $filtro_pm01[11] = $filtro_pm01_diciembre;

        $filtro_pm02[] =array();
        $filtro_pm02_enero = $request->filtro_pm02_enero;
        $filtro_pm02_febrero = $request->filtro_pm02_febrero;
        $filtro_pm02_marzo = $request->filtro_pm02_marzo;
        $filtro_pm02_abril = $request->filtro_pm02_abril;
        $filtro_pm02_mayo = $request->filtro_pm02_mayo;
        $filtro_pm02_junio = $request->filtro_pm02_junio;
        $filtro_pm02_julio = $request->filtro_pm02_julio;
        $filtro_pm02_agosto = $request->filtro_pm02_agosto;
        $filtro_pm02_septiembre = $request->filtro_pm02_septiembre;
        $filtro_pm02_octubre = $request->filtro_pm02_octubre;
        $filtro_pm02_noviembre = $request->filtro_pm02_noviembre;
        $filtro_pm02_diciembre = $request->filtro_pm02_diciembre;
        $filtro_pm02[0] = $filtro_pm02_enero;
        $filtro_pm02[1] = $filtro_pm02_febrero;
        $filtro_pm02[2] = $filtro_pm02_marzo;
        $filtro_pm02[3] = $filtro_pm02_abril;
        $filtro_pm02[4] = $filtro_pm02_mayo;
        $filtro_pm02[5] = $filtro_pm02_junio;
        $filtro_pm02[6] = $filtro_pm02_julio;
        $filtro_pm02[7] = $filtro_pm02_agosto;
        $filtro_pm02[8] = $filtro_pm02_septiembre;
        $filtro_pm02[9] = $filtro_pm02_octubre;
        $filtro_pm02[10] = $filtro_pm02_noviembre;
        $filtro_pm02[11] = $filtro_pm02_diciembre;

        $filtro_pm03[] = array();
        $filtro_pm03_enero = $request->filtro_pm03_enero;
        $filtro_pm03_febrero = $request->filtro_pm03_febrero;
        $filtro_pm03_marzo = $request->filtro_pm03_marzo;
        $filtro_pm03_abril = $request->filtro_pm03_abril;
        $filtro_pm03_mayo = $request->filtro_pm03_mayo;
        $filtro_pm03_junio = $request->filtro_pm03_junio;
        $filtro_pm03_julio = $request->filtro_pm03_julio;
        $filtro_pm03_agosto = $request->filtro_pm03_agosto;
        $filtro_pm03_septiembre = $request->filtro_pm03_septiembre;
        $filtro_pm03_octubre = $request->filtro_pm03_octubre;
        $filtro_pm03_noviembre = $request->filtro_pm03_noviembre;
        $filtro_pm03_diciembre = $request->filtro_pm03_diciembre;
        $filtro_pm03[0] = $filtro_pm03_enero;
        $filtro_pm03[1] = $filtro_pm03_febrero;
        $filtro_pm03[2] = $filtro_pm03_marzo;
        $filtro_pm03[3] = $filtro_pm03_abril;
        $filtro_pm03[4] = $filtro_pm03_mayo;
        $filtro_pm03[5] = $filtro_pm03_junio;
        $filtro_pm03[6] = $filtro_pm03_julio;
        $filtro_pm03[7] = $filtro_pm03_agosto;
        $filtro_pm03[8] = $filtro_pm03_septiembre;
        $filtro_pm03[9] = $filtro_pm03_octubre;
        $filtro_pm03[10] = $filtro_pm03_noviembre;
        $filtro_pm03[11] = $filtro_pm03_diciembre;

        //dd($hh_pm01_ews);
        $graf_hh_filtro_1 = app()->chartjs
        ->name('graf_hh_filtro_1')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Diciembre'])
        ->datasets([
            [
                "label" => "PM01",
                'borderColor' => "#F7C55F",
                "pointBorderColor" => "#F7C55F",
                "pointBackgroundColor" => "#F7C55F",
                'data' => [$filtro_pm01[0],$filtro_pm01[1],$filtro_pm01[2],$filtro_pm01[3],$filtro_pm01[4],$filtro_pm01[5],$filtro_pm01[6],$filtro_pm01[7],$filtro_pm01[8],$filtro_pm01[9],$filtro_pm01[10],$filtro_pm01[11]],
            ],
            [
                "label" => "PM02",
                'borderColor' => "#48C9A9",
                "pointBorderColor" => "#48C9A9",
                "pointBackgroundColor" => "#48C9A9",
                'data' => [$filtro_pm02[0],$filtro_pm02[1],$filtro_pm02[2],$filtro_pm02[3],$filtro_pm02[4],$filtro_pm02[5],$filtro_pm02[6],$filtro_pm02[7],$filtro_pm02[8],$filtro_pm02[9],$filtro_pm02[10],$filtro_pm02[11]],
            ],
            [
                "label" => "PM03",
                'borderColor' => "#EF5350",
                "pointBorderColor" => "#EF5350",
                "pointBackgroundColor" => "#EF5350",
                'data' => [$filtro_pm03[0],$filtro_pm03[1],$filtro_pm03[2],$filtro_pm03[3],$filtro_pm03[4],$filtro_pm03[5],$filtro_pm03[6],$filtro_pm03[7],$filtro_pm03[8],$filtro_pm03[9],$filtro_pm03[10],$filtro_pm03[11]],
            ]
        ])
        ->options([]);
        
        $graf_hh_filtro_2 = app()->chartjs
        ->name('graf_hh_filtro_2')
        ->type('bar')
        ->size(['width' => 800, 'height' => 400])
        ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
        ->datasets([
            [
                "label" => "PM02",
                'backgroundColor' => "#48C9A9",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$filtro_pm02[0],$filtro_pm02[1],$filtro_pm02[2],$filtro_pm02[3],$filtro_pm02[4],$filtro_pm02[5],$filtro_pm02[6],$filtro_pm02[7],$filtro_pm02[8],$filtro_pm02[9],$filtro_pm02[10],$filtro_pm02[11]],
            ],
            [
                "label" => "PM03",
                'backgroundColor' => "#EF5350",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$filtro_pm03[0],$filtro_pm03[1],$filtro_pm03[2],$filtro_pm03[3],$filtro_pm03[4],$filtro_pm03[5],$filtro_pm03[6],$filtro_pm03[7],$filtro_pm03[8],$filtro_pm03[9],$filtro_pm03[10],$filtro_pm03[11]],
            ]
        ])
        ->options([]);

        $ect_pm01[] = array();
        $ect_pm01_enero = $request->ect_pm01_enero;
        $ect_pm01_febrero = $request->ect_pm01_febrero;
        $ect_pm01_marzo = $request->ect_pm01_marzo;
        $ect_pm01_abril = $request->ect_pm01_abril;
        $ect_pm01_mayo = $request->ect_pm01_mayo;
        $ect_pm01_junio = $request->ect_pm01_junio;
        $ect_pm01_julio = $request->ect_pm01_julio;
        $ect_pm01_agosto = $request->ect_pm01_agosto;
        $ect_pm01_septiembre = $request->ect_pm01_septiembre;
        $ect_pm01_octubre = $request->ect_pm01_octubre;
        $ect_pm01_noviembre = $request->ect_pm01_noviembre;
        $ect_pm01_diciembre = $request->ect_pm01_diciembre;
        $ect_pm01[0] = $ect_pm01_enero;
        $ect_pm01[1] = $ect_pm01_febrero;
        $ect_pm01[2] = $ect_pm01_marzo;
        $ect_pm01[3] = $ect_pm01_abril;
        $ect_pm01[4] = $ect_pm01_mayo;
        $ect_pm01[5] = $ect_pm01_junio;
        $ect_pm01[6] = $ect_pm01_julio;
        $ect_pm01[7] = $ect_pm01_agosto;
        $ect_pm01[8] = $ect_pm01_septiembre;
        $ect_pm01[9] = $ect_pm01_octubre;
        $ect_pm01[10] = $ect_pm01_noviembre;
        $ect_pm01[11] = $ect_pm01_diciembre;

        $ect_pm02[] =array();
        $ect_pm02_enero = $request->ect_pm02_enero;
        $ect_pm02_febrero = $request->ect_pm02_febrero;
        $ect_pm02_marzo = $request->ect_pm02_marzo;
        $ect_pm02_abril = $request->ect_pm02_abril;
        $ect_pm02_mayo = $request->ect_pm02_mayo;
        $ect_pm02_junio = $request->ect_pm02_junio;
        $ect_pm02_julio = $request->ect_pm02_julio;
        $ect_pm02_agosto = $request->ect_pm02_agosto;
        $ect_pm02_septiembre = $request->ect_pm02_septiembre;
        $ect_pm02_octubre = $request->ect_pm02_octubre;
        $ect_pm02_noviembre = $request->ect_pm02_noviembre;
        $ect_pm02_diciembre = $request->ect_pm02_diciembre;
        $ect_pm02[0] = $ect_pm02_enero;
        $ect_pm02[1] = $ect_pm02_febrero;
        $ect_pm02[2] = $ect_pm02_marzo;
        $ect_pm02[3] = $ect_pm02_abril;
        $ect_pm02[4] = $ect_pm02_mayo;
        $ect_pm02[5] = $ect_pm02_junio;
        $ect_pm02[6] = $ect_pm02_julio;
        $ect_pm02[7] = $ect_pm02_agosto;
        $ect_pm02[8] = $ect_pm02_septiembre;
        $ect_pm02[9] = $ect_pm02_octubre;
        $ect_pm02[10] = $ect_pm02_noviembre;
        $ect_pm02[11] = $ect_pm02_diciembre;

        $ect_pm03[] = array();
        $ect_pm03_enero = $request->ect_pm03_enero;
        $ect_pm03_febrero = $request->ect_pm03_febrero;
        $ect_pm03_marzo = $request->ect_pm03_marzo;
        $ect_pm03_abril = $request->ect_pm03_abril;
        $ect_pm03_mayo = $request->ect_pm03_mayo;
        $ect_pm03_junio = $request->ect_pm03_junio;
        $ect_pm03_julio = $request->ect_pm03_julio;
        $ect_pm03_agosto = $request->ect_pm03_agosto;
        $ect_pm03_septiembre = $request->ect_pm03_septiembre;
        $ect_pm03_octubre = $request->ect_pm03_octubre;
        $ect_pm03_noviembre = $request->ect_pm03_noviembre;
        $ect_pm03_diciembre = $request->ect_pm03_diciembre;
        $ect_pm03[0] = $ect_pm03_enero;
        $ect_pm03[1] = $ect_pm03_febrero;
        $ect_pm03[2] = $ect_pm03_marzo;
        $ect_pm03[3] = $ect_pm03_abril;
        $ect_pm03[4] = $ect_pm03_mayo;
        $ect_pm03[5] = $ect_pm03_junio;
        $ect_pm03[6] = $ect_pm03_julio;
        $ect_pm03[7] = $ect_pm03_agosto;
        $ect_pm03[8] = $ect_pm03_septiembre;
        $ect_pm03[9] = $ect_pm03_octubre;
        $ect_pm03[10] = $ect_pm03_noviembre;
        $ect_pm03[11] = $ect_pm03_diciembre;

        //dd($hh_pm01_ews);
        $graf_hh_ect_1 = app()->chartjs
        ->name('graf_hh_ect_1')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Diciembre'])
        ->datasets([
            [
                "label" => "PM01",
                'borderColor' => "#F7C55F",
                "pointBorderColor" => "#F7C55F",
                "pointBackgroundColor" => "#F7C55F",
                'data' => [$ect_pm01[0],$ect_pm01[1],$ect_pm01[2],$ect_pm01[3],$ect_pm01[4],$ect_pm01[5],$ect_pm01[6],$ect_pm01[7],$ect_pm01[8],$ect_pm01[9],$ect_pm01[10],$ect_pm01[11]],
            ],
            [
                "label" => "PM02",
                'borderColor' => "#48C9A9",
                "pointBorderColor" => "#48C9A9",
                "pointBackgroundColor" => "#48C9A9",
                'data' => [$ect_pm02[0],$ect_pm02[1],$ect_pm02[2],$ect_pm02[3],$ect_pm02[4],$ect_pm02[5],$ect_pm02[6],$ect_pm02[7],$ect_pm02[8],$ect_pm02[9],$ect_pm02[10],$ect_pm02[11]],
            ],
            [
                "label" => "PM03",
                'borderColor' => "#EF5350",
                "pointBorderColor" => "#EF5350",
                "pointBackgroundColor" => "#EF5350",
                'data' => [$ect_pm03[0],$ect_pm03[1],$ect_pm03[2],$ect_pm03[3],$ect_pm03[4],$ect_pm03[5],$ect_pm03[6],$ect_pm03[7],$ect_pm03[8],$ect_pm03[9],$ect_pm03[10],$ect_pm03[11]],
            ]
        ])
        ->options([]);
        
        $graf_hh_ect_2 = app()->chartjs
        ->name('graf_hh_ect_2')
        ->type('bar')
        ->size(['width' => 800, 'height' => 400])
        ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
        ->datasets([
            [
                "label" => "PM02",
                'backgroundColor' => "#48C9A9",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$ect_pm02[0],$ect_pm02[1],$ect_pm02[2],$ect_pm02[3],$ect_pm02[4],$ect_pm02[5],$ect_pm02[6],$ect_pm02[7],$ect_pm02[8],$ect_pm02[9],$ect_pm02[10],$ect_pm02[11]],
            ],
            [
                "label" => "PM03",
                'backgroundColor' => "#EF5350",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$ect_pm03[0],$ect_pm03[1],$ect_pm03[2],$ect_pm03[3],$ect_pm03[4],$ect_pm03[5],$ect_pm03[6],$ect_pm03[7],$ect_pm03[8],$ect_pm03[9],$ect_pm03[10],$ect_pm03[11]],
            ]
        ])
        ->options([]);


        $colorados_pm01[] = array();
        $colorados_pm01_enero = $request->colorados_pm01_enero;
        $colorados_pm01_febrero = $request->colorados_pm01_febrero;
        $colorados_pm01_marzo = $request->colorados_pm01_marzo;
        $colorados_pm01_abril = $request->colorados_pm01_abril;
        $colorados_pm01_mayo = $request->colorados_pm01_mayo;
        $colorados_pm01_junio = $request->colorados_pm01_junio;
        $colorados_pm01_julio = $request->colorados_pm01_julio;
        $colorados_pm01_agosto = $request->colorados_pm01_agosto;
        $colorados_pm01_septiembre = $request->colorados_pm01_septiembre;
        $colorados_pm01_octubre = $request->colorados_pm01_octubre;
        $colorados_pm01_noviembre = $request->colorados_pm01_noviembre;
        $colorados_pm01_diciembre = $request->colorados_pm01_diciembre;
        $colorados_pm01[0] = $colorados_pm01_enero;
        $colorados_pm01[1] = $colorados_pm01_febrero;
        $colorados_pm01[2] = $colorados_pm01_marzo;
        $colorados_pm01[3] = $colorados_pm01_abril;
        $colorados_pm01[4] = $colorados_pm01_mayo;
        $colorados_pm01[5] = $colorados_pm01_junio;
        $colorados_pm01[6] = $colorados_pm01_julio;
        $colorados_pm01[7] = $colorados_pm01_agosto;
        $colorados_pm01[8] = $colorados_pm01_septiembre;
        $colorados_pm01[9] = $colorados_pm01_octubre;
        $colorados_pm01[10] = $colorados_pm01_noviembre;
        $colorados_pm01[11] = $colorados_pm01_diciembre;

        $colorados_pm02[] =array();
        $colorados_pm02_enero = $request->colorados_pm02_enero;
        $colorados_pm02_febrero = $request->colorados_pm02_febrero;
        $colorados_pm02_marzo = $request->colorados_pm02_marzo;
        $colorados_pm02_abril = $request->colorados_pm02_abril;
        $colorados_pm02_mayo = $request->colorados_pm02_mayo;
        $colorados_pm02_junio = $request->colorados_pm02_junio;
        $colorados_pm02_julio = $request->colorados_pm02_julio;
        $colorados_pm02_agosto = $request->colorados_pm02_agosto;
        $colorados_pm02_septiembre = $request->colorados_pm02_septiembre;
        $colorados_pm02_octubre = $request->colorados_pm02_octubre;
        $colorados_pm02_noviembre = $request->colorados_pm02_noviembre;
        $colorados_pm02_diciembre = $request->colorados_pm02_diciembre;
        $colorados_pm02[0] = $colorados_pm02_enero;
        $colorados_pm02[1] = $colorados_pm02_febrero;
        $colorados_pm02[2] = $colorados_pm02_marzo;
        $colorados_pm02[3] = $colorados_pm02_abril;
        $colorados_pm02[4] = $colorados_pm02_mayo;
        $colorados_pm02[5] = $colorados_pm02_junio;
        $colorados_pm02[6] = $colorados_pm02_julio;
        $colorados_pm02[7] = $colorados_pm02_agosto;
        $colorados_pm02[8] = $colorados_pm02_septiembre;
        $colorados_pm02[9] = $colorados_pm02_octubre;
        $colorados_pm02[10] = $colorados_pm02_noviembre;
        $colorados_pm02[11] = $colorados_pm02_diciembre;

        $colorados_pm03[] = array();
        $colorados_pm03_enero = $request->colorados_pm03_enero;
        $colorados_pm03_febrero = $request->colorados_pm03_febrero;
        $colorados_pm03_marzo = $request->colorados_pm03_marzo;
        $colorados_pm03_abril = $request->colorados_pm03_abril;
        $colorados_pm03_mayo = $request->colorados_pm03_mayo;
        $colorados_pm03_junio = $request->colorados_pm03_junio;
        $colorados_pm03_julio = $request->colorados_pm03_julio;
        $colorados_pm03_agosto = $request->colorados_pm03_agosto;
        $colorados_pm03_septiembre = $request->colorados_pm03_septiembre;
        $colorados_pm03_octubre = $request->colorados_pm03_octubre;
        $colorados_pm03_noviembre = $request->colorados_pm03_noviembre;
        $colorados_pm03_diciembre = $request->colorados_pm03_diciembre;
        $colorados_pm03[0] = $colorados_pm03_enero;
        $colorados_pm03[1] = $colorados_pm03_febrero;
        $colorados_pm03[2] = $colorados_pm03_marzo;
        $colorados_pm03[3] = $colorados_pm03_abril;
        $colorados_pm03[4] = $colorados_pm03_mayo;
        $colorados_pm03[5] = $colorados_pm03_junio;
        $colorados_pm03[6] = $colorados_pm03_julio;
        $colorados_pm03[7] = $colorados_pm03_agosto;
        $colorados_pm03[8] = $colorados_pm03_septiembre;
        $colorados_pm03[9] = $colorados_pm03_octubre;
        $colorados_pm03[10] = $colorados_pm03_noviembre;
        $colorados_pm03[11] = $colorados_pm03_diciembre;

        $graf_hh_colorados_1 = app()->chartjs
        ->name('graf_hh_colorados_1')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Agosto','Septiembre','Octubre','Diciembre'])
        ->datasets([
            [
                "label" => "PM01",
                'borderColor' => "#F7C55F",
                "pointBorderColor" => "#F7C55F",
                "pointBackgroundColor" => "#F7C55F",
                'data' => [$colorados_pm01[0],$colorados_pm01[1],$colorados_pm01[2],$colorados_pm01[3],$colorados_pm01[4],$colorados_pm01[5],$colorados_pm01[6],$colorados_pm01[7],$colorados_pm01[8],$colorados_pm01[9],$colorados_pm01[10],$colorados_pm01[11]],
            ],
            [
                "label" => "PM02",
                'borderColor' => "#48C9A9",
                "pointBorderColor" => "#48C9A9",
                "pointBackgroundColor" => "#48C9A9",
                'data' => [$colorados_pm02[0],$colorados_pm02[1],$colorados_pm02[2],$colorados_pm02[3],$colorados_pm02[4],$colorados_pm02[5],$colorados_pm02[6],$colorados_pm02[7],$colorados_pm02[8],$colorados_pm02[9],$colorados_pm02[10],$colorados_pm02[11]],
            ],
            [
                "label" => "PM03",
                'borderColor' => "#EF5350",
                "pointBorderColor" => "#EF5350",
                "pointBackgroundColor" => "#EF5350",
                'data' => [$colorados_pm03[0],$colorados_pm03[1],$colorados_pm03[2],$colorados_pm03[3],$colorados_pm03[4],$colorados_pm03[5],$colorados_pm03[6],$colorados_pm03[7],$colorados_pm03[8],$colorados_pm03[9],$colorados_pm03[10],$colorados_pm03[11]],
            ]
        ])
        ->options([]);
        
        $graf_hh_colorados_2 = app()->chartjs
        ->name('graf_hh_colorados_2')
        ->type('bar')
        ->size(['width' => 800, 'height' => 400])
        ->labels(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'])
        ->datasets([
            [
                "label" => "PM02",
                'backgroundColor' => "#48C9A9",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$colorados_pm02[0],$colorados_pm02[1],$colorados_pm02[2],$colorados_pm02[3],$colorados_pm02[4],$colorados_pm02[5],$colorados_pm02[6],$colorados_pm02[7],$colorados_pm02[8],$colorados_pm02[9],$colorados_pm02[10],$colorados_pm02[11]],
            ],
            [
                "label" => "PM03",
                'backgroundColor' => "#EF5350",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$colorados_pm03[0],$colorados_pm03[1],$colorados_pm03[2],$colorados_pm03[3],$colorados_pm03[4],$colorados_pm03[5],$colorados_pm03[6],$colorados_pm03[7],$colorados_pm03[8],$colorados_pm03[9],$colorados_pm03[10],$colorados_pm03[11]],
            ]
        ])
        ->options([]);

        return view('estadisticas.reportes.pdf_cho_hh', compact('filtro_pm01','filtro_pm02','filtro_pm03','graf_hh_filtro_1','graf_hh_filtro_2','ect_pm01','ect_pm02','ect_pm03','graf_hh_ect_1','graf_hh_ect_2','colorados_pm01','colorados_pm02','colorados_pm03','graf_hh_colorados_1','graf_hh_colorados_2'));
    }

    public function pdf_area(Request $request) {
        //dd($request->all());
        $area = $request->area;
        $gerencia = $request->gerencia;
        $pm01_r = $request->pm01_r;
        $pm01_nr = $request->pm01_nr;
        $total_pm01_area = $pm01_r + $pm01_nr;
        $pm02_r = $request->pm02_r;
        $pm02_nr = $request->pm02_nr;
        $total_pm02_area = $pm02_r + $pm02_nr;
        $pm03_r = $request->pm03_r;
        $pm03_nr = $request->pm03_nr;
        $total_pm03_area = $pm03_r + $pm03_nr;
        $total_pm02 = $request->total_pm02;
        $total_pm03 = $request->total_pm03;

        $graf_total= app()->chartjs
        ->name('graf_total')
        ->type('pie')
        ->size(['width' => 200, 'height' => 120])
        ->labels(['PM01: '.$total_pm01_area.'','PM02: '.$total_pm02_area.'', 'PM03: '.$total_pm03_area.''])
        ->datasets([
            [
                'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'data' => [$total_pm01_area,$total_pm02_area,$total_pm03_area]
            ]
        ])
        ->options([]);

        return view('estadisticas.reportes.pdf_area', compact('pm01_r','pm01_nr','pm02_r','pm02_nr','pm03_r','pm03_nr','total_pm02','total_pm03','graf_total','gerencia','area'));
    }

    public function pdf_npi(Request $request) {
        //dd($request->all());
        $pm02_si_g1 = $request->pm02_si_g1;
        $pm02_no_g1 = $request->pm02_no_g1;
        $pm02_g1 = $request->pm02_g1;
        $pm03_g1 = $request->pm03_g1;

        $pm01_si_g1 = $request->pm01_si_g1;
        $pm01_no_g1 = $request->pm01_no_g1;
        $pm02_r_g1 = $request->pm02_r_g1;
        $pm02_nr_g1 = $request->pm02_nr_g1;
        $pm03_si_g1 = $request->pm03_si_g1;
        $pm03_no_g1 = $request->pm03_no_g1;

        $ews_pm01_r = $request->ews_pm01_r;
        $ews_pm01_nr = $request->ews_pm01_nr;
        $ews_pm02_r = $request->ews_pm02_r;
        $ews_pm02_nr = $request->ews_pm02_nr;
        $ews_pm03_r = $request->ews_pm03_r;
        $ews_pm03_nr = $request->ews_pm03_nr;
        $total_ews_pm02 = $request->total_ews_pm02;
        $total_ews_pm03 = $request->total_ews_pm03;
        $pcda_pm01_r = $request->pcda_pm01_r;
        $pcda_pm01_nr = $request->pcda_pm01_nr;
        $pcda_pm02_r = $request->pcda_pm02_r;
        $pcda_pm02_nr = $request->pcda_pm02_nr;
        $pcda_pm03_r = $request->pcda_pm03_r;
        $pcda_pm03_nr = $request->pcda_pm03_nr;
        $total_pcda_pm02 = $request->total_pcda_pm02;
        $total_pcda_pm03 = $request->total_pcda_pm03;
        $agua_pm01_r = $request->agua_pm01_r;
        $agua_pm01_nr = $request->agua_pm01_nr;
        $agua_pm02_r = $request->agua_pm02_r;
        $agua_pm02_nr = $request->agua_pm02_nr;
        $agua_pm03_r = $request->agua_pm03_r;
        $agua_pm03_nr = $request->agua_pm03_nr;
        $total_agua_pm02 = $request->total_agua_pm02;
        $total_agua_pm03 = $request->total_agua_pm03;

        //CÓDIGO DE LAS GRÁFICAS//
        $graf_pm02_g1 = app()->chartjs
        ->name('graf_pm02_g1')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Realizadas: '.$pm02_si_g1.'', 'No Realizadas: '.$pm02_no_g1.''])
        ->datasets([
            [
                'backgroundColor' => ['#BDBDBD', '#D7CCC8'],
                'hoverBackgroundColor' => ['#BDBDBD', '#D7CCC8'],
                'data' => [$pm02_si_g1, $pm02_no_g1]
            ]
        ])
        ->options([]);

        $graf_act_pm02_vs_act_pm03_g1 = app()->chartjs
        ->name('graf_act_pm02_vs_act_pm03_g1')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['TOTAL PM02: '.$pm02_g1.'', 'TOTAL PM03: '.$pm03_g1.''])
        ->datasets([
            [
                'backgroundColor' => ['#48C9A9','#EF5350'],
                'hoverBackgroundColor' => ['#48C9A9','#EF5350'],
                'data' => [$pm02_g1, $pm03_g1]
            ]
        ])
        ->options([]);
        $pm01_g1=$pm01_si_g1+$pm01_no_g1;//total de pm01 en NPI
        $pm02_g1=$pm02_nr_g1+$pm02_r_g1;//total de pm02 en NPI
        $pm03_g1=$pm03_si_g1+$pm03_no_g1;//total de pm03 en NPI
        $graf_total_act_g1 = app()->chartjs
        ->name('graf_total_act_g1')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['PM01','PM02', 'PM03'])
        ->datasets([
            [
                'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'data' => [$pm01_g1,$pm02_g1, $pm03_g1]
            ]
        ])
        ->options([]);
        $total_pm01_ews = $ews_pm01_r + $ews_pm01_nr;
        $total_pm02_ews = $ews_pm02_r + $ews_pm02_nr;
        $total_pm03_ews = $ews_pm03_r + $ews_pm03_nr;
        $graf_total_ews= app()->chartjs
        ->name('graf_total_ews')
        ->type('pie')
        ->size(['width' => 200, 'height' => 120])
        ->labels(['PM01','PM02', 'PM03'])
        ->datasets([
            [
                'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'data' => [$total_pm01_ews,$total_pm02_ews, $total_pm03_ews]
            ]
        ])
        ->options([]);

        $total_pm01_planta = $pcda_pm01_r + $pcda_pm01_nr;
        $total_pm02_planta = $pcda_pm02_r + $pcda_pm02_nr;
        $total_pm03_planta = $pcda_pm03_r + $pcda_pm03_nr;
        $graf_total_planta= app()->chartjs
        ->name('graf_total_planta')
        ->type('pie')
        ->size(['width' => 200, 'height' => 120])
        ->labels(['PM01','PM02', 'PM03'])
        ->datasets([
            [
                'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'data' => [$total_pm01_planta,$total_pm02_planta, $total_pm03_planta]
            ]
        ])
        ->options([]);

        $total_pm01_agua = $agua_pm01_r + $agua_pm01_nr;
        $total_pm02_agua = $agua_pm02_r + $agua_pm02_nr;
        $total_pm03_agua = $agua_pm03_r + $agua_pm03_nr;
        $graf_total_agua= app()->chartjs
        ->name('graf_total_agua')
        ->type('pie')
        ->size(['width' => 200, 'height' => 120])
        ->labels(['PM01','PM02', 'PM03'])
        ->datasets([
            [
                'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'data' => [$total_pm01_agua,$total_pm02_agua, $total_pm03_agua]
            ]
        ])
        ->options([]);

        $semana = $request->semana;
        $fecha = $request->fecha;

        return view('estadisticas.reportes.pdf_npi', compact('pm02_si_g1','pm02_no_g1','pm02_g1','pm03_g1','pm01_si_g1','pm01_no_g1','pm02_r_g1','pm02_nr_g1','pm03_si_g1','pm03_no_g1','ews_pm01_r','ews_pm01_nr','ews_pm02_r','ews_pm02_nr','ews_pm03_r','ews_pm03_nr','total_ews_pm02','total_ews_pm03','pcda_pm01_r','pcda_pm01_nr','pcda_pm02_r','pcda_pm02_nr','pcda_pm03_r','pcda_pm03_nr','total_pcda_pm02','total_pcda_pm03','agua_pm01_r','agua_pm01_nr','agua_pm02_r','agua_pm02_nr','agua_pm03_r','agua_pm03_nr','total_agua_pm02','total_agua_pm03','graf_pm02_g1','graf_act_pm02_vs_act_pm03_g1','graf_total_act_g1','graf_total_ews','graf_total_planta','graf_total_agua','semana','fecha'));
    }

    public function pdf_cho(Request $request) {
        //dd($request->all());
        $pm02_si_g2 = $request->pm02_si_g2;
        $pm02_no_g2 = $request->pm02_no_g2;
        $pm02_g2 = $request->pm02_g2;
        $pm03_g2 = $request->pm03_g2;

        $pm01_si_g2 = $request->pm01_si_g2;
        $pm01_no_g2 = $request->pm01_no_g2;
        $pm02_r_g2 = $request->pm02_r_g2;
        $pm02_nr_g2 = $request->pm02_nr_g2;
        $pm03_si_g2 = $request->pm03_si_g2;
        $pm03_no_g2 = $request->pm03_no_g2;

        $filtro_pm01_r = $request->filtro_pm01_r;
        $filtro_pm01_nr = $request->filtro_pm01_nr;
        $filtro_pm02_r = $request->filtro_pm02_r;
        $filtro_pm02_nr = $request->filtro_pm02_nr;
        $filtro_pm03_r = $request->filtro_pm03_r;
        $filtro_pm03_nr = $request->filtro_pm03_nr;
        $total_filtro_pm02 = $request->total_filtro_pm02;
        $total_filtro_pm03 = $request->total_filtro_pm03;
        $ect_pm01_r = $request->ect_pm01_r;
        $ect_pm01_nr = $request->ect_pm01_nr;
        $ect_pm02_r = $request->ect_pm02_r;
        $ect_pm02_nr = $request->ect_pm02_nr;
        $ect_pm03_r = $request->ect_pm03_r;
        $ect_pm03_nr = $request->ect_pm03_nr;
        $total_ect_pm02 = $request->total_ect_pm02;
        $total_ect_pm03 = $request->total_ect_pm03;
        $colorados_pm01_r = $request->colorados_pm01_r;
        $colorados_pm01_nr = $request->colorados_pm01_nr;
        $colorados_pm02_r = $request->colorados_pm02_r;
        $colorados_pm02_nr = $request->colorados_pm02_nr;
        $colorados_pm03_r = $request->colorados_pm03_r;
        $colorados_pm03_nr = $request->colorados_pm03_nr;
        $total_colorados_pm02 = $request->total_colorados_pm02;
        $total_colorados_pm03 = $request->total_colorados_pm03;

        //CÓDIGO DE LAS GRÁFICAS//
        $graf_pm02_g2 = app()->chartjs
        ->name('graf_pm02_g2')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['Realizadas: ', 'No Realizadas: '])
        ->datasets([
            [
                'backgroundColor' => ['#BDBDBD', '#D7CCC8'],
                'hoverBackgroundColor' => ['#BDBDBD', '#D7CCC8'],
                'data' => [$pm02_si_g2, $pm02_no_g2]
            ]
        ])
        ->options([]);

        $graf_act_pm02_vs_act_pm03_g2 = app()->chartjs
        ->name('graf_act_pm02_vs_act_pm03_g2')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['TOTAL PM02', 'TOTAL PM03'])
        ->datasets([
            [
                'backgroundColor' => ['#48C9A9','#EF5350'],
                'hoverBackgroundColor' => ['#48C9A9','#EF5350'],
                'data' => [$pm02_g2, $pm03_g2]
            ]
        ])
        ->options([]);
        $pm01_g2=$pm01_si_g2+$pm01_no_g2;//total de pm01 en NPI
        $pm02_g2=$pm02_nr_g2+$pm02_r_g2;//total de pm02 en NPI
        $pm03_g2=$pm03_si_g2+$pm03_no_g2;//total de pm03 en NPI
        $graf_total_act_g2 = app()->chartjs
        ->name('graf_total_act_g2')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['PM01','PM02', 'PM03'])
        ->datasets([
            [
                'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'data' => [$pm01_g2,$pm02_g2, $pm03_g2]
            ]
        ])
        ->options([]);
        $total_pm01_filtro = $filtro_pm01_r + $filtro_pm01_nr;
        $total_pm02_filtro = $filtro_pm02_r + $filtro_pm02_nr;
        $total_pm03_filtro = $filtro_pm03_r + $filtro_pm03_nr;
        $graf_total_filtro= app()->chartjs
        ->name('graf_total_filtro')
        ->type('pie')
        ->size(['width' => 200, 'height' => 120])
        ->labels(['PM01','PM02', 'PM03'])
        ->datasets([
            [
                'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'data' => [$total_pm01_filtro,$total_pm02_filtro, $total_pm03_filtro]
            ]
        ])
        ->options([]);

        $total_pm01_ect = $ect_pm01_r + $ect_pm01_nr;
        $total_pm02_ect = $ect_pm02_r + $ect_pm02_nr;
        $total_pm03_ect = $ect_pm03_r + $ect_pm03_nr;
        $graf_total_ect= app()->chartjs
        ->name('graf_total_ect')
        ->type('pie')
        ->size(['width' => 200, 'height' => 120])
        ->labels(['PM01','PM02', 'PM03'])
        ->datasets([
            [
                'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'data' => [$total_pm01_ect,$total_pm02_ect, $total_pm03_ect]
            ]
        ])
        ->options([]);

        $total_pm01_colorados = $colorados_pm01_r + $colorados_pm01_nr;
        $total_pm02_colorados = $colorados_pm02_r + $colorados_pm02_nr;
        $total_pm03_colorados = $colorados_pm03_r + $colorados_pm03_nr;
        $graf_total_colorados= app()->chartjs
        ->name('graf_total_colorados')
        ->type('pie')
        ->size(['width' => 200, 'height' => 120])
        ->labels(['PM01','PM02', 'PM03'])
        ->datasets([
            [
                'backgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'hoverBackgroundColor' => ['#F7C55F', '#48C9A9','#EF5350'],
                'data' => [$total_pm01_colorados,$total_pm02_colorados, $total_pm03_colorados]
            ]
        ])
        ->options([]);

        $semana = $request->semana;
        $fecha = $request->fecha;
        return view('estadisticas.reportes.pdf_cho', compact('pm02_si_g2','pm02_no_g2','pm02_g2','pm03_g2','pm01_si_g2','pm01_no_g2','pm02_r_g2','pm02_nr_g2','pm03_si_g2','pm03_no_g2','filtro_pm01_r','filtro_pm01_nr','filtro_pm02_r','filtro_pm02_nr','filtro_pm03_r','filtro_pm03_nr','total_filtro_pm02','total_filtro_pm03','ect_pm01_r','ect_pm01_nr','ect_pm02_r','ect_pm02_nr','ect_pm03_r','ect_pm03_nr','total_ect_pm02','total_ect_pm03','colorados_pm01_r','colorados_pm01_nr','colorados_pm02_r','colorados_pm02_nr','colorados_pm03_r','colorados_pm03_nr','total_colorados_pm02','total_colorados_pm03','graf_pm02_g2','graf_act_pm02_vs_act_pm03_g2','graf_total_act_g2','graf_total_filtro','graf_total_ect','graf_total_colorados','semana','fecha'));
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

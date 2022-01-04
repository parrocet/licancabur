<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleados;
use App\Areas;
use App\Actividades;
use App\ActividadesProceso;
use App\Planificacion;
use App\Notas;
use App\Muro;
use App\Novedades;
use App\Avisos;
use Mail;
date_default_timezone_set('UTC');
ini_set('max_execution_time', 3000);
set_time_limit(3000);

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    protected function conexion()
    {
        $connected = @fopen("http://www.google.com:80/","r"); 

        if($connected) { return true; } else { return false; }
        
    }
    public function index(Request $request)
    {
        //ajustando año para operaciones
        if(session('fecha_actual')){
            $anio=session('fecha_actual');
        }else{
            $anio=date('Y');
            $request->session()->put('fecha_actual', $anio);
            session(['fecha_actual' => $anio]);
        }
        //-----------------------------
        if ($this->conexion()) {
             
         if(\Auth::user()->tipo_user!="Empleado"){

            $this->envio_avisos();
            }
         } else {
            if(\Auth::user()->tipo_user!="Empleado"){
                flash('<i class="fa fa-check-circle"></i> No hay conexión a Internet para el envio de avisos!')->warning()->important();
            }
         }
            //dd("+++++");
        $dia=dia(date(session('fecha_actual').'-m-d'));
        $novedades=Novedades::where('id','<>',0)->orderBy('created_at','DESC')->get();

        $fecha1=date(session('fecha_actual')."-m-d");
        $fecha2=date(session('fecha_actual')."-m-d",strtotime($fecha1."- 1 days"));
        $fecha3=date(session('fecha_actual')."-m-d",strtotime($fecha1."- 2 days"));
        $fecha4=date(session('fecha_actual')."-m-d",strtotime($fecha1."- 3 days"));

        $fechaNove=Novedades::where('fecha',[$fecha1,$fecha2,$fecha3,$fecha4])->groupBy('fecha')->get();
        // dd(count($fechaNove));
        // dd($fecha1, $fecha2, $fecha3, $fecha4);
        $muro=Muro::all();
        if (\Auth::User()->tipo_user!="Empleado" || \Auth::User()->tipo_user!="Admin de Empleado") {

            //obteniendo id_empleado
            $empleado=Empleados::where('id_usuario',\Auth::User()->id)->first();
            //conteo de horas
            //areas registradas
            $mis_areas=Areas::all();
            //variables de conteo
            $dp=array();//arreglo para la duracion proyectada
            $dr=array();//arreglo para la duracion real
            $totaldp=0;
            $totaldr=0;
            $i=0;
            //inicializando
            foreach ($mis_areas as $key) {
                $dp[$i]=0;
                $dr[$i]=0;
                $i++;
            }
            
            //consultando actividades asignadas
            if (!is_null($empleado)) {
                

            $buscar=\DB::table('actividades_proceso')->join('actividades','actividades.id','actividades_proceso.id_actividad')->join('empleados','empleados.id','actividades_proceso.id_empleado')->where('id_empleado',$empleado->id)->where('actividades.dia',$dia)->select('actividades.duracion_pro','actividades.duracion_real','actividades.id_area')->get();
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

            //fin del conteo de duraciones
            # code...
                //dd("dfghjk");
            $lista_empleado=Empleados::all();
            $empleados=Empleados::all();
            $areas=Areas::all();
            $hallado=0;
            $actividades=Actividades::all();
            $hoy=date(session('fecha_actual').'-m-d');
            $notas=Notas::where('id_empleado',\Auth::User()->id)->get();
            $num_notas=count($notas);
            //--- buscando planificacion actual
            $fechaHoy = date(session('fecha_actual').'-m-d');
            $num_dia=num_dia($fechaHoy);
            $num_semana_actual=date('W', strtotime($fechaHoy));
            if ($num_dia==1 || $num_dia==2) {
                $num_semana_actual--;
            }

            $planificacion1 = Planificacion::where('semana',$num_semana_actual)->where('id_gerencia',1)->where('anio',session('fecha_actual'))->first();
            if (is_null($planificacion1)) {
                $id_planificacion1=0;
            } else {
                $id_planificacion1=$planificacion1->id;
            }
            $planificacion2 = Planificacion::where('semana',$num_semana_actual)->where('id_gerencia',2)->where('anio',session('fecha_actual'))->first();

            if (is_null($planificacion2)) {
                $id_planificacion2=0;
            } else {
                $id_planificacion2=$planificacion2->id;
            }
            //-----------
            $actividadesProceso=\DB::table('actividades_proceso')->join('actividades','actividades.id','actividades_proceso.id_actividad')->join('planificacion','planificacion.id','actividades.id_planificacion')->select('actividades.*','actividades_proceso.*')->where('planificacion.semana',$num_semana_actual)->where('planificacion.anio',session('fecha_actual'))->get();
            // dd($num_semana_actual);
            //$actividadesProceso=ActividadesProceso::all();
            //------------------calculo de totales para el usuario MEL----------

            $fechaHoy = date(session('fecha_actual').'-m-d');
            $num_dia=num_dia($fechaHoy);
            $num_semana_actual=date('W', strtotime($fechaHoy));
            if ($num_dia==1 || $num_dia==2) {
                $num_semana_actual--;
            }
            $ews[] = array();
            $pcda[] = array();
            $agua[] = array();
            $filtro[] = array();
            $ect[] = array();
            $colorados[] = array();
            //--------------------------------------
            //------- obteniendo para la gerencia 1---------------
            $planificacion=Planificacion::where('id_gerencia',1)->where('semana',$num_semana_actual)->where('anio',session('fecha_actual'))->first();
            //dd($planificacion);
            if (is_null($planificacion)) {
                $id_planificacion=0;
            } else {
                $id_planificacion=$planificacion1->id;
            }
            $planificacion2=Planificacion::where('id_gerencia',2)->where('semana',$num_semana_actual)->where('anio',session('fecha_actual'))->first();
            if (is_null($planificacion2)) {
                $id_planificacion2=0;
            } else {
                $id_planificacion2=$id_planificacion2;
            }
            //------------EWS----------------
                $total_pm01=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',1)->where('tipo','PM01')->count();
                $total_pm01_ews= $total_pm01;
                $total_pm01_si=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',1)->where('tipo','PM01')->where('realizada','Si')->count();
                $total_pm01_no=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',1)->where('tipo','PM01')->where('realizada','No')->count();
                $ews[0]=$total_pm01;
                $ews[1]=$total_pm01_si;
                $ews[2]=$total_pm01_no;

                $total_pm02=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',1)->where('tipo','PM02')->count();
                $total_pm02_ews= $total_pm02;
                $total_pm02_si=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',1)->where('tipo','PM02')->where('realizada','Si')->count();
                $total_pm02_no=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',1)->where('tipo','PM02')->where('realizada','No')->count();
                $ews[3]=$total_pm02;
                $ews[4]=$total_pm02_si;
                $ews[5]=$total_pm02_no;

                $total_pm03=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',1)->where('tipo','PM03')->count();
                $total_pm03_ews= $total_pm03;
                $total_pm03_si=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',1)->where('tipo','PM03')->where('realizada','Si')->count();
                $total_pm03_no=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',1)->where('tipo','PM03')->where('realizada','No')->count();
                $ews[6]=$total_pm03;
                $ews[7]=$total_pm03_si;
                $ews[8]=$total_pm03_no;

                $total_pm04=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',1)->where('tipo','PM04')->count();
                $total_pm04_si=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',1)->where('tipo','PM04')->where('realizada','Si')->count();
                $total_pm04_no=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',1)->where('tipo','PM04')->where('realizada','No')->count();
                $ews[9]=$total_pm04;
                $ews[10]=$total_pm04_si;
                $ews[11]=$total_pm04_no;
            //---------FIN DE EWS------------
            //------------Planta Cero----------------
                $total_pm01=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',2)->where('tipo','PM01')->count();
                $total_pm01_planta=$total_pm01;
                $total_pm01_si=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',2)->where('tipo','PM01')->where('realizada','Si')->count();
                $total_pm01_no=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',2)->where('tipo','PM01')->where('realizada','No')->count();
                $pcda[0]=$total_pm01;
                $pcda[1]=$total_pm01_si;
                $pcda[2]=$total_pm01_no;

                $total_pm02=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',2)->where('tipo','PM02')->count();
                $total_pm02_planta=$total_pm02;
                $total_pm02_si=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',2)->where('tipo','PM02')->where('realizada','Si')->count();
                $total_pm02_no=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',2)->where('tipo','PM02')->where('realizada','No')->count();
                $pcda[3]=$total_pm02;
                $pcda[4]=$total_pm02_si;
                $pcda[5]=$total_pm02_no;

                $total_pm03=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',2)->where('tipo','PM03')->count();
                $total_pm03_planta=$total_pm03;
                $total_pm03_si=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',2)->where('tipo','PM03')->where('realizada','Si')->count();
                $total_pm03_no=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',2)->where('tipo','PM03')->where('realizada','No')->count();
                $pcda[6]=$total_pm03;
                $pcda[7]=$total_pm03_si;
                $pcda[8]=$total_pm03_no;

                $total_pm04=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',2)->where('tipo','PM04')->count();
                $total_pm04_si=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',2)->where('tipo','PM04')->where('realizada','Si')->count();
                $total_pm04_no=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',2)->where('tipo','PM04')->where('realizada','No')->count();
                $pcda[9]=$total_pm04;
                $pcda[10]=$total_pm04_si;
                $pcda[11]=$total_pm04_no;
            //---------FIN DE Planta Cero------------
            //------------Agua y tranque----------------
                $total_pm01=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',3)->where('tipo','PM01')->count();
                $total_pm01_agua=$total_pm01;
                $total_pm01_si=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',3)->where('tipo','PM01')->where('realizada','Si')->count();
                $total_pm01_no=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',3)->where('tipo','PM01')->where('realizada','No')->count();
                $agua[0]=$total_pm01;
                $agua[1]=$total_pm01_si;
                $agua[2]=$total_pm01_no;

                $total_pm02=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',3)->where('tipo','PM02')->count();
                $total_pm02_agua=$total_pm02;
                $total_pm02_si=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',3)->where('tipo','PM02')->where('realizada','Si')->count();
                $total_pm02_no=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',3)->where('tipo','PM02')->where('realizada','No')->count();
                $agua[3]=$total_pm02;
                $agua[4]=$total_pm02_si;
                $agua[5]=$total_pm02_no;

                $total_pm03=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',3)->where('tipo','PM03')->count();
                $total_pm03_agua=$total_pm03;
                $total_pm03_si=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',3)->where('tipo','PM03')->where('realizada','Si')->count();
                $total_pm03_no=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',3)->where('tipo','PM03')->where('realizada','No')->count();
                $agua[6]=$total_pm03;
                $agua[7]=$total_pm03_si;
                $agua[8]=$total_pm03_no;

                $total_pm04=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',3)->where('tipo','PM04')->count();
                $total_pm04_si=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',3)->where('tipo','PM04')->where('realizada','Si')->count();
                $total_pm04_no=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',3)->where('tipo','PM04')->where('realizada','No')->count();
                $agua[9]=$total_pm04;
                $agua[10]=$total_pm04_si;
                $agua[11]=$total_pm04_no;
            //---------FIN DE AGUA Y TRANQUE------------
            //------------FILTRO Y PUERTO----------------
                $total_pm01=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',4)->where('tipo','PM01')->count();
                $total_pm01_filtro=$total_pm01;
                $total_pm01_si=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',4)->where('tipo','PM01')->where('realizada','Si')->count();
                $total_pm01_no=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',4)->where('tipo','PM01')->where('realizada','No')->count();
                $filtro[0]=$total_pm01;
                $filtro[1]=$total_pm01_si;
                $filtro[2]=$total_pm01_no;

                $total_pm02=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',4)->where('tipo','PM02')->count();
                $total_pm02_filtro=$total_pm02;
                $total_pm02_si=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',4)->where('tipo','PM02')->where('realizada','Si')->count();
                $total_pm02_no=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',4)->where('tipo','PM02')->where('realizada','No')->count();
                $filtro[3]=$total_pm02;
                $filtro[4]=$total_pm02_si;
                $filtro[5]=$total_pm02_no;

                $total_pm03=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',4)->where('tipo','PM03')->count();
                $total_pm03_filtro=$total_pm03;
                $total_pm03_si=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',4)->where('tipo','PM03')->where('realizada','Si')->count();
                $total_pm03_no=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',4)->where('tipo','PM03')->where('realizada','No')->count();
                $filtro[6]=$total_pm03;
                $filtro[7]=$total_pm03_si;
                $filtro[8]=$total_pm03_no;

                $total_pm04=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',4)->where('tipo','PM04')->count();
                $total_pm04_si=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',4)->where('tipo','PM04')->where('realizada','Si')->count();
                $total_pm04_no=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',4)->where('tipo','PM04')->where('realizada','No')->count();
                $filtro[9]=$total_pm04;
                $filtro[10]=$total_pm04_si;
                $filtro[11]=$total_pm04_no;
            //---------FIN DE FILTRO Y PUERTO------------
            //------------ECT----------------
                $total_pm01=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',5)->where('tipo','PM01')->count();
                $total_pm01_ECT=$total_pm01;
                $total_pm01_si=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',5)->where('tipo','PM01')->where('realizada','Si')->count();
                $total_pm01_no=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',5)->where('tipo','PM01')->where('realizada','No')->count();
                $ect[0]=$total_pm01;
                $ect[1]=$total_pm01_si;
                $ect[2]=$total_pm01_no;

                $total_pm02=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',5)->where('tipo','PM02')->count();
                $total_pm02_ECT=$total_pm02;
                $total_pm02_si=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',5)->where('tipo','PM02')->where('realizada','Si')->count();
                $total_pm02_no=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',5)->where('tipo','PM02')->where('realizada','No')->count();
                $ect[3]=$total_pm02;
                $ect[4]=$total_pm02_si;
                $ect[5]=$total_pm02_no;

                $total_pm03=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',5)->where('tipo','PM03')->count();
                $total_pm03_ECT=$total_pm03;
                $total_pm03_si=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',5)->where('tipo','PM03')->where('realizada','Si')->count();
                $total_pm03_no=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',5)->where('tipo','PM03')->where('realizada','No')->count();
                $ect[6]=$total_pm03;
                $ect[7]=$total_pm03_si;
                $ect[8]=$total_pm03_no;

                $total_pm04=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',5)->where('tipo','PM04')->count();
                $total_pm04_si=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',5)->where('tipo','PM04')->where('realizada','Si')->count();
                $total_pm04_no=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',5)->where('tipo','PM04')->where('realizada','No')->count();
                $ect[9]=$total_pm04;
                $ect[10]=$total_pm04_si;
                $ect[11]=$total_pm04_no;
            //---------FIN DE ECT------------
            //------------LOS COLORADOS----------------
                $total_pm01=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',6)->where('tipo','PM01')->count();
                $total_pm01_colorados=$total_pm01;
                $total_pm01_si=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',6)->where('tipo','PM01')->where('realizada','Si')->count();
                $total_pm01_no=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',6)->where('tipo','PM01')->where('realizada','No')->count();
                $colorados[0]=$total_pm01;
                $colorados[1]=$total_pm01_si;
                $colorados[2]=$total_pm01_no;

                $total_pm02=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',6)->where('tipo','PM02')->count();
                $total_pm02_colorados=$total_pm02;
                $total_pm02_si=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',6)->where('tipo','PM02')->where('realizada','Si')->count();
                $total_pm02_no=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',6)->where('tipo','PM02')->where('realizada','No')->count();
                $colorados[3]=$total_pm02;
                $colorados[4]=$total_pm02_si;
                $colorados[5]=$total_pm02_no;

                $total_pm03=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',6)->where('tipo','PM03')->count();
                $total_pm03_colorados=$total_pm03;
                $total_pm03_si=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',6)->where('tipo','PM03')->where('realizada','Si')->count();
                $total_pm03_no=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',6)->where('tipo','PM03')->where('realizada','No')->count();
                $colorados[6]=$total_pm03;
                $colorados[7]=$total_pm03_si;
                $colorados[8]=$total_pm03_no;

                $total_pm04=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',6)->where('tipo','PM04')->count();
                $total_pm04_si=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',6)->where('tipo','PM04')->where('realizada','Si')->count();
                $total_pm04_no=Actividades::where('id_planificacion',$id_planificacion2)->where('id_area',6)->where('tipo','PM04')->where('realizada','No')->count();
                $colorados[9]=$total_pm04;
                $colorados[10]=$total_pm04_si;
                $colorados[11]=$total_pm04_no;
            //---------FIN DE LOS COLORADOS------------

            //---------------------------fin del calculo de totales----------------
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
            
            $graf_pm02_g1 = app()->chartjs
                ->name('pieChartTest6')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['No Realizadas: ', 'Realizadas: '])
                ->datasets([
                    [
                        'backgroundColor' => ['orange', 'green'],
                        'hoverBackgroundColor' => ['orange', 'green'],
                        'data' => [$pm02_no_g1, $pm02_si_g1]
                    ]
                ])
                ->options([]);
                //grafica de PM02 vs PM03
            $graf_pm02_vs_pm03_g1 = app()->chartjs
                ->name('pieChartTest7')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['TOTAL PM02', 'TOTAL PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['orange', 'green'],
                        'hoverBackgroundColor' => ['orange', 'green'],
                        'data' => [$pm02_g1, $pm03_g1]
                    ]
                ])
                ->options([]);
            $graf_pm01_vs_pm02_vs_pm03_g1 = app()->chartjs
                ->name('pieChartTest8')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['orange', 'green','blue'],
                        'hoverBackgroundColor' => ['orange', 'green','blue'],
                        'data' => [$pm01_g1,$pm02_g1, $pm03_g1]
                    ]
                ])
                ->options([]);
            $graficoTotalEWS= app()->chartjs
                ->name('pieChartTest13')
                ->type('pie')
                ->size(['width' => 200, 'height' => 200])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['orange', 'green','blue'],
                        'hoverBackgroundColor' => ['orange', 'green','blue'],
                        'data' => [$total_pm01_ews,$total_pm02_ews, $total_pm03_ews]
                    ]
                ])
                ->options([]);

            $graficoTotalPlanta= app()->chartjs
                ->name('pieChartTest14')
                ->type('pie')
                ->size(['width' => 200, 'height' => 200])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['orange', 'green','blue'],
                        'hoverBackgroundColor' => ['orange', 'green','blue'],
                        'data' => [$total_pm01_planta,$total_pm02_planta, $total_pm03_planta]
                    ]
                ])
                ->options([]);

            $graficoTotalAgua= app()->chartjs
                ->name('pieChartTest15')
                ->type('pie')
                ->size(['width' => 200, 'height' => 200])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['orange', 'green','blue'],
                        'hoverBackgroundColor' => ['orange', 'green','blue'],
                        'data' => [$total_pm01_agua,$total_pm02_agua, $total_pm03_agua]
                    ]
                ])
                ->options([]);
                //---------fin de totales y graficos de NPI
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
            //primera grafica de PM02 si y no en NPI
            $graf_pm02_g2 = app()->chartjs
                ->name('pieChartTest9')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['No Realizadas: ', 'Realizadas: '])
                ->datasets([
                    [
                        'backgroundColor' => ['orange', 'green'],
                        'hoverBackgroundColor' => ['orange', 'green'],
                        'data' => [$pm02_no_g2, $pm02_si_g2]
                    ]
                ])
                ->options([]);
                //grafica de PM02 vs PM03
            $graf_pm02_vs_pm03_g2 = app()->chartjs
                ->name('pieChartTest10')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['TOTAL PM02', 'TOTAL PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['orange', 'green'],
                        'hoverBackgroundColor' => ['orange', 'green'],
                        'data' => [$pm02_g2, $pm03_g2]
                    ]
                ])
                ->options([]);
            $graf_pm01_vs_pm02_vs_pm03_g2 = app()->chartjs
                ->name('pieChartTest11')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['orange', 'green','blue'],
                        'hoverBackgroundColor' => ['orange', 'green','blue'],
                        'data' => [$pm01_g2,$pm02_g2, $pm03_g2]
                    ]
                ])
                ->options([]);

            $graficoTotalFiltro= app()->chartjs
                ->name('pieChartTest16')
                ->type('pie')
                ->size(['width' => 200, 'height' => 200])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['orange', 'green','blue'],
                        'hoverBackgroundColor' => ['orange', 'green','blue'],
                        'data' => [$total_pm01_filtro,$total_pm02_filtro, $total_pm03_filtro]
                    ]
                ])
                ->options([]);

            $graficoTotalECT= app()->chartjs
                ->name('pieChartTest17')
                ->type('pie')
                ->size(['width' => 200, 'height' => 200])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['orange', 'green','blue'],
                        'hoverBackgroundColor' => ['orange', 'green','blue'],
                        'data' => [$total_pm01_ECT,$total_pm02_ECT, $total_pm03_ECT]
                    ]
                ])
                ->options([]);

            $graficoTotalColorados= app()->chartjs
                ->name('pieChartTest18')
                ->type('pie')
                ->size(['width' => 200, 'height' => 200])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['orange', 'green','blue'],
                        'hoverBackgroundColor' => ['orange', 'green','blue'],
                        'data' => [$total_pm01_colorados,$total_pm02_colorados, $total_pm03_colorados]
                    ]
                ])
                ->options([]);

            //----- fin de totales y graficos de CHO
            //-------TOTALES NPI VS CHO
            $PM01TotalGrafica= $pm01_g1 + $pm01_g2;
            $PM02TotalGrafica= $pm02_g1 + $pm02_g2;
            $PM03TotalGrafica= $pm03_g1 + $pm03_g2;



            $graficoTotalPM01_02_03 = app()->chartjs
                ->name('pieChartTest12')
                ->type('pie')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['PM01','PM02', 'PM03'])
                ->datasets([
                    [
                        'backgroundColor' => ['orange', 'green','blue'],
                        'hoverBackgroundColor' => ['orange', 'green','blue'],
                        'data' => [$PM01TotalGrafica,$PM02TotalGrafica, $PM03TotalGrafica]
                    ]
                ])
                ->options([]);

            //--- FIN DE TOTALES NPI VS CHO
            return view('home', compact('empleados','areas','hallado','lista_empleado','actividades','hoy','id_planificacion1','id_planificacion2','notas','num_notas','actividadesProceso','muro','novedades','fechaNove','fecha2','fecha3','fecha4','dr','dp','totaldp','totaldr','num_semana_actual','ews','pcda','agua','filtro','ect','colorados','pm01_si_g1','pm01_no_g1','pm02_si_g1','pm02_no_g1','pm03_si_g1','pm03_no_g1','pm01_g1','pm02_g1','pm03_g1','graf_pm02_g1','graf_pm02_vs_pm03_g1','graf_pm01_vs_pm02_vs_pm03_g1','pm01_si_g2','pm01_no_g2','pm02_si_g2','pm02_no_g2','pm03_si_g2','pm03_no_g2','pm01_g2','pm02_g2','pm03_g2','graf_pm02_g2','graf_pm02_vs_pm03_g2','graf_pm01_vs_pm02_vs_pm03_g2','graficoTotalPM01_02_03','graficoTotalEWS','graficoTotalPlanta','graficoTotalAgua','graficoTotalFiltro','graficoTotalECT','graficoTotalColorados'));
        } elseif (\Auth::User()->tipo_user=="Empleado") {
            //obteniendo id_empleado
                if (!is_null($empleado)) {
                

            $buscar=\DB::table('actividades_proceso')->join('actividades','actividades.id','actividades_proceso.id_actividad')->join('empleados','empleados.id','actividades_proceso.id_empleado')->where('id_empleado',$empleado->id)->where('actividades.dia',$dia)->select('actividades.duracion_pro','actividades.duracion_real','actividades.id_area')->get();
            //areas registradas
            $mis_areas=Areas::all();
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
            //fin del conteo de duraciones


            $notas=Notas::where('id_empleado',\Auth::User()->id)->get();
            $num_notas=count($notas);
            $fechaHoy = date(session('fecha_actual').'-m-d');
            $num_dia=num_dia($fechaHoy);
            $num_semana_actual=date('W', strtotime($fechaHoy));
            if ($num_dia==1 || $num_dia==2) {
                $num_semana_actual--;
            }
            
            $actividades=Actividades::select('id_area','id',\DB::raw('task'))->where('tipo','PM02')->groupBy('task')->orderBy('id','DESC')->get();
            $areas=Areas::all();
            $planificacion = Planificacion::where('semana','>=',$num_semana_actual)->where('anio',session('fecha_actual'))->get();

            $empleados = Empleados::where('empleados.email',\Auth::User()->email)->get();

            $empleado=Empleados::where('id_usuario', \Auth::User()->id)->first();
            $actividadesProceso=ActividadesProceso::where('id_empleado',$empleado->id)->get();

            return view('home', compact('empleados','actividades','areas','planificacion','notas','num_notas','actividadesProceso','muro','novedades','fechaNove','fecha2','fecha3','fecha4','dp','dr','totaldp','totaldr'));
        } elseif (\Auth::User()->tipo_user=="Admin de Empleado") {
            //obteniendo id_empleado
                $empleado=Empleados::where('id_usuario',\Auth::User()->id)->first();
            //conteo de horas
            //consultando actividades asignadas
            if (!is_null($empleado)) {
                

            $buscar=\DB::table('actividades_proceso')->join('actividades','actividades.id','actividades_proceso.id_actividad')->join('empleados','empleados.id','actividades_proceso.id_empleado')->where('id_empleado',$empleado->id)->where('actividades.dia',$dia)->select('actividades.duracion_pro','actividades.duracion_real','actividades.id_area')->get();
            //areas registradas
            $mis_areas=Areas::all();
            //variables de conteo
            $dp=array();//arreglo para la duracion proyectada
            $dr=array();//arreglo para la duracion real 
            $totaldp=0;
            $totaldr=0;
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
            //fin del conteo de duraciones
            $contador=1;
            $notas=Notas::where('id_empleado',\Auth::User()->id)->get();
            $num_notas=count($notas);
            $fechaHoy = date(session('fecha_actual').'-m-d');
            $num_dia=num_dia($fechaHoy);
            $num_semana_actual=date('W', strtotime($fechaHoy));
            if ($num_dia==1 || $num_dia==2) {
                $num_semana_actual--;
            }
            
            $actividades=Actividades::select('id_area','id',\DB::raw('task'))->where('tipo','PM02')->groupBy('task')->orderBy('id','DESC')->get();
            $areas=Areas::all();
            $planificacion = Planificacion::where('semana','>=',$num_semana_actual)->where('anio',session('fecha_actual'))->get();

            $empleados = Empleados::where('empleados.email',\Auth::User()->email)->get();

            
            $actividadesProceso=ActividadesProceso::where('id_empleado',$empleado->id)->get();

            return view('home', compact('empleados','actividades','areas','planificacion','notas','num_notas','actividadesProceso','muro','novedades','fechaNove','fecha2','fecha3','fecha4','dr','dp','totaldp','totaldr'));
        }
    }

    public function buscar(Request $request) 
    {
        /*if(session('fecha_actual')){
            $anio=session('fecha_actual');
        }else{
            $anio=date('Y');
        }*/
        //dd('hola');
        $hallado=1;
        $areas=Areas::all();
        $lista_empleado=Empleados::all();
        $hoy=date(session('fecha_actual').'-m-d');
        //--- buscando planificacion actual
        $fechaHoy = date(session('fecha_actual').'-m-d');
        $num_dia=num_dia($fechaHoy);
        $num_semana_actual=date('W', strtotime($fechaHoy));
        if ($num_dia==1 || $num_dia==2) {
            $num_semana_actual--;
        }

        $planificacion1 = Planificacion::where('semana',$num_semana_actual)->where('id_gerencia',1)->where('anio',session('fecha_actual'))->first();
        if (is_null($planificacion1)) {
            $id_planificacion1=0;
        } else {
            $id_planificacion1=$planificacion1->id;
        }
        $planificacion2 = Planificacion::where('semana',$num_semana_actual)->where('id_gerencia',2)->where('anio',session('fecha_actual'))->first();
        if (is_null($planificacion2)) {
            $id_planificacion2=0;
        } else {
            $id_planificacion2=$id_planificacion2;
        }
        //-----------
        if($request->tipo_busqueda=="empleado") {
            $empleados = Empleados::where('empleados.id', [$request->empleado])->get();
        } else if($request->tipo_busqueda=="area"){
            $empleados = Empleados::where('empleados.id_area', [$request->area])->get();
        }
        
        return view('home', compact('empleados','hallado','areas','lista_empleado','hoy','id_planificacion1','id_planificacion2'));
    }

    public function dashboardStadistic()
    {
        /*if(session('fecha_actual')){
            $anio=session('fecha_actual');
        }else{
            $anio=date('Y');
        }*/
        $fechaHoy = date(session('fecha_actual').'-m-d');
        $num_dia=num_dia($fechaHoy);
        $num_semana_actual=date('W', strtotime($fechaHoy));
        if ($num_dia==1 || $num_dia==2) {
            $num_semana_actual--;
        }
        $empleados=Empleados::all()->count();
        $actividades = Actividades::join('planificacion', 'planificacion.id', '=', 'actividades.id_planificacion')
            ->where('planificacion.semana',$num_semana_actual)->where('planificacion.anio',session('fecha_actual'))->count();

        $realizada = Actividades::join('planificacion', 'planificacion.id', '=', 'actividades.id_planificacion')
            ->where('planificacion.semana',$num_semana_actual)
            ->where('actividades.realizada','Si')->where('planificacion.anio',session('fecha_actual'))->count();

        $act_mie = Actividades::join('planificacion', 'planificacion.id', '=', 'actividades.id_planificacion')
            ->where([['planificacion.semana',$num_semana_actual],['actividades.dia','Mié']])->where('planificacion.anio',session('fecha_actual'))->count();
        $act_jue = Actividades::join('planificacion', 'planificacion.id', '=', 'actividades.id_planificacion')
            ->where([['planificacion.semana',$num_semana_actual],['actividades.dia','Jue']])->where('planificacion.anio',session('fecha_actual'))->count();
        $act_vie = Actividades::join('planificacion', 'planificacion.id', '=', 'actividades.id_planificacion')
            ->where([['planificacion.semana',$num_semana_actual],['actividades.dia','Vie']])->where('planificacion.anio',session('fecha_actual'))->count();
        $act_sab = Actividades::join('planificacion', 'planificacion.id', '=', 'actividades.id_planificacion')
            ->where([['planificacion.semana',$num_semana_actual],['actividades.dia','Sáb']])->where('planificacion.anio',session('fecha_actual'))->count();
        $act_dom = Actividades::join('planificacion', 'planificacion.id', '=', 'actividades.id_planificacion')
            ->where([['planificacion.semana',$num_semana_actual],['actividades.dia','Dom']])->where('planificacion.anio',session('fecha_actual'))->count();
        $act_lun = Actividades::join('planificacion', 'planificacion.id', '=', 'actividades.id_planificacion')
            ->where([['planificacion.semana',$num_semana_actual],['actividades.dia','Lun']])->where('planificacion.anio',session('fecha_actual'))->count();
        $act_mar = Actividades::join('planificacion', 'planificacion.id', '=', 'actividades.id_planificacion')
            ->where([['planificacion.semana',$num_semana_actual],['actividades.dia','Mar']])->where('planificacion.anio',session('fecha_actual'))->count();

        $rea_mie = Actividades::join('planificacion', 'planificacion.id', '=', 'actividades.id_planificacion')
            ->where('planificacion.semana',$num_semana_actual)
            ->where([['actividades.realizada','Si'],['actividades.dia','Mié']])->where('planificacion.anio',session('fecha_actual'))->count();
        $rea_jue = Actividades::join('planificacion', 'planificacion.id', '=', 'actividades.id_planificacion')
            ->where('planificacion.semana',$num_semana_actual)
            ->where([['actividades.realizada','Si'],['actividades.dia','Jue']])->where('planificacion.anio',session('fecha_actual'))->count();
        $rea_vie = Actividades::join('planificacion', 'planificacion.id', '=', 'actividades.id_planificacion')
            ->where('planificacion.semana',$num_semana_actual)
            ->where([['actividades.realizada','Si'],['actividades.dia','Vie']])->where('planificacion.anio',session('fecha_actual'))->count();
        $rea_sab = Actividades::join('planificacion', 'planificacion.id', '=', 'actividades.id_planificacion')
            ->where('planificacion.semana',$num_semana_actual)
            ->where([['actividades.realizada','Si'],['actividades.dia','Sáb']])->where('planificacion.anio',session('fecha_actual'))->count();
        $rea_dom = Actividades::join('planificacion', 'planificacion.id', '=', 'actividades.id_planificacion')
            ->where('planificacion.semana',$num_semana_actual)
            ->where([['actividades.realizada','Si'],['actividades.dia','Dom']])->where('planificacion.anio',session('fecha_actual'))->count();
        $rea_lun = Actividades::join('planificacion', 'planificacion.id', '=', 'actividades.id_planificacion')
            ->where('planificacion.semana',$num_semana_actual)
            ->where([['actividades.realizada','Si'],['actividades.dia','Lun']])->where('planificacion.anio',session('fecha_actual'))->count();
        $rea_mar = Actividades::join('planificacion', 'planificacion.id', '=', 'actividades.id_planificacion')
            ->where('planificacion.semana',$num_semana_actual)
            ->where([['actividades.realizada','Si'],['actividades.dia','Mar']])->where('planificacion.anio',session('fecha_actual'))->count();

        $chartjs = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 200])
        ->labels(["Miércoles", "Jueves", "Viernes", "Sábado", "Domingo", "Lunes", "Martes"])
        ->datasets([
            [
                "label" => "Cantidad de actividades",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$act_mie, $act_jue, $act_vie, $act_sab, $act_dom, $act_lun, $act_mar],
            ],
            [
                "label" => "Actividades realizadas",
                'borderColor' => "#03A9F4",
                "pointBorderColor" => "#03A9F4",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => [$rea_mie, $rea_jue, $rea_vie, $rea_sab, $rea_dom, $rea_lun, $rea_mar],
            ]
        ])
        ->options([]);

        return view('estadisticas', compact('empleados','actividades','realizada','chartjs'));
    }
    protected function envio_avisos()
    {
        /*if(session('fecha_actual')){
            $anio=session('fecha_actual');
        }else{
            $anio=date('Y');
        }*/
        //primero la fecha de hoy
        $hoy=date('Y-m-d');
        $hoy_c=strtotime(date('Y-m-d'));
        

        //consultando a todos los empleados
        $empleados=Empleados::all();
        //consultando fechas de vencimiento de licencias

        foreach ($empleados as $key) {
            
            //-- envio de aviso en caso de vencimiento de licencia----------------
            foreach ($key->licencias as $key2) {
                
            $fechav_licn=$key2->pivot->fecha_vence;
            $fechav_licn_c=strtotime($fechav_licn);
                # no ha pasado la fecha de vencimiento
                $date1 = new \DateTime($fechav_licn);
                $date2 = new \DateTime($hoy);
                $diff = $date1->diff($date2);
                $nombres=$key->nombres." ".$key->apellidos." RUT: ".$key->rut;
                //mensaje a enviar 
                $aviso=Avisos::where('motivo','Vencimiento de Licencia')->first();
                //dd($aviso);
                $mensaje=$aviso->mensaje."  Faltan ".$diff->days ." días para vencerse la licencia ".$key2->licencia;
                $asunto="Bienen! | Vencimiento de Licencia";
                $destinatario=$key->email;

            if ($hoy_c<=$fechav_licn_c) {
                //en caso de que falten dias para vencerse
                
                //a quien se envia.....
                //antes de enviar el correo se necesita saber si ya se ha enviado
                
                //echo $diff->days."---------";
                if (count($key->avisos)!=0) {

                    $cont=0;
                    $c=0;//cuenta si hubo envio de avisos hoy
                    # en caso de tener avisos
                    foreach ($key->avisos as $key2) {
                        if ($key2->pivot->id_aviso==$aviso->id and $key2->pivot->status=="Enviado") {
                            $cont++;
                        }
                        $created_at=substr($key2->pivot->created_at,0,10)."<br>";
                        //echo strcmp($created_at,$hoy)."<br>";
                        if ($key2->pivot->id_aviso==$aviso->id and strcmp($created_at,$hoy)==4) {

                            $c++;
                        }
                    }
                        //echo $diff->days."---------".$cont;
                    
                    if (($diff->days==30 || $diff->days<=10) && $c==0) {
                        # enviando el correo cuando le falten 30 o 10 dias para el vencimiento

                        $r=Mail::send('email_avisos.aviso',
                        ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$asunto,$destinatario,$mensaje) {
                        $m->from('avisos@licancaburweb.cl', 'Bienen!');
                        $m->to($destinatario)->subject($asunto);
                        });
                        //registrando que se envió el correo
                        \DB::table('avisos_enviados')->insert([
                            'id_aviso' => $aviso->id,
                            'id_empleado' => $key->id,
                            'created_at' => $hoy
                        ]);
                    }
                    //dd("-------");
                }else{
                    //considicionando para que envie el aviso cuando falten 30 dias o menos
                    //pero solo la primera vez cuando no tiene avisos
                    //echo $diff->days."---------";
                if($diff->days<=30){
                    //enviando correo si no tiene avisos registrados
                    $r=Mail::send('email_avisos.aviso',
                        ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$asunto,$destinatario,$mensaje) {
                        $m->from('avisos@licancaburweb.cl', 'Bienen!');
                        $m->to($destinatario)->subject($asunto);
                    });
                    //registrando que se envió el correo
                        \DB::table('avisos_enviados')->insert([
                            'id_aviso' => $aviso->id,
                            'id_empleado' => $key->id,
                            'created_at' => $hoy
                        ]);
                }
                }//fin de condicional si no tiene avisos registrados

                
            } else {
                //en el caso de que se paso la fecha de vencimiento
                if (count($key->avisos)!=0) {

                    $cont=0;
                    $c=0;//cuenta si hubo envio de avisos hoy
                    # en caso de tener avisos
                    foreach ($key->avisos as $key2) {
                        if ($key2->pivot->id_aviso==$aviso->id and $key2->pivot->status=="Enviado") {
                            $cont++;
                        }
                        $created_at=substr($key2->pivot->created_at,0,10)."<br>";
                        //echo strcmp($created_at,$hoy)."<br>";
                        if ($key2->pivot->id_aviso==$aviso->id and strcmp($created_at,$hoy)==4) {

                            $c++;
                        }
                    }
                        
                    
                    if (($diff->days==30 || $diff->days<=10) && $c==0) {
                        # enviando el correo cuando le falten 30 o 10 dias para el vencimiento
                        $mensaje=$aviso->mensaje."  Tiene ".$diff->days ." días vencida la licencia ".$key2->licencia;
                        $r=Mail::send('email_avisos.aviso',
                        ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$asunto,$destinatario,$mensaje) {
                        $m->from('avisos@licancaburweb.cl', 'Bienen!');
                        $m->to($destinatario)->subject($asunto);
                        });
                        //registrando que se envió el correo
                        \DB::table('avisos_enviados')->insert([
                            'id_aviso' => $aviso->id,
                            'id_empleado' => $key->id,
                            'created_at' => $hoy
                        ]);
                    }
                }else{
                    //considicionando para que envie el aviso cuando falten 30 dias o menos
                    //pero solo la primera vez cuando no tiene avisos
                        //echo $diff->days."---------";
                if($diff->days<=10){
                    $mensaje=$aviso->mensaje."  Tiene ".$diff->days ." días vencida la licencia ".$key2->licencia;
                    //enviando correo si no tiene avisos registrados
                    $r=Mail::send('email_avisos.aviso',
                        ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$asunto,$destinatario,$mensaje) {
                        $m->from('avisos@licancaburweb.cl', 'Bienen!');
                        $m->to($destinatario)->subject($asunto);
                    });
                    //registrando que se envió el correo
                        \DB::table('avisos_enviados')->insert([
                            'id_aviso' => $aviso->id,
                            'id_empleado' => $key->id,
                            'created_at' => $hoy
                        ]);
                }
                }//fin de condicional si no tiene avisos registrados
            }//fin del else en caso de que se pasó la fecha de vencimiento
        }//fin del foreach de licencias

            //----fin de envio de aviso en caso de vencimiento de licencia
            //--- envio de avisos por vencimientos de examenes
            foreach ($key->examenes as $key2) {
                //echo $key2->pivot->fecha_vence."<br>";
                $fecha_vence=$key2->pivot->fecha_vence;
                $fecha_vence_c=strtotime($fecha_vence);
                # no ha pasado la fecha de vencimiento
                $date1 = new \DateTime($fecha_vence);
                $date2 = new \DateTime($hoy);
                $diff = $date1->diff($date2);
                /*if($key->id==4){
                    echo $diff->days."<br>";
                }*/
                $nombres=$key->nombres." ".$key->apellidos." RUT: ".$key->rut;
                //mensaje a enviar 
                $aviso=Avisos::where('motivo','Vencimiento de Exámenes')->first();
                //dd($aviso);
                $mensaje=$aviso->mensaje."  Faltan ".$diff->days ." días para vencerse el exámen <b>".$key2->examen."</b>.";
                $asunto="Bienen! | Vencimiento de Exámenes";
                $destinatario=$key->email;
                
            if ($hoy_c<=$fecha_vence_c) {
                
                //en caso de que falten dias para vencerse
                
                //a quien se envia.....
                //antes de enviar el correo se necesita saber si ya se ha enviado
                
                //echo $diff->days."---------";
                if (count($key->avisos)!=0) {

                    $cont=0;
                    $c=0;//cuenta si hubo envio de avisos hoy
                    # en caso de tener avisos
                    foreach ($key->avisos as $key2) {
                        if ($key2->pivot->id_aviso==$aviso->id and $key2->pivot->status=="Enviado") {
                            $cont++;
                        }
                        $created_at=substr($key2->pivot->created_at,0,10)."<br>";
                        //echo strcmp($created_at,$hoy)."<br>";
                        if ($key2->pivot->id_aviso==$aviso->id and strcmp($created_at,$hoy)==4) {

                            $c++;
                        }
                    }
                        //echo $diff->days."---------".$cont;
                    /*if($key->id==4){
                    echo $diff->days."---".$cont."----".$c."<br>";
                    }*/
                    if (($diff->days==30 || $diff->days<=10) && $c==0) {
                        # enviando el correo cuando le falten 30 o 10 dias para el vencimiento
                        $r=Mail::send('email_avisos.aviso',
                        ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$asunto,$destinatario,$mensaje) {
                        $m->from('avisos@licancaburweb.cl', 'Bienen!');
                        $m->to($destinatario)->subject($asunto);
                        });
                        //registrando que se envió el correo
                        \DB::table('avisos_enviados')->insert([
                            'id_aviso' => $aviso->id,
                            'id_empleado' => $key->id,
                            'created_at' => $hoy
                        ]);
                    }
                }else{
                    //considicionando para que envie el aviso cuando falten 30 dias o menos
                    //pero solo la primera vez cuando no tiene avisos
                    //echo $diff->days."---------";
                    /*if($key->id==4){
                    echo $diff->days."<br>";
                    }*/
                if($diff->days<=30){
                    //enviando correo si no tiene avisos registrados
                    $r=Mail::send('email_avisos.aviso',
                        ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$asunto,$destinatario,$mensaje) {
                        $m->from('avisos@licancaburweb.cl', 'Bienen!');
                        $m->to($destinatario)->subject($asunto);
                    });
                    //registrando que se envió el correo
                        \DB::table('avisos_enviados')->insert([
                            'id_aviso' => $aviso->id,
                            'id_empleado' => $key->id,
                            'created_at' => $hoy
                        ]);
                }
                }//fin de condicional si no tiene avisos registrados

                
            } else {
                /*if($key->id==4){
                    echo $diff->days."<br>";
                }*/
                //en el caso de que se paso la fecha de vencimiento
                if (count($key->avisos)!=0) {

                    $cont=0;
                    $c=0;//cuenta si hubo envio de avisos hoy
                    # en caso de tener avisos
                    foreach ($key->avisos as $key2) {
                        if ($key2->pivot->id_aviso==$aviso->id and $key2->pivot->status=="Enviado") {
                            $cont++;
                        }
                        $created_at=substr($key2->pivot->created_at,0,10)."<br>";
                        //echo strcmp($created_at,$hoy)."<br>";
                        if ($key2->pivot->id_aviso==$aviso->id and strcmp($created_at,$hoy)==4) {

                            $c++;
                        }
                    }
                        
                    
                    if (($diff->days==30 || $diff->days<=10) && $c==0) {
                        # enviando el correo cuando le falten 30 o 10 dias para el vencimiento
                        $mensaje=$aviso->mensaje."  Tienen ".$diff->days ." días vencido el exámen <b>".$key2->examen."</b>.";
                        $r=Mail::send('email_avisos.aviso',
                        ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$asunto,$destinatario,$mensaje) {
                        $m->from('avisos@licancaburweb.cl', 'Bienen!');
                        $m->to($destinatario)->subject($asunto);
                        });
                        //registrando que se envió el correo
                        \DB::table('avisos_enviados')->insert([
                            'id_aviso' => $aviso->id,
                            'id_empleado' => $key->id,
                            'created_at' => $hoy
                        ]);
                    }
                }else{
                    //considicionando para que envie el aviso cuando falten 30 dias o menos
                    //pero solo la primera vez cuando no tiene avisos
                        //echo $diff->days."---------";
                if($diff->days<=30){
                    $mensaje=$aviso->mensaje."  Tienen ".$diff->days ." días vencido el exámen <b>".$key2->examen."</b>.";
                    //enviando correo si no tiene avisos registrados
                    $r=Mail::send('email_avisos.aviso',
                        ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$asunto,$destinatario,$mensaje) {
                        $m->from('avisos@licancaburweb.cl', 'Bienen!');
                        $m->to($destinatario)->subject($asunto);
                    });
                    //registrando que se envió el correo
                        \DB::table('avisos_enviados')->insert([
                            'id_aviso' => $aviso->id,
                            'id_empleado' => $key->id,
                            'created_at' => $hoy
                        ]);
                }
                }//fin de condicional si no tiene avisos registrados
            }
            }//fin del foreach de examenes


            //---fin de envio de avisos por vecimiento de examenes
            //--- envio de avisos por vencimientos de examenes
            foreach ($key->cursos as $key2) {
                //echo $key2->pivot->fecha_vence."<br>";
                $fecha_vence=$key2->pivot->fecha_vence;
                $fecha_vence_c=strtotime($fecha_vence);
                # no ha pasado la fecha de vencimiento
                $date1 = new \DateTime($fecha_vence);
                $date2 = new \DateTime($hoy);
                $diff = $date1->diff($date2);
                /*if($key->id==4){
                    echo $diff->days."<br>";
                }*/
                $nombres=$key->nombres." ".$key->apellidos." RUT: ".$key->rut;
                //mensaje a enviar 
                $aviso=Avisos::where('motivo','Vencimiento de Cursos')->first();
                //dd($aviso);
                $mensaje=$aviso->mensaje."  Faltan ".$diff->days ." días para vencerse el curso <b>".$key2->curso."</b>.";
                $asunto="Bienen! | Vencimiento de Cursos";
                $destinatario=$key->email;
                
            if ($hoy_c<=$fecha_vence_c) {
                
                //en caso de que falten dias para vencerse
                
                //a quien se envia.....
                //antes de enviar el correo se necesita saber si ya se ha enviado
                
                //echo $diff->days."---------";
                if (count($key->avisos)!=0) {

                    $cont=0;
                    $c=0;//cuenta si hubo envio de avisos hoy
                    # en caso de tener avisos
                    foreach ($key->avisos as $key2) {
                        if ($key2->pivot->id_aviso==$aviso->id and $key2->pivot->status=="Enviado") {
                            $cont++;
                        }
                        $created_at=substr($key2->pivot->created_at,0,10)."<br>";
                        //echo strcmp($created_at,$hoy)."<br>";
                        if ($key2->pivot->id_aviso==$aviso->id and strcmp($created_at,$hoy)==4) {

                            $c++;
                        }
                    }
                        //echo $diff->days."---------".$cont;
                    /*if($key->id==4){
                    echo $diff->days."---".$cont."----".$c."<br>";
                    }*/
                    if (($diff->days==30 || $diff->days<=10) && $c==0) {
                        //echo "string";
                        # enviando el correo cuando le falten 30 o 10 dias para el vencimiento
                        $r=Mail::send('email_avisos.aviso',
                        ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$asunto,$destinatario,$mensaje) {
                        $m->from('avisos@licancaburweb.cl', 'Bienen!');
                        $m->to($destinatario)->subject($asunto);
                        });
                        //registrando que se envió el correo
                        \DB::table('avisos_enviados')->insert([
                            'id_aviso' => $aviso->id,
                            'id_empleado' => $key->id,
                            'created_at' => $hoy
                        ]);
                    }
                }else{
                    //considicionando para que envie el aviso cuando falten 30 dias o menos
                    //pero solo la primera vez cuando no tiene avisos
                    //echo $diff->days."---------";
                    /*if($key->id==4){
                    echo $diff->days."<br>";
                    }*/
                if($diff->days<=30){
                    //enviando correo si no tiene avisos registrados
                    $r=Mail::send('email_avisos.aviso',
                        ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$asunto,$destinatario,$mensaje) {
                        $m->from('avisos@licancaburweb.cl', 'Bienen!');
                        $m->to($destinatario)->subject($asunto);
                    });
                    //registrando que se envió el correo
                        \DB::table('avisos_enviados')->insert([
                            'id_aviso' => $aviso->id,
                            'id_empleado' => $key->id,
                            'created_at' => $hoy
                        ]);
                }
                }//fin de condicional si no tiene avisos registrados

                
            } else {
                /*if($key->id==4){
                    echo $diff->days."<br>";
                }*/
                //en el caso de que se paso la fecha de vencimiento
                if (count($key->avisos)!=0) {

                    $cont=0;
                    $c=0;//cuenta si hubo envio de avisos hoy
                    # en caso de tener avisos
                    foreach ($key->avisos as $key2) {
                        if ($key2->pivot->id_aviso==$aviso->id and $key2->pivot->status=="Enviado") {
                            $cont++;
                        }
                        $created_at=substr($key2->pivot->created_at,0,10)."<br>";
                        //echo strcmp($created_at,$hoy)."<br>";
                        if ($key2->pivot->id_aviso==$aviso->id and strcmp($created_at,$hoy)==4) {

                            $c++;
                        }
                    }
                        
                    
                    if (($diff->days==30 || $diff->days<=10) && $c==0) {
                        # enviando el correo cuando le falten 30 o 10 dias para el vencimiento
                        $mensaje=$aviso->mensaje."  Tienen ".$diff->days ." días vencido el curso <b>".$key2->curso."</b>.";
                        $r=Mail::send('email_avisos.aviso',
                        ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$asunto,$destinatario,$mensaje) {
                        $m->from('avisos@licancaburweb.cl', 'Bienen!');
                        $m->to($destinatario)->subject($asunto);
                        });
                        //registrando que se envió el correo
                        \DB::table('avisos_enviados')->insert([
                            'id_aviso' => $aviso->id,
                            'id_empleado' => $key->id,
                            'created_at' => $hoy
                        ]);
                    }
                }else{
                    //considicionando para que envie el aviso cuando falten 30 dias o menos
                    //pero solo la primera vez cuando no tiene avisos
                        //echo $diff->days."---------";
                if($diff->days<=30){
                    $mensaje=$aviso->mensaje."  Tienen ".$diff->days ." días vencido el curso <b>".$key2->examen."</b>.";
                    //enviando correo si no tiene avisos registrados
                    $r=Mail::send('email_avisos.aviso',
                        ['nombres'=>$nombres, 'mensaje' => $mensaje], function ($m) use ($nombres,$asunto,$destinatario,$mensaje) {
                        $m->from('avisos@licancaburweb.cl', 'Bienen!');
                        $m->to($destinatario)->subject($asunto);
                    });
                    //registrando que se envió el correo
                        \DB::table('avisos_enviados')->insert([
                            'id_aviso' => $aviso->id,
                            'id_empleado' => $key->id,
                            'created_at' => $hoy
                        ]);
                }
                }//fin de condicional si no tiene avisos registrados
            }
            }//fin del foreach de cursos
            //fin de envio de avisos de cursos
            //dd("---------------");
        }
                //dd("----");

    }

    protected function actualizar_anio(Request $request)
    {
        //dd($request->all());
        //dd($request->session()->get('fecha_actual'));
        $request->session()->put('fecha_actual', $request->anio_planificacion_g);
        session(['fecha_actual' => $request->anio_planificacion_g]);
        //dd(config('session.fecha_actual'));
        \Artisan::call('config:cache'); 
        return redirect()->back();
        //dd('cambiar año');
    }
    
}

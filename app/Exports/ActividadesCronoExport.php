<?php

namespace App\Exports;

use App\Actividades;
use App\Planificacion;
use App\Gerencias;
use App\Areas;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Files\NewExcelFile;

class ActividadesCronoExport implements FromView
{
	public $planificacion="";
	public $gerencias;
	public $areas="";
    public $tipo="";
    public $realizadas="";
    public $dias="";
    public $departamentos="";

    
	public function datos(Request $request)
	{
        //dd($request->all());
		//$obj=new ActividadesExport();
		$this->planificacion=$request->planificacion;
		$this->gerencias=$request->gerencias;
		$this->areas=$request->areas;
        $this->tipo=$request->tipo;
        $this->realizadas=$request->realizadas;
        $this->dias=$request->dias;
        $this->departamentos=$request->departamentos;

	}
    
    public function view(): View
    {
    	//dd($this->departamentos);

            
            $gerencia=Gerencias::where('gerencia',$this->gerencias)->first();
            $areas=Areas::find($this->areas);
            $planificacion=Planificacion::where('semana',$this->planificacion)->where('id_gerencia',$gerencia->id)->first();

            $actividades=Actividades::where('id_planificacion', $planificacion->id)->where('id_area', $this->areas)->get();
            /*if ($this->planificacion!=0) {
                    $condicion_plan=" && planificacion.semana=".$this->planificacion." ";
                    //dd('Número de la semana',$condicion_plan);
                } else {
                    //dd('Todos PLanificación');
                    $condicion_plan="";
                }

                if ($this->gerencias!=0) {
                    $condicion_geren=" && gerencias.gerencia='".$this->gerencias."' ";
                } else {
                    //dd('Todos Gerencia');
                    $condicion_geren="";
                }

                if ($this->areas!=0) {
                    $condicion_areas=" && areas.id=".$this->areas." ";
                } else {
                    //dd('Todos Áreas');
                    $condicion_areas="";
                }

                if ($this->tipo!="0") {
                    $condicion_tipo=" && actividades.tipo='".$this->tipo."' ";
                } else {
                    //dd('Todos Tipo',$this->tipo);
                    $condicion_tipo="";
                }

                if ($this->realizadas!="0") {
                    $condicion_realizadas=" && actividades.realizada='".$this->realizadas."' ";
                } else {
                    $condicion_realizadas="";
                    //dd('Todos Días',$condicion_realizadas);
                }

                if ($this->dias!="0") {
                    $condicion_dias=" && actividades.dia='".$this->dias."' ";
                    //dd('Todos Días 11',$condicion_dias);
                } else {
                    $condicion_dias="";
                    //dd('Todos Días 00',$condicion_dias);
                }

                if ($this->departamentos!=NULL) {
                    $condicion_departamentos=" && departamentos.departamento='".$this->departamentos."' ";
                    //dd('Todos Días 11',$condicion_dias);
                } else {
                    $condicion_departamentos="";
                    //dd('Todos Días 00',$condicion_dias);
                }

                $sql="SELECT planificacion.elaborado,planificacion.aprobado,planificacion.num_contrato,planificacion.fechas,planificacion.semana,planificacion.revision,gerencias.gerencia,planificacion.id FROM planificacion,actividades,gerencias,areas,departamentos WHERE planificacion.id_gerencia = gerencias.id && actividades.id_area=areas.id && actividades.id_planificacion=planificacion.id ".$condicion_plan." ".$condicion_geren." ".$condicion_areas." ".$condicion_realizadas." ".$condicion_tipo." ".$condicion_dias." ".$condicion_departamentos." group by planificacion.id";
                //dd($sql);
                $actividades=\DB::select($sql);
            
            */


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

        //-----------------------------------------------------
 		//dd($resultado);

        if ($resultado==0) {
        	//dd("---------------");
        	flash('<i class="icon-circle-check"></i> No exiten actividades registradas en la planificacion seleccionada!')->warning()->important();
                
            return redirect()->back();
        } else {
        //dd($resultado."---------------".$areas);
        return view('reportes.crono.cronoEXCEL', ['resultado' => $resultado,
                    'planificacion' => $planificacion,
                    'cant_act' =>$cant_act, 
                    'areas' => $areas, 
                    'actividades' =>$actividades,
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
                    'duracion_real_pm04' => $duracion_real_pm04]);
        }
        
    }
}
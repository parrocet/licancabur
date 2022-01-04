<?php

namespace App\Http\Controllers;

use App\Actividades;
use App\ActividadesProceso;
use App\Comentarios;
use App\Planificacion;
use App\Areas;
use App\Gerencias;
use App\ArchivosPlan;
use App\ActividadesAdjuntos;
use App\Http\Requests\FilesRequest;
use Illuminate\Http\Request;
use App\Empleados;
use App\ActividadesVistas;
use App\ComentariosVistos;
use App\Departamentos;
use App\User;
date_default_timezone_set('UTC');
ini_set('max_execution_time', 900);
set_time_limit(900);
class ActividadesController extends Controller
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
        //
    }

    public function buscar()
    {
        return $actividades=Actividades::where('tipo','PM02')->get();

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
    protected function generarCodigo() {
     $key = '';
     $pattern = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
     $max = strlen($pattern)-1;
     // for($i=0;$i < 4;$i++) $key .= $pattern{mt_rand(0,$max)};
     for ($i = 0; $i < 4; $i++) {
        $key .= $pattern[rand(0, $max)];
    }
     return $key;
    }

    
    public function store(Request $request)
    {

        
        //----------generando fechas de los dias seleccionados---------
        // dd($request->all());
        if ($request->id_actividad_act=="") {
            //dd("registrando");
            //--- creando variable para contener los días seleccionas------
            $dias=" (";
            $j=count($request->dia)-1;
            for($i=0;$i<count($request->dia);$i++){
                $dias.=$request->dia[$i];
                if($i<$j){
                    $dias.=" - ";
                }else{
                    $dias.=")";
                }
            }
            //dd($dias);
            //------------------------------
            $semanas=array();
        $fecha_vencimiento=array();
        if($request->id_actividad==0){
            $area=Areas::find($request->id_area);
            
        }else{
            $act=Actividades::find($request->id_actividad);
            $area=Areas::find($act->id_area);
            
        }
        
        $area_plan=0;
        for ($j=0; $j < count($request->id_planificacion); $j++) { 
            $planificacion=Planificacion::find($request->id_planificacion[$j]);
            if ($area->id_gerencia==$planificacion->id_gerencia) {
                $area_plan++;
            }
            $semanas[$j]=$planificacion->semana;
            for ($i=0; $i < count($request->dia); $i++) { 
                $fecha_vencimiento[$j][$i]=$this->calcular_fecha($request->dia[$i],$planificacion->semana);
            }

        }
        // dd($fecha_vencimiento);
        //dd($request->all());
        //-------------------------------ORIGINAL---------------------------------
        //if ($area_plan==count($request->id_planificacion)) {
        //-------------------------------CAMBIO-----------------------------------
        //dd($request->id_planificacion);
        if (count($request->id_planificacion)>0) {
            //----fin de la generacion de fechas
            $semanas_encontrada=array();//guarda las semanas donde fue encontrada la actividad registrada
            //dd($request->all());
            //validando entrada de archivos e imagenes para la actividad
             /*$this->validate($request, [
                'archivos.*' => 'nullable|mimes:doc,pdf,docx,zip',
                'imagenes.*' => 'nullable|mimes:png,jpg,jpeg',
            ]);*/
            //dd($request->all());
            //dd($request->id_actividad."-".$request->tipo);
            //primero verificar si se elegió una PM02 ya registrada
            if ($request->id_actividad!=0 && $request->tipo=="PM02") {
                //dd('----');
                # se eligió una actividad PM02 ya registrada
                $actividad=Actividades::find($request->id_actividad);
                //dd($actividad);

                //buscando si ya existe esa actividad registrada a esa planificacion para ese dia
                $contar=0;
                $k=0;
                for ($i=0; $i < count($request->id_planificacion); $i++) { 
                    for ($j=0; $j < count($request->dia) ; $j++) { 
                        
                        $buscar=Actividades::where('id_planificacion',$request->id_planificacion[$i])->where('dia',$request->dia[$j])->where('id_area',$request->id_area)->where('id',$request->id_actividad)->get();
                        if (count($buscar)>0) {
                            $contar++;
                            $semanas_encontrada[$k]=$semanas[$i];
                            $k++;
                        }
                    }
                }
                //dd($contar);
                if ($contar==0) {
                    if($request->archivos!==null){
                        foreach($request->file('archivos') as $file){
                            $codigo=$this->generarCodigo();
                            $name=$codigo."_".$file->getClientOriginalName();
                            $file->move(public_path().'/files_actividades/',$name);  
                            $names_files[] = $name;
                            $urls_files[] ='files_actividades/'.$name;

                        }
                    }
                    if($request->imagenes!==null){
                        foreach($request->file('imagenes') as $file){

                            $name=$codigo."_".$file->getClientOriginalName();
                            $file->move(public_path().'/imgs_actividades/', $name);  
                            $names_imgs[] = $name;
                            $urls_imgs[] ='imgs_actividades/'.$name;

                        }
                    }
                    
                    for ($j=0; $j < count($request->id_planificacion) ; $j++) { 
                        for ($i=0; $i < count($request->dia); $i++) { 
                        //registrado varias actividades en los dias seleccionados
                        
                        $actividad2=new Actividades();
                        $actividad2->task=$actividad->task;
                        $actividad2->descripcion=$actividad->descripcion;
                        $actividad2->fecha_vencimiento=$fecha_vencimiento[$j][$i];
                        $actividad2->duracion_pro=$actividad->duracion_pro;
                        $actividad2->cant_personas=$actividad->cant_personas;
                        $actividad2->dia=$request->dia[$i];
                        $actividad2->tipo=$actividad->tipo;

                        $actividad2->observacion2=$request->observacion2;
                        $actividad2->id_planificacion=$request->id_planificacion[$j];
                        $actividad2->id_area=$request->id_area;
                        $actividad2->id_departamento=1;
                        $actividad2->save();

                            //dd($request->file('archivos'));
                            if ($request->archivos!==null) {
                            
                                for ($i=0; $i < count($names_files); $i++) { 
                                    $archivos=new ArchivosPlan();
                                    $archivos->id_actividad=$actividad2->id;
                                    $archivos->nombre=$names_files[$i];
                                    $archivos->url=$urls_files[$i];
                                    $archivos->tipo="file";
                                    $archivos->save();
                                }//fin del for del registro de archivos
                            }//fin del condicional de archivos
                            if($request->imagenes!==null) {
                                
                                for ($i=0; $i < count($names_files); $i++) { 
                                    $archivos=new ArchivosPlan();
                                    $archivos->id_actividad=$actividad2->id;
                                    $archivos->nombre=$names_imgs[$i];
                                    $archivos->url=$urls_imgs[$i];
                                    $archivos->tipo="img";
                                    $archivos->save();
                                }//finde for de asignacion de imagenes
                            }//fin del condicional de imagenes
                        }//fin del 2do for de actividades
                    }//fin del 1er for de actividades
                    //dd('asasas');
                    $empleado=Empleados::where('id_usuario', \Auth::user()->id)->first();
                    $activi=Actividades::find($actividad2->id);

                    /*if(count($empleado)!=0 || \Auth::user()->superUser != 'Eiche'){
                        \DB::table('actividades_proceso')->insert([
                            'id_actividad' => $activi->id,
                            'id_empleado' => $empleado->id,
                            'hora_inicio' => "'".date('Y-m-d')." ".date('H:i:s')."'"
                        ]);
                    }*/

                    //en  caso de agregar archivos o imagenes
                
                   for ($j=0; $j < count($request->id_planificacion); $j++) { 
                        $planificacion=Planificacion::find($request->id_planificacion[$j]);
                        
                        flash('<i class="icon-circle-check"></i> La Actividad fue registrada para el área '.$area->area.' en la Semana '.$planificacion->semana.' para '.$dias.', de manera exitosa!')->success()->important();
                        
                    }
                        return redirect()->to('planificacion');
                } else {
                    for ($i=0; $i < count($semanas_encontrada); $i++) { 
                        
                        flash('<i class="icon-circle-check"></i> La Actividad ya existe registrada para el área '.$area->area.' en la Planificación de la Semana '.$semanas_encontrada[$i].', en al menos un día de los seleccionados!')->warning()->important();
                    }
                        return redirect()->to('planificacion');
                }
                

            } else {
                if ($request->id_actividad==0 && $request->tipo=="PM02") {
                    # se elegió registrar una nueva actividad tipo PM02
                    //dd($request->all());
                    $contar=0;
                    $k=0;
                    for ($i=0; $i < count($request->id_planificacion) ; $i++) { 
                        for ($j=0; $j < count($request->dia); $j++) { 
                            $buscar=Actividades::where('task',$request->task)->where('id_planificacion',$request->id_planificacion[$i])->where('dia',$request->dia[$j])->where('id_area',$request->id_area)->count();
                            if($buscar>0){
                                $contar++;
                                $semanas_encontrada[$k]=$semanas[$i];
                                $k++;
                            }           
                        }
                    }
                    //dd($contar);
                    if($contar==0){
                        
                        if($request->archivos!==null){
                            foreach($request->file('archivos') as $file){
                                $codigo=$this->generarCodigo();
                                $name=$codigo."_".$file->getClientOriginalName();
                                $file->move(public_path().'/files_actividades/',$name);  
                                $names_files[] = $name;
                                $urls_files[] ='files_actividades/'.$name;

                            }
                        }
                        if($request->imagenes!==null){
                            foreach($request->file('imagenes') as $file){

                                $name=$codigo."_".$file->getClientOriginalName();
                                $file->move(public_path().'/imgs_actividades/', $name);  
                                $names_imgs[] = $name;
                                $urls_imgs[] ='imgs_actividades/'.$name;

                            }
                        }
                        //registrando una nueva actividad PM02 en la planificación
                    for ($i=0; $i < count($request->id_planificacion); $i++) { 
                        for ($j=0; $j < count($request->dia); $j++) { 
                            
                            $actividad=new Actividades();
                            $actividad->task=$request->task;
                            $actividad->descripcion=$request->descripcion;
                            $actividad->fecha_vencimiento=$fecha_vencimiento[$i][$j];
                            $actividad->duracion_pro=$request->duracion_pro;
                            $actividad->cant_personas=$request->cant_personas;
        
                            $actividad->dia=$request->dia[$j];
                            $actividad->tipo=$request->tipo;
        
                            $actividad->observacion2=$request->observacion2;
                            $actividad->id_planificacion=$request->id_planificacion[$i];
                            $actividad->id_area=$request->id_area;
                            $actividad->id_departamento=1;
                            $actividad->save();
                            //ASIGNACIONES
                            $empleado=Empleados::where('id_usuario', \Auth::user()->id)->first();
                            $activi=Actividades::find($actividad->id);
                            //dd($request->file('archivos'));
                            if ($request->archivos!==null) {
                            
                                for ($pos=0; $pos < count($names_files); $pos++) { 
                                    $archivos=new ArchivosPlan();
                                    $archivos->id_actividad=$actividad->id;
                                    $archivos->nombre=$names_files[$pos];
                                    $archivos->url=$urls_files[$pos];
                                    $archivos->tipo="file";
                                    $archivos->save();
                                }//fin del for del registro de archivos
                            }//fin del condicional de archivos
                            if($request->imagenes!==null) {
                                
                                for ($pos=0; $pos < count($names_files); $pos++) { 
                                    $archivos=new ArchivosPlan();
                                    $archivos->id_actividad=$actividad->id;
                                    $archivos->nombre=$names_imgs[$pos];
                                    $archivos->url=$urls_imgs[$pos];
                                    $archivos->tipo="img";
                                    $archivos->save();
                                }//fin de for de asignacion de imagenes
                            }//fin del condicional de imagenes
                            /*if(\Auth::user()->superUser != 'Eiche'){
                                \DB::table('actividades_proceso')->insert([
                                    'id_actividad' => $actividad->id,
                                    'id_empleado' => $empleado->id,
                                    'hora_inicio' => "'".date('Y-m-d')." ".date('H:i:s')."'"
                                ]);
                            }*/
                            
                        }
                    }

                   
                       for ($j=0; $j < count($request->id_planificacion); $j++) { 
                            $planificacion=Planificacion::find($request->id_planificacion[$j]);
                            
                            flash('<i class="icon-circle-check"></i> La Actividad fue registrada para el área '.$area->area.' en la Semana '.$planificacion->semana.'  para '.$dias.', de manera exitosa!')->success()->important();
                            
                        }
                        return redirect()->to('planificacion');
                    }else{
                        
                     for ($i=0; $i < count($semanas_encontrada); $i++) { 
                        $var='<i class="icon-circle-check"></i> La Actividad ya existe registrada para el área '.$area->area.' en la Planificación de la Semana '.$semanas_encontrada[$i].'!';
                        flash($var)->warning()->important();
                    
                     }
                     
                        return redirect()->to('planificacion');
                    }
                } else {
                    # se eligió registrar una actividad distinta de PM02
                    //dd($request->all());
                    
                    //dd($fecha_vencimiento);
                    $contar=0;
                    $k=0;
                    for ($i=0; $i < count($request->id_planificacion) ; $i++) { 
                        for ($j=0; $j < count($request->dia); $j++) { 
                            $buscar=Actividades::where('task',$request->task)->where('id_planificacion',$request->id_planificacion[$i])->where('dia',$request->dia[$j])->where('id_area',$request->id_area)->first();
                            if(!empty($buscar)){
                                $contar++;
                                $semanas_encontrada[$k]=$semanas[$i];
                                $k++;
                            }           
                        }
                    }
                    if($contar==0){
                        if($request->archivos!==null){
                            foreach($request->file('archivos') as $file){
                                $codigo=$this->generarCodigo();
                                $name=$codigo."_".$file->getClientOriginalName();
                                $file->move(public_path().'/files_actividades/',$name);  
                                $names_files[] = $name;
                                $urls_files[] ='files_actividades/'.$name;

                            }
                        }
                        if($request->imagenes!==null){
                            foreach($request->file('imagenes') as $file){

                                $name=$codigo."_".$file->getClientOriginalName();
                                $file->move(public_path().'/imgs_actividades/', $name);  
                                $names_imgs[] = $name;
                                $urls_imgs[] ='imgs_actividades/'.$name;

                            }
                        }
                        //registrando una nueva actividad PM02 en la planificación
                    for ($i=0; $i < count($request->id_planificacion); $i++) { 
                        for ($j=0; $j < count($request->dia); $j++) { 
                                        
                            $actividad=new Actividades();
                            $actividad->task=$request->task;
                            $actividad->descripcion=$request->descripcion;
                            $actividad->fecha_vencimiento=$fecha_vencimiento[$i][$j];
                            $actividad->duracion_pro=$request->duracion_pro;
                            $actividad->cant_personas=$request->cant_personas;
        
                            $actividad->dia=$request->dia[$j];
                            $actividad->tipo=$request->tipo;
        
                            $actividad->observacion2=$request->observacion2;
                            $actividad->id_planificacion=$request->id_planificacion[$i];
                            $actividad->id_area=$request->id_area;
                            if($request->tipo=="PM03"){
                            $actividad->id_departamento=$request->id_departamento;
                            }else{
                                $actividad->id_departamento=1;
                            }
                            $actividad->save();

                            if ($request->archivos!==null) {
                            
                                for ($pos=0; $pos < count($names_files); $pos++) { 
                                    $archivos=new ArchivosPlan();
                                    $archivos->id_actividad=$actividad->id;
                                    $archivos->nombre=$names_files[$pos];
                                    $archivos->url=$urls_files[$pos];
                                    $archivos->tipo="file";
                                    $archivos->save();
                                }//fin del for del registro de archivos
                            }//fin del condicional de archivos
                            if($request->imagenes!==null) {
                                
                                for ($pos=0; $pos < count($names_files); $pos++) { 
                                    $archivos=new ArchivosPlan();
                                    $archivos->id_actividad=$actividad->id;
                                    $archivos->nombre=$names_imgs[$pos];
                                    $archivos->url=$urls_imgs[$pos];
                                    $archivos->tipo="img";
                                    $archivos->save();
                                }//fin de for de asignacion de imagenes
                            }//fin del condicional de imagenes
                            //ASIGNACIONES
                            $empleado=Empleados::where('id_usuario', \Auth::user()->id)->first();

                            $activi=Actividades::find($actividad->id);

                            /*if (\Auth::user()->tipo_usuario=="Empleado" && $request->tipo=="PM03") {
                                $asignacion= new ActividadesProceso();
                                $asignacion->id_actividad=$actividad->id;
                                $asignacion->id_empleado=$empleado->id;
                                $asignacion->hora_inicio="'".date('Y-m-d')." ".date('H:i:s')."'";
                                $asignacion->save();
                            }*/
                            if(\Auth::user()->tipo_user=="Empleado"){
                                
                                \DB::table('actividades_proceso')->insert([
                                    'id_actividad' => $activi->id,
                                    'id_empleado' => $empleado->id,
                                    'hora_inicio' => "'".date('Y-m-d')." ".date('H:i:s')."'"
                                ]);
                            }
                            
                        }
                    }
                    
                   for ($j=0; $j < count($request->id_planificacion); $j++) { 
                        $planificacion=Planificacion::find($request->id_planificacion[$j]);
                        
                        flash('<i class="icon-circle-check"></i> La Actividad fue registrada para el área '.$area->area.' en la Semana '.$planificacion->semana.'  para '.$dias.', de manera exitosa!')->success()->important();
                        
                    }
                    return redirect()->to('planificacion');
                }else{
                     for ($i=0; $i < count($semanas_encontrada); $i++) { 
                        
                        flash('<i class="icon-circle-check"></i> La Actividad ya existe registrada para el área '.$area->area.' en la Planificación de la Semana '.$semanas_encontrada[$i].'!')->warning()->important();
                     }
                    return redirect()->to('planificacion');
                }
            }
                    
        }//fin de else de PM02 registrada

        }else{
            flash('<i class="icon-circle-check"></i> No existe una planificación registrada para la gerencia del área '.$area->area.' !')->warning()->important();
            return redirect()->to('planificacion');
        }
        }else{
            
            #en caso de que sea una actualización de la actividad
            //dd("actualización");
        //id_actividad es la PM02 por la cual voy a cambiar
        //id_actividad_act es el id de la actividad que se va a actualizar
        //validando entrada de archivos e imagenes para la actividad
         /*$this->validate($request, [
            'archivos.*' => 'nullable|mimes:doc,pdf,docx,zip',
            'imagenes.*' => 'nullable|mimes:png,jpg,jpeg',
        ]);*/
        //dd($request->all());
        $planificacion=Planificacion::find($request->id_planificacion_edit[0]);

        $fecha_vencimiento=$this->calcular_fecha($request->dia,$planificacion->semana);
        
        $area=Areas::find($request->id_area);
        if ($area->id_gerencia==$planificacion->id_gerencia) {
            
        //primero verificar si se elegió una PM02 ya registrada
        //dd($request->id_actividad_act);
        if ($request->id_actividad!=0 && $request->tipo=="PM02") {

            # se eligió una actividad PM02 ya registrada
            $actividad=Actividades::find($request->id_actividad);
            
            //buscando si ya existe esa actividad registrada a esa planificacion para ese dia
            $buscar=Actividades::where('id_planificacion',$request->id_planificacion_edit[0])->where('dia',$request->dia)->where('id_area',$area->id)->where('id','<>',$request->id_actividad_act)->count();
            //dd($buscar);
            if ($buscar==0) {
                $actividad2= Actividades::find($request->id_actividad_act);
                $actividad2->task=$actividad->task;
                $actividad2->descripcion=$actividad->descripcion;
                $actividad2->fecha_vencimiento=$fecha_vencimiento;
                $actividad2->duracion_pro=$actividad->duracion_pro;
                $actividad2->cant_personas=$actividad->cant_personas;
                $actividad2->dia=$request->dia;
                $actividad2->tipo=$request->tipo;
                //$actividad2->observacion2=$request->observacion2;
                $actividad2->id_planificacion=$request->id_planificacion_edit[0];
                $actividad2->id_area=$area->id;
                //$actividad2->id_departamento=$request->id_departamento;
                $actividad2->save();
                //en  caso de agregar archivos o imagenes
                //dd($request->file('archivos'));
                    if ($request->archivos!==null) {
                       foreach($request->file('archivos') as $file){
                        $codigo=$this->generarCodigo();
                        $name=$codigo."_".$file->getClientOriginalName();
                        $file->move(public_path().'/files_actividades/',$name);  
                        $names_files[] = $name;
                        $urls_files[] ='files_actividades/'.$name;

                    }
                    for ($i=0; $i < count($names_files); $i++) { 
                        $archivos=new ArchivosPlan();
                        $archivos->id_actividad=$actividad2->id;
                        $archivos->nombre=$names_files[$i];
                        $archivos->url=$urls_files[$i];
                        $archivos->tipo="file";
                        $archivos->save();
                    }
                   }
                    if($request->imagenes!==null) {
                        foreach($request->file('imagenes') as $file){

                        $name=$codigo."_".$file->getClientOriginalName();
                        $file->move(public_path().'/imgs_actividades/', $name);  
                        $names_imgs[] = $name;
                        $urls_imgs[] ='imgs_actividades/'.$name;

                        }
                        for ($i=0; $i < count($names_files); $i++) { 
                            $archivos=new ArchivosPlan();
                            $archivos->id_actividad=$actividad2->id;
                            $archivos->nombre=$names_imgs[$i];
                            $archivos->url=$urls_imgs[$i];
                            $archivos->tipo="img";
                            $archivos->save();
                        }
                    }
               
               flash('<i class="icon-circle-check"></i> La Actividad fue actualizada para el área '.$area->area.' en la Semana '.$planificacion->semana.' para el día '.$request->dia.', de manera exitosa!')->success()->important();
                    return redirect()->to('planificacion');
            } else {
                
                    $planificacion=Planificacion::find($request->id_planificacion_edit[0]);
                    flash('<i class="icon-circle-check"></i> La Actividad ya existe registrada para el área '.$area->area.' en la Semana '.$planificacion->semana.'!')->warning()->important();
                    return redirect()->to('planificacion');
            }
            

        } else {
            if ($request->id_actividad==0 && $request->tipo=="PM02") {
                
                # se elegió registrar una nueva actividad tipo PM02
                $buscar=Actividades::where('task',$request->task)->where('id_planificacion',$request->id_planificacion_edit[0])->where('dia',$request->dia)->where('id_area',$request->id_area)->where('id','<>',$request->id_actividad_act)->count();
                //dd($buscar);
                if($buscar==0){
                    //registrando una nueva actividad PM02 en la planificación
                $actividad=Actividades::find($request->id_actividad_act);
                $actividad->task=$request->task;
                $actividad->descripcion=$request->descripcion;
                $actividad->fecha_vencimiento=$fecha_vencimiento;
                $actividad->duracion_pro=$request->duracion_pro;
                $actividad->cant_personas=$request->cant_personas;
                $actividad->dia=$request->dia;
                $actividad->tipo=$request->tipo;
                $actividad->observacion2=$request->observacion2;
                $actividad->id_planificacion=$request->id_planificacion_edit[0];
                $actividad->id_area=$request->id_area;
                
                $actividad->save();

                //en  caso de agregar archivos o imagenes
                //dd($request->file('archivos'));
                if ($request->archivos!==null) {
                   foreach($request->file('archivos') as $file){
                    $codigo=$this->generarCodigo();
                    $name=$codigo."_".$file->getClientOriginalName();
                    $file->move(public_path().'/files_actividades/',$name);  
                    $names_files[] = $name;
                    $urls_files[] ='files_actividades/'.$name;

                    }
                    for ($pos=0; $pos < count($names_files); $pos++) { 
                        $archivos=new ArchivosPlan();
                        $archivos->id_actividad=$actividad->id;
                        $archivos->nombre=$names_files[$pos];
                        $archivos->url=$urls_files[$pos];
                        $archivos->tipo="file";
                        $archivos->save();
                    }
                }
                if($request->imagenes!==null) {
                    foreach($request->file('imagenes') as $file){

                    $name=$codigo."_".$file->getClientOriginalName();
                    $file->move(public_path().'/imgs_actividades/', $name);  
                    $names_imgs[] = $name;
                    $urls_imgs[] ='imgs_actividades/'.$name;

                    }
                    for ($pos=0; $pos < count($names_files); $pos++) { 
                        $archivos=new ArchivosPlan();
                        $archivos->id_actividad=$actividad->id;
                        $archivos->nombre=$names_imgs[$pos];
                        $archivos->url=$urls_imgs[$pos];
                        $archivos->tipo="img";
                        $archivos->save();
                    }
                }
              
               flash('<i class="icon-circle-check"></i> La Actividad fue actualizada para el área '.$area->area.' en la Semana '.$planificacion->semana.' para el día '.$request->dia[0].', de manera exitosa!')->success()->important();
                    return redirect()->to('planificacion');
                }else{
                    
                    $planificacion=Planificacion::find($request->id_planificacion_edit[0]);
                    flash('<i class="icon-circle-check"></i> La Actividad ya existe registrada para el área '.$area->area.' en la Semana '.$planificacion->semana.'!')->warning()->important();
                    return redirect()->to('planificacion');
                }
            } else {
                # se eligió registrar una actividad distinta de PM02
                //dd($request->all());
                //primero calculando la fecha de vencimiento de una actividad
                $planificacion=Planificacion::find($request->id_planificacion_edit[0]);
                $fecha_vencimiento=$this->calcular_fecha($request->dia,$planificacion->semana);
                //dd($fecha_vencimiento);
                $buscar=Actividades::where('task',$request->task)->where('id_planificacion',$request->id_planificacion_edit[0])->where('dia',$request->dia)->where('id_area',$request->id_area)->where('id','<>',$request->id_actividad_act)->count();
                //dd($request->tipo);
                if ($buscar==0) {
                
                // dd($request->all());
                $actividad=Actividades::find($request->id_actividad_act);
                if (!is_null($request->task)) {
                    $actividad->task=$request->task;
                }
                if (!is_null($request->descripcion)) {
                    $actividad->descripcion=$request->descripcion;
                }
                if (!is_null($fecha_vencimiento)) {
                    $actividad->fecha_vencimiento=$fecha_vencimiento;
                }
                if (!is_null($request->duracion_pro)) {
                    $actividad->duracion_pro=$request->duracion_pro;
                }
                if (!is_null($request->cant_personas)) {
                    $actividad->cant_personas=$request->cant_personas;
                }
                // $actividad->save();
                if (!is_null($request->dia)) {
                    $actividad->dia=$request->dia[0];
                }
                if (!is_null($request->tipo)) {
                    $actividad->tipo=$request->tipo;
                }
                if (!is_null($request->observacion2)) {
                    $actividad->observacion2=$request->observacion2;
                }
                if (!is_null($request->id_planificacion_edit)) {
                    $actividad->id_planificacion=$request->id_planificacion_edit[0];
                }
                if (!is_null($request->id_area)) {
                    $actividad->id_area=$request->id_area;
                }

                // if($request->tipo=="PM03" && !is_null($request->id_departamento)){
                //     $actividad->id_departamento=$request->id_departamento;
                // }
                $actividad->save();
                //dd($actividad);
                $empleado=Empleados::where('id_usuario',\Auth::user()->id)->first();

                /*if (\Auth::user()->tipo_usuario=="Empleado" && $request->tipo=="PM03") {
                    $asignacion= new ActividadesProceso();
                    $asignacion->id_actividad=$actividad->id;
                    $asignacion->id_empleado=$empleado->id;
                    $asignacion->hora_inicio="'".date('Y-m-d')." ".date('H:i:s')."'";
                    $asignacion->save();
                }*/
                //en  caso de agregar archivos o imagenes
            //dd($request->file('archivos'));
            if ($request->archivos!==null) {
               foreach($request->file('archivos') as $file){
                $codigo=$this->generarCodigo();
                $name=$codigo."_".$file->getClientOriginalName();
                $file->move(public_path().'/files_actividades/',$name);  
                $names_files[] = $name;
                $urls_files[] ='files_actividades/'.$name;

                }
                for ($i=0; $i < count($names_files); $i++) { 
                    $archivos=new ArchivosPlan();
                    $archivos->id_actividad=$actividad->id;
                    $archivos->nombre=$names_files[$i];
                    $archivos->url=$urls_files[$i];
                    $archivos->tipo="file";
                    $archivos->save();
                }
            }
            if($request->imagenes!==null) {
                foreach($request->file('imagenes') as $file){

                $name=$codigo."_".$file->getClientOriginalName();
                $file->move(public_path().'/imgs_actividades/', $name);  
                $names_imgs[] = $name;
                $urls_imgs[] ='imgs_actividades/'.$name;

                }
                for ($i=0; $i < count($names_files); $i++) { 
                    $archivos=new ArchivosPlan();
                    $archivos->id_actividad=$actividad->id;
                    $archivos->nombre=$names_imgs[$i];
                    $archivos->url=$urls_imgs[$i];
                    $archivos->tipo="img";
                    $archivos->save();
                }
            }
            
               flash('<i class="icon-circle-check"></i> La Actividad fue actualizada para el área '.$area->area.' en la Semana '.$planificacion->semana.' para el día '.$request->dia[0].', de manera exitosa!')->success()->important();
                    return redirect()->to('planificacion');
                } else {
                 
                    $planificacion=Planificacion::find($request->id_planificacion_edit[0]);
                    flash('<i class="icon-circle-check"></i> La Actividad ya existe registrada para el área '.$area->area.' en la Semana '.$planificacion->semana.'!')->warning()->important();
                    return redirect()->to('planificacion');   
                }
            }
            
        }//fin de else de PM02 registrada
        }else{
            flash('<i class="icon-circle-check"></i> No existe una planificación registrada para la gerencia del área '.$area->area.' !')->warning()->important();
            return redirect()->to('planificacion');
        }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function show(Actividades $actividades)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function edit($id_actividad)
    {
        
        return $actividad=Actividades::where('id',$id_actividad)->get();
    }

    public function mis_archivos($id_actividad)
    {
        
        return $archivos=ArchivosPlan::where('id_actividad',$id_actividad)->where('tipo','file')->get();
    }

    public function mis_imagenes($id_actividad)
    {
        
        return $imagenes=ArchivosPlan::where('id_actividad',$id_actividad)->where('tipo','img')->get();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actividades $actividades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actividades  $actividades
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($request->all());
        $actividad=Actividades::find($request->id_actividad_eliminar);
        $planificacion=Planificacion::find($actividad->id_planificacion);
        $usuario=User::where('tipo_user','Admin')->first();
        
        $request->id_gerencia_search=$planificacion->id_gerencia;
        $request->id_area_search=$actividad->id_area;
       
            if ($actividad->delete()) {
               flash('<i class="icon-circle-check"></i> Actividad eliminada exitosamente!')->success()->important();
               // return redirect()->back();
            } else {
                flash('<i class="icon-circle-check"></i> Actividad no pudo ser eliminada !')->danger()->important();
               // return redirect()->back();
            }
        

        //-------------------------------------------------REDIRECCIONAR A LA VISTA PRINCIPAL DE ACTIVIDADES

        $planificaciones=Planificacion::where('anio',session('fecha_actual'))->get();
        $actividadesProceso=ActividadesProceso::all();
        $empleados=Empleados::all();
        //consultando las planificaciones del empleado
        if (\Auth::user()->tipo_usuario=="Empleado") {
            $actividades=Empleados::find(\Auth::user()->id);
            //averiguando en que semana estamos
            $fechaHoy = date(session('fecha_actual').'-m-d');
            $num_semana_actual=date('W', strtotime($fechaHoy));

        // return view("planificacion.index", compact('fechaHoy','num_semana_actual','actividades'));
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
                
            $actividades=Actividades::where('id_planificacion',[$planificacion3[0]->id,$planificacion3[1]->id])->get();
                    
            
            // dd(count($actividades));
            $planificacion = Planificacion::where('semana','>=',$num_semana_actual)->where('anio',session('fecha_actual'))->get();
            //$planificacion = Planificacion::all();
            
            $areas=Areas::all();
            //actividades pm01
            $id_area=0;
            $envio=1;
            // dd($actividades->all());
            // return view("planificacion.index", compact('fechaHoy','planificacion','planificacion1','planificacion2','areas','num_semana_actual','gerencias','gerencias1','gerencias2','actividades','id_area','envio','actividadesProceso','planificaciones','empleados'));
            return redirect()->back();
        }
    }

    protected function calcular_fecha($dia,$semana)
    {
        //funcion par calcular la fecha de vencimiento de una actividad

        $num=0;
        switch ($dia) {
            case 'Mié':
                $num=3;
                break;
            case 'Jue':
                $num=4;
                break;
            case 'Vie':
                $num=5;
                break;
            case 'Sáb':
                $num=6;
                break;
            case 'Dom':
                $num=7;
                break;
            case 'Lun':
                $num=1;
                $semana+=1;
                break;
            case 'Mar':
                $num=2;
                $semana+=1;
                break;
        }
        if ($semana>=1 && $semana<=9) {
            $sem="0".$semana."";
        }else{
            $sem=$semana;
        }
        $anio=date(session('fecha_actual'));
        $fecha=date(session('fecha_actual')."-m-d",strtotime($anio."W".$sem.$num));

        return $fecha;

    }
    protected function actualizando_fechas_vencimiento()
    {
        //primero todas las planificaciones 
        /*$anio=date('Y');
        $semana=4;
        $semana="".$semana."";
        $num=3;
        
        $fecha=date("Y-m-d",strtotime($anio."-W0".$semana.'-'.$num));
        dd($fecha);*/
            $planificacion=Planificacion::where('anio',session('fecha_actual'))->get();
        foreach ($planificacion as $p) {
            //luegos las actividades de esa planificacion
            $actividades=Actividades::where('id_planificacion',$p->id)->get();
            //echo "semana: ".$p->semana."(fecha: ".$p->fechas.")<br>";
                $semana=$p->semana;
            foreach ($actividades as $a) {
                //primero obtengo la semana
                //luego el numero del dia de la actividad
                        switch ($a->dia) {
                    case 'Mié':
                        $num=3;
                        break;
                    case 'Jue':
                        $num=4;
                        break;
                    case 'Vie':
                        $num=5;
                        break;
                    case 'Sáb':
                        $num=6;
                        break;
                    case 'Dom':
                        $num=7;
                        break;
                    case 'Lun':
                        $num=1;
                        $semana+=1;
                        break;
                    case 'Mar':
                        $num=2;
                        $semana+=1;
                        break;
                }
                if ($semana>=1 && $semana<=9) {
                    $sem="0".$semana."";
                }else{
                    $sem=$semana;
                }

                $anio=date('Y');//año actual
                $fecha=date("Y-m-d",strtotime($anio."W".$sem.$num));

                $a->fecha_vencimiento=$fecha;
                $a->save();
                
                //echo "(".$fecha.": dia: ".$a->dia." - semana: ".$sem." -id_planificacion:".$p->id.")";
                
            }
            //echo "<br>";
        }
        //dd("-------------------------------------------------");
    }
    public function eliminar_archivos($id_archivo)
    {
        $archivo=ArchivosPlan::find($id_archivo);
        $tipo=$archivo->tipo;
        $id_actividad=$archivo->id_actividad;
        unlink(public_path().'/'.$archivo->url);
        $archivo->delete();
        

            if ($tipo=="img") {
                return $actividad=ArchivosPlan::where('id_actividad',$id_actividad)->where('tipo',$tipo)->get();
            } else {
                return $actividad=ArchivosPlan::where('id_actividad',$id_actividad)->where('tipo',$tipo)->get();
            }
         

    }
    public function buscar_empleados($id_area)
    {
        return $empleados=\DB::table('empleados')->join('empleados_has_areas','empleados_has_areas.id_empleado','=','empleados.id')->join('areas','areas.id',"=","empleados_has_areas.id_area")
        ->select('empleados.*')->where('areas.id',$id_area)->get();
    }

    public function asignar_actividad(Request $request)
    {
        //dd($request->all());

        $empleado=Empleados::find($request->id_empleado);
        $actividad=Actividades::find($request->id_actividad_asig);

        $hallado=0;
        $asignados=0;
        foreach ($actividad->empleados as $key) {
            if ($key->pivot->id_empleado==$request->id_empleado) {
                $hallado++;
            }        
            $asignados++;     
        }
        
        if ($hallado==0 and $asignados<$actividad->cant_personas) {
        
        \DB::table('actividades_proceso')->insert([
            'id_actividad' => $request->id_actividad_asig,
            'id_empleado' => $request->id_empleado,
            'hora_inicio' => "'".date('Y-m-d')." ".date('H:i:s')."'"
        ]);

        flash('<i class="icon-circle-check"></i> La Actividad: '.$actividad->task.' <br> Fue Asignada al empleado:'.$empleado->apellidos.', '.$empleado->nombres.', RUT: '.$empleado->rut.'!')->success()->important();
                    return redirect()->to('home');   
            
        } else {
            if ($hallado>0) {
            flash('<i class="icon-circle-check"></i> La Actividad: '.$actividad->task.' <br>ya ha sido Asignada al empleado:'.$empleado->apellidos.', '.$empleado->nombres.', RUT: '.$empleado->rut.'!')->warning()->important();
                    return redirect()->to('home'); 
            } else {
                if ($asignados==$actividad->cant_personas) {
                    
                flash('<i class="icon-circle-check"></i> La Actividad: '.$actividad->task.'  ya alcanzó el límite de empleados ha asignarse!')->warning()->important();
                    return redirect()->to('home'); 
                }
            }
            
        }
    }

    public function buscar_comentarios($id_actividad)
    {
        $actividad=ActividadesProceso::where('id_actividad',$id_actividad)->first();
        return $comentarios=\DB::table('actividades_comentarios')->join('users','users.id','=','actividades_comentarios.id_usuario')->select('actividades_comentarios.*','users.name','users.email')->where('actividades_comentarios.id_actv_proceso',$actividad->id)->get();

    }

    public function registrar_comentario(Request $request)
    {
        if ($request->isMethod('post')){
        $actividad=ActividadesProceso::where('id_actividad',$request->id_actividad)->where('id_empleado',$request->id_empleado)->first();
        $comentar= new Comentarios();   
        $comentar->id_actv_proceso=$actividad->id;
        $comentar->id_usuario=$request->id_usuario;
        $comentar->comentario=$request->comentario;
        $comentar->save();
            
        return $comentarios=\DB::table('actividades_comentarios')->join('users','users.id','=','actividades_comentarios.id_usuario')->select('actividades_comentarios.*','users.name','users.email')->where('actividades_comentarios.id_actv_proceso',$actividad->id)->get();
        }
    }

    public function eliminar_comentario($id_actv_proceso,$id_comentario)
    {
        $comentar=Comentarios::find($id_comentario);
        $comentar->delete();

        $actividad=ActividadesProceso::find($id_actv_proceso);
        return $comentarios=\DB::table('actividades_comentarios')->join('users','users.id','=','actividades_comentarios.id_usuario')->select('actividades_comentarios.*','users.name','users.email')->where('actividades_comentarios.id_actv_proceso',$actividad->id)->get();
    }

    public function buscar_archivos($id_actividad)
    {
        return $actividad=ArchivosPlan::where('id_actividad',$id_actividad)->where('tipo','file')->get();
    }

    public function buscar_imagenes($id_actividad)
    {
        return $actividad=ArchivosPlan::where('id_actividad',$id_actividad)->where('tipo','img')->get();
    }

    public function registrar_archivos(Request $request)
    {
        //dd($request->all());
        if ($request->isMethod('post')){
        $actividad=ActividadesProceso::where('id_actividad',$request->id_actividad)->where('id_empleado',$request->id_empleado)->first();
           foreach($request->archivos as $file){
                $codigo=$this->generarCodigo();
                $name=$codigo."_".$file->getClientOriginalName();
                $file->move(public_path().'/files_actividades/',$name);  
                $names_files[] = $name;
                $urls_files[] ='files_actividades/'.$name;

            }
            for ($i=0; $i < count($names_files); $i++) { 
                $archivos=new ActividadesAdjuntos();
                $archivos->id_actv_proceso=$actividad->id;
                $archivos->id_usuario=$request->id_usuario;
                $archivos->nombre=$names_files[$i];
                $archivos->url=$urls_files[$i];
                $archivos->tipo="file";
                $archivos->save();
            }
            
        return $archivos=\DB::table('actividades_adjuntos')->join('users','users.id','=','actividades_adjuntos.id_usuario')->join('actividades_proceso','actividades_proceso.id','=','actividades_adjuntos.id_actv_proceso')->join('actividades','actividades.id','=','actividades_proceso.id_actividad')->select('actividades_adjuntos.*','users.name','users.email')->where('actividades.id',$request->id_actividad)->get();
        }
    }
    public function registrar_imagenes(Request $request)
    {
        //dd($request->all());
        if ($request->isMethod('post')){
        $actividad=ActividadesProceso::where('id_actividad',$request->id_actividad)->where('id_empleado',$request->id_empleado)->first();
           foreach($request->imagenes as $file){
                $codigo=$this->generarCodigo();
                $name=$codigo."_".$file->getClientOriginalName();
                $file->move(public_path().'/imgs_actividades/',$name);  
                $names_files[] = $name;
                $urls_files[] ='imgs_actividades/'.$name;

            }
            for ($i=0; $i < count($names_files); $i++) { 
                $archivos=new ActividadesAdjuntos();
                $archivos->id_actv_proceso=$actividad->id;
                $archivos->id_usuario=$request->id_usuario;
                $archivos->nombre=$names_files[$i];
                $archivos->url=$urls_files[$i];
                $archivos->tipo="img";
                $archivos->save();
            }
            
        return $archivos=\DB::table('actividades_adjuntos')->join('users','users.id','=','actividades_adjuntos.id_usuario')->join('actividades_proceso','actividades_proceso.id','=','actividades_adjuntos.id_actv_proceso')->join('actividades','actividades.id','=','actividades_proceso.id_actividad')->select('actividades_adjuntos.*','users.name','users.email')->where('actividades.id',$request->id_actividad)->get();
        }
    }
    public function buscar_archivos_adjuntos($id_actividad)
    {
        return $archivos=\DB::table('actividades_adjuntos')->join('users','users.id','=','actividades_adjuntos.id_usuario')->join('actividades_proceso','actividades_proceso.id','=','actividades_adjuntos.id_actv_proceso')->join('actividades','actividades.id','=','actividades_proceso.id_actividad')->select('actividades_adjuntos.*','users.name','users.email')->where('actividades.id',$id_actividad)->where('actividades_adjuntos.tipo','file')->get();
    }
    public function buscar_imagenes_adjuntas($id_actividad)
    {
        return $archivos=\DB::table('actividades_adjuntos')->join('users','users.id','=','actividades_adjuntos.id_usuario')->join('actividades_proceso','actividades_proceso.id','=','actividades_adjuntos.id_actv_proceso')->join('actividades','actividades.id','=','actividades_proceso.id_actividad')->select('actividades_adjuntos.*','users.name','users.email')->where('actividades.id',$id_actividad)->where('actividades_adjuntos.tipo','img')->get();
    }

    public function eliminar_archivos_adjuntos($id_archivo)
    {
        $archivo=ActividadesAdjuntos::find($id_archivo);
        $tipo=$archivo->tipo;
        $id_actividad=$archivo->id_actividad;
        unlink(public_path().'/'.$archivo->url);
        $archivo->delete();
        

            if ($tipo=="img") {
                return $archivos=\DB::table('actividades_adjuntos')->join('users','users.id','=','actividades_adjuntos.id_usuario')->join('actividades_proceso','actividades_proceso.id','=','actividades_adjuntos.id_actv_proceso')->join('actividades','actividades.id','=','actividades_proceso.id_actividad')->select('actividades_adjuntos.*','users.name','users.email')->where('actividades.id',$id_actividad)->where('actividades_adjuntos.tipo',$tipo)->get();
            } else {
                return $archivos=\DB::table('actividades_adjuntos')->join('users','users.id','=','actividades_adjuntos.id_usuario')->join('actividades_proceso','actividades_proceso.id','=','actividades_adjuntos.id_actv_proceso')->join('actividades','actividades.id','=','actividades_proceso.id_actividad')->select('actividades_adjuntos.*','users.name','users.email')->where('actividades.id',$id_actividad)->where('actividades_adjuntos.tipo',$tipo)->get();
            }
         

    }

    public function finalizar(Request $request)
    {

        // dd($request->all());
        if ($request->status==1) {
            # no finalizar



            $actividad=ActividadesProceso::where('id_actividad',$request->id_actividad_f)->first();
            $actividad->status="Iniciada";
            $actividad->hora_finalizada="";
            $actividad->save();

            $act=Actividades::find($request->id_actividad_f);
            $act->realizada="No";
            $act->duracion_real="";
            $act->id_departamento=$request->id_departamento_s;
            $act->save();
            //buscando comentarios realizados por el empleado
            //eliminado comentarios anteriores
            $buscar=Comentarios::where('id_actv_proceso',$actividad->id)->get();
            if (count($buscar)>0) {
                foreach ($buscar as $key) {
                    //$comentario=Comentarios::find($key->id);
                    $key->delete();
                }
            }

            //agregando comentario
            $empleado=Empleados::find($actividad->id_empleado);
                $comentar= new Comentarios();   
                $comentar->id_actv_proceso=$actividad->id;
                $comentar->id_usuario=$empleado->id_usuario;
                $comentar->comentario=$request->comentario;
                $comentar->save();
            flash('<i class="icon-circle-check"></i> Actividad actualizada con éxito!')->warning()->important();
        } else {
            # finalizar
            if($request->comentario!=="" && $request->duracion_real!==""){
            $actividad=ActividadesProceso::where('id_actividad',$request->id_actividad_f)->get();
            foreach ($actividad as $key) {
                $a=ActividadesProceso::find($key->id);
                $a->status="Finalizada";
                $a->hora_finalizada="".date('Y-m-d H:i:s')."";
                $a->save();

                //elimiando comentarios anteriores
                $buscar=Comentarios::where('id_actv_proceso',$a->id)->get();
                if (count($buscar)>0) {
                    foreach ($buscar as $key) {
                        $comentario=Comentarios::find($key->id);
                        $comentario->delete();
                    }
                }

                
            }

            $act=Actividades::find($request->id_actividad_f);
            $act->realizada="Si";
            $act->duracion_real=$request->duracion_real;
            $act->id_departamento=$request->id_departamento_s;
            $act->save();
            
            //agregando comentario

                $empleado=Empleados::where('id_usuario',\Auth::user()->id)->first();
                //echo $empleado->id_usuario;
                $actividad2=ActividadesProceso::where('id_actividad',$request->id_actividad_f)->where('id_empleado',$empleado->id)->first();
                if ($actividad2!==null) {
                    $comentar= new Comentarios();   
                    $comentar->id_actv_proceso=$actividad2->id;
                    $comentar->id_usuario=\Auth::user()->id;
                    $comentar->comentario=$request->comentario;
                    $comentar->save();
                    
                }
                
            }
            flash('<i class="icon-circle-check"></i> Actividad finalizada con éxito!')->success()->important();
        }
        
        return redirect()->back();
    }

    public function actividad_vista($id_actividad)
    {
        $buscar= ActividadesVistas::where('id_actividad',$id_actividad)->first();        
        $buscar->status="Si";
        $buscar->save();

        return $actividad=\DB::table('actividades')->join('areas','areas.id','=','actividades.id_area')->join('departamentos','departamentos.id','=','actividades.id_departamento')->join('planificacion','planificacion.id','=','actividades.id_planificacion')->join('gerencias','gerencias.id','=','planificacion.id_gerencia')->select('actividades.*','areas.area','departamentos.departamento','planificacion.elaborado','planificacion.num_contrato','planificacion.fechas','planificacion.semana','planificacion.revision','gerencias.gerencia')->where('planificacion.anio',session('fecha_actual'))->where('actividades.id',$id_actividad)->get();
    }

    public function comentario_visto($id_comentario)
    {
        $buscar= ComentariosVistos::find($id_comentario);        
        $buscar->status="Si";
        $buscar->save();

        return 1;           
    }

    public function buscar_departamentos($id_departamento)
    {
        return $departamentos=Departamentos::where('id','>',1)->get();
    }

    public function buscar_actividades_semana_actual(Request $request)
    {
        // dd('adsasdasd');
        // dd($request->all());
        $fechaHoy = date(session('fecha_actual').'-m-d');
        $num_dia=num_dia($fechaHoy);
        $num_semana_actual=date('W', strtotime($fechaHoy));
            

        //-------------------MODIFICACION JAVIER

        // dd($request->id_gerencia_search);
        // if ($num_dia==1 || $num_dia==2) {
        //     $num_semana_actual--;
        // }
        
        //TODAS LAS SEMANAS APARECÍAN EN 0, POR LO TANTO, EN planificación1,
        //LA CONSULTA ERA NULA, SOLO SE COMENTÓ LA CONDICIONAL

        //-------------------FIN MODIFICACION JAVIER

        // dd($num_semana_actual);
        $gerencias=Gerencias::all();
        $areas=Areas::all();
            // dd($request->id_gerencia_search);

            
            //Par mostrar las planificaciones de la semana actual
            $planificacion1 = Planificacion::find($request->id_gerencia_search);
            // dd($planificacion1);


            //para prueba
            /*$planificacion1 = Planificacion::where('semana',38)->where('id_gerencia',1)->first();
            $planificacion2 = Planificacion::where('semana',38)->where('id_gerencia',2)->first();
            $num_semana_actual=38;*/
            //------------------------------
            //dd($planificacion1);
            $planificacion = Planificacion::where('semana','>=',$num_semana_actual)->where('anio',session('fecha_actual'))->get();
            //actividades pm01
            //dd($planificacion);
            $actividades=Actividades::select('id_area','id',\DB::raw('task'))->where('tipo','PM02')->groupBy('task')->orderBy('id','DESC')->get();
            // dd(count($actividades));
            $id_area=$request->id_area_search;

            $envio=0;
            $empleados=\DB::table('empleados')->join('empleados_has_areas','empleados_has_areas.id_empleado','=','empleados.id')->join('areas','areas.id',"=","empleados_has_areas.id_area")
                ->select('empleados.*')->where('areas.id',$request->id_area_search)->get();
            // dd(count($empleados));


        return view("planificacion.index", compact('fechaHoy','planificacion','planificacion1','num_semana_actual','gerencias','actividades','id_area','areas','envio','empleados'));
    }

    public function moviendo_actividad_admin($id_actividad)
    {
        $actividad=ActividadesProceso::where('id_actividad',$id_actividad)->where('status','Finalizada')->first();
        $actividad->id_empleado=1;
        $actividad->save();

        $actividad=ActividadesProceso::where('id_actividad',$id_actividad)->where('id_empleado','<>',1)->get();
        foreach ($actividad as $key) {
            $key->delete();
        }


        return 1;
    }

    public function asignar_otra_actividad(Request $request)
    {
        dd($request->all());
    }

    public function actividades_sin_realizar($id_empleado)
    {
        $fecha=date(session('fecha_actual').'-m-d');
        $num_dia=num_dia($fecha);
        $num_semana_actual=date('W', strtotime($fecha));
        //dd($num_semana_actual);
        if ($num_dia==1 || $num_dia==2) {
                $num_semana_actual--;
        }
        return $actividades=\DB::table('actividades')->join('empleados_has_areas','empleados_has_areas.id_area','=','actividades.id_area')->join('empleados','empleados.id','=','empleados_has_areas.id_empleado')->join('areas','areas.id','=','empleados_has_areas.id_area')->join('planificacion','planificacion.id','=','actividades.id_planificacion')->select('actividades.*')->where('empleados.id',$id_empleado)->where('actividades.realizada','=','No')->where('planificacion.semana',$num_semana_actual)->where('planificacion.anio',session('fecha_actual'))->get();
        
    }

    public function mover_actividad_empleado(Request $request)
    {
        $actividad=ActividadesProceso::where('id_actividad',$request->id_actividad)->first();
        $actividad->id_empleado=$request->id_empleado;
        $actividad->save();

        return redirect()->to('home');
    }

    public function asignacion_multiple(Request $request)
    {
        //dd($request->all());

        // Si la variable "global" no está vacía, entonces es una asignación global

        if($request->id_empleados_search == null){
            flash('<i class="icon-circle-check"></i> No ha seleccionado a nungún empleado!')->warning()->important();
            return redirect()->back();
        }

        if ($request->global == 1) {

            $areas=Areas::find($request->id_area_search);
            $actividades=Actividades::where('id_planificacion', $request->id_gerencia_search)->where('id_area',$request->id_area_search)->get();
            $empleado=Empleados::find($request->id_empleados_search);
            $cant_actividades_asignadas=0;
            for ($i=0; $i < count($actividades) ; $i++) {
                $busca=ActividadesProceso::where('id_actividad',$actividades[$i]->id)->first();
                //dd($busca);
                if ($busca==null) {
                    \DB::table('actividades_proceso')->insert([
                        'id_actividad' => $actividades[$i]->id,
                        'id_empleado' => $request->id_empleados_search,
                        'hora_inicio' => "'".date(session('fecha_actual').'-m-d')." ".date('H:i:s')."'"
                    ]);
                    $cant_actividades_asignadas++;
                 }else{
                    $cant_personas=Actividades::find($busca->id_actividad);
                    $cant_actividad=ActividadesProceso::where('id_actividad',$busca->id_actividad)->get();
                    if ($cant_personas->cant_personas>count($cant_actividad)) {
                        $cant_actividad_empleado=ActividadesProceso::where('id_actividad',$busca->id_actividad)->where('id_empleado',$request->id_empleados_search)->first();
                        if ($cant_actividad_empleado==null) {
                            
                           \DB::table('actividades_proceso')->insert([
                            'id_actividad' => $actividades[$i]->id,
                            'id_empleado' => $request->id_empleados_search,
                            'hora_inicio' => "'".date(session('fecha_actual').'-m-d')." ".date('H:i:s')."'"
                            ]); 
                        }
                       $cant_actividades_asignadas++;
                    } 
                    

                 } 
            }
            if ($cant_actividades_asignadas==0) {
                flash('<i class="icon-circle-check"></i> No se asignó ninguna actividad</strong>  al empleado <strong>'.$empleado->nombres.'</strong>, debido a que las actividades ya fueron asignadas!')->warning()->important();    
            } else {
                if ($cant_actividades_asignadas!==count($actividades)) {
                    flash('<i class="icon-circle-check"></i> Solo se han asignado <strong>'.$cant_actividades_asignadas.'</strong> de las <strong>'.count($actividades).'</strong> actividades al empleado <strong>'.$empleado->nombres.'</strong>, al área <strong>'.$areas->area.'</strong> de forma exitosa, debido a que las demás ya han sido asignadas a otro empleado!')->success()->important();
                } else {
                    flash('<i class="icon-circle-check"></i> Se han asignado <strong>'.$cant_actividades_asignadas.'</strong> actividades al empleado <strong>'.$empleado->nombres.'</strong>, al área <strong>'.$areas->area.'</strong> de forma exitosa!')->success()->important();
                }
                
            }
            
            
            return redirect()->back();


            // dd('global');
        }else{ // Si no, entonces es una asignación específica


            // dd('específica');
                if ($request->id_actividad == null) {
                    flash('<i class="icon-circle-check"></i> No Seleccionó ninguna actividad para asignar!')->warning()->important();
                            return redirect()->back();   
                } else {
                    
                $x=0; //contador de las veces que hallado=0 y asignacos<cant_personas
                $y=0; //contador hallado >0
                $z=0; //contador asignados==cant_personas
                $empleado=Empleados::find($request->id_empleados_search);
                $hallado=0;
                $asignados=0;
                $registros=Array();
                $yaasignados=Array();
                $actividadlimite=Array();

                // dd($request->id_actividad);
                for ($i=0; $i < count($request->id_actividad); $i++) { 
                    // dd($request->id_actividad);
                $actividad=Actividades::find($request->id_actividad[$i]);
                    // dd($actividad);
                foreach ($actividad->empleados as $key) {
                    if ($key->pivot->id_empleado==$request->id_empleados_search) {
                        $hallado++;
                    }        
                    $asignados++;     
                }
                
                if ($hallado==0 and $asignados<$actividad->cant_personas) {
                
                \DB::table('actividades_proceso')->insert([
                    'id_actividad' => $request->id_actividad[$i],
                    'id_empleado' => $request->id_empleados_search,
                    'hora_inicio' => "'".date(session('fecha_actual').'-m-d')." ".date('H:i:s')."'"
                ]);

                $registros[$i][0]=$actividad->task;
                $registros[$i][1]=$empleado->nombres;
                $registros[$i][2]=$empleado->apellidos;
                $registros[$i][3]=$empleado->rut;
                    $x++;
                } else {
                    if ($hallado>0) {
                        $yaasignados[$i][0]=$actividad->task;
                        $yaasignados[$i][1]=$empleado->nombres;
                        $yaasignados[$i][2]=$empleado->apellidos;
                        $yaasignados[$i][3]=$empleado->rut;
                        $y++; 
                    } else {
                        if ($asignados==$actividad->cant_personas) {
                            $actividadlimite[$i]=$actividad->task;
                            $z++;
                        }
                    }
                    
                }
            }//fin del for
                
                
                for ($i=0; $i < count($registros) ; $i++) { 
                    if ($x>0) {
                        flash('<i class="icon-circle-check"></i> La Actividad: '.$registros[$i][0].' <br> Fue Asignada al empleado:'.$registros[$i][2].', '.$registros[$i][1].', RUT: '.$registros[$i][3].'!')->success()->important();
                                //return redirect()->to('planificacion');   
                    }
                } 
                for ($i=0; $i < count($yaasignados) ; $i++) { 
                    if ($y>0) {
                           flash('<i class="icon-circle-check"></i> La Actividad: '.$yaasignados[$i][0].' <br>ya ha sido Asignada al empleado:'.$yaasignados[$i][2].', '.$yaasignados[$i][1].', RUT: '.$yaasignados[$i][3].'!')->warning()->important();
                                //return redirect()->to('planificacion');
                    }
                }
                for ($i=0; $i < count($actividadlimite) ; $i++) { 
                    if ($z>0) {
                           flash('<i class="icon-circle-check"></i> La Actividad: '.$actividadlimite[$i].'  ya alcanzó el límite de empleados ha asignarse!')->warning()->important();
                            //return redirect()->to('planificacion'); 
                    }
                }
                   
                    
                
                 return redirect()->back();   
                }//fin del else
                

            }//fin de la funcion asignar multiple
        }


        public function buscar_actividad($id_area, $id_planificacion,$tipo)
        {
            return $actividades=Actividades::where('id_area', $id_area)->where('id_planificacion',$id_planificacion)->where('tipo',$tipo)->get();
        }

        public function buscar_actividad2($id_area, $id_planificacion)
        {
            return $actividades=Actividades::where('id_area', $id_area)->where('id_planificacion',$id_planificacion)->get();
        }
        public function buscar_actividad3($id_area, $id_planificacion)
        {
            return $actividades=\DB::table('actividades_proceso')
            ->join('actividades','actividades.id','=','actividades_proceso.id_actividad')
            ->join('empleados','empleados.id','=','actividades_proceso.id_empleado')
            ->join('areas','areas.id','=','actividades.id_area')
            ->join('planificacion','planificacion.id','=','actividades.id_planificacion')
            ->join('gerencias','gerencias.id', '=', 'planificacion.id_gerencia')
            ->where('actividades.id_area',$id_area)
            ->where('actividades.id_planificacion',$id_planificacion)
            ->where('planificacion.anio',session('fecha_actual'))
            ->select('actividades.*','areas.area','gerencias.gerencia','empleados.*')->get();
        }

        public function buscar_actividades_eliminar()
        {
            //dd("dfghjkl");
            //$planificaciones=planificacion::all();
        //averiguando en que semana estamos
            $fechaHoy = date(session('fecha_actual').'-m-d');
            $num_dia=num_dia($fechaHoy);
            $num_semana_actual=date('W', strtotime($fechaHoy));
            if ($num_dia==1 || $num_dia==2) {
                $num_semana_actual--;
                }
            $planificaciones=\DB::table('planificacion')
            ->join('actividades','actividades.id_planificacion','=','planificacion.id')
            ->join('gerencias','gerencias.id', '=', 'planificacion.id_gerencia')
            ->where('semana','>=',$num_semana_actual)
            ->where('planificacion.anio',session('fecha_actual'))
            ->select('planificacion.*','gerencias.gerencia')
            ->groupBy('id_planificacion')
            ->get();

            // dd(count($planificaciones));
            //$planificaciones=Actividades::groupBy('task')->orderBy('id','DESC')->get();
            return view('planificacion.asignaciones.eliminar_actividades', compact('planificaciones'));
        }

        public function eliminar_actividades_multiple(Request $request)
        {
            // -------------------GLOBAL
                // dd($request->all());
            if ($request->global == 1) {

                $areas= Areas::find($request->id_area_search);
                // dd($request->id_area_search);
                $actividades=Actividades::where('id_area', $request->id_area_search)
                ->where('id_planificacion',$request->id_gerencia_search)
                ->where('tipo', $request->tipo_actividad)
                ->delete();

                // dd(count($actividades));
                    // for ($i=0; $i < count($actividades); $i++) { 
                    //     $actividades[$i]->delete();
                    // }

                flash('<i class="icon-circle-check"></i> Las actividades del área '.$areas->area.' y del tipo '.$request->tipo_actividad.' Han sido eliminados con éxito!')->success()->important();
                return redirect()->back();

            // ----------------------ESPECÍFICO
            }else{

                
                if ($request->id_actividad == null) {
                    flash('<i class="icon-circle-check"></i> No seleccionó ninguna actividad para eliminar!')->warning()->important();
                            return redirect()->back();   
                } else {
                    for ($i=0; $i < count($request->id_actividad); $i++) {

                        $actividades=Actividades::find($request->id_actividad[$i])->delete();
                    }

                    flash('<i class="icon-circle-check"></i> Se han eliminado '.count($request->id_actividad).' actividad(es) de forma exitosa!')->success()->important();
                    return redirect()->back();
                }

            }// Fin del eliminado específico
        }

    public function buscar_mis_actividades($dia,$id_planificacion,$id_area)
    {
        switch ($dia) {
            case 7:
                $dia="Dom";
                break;
            case 1:
                $dia='Lun';
                break;
            case 2:
                $dia='Mar';
                break;
            case 3:
                $dia='Mié';
                break;
            case 4:
                $dia='Jue';
                break;
            case 5:
                $dia='Vie';
                break;
            case 6:
                $dia='Sáb';
                break;
        }
        $empleado=Empleados::where('id_usuario', \Auth::user()->id)->first();
        

        return $actividades=\DB::table('actividades_proceso')
            ->join('actividades','actividades.id','=','actividades_proceso.id_actividad')
            ->join('planificacion','planificacion.id','=','actividades.id_planificacion')
            ->join('areas','areas.id','=','actividades.id_area')
            ->join('gerencias','gerencias.id','planificacion.id_gerencia')
            ->join('departamentos','departamentos.id','=','actividades.id_departamento')
            ->where('actividades_proceso.id_empleado',$empleado->id)
            ->where('planificacion.id',$id_planificacion)
            ->where('actividades.id_area',$id_area)
            ->where('actividades.dia',$dia)
            // ->where('planificacion.anio',session('fecha_actual'))
            ->select('actividades.*','areas.area','gerencias.gerencia','departamentos.departamento','planificacion.elaborado','planificacion.aprobado','planificacion.fechas','planificacion.semana','planificacion.revision','planificacion.num_contrato')
            ->get();
        
    }

    public function buscar_mis_actividades2($id_planificacion,$id_area)
    {
        
        // return $actividades=Actividades::where('id_planificacion',$id_planificacion)->where('id_area',$id_area)->get();        

        return $actividades=\DB::table('actividades')
        // ->join('actividades','actividades.id','=','actividades_proceso.id_actividad')
        ->join('planificacion','planificacion.id','=','actividades.id_planificacion')
        ->join('areas','areas.id','=','actividades.id_area')
        ->join('gerencias','gerencias.id','planificacion.id_gerencia')
        ->join('departamentos','departamentos.id','=','actividades.id_departamento')
        // ->where('actividades_proceso.id_empleado',$empleado->id)
        ->where('planificacion.id',$id_planificacion)
        ->where('actividades.id_area',$id_area)
        // ->where('planificacion.anio',session('fecha_actual'))
        // ->where('actividades.dia',$dia)
        ->select('actividades.*','areas.area','gerencias.gerencia','departamentos.departamento','planificacion.elaborado','planificacion.aprobado','planificacion.fechas','planificacion.semana','planificacion.revision','planificacion.num_contrato')->get();
        
    }

    public function buscar_planificacion_por_area($id_area)
    {
        $areas=Areas::find($id_area);

       //return $planificacion=Planificacion::where('id_gerencia',$areas->id_gerencia)->get();
        //return $areas->id_gerencia;
        return $planificacion=\DB::table('planificacion')->join('gerencias','gerencias.id','=','planificacion.id_gerencia')->where('planificacion.anio',session('fecha_actual'))->where('planificacion.id_gerencia',$areas->id_gerencia)->select('planificacion.*','gerencias.gerencia')->get();
    }

    public function asignada($id_actividad)
    {
        return $buscar=\DB::table('actividades_proceso')
        ->join('actividades','actividades.id','=','actividades_proceso.id_actividad')
        ->join('empleados','empleados.id','=','actividades_proceso.id_empleado')
        ->where('actividades_proceso.id_actividad',$id_actividad)
        ->select('empleados.*')
        ->get();
    }

    function comentarios_actividad($id_actividad)
{
    $buscar=\DB::table('actividades_proceso')->where('id_actividad',$id_actividad)->select('id')->get();
    $comentarios="";
    if (count($buscar)>0) {
        for ($i=0; $i < count($buscar); $i++) { 
            $buscar2=\DB::table('actividades_comentarios')->where('id_actv_proceso',$buscar[$i]->id)->select('comentario')->get();
            if (count($buscar2)>0) {
                for ($j=0; $j < count($buscar2); $j++) { 
                    $comentarios.=$buscar2[$j]->comentario;
                    $comentarios.="\n";
                }
            }
        }
    }
    return $comentarios;
}

public function buscar_areas_editar($id_area)
{
    return $areas=Areas::where('id','>',0)->get();


}
public function buscar_planificacion_editar($id_planificacion)
{
    return $planificacion=\DB::table('planificacion')
    ->join('gerencias','gerencias.id','=','planificacion.id_gerencia')
    ->where('planificacion.anio',session('fecha_actual'))
    ->select('planificacion.id','planificacion.semana','planificacion.fechas','gerencias.gerencia')
    ->get();


}

public function validar_clave(Request $request){

    
     if(\Hash::check($request->clave, \Auth::user()->password)){
        return 1;
     }else{
        return 0;
     }
    
}
    public function buscar_actividad_registrada($id_actividad)
    {
        return $actividad=Actividades::where('id',$id_actividad)->first();
    }
}

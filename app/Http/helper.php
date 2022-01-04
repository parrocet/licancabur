<?php
date_default_timezone_set('UTC');
function active($path){
   // dd(request()->is($path));
    return request()->is($path) ? "active" : " ";
}

function total_empleados()
{

	$total=App\Empleados::count();
	return $total;
}
function meses($num_mes)
{
	switch ($num_mes) {
		case 1:
			return "Enero";
			break;
		case 2:
			return "Febrero";
			break;
		case 3:
			return "Marzo";
			break;
		case 4:
			return "Abril";
			break;
		case 5:
			return "Mayo";
			break;
		case 6:
			return "Junio";
			break;
		case 7:
			return "Julio";
			break;
		case 8:
			return "Agosto";
			break;
		case 9:
			return "Septiembre";
			break;
		case 10:
			return "Octubre";
			break;
		case 11:
			return "Noviembre";
			break;
		case 12:
			return "Diciembre";
			break;
	}
}
function dia($fecha)
{
	$dia="";
	$var=date("D",strtotime($fecha));
	switch ($var) {
		case 'Wed':
			$dia="Mié";
			break;
		case 'Thu':
			$dia="Jue";
			break;
		case 'Fri':
			$dia="Vie";
			break;
		case 'Sat':
			$dia="Sáb";
			break;
		case 'Sun':
			$dia="Dom";
			break;
		case 'Mon':
			$dia="Lun";
			break;
		case 'Tue':
			$dia="Mar";
			break;/*
		default:
			$dia=$var;
			break;*/
	}

	return $dia;
}
function num_dia($fecha)
{
    $dia=0;
    $var=date("D",strtotime($fecha));
    switch ($var) {
        case 'Wed':
            $dia=3;
            break;
        case 'Thu':
            $dia=4;
            break;
        case 'Fri':
            $dia=5;
            break;
        case 'Sat':
            $dia=6;
            break;
        case 'Sun':
            $dia=7;
            break;
        case 'Mon':
            $dia=1;
            break;
        case 'Tue':
            $dia=2;
            break;/*
        default:
            $dia=$var;
            break;*/
    }

    return $dia;
}
function buscar_p($modulo,$privilegio)
{
	$hallado="No";
	$privilegio=App\Privilegios::where('privilegio',$privilegio)->where('modulo',$modulo)->first();
    if(!is_null($privilegio)){
    	foreach ($privilegio->usuarios as $key) {
    		
    		if ($key->pivot->id_usuario==\Auth::user()->id) {
    			$hallado=$key->pivot->status;
    		}
    	}
    }
	return $hallado;
}

function buscar_actividades_area($semana,$id_area)
{
	$hallado="No";

	$planificacion=App\Planificacion::where('semana',$semana)->where('anio',session('fecha_actual'))->get();

	if (count($planificacion)>0) {
  //   foreach($planificacion as $key1){
		// foreach ($key1->actividades as $key) {
  //           //echo $key->id_area."---";
  //   		if ($key->id_area==$id_area) {
    			$hallado="Si";
  //   		}
		// }
    // }	
	} else {
		$hallado="No";
	}
	//dd($hallado);
	
	return $hallado;
}
function tiempos($planificacion,$id_area)
{
	if(empty($planificacion)){
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
        foreach ($planificacion->actividades as $key) {
            if ($id_area==$id_area) {
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

        if ($encontrado==1) {
        	return $tiempos;
        } else {
        	return "";
        }
        
}

function tareas($id_area)
{
    $hallado=0;
    $total=0;
    $realizadas=0;
    $porcentaje=0;
    $anio=session('fecha_actual');
    $fecha=date($anio.'-m-d');
    $num_dia=num_dia($fecha);
        $num_semana_actual=date('W', strtotime($fecha));
        //dd($num_semana_actual);
        if ($num_dia==1 || $num_dia==2) {
                $num_semana_actual--;
        }
        //para buscar las actividades realizadas en la semana actual

        $planificaciones=App\Planificacion::where('semana',$num_semana_actual)->where('anio',$anio)->get();
        $contar=0;
        if (count($planificaciones)>0) {
            # si se encontraron planificaciones en la semana actual
            #verificar que actividades de esas planificaciones se encuentran realizadas
            foreach ($planificaciones as $key1) {
                
                foreach ($key1->actividades as $key) {
                        //averiguando el total de actividades registradas para la planificacion
                        //y el area seleccionada
                        if ($key->id_area==$id_area) {
                            $total++;
                        }
                        if ($key->id_area==$id_area && $key->realizada=="Si") {
                            $realizadas++;
                        }
                }
            }

            if ($total>0) {
                $porcentaje=($realizadas*100)/$total;
                $porcentaje=bcdiv($porcentaje,'1',2);
            } else {
                $porcentaje=0;
            }
        }
    
    return $porcentaje;
}

function tarea_terminada()
{
    $anio=session('fecha_actual');
    $fecha=date($anio.'-m-d');
    $num_dia=num_dia($fecha);
        $num_semana_actual=date('W', strtotime($fecha));
        //dd($num_semana_actual);
        if ($num_dia==1 || $num_dia==2) {
                $num_semana_actual--;
        }
        //para buscar las actividades realizadas en la semana actual

        $planificaciones=App\Planificacion::where('semana',$num_semana_actual)->where('anio',$anio)->get();
        $contar=0;
        if (count($planificaciones)>0) {
            # si se encontraron planificaciones en la semana actual
            #verificar que actividades de esas planificaciones se encuentran realizadas
            foreach ($planificaciones as $key1) {
                
                foreach ($key1->actividades as $key) {
                    //dd($key->realizada);
                    if ($key->realizada=="Si") {
                        #al encontrarla verificamos si ha sido vista
                        $encontrar=App\ActividadesVistas::where('id_actividad',$key->id)->first();
                        //dd($encontrar);
                        if (is_null($encontrar)) {
                            # si no fue encontrada en las vistas
                            # se debe registrar y colocar como no ha sido vista
                            $vista= new App\ActividadesVistas();
                            $vista->id_actividad=$key->id;
                            $vista->status="No";
                            $vista->save();
                            $id_actividad_vista=$vista->id;
                        }
                      $contar++;                  
                    }
                }

            }
        }
        
        //dd($contar);
        //despues de registrar las no vistas en la tabla
        // se consultan esas no vistas y se guardan en el array
        $actividades_vistas=array();
        $no_vistas=App\ActividadesVistas::where('status','No')->get();
        $i=0;
        if (count($no_vistas)>0) {
            foreach ($no_vistas as $key) {
                $task=$key->actividades->task;
                foreach ($key->actividades->empleados as $key2) {
                    $actividades_vistas[$i][0]=$key2->nombres." ".$key2->apellidos;
                    $actividades_vistas[$i][1]=$task;
                    $actividades_vistas[$i][2]=$key->id_actividad;
                    $actividades_vistas[$i][3]=$key2->id_empleado;
                $i++;
                }
            }
        }


    //dd(count($actividades_vistas));

    return $actividades_vistas;   
}

function total_tarea_terminada()
{
    $anio=session('fecha_actual');
    $fecha=date($anio.'-m-d');
    $num_dia=num_dia($fecha);
        $num_semana_actual=date('W', strtotime($fecha));
        //dd($num_semana_actual);
        if ($num_dia==1 || $num_dia==2) {
                $num_semana_actual--;
        }
        //para buscar las actividades realizadas en la semana actual

        $planificaciones=App\Planificacion::where('semana',$num_semana_actual)->where('anio',$anio)->get();
        $contar=0;
        if (count($planificaciones)>0) {
            # si se encontraron planificaciones en la semana actual
            #verificar que actividades de esas planificaciones se encuentran realizadas
            foreach ($planificaciones as $key1) {
                
                foreach ($key1->actividades as $key) {
                    //dd($key->realizada);
                    if ($key->realizada=="Si") {
                        #al encontrarla verificamos si ha sido vista
                        $encontrar=App\ActividadesVistas::where('id_actividad',$key->id)->first();
                        //dd($encontrar);
                        if (is_null($encontrar)) {
                            # si no fue encontrada en las vistas
                            # se debe registrar y colocar como no ha sido vista
                            $vista= new App\ActividadesVistas();
                            $vista->id_actividad=$key->id;
                            $vista->status="No";
                            $vista->save();
                            $id_actividad_vista=$vista->id;
                        }
                      $contar++;                  
                    }
                }

            }
        }
        
        //dd($contar);
        //despues de registrar las no vistas en la tabla
        // se consultan esas no vistas y se guardan en el array
        $actividades_vistas=array();
        $no_vistas=App\ActividadesVistas::where('status','No')->get();
        $i=0;
        if (count($no_vistas)>0) {
            foreach ($no_vistas as $key) {
                $task=$key->actividades->task;
                foreach ($key->actividades->empleados as $key2) {
                    $actividades_vistas[$i][0]=$key2->nombres." ".$key2->apellidos;
                    $actividades_vistas[$i][1]=$task;
                    $actividades_vistas[$i][2]=$key->id_actividad;
                    $actividades_vistas[$i][3]=$key2->id_empleado;
                $i++;
                }
            }
        }
    return count($actividades_vistas);   
}

function mensajes()
{
    $anio=session('fecha_actual');
    $fecha=date($anio.'-m-d');
    $num_dia=num_dia($fecha);
        $num_semana_actual=date('W', strtotime($fecha));
        //dd($num_semana_actual);
        if ($num_dia==1 || $num_dia==2) {
                $num_semana_actual--;
        }
        //para buscar las actividades realizadas en la semana actual

        $planificaciones=App\Planificacion::where('semana',$num_semana_actual)->where('anio',$anio)->get();
        $contar=0;
        $id_actividad_visto=array();
        $id_empleado=array();
        $i=0;
        if (count($planificaciones)>0) {
            # si se encontraron planificaciones en la semana actual
            #verificar que actividades de esas planificaciones se encuentran realizadas
            foreach ($planificaciones as $key) {
                
                foreach ($key->actividades as $key2) {
                    //dd($key->realizada);
                    
                    $actividad_proceso=App\ActividadesProceso::where('id_actividad',$key2->id)->get();
                    foreach ($actividad_proceso as $key3) {
                        //echo count($key3->comentarios);
                        if (count($key3->comentarios)>0) {

                            foreach ($key3->comentarios as $key5) {
                                $encontrar=App\ComentariosVistos::where('id_comentario',$key5->id)->first();

                                if (is_null($encontrar)) {
                                    # si no fue encontrada en las vistas
                                    # se debe registrar y colocar como no ha sido vista
                                    $visto= new App\ComentariosVistos();
                                    $visto->id_comentario=$key5->id;
                                    $visto->status="No";
                                    $visto->id_actividad=$key2->id;
                                    $visto->id_empleado=$key3->id_empleado;
                                    $visto->save();
                                }
                              $contar++;
                            }
                        
                        }
                    }
                }
            }
        }
        
        //dd($contar);
        //despues de registrar las no vistas en la tabla
        // se consultan esas no vistas y se guardan en el array
        $cometarios_vistos=array();
        $no_vistos=App\ComentariosVistos::where('status','No')->get();
        $i=0;

        if (count($no_vistos)>0) {
            foreach ($no_vistos as $key) {
                
                $cometarios_vistos[$i][0]=$key->comentarios->comentario;
                $cometarios_vistos[$i][1]=$key->comentarios->usuarios->email;
                $cometarios_vistos[$i][2]=$key->id_actividad;
                $cometarios_vistos[$i][3]=$key->id_empleado;
                $cometarios_vistos[$i][4]=$key->id_comentario;
                $i++;
                
            }
        }


    //dd($cometarios_vistos);

    return $cometarios_vistos;   
        
}

function total_mensajes()
{
    $anio=session('fecha_actual');
    $fecha_vencimiento=date($anio.'-m-d');
    $buscar=App\Actividades::where('fecha_vencimiento',$fecha_vencimiento)->get();
    $cont=0;
    foreach ($buscar as $key) {
        $actividad=App\ActividadesProceso::where('id_actividad',$key->id)->get();
        foreach ($actividad as $key2) {
            foreach ($key2->comentarios as $key3) {
                $encontrar=App\ComentariosVistos::where('id',$key3->id)->get();
                if (count($encontrar)==0) {
                    $visto=new App\ComentariosVistos();
                    $visto->id_comentario=$key3->id;
                    $visto->status="No";
                    $visto->save();
                }
            }
        }
    }
    $buscar_vistos=App\ComentariosVistos::where('status','No')->get();
    return count($buscar_vistos);
}

function semana_actual(){
    $anio=session('fecha_actual');
    $fechaHoy = date($anio.'-m-d');
    $num_dia=num_dia($fechaHoy);
    $num_semana_actual=date('W', strtotime($fechaHoy));
    if ($num_dia==1 || $num_dia==2) {
        $num_semana_actual--;
    }

    return $num_semana_actual;
}
function mensajes_en_actividad($id_actividad)
{

    $cont=0;
        $actividad=App\ActividadesProceso::where('id_actividad',$id_actividad)->get();
        foreach ($actividad as $key2) {
            foreach ($key2->comentarios as $key3) {     
                $cont++;
            }
        }
    

    return $cont;
}

function files_en_actividad($id_actividad)
{

    $cont=0;
    //archivos adjuntados el registrar la actividad
        $actividad=App\ArchivosPlan::where('id_actividad',$id_actividad)->where('tipo','file')->get();
    $cont+=count($actividad);
    //archivos agregados luego
        $actividad=App\ActividadesProceso::where('id_actividad',$id_actividad)->get();
        foreach ($actividad as $key) {
            foreach ($key->archivos as $key2) {
                if ($key2->tipo=="file") {
                    $cont++;
                }
            }
        }
    

    return $cont;
}

function imgs_en_actividad($id_actividad)
{

    $cont=0;
    //archivos adjuntados el registrar la actividad
        $actividad=App\ArchivosPlan::where('id_actividad',$id_actividad)->where('tipo','img')->get();
    $cont+=count($actividad);
    //archivos agregados luego
        $actividad=App\ActividadesProceso::where('id_actividad',$id_actividad)->get();
        foreach ($actividad as $key) {
            foreach ($key->archivos as $key2) {
                if ($key2->tipo=="img") {
                    $cont++;
                }
            }
        }
    

    return $cont;
}
function areas()
{
    if (\Auth::User()->tipo_user=="G-NPI") {
        $areas=App\Areas::where('id_gerencia',1)->get();
    } else if(\Auth::User()->tipo_user=="G-CHO"){
        $areas=App\Areas::where('id_gerencia',2)->get();
    } else {
        $areas=App\Areas::all();
    }
    
     return $areas;
}

function areas_empleado($id_empleado)
{
    $empleado=App\Empleados::find($id_empleado);

    return $empleado->areas;
}

function examenes_empleado($id_empleado)
{
    $empleado=App\Empleados::find($id_empleado);

    return $empleado->examenes;
}

function departamentos_empleado($id_empleado)
{
    $empleado=App\Empleados::find($id_empleado);

    return $empleado->departamentos;
}

function isapre_empleado($id_empleado)
{
    $empleado=App\Empleados::find($id_empleado);

    return $empleado->isapre;
}

function afp_empleado($id_empleado)
{
    $empleado=App\Empleados::find($id_empleado);

    return $empleado->afp;
}

function areasEmpresa_empleado($id_empleado)
{
    $empleado=App\Empleados::find($id_empleado);

    return $empleado->areasempresa;
}

function faenas_empleado($id_empleado)
{
    $empleado=App\Empleados::find($id_empleado);

    return $empleado->faenas;
}

function actividad_asignada($id_actividad)
{
    $buscar=\DB::table('actividades_proceso')->where('id_actividad',$id_actividad)->select('*')->get();

    return count($buscar);
}
function actividad_asignada2($id_actividad)
{
    $buscar=\DB::table('actividades_proceso')->where('id_actividad',$id_actividad)->select('*')->get();

    if (count($buscar)>0) {
        return "Si";
    } else {
        return "No";
    }
    
    
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

function anios_planificacion()
{
    
    $buscar=App\Planificacion::where('semana',1)->get();
    $anios[]= array();
    $anios[0]="";
    $i=0;
    $cont=0;
    foreach ($buscar as $key) {
        $a=substr($key->fechas,-4);
        for ($j=0; $j < count($anios); $j++) { 
            if($a==$anios[$j]){
                $cont++;
            }
        }        
        if($cont==0){
            $anios[$i]=$a;
        }
        $i++;
    }
    return $anios;
}

function buscar_pm02()
{
    return $actividades=App\Actividades::select('id_area','id',\DB::raw('task'))->where('tipo','PM02')->groupBy('task')->orderBy('id','DESC')->get();
}

function mostrar_semana($semana){

    $buscar=App\Planificacion::where('semana',$semana)->where('anio',session('fecha_actual'))->count();

    return $buscar;
}
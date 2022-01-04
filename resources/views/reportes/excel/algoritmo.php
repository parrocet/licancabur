<?php

if ($request->planificacion!=0) {
	$condicion_plan=" && planificacion.semana=".$request->planificacion." ";
} else {
	$condicion_plan="";
}

if ($request->gerencias!=0) {
	$condicion_geren=" && gerencias.id=".$request->gerencias." ";
} else {
	$condicion_geren="";
}

if ($request->areas!=0) {
	$condicion_areas=" && areas.id=".$request->areas." ";
} else {
	$condicion_areas="";
}

if ($request->tipo!=0) {
	$condicion_tipo=" && actividades.tipo='".$request->tipo."' ";
} else {
	$condicion_tipo="";
}

if ($request->realizadas!=0) {
	$condicion_realizadas=" && planificacion.realizada='".$request->realizadas."' ";
} else {
	$condicion_realizadas="";
}

if ($request->dias!=0) {
	$condicion_dias=" && actividades.dias='".$request->dias."' ";
} else {
	$condicion_dias="";
}

$sql="SELECT * FROM planificacion,actividades,gerencias,areas WHERE 
planificacion.id_gerencias = gerencias.id && 
actividades.id_area=areas.id && 
actividades.id_planificacion=planificacion.id ".$condicion_plan." ".$condicion_geren." ".$condicion_areas." ".$condicion_realizadas." ".$condicion_tipo." ".$condicion_dias."";

$resultado=\DB::select($sql);
<?php
  libxml_use_internal_errors(true);
  
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	  <title>Reporte cronológico de Actividades</title>
	  <link rel="stylesheet" href="{{ asset('css/table_excel.css') }}">
	  <style>
	    #fila {
	  		background: #F9E79F;
		}
	  
	  </style>
	</head>
	<body>		
<table>
	<tr><td colspan="12"><center><h1>Reporte de Actividades</h1></center></td></tr>
	<tr><td colspan="12" style="background-color: #e5be01;"><h1>{{ $areas }}</h1></td></tr>
	<tr><td colspan="12"><h4>Total de actividades: {{$resultado}}</h4></td></tr>
	<tr style="border-color: #000000">
		<td></td>
		<td ></td>
		<td  style="background-color: #f5b7b1; width: 10px; height: 50px; text-align: center; font-size: 10;">TOTAL DE ACTIVIDADES<br>REALIZADAS</td>
		<td  style="background-color: #f5b7b1; width: 10px; height: 50px; text-align: center; font-size: 10;">TOTAL DE ACTIVIDADES<br>NO REALIZADAS</td>
		<td  style="background-color: #f5b7b1; width: 10px; height: 50px; text-align: center; font-size: 10;">TOTAL DE ACTIVIDADES<br>PLANIFICADAS</td>
		<td ></td>
		<td ></td>
		<td ></td>
		<td ></td>
		<td></td>
		<td style="background-color: #abebc6; width: 20px; height: 50px; text-align: center">TOTAL DE MINUTOS<br>REALIZADOS</td>
		<td style="background-color: #abebc6; width: 20px; height: 50px; text-align: center">TOTAL DE MINUTOS<br>PROYECTADOS</td>
	</tr>

	<tr>
		<td></td>
		<td>PM01</td>
		<td><b>{{$acti_realizadas_PM01}}</b></td>
		<td><b>{{$acti_Nrealizadas_PM01}}</b></td>
		<td><b>{{$total_pm01}}</b></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>PM01</td>
		<td>{{$duracion_real_pm01}}</td>
		<td style="background-color: #B2BABB;"><b>---</b></td>
	</tr>
	<tr>
		<td></td>
		<td>PM02</td>
		<td><b>{{$acti_realizadas_PM02}}</b></td>
		<td><b>{{$acti_Nrealizadas_PM02}}</b></td>
		<td><b>{{$total_pm02}}</b></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>PM02</td>
		<td>{{$duracion_real_pm02}}</td>
		<td>{{$duracion_pro_pm02}}</td>
	</tr>
	<tr>
		<td></td>
		<td>PM03</td>
		<td><b>{{$acti_realizadas_PM03}}</b></td>
		<td style="background-color: #B2BABB;"><b>---</b></td>
		<td style="background-color: #B2BABB;"><b>---</b></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>PM03</td>
		<td>{{$duracion_real_pm03}}</td>
		<td style="background-color: #B2BABB;"><b>---</b></td>
	</tr>
	{{--<tr>
		<td></td>
		<td>PM04</td>
		<td><b>{{$acti_realizadas_PM04}}</b></td>
		<td><b>{{$acti_Nrealizadas_PM04}}</b></td>
		<td><b>{{$total_pm04}}</b></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td>PM04</td>
		<td>{{$duracion_real_pm04}}</td>
		<td style="background-color: #B2BABB;"><b>---</b></td>
	</tr>--}}
					
				
</table>
	</body>
</html>
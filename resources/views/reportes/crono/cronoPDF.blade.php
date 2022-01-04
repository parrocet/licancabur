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
	<body style="width: 100%;">
		<?php $image_path = '/assets/img/bienen.jpg'; ?>
		<center><h1>Reporte de Actividades</h1></center>
		<h1 style="background-color: yellow;">{{$areas}}</h1>
		<hr>
		<h4>Total de actividades: {{$resultado}}</h4>
		<table width="100%">
			<tr>
				<td width="50%">
					<table border="1px" width="40%">
					<thead>
						<tr>
							<th width="10%"></th>
							<th width="10%" style="background-color: #f5b7b1">Total de actividades realizadas</th>
							<th width="10%" style="background-color: #f5b7b1">Total de actividades NO realizadas</th>
							<th width="10%" style="background-color: #f5b7b1">Total de actividades planificadas</th>
						</tr>
					</thead>
					<tbody align="center">
						<tr>
							<td>PM01</td>
							<td><strong>{{$acti_realizadas_PM01}}</strong></td>
							<td><strong>{{$acti_Nrealizadas_PM01}}</strong></td>
							<td><strong>{{$total_pm01}}</strong></td>
						</tr>
						<tr>
							<td>PM02</td>
							<td><strong>{{$acti_realizadas_PM02}}</strong></td>
							<td><strong>{{$acti_Nrealizadas_PM02}}</strong></td>
							<td><strong>{{$total_pm02}}</strong></td>
						</tr>
						<tr>
							<td>PM03</td>
							<td><strong>{{$acti_realizadas_PM03}}</strong></td>
							<td style="background-color: #B2BABB;"><strong>---</strong></td>
							<td style="background-color: #B2BABB;"><strong>---</strong></td>
						</tr>
						{{--<tr>
							<td>PM04</td>
							<td><strong>{{$acti_realizadas_PM04}}</strong></td>
							<td><strong>{{$acti_Nrealizadas_PM04}}</strong></td>
							<td><strong>{{$total_pm04}}</strong></td>
						</tr>--}}
					</tbody>
				</table>
				</td>
				<td width="50%">
					<table border="1px" width="60%">
					<thead>
						<tr>
							<th width="20%" border="0"></th>
							<th width="20%" style="background-color: #abebc6">Total de minutos realizados</th>
							<th width="20%" style="background-color: #abebc6">Total de minutos proyectados</th>
						</tr>
					</thead>
					<tbody align="center">
						<tr>
							<td>PM01</td>
							<td>{{$duracion_real_pm01}}</td>
							<td>{{$duracion_pro_pm01}}</td>
						</tr>
						<tr>
							<td>PM02</td>
							<td>{{$duracion_real_pm02}}</td>
							<td>{{$duracion_pro_pm02}}</td>
						</tr>
						<tr>
							<td>PM03</td>
							<td>{{$duracion_real_pm03}}</td>
							<td style="background-color: #B2BABB;"><strong>---</strong></td>
						</tr>
						{{--<tr>
							<td>PM04</td>
							<td>{{$duracion_real_pm04}}</td>
							<td style="background-color: #B2BABB;"><strong>---</strong></td>
						</tr>--}}
					</tbody>
				</table>
				</td>
			</tr>
			<tr>
				<td colspan="2" width="100%"><hr></td>
			</tr>
			{{-- <tr>
				<td>
					<table border="1px" width="60%">
						<tr>
							<td align="center" width="40%" style="background-color: #eeeeee"><b>HORAS ADMINISTRATIVAS MENSUALES</b></td>
							<td align="center" width="20%">0</td>
						</tr>
						<tr>
							<td align="center" width="40%" style="background-color: #eeeeee"><b>Cursos Online de Mutual</b></td>
							<td align="center" width="20%">0</td>
						</tr>
						<tr>
							<td align="center" width="40%" style="background-color: #eeeeee"><b>Reuniones de Seguridad</b></td>
							<td align="center" width="20%">0</td>
						</tr>
						<tr>
							<td align="center" width="40%" style="background-color: #eeeeee"><b>Entrega de Turno</b></td>
							<td align="center" width="20%">0</td>
						</tr>
						<tr>
							<td align="center" width="40%" style="background-color: #eeeeee"><b>Recepción de Turno</b></td>
							<td align="center" width="20%">0</td>
						</tr>
						<tr>
							<td align="center" width="40%" style="background-color: #eeeeee"><b>Actividades de Seguridad OPS</b></td>
							<td align="center" width="20%">0</td>
						</tr>
						<tr>
							<td align="center" width="40%" style="background-color: #eeeeee"><b>Temas Administrativos</b></td>
							<td align="center" width="20%">0</td>
						</tr>
					</table>
				</td>
				<td>
					<table border="1px" width="60%">
						<tr>
							<td align="center" width="40%" style="background-color: #ffc08c"><b>Total HH para el mes</b></td>
							<td align="center" width="20%" style="background-color: #ffc08c">0</td>
						</tr>
						<tr>
							<td align="center" width="40%" style="background-color: #ffc08c"><b>Total HH realizadas mes</b></td>
							<td align="center" width="20%" style="background-color: #ffc08c">0</td>
						</tr>
						<tr>
							<td align="center" width="40%" style="background-color: #ffc08c"><b>Horas disponibles mes</b></td>
							<td align="center" width="20%">0</td>
						</tr>
						<tr>
							<td align="center" width="40%" style="background-color: #ffc08c"><b>Horas disponibles diarias</b></td>
							<td align="center" width="20%">0</td>
						</tr>
						<tr>
							
							<td colspan="2"><br></td>
						</tr>
						<tr>
							<td align="center" width="40%" style="background-color: #ffc08c"><b>PM02 sin hacer ambas plantas</b></td>
							<td align="center" width="20%">0</td>
						</tr>
					</table>
				</td>
			</tr> --}}
		</table>		
	</body>
</html>
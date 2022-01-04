<?php
  libxml_use_internal_errors(true);
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Reporte de Actividades</title>
  <link rel="stylesheet" href="{{ asset('css/table_excel.css') }}">
  <style>
    #fila {
  background: #F9E79F;
}
  
  </style>
</head>
<body>
<?php $image_path = '/assets/img/bienen.jpg'; ?>
<table border="1px" width="100%">
  {{-- <thead> --}}
    @for($i=0; $i<count($planificacion);$i++)
    <tr>
      <td colspan="13">&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td colspan="13">&nbsp;&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;&nbsp;</td>
      <td style="font-size: ; height: 30px; width: 50px;" id="cell">Asignada</td>
      <td colspan="11" style=" text-align: center; background: #D6EAF8;">REPORTE ACTIVIDAD SEMANAL</td>
    </tr>
    
      <tr>
      <td>&nbsp;&nbsp;&nbsp;</td>
      <td colspan="3">@if($cant_act[$i]>0)Área: {{ $areas[$i] }} @endif</td>
      <td colspan="3">Elaborado:{{ $planificacion[$i][0] }}</td>
      <td colspan="6">N° de contrato:{{ $planificacion[$i][2] }}</td>      
    </tr>
    <tr>
      <td>&nbsp;&nbsp;&nbsp;</td>
      <td colspan="3">Fecha:{{ $planificacion[$i][3] }}</td>
      <td colspan="3">Aprobado por:{{ $planificacion[$i][1] }}</td>
      <td colspan="6">Revisión: {{ $planificacion[$i][5] }}</td>
    </tr>
    <tr style="font-size: 11px;" align="center">
        <th>&nbsp;&nbsp;&nbsp;</th>
        <th style="background: #F9E79F; width: 50px; height: 30px;">Task</th>
        <th style="background: #F9E79F; width: 11px;">Date</th>
        <th style="background: #F9E79F;">Duración <br>proyectada</th>
        <th style="background: #F9E79F;">Cant. <br>personas</th>
        <th style="background: #F9E79F;">Duración<br>real</th>
        <th style="background: #F9E79F;">Día {{ $cant_mie }}</th>
        <th style="background: #F9E79F;">Tipo</th>
        <th style="background: #F9E79F; width: 20px;">Departamento</th>
        <th style="background: #F9E79F;">Realizada SI/NO</th>
        <th style="background: #F9E79F; width: 20px;">Observaciones</th>
        <th colspan="2" style="background: #F9E79F; width: 20px;">Comentarios</th>
    </tr>
  </thead>
  <tbody>
  @if($cant_act[$i]>0)
  @php 
  $x=0; 
  $y=$cant_mie+$cant_jue;
  $z=$y+$cant_vie;
  $aa=$z+$cant_sab;
  $bb=$aa+$cant_dom;
  $cc=$bb+$cant_lun;
  $dd=$cc+$cant_mar;
  @endphp
    @for($j=0;$j<$cant_act[$i];$j++)

    @php $x++; @endphp
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
          <td style="width: 50px;">
            @if(actividad_asignada($actividades[$i][$j][13])>0)
              {{-- <img src="{{ asset('assets/images/checked.png') }}" style="border-radius: 30px !important;" height="15px" width="15px"/> --}}
            @endif 
            {{ $actividades[$i][$j][0] }}
          </td>
          <td>{{ $actividades[$i][$j][3] }}</td>
          <td>{{ $actividades[$i][$j][4] }}</td>
          <td>{{ $actividades[$i][$j][5] }}</td>
          <td>{{ $actividades[$i][$j][6] }}</td>
          <td>{{ $actividades[$i][$j][7] }}</td>
          <td>{{ $actividades[$i][$j][8] }}</td>
          <td>
            @if($actividades[$i][$j][14]!="Ninguno")
          {{ $actividades[$i][$j][14] }}
            @endif
          </td>
          <td>{{ $actividades[$i][$j][9] }}</td>
          <td>{{ $actividades[$i][$j][11] }}</td>
          <td colspan="2">
            @if(actividad_asignada($actividades[$i][$j][13])>0) 
                {{ comentarios_actividad($actividades[$i][$j][13]) }}
            @endif
          </td>
      </tr>
      {{-- totales dia miercoles --}}
      @if($x==$cant_mie && $cant_mie!=0)
      
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td style="background: #000000; color: #FFFFFF;" colspan="2">Total {{ $cant_mie }}</td>
        <td style="background: #000000; color: #FFFFFF;">{{ $tdp_mie }}</td>
        <td style="background: #000000; color: #FFFFFF;"></td>
        <td style="background: #000000; color: #FFFFFF;">{{ $tdr_mie }}</td>
        <td style="background: #000000; color: #FFFFFF;" colspan="7"></td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td colspan="3" style="background: #e5be01;">{{ $actividades[$i][$j][12] }}</td>
        <td colspan="9" style="background: #e5be01; text-align: center;">{{ $actividades[$i][$j][12] }}</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td colspan="12"></td>
      </tr>
      @endif
      {{-- totales dia jueves --}}
      @if($y==$x && $cant_jue!=0)
      
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td style="background: #000000; color: #FFFFFF;" colspan="2">Total</td>
        <td style="background: #000000; color: #FFFFFF;">{{ $tdp_jue }}</td>
        <td style="background: #000000; color: #FFFFFF;"></td>
        <td style="background: #000000; color: #FFFFFF;">{{ $tdr_jue }}</td>
        <td style="background: #000000; color: #FFFFFF;" colspan="7"></td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td colspan="3" style="background: #e5be01;">{{ $actividades[$i][$j][12] }}</td>
        <td colspan="9" style="background: #e5be01; text-align: center;">{{ $actividades[$i][$j][12] }}</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td colspan="12"></td>
      </tr>
      @endif
      {{-- totales dia viernes --}}
      @if($z==$x  && $cant_vie!=0)
      
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td style="background: #000000; color: #FFFFFF;" colspan="2">Total</td>
        <td style="background: #000000; color: #FFFFFF;">{{ $tdp_vie }}</td>
        <td style="background: #000000; color: #FFFFFF;"></td>
        <td style="background: #000000; color: #FFFFFF;">{{ $tdr_vie }}</td>
        <td style="background: #000000; color: #FFFFFF;" colspan="7"></td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td colspan="3" style="background: #e5be01;">{{ $actividades[$i][$j][12] }}</td>
        <td colspan="9" style="background: #e5be01; text-align: center;">{{ $actividades[$i][$j][12] }}</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td colspan="12"></td>
      </tr>
      @endif
      {{-- totales dia jueves --}}
      @if($aa==$x  && $cant_sab!=0)
      
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td style="background: #000000; color: #FFFFFF;" colspan="2">Total</td>
        <td style="background: #000000; color: #FFFFFF;">{{ $tdp_sab }}</td>
        <td style="background: #000000; color: #FFFFFF;"></td>
        <td style="background: #000000; color: #FFFFFF;">{{ $tdr_sab }}</td>
        <td style="background: #000000; color: #FFFFFF;" colspan="7"></td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td colspan="3" style="background: #e5be01;">{{ $actividades[$i][$j][12] }}</td>
        <td colspan="9" style="background: #e5be01; text-align: center;">{{ $actividades[$i][$j][12] }}</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td colspan="12"></td>
      </tr>
      @endif
      {{-- totales dia domingo --}}
      @if($bb==$x  && $cant_dom!=0)
      
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td style="background: #000000; color: #FFFFFF;" colspan="2">Total</td>
        <td style="background: #000000; color: #FFFFFF;">{{ $tdp_dom }}</td>
        <td style="background: #000000; color: #FFFFFF;"></td>
        <td style="background: #000000; color: #FFFFFF;">{{ $tdr_dom }}</td>
        <td style="background: #000000; color: #FFFFFF;" colspan="7"></td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td colspan="3" style="background: #e5be01;">{{ $actividades[$i][$j][12] }}</td>
        <td colspan="9" style="background: #e5be01; text-align: center;">{{ $actividades[$i][$j][12] }}</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td colspan="12"></td>
      </tr>
      @endif
      {{-- totales dia lunes --}}
      @if($cc==$x  && $cant_lun!=0)
      
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td style="background: #000000; color: #FFFFFF;" colspan="2">Total</td>
        <td style="background: #000000; color: #FFFFFF;">{{ $tdp_lun }}</td>
        <td style="background: #000000; color: #FFFFFF;"></td>
        <td style="background: #000000; color: #FFFFFF;">{{ $tdr_lun }}</td>
        <td style="background: #000000; color: #FFFFFF;" colspan="7"></td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td colspan="3" style="background: #e5be01;">{{ $actividades[$i][$j][12] }}</td>
        <td colspan="9" style="background: #e5be01; text-align: center;">{{ $actividades[$i][$j][12] }}</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td colspan="12"></td>
      </tr>
      @endif
      {{-- totales dia martes --}}
      @if($dd==$x  && $cant_mar!=0)
      
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td style="background: #000000; color: #FFFFFF;" colspan="2">Total</td>
        <td style="background: #000000; color: #FFFFFF;">{{ $tdp_mar }}</td>
        <td style="background: #000000; color: #FFFFFF;"></td>
        <td style="background: #000000; color: #FFFFFF;">{{ $tdr_mar }}</td>
        <td style="background: #000000; color: #FFFFFF;" colspan="7"></td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td colspan="3" style="background: #e5be01;">{{ $actividades[$i][$j][12] }}</td>
        <td colspan="9" style="background: #e5be01; text-align: center;">{{ $actividades[$i][$j][12] }}</td>
      </tr>
      <tr>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td colspan="12"></td>
      </tr>
      @endif
    @endfor
  @endif
  {{-- </tbody> --}}
      <div class="page-break"></div>
  @endfor
</table>
  
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Reporte por área en ejecución</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" prefer>
    <style type="text/css">
        td, th {
            text-align: center !important;
        }
        @media print{
           .botones {
            display: none;
           }
           tr.header {
            display: block;
           }
           .grafica {
            width:40% !important;
           }
        }
        @media screen{
            body {
                padding: 100px;
                border: 2px solid black;
                margin: 100px 100px 100px 100px
            }
        }
    </style>
</head>
<body>
    <table width="70%" height="" align="center" style="padding: 0px; border: 2px solid gray;" border="1">
        <tr>
            <table border="1" width="" class="table table-striped table-bordered">
                <tr>
                    <td colspan="3">
                        <img src="{{ url('assets/img/licancabur.png') }}" alt="Logo Licancabur" width="150px" height="150px">
                    </td>
                    <td colspan="">
                        <h2 align="center">Reporte de estadísticas por ejecución</h2>
                        <h2 align="center">Gerencia: {!! $gerencia !!} - Área: {{$area}}</h2>
                    </td>
                    
                </tr>
            </table>
        </tr>
        <tr>
            <table class="table table-striped table-bordered" border="1">
                <thead>
                    <tr>
                        <th colspan="2" style="background: #F7C55F;">PM01</th>
                        <th colspan="2" style="background: #48C9A9;">PM02</th>
                        <th colspan="2" style="background: #EF5350;">PM03</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th style="background: #D7CCC8; color: black;">R</th>
                        <th style="background: #BDBDBD; color: black;">NR</th>
                        <th style="background: #D7CCC8; color: black;">R</th>
                        <th style="background: #BDBDBD; color: black;">NR</th>
                        <th style="background: #D7CCC8; color: black;">R</th>
                        <th style="background: #BDBDBD; color: black;">NR</th>
                    </tr>
                    <tr>
                        <td bgcolor="white">{!! $pm01_r !!}</td>
                        <td bgcolor="white">{!! $pm01_nr !!}</td>
                        <td bgcolor="white">{!! $pm02_r !!}</td>
                        <td bgcolor="white">{!! $pm02_nr !!}</td>
                        <td bgcolor="white">{!! $pm03_r !!}</td>
                        <td bgcolor="white">{!! $pm03_nr !!}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="color: black; text-align: center;"><b>Total PM02</b></td>
                        <td colspan="3" style="color: black; text-align: center;"><b>Total PM03</b></td>
                    </tr>
                    <tr>
                        <td colspan="3">{!! $total_pm02 !!}</td>
                        <td colspan="3">{!! $total_pm03 !!}</td>                                                        
                    </tr>
                </tbody>
            </table>
        </tr>
    </table>
    <table width="50%" align="center" border="1" class="grafica">
        <tr>
            <td colspan="6" style="background: white; padding: 20px; border-radius: 30px;">
                <h4 style="text-align: center;">Gráfica por tipo del año 
                    @if(session('fecha_actual'))
                        @php $anio=session('fecha_actual'); @endphp
                    @else
                        @php $anio=date('Y');
                            session('fecha_actual',$anio);
                         @endphp
                        
                    @endif
                    {{ $anio }}
                </h4>
                {!! $graf_total->render() !!}
            </td>            
        </tr>
    </table>
    <br>
    <table align="center" class="botones" style="margin-top: 10px;">
        <tr>
            <td colspan="3" onclick="return false;">
                <button onclick="window.close();" class="boton-cerrar">Cerrar</button> 
                <button onclick="window.print();" class="boton-print">Imprimir</button>                
            </td>
        </tr>
    </table>
</body>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/line-chart.js') }}"></script>
</html>

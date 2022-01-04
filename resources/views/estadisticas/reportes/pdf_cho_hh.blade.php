<!DOCTYPE html>
<html>
<head>
    <title>Reporte HH por área</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" prefer>
    <style type="text/css">
        td {
            text-align: center !important;
        }
        @media print{
            body {
                border: 1px solid black;
            }
           table.saltopagina{
              page-break-before:always;
           }
           .botones {
            display: none;
           }
           #pm01 {
            background: #F7C55F !important;
           }
           .pm02 {
            background: #48C9A9;
           }

           .pm03 {
            background: #EF5350;
           }
           #id {
            width: 100%;
           }
           tr.header {
            display: block;
           }
        }
        @media screen{
            tr.header {
                display: none;
            }
            body {
                padding: 100px;
                border: 2px solid black;
                margin: 100px 100px 100px 100px
            }
        }
    </style>
</head>
<body>
    <table width="50%" height="100px" align="center" style="padding: 20px; border: 2px solid gray;" id="table-general" border="1">
        <tr>
            <td>
                <img src="{{ url('assets/img/licancabur.png') }}" alt="Logo Licancabur" width="150px" height="150px">
            </td>
            <td colspan="3">
                <h2 align="center">Reporte HH</h2>
                <h2 align="center">Gerencia: CHO - Área: Filtro-Puerto</h2>
            </td>
        </tr>
        <tr>
            <td align="center">
                <table class="table table-striped table-bordered" border="2px" style="height: 40px;" width="100%"height="100%">
                    <tr>
                        <td colspan="2" style=" background: #F7C55F !important; color: black;" class="pm01">PM01</td>
                        <td>HH Realizadas</td>
                    </tr>
                    <tr>
                        <th rowspan="13" style=" padding-top:;">
                            @if(session('fecha_actual'))
                                @php $anio=session('fecha_actual'); @endphp
                            @else
                                @php $anio=date('Y');
                                    session('fecha_actual',$anio);
                                 @endphp
                                
                            @endif
                            {{ $anio }}
                        </th>
                    </tr>
                    <tr>
                        <td>Enero</td>
                        <td>{{ $filtro_pm01[0] }}</td>
                    </tr>
                    <tr>
                        <td>Febrero</td>
                        <td>{{ $filtro_pm01[1] }}</td>
                    </tr>
                    <tr>
                        <td>Marzo</td>
                        <td>{{ $filtro_pm01[2] }}</td>
                    </tr>
                    <tr>
                        <td>Abril</td>
                        <td>{{ $filtro_pm01[3] }}</td>
                    </tr>
                    <tr>
                        <td>Mayo</td>
                        <td>{{ $filtro_pm01[4] }}</td>
                    </tr>
                    <tr>
                        <td>Junio</td>
                        <td>{{ $filtro_pm01[5] }}</td>
                    </tr>
                    <tr>
                        <td>Julio</td>
                        <td>{{ $filtro_pm01[6] }}</td>
                    </tr>
                    <tr>
                        <td>Agosto</td>
                        <td>{{ $filtro_pm01[7] }}</td>
                    </tr>
                    <tr>
                        <td>Septiembre</td>
                        <td>{{ $filtro_pm01[8] }}</td>
                    </tr>
                    <tr>
                        <td>Octubre</td>
                        <td>{{ $filtro_pm01[9] }}</td>
                    </tr>
                    <tr>
                        <td>Noviembre</td>
                        <td>{{ $filtro_pm01[10] }}</td>
                    </tr>
                    <tr>
                        <td>Diciembre</td>
                        <td>{{ $filtro_pm01[11] }}</td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="table table-striped table-bordered" border="2px" style="height: 40px;" width="100%">
                    <tr>
                        <td colspan="2" style=" background: #48C9A9; color: black;">PM02</td>
                        <td>HH Realizadas</td>
                    </tr>
                    <tr>
                        <th rowspan="13" style=" padding-top: ;">
                            @if(session('fecha_actual'))
                                @php $anio=session('fecha_actual'); @endphp
                            @else
                                @php $anio=date('Y');
                                    session('fecha_actual',$anio);
                                 @endphp
                                
                            @endif
                            {{ $anio }}
                        </th>
                    </tr>
                    <tr>
                        <td>Enero</td>
                        <td>{{ $filtro_pm02[0] }}</td>
                    </tr>
                    <tr>
                        <td>Febrero</td>
                        <td>{{ $filtro_pm02[1] }}</td>
                    </tr>
                    <tr>
                        <td>Marzo</td>
                        <td>{{ $filtro_pm02[2] }}</td>
                    </tr>
                    <tr>
                        <td>Abril</td>
                        <td>{{ $filtro_pm02[3] }}</td>
                    </tr>
                    <tr>
                        <td>Mayo</td>
                        <td>{{ $filtro_pm02[4] }}</td>
                    </tr>
                    <tr>
                        <td>Junio</td>
                        <td>{{ $filtro_pm02[5] }}</td>
                    </tr>
                    <tr>
                        <td>Julio</td>
                        <td>{{ $filtro_pm02[6] }}</td>
                    </tr>
                    <tr>
                        <td>Agosto</td>
                        <td>{{ $filtro_pm02[7] }}</td>
                    </tr>
                    <tr>
                        <td>Septiembre</td>
                        <td>{{ $filtro_pm02[8] }}</td>
                    </tr>
                    <tr>
                        <td>Octubre</td>
                        <td>{{ $filtro_pm02[9] }}</td>
                    </tr>
                    <tr>
                        <td>Noviembre</td>
                        <td>{{ $filtro_pm02[10] }}</td>
                    </tr>
                    <tr>
                        <td>Diciembre</td>
                        <td>{{ $filtro_pm02[11] }}</td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="table table-striped table-bordered" border="2px" style="height: 40px;" width="100%">
                    <tr>
                        <td colspan="2" style=" background: #EF5350; color: black;">PM03</td>
                        <td>HH Realizadas</td>
                    </tr>
                    <tr>
                        <th rowspan="13" style=" padding-top: ;">
                            @if(session('fecha_actual'))
                                @php $anio=session('fecha_actual'); @endphp
                            @else
                                @php $anio=date('Y');
                                    session('fecha_actual',$anio);
                                 @endphp
                                
                            @endif
                            {{ $anio }}
                        </th>
                    </tr>
                    <tr>
                        <td>Enero</td>
                        <td>{{ $filtro_pm03[0] }}</td>
                    </tr>
                    <tr>
                        <td>Febrero</td>
                        <td>{{ $filtro_pm03[1] }}</td>
                    </tr>
                    <tr>
                        <td>Marzo</td>
                        <td>{{ $filtro_pm03[2] }}</td>
                    </tr>
                    <tr>
                        <td>Abril</td>
                        <td>{{ $filtro_pm03[3] }}</td>
                    </tr>
                    <tr>
                        <td>Mayo</td>
                        <td>{{ $filtro_pm03[4] }}</td>
                    </tr>
                    <tr>
                        <td>Junio</td>
                        <td>{{ $filtro_pm03[5] }}</td>
                    </tr>
                    <tr>
                        <td>Julio</td>
                        <td>{{ $filtro_pm03[6] }}</td>
                    </tr>
                    <tr>
                        <td>Agosto</td>
                        <td>{{ $filtro_pm03[7] }}</td>
                    </tr>
                    <tr>
                        <td>Septiembre</td>
                        <td>{{ $filtro_pm03[8] }}</td>
                    </tr>
                    <tr>
                        <td>Octubre</td>
                        <td>{{ $filtro_pm03[9] }}</td>
                    </tr>
                    <tr>
                        <td>Noviembre</td>
                        <td>{{ $filtro_pm03[10] }}</td>
                    </tr>
                    <tr>
                        <td>Diciembre</td>
                        <td>{{ $filtro_pm03[11] }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="background: white; padding: 20px; border-radius: 30px;">
                <h4 style="text-align: center;">Gráfica HH por tipo del año 
                    @if(session('fecha_actual'))
                        @php $anio=session('fecha_actual'); @endphp
                    @else
                        @php $anio=date('Y');
                            session('fecha_actual',$anio);
                         @endphp
                        
                    @endif
                    {{ $anio }}
                </h4>
                {!! $graf_hh_filtro_1->render() !!}
            </td>
        </tr>
        <tr>
            <td colspan="3" style="background: white; padding: 20px; border-radius: 30px;">
                <h4 style="text-align: center;">Gráfica HH por tipo del año 
                    @if(session('fecha_actual'))
                        @php $anio=session('fecha_actual'); @endphp
                    @else
                        @php $anio=date('Y');
                            session('fecha_actual',$anio);
                         @endphp
                        
                    @endif
                    {{ $anio }}
                </h4>
                {!! $graf_hh_filtro_2->render() !!}
            </td>
        </tr>
    </table>
    <br>
    <table width="50%" height="100px" align="center" style="padding: 20px; border: 2px solid gray;" id="table-general" border="1" class="saltopagina">
        <tr>
            <td>
                <img src="{{ url('assets/img/licancabur.png') }}" alt="Logo Licancabur" width="150px" height="150px">
            </td>
            <td colspan="3">
                <h2 align="center">Reporte HH</h2>
                <h2 align="center">Gerencia: NPI - Área: ECT</h2>
            </td>
        </tr>
        <tr>
            <td align="center">
                <table class="table table-striped table-bordered" border="2px" style="height: 40px;" width="100%"height="100%">
                    <tr>
                        <td colspan="2" style=" background: #F7C55F !important; color: black;" class="pm01">PM01</td>
                        <td>HH Realizadas</td>
                    </tr>
                    <tr>
                        <th rowspan="13" style=" padding-top:;">
                            @if(session('fecha_actual'))
                                @php $anio=session('fecha_actual'); @endphp
                            @else
                                @php $anio=date('Y');
                                    session('fecha_actual',$anio);
                                 @endphp
                                
                            @endif
                            {{ $anio }}
                        </th>
                    </tr>
                    <tr>
                        <td>Enero</td>
                        <td>{{ $ect_pm01[0] }}</td>
                    </tr>
                    <tr>
                        <td>Febrero</td>
                        <td>{{ $ect_pm01[1] }}</td>
                    </tr>
                    <tr>
                        <td>Marzo</td>
                        <td>{{ $ect_pm01[2] }}</td>
                    </tr>
                    <tr>
                        <td>Abril</td>
                        <td>{{ $ect_pm01[3] }}</td>
                    </tr>
                    <tr>
                        <td>Mayo</td>
                        <td>{{ $ect_pm01[4] }}</td>
                    </tr>
                    <tr>
                        <td>Junio</td>
                        <td>{{ $ect_pm01[5] }}</td>
                    </tr>
                    <tr>
                        <td>Julio</td>
                        <td>{{ $ect_pm01[6] }}</td>
                    </tr>
                    <tr>
                        <td>Agosto</td>
                        <td>{{ $ect_pm01[7] }}</td>
                    </tr>
                    <tr>
                        <td>Septiembre</td>
                        <td>{{ $ect_pm01[8] }}</td>
                    </tr>
                    <tr>
                        <td>Octubre</td>
                        <td>{{ $ect_pm01[9] }}</td>
                    </tr>
                    <tr>
                        <td>Noviembre</td>
                        <td>{{ $ect_pm01[10] }}</td>
                    </tr>
                    <tr>
                        <td>Diciembre</td>
                        <td>{{ $ect_pm01[11] }}</td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="table table-striped table-bordered" border="2px" style="height: 40px;" width="100%">
                    <tr>
                        <td colspan="2" style=" background: #48C9A9; color: black;">PM02</td>
                        <td>HH Realizadas</td>
                    </tr>
                    <tr>
                        <th rowspan="13" style=" padding-top: ;">
                            @if(session('fecha_actual'))
                                @php $anio=session('fecha_actual'); @endphp
                            @else
                                @php $anio=date('Y');
                                    session('fecha_actual',$anio);
                                 @endphp
                                
                            @endif
                            {{ $anio }}
                        </th>
                    </tr>
                    <tr>
                        <td>Enero</td>
                        <td>{{ $ect_pm02[0] }}</td>
                    </tr>
                    <tr>
                        <td>Febrero</td>
                        <td>{{ $ect_pm02[1] }}</td>
                    </tr>
                    <tr>
                        <td>Marzo</td>
                        <td>{{ $ect_pm02[2] }}</td>
                    </tr>
                    <tr>
                        <td>Abril</td>
                        <td>{{ $ect_pm02[3] }}</td>
                    </tr>
                    <tr>
                        <td>Mayo</td>
                        <td>{{ $ect_pm02[4] }}</td>
                    </tr>
                    <tr>
                        <td>Junio</td>
                        <td>{{ $ect_pm02[5] }}</td>
                    </tr>
                    <tr>
                        <td>Julio</td>
                        <td>{{ $ect_pm02[6] }}</td>
                    </tr>
                    <tr>
                        <td>Agosto</td>
                        <td>{{ $ect_pm02[7] }}</td>
                    </tr>
                    <tr>
                        <td>Septiembre</td>
                        <td>{{ $ect_pm02[8] }}</td>
                    </tr>
                    <tr>
                        <td>Octubre</td>
                        <td>{{ $ect_pm02[9] }}</td>
                    </tr>
                    <tr>
                        <td>Noviembre</td>
                        <td>{{ $ect_pm02[10] }}</td>
                    </tr>
                    <tr>
                        <td>Diciembre</td>
                        <td>{{ $ect_pm02[11] }}</td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="table table-striped table-bordered" border="2px" style="height: 40px;" width="100%">
                    <tr>
                        <td colspan="2" style=" background: #EF5350; color: black;">PM03</td>
                        <td>HH Realizadas</td>
                    </tr>
                    <tr>
                        <th rowspan="13" style=" padding-top: ;">
                            @if(session('fecha_actual'))
                                @php $anio=session('fecha_actual'); @endphp
                            @else
                                @php $anio=date('Y');
                                    session('fecha_actual',$anio);
                                 @endphp
                                
                            @endif
                            {{ $anio }}
                        </th>
                    </tr>
                    <tr>
                        <td>Enero</td>
                        <td>{{ $ect_pm03[0] }}</td>
                    </tr>
                    <tr>
                        <td>Febrero</td>
                        <td>{{ $ect_pm03[1] }}</td>
                    </tr>
                    <tr>
                        <td>Marzo</td>
                        <td>{{ $ect_pm03[2] }}</td>
                    </tr>
                    <tr>
                        <td>Abril</td>
                        <td>{{ $ect_pm03[3] }}</td>
                    </tr>
                    <tr>
                        <td>Mayo</td>
                        <td>{{ $ect_pm03[4] }}</td>
                    </tr>
                    <tr>
                        <td>Junio</td>
                        <td>{{ $ect_pm03[5] }}</td>
                    </tr>
                    <tr>
                        <td>Julio</td>
                        <td>{{ $ect_pm03[6] }}</td>
                    </tr>
                    <tr>
                        <td>Agosto</td>
                        <td>{{ $ect_pm03[7] }}</td>
                    </tr>
                    <tr>
                        <td>Septiembre</td>
                        <td>{{ $ect_pm03[8] }}</td>
                    </tr>
                    <tr>
                        <td>Octubre</td>
                        <td>{{ $ect_pm03[9] }}</td>
                    </tr>
                    <tr>
                        <td>Noviembre</td>
                        <td>{{ $ect_pm03[10] }}</td>
                    </tr>
                    <tr>
                        <td>Diciembre</td>
                        <td>{{ $ect_pm03[11] }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="background: white; padding: 20px; border-radius: 30px;">
                <h4 style="text-align: center;">Gráfica HH por tipo del año 
                    @if(session('fecha_actual'))
                        @php $anio=session('fecha_actual'); @endphp
                    @else
                        @php $anio=date('Y');
                            session('fecha_actual',$anio);
                         @endphp
                        
                    @endif
                    {{ $anio }}
                </h4>
                {!! $graf_hh_ect_1->render() !!}
            </td>
        </tr>
        <tr>
            <td colspan="3" style="background: white; padding: 20px; border-radius: 30px;">
                <h4 style="text-align: center;">Gráfica HH por tipo del año 
                    @if(session('fecha_actual'))
                        @php $anio=session('fecha_actual'); @endphp
                    @else
                        @php $anio=date('Y');
                            session('fecha_actual',$anio);
                         @endphp
                        
                    @endif
                    {{ $anio }}
                </h4>
                {!! $graf_hh_ect_2->render() !!}
            </td>
        </tr>
    </table>
    <br>
    <table width="50%" height="100px" align="center" style="padding: 20px; border: 2px solid gray;" id="table-general" border="1" class="saltopagina">
        <tr>
            <td>
                <img src="{{ url('assets/img/licancabur.png') }}" alt="Logo Licancabur" width="150px" height="150px">
            </td>
            <td colspan="3">
                <h2 align="center">Reporte HH</h2>
                <h2 align="center">Gerencia: NPI - Área: Los Colorados</h2>
            </td>
        </tr>
        <tr>
            <td align="center">
                <table class="table table-striped table-bordered" border="2px" style="height: 40px;" width="100%"height="100%">
                    <tr>
                        <td colspan="2" style=" background: #F7C55F !important; color: black;" class="pm01">PM01</td>
                        <td>HH Realizadas</td>
                    </tr>
                    <tr>
                        <th rowspan="13" style=" padding-top:;">
                            @if(session('fecha_actual'))
                                @php $anio=session('fecha_actual'); @endphp
                            @else
                                @php $anio=date('Y');
                                    session('fecha_actual',$anio);
                                 @endphp
                                
                            @endif
                            {{ $anio }}
                        </th>
                    </tr>
                    <tr>
                        <td>Enero</td>
                        <td>{{ $colorados_pm01[0] }}</td>
                    </tr>
                    <tr>
                        <td>Febrero</td>
                        <td>{{ $colorados_pm01[1] }}</td>
                    </tr>
                    <tr>
                        <td>Marzo</td>
                        <td>{{ $colorados_pm01[2] }}</td>
                    </tr>
                    <tr>
                        <td>Abril</td>
                        <td>{{ $colorados_pm01[3] }}</td>
                    </tr>
                    <tr>
                        <td>Mayo</td>
                        <td>{{ $colorados_pm01[4] }}</td>
                    </tr>
                    <tr>
                        <td>Junio</td>
                        <td>{{ $colorados_pm01[5] }}</td>
                    </tr>
                    <tr>
                        <td>Julio</td>
                        <td>{{ $colorados_pm01[6] }}</td>
                    </tr>
                    <tr>
                        <td>Agosto</td>
                        <td>{{ $colorados_pm01[7] }}</td>
                    </tr>
                    <tr>
                        <td>Septiembre</td>
                        <td>{{ $colorados_pm01[8] }}</td>
                    </tr>
                    <tr>
                        <td>Octubre</td>
                        <td>{{ $colorados_pm01[9] }}</td>
                    </tr>
                    <tr>
                        <td>Noviembre</td>
                        <td>{{ $colorados_pm01[10] }}</td>
                    </tr>
                    <tr>
                        <td>Diciembre</td>
                        <td>{{ $colorados_pm01[11] }}</td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="table table-striped table-bordered" border="2px" style="height: 40px;" width="100%">
                    <tr>
                        <td colspan="2" style=" background: #48C9A9; color: black;">PM02</td>
                        <td>HH Realizadas</td>
                    </tr>
                    <tr>
                        <th rowspan="13" style=" padding-top: ;">
                            @if(session('fecha_actual'))
                                @php $anio=session('fecha_actual'); @endphp
                            @else
                                @php $anio=date('Y');
                                    session('fecha_actual',$anio);
                                 @endphp
                                
                            @endif
                            {{ $anio }}
                        </th>
                    </tr>
                    <tr>
                        <td>Enero</td>
                        <td>{{ $colorados_pm02[0] }}</td>
                    </tr>
                    <tr>
                        <td>Febrero</td>
                        <td>{{ $colorados_pm02[1] }}</td>
                    </tr>
                    <tr>
                        <td>Marzo</td>
                        <td>{{ $colorados_pm02[2] }}</td>
                    </tr>
                    <tr>
                        <td>Abril</td>
                        <td>{{ $colorados_pm02[3] }}</td>
                    </tr>
                    <tr>
                        <td>Mayo</td>
                        <td>{{ $colorados_pm02[4] }}</td>
                    </tr>
                    <tr>
                        <td>Junio</td>
                        <td>{{ $colorados_pm02[5] }}</td>
                    </tr>
                    <tr>
                        <td>Julio</td>
                        <td>{{ $colorados_pm02[6] }}</td>
                    </tr>
                    <tr>
                        <td>Agosto</td>
                        <td>{{ $colorados_pm02[7] }}</td>
                    </tr>
                    <tr>
                        <td>Septiembre</td>
                        <td>{{ $colorados_pm02[8] }}</td>
                    </tr>
                    <tr>
                        <td>Octubre</td>
                        <td>{{ $colorados_pm02[9] }}</td>
                    </tr>
                    <tr>
                        <td>Noviembre</td>
                        <td>{{ $colorados_pm02[10] }}</td>
                    </tr>
                    <tr>
                        <td>Diciembre</td>
                        <td>{{ $colorados_pm02[11] }}</td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="table table-striped table-bordered" border="2px" style="height: 40px;" width="100%">
                    <tr>
                        <td colspan="2" style=" background: #EF5350; color: black;">PM03</td>
                        <td>HH Realizadas</td>
                    </tr>
                    <tr>
                        <th rowspan="13" style=" padding-top: ;">
                            @if(session('fecha_actual'))
                                @php $anio=session('fecha_actual'); @endphp
                            @else
                                @php $anio=date('Y');
                                    session('fecha_actual',$anio);
                                 @endphp
                                
                            @endif
                            {{ $anio }}
                        </th>
                    </tr>
                    <tr>
                        <td>Enero</td>
                        <td>{{ $colorados_pm03[0] }}</td>
                    </tr>
                    <tr>
                        <td>Febrero</td>
                        <td>{{ $colorados_pm03[1] }}</td>
                    </tr>
                    <tr>
                        <td>Marzo</td>
                        <td>{{ $colorados_pm03[2] }}</td>
                    </tr>
                    <tr>
                        <td>Abril</td>
                        <td>{{ $colorados_pm03[3] }}</td>
                    </tr>
                    <tr>
                        <td>Mayo</td>
                        <td>{{ $colorados_pm03[4] }}</td>
                    </tr>
                    <tr>
                        <td>Junio</td>
                        <td>{{ $colorados_pm03[5] }}</td>
                    </tr>
                    <tr>
                        <td>Julio</td>
                        <td>{{ $colorados_pm03[6] }}</td>
                    </tr>
                    <tr>
                        <td>Agosto</td>
                        <td>{{ $colorados_pm03[7] }}</td>
                    </tr>
                    <tr>
                        <td>Septiembre</td>
                        <td>{{ $colorados_pm03[8] }}</td>
                    </tr>
                    <tr>
                        <td>Octubre</td>
                        <td>{{ $colorados_pm03[9] }}</td>
                    </tr>
                    <tr>
                        <td>Noviembre</td>
                        <td>{{ $colorados_pm03[10] }}</td>
                    </tr>
                    <tr>
                        <td>Diciembre</td>
                        <td>{{ $colorados_pm03[11] }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="background: white; padding: 20px; border-radius: 30px;">
                <h4 style="text-align: center;">Gráfica HH por tipo del año 
                    @if(session('fecha_actual'))
                        @php $anio=session('fecha_actual'); @endphp
                    @else
                        @php $anio=date('Y');
                            session('fecha_actual',$anio);
                         @endphp
                        
                    @endif
                    {{ $anio }}
                </h4>
                {!! $graf_hh_colorados_1->render() !!}
            </td>
        </tr>
        <tr>
            <td colspan="3" style="background: white; padding: 20px; border-radius: 30px;">
                <h4 style="text-align: center;">Gráfica HH por tipo del año 
                    @if(session('fecha_actual'))
                        @php $anio=session('fecha_actual'); @endphp
                    @else
                        @php $anio=date('Y');
                            session('fecha_actual',$anio);
                         @endphp
                        
                    @endif
                    {{ $anio }}
                </h4>
                {!! $graf_hh_colorados_2->render() !!}
            </td>
        </tr>
    </table>
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

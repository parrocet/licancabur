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
            div.saltopagina{
              page-break-before:always;
           }
           .botones {
            display: none;
           }
           div.header {
            display: block;
           }
           .grafica {
            width:40% !important;
           }
           .graf_print {
            border: 1px solid black;
            border-radius: 20px;
            padding: 10px;
            margin: 0 auto;
           }
        }
        @media screen{
            body {
                padding: 100px;
                border: 2px solid black;
                margin: 100px 100px 100px 100px
            }

            .fondo {
                background: #DCDCDC;
                border-radius: 20px;
                padding: 10px;
            }
            .header {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-md-12">
            <table border="1" width="" class="table table-striped table-bordered">
                <tr>
                    <td colspan="3">
                        <img src="{{ url('assets/img/licancabur.png') }}" alt="Logo Licancabur" width="150px" height="150px">
                    </td>
                    <td colspan="">
                        <h2 align="center">Reporte de estadísticas por ejecución</h2>
                        <h2 align="center">Gerencia: NPI - Semana número: {{$semana}}</h2>
                        <h2>Fecha: {{$fecha}}</h2>
                    </td>                   
                </tr>
            </table>
        </div>
    </div>
    <div class="row fondo">
        <div class="col-md-6" style="">
            <h4 align="center">Cantidad de Actividades PM02</h4>
            <table class="table table-striped table-bordered" border="1">
                <thead>
                    <tr>
                        <th style="background: #D7CCC8; color: black;">R</th>
                        <th style="background: #BDBDBD; color: black;">NR</th>
                    </tr>                    
                </thead>
                <tbody>
                    <tr>
                        <td>{!! $pm02_si_g1 !!}</td>
                        <td>{!! $pm02_no_g1 !!}</td>
                    </tr>
                </tbody>
            </table> 
            <div class="graf_print" style="background: white; padding: 20px; border-radius: 10px;">
                <h4 style="text-align: center;">Gráfica</h4>
                <div class="row">
                    <!-- Aqui va la grafica -->
                    {!! $graf_pm02_g1->render() !!}
                </div>
            </div>
        </div>
        <div class="row header saltopagina">
            <div class="col-md-12">
                <table border="1" width="" class="table table-striped table-bordered">
                    <tr>
                        <td colspan="3">
                            <img src="{{ url('assets/img/licancabur.png') }}" alt="Logo Licancabur" width="150px" height="150px">
                        </td>
                        <td colspan="">
                            <h2 align="center">Reporte de estadísticas por ejecución</h2>
                            <h2 align="center">Gerencia: NPI - Semana número: {{$semana}}</h2>
                            <h2>Fecha: {{$fecha}}</h2>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <h4 align="center">Actividades PM02 VS Actividades PM03</h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="50%" style="background: #48C9A9; color: black;">PM02</th>
                        <th width="50%" style="background: #EF5350; color: black;">PM03</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{!! $pm02_g1 !!}</td>
                        <td>{!! $pm03_g1 !!}</td>
                    </tr>
                </tbody>
            </table>
            <div class="graf_print" style="background: white; padding: 20px; border-radius: 10px;">
                <h4 style="text-align: center;">Gráfica</h4>
                <div class="row">
                    {!! $graf_act_pm02_vs_act_pm03_g1->render() !!}
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row header saltopagina">
        <div class="col-md-12">
            <table border="1" width="" class="table table-striped table-bordered">
                <tr>
                    <td colspan="3">
                        <img src="{{ url('assets/img/licancabur.png') }}" alt="Logo Licancabur" width="150px" height="150px">
                    </td>
                    <td colspan="">
                        <h2 align="center">Reporte de estadísticas por ejecución</h2>
                        <h2 align="center">Gerencia: NPI - Semana número: {{$semana}}</h2>
                        <h2>Fecha: {{$fecha}}</h2>
                    </td>                    
                </tr>
            </table>
        </div>
    </div>
    <div class="row fondo">
        <div class="col-md-8">
            <h4>Total de Actividades</h4>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th colspan="2" style="background: #F7C55F">PM01</th>
                        <th colspan="2" style="background: #48C9A9">PM02</th>
                        <th colspan="2" style="background: #EF5350">PM03</th>
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
                        <td bgcolor="white">{!! $pm01_si_g1 !!}</td>
                        <td bgcolor="white">{!! $pm01_no_g1 !!}</td>
                        <td bgcolor="white">{!! $pm02_si_g1 !!}</td>
                        <td bgcolor="white">{!! $pm02_no_g1 !!}</td>
                        <td bgcolor="white">{!! $pm03_si_g1 !!}</td>
                        <td bgcolor="white">{!! $pm03_no_g1 !!}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4 graf_print" style="background: white; padding: 20px; border-radius: 10px;">
            <table align="center">
                <tr>
                    <td>
                        <h4 style="text-align: center;">Gráfica</h4>
                        <div class="row">
                            <!-- Aqui va la grafica -->
                            {!! $graf_total_act_g1->render() !!}
                        </div>                        
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <hr>
    <div class="row header saltopagina">
        <div class="col-md-12">
            <table border="1" width="" class="table table-striped table-bordered">
                <tr>
                    <td colspan="3">
                        <img src="{{ url('assets/img/licancabur.png') }}" alt="Logo Licancabur" width="150px" height="150px">
                    </td>
                    <td colspan="">
                        <h2 align="center">Reporte de estadísticas por ejecución</h2>
                        <h2 align="center">Gerencia: NPI - Semana número: {{$semana}}</h2>
                        <h2>Fecha: {{$fecha}}</h2>
                    </td>                    
                </tr>
            </table>
        </div>
    </div>
    <div class="row fondo">
        <div class="col-md-8">
            <h4>EWS <span style="float: right;">Total: {!! $ews_pm01_r+$ews_pm01_nr+$ews_pm02_r+$ews_pm02_nr+$ews_pm03_r+$ews_pm03_nr !!}</span></h4>
            <div class="bsc-tbl-st">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" style="background: #F7C55F;">PM01</th>
                            <th colspan="2" style="background: #48C9A9;">PM02</th>
                            <th colspan="2" style="background: #EF5350;">PM03</th>
                        </tr>
                        <tr>
                            <th style="background: #D7CCC8; color: black;">R</th>
                            <th style="background: #BDBDBD; color: black;">NR</th>
                            <th style="background: #D7CCC8; color: black;">R</th>
                            <th style="background: #BDBDBD; color: black;">NR</th>
                            <th style="background: #D7CCC8; color: black;">R</th>
                            <th style="background: #BDBDBD; color: black;">NR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td bgcolor="white">{!! $ews_pm01_r !!}</td>
                            <td bgcolor="white">{!! $ews_pm01_nr !!}</td>
                            <td bgcolor="white">{!! $ews_pm02_r !!}</td>
                            <td bgcolor="white">{!! $ews_pm02_nr !!}</td>
                            <td bgcolor="white">{!! $ews_pm03_r !!}</td>
                            <td bgcolor="white">{!! $ews_pm03_nr !!}</td>
                        </tr>
                        <tr bgcolor="white">
                            <td colspan="3" style="color: black; text-align: center;"><b>Total PM02</b></td>
                            <td colspan="3" style="color: black; text-align: center;"><b>Total PM03</b></td>
                        </tr>
                        <tr>
                            <td colspan="3">{!! $total_ews_pm02 !!}</td>
                            <td colspan="3">{!! $total_ews_pm03 !!}</td>                   
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4 graf_print" style="background: white; padding: 20px; border-radius: 10px;">
            <h4 style="text-align: center;">Gráfica</h4>
            <div class="row">
                <!-- Aqui va la grafica -->
                {!! $graf_total_ews->render() !!}
            </div>
        </div> 
    </div>
    <hr>
    <div class="row header saltopagina">
        <div class="col-md-12">
            <table border="1" width="" class="table table-striped table-bordered">
                <tr>
                    <td colspan="3">
                        <img src="{{ url('assets/img/licancabur.png') }}" alt="Logo Licancabur" width="150px" height="150px">
                    </td>
                    <td colspan="">
                        <h2 align="center">Reporte de estadísticas por ejecución</h2>
                        <h2 align="center">Gerencia: NPI - Semana número: {{$semana}}</h2>
                        <h2>Fecha: {{$fecha}}</h2>
                    </td>                    
                </tr>
            </table>
        </div>
    </div>
    <div class="row fondo">
        <div class="col-md-8">
            <h4>Planta Cero/Desaladora & Acueducto <span style="float: right;">Total: {!! $pcda_pm01_r+$pcda_pm01_nr+$pcda_pm02_r+$pcda_pm02_nr+$pcda_pm03_r+$pcda_pm03_nr !!}</span></h4>
            <div class="bsc-tbl-st">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" style="background: #F7C55F;">PM01</th>
                            <th colspan="2" style="background: #48C9A9;">PM02</th>
                            <th colspan="2" style="background: #EF5350;">PM03</th>
                        </tr>
                        <tr>
                            <th style="background: #D7CCC8; color: black;">R</th>
                            <th style="background: #BDBDBD; color: black;">NR</th>
                            <th style="background: #D7CCC8; color: black;">R</th>
                            <th style="background: #BDBDBD; color: black;">NR</th>
                            <th style="background: #D7CCC8; color: black;">R</th>
                            <th style="background: #BDBDBD; color: black;">NR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td bgcolor="white">{!! $pcda_pm01_r !!}</td>
                            <td bgcolor="white">{!! $pcda_pm01_nr !!}</td>
                            <td bgcolor="white">{!! $pcda_pm02_r !!}</td>
                            <td bgcolor="white">{!! $pcda_pm02_nr !!}</td>
                            <td bgcolor="white">{!! $pcda_pm03_r !!}</td>
                            <td bgcolor="white">{!! $pcda_pm03_nr !!}</td>
                        </tr>
                        <tr bgcolor="white">
                            <td colspan="3" style="color: black; text-align: center;"><b>Total PM02</b></td>
                            <td colspan="3" style="color: black; text-align: center;"><b>Total PM03</b></td>
                        </tr>
                        <tr>
                            <td colspan="3">{!! $total_pcda_pm02 !!}</td>
                            <td colspan="3">{!! $total_pcda_pm03 !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4 graf_print" style="background: white; padding: 20px; border-radius: 10px;">
            <h4 style="text-align: center;">Gráfica</h4>
            <div class="row">
                <!-- Aqui va la grafica -->
                {!! $graf_total_planta->render() !!}
            </div>
        </div>
    </div>
    <hr>
    <div class="row header saltopagina">
        <div class="col-md-12">
            <table border="1" width="" class="table table-striped table-bordered">
                <tr>
                    <td colspan="3">
                        <img src="{{ url('assets/img/licancabur.png') }}" alt="Logo Licancabur" width="150px" height="150px">
                    </td>
                    <td colspan="">
                        <h2 align="center">Reporte de estadísticas por ejecución</h2>
                        <h2 align="center">Gerencia: NPI - Semana número: {{$semana}}</h2>
                        <h2>Fecha: {{$fecha}}</h2>
                    </td>                    
                </tr>
            </table>
        </div>
    </div>
    <div class="row fondo">
        <div class="col-md-8">
            <h4>Agua y Tranque <span style="float: right;">Total: {!! $agua_pm01_r+$agua_pm01_nr+$agua_pm02_r+$agua_pm02_nr+$agua_pm03_r+$agua_pm03_nr !!}</span></h4>
            <div class="bsc-tbl-st">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" style="background: #F7C55F;">PM01</th>
                            <th colspan="2" style="background: #48C9A9;">PM02</th>
                            <th colspan="2" style="background: #EF5350;">PM03</th>
                        </tr>
                        <tr>
                            <th style="background: #D7CCC8; color: black;">R</th>
                            <th style="background: #BDBDBD; color: black;">NR</th>
                            <th style="background: #D7CCC8; color: black;">R</th>
                            <th style="background: #BDBDBD; color: black;">NR</th>
                            <th style="background: #D7CCC8; color: black;">R</th>
                            <th style="background: #BDBDBD; color: black;">NR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td bgcolor="white">{!! $agua_pm01_r !!}</td>
                            <td bgcolor="white">{!! $agua_pm01_nr !!}</td>
                            <td bgcolor="white">{!! $agua_pm02_r !!}</td>
                            <td bgcolor="white">{!! $agua_pm02_nr !!}</td>
                            <td bgcolor="white">{!! $agua_pm03_r !!}</td>
                            <td bgcolor="white">{!! $agua_pm03_nr !!}</td>
                        </tr>
                        <tr bgcolor="white">
                            <td colspan="3" style="color: black; text-align: center;"><b>Total PM02</b></td>
                            <td colspan="3" style="color: black; text-align: center;"><b>Total PM03</b></td>
                        </tr>
                        <tr>
                            <td colspan="3">{!! $total_agua_pm02 !!}</td>
                            <td colspan="3">{!! $total_agua_pm03 !!}</td>                                                        
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4 graf_print" style="background: white; padding: 20px; border-radius: 10px;">
            <h4 style="text-align: center;">Gráfica</h4>
            <div class="row">
                <!-- Aqui va la grafica -->
                {!! $graf_total_agua->render() !!}
            </div>
        </div>
    </div>

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

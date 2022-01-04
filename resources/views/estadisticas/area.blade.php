@php
  libxml_use_internal_errors(true);
@endphp
@extends('layouts.appLayout')
@section('css')
<style type="text/css">
    body{
        background-color: #DCDCDC !important;
    }
    .ajl {
        border-radius: 10px !important;
        background: #DCDCDC;
        padding: 10px;
    }
    td,th {
        background: white;
        text-align: center !important;
    }
</style>
@endsection
@section('breadcomb')
<!-- Breadcomb area Start-->
<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <a href="{{ route('home') }}" data-toggle="tooltip"
                                        data-placement="bottom" title="Volver" class="btn">
                                        <i class="fa fa-th-list"></i>
                                    </a>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Estadísticas</h2>
                                    <p>Filtro para mostrar estadísticas específica..</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <strong style="float: right; margin-top: 10px; margin-bottom: 5px;">Año laboral actual: {{-- {{ config('session.fecha_actual') }} --}} 
                                @if(session('fecha_actual'))
                                    @php $anio=session('fecha_actual'); @endphp
                                @else
                                    @php $anio=date('Y');
                                        session('fecha_actual',$anio);
                                     @endphp
                                    
                                @endif
                                {{ $anio }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcomb area End-->

@endsection

@section('content')
<!-- Form Element area Start-->
<div class="form-element-area">
    <div class="container">
        @include('flash::message')
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="widget-tabs-int">
                    <div class="widget-tabs-list">
                        <ul class="nav nav-tabs tab-nav-center">
                            <li class="active"><a class="active" data-toggle="tab" href="#reporte_general">Gerencia {{$gerencia}} - Área {{$area}}</a></li>
                        </ul>
                        <div class="tab-content tab-custom-st">
                            <div id="reporte_general" class="tab-pane fade in active">
                                <div class="tab-ctn">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="add-todo-list notika-shadow ">
                                                <div class="realtime-ctn">
                                                    <div class="realtime-title">
                                                        <h2>Áca encontrará todos los datos del áreas {{$area}}</h2>
                                                    </div>
                                                </div>
                                                <form action="{{ route('pdf_area') }}" method="POST" target="_blank">
                                                    @csrf
                                                    <div class="card-box">
                                                        <div class="card-box">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <a href="{{ route('estadisticas1.index') }}" class="btn btn-primary"><i class="fa fa-undo"></i> Regresar</a>
                                                                    <button value="submit" class="btn btn-danger" target="_blank" ><i class="fa fa-file-pdf-o"></i> Imprimir</button>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <h4>Resultado de la búsquedas</h4>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <strong style="float: right;">Semana Número: {{$planificacion->semana}} - Fecha:{{$planificacion->fechas}}</strong>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        {{--
                                                        <div class="card-box">
                                                            <div class="row ajl">
                                                                <div class="col-md-8">                                            
                                                                    <h4 align="center">Actividades PM02 VS Actividades PM03</h4>
                                                                    <div class="bsc-tbl-st">
                                                                        <table class="table table-striped table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th width="50%" style="background: #48C9A9; color: black;">PM02</th>
                                                                                    <th width="50%" style="background: #EF5350; color: black;">PM03</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td width="50%" style="">1</td>
                                                                                    <td width="50%" style="">Alexandra</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4" style="background: white; padding: 20px; border-radius: 10px;">
                                                                    <h4 style="text-align: center;">Gráfica</h4>
                                                                    <div class="row">
                                                                        <!-- Aqui va la grafica -->
                                                                        {!! $graf_act_pm02_vs_act_pm03_g1->render() !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="card-box">
                                                            <div class="row ajl">
                                                                <div class="col-md-8">
                                                                    <h4>Total de Actividades</h4>
                                                                    <div class="bsc-tbl-st">
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
                                                                                    <td bgcolor="white">{!! $count_area[1] !!}</td>
                                                                                    <td bgcolor="white">{!! $count_area[2] !!}</td>
                                                                                    <td bgcolor="white">{!! $count_area[4] !!}</td>
                                                                                    <td bgcolor="white">{!! $count_area[5] !!}</td>
                                                                                    <td bgcolor="white">{!! $count_area[7] !!}</td>
                                                                                    <td bgcolor="white">{!! $count_area[8] !!}</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4" style="background: white; padding: 20px; border-radius: 10px;">
                                                                    <h4 style="text-align: center;">Gráfica</h4>
                                                                    <div class="row">
                                                                        <!-- Aqui va la grafica -->
                                                                        {!! $graf_total_act_g1->render() !!}
                                                                    </div>
                                                                </div>           
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        --}}
                                                        <div class="card-box">
                                                            <div class="row ajl">
                                                                <div class="col-md-8">
                                                                    <h4>{{$area}} <span style="float: right;">Total: {!! $count_area[1]+$count_area[2]+$count_area[4]+$count_area[5]+$count_area[7]+$count_area[8] !!}</span></h4>
                                                                    <div class="bsc-tbl-st">
                                                                        <table class="table table-striped table-bordered">
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
                                                                                    <td bgcolor="white">{!! $count_area[1] !!}</td>
                                                                                    <td bgcolor="white">{!! $count_area[2] !!}</td>
                                                                                    <td bgcolor="white">{!! $count_area[4] !!}</td>
                                                                                    <td bgcolor="white">{!! $count_area[5] !!}</td>
                                                                                    <td bgcolor="white">{!! $count_area[7] !!}</td>
                                                                                    <td bgcolor="white">{!! $count_area[8] !!}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <input type="hidden" name="pm01_r" value="{!! $count_area[1] !!}">
                                                                                    <input type="hidden" name="pm01_nr" value="{!! $count_area[2] !!}">
                                                                                    <input type="hidden" name="pm02_r" value="{!! $count_area[4] !!}">
                                                                                    <input type="hidden" name="pm02_nr" value="{!! $count_area[5] !!}">
                                                                                    <input type="hidden" name="pm03_r" value="{!! $count_area[7] !!}">
                                                                                    <input type="hidden" name="pm03_nr" value="{!! $count_area[8] !!}">

                                                                                    <input type="hidden" name="total_pm02" value="{!! $count_area[3] !!}">
                                                                                    <input type="hidden" name="total_pm03" value="{!! $count_area[6] !!}">

                                                                                    <input type="hidden" value="{{$area}}" name="area">
                                                                                    <input type="hidden" value="{{$gerencia}}" name="gerencia">
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3" style="color: black; text-align: center;"><b>Total PM02</b></td>
                                                                                    <td colspan="3" style="color: black; text-align: center;"><b>Total PM03</b></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="3">{!! $count_area[3] !!}</td>
                                                                                    <td colspan="3">{!! $count_area[6] !!}</td>                                                        
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4" style="background: white; padding: 20px; border-radius: 10px;">
                                                                    <h4 style="text-align: center;">Gráfica</h4>
                                                                    <div class="row">
                                                                        <!-- Aqui va la grafica -->
                                                                        {!! $graf_total->render() !!}
                                                                    </div>
                                                                </div>  
                                                            </div>
                                                        </div>
                                                        <hr>                                              
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" align="center">
                            <a href="{{ route('estadisticas1.index') }}" class="btn btn-primary"><i class="fa fa-undo"></i> Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
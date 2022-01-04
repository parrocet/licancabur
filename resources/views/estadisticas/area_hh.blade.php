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

    @media (min-width:120px) {
        .grafica {
            width: 420px;
            height: 220px;
        }
    }
    @media (min-width:480px) {
        .grafica {
            width: 100%;
            height: 100%;
        }
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
                            <li class="active"><a class="active" data-toggle="tab" href="#reporte_general">Gerencia {{$request->gerencias}} - Área {{$request->areas}}</a></li>
                        </ul>
                        <div class="tab-content tab-custom-st">
                            <div id="reporte_general" class="tab-pane fade in active">
                                <div class="tab-ctn">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="add-todo-list notika-shadow ">
                                                <div class="realtime-ctn">
                                                    <div class="realtime-title">
                                                        <h2>Áca encontrará todos los datos del áreas {{$request->areas}}</h2>
                                                    </div>
                                                </div>
                                                <form action="{{ route('pdf_area_hh') }}" method="POST" target="_blank">
                                                    @csrf
                                                    <input type="hidden" name="gerencias" value="{{$request->gerencias}}">
                                                    <input type="hidden" name="areas" value="{{$request->areas}}">

                                                <div class="card-box">
                                                    <div class="card-box">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <a href="{{ route('estadisticasHH') }}" class="btn btn-primary"><i class="fa fa-undo"></i> Regresar</a>
                                                                <button value="submit" class="btn btn-danger" target="_blank" ><i class="fa fa-file-pdf-o"></i> Imprimir</button>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <h4>Resultado de la búsquedas</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="card-box">
                                                        <div class="row ajl">
                                                            <h4>{{$request->areas}} </h4>
                                                            <div class="col-md-4 table-responsive">
                                                                <table class="table table-striped table-bordered" border="2px" style="height: 40px;">
                                                                    <tr>
                                                                        <td colspan="2" style=" background: #F7C55F; color: black;">PM01</td>
                                                                        <td>HH Realizadas</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th rowspan="13" style=" padding-top: 80%;">
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
                                                                        <td>
                                                                            {!! $hh_pm01[0] !!}
                                                                            <input type="hidden" name="pm01_enero" value="{!! $hh_pm01[0] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Febrero</td>
                                                                        <td>
                                                                            {!! $hh_pm01[1] !!}
                                                                            <input type="hidden" name="pm01_febrero" value="{!! $hh_pm01[1] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Marzo</td>
                                                                        <td>
                                                                            {!! $hh_pm01[2] !!}
                                                                            <input type="hidden" name="pm01_marzo" value="{!! $hh_pm01[2] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Abril</td>
                                                                        <td>
                                                                            {!! $hh_pm01[3] !!}
                                                                            <input type="hidden" name="pm01_abril" value="{!! $hh_pm01[3] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Mayo</td>
                                                                        <td>
                                                                            {!! $hh_pm01[4] !!}
                                                                            <input type="hidden" name="pm01_mayo" value="{!! $hh_pm01[4] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Junio</td>
                                                                        <td>
                                                                            {!! $hh_pm01[5] !!}
                                                                            <input type="hidden" name="pm01_junio" value="{!! $hh_pm01[5] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Julio</td>
                                                                        <td>
                                                                            {!! $hh_pm01[6] !!}
                                                                            <input type="hidden" name="pm01_julio" value="{!! $hh_pm01[6] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Agosto</td>
                                                                        <td>
                                                                            {!! $hh_pm01[7] !!}
                                                                            <input type="hidden" name="pm01_agosto" value="{!! $hh_pm01[7] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Septiembre</td>
                                                                        <td>
                                                                            {!! $hh_pm01[8] !!}
                                                                            <input type="hidden" name="pm01_septiembre" value="{!! $hh_pm01[8] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Octubre</td>
                                                                        <td>
                                                                            {!! $hh_pm01[9] !!}
                                                                            <input type="hidden" name="pm01_octubre" value="{!! $hh_pm01[9] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Noviembre</td>
                                                                        <td>
                                                                            {!! $hh_pm01[10] !!}
                                                                            <input type="hidden" name="pm01_noviembre" value="{!! $hh_pm01[10] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Diciembre</td>
                                                                        <td>
                                                                            {!! $hh_pm01[11] !!}
                                                                            <input type="hidden" name="pm01_diciembre" value="{!! $hh_pm01[11] !!}">
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="col-md-4 table-responsive">
                                                                <table class="table table-striped table-bordered" border="2px">
                                                                    <tr>
                                                                        <td colspan="2" style=" background: #48C9A9; color: black;">PM02</td>
                                                                        <td>HH Realizadas</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th rowspan="13" style=" padding-top: 80%;">
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
                                                                        <td>
                                                                            {!! $hh_pm02[0] !!}
                                                                            <input type="hidden" name="pm02_enero" value="{!! $hh_pm02[0] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Febrero</td>
                                                                        <td>
                                                                            {!! $hh_pm02[1] !!}
                                                                            <input type="hidden" name="pm02_febrero" value="{!! $hh_pm02[1] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Marzo</td>
                                                                        <td>
                                                                            {!! $hh_pm02[2] !!}
                                                                            <input type="hidden" name="pm02_marzo" value="{!! $hh_pm02[2] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Abril</td>
                                                                        <td>
                                                                            {!! $hh_pm02[3] !!}
                                                                            <input type="hidden" name="pm02_abril" value="{!! $hh_pm02[3] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Mayo</td>
                                                                        <td>
                                                                            {!! $hh_pm02[4] !!}
                                                                            <input type="hidden" name="pm02_mayo" value="{!! $hh_pm02[4] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Junio</td>
                                                                        <td>
                                                                            {!! $hh_pm02[5] !!}
                                                                            <input type="hidden" name="pm02_junio" value="{!! $hh_pm02[5] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Julio</td>
                                                                        <td>
                                                                            {!! $hh_pm02[6] !!}
                                                                            <input type="hidden" name="pm02_julio" value="{!! $hh_pm02[6] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Agosto</td>
                                                                        <td>
                                                                            {!! $hh_pm02[7] !!}
                                                                            <input type="hidden" name="pm02_agosto" value="{!! $hh_pm02[7] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Septiembre</td>
                                                                        <td>
                                                                            {!! $hh_pm02[8] !!}
                                                                            <input type="hidden" name="pm02_septiembre" value="{!! $hh_pm02[8] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Octubre</td>
                                                                        <td>
                                                                            {!! $hh_pm02[9] !!}
                                                                            <input type="hidden" name="pm02_octubre" value="{!! $hh_pm02[9] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Noviembre</td>
                                                                        <td>
                                                                            {!! $hh_pm02[10] !!}
                                                                            <input type="hidden" name="pm02_noviembre" value="{!! $hh_pm02[10] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Diciembre</td>
                                                                        <td>
                                                                            {!! $hh_pm02[11] !!}
                                                                            <input type="hidden" name="pm02_diciembre" value="{!! $hh_pm02[11] !!}">
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                            <div class="col-md-4 table-responsive">
                                                                <table class="table table-striped table-bordered" border="2px">
                                                                    <tr>
                                                                        <td colspan="2" style=" background: #EF5350; color: black;">PM03</td>
                                                                        <td>HH Realizadas</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th rowspan="13" style=" padding-top: 80%;">
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
                                                                        <td>
                                                                            {!! $hh_pm03[0] !!}
                                                                            <input type="hidden" name="pm03_enero" value="{!! $hh_pm03[0] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Febrero</td>
                                                                        <td>
                                                                            {!! $hh_pm03[1] !!}
                                                                            <input type="hidden" name="pm03_febrero" value="{!! $hh_pm03[1] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Marzo</td>
                                                                        <td>
                                                                            {!! $hh_pm03[2] !!}
                                                                            <input type="hidden" name="pm03_marzo" value="{!! $hh_pm03[2] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Abril</td>
                                                                        <td>
                                                                            {!! $hh_pm03[3] !!}
                                                                            <input type="hidden" name="pm03_abril" value="{!! $hh_pm03[3] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Mayo</td>
                                                                        <td>
                                                                            {!! $hh_pm03[4] !!}
                                                                            <input type="hidden" name="pm03_mayo" value="{!! $hh_pm03[4] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Junio</td>
                                                                        <td>
                                                                            {!! $hh_pm03[5] !!}
                                                                            <input type="hidden" name="pm03_junio" value="{!! $hh_pm03[5] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Julio</td>
                                                                        <td>
                                                                            {!! $hh_pm03[6] !!}
                                                                            <input type="hidden" name="pm03_julio" value="{!! $hh_pm03[6] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Agosto</td>
                                                                        <td>
                                                                            {!! $hh_pm03[7] !!}
                                                                            <input type="hidden" name="pm03_agosto" value="{!! $hh_pm03[7] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Septiembre</td>
                                                                        <td>
                                                                            {!! $hh_pm03[8] !!}
                                                                            <input type="hidden" name="pm03_septiembre" value="{!! $hh_pm03[8] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Octubre</td>
                                                                        <td>
                                                                            {!! $hh_pm03[9] !!}
                                                                            <input type="hidden" name="pm03_octubre" value="{!! $hh_pm03[9] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Noviembre</td>
                                                                        <td>
                                                                            {!! $hh_pm03[10] !!}
                                                                            <input type="hidden" name="pm03_noviembre" value="{!! $hh_pm03[10] !!}">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Diciembre</td>
                                                                        <td>
                                                                            {!! $hh_pm03[11] !!}
                                                                            <input type="hidden" name="pm03_diciembre" value="{!! $hh_pm03[11] !!}">
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                {{--
                                                                <div style="background: white; padding: 20px; border-radius: 10px;">
                                                                    <h4 style="text-align: center;">Gráfica</h4>
                                                                    <div class="row">
                                                                        <!-- Aqui va la grafica -->
                                                                        {!! $graf_hh_3->render() !!}
                                                                    </div>
                                                                </div>
                                                                --}}
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 table-responsive" style="background: white; padding: 20px; border-radius: 10px;">
                                                                <div class="grafica">
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
                                                                    <div class="row">
                                                                        <!-- Aqui va la grafica -->
                                                                        {!! $graf_hh_1->render() !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 table-responsive mt-3" style="background: white; padding: 20px; border-radius: 10px;">
                                                                <div class="grafica">
                                                                    <h4 style="text-align: center;">Gráfica por tipo PM01 vs PM02 del 
                                                                        @if(session('fecha_actual'))
                                                                            @php $anio=session('fecha_actual'); @endphp
                                                                        @else
                                                                            @php $anio=date('Y');
                                                                                session('fecha_actual',$anio);
                                                                             @endphp
                                                                            
                                                                        @endif
                                                                        {{ $anio }}
                                                                    </h4>
                                                                    <div class="row">
                                                                        <!-- Aqui va la grafica -->
                                                                        {!! $graf_hh_area_2->render() !!}
                                                                    </div>
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
                            <a href="{{ route('estadisticasHH') }}" class="btn btn-primary"><i class="fa fa-undo"></i> Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
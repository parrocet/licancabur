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
                                    <h2>Estadísticas HH</h2>
                                    <p>Filtro para mostrar estadísticas HH específica..</p>
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
                            @if($request->gerencias=="NPI")
                            <li class="active"><a class="active" data-toggle="tab" href="#reporte_general">Gerencia NPI</a></li>
                            @elseif($request->gerencias=="CHO")
                            <li class="active"><a data-toggle="tab" class="active" href="#reporte_cronologico">Gerencia CHO</a></li>
                            @endif
                        </ul>
                        <div class="tab-content tab-custom-st">
                            @if($request->gerencias=="NPI")
                            <div id="reporte_general" class="tab-pane fade in active">
                                <div class="tab-ctn">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="add-todo-list notika-shadow ">
                                                <div class="realtime-ctn">
                                                    <div class="realtime-title">
                                                        <h2>Áca encontrará todas las áreas correspondiente a la gerencia NPI</h2>
                                                    </div>
                                                </div>
                                                <div class="card-box">
                                                    @include('estadisticas.partials.npi_hh-field')                                                  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @elseif($request->gerencias=="CHO")
                            <div id="reporte_cronologico" class="tab-pane fade in active">
                                <div class="tab-ctn">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="notika-chat-list notika-shadow tb-res-ds-n dk-res-ds">
                                                <div class="realtime-ctn">
                                                    <div class="realtime-title">
                                                        <h2>Áca encontrará todas las áreas correspondiente a la gerencia CHO</h2>
                                                    </div>
                                                </div>
                                                <div class="card-box">
                                                    @include('estadisticas.partials.cho_hh-field')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
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
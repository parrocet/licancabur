@php
  libxml_use_internal_errors(true);
@endphp
@extends('layouts.appLayout')
@section('css')
<style type="text/css">
    body{
        background-color: #DCDCDC !important;
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
                                    <p>Filtro para mostrar estadísticas específica..</p><br>
                                    @if($contar==0)
                                         <div class="alert alert-warning" role="alert">
                                          No existen Actividades registradas
                                        </div>                                   
                                    @endif 
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
        @if((buscar_p('Estadisticas','Por Ejecucion')=="Si"))
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="widget-tabs-int">
                    <div class="widget-tabs-list">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="notika-chat-list notika-shadow tb-res-ds-n dk-res-ds">
                                    <div class="realtime-ctn">
                                        <div class="realtime-title">
                                            <h2>Filtro de estadísticas <small>Todos los campos (<b style="color: red;">*</b>) son requerido.</small></h2>
                                        </div>
                                    </div>
                                    <div class="card-box">
                                        {!! Form::open(['route' => 'estadisticas1.store', 'method' => 'post', 'data-parsley-validate']) !!}
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="">Gerencias: <b style="color: red;">*</b></label></label>
                                                        <select name="gerencias" id="gerencias" class="form-control" required="required">
                                                            <option value="">Seleccione la gerencia...</option>
                                                            <!-- <option value="todas">Todas</option> -->
                                                            @foreach($gerencias as $item)
                                                            <option value="{{ $item->gerencia }}">{{ $item->gerencia }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="">Áreas: <b style="color: red;">*</b></label></label>
                                                        <select name="areas" id="areas" class="form-control" required="required" disabled="disabled">
                                                            <option value="">Seleccione un área...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="">Semana: <b style="color: red;">*</b></label></label>
                                                        <select name="planificacion" id="planificacion" class="form-control" required="required">
                                                            <option value="">Seleccione una semana...</option>
                                                            @if($contar>0)
                                                            @foreach($planificacion as $item)
                                                                <option value="{{$item->semana}}">Semana: {{$item->semana}} - ({{$item->fechas}})</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="text-center mt-4">
                                                <button class="btn btn-md btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                            </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="alert alert-danger alert-mg-b-0" role="alert">
                <h3 align="center">¡NO TIENE PERMISO A ESTE MÓDULO, ACCESO RESTRINGIDO!</h3>
            </div>
        @endif
    </div>
</div>


@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready( function(){
        $("#gerencias").on("change",function (event) {
            var gerencias=event.target.value;
            console.log(gerencias); // true
            $("#areas").empty();
            if(gerencias == "NPI"){
                $("#areas").removeAttr('disabled');
                $("#areas").append('<option value="todas">Todas...</option>');
                $("#areas").append('<option value="EWS">EWS</option>');
                $("#areas").append('<option value="Planta Cero/Desaladora & Acueducto">Planta Cero/Desaladora & Acueducto</option>');
                $("#areas").append('<option value="Agua y Tranque">Agua y Tranque</option>');

            } else if(gerencias == "CHO"){
                $("#areas").removeAttr('disabled');
                $("#areas").append('<option value="todas">Todas...</option>');
                $("#areas").append('<option value="Filtro-Puerto">Filtro-Puerto</option>');
                $("#areas").append('<option value="ECT">ECT</option>');
                $("#areas").append('<option value="Los Colorados">Los Colorados</option>');

            } else if(gerencias == "todas"){
                $("#areas").append('<option value="">Todas las áreas seleccionadas</option>');
                $("#areas").attr('disabled', true);
                $("#areas").attr('required', false);

            } else if(gerencias == ""){
                $("#areas").append('<option value="">Seleccione un área...</option>');
                $("#areas").attr('disabled', true);

            }
        });
    });
</script>
@endsection
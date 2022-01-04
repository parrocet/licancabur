@extends('layouts.appLayout')

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
                                    <a href="{{ route('graficas.index') }}" data-toggle="tooltip"
                                        data-placement="bottom" title="Gráficas" class="btn">
                                        <i class="notika-icon notika-star"></i>
                                    </a>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Gráficas</h2>
                                    <p>Filtro para consultar gráficas</p>
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
                        @if(buscar_p('Graficas','Ver')=="Si")
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                            <div class="breadcomb-report">
                                <a href="{{ route('graficas.status_general')}}" class="btn btn-default">Status actual</a>
                            </div>
                        </div>
                        @endif
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
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-element-list">
                    <div class="basic-tb-hd text-center">
                        @if(buscar_p('Graficas','Ver')=="Si")
                        <p>Todos los campos (<b style="color: red;">*</b></label>) son obligatorios</p>
                        @endif
                        @if(count($errors))
                        <div class="alert-list m-4">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>
                                        {{$error}}
                                    </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        @endif
                        @include('flash::message')
                    </div>
                    @if(buscar_p('Graficas','Ver')=="Si")
                    {!! Form::open(['route' => 'graficas.store', 'method' => 'post']) !!}
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="">¿Qué tipo de gráfica desea mostrar? <b style="color: red;">*</b></label></label>
                                    <select name="graficas" id="graficas" class="form-control">
                                        <option value="Area">Área</option>
                                        <option value="Tipo">Tipo</option>
                                        <!-- <option value="Turno">Turno</option> -->
                                        <option value="Semanas">Semanas</option>
                                        <option value="Realizadas">Realizadas</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="">Tipo de gráfica: <b style="color: red;">*</b></label></label>
                                    <select name="tipo_grafica" id="tipo_grafica" class="form-control">
                                        <option id="Barra" value="Barra">Barra</option>
                                        <option value="Torta">Torta</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="">Semana: <b style="color: red;">*</b></label></label>
                                    <select name="planificacion" id="planificacion" class="form-control" required="required">
                                        @for($i=1; $i<=52; $i++)
                                            @if(mostrar_semana($i)>0)<option value="{{$i}}">{{$i}}</option>
                                            @endif
                                        @endfor                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="">Gerencias: <b style="color: red;">*</b></label></label>
                                    <select name="gerencias" id="gerencias" class="form-control" required="required">
                                        @foreach($gerencias as $key)
                                        <option value="{{$key->gerencia}}">{{$key->gerencia}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    <div class="text-center mt-4">
                        <button class="btn btn-md btn-info">Buscar</button>
                    </div>

                    {!! Form::close() !!}
                    @else
                    <div class="alert alert-danger alert-mg-b-0" role="alert">
                        <h3 align="center">¡NO TIENE PERMISO A ESTE MÓDULO, ACCESO RESTRINGIDO!</h3>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$( function() {
    $("#graficas").change( function() {

            if ($(this).val() === "Semanas") {
                semana.value="";
                fecha_desde.value="";
                fecha_hasta.value="";
                $("#semana").removeAttr('style');
                $("#fecha_desde").prop("disabled", true);
                $("#fecha_hasta").prop("disabled", true);
            }
            else {
                $("#semana").css('display','none');
                $("#fecha_desde").prop("disabled", false);
                $("#fecha_hasta").prop("disabled", false);
            }
    });

    $("#gerencias").on("change",function (event) {
            var gerencias=event.target.value;
            console.log(gerencias); // true
            $("#areas").empty();




            if(gerencias == 0){
                $("#areas").removeAttr('disabled');
                $("#areas").append('<option value="0">Todas...</option>');
                $("#areas").append('<option value="1">EWS</option>');
                $("#areas").append('<option value="2">Planta Cero/Desaladora & Acueducto</option>');
                $("#areas").append('<option value="3">Agua y Tranque</option>');
                $("#areas").append('<option value="4">Filtro-Puerto</option>');
                $("#areas").append('<option value="5">ECT</option>');
                $("#areas").append('<option value="6">Los Colorados</option>');

            } else if(gerencias == "NPI"){
                $("#areas").removeAttr('disabled');
                $("#areas").append('<option value="0">Todas...</option>');
                $("#areas").append('<option value="1">EWS</option>');
                $("#areas").append('<option value="2">Planta Cero/Desaladora & Acueducto</option>');
                $("#areas").append('<option value="3">Agua y Tranque</option>');

            } else if(gerencias == "CHO"){
                $("#tipo_filtro").removeAttr('disabled');
                $("#areas").append('<option value="0">Todas...</option>');
                $("#areas").append('<option value="4">Filtro-Puerto</option>');
                $("#areas").append('<option value="5">ECT</option>');
                $("#areas").append('<option value="6">Los Colorados</option>');

            } else if(gerencias == ""){
                $("#tipo_filtro").append('<option value="">Seleccione un filtro...</option>');
                $("#tipo_filtro").attr('disabled', true);

            }
        });

});
</script>
@endsection
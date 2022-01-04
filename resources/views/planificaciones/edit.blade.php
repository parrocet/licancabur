@extends('layouts.appLayout')
@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/jquery-ui/jquery-ui.css') }}">
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
                                    <a href="{{ route('planificaciones.index') }}" data-toggle="tooltip"
                                        data-placement="bottom" title="Volver" class="btn">
                                        <i class="notika-icon notika-left-arrow"></i>
                                    </a>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Modificar Planificación</h2>
                                    <p>Modificar planificación en el sistema</p>
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
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-element-list">
                    <div class="basic-tb-hd text-center">
                        <p>Todos los campos (<b style="color: red;">*</b>) son obligatorios</p>
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

                    {!! Form::open(['route' => ['planificaciones.update',1], 'method' => 'PUT', 'name' => 'editar_planificacion', 'id' => 'editar_planificacion', 'data-parsley-validate']) !!}
                        @csrf
                        <h4>Datos de planificación</h4>
                        <hr>
                        <div class="row">
		            		<div class="col-md-4">
				            	<div class="form-group">
				            		<label id="curso">Elaborado por: <b style="color: red;">*</b></label>
				            		<select name="elaborado" id="elaborado_edit" class="form-control select2" required style="width: 100% !important;">
				            			@foreach($usuarios as $key)
				            				<option value="{{$key->id}}" @if($planificacion->elaborado==$key->id) selected @endif>{{$key->name}}</option>
				            			@endforeach()
				            		</select>
				            	</div>	            			
		            		</div>
		            		<div class="col-md-4">
				            	<div class="form-group">
				            		<label id="curso">Aprobado por: <b style="color: red;">*</b></label>
				            		<select name="aprobado" id="aprobado_edit" class="form-control select2" required style="width: 100% !important;">
				            			@foreach($usuarios as $key)
				            				<option value="{{$key->id}}" @if($planificacion->aprobado==$key->id) selected @endif>{{$key->name}}</option>
				            			@endforeach()
				            		</select>
				            	</div>	            			
		            		</div>
		            		<div class="col-md-4">
				            	<div class="form-group">
				            		<label id="curso">Num. de contrato <b style="color: red;">*</b></label>
				            		<input type="number" name="num_contrato" id="num_contrato_edit" required="required" class="form-control" placeholder="Número de contrato" value="{{$planificacion->num_contrato}}">
				            	</div>		            			
		            		</div>
		            	</div>
		            	<hr>
                        <center>
				            <h3>Fechas: <span class="text-info">{{$planificacion->fechas}}</span></h3>
				            <input type="hidden" name="fechas_r" value="{{$planificacion->fechas}}">
			            	
	            			<!-- <div class="form-group">
	            				<input type="checkbox" name="cambiar_fechas" id="cambiar_fechas" value="1">
                                <label for="cambiar_fechas">Cambiar fechas</label>
	            			</div> -->
                        </center>
                        <!-- <div class="card shadow" id="mostrarCambiarFechas" style="display: none">
                            <div class="card body">
        		            	<div class="row">
        		            		<div class="col-md-6">
        		            			<label id="desde">Desde <b style="color: red;">*</b></label>
        		            			<input type="text" id="datepicker" name="desde" class="form-control desde" keyup="calcularFecha()" autocomplete="off" disabled>
                                        <input type="hidden" value="{{ $anio }}" name="anio" id="anio">
        		            		</div>
        		            		<div class="col-md-6">
        		            			<label id="hasta">Hasta <b style="color: red;">*</b></label>
        		            			<input type="text" name="hasta" class="form-control hasta" id="datepicker" disabled>
        		            			<input type="hidden" name="hasta1" class="form-control hasta1" id="datepicker" readonly="readonly">
        		            		</div>
        		            	</div>
                            </div>
                        </div> -->
		            	<hr>
		            	<!-- <div class="form-group">
		            		<label id="semana">Semana <b style="color: red;">*</b></label>
		            		<input type="text" name="semana" id="semana_edit" required="required" class="form-control" placeholder="Semana de la planificación">
		            	</div> -->
                        <center>
			            	<h3>Gerencia: <span class="text-info">{{$planificacion->gerencias->gerencia}}</span></h3>
			            	<input type="hidden" name="fechas_r" value="{{$planificacion->fechas}}">
		            			<div class="form-group">
		            				<input type="checkbox" name="cambiar_gerencia" id="cambiar_gerencia" value="1">
	                                <label for="cambiar_gerencia">Cambiar gerencia</label>
		            			</div>
                        </center>
				            	
		            	<div class="row justify-content-center">
		            		<div class="col-md-6">
				            	<div class="form-group">
				            		<label id="revision">Revisión <b style="color: red;">*</b></label>
				            		<select name="revision" class="form-control select2" id="revision_edit" style="width: 100% !important;" required>
				            			<option value="A" @if($planificacion->revision=="A") selected="" @endif>A</option>
				            			<option value="B" @if($planificacion->revision=="B") selected="" @endif>B</option>
				            			<option value="C" @if($planificacion->revision=="C") selected="" @endif>C</option>
				            			<option value="D" @if($planificacion->revision=="D") selected="" @endif>D</option>
				            		</select>
				            	</div>	            			
		            		</div>
		            		<div class="col-md-6" id="mostrarCambiarGerencias" style="display: none">
				            	<div class="form-group">
				            		<label id="curso">Gerencia <b style="color: red;">*</b></label>
				            		<select name="id_gerencia" class="form-control select2" style="width: 100% !important;" id="gerencia_edit" disabled="disabled">
				            			<option value="">Seleccione una gerencia</option>
				            			@foreach($gerencias as $key)
				            				<option value="{{$key->id}}" @if($planificacion->id_gerencia==$key->id) disabled @endif>{{$key->gerencia}}</option>
				            			@endforeach()
				            		</select>
				            	</div>	            			
		            		</div>
		            	</div>

                        <div class="text-center mt-4">
                            <input type="hidden" name="id" value="{{$planificacion->id}}">
                            <a href="{{ route('planificaciones.index') }}" class="btn btn-info btn-sm">Regresar</a>
                            <button class="btn btn-lg btn-success btn-sm" type="submit">Modificar planificación</button>
                        </div>

                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>
<script src="i18n/datepicker-es.js"></script>
<script>
	//EDITAR
    $( function() {
        var anio = $("#anio").val();
        console.log(anio);
        $( "#datepicker" ).datepicker({
            closeText: 'Cerrar',
            currentText: 'Hoy',
            prevText: '<Ant',
            nextText: 'Sig>',
            dateFormat: 'dd-mm-yy',
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
            showWeek: true,
            changeMonth: true,
            changeYear: false,
            showButtonPanel: true,
            yearRange: "-18:-12",
            minDate: new Date(anio, 0, 1),
            maxDate: new Date(anio, 11, 31),
            beforeShowDay: function(date){
                var day = date.getDay();
                return [(day != 0 && day != 1 && day != 2 && day != 4 && day != 5 && day != 6), ''];
            }
        }).focus(function () {
               $(".datepicker").hide();
        });;
        //$( "#datepicker" ).datepicker( "option", "dateFormat", 'dd-mm-yy' );
    });

    $( function() {
        $(".desde").datepicker();
        $(".hasta").datepicker();
        $(".hasta1").datepicker();

        $(".desde").on("change", function() {
            var fecha = $(".desde").datepicker("getDate");
            fecha.setDate(fecha.getDate() + 6); 
            $(".hasta").datepicker("setDate", fecha);
            $(".hasta1").datepicker("setDate", fecha);
            $(".hasta").datepicker( "option", "dateFormat", 'dd-mm-yy' );
            $(".hasta1").datepicker( "option", "dateFormat", 'dd-mm-yy' );
        });
    });
</script>
<script type="text/javascript">
$('#cambiar_fechas').on('change',function () {
    if ($('#cambiar_fechas').prop('checked')) {
      $('#datepicker').attr('disabled',false);
      $("#datepicker").prop('required', true);
      $('#mostrarCambiarFechas').fadeIn(300);
    }else{
      $('#datepicker').attr('disabled',true);
      $("#datepicker").removeAttr('required');
      datepicker.value="";
      $('#mostrarCambiarFechas').fadeOut('slow');
    }
  });
$('#cambiar_gerencia').on('change',function () {
    if ($('#cambiar_gerencia').prop('checked')) {
      $('#gerencia_edit').attr('disabled',false);
      $("#gerencia_edit").prop('required', true);
      $('#mostrarCambiarGerencias').fadeIn(300);
    }else{
      $('#gerencia_edit').attr('disabled',true);
      $("#gerencia_edit").removeAttr('required');
      gerencia_edit.value="";
      $('#mostrarCambiarGerencias').fadeOut('slow');
    }
  });
</script>
@endsection

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
									<i class="notika-icon notika-support"></i>
								</div>
								<div class="breadcomb-ctn">
									<h2>Planificaciones</h2>
									<p>Lista de todas las Planificaciones registradas en el sistema</p>
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
                        @if(buscar_p('Planificación','Registrar')=="Si")
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
							<div class="breadcomb-report">
								<button value="0" data-toggle="modal" data-target="#nuevaPlanificacion" class="btn btn-default" data-backdrop="static" data-keyboard="false">Nueva Planificación</button>
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
<!-- Data Table area Start-->
<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="basic-tb-hd text-center">
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
                <div class="data-table-list">
                    
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Elaborado por</th>
                                    <th>Aprobado por</th>
                                    <th>Num. de contrato</th>
                                    <th>Fechas</th>
                                    <th>Semana</th>
                                    <th>Revisión</th>
                                    <th>Gerencia</th>
                                    <th style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $num=0;?>
                            	@foreach($planificaciones as $key )
                                    <tr>                                        
    	                           		<td>{{$num=$num+1}}</td>
    	                           		<td>{{$key->elaborados->nombres}} {{$key->elaborados->apellidos}}</td>
    	                           		<td>{{$key->aprobados->nombres}} {{$key->aprobados->apellidos}}</td>
    	                           		<td>{{$key->num_contrato}}</td>
    	                           		<td>{{$key->fechas}}</td>
    	                           		<td>{{$key->semana}}</td>
    	                           		<td>{{$key->revision}}</td>
    	                           		<td>{{$key->gerencias->gerencia}}</td>
    	                           		<td>
                                            @if(buscar_p('Planificación','Modificar')=="Si")
    	                           			<a style="width: 76px;" class="btn btn-warning" data-backdrop="static" data-keyboard="false" href="{{ route('planificaciones.edit', $key->id) }}"> Editar</a>
                                            @endif
                                            @if(buscar_p('Planificación','Eliminar')=="Si")
    	                           			<button data-toggle="modal" data-target="#eliminarPlanificacion" class="btn btn-danger" data-backdrop="static" onclick="eliminar('{{$key->id}}')" data-keyboard="false"> Eliminar</button>
                                            @endif
    	                           		</td>
                                    </tr>
	                           	@endforeach()
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('planificaciones.modales.create')
    @include('planificaciones.modales.delete')

</div>
<!-- Data Table area End-->
@endsection

<!-- @include('examenes.modales.eliminar') -->

@section('scripts')
    <script type="text/javascript">

    	function eliminar(id) {
    		$('#id_planificacion_eli').val(id);
    	}
        function editarPlanificacion(id,elaborado,aprobado,num_contrato,fechas,semana,revision,gerencia) {
            $('#id_planificacion_edit').val(id);
			$('#elaborado_edit').val(elaborado);
			$('#aprobado_edit').val(aprobado);
			$('#num_contrato_edit').val(num_contrato);
			$('#fechas_edit').html('<h4>'+fechas+'</h4>');
			$('#semana_edit').val(semana);
			$('#revision_edit').val(revision);
			$('#gerencia_edit').val(gerencia);
        }
    </script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>
    <script src="i18n/datepicker-es.js"></script>
    <script>
        //REGISTRAR
        $( function() {
            var anio = $("#anio").val();
            console.log(anio);
            $( "#datepicker" ).datepicker({
                closeText: 'Cerrar',
                currentText: 'Hoy',
                prevText: '<Ant',
                nextText: 'Sig>',
                dateFormat: 'dd-mm-yy',
                monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
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

        $('#anio_all').on('change',function () {
            if ($('#anio_all').prop('checked')) {
                $('#datepicker').attr('disabled',true);
                $("#datepicker").removeAttr('required');
                $('#ocultarFechas').fadeOut('slow');
            }else{
                datepicker.value="";
                $('#datepicker').attr('disabled',false);
                $("#datepicker").prop('required', true);
                $('#ocultarFechas').fadeIn(300);
            }
        });
    </script>
@endsection
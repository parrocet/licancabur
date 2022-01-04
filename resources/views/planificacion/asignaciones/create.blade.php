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
										<i class="notika-icon notika-support"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Actividades asignadas</h2>
										<p>Lista de todas las actividades asignadas a los empleados registrados en el sistema</p>
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
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									
								</div>
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
<div class="contact-area">
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
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">

                    <div class="row">
                        <div class="col-xs-12">
                            <label for="id_empleado"> Seleccione al empleado</label><b style="color: red;">*</b>
                            <select class="form-control" name="id_empleado" id="id_empleado">
                                <option value="0" disabled="disabled">Seleccione al empleado</option>
                                @foreach($empleados as $key)
                                    <option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}} - {{$key->rut}}</option>
                                @endforeach()
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="tabla">
        <div class="data-table-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="data-table-list">
                            
                            <div class="table-responsive">
                                <table id="tabla_muestra" class="table table-striped">








                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Data Table area End-->
    </div>
</div>
<div class="modal fade" id="ModalMensaje" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h2>Registro eliminado con éxito!</h2>

            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>


@include('planificacion.modales.eliminar_asignacion')
@endsection
@section('scripts')
<script type="text/javascript">
    function cerrar() {
        $('#ModalMensaje').hide();
    }
    $(document).ready(function() {
        $('#tabla').hide();

        $("#id_empleado").on("change",function (event) {

            var id_empleado=event.target.value;
            $("#id_empleado_act_eliminar").val(id_empleado);
            $.get("/asignacion/"+id_empleado+"/buscar",function (data) {
                
                $("#tabla").show();
                $("#tabla_muestra").empty();
                

                if(data.length > 0){

                    $("#tabla_muestra").append('<thead><tr><th>#</th><th>Actividad</th><th>Tipo</th><th>Duración</th><th>Fecha de vencimiento</th><th>Acciones</th></tr></thead>');

                    for (var i = 0; i < data.length ; i++) 
                    {  
                        v=i+1;
                        $("#tabla_muestra").append('<tbody><tr><td>'+v+'</td><td>'+ data[i].task +'</td><td>'+ data[i].tipo +'</td><td>'+ data[i].duracion_pro +'</td><td>'+ data[i].fecha_vencimiento +'</td><td><button id="eliminar_actividad" onclick="eliminar('+data[i].id+')" value="0" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModaltre"><i class="fa fa-trash"></i> </button></td></tr></tbody');
                    }
                }else{

                    $('#tabla').hide();
                    // alert('No Da');

                }
            });
        });


    });
</script>
<script>
$(function () {
  $('select').each(function () {
    $(this).select2({
      theme: 'bootstrap4',
      width: 'style',
      placeholder: $(this).attr('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
  });
});
</script>
<script type="text/javascript">



        function eliminar_asignacion() {

            var id_actividad=   $('#id_actividad_eliminar').val();
            var id_empleado=    $('#id_empleado_act_eliminar').val();

            $.get(id_actividad+'/'+id_empleado+'/eliminar_asignacion',function(data){
                console.log(data.length);
                $("#tabla_muestra").empty();
                if(data.length > 0){

                    $("#tabla_muestra").append('<thead><tr><th>#</th><th>Actividad</th><th>Tipo</th><th>Duración</th><th>Fecha de vencimiento</th><th>Acciones</th></tr></thead>');
                    $('#myModaltre').modal('hide');
                    $('#ModalMensaje').modal();
                    


                    for (var i = 0; i < data.length ; i++) 
                    {  
                        v=i+1;
                        $("#tabla_muestra").append('<tbody><tr><td>'+v+'</td><td>'+ data[i].task +'</td><td>'+ data[i].tipo +'</td><td>'+ data[i].duracion_pro +'</td><td>'+ data[i].fecha_vencimiento +'</td><td><button id="eliminar_actividad" onclick="eliminar('+data[i].id+')" value="0" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModaltre"><i class="fa fa-trash"></i> </button></td></tr></tbody');
                    }
                }else{

                    $('#tabla').hide();
                    // alert('No Da');

                }
                
            });
        }

    function eliminar(id_actividad) {
        $("#id_actividad_eliminar").val(id_actividad);
    }
</script>
@endsection
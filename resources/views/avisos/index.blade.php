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
										<i class="fa fa-envelope-o"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Avisos</h2>
										<p>Lista de todos los avisos del sistema</p>
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
									<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#NuevoAviso">Nuevo aviso</a>
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

<div class="form-element-area modals-single">
    <div class="container" style="width: ;">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="callout callout-success" style="height: -5px;">
                    <h4>Envío de avisos!</h4>

                    <ul>
                        <li><strong>Automático</strong> 
                            <!-- <ul>
                                <li>Asigna todas las actividades en la planificación y área, al empleado seleccionado</li>
                            </ul> -->
                        </li>
                        <li><strong>Manual</strong> 
                            <!-- <ul>
                                <li>Asigna las actividades seleccionadas en la tabla, de la planificación y área al empleado seleccionado</li>
                            </ul> -->
                        </li>
                        <li><strong>Ambos</strong> 

                        </li>
                    </ul>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
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
                        
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="data-table-list">
                                    <div class="table-responsive">
                                        <table id="data-table-basic2" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nro.</th>
                                                    <th>Motivo</th>
                                                    <th>Mensaje</th>
                                                    <th>Dias previos</th>
                                                    <th>Días del aviso</th>
                                                    <th>Modalidad</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            	@php $i=1; @endphp
                                            	@foreach($avisos as $key)
                                                    <tr>
                                                    	<td>@php $i=$i+1; @endphp</td>
                                                    	<td>{{$key->motivo}}</td>
                                                    	<td>{{$key->mensaje}}</td>
                                                    	<td>{{$key->dias_previos}}</td>
                                                    	<td>{{$key->dias_post}}</td>
                                                    	<td>{{$key->modalidad}}</td>
                                                    	<td>
                                                    		<a href="#" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                                    	</td>
                                                    </tr>
                                                @endforeach()
                                                <tr>
                                                    	<td>1</td>
                                                    	<td>Asignación de actividades</td>
                                                    	<td>Por motivo de mantenimiento de las nuevas áreas, la actividad en la que fué asignado ha sido modificado con los nuevos... <a href="#" data-toggle="modal" data-target="#verMas">Ver más...</a></td>
                                                    	<td><span class="label label-success pull-center">6 dias</span></td>
                                                    	<td><span class="label label-warning pull-center">1 dias</span></td>
                                                    	<td>Ambas</td>
                                                    	<td>
                                                    		<a href="#" class="btn btn-default" data-toggle="modal" data-target="#verAviso"><i class="fa fa-eye"></i></a>

                                                    		<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editarAviso"><i class="fa fa-pencil"></i></a>

                                                    		<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#eliminarAviso"><i class="fa fa-trash"></i></a>
                                                    	</td>
                                                    </tr>
                                            </tbody>    
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data Table area End-->

<div class="modal fade" id="NuevoAviso" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Nuevo aviso</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <hr>
            </div>
            <div class="modal-body">
            	@include('avisos.modales.nuevo_aviso')
            </div>
            <div class="modal-footer">
            	<hr>
                <button type="submit" class="btn btn-primary" name="Enviar" value="Enviar">Crear aviso</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editarAviso" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Editar aviso</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <hr>
            </div>
            <div class="modal-body">
            	@include('avisos.modales.editar_aviso')
            </div>
            <div class="modal-footer">
            	<hr>
                <button type="submit" class="btn btn-primary" name="Enviar" value="Enviar">Editar aviso</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="verAviso" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Asignación de actividades</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <hr>
            </div>
            <div class="modal-body">
            	<p><strong>Por motivo de mantenimiento de las nuevas áreas, la actividad en la que fué asignado ha sido modificado con los nuevos parámetros a cumplir en la nueva actividad</strong></p>
            	<hr>
            	<div class="row">
            		
            		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Días previos
            			<span class="label label-success pull-center">6 dias</span>
            		</div>
            		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">Días del post
            			<span class="label label-warning pull-center">1 dias</span>
            		</div>
            	</div>
            	<hr>
            	<div class="row">
            		
            		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Modalidad
            			<strong>Ambas</strong>
            		</div>
            	</div>
            </div>
            <div class="modal-footer">
            	
            </div>
        </div>
    </div>
</div>
@include('avisos.modales.eliminar_aviso')


@endsection

@section('scripts')
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
@endsection
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
									<h2>Exámenes</h2>
									<p>Lista de todos los exámenes registradas en el sistema</p>
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
                        @if(buscar_p('Examenes','Registrar')=="Si" && buscar_p('Examenes','Listado')=="Si")
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
							<div class="breadcomb-report">
								<button id="examen" value="0" data-toggle="modal" data-target="#nuevoExamen" class="btn btn-default" data-backdrop="static" data-keyboard="false">Nuevo Exámen</button>
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
        @if((buscar_p('Examenes','Listado')=="Si"))
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
                                    <th>Exámen</th>
                                    <th>Descripción</th>
                                    <th>Status</th>
                                    <th style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $num=0;?>
                            	@foreach($examenes as $item )
                                    <tr>
                                        
    	                           		<td>{{$num=$num+1}}</td>
    	                           		<td>{{$item->examen}}</td>
    	                           		<td>{{$item->descripcion}}</td>
    	                           		<td>
                                            @if($item->status == "Activo")
                                                <strong style="color: green;">Activo</strong>
                                            @else
                                                <strong style="color: red;">Inactivo</strong>
                                            @endif
                                        </td>
    	                           		<td>
                                            {!! Form::open(['route' => ['examenes.update',$item->id], 'method' => 'PUT', 'name' => 'modificar_examen', 'id' => 'modificar_gerencia', 'data-parsley-validate']) !!}
                                                @include('examenes.modales.editar')
                                            {!! Form::close() !!}
                                            @if(buscar_p('Examenes','Editar')=="Si")
    	                           			<button id="EditarExamen" data-toggle="modal" data-target="#editarExamen" class="btn btn-warning" data-backdrop="static" data-keyboard="false" onclick="editar('{{$item->id}}','{{$item->examen}}','{{$item->descripcion}}','{{$item->status}}')"> Editar</button>
                                            @endif

    	                           			<!-- <button id="EliminarExamen" data-toggle="modal" data-target="#eliminarExamen" class="btn btn-danger" data-backdrop="static" data-keyboard="false"> Eliminar</button> -->
    	                           		</td>
                                    </tr>
	                           	@endforeach()
                            </tbody>
                        </table>
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
<!-- Data Table area End-->
@endsection

<!-- @include('examenes.modales.eliminar') -->
{!! Form::open(['route' => ['examenes.store'],'method' => 'post']) !!}
    @include('examenes.modales.crear')
{!! Form::close() !!}

@section('scripts')
    <script type="text/javascript">
        function editar(id,examen,descripcion,status) {
            $('#id').val(id);
            $('#e_examen').val(examen);
            $('#e_descripcion').val(descripcion);
            $('#e_status').val(status);
        }
    </script>
@endsection
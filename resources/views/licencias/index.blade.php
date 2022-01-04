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
									<h2>Licencias</h2>
									<p>Lista de todos los licencias registradas en el sistema</p>
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
                        @if(buscar_p('Licencias','Registrar')=="Si" && buscar_p('Licencias','Listado')=="Si")
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
							<div class="breadcomb-report">
								<button id="licencia" value="0" data-toggle="modal" data-target="#nuevaLicencia" class="btn btn-default" data-backdrop="static" data-keyboard="false">Nueva licencia</button>
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
        @if((buscar_p('Licencias','Listado')=="Si"))
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
                                    <th>Licencia</th>
                                    <th>Status</th>
                                    <th style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $num=0;?>
                            	@foreach($licencias as $item)
                            		<tr>
                            			
		                           		<td>{{$num=$num+1}}</td>
		                           		<td>{{$item->licencia}}</td>
		                           		<td>
		                           			@if($item->status == "Activo")
		                           				<strong style="color: green;">Activo</strong>
		                           			@else
		                           				<strong style="color: red;">Inactivo</strong>
		                           			@endif
		                           		</td>
		                           		<td>
                                            {!! Form::open(['route' => ['licencias.update',$item->id], 'method' => 'PUT', 'name' => 'modificar_gerencia', 'id' => 'modificar_gerencia', 'data-parsley-validate']) !!}
                                                @include('licencias.modales.editar')
                                            {!! Form::close() !!}
                                            @if((buscar_p('Licencias','Editar')=="Si"))
		                           			<button id="EditarLicencia" data-toggle="modal" data-target="#editarLicencia" class="btn btn-warning" data-backdrop="static" data-keyboard="false" onclick="editar('{{$item->id}}','{{$item->licencia}}','{{$item->status}}')"> Editar</button>
                                            @endif

		                           			<!-- <button id="EliminarLicencia" data-toggle="modal" data-target="#eliminarLicencia" class="btn btn-danger" data-backdrop="static" data-keyboard="false"> Eliminar</button> -->
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

<!-- @include('licencias.modales.eliminar') -->
{!! Form::open(['route' => ['licencias.store'],'method' => 'post']) !!}
    @include('licencias.modales.crear')
{!! Form::close() !!}

@section('scripts')
    <script type="text/javascript">
        function editar(id,licencia,status) {
            $('#id').val(id);
            $('#e_licencia').val(licencia);
            $('#e_status').val(status);
        }
    </script>
@endsection
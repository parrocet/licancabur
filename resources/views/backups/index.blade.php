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
									<h2>Respaldo</h2>
									<p>Respaldos registrados en el sistema</p>
								</div>
							</div>
						</div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <strong style="float: right; margin-top: 10px;">Año laboral actual: {{-- {{ config('session.fecha_actual') }} --}} 
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
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div style="float: right;">
								<a href="{{ route('backup') }}" id="backup" class="btn btn-default" >Respaldar BD</a>
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
                                    <!-- <th>#</th> -->
                                    <th>Respaldo</th>
                                    <th style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $num=0;?>
                            	@foreach($nombres as $key)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>
                                            <button value="0" data-toggle="modal" data-target="#modalRespaldo" class="btn btn-warning pull-right" data-backdrop="static" data-keyboard="false" onclick="respaldar('{{$key}}')">
                                                <i class="fa fa-file-zip-o"></i> Descargar .zip
                                            </button>
                                            <br><br>
                                            <button id="curso" value="0" data-toggle="modal" data-target="#EliminarBackup" class="btn btn-danger pull-right" data-backdrop="static" data-keyboard="false" onclick="eliminar('{{$key}}')">
                                                <i class="fa fa-trash" ></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Data Table area End-->

{!! Form::open(['route' => 'respaldo.eliminar', 'method' => 'post']) !!}
    @csrf
    <div class="modal fade" id="EliminarBackup" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h2>¿Esta seguro que desea eliminar el respaldo seleccionado?</h2>
                    <p>Esta acción no se podra deshacer en el futuro.</p>
                
                    <div class="modal-footer">
                        <input type="hidden" name="nombre_backup" id="nombre_backup">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}

{!! Form::open(['route' => 'respaldo.descargar', 'method' => 'post']) !!}
    @csrf
    <div class="modal fade" id="modalRespaldo" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h2>¿Está seguro que desea descargar el archivo de respaldo?</h2>
                    
                    <div class="modal-footer">
                        <input type="hidden" name="nombre_backup" id="nombre_backup2">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" onclick="CerrarModal();"class="btn btn-warning"><i class="fa fa-file-zip-o"></i>Descargar en .zip</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}

@endsection



@section('scripts')
    <script type="text/javascript">
        function eliminar(id) {
            // $('#EliminarBackup').modal('show');
            $('#nombre_backup').val(id);
        }
        function respaldar(id) {
            // $('#modalRespaldo').modal('show');
            $('#nombre_backup2').val(id);
        }
        function CerrarModal() {
            $('#modalRespaldo').modal('hide');
        }
    </script>
@endsection
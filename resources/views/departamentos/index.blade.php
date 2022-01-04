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
										<h2>Departamentos</h2>
										<p>Lista de todos los departamentos registrados en el sistema</p>
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
                            @if(buscar_p('Departamentos','Registrar')=="Si" && buscar_p('Departamentos','Listado')=="Si")
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									<a href="{{ route('departamentos.create') }}" data-toggle="tooltip" data-placement="left" title="Registrar un nuevo departamento" class="btn"><i class="lni-user"></i> Registrar departamentos</a>
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
        @if((buscar_p('Departamentos','Listado')=="Si"))
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
                                    <th>Departamento</th>
                                    <th style="text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $contador=1; @endphp
                            @foreach($departamentos as $item )
                                <tr>
                                    <td>{{ $contador++ }}</td>
                                    <td>{{ $item->departamento }}</td>
                                    <td align="center">
                                        @if(buscar_p('Departamentos','Editar')=="Si")
                                        <a href="{{ route('departamentos.edit', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Editar datos de departamento">
                                            <i class="fa fa-pencil pr-3" style="font-size:20px"></i>
                                        </a>
                                        @endif
                                        @if(buscar_p('Departamentos','Eliminar')=="Si")
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Eliminar departamento"  onclick="eliminar('{{ $item->id }}')" id="eliminar_departamento">
                                            <i class="fa fa-trash" style="font-size:20px" data-toggle="modal" data-target="#eliminar_departamento"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach    
                            @include('departamentos.modales.eliminar')
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
@section('scripts')
<script type="text/javascript">
    function ModalTwo(){
        $('#eliminar_departamento').modal('hide');
        $('#eliminar_departamento').on('hidden', function () {
            $('#claverrot').modal('show')
        });
    }
</script>
<script>
function eliminar(id_departamento) {
    $("#id_departamento_eliminar").val(id_departamento);
}
</script>
@endsection
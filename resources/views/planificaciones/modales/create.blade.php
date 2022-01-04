{!! Form::open(['route' => ['planificaciones.store'],'method' => 'post']) !!}
	<div class="modal fade" id="nuevaPlanificacion" role="dialog">
	    <div class="modal-dialog modal-lg">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal">&times;</button>
	                <h2>Nueva Planificación</h2><br>
	                <p>Todos los campos con (<b style="color: red;">*</b>) son requeridos.</p>
	            </div>
	            <div class="modal-body">
	            	<div class="row justify-content-center">
	            		<div class="col-md-4">
			            	<div class="form-group">
			            		<label id="curso">Elaborado por: <b style="color: red;">*</b></label>
			            		<select name="elaborado" class="form-control select2" required style="width: 100% !important;">
			            			@foreach($usuarios as $key)
			            				<option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}}</option>
			            			@endforeach()
			            		</select>
			            	</div>
			            </div>
			            <div class="col-md-4">
			            	<div class="form-group">
			            		<label id="curso">Aprobado por: <b style="color: red;">*</b></label>
			            		<select name="aprobado" class="form-control select2" required style="width: 100% !important;">
			            			@foreach($usuarios as $key)
			            				<option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}}</option>
			            			@endforeach()
			            		</select>
			            	</div>
			            </div>
			            <div class="col-md-4">
			            	<div class="form-group">
			            		<label id="curso">Num. de contrato <b style="color: red;">*</b></label>
			            		<input type="number" name="num_contrato" required="required" class="form-control" placeholder="Número de contrato">
			            	</div>
			            </div>
	            	</div>
	            	<hr>
	            	<div class="row text-center">
	            		<div class="col-md-12">
	            			<div class="form-group">
	            				<input type="checkbox" name="anio_all" id="anio_all" value="1">
                                <label for="anio_all">Registrar planificación para todo el año {{ $anio }}</label>
	            			</div>
	            		</div>
	            	</div>
	            	<div class="row justify-content-center" id="ocultarFechas">
	            		<h4 align="center">Fechas</h4>
	            		<div class="col-md-6">
		            		<div class="form-group">
		            			<label id="desde">Desde <b style="color: red;">*</b></label>
		            			<input type="text" id="datepicker" name="desde" required="" class="form-control desde" keyup="calcularFecha()" autocomplete="off">
		            			<input type="hidden" value="{{ $anio }}" name="anio" id="anio">
	            			</div>
	            		</div>
	            		<div class="col-md-6">
	            			<div class="form-group">
		            			<label id="hasta">Hasta <b style="color: red;">*</b></label>
		            			<input type="text" name="hasta" required="required" class="form-control hasta" id="datepicker" disabled>
		            			<input type="hidden" name="hasta1" required="required" class="form-control hasta1" id="datepicker" readonly="readonly">
	            			</div>
	            		</div>
	            	</div>
	            	<hr>
	            	<div class="row justify-content-center">
	            		<div class="col-md-6">
			            	<div class="form-group">
			            		<label id="revision">Revisión <b style="color: red;">*</b></label>
			            		<select name="revision" class="form-control select2" style="width: 100% !important;" required>
			            			<option value="A">A</option>
			            			<option value="B">B</option>
			            			<option value="C">C</option>
			            			<option value="D">D</option>
			            		</select>
			            	</div>
	            		</div>
	            		<div class="col-md-6">
			            	<div class="form-group">
			            		<label id="curso">Gerencia <b style="color: red;">*</b></label>
			            		<select name="id_gerencia[]" class="form-control select2" required style="width: 100% !important;" multiple="multiple">
			            			@foreach($gerencias as $key)
			            				<option value="{{$key->id}}">{{$key->gerencia}}</option>
			            			@endforeach()
			            		</select>
			            	</div>
	            		</div>
	            	</div>
	            	<!-- <div class="form-group">
	            		<label id="semana">Semana <b style="color: red;">*</b></label>
	            		<input type="text" name="semana" id="" required="required" class="form-control" placeholder="Semana de la planificación">
	            	</div> -->
	            </div>
	            <div class="modal-footer">
	            	<button type="submit" class="btn btn-danger">Registrar</button>
	            </div>
	        </div>
	    </div>
	</div>
{!! Form::close() !!}
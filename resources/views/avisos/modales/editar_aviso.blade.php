<div class="form-group">
	<div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
		<label>Seleccione al empleado</label>
		<select class="form-control" required="" multiple="multiple" id="id_empleado" name="id_empleado[]" title="Seleccione al empleado">
			@foreach($empleados as $key)
				@foreach($users as $key2)
					@if($key->id_usuario == $key2->id)
						<option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}} .- {{$key->rut}}</option>
					@endif()
				@endforeach()
			@endforeach()
		</select>
	</div>
</div>
<hr>
<div class="form-group">
	<label>Motivo del mensaje</label>
	<input type="text" class="form-control" name="motivo" placeholder="Motivo del aviso" title="Motivo del aviso">
</div>
<hr>
<div class="form-group">
	<label>Mensaje</label>
	<textarea name="mensaje" class="form-control" placeholder="Mensaje" title="Transcriba el mensaje del avisa"></textarea>
</div>
<hr>
<div class="form-group">
	<label>Dias previos del aviso</label>
	<input type="number" class="form-control" name="dias_previos" placeholder="Días del aviso" title="Días previos al aviso">
</div>
<div class="form-group">
	<label>Días del post</label>
	<input type="number" class="form-control" name="dias_post" placeholder="Día del aviso" title="Dias del aviso">
</div>
<div class="form-group">
	<label>Escoja modalidad</label>
	<select class="form-control" name="modalidad" title="Seleccione la modalidad del mensaje">
		<option value="Automático">Automático</option>
		<option value="Manual">Manual</option>
		<option value="Ambos">Ambos</option>
	</select>
</div>

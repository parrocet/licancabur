{!! Form::open(['route' => ['planificaciones.destroy',1033], 'method' => 'DELETE']) !!}
    @csrf
	<div class="modal fade" id="eliminarPlanificacion" role="dialog">
	    <div class="modal-dialog modal-sm">
	        <div class="modal-content">
            <div class="modal-header">
                <h2>¡ATENCIÓN!</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <hr>
            </div>
            <div class="modal-body">
            	<p><strong>Está a punto de eliminar esta planificación! Esta acción no se podrá deshacer. ¿Está seguro?</p>
            		<span>Nota: No se podrá eliminar si hay actividades registradas</span>
                <hr>
            </div>
            <div class="modal-footer">
            	<input type="hidden" name="id" id="id_planificacion_eli">
            	<button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
	    </div>
	</div>
{!! Form::close() !!}
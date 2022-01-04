<div class="modal fade" id="cerrar_modal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <h2>¿Esta seguro que desea cerrar el modal de <span id="accion2"></span> de actividad?</h2>
                <p>No se ha guardado los datos de <span id="accion3"></span>, esta acción no se podra deshacer en el futuro.</p>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#claveroot">Eliminar</button> -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Regresar</button>
                <a href="{{ url('planificacion') }}" class="btn btn-danger" >Cerrar modal de <span id="accion4"></span></a>
            </div>
        </div>
    </div>
</div>


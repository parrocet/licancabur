<div class="modal fade" id="cerrar_modal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <h2>¿Esta seguro que desea cerrar el modal de registro de usuario?</h2>
                <p>No se ha guardado los datos de registro, esta acción no se podra deshacer en el futuro.</p>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#claveroot">Eliminar</button> -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Regresar</button>
                <a href="{{ url('empleados') }}" class="btn btn-danger" >Cerrar modal de registro</a>
            </div>
        </div>
    </div>
</div>
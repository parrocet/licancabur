<div class="modal fade" id="myModaltre" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h2>¿Esta seguro que desea eliminar las asignaciones de las actividades seleccionadas?</h2>
                <p>Esta acción no se podra deshacer en el futuro.</p>
            
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#claveroot">Eliminar</button> -->
                    <input type="hidden" name="id_actividad_eliminar" id="id_actividad_eliminar">
                    <input type="hidden" name="id_empleado_act_eliminar" id="id_empleado_act_eliminar">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-default" data-toggle="modal"onclick="eliminar()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>

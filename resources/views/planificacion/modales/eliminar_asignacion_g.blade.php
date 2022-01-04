<div class="modal fade" id="myModaltre2" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h2>¿Esta seguro que desea eliminar TODAS las asignaciónes de forma global?</h2>
                <p>Esta acción no se podra deshacer en el futuro.</p>
            
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#claveroot">Eliminar</button> -->
                    <input type="hidden" name="id_planificacion_g" id="id_planificacion_g">
                    <input type="hidden" name="id_empleado_g" id="id_empleado_g">
                    <input type="hidden" name="id_area_g" id="id_area_g">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-default" data-toggle="modal"onclick="eliminar_asignaciones_g()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</div>
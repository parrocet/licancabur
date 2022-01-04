<div class="modal fade" id="ModalGlobal2" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h2>ATENCIÓN! Está a punto de eliminar las actividades seleccionadas!</h2>
                <p>Esta acción no se podra deshacer en el futuro.</p>
                
                @if(\Auth::user()->tipo_user!="Admin")
                    <div class="form-group">
                        <label class="text-danger">Ingrese su contraseña de usuario *</label>
                        <input type="password" name="contraseña_conf" class="form-control" id="contraseña_confir2-2" onkeyup="VerificaContraseña(2,this.value)" required value="" placeholder="Contraseña">
                        <span class="contraseña_incorrecta"></span>
                    </div>
                @endif

                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#claveroot">Eliminar</button> -->
                    <input type="hidden" name="id_actividad_eliminar" id="id_actividad_eliminar">
                    <input type="hidden" name="id_empleado_act_eliminar" id="id_empleado_act_eliminar">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    @if(\Auth::user()->tipo_user!="Admin")
                        <button type="submit" class="btn btn-default" id="botonEliminarE" disabled data-toggle="modal">Eliminar</button>
                    @else
                        <button type="submit" class="btn btn-default" id="botonEliminarE" data-toggle="modal">Eliminar</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

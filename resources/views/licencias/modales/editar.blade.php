<div class="modal fade" id="editarLicencia" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Editar Licencia</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <hr>
            </div>
            <div class="modal-body">
            	<div class="form-group">
            		<label id="licencia">Licencia <b style="color: red;">*</b></label>
            		<input type="text" id="e_licencia" name="licencia" required="required" class="form-control" placeholder="Nombre de la licencia">
            	</div>
                <div class="form-group">
                    <label id="status">Status <b style="color: red;">*</b></label>
                    <select id="e_status" name="status" class="form-control" required="required" title="Status de la licencia" placeholder="Status de la licencia">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>

                    </select>
                </div>
            </div>
            <input type="hidden" name="id" id="id"></ins>
            <div class="modal-footer">
            	<button type="submit" class="btn btn-danger">Editar</button>
            </div>
        </div>
    </div>
</div>
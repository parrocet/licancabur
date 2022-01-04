<div class="modal fade" id="nuevoExamen" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Nuevo Exámen</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <hr>
            </div>
            <div class="modal-body">
            	<div class="form-group">
            		<label id="examen">Exámen <b style="color: red;">*</b></label>
            		<input type="text" name="examen" required="required" class="form-control" placeholder="Nombre del exámen">
            	</div>
            	<div class="form-group">
            		<label id="descripcion">Descripción</label>
            		<input type="text" name="descripcion" required="required" class="form-control" placeholder="Descripción del exámen">
            	</div>
            </div>
            <div class="modal-footer">
            	<button type="submit" class="btn btn-danger">Registrar</button>
            </div>
        </div>
    </div>
</div>
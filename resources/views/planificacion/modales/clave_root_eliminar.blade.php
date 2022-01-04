<div class="modal fade" id="claverrot" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => ['actividades.destroy',1033], 'method' => 'DELETE']) !!}
                    <input type="hidden" name="id_producto" id="id_producto" >
                    <div class="row form-group">
                        <div class="col-12 col-md-9">
                            <label for="text-input" class=" form-control-label"> <b style="color:red;">*</b> Contraseña de Administrador</label>
                           <input type="password" id="clave" name="clave" class="form-control" required="required">
                            <small class="form-text text-muted">Escribe la contraseña e administrador para validar la eliminación</small>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="id_actividad_eliminar" id="id_actividad_eliminar">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
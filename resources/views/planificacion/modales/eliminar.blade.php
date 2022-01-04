<div class="modal fade" id="myModaltwo" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            @if(\Auth::user()->tipo_user!="Admin")
                <div class="modal-body">
                    <h2>¿Esta seguro que desea eliminar esta actividad?</h2>
                    <p>Esta acción no se podrá deshacer en el futuro.</p>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#claveroot">Eliminar</button> -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#claverrot" onclick="ModalTwo()">Eliminar</button>
                </div>
            @else
                <div class="modal-body">
                    {!! Form::open(['route' => ['actividades.destroy',1033], 'method' => 'DELETE']) !!}
                        <h2>¿Esta seguro que desea eliminar esta actividad?</h2>
                        <p>Esta acción no se podrá deshacer en el futuro.</p>

                        <div class="modal-footer">
                            <input type="hidden" name="id_producto" id="id_producto" >
                            <input type="hidden" name="id_actividad_eliminar" id="id_actividad_eliminar">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            @endif
        </div>
    </div>
</div>


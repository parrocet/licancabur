<div class="modal fade" id="asignar_tarea" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="Cargando_asigna" style="display: none;">
                <center>
                    <div id="mensaje_asigna"></div>
                    <img src="{{ asset('assets/img/tenor2.gif') }}" alt="Logo" height="40px" width="100px;" title="Cargando" />
                </center>
                <hr>
            </div>
            <div id="vista_asigna" style="display: none;">
                <div class="modal-body">
                    <h2>Asignar tarea:</h2><br>
                    <h1><span id="tarea"></span></h1>
                    <br>
                    {!! Form::open(['route' => 'actividades.asignar','method' => 'post','enctype' => 'Multipart/form-data']) !!}
                    <h2>Empleados:</h2>
                    <div class="row">
                        <div class="form-group">
                            <select class="form-control" id="id_empleado" name="id_empleado">
                            </select>
                        </div>
                        <input type="hidden" name="id_actividad_asig" id="id_actividad_asig">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default">Guardar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
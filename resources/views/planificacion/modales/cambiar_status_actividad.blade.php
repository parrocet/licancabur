
<div class="modal fade" id="myModaltwoFinal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <form action="{{ route('finalizar_actividad') }}" method="GET" name="registrar_gerencia" data-parsley-validate>
                <div class="modal-body">

                    <h2>Cambiar de status a la Actividad</h2>
                    <!-- <p>¿Estas seguro que desea cambiar de status a la actividad?.</p> -->
                    <p style="color: green;">Se puede guardar los datos ingresados sin terminar la actividad</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status"><b>Status</b> <b style="color: red;">*</b></label>
                                <input type="hidden" id="id_actividad_f" name="id_actividad_f">
                                <select name="status" class="form-control" required="required">
                                    <option value="1">No Finalizada</option>
                                    <option value="0">Finalizada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status">
                                    <b>Duración Real</b>
                                    <!-- <b style="color: red;">*</b> -->
                                </label>
                                <input type="number" name="duracion_real" id="duracion_real_f" class="form-control" title="ingrese la Duración Real">
                                <br>
                                La duración promedio: <strong><span id="duracion_promedio"></span></strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status">
                                    <b>Comentario:</b>
                                    <b style="color: red;">*</b>
                                </label>
                                <input type="text" name="comentario" id="comentario_f" class="form-control" title="ingrese la Duración Real" maxlength="500" required="required">
                                
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p>Especifique el departamento que pertenece a la actividad</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="status"><b>Departamentos:</b> <b style="color: red;">*</b></label>
                                <select id="id_departamento_s" name="id_departamento_s" class="form-control select2" placeholder="Seleccione el departamento de la actividad" required="required">
                                    @foreach($departamentos as $key)
                                        <option value="{{$key->id}}">{{$key->departamento}}</option>
                                    @endforeach()
                                </select>
                                
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <!-- <p>Se puede guardar los datos ingresados sin terminar la actividad</p>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success" value="2" style="width: 100%;">Guardar sin terminar</button>
                    </div>
                </div> -->
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-default" style="width: 100%;">Cambiar status</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-default" data-dismiss="modal" style="width: 100%;">Cerrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

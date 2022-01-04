<!-- Start modal actividades -->
<div class="modal fade" id="modalActividades2" role="dialog">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-body">
                    <h1 id="task2"></h1>
                    <div class="row" style="background: #B3E5FC;">
                        <div class="col-md-12">
                            <div class="col-md-3 mt-3 mb-3">
                                <b>Día:</b> <span id="dia2"></span>
                            </div>
                            <div class="col-md-3 mt-3 mb-3">
                                <b>Realizada:</b> <span id="realizada2"></span>
                            </div>
                            <div class="col-md-3 mt-3 mb-3">
                                <b>Cant. de persona:</b> <span id="cant_personas2"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="background: #B3E5FC;">
                        <div class="col-md-12">
                            <div class="col-md-3 mt-3 mb-3">
                                <b>Semana:</b> <span id="semana2"></span>
                            </div>
                            <div class="col-md-3 mt-3 mb-3">
                                <b>Área:</b> <span id="area12"></span>
                            </div>
                            <div class="col-md-6 mt-3 mb-3">
                                <b>Fechas:</b> <span id="fechas2"></span>
                            </div>
                        </div>
                    </div>
                    <small>En la lista de: <b id="nombres"></b> <b id="apellidos"></b></small>
                    <div class="row">
                        <div class="col-md-7">
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <b>Vencimiento:</b> <span id="vencimiento2"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span id="descripcion11"><b>Descripción:</b></span> <span id="descripcion2"> </span> <br>
                                    <b>Duración aproximada:</b> <span id="duracion_pro2"></span> <br>
                                    <b>Duración real:</b> <span id="duracion_real2"></span> <br>
                                    <b>Tipo:</b> <span id="tipo2"></span> <br>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <b>
                                        <p>Comentarios realizados:</p>
                                    </b>
                                </div>
                                <div class="col-md-12">
                                    <table border="0px" width="100%" style="background: #F6F8FA;" id="comentarios2">
                                        
                                    </table>
                                </div>
                            </div><hr>
                        </div>
                        
                        <div class="col-md-5" style="margin-top: -20px">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-heading" role="tab">
                                        <h4 class="panel-title"> Archivos adjuntos:</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-heading" style="background: #F6F8FA;" role="tab">
                                        <span class="panel-title">
                                            <ol id="mis_archivos" class="lista">
                                                {{-- <li>No hay Archivos</li> --}}
                                            </ol>
                                            <ul class="lista" id="mis_archivos_cargados2">
                                                {{-- <li>1 <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></li> --}}
                                            </ul>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-heading" role="tab">
                                        <h4 class="panel-title"> Imagenes adjuntos:</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-heading" style="background: #F6F8FA;" role="tab">
                                        <span class="panel-title">
                                            <ol id="mis_imagenes" class="lista">
                                                {{-- <li>No hay imagenes</li> --}}
                                            </ol>
                                            <ul class="lista" id="mis_imagenes_cargadas2">
                                                {{-- <li>1 <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></li> --}}
                                            </ul>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-stn col-5">
                                <div class="panel-group" data-collapse-color="nk-green" id="accordionGreen"
                                    role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-collapse notika-accrodion-cus">
                                        <div class="panel-heading" role="tab">
                                            <h4 class="panel-title">
                                                Observaciones/comentarios
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="panel panel-collapse notika-accrodion-cus">
                                        <div class="panel-heading" style="background: #F6F8FA" role="tab">
                                            <p class="panel-title">
                                                <a class="collapsed" data-toggle="collapse"
                                                    data-parent="#accordionGreen" href="#accordionGreen-three"
                                                    aria-expanded="false">
                                                    <i class="lni-move"></i> <span id="observacion22"></span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
                <div class="modal-footer mt-4">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- End modal view -->

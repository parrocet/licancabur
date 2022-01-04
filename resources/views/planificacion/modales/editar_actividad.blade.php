<!-- Start modal -->

<div class="modal fade" id="crear_actividad" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- <button type="button" class="close" data-toggle="modal" data-target="#cerrar_modal">&times;</button> -->
            </div>
            <div class="modal-body">
                <div class="wizard-wrap-int">
                    <div class="wizard-hd">
                        <h1 class="text-center"><span id="accion"></span> Actividad</h1>asdasd
                        <div class="text-center">
                            <small class="text-center">Los campos con un (<span style="color:red">*</span>) son
                                obligatorios</small>

                        </div>

                    </div>
                    <div id="rootwizard">
                        <div class="navbar">
                            <div class="navbar-inner">
                                <div class="container-pro wizard-cts-st">
                                    <ul>
                                        <li><a href="#tab1" data-toggle="tab">Tipo</a></li>
                                        <li id="des_actividad"><a href="#tab2" data-toggle="tab">Descripción de Actividad</a></li>
                                        <!-- <li><a href="#tab3" data-toggle="tab">Horario</a></li> -->
                                        <li><a href="#tab4" data-toggle="tab">Archivos</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {!! Form::open(['route' => 'actividades.store', 'method' => 'post','enctype' => 'Multipart/form-data', 'data-parsley-validate']) !!}
                        <div class="tab-content">
                            <div class="tab-pane wizard-ctn" id="tab1">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                <label> <b> Tipo: </b></label>
                                                <select name="tipo" id="tipo1" class="form-control" required="required">
                                                    <option value="PM03">Seleccione tipo de actividad</option>
                                                    @if(buscar_p('Actividades - PM01','General')=="Si")
                                                        <option value="PM01">PM01</option>
                                                    @endif
                                                    @if(buscar_p('Actividades - PM02','General')=="Si")
                                                        <option value="PM02">PM02</option>
                                                    @endif
                                                    @if(buscar_p('Actividades','Registro de PM03')=="Si")
                                                    <option value="PM03">PM03</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="pm02" style="display: none">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                    <label> <b> Actividades: </b></label>
                                                    <select name="id_actividad" id="id_actividad" class="form-control" required="required">
                                                        <option value="0" class="reg_act">Registrar nueva</option>
                                                        @foreach($actividades as $key)
                                                        <option value="{{$key->id}}">{{$key->task}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="display: block;" id="otros">
                                    <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                <label> <b> Avances del turno y pendientes: </b></label>
                                                <input type="text" name="observacion1" id="observacion1" class="form-control" placeholder="Avances del turno y pendientes">
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-12 col-md-12 col-sm-12" id="areas">
                                        <div class="form-group">
                                            <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                <label> <b> Áreas: </b></label>
                                                <select name="id_area" id="id_area" class="form-control" required="required">
                                                    <option value="#">Selecciones un área</option>
                                                    @foreach($areas as $key)
                                                    <option value="{{ $key->id }}">{{ $key->area }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12" id="departamentos" style="display: none">
                                        <div class="form-group">
                                            <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                <label for="id_departamento"><b> Departamento: </b></label>
                                                <select name="id_departamento" id="id_departamento" required="required">
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group" id="muestra_create">
                                            <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                <label> <b> Planificación: </b> <b style="color: red;">*</b></label>
                                                    <select name="id_planificacion[]" id="id_planificacion" class="form-control" required="required" multiple="multiple">
                                                        
                                                        @foreach($planificacion as $key)
                                                            <option value="{{ $key->id }}">Semana: {{ $key->semana }} - ({{ $key->fechas }}) - Gerencia: {{$key->gerencias->gerencia}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="muestra_edit" style="display: none;">
                                            <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                <label> <b> Planificación: </b> <b style="color: red;">*</b></label>
                                                <select name="id_planificacion_edit[]" class="select2" id="id_planificacion2" required="required">
                                                        @foreach($planificaciones as $key)
                                                            <option value="{{ $key->id }}">Semana: {{ $key->semana }} - ({{ $key->fechas }}) - Gerencia: {{$key->gerencias->gerencia}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane wizard-ctn" id="tab2">
                                @if(\Auth::User()->tipo_user!="Empleado")
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                            <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                <label>Task: <span style="color:red">*</span></label>
                                                <input type="text" name="task" id="task1" class="form-control" placeholder="Task" required="required">
                                            </div>
                                            </div>
                                        </div>

                                        <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group">
                                            <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                <label>Descripción: </label>
                                                <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="descripcion">
                                            </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="row">

                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                    <label> <b> Duración proyectada: </b>
                                                    </label>
                                                    <input  @if(\Auth::user()->tipo_user=="Empleado") type="hidden" value="0" @else type="number" @endif class="form-control" name="duracion_pro" id="duracion_pro" placeholder="Duración proyectada">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                    <label> <b> Cantidad de personas: </b><span style="color:red">*</span>
                                                    </label>
                                                    <input type="number" name="cant_personas" id="cant_personas1" class="form-control" placeholder="Cantidad de personas" required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                    <label> <b> Duración real: </b></label>
                                                    <input type="number" name="duracion_real" id="duracion_real" class="form-control" placeholder="Duración real">
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                    <label> <b> Observaciones/Comentarios: </b></label>
                                                    <input type="text" name="observacion2" id="observacion2" class="form-control" placeholder="Avances del turno y pendientes">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="data_1">
                                            <div class="form-group">
                                                <h5 style="text-align: center;" class="mb-3">Día de la actividad</h5>
                                                <div class="fm-checkbox form-elet-mg">
                                                    <!-- <div class="form-group text-center">
                                                        <input type="checkbox" name="dia[]" id="mie" value="Mié" class="i-checks" checked="true">
                                                        <label for="mie">Miércoles</label>
                                                        
                                                        <input type="checkbox" name="dia[]" id="jue" value="Jue" class="i-checks">
                                                        <label for="jue">jueves</label>
                                                    
                                                        <input type="checkbox" name="dia[]" id="vie" value="Vie" class="i-checks">
                                                        <label for="vie">Viernes</label>
                                                    
                                                        <input type="checkbox" name="dia[]" id="sab" value="Sáb" class="i-checks">
                                                        <label for="sab">Sábado</label>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <input type="checkbox" name="dia[]" id="dom" value="Dom" class="i-checks">
                                                        <label for="dom">Domingo</label>
                                                    
                                                        <input type="checkbox" name="dia[]" id="lun" value="Lun" class="i-checks">
                                                        <label for="lun">Lunes</label>
                                                    
                                                        <input type="checkbox" name="dia[]" id="mar" value="Mar" class="i-checks">
                                                        <label for="mar">Martes</label>
                                                    </div> -->
                                                    <div class="area_check" id="area_check">
                                                        <div class="miercoles">
                                                            <p>
                                                                <input type="checkbox" id="mie" name="dia[]" value="Mié" checked>
                                                                <label for="mie"><span></span>  Miércoles</label>
                                                            </p>
                                                        </div>
                                                        <div class="jueves">
                                                            <p>
                                                                <input type="checkbox" id="jue" name="dia[]" value="Jue">
                                                                <label for="jue"><span></span>  Jueves</label>
                                                            </p>
                                                        </div>
                                                        <div class="viernes">
                                                            <p>
                                                                <input type="checkbox" id="vie" name="dia[]" value="Vie">
                                                                <label for="vie"><span></span>  Viernes</label>
                                                            </p>
                                                            <p>
                                                        </div>
                                                        <div class="sabado">
                                                            <p>
                                                                <input type="checkbox" id="sab" name="dia[]"  value="Sáb">
                                                                <label for="sab"><span></span>   Sábado</label>
                                                            </p>
                                                        </div>
                                                        <div class="domingo">
                                                            <p>
                                                                <input type="checkbox" id="dom" name="dia[]"  value="Dom">
                                                                <label for="dom"><span></span>   Domingo</label>
                                                            </p>
                                                        </div>
                                                        <div class="lunes">
                                                            <p>
                                                                <input type="checkbox" id="lun" name="dia[]"  value="Lun">
                                                                <label for="lun"><span></span>   Lunes</label>
                                                            </p>
                                                        </div>
                                                        <div class="martes">
                                                            <p>
                                                                <input type="checkbox" id="mar" name="dia[]"  value="Mar">
                                                                <label for="mar"><span></span>   Martes</label>
                                                            </p>  
                                                        </div>
                                                    </div>
                                                    <div class="area_radio" id="area_radio">
                                                        <div class="demo">
                                                            <p>
                                                                <input type="radio" id="miercoles_r" name="dia" value="Mié">
                                                                <label for="miercoles_r"><span></span>Miércoles</label>
                                                            </p>
                                                            <p>
                                                                <input type="radio" id="jueves_r" name="dia" value="Jue">
                                                                <label for="jueves_r"><span></span>Jueves</label>
                                                            </p>
                                                        
                                                            <p>
                                                                <input type="radio" id="viernes_r" name="dia" value="Vie">
                                                                <label for="viernes_r"><span></span>Viernes</label>
                                                            </p>
                                                            <p>
                                                                <input type="radio" id="sabado_r" name="dia" value="Sáb">
                                                                <label for="sabado_r"><span></span>Sabado</label>
                                                            </p>
                                                            <p>
                                                                <input type="radio" id="domingo_r" name="dia" value="Dom">
                                                                <label for="domingo_r"><span></span>Domingo</label>
                                                            </p>
                                                            <p>
                                                                <input type="radio" id="lunes_r" name="dia" value="Lun">
                                                                <label for="lunes_r"><span></span>Lunes</label>
                                                            </p>
                                                            <p>
                                                                <input type="radio" id="martes_r" name="dia" value="Mar">
                                                                <label for="martes_r"><span></span>Martes</label>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                            <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                <label>Task: <span style="color:red">*</span></label>
                                                <input type="text" name="task" id="task1" class="form-control" placeholder="Task" required="required">
                                            </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                    <label> <b> Cantidad de personas: </b><span style="color:red">*</span>
                                                    </label>
                                                    <input type="number" name="cant_personas" id="cant_personas1" class="form-control" placeholder="Cantidad de personas" required="required">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                            <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                <label>Descripción: </label>
                                                <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="descripcion">
                                            </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                    <label> <b> Observaciones/Comentarios: </b></label>
                                                    <input type="text" name="observacion2" id="observacion2" class="form-control" placeholder="Avances del turno y pendientes">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="data_1">
                                            <div class="form-group">
                                                <h5 style="text-align: center;" class="mb-3">Día de la actividad</h5>
                                                <div class="fm-checkbox form-elet-mg">
                                                    <!-- <div class="form-group text-center">
                                                        <input type="checkbox" name="dia[]" id="mie" value="Mié" class="i-checks" checked="true">
                                                        <label for="mie">Miércoles</label>
                                                        
                                                        <input type="checkbox" name="dia[]" id="jue" value="Jue" class="i-checks">
                                                        <label for="jue">jueves</label>
                                                    
                                                        <input type="checkbox" name="dia[]" id="vie" value="Vie" class="i-checks">
                                                        <label for="vie">Viernes</label>
                                                    
                                                        <input type="checkbox" name="dia[]" id="sab" value="Sáb" class="i-checks">
                                                        <label for="sab">Sábado</label>
                                                    </div>
                                                    <div class="form-group text-center">
                                                        <input type="checkbox" name="dia[]" id="dom" value="Dom" class="i-checks">
                                                        <label for="dom">Domingo</label>
                                                    
                                                        <input type="checkbox" name="dia[]" id="lun" value="Lun" class="i-checks">
                                                        <label for="lun">Lunes</label>
                                                    
                                                        <input type="checkbox" name="dia[]" id="mar" value="Mar" class="i-checks">
                                                        <label for="mar">Martes</label>
                                                    </div> -->
                                                    <div class="area_check" id="area_check">
                                                        <div class="miercoles">
                                                            <p>
                                                                <input type="checkbox" id="mie" name="dia[]" value="Mié" checked>
                                                                <label for="mie"><span></span>  Miércoles</label>
                                                            </p>
                                                        </div>
                                                        <div class="jueves">
                                                            <p>
                                                                <input type="checkbox" id="jue" name="dia[]" value="Jue">
                                                                <label for="jue"><span></span>  Jueves</label>
                                                            </p>
                                                        </div>
                                                        <div class="viernes">
                                                            <p>
                                                                <input type="checkbox" id="vie" name="dia[]" value="Vie">
                                                                <label for="vie"><span></span>  Viernes</label>
                                                            </p>
                                                            <p>
                                                        </div>
                                                        <div class="sabado">
                                                            <p>
                                                                <input type="checkbox" id="sab" name="dia[]"  value="Sáb">
                                                                <label for="sab"><span></span>   Sábado</label>
                                                            </p>
                                                        </div>
                                                        <div class="domingo">
                                                            <p>
                                                                <input type="checkbox" id="dom" name="dia[]"  value="Dom">
                                                                <label for="dom"><span></span>   Domingo</label>
                                                            </p>
                                                        </div>
                                                        <div class="lunes">
                                                            <p>
                                                                <input type="checkbox" id="lun" name="dia[]"  value="Lun">
                                                                <label for="lun"><span></span>   Lunes</label>
                                                            </p>
                                                        </div>
                                                        <div class="martes">
                                                            <p>
                                                                <input type="checkbox" id="mar" name="dia[]"  value="Mar">
                                                                <label for="mar"><span></span>   Martes</label>
                                                            </p>  
                                                        </div>
                                                    </div>
                                                    <div class="area_radio" id="area_radio">
                                                        <div class="demo">
                                                            <p>
                                                                <input type="radio" id="miercoles_r" name="dia" value="Mié">
                                                                <label for="miercoles_r"><span></span>Miércoles</label>
                                                            </p>
                                                            <p>
                                                                <input type="radio" id="jueves_r" name="dia" value="Jue">
                                                                <label for="jueves_r"><span></span>Jueves</label>
                                                            </p>
                                                        
                                                            <p>
                                                                <input type="radio" id="viernes_r" name="dia" value="Vie">
                                                                <label for="viernes_r"><span></span>Viernes</label>
                                                            </p>
                                                            <p>
                                                                <input type="radio" id="sabado_r" name="dia" value="Sáb">
                                                                <label for="sabado_r"><span></span>Sabado</label>
                                                            </p>
                                                            <p>
                                                                <input type="radio" id="domingo_r" name="dia" value="Dom">
                                                                <label for="domingo_r"><span></span>Domingo</label>
                                                            </p>
                                                            <p>
                                                                <input type="radio" id="lunes_r" name="dia" value="Lun">
                                                                <label for="lunes_r"><span></span>Lunes</label>
                                                            </p>
                                                            <p>
                                                                <input type="radio" id="martes_r" name="dia" value="Mar">
                                                                <label for="martes_r"><span></span>Martes</label>
                                                            </p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                @endif()
                            </div>
                            
                            <div class="tab-pane wizard-ctn" id="tab4">

                                <!-- Dropzone area Start-->
                                <div class="dropzone-area">
                                    <div class="container">
                                        <div id="archivos_cargados" style="display: none;">
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                    <div class="dropdone-nk mg-t-30">
                                                    <div class="cmp-tb-hd">
                                                        <h2>Archivos de la Actividad</h2>
                                                        <ul id="mis_archivos">
                                                            
                                                        </ul>
                                                    </div>
                                                </div>    
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                <div class="dropdone-nk mg-t-30">
                                                    <div class="cmp-tb-hd">
                                                        <h2>Cargar archivos</h2>
                                                        <!-- <p>Realiza la carga de tantos archivos como quieras.</p> -->
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <input type="file" class="form-control" multiple="multiple" name="archivos[]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="imagenes_cargadas" style="display: none;">
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                    <div class="dropdone-nk mg-t-30">
                                                    <div class="cmp-tb-hd">
                                                        <h2>Imágenes de la Actividad</h2>
                                                        <ul id="mis_imagenes">

                                                        </ul>
                                                    </div>
                                                </div>    
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                <div class="dropdone-nk mg-t-30">
                                                    <div class="cmp-tb-hd">
                                                        <h2>Cargar imagenes</h2>
                                                        <!-- <p>Realiza la carga de varias imagenes a la vez.</p> -->
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <input type="file" class="form-control" multiple="multiple" name="imagenes[]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Dropzone area End-->
                            </div>
                            <div class="wizard-action-pro">
                                <ul class="wizard-nav-ac">
                                    <li>
                                        <a class="button-previous a-prevent" href="#">
                                            <i class="notika-icon notika-back"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="button-next a-prevent" href="#">
                                            <i class="notika-icon notika-next-pro"></i>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <div class="modal-footer mt-3">
                                <input type="hidden" name="id_actividad_act" id="id_actividad_act">
                                <button type="submit" class="btn btn-default">Guardar</button>
                                <a type="button" class="btn btn-default" data-toggle="modal" data-target="#cerrar_modal">Cerrar</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
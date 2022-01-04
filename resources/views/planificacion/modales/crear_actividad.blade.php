<!-- Start modal -->

<div class="modal fade" id="crear_actividad" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- <button type="button" class="close" data-toggle="modal" data-target="#cerrar_modal">&times;</button> -->
            </div>
            <div class="modal-body" id="formulario_actividad">
                <div class="wizard-wrap-int">
                    <div class="wizard-hd">
                        <h1 class="text-center"><span id="accion"></span> Actividad</h1>
                        <div id="Cargando_edit" style="display: none;">
                            <center>
                                <div id="mensaje2"></div>
                                <img src="{{ asset('assets/img/tenor2.gif') }}" alt="Logo" height="40px" width="100px;" title="Cargando" />
                            </center>
                            <hr>
                        </div>
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
                                                    <option value="">Seleccione tipo de actividad</option>
                                                    @if(buscar_p('Actividades - PM01','General')=="Si" || buscar_p('Actividades','Registrar')=="Si")
                                                        <option value="PM01">PM01</option>
                                                    @endif
                                                    @if(buscar_p('Actividades - PM02','General')=="Si" || buscar_p('Actividades','Registrar')=="Si")
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
                                                    @php $pm02s=buscar_pm02(); @endphp
                                                    <select name="id_actividad" id="id_actividad" class="form-control" required="required">                  
                                                        <option value="0">Registrar nueva</option>
                                                        @foreach($pm02s as $key)
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
                                                <label><b> Áreas: </b></label>
                                                <select name="id_area" id="id_area" class="form-control" required="required">
                                                    <option value="">Selecciones un área</option>
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
                                                <select name="id_departamento" id="id_departamento">
                                                    
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
                                                <label><b> Planificación: </b> <b style="color: red;">*</b></label>
                                                <select name="id_planificacion_edit[]" class="form-control select2" id="id_planificacion2" required="required">
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
                                <div id="actividad_registrada" style="display: none;">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                    <label>Task: !! Actividad  registrada!! </label>
                                                    <p id="ver_task1"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if(\Auth::User()->tipo_user!="Empleado")
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                    <label><b> Duración proyectada: </b><span id="ver_duracion_pro1"></span></label>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if(\Auth::User()->tipo_user!="Empleado")
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                        @else
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                        @endif
                                            <div class="form-group">
                                                <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                    <label><b>Cantidad de personas: </b><span id="ver_cant_personas1"></span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                    <label><b>Observaciones/Comentarios: </b></label><br>
                                                    <p id="ver_observacion2"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="data_1">
                                            <div class="form-group">
                                                <label><b>Día de la actividad: <span style="color: red;">*</span></b></label>
                                                <div class="fm-checkbox form-elet-mg">
                                                    <div class="area_check" id="area_check">
                                                        <div class="miercoles">
                                                            <p>
                                                                <input type="checkbox" id="ar_mie" name="dia[]" value="Mié" checked class="ar_dia">
                                                                <label for="ar_mie"><span></span>  Miércoles</label>
                                                            </p>
                                                        </div>
                                                        <div class="jueves">
                                                            <p>
                                                                <input type="checkbox" id="ar_jue" name="dia[]" value="Jue" class="ar_dia">
                                                                <label for="ar_jue"><span></span>  Jueves</label>
                                                            </p>
                                                        </div>
                                                        <div class="viernes">
                                                            <p>
                                                                <input type="checkbox" id="ar_vie" name="dia[]" value="Vie" class="ar_dia">
                                                                <label for="ar_vie"><span></span>  Viernes</label>
                                                            </p>
                                                            <p>
                                                        </div>
                                                        <div class="sabado">
                                                            <p>
                                                                <input type="checkbox" id="ar_sab" name="dia[]"  value="Sáb" class="ar_dia">
                                                                <label for="ar_sab"><span></span>   Sábado</label>
                                                            </p>
                                                        </div>
                                                        <div class="domingo">
                                                            <p>
                                                                <input type="checkbox" id="ar_dom" name="dia[]"  value="Dom" class="ar_dia">
                                                                <label for="ar_dom"><span></span>   Domingo</label>
                                                            </p>
                                                        </div>
                                                        <div class="lunes">
                                                            <p>
                                                                <input type="checkbox" id="ar_lun" name="dia[]"  value="Lun" class="ar_dia">
                                                                <label for="ar_lun"><span></span>   Lunes</label>
                                                            </p>
                                                        </div>
                                                        <div class="martes">
                                                            <p>
                                                                <input type="checkbox" id="ar_mar" name="dia[]"  value="Mar" class="ar_dia">
                                                                <label for="ar_mar"><span></span>   Martes</label>
                                                            </p>  
                                                        </div>
                                                    </div>
                                                    <div class="area_radio" id="area_radio">
                                                            <div class="demo">
                                                                <p>
                                                                    <input type="radio" id="miercoles_ar" name="dia" value="Mié" class="ar_dia">
                                                                    <label for="miercoles_ar"><span></span>Miércoles</label>
                                                                </p>
                                                                <p>
                                                                    <input type="radio" id="jueves_ar" name="dia" value="Jue" class="ar_dia">
                                                                    <label for="jueves_ar"><span></span>Jueves</label>
                                                                </p>
                                                            
                                                                <p>
                                                                    <input type="radio" id="viernes_ar" name="dia" value="Vie" class="ar_dia">
                                                                    <label for="viernes_ar"><span></span>Viernes</label>
                                                                </p>
                                                                <p>
                                                                    <input type="radio" id="sabado_ar" name="dia" value="Sáb" class="ar_dia">
                                                                    <label for="sabado_ar"><span></span>Sabado</label>
                                                                </p>
                                                                <p>
                                                                    <input type="radio" id="domingo_ar" name="dia" value="Dom" class="ar_dia">
                                                                    <label for="domingo_ar"><span></span>Domingo</label>
                                                                </p>
                                                                <p>
                                                                    <input type="radio" id="lunes_ar" name="dia" value="Lun" class="ar_dia">
                                                                    <label for="lunes_ar"><span></span>Lunes</label>
                                                                </p>
                                                                <p>
                                                                    <input type="radio" id="martes_ar" name="dia" value="Mar" class="ar_dia">
                                                                    <label for="martes_ar"><span></span>Martes</label>
                                                                </p>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="registrar_actividad">
                                    @if(\Auth::User()->tipo_user!="Empleado")
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                    <label>Task: !! Crear actividad !! <span style="color:red">*</span></label>
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
                                                        @if(\Auth::user()->tipo_user=="Empleado")
                                                        asasa<input   type="hidden" value="0" class="form-control" name="duracion_pro_edit" id="duracion_pro" placeholder="Duración proyectada">
                                                        @else
                                                        <input type="number" class="form-control" name="duracion_pro" id="duracion_pro_edit" placeholder="Duración proyectada">
                                                        @endif
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
                                                    <label><b>Día de la actividad: <span style="color: red;">*</span></b></label>
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
                                                                    <input type="checkbox" id="mie" name="dia[]" value="Mié" checked class="ra_dia">
                                                                    <label for="mie"><span></span>  Miércoles</label>
                                                                </p>
                                                            </div>
                                                            <div class="jueves">
                                                                <p>
                                                                    <input type="checkbox" id="jue" name="dia[]" value="Jue" class="ra_dia">
                                                                    <label for="jue"><span></span>  Jueves</label>
                                                                </p>
                                                            </div>
                                                            <div class="viernes">
                                                                <p>
                                                                    <input type="checkbox" id="vie" name="dia[]" value="Vie" class="ra_dia">
                                                                    <label for="vie"><span></span>  Viernes</label>
                                                                </p>
                                                                <p>
                                                            </div>
                                                            <div class="sabado">
                                                                <p>
                                                                    <input type="checkbox" id="sab" name="dia[]"  value="Sáb" class="ra_dia">
                                                                    <label for="sab"><span></span>   Sábado</label>
                                                                </p>
                                                            </div>
                                                            <div class="domingo">
                                                                <p>
                                                                    <input type="checkbox" id="dom" name="dia[]"  value="Dom" class="ra_dia">
                                                                    <label for="dom"><span></span>   Domingo</label>
                                                                </p>
                                                            </div>
                                                            <div class="lunes">
                                                                <p>
                                                                    <input type="checkbox" id="lun" name="dia[]"  value="Lun" class="ra_dia">
                                                                    <label for="lun"><span></span>   Lunes</label>
                                                                </p>
                                                            </div>
                                                            <div class="martes">
                                                                <p>
                                                                    <input type="checkbox" id="mar" name="dia[]"  value="Mar" class="ra_dia">
                                                                    <label for="mar"><span></span>   Martes</label>
                                                                </p>  
                                                            </div>
                                                        </div>
                                                        <div class="area_radio1" id="area_radio1">
                                                            <div class="demo">
                                                                <p>
                                                                    <input type="radio" id="miercoles_r" name="dia" value="Mié" class="ra_dia">
                                                                    <label for="miercoles_r"><span></span>Miércoles</label>
                                                                </p>
                                                                <p>
                                                                    <input type="radio" id="jueves_r" name="dia" value="Jue" class="ra_dia">
                                                                    <label for="jueves_r"><span></span>Jueves</label>
                                                                </p>
                                                            
                                                                <p>
                                                                    <input type="radio" id="viernes_r" name="dia" value="Vie" class="ra_dia">
                                                                    <label for="viernes_r"><span></span>Viernes</label>
                                                                </p>
                                                                <p>
                                                                    <input type="radio" id="sabado_r" name="dia" value="Sáb" class="ra_dia">
                                                                    <label for="sabado_r"><span></span>Sabado</label>
                                                                </p>
                                                                <p>
                                                                    <input type="radio" id="domingo_r" name="dia" value="Dom" class="ra_dia">
                                                                    <label for="domingo_r"><span></span>Domingo</label>
                                                                </p>
                                                                <p>
                                                                    <input type="radio" id="lunes_r" name="dia" value="Lun" class="ra_dia">
                                                                    <label for="lunes_r"><span></span>Lunes</label>
                                                                </p>
                                                                <p>
                                                                    <input type="radio" id="martes_r" name="dia" value="Mar" class="ra_dia">
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
                                                    <label><b>Día de la actividad: <span style="color: red;">*</span></b></label>
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
                                                                    <input type="checkbox" id="mie_e" name="dia[]" value="Mié" checked class="ra_dia">
                                                                    <label for="mie_e"><span></span>  Miércoles</label>
                                                                </p>
                                                            </div>
                                                            <div class="jueves">
                                                                <p>
                                                                    <input type="checkbox" id="jue_e" name="dia[]" value="Jue" class="ra_dia">
                                                                    <label for="jue_e"><span></span>  Jueves</label>
                                                                </p>
                                                            </div>
                                                            <div class="viernes">
                                                                <p>
                                                                    <input type="checkbox" id="vie_e" name="dia[]" value="Vie" class="ra_dia">
                                                                    <label for="vie_e"><span></span>  Viernes</label>
                                                                </p>
                                                                <p>
                                                            </div>
                                                            <div class="sabado">
                                                                <p>
                                                                    <input type="checkbox" id="sab_e" name="dia[]"  value="Sáb" class="ra_dia">
                                                                    <label for="sab_e"><span></span>   Sábado</label>
                                                                </p>
                                                            </div>
                                                            <div class="domingo">
                                                                <p>
                                                                    <input type="checkbox" id="dom_e" name="dia[]"  value="Dom" class="ra_dia">
                                                                    <label for="dom_e"><span></span>   Domingo</label>
                                                                </p>
                                                            </div>
                                                            <div class="lunes">
                                                                <p>
                                                                    <input type="checkbox" id="lun_e" name="dia[]"  value="Lun" class="ra_dia">
                                                                    <label for="lun_e"><span></span>   Lunes</label>
                                                                </p>
                                                            </div>
                                                            <div class="martes">
                                                                <p>
                                                                    <input type="checkbox" id="mar_e" name="dia[]"  value="Mar" class="ra_dia">
                                                                    <label for="mar_e"><span></span>   Martes</label>
                                                                </p>  
                                                            </div>
                                                        </div>
                                                        <div class="area_radio2" id="area_radio2">
                                                            <div class="demo">
                                                                <p>
                                                                    <input type="radio" id="miercoles_r" name="dia" value="Mié" class="ra_dia">
                                                                    <label for="miercoles_r"><span></span>Miércoles</label>
                                                                </p>
                                                                <p>
                                                                    <input type="radio" id="jueves_r" name="dia" value="Jue" class="ra_dia">
                                                                    <label for="jueves_r"><span></span>Jueves</label>
                                                                </p>
                                                            
                                                                <p>
                                                                    <input type="radio" id="viernes_r" name="dia" value="Vie" class="ra_dia">
                                                                    <label for="viernes_r"><span></span>Viernes</label>
                                                                </p>
                                                                <p>
                                                                    <input type="radio" id="sabado_r" name="dia" value="Sáb" class="ra_dia">
                                                                    <label for="sabado_r"><span></span>Sabado</label>
                                                                </p>
                                                                <p>
                                                                    <input type="radio" id="domingo_r" name="dia" value="Dom" class="ra_dia">
                                                                    <label for="domingo_r"><span></span>Domingo</label>
                                                                </p>
                                                                <p>
                                                                    <input type="radio" id="lunes_r" name="dia" value="Lun" class="ra_dia">
                                                                    <label for="lunes_r"><span></span>Lunes</label>
                                                                </p>
                                                                <p>
                                                                    <input type="radio" id="martes_r" name="dia" value="Mar" class="ra_dia">
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
                            </div>
                            
                            <div class="tab-pane wizard-ctn" id="tab4">

                                <!-- Dropzone area Start-->
                                <div class="dropzone-area">
                                    <div class="container">
<!--                                         <div id="archivos_cargados">
                                        </div>
                                        <div id="mis_archivosMensaje">
                                                            
                                        </div> -->
                                        <div class="row">
                                                    <!-- <div class="cmp-tb-hd"><h3>Archivos</h3> -->
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="dropdone-nk mg-t-30">
                                                        <h2>Cargar archivos</h2>
                                                    <div id="MuestraArchivos2"></div>
                                                        <!-- <p>Realiza la carga de tantos archivos como quieras.</p> -->
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <input type="file" class="form-control" multiple="multiple" name="archivos[]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="imagenes_cargadas">
                                            
                                        </div>
                                        <br>
                                        <ul id="mis_imagenesMensaje">

                                        </ul>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="dropdone-nk mg-t-30">
                                                    <div class="cmp-tb-hd">
                                                        <h2>Cargar imagenes</h2>
                                                    <div id="MuestraImagenes2"></div>
                                                        <!-- <p>Realiza la carga de varias imagenes a la vez.</p> -->
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <input type="file" class="form-control" multiple="multiple" name="imagenes[]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3"></div>
                                        <center><button type="submit" class="btn btn-default">Guardar</button></center>
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
                                <a type="button" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
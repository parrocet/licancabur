<!-- Start modal -->

<div class="modal fade" id="nuevo_empleado" role="dialog">
    <div class="modal-dialog modal-lg">
    <!-- <div class="modal-dialog modals-default"> -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-toggle="modal" data-target="#cerrar_modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="wizard-wrap-int" style="width:100%;">
                    <div class="wizard-hd">
                        <h1 class="text-center"> Nuevo usuario</h1>
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
                                        <li><a href="#tab1" data-toggle="tab" class="pestanaUsuario1">Datos básicos</a></li>
                                        <li><a href="#tab2" data-toggle="tab" class="pestanaUsuario2">Laboral</a></li>
                                        <li><a href="#tabL" data-toggle="tab" class="pestanaUsuario3">Licencias</a></li>
                                        <li><a href="#tab4" data-toggle="tab" class="pestanaUsuario4">Cursos</a></li>
                                        <li><a href="#tab5" data-toggle="tab" class="pestanaUsuario5">Médicos</a></li>
                                        <li><a href="#tab6" data-toggle="tab" class="pestanaUsuario6">Contacto</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <form action="{{route('empleados.store')}}" method="POST" name="registrar_usuario" id="registrar_usuario" data-parsley-validate>
                        <div class="tab-content">
                            <div class="tab-pane wizard-ctn" id="tab1">
                                <h4>Datos de Usuarios</h4>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mb-6">
                                        <div class="form-group">
                                            <label for="email">Correo electrónico: <b style="color: red;">*</b></label>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese correo electrónico" required="required" value="{{ old('email') }}" data-parsley-type="email" data-parsley-trigger="keyup">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mb-6">
                                        <div class="form-group">
                                            <label for="tipo_user">Tipo de usuario<b style="color: red;">*</b></label>
                                            <select class="form-control" id="tipo_user" placeholder="Especifique el tipo de usuario que será el nuevo usuario terreno" name="tipo_user" required="required">
                                                <option value="Empleado">Usuario terreno</option>
                                                <option value="Supervisor">Supervisor</option>
                                                <option value="Planificacion">Planificacion</option>
                                                <!-- <option value="Recursos humanos">Recursos humanos</option> -->
                                                @if(\Auth::User()->tipo_user=="Admin")
                                                    <option value="Admin">Admin</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <h4>Datos personales</h4>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group">
                                            <label for="nombres">Primer nombre: <b style="color: red;">*</b></label>
                                            <input type="text" name="nombres" id="primer_nombre" class="form-control" placeholder="Ingrese primer nombre" required="required" value="{{ old('nombres') }}" data-parsley-pattern="^[a-zA-Z ]+$">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group">
                                            <label for="segundo_nombre">Segundo nombre: </label>
                                            <input type="text" name="segundo_nombre" id="segundo_nombre" class="form-control" placeholder="Ingrese segundo nombre"  value="{{ old('segundo_nombre') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group">
                                            <label for="apellidos">Primer apellido: <b style="color: red;">*</b></label>
                                            <input type="text" name="apellidos" id="primer_apellido" class="form-control" placeholder="Ingrese primer apellido" required="required" value="{{ old('apellidos') }}" data-parsley-pattern="^[a-zA-Z ]+$">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group">
                                            <label for="segundo_apellido">Segundo apellido: </label>
                                            <input type="text" name="segundo_apellido" id="segundo_apellido" class="form-control" placeholder="Ingres segundo apellido"  value="{{ old('segundo_apellido') }}">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group">
                                            <label for="rut">Rut: <b style="color: red;">*</b></label>
                                            <input type="text" name="rut" id="rut" class="form-control" placeholder="Ingrese rut" required="required" value="{{ old('rut') }}" data-parsley-type="number" data-parsley-length="[8, 9]" maxlength="9">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group">
                                            <label for="fecha_nac">Fecha de nacimiento: <b style="color: red;">*</b></label>
                                            <input type="date" class="form-control" max="<?php echo date('Y-m-d'); ?>" id="fecha_nac" name="fecha_nac" required="required" >
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <div class="form-group">
                                            <label for="genero">Género: <b style="color: red;">*</b></label>
                                            <div class="fm-checkbox form-elet-mg">
                                                <div class="i-checks">
                                                    <label>
                                                        <label><input type="radio" id="genero" name="genero" class="i-checks" value="Masculino" checked="checked"><i></i>  Masculino</label>
                                                    </label>
                                                    <label>
                                                        <label><input type="radio" id="genero" name="genero" class="i-checks" value="Femenino"><i></i>  Femenino</label>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <h4>AFP</h4>
                                <br>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="align-content: center;">
                                            <select name="id_afp[]" id="id_afp" class="select2" title="Seleccione los AFP del usuario terreno" style="width: 100%;" multiple="multiple">
                                                @foreach($afp as $key)
                                                    <option value="{{$key->id}}">{{$key->afp}}</option>
                                                @endforeach()
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h4>Isapre</h4>
                                <br>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                <select name="id_isapre[]" id="id_isapre" class="select2" multiple="multiple" style="width: 100%" title="Seleccione los Isapre del usuario">
                                                    @foreach($isapre as $k)
                                                        <option value="{{$k->id}}">{{$k->isapre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- DATOS LABORALES-->
                            <div class="tab-pane wizard-ctn" id="tab2">

                                <h4>Datos laborales</h4>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-12">
                                        <div class="form-group">
                                            <label for="status">Status: <b style="color: red;">*</b></label>
                                            <select name="status" id="status" class="form-control" required="required">
                                                <option value="Activo">Activo</option>
                                                <option value="Reposo">Reposo</option>
                                                <option value="Retirado">Retirado</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-12">
                                        <div class="form-group">
                                            <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                <label for="rut">Áreas: <b style="color: red;">*</b></label>
                                                <select name="id_area[]" id="id_area" class="select2" multiple="multiple" style="width: 100%" required="required" placeholder="Seleccione...">
                                                    @foreach($areas as $key)
                                                        <option value="{{ $key->id }}">{{ $key->area }}</option>
                                                    @endforeach
                                                </select>
                                                <p style="color:red;" id="id_areaM"><strong>Seleccione un Área</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-12" style="display: none;">
                                        <div class="form-group">
                                            <label for="id_departamento">Departamentos: <b style="color: red;">*</b></label>
                                            <select name="id_departamento[]" id="id_departamento" class="form-control" multiple="multiple" style="width: 100%" placeholder="Seleccione..." required>                  
                                                @foreach($departamentos as $key)
                                                    <option value="{{ $key->id }}">{{ $key->departamento }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-12">
                                        <div class="form-group">
                                            <label for="cargo">Cargo: <b style="color: red;">*</b></label>
                                            <select class="form-control" name="cargo" id="cargo" placeholder="Seleccione el cargo del usuario terreno" required="required">
                                                <option value="Gerente">Gerente</option>
                                                <option value="Jefe de Operaciones">Jefe de Operaciones</option>
                                                <option value="Ingeniero de Servicios">Ingeniero de Servicios</option>
                                                <option value="Jefe de Administración">Jefe de Administración</option>
                                                <option value="Técnico de Servicios">Técnico de Servicios</option>
                                                <option value="Ingeniero en Entrenamiento">Ingeniero en Entrenamiento</option>
                                                <option value="Maestro Mayor">Maestro Mayor</option>
                                                <option value="Jefe de Terreno">Jefe de Terreno</option>
                                                <option value="Supervisor de Terreno">Supervisor de Terreno</option>
                                                <option value="Técnico de Montaje">Técnico de Montaje</option>
                                                <option value="Jefe de Coordinación y Gestión">Jefe de Coordinación y Gestión</option>
                                                <option value="Planificador">Planificador</option>
                                                <!-- <option value="Prevención de Riesgos"></option> -->
                                                <option value="Asistente Administrativo">Asistente Administrativo</option>
                                                <option value="Chofer">Chofer</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-12">
                                        <div class="form-group">
                                            <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                <label for="id_faena">Faenas: <b style="color: red;">*</b></label>
                                                <select name="id_faena[]" id="id_faena" class="select2" required="required" multiple="multiple" style="width: 100%" placeholder="Seleccione..." required>
                                                    @foreach($faenas as $key)
                                                        <option value="{{ $key->id }}">{{ $key->faena }}</option>
                                                    @endforeach
                                                </select>
                                                <p style="color:red;" id="id_faenaM"><strong>Seleccione una Faena</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-12">
                                        <div class="form-group">
                                            <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10">
                                                <label for="id_area_e">Áreas empresas: <b style="color: red;">*</b></label>
                                                <select name="id_area_e[]" id="id_area_e" class="select2" multiple="multiple" style="width: 100%" placeholder="Seleccione..." required="required">
                                                    @foreach($areasEmpresa as $key)
                                                        <option value="{{ $key->id }}">{{ $key->area_e }}</option>
                                                    @endforeach
                                                </select>
                                                <p style="color:red;" id="id_area_eM"><strong>Seleccione un Área de empresa</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane wizard-ctn" id="tab4">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-element-list">
                                            @csrf
                                                <h4>Cursos realizados</h4>
                                                <br>
                                                <div class="scrollbar">
                                                    @php $num=1; @endphp
                                                    @foreach($cursos as $key)
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                                                    <input type="checkbox" onclick="cursos('{{$num}}')" name="id_curso[]" id="id_curso{{$num}}" value="{{ $key->id }}">
                                                                </div>
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                                    <label>{{$key->curso}}</label>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                    <div class="form-group">
                                                                        <label>Fecha de culminación del curso</label>
                                                                        <input type="date" max="<?php echo date('Y-m-d'); ?>" onchange="selectFechas(1,'{{$num}}')" name="curso_fecha_realizado[]" class="form-control" id="curso_fecha_realizado{{$num}}" disabled="disabled">
                                                                    </div>
                                                                    <p style="color: red; display: none;" id="mensaje1-{{$num}}">Debe seleccionar la fecha de culminación</p>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                    <div class="form-group">
                                                                        <label>Fecha de vencimiento del curso</label>
                                                                        <input type="date" min="<?php echo date('Y-m-d'); ?>" onchange="selectFechas(2,'{{$num}}')" name="curso_fecha_vencimiento[]" class="form-control" id="curso_fecha_vencimiento{{$num}}" disabled="disabled">
                                                                    </div>
                                                                    <p style="color: red; display: none;" id="mensaje2-{{$num}}">Debe seleccionar la fecha de vencimiento</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        @php $num++; @endphp
                                                    @endforeach()
                                                </div>
                                                <input type="hidden" id="selectCursos" value="0">
                                        </div>

                                    </div>
                                </div>


                            </div>

                            <div class="tab-pane wizard-ctn" id="tabL">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-element-list">
                                            @csrf
                                            <h4>Licencias</h4>
                                            <br>
                                            <div class="scrollbar">
                                                @php $num=1; @endphp
                                                @foreach($licencias as $key)
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                                                <input type="checkbox" onclick="licencias('{{$num}}')" name="id_licencia[]" id="id_licencia{{$num}}" value="{{ $key->id }}">
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                                <label>{{$key->licencia}}</label>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                                                                <div class="form-group">
                                                                    <label for="licencia_conducir">Fecha de emisión <b style="color: red;">*</b></label>
                                                                    <input type="date" class="form-control" max="<?php echo date('Y-m-d'); ?>" id="lic_fecha_emision{{$num}}" name="fechae_licn[]" disabled="disabled" onchange="selectFechas(3,'{{$num}}')">
                                                                </div>
                                                                <p style="color: red; display: none" id="mensaje3-{{$num}}">Debe seleccionar la fecha de emisión</p>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                                                                <div class="form-group">
                                                                    <label for="licencia_conducir">Fecha de vencimiento <b style="color: red;">*</b></label>
                                                                    <input type="date" class="form-control" min="<?php echo date('Y-m-d'); ?>" id="lic_fecha_vencimiento{{$num}}" name="fechav_licn[]" disabled="disabled" onchange="selectFechas(4,'{{$num}}')">
                                                                </div>
                                                                <p style="color: red; display: none" id="mensaje4-{{$num}}">Debe seleccionar la fecha de vencimiento</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    @php $num++; @endphp
                                                @endforeach()
                                                <input type="hidden" id="selectLicencia" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="tab-pane wizard-ctn" id="tab5">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-element-list">
                                            @csrf
                                                <h4>Exámenes</h4>
                                                <br>
                                                <div class="scrollbar">
                                                    @php $num=1; @endphp
                                                    @foreach($examenes as $key)
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                                                    <input type="checkbox" onclick="examenes('{{$num}}')" name="id_examen[]" id="id_examen{{$num}}" value="{{ $key->id }}">
                                                                </div>
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                                    <label>{{$key->examen}}</label>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                    <div class="form-group">
                                                                        <label>Fecha en que se realizó el examen</label>
                                                                        <input type="date" max="<?php echo date('Y-m-d'); ?>" name="examenes_fecha_realizado[]" class="form-control" id="examenes_fecha_realizado{{$num}}" disabled="disabled" onchange="selectFechas(5,'{{$num}}')">
                                                                    </div>
                                                                    <p style="color: red; display: none" id="mensaje5-{{$num}}">Debe seleccionar la fecha de emisión del exámen</p>
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                                    <div class="form-group">
                                                                        <label>Fecha de vencimiento</label>
                                                                        <input type="date" min="<?php echo date('Y-m-d'); ?>" name="examenes_fecha_vencimiento[]" class="form-control" id="examenes_fecha_vencimiento{{$num}}" disabled="disabled" onchange="selectFechas(6,'{{$num}}')">
                                                                    </div>
                                                                    <p style="color: red; display: none" id="mensaje6-{{$num}}">Debe seleccionar la fecha de vencimiento</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        @php $num++; @endphp
                                                    @endforeach()
                                                </div>
                                                <input type="hidden" id="selectExam" value="0">

                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane wizard-ctn" id="tab6">
                                <h4>Contacto opcional en caso de una emergencia</h4>
                                <br>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label for="nombre_contacto">Nombre del contacto <b style="color: red;">*</b></label>
                                            <input type="text" name="nombre" class="form-control" id="nombre_contacto" placeholder="Ingrese el nombre del contacto provisonal" required="required">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label for="apellido_contacto">Apellido del contacto <b style="color: red;">*</b></label>
                                            <input type="text" name="apellido" class="form-control" id="apellido_contacto" placeholder="Ingrese el apellido del contacto provisonal" required="required">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label for="telefono_contacto">Teléfono del contacto <b style="color: red;">*</b></label>
                                            <input type="number" name="telefono" class="form-control" id="telefono_contacto" placeholder="Ingrese el rut del contacto provisonal" required="required">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label for="email_contacto">Email del contacto <b style="color: red;">*</b></label>
                                            <input type="email" name="email_contacto" class="form-control" id="email_contacto" placeholder="Ingrese el email del contacto provisonal" required="required">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="direccion_contacto">Dirección del contacto <b style="color: red;">*</b></label>
                                            <textarea class="form-control" name="direccion" id="direccion_contacto" placeholder="Ingrese la dirección del contacto provisonal" required="required"></textarea>
                                        </div>
                                    </div>
                                </div>
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
                                <center>
                                    <p style="color: red; display: none;" id="completeUsuario"><strong>¡Complete los campos requeridos!</strong></p>
                                    <input type="hidden" name="id_actividad_act" id="id_actividad_act">
                                    <button type="submit" class="btn btn-default" style="display: none;" id="crearUsuario1">Guardar</button>
                                    <a class="btn btn-default" id="crearUsuario2">Guardar</a>
                                    <a type="button" class="btn btn-default" data-toggle="modal" data-target="#cerrar_modal">Cerrar</a>
                                </center>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@extends('layouts.appLayout')

@section('breadcomb')
<!-- Breadcomb area Start-->
<div class="breadcomb-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="breadcomb-list">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="breadcomb-wp">
								<div class="breadcomb-icon">
									<i class="notika-icon notika-support"></i>
								</div>
								<div class="breadcomb-ctn">
									<h2>Privilegios </h2>
									<p>Permisos del sistema de cada usuario terreno</p>
								</div>
							</div>
						</div>
                        <div>
                            <strong style="float: right; margin-top: 10px; margin-bottom: 5px;">Año laboral actual: {{-- {{ config('session.fecha_actual') }} --}} 
                                @if(session('fecha_actual'))
                                    @php $anio=session('fecha_actual'); @endphp
                                @else
                                    @php $anio=date('Y');
                                        session('fecha_actual',$anio);
                                     @endphp
                                    
                                @endif
                                {{ $anio }}
                            </strong>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Breadcomb area End-->
    
@endsection


@section('content')
<!-- Data Table area Start-->
<div class="data-table-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="basic-tb-hd text-center">
                    @if(count($errors))
                    <div class="alert-list m-4">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>
                                    {{$error}}
                                </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    @endif
                    @include('flash::message')
                </div>
                <div class="data-table-list">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span><select class="form-control select2" name="id_empleado" id="id_empleado">
                                    
                                    @foreach($empleados as $item)
                                        <option value="{{$item->id}}">{{$item->nombres}} {{$item->apellidos}} .- {{$item->rut}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" id="buscar_permisos" class="btn btn-primary">Buscar permisos</button>
                        </div>
                    </div>
                </div>

                <div class="row" id="mostrar_permisos" style="display: none;">
                    <input type="hidden" name="id_usuario_p" id="id_usuario_p">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="normal-table-list mg-t-30">
                            <div class="basic-tb-hd">
                                <h2>Permisos - Módulos</h2>
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Ver todos los módulos</button>
                                <span id="notificacion"></span>
                            </div>
                            <hr>
                            <!-- DESPLIEGUE PLANIFICACIONES -->
                            <div id="ocultar_planificacion">
                                <p>
                                    <a class="btn btn-primary" style="width: 100%;" data-toggle="collapse" href="#permisosPlanificacion" role="button" aria-expanded="false" aria-controls="permisosPlanificacion">PLANIFICACIÓN</a>
                                  
                                </p>
                                <div class="row">
                                  <div class="col">
                                    <div class="collapse multi-collapse" id="permisosPlanificacion">
                                      <div class="card" style="width: 100%; left: 6000px;">
                                          <ul class="list-group list-group-flush">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: green;">Buscar </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso1" id="id_permiso1" value="1"></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Registrar </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso2" id="id_permiso2" value="2" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: green;">Modificar</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso3" id="id_permiso3" value="3"  checked></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Eliminar</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso4" id="id_permiso4" value="4" ></div></div> </li>
                                                </div>
                                            </div>
                                          </ul>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div id="ocultar_actividad">
                                <!-- DESPLIEGUE ACTIVIDADES -->
                                <p>
                                    <a class="btn btn-success" style="width: 100%;" data-toggle="collapse" href="#permisosActividades" role="button" aria-expanded="false" aria-controls="permisosActividades">ACTIVIDADES</a>
                                  
                                </p>
                                <div class="row">
                                  <div class="col">
                                    <div class="collapse multi-collapse" id="permisosActividades">
                                      <div class="card" style="width: 100%; left: 6000px;">
                                          <ul class="list-group list-group-flush">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Ver </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso5" id="id_permiso5" value="5" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Registrar </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso6" id="id_permiso6" value="6" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Registro de PM03</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso7" id="id_permiso7" value="7" ></div></div> </li>
                                                </div>
                                                <div id="ocultar_actividad1">
                                                    <div class="col-md-3">
                                                        <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Modificar</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso8" id="id_permiso8" value="8" ></div></div> </li>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div id="ocultar_actividad2">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Asignar</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso9" id="id_permiso9" value="9" ></div></div> </li>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Eliminar</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso10" id="id_permiso10" value="10" ></div></div> </li>
                                                    </div>
                                                </div>
                                            </div>
                                          </ul>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div id="ocultar_usuarios">
                                <!-- DESPLIEGUE USUARIOS -->
                                <p>
                                    <a class="btn btn-info" style="width: 100%;" data-toggle="collapse" href="#permisosUsuarios" role="button" aria-expanded="false" aria-controls="permisosUsuarios">USUARIOS</a>
                                  
                                </p>
                                <div class="row">
                                  <div class="col">
                                    <div class="collapse multi-collapse" id="permisosUsuarios">
                                      <div class="card" style="width: 100%; left: 6000px;">
                                          <ul class="list-group list-group-flush">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Listado </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso11" id="id_permiso11" value="11" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Registrar </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso12" id="id_permiso12" value="12" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Modificar</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso13" id="id_permiso13" value="13" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Eliminar</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso14" id="id_permiso14" value="14" ></div></div> </li>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Ver datos laborales</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso15" id="id_permiso15" value="15" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Ver exámenes</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso16" id="id_permiso16" value="16" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Ver curso cero daño</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso17" id="id_permiso17" value="17" ></div></div> </li>
                                                </div>
                                            </div>
                                          </ul>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>

                            <div id="ocultar_graficas">
                                <!-- DESPLIEGUE GRÁFICAS -->
                                <p>
                                    <a class="btn btn-danger" style="width: 100%;" data-toggle="collapse" href="#permisosGraficas" role="button" aria-expanded="false" aria-controls="permisosGraficas">GRÁFICAS</a>
                                  
                                </p>
                                <div class="row">
                                  <div class="col">
                                    <div class="collapse multi-collapse" id="permisosGraficas">
                                      <div class="card" style="width: 100%; left: 6000px;">
                                          <ul class="list-group list-group-flush">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Listado </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso18" id="id_permiso18" value="18" ></div></div> </li>
                                                </div>
                                            </div>
                                          </ul>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div id="ocultar_reportes">
                                <!-- DESPLIEGUE REPORTES -->
                                <p>
                                    <a class="btn btn-warning" style="width: 100%;" data-toggle="collapse" href="#permisosReportes" role="button" aria-expanded="false" aria-controls="permisosReportes">REPORTES</a>
                                  
                                </p>
                                <div class="row">
                                  <div class="col">
                                    <div class="collapse multi-collapse" id="permisosReportes">
                                      <div class="card" style="width: 100%; left: 6000px;">
                                          <ul class="list-group list-group-flush">
                                            <div class="row">
                                                <div id="ocultar_reportes1">
                                                    <div class="col-md-3">
                                                        <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Excel </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso19" id="id_permiso19" value="19" ></div></div> </li>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">PDF </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso20" id="id_permiso20" value="20" ></div></div> </li>
                                                </div>
                                            </div>
                                          </ul>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div id="ocultar_areas">
                                 <!-- DESPLIEGUE AREAS -->
                                <p>
                                    <a class="btn btn-primary" style="width: 100%;" data-toggle="collapse" href="#permisosAreas" role="button" aria-expanded="false" aria-controls="permisosAreas">ÁREAS</a>
                                  
                                </p>
                                <div class="row">
                                  <div class="col">
                                    <div class="collapse multi-collapse" id="permisosAreas">
                                      <div class="card" style="width: 100%; left: 6000px;">
                                          <ul class="list-group list-group-flush">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Listado </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso21" id="id_permiso21" value="21" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Registrar </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso22" id="id_permiso22" value="22" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Editar</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso23" id="id_permiso23" value="23" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Eliminar</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso24" id="id_permiso24" value="24" ></div></div> </li>
                                                </div>
                                            </div>
                                          </ul>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div id="ocultar_gerencias">
                                 <!-- DESPLIEGUE GERENCIAS -->
                                <p>
                                    <a class="btn btn-success" style="width: 100%;" data-toggle="collapse" href="#permisosGerencias" role="button" aria-expanded="false" aria-controls="permisosGerencias">GERENCIAS</a>
                                  
                                </p>
                                <div class="row">
                                  <div class="col">
                                    <div class="collapse multi-collapse" id="permisosGerencias">
                                      <div class="card" style="width: 100%; left: 6000px;">
                                          <ul class="list-group list-group-flush">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Listado </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso25" id="id_permiso25" value="25" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Registrar </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso26" id="id_permiso26" value="26" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Editar</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso27" id="id_permiso27" value="27" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Eliminar</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso28" id="id_permiso28" value="28" ></div></div> </li>
                                                </div>
                                            </div>
                                          </ul>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div id="ocultar_departamentos">
                                <!-- DESPLIEGUE DEPARTAMENTOS -->
                                <p>
                                    <a class="btn btn-info" style="width: 100%;" data-toggle="collapse" href="#permisosDepartamentos" role="button" aria-expanded="false" aria-controls="permisosDepartamentos">DEPARTAMENTOS</a>
                                  
                                </p>
                                <div class="row">
                                  <div class="col">
                                    <div class="collapse multi-collapse" id="permisosDepartamentos">
                                      <div class="card" style="width: 100%; left: 6000px;">
                                          <ul class="list-group list-group-flush">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Listado </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso29" id="id_permiso29" value="29" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Registrar </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso30" id="id_permiso30" value="30" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Editar</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso31" id="id_permiso31" value="31" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Eliminar</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso32" id="id_permiso32" value="32" ></div></div> </li>
                                                </div>
                                            </div>
                                          </ul>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div id="ocultar_actividad_tipos">
                                <!-- DESPLIEGUE ACTIVIDADES GENERAL -->
                                <p>
                                    <a class="btn btn-danger" style="width: 100%;" data-toggle="collapse" href="#permisosActividadesG" role="button" aria-expanded="false" aria-controls="permisosActividadesG">ACTIVIDADES TIPOS</a>
                                  
                                </p>
                                <div class="row">
                                  <div class="col">
                                    <div class="collapse multi-collapse" id="permisosActividadesG">
                                      <div class="card" style="width: 100%; left: 6000px;">
                                          <ul class="list-group list-group-flush">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Actividades - PM01 General </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso33" id="id_permiso33" value="33" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Actividades - PM02 General </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso34" id="id_permiso34" value="34" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Actividades - PM04 General</label></div><div class="col-md-1"><input type="checkbox" name="id_permiso35" id="id_permiso35" value="35" ></div></div> </li>
                                                </div>
                                            </div>
                                          </ul>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div id="ocultar_estadisticas">
                                <!-- DESPLIEGUE ACTIVIDADES GENERAL -->
                                <p>
                                    <a class="btn btn-warning" style="width: 100%;" data-toggle="collapse" href="#permisosEstadisticas" role="button" aria-expanded="false" aria-controls="permisosEstadisticas">ESTADÍSTICAS</a>
                                  
                                </p>
                                <div class="row">
                                  <div class="col">
                                    <div class="collapse multi-collapse" id="permisosEstadisticas">
                                      <div class="card" style="width: 100%; left: 6000px;">
                                          <ul class="list-group list-group-flush">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Estadísticas - Por Ejecución </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso36" id="id_permiso36" value="36" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Estadísticas - Por HH </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso37" id="id_permiso37" value="37" ></div></div> </li>
                                                </div>
                                            </div>
                                          </ul>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div id="ocultar_cursos">
                                <!-- DESPLIEGUE ACTIVIDADES GENERAL -->
                                <p>
                                    <a class="btn btn-success" style="width: 100%;" data-toggle="collapse" href="#permisosCursos" role="button" aria-expanded="false" aria-controls="permisosCursos">CURSOS</a>
                                  
                                </p>
                                <div class="row">
                                  <div class="col">
                                    <div class="collapse multi-collapse" id="permisosCursos">
                                      <div class="card" style="width: 100%; left: 6000px;">
                                          <ul class="list-group list-group-flush">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Listado </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso38" id="id_permiso38" value="38" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Registrar </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso39" id="id_permiso39" value="39" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Editar </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso40" id="id_permiso40" value="40" ></div></div> </li>
                                                </div>
                                            </div>
                                          </ul>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div id="ocultar_examenes">
                                <!-- DESPLIEGUE ACTIVIDADES GENERAL -->
                                <p>
                                    <a class="btn btn-danger" style="width: 100%;" data-toggle="collapse" href="#permisosExamenes" role="button" aria-expanded="false" aria-controls="permisosExamenes">EXÁMENES</a>
                                  
                                </p>
                                <div class="row">
                                  <div class="col">
                                    <div class="collapse multi-collapse" id="permisosExamenes">
                                      <div class="card" style="width: 100%; left: 6000px;">
                                          <ul class="list-group list-group-flush">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Listado </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso41" id="id_permiso41" value="41" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Registrar </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso42" id="id_permiso42" value="42" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Editar </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso43" id="id_permiso43" value="43" ></div></div> </li>
                                                </div>
                                            </div>
                                          </ul>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            <div id="ocultar_licencias">
                                <!-- DESPLIEGUE ACTIVIDADES GENERAL -->
                                <p>
                                    <a class="btn btn-success" style="width: 100%;" data-toggle="collapse" href="#permisosLicencias" role="button" aria-expanded="false" aria-controls="permisosLicencias">LICENCIAS</a>
                                  
                                </p>
                                <div class="row">
                                  <div class="col">
                                    <div class="collapse multi-collapse" id="permisosLicencias">
                                      <div class="card" style="width: 100%; left: 6000px;">
                                          <ul class="list-group list-group-flush">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color: red;">Listado </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso44" id="id_permiso44" value="44" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Registrar </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso45" id="id_permiso45" value="45" ></div></div> </li>
                                                </div>
                                                <div class="col-md-3">
                                                    <li class="list-group-item"><div class="row"><div class="col-md-11"><label style="color:red;">Editar </label></div><div class="col-md-1"><input type="checkbox" name="id_permiso46" id="id_permiso46" value="46" ></div></div> </li>
                                                </div>
                                            </div>
                                          </ul>
                                        </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="not_found" style="display: block;">
                    <span id="mensaje"></span>
                </div>
                <!-- SECCIÓN DE PERMISOS --> 
            </div>
        </div>
    </div>
</div>

@include('areas.modales.eliminar')
<!-- Data Table area End-->
@endsection


@section('scripts')
<script type="text/javascript">
    $("#buscar_permisos").on('click',function () {
       //console.log('evento del boton') ;
       var id_empleado=$("#id_empleado").val();
       console.log(id_empleado);
       $("#notificacion").text('');
       $.get('permisos/'+id_empleado+'/buscar',function (data) {
           console.log(data[0].user);
           if (data.length>0) {
            $("#mostrar_permisos").css('display','block');
            $("#not_found").css('display','none');
            var j=0;
            var id_permiso="#id_permiso";
            var permiso="";
            var js="";
            var id_usuario=0;
            for(i=0;i<data.length;i++){
                j++;
                //console.log(data[i].user);
                js=j.toString();
                permiso=id_permiso.concat(js);
                if (data[i].id_privilegio==j && data[i].status=="Si") {
                    $(""+permiso+"").prop('checked',true);
                } else {
                    $(""+permiso+"").prop('checked',false);
                }
                id_usuario=data[i].id_usuario;
            }
            $("#id_usuario_p").val(id_usuario);
            if (data[0].user=="Empleado") {
                $("#ocultar_planificacion").css('display','none');
                $("#ocultar_actividad1").css('display','none');
                $("#ocultar_actividad2").css('display','none');
                $("#ocultar_usuarios").css('display','none');
                $("#ocultar_graficas").css('display','none');
                $("#ocultar_reportes1").css('display','none');
                $("#ocultar_areas").css('display','none');
                $("#ocultar_gerencias").css('display','none');
                $("#ocultar_departamentos").css('display','none');
                $("#ocultar_actividad_tipos").css('display','none');
                $("#ocultar_estadisticas").css('display','none');
                $("#ocultar_cursos").css('display','none');
                $("#ocultar_examenes").css('display','none');
                $("#ocultar_licencias").css('display','none');
            } else {
                $("#ocultar_planificacion").css('display','block');
                $("#ocultar_actividad1").css('display','block');
                $("#ocultar_actividad2").css('display','block');
                $("#ocultar_usuarios").css('display','block');
                $("#ocultar_graficas").css('display','block');
                $("#ocultar_reportes1").css('display','block');
                $("#ocultar_areas").css('display','block');
                $("#ocultar_gerencias").css('display','block');
                $("#ocultar_departamentos").css('display','block');
                $("#ocultar_actividad_tipos").css('display','block');
                $("#ocultar_estadisticas").css('display','block');
                $("#ocultar_cursos").css('display','block');
                $("#ocultar_examenes").css('display','block');
                $("#ocultar_licencias").css('display','block');
            }
           } else {
            $("#not_found").css('display','block');
            $("#mostrar_permisos").css('display','none');
            $("#mensaje").text('No fueron hallados permisos para el empleado seleccionado');
           }
       })
    });
    var j=0;
    var id_permiso="#id_permiso";
    var permiso="";
    var js="";
    for(i=1;i<=46;i++){
        j++;
        //console.log(data[i].status);
        js=j.toString();
        permiso=id_permiso.concat(js);

        $(""+permiso+"").on('change',function (event) {
            var id_usuario=$("#id_usuario_p").val();
            if( $(this).is(':checked') ){
                // console.log($(this).val());
                $.get('permisos/'+$(this).val()+'/1/'+id_usuario+'/actualizando',function (data) {
                    if (data==1) {
                        console.log("Se cambio el permiso a Si");
                        $("#notificacion").css('color','green');
                        $("#notificacion").text("Se ha asignado el permiso exitosamente!!");
                    } else {
                        console.log("No se cambio el permiso a Si");
                    }
                });
            }else{
                $.get('permisos/'+$(this).val()+'/2/'+id_usuario+'/actualizando',function (data) {
                    if (data==1) {
                        $("#notificacion").css('color','green');
                        $("#notificacion").text("Se ha retirado el permiso exitosamente!!");
                    } else {
                        //console.log("No se cambio el permiso a No");
                    }
                });
            }
        });

    }
</script>
<script type="text/javascript">
    function ModalTwo(){
        $('#eliminar_area').modal('hide');
        $('#eliminar_area').on('hidden', function () {
            $('#claverrot').modal('show')
        });
    }
</script>
<script>
function eliminar(id_area) {
    $("#id_area_eliminar").val(id_area);
}
</script>

<script>

    $(function () {
      $('select').each(function () {
        $(this).select2({
          theme: 'bootstrap4',
          width: 'style',
          placeholder: $(this).attr('placeholder'),
          allowClear: Boolean($(this).data('allow-clear')),
        });
      });
    });
</script>

@endsection
<div class="mobile-menu-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="mobile-menu">
                    <div class="material-design-btn mt-2" style="display: none;">
                        
                            {!! Form::open(['route' => ['examenes.store'], 'method' => 'POST', 'name' => 'modificar_anio', 'id' => 'modificar_anio', 'data-parsley-validate']) !!}
                                <select name="anio_planificacion_g" class="form-control select2" id="anio_planificacion_g2" required style="width: 73%; align-content: left !important; margin-top: -15px !important;">
                                    <option selected disabled>Seleccione año de planificación</option>
                                </select>
                                <button type="submit" class="btn notika-btn-green btn-reco-mg btn-button-mg waves-effect btn-xs" style="float: right !important; margin-top: -31px !important;">
                                    <i class="notika-icon notika-next"></i>
                                </button>
                            {!! Form::close() !!}
                    </div>
                    <nav id="dropdown">
                        <ul class="mobile-menu-nav">
                            <li class="{{ active('home') }}"><a href="{{ route('home') }}" ><i class="notika-icon notika-house"></i> Dashboard </a></li>
                            <!-- <li><a data-toggle="collapse" data-target="#demolibra" href="#">Inicio</a>
                                <ul id="demolibra" class="collapse dropdown-header-top">
                                    <li><a href="{{ route('home') }}">Dashboard</a></li>
                                    @if(\Auth::User()->tipo_user=="Admin")
                                    <li><a href="{{ route('estadisticas') }}">Estadísticas</a></li>
                                    @endif
                                </ul>
                            </li> -->
                            @if((buscar_p('Planificacion','Buscar')=="Si" || buscar_p('Actividades','Ver')=="Si")  && \Auth::User()->email!="ViewMel@licancabur.cl")
                            <li><a data-toggle="collapse" data-target="#planificacion" role="button" aria-expanded="false" aria-controls="planificacion" href="#"><i class="notika-icon notika-calendar"></i> Actividades </a>
                                <ul id="planificacion" class="collapse dropdown-header-top">
                                    @if(buscar_p('Planificación','Buscar')=="Si")
                                    <li><a href="{{ route('planificacion.index') }}">Actividades</a></li>
                                    @endif

                                    @if(buscar_p('Actividades','Asignar')=="Si")
                                    <li><a href="{{ route('asignaciones.index') }}">Asignar Actividades</a></li>
                                    @endif
                                    @if(buscar_p('Actividades','Eliminar')=="Si")
                                        <li>
                                            <a href="{{ route('eliminacion.actividades') }}">Eliminar Actividades</a>
                                        </li>
                                    @endif
                                    <!-- <li><a href="{{ route('asignaciones.create') }}">Actividades asignadas</a></li> -->
                                </ul>
                            </li>
                            @endif
                           @if(buscar_p('Usuarios','Listado')=="Si" && \Auth::User()->email!="ViewMel@licancabur.cl")
                            <li><a data-toggle="collapse" data-target="#Charts" href="{{ route('empleados.index') }}"><i class="notika-icon notika-support"></i> Usuarios </a></li>
                            @endif
                            @if(buscar_p('Graficas','Ver')=="Si" && \Auth::User()->email!="ViewMel@licancabur.cl")
                            <li><a data-toggle="collapse" data-target="#Charts" href="{{ route('graficas.index') }}"><i class="notika-icon notika-star"></i> Gráficas </a></li>
                            @endif
                            @if(buscar_p('Reportes','Excel')=="Si" || buscar_p('Reportes','PDF')=="Si")
                            <li class="{{ active('reportes') }}"><a href="{{ route('reportes.index') }}" ><i class="fa fa-file-archive-o"></i> Reportes </a></li>
                            @endif

                            @if((buscar_p('Areas','Listado')=="Si" || buscar_p('Gerencias','Listado')=="Si" || buscar_p('Departamentos','Listado')=="Si") && \Auth::User()->email!="ViewMel@licancabur.cl")
                            <li>
                                <a data-toggle="collapse" data-target="#configuraciones" role="button" aria-expanded="false" aria-controls="configuraciones" href="#"><i class="fa fa-cogs"></i> Configuraciones </a>
                                <ul id="configuraciones" class="collapse dropdown-header-top">
                                    <li><a href="{{ route('cursos.index') }}">Cursos</a></li>

                                    <li><a href="{{ route('examenes.index') }}">Exámenes</a></li>

                                    <li><a href="{{ route('licencias.index') }}">Licencias</a></li>
                                    
                                    @if(buscar_p('Gerencias','listado')=="Si")
                                    <li><a href="{{ route('gerencias.index') }}">Gerencias</a></li>
                                    @endif

                                    @if(buscar_p('Areas','listado')=="Si")
                                    <li><a href="{{ route('areas.index') }}">Áreas</a></li>
                                    @endif

                                    @if(buscar_p('Departamentos','listado')=="Si")
                                    <li><a href="{{ route('departamentos.index') }}">Departamentos</a></li> 
                                    @endif

                                    @if(\Auth::user()->tipo_user == 'Admin' && \Auth::user()->email != 'adminlicancabur@eiche.cl')
                                        <li><a href="{{ route('privilegios.index') }}">Permisos</a></li>
                                    @endif
                                    @if(\Auth::user()->tipo_user == 'Admin' && \Auth::user()->email != 'adminlicancabur@eiche.cl')
                                        <li><a href="{{ route('respaldos.index') }}">Respaldo de BD</a></li>
                                    @endif
                                </ul>
                            </li>
                            @endif
                            @if(\Auth::User()->tipo_user=="Admin" || buscar_p('Estadisticas','Por Ejecucion')=="Si" || buscar_p('Estadisticas','Por HH')=="Si")
                                <li>
                                    <a data-toggle="collapse" data-target="#estadisticas" role="button" aria-expanded="false" aria-controls="estadisticas" href="#"><i class="fa fa-th-list"></i> Estadísticas</a>
                                    <ul id="estadisticas" class="collapse dropdown-header-top">
                                        <li><a href="{{ route('estadisticas1.index') }}">Por Ejecución</a></li>
                                        <li><a href="{{ route('estadisticasHH') }}">Por HH</a></li>
                                    </ul>
                                </li>
                            @endif
                            <li>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-menu-area mg-tb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <center>
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro" style=" background-color: white;" >
                        <li class="{{ active('home') }}"><a href="{{ route('home') }}" ><i class="notika-icon notika-house"></i> Dashboard </a></li>
                        <!-- <li class="{{ active('home') }} {{ active('estadisticas') }}"><a data-toggle="tab" href="#home"><i class="notika-icon notika-house"></i> Inicio</a></li> -->
                        @if((\Auth::user()->tipo_user == 'Admin' || \Auth::user()->tipo_user == 'Planificacion') && \Auth::user()->email != 'ViewMel@licancabur.cl')
                            <li class="{{ active('planificaciones*') }}">
                                <a href="{{ route('planificaciones.index') }}"> <i class="notika-icon notika-calendar"></i> Planificaciones</a>
                            </li>
                        @endif
                        @if((buscar_p("Planificacion","Buscar")=="Si" || buscar_p("Actividades","Ver")=="Si")  && (\Auth::User()->email!="ViewMel@licancabur.cl"))
                            <li class="{{ active('planificacion') }}"><a data-toggle="tab" href="#planification"><i class="notika-icon notika-calendar"></i> Actividades</a></li>
                        @endif
                        @if(buscar_p('Usuarios','Listado')=="Si" && \Auth::User()->email!="ViewMel@licancabur.cl")
                            <li class="{{ active('empleados') }}"><a href="{{ url('empleados') }}" ><i class="notika-icon notika-support"></i> Usuarios</a></li>
                        @endif
                        @if(buscar_p('Graficas','Ver')=="Si" && \Auth::User()->email!="ViewMel@licancabur.cl")
                            <li class="{{ active('graficas*') }}">
                                <a href="{{ route('graficas.index') }}" ><i class="notika-icon notika-star"></i> Gráficas</a>
                            </li>
                        @endif
                        @if(buscar_p('Reportes','Excel')=="Si" || buscar_p('Reportes','PDF')=="Si")
                            <li class="{{ active('reportes') }}"><a href="{{ route('reportes.index') }}" ><i class="fa fa-file-archive-o"></i> Reportes </a></li>
                        @endif
                        @if(\Auth::user()->tipo_user == 'Admin')
                        <!-- <li><a href="{{ route('avisos.index') }}" ><i class="fa fa-envelope-o"></i> Avisos </a></li> -->
                        @endif
                        @if((buscar_p('Areas','Listado')=="Si" || buscar_p('Gerencias','Listado')=="Si" || buscar_p('Departamentos','Listado')=="Si") && (\Auth::User()->email!="ViewMel@licancabur.cl"))
                            <li class="{{ active('') }}"><a data-toggle="tab" href="#config"><i class="fa fa-cogs"></i> Configuraciones </a></li>
                        @endif
                        @if(buscar_p('Estadisticas','Por Ejecucion')=="Si" || buscar_p('Estadisticas','Por HH')=="Si")
                        <li class="{{ active('estadisticas1') }}"><a data-toggle="tab" href="#estadisticas1"><i class="fa fa-th-list"></i> Estadísticas </a></li>
                        @endif

                        
                    </ul>
                </center>

                <div class="tab-content custom-menu-content">
                    <div id="Home" class="tab-pane in active notika-tab-menu-bg animated flipInX">

                    </div>
                    <!-- <div id="home" class="tab-pane {{ active('home') }} {{ active('estadisticas') }} notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            <li><a href="{{ route('home') }}">Dashboard</a></li>
                            @if(buscar_p('Graficas','Ver')=="Si")
                            <li><a href="{{ route('estadisticas') }}">Estadísticas</a></li>
                            @endif
                        </ul>
                    </div> -->
                    <div id="planification" class="tab-pane {{ active('planificacion') }} notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            @if(buscar_p('Actividades','Ver')=="Si")
                            <li><a href="{{ route('planificacion.index') }}">Actividades</a></li>
                            @endif
                            @if(buscar_p('Actividades','Asignar')=="Si")
                            <li><a href="{{ route('asignaciones.index') }}">Asignar Actividades</a></li>
                            @endif
                            @if(buscar_p('Actividades','Eliminar')=="Si")
                            <li><a href="{{ route('eliminacion.actividades') }}">Eliminar Actividades</a></li>
                            @endif
                            <!-- <li><a href="{{ route('asignaciones.create') }}">Actividades asignadas</a></li> -->
                        </ul>
                    </div>
                    <div id="config" class="tab-pane {{ active('configuraciones') }} notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            @if(buscar_p('Cursos','listado')=="Si")
                            <li><a href="{{ route('cursos.index') }}">Cursos</a></li>
                            @endif
                            @if(buscar_p('Examenes','listado')=="Si")
                            <li><a href="{{ route('examenes.index') }}">Exámenes</a></li>
                            @endif
                            @if(buscar_p('Licencias','listado')=="Si")
                            <li><a href="{{ route('licencias.index') }}">Licencias</a></li>
                            @endif
                            @if(buscar_p('Gerencias','listado')=="Si")
                                <li><a href="{{ route('gerencias.index') }}">Gerencias</a></li>
                            @endif
                            @if(buscar_p('Areas','listado')=="Si")
                                <li><a href="{{ route('areas.index') }}">Áreas</a></li>
                            @endif
                            @if(buscar_p('Departamentos','listado')=="Si")
                                <li><a href="{{ route('departamentos.index') }}">Departamentos</a></li>
                            @endif
                            @if(\Auth::user()->tipo_user == 'Admin' && \Auth::user()->email != 'ViewMel@licancabur.cl')
                                <li><a href="{{ route('privilegios.index') }}">Permisos</a></li>                                
                                <li><a href="{{ route('respaldos.index') }}">Respaldo</a></li>
                            @endif
                        </ul>
                    </div>
                    <div id="estadisticas1" class="tab-pane {{ active('estadisticas1') }} notika-tab-menu-bg animated flipInX">
                        <ul class="notika-main-menu-dropdown">
                            @if(buscar_p('Estadisticas','Por Ejecucion')=="Si")
                            <li><a href="{{ route('estadisticas1.index') }}">Por Ejecución</a></li>
                            @endif
                            @if(buscar_p('Estadisticas','Por HH')=="Si")
                            <li><a href="{{ route('estadisticasHH') }}">Por HH</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@extends('layouts.appLayout')
<input type="hidden" name="tipo_user" id="tipo_user" value="{{\Auth::user()->email}}">
@if(\Auth::user()->tipo_user=="Empleado")
@section('statusarea')

<!-- Start Status area -->
    <div class="notika-status-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">

                        <div class="website-traffic-ctn">
                            <p>Total Duración Real</p><b><span class="counter">{{ $totaldr }}</span></b>
                            <p>Total Duración Proyectada</p><b><span class="counter">{{ $totaldp }}</span></b>
                            <p><b>Todas las Áreas</b></p>
                        </div>
                        <div class="sparkline-bar-stats3">9,4,8,6,5,6,4,8,3,5,9,5</div>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                @php $i=0; @endphp
                @foreach($areas as $key)
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="wb-traffic-inner notika-shadow sm-res-mg-t-30 tb-res-mg-t-30">

                        <div class="website-traffic-ctn">
                            <p>Duración Real</p><b><span>{{ $dr[$i] }}</span></b>
                            <p>Duración Proyectada</p><b><span>{{ $dp[$i] }}</span></b>
                            <p><b>{{ str_limit($key->area,20) }}</b></p>
                        </div>
                        <div class="sparkline-bar-stats3">9,4,8,6,5,6,4,8,3,5,9,5</div>
                    </div>
                </div>
                @if($i % 4 == 1)
                @else
                @endif()
                @php $i++; @endphp
                @endforeach
            </div><hr>
            <center><b style="color: red">Todos los cálculos corresponden a la semana actual (Nro. {{ $num_semana_actual }})</b></center>
            <hr>
        </div>
    </div>
@endsection
@endif
@section('breadcomb')
<!-- Breadcomb area Start-->

{{-- 
<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="scroll_horizontal">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="breadcomb-list">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="breadcomb-wp">
                                    <div class="breadcomb-icon">
                                        <i class="notika-icon notika-star"></i>
                                    </div>
                                    <div class="breadcomb-ctn">
                                        <h2>Horas realizadas</h2>
                                        <hr>
                                        <h2>0</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="breadcomb-list">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="breadcomb-wp">
                                    <div class="breadcomb-icon">
                                        <i class="notika-icon notika-house"></i>
                                    </div>
                                    <div class="breadcomb-ctn">
                                        <h2>Áreas</h2>
                                        <hr>
                                        <h2>0</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="scroll_horizontal">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="breadcomb-list">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="breadcomb-wp">
                                    <div class="breadcomb-icon">
                                        <i class="notika-icon notika-up-arrow"></i>
                                    </div>
                                    <div class="breadcomb-ctn">
                                        <h2>Actividades asignadas</h2>
                                        <hr>
                                        <h2>0</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="breadcomb-list">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="breadcomb-wp">
                                    <div class="breadcomb-icon">
                                        <i class="notika-icon notika-checked"></i>
                                    </div>
                                    <div class="breadcomb-ctn">
                                        <h2>Actividades completadas</h2>
                                        <hr>
                                        <h2>0</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


 --}}

<div class="breadcomb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcomb-list">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <div class="breadcomb-wp">
                                <div class="breadcomb-icon">
                                    <i class="notika-icon notika-calendar"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Crear actividad</h2>
                                    <p>Ver actividades de la semana actual | registrar actividad.</p>
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
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="pull-right">
                                @if(buscar_p('Actividades','Registrar')=="Si" || buscar_p('Actividades','Registro de PM03')=="Si")
                                <button id="actividad" value="0" data-toggle="modal" data-target="#crear_actividad" onclick="
                                $('#muestra_edit').hide();
                                $('#muestra_create').show();
                                $('id_planificacion2').hide();
                                $('id_planificacion').show();
                                $('#mis_archivosMensaje').empty();
                                $('#mis_imagenesMensaje').empty();" class="btn btn-default" data-backdrop="static" data-keyboard="false"><i class="notika-icon notika-edit"></i> Nueva actividad</button>
                                @endif
                            </div>
                        </div>
                        @include('planificacion.modales.crear_actividad')
                        @include('planificacion.modales.cerrar_modal')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcomb area End-->
@endsection



@section('content')
    @if(\Auth::User()->tipo_user=="Empleado")
        @php $nombres="";$apellidos=""; $id_empleado=""; @endphp
        @foreach($empleados as $key)
                @if($key->id_usuario==\Auth::User()->id)
                    @php $nombres=$key->nombres; $apellidos=$key->apellidos; $id_empleado=$key->id;@endphp

                @endif
        @endforeach
        <div class="form-element-area modals-single">
            <div class="container">
                @include('flash::message')
                    <div class="alert alert-default" role="alert" id="message_f">
                        <center><strong><span id="mensaje_f"></span></strong></center>
                        <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> -->
                        <br>
                    </div>
                <div class="widget-tabs-int">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="row" id="vistaBusca" style="display: none;">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    @if(!is_null($planificaciones2))
                                        <label for="busqueda">Seleccione la planificación</label><br>
                                        <div class="form-group">
                                           <select class="form-control select2" name="id_planificacion_b" id="id_planificacion_b" disabled="disabled">
                                            <option selected disabled>Seleccione una planificación</option>
                                            @foreach($planificaciones2 as $item)
                                                <option value="{{$item->id}}">Semana: {{$item->semana}} | {{$item->fechas}} | {{$item->gerencia}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    @if(!is_null($planificaciones2))
                                        <label for="busqueda">Seleccione el área</label><br>
                                        <div class="form-group">
                                           <select name="id_area_b" onchange="limpiarTabla()" id="id_area_b" class="form-control select2" title="Seleccione el área a buscar" disabled="disabled">
                                                <option>Seleccione el área</option>
                                           </select>
                                        </div>
                                    @else
                                        <h3>¡No tiene actividades registradas para este año!</h3>
                                    @endif
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    @if(!is_null($planificaciones2))
                                        <input type="hidden" name="nombres_emp" id="nombres_emp" value="{{ $nombres }}">
                                        <input type="hidden" name="apellidos_emp" id="apellidos_emp" value="{{ $apellidos }}">
                                        <input type="hidden" name="id_empleado" id="id_empleado" value="{{ $id_empleado }}">
                                        <label for="busqueda">Seleccione el día</label><br>
                                        <div class="form-group">
                                           <select name="dia" id="dia_b" class="form-control" title="Seleccione el dia a buscar" disabled="disabled">
                                                <option>Seleccione dia</option>
                                                <option value="3">Miércoles</option>
                                                <option value="4">Jueves</option>
                                                <option value="5">Viernes</option>
                                                <option value="6">Sábado</option>
                                                <option value="0">Domingo</option>
                                                <option value="1">Lunes</option>
                                                <option value="2">Martes</option>
                                           </select>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div id="Cargando2" style="display: none;">
                                <center>
                                    <div id="mensaje3"></div>
                                    <img src="{{ asset('assets/img/tenor2.gif') }}" alt="Logo" height="40px" width="100px;" title="Cargando" />
                                </center>
                                <hr>
                            </div>
                            <div class="tab-hd">
                                <h2>Actividades</h2>
                                <p>Actividades registradas y asignadas al sistema</p>
                            </div>
                            <div class="widget-tabs-list">
                                <ul class="nav nav-tabs tab-nav-center">
                                    <li class="active"><a data-toggle="tab" href="#Act1" onclick="pestana(1);">Actividades de hoy</a></li>
                                    <li><a data-toggle="tab" href="#Act2" onclick="pestana(2);">Buscar Actividades</a></li>
                                </ul>
                                <div class="tab-content tab-custom-st">
                                    <div id="Act2" class="tab-pane fade">
                                        <div class="tab-ctn">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="notika-chat-list notika-shadow tb-res-ds-n dk-res-ds">
                                                        <div class="card-box">
                                                            <div class="chat-conversation">
                                                                <div class="chat-widget-input">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            <div class="data-table-list">
                                                                                <div class="table-responsive">
                                                                                    <div class="data-table-list">
                                                                                        <div class="table-responsive">
                                                                                            <div class="todoapp" id="todoapp" class="overflow-auto">
                                                                                                <div class="scrollbar scrollbar-primary">
                                                                                                    <table id="data-table-basic2" class="table table-striped">
                                                                                                        
                                                                                                    </table>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="Act1" class="tab-pane fade in active">
                                        <div class="tab-ctn">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="add-todo-list notika-shadow ">
                                                        <div class="realtime-ctn">
                                                            <div class="realtime-title">
                                                                <h2>Actividades del día de hoy</h2>
                                                            </div>
                                                        </div>
                                                        <div class="card-box">
                                                            <div class="todoapp" id="todoapp" class="overflow-auto">
                                                                <div class="scrollbar scrollbar-primary">
                                                                    <table id="data-table-basic" class="table table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>Task</th>
                                                                                <!-- <th>Descripción</th> -->
                                                                                <th data-toggle="tooltip" data-placement="top" title="Duración Proyectada" >DP</th>
                                                                                <th data-toggle="tooltip" data-placement="top" title="Duración Real" >DR</th>
                                                                                <th data-toggle="tooltip" data-placement="top" title="Fecha para ser realizada la actividad" >Fecha</th>
                                                                                <th>Día</th>
                                                                                <th>Área</th>
                                                                                <th>Departamento</th>
                                                                                <th>Tipo</th>
                                                                                <th>Realizada</th>
                                                                                <th data-toggle="tooltip" data-placement="top" title="Comentarios realizados al finalizar la actividad" >Comentarios</th>
                                                                                <th>Observaciones</th>
                                                                                <th>Acciones</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            @foreach($buscar as $key)
                                                                                <tr>
                                                                                    <td>{{$num=$num+1}}</td>
                                                                                    <td>{{$key->task}}</td>
                                                                                    {{--<td>{{ $key->descripcion </td>--}}
                                                                                    <td>{{$key->duracion_pro}}</td>
                                                                                    <td>{{$key->duracion_real}}</td>
                                                                                    <td>{{$key->fecha_vencimiento}}</td>
                                                                                    <td>{{$key->dia}}</td>
                                                                                    <td>{{$key->area}}</td>
                                                                                    <td>{{$key->departamento}}</td>
                                                                                    <td>{{$key->tipo}}</td>
                                                                                    <td>{{$key->realizada}}</td>
                                                                                    <td>{{ comentarios_actividad($key->id) }}</td>
                                                                                    <td>{{ $key->observacion1 }}<br>{{ $key->observacion2 }}</td>
                                                                                    <td>
                                                                                        <button data-target="#myModaltwoFinal" onclick="enviar_id('{{$key->id}}','{{$key->duracion_pro}}','{{$key->id_departamento}}')" data-toggle="modal">Finalizar</button>
                                                                                        <button class="btn btn-success" data-target="#VerArchivos" onclick="mostrarArchivos('{{$key->id}}')" data-toggle="modal">Ver archivos</button>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach()
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                            
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>


    @elseif(\Auth::User()->tipo_user!=="Empleado")
        <!-- Form Element area Start-->
        <div class="form-element-area modals-single">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-element-list">
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
                            
                            
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="widget-tabs-int">                                
                                        <div class="widget-tabs-list">
                                            <ul class="nav nav-tabs tab-nav-center">
                                                <li class="active"><a data-toggle="tab" href="#home">Actividades</a></li>
                                                <!-- <li><a data-toggle="tab" href="#menu1">Actividades asignadas</a></li> -->
                                            </ul>
                                            <div class="tab-content tab-custom-st">
                                                <div class="widget-tabs-int">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="row" >
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                    <label for="busqueda">Seleccione la planificación</label><br>
                                                                    <div class="form-group">
                                                                       <select class="form-control select2" name="id_planificacion_b" id="id_planificacion_b2">
                                                                        <option value="0">Seleccione una planificación</option>
                                                                        @foreach($planificaciones as $item)
                                                                            <option value="{{$item->id}}">Semanas: {{$item->semana}} | {{$item->fechas}} | {{$item->gerencias->gerencia}}</option>
                                                                        @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                    <label for="busqueda">Seleccione el área</label><br>
                                                                    <div class="form-group">
                                                                       <select name="id_area_b" id="id_area_b2" class="form-control select2" title="Seleccione el área a buscar" disabled="disabled">
                                                                            
                                                                       </select>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <hr>
                                                            <div id="Cargando" style="display: none;">
                                                                <center>
                                                                    <div id="mensaje2"></div>
                                                                    <img src="{{ asset('assets/img/tenor2.gif') }}" alt="Logo" height="40px" width="100px;" title="Cargando" />
                                                                </center>
                                                                <hr>
                                                            </div>
                                                            <!-- <div id="mensaje2"></div> -->
                                                            <div class="scrollbar scrollbar-primary">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                       <table id="data-table-basic3" class="table table-striped">
                                                                             
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif

    @include('planificacion.modales.eliminar')
    @include('planificacion.modales.asignar_tarea')
    @include('planificacion.modales.clave_root_eliminar')
    @include('planificacion.modales.ver_actividad')
    @include('planificacion.modales.cambiar_status_actividad')
    @include('planificacion.modales.VerArchivos')
    @include('planificacion.modales.VerImagen')
    @include('partials.modalActividades')

    @endsection

@section('scripts')
<script type="text/javascript">

    function limpiarTabla() {
        $("#data-table-basic2").empty();
    }


    function pestana(num) {
        if(num==1){
            $('#vistaBusca').fadeOut('slow');
            $('#dia_b').prop('disabled',true);
            $('#id_area_b').prop('disabled',true);
            $('#id_planificacion_b').prop('disabled',true);
        }else{
            $('#vistaBusca').fadeIn(300);
            // $('#dia_b').prop('disabled',false);
            $('#id_area_b').prop('disabled',false);
            $('#id_planificacion_b').prop('disabled',false);
        }
    }
    //console.log("+++++++++++++++++++++++++");
    function ModalTwo(){
        $('#myModaltwo').modal('hide');
        $('#myModaltwo').on('hidden', function () {
            $('#claverrot').modal('show')
        });
    }
</script>
<script type="text/javascript">
    //console.log("------------------------------");
$(document).ready( function(){
    
    
    $("#cambiar_s").on("change",function (event) {
        var status=event.target.value;
        if (status == 1) {
            $('#duracion_real_f').prop('disabled',true).prop('required', false);
            $('#comentario_f').prop('disabled',true).prop('required', false);
            $('#id_departamento_s').prop('disabled',true).prop('required', false);
        } else {
            $('#duracion_real_f').prop('disabled',false).prop('required', true);
            $('#comentario_f').prop('disabled',false).prop('required', true);
            $('#id_departamento_s').prop('disabled',false).prop('required', true);
        }

    });
    //console.log("obj");
    //------ realizando busqueda de las actividades deacuerdo al filtro
        //select dinámico
        $("#id_gerencia_search").on("change",function (event) {
            //console.log("select dinámico");
            var id_gerencia=event.target.value;
            
            $.get("/planificacion/"+id_gerencia+"/buscar",function (data) {
                
                $("#id_area_search").empty();
            
            if(data.length > 0){
                for (var i = 0; i < data.length ; i++) 
                {  
                    $("#id_area_search").removeAttr('disabled');
                    $("#id_area_search").append('<option value="'+ data[i].id + '">' + data[i].area +'</option>');
                }
            }else{
                
                $("#id_area_search").attr('disabled', false);
            }
            });
        });
        
    //-----------------------------------------
    
    $("#id_planificacion").attr('multiple',true);
    $('#id_planificacion').prop('disabled',false).prop('required', true);
    $('#id_planificacion').replaceWith($('#id_planificacion').clone().attr('name', 'id_planificacion[]'));
    
    $("#tipo1").on('change',function (event) { 
   // console.log("entro");
        $("#id_departamento").empty();
        $("#id_departamento").append("<option value='1'>Ninguno</option>");

        var tipo1=event.target.value;        
        if (tipo1=="PM02") {
            $(".ra_dia").attr('name','dia[]');
            $(".ar_dia").removeAttr('name');
            $("#pm02").removeAttr('style');
            $("#departamentos").css('display','none');
            $('#id_departamento').prop('disabled',true).prop('required', false);
        }else{
            if (tipo1=="PM03") {
                $('#id_departamento').prop('disabled',false).prop('required', true);
                var id_departamento;
                $.get("/actividades/"+id_departamento+"/buscar_departamentos",function (data) {
                    if (data.length>0) {
                        $("#id_departamento").empty();
                        $("#departamentos").css('display','block');
                        for (var i = 0; i < data.length; i++) {
                            console.log(data[i].id+"asasas");
                            $("#id_departamento").append("<option value='"+data[i].id+"'>"+data[i].departamento+"</option>");
                        }
                    }
                });

                // $("#id_departamentos").empty();
                // $("#departamentos option").attr('selected',true);
            } else{
                $("#departamentos").css('display','none');
                // $("#departamentos option").attr('selected',true);
                // $("#id_departamentos").empty();
            }
            $(".ar_dia").removeAttr('name');
            $(".ra_dia").attr('name','dia[]');
            $("#registrar_actividad").css('display','block');
            $("#actividad_registrada").css('display','none');
            $("#pm02").css('display','none');
            $("#des_actividad").removeAttr('style');
            $("#areas").css('display','block');
            $("#tab2").removeAttr('style');
        }
    });
    $("#id_actividad").on('change',function (event) {
        //console.log("act");     
        var id_actividad=event.target.value;
        
        if (id_actividad!=="0") {
            var id_actividad;
            $.get("/actividades/"+id_actividad+"/buscar_actividad_registrada",function (data) {
                console.log("Actividad registrada");
                $("#ver_task1").text(data.task);
                if (data.duracion_pro==null) {
                    $('#ver_duracion_pro1').empty();
                    $("#ver_duracion_pro1").append('<span></span>');
                } else {
                    $("#ver_duracion_pro1").text(data.duracion_pro);
                }
                $("#ver_cant_personas1").text(data.cant_personas);
                if (data.observacion2==null) {
                    $('#ver_observacion2').empty();
                    $("#ver_observacion2").append('<span>Esta actividad no posee observación y/o comentario.</span>');
                } else {
                    $("#ver_observacion2").text(data.observacion2);
                }
                if (data.dia=="Mié") {
                    $("#ar_mie").prop('checked',true);
                    if($("#ar_jue").val()!=data.dia && $("#ar_vie").val()!=data.dia && $("#ar_sab").val()!=data.dia && $("#ar_dom").val()!=data.dia && $("#ar_lun").val()!=data.dia && $("#ar_mar").val()!=data.dia){     
                        $("#ar_jue").prop('checked',false);
                        $("#ar_vie").prop('checked',false);
                        $("#ar_sab").prop('checked',false);
                        $("#ar_dom").prop('checked',false);
                        $("#ar_lun").prop('checked',false);
                        $("#ar_mar").prop('checked',false);
                    }
                } else if (data.dia=="Jue") { 
                    $("#ar_jue").prop('checked',true);
                    if($("#ar_mie").val()!=data.dia && $("#ar_vie").val()!=data.dia && $("#ar_sab").val()!=data.dia && $("#ar_dom").val()!=data.dia && $("#ar_lun").val()!=data.dia && $("#ar_mar").val()!=data.dia){     
                        $("#ar_mie").prop('checked',false);
                        $("#ar_vie").prop('checked',false);
                        $("#ar_sab").prop('checked',false);
                        $("#ar_dom").prop('checked',false);
                        $("#ar_lun").prop('checked',false);
                        $("#ar_mar").prop('checked',false);
                    }
                } else if (data.dia=="Vie") {
                    $("#ar_vie").prop('checked',true);
                    if($("#ar_mie").val()!=data.dia && $("#ar_jue").val()!=data.dia && $("#ar_sab").val()!=data.dia && $("#ar_dom").val()!=data.dia && $("#ar_lun").val()!=data.dia && $("#ar_mar").val()!=data.dia){     
                        $("#ar_mie").prop('checked',false);
                        $("#ar_jue").prop('checked',false);
                        $("#ar_sab").prop('checked',false);
                        $("#ar_dom").prop('checked',false);
                        $("#ar_lun").prop('checked',false);
                        $("#ar_mar").prop('checked',false);
                    }
                } else if (data.dia=="Sáb") {
                    $("#ar_sab").prop('checked',true);
                    if($("#ar_mie").val()!=data.dia && $("#ar_jue").val()!=data.dia && $("#ar_vie").val()!=data.dia && $("#ar_dom").val()!=data.dia && $("#ar_lun").val()!=data.dia && $("#ar_mar").val()!=data.dia){     
                        $("#ar_mie").prop('checked',false);
                        $("#ar_jue").prop('checked',false);
                        $("#ar_vie").prop('checked',false);
                        $("#ar_dom").prop('checked',false);
                        $("#ar_lun").prop('checked',false);
                        $("#ar_mar").prop('checked',false);
                    }
                } else if (data.dia=="Dom") {
                    $("#ar_dom").prop('checked',true);
                    if($("#ar_mie").val()!=data.dia && $("#ar_jue").val()!=data.dia && $("#ar_vie").val()!=data.dia && $("#ar_sab").val()!=data.dia && $("#ar_lun").val()!=data.dia && $("#ar_mar").val()!=data.dia){     
                        $("#ar_mie").prop('checked',false);
                        $("#ar_jue").prop('checked',false);
                        $("#ar_vie").prop('checked',false);
                        $("#ar_sab").prop('checked',false);
                        $("#ar_lun").prop('checked',false);
                        $("#ar_mar").prop('checked',false);
                    }
                } else if (data.dia=="Lun") {
                    $("#ar_lun").prop('checked',true);
                    if($("#ar_mie").val()!=data.dia && $("#ar_jue").val()!=data.dia && $("#ar_vie").val()!=data.dia && $("#ar_dom").val()!=data.dia && $("#ar_sab").val()!=data.dia && $("#ar_mar").val()!=data.dia){     
                        $("#ar_mie").prop('checked',false);
                        $("#ar_jue").prop('checked',false);
                        $("#ar_vie").prop('checked',false);
                        $("#ar_sab").prop('checked',false);
                        $("#ar_dom").prop('checked',false);
                        $("#ar_mar").prop('checked',false);
                    }
                } else if (data.dia=="Mar") {
                    $("#ar_mar").prop('checked',true);
                    if($("#ar_mie").val()!=data.dia && $("#ar_jue").val()!=data.dia && $("#ar_vie").val()!=data.dia && $("#ar_dom").val()!=data.dia && $("#ar_lun").val()!=data.dia && $("#ar_sab").val()!=data.dia){     
                        $("#ar_mie").prop('checked',false);
                        $("#ar_jue").prop('checked',false);
                        $("#ar_vie").prop('checked',false);
                        $("#ar_sab").prop('checked',false);
                        $("#ar_dom").prop('checked',false);
                        $("#ar_lun").prop('checked',false);
                    }
                }
                switch(data.dia){
                    case 'Mié':
                        $("#miercoles_ar").prop('checked',true);
                    break;
                    case 'Jue':
                        $("#jueves_ar").prop('checked',true);
                    break;
                    case 'Vie':
                        $("#viernes_ar").prop('checked',true);
                    break;
                    case 'Sáb':
                        $("#sabado_ar").prop('checked',true);
                    break;
                    case 'Dom':
                        $("#domingo_ar").prop('checked',true);
                    break;
                    case 'Lun':
                        $("#lunes_ar").prop('checked',true);
                    break;
                    case 'Mar':
                        $("#martes_ar").prop('checked',true);
                    break;
                }
            });
                //$("#areas").css('display','none');
                //$("#des_actividad").css('display','none');
                //$("#des_actividad").empty();
                //$("#des_actividad").detach();
                //$("#tab2").css('display','none');
                $("#actividad_registrada").css('display','block');
                $("#registrar_actividad").css('display','none');
                $("#task1").removeAttr('required');
                $(".ra_dia").removeAttr('name');
                $(".ar_dia").attr('name','dia[]');
                $("#cant_personas1").removeAttr('required');
        }else{
            console.log("Registrar Actividad");
            $(".ar_dia").removeAttr('name');
            $(".ra_dia").attr('name','dia[]');
            //console.log("entra");
            $("#areas").css('display','block');
            //$("#tab2").removeAttr('style');
            $("#registrar_actividad").css('display','block');
            $("#actividad_registrada").css('display','none');
            $("#des_actividad").removeAttr('style');
            //$("#des_actividad").css('display','block');
            
        }
    });

    $("#actividad").on('click',function (event) {
        
        var actividad=event.target.value;
        //console.log("index");
        if (actividad==0) {
            $("#accion").text('Registrar');
            $('#MuestraArchivos2').empty();
            $('#MuestraImagenes2').empty();
            $("#accion2").text('registro');
            $("#accion3").text('registro');
            $("#accion4").text('registro');
            $("#id_actividad_act").val("");
        }
//---------------------------------------------DISPLAY CHECK AND NONE RADIO
            $("#area_radio").css('display','none');
            $("#area_radio1").css('display','none');
            $("#area_radio2").css('display','none');
                $("#miercoles_r").prop('disabled',true);
                $("#jueves_r").prop('disabled',true);
                $("#viernes_r").prop('disabled',true);
                $("#sabado_r").prop('disabled',true);
                $("#domingo_r").prop('disabled',true);
                $("#lunes_r").prop('disabled',true);
                $("#martes_r").prop('disabled',true);
            $("#area_check").css('display','block');
                $("#mie").prop('disabled',false);
                $("#jue").prop('disabled',false);
                $("#vie").prop('disabled',false);
                $("#sab").prop('disabled',false);
                $("#dom").prop('disabled',false);
                $("#lun").prop('disabled',false);
                $("#mar").prop('disabled',false);
//------FINISH
    // $("#mie").replaceWith($('#mie').clone().attr('type', 'checkbox'));
    // $("#jue").replaceWith($('#jue').clone().attr('type', 'checkbox'));
    // $("#vie").replaceWith($('#vie').clone().attr('type', 'checkbox'));
    // $("#sab").replaceWith($('#sab').clone().attr('type', 'checkbox'));
    // $("#dom").replaceWith($('#dom').clone().attr('type', 'checkbox'));
    // $("#lun").replaceWith($('#lun').clone().attr('type', 'checkbox'));
    // $("#mar").replaceWith($('#mar').clone().attr('type', 'checkbox'));
    });
    // var id_departamento;
    // alert(id_departamento);

    // $.get("/actividades/"+id_departamento+"/buscar_departamentos",function (data) {
    //     if (data.length>0) {
    //         $("#id_departamento").empty();
    //         for (var i = 0; i < data.length; i++) {
    //             console.log(data[i].id+"asasas");
    //             $("#id_departamento").append("<option value='"+data[i].id+"'>"+data[i].departamento+"</option>");
    //         }
    //     }
    // });
});
function editar_act(id_actividad) {
        $('#rootwizard').hide();
        $('#Cargando_edit').show();
        $("#accion").text('Editar');
        $('#crear_actividad').modal('show');
        $("#id_actividad_act").val(id_actividad);
        $("#muestra_edit").show();
        $("id_planificacion2").show();
        $("#muestra_create").hide();
        $("id_planificacion").hide();
        $('#id_planificacion').prop('disabled',true).prop('required', false);
        
        $.get("/actividades/"+id_actividad+"/edit",function (data) {
                
            // $('#ModalEditarActividad').append(
            //     '<div class="wizard-hd">'+
            //         '<h1 class="text-center">Actualizar actividad</h1>'+
            //         '<div class="text-center">'+
            //             '<small class="text-center">Los campos con un (<span style="color:red">*</span>) son obligatorios</small>'+
            //         '</div>'+
            //     '</div>'
            // );

                //console.log(data[0].area);
                //agregando tipo en select
                $("#tipo1").empty();
                switch(data[0].tipo){
                    case 'PM01':
                        $("#pm02").css('display','none');
                        $("#tipo1").append('<option value="PM01" selected="selected">PM01</option>');
                        $("#tipo1").append('<option value="PM02">PM02</option>');
                        $("#tipo1").append('<option value="PM03">PM03</option>');
                    break;
                    case 'PM02':
                        $("#pm02").removeAttr('style');
                        $("#reg_act").css('display','none');
                        $("#tipo1").append('<option value="PM01">PM01</option>');
                        $("#tipo1").append('<option value="PM02" selected="selected">PM02</option>');
                        $("#tipo1").append('<option value="PM03">PM03</option>');
                    break;
                    case 'PM03':
                        $("#pm02").css('display','none');
                        $("#tipo1").append('<option value="PM01">PM01</option>');
                        $("#tipo1").append('<option value="PM02">PM02</option>');
                        $("#tipo1").append('<option value="PM03" selected="selected">PM03</option>');
                    break;
                    case 'PM04':
                        $("#pm02").css('display','none');
                        $("#tipo1").append('<option value="PM01">PM01</option>');
                        $("#tipo1").append('<option value="PM02">PM02</option>');
                        $("#tipo1").append('<option value="PM03">PM03</option>');
                        $("#tipo1").append('<option value="PM04" selected="selected">PM04</option>');
                    break;
                }

                // para el área
                seleccionando_area_editar(data[0].id_area);

                //seleccionando opcion de actividades
                seleccionando_planificacion_editar(data[0].id_planificacion);
            
                
            $("#observacion1").val(data[0].observacion1);
            $("#observacion2").val(data[0].observacion2);
            // $("#id_planificacion").attr('multiple',false);
            $('#id_planificacion2').val(data[0].id_planificacion);
            // $('#id_planificacion2').val($('#id_planificacion').clone().attr('name', 'id_planificacion'));
            
            // $("#id_planificacion2 option").each(function(){
            //     if ($(this).val()==data[0].id_planificacion) {
                
            //         $(this).attr("selected",true);
            //     }
            // });
            $("#id_area option").each(function(){
                if ($(this).val()==data[0].id_area) {
                
                    $(this).attr("selected",true);
                }
            });
            //campos en caracteristicas
            $("#task1").val(data[0].task);
            // $("#descripcion").val(data[0].descripcion);

            //$("#duracion_real").val(data[0].duracion_real);
            $("#duracion_pro_edit").val(data[0].duracion_pro);
            //console.log($("#duracion_pro").val()+'mmmmmmm');
            $("#cant_personas1").val(data[0].cant_personas);
            $("#observacion2").val(data[0].observacion2);
            
            /*$('input:radio[name=dia]').each(function() { 
                
                
                if($('input:radio[name=dia]').is(':checked')) {  
                    $('input:radio[name=dia]').attr('checked', false);
                } else {  
                    $('input:radio[name=dia]').attr('checked', false);
                }
            });*/
//------------------------------------------------------------------DISPLAY RADIO AND NONE CHECK
            $("#area_radio").css('display','block');
            $("#miercoles_r").prop('disabled',false);
            $("#jueves_r").prop('disabled',false);
            $("#viernes_r").prop('disabled',false);
            $("#sabado_r").prop('disabled',false);
            $("#domingo_r").prop('disabled',false);
            $("#lunes_r").prop('disabled',false);
            $("#martes_r").prop('disabled',false);
            switch(data[0].dia){
                case 'Mié':
                    $("#miercoles_r").prop('checked',true);
                break;
                case 'Jue':
                    $("#jueves_r").prop('checked',true);
                break;
                case 'Vie':
                    $("#viernes_r").prop('checked',true);
                break;
                case 'Sáb':
                    $("#sabado_r").prop('checked',true);
                break;
                case 'Dom':
                    $("#domingo_r").prop('checked',true);
                break;
                case 'Lun':
                    $("#lunes_r").prop('checked',true);
                break;
                case 'Mar':
                    $("#martes_r").prop('checked',true);
                break;
            }
            $("#area_check").css('display','none');
            $(".area_check").css('display','none');
                $("#ar_mie").prop('disabled',true);
                $("#ar_jue").prop('disabled',true);
                $("#ar_vie").prop('disabled',true);
                $("#ar_sab").prop('disabled',true);
                $("#ar_dom").prop('disabled',true);
                $("#ar_lun").prop('disabled',true);
                $("#ar_mar").prop('disabled',true);

                $("#mie").prop('disabled',true);
                $("#jue").prop('disabled',true);
                $("#vie").prop('disabled',true);
                $("#sab").prop('disabled',true);
                $("#dom").prop('disabled',true);
                $("#lun").prop('disabled',true);
                $("#mar").prop('disabled',true);

                $("#mie_e").prop('disabled',true);
                $("#jue_e").prop('disabled',true);
                $("#vie_e").prop('disabled',true);
                $("#sab_e").prop('disabled',true);
                $("#dom_e").prop('disabled',true);
                $("#lun_e").prop('disabled',true);
                $("#mar_e").prop('disabled',true);
//------FINISH
            if (dia == "Mié") {
                $("#miercoles_r").prop('checked',true);
            }
            if (dia == "Jue") {
                $("#jueves_r").prop('checked',true);
            }
            if (dia == "Vie") {
                $("#viernes_r").prop('checked',true);
            }
            if (dia == "Sáb") {
                $("#sabado_r").prop('checked',true);
            }
            if (dia == "Dom") {
                $("#domingo_r").prop('checked',true);
            }
            if (dia == "Lun") {
                $("#lunes_r").prop('checked',true);
            }
            if (dia == "Mar") {
                $("#martes_r").prop('checked',true);
            }
            if($("#mie").val()==data[0].dia){
                
                $("#mie").prop('checked',true);
            }
            if($("#jue").val()==data[0].dia){
                
                $("#jue").prop('checked',true);
            }
            if($("#vie").val()==data[0].dia){
                
                $("#vie").prop('checked',true);
            }
            if($("#sab").val()==data[0].dia){
                
                $("#sab").prop('checked',true);
            }
            if($("#dom").val()==data[0].dia){
                
                $("#dom").prop('checked',true);
            }
            if($("#lun").val()==data[0].dia){
                
                $("#lun").prop('checked',true);
            }
            if($("#mar").val()==data[0].dia){
                
                $("#mar").prop('checked',true);
            }
            
            //console.log(data[0].dia);
            
            });
            //mostrando archivos cargadas a la actividad
            $.get("actividades/"+id_actividad+"/mis_imagenes",function (data) {

        })
        .done(function(data) {
            console.log(data);
            if(data.length>0){
                for (var i = 0; i < data.length; i++) {
                    
                    $('#MuestraImagenes2').append(
                        '<div style="overflow-x: auto;">'+
                            '<img style="width:100%;" src="'+data[i].url+'">'+
                        '<div>'+
                        '<div id="archivo"><div class="alert alert-info" role="alert">"'+data[i].nombre+'" <a class="btn btn-danger pull-right" onclick="eliminar_archivo("'+data[i].id+'",1)"><i class="fa fa-trash" ></i> Eliminar</a></div>'
                    );
                    $('#MuestraImagen').append('<img src="'+data[i].url+'">');
                }

            }else{
                    $('#MuestraImagenes2').append('<div style="overflow-x: auto;"><p>La actividad no tiene imágenes registradas</p></div>');
            }
        });

        $.get("actividades/"+id_actividad+"/mis_archivos",function (data) {

        })
        .done(function(data) {
            if(data.length>0){
                for (var i = 0; i < data.length; i++) {
                    $('#MuestraArchivos2').append(
                        '<div class="row">'+
                            '<div class="col-md-8">'+
                                '<a class="btn btn-primary rounded" href="'+data[i].url+'">'+
                                    '<i class="fa fa-file"></i>  '+data[i].nombre+
                                '</a>'+
                            '</div>'+
                            '<div class="col-md-4">'+
                                '<a class="btn btn-danger pull-right" onclick="eliminar_archivo("'+data[i].id+'",2)"><i class="fa fa-trash"></i></a>'+
                            '</div>'+
                        '</div>'

                    );
                }

            }else{
                    $('#MuestraArchivos2').append('<p>La actividad no tiene archivos registrados</p>');
            }
            $('#CargandoArchivos').css('display','none');
            $('#mensajeArchivos').empty();
        });
            //mostrando imágenes cargadas a la actividad
            $.get("actividades/"+id_actividad+"/mis_imagenes",function (data) {

        })
        .done(function(data) {
            if(data.length>0){
                for (var i = 0; i < data.length; i++) {
                    
                    $('#MuestraImagenes').append('<div style="overflow-x: auto;">'+
                        '<a href="#" onclick="VerImagen()">'+
                            '<img style="width:100%;" src="'+data[i].url+'">'+
                        '</a><div>'
                    );
                    $('#MuestraImagen').append('<img style="width:100%" src="'+data[i].url+'">');
                }

            }else{
                    $('#MuestraImagenes').append('<div style="overflow-x: auto;"><p>La actividad no tiene imágenes registradas</p></div>');
            }
        })
        .always(function() {
            $('#Cargando_edit').hide();
            $('#rootwizard').show();
        });

        $.get("actividades/"+id_actividad+"/mis_archivos",function (data) {

        })
        .done(function(data) {
            if(data.length>0){
                for (var i = 0; i < data.length; i++) {
                    $('#MuestraArchivos').append('<a class="btn btn-primary rounded" href="'+data[i].url+'"><i class="fa fa-file"></i>  '+data[i].nombre+'</a><br>');
                }

            }else{
                    $('#MuestraArchivos').append('<p>La actividad no tiene archivos registrados</p>');
            }
            $('#CargandoArchivos').css('display','none');
            $('#mensajeArchivos').empty();
        });
}//fin de la función editar_act
function seleccionando_area_editar(id_area) {
        var seleccionar="";

        $.get("/buscar_areas/"+id_area+"/editar",function (data) {
                if (data.length!=0) {
                    $("#id_area").empty();
                    for (var i = 0; i < data.length; i++) {
                        if (id_area==data[i].id) {
                            seleccionar=" selected='selected'";
                        }
                        $("#id_area").append("<option "+seleccionar+" value='"+data[i].id+"'>"+data[i].area+"</option>");
                        seleccionar="";
                    }

                }
        });
}
function seleccionando_planificacion_editar(id_planificacion) {
        var seleccionar="";

        $.get("/buscar_planificacion/"+id_planificacion+"/editar",function (data) {
                if (data.length!=0) {
                    $("#id_planificacion2").empty();
                    for (var i = 0; i < data.length; i++) {
                        if (id_planificacion==data[i].id) {
                            seleccionar=" selected='selected'";
                        }
                        $("#id_planificacion2").append("<option "+seleccionar+" value='"+data[i].id+"'>Semana: "+data[i].semana+" | "+data[0].fechas+" | "+data[0].gerencia+"</option>");
                        seleccionar="";
                    }
                }
        });
}
function eliminar_archivo(id_archivo,tipo) {
        var xtipo=tipo;
        //console.log(tipo);
    $.get("/actividades/"+id_archivo+"/eliminar_archivos",function (data) {
                if (data.length!=0) {
                    if (xtipo==1) {
                        //console.log("cuando es archivo");
                    $("#archivos_cargados").css('display','none');
                    $("#mis_archivos").empty();
                    setTimeout(function() { $("#archivos_cargados").show(); }, 3000);
                    $('.archivos_cargados').show("slow");
                    }else{
                    $("#imagenes_cargados").css('display','none');
                    $("#mis_imagenes").empty();
                    setTimeout(function() { $("#imagenes_cargados").show(); }, 1000);
                    }
                    for (var i = 0; i < data.length; i++) {
                                                   
                    if (data[i].tipo=="file") {
                        $("#mis_archivos").append("<li><div class='alert alert-info' role='alert'>"+data[i].nombre+" <a class='btn btn-danger pull-right'  onclick='eliminar_archivo("+data[i].id+",1)'><i class='fa fa-trash' style='color:;'></i> Eliminar</a></div></li>");
                        $("#archivo").css('display','none');
                    } else {
                        $("#mis_imagenes").append("<li id='imagen_eliminar'><div class='alert alert-info' role='alert'><img src='{!! asset('"+ data[i].url +"') !!}' height='100px' width='100px'><a class='btn btn-danger pull-right'   onclick='eliminar_archivo("+data[i].id+",2)'><i class='fa fa-trash' style='color:;'></i> Eliminar</a></div></li>");
                    }
                    }
                }else{
                        //console.log("cuando es 0 data");
                    if (xtipo==1) {
                    $("#archivos_cargados").css('display','none');
                    $("#mis_archivos").empty();
                    
                    }else{
                    $("#imagenes_cargados").css('display','none');
                    $("#mis_imagenes").empty();
                    }
                }
    });
}
function asignar(id_actividad,id_area) {
    $('#vista_asigna').css('display', 'none');
    $('#Cargando_asigna').css('display','block');
    $('#mensaje_asigna').append('<h3><strong>Cargando empleados. Por favor, espere...</strong></h3>');

    $.get("/empleados/"+id_area+"/buscar",function (datos) {
        $("#id_actividad_asig").val(id_actividad);
        $("#tarea").text($('#task'+id_actividad).val());
        if (datos.length>0) {
            $("#id_empleado").empty();
            for (var i = 0; i < datos.length; i++) {
                $("#id_empleado").append('<option value="'+datos[i].id+'">'+datos[i].apellidos+', '+datos[i].nombres+' RUT: '+datos[i].rut+'</option>');
            }

            if (i == datos.length) {
                // $('#Cargando_asigna').css('display','none');

                $('#Cargando_asigna').fadeOut('slow',
                    function() { 
                        $('#mensaje_asigna').empty();
                        $(this).hide();
                        $('#vista_asigna').fadeIn(300);
                });

            }
        }
    });
}
function eliminar(id_actividad) {
        $("#id_actividad_eliminar").val(id_actividad);
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
<script type="text/javascript">
    function status(id_usuario) {
        //console.log(id_usuario+"----");
        $("#id_empleado").val(id_usuario);
    }


    $("#id_planificacion_b").on("change",function (event) {

        $('#dia_b').empty();
        $('#dia_b').append(
            '<option>Seleccione dia</option>'+
            '<option value="3">Miércoles</option>'+
            '<option value="4">Jueves</option>'+
            '<option value="5">Viernes</option>'+
            '<option value="6">Sábado</option>'+
            '<option value="7">Domingo</option>'+
            '<option value="1">Lunes</option>'+
            '<option value="2">Martes</option>'
            );
        $('#dia_b').prop('disabled',true);
        $("#data-table-basic2").empty();
        $('#Cargando2').css('display','block');
        $('#mensaje3').append('<h3><strong>Cargando áreas. Por favor, espere...</strong></h3>');

        var id_planificacion=event.target.value;
        $.get("/asignaciones/"+id_planificacion+"/buscar",function (data) {

        })
        .done(function(data) {
            $('#mensaje3').empty();
            $('#Cargando2').css('display','none');
            $("#id_area_b").empty();
            $("#id_area_b").append('<option selected disabled>Seleccione un área</option>');
        
            if(data.length > 0){

                for (var i = 0; i < data.length ; i++) 
                {  
                        
                    
                    $("#id_area_b").append('<option value="'+ data[i].id + '">' + data[i].area +'</option>');
                    $("#id_area_b2").append('<option value="'+ data[i].id + '">' + data[i].area +'</option>');
                }

            }else{
                $("#id_area_b").attr('disabled', false);

            }
        });

        // window.location.reload(true);
    });

    $("#id_planificacion_b2").on("change",function (event) {

        $("#data-table-basic3").empty();
        $('#Cargando').css('display','block');
        $('#mensaje2').append('<h3><strong>cargando áreas. Por favor, espere...</strong></h3>');
        // window.location.reload(true);
        // location.reload(true);
        var id_planificacion=event.target.value;
        $.get("/asignaciones/"+id_planificacion+"/buscar",function (data) {

        })
        .done(function(data) {
            $('#Cargando').css('display','none');
            $('#mensaje2').empty();
            $("#id_area_b2").empty();
            $("#id_area_b2").append('<option value="0">Seleccione un área</option>');
        
            if(data.length > 0){
                $("#id_area_b2").attr('disabled', false);
                for (var i = 0; i < data.length ; i++) 
                {  
                        
                    
                    $("#id_area_b2").append('<option value="'+ data[i].id + '">' + data[i].area +'</option>');
                }

            }else{
                $("#id_area_b2").attr('disabled', true);

            }

        });

        // window.location.reload(true);
    });

    $("#id_area_b").on("change",function (event) {
        $("#data-table-basic2").empty();
        $('#dia_b').empty();
        var id_planificacion= $('#id_planificacion_b').val();
        var id_area= $('#id_area_b').val();

        // if (id_area>0) {
        //     $('#dia_b').removeAttr('disabled',false);
        // }else{
        //     $('#dia_b').attr('disabled',true);
        // }
        $.get("asignaciones/"+id_planificacion+"/"+id_area+"/buscar_dias",function (data) {

        })
        .done(function(data) {
            // alert(data.length);
            if (data.length>0) {
                $('#dia_b').append('<option selected disabled>Seleccione dia</option>');
                for (var i=0; i < data.length; i++) {
                    var dia=data[i].dia;

                    if (dia== 'Lun') {
                        $('#dia_b').append('<option value="1">Lunes</option>');
                    }else if(dia== 'Mar') {
                        $('#dia_b').append('<option value="2">Martes</option>');
                    }else if(dia== 'Mié') {
                        $('#dia_b').append('<option value="3">Miércoles</option>');
                    }else if(dia== 'Jue') {
                        $('#dia_b').append('<option value="4">Jueves</option>');
                    }else if(dia== 'Vie') {
                        $('#dia_b').append('<option value="5">Viernes</option>');
                    }else if(dia== 'Sáb') {
                        $('#dia_b').append('<option value="6">Sábado</option>');
                    }else if(dia== 'Dom') {
                        $('#dia_b').append('<option value="7">Domingo</option>');
                    }else{

                    }
                }
                $('#dia_b').prop('disabled',false);
            }else{
                $('#dia_b').append('<option selected disabled>No hay dias en esta Area y Planificación</option>');
                $('#dia_b').prop('disabled',true);
            }
        });
        // $('#dia_b').append(
        //     '<option>Seleccione dia</option>'+
        //     '<option value="3">Miércoles</option>'+
        //     '<option value="4">Jueves</option>'+
        //     '<option value="5">Viernes</option>'+
        //     '<option value="6">Sábado</option>'+
        //     '<option value="7">Domingo</option>'+
        //     '<option value="1">Lunes</option>'+
        //     '<option value="2">Martes</option>'
        //     );
    });

    $("#dia_b").on("change",function (event) {
        $('#Cargando2').css('display','block');
        $('#mensaje3').append('<h3><strong>Cargando Actividades. Por favor, espere...</strong></h3>');
        $("#data-table-basic2").empty();

        var dia=event.target.value;
        var id_planificacion=$("#id_planificacion_b").val();
        // alert(id_planificacion);
        var id_area=$("#id_area_b").val();

        // alert(dia+' - '+id_planificacion+' - '+id_area);
        $.get("/mis_actividades/"+dia+"/"+id_planificacion+"/"+id_area+"/buscar",function (data) {

        })
        .done(function(data) {
            //console.log(data.length);
            $('#Cargando2').css('display','none');
            $('#mensaje3').empty();
            
            // console.log(data.length);

            if(data.length > 0){
                $("#data-table-basic2").append("<thead><tr><th>#</th><th>Task</th>"+
                    // "<th>Descripción</th>"+
                    "<th data-toggle='tooltip' data-placement='top' title='Duración Proyectada' >DP</th><th data-toggle='tooltip' data-placement='top' title='Duración Real' >DR</th><th>Fecha</th><th>Día</th><th>Área</th><th>Departamento</th><th>Tipo</th><th>Realizada</th><th>Comentarios</th><th>Observaciones</th><th>Acciones</th></tr></thead><tbody>");
                var nombres=$("#nombres_emp").val();
                var apellidos=$("#apellidos_emp").val();
                var id_empleado=$("#id_empleado").val();
                var id_comment="mis_comentarios";
                var comment="";
                var num="";
                for (var i = 0; i < data.length ; i++) 
                {  
                        j=i+1;
                    buscar_comentarios(data[i].id);
                    var numero=data[i].id;//asigno el id a una variable
                    num=numero.toString();//convierto la variable en string
                    comment=id_comment.concat(num);//concateno vaiables


                    //

                    if (data[i].descripcion == null) {
                        var descripcion = '';
                    } else {
                        var descripcion = data[i].descripcion;
                    }
                    if (data[i].observacion1 == null) {
                        var observacion1 = 'Sin observaciones';
                    } else {
                        var observacion1 = data[i].observacion1;
                    }
                    if (data[i].observacion2 == null) {
                        var observacion2 = 'Sin observaciones';
                    } else {
                        var observacion2 = data[i].observacion2;
                    }

                    if (data[i].duracion_pro == null) {
                        var duracion_p = 'Sin duración';
                    } else {
                        var duracion_p = data[i].duracion_pro;
                    }

                    if (data[i].duracion_real == null) {
                        var duracion_r = 'Sin duración';
                    } else {
                        var duracion_r = data[i].duracion_real;
                    }



                     //console.log(comment);
                    $("#data-table-basic2").append('<tr><td>'+j+'</td><td>' + data[i].task +'</td>'+
                        // '<td>'+descripcion+'</td>'+
                        '<td>' + duracion_p +'</td><td>' + duracion_r +'</td><td>' + data[i].fecha_vencimiento +'</td><td>' + data[i].dia +'</td><td>' + data[i].area +'</td><td>' + data[i].departamento +'</td><td>' + data[i].tipo +'</td><td>' + data[i].realizada +'</td><td><span id="'+comment+'"></td><td>'+observacion1+'</td><td><button data-target="#myModaltwoFinal" onclick="enviar_id('+data[i].id+','+data[i].duracion_pro+','+data[i].id_departamento+')" data-toggle="modal">Finalizar</button>'+
                            '<button data-target="#VerArchivos" onclick="mostrarArchivos('+data[i].id+')" data-toggle="modal">Ver archivos</button>'+
                        '</td>'


                        );
                    /*$("#data-table-basic").append('<tr><td>'+j+'</td><td>' + data[i].task +'</td><td>' + data[i].fecha_vencimiento +'</td><td>' + data[i].dia +'</td><td>' + data[i].area +'</td><td>' + data[i].departamento +'</td><td>' + data[i].tipo +'</td><td>' + data[i].realizada +'</td><td><button data-target="#modalActividad" data-toggle="modal" onclick="modal_actividad('+data[i].id+','+data[i].task+','+data[i].fecha_vencimiento+','+nombres+','+apellidos+','+data[i].descripcion+','+data[i].duracion_pro+','+data[i].cant_personas+','+data[i].duracion_real+','+data[i].dia+','+data[i].tipo+','+data[i].realizada+','+data[i].elaborado+','+data[i].aprobado+','+data[i].num_contrato+','+data[i].fechas+','+data[i].semana+','+data[i].revision+','+data[i].gerencia+','+data[i].id_area+','+data[i].area+','+data[i].observacion1+','+data[i].observacion2+','+id_empleado+')">Finalizar</button></td>');*/

                    
                }
                $("#data-table-basic2").append('</tbody>');
            }else{
                // alert('NO Trae');
                $("#data-table-basic2").append('<center><h3><strong>No hay actividades para el dia, con la planificación y área seleccionados</strong></h3></center>');
            }
        });

    });

    $("#id_area_b2").on("change",function (event) {
        var tipo_user= $('#tipo_user').val();
        // alert(tipo_user);
        $('#Cargando').css('display','block');
        $('#mensaje2').append('<h3><strong>Cargando Actividades. Por favor, espere...</strong></h3>');
        $("#data-table-basic3").empty();
        // var dia=$("#dia_b").val();
        var id_planificacion=$("#id_planificacion_b2").val();
        var id_area=event.target.value;
        //console.log(dia+"--"+id_planificacion+"--"+id_area);

        $.get("/mis_actividades2/"+id_planificacion+"/"+id_area+"/buscar",function (data) {

        })
        .done(function(data) {
            $("#data-table-basic3").empty();
            $('#Cargando').css('display','none');
            $('#mensaje2').empty();
            
            // $("#data-table-basic3").append(
            //     '<thead>'+
            //         '<tr>'+
            //             '<th>#</th>'+
            //             '<th>Task</th>'+
            //             '<th>Duración Proy.</th>'+
            //             '<th>Duración Real</th>'+
            //             '<th>Fecha</th>'+
            //             '<th>Día</th>'+
            //             '<th>Área</th>'+
            //             '<th>Departamento</th>'+
            //             '<th>Tipo</th>'+
            //             '<th>Realizada</th>'+
            //             '<th>Comentarios</th>'+
            //             '<th>Acciones</th>'+
            //         '</tr>'+
            //     '</thead>'+
            //     '<tbody>'+
                    
                
            //     '</tbody>'   );
            if(data.length > 0){
                // alert('entra');
                $("#data-table-basic3").append("<thead><tr><th>#</th><th>Task</th>"+
                    // "<th>Descripción</th>"+
                    "<th data-toggle='tooltip' data-placement='top' title='Duración Proyectada' >DP</th><th data-toggle='tooltip' data-placement='top' title='Duración Real' >DR</th><th>Fecha</th><th>Día</th><th>Área</th><th>Departamento</th><th>Tipo</th><th>Realizada</th><th>Comentarios</th><th>Observaciones</th><th>Acciones</th></tr></thead><tbody>");
                var nombres=$("#nombres_emp").val();
                var apellidos=$("#apellidos_emp").val();
                var id_empleado=$("#id_empleado").val();
                var id_comment="mis_comentarios";
                var comment="";
                var num="";
                for (var i = 0; i < data.length ; i++) 
                {  
                        j=i+1;
                    buscar_comentarios(data[i].id);
                    var numero=data[i].id;//asigno el id a una variable
                    num=numero.toString();//convierto la variable en string
                    comment=id_comment.concat(num);//concateno vaiables
                    var tarea = toString(data[i].task);


                    //

                    if (data[i].descripcion == null) {
                        var descripcion = '';
                    } else {
                        var descripcion = data[i].descripcion;
                    }
                    if (data[i].observacion1 == null) {
                        var observacion1 = 'Sin observaciones';
                    } else {
                        var observacion1 = data[i].observacion1;
                    }
                    if (data[i].observacion2 == null) {
                        var observacion2 = 'Sin observaciones';
                    } else {
                        var observacion2 = data[i].observacion2;
                    }
                     //console.log(comment);
                    if (data[i].duracion_real==null) {
                        duracion_real='Sin datos registrados';
                    } else {
                        duracion_real=data[i].duracion_real;
                    }

                    if (data[i].duracion_pro==null) {
                        duracion_pro='Sin datos registrados';
                    } else {
                        duracion_pro=data[i].duracion_pro;
                    }


                    if (tipo_user != 'ViewMel@licancabur.cl') {
                        $("#data-table-basic3").append('<tr><td>'+j+'</td><td>' + data[i].task +'<input type="hidden" id="task'+data[i].id+'" value="'+data[i].task+'"></td>'+
                            // '<td>'+data[i].descripcion+'</td>'+
                            '<td>' + duracion_pro +'</td><td>' + duracion_real +'</td><td>' + data[i].fecha_vencimiento +'</td><td>' + data[i].dia +'</td><td>' + data[i].area +'</td><td>' + data[i].departamento +'</td><td>' + data[i].tipo +'</td><td>' + data[i].realizada +'</td><td><span id="'+comment+'"></td><td>'+observacion1+'</td>'+
                                '<td width="700">'+
                                    // '<button onclick="ver_actividad('+ data[i].fecha_vencimiento 
                                    // // +','+ data[i].descripcion
                                    // +','+ duracion_pro +','+ data[i].cant_personas +

                                    // ')" type="button" class="btn btn-info" data-toggle="modal" data-target="#ver_actividad"><i class="fa fa-search"></i> </button>'+
                                    '<button onclick="editar_act('+data[i].id+')" class="btn btn-info"><i class="fa fa-pencil"></i></button>'+
                                    '<button id="eliminar_actividad" onclick="eliminar('+data[i].id+')" value="0" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModaltwo"><i class="fa fa-trash"></i> </button>'+
                                    '<button onclick="asignar('+data[i].id+','+data[i].id_area+')" type="button" class="btn btn-success" data-toggle="modal" data-target="#asignar_tarea"><i class="fa fa-user"></i> </button><br><br>'+
                                    '<button data-target="#VerArchivos" onclick="mostrarArchivos('+data[i].id+')" data-toggle="modal">Ver archivos</button>'+
                                '</td>'
                        );
                    } else {
                        $("#data-table-basic3").append('<tr><td>'+j+'</td><td>' + data[i].task +'</td>'+
                            // '<td>'+data[i].descripcion+'</td>'+
                            '<td>' + duracion_pro +'</td><td>' + duracion_real +'</td><td>' + data[i].fecha_vencimiento +'</td><td>' + data[i].dia +'</td><td>' + data[i].area +'</td><td>' + data[i].departamento +'</td><td>' + data[i].tipo +'</td><td>' + data[i].realizada +'</td><td><span id="'+comment+'"></td><td>'+observacion1+'</td>'+
                                '<td width="700">'+
                                    '<button onclick="ver_actividad('+data[i].id+','+data[i].task+','+ data[i].fecha_vencimiento 
                                    // +','+ data[i].descripcion
                                    +','+ duracion_pro +','+ data[i].cant_personas +','+ duracion_real +','+data[i].dia+','+ data[i].tipo +','+ data[i].realizada +','+ data[i].area +','+observacion2+','+ data[i].departamento +')" type="button" class="btn btn-info" data-toggle="modal" data-target="#ver_actividad"><i class="fa fa-search"></i> </button>'+
                                    '<button data-target="#VerArchivos" onclick="mostrarArchivos('+data[i].id+')" data-toggle="modal">Ver archivos</button>'+
                                '</td>'
                        );
                    }
                    /*$("#data-table-basic").append('<tr><td>'+j+'</td><td>' + data[i].task +'</td><td>' + data[i].fecha_vencimiento +'</td><td>' + data[i].dia +'</td><td>' + data[i].area +'</td><td>' + data[i].departamento +'</td><td>' + data[i].tipo +'</td><td>' + data[i].realizada +'</td><td><button data-target="#modalActividad" data-toggle="modal" onclick="modal_actividad('+data[i].id+','+data[i].task+','+data[i].fecha_vencimiento+','+nombres+','+apellidos+','+data[i].descripcion+','+data[i].duracion_pro+','+data[i].cant_personas+','+data[i].duracion_real+','+data[i].dia+','+data[i].tipo+','+data[i].realizada+','+data[i].elaborado+','+data[i].aprobado+','+data[i].num_contrato+','+data[i].fechas+','+data[i].semana+','+data[i].revision+','+data[i].gerencia+','+data[i].id_area+','+data[i].area+','+data[i].observacion1+','+data[i].observacion2+','+id_empleado+')">Finalizar</button></td>');*/

                    
                }
                $("#data-table-basic3").append('</tbody>');
            }else{
                $('#data-table-basic3').append('<center><h3><strong>Sin resultados</strong></h3></center>');
                console.log('no trae');
            }

        });
    });
    function buscar_comentarios(id_actividad) {
        
        $.get('actividades/'+id_actividad+'/mis_comentarios',function (comentarios) {
            
            var id_nombre="#mis_comentarios";
            var nombre="";
            var num="";
            var numero=id_actividad;
            num=numero.toString();
            nombre=id_nombre.concat(num);
            //console.log(nombre);
            $(""+nombre+"").text(comentarios);
        });
    }
    function enviar_id(id_actividad, duracion_pro, id_departamento) {
        $("#id_actividad_f").val(id_actividad);
        $('#id_departamento_s').val(id_departamento);
        
        var duracion;
        if (duracion_pro == null) {
            duracion='No especificada';
        } else {
            duracion=duracion_pro;
        }
        $("#duracion_promedio").text(duracion);
    }
    function finalizar() {
        //console.log("ghlasasas");
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });
        var opcion=$("#cambiar_s").val();
        var id_actividad=$("#id_actividad_f").val();
        var duracion_real=$("#duracion_real_f").val();
        var comentario=$("#comentario_f").val();
        //console.log(id_actividad+"-"+duracion_real+'-'+comentario+'-'+opcion);
        $("#mensaje_f").empty();
        if (opcion==0) {
            var estado="FINALIZADA";
        }else{
            var estado="NO FINALIZADA";
        }
        //e.preventDefault();
                if (comentario=="" && opcion==0) {
                    $("#message_f").show();
                    $("#mensaje_f").append('<strong style="color:red; backgroundColor:white; align: center;">El comentario no debe estar vacío</strong>');
                } else {
                    if (duracion_real=="" && opcion==0) {
                
                        $("#mensaje_f").append('<strong style="color:red; backgroundColor:white; align: center;">Debe ingresar la duración real</strong>');
                    } else {
                            $.ajax({
                            type: "post",
                            url: "actividades_proceso/finalizar",
                            data: {
                                opcion:opcion,
                                id_actividad:id_actividad,
                                duracion_real:duracion_real,
                                comentario:comentario
                            }, success: function (data) {
                                console.log(data);
                                $("#mensaje_f").append('<strong style="color:green; backgroundColor:white; align: center;">Se ha cambiado el status de la actividad a '+estado+' exitosamente</strong>');
                                location.reload(true);
                            }
                                });      
                    }
                }
        $('#myModaltwoFinal').modal('hide');
        
            
    }
//creando evento para el modal de actividades para traer las planificaciones del area seleccionada
        $("#id_area").on('change',function (event) {
            var id_area=event.target.value;
            //console.log("evento realizado"+id_area);
            $.get('planificaciones/'+id_area+'/buscar',function(data){
                //console.log(data.length);
                $("#id_planificacion").empty();
                $("#id_planificacion2").empty();
                if (data.length>0) {
                    for(i=0; i < data.length; i++){
                        $("#id_planificacion").append('<option value="'+data[i].id+'">Semana:'+data[i].semana+' - ('+data[i].fechas+') - Gerencia: '+data[i].gerencia+'</option>');
                        $("#id_planificacion2").append('<option value="'+data[i].id+'">Semana:'+data[i].semana+' - ('+data[i].fechas+') - Gerencia: '+data[i].gerencia+'</option>');
                    }
                }

            });
        });
    function mostrarArchivos(id_actividad) {
        $('#CargandoArchivos').css('display','block');
        $('#mensajeArchivos').append('<h3><strong>Cargando archivos. Por favor, espere...</strong></h3>');
        $('#MuestraImagen').empty();
        $('#MuestraImagenes').empty();
        $('#MuestraArchivos').empty();
        
        $.get("actividades/"+id_actividad+"/mis_imagenes",function (data) {

        })
        .done(function(data) {
            if(data.length>0){
                for (var i = 0; i < data.length; i++) {
                    
                    $('#MuestraImagenes').append('<div style="overflow-x: auto;">'+
                        '<a href="#" onclick="VerImagen()">'+
                            '<img style="width:100%;" src="'+data[i].url+'">'+
                        '</a><div>'
                    );
                    $('#MuestraImagen').append('<img style="width:100%" src="'+data[i].url+'">');
                }

            }else{
                    $('#MuestraImagenes').append('<div style="overflow-x: auto;"><p>La actividad no tiene imágenes registradas</p></div>');
            }
        });

        $.get("actividades/"+id_actividad+"/mis_archivos",function (data) {

        })
        .done(function(data) {
            if(data.length>0){
                for (var i = 0; i < data.length; i++) {
                    $('#MuestraArchivos').append('<a class="btn btn-primary rounded" href="'+data[i].url+'"><i class="fa fa-file"></i>  '+data[i].nombre+'</a><br>');
                }

            }else{
                    $('#MuestraArchivos').append('<p>La actividad no tiene archivos registrados</p>');
            }
            $('#CargandoArchivos').css('display','none');
            $('#mensajeArchivos').empty();
        });
    }
    function VerImagen() {
        $('#VerArchivos').modal('hide');
        $('#VerImagen').modal('show');
    }
</script>

@endsection
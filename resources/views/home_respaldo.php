@extends('layouts.appLayout')
@section('css')
<style>
    .lista {
        list-style-image: url("../../assets/images/check2.png");
        list-style-position: inside;
        margin-bottom: 5px;
        font-size: 14px;
    }
    .lista li {

    }

    .scrollbar {
height: 500px;
width: 100%;
background: #fff;
overflow-y: scroll;
margin-bottom: 25px;
}
.force-overflow {
min-height: 450px;
}

.scrollbar-primary::-webkit-scrollbar {
width: 12px;
background-color: #F5F5F5; }

.scrollbar-primary::-webkit-scrollbar-thumb {
border-radius: 10px;
-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
background-color: #4285F4; }

</style>
@endsection
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
                                    <i class="notika-icon notika-house"></i>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Dashboard</h2>
                                    <p>Bienvenido a Bienen System</p>
                                </div>
                            </div>
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
<div class="contact-area">
    <div class="container">
        <div class="row">
            @if(\Auth::User()->tipo_user=="Admin")
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="add-todo-list notika-shadow ">
                    <div class="realtime-ctn">
                        <div class="realtime-title">
                            <h2>Pizarra - Notas</h2>
                        </div>
                    </div>
                    <div class="card-box">
                        <div class="todoapp">
                            <form action="{{ route('notas.eliminar') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-sm-12 col-xs-12">
                                        <h4 id="todo-message"> {{$num_notas}} notas</h4>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="notika-todo-btn">
                                            <button type="submit" class="pull-right btn btn-primary btn-sm" id="">Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="notika-todo-scrollbar">
                                    <ul class="list-group no-margn todo-list" id="">
                                        @foreach($notas as $item)
                                        <li class="list-group-item">
                                            <div class="checkbox checkbox-primary">
                                                <input class="todo-done" id="{{$item->id}}" type="checkbox" name="notas[]" value="{{$item->id}}">
                                                <label for="{{$item->id}}">{{$item->notas}}</label>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </form>
                            <form action="{{ route('notas.store') }}" method="POST" data-parsley-validate>
                                @csrf
                                <div id="todo-form">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-sm-12 col-xs-12 todo-inputbar">
                                            <div class="form-group todoflex">
                                                <div class="col-sm-8">
                                                    <input type="text" id="nota" name="nota" class="form-control" placeholder="Agregar una nota nueva en la pizarra..." required="required">
                                                </div>
                                                <div class="col-sm-4">
                                                    <button class="btn-primary btn-md btn-block btn notika-add-todo" type="submit" id="">Agregar nota</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="add-todo-list notika-shadow ">
                    <div class="realtime-ctn">
                        <div class="realtime-title">
                            <h2>Actividades - Resúmen</h2>
                        </div>
                    </div>
                    <div class="card-box">
                        <div class="todoapp" id="todoapp" class="overflow-auto">
                            <div class="scrollbar scrollbar-primary">
                                <?php $i=1; ?>
                                @foreach($actividadesProceso as $key)
                                    @foreach($actividades as $key2)
                                        @if($key->id_actividad == $key2->id)
                                            <div id="contenido{{$i}}">
                                                <input type="hidden" name="contenido{{$i}}" id="contenido" value="contenido{{$i}}" onclick="">
                                                <?php $f=date('Y-m-d');
                                                    if($f > $key2->planificacion->fechas){
                                                        $estilo="panel panel-danger";
                                                    }else{
                                                        $estilo="panel panel-primary";
                                                    }
                                                ?>
                                                <div class="{{$estilo}}">
                                                  <div class="panel-heading"><strong>{{$key2->tipo}}</strong> - {{$key2->task}} 
                                                    @if($f > $key2->planificacion->fechas)
                                                        <strong>Vencido</strong>
                                                    @endif
                                                   <a href="#" class="btn btn-danger" id="eliminar_actividad" onclick="eliminar('{{$key->id_actividad}}','{{$key->id_empleado}}','contenido{{$i}}')" value="0" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModaltre"><span class="fa fa-trash"></span></a>
                                                  </div>
                                                    <div class="panel-body">
                                                        @if(Auth::user()->tipo_user>= "Admin")
                                                            <strong>Empleados:</strong> 
                                                            @foreach($empleados as $data)
                                                                @if($data->id == $key->id_empleado)
                                                                    {{$data->nombres}} {{$data->apellidos}} - {{$data->rut}}<br>
                                                                @endif
                                                            @endforeach()
                                                        @endif
                                                        <strong>Fecha:</strong> {{$key2->fecha_vencimiento}}<br>
                                                        <strong>Planificación:</strong> {{$key2->planificacion->fechas}}<br>
                                                        <strong>Día:</strong> {{$key2->dia}}<br>
                                                        <strong>Semana:</strong> {{$key2->planificacion->semana}}<br>
                                                        <strong>Área:</strong> {{$key2->areas->area}}<br>
                                                        <strong>Departamento:</strong> {{$key2->departamentos->departamento}}<br>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $i++; ?>
                                        @endif
                                    @endforeach()
                                @endforeach()
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            {{--
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-element-list text-center">
                    <!-- <div class="basic-tb-hd text-center">
                        @if(\Auth::User()->tipo_user=="Admin")<p>Todos los campos (<b style="color: red;">*</b></label>) son obligatorios</p>
                        @endif
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
                    </div> -->
                    <!-- @if(\Auth::User()->tipo_user=="Admin")
                    {!! Form::open(['route' => 'home.buscar', 'method' => 'get']) !!}
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="form-example-wrap mg-t-5">
                                    <div class="cmp-tb-hd cmp-int-hd">
                                        <h2>Filtros:</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <div class="form-example-int form-example-st">
                                                <div class="form-group">
                                                    <label for="">Tipo de búsquedad: <b style="color: red;">*</b></label></label>
                                                    <select name="tipo_busqueda" id="tipo_busqueda" class="form-control" required="required">
                                                        <option value="">Seleccione...</option>
                                                        <option value="empleado">Empleado</option>
                                                        <option value="area">Área</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="mostrar_empleado" style="display: none;">
                                            <div class="form-example-int form-example-st">
                                                <div class="form-group">
                                                    <label for="">Empleados: <b style="color: red;">*</b></label></label>
                                                    <select name="empleado" id="empleado" class="form-control" disabled="disabled">
                                                        <option value="">Seleccione empleado...</option>
                                                        @foreach($lista_empleado as $key)
                                                        <option value="{{$key->id}}">{{$key->nombres}} {{$key->apellidos}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="mostrar_area" style="display: none;">
                                            <div class="form-example-int form-example-st">
                                                <div class="form-group">
                                                    <label for="">Área: <b style="color: red;">*</b></label></label>
                                                    <select name="area" id="area" class="form-control" disabled="disabled">
                                                        <option value="">Seleccione área...</option>
                                                        @foreach($areas as $key)
                                                        <option value="{{$key->id}}">{{$key->area}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            <div class="form-example-int">
                                                <br>
                                                <button class="btn btn-success notika-btn-success" type="submit">Buscar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    {!! Form::close() !!}
                    @endif -->
                </div>
            </div>
            --}}
        </div>
        <div class="row">
            <!-- @if(\Auth::User()->tipo_user=="Admin")
                @if($hallado==0)
                @foreach($empleados as $key)
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="padding-top: 15px;">
                    <div class="contact-list sm-res-mg-t-30">
                        <div class="contact-win">
                            <div class="contact-img ml-auto">
                                <img src="{{ asset('assets/img/post/2.jpg') }}" alt="" />
                                <div class="dropdown"><br>
                                    {{-- <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                        <div class="contact-ctn" style="margin-top: -40px">
                            <div class="contact-ad-hd">
                                <h2>{{$key->nombres}} {{$key->apellidos}}</h2>
                                <p class="ctn-ads"></p>
                            </div>
                            <h2>Actividades:</h2>
                        </div>
                        <div class="accordion-stn">
                            <div class="panel-group" data-collapse-color="nk-green" id="accordionGreen" role="tablist"
                                aria-multiselectable="true">
            
                                @foreach($key->actividades as $key1)
            
                                @if($key1->id_planificacion==$id_planificacion1 || $key1->id_planificacion==$id_planificacion2)
            
                                <div class="panel panel-collapse notika-accrodion-cus">
                                    <div class="panel-heading" style="background: #F6F8FA" role="tab">
                                        <h4 class="panel-title">
                                            <a data-toggle="modal" data-target="#modalActividades" id="buscar_empleado"
                                                href="#accordionGreen-one" aria-expanded="true" onclick="modal_actividad('{{ $key1->id }}','{{ $key1->task }}','{{ $key1->fecha_vencimiento }}','{{ $key->nombres }}','{{ $key->apellidos }}','{{ $key1->descripcion }}','{{ $key1->duracion_pro }}','{{ $key1->cant_personas }}','{{ $key1->duracion_real }}','{{ $key1->dia }}','{{ $key1->tipo }}','{{ $key1->realizada }}','{{ $key1->planificacion->elaborado }}','{{ $key1->planificacion->aprobado }}','{{ $key1->planificacion->num_contrato }}','{{ $key1->planificacion->fechas }}','{{ $key1->planificacion->semana }}','{{ $key1->planificacion->revision }}','{{ $key1->planificacion->gerencias->gerencia }}','{{ $key1->areas->id }}','{{ $key1->areas->area }}','{{ $key1->areas->descripcion }}','{{ $key1->areas->ubicacion }}','{{ $key1->observacion1 }}','{{ $key1->observacion2 }}','{{ $key->id }}','{{ $key1->pivot->status }}')">{{$key1->task}}</a>
                                        </h4>
                                        <div class="mt-2">
                                            <span @if($key1->fecha_vencimiento==$hoy) class="label label-warning p-1" @elseif($key1->fecha_vencimiento<$hoy) class="label label-danger p-1" @endif data-toggle="tooltip"
                                                data-placement="bottom" title="Fecha de vencimiento"><i
                                                    class="lni-alarm-clock"></i> {{ date('d-m-Y', strtotime($key1->fecha_vencimiento)) }}.</span>
                                            TOOLTIPS CON ICONOS START
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Comentarios"
                                                class="ml-2">
                                                {{ mensajes_en_actividad($key1->id) }} <i class="lni-bubble"></i>
                                            </a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom"
                                                title="Archivos adjuntos" class="ml-2">
                                                {{ files_en_actividad($key1->id) }} <i class="lni-paperclip"></i>
                                            </a>
            
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Imagenes adjuntadas"
                                                class="ml-2">
                                                {{ imgs_en_actividad($key1->id) }} <i class="lni-check-mark-circle"></i>
                                            </a>
                                            TOOLTIPS CON ICONOS END
            
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                <div class="panel panel-collapse notika-accrodion-cus text-center">
                                    <div class="panel-heading">
                                        <span style="cursor:pointer" onclick="mostrar_actividades('{{ $key->id }}')" id="agregar" data-toggle="modal" data-target="#agregar_actividad">Agregar otra actividad <i class="lni-plus"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                @foreach($empleados as $key)
            
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="padding-top: 15px;">
                    <div class="contact-list sm-res-mg-t-30">
                        <div class="contact-win">
                            <div class="contact-img ml-auto">
                                <img src="{{ asset('assets/img/post/2.jpg') }}" alt="" />
                                <div class="dropdown">
                                    <br>
                                    {{-- <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                        <div class="contact-ctn" style="margin-top: -40px">
                            <div class="contact-ad-hd">
                                <h2>{{$key->nombres}} {{$key->apellidos}}</h2>
                                <p class="ctn-ads"></p>
                            </div>
                            <h2>Actividades:</h2>
                        </div>
                        @foreach($key->actividades as $key1)
                        <div class="accordion-stn">
                            <div class="panel-group" data-collapse-color="nk-green" id="accordionGreen" role="tablist"
                                aria-multiselectable="true">
                                <div class="panel panel-collapse notika-accrodion-cus">
                                    <div class="panel-heading" style="background: #F6F8FA" role="tab">
                                        <h4 class="panel-title">
                                            <a data-toggle="modal" data-target="#modalActividades"
                                                href="#accordionGreen-one" aria-expanded="true" onclick="modal_actividad('{{ $key1->id }}','{{ $key1->task }}','{{ $key1->fecha_vencimiento }}','{{ $key->nombres }}','{{ $key->apellidos }}','{{ $key1->descripcion }}','{{ $key1->duracion_pro }}','{{ $key1->cant_personas }}','{{ $key1->duracion_real }}','{{ $key1->dia }}','{{ $key1->tipo }}','{{ $key1->realizada }}','{{ $key1->planificacion->elaborado }}','{{ $key1->planificacion->aprobado }}','{{ $key1->planificacion->num_contrato }}','{{ $key1->planificacion->fechas }}','{{ $key1->planificacion->semana }}','{{ $key1->planificacion->revision }}','{{ $key1->planificacion->gerencias->gerencia }}','{{ $key1->areas->id }}','{{ $key1->areas->area }}','{{ $key1->areas->descripcion }}','{{ $key1->areas->ubicacion }}','{{ $key1->observacion1 }}','{{ $key1->observacion2 }}','{{ $key->id }}')">{{$key1->task}}</a>
                                        </h4>
                                        <div class="mt-2">
                                            <span @if($key1->fecha_vencimiento==$hoy) class="label label-warning p-1" @elseif($key1->fecha_vencimiento<$hoy) class="label label-danger p-1" @endif data-toggle="tooltip"
                                                data-placement="bottom" title="Fecha de vencimiento"><i
                                                    class="lni-alarm-clock"></i> {{ date('d-m-Y', strtotime($key1->fecha_vencimiento)) }}.</span>
                                            TOOLTIPS CON ICONOS START
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Comentarios"
                                                class="ml-2">
                                                2 <i class="lni-bubble"></i>
                                            </a>
                                            <a href="#" data-toggle="tooltip" data-placement="bottom"
                                                title="Archivos adjuntos" class="ml-2">
                                                4 <i class="lni-paperclip"></i>
                                            </a>
            
                                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="Imagenes adjuntadas"
                                                class="ml-2">
                                                1 <i class="lni-check-mark-circle"></i>
                                            </a>
                                            TOOLTIPS CON ICONOS END
            
                                        </div>
                                    </div>
                                </div>
            
                                <div class="panel panel-collapse notika-accrodion-cus text-center">
                                    <div class="panel-heading">
                                        <span data-toggle="modal" onclick="mostrar_actividades('{{ $key->id }}')" id="agregar" data-target="#agregar_actividad" id="" style="cursor:pointer">Agregar otra actividad <i class="lni-plus"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
                @endif
            @endif -->
            @if(\Auth::User()->tipo_user=="Empleado")
                <div class="data-table-list">
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Task</th>
                                    <th>Fecha</th>
                                    <th>Día</th>
                                    <th>Área</th>
                                    <th>Departamento</th>
                                    <th>Tipo</th>
                                    <th>Realizada</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach($empleados as $key)
                                @foreach($key->actividades as $key1)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td width="20%">{{ $key1->task }}</td>
                                    <td>{{ $key1->fecha_vencimiento }}</td>
                                    <td>{{ $key1->dia }}</td>
                                    <td>{{ $key1->areas->area }}</td>
                                    <td>{{ $key1->departamentos->departamento }}</td>
                                    <td>{{ $key1->tipo }}</td>
                                    <td>{{ $key1->realizada }}</td>
                                    <td>
                                        {{-- ,,,,,,,,,,,,,,,,,,,,,,,,,comentario,id_empleado,descripcion1 --}}
                                        <button data-toggle="modal" data-target="#modalActividades"
                                                href="#accordionGreen-one" aria-expanded="true" onclick="modal_actividad('{{ $key1->id }}','{{ $key1->task }}','{{ $key1->fecha_vencimiento }}','{{ $key->nombres }}','{{ $key->apellidos }}','{{ $key1->descripcion }}','{{ $key1->duracion_pro }}','{{ $key1->cant_personas }}','{{ $key1->duracion_real }}','{{ $key1->dia }}','{{ $key1->tipo }}','{{ $key1->realizada }}','{{ $key1->planificacion->elaborado }}','{{ $key1->planificacion->aprobado }}','{{ $key1->planificacion->num_contrato }}','{{ $key1->planificacion->fechas }}','{{ $key1->planificacion->semana }}','{{ $key1->planificacion->revision }}','{{ $key1->planificacion->gerencias->gerencia }}','{{ $key1->areas->id }}','{{ $key1->areas->area }}','{{ $key1->areas->descripcion }}','{{ $key1->areas->ubicacion }}','{{ $key1->observacion1 }}','{{ $key1->observacion2 }}','{{ $key->id }}')" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                        {{-- <a data-toggle="modal" data-target="#modalActividades"
                                                href="#accordionGreen-one" aria-expanded="true" onclick="modal_actividad('{{ $key->id }}','{{ $key->task }}','{{ $key->fecha_vencimiento }}','{{ $empleado->nombres }}','{{ $empleado->apellidos }}','{{ $key->descripcion }}','{{ $key->duracion_pro }}','{{ $key->cant_personas }}','{{ $key->duracion_real }}','{{ $key->dia }}','{{ $key->tipo }}','{{ $key->realizada }}','{{ $key->planificacion->elaborado }}','{{ $key->planificacion->aprobado }}','{{ $key->planificacion->num_contrato }}','{{ $key->planificacion->fechas }}','{{ $key->planificacion->semana }}','{{ $key->planificacion->revision }}','{{ $key->planificacion->gerencias->gerencia }}','{{ $key->areas->area }}','{{ $key->areas->descripcion }}','{{ $key->areas->ubicacion }}','{{ $key->observacion1 }}','{{ $key->observacion2 }}','{{ $empleado->id }}')"><i class="fa fa-search"></i></a> --}}
                                        @if($key1->tipo=="PM03")
                                            <button onclick="editar_act({{ $key1->id }},'{{$key1->dia}}')" type="button" class="btn btn-info" data-toggle="modal" data-target="#crear_actividad"1><i class="fa fa-edit"></i> </button>
                                            @include('planificacion.modales.crear_actividad')
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>    
                        </table>
                    </div>
                </div>
            @elseif(\Auth::User()->tipo_user=="Admin de Empleado")
                <div class="data-table-list">
                    <div class="table-responsive">
                        <table id="data-table-basic" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Estado</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>RUT</th>
                                    <th>Género</th>
                                    <th>Áreas</th>
                                    <th>Departamentos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($empleados as $item )
                                <tr>
                                    <td>{{ $contador++ }}</td>
                                    <td>
                                        @if($item->status == "Activo")
                                        <span class="label label-success">{{ $item->status }}</span>
                                        @elseif($item->status == "Reposo")
                                        <span class="label label-default">{{ $item->status }}</span>
                                        @else
                                        <span class="label label-danger">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->nombres }}</td>
                                    <td>{{ $item->apellidos }}</td>
                                    <td>{{ $item->rut }}</td>
                                    <td>{{ $item->genero }}</td>
                                    <td>
                                        <ul>
                                        @foreach($item->areas as $key2)
                                            <li>{{ $key2->area }}</li>
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                        @foreach($item->departamentos as $key2)
                                            <li>{{ $key2->departamento }}</li>
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="{{ route('empleados.edit', $item->id) }}" data-toggle="tooltip" data-placement="top" title="Editar datos del empleado">
                                            <i class="fa fa-pencil pr-3" style="font-size:20px"></i>
                                        </a>
                                        @if($item->id!=1)
                                        <a href="#" data-toggle="tooltip" data-placement="top" title="Suspender empleado"  onclick="status('{{ $item->id }}')" id="cambiar_status">
                                            <i class="fa fa-trash" style="font-size:20px" data-toggle="modal" data-target="#myModaltwo"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach    
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


@if(\Auth::User()->tipo_user=="Admin" || \Auth::User()->tipo_user=="Empleado")
    @include('partials.modalActividades')
@endif


<!-- Start Modales -->
<div class="modal animated bounce" id="agregar_actividad" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            {!! Form::open(['route' => 'actividades.asignar','method' => 'post','enctype' => 'Multipart/form-data']) !!}
            <div class="modal-body">
                <h1>Agregar actividad</h1>
                <div class="nk-int-mk sl-dp-mn sm-res-mg-t-10 mt-4">
                    <h2>Seleccione la actividad para agregar</h2>
                </div>
                <div class="form-group">
                    <select name="id_actividad_asig" id="actividad_asignar" class="form-control">
                        
                    </select>
                </div>
            </div>
            <input type="hidden" name="id_empleado" id="id_empleado_asignar">
            <div class="modal-footer mt-4">
                <button type="submit" class="btn btn-default">Registrar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal fade" id="ModalMensaje" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h2>Registro eliminado con éxito!</h2>

            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>
@include('planificacion.modales.eliminar_asignacion')
<!-- End modales -->
@endsection
@section('scripts')
<script>
    function eliminar_asignacion(contenido) {

                var id_actividad=   $('#id_actividad_eliminar').val();
                var id_empleado=    $('#id_empleado_act_eliminar').val();
                var contenido =     $('#contenido').val();
                console.log(id_actividad, id_empleado, contenido);



                $.get('asignaciones/'+id_actividad+'/'+id_empleado+'/eliminar_asignacion',function(data){
                    // console.log(data.length);
                    
                        $("#"+contenido).empty();
                        $('#myModaltre').modal('hide');
                        $('#ModalMensaje').modal();
                    
                });
            }
    function eliminar(id_actividad, id_empleado, contenido) {
        $("#id_actividad_eliminar").val(id_actividad);
        $('#id_empleado_act_eliminar').val(id_empleado);
        $('#contenido').val(contenido);
    }
$( function() {
$("#tipo_busqueda").change( function() {
    if ($(this).val() === "empleado") {
        empleado.value="";
        area.value="";
        $("#mostrar_empleado").removeAttr('style');
        $("#mostrar_area").css('display','none');
        $("#empleado").prop("disabled", false);
        $("#empleado").prop('required', true);
    } else if ($(this).val() === "area"){
        empleado.value="";
        area.value="";
        $("#mostrar_area").removeAttr('style');
        $("#mostrar_empleado").css('display','none');
        $("#empleado").prop("disabled", true);
        $("#area").prop("disabled", false);
        $("#area").prop('required', true);
    } else if ($(this).val() === ""){
        empleado.value="";
        area.value="";
        $("#mostrar_empleado").css('display','none');
        $("#mostrar_area").css('display','none');
    }
});
});
</script>
<script type="text/javascript">

    function modal_actividad(id_actividad,task,fecha_vencimiento,nombres,apellidos,descripcion,duracion_pro,cant_personas,duracion_real,dia,tipo,realizada,elaborado,aprobado,num_contrato,fechas,semana,revision,gerencia,id_area,area1,descripcion_area,ubicacion,observacion1,observacion2,id_empleado,status) {
        
        $("#task").text(task);
        $("#nombres").text(nombres);
        $("#apellidos").text(apellidos);
        $("#fecha_vencimiento").text(fecha_vencimiento);
        $("#descripcion").text(descripcion);
        $("#duracion_pro").text(duracion_pro);
        $("#cant_personas").text(cant_personas);
        $("#duracion_real").text(duracion_real);
        $("#dia").text(dia);
        $("#tipo").text(tipo);
        $("#realizada").text(realizada);
        $("#elaborado").text(elaborado);
        $("#aprobado").text(aprobado);
        $("#num_contrato").text(num_contrato);
        $("#fechas").text(fechas);
        $("#semana").text(semana);
        $("#revision").text(revision);
        $("#gerencia").text(gerencia);
        $("#id_area").text(id_area);
        $("#area1").text(area1);
        $("#descripcion_area").text(descripcion_area);
        $("#ubicacion").text(ubicacion);
        $("#observacion1").text(observacion1);
        $("#observacion2").text(observacion2);
        $("#status").text(status);
        //boton mover al admin
        $("#mover").on('click',function(event){
            $.get("actividades/"+id_actividad+"/mover_admin",function(data){
                $('.row').load('.row');
            });
        });
        //---- fin boton mover al admin
        //para el boton de finalizar
        if (realizada=="Si") {
            console.log(id_empleado);
            $("#duracion_real1").empty();
            $("#boton").empty();
            $("#vacio").empty();
            $("#boton").append('<button type="button" onclick="finalizar(1,'+id_actividad+')" class="btn btn-info">CAMBIAR A NO FINALIZADA</button>');
            $("#duracion_real2").val("");
            $("#duracion_real").empty();
            $("#duracion_real2").css('display','none');
            $("#duracion_real").val("Si");
            if (id_empleado!=1) {
                
            $("#mover").css('display','block');
            $("#mover_emp").css('display','none');

            }else{
                console.log("entro");
                $("#mover").css('display','none');
                $("#mover_emp").css('display','block');
                $("#mover_emp1").css('display','block');
            }
                
        } else {
            $("#vacio").empty();
            $("#duracion_real2").val("");
            $("#duracion_real2").css('display','block');
            
            $("#boton").empty();
            $("#boton").append('<button type="button" onclick="finalizar(0,'+id_actividad+')" class="btn btn-info">FINALIZAR </button>');
            $("#duracion_real").empty();
            $("#duracion_real").val("No");
            $("#mover").css('display','none');
            $("#mover_emp").css('display','none');
        }

        /*if(status=="Finalizada") {
            console.log("status--Fin");
            $("#mover").css('display','none');
        } 
        if(status=="Iniciada") {
            console.log("status--Ini");
            $("#mover_emp").css('display','none');
        }*/

        //-------fin para el boton de finalizar
        
        $.get("/empleados/"+id_area+"/buscar",function (datos) {
            console.log(datos.length);
            if (datos.length>0) {
            $("#id_actividad_mover").val(id_actividad);
                $("#mover_emp1").empty();
                for (var i = 0; i < datos.length; i++) {
                    $("#mover_emp1").append('<option value="'+datos[i].id+'">'+datos[i].apellidos+', '+datos[i].nombres+' RUT: '+datos[i].rut+'</option>');
                }
            }

        });

        //$("#comentarios").text(comentario);
          var fecha = new Date(); //Fecha actual
          var mes = fecha.getMonth()+1; //obteniendo mes
          var dia = fecha.getDate(); //obteniendo dia
          var ano = fecha.getFullYear(); //obteniendo año
          if(dia<10)
            dia='0'+dia; //agrega cero si el menor de 10
          if(mes<10)
            mes='0'+mes //agrega cero si el menor de 10
        var hoy=ano+"-"+mes+"-"+dia;
        if (fecha_vencimiento==hoy) {
            $("#vencimiento").empty();
            $("#vencimiento").append('<span class="label label-warning p-1" data-toggle="tooltip"'+ 
                'data-placement="bottom"'+
                'title="Feha de vencimiento"><i class="lni-alarm-clock"></i>'+
                '<b>'+fecha_vencimiento+'</b></span>');
        } else {
            if (fecha_vencimiento<hoy) {
                $("#vencimiento").empty();
            $("#vencimiento").append('<span class="label label-danger p-1" data-toggle="tooltip"'+ 
                'data-placement="bottom"'+
                'title="Feha de vencimiento"><i class="lni-alarm-clock"></i>'+
                '<b>'+fecha_vencimiento+'</b></span>');
            }
        }
        if (realizada=="Si") {
            $("#boton").empty();
            $("#boton").append('<button type="button" onclick="finalizar(1,'+id_actividad+')" class="btn btn-info">CAMBIAR A NO FINALIZADA</button>');
        } else {
            $("#boton").empty();
            $("#boton").append('<button type="button" onclick="finalizar(0,'+id_actividad+')" class="btn btn-info">FINALIZAR </button>');
        }
        
        if (descripcion=="") {
            $("#descripcion1").empty();
        }
        $("#id_empleado").val(id_empleado);
        //buscando mensajes registrados
        $.get("/actividades/"+id_actividad+"/comentarios",function(data){
            //console.log(data.length);

            if (data.length>0) {
                $("#comentarios").empty();
                for(i=0;i<data.length;i++){
                    $("#comentarios").append('<tr style="border: 0px;">'+
                                            '<td>'+                                    
                                                '<span id="usuario"><a href="#">'+data[i].name+' '+data[i].email+'</a> el '+data[i].created_at+'</span>'+
                                            '</td>'+
                                        '</tr>'+
                                        '<tr style="border: 0px; height: 15px;">'+
                                            '<td>'+
                                                '<span id="comentario">'+data[i].comentario+'</span>'+
                                            '</td>'+
                                        '</tr>'+
                                        '<tr style="border: 0px;">'+
                                            '<td>'+
                                                '<button class="btn btn-danger btn-xs" '+
                                                ' onclick="eliminar_comentario('+data[i].id+','+data[i].id_actv_proceso+')"><i class="fa fa-trash"></i></button>'+
                                            '</td>'+
                                        '</tr>');
                }
            }
        });
    $("#enviar_comentario").on('click',function(e){
        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });

        e.preventDefault();
          var comentario = $('textarea#comentario').val();
          var id_usuario = $('#id_usuario').val();
          
          if (comentario=="") {
            $("#error").text("El comentario no puede estar vacio");
          } else {
          $.ajax({
            type: "post",
            url: "actividades/registrar_comentario",
            data: {
                comentario: comentario,
                id_actividad: id_actividad,
                id_usuario: id_usuario,
                id_empleado: id_empleado
            }, success: function (data) {
                    if (data.length>0) {
                $("#comentarios").empty();
                for(i=0;i<data.length;i++){
                    $('textarea#comentario').val("");
                    $("#comentarios").append('<tr style="border: 0px;">'+
                                            '<td>'+                                    
                                                '<span id="usuario"><a href="#">'+data[i].name+' '+data[i].email+'</a> el '+data[i].created_at+'</span>'+
                                            '</td>'+
                                        '</tr>'+
                                        '<tr style="border: 0px; height: 15px;">'+
                                            '<td>'+
                                                '<span id="comentario">'+data[i].comentario+'</span>'+
                                            '</td>'+
                                        '</tr>'+
                                        '<tr style="border: 0px;">'+
                                            '<td>'+
                                                '<button class="btn btn-danger btn-xs"'+
                                                ' onclick="eliminar_comentario('+data[i].id+','+data[i].id_actv_proceso+')"><i class="fa fa-trash"></i></button>'+
                                            '</td>'+
                                        '</tr>');
                }
            }         
            }
          });
        }
    });
    
    //archivos guardados al registrar una actividad
    $.get('actividades/'+id_actividad+'/buscar_archivos',function(data){
        //console.log(data.length);
        if (data.length>0) {
            $("#mis_archivos").empty();
            for(var k = 0; k < data.length; k++){
                $("#mis_archivos").append('<li><a href="{!! asset('"+ data[k].url +"') !!}">'+data[k].nombre+'</a> <button class="btn btn-danger btn-xs" '+
                    ' onclick="eliminar_archivo('+data[k].id+')"><i class="fa fa-trash"></i></button></li>');
            }
        }else{
            $("#mis_archivos").empty();
        }
    });
    //-------------------------------------------------
    //archivos guardados desde el modal
    $.get('actividades_proceso/'+id_actividad+'/buscar_archivos_adjuntos',function(data){
        
        if (data.length>0) {
            $("#mis_archivos_cargados").empty();
            for(var k = 0; k < data.length; k++){
                if(data[k].tipo=="file"){
                $("#mis_archivos_cargados").append('<li><a href="{!! asset('"+ data[k].url +"') !!}">'+data[k].nombre+'</a> <button class="btn btn-danger btn-xs" onclick="eliminar_archivos_adjuntos('+data[k].id+')"><i class="fa fa-trash"></i></button></li>');
                }
            }
        }else{
            $("#mis_archivos_cargados").empty();
        }
    });
    //-------------------------------------------------
    //imagenes guardadas al registrar una actividad
    $.get('actividades/'+id_actividad+'/buscar_imagenes',function(data){
        //console.log(data.length);
        if (data.length>0) {
            $("#mis_imagenes").empty();
            for(var k = 0; k < data.length; k++){
                $("#mis_imagenes").append('<li><a href="{!! asset('"+ data[k].url +"') !!}">'+data[k].nombre+' </a><button class="btn btn-danger btn-xs"'+
                    ' onclick="eliminar_imagen('+data[k].id+')" ><i class="fa fa-trash"></i></button></li></li>');
            }
        }else{
            $("#mis_imagenes").empty();
        }
    });
    //---------------------------------------------
    //imagenes guardadas desde el modal
    $.get('actividades_proceso/'+id_actividad+'/buscar_imagenes_adjuntas',function(data){
        //console.log(data.length);
        if (data.length>0) {
            $("#mis_imagenes_cargadas").empty();
            for(var k = 0; k < data.length; k++){
                $("#mis_imagenes_cargadas").append('<li><a href="{!! asset('"+ data[k].url +"') !!}">'+data[k].nombre+'</a> <button class="btn btn-danger btn-xs"'+
                    ' onclick="eliminar_imagenes_adjuntas('+data[k].id+')" ><i class="fa fa-trash"></i></button></li></li>');
            }
        }else{
            $("#mis_imagenes_cargadas").empty();
            }
    });
    //---------------------------------------------

    $("#enviar_archivo").on('click',function(e){

        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });
        e.preventDefault();
          var archivos= $("#archivos").val();
          var id_usuario = $('#id_usuario').val();
          var formulario = new FormData($("#frmB")[0]);
          
          formulario.append('id_empleado', id_empleado);
          formulario.append('id_actividad', id_actividad);
          formulario.append('id_usuario',id_usuario);
          
          //console.log(formulario);
          if (archivos=="") {
            $("#error2").text("El comentario no puede estar vacio");
          } else {
            
          $.ajax({
            type: "post",
            url: "actividades/registrar_archivos",
            data:formulario,
            dataType: 'json',
            processData: false,
            contentType: false ,
            success: function (datos) {
                
            if (datos.length>0) {
                $("#mis_archivos_cargados").empty();
                for(i=0;i<datos.length;i++){
                    $('file#archivos').val("");
                    if(datos[i].tipo=="file"){
                    $("#mis_archivos_cargados").append('<li><a href="{!! asset('"+ datos[i].url +"') !!}">'+datos[i].nombre+'</a> <button class="btn btn-danger btn-xs" onclick="eliminar_archivos_adjuntos('+datos[i].id+')"><i class="fa fa-trash"></i></button></li>');
                    }
                }
            }else{
                $("#error2").text("No se pudo traer nada");  
            }         
            }
          });
        }
    });
    $("#enviar_imagen").on('click',function(e){

        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });
        e.preventDefault();
          var imagenes= $("#imagenes").val();
          var id_usuario = $('#id_usuario').val();
          var formulario = new FormData($("#frmC")[0]);
          
          formulario.append('id_empleado', id_empleado);
          formulario.append('id_actividad', id_actividad);
          formulario.append('id_usuario',id_usuario);
          
          
          if (imagenes=="") {
            $("#error3").text("El comentario no puede estar vacio");
          } else {
            
          $.ajax({
            type: "post",
            url: "actividades/registrar_imagenes",
            data:formulario,
            dataType: 'json',
            processData: false,
            contentType: false ,
            success: function (datos) {
                
            if (datos.length>0) {
                $("#mis_imagenes_cargadas").empty();
                for(i=0;i<datos.length;i++){
                    $('file#imagenes').val("");
                    if(datos[i].tipo=="img"){
                    $("#mis_imagenes_cargadas").append('<li><a href="{!! asset('"+ datos[i].url +"') !!}">'+datos[i].nombre+'</a> <button class="btn btn-danger btn-xs" onclick="eliminar_imagenes_adjuntas('+datos[i].id+')"><i class="fa fa-trash"></i></button></li>');
                    }
                }
            }else{
                $("#error3").text("No se pudo traer nada");  
            }         
            }
          });
        }
    });
    }

    function eliminar_comentario(id_comentario,id_actv_proceso) {
        

        $.get('actividades/'+id_actv_proceso+'/'+id_comentario+'/eliminar_comentario',function(data){
            if (data.length>0) {
                $("#comentarios").empty();
                for(i=0;i<data.length;i++){
                    $("#comentarios").append('<tr style="border: 0px;">'+
                            '<td>'+                                    
                                '<span id="usuario"><a href="#">'+data[i].name+' '+data[i].email+'</a> el '+data[i].created_at+'</span>'+
                            '</td>'+
                        '</tr>'+
                        '<tr style="border: 0px; height: 15px;">'+
                            '<td>'+
                                '<span id="comentario">'+data[i].comentario+'</span>'+
                            '</td>'+
                        '</tr>'+
                        '<tr style="border: 0px;">'+
                            '<td>'+
                                '<button class="btn btn-danger btn-xs" '+
                                'onclick="eliminar_comentario('+data[i].id+','+data[i].id_actv_proceso+')"><i class="fa fa-trash"></i></button>'+
                            '</td>'+
                        '</tr>');
                }
            }else{
                $("#comentarios").empty();
            }
        });
    }
    function eliminar_archivo(id_archivo) {
        $.get('actividades/'+id_archivo+'/eliminar_archivos',function(data){
            
            if (data.length>0) {
            $("#mis_archivos").empty();
                for(var k = 0; k < data.length; k++){
                $("#mis_archivos").append('<li><a href="{!! asset('"+ data[k].url +"') !!}">'+data[k].nombre+' </a><button class="btn btn-danger btn-xs" '+
                        ' onclick="eliminar_archivo('+data[k].id+')"><i class="fa fa-trash"></i></button></li>');
                }
            }else{
                $("#mis_archivos").empty();
            }
        });
    }

    function eliminar_imagen(id_archivo) {
        $.get('actividades/'+id_archivo+'/eliminar_archivos',function(data){
            
            if (data.length>0) {
            $("#mis_imagenes").empty();
                for(var k = 0; k < data.length; k++){
                $("#mis_imagenes").append('<li><a href="{!! asset('"+ data[k].url +"') !!}" >'+data[k].nombre+' </a><button class="btn btn-danger btn-xs" '+
                        ' onclick="eliminar_imagen('+data[k].id+')"><i class="fa fa-trash"></i></button></li>');
                }
            }else{
                $("#mis_imagenes").empty();
            }
        });
    }
    function eliminar_archivos_adjuntos(id_archivo) {
        $.get('actividades_proceso/'+id_archivo+'/eliminar_archivos_adjuntos',function(data){
            
            if (data.length>0) {
            $("#mis_archivos_cargados").empty();
                for(var k = 0; k < data.length; k++){
                $("#mis_archivos_cargados").append('<li><a'+
                    ' href="{!! asset('"+ data[k].url +"') !!}">'+data[k].nombre+
                    ' </a><button class="btn btn-danger btn-xs" '+
                        ' onclick="eliminar_archivos_adjuntos('+data[k].id+')"><i class="fa fa-trash"></i></button></li>');
                }
            }else{
                $("#mis_archivos_cargados").empty();
            }
        });
    }

    function eliminar_imagenes_adjuntas(id_archivo) {
        $.get('actividades_proceso/'+id_archivo+'/eliminar_archivos_adjuntos',function(data){
            
            if (data.length>0) {
            $("#mis_imagenes_cargadas").empty();
                for(var k = 0; k < data.length; k++){
                $("#mis_imagenes_cargadas").append('<li><a href="{!! asset('"+ data[k].url +"') !!}">'+data[k].nombre+' </a><button class="btn btn-danger btn-xs" '+
                        ' onclick="eliminar_imagenes_adjuntas('+data[k].id+')"><i class="fa fa-trash"></i></button></li>');
                }
            }else{
                $("#mis_imagenes_cargadas").empty();
            }
        });
    }
    function finalizar(opcion,id_actividad) {

        if (opcion==0) {
            $("#vacio").empty();
            if ($("#duracion_real2").val()=="") {
                
                $("#vacio").append('<small style="color:red;">Debe ingresar la duración real</small>');
            } else {
                console.log($("#duracion_real2").val());
                var duracion_real=$("#duracion_real2").val();
                $.get('actividades_proceso/'+opcion+'/'+id_actividad+'/'+duracion_real+'/finalizar',function(data){
                    $("#duracion_real1").empty();
                    $("#boton").empty();
                    $("#vacio").empty();
                    $("#boton").append('<button type="button" onclick="finalizar(1,'+id_actividad+')" class="btn btn-info">CAMBIAR A NO FINALIZADA</button>');
                    $("#duracion_real2").val("");
                    $("#duracion_real").empty();
                    $("#duracion_real2").css('display','none');
                    $("#duracion_real").val("Si");
                    $("#mover").css('display','block');
                
            });   
            }
        } else {
            $("#vacio").empty();
            $("#duracion_real2").val("");
            $("#duracion_real2").css('display','block');
            $.get('actividades_proceso/'+opcion+'/'+id_actividad+'/'+duracion_real+'/finalizar',function(data){
            $("#boton").empty();
                    $("#boton").append('<button type="button" onclick="finalizar(0,'+id_actividad+')" class="btn btn-info">FINALIZAR </button>');
            });
            $("#duracion_real").empty();
            $("#duracion_real").val("No");
            $("#mover").css('display','none');
        }
        
    }
    function mostrar_actividades(id_empleado){
        $("#id_empleado_asignar").val(id_empleado);
        $.get('actividades/'+id_empleado+'/sin_realizar',function(data){
            console.log(data.length);
            if (data.length>0) {
                $("#actividad_asignar").empty();
                for (var i = 0; i < data.length; i++) {
                    $("#actividad_asignar").append("<option value='"+data[i].id+"'>"+data[i].task+" - DÍA: "+data[i].dia+" - FECHA: "+data[i].fecha_vencimiento+" - realizada: "+data[i].realizada+"</option>");
                }
            }
        });
    }
</script>


<script>
    $("#tipo1").on('change',function (event) { 
    console.log("entro");
        var tipo1=event.target.value;        
        if (tipo1=="PM02") {
            $("#pm02").removeAttr('style');
            $("#departamentos").css('display','none');
            $("#departamentos option").val(1).attr('selected',true);
                
        }else{
            if (tipo1=="PM03") {
                $("#departamentos").css('display','block');
                $("#departamentos option").val(1).attr('selected',true);
            } else{
                $("#departamentos").css('display','none');
                $("#departamentos option").val(1).attr('selected',true);
            }
            $("#pm02").css('display','none');
            $("#des_actividad").removeAttr('style');

            $("#areas").css('display','block');
            $("#tab2").removeAttr('style');           
              
        }

    });

    $("#id_actividad").on('change',function (event) {
        console.log("act");     
        var id_actividad=event.target.value;
        
        if (id_actividad!=="0") {
            $("#areas").css('display','none');
            //$("#des_actividad").css('display','none');
            $("#des_actividad").empty();
            $("#tab2").css('display','none');
            $("#task1").removeAttr('required');
            $("#cant_personas1").removeAttr('required');
        }else{
            console.log("entra");
            $("#areas").css('display','block');
            $("#tab2").removeAttr('style');
            $("#des_actividad").removeAttr('style');
        }
    });
    function editar_act(id_actividad,dia) {
        
        $("#accion").text('Actualizar');
        
        $("#id_actividad_act").val(id_actividad);
        $.get("/actividades/"+id_actividad+"/edit",function (data) {
                
                //console.log(data[0].tipo);
                //agregando tipo en select
                $("#tipo1").empty();
                switch(data[0].tipo){
                    case 'PM01':
                        $("#tipo1").append('<option value="PM01" selected="selected">PM01</option>');
                        $("#tipo1").append('<option value="PM02">PM02</option>');
                        $("#tipo1").append('<option value="PM03">PM03</option>');
                        $("#tipo1").append('<option value="PM04">PM04</option>');
                    break;
                    case 'PM02':
                        $("#tipo1").append('<option value="PM01">PM01</option>');
                        $("#tipo1").append('<option value="PM02" selected="selected">PM02</option>');
                        $("#tipo1").append('<option value="PM03">PM03</option>');
                        $("#tipo1").append('<option value="PM04">PM04</option>');
                    break;
                    case 'PM03':
                        $("#tipo1").append('<option value="PM03" selected="selected">PM03</option>');
                    break;
                    case 'PM04':
                        $("#tipo1").append('<option value="PM01">PM01</option>');
                        $("#tipo1").append('<option value="PM02">PM02</option>');
                        $("#tipo1").append('<option value="PM03">PM03</option>');
                        $("#tipo1").append('<option value="PM04" selected="selected">PM04</option>');
                    break;

                }

                //seleccionando opcion de actividades
            $("#id_actividad option").each(function(){

                if ($(this).text()==data[0].task) {
                
                    $(this).attr("selected",true);
               }
            });
            
                
            $("#observacion1").val(data[0].observacion1);
            $("#observacion2").val(data[0].observacion2);
            $("#id_planificacion").attr('multiple',false);
            $('#id_planificacion').replaceWith($('#id_planificacion').clone().attr('name', 'id_planificacion'));
            
            $("#id_planificacion option").each(function(){

                if ($(this).val()==data[0].id_planificacion) {
                
                    $(this).attr("selected",true);
                }
            });
            $("#id_area option").each(function(){

                if ($(this).val()==data[0].id_area) {
                
                    $(this).attr("selected",true);
                }
            });
            var id_departamento=1;
            $.get("/actividades/"+id_departamento+"/buscar_departamentos",function (data) {
                
                if (data.length>0) {
                    $("#id_departamento").empty();
                    for (var i = 0; i < data.length; i++) {
                        $("#id_departamento").append("<option value='"+data[i].id+"'>"+data[i].departamento+"</option>");
                    }
                }
            });
            $("#id_departamento option").each(function(){

                if ($(this).val()==data[0].id_departamento) {
                
                    $(this).attr("selected",true);
                }
            });
            //campos en caracteristicas
            $("#task1").val(data[0].task);
            $("#descripcion").val(data[0].descripcion);
            $("#duracion_pro").val(data[0].duracion_pro);
            $("#duracion_real").val(data[0].duracion_real);
            $("#cant_personas1").val(data[0].cant_personas);
            

            
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
            $("#area_check").css('display','none');
                $("#mie").prop('disabled',true);
                $("#jue").prop('disabled',true);
                $("#vie").prop('disabled',true);
                $("#sab").prop('disabled',true);
                $("#dom").prop('disabled',true);
                $("#lun").prop('disabled',true);
                $("#mar").prop('disabled',true);
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
            $.get("/actividades/"+id_actividad+"/mis_archivos",function (data) {
                //console.log(data.length);
                if (data.length!=0) {
                    $("#archivos_cargados").css('display','block');
                    $("#mis_archivos").empty();
                    for (var i = 0; i < data.length; i++) {
                        $("#mis_archivos").append("<li id='archivo'><div class='alert alert-info' role='alert'>"+data[i].nombre+" <a class='btn btn-danger pull-right' onclick='eliminar_archivo("+data[i].id+",1)'><i class='fa fa-trash' style='color:;'></i> Eliminar</a></div></li>");
                    }
                }
            }); 
            //mostrando imágenes cargadas a la actividad
            $.get("/actividades/"+id_actividad+"/mis_imagenes",function (data) {
                //console.log(data.length);
                if (data.length!=0) {
                    $("#imagenes_cargadas").css('display','block');
                    $("#mis_imagenes").empty();
                    for (var i = 0; i < data.length; i++) {
                        //console.log(data[i].url);

                        $("#mis_imagenes").append("<li id='imagen_eliminar'><div class='alert alert-info' role='alert'><img src='{!! asset('"+ data[i].url +"') !!}' height='100px' width='100px'><a class='btn btn-danger pull-right' onclick='eliminar_archivo("+data[i].id+",2)'><i class='fa fa-trash' style='color:;'></i> Eliminar</a></div></li>");
                        //$("#mis_imagenes").append("<li>"+data[i].url+"</li>");
                    }
                }
            });


            
        function cerrar() {
        $('#ModalMensaje').hide();
    } 
}
</script>
@endsection
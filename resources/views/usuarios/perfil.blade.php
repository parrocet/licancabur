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
                                    <a href="{{ route('empleados.index') }}" data-toggle="tooltip"
                                        data-placement="bottom" title="Volver" class="btn">
                                        <i class="notika-icon notika-left-arrow"></i>
                                    </a>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Perfil de usuario</h2>
                                    <p>Edite sus datos</p>
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
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                            <div class="breadcomb-report">
                                <a href="#" title="Solicitar vacaciones" class="btn" data-toggle="modal" data-target="#solicitar_vacaciones"><i class="lni-key"></i> Solicitar vacaciones</a>
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
<!-- Form Element area Start-->
<div class="form-element-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-element-list">
                    <div class="basic-tb-hd text-center">
                        <p>Todos los campos (<b style="color: red;">*</b>) son obligatorios</p>
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

                    @if($emp==0)
                    <form action="{{route('usuarios.update',$usuario->id)}}" method="POST" name="cambiar_perfil" data-parsley-validate id="editar_perfil">
                    @else
                    <form action="{{route('usuarios.update',$empleado->id)}}" method="POST" name="cambiar_perfil" data-parsley-validate id="editar_perfil">
                    @endif
                    @csrf

                        <h4>Datos de Usuarios</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="email">Correo electrónico: <b style="color: red;">*</b></label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese correo electrónico" required="required" @if($emp==0) value="{{ $usuario->email }}" @else value="{{$empleado->usuario->email}}" @endif>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="password">Contraseña: <b style="color: red;">*</b></label>
                                    <input type="checkbox" name="cambiar_password" id="cambiar_password" value="1">
                                    <small>Cambiar contraseña</small>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese contraseña" data-parsley-length="[8, 16]" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="confirmar_password">Repita contraseña: <b style="color: red;">*</b></label>
                                    <input type="password" name="confirmar_password" id="confirmar_password" class="form-control" placeholder="Repita contraseña" data-parsley-length="[8, 16]" data-parsley-equalto='#password' disabled="disabled">
                                </div>
                            </div>
                        </div>
                        <h4>Datos personales</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-4">
                                <div class="form-group">
                                    <label for="nombres">Nombres: <b style="color: red;">*</b></label>
                                    <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Ingrese nombres" required="required" @if($emp==0) value="{{ $usuario->name }}" @else value="{{$empleado->nombres}}" @endif>
                                </div>
                            </div>
                            @if($emp > 0)
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-4">
                                <div class="form-group">
                                    <label for="apellidos">Apellidos: <b style="color: red;">*</b></label>
                                    <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Ingrese apellidos" required="required" value="{{$empleado->apellidos}}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-4">
                                <div class="form-group">
                                    <label for="rut">Rut: <b style="color: red;">*</b></label>
                                    <input type="text" name="rut" id="rut" class="form-control" placeholder="Ingrese RUT" required="required" value="{{$empleado->rut}}" data-parsley-length="[8, 9]" maxlength="9" data-parsley-type="number">
                                </div>
                            </div>
                            @endif
                        </div>
                        @if($emp > 0)
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-4">
                                <div class="form-group">
                                    <label for="rut">Género: <b style="color: red;">*</b></label>
                                    <div class="fm-checkbox form-elet-mg">
                                        <div class="i-checks">
                                            <label>
                                                <label>
                                                    <input type="radio" id="genero" name="genero" class="i-checks" value="Masculino" @if($empleado->genero=="Masculino") checked="checked" @endif> <i></i>  Masculino
                                                </label>
                                            </label>
                                            <label>
                                                <label>
                                                    <input type="radio" id="genero" name="genero" class="i-checks" value="Femenino" @if($empleado->genero=="Femenino") checked="checked" @endif> <i></i>  Femenino
                                                </label>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-4">
                                <div class="form-group">
                                    <label for="edad">Edad: <b style="color: red;">*</b></label>
                                    <input type="text" name="edad" id="edad" class="form-control" placeholder="Ingrese correo electrónico" required="required" value="{{$empleado->edad}}" maxlength="2" data-parsley-length="[1, 2]">
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($tipo_user!=="Empleado" && $tipo_user!=="Admin" && $tipo_user!=="G-NPI" && $tipo_user!=="G-CHO" && $emp > 0)
                        {{-- <h4>Datos laborales</h4>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="rut">Área: <b style="color: red;">*</b></label>
                                    <select name="id_area" id="id_area" class="form-control">                  
                                        @foreach($areas as $key)
                                            <option value="{{ $key->id }}" @if($empleado->id_area=="{{ $key->id }}") selected="selected" @endif>{{ $key->area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="status">Status: <b style="color: red;">*</b></label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="Activo" @if($empleado->status=="Activo") selected="selected" @endif>Activo</option>
                                        <option value="Reposo" @if($empleado->status=="Reposo") selected="selected" @endif>Reposo</option>
                                        <option value="Retirado" @if($empleado->status=="Retirado") selected="selected" @endif>Retirado</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                        @endif

                        <div class="text-center mt-4">
                            <input type="hidden" name="empleado_existe" value="{{ $emp }}">
                            <a href="{{route('home')}}" class="btn btn-info btn-sm">Regresar</a>
                            <button class="btn btn-lg btn-success btn-sm" type="submit">Guardar perfil</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="solicitar_vacaciones" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Solicitar vacaciones</h3>
            </div>
            {!! Form::open(['route' => ['empleados.cambiar_status'], 'method' => 'POST', 'name' => 'cambiar_status', 'id' => 'cambiar_status', 'data-parsley-validate']) !!}
            @csrf
            <div class="modal-body">
                <p>¡Eliga la fecha de sus vacaciones!.</p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status"><b>Fecha de inicio</b> <b style="color: red;">*</b></label>
                            <input type="date" class="form-control" name="fechai_vac">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status"><b>Fecha final</b> <b style="color: red;">*</b></label>
                            <input type="date" class="form-control" name="fechaf_vac">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default">Solicitar vacaciones</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
  $('#editar_perfil').parsley();
</script>
<script type="text/javascript">
$('#cambiar_password').on('change',function () {
    if ($('#cambiar_password').prop('checked')) {
      $('#password').attr('disabled',false);
      $("#password").prop('required', true);
      $('#confirmar_password').attr('disabled',false);
      $("#confirmar_password").prop('required', true);
    }else{
      $('#password').attr('disabled',true);
      $("#password").removeAttr('required');
      $('#confirmar_password').attr('disabled',true);
      $("#confirmar_password").removeAttr('required');
      password.value="";
      confirmar_password.value="";
    }
  });
</script>
@endsection
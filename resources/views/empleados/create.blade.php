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
                                    <h2>Registrar empleados</h2>
                                    <p>Registra nuevos empleados en el sistema</p>
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
<!-- Form Element area Start-->
<div class="form-element-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-element-list">
                    <div class="basic-tb-hd text-center">
                        <p>Todos los campos son obligatorios</p>
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

                    <form action="{{route('empleados.store')}}" method="POST" name="registrar_usuario" data-parsley-validate>
                    @csrf
                        <h4>Datos de Usuarios</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="email">Correo electrónico: <b style="color: red;">*</b></label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Ingrese correo electrónico" required="required" value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>
                        <h4>Datos personales</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="nombres">Nombres: <b style="color: red;">*</b></label>
                                    <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Ingrese nombres" required="required" value="{{ old('nombres') }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="apellidos">Apellidos: <b style="color: red;">*</b></label>
                                    <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Ingrese apellido" required="required" value="{{ old('apellidos') }}">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="rut">Rut: <b style="color: red;">*</b></label>
                                    <input type="text" name="rut" id="rut" class="form-control" placeholder="Ingrese rut" required="required" value="{{ old('rut') }}" data-parsley-type="number" data-parsley-length="[8, 9]" maxlength="9">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="rut">Género: <b style="color: red;">*</b></label>
                                    <div class="fm-checkbox form-elet-mg">
                                        <div class="i-checks">
                                            <label>
                                                <label><input type="radio" id="genero" name="genero" class="i-checks" value="Masculino" checked="checked"> <i></i>  Masculino</label>
                                            </label>
                                            <label>
                                                <label><input type="radio" id="genero" name="genero" class="i-checks" value="Femenino" > <i></i>  Femenino</label>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="edad">Edad: <b style="color: red;">*</b></label>
                                    <input type="text" name="edad" id="edad" class="form-control" placeholder="Ingrese edad" required="required" value="{{ old('edad') }}" maxlength="2" data-parsley-length="[1, 2]" data-parsley-type="number">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4>Datos laborales</h4>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="status">Status: <b style="color: red;">*</b></label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="Activo">Activo</option>
                                        <option value="Reposo">Reposo</option>
                                        <option value="Retirado">Retirado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="rut">Área: <b style="color: red;">*</b></label>
                                    <select name="id_area[]" id="id_area" class="form-control" multiple="multiple" placeholder="Seleccione..." required>
                                        @foreach($areas as $key)
                                            <option value="{{ $key->id }}">{{ $key->area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3" style="display: none;">
                                <div class="form-group">
                                    <label for="rut">Departamentos: <b style="color: red;">*</b></label>
                                    <select name="id_departamento[]" id="id_departamento" class="form-control" multiple="multiple" placeholder="Seleccione..." required>                  
                                        @foreach($departamentos as $key)
                                            <option value="{{ $key->id }}">{{ $key->departamento }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <div class="form-group">
                                        <label>Cargo</label>
                                        <select class="form-control select2" name="cargo" id="cargo" placeholder="Seleccione el curso del empleado">
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
                                            <option value="Prevención de Riesgos"></option>
                                            <option value="Asistente Administrativo">Asistente Administrativo</option>
                                            <option value="Chofer">Chofer</option>
                                            
                                        </select>
                                    </div>
                                </div>

                        </div>

                        <hr>
                        <h4>AFP</h4>
                        <br>
                        @foreach($afp as $key)
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="align-content: center;">
                                        <input type="checkbox" name="afp[]" value="Si">
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <label>{{$key->afp}}</label>
                                    </div>
                                </div>
                            </div>
                        @endforeach()
                        <br>
                        <hr>
                        @if(buscar_p('Usuarios','Ver datos laborales')=="Si")
                        <h4>Licencia de conducir</h4>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="licencia_conducir">Fecha de emisión <b style="color: red;">*</b></label>
                                    <input type="date" class="form-control" id="lic_fecha_emision">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="licencia_conducir">Fecha de vencimiento <b style="color: red;">*</b></label>
                                    <input type="date" class="form-control" id="lic_fecha_vencimiento">
                                </div>
                            </div>
                        </div>
                        <!-- <hr> -->
                        @endif
                        @if(buscar_p('Usuarios','Ver curso cero daño')=="Si")
                        <!-- <h4>Curso cero daño</h4>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="status_ccd">Status <b style="color: red;">*</b></label>
                                    <select name="status_ccd" id="" class="form-control">
                                        <option value="Pendiente">Pendiente</option>
                                        <option value="Presentado">Presentado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="fecha_presentacion">Fecha de presentación <b style="color: red;">*</b></label>
                                    <input type="date" class="form-control" id="fecha_presentacion" name="fecha_presentacion">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="mes_ccd">Mes <b style="color: red;">*</b></label>
                                    <input type="month" class="form-control" id="mes_ccd" name="mes_ccd">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="observacion_ccd">Observación: <b style="color: red;">*</b></label>
                                    <input type="text" class="form-control" id="observacion_ccd" name="observacion_ccd" placeholder="Ingrese observación">
                                </div>
                            </div>
                        </div> -->
                        @endif


                </div>

            </div>
        </div>
    </div>
</div>
<br><br>


<!--  ---------------------------------------------------------------------- CURSOS DEL EMPLEADO-->
<div class="form-element-area">
    <div class="container">
        <hr><br>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-element-list">
                    @csrf
                        <h4>Cursos realizados</h4>
                        <hr>
                        @foreach($cursos as $key)
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                        <input type="checkbox" name="id_curso[]" value="Si">
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <label>{{$key->curso}}</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="form-group">
                                            <label>Fecha de culminación del curso</label>
                                            <input type="date" name="fecha_realizado_c[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="form-group">
                                            <label>Fecha de vencimiento del curso</label>
                                            <input type="date" name="fecha_vencimiento_c[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        @endforeach()
                </div>

            </div>
        </div>
    </div>
</div><br><br>


<!--  ---------------------------------------------------------------------- DATOS MÉDICOS    -->

<div class="form-element-area">
    <div class="container">
        <hr><br>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-element-list">
                    @csrf
                        <h4>Datos de Médicos</h4>
                        <hr>
                        Exámenes
                        <br>
                        @foreach($examenes as $key)
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                        <input type="checkbox" name="id_examen[]" value="Si">
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <label>{{$key->examen}}</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="form-group">
                                            <label>Fecha en que se realizó el examen</label>
                                            <input type="date" name="fecha_realizado[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="form-group">
                                            <label>Fecha de vencimiento</label>
                                            <input type="date" name="fecha_vencimiento[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        @endforeach()
                        

                </div>

            </div>
        </div>
    </div>
</div>
<br><br>

<div class="form-element-area">
    <div class="container">
        <hr><br>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-element-list">
                    @csrf
                        
                        <div class="form-group">
                            <label for="novedades">¿Publicar en las novedades? 
                            <input type="checkbox" id="novedades" checked="" value="Si" name="novedades">
                                </div>
                        <hr>
                        <div class="text-center mt-4">
                            <!-- <a href="{{route('empleados.index')}}" class="btn btn-danger btn-sm">Regresar</a> -->
                            <button class="btn btn-lg btn-primary btn-sm" type="submit">Registrar empleado</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
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
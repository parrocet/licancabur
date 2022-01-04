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
                                    <a href="{{ route('gerencias.index') }}" data-toggle="tooltip"
                                        data-placement="bottom" title="Volver" class="btn">
                                        <i class="notika-icon notika-left-arrow"></i>
                                    </a>
                                </div>
                                <div class="breadcomb-ctn">
                                    <h2>Registrar gerencia</h2>
                                    <p>Registra nuevos gerencia en el sistema</p>
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

                    {!! Form::open(['route' => ['gerencias.update',$gerencia->id], 'method' => 'PUT', 'name' => 'modificar_gerencia', 'id' => 'modificar_gerencia', 'data-parsley-validate']) !!}
                    @csrf
                        <h4>Datos de gerencia</h4>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-3">
                                <div class="form-group">
                                    <label for="gerencia">Nombre de la gerencia: <b style="color: red;">*</b></label>
                                    <input type="text" name="gerencia" id="gerencia" class="form-control" placeholder="Ingrese nombre de la gerencia" required="required" value="{{ $gerencia->gerencia }}">
                                </div>
                            </div>
                        </div><hr>

                        <div class="text-center mt-4">
                            <a href="{{route('gerencias.index')}}" class="btn btn-info btn-sm">Regresar</a>
                            <button class="btn btn-lg btn-success btn-sm" type="submit">Modificar gerencia</button>
                        </div>

                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>
</div>
@endsection

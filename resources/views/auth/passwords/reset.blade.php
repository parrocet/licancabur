@extends('layouts.loginLayout')

@section('content')
<form method="POST" action="{{ route('recuperando_clave') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="nk-block toggled" id="l-login">
        <div class="nk-form">
            <h2>Restablecer contraseña</h2>
             @include('flash::message')
            @if(count($errors))
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="input-group">
                <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                <div class="nk-int-st">
                <input placeholder="Correo electrónico" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                </div>
            </div>

            <div class="input-group mg-t-15">
                <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                <div class="nk-int-st">
                <input placeholder="Nueva contraseña" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                </div>
            </div>

            <div class="input-group mg-t-15">
                <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                <div class="nk-int-st">
                <input placeholder="Confirmar contraseña" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <button type="submit"
                class="btn btn-login btn-success btn-float"><i
                    class="notika-icon notika-right-arrow right-arrow-ant"></i></button>
        </div>

    </div>
</form>

@endsection

@extends('layouts.loginLayout')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="nk-block toggled" id="l-login">
        <div class="nk-form">
            <h2>Por favor verifica tu correo electrónico</h2>
            <p>Para finalizar la creación de tu cuenta te hemos enviado un correo de confirmación, revisa la bandeja de
                entrada de tú correo o la bandeja de spam(Si lo encuentras allí, por favor marcalo cómo: No-Spam). Sí
                aun no te ha llegado ningún correo podemos enviarte otro, solo has click <a
                    href="{{ route('verification.resend') }}">aquí</a> </p>
        </div>
    </div>


    @endsection

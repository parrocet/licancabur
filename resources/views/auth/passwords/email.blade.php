<form method="POST" action="{{ route('recuperando_clave') }}">
    @csrf

    <div class="nk-block" id="l-forget-password">
        <div class="nk-form">
            <h2>Restablecer contraseña</h2>

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
            <p class="text-left">Coloca tu correo electrónico y te enviaremos un correo con el que podrás recuperar tu
                contraseña.</p>

            <div class="input-group">
                <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
                <div class="nk-int-st">
                    <input placeholder="Correo electrónico" id="email" type="text"
                        class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>
            </div>

            <!-- <button type="submit" class="btn btn-login btn-success btn-float">
                <i class="notika-icon notika-right-arrow right-arrow-ant"></i>
            </button> -->
            <div class="row">
                <div class="pull-left mt-3">
                    <a href="{{ route('login') }}" data-ma-action="nk-login-switch" data-ma-block="#l-login" class="btn btn-primary"><span>Iniciar sesión</span></a>                    
                </div>
                <div class="pull-right mt-3">
                    <button  class="btn btn-primary" type="submit"> <span>Restablecer contraseña</span></button>
                </div>
            </div>
        </div>


        <!-- <div class="nk-navigation nk-lg-ic rg-ic-stl">
            <a href="{{ route('login') }}" data-ma-action="nk-login-switch" data-ma-block="#l-login"><i
                    class="notika-icon notika-right-arrow"></i> <span>Iniciar sesión</span></a>
            <a href="{{ route('register') }}" data-ma-action="nk-login-switch" data-ma-block="#l-register"><i
                    class="notika-icon notika-plus-symbol"></i> <span>Regístrate</span></a>
        </div> -->

    </div>

</form>

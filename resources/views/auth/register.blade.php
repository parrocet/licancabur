<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="nk-block" id="l-register">
        <div class="nk-form">

            <h2>Registrate</h2>

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
                    <input placeholder="Nombre y apellido" id="name" type="text"
                        class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                        required autocomplete="name" autofocus>

                </div>
            </div>

            <div class="input-group mg-t-15">
                <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
                <div class="nk-int-st">
                    <input placeholder="Correo electrónico" id="email" type="text"
                        class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email">

                </div>
            </div>

            <div class="input-group mg-t-15">
                <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                <div class="nk-int-st">
                    <input placeholder="Contraseña" id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="new-password">

                </div>
            </div>

            <div class="input-group mg-t-15">
                <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                <div class="nk-int-st">
                    <input placeholder="Confirmar contraseña" id="password-confirm" type="password" class="form-control"
                        name="password_confirmation" required autocomplete="new-password">

                </div>
            </div>

            <button type="submit" class="btn btn-login btn-success btn-float">
                <i class="notika-icon notika-right-arrow right-arrow-ant"></i>
            </button>
        </div>

        <div class="nk-navigation rg-ic-stl">
            <a href="{{ route('login') }}" data-ma-action="nk-login-switch" data-ma-block="#l-login"><i
                    class="notika-icon notika-right-arrow"></i> <span>Iniciar sesión</span></a>
            <a href="{{ route('password.request') }}" data-ma-action="nk-login-switch"
                data-ma-block="#l-forget-password"><i>?</i> <span>Recuperar Contraseña</span></a>
        </div>

    </div>
</form>

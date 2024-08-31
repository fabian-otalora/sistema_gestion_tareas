<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/less/login.less'])
</head>
<body>
    <div class="contenedor">
        <div class="box">
            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="box-input">
                    <h1>Sistema de Gestión de Tareas</h1>
                    <br>
                    <label for="email" class="label">{{ __('Correo electrónico') }}</label>
                    <br>
                    <input type="email" class="input" name="email" id="email" placeholder="" required>
                    <br>
                    @error('email')
                    <span class="error-msg">
                        <strong>{{ $value }}</strong>
                    </span>
                    @enderror
                </div>
                

                <div class="box-input">
                    <label for="password" class="label">{{ __('Contraseña') }}</label>
                    <br>
                    <input type="password" class="input" name="password" id="password" value="" placeholder="" required>
                    <br>
                    @error('password')
                    <span class="error-msg">
                        <strong>{{ $value }}</strong>
                    </span>
                    @enderror
                </div>

                @session('error')
                <div class="error-msg"> 
                    {{ $value }}
                </div>
                @endsession

                <div class="box-input">
                    <button class="button" type="submit">{{ __('Iniciar Sesión') }}</button>
                </div>
                <br>

                <div class="box-text">
                    <p class="text">No tienes cuenta?, crea una! <a href="{{ route('register') }}" class="a">Crear cuenta</a></p>
                </div>
            </form>         
        </div>
    </div>
</body>
</html>
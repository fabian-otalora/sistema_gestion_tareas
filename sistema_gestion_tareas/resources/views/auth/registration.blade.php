<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo usuario</title>
    @vite(['resources/less/login.less'])

</head>
<body>
    <div class="contenedor">
        <div class="box">
            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                @session('error')
                    <div class="error-msg" role=""> 
                        {{ $value }}
                    </div>
                @endsession

                <h3 style="text-align:center">Crear usuario</h3>

                <div class="box-input">
                    <label for="name" class="label">{{ __('Nombre') }}</label>
                    <br>
                    <input type="text" class="input" name="name" id="name" placeholder="" required>
                </div>
                @error('name')
                    <span class="error-msg" role="">
                        {{ $message }}
                    </span>
                @enderror

                <div class="box-input">
                    <label for="email" class="label">{{ __('Correo electronico') }}</label>
                    <br>
                    <input type="email" class="input" name="email" id="email" placeholder="name@example.com" required>
                </div>
                @error('email')
                    <span class="error-msg" role="">
                        {{ $message }}
                    </span>
                @enderror

                <div class="box-input">
                    <label for="rol" class="label">{{ __('Rol') }}</label>
                    <br>
                    <select class="input" name="rol" id="rol" required>
                        <option value="1">Administrador</option>
                        <option value="2">Usuario</option>
                    </select>
                </div>
                @error('rol')
                    <span class="error-msg" role="">
                        {{ $message }}
                    </span>
                @enderror
                
                <div class="box-input">
                    <label for="password" class="label">{{ __('Contraseña') }}</label>
                    <br>
                    <input type="password" class="input" name="password" id="password" value="" placeholder="" required>
                </div>
                @error('password')
                    <span class="error-msg" role="">
                        {{ $message }}
                    </span>
                @enderror

                <div class="box-input">
                    <label for="password_confirmation" class="label">{{ __('Confirmar contraseña') }}</label>
                    <br>
                    <input type="password" class="input" name="password_confirmation" id="password_confirmation" value="" placeholder="" required>
                </div>
                @error('password_confirmation')
                    <span class="error-msg">
                        {{ $message }}
                    </span>
                @enderror

                <div class="box-input">
                    <button class="button" type="submit">{{ __('Crear usuario') }}</button>
                </div>
                <div class="box-text">
                    <p class="text">Tiene una cuenta? <a href="{{ route('login') }}" class="a">Iniciar sesión</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registro</title>
        <style>body{font-family:system-ui, sans-serif;background:#f3f4f6;color:#111}</style>
    </head>
    <body>
        <h1>Registro</h1>

        @if ($errors->any())
            <div style="color:#b91c1c; margin-bottom:1rem;">
                <strong>Error:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <label for="name">Nombre</label><br>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            <div style="margin-top:1rem;">
                <label for="email">Correo electrónico</label><br>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div style="margin-top:1rem;">
                <label for="password">Contraseña</label><br>
                <input id="password" type="password" name="password" required>
            </div>
            <div style="margin-top:1rem;">
                <label for="password_confirmation">Confirmar contraseña</label><br>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>
            <div style="margin-top:1.5rem;">
                <button type="submit">Registrar</button>
            </div>
        </form>

        <p style="margin-top:1.5rem;">¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
    </body>
</html>

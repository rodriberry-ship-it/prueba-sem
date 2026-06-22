<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inicio</title>
        <style>body{font-family:system-ui, sans-serif;background:#f3f4f6;color:#111}</style>
    </head>
    <body>
        <h1>Bienvenido</h1>
        <p>Has iniciado sesión correctamente.</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    </body>
</html>

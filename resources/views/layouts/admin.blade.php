<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurante</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Barra superior */
        .top-bar {
            background-color: #333;
            padding: 10px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .top-bar ul {
            list-style-type: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        .top-bar ul li {
            margin-right: 20px;
        }
        .top-bar ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 10px;
            background-color: #FF851B;
            border-radius: 5px;
        }
        .top-bar ul li a:hover {
            background-color: #FF5722;
        }

        /* Botón de logout */
        .logout-btn {
            color: white;
            background-color: #FF5722;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #FF851B;
        }

        .container {
            margin-top: 20px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Barra de navegación superior -->
    <nav class="top-bar">
        <ul>
            <li><a href="{{ route('admin.index') }}">Dashboard</a></li>
            <li><a href="{{ route('platillos.index') }}">Platillos</a></li>
            <li><a href="{{ route('inventarios.index') }}">Inventarios</a></li>
            <li><a href="{{ route('ventas.index') }}">Ventas</a></li>
            <li><a href="{{ route('proveedores.index') }}">Proveedores</a></li>
            <li><a href="{{ route('usuarios.create') }}" class="nav-link">Crear Usuarios</a></li>
        </ul>

        <!-- Botón de Logout -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <script>
        // Puedes añadir JavaScript si necesitas confirmación o comportamiento adicional al cerrar sesión
    </script>
</body>
</html>

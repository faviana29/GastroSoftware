@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Crear Nuevo Usuario</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('usuarios.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <label for="role">Rol:</label>
            <select id="role" class="form-control" name="role" required>
                <option value="mesero">Mesero</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear Usuario</button>
    </form>

    <!-- Tabla de meseros creados -->
    <h2 class="mt-5">Lista de Meseros Creados</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($meseros as $mesero) <!-- Cambia a $meseros -->
            <tr>
                <td>{{ $mesero->name }}</td>
                <td>{{ $mesero->email }}</td>
                <td>{{ ucfirst($mesero->role) }}</td>
                <td>
                    <a href="{{ route('usuarios.edit', $mesero->id) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('usuarios.destroy', $mesero->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection



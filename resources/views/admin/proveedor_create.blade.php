@extends('layouts.admin')

@section('content')
<h2>Agregar un Nuevo Proveedor</h2>

<!-- Formulario para agregar un nuevo proveedor -->
<form method="POST" action="{{ route('proveedores.store') }}">
    @csrf
    <div>
        <label for="nombre">Nombre del Proveedor:</label>
        <input type="text" id="nombre" name="nombre" required>
    </div>
    <div>
        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required>
    </div>
    <div>
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div>
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required>
    </div>
    <button type="submit" class="btn btn-primary">Agregar Proveedor</button>
</form>

<a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Regresar a la lista de proveedores</a>
@endsection

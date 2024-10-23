@extends('layouts.admin')

@section('content')
    <h1>Inventarios</h1>

    <form method="POST" action="{{ route('inventarios.store') }}">
        @csrf
        <div class="form-group">
            <label for="producto">Producto:</label>
            <input type="text" class="form-control" id="producto" name="producto" required>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Producto</button>
    </form>

    <h2>Lista de Productos</h2>
    <ul>
        @foreach ($inventarios as $producto)
            <li>{{ $producto->producto }} - Cantidad: {{ $producto->cantidad }}</li>
        @endforeach
    </ul>
@endsection

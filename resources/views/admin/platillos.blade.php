@extends('layouts.admin')

@section('content')
<style>
    .platillos-table {
        width: 100%;
        border-collapse: collapse;
    }
    .platillos-table th, .platillos-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    .platillos-table th {
        background-color: #f2f2f2;
        text-align: left;
    }
</style>

<h2>Gestión de Platillos</h2>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Barra de búsqueda -->
<form method="GET" action="{{ route('platillos.index') }}">
    <div>
        <input type="text" name="search" placeholder="Buscar platillo..." value="{{ $search }}">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</form>

<!-- Formulario para agregar un nuevo platillo -->
<form id="platilloForm" method="POST" action="{{ route('platillos.store') }}">
    @csrf
    <div>
        <label for="nombre">Nombre del Platillo:</label>
        <input type="text" id="nombre" name="nombre" required>
    </div>
    <div>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" required>
    </div>
    <button type="submit" class="btn btn-primary">Agregar Platillo</button>
</form>

<!-- Tabla de platillos -->
<table class="platillos-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($platillos as $platillo)
            <tr id="platillo-{{ $platillo->id }}">
                <td>{{ $platillo->nombre }}</td>
                <td>S/ {{ number_format($platillo->precio, 2, ',', '.') }}</td>
                <td>
                    <button onclick="editarPlatillo({{ $platillo->id }})" class="btn btn-warning">Editar</button>
                    <form action="{{ route('platillos.destroy', $platillo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal para editar platillo -->
<div id="modalEditarPlatillo" style="display: none;">
    <div>
        <h2>Editar Platillo</h2>
        <input type="hidden" id="platilloId">
        <div>
            <label for="editNombre">Nombre del Platillo:</label>
            <input type="text" id="editNombre" required>
        </div>
        <div>
            <label for="editPrecio">Precio:</label>
            <input type="number" id="editPrecio" required>
        </div>
        <button onclick="guardarCambios()" class="btn btn-success">Guardar Cambios</button>
        <button onclick="cerrarModal()">Cancelar</button>
    </div>
</div>

<script>
    function editarPlatillo(id) {
        fetch(`/platillos/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('platilloId').value = data.id;
                document.getElementById('editNombre').value = data.nombre;
                document.getElementById('editPrecio').value = data.precio;
                document.getElementById('modalEditarPlatillo').style.display = 'block';
            });
    }

    function cerrarModal() {
        document.getElementById('modalEditarPlatillo').style.display = 'none';
    }

    function guardarCambios() {
        const id = document.getElementById('platilloId').value;
        const nombre = document.getElementById('editNombre').value;
        const precio = document.getElementById('editPrecio').value;

        fetch(`/platillos/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                nombre: nombre,
                precio: precio
            })
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            }
            throw new Error('Error al guardar los cambios');
        })
        .then(data => {
            // Actualiza la fila en la tabla con los nuevos valores
            document.querySelector(`#platillo-${data.id} td:nth-child(1)`).innerText = data.nombre;
            document.querySelector(`#platillo-${data.id} td:nth-child(2)`).innerText = `S/ ${parseFloat(data.precio).toFixed(2).replace('.', ',')}`;
            cerrarModal(); // Cierra el modal
        })
        .catch(error => alert(error));
    }
</script>

@endsection

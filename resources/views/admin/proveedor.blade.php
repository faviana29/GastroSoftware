@extends('layouts.admin')

@section('content')
<style>
    .proveedores-table {
        width: 100%;
        border-collapse: collapse;
    }
    .proveedores-table th, .proveedores-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    .proveedores-table th {
        background-color: #f2f2f2;
        text-align: left;
    }
</style>

<h2>Gestión de Proveedores</h2>
<a href="{{ route('proveedores.create') }}" class="btn btn-success" style="margin-bottom: 20px;">Agregar un Nuevo Proveedor</a>


@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif



<!-- Tabla de proveedores -->
<table class="proveedores-table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proveedores as $proveedor)
            <tr id="proveedor-{{ $proveedor->id }}">
                <td>{{ $proveedor->nombre }}</td>
                <td>{{ $proveedor->telefono }}</td>
                <td>{{ $proveedor->email }}</td>
                <td>
                    <button onclick="editarProveedor({{ $proveedor->id }})" class="btn btn-warning">Editar</button>

                    <!-- Formulario para eliminar el proveedor -->
                    <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal para editar proveedor -->
<div id="modalEditarProveedor" style="display: none;">
    <div>
        <h2>Editar Proveedor</h2>
        <input type="hidden" id="proveedorId">
        <div>
            <label for="editNombre">Nombre del Proveedor:</label>
            <input type="text" id="editNombre" required>
        </div>
        <div>
            <label for="editTelefono">Teléfono:</label>
            <input type="text" id="editTelefono" required>
        </div>
        <div>
            <label for="editEmail">Correo Electrónico:</label>
            <input type="email" id="editEmail" required>
        </div>
        <button onclick="guardarCambios()" class="btn btn-success">Guardar Cambios</button>
        <button onclick="cerrarModal()">Cancelar</button>
    </div>
</div>

<script>
    function editarProveedor(id) {
        fetch(`/proveedores/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('proveedorId').value = data.id;
                document.getElementById('editNombre').value = data.nombre;
                document.getElementById('editTelefono').value = data.telefono;
                document.getElementById('editEmail').value = data.email;
                document.getElementById('modalEditarProveedor').style.display = 'block';
            });
    }

    function cerrarModal() {
        document.getElementById('modalEditarProveedor').style.display = 'none';
    }

    function guardarCambios() {
        const id = document.getElementById('proveedorId').value;
        const nombre = document.getElementById('editNombre').value;
        const telefono = document.getElementById('editTelefono').value;
        const email = document.getElementById('editEmail').value;

        fetch(`/proveedores/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                nombre: nombre,
                telefono: telefono,
                email: email
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
            document.querySelector(`#proveedor-${data.id} td:nth-child(1)`).innerText = data.nombre;
            document.querySelector(`#proveedor-${data.id} td:nth-child(2)`).innerText = data.telefono;
            document.querySelector(`#proveedor-${data.id} td:nth-child(3)`).innerText = data.email;
            cerrarModal(); // Cierra el modal
        })
        .catch(error => alert(error));
    }
</script>

@endsection

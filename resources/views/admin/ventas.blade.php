@extends('layouts.admin')

@section('content')
<style>
    .ventas-table {
        width: 100%;
        border-collapse: collapse;
    }
    .ventas-table th, .ventas-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    .ventas-table th {
        background-color: #f2f2f2;
        text-align: left;
    }
</style>

<h2>Ventas Realizadas</h2>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="ventas-table">
    <thead>
        <tr>
            <th>Usuario</th> <!-- Cambiar ID por Usuario -->
            <th>Monto</th>
            <th>Método de Pago</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ventas as $venta)
            <tr>
                <td>{{ $venta->usuario ? $venta->usuario->name : 'Desconocido' }}</td> <!-- Mostrar nombre del usuario -->
                <td>S/ {{ number_format($venta->monto, 2, ',', '.') }}</td>
                <td>{{ ucfirst($venta->metodo_pago) }}</td>
                <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td> <!-- Mostrar la fecha -->
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Totales por método de pago -->
<h3>Totales por Método de Pago</h3>
<ul>
    <li>Efectivo: S/ {{ number_format($totalEfectivo, 2, ',', '.') }}</li>
    <li>Débito: S/ {{ number_format($totalDebito, 2, ',', '.') }}</li>
    <li>Transferencia: S/ {{ number_format($totalTransferencia, 2, ',', '.') }}</li>
</ul>

<!-- Botón para cuadrar caja -->
<form action="{{ route('ventas.cuadrar-caja') }}" method="POST" style="margin-top: 20px;">
    @csrf
    <button type="submit" class="btn btn-success">Cuadrar Caja</button>
</form>
@endsection

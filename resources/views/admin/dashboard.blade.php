@extends('layouts.admin')

@section('content')
<style>
    .mesa-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 20px;
        padding: 20px;
    }
    .mesa-item {
        background-color: #fff;
        border: 2px solid #FF851B;
        border-radius: 10px;
        padding: 15px;
        text-align: center;
        cursor: pointer;
    }
    .mesa-item h3 {
        margin: 10px 0;
        font-size: 18px;
    }
    .mesa-item .icon {
        font-size: 30px;
        color: #FF851B;
    }
    .mesa-item .status {
        margin-top: 10px;
        font-size: 12px;
        color: #FF5722;
    }
    .mesa-item .time {
        margin-top: 5px;
        font-size: 14px;
    }

    /* Estilos del modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }
    .modal-content {
        background-color: #fff;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        border-radius: 10px;
    }
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }
    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<!-- Enlace al archivo CSS de Laravel -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<!-- Contenedor de mesas -->
<div class="mesa-container">
    @foreach ($mesas as $mesa)
    <div class="mesa-item" onclick="abrirModal({{ $mesa->numero }}, '{{ $mesa->estado }}')">
        <div class="icon">🍽️</div>
        <h3>Mesa {{ $mesa->numero }}</h3>
        <p class="status">{{ $mesa->estado }}</p>
        <p class="time" id="tiempo-{{ $mesa->numero }}">--:--</p> <!-- Temporizador -->
    </div>
    @endforeach
</div>

<!-- Modal para tomar pedidos -->
<div id="modalPedido" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarModal()">&times;</span>
        <h2 id="mesaSeleccionada">Tomar Pedido</h2>
        <button id="terminarPedidoBtn" class="btn btn-success" onclick="terminarPedido()">Terminar Pedido</button>
        <button id="pagarPedidoBtn" class="btn btn-primary" onclick="pagarPedido()">Pagar</button>
    </div>
</div>

<script>
    let mesaActual = null; // Variable para almacenar la mesa seleccionada
    let interval = null; // Variable para el temporizador

    // Función para abrir el modal de pedido
    function abrirModal(numero, estado) {
        console.log('Intentando abrir el modal para la mesa:', numero, 'Estado:', estado);
        
        if (numero === undefined) {
            console.error('Error: Número de mesa es undefined');
            return; // Salir de la función si el número es undefined
        }
        
        console.log('Función abrirModal llamada para mesa:', numero); // Log para verificar el número de mesa
        mesaActual = numero; // Guardar el número de la mesa seleccionada
        document.getElementById('mesaSeleccionada').innerHTML = 'Tomar Pedido para Mesa ' + numero; // Actualizar título del modal
        document.getElementById('modalPedido').style.display = 'block'; // Mostrar el modal
        iniciarTemporizador(); // Iniciar temporizador al abrir el modal
    }

    // Función para cerrar el modal
    function cerrarModal() {
        console.log('Cerrando modal. Mesa actual:', mesaActual);
        document.getElementById('modalPedido').style.display = 'none';
        mesaActual = null; // Reiniciar la mesa actual
        clearInterval(interval); // Detener cualquier temporizador en curso
        if (mesaActual !== null) {
            document.getElementById('tiempo-' + mesaActual).textContent = '--:--'; // Reiniciar el temporizador visible
        }
    }

    // Función para iniciar el temporizador en la mesa actual
    function iniciarTemporizador() {
        if (!mesaActual) {
            console.error('Error: No hay mesa seleccionada para iniciar el temporizador');
            return; // Verifica que haya una mesa seleccionada
        }
        
        const tiempoElemento = document.getElementById('tiempo-' + mesaActual);
        let segundos = 0;

        console.log('Iniciando temporizador para la mesa:', mesaActual);
        
        interval = setInterval(() => {
            segundos++;
            const minutos = Math.floor(segundos / 60);
            const segRestantes = segundos % 60;
            tiempoElemento.textContent = `${minutos.toString().padStart(2, '0')}:${segRestantes.toString().padStart(2, '0')}`;
        }, 1000);
    }

    // Función para terminar el pedido y detener el temporizador
    function terminarPedido() {
        console.log('Terminando pedido para la mesa:', mesaActual);
        if (mesaActual) {
            cerrarModal(); // Cerrar el modal después de iniciar el temporizador
        }
    }

    // Función para finalizar el pedido (detener temporizador)
    function pagarPedido() {
        console.log('Pagando pedido para la mesa:', mesaActual);
        if (mesaActual) {
            clearInterval(interval); // Detener el temporizador
            alert('Pedido pagado para Mesa ' + mesaActual);
            cerrarModal(); // Cerrar el modal después de pagar
        }
    }

    // Cierra el modal si se hace clic fuera de él
    window.onclick = function(event) {
        const modal = document.getElementById('modalPedido');
        if (event.target == modal) {
            console.log('Clic detectado fuera del modal. Cerrando modal...');
            cerrarModal();
        }
    }
</script>

@endsection



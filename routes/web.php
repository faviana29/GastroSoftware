<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MeseroController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\PlatilloController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\MesaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
    // Ruta para el dashboard del admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Rutas para gestionar usuarios (solo admin puede acceder)
    Route::get('/usuarios/crear', [AdminController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [AdminController::class, 'store'])->name('usuarios.store');
    Route::delete('/usuarios/{id}', [AdminController::class, 'destroy'])->name('usuarios.destroy');
    Route::get('/meseros', [MeseroController::class, 'index'])->name('meseros.index'); // Listar empleados
    Route::get('/meseros/{mesero}/edit', [MeseroController::class, 'edit'])->name('meseros.edit'); // Editar empleados
    Route::put('/meseros/{mesero}', [MeseroController::class, 'update'])->name('meseros.update'); // Actualizar empleados
    Route::delete('/meseros/{mesero}', [MeseroController::class, 'destroy'])->name('meseros.destroy'); // Eliminar empleados
    Route::resource('meseros', MeseroController::class);
    Route::get('/meseros/create', [MeseroController::class, 'create'])->name('meseros.create');
    Route::get('/meseros/create', [MeseroController::class, 'create'])->name('meseros.create');
    Route::post('/meseros', [MeseroController::class, 'store'])->name('meseros.store');
    
    // Rutas para gestionar inventarios (solo admin)
    Route::get('/inventarios', [InventarioController::class, 'index'])->name('inventarios.index');
    Route::post('/inventarios', [InventarioController::class, 'store'])->name('inventarios.store');

    // Rutas para gestionar platillos (solo admin)
    Route::get('/platillos', [PlatilloController::class, 'index'])->name('platillos.index');
    Route::post('/platillos', [PlatilloController::class, 'store'])->name('platillos.store');
    Route::get('/platillos/{id}/edit', [PlatilloController::class, 'edit'])->name('platillos.edit');
    Route::put('/platillos/{id}', [PlatilloController::class, 'update'])->name('platillos.update');
    Route::delete('/platillos/{id}', [PlatilloController::class, 'destroy'])->name('platillos.destroy');

    // Rutas para gestionar ventas (solo admin)
    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::post('/ventas/cuadrar-caja', [VentaController::class, 'cuadrarCaja'])->name('ventas.cuadrar-caja');


    Route::post('/mesas', [MesaController::class, 'store'])->name('mesas.store');

    // Rutas para gestionar proveedores (solo admin)
    Route::resource('proveedores', ProveedorController::class);
    Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
    Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
    Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');

});
// Rutas para Mesero
Route::middleware(['auth'])->group(function () {
    // Ruta para el dashboard del mesero
    Route::get('/mesero', [MeseroController::class, 'index'])->name('mesero.index');

    // Rutas para tomar pedidos (solo mesero)
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
});
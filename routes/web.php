<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\ProveedorController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\AdminDashboardController;
use App\Http\Controllers\VentasController;
use Illuminate\Support\Facades\Http;

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
    /*$response = Http::get('https://thirsty-feynman.82-223-161-36.plesk.page/api/register');
    $data = $response->json();
    dd($data);*/
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::get('/dashboard', 'App\Http\Controllers\Api\ProductoController@index')->name('dashboard');
Route::get('/adminDashboard', [App\Http\Controllers\Api\ProductoController::class, 'index'])->name('adminDashboard');
//carrito
Route::post('/cart', [CartController::class, 'index'])->name('cart.store');
Route::get('/cart', [CartController::class, 'store'])->name('cart.index');
Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

//productos
Route::put('/productos/{id}', 'App\Http\Controllers\Api\ProductoController@update')->name('producto.update');
Route::post('/productos', 'App\Http\Controllers\Api\ProductoController@store')->name('producto.store');
Route::get('/productos', [App\Http\Controllers\Api\ProductoController::class, 'index'])->name('producto.index');
Route::delete('/productos/{id}', [App\Http\Controllers\Api\ProductoController::class, 'destroy'])->name('producto.destroy');

//ventas
Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');

//proveedores
Route::get('/proveedors', [App\Http\Controllers\Api\ProveedorController::class, 'index'])->name('proveedor.index');
Route::post('/proveedors', [App\Http\Controllers\Api\ProveedorController::class, 'store'])->name('proveedor.store');
Route::put('/proveedors/{id}', [App\Http\Controllers\Api\ProveedorController::class, 'update'])->name('proveedor.update');
Route::delete('/proveedors/{id}', [App\Http\Controllers\Api\ProveedorController::class, 'destroy'])->name('proveedor.destroy');
//Route::get('/dashboard', 'App\Http\Controllers\Api\ProveedorController@index');

/*Route::middleware(['auth:sanctum'])->group(function(){
    //Productos
    Route::resource('/productos',App\Http\Controllers\Api\ProductoController::class);

    /*Route::get('/productos/{id}', 'ProductoController@show');
    Route::put('/productos/{id}', 'ProductosController@update');

    //Proveedores
    Route::resource('/proveedors',ProveedorController::class);
    Route::get('/proveedors/{id}', 'ProveedorController@show');
    Route::put('/proveedors/{id}', 'ProveedorController@update');*/
//});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//Route::post('/register', [App\Http\Controllers\Api\RegisterController::class, 'register'])->name('api.register');

require __DIR__.'/auth.php';

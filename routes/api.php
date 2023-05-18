<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductoController;
use App\Http\Controllers\Api\ProveedorController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    $user = $request->user();
    if($user->rol_id == 1){
        return redirect('/adminDashboard');
    }else{
        return redirect('/dashboard');
    }
});

//register
Route::post('/register',[App\Http\Controllers\Api\RegisterController::class, 'register']);

//login
Route::post('/login',[App\Http\Controllers\Api\LoginController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function(){
    //Productos
    Route::resource('/productos',ProductoController::class);
    Route::get('/productos/{id}', 'ProductoController@show');
    Route::put('/productos/{id}', 'ProductosController@update');

    //Proveedores
    Route::resource('/proveedors',ProveedorController::class);
    Route::get('/proveedors/{id}', 'ProveedorController@show');
    Route::put('/proveedors/{id}', 'ProveedorController@update');
});

*/

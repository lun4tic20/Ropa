<?php

namespace App\Http\Controllers\Api;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class ProductoController extends Controller
{

    public function index(Request $request)
    {
        $url = "https://thirsty-feynman.82-223-161-36.plesk.page";
        $token = session('auth_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($url.'/api/productos');
        $data = $response->json();
        $productos = $data['producto'];
        return view('adminDashboard', compact('productos', 'data'));
    }

    public function store(Request $request)
{
    $url = "https://thirsty-feynman.82-223-161-36.plesk.page";

    $token = session('auth_token');
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post($url.'/api/productos', [
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'cantidad' => $request->cantidad,
        'proveedor_id' => $request->proveedor_id,
    ]);
    return redirect()->route('producto.index')->with('success_message', 'Producto creado correctamente.');
}

    /*public function show(Producto $producto)
    {
        return response()->json(['producto' => $producto]);
    }*/

    public function update(Request $request, $idProducto)
    {
        $url = "https://thirsty-feynman.82-223-161-36.plesk.page";

        $token = session('auth_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put($url.'/api/productos/'.$idProducto, [
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'proveedor_id' => $request->proveedor_id,
        ]);

        return redirect()->route('producto.index')->with('success_message', 'Producto actualizado correctamente.');
    }

    public function destroy($idProducto)
    {
        $url = "https://thirsty-feynman.82-223-161-36.plesk.page";
        $token = session('auth_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete($url.'/api/productos/'.$idProducto);
        //$response = Http::delete($url.'/api/productos/'.$idProducto);
        return redirect()->route('producto.index')->with('success_message', 'Producto eliminado correctamente.');
    }


}


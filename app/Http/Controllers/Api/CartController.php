<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $productoId = $request->input('id');
        $cantidad = $request->input('cantidad');

        // Realizar solicitud a la API para obtener los detalles del producto
        $url = "https://thirsty-feynman.82-223-161-36.plesk.page";
        $token = session('auth_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($url.'/api/productos/'.$productoId);
        //dd($response);
        if ($response->failed()) {
            // Manejar el caso de una solicitud fallida a la API
            return redirect()->back()->with('error_message', 'Error al obtener los detalles del producto desde la API.');
        }
        $producto = $response->json();
        $productos = $producto['producto'];
        // Verificar si se obtuvo el producto correctamente
        if (!$productos) {
            // Manejar el caso de un producto no encontrado en la API
            return redirect()->back()->with('error_message', 'El producto no existe en la API.');
        }

        // Agregar el producto al carrito
        $cart = $request->session()->get('cart', []);

        $cart[$productos['id']] = [
            'id' => $productos['id'],
            'nombre' => $productos['nombre'],
            'descripcion' => $productos['descripcion'],
            'precio' => $productos['precio'],
            'cantidad' => $cantidad,
            'proveedor_id' => $productos['proveedor_id'],
        ];
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success_message', 'Producto añadido al carrito.');
    }


    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $total = 0;

        foreach ($cart as &$producto) {
            $subtotal = $producto['precio'] * $producto['cantidad'];
            $producto['subtotal'] = $subtotal; // Agregar el subtotal al producto

            $total += $subtotal;
        }
        if($cart == []){
            $mensaje = "Tu carrito está vacío (por ahora).";
        } else {
            $mensaje = null;
        }

return view('cart', ['productos' => $cart, 'total' => $total, 'mensaje' => $mensaje]);
    }

    public function update(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $cantidad = $request->input('cantidad');
        $id = $request->input('id');

        if (isset($cart[$id])) {
            $cart[$id]['cantidad'] = $cantidad;
            $subtotal = $cart[$id]['precio'] * $cantidad;
            $request->session()->put('cart', $cart);
        }

        $total = 0;

        foreach ($cart as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }

        return redirect()->route('cart.index')->with('success_message', 'Cantidad actualizada correctamente.');
    }

    public function destroy(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $id = $request->input('id');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            $request->session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

}

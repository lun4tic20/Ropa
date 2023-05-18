<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    public function store(Request $request, Producto $producto)
{
    $cart = $request->session()->get('cart', []);
    $cart =[$producto->id] = $producto;
    $request->session()->put('cart', $cart);
    //dd($productos);
    /*if ($productos->isEmpty()) {
        $mensaje = "Tu carrito está vacío (por ahora).";
    } else {
        $mensaje = null;
    }*/

    return redirect()->route('cart.index');
}


    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $total = 0;
        dd($cart);
        foreach($cart as $producto){
            dd($producto);
            $total += $producto->precio;
        }

        return view('cart', ['producto' => $cart, 'total' => $total]);
    }

    public function update(Request $request, $id)
    {
        $item = Cart::get($id);

        if ($item) {
            $quantity = $request->input('cantidad');
            $price = $item->price; // Obtener el precio unitario del artículo
            $subtotal = $price * $quantity;

            Cart::update($id, [
                'quantity' => [
                    'relative' => false,
                    'value' => $quantity,
                ],
            ]);

            return redirect()->route('cart.index')->with('success_message', 'Cantidad actualizada.');
        }

        return redirect()->route('cart.index')->with('error_message', 'El elemento no existe en el carrito.');
    }


    public function destroy($id)
    {
        $cart = $request->session()->get('cart', []);

        if(isset($cart[$producto->id])){
            unset($cart[$producto->id]);
            $request->session()->put('cart', $cart);
        }
        return redirect()->route('cart.index');
    }
}

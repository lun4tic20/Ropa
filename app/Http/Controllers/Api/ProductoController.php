<?php

namespace App\Http\Controllers\Api;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductoController extends Controller
{

    public function index()
    {
        $productos = Producto::all();

        return response()->json(['producto' => $productos]);
    }

    public function store(Request $request)
    {
        $producto = new Producto;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;
        $producto->proveedor_id = $request->proveedor_id;
        $producto->save();
        $data = [
            'message' => 'Producto creado correctamente',
            'producto' => $producto
        ];
        return response()->json($data);
    }

    public function show(Producto $producto)
    {
        return response()->json(['producto' => $producto]);
    }

    public function update(Request $request, Producto $producto)
    {
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;
        $producto->proveedor_id = $request->proveedor_id;
        $producto->save();
        $data = [
            'message' => 'Producto actualizado correctamente',
            'producto' => $producto
        ];
        return response()->json($data);
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        $data = [
            'message' => 'Producto eliminado correctamente',
            'producto' => $producto
        ];
        return response()->json($data);
    }
}

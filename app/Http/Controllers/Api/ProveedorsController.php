<?php

namespace App\Http\Controllers\Api;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProveedorController extends Controller
{

    public function index()
    {
        $proveedors = Proveedor::all();

        return response()->json(['proveedor' => $proveedors]);
    }

    public function create(Request $request)
    {
        $validated = $request->validated([
            'nombre' => 'required|max:255',
            'direccion' => 'required',
            'telefono' => 'required'
        ]);

        $proveedor = Proveedor::create($validated);
        return response()->json(['proveedor' => $proveedor], 201);
    }

    public function store(Request $request)
    {
        $proveedor = new Proveedor;
        $proveedor->nombre = $request->nombre;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->save();
        $data = [
            'message' => 'Proveedor creado correctamente',
            'proveedor' => $proveedor
        ];
        return response()->json($data);
    }

    public function show(Proveedor $proveedor)
    {
        return response()->json($proveedor);
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $proveedor->nombre = $request->nombre;
        $proveedor->direccion = $request->direccion;
        $proveedor->telefono = $request->telefono;
        $proveedor->save();
        $data = [
            'message' => 'Proveedor actualizado correctamente',
            'proveedor' => $proveedor
        ];
            return response()->json($data);

    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();
        $data = [
            'message' => 'Proveedor eliminado correctamente',
            'proveedor' => $proveedor
        ];
        return response()->json($data);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class ProveedorController extends Controller
{

    public function index(Request $request)
    {
        $url = "https://thirsty-feynman.82-223-161-36.plesk.page";
        $token = session('auth_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get($url.'/api/proveedors');
        $data = $response->json();
        $proveedores = $data['proveedor'];
        return view('proveedores', compact('proveedores', 'data'));
    }

    public function store(Request $request)
{
    $url = "https://thirsty-feynman.82-223-161-36.plesk.page";

    $token = session('auth_token');
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post($url.'/api/proveedors', [
        'nombre' => $request->nombre,
        'direccion' => $request->direccion,
        'telefono' => $request->telefono,
    ]);
    return redirect()->route('proveedor.index')->with('success_message', 'Proveedor creado correctamente.');
}

    public function update(Request $request, $idProveedor)
    {
        $url = "https://thirsty-feynman.82-223-161-36.plesk.page";

        $token = session('auth_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->put($url.'/api/proveedors/'.$idProveedor, [
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('proveedor.index')->with('success_message', 'Proveedor actualizado correctamente.');
    }

    public function destroy($idProveedor)
    {
        $url = "https://thirsty-feynman.82-223-161-36.plesk.page";
        $token = session('auth_token');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->delete($url.'/api/proveedors/'.$idProveedor);

        return redirect()->route('proveedor.index')->with('success_message', 'Proveedor eliminado correctamente.');
    }

}

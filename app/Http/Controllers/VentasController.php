<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;

class VentasController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('producto')->get();
        return view('ventas', compact('ventas'));
    }
}

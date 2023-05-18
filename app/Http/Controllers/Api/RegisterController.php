<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function register(Request $request){
        $response = Http::post('https://thirsty-feynman.82-223-161-36.plesk.page/api/register', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->status() == 201) {
            $data = $response->json();
            $token = $data['token'];
            Session::put('auth_token', $token);

            /*return response()->json([
                'message' => 'registrado correctamente',
                'user' => $data['user'],
                'token' => $token,
            ], 201);*/
            return redirect('/adminDashboard')->with('token', $token); // Redirigir al usuario a una página de bienvenida o perfil de usuario
        }
    }

}

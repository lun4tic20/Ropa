<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validateLogin($request);

        $response = Http::post('https://thirsty-feynman.82-223-161-36.plesk.page/api/login', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->status() == 200) {
            $data = $response->json();
            $token = $data['token'];

            // Almacenar el token en una variable de sesión
            session(['auth_token' => $token]);
            //dd($data);

            // Almacenar el nombre del usuario en una variable de sesión

            return redirect('/adminDashboard');
        }
    }

    public function validateLogin(Request $request){
        return $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
    }

    public function logout(Request $request)
    {
            dd($response->status());
            if ($response->status() == 200) {
                session()->forget('auth_token');
                auth()->logout();
            }

        return redirect('/login')->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }
}

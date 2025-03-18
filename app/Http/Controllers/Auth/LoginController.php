<?php
// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar el inicio de sesión
    // app/Http/Controllers/Auth/LoginController.php

public function login(Request $request)
{
    // Validar los datos del formulario
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Intentar autenticar al usuario
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate(); // Regenerar la sesión
        return redirect()->intended('/panel'); // Redirigir al panel
    }

    // Si la autenticación falla, redirigir con un mensaje de error
    return back()->withErrors([
        'email' => 'Las credenciales no coinciden.',
    ]);
}

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout(); // Cerrar la sesión
        $request->session()->invalidate(); // Invalidar la sesión
        $request->session()->regenerateToken(); // Regenerar el token de sesión
        return redirect('/'); // Redirigir a la página principal
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RegistroSeguridad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function mostrarLogin()
    {
        return view('/login');
    }

    public function mostrarRegistro()
    {
        return view('/registro');
    }

    public function registro(Request $request)
    {
        $validado = $request->validate([
            'nombres' => 'required|string|min:3|max:100',
            'apellidos' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:users|max:255',
            'password' => [
                'required',
                'min:8',
                'confirmed',  
                'regex:/[a-z]/',      
                'regex:/[A-Z]/',      
                'regex:/[0-9]/',      
                'regex:/[@$!%*#?&]/',
            ],
        ], [
            'password.regex' => 'La contraseña debe contener mayúsculas, minúsculas, números y caracteres especiales.',
            'email.unique' => 'Este email ya está registrado.',
            'nombres.required' => 'El campo nombres es obligatorio.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'email.required' => 'Es necesario que introduzca un email',
            'password.required' => 'Es necesario que introduzca una contraseña',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'Longitud minima de 8'
        ]);

        $usuario = User::create([
            'nombres' => $validado['nombres'],
            'apellidos' => $validado['apellidos'],
            'email' => $validado['email'],
            'password' => Hash::make($validado['password']),
        ]);

        RegistroSeguridad::create([
            'tipo_evento' => 'registro_exitoso',
            'usuario_id' => $usuario->id,
            'email' => $usuario->email,
            'direccion_ip' => $request->ip(),
            'detalles' => 'Usuario registrado desde ' . $request->userAgent(),
            'nivel_riesgo' => 'bajo',
        ]);
        Auth::login($usuario);
        return redirect()->route('pagina');
    }

  
    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],
        [
            'email.required' => 'Proporcione un email',
            'password.required' => 'Introduzca su contraseña',
            'email.email' => 'El email debe ser uno valido'
        ]);
        
            //reemplazando 
        if (Auth::attempt($credenciales)) {
    
            $request->session()->regenerate();

            RegistroSeguridad::create([
                'tipo_evento' => 'login_exitoso',
                'usuario_id' => Auth::id(),
                'email' => $request->email,
                'direccion_ip' => $request->ip(),
                'detalles' => 'Login exitoso desde ' . $request->userAgent(),
                'nivel_riesgo' => 'bajo',
            ]);

            $rol = Auth::user()->rol;

            if ($rol == 'admin') {
                return redirect()->route('admin_test'); //cambiar admin_test por la vista permitidas para admin
            }
            /*
            if ($rol == 'inventario') {
                return redirect()->route('productos');// pagina inventario
            }*/

            if ($rol == 'cliente') {
                return redirect()->route('pagina');//pagina a las que tiene permiso el cliente
            }

            return redirect()->route('pagina');
        }

        RegistroSeguridad::create([
            'tipo_evento' => 'login_fallido',
            'usuario_id' => null,
            'email' => $request->email,
            'direccion_ip' => $request->ip(),
            'detalles' => 'Intento de login fallido desde ' . $request->userAgent(),
            'nivel_riesgo' => 'medio',
        ]);

        return back()->with('error', 'Las credenciales no coinciden con nuestros registros.');
    }

 
    
    public function logout(Request $request)
    {
        RegistroSeguridad::create([
            'tipo_evento' => 'logout',
            'usuario_id' => Auth::id(),
            'email' => Auth::user()->email,
            'direccion_ip' => $request->ip(),
            'detalles' => 'Usuario cerró sesión',
            'nivel_riesgo' => 'bajo',
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}
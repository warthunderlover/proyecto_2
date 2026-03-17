<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RegistroSeguridad;
use Illuminate\Http\Request;
use App\Models\Productos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

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
            'nombres' => ['required','string','min:3','max:100','regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/'],
            'apellidos' => ['required','string','min:3','max:100','regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/'],
            'email' => 'required|email|unique:users|max:255',
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&\-_]/',
            ],
        ], [
            'password.regex' => 'La contraseña debe contener mayúsculas, minúsculas, números y al menos un carácter especial (@ $ ! % * # ? & - _).',
            'email.unique' => 'Este email ya está registrado.',
            'nombres.required' => 'El campo nombres es necesario.',
            'apellidos.required' => 'El campo apellidos es necesario.',
            'email.required' => 'Se necesita un email.',
            'password.required' => 'Se necesita una contraseña.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'nombres.regex' => 'El nombre solo puede contener letras, sin espacios ni guiones.',
            'apellidos.regex' => 'El apellido solo puede contener letras, sin espacios ni guiones.',
        ]);

        $usuario = User::create([
            'nombres' => $validado['nombres'],
            'apellidos' => $validado['apellidos'],
            'email' => $validado['email'],
            'password' => Hash::make($validado['password']),
            'rol'=>'cliente',
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
        return redirect()->route('compras.Bienvenida')->with('success', 'Registro exitoso. Bienvenido a la tienda.');
    }

    public function login(Request $request)
    {
        $clave = Str::lower($request->email).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($clave, 5)) {
            return back()->with('error', 'Demasiados intentos. Intente nuevamente en 1 minuto.');
        }

        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Se necesita un email',
            'password.required' => 'Se necesita una contraseña',
            'email.email' => 'El email debe ser válido'
        ]);
        
            //reemplazando 
        if (Auth::attempt($credenciales)) {
    
            $request->session()->regenerate();
            RateLimiter::clear($clave);

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
                return redirect()->route('admin.inicio'); //cambiar admin_test por la vista permitidas para admin
            }
            /*
            if ($rol == 'inventario') {
                return redirect()->route('productos');// pagina inventario
            }*/

            if ($rol == 'cliente') {
                return redirect()->route('compras.Bienvenida');//pagina a las que tiene permiso el cliente
            }

            return redirect()->route('compras.Bienvenida');
        }

        RateLimiter::hit($clave, 60);

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
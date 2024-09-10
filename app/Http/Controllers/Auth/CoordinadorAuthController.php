<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Coordinador;
use Illuminate\Support\Facades\Hash; // Para manejar la encriptación de la contraseña

class CoordinadorAuthController extends Controller
{
    // Mostrar el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('vendor.adminlte.auth.coordinador-login');
    }

    // Manejar el inicio de sesión
    public function login(Request $request)
    {
        $credentials = $request->only('correo', 'password'); // Asegúrate de que 'correo' sea el campo correcto

        if (Auth::guard('coordinador')->attempt($credentials)) {
            return redirect()->intended('/home'); // Redirige a la página de inicio o dashboard
        }

        return back()->withErrors([
            'correo' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    // Mostrar el formulario de registro
    public function showRegisterForm()
    {
        $programasAcademicos = \App\Models\ProgramaAcademico::all();

        return view('vendor.adminlte.auth.coordinador-register', [
            'programasAcademicos' => $programasAcademicos
        ]);
    }

    // Manejar el registro
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|max:255',
            'programa_academico' => 'required|exists:programa_academicos,id',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|string|email|max:255|unique:coordinadors',
            'genero' => 'nullable|string|max:10',
            'fecha_nacimiento' => 'nullable|date',
            'fecha_vinculacion' => 'required|date',
            'acuerdo_vinculacion' => 'nullable|file|mimes:pdf|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Manejar el archivo si se proporciona
        $path = null;
        if ($request->hasFile('acuerdo_vinculacion')) {
            $path = $request->file('acuerdo_vinculacion')->store('acuerdos'); // Guarda el archivo en la carpeta "acuerdos"
        }

        // Crear un nuevo Coordinador
        $coordinador = Coordinador::create([
            'nombre' => $request->nombre,
            'identificacion' => $request->identificacion,
            'programa_academico_id' => $request->programa_academico,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'genero' => $request->genero,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'fecha_vinculacion' => $request->fecha_vinculacion,
            'acuerdo_vinculacion' => $path,
            'password' => Hash::make($request->password), // Encriptar la contraseña
        ]);

        // Loguear al usuario recién registrado
        Auth::guard('coordinador')->login($coordinador);

        return redirect()->intended('/home'); // Redirige al dashboard
    }

    // Manejar el cierre de sesión
    public function logout(Request $request)
    {
        Auth::guard('coordinador')->logout();

        return redirect('/');
    }
}

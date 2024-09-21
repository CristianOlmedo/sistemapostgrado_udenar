<?php

namespace App\Http\Controllers;

use App\Models\Presidente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Models\ProgramaAcademico;

class PresidenteController extends Controller
{
    public function index()
    {
        $presidentes = Presidente::all();
        return view('admin.presidente.index', compact('presidentes'));
    }

    public function create()
    {
        $programas = ProgramaAcademico::all(); // Asegúrate de obtener los programas académicos
        return view('admin.presidente.create', compact('programas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'correo_electronico' => 'required|email|max:255|unique:presidentes,correo_electronico',
            'numero_identificacion' => 'required|string|max:20|unique:presidentes,numero_identificacion',
            'telefono' => 'required|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'fecha_inicio_gestion' => 'required|date',
            'fecha_fin_gestion' => 'nullable|date',
            'departamento_o_facultad' => 'required|string|max:255',
            'programa_academico' => 'required|string|max:255',  // Corregido aquí
            'estado' => 'required|string|max:10',
            'resoluciones' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Convertir el estado a booleano antes de guardar
        $validatedData['estado'] = $validatedData['estado'] === 'Activo' ? 1 : 0;

        // Manejo del archivo de resoluciones
        if ($request->hasFile('resoluciones')) {
            $file = $request->file('resoluciones');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->storeAs('resoluciones', $filename, 'public');
            $validatedData['resoluciones'] = $filename;
        }
        Log::info('Este es un mensaje de prueba para crear el archivo laravel.log');
        try {
            Presidente::create($validatedData);
            Session::flash('swal:success', 'Presidente creado correctamente.');
            return redirect()->route('presidente.index');
        } catch (QueryException $e) {
            Log::error('Error al crear presidente: ' . $e->getMessage());
            Session::flash('swal:error', 'Error al crear el presidente.');
            return redirect()->back()->withInput();
        }
    }


    public function edit(Presidente $presidente)
    {
        $programas = ProgramaAcademico::all();
        return view('admin.presidente.edit', compact('presidente', 'programas'));
    }

    public function update(Request $request, Presidente $presidente)
    {
        $validatedData = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'correo_electronico' => 'required|email|max:255',
            'numero_identificacion' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'fecha_inicio_gestion' => 'required|date',
            'fecha_fin_gestion' => 'nullable|date',
            'departamento_o_facultad' => 'required|string|max:255',
            'programa_academico' => 'required|string|max:255',
            'estado' => 'required|string|max:10',
            'resoluciones' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $validatedData['estado'] = $validatedData['estado'] === 'Activo' ? 1 : 0;

        try {
            $presidente->update($validatedData);
            Session::flash('swal:success', 'Presidente actualizado correctamente.');
            return redirect()->route('presidente.index');
        } catch (QueryException $e) {
            Log::error('Error al actualizar presidente: ' . $e->getMessage());
            Session::flash('swal:error', 'Error al actualizar el presidente.');
            return redirect()->back()->withInput();
        }
    }
}

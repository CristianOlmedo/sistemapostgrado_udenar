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
        return view('admin.presidente.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:presidentes,correo',
            'identificacion' => 'required|string|max:20|unique:presidentes,identificacion',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'fecha_inicio_gestion' => 'required|date',
            'fecha_fin_gestion' => 'nullable|date',
            'departamento' => 'required|string|max:255',
            'programa_academico_id' => 'required|exists:programa_academicos,id',
            'estado' => 'required|string|max:10', // Validación cambiada
            'resoluciones' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Convertir el estado a booleano antes de guardar
        $validatedData['estado'] = $validatedData['estado'] === 'Activo' ? 1 : 0;

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
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'identificacion' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'fecha_inicio_gestion' => 'required|date',
            'fecha_fin_gestion' => 'nullable|date',
            'departamento' => 'required|string|max:255',
            'programa_academico_id' => 'required|exists:programa_academicos,id',
            'estado' => 'required|string|max:10', // Validación cambiada
            'resoluciones' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Convertir el estado a booleano antes de actualizar
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

    public function destroy(Presidente $presidente)
    {
        $presidente->delete();
        Session::flash('swal:success', 'Presidente eliminado correctamente.');
        return redirect()->route('presidente.index');
    }
}

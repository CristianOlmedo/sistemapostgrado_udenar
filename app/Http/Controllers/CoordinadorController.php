<?php

namespace App\Http\Controllers;

use App\Models\Coordinador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Models\ProgramaAcademico;

class CoordinadorController extends Controller
{
    public function index()
    {
        $coordinadores = Coordinador::all();
        return view('admin.coordinador.index', compact('coordinadores'));
    }

    public function create()
    {
        $programas = ProgramaAcademico::all(); // Obtén los programas académicos
        return view('admin.coordinador.create', compact('programas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|max:20|unique:coordinadores,identificacion',
            'programa_academico_id' => 'required|exists:programa_academicos,id',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255|unique:coordinadores,correo',
            'genero' => 'required|string|max:10',
            'fecha_nacimiento' => 'nullable|date',
            'fecha_vinculacion' => 'required|date',
            'acuerdo_vinculacion' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        try {
            Coordinador::create($validatedData);
            Session::flash('swal:success', 'Coordinador creado correctamente.');
            return redirect()->route('coordinador.index');
        } catch (QueryException $e) {
            Log::error('Error al crear coordinador: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error al crear el coordinador.'])->withInput();
        }
    }

    public function edit(Coordinador $coordinador)
    {
        $programas = ProgramaAcademico::all(); // Obtén los programas académicos para el formulario de edición
        return view('admin.coordinador.edit', compact('coordinador', 'programas'));
    }

    public function update(Request $request, Coordinador $coordinador)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|max:20',
            'programa_academico_id' => 'required|exists:programa_academicos,id',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255',
            'genero' => 'required|string|max:10',
            'fecha_nacimiento' => 'nullable|date',
            'fecha_vinculacion' => 'required|date',
            'acuerdo_vinculacion' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $coordinador->update($validatedData);
        Session::flash('swal:success', 'Coordinador actualizado correctamente.');
        return redirect()->route('coordinador.index');
    }

    public function destroy(Coordinador $coordinador)
    {
        $coordinador->delete();
        Session::flash('swal:success', 'Coordinador eliminado correctamente.');
        return redirect()->route('coordinador.index');
    }
}

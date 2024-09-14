<?php

namespace App\Http\Controllers;

use App\Models\Cohorte;
use App\Models\ProgramaAcademico;
use Illuminate\Http\Request;

class CohorteController extends Controller
{
    /**
     * Mostrar una lista de las cohortes.
     */
    public function index()
    {
        $cohortes = Cohorte::with('programa')->get();
        return view('admin.cohorte.index', compact('cohortes'));
    }

    /**
     * Mostrar el formulario para crear una nueva cohorte.
     */
    public function create()
    {
        $programas = ProgramaAcademico::all();
        return view('admin.cohorte.create', compact('programas'));
    }

    /**
     * Guardar una nueva cohorte en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:255|unique:cohortes,codigo',
            'nombre' => 'required|string|max:255',
            'programa_id' => 'required|exists:programa_academicos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'numero_estudiantes_matriculados' => 'required|integer|min:0',
        ]);

        // Crear una nueva cohorte
        Cohorte::create($validatedData);

        return redirect()->route('cohorte.index')->with('success', 'Cohorte creada correctamente.');
    }

    /**
     * Mostrar el formulario para editar una cohorte.
     */
    public function edit(Cohorte $cohorte)
    {
        $programas = ProgramaAcademico::all();
        return view('admin.cohorte.edit', compact('cohorte', 'programas'));
    }

    /**
     * Actualizar una cohorte en la base de datos.
     */
    public function update(Request $request, Cohorte $cohorte)
    {
        // Validar los datos actualizados
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:255|unique:cohortes,codigo,' . $cohorte->id,
            'nombre' => 'required|string|max:255',
            'programa_id' => 'required|exists:programa_academicos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'numero_estudiantes_matriculados' => 'required|integer|min:0',
        ]);

        // Actualizar la cohorte
        $cohorte->update($validatedData);

        return redirect()->route('cohorte.index')->with('success', 'Cohorte actualizada correctamente.');
    }

    /**
     * Eliminar una cohorte de la base de datos.
     */
    public function destroy(Cohorte $cohorte)
    {
        $cohorte->delete();
        return redirect()->route('cohorte.index')->with('success', 'Cohorte eliminada correctamente.');
    }
}

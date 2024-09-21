<?php

namespace App\Http\Controllers;

use App\Models\Auxiliar;
use App\Models\ProgramaAcademico;
use Illuminate\Http\Request;

class AuxiliarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtén los auxiliares y sus programas académicos relacionados
        $auxiliares = Auxiliar::with('programa')->get();

        // Retorna la vista y pasa los datos
        return view('admin.auxiliar.index', compact('auxiliares'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programas = ProgramaAcademico::all();
        //Mostrar Formulario de creación
        //return view('admin.auxiliar.create');
        // Pasar los programas a la vista
        return view('admin.auxiliar.create', compact('programas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|max:255|unique:auxiliars,identificacion',
            'programa_academico_id' => 'required|exists:programa_academicos,id',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'correo' => 'required|email|unique:auxiliars',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'fecha_nacimiento' => 'required|date',
            'fecha_vinculacion' => 'required|date',
            'acuerdo_vinculacion' => 'nullable|file|mimes:pdf|max:2048',
        ]);
        // Crear un nuevo auxiliar con los datos validados
        $auxiliar = new Auxiliar($validatedData);

        // Si se carga un nuevo archivo, reemplazar el anterior
        if ($request->hasFile('acuerdo_vinculacion')) {
            $filePath = $request->file('acuerdo_vinculacion')->store('acuerdos_vinculacion');
            $auxiliar->acuerdo_vinculacion = $filePath;
        }

        // Guardar el coordinador en la base de datos
        $auxiliar->save();
        // Mensaje de éxito
        return redirect()->route('auxiliar.index')->with('success', 'Auxiliar creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Auxiliar $auxiliar)
    {
        $programas = ProgramaAcademico::all();
        return view('admin.auxiliar.edit', compact('auxiliar', 'programas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Auxiliar $auxiliar)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|max:255|unique:auxiliars,identificacion,' . $auxiliar->id,
            'programa_academico_id' => 'required|exists:programa_academicos,id',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'correo' => 'required|email|max:255|unique:auxiliars,correo,' . $auxiliar->id,
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'fecha_nacimiento' => 'required|date',
            'fecha_vinculacion' => 'required|date',
            'acuerdo_vinculacion' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Actualizar el auxiliar con los datos validados
        $auxiliar->update($validatedData);

        // Si se carga un nuevo archivo, reemplazar el anterior
        if ($request->hasFile('acuerdo_vinculacion')) {
            $filePath = $request->file('acuerdo_vinculacion')->store('acuerdos_vinculacion');
            $auxiliar->acuerdo_vinculacion = $filePath;
        }

        $auxiliar->save();

        return redirect()->route('auxiliar.index')->with('success', 'Auxiliar actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auxiliar $auxiliar)
    {
        $auxiliar->delete();
        return redirect()->route('auxiliar.index')->with('success', 'Auxiliar eliminado correctamente.');
    }
}

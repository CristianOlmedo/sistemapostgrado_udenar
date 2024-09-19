<?php

namespace App\Http\Controllers;

use App\Models\Auxiliar;
use App\Models\Docente;
use App\Models\ProgramaAcademico;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los docentes
        $docentes = Docente::all();

        // Pasar los presidentes a la vista
        return view('admin.docente.index', compact('docentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.docente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|max:255|unique:auxiliars,identificacion',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'correo' => 'required|email|unique:auxiliars',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'fecha_nacimiento' => 'required|date',
            'formacion_academica' => 'required|in:Pregrado,Postgrado',
            'area_conocimiento' => 'required|in:Ingenieria de Software,Telecomunicaciones,Bases de datos',
        ]);
        // Crear nuevo docente
        Docente::create($validatedData);

        return redirect()->route('docente.index')->with('success', 'Cohorte creada correctamente.');

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
    public function edit(string $id)
    {
        return view('admin.docente.edit', compact('docente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Auxiliar $docente)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|max:255|unique:auxiliars,identificacion',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'correo' => 'required|email|unique:auxiliars',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'fecha_nacimiento' => 'required|date',
            'formacion_academica' => 'required|in:Pregrado,Postgrado',
            'area_conocimiento' => 'required|in:Ingenieria de Software,Telecomunicaciones,Bases de datos',
        ]);
        $docente->update($validatedData);

        return redirect()->route('docente.index')->with('success', 'Docente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Docente $docente)
    {
        $docente->delete();
        return redirect()->route('docente.index')->with('success', 'Docente eliminado correctamente.');
    }
}

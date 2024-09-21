<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Cohorte;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    // Obtén los Estudiante y sus cohortes relacionadas
    $estudiantes = Estudiante::with('cohorte')->get();

    // Retorna la vista y pasa los datos
    return view('admin.estudiante.index', compact('estudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cohortes = Cohorte::all();
        //Mostrar Formulario de creación
        //return view('admin.auxiliar.create');
        // Pasar los programas a la vista
        return view('admin.estudiante.create', compact('cohortes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'cohorte_id' => 'required|exists:cohortes,id',
            'identificacion' => 'required|string|max:255|unique:estudiantes,identificacion',
            'codigo_estudiantil' => 'required|string|max:255|unique:estudiantes,codigo_estudiantil',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'correo' => 'required|email|unique:estudiantes',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'fecha_nacimiento' => 'required|date',
            'semestre' => 'required|integer|min:1',
            'fecha_ingreso' => 'required|date',
            'fecha_egreso' => 'required|date',
        ]);
        // Crear un nuevo estudiante con los datos validados
        $estudiante = new Estudiante($validatedData);

        // Si hay una foto, guardarlo en el almacenamiento y guardar la ruta
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos');
            $estudiante->foto = $fotoPath;
        }


        // Guardar el coordinador en la base de datos
        $estudiante->save();        
        // Mensaje de éxito
        return redirect()->route('estudiante.index')->with('success', 'Estudiante creado correctamente.');

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
        $estudiante = Estudiante::all();
        return view('admin.estudiante.edit', compact('estudiante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Estudiante $estudiante)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'cohorte_id' => 'required|exists:cohortes,id',
            'identificacion' => 'required|string|max:255',
            'codigo_estudiantil' => 'required|string|max:255|unique:estudiantes,codigo_estudiantil',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'correo' => 'required|email|unique:estudiantes',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'fecha_nacimiento' => 'required|date',
            'semestre' => 'required|integer|min:1',
            'fecha_ingreso' => 'required|date',
            'fecha_egreso' => 'required|date',
        ]);
        $estudiante->update($validatedData);

        return redirect()->route('estudiante.index')->with('success', 'Estudiante actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();
        return redirect()->route('estudiante.index')->with('success', 'Estudiante eliminado correctamente.');
    }
}

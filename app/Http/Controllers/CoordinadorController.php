<?php

namespace App\Http\Controllers;

use App\Models\Coordinador; // Asegúrate de tener este modelo
use Illuminate\Http\Request;

class CoordinadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los coordinadores
        $coordinadores = Coordinador::all();

        // Pasar los coordinadores a la vista
        return view('admin.coordinador.index', compact('coordinadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coordinador.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:coordinadores',
            'identificacion' => 'required|string|max:20|unique:coordinadores',
            'telefono' => 'required|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'genero' => 'required|string',
            'fecha_nacimiento' => 'nullable|date',
            'fecha_vinculacion' => 'required|date',
            'acuerdo_vinculacion' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Crear nuevo coordinador
        $coordinador = new Coordinador($validatedData);

        // Si hay un archivo, guardarlo en el almacenamiento y guardar la ruta
        if ($request->hasFile('acuerdo_vinculacion')) {
            $filePath = $request->file('acuerdo_vinculacion')->store('acuerdos');
            $coordinador->acuerdo_vinculacion = $filePath;
        }

        // Guardar el coordinador en la base de datos
        $coordinador->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('coordinador.index')->with('success', 'Coordinador creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coordinador $coordinador)
    {
        return view('admin.coordinador.show', compact('coordinador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coordinador $coordinador)
    {
        return view('admin.coordinador.edit', compact('coordinador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coordinador $coordinador)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:coordinadores,correo,' . $coordinador->id,
            'identificacion' => 'required|string|max:20|unique:coordinadores,identificacion,' . $coordinador->id,
            'telefono' => 'required|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'genero' => 'required|string',
            'fecha_nacimiento' => 'nullable|date',
            'fecha_vinculacion' => 'required|date',
            'acuerdo_vinculacion' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Actualizar los datos del coordinador
        $coordinador->update($validatedData);

        // Si se carga un nuevo archivo, reemplazar el anterior
        if ($request->hasFile('acuerdo_vinculacion')) {
            $filePath = $request->file('acuerdo_vinculacion')->store('acuerdos');
            $coordinador->acuerdo_vinculacion = $filePath;
        }

        // Guardar los cambios
        $coordinador->save();

        return redirect()->route('coordinador.index')->with('success', 'Coordinador actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coordinador $coordinador)
    {
        // Eliminar el coordinador
        $coordinador->delete();

        return redirect()->route('coordinador.index')->with('success', 'Coordinador eliminado correctamente.');
    }
}

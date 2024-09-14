<?php

namespace App\Http\Controllers;

use App\Models\Presidente;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PresidenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los presidentes
        $presidentes = Presidente::all();

        // Pasar los presidentes a la vista
        return view('admin.presidente.index', compact('presidentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.presidente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'correo_electronico' => 'required|email|max:255',
            'numero_identificacion' => 'required|string|max:20|unique:presidentes,numero_identificacion',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'fecha_inicio_gestion' => 'required|date',
            'fecha_fin_gestion' => 'required|date',
            'departamento_o_facultad' => 'required|string|max:255',
            'programa_academico' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'resoluciones_o_nombramientos' => 'nullable|file|mimes:pdf',
        ]);

        try {
            // Crear nuevo presidente
            $presidente = new Presidente($validatedData);

            // Si hay un archivo, guardarlo en el almacenamiento y guardar la ruta
            if ($request->hasFile('resoluciones_o_nombramientos')) {
                $filePath = $request->file('resoluciones_o_nombramientos')->store('resoluciones');
                $presidente->resoluciones_o_nombramientos = $filePath;
            }

            // Guardar el presidente en la base de datos
            $presidente->save();

            // Guardar un mensaje en la sesión para SweetAlert
            Session::flash('swal:success', 'Presidente creado correctamente.');

            return redirect()->route('presidente.index');
        } catch (QueryException $e) {
            // Loguear el error
            Log::error('Error al crear presidente: ' . $e->getMessage());

            // Guardar un mensaje de error en la sesión para SweetAlert
            Session::flash('swal:error', 'Error al crear el presidente: el número de identificación ya existe.');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Presidente $presidente)
    {
        return view('admin.presidente.show', compact('presidente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presidente $presidente)
    {
        return view('admin.presidente.edit', compact('presidente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presidente $presidente)
    {
        // Validar los datos actualizados
        $validatedData = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'correo_electronico' => 'required|email|max:255',
            'numero_identificacion' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'fecha_inicio_gestion' => 'required|date',
            'fecha_fin_gestion' => 'nullable|date',
            'departamento_o_facultad' => 'required|string|max:255',
            'programa_academico' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'resoluciones_o_nombramientos' => 'nullable|file|mimes:pdf',
        ]);

        // Actualizar los datos del presidente
        $presidente->update($validatedData);

        // Si se carga un nuevo archivo, reemplazar el anterior
        if ($request->hasFile('resoluciones_o_nombramientos')) {
            $filePath = $request->file('resoluciones_o_nombramientos')->store('resoluciones');
            $presidente->resoluciones_o_nombramientos = $filePath;
        }

        // Guardar los cambios
        $presidente->save();

        // Guardar un mensaje en la sesión para SweetAlert
        Session::flash('swal:success', 'Presidente actualizado correctamente.');

        return redirect()->route('presidente.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presidente $presidente)
    {
        // Eliminar el presidente
        $presidente->delete();

        // Guardar un mensaje en la sesión para SweetAlert
        Session::flash('swal:success', 'Presidente eliminado correctamente.');

        return redirect()->route('presidente.index');
    }
}

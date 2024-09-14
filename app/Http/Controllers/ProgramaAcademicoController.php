<?php

namespace App\Http\Controllers;

use App\Models\ProgramaAcademico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ProgramaAcademicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los programas académicos
        $programas = ProgramaAcademico::all();

        // Convertir fecha_resolucion a un objeto Carbon
        foreach ($programas as $programa) {
            $programa->fecha_resolucion = Carbon::parse($programa->fecha_resolucion);
        }

        // Pasar los programas a la vista
        return view('admin.programa_academico.index', compact('programas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.programa_academico.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'codigo_snies' => 'required|string|max:255|unique:programa_academicos,codigo_snies',
            'nombre_programa' => 'required|string|max:255|unique:programa_academicos,nombre_programa',
            'descripcion' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'correo' => 'required|email|max:255|unique:programa_academicos,correo',
            'fecha_resolucion' => 'required|date',
            'numero_resolucion' => 'required|string|max:255',
            'archivo_resolucion' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        try {
            // Crear nuevo programa académico
            $programa = new ProgramaAcademico($validatedData);

            // Si hay un logo, guardarlo en el almacenamiento y guardar la ruta
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('logos');
                $programa->logo = $logoPath;
            }

            // Si hay un archivo de resolución, guardarlo en el almacenamiento y guardar la ruta
            if ($request->hasFile('archivo_resolucion')) {
                $resolucionPath = $request->file('archivo_resolucion')->store('resoluciones');
                $programa->archivo_resolucion = $resolucionPath;
            }

            // Guardar el programa académico en la base de datos
            $programa->save();

            // Guardar un mensaje en la sesión para SweetAlert
            Session::flash('swal:success', 'Programa académico creado correctamente.');

            return redirect()->route('programa_academico.index');
        } catch (QueryException $e) {
            // Loguear el error
            Log::error('Error al crear programa académico: ' . $e->getMessage());

            // Guardar un mensaje de error en la sesión para SweetAlert
            Session::flash('swal:error', 'Error al crear el programa académico: el código SNIES o el nombre ya existe.');

            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramaAcademico $programaAcademico)
    {
        return view('admin.programa_academico.show', compact('programaAcademico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramaAcademico $programaAcademico)
    {
        return view('admin.programa_academico.edit', compact('programaAcademico'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramaAcademico $programaAcademico)
    {
        // Validar los datos actualizados
        $validatedData = $request->validate([
            'codigo_snies' => 'required|string|max:255',
            'nombre_programa' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'correo' => 'required|email|max:255',
            'fecha_resolucion' => 'required|date',
            'numero_resolucion' => 'required|string|max:255',
            'archivo_resolucion' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Actualizar los datos del programa académico
        $programaAcademico->update($validatedData);

        // Si se carga un nuevo logo, reemplazar el anterior
        if ($request->hasFile('logo')) {
            // Eliminar el logo anterior si existe
            if ($programaAcademico->logo) {
                Storage::delete($programaAcademico->logo);
            }
            $logoPath = $request->file('logo')->store('logos');
            $programaAcademico->logo = $logoPath;
        }

        // Si se carga un nuevo archivo de resolución, reemplazar el anterior
        if ($request->hasFile('archivo_resolucion')) {
            // Eliminar el archivo de resolución anterior si existe
            if ($programaAcademico->archivo_resolucion) {
                Storage::delete($programaAcademico->archivo_resolucion);
            }
            $resolucionPath = $request->file('archivo_resolucion')->store('resoluciones');
            $programaAcademico->archivo_resolucion = $resolucionPath;
        }

        // Guardar los cambios
        $programaAcademico->save();

        return redirect()->route('programa_academico.index')->with('success', 'Programa académico actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramaAcademico $programaAcademico)
    {
        // Eliminar los archivos asociados
        if ($programaAcademico->logo) {
            Storage::delete($programaAcademico->logo);
        }
        if ($programaAcademico->archivo_resolucion) {
            Storage::delete($programaAcademico->archivo_resolucion);
        }

        // Eliminar el programa académico
        $programaAcademico->delete();

        return redirect()->route('programa_academico.index')->with('success', 'Programa académico eliminado correctamente.');
    }
}

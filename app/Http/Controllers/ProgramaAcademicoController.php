<?php

namespace App\Http\Controllers;

use App\Models\ProgramaAcademico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class ProgramaAcademicoController extends Controller
{
    public function index()
    {
        $programas = ProgramaAcademico::all();
        return view('admin.programa_academico.index', compact('programas'));
    }

    public function create()
    {
        return view('admin.programa_academico.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'codigo_snies' => 'required|string|max:255|unique:programa_academicos,codigo_snies',
            'nombre_programa' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'correo' => 'required|email|max:255|unique:programa_academicos,correo',
            'logo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'fecha_resolucion' => 'required|date',
            'numero_resolucion' => 'required|string|max:255',
            'archivo_resolucion' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        try {
            ProgramaAcademico::create($validatedData);
            Session::flash('swal:success', 'Programa Académico creado correctamente.');
            return redirect()->route('programa_academico.index');
        } catch (QueryException $e) {
            Log::error('Error al crear programa académico: ' . $e->getMessage());
            Session::flash('swal:error', 'Error al crear el programa académico.');
            return redirect()->back()->withInput();
        }
    }

    public function edit(ProgramaAcademico $programaAcademico)
    {
        return view('admin.programa_academico.edit', compact('programaAcademico'));
    }

    public function update(Request $request, ProgramaAcademico $programaAcademico)
    {
        $validatedData = $request->validate([
            'codigo_snies' => 'required|string|max:255',
            'nombre_programa' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'correo' => 'required|email|max:255',
            'logo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            'fecha_resolucion' => 'required|date',
            'numero_resolucion' => 'required|string|max:255',
            'archivo_resolucion' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $programaAcademico->update($validatedData);
        Session::flash('swal:success', 'Programa Académico actualizado correctamente.');
        return redirect()->route('programa_academico.index');
    }

    public function destroy(ProgramaAcademico $programaAcademico)
    {
        $programaAcademico->delete();
        Session::flash('swal:success', 'Programa Académico eliminado correctamente.');
        return redirect()->route('programa_academico.index');
    }
}

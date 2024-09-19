<?php

namespace App\Http\Controllers;

use App\Models\Cohorte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Models\ProgramaAcademico;

class CohorteController extends Controller
{
    public function index()
    {
        $cohortes = Cohorte::all();
        return view('admin.cohorte.index', compact('cohortes'));
    }

    public function create()
    {
        return view('admin.cohorte.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:255|unique:cohortes,codigo',
            'nombre' => 'required|string|max:255',
            'programa_id' => 'required|exists:programa_academicos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'num_estudiantes_matriculados' => 'required|integer|min:0',
        ]);

        try {
            Cohorte::create($validatedData);
            Session::flash('swal:success', 'Cohorte creada correctamente.');
            return redirect()->route('cohorte.index');
        } catch (QueryException $e) {
            Log::error('Error al crear la cohorte: ' . $e->getMessage());
            Session::flash('swal:error', 'Error al crear la cohorte.');
            return redirect()->back()->withInput();
        }
    }

    public function edit(Cohorte $cohorte)
    {
        $programas = ProgramaAcademico::all();
        return view('admin.cohorte.edit', compact('cohorte', 'programas'));
    }

    public function update(Request $request, Cohorte $cohorte)
    {
        $validatedData = $request->validate([
            'codigo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'programa_id' => 'required|exists:programa_academicos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'numero_estudiantes_matriculados' => 'required|integer|min:0',
        ]);

        $cohorte->update($validatedData);
        Session::flash('swal:success', 'Cohorte actualizada correctamente.');
        return redirect()->route('cohorte.index');
    }

    public function destroy(Cohorte $cohorte)
    {
        $cohorte->delete();
        Session::flash('swal:success', 'Cohorte eliminada correctamente.');
        return redirect()->route('cohorte.index');
    }
}

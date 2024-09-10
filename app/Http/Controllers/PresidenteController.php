<?php

namespace App\Http\Controllers;

use App\Models\Presidente;
use Illuminate\Http\Request;

class PresidenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.presidente.index');
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
    public function store(Request $request){
        // Validación y creación de presidente
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Lógica para guardar presidente
        Presidente::create([
            'name' => $request->name,
        ]);

        return redirect()->route('presidente.create')->with('success', 'Presidente creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presidente $presidente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presidente $presidente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presidente $presidente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presidente $presidente)
    {
        //
    }
}

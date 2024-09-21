<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PresidenteController;
use App\Http\Controllers\CoordinadorController;
use App\Http\Controllers\ProgramaAcademicoController;
use App\Http\Controllers\AuxiliarController;
use App\Http\Controllers\CohorteController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EstudianteController;
use Illuminate\Support\Facades\Auth;



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Rutas para Presidente
Route::get('admin/presidente', [PresidenteController::class, 'index'])->name('presidente.index');
Route::get('admin/presidente/create', [PresidenteController::class, 'create'])->name('presidente.create');
Route::post('admin/presidente', [PresidenteController::class, 'store'])->name('presidente.store');
Route::get('presidente/{presidente}/edit', [PresidenteController::class, 'edit'])->name('presidente.edit');
Route::put('admin/presidente/{presidente}', [PresidenteController::class, 'update'])->name('presidente.update');
Route::delete('admin/presidente/{presidente}', [PresidenteController::class, 'destroy'])->name('presidente.destroy');


// Rutas para Coordinador
Route::get('/admin/coordinador', [CoordinadorController::class, 'index'])->name('coordinador.index');
Route::get('/admin/coordinador/crear', [CoordinadorController::class, 'create'])->name('coordinador.create');
Route::post('/admin/coordinador', [CoordinadorController::class, 'store'])->name('coordinador.store');
Route::get('/admin/coordinador/{coordinador}/edit', [CoordinadorController::class, 'edit'])->name('coordinador.edit');
Route::put('/admin/coordinador/{coordinador}', [CoordinadorController::class, 'update'])->name('coordinador.update');
Route::delete('/admin/coordinador/{coordinador}', [CoordinadorController::class, 'destroy'])->name('coordinador.destroy');


// Rutas para Programa Académico
Route::get('admin/programa', [ProgramaAcademicoController::class, 'index'])->name('programa_academico.index');
Route::get('/programa_academico/create', [ProgramaAcademicoController::class, 'create'])->name('programa_academico.create');
Route::post('admin/programa', [ProgramaAcademicoController::class, 'store'])->name('programa_academico.store');
Route::get('admin/programa/{programaAcademico}/edit', [ProgramaAcademicoController::class, 'edit'])->name('programa_academico.edit');
Route::put('admin/programa/{programaAcademico}', [ProgramaAcademicoController::class, 'update'])->name('programa_academico.update');
Route::delete('admin/programa/{programaAcademico}', [ProgramaAcademicoController::class, 'destroy'])->name('programa_academico.destroy');


// Rutas para Cohorte
Route::get('admin/cohorte', [CohorteController::class, 'index'])->name('cohorte.index');
Route::get('admin/cohorte/create', [CohorteController::class, 'create'])->name('cohorte.create');
Route::post('admin/cohorte', [CohorteController::class, 'store'])->name('cohorte.store');
Route::get('admin/cohorte/{cohorte}/edit', [CohorteController::class, 'edit'])->name('cohorte.edit');
Route::put('admin/cohorte/{cohorte}', [CohorteController::class, 'update'])->name('cohorte.update');
Route::delete('admin/cohorte/{cohorte}', [CohorteController::class, 'destroy'])->name('cohorte.destroy');

//Rutas para Auxiliares
Route::resource('auxiliar', AuxiliarController::class);
Route::get('admin/auxiliar', [AuxiliarController::class, 'index'])->name('auxiliares.index');
Route::get('admin/auxiliares/create', [AuxiliarController::class, 'create'])->name('auxiliares.create');
Route::post('admin/auxiliares', [AuxiliarController::class, 'store'])->name('auxiliares.store');
Route::get('admin/auxiliares/{id}/edit', [AuxiliarController::class, 'edit'])->name('auxiliares.edit');
Route::put('admin/auxiliares/{id}', [AuxiliarController::class, 'update'])->name('auxiliares.update');
Route::delete('admin/auxiliares/{id}', [AuxiliarController::class, 'destroy'])->name('auxiliares.destroy');

// Rutas para Docentes
Route::get('/admin/docente', [DocenteController::class, 'index'])->name('docente.index');
Route::get('/docente/crear', [DocenteController::class, 'create'])->name('docente.create');
Route::post('/docente', [DocenteController::class, 'store'])->name('docente.store');
Route::get('admin/docente/{id}/edit', [DocenteController::class, 'edit'])->name('docente.edit');
Route::put('admin/docente/{id}', [DocenteController::class, 'update'])->name('docente.update');
Route::delete('admin/docente/{id}', [DocenteController::class, 'destroy'])->name('docente.destroy');

// Rutas para Estudiantes
Route::get('/admin/estudiante', [EstudianteController::class, 'index'])->name('estudiante.index');
Route::get('/estudiante/crear', [EstudianteController::class, 'create'])->name('estudiante.create');
Route::post('/estudiante', [EstudianteController::class, 'store'])->name('estudiante.store');
Route::get('admin/estudiante/{id}/edit', [EstudianteController::class, 'edit'])->name('estudiante.edit');
Route::put('admin/estudiante/{estudiante}', [EstudianteController::class, 'update'])->name('estudiante.update');
Route::delete('admin/estudiante/{id}', [EstudianteController::class, 'destroy'])->name('estudiante.destroy');

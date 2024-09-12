<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ClientaController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CitaController;
use Illuminate\Support\Facades\Route;

// Rutas para Clientas 
Route::get('/clientas', [ClientaController::class, 'index']);
Route::get('/clientas/{id}', [ClientaController::class, 'show']);
Route::post('/clientas', [ClientaController::class, 'store']);
Route::put('/clientas/{id}',[ClientaController::class, 'update']);
Route::delete('/clientas/{id}',[ClientaController::class, 'destroy']);

//Rutas para servicios
Route::get('/servicios',[ServicioController::class, 'index']);
Route::get('/servicios/{id}', [ServicioController::class, 'show']);
Route::post('/servicios',[ServicioController::class, 'store']);
Route::put('/servicios/{id}',[ServicioController::class, 'update']);
Route::delete('/servicios/{id}',[ServicioController::class, 'destroy']);

//Rutas para empleados
Route::get('/empleados',[EmpleadoController::class, 'index']);
Route::get('/empleados/{id}', [EmpleadoController::class, 'show']);
Route::post('/empleados',[EmpleadoController::class, 'store']);
Route::put('/empleados/{id}',[EmpleadoController::class, 'update']);
Route::delete('/empleados/{id}',[EmpleadoController::class, 'destroy']);

//Rutas para productos
Route::get('/productos',[ProductoController::class, 'index']);
Route::get('/productos/{id}', [ProductoController::class, 'show']);
Route::post('/productos',[ProductoController::class, 'store']);
Route::put('/productos/{id}',[ProductoController::class, 'update']);
Route::delete('/productos/{id}',[ProductoController::class, 'destroy']);

//Rutas para citas
Route::get('/citas',[CitaController::class, 'index']);
Route::get('/citas/{id}', [CitaController::class, 'show']);
Route::post('/citas',[CitaController::class, 'store']);
Route::put('/citas/{id}',[CitaController::class, 'update']);
Route::delete('/citas/{id}',[CitaController::class, 'destroy']);
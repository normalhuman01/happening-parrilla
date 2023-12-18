<?php

use App\Http\Controllers\reservas;
use App\Http\Controllers\restaurante;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(restaurante::class)->group(function(){
    Route::get("/","index")->name("main");
});

Route::controller(reservas::class)->group(function(){
    Route::get("/reservas","index")->name("reservas");
    Route::post("/reservas","initReserva")->name("reservas.create");

    Route::get("/reservas/fecha","reservasFecha")->name("reservaFecha");
    Route::post("/reservas/fecha","reservasFechaCreate")->name("reservasFecha.create");

    Route::get("/reservas/fecha/horario","reservasHorario")->name("reservaHorario");
    Route::post("/reservas/fecha/horario","reservasHorarioCreate")->name("reservasHorario.create");

    Route::get("/reservas/cancelar/{id}","deleteReserva")->name("cancelarReserva");
    Route::delete("/reservas/{id}","destroy")->name("destroyReserva");
});

Route::view("/error_page","error")->name("error_page");


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

Route::get('/listclientes', [ClienteController::class, 'listClientes']);
Route::get('/kpideclientes', [ClienteController::class, 'kpiDeClientes']);
Route::post('/creacliente', [ClienteController::class, 'creaCliente']);

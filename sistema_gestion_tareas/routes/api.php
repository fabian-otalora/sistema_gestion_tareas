<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiTaskController;


Route::controller(ApiTaskController::class)->group(function () {
    
    // Listar todas las tareas.
    Route::get('/v1/tasks', 'getTask');

    // Mostrar detalles de una tarea específica.
    Route::get('/v1/tasks/{id}', 'getIdTask');

    // Mostrar detalles de una tarea específica.
    Route::get('/v1/tasksByDate/{date}', 'filterByDate');
    
}); 
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TaskController;


Route::controller(AuthController::class)->group(function () {
    // Pagina de Login
    Route::get('/','index')->name('login');

    // Proceso de login
    Route::post('post-login', 'postLogin')->name('login.post'); 

    // Pagina de Nuevo Usuario
    Route::get('registration', 'registration')->name('register');

    // Proceso de registro de usuario nuevo
    Route::post('post-registration', 'postRegistration')->name('register.post');

    // Logout
    Route::get('logout', 'logout')->name('logout');
});

Route::controller(TaskController::class)->group(function () {

    // Pagina principal
    Route::get('/home', 'home');

    // Crear una nueva tarea.
    Route::post('/saveTask', 'saveTask');

    // Actualizar una tarea específica.
    Route::get('/editTask/{id}','editTask')->name('editTask');
    Route::post('/putTask/{id}','putTask');

    // Eliminar una tarea específica.
    Route::get('/deleteTask/{id}', 'deleteTask')->name('deleteTask');

}); 
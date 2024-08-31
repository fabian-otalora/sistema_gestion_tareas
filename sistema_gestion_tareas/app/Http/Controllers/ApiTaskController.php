<?php

namespace App\Http\Controllers;
use App\Models\Task;

class ApiTaskController extends Controller
{
    /**
     * Función que regresa las tareas
     */
    public function getTask(){
        $data = Task::orderBy("created_at","desc")->get();

        $response = [
            "status" => 200,
            "products"=> $data,
        ];

        return response()->json($response);
    }

    /**
     * Funcion que muestra una tarea especifica en base a su id
     * 
     */
    public function getIdTask($id){
        $data = Task::find($id);

        $response = [
            "status" => 200,
            "product"=> $data,
        ];

        return response()->json($response);
    }

    /**
     * Función que regresa las tareas segun fecha de vencimiento   
     * */
    public function filterByDate($date){
        
        $data = Task::where("expiration_date", $date)->first();

        $response = [
            "status" => 200,
            "products"=> $data,
        ];

        return response()->json($response);
    }
}



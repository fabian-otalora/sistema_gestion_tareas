<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;
use App\Models\User_rol;
use Validator;

class TaskController extends Controller
{

    /**
     * Pagina principal del sistema gestion de tareas, verifica que el usuario este logueado
     */
    public function home(){
        if(Auth::check()){
            $user = User::find(Auth::user()->id);
            $tasks = Task::where("user_id", Auth::user()->id)->get();
    
            return view("home")
                ->with("user", $user)
                ->with("tasks", $tasks);
        }else{
            return redirect("/");
        }
    }

    /**
     * Funcion que guarda las tareas
     */
    public function saveTask(Request $request){

        $validator = Validator::make(
            $request->all(), 
            [
                'title' => 'required|string|max:300',
                'description' => 'required|string|max:500',
                'state' => 'required',
                'expiration_date' => 'required|date',
            ],
            [
                'title.required'=> 'El titulo es obligatorio', 
                'description.required'=> 'La descripcion es obligatoria',   
                'state.required'=> 'El estado es obligatorio', 
                'expiration_date.required'=> 'La fecha es obligatoria', 
                'expiration_date.date'=> 'La fecha debe ser valida', 
            ]
        );

        if($validator->fails()){
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages()
            ], 400);
        }

        $user = User::find(Auth::user()->id);

        $task = new Task();
        $task->user_id = $user->id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->state = $request->state;
        $task->expiration_date = $request->expiration_date;
        $task->save();

        if($task){
            $response = [
                "status" => 200,
                "message" => "Registro guardado correctamente :)"
            ];

            return response()->json($response, 200);
        }else{
            $response = [
                "status" => 500,
                "message" => "Error :("
            ];
            return response()->json($response, 500);
        }
    }


    /**
     * Blade de editar tareas
     */
    public function editTask($id){
        $user = User::find(Auth::user()->id);
        $task = Task::where("user_id", Auth::user()->id)
                    ->where("id",$id)
                    ->first();

        return view("edit")
            ->with("user", $user)
            ->with("task", $task);

    }


    /**
     * Función que actualiza tareas
     */
    public function putTask(Request $request, $id){

        $task = Task::find($id);

        $validator = Validator::make(
            $request->all(), 
            [
                'title' => 'required|string|max:300',
                'description' => 'required|string|max:500',
                'state' => 'required',
                'expiration_date' => 'required|date',
            ],
            [
                'title.required'=> 'El titulo es obligatorio', 
                'description.required'=> 'La descripcion es obligatoria',   
                'state.required'=> 'El estado es obligatorio', 
                'expiration_date.required'=> 'La fecha es obligatoria', 
                'expiration_date.date'=> 'La fecha debe ser valida', 
            ]
        );

        if($validator->fails()){
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages()
            ], 400);
        }

        $task->title = $request->title;
        $task->description = $request->description;
        $task->state = $request->state;
        $task->expiration_date = $request->expiration_date;
        $task->update();

        if($task){
            $response = [
                "status" => 200,
                "message" => "Registro editado correctamente :)"
            ];
            return redirect("home");

            // return response()->json($response, 200);
        }else{
            $response = [
                "status" => 500,
                "message" => "Error :("
            ];
            return response()->json($response, 500);
        }
    }

    /**
     * Función que elimina tareas
     */
    public function deleteTask($id)
    {
        $task = Task::find($id);
        if($task){
            $task->delete();
            $response = [
                "status" => 200,
                "message" => "Tarea eliminada correctamente :)"
            ];
            return redirect("home");

            // return response()->json($response, 200);
        }else{
            $response = [
                "status" => 404,
                "message" => "No existe la tarea"
            ];
            return response()->json($response, 404);
        }


    }

}
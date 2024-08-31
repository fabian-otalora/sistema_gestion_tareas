<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @vite(['resources/less/home.less'])

</head>

    <div class="nav">
        <div class="nav-box1">
            <h3>Sistema de Gestión de Tareas |  Hola!! {{$user->name}}</h3>
        </div>
        <div class="nav-box2">
            <a class="" href="{{ route('logout') }}">{{ __('Cerrar sesión') }}</a>
        </div>
    </div>

    <div class="contenedor">
        <div class="box1">
            <h2>Nueva tarea</h2>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <p for="title">Titulo</p>
            <input class="inputTask" type="text" name="title" id="title" required/>
            <br>
            <p for="description">Descripción</p>
            <input class="inputTask" type="text" name="description" id="description" required/>
            <br>
            <p for="expiration_date">Fecha de vencimiento</p>
            <input class="inputTask" type="date" name="expiration_date" id="expiration_date" required/>
            <br>
            <p for="state">Estado</p>
            <select class="inputTask" name="state" id="state" required>
                <option value="0">Tarea no completada</option>
                <option value="1">Tarea completada</option>
            </select>
            <br><br>
            <button type="submit" id="js-save">Guardar</button>
        </div>

        <div class="box2">
            <table id="tableTask">
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Fecha de vencimiento</th>
                    <th>Acciones</th>
                </tr>
                @foreach ($tasks as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ $value->description }}</td>
                    @php
                        $state = "";
                        if($value->state == 0){
                            $state = "Tarea no completada";
                        }else{
                            $state = "Tarea completada";
                        }
                    @endphp
                    <td>{{ $state }}</td>
                    <td>{{ $value->expiration_date }}</td>
                    <td>
                        <a href="{{ route('editTask', $value->id) }}"><button class="buttonTable">Editar</button>
                        <br><br>
                        <a href="{{ route('deleteTask', $value->id) }}"><button class="buttonTable">Eliminar</button>
                        </a>
                    </td>

                </tr> 
                @endforeach
                
            </table>
        </div>
    </div>

    <script>

        let buttonSave = document.getElementById("js-save");
        if (buttonSave) {
            buttonSave.addEventListener("click", function() {
                saveTask();
            });
        }

        function saveTask() {
            let titleValue = document.getElementById("title").value;
            let descriptionValue = document.getElementById("description").value;
            let expiration_dateValue = document.getElementById("expiration_date").value;
            let stateValue = document.getElementById("state").options[document.getElementById("state").selectedIndex].value;

            let xhr = new XMLHttpRequest();
            let json = JSON.stringify({
                title: titleValue,
                description: descriptionValue,
                expiration_date: expiration_dateValue,
                state: stateValue
            });
            xhr.open("POST", '/public/saveTask')
            xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.send(json);
            xhr.onload = function () {
                if (xhr.status == 200) {
                    alert("Tarea registrada con exito");
                    location.reload();
                } else {
                    alert("Error :( , todos los campos son obligatorios");
                }
            };
        }

    </script>

</body>
</html>
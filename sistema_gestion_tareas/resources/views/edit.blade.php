<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar tarea</title>
    @vite(['resources/less/home.less'])

</head>
<body>
    <div class="box1">
        <h2>Editar tarea</h2>
        <input type="hidden" id="id" value="{{ $task->id }}" />
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <p for="title">Titulo</p>
        <input class="inputTask" type="text" name="title" id="title" requireda value="{{ $task->title }}"/>
        <br>
        <p for="description">Descripción</p>
        <input class="inputTask" type="text" name="description" id="description" required value="{{ $task->description}}"/>
        <br>
        <p for="expiration_date">Fecha de vencimiento</p>
        <input class="inputTask" type="date" name="expiration_date" id="expiration_date" required value="{{ $task->expiration_date }}"/>
        <br>
        <p for="state">Estado</p>
        <select class="inputTask" name="state" id="state" required>
            @if($task->state == 0)
                <option value="0" selected>Tarea no completada</option>
                <option value="1">Tarea completada</option>
            @endif
            @if($task->state == 1)
                <option value="0">Tarea no completada</option>
                <option value="1" selected>Tarea completada</option>
            @endif
        </select>
        <br><br>
        <button type="submit" id="js-save">Guardar</button>
    </div>

    <script>

        let buttonSave = document.getElementById("js-save");
        if (buttonSave) {
            buttonSave.addEventListener("click", function() {
                saveTask();
            });
        }

        function saveTask() {
            let id = document.getElementById("id").value;
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
            xhr.open("POST", '/public/putTask/'+id)
            xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.send(json);
            xhr.onload = function () {
                if (xhr.status == 200) {
                    alert("Tarea registrada con exito");
                    location.href ="http://localhost:9000/public/home";

                } else {
                    alert("Error :( , todos los campos son obligatorios");
                }
            };
        }

    </script>

</body>
</html>
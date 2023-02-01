<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Singers Crud</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-end">
            <a href="http://localhost:8080/singers/new" class="btn btn-success mb-2">Agregar cantante</a>
        </div>
        <div class="mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha de nacimiento</th>
                        <th>Biografía</th>
                        <th>Foto</th>
                        <th>Genero</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="data">
                </tbody>
            </table>
        </div>
    </div>
    
    <script>
        //
        fetch('http://localhost:8080/singers')
        .then(response => response.json())
        .then(data => getData(data))
        .catch(error => console.log(error))

        const getData = (data) => {
            let body = '';
            for(let i = 0; i < data.length; i++){
                body += `<tr>
                    <td>${data[i].name}</td>
                    <td>${data[i].birthday}</td>
                    <td>${data[i].biography}</td>
                    <td> <img src="/uploads/${data[i].photo}" width="120"> </td>
                    <td>${data[i].gender}</td>
                    <td>
                        
                        <a href="http://localhost:8080/singers/${data[i].id}" class="btn btn-outline-success">Editar</a>

                            <form method="post" action="http://localhost:8080/singers/delete/${data[i].id}">
                                <input type="hidden" name="id" id="id" value="${data[i].id}">
                                <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                            </form>
                    </td>
                </tr>`
            }
            document.getElementById('data').innerHTML = body;
        }
    </script>
</body>
</html>
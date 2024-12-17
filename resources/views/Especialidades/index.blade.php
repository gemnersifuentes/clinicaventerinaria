<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Especialidades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Lista de Especialidades</h1>

        <div class="mb-3 text-end">
            <a href="{{ route('Especialidades.create') }}" class="btn btn-success">Nueva Especialidad</a>
        </div>

   
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Código</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Especialidades as $Especialidad)
                    <tr>
                        <td>{{ $Especialidad->id }}</td>
                        <td>{{ $Especialidad->nombre }}</td>
                        <td>{{ $Especialidad->descripcion }}</td>
                        <td>{{ $Especialidad->codigo }}</td>
                        <td>{{ ucfirst($Especialidad->estado) }}</td>
                        <td>
                            <a href="{{ route('Especialidades.edit', $Especialidad->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            
                            <form action="{{ route('Especialidades.destroy', $Especialidad->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

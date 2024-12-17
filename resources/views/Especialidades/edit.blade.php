<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Especialidad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Especialidad</h1>

        <form action="{{ Route('Especialidades.update', $Especialidades->id) }}" method="POST">
            @csrf
            @method('PUT')
        
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $Especialidades->nombre }}" required>
            </div>
        
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control">{{ $Especialidades->descripcion }}</textarea>
            </div>
        
            <div class="mb-3">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" name="codigo" id="codigo" class="form-control" value="{{ $Especialidades->codigo }}">
            </div>
        
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select name="estado" id="estado" class="form-control" required>
                    <option value="activo" {{ $Especialidades->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ $Especialidades->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
        
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('Especialidades.index') }}" class="btn btn-secondary">Volver</a>
        </form>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

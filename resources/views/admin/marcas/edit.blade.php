<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @extends('admin.layouts.main') <!-- Si estás utilizando un layout principal -->

@section('content')
    <div class="container">
    <h1>Editar Marca</h1>

    <form action="{{ route('marcas.update', $marca->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Actualizar Marca</button>
    </form>

    <a href="{{ route('marcas.index') }}" class="btn btn-primary">Volver</a>
    </div>
    @endsection

</body>
</html>
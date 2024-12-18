<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5" style="width: 550px;">
        <h1 class="h1">Registrar Pedido</h1>
        <form action="{{ route('pedidos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Numero</label>
                <input type="number" class="form-control" name="numero">
                <label for="">Fecha</label>
                <input type="date" class="form-control" name="fecha">
            </div>
           
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">
                    GUARDAR
                </button>
                <a href="{{ route('pedidos.index') }}" class="btn btn-success">
                    CANCELAR
                </a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-q8i/X+965DzO0rT7abt9NrnVfbdEjh4u9/j6cY/iYc1S+dQ=" crossorigin="anonymous"></script>
</body>
</html>

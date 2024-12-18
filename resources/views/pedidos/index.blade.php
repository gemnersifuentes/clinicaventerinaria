<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5" style="width: 900px;">
        <div class="d-flex align-items-center mb-4">
            <h1 class="h1 mb-0">Lista de Pedidos</h1>
            <a href="{{ route('pedidos.create') }}" class="btn btn-primary ms-5">NUEVO PEDIDO</a>
        </div>
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Número</th>
                    <th scope="col" class="text-center">Fecha</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                    <tr>
                        <td class="text-center">{{ $pedido->id }}</td>
                        <td class="text-center">{{ $pedido->numero }}</td>
                        <td class="text-center">{{ $pedido->fecha }}</td>
                        <td class="text-center">
                            <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-success btn-sm">EDITAR</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $pedido->id }}">
                                ELIMINAR
                            </button>
                            @include('pedidos.modal')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

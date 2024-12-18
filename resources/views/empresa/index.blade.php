<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Empresas</h1>
        <a href="{{ route('empresa.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Agregar Empresa</a>

        @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 mt-3 rounded border border-green-200">{{ session('success') }}</div>
        @endif

        <div class="overflow-x-auto mt-6">
            <table class="min-w-full bg-white border border-gray-300 rounded">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Nombre</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Dirección</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Teléfono</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">RUC</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Logo</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Misión</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Visión</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empresas as $empresa)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $empresa->nombre_empresa }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $empresa->direccion }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $empresa->telefono }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $empresa->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $empresa->ruc_empresa }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $empresa->logo_empresa }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $empresa->mision_empresa }}</td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $empresa->vision_empresa }}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('empresa.edit', $empresa->id) }}" class="bg-yellow-500 text-white px-3 py-2 rounded hover:bg-yellow-600 transition">Editar</a>
                            <form action="{{ route('empresa.destroy', $empresa->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta empresa?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 transition">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
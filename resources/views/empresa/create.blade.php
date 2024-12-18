<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Empresa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-bold mb-6">Nueva Empresa</h1>

        <form action="{{ route('empresa.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="nombre_empresa" class="block text-sm font-medium text-gray-700">Nombre de la Empresa</label>
                <input type="text" id="nombre_empresa" name="nombre_empresa" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="ruc_empresa" class="block text-sm font-medium text-gray-700">RUC</label>
                <input type="text" id="ruc_empresa" name="ruc_empresa" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="logo_empresa" class="block text-sm font-medium text-gray-700">Logo</label>
                <input type="file" id="logo_empresa" name="logo_empresa" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="mision_empresa" class="block text-sm font-medium text-gray-700">Misión</label>
                <textarea id="mision_empresa" name="mision_empresa" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
            </div>

            <div>
                <label for="vision_empresa" class="block text-sm font-medium text-gray-700">Visión</label>
                <textarea id="vision_empresa" name="vision_empresa" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
            </div>

            <!-- Botones -->
            <div class="flex space-x-4">
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    Guardar
                </button>

                <a href="{{ route('empresa.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto bg-white p-6 shadow-lg mt-10">
        <h1 class="text-2xl font-bold mb-6">Editar Perfil</h1>
        <form action="{{ route('perfil.update', $perfil->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700">Nacionalidad</label>
                <input type="text" name="nacionalidad" value="{{ $perfil->nacionalidad }}" class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Tipo de Documento</label>
                <input type="text" name="tipo_documento" value="{{ $perfil->tipo_documento }}" class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Número de Documento</label>
                <input type="text" name="numero_documento" value="{{ $perfil->numero_documento }}" class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" value="{{ $perfil->fecha_nacimiento }}" class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Teléfono</label>
                <input type="text" name="telefono" value="{{ $perfil->telefono }}" class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Dirección</label>
                <input type="text" name="direccion" value="{{ $perfil->direccion }}" class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Ciudad</label>
                <input type="text" name="ciudad" value="{{ $perfil->ciudad }}" class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">País</label>
                <input type="text" name="pais" value="{{ $perfil->pais }}" class="w-full px-3 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Descripción</label>
                <textarea name="descripcion" class="w-full px-3 py-2 border rounded">{{ $perfil->descripcion }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
        </form>
    </div>
</body>
</html>

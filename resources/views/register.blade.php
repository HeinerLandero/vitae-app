<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registro - Vitae App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'vitae-blue': '#3b82f6',
                        'vitae-purple': '#8b5cf6',
                        'vitae-green': '#10b981'
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 flex items-center justify-center min-h-screen py-8 px-4">
    <div class="bg-slate-800 p-6 sm:p-8 rounded-2xl shadow-2xl w-full max-w-md border border-slate-700">
        <!-- Logo -->
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-circle text-white text-3xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-white">Vitae</h1>
            <p class="text-slate-400 text-sm">Crea tu CV profesional</p>
        </div>

        <h2 class="text-xl font-semibold text-white mb-2 text-center">Crear Cuenta</h2>
        <p class="text-center mb-6 text-slate-400">¿Ya tienes cuenta? <a href="/login" class="text-blue-400 hover:text-blue-300">Inicia sesión</a></p>

        <form id="registerForm" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-300 mb-2"><i class="fas fa-user mr-2 text-blue-400"></i>Nombre</label>
                    <input type="text" id="nombre"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="Tu nombre" required>
                </div>
                <div>
                    <label class="block text-slate-300 mb-2"><i class="fas fa-user-tag mr-2 text-blue-400"></i>Apellido</label>
                    <input type="text" id="apellido"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="Tu apellido" required>
                </div>
            </div>
            <div>
                <label class="block text-slate-300 mb-2"><i class="fas fa-envelope mr-2 text-blue-400"></i>Email</label>
                <input type="email" id="email"
                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    placeholder="tu@email.com" required>
            </div>
            <div>
                <label class="block text-slate-300 mb-2"><i class="fas fa-lock mr-2 text-blue-400"></i>Contraseña</label>
                <input type="password" id="password"
                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    placeholder="••••••••" required>
            </div>
            <div>
                <label class="block text-slate-300 mb-2"><i class="fas fa-lock mr-2 text-blue-400"></i>Confirmar Contraseña</label>
                <input type="password" id="password_confirmation"
                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    placeholder="••••••••" required>
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-3 px-6 rounded-xl font-semibold hover:from-green-700 hover:to-emerald-700 transition-all duration-200">
                <i class="fas fa-user-plus mr-2"></i>
                Crear Cuenta
            </button>
        </form>

        <div id="response" class="mt-4 text-center text-sm text-slate-400"></div>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const nombre = document.getElementById('nombre').value;
            const apellido = document.getElementById('apellido').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const password_confirmation = document.getElementById('password_confirmation').value;

            const response = await fetch('/api/usuarios', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ nombre, apellido, email, password, password_confirmation })
            });

            const data = await response.json();

            if (response.ok) {
                document.getElementById('response').innerHTML = '<span class="text-green-400">¡Cuenta creada exitosamente! Redirigiendo...</span>';
                setTimeout(() => {
                    window.location.href = '/login';
                }, 1500);
            } else {
                let errorMsg = 'Error al crear la cuenta';
                if (data.message) {
                    errorMsg = data.message;
                } else if (data.errors) {
                    errorMsg = Object.values(data.errors).flat().join('<br>');
                }
                document.getElementById('response').innerHTML = '<span class="text-red-400">' + errorMsg + '</span>';
            }
        });
    </script>
</body>
</html>

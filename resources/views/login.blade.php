<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Vitae App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'vitae-blue': '#3b82f6',
                        'vitae-purple': '#8b5cf6'
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 flex items-center justify-center min-h-screen p-4">
    <div class="bg-slate-800 p-6 sm:p-8 rounded-2xl shadow-2xl w-full max-w-md border border-slate-700">
        <!-- Logo -->
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-circle text-white text-3xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-white">Vitae</h1>
            <p class="text-slate-400 text-sm">Crea tu CV profesional</p>
        </div>

        <h2 class="text-xl font-semibold text-white mb-2 text-center">Bienvenido</h2>
        <p class="text-center mb-6 text-slate-400">¿No tienes cuenta? <a href="/register" class="text-blue-400 hover:text-blue-300">Regístrate</a></p>

        <form id="loginForm" class="space-y-4">
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
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-6 rounded-xl font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-200">
                <i class="fas fa-sign-in-alt mr-2"></i>
                Iniciar Sesión
            </button>
        </form>

    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ email, password })
            });

            const data = await response.json();

            if (data.token) {
                localStorage.setItem('token', data.token);
                window.location.href = '/dashboard';
            } else {
                alert(data.message || 'Error al iniciar sesión');
            }
        });
    </script>
</body>
</html>

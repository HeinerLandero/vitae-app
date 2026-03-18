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
            <div id="successMessage" class="hidden p-4 bg-green-900/50 border border-green-600 rounded-xl text-green-300 text-center"></div>
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
            <button type="submit" id="submitBtn" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-3 px-6 rounded-xl font-semibold hover:from-green-700 hover:to-emerald-700 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                <span id="btnText"><i class="fas fa-user-plus mr-2"></i>Crear Cuenta</span>
                <span id="btnSpinner" class="hidden"><i class="fas fa-spinner fa-spin mr-2"></i>Creando...</span>
            </button>
        </form>

        <div id="response" class="mt-4 text-center text-sm text-slate-400"></div>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnSpinner = document.getElementById('btnSpinner');
            const successMessage = document.getElementById('successMessage');
            const responseDiv = document.getElementById('response');

            const nombre = document.getElementById('nombre').value;
            const apellido = document.getElementById('apellido').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const password_confirmation = document.getElementById('password_confirmation').value;

            // Disable button and show spinner
            submitBtn.disabled = true;
            btnText.classList.add('hidden');
            btnSpinner.classList.remove('hidden');
            responseDiv.innerHTML = '';
            successMessage.classList.add('hidden');

            try {
                const response = await fetch('/api/usuarios', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ nombre, apellido, email, password, password_confirmation })
                });

                const data = await response.json();

                if (response.ok) {
                    successMessage.innerHTML = '<i class="fas fa-check-circle mr-2"></i>¡Cuenta creada exitosamente! Serás redirigido al login...';
                    successMessage.classList.remove('hidden');
                    document.getElementById('registerForm').reset();
                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 2000);
                } else {
                    let errorMsg = 'Error al crear la cuenta';
                    if (data.message) {
                        // Check for duplicate email message
                        if (data.message.includes('email') || data.message.includes('correo')) {
                            errorMsg = 'El correo electrónico ya está registrado. <a href="/login" class="text-blue-400 hover:underline">¿Ya tienes cuenta?</a>';
                        } else {
                            errorMsg = data.message;
                        }
                    } else if (data.errors) {
                        // Check for email already exists error
                        if (data.errors.email) {
                            const emailErrors = data.errors.email;
                            if (Array.isArray(emailErrors)) {
                                const hasDuplicate = emailErrors.some(e => e.includes('unique') || e.includes('ya') || e.includes('taken'));
                                if (hasDuplicate) {
                                    errorMsg = 'El correo electrónico ya está registrado. <a href="/login" class="text-blue-400 hover:underline">¿Ya tienes cuenta?</a>';
                                } else {
                                    errorMsg = emailErrors.join('<br>');
                                }
                            }
                        } else {
                            errorMsg = Object.values(data.errors).flat().join('<br>');
                        }
                    }
                    responseDiv.innerHTML = '<span class="text-red-400">' + errorMsg + '</span>';
                }
            } catch (error) {
                responseDiv.innerHTML = '<span class="text-red-400">Error de conexión. Intenta de nuevo.</span>';
            } finally {
                // Re-enable button and hide spinner
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                btnSpinner.classList.add('hidden');
            }
        });
    </script>
</body>
</html>

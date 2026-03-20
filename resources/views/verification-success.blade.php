<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo verificado - Vitae App</title>
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
        <!-- Success Icon -->
        <div class="w-20 h-20 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-check text-4xl text-white"></i>
        </div>

        <!-- Title -->
        <h1 class="text-2xl font-bold text-white text-center mb-4">
            ¡Correo verificado exitosamente!
        </h1>

        <!-- Message -->
        <p class="text-slate-400 text-center mb-8">
            Tu cuenta ha sido confirmada. Ahora puedes acceder a tu perfil y comenzar a construir tu hoja de vida profesional.
        </p>

        <!-- Login Button -->
        <a href="/login"
           class="inline-flex items-center justify-center w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-3 px-6 rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
            <i class="fas fa-sign-in-alt mr-2"></i>
            <span>Ir a iniciar sesión</span>
        </a>

        <!-- Additional Info -->
        <p class="mt-6 text-sm text-slate-500 text-center">
            Si tienes alguna pregunta, no dudes en contactarnos.
        </p>
    </div>

    <!-- Footer -->
    <p class="absolute bottom-4 text-slate-500 text-sm">
        © {{ date('Y') }} Vitae App. Todos los derechos reservados.
    </p>
</body>
</html>

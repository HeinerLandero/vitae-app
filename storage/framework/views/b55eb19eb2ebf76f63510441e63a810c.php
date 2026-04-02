<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Dashboard - Vitae App</title>
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'vitae-blue': '#3b82f6',
                        'vitae-purple': '#8b5cf6',
                        'vitae-green': '#10b981'
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.3s ease-in-out',
                        'slide-up': 'slideUp 0.3s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(10px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease-in-out;
        }
        .tab-content.active {
            display: block;
            animation: slideUp 0.3s ease-out;
        }
        .nav-item.active {
            background: linear-gradient(135deg, #475569 0%, #334155 100%);
            color: white;
        }
        .nav-item.active i {
            color: white;
        }
        .glass-effect {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
        }
        .gradient-border {
            position: relative;
        }
        .gradient-border::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #475569, #64748b);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <!-- Mobile Menu Button - Attached to right side of sidebar -->
        <button id="mobileMenuBtn" class="lg:hidden fixed top-4 right-4 z-50 p-3 bg-slate-800 text-white rounded-xl shadow-lg border border-slate-600" onclick="toggleMobileSidebar()">
            <i id="menuIcon" class="fas fa-chevron-right text-xl"></i>
        </button>

        <!-- Sidebar -->
        <aside id="sidebar" class="w-72 glass-effect border-r border-slate-700 flex flex-col shadow-2xl fixed lg:relative inset-y-0 left-0 z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <!-- Logo -->
            <div class="p-6 border-b border-slate-700">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-blue-900/50 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-user-circle text-blue-400 text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-white">Vitae</h1>
                        <p class="text-xs text-slate-400">Crea tu CV profesional</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <button onclick="switchTab('perfil')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-slate-700 transition-all duration-200" data-tab="perfil">
                    <div class="w-10 h-10 bg-blue-900/50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user text-blue-400"></i>
                    </div>
                    <span class="font-medium">Perfil</span>
                </button>

                <button onclick="switchTab('experiencia')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-slate-700 transition-all duration-200" data-tab="experiencia">
                    <div class="w-10 h-10 bg-blue-900/50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-briefcase text-blue-400"></i>
                    </div>
                    <span class="font-medium">Experiencia</span>
                </button>

                <button onclick="switchTab('educacion')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-slate-700 transition-all duration-200" data-tab="educacion">
                    <div class="w-10 h-10 bg-blue-900/50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-blue-400"></i>
                    </div>
                    <span class="font-medium">Educación</span>
                </button>

                <button onclick="switchTab('certificaciones')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-slate-700 transition-all duration-200" data-tab="certificaciones">
                    <div class="w-10 h-10 bg-blue-900/50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-award text-blue-400"></i>
                    </div>
                    <span class="font-medium">Certificaciones</span>
                </button>

                <button onclick="switchTab('habilidades')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-slate-700 transition-all duration-200" data-tab="habilidades">
                    <div class="w-10 h-10 bg-blue-900/50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-tools text-blue-400"></i>
                    </div>
                    <span class="font-medium">Habilidades</span>
                </button>

                <button onclick="switchTab('idiomas')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-slate-700 transition-all duration-200" data-tab="idiomas">
                    <div class="w-10 h-10 bg-blue-900/50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-language text-blue-400"></i>
                    </div>
                    <span class="font-medium">Idiomas</span>
                </button>

                <button onclick="switchTab('proyectos')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-slate-700 transition-all duration-200" data-tab="proyectos">
                    <div class="w-10 h-10 bg-blue-900/50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-project-diagram text-blue-400"></i>
                    </div>
                    <span class="font-medium">Proyectos</span>
                </button>

                <button onclick="switchTab('publicaciones')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-slate-700 transition-all duration-200" data-tab="publicaciones">
                    <div class="w-10 h-10 bg-blue-900/50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-book text-blue-400"></i>
                    </div>
                    <span class="font-medium">Publicaciones</span>
                </button>

                <button onclick="switchTab('redes')" class="nav-item w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-white hover:bg-slate-700 transition-all duration-200" data-tab="redes">
                    <div class="w-10 h-10 bg-blue-900/50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-share-alt text-blue-400"></i>
                    </div>
                    <span class="font-medium">Redes Sociales</span>
                </button>
            </nav>

            <!-- User & Logout -->
            <div class="p-4 border-t border-slate-700">
                <div id="userInfo" class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-blue-900/50 rounded-full flex items-center justify-center text-white font-bold">
                        <i class="fas fa-user text-blue-400"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p id="userName" class="text-sm font-medium text-white truncate">Cargando...</p>
                        <p class="text-xs text-slate-400">Usuario</p>
                    </div>
                </div>
                <button onclick="logout()" class="w-full flex items-center justify-center space-x-2 px-4 py-3 bg-red-600/20 text-red-400 rounded-xl hover:bg-red-600/30 transition-colors">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="font-medium">Cerrar Sesión</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Header -->
            <header class="hidden lg:flex glass-effect border-b border-slate-700 sticky top-0 z-10">
                <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between w-full">
                    <div>
                        <h2 id="tabTitle" class="text-2xl font-bold text-white">Perfil</h2>
                        <p id="tabSubtitle" class="text-sm text-slate-400">Gestiona tu información personal</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- View CV Button -->
                        <a id="viewCvBtn" href="#" class="p-3 bg-blue-600/30 text-blue-400 rounded-xl hover:bg-blue-600/40 transition-colors h-12 w-12 flex items-center justify-center" title="Ver mi CV">
                            <i class="fas fa-eye"></i>
                        </a>
                        <!-- QR Button -->
                        <button onclick="toggleQRModal()" class="p-3 bg-blue-600/30 text-blue-400 rounded-xl hover:bg-blue-600/40 transition-colors h-12 w-12 flex items-center justify-center">
                            <i class="fas fa-qrcode"></i>
                        </button>
                        <!-- Progress -->
                        <div class="flex items-center space-x-2 px-4 py-2 bg-slate-700 rounded-xl h-12">
                            <div class="w-16 h-2 bg-slate-600 rounded-full overflow-hidden">
                                <div id="progressBar" class="h-full bg-blue-600 rounded-full" style="width: 0%"></div>
                            </div>
                            <span id="progressText" class="text-sm font-medium text-white">0%</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Mobile Floating Buttons -->
            <div class="lg:hidden fixed bottom-10 right-4 z-10 flex gap-3">
                <!-- View CV Floating Button -->
                <a id="viewCvBtnMobile" href="#" class="p-3 bg-blue-600 text-white rounded-xl shadow-lg" title="Ver mi CV">
                    <i class="fas fa-eye text-xl"></i>
                </a>
                <!-- Progress Floating Button -->
                <button onclick="toggleProgressModal()" class="p-3 bg-slate-800/90 text-white rounded-xl shadow-lg border border-slate-600 backdrop-blur-sm" title="Progreso del CV">
                    <div class="relative">
                        <i class="fas fa-chart-pie text-green-400 text-xl"></i>
                        <span id="progressBadge" class="absolute -top-1 -right-1 w-4 h-4 bg-blue-600 text-white text-xs rounded-full flex items-center justify-center">0</span>
                    </div>
                </button>
                <!-- QR Floating Button -->
                <button onclick="toggleQRModal()" class="p-3 bg-blue-600 text-white rounded-xl shadow-lg">
                    <i class="fas fa-qrcode text-xl"></i>
                </button>
            </div>

            <!-- Content Area -->
            <div class="max-w-6xl mx-auto pb-12  lg:pb-4 p-4 lg:p-6">
                <!-- Perfil Tab -->
                <div id="tab-perfil" class="tab-content active">
                    <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden gradient-border">
                        <div class="p-6">
                            <div id="perfilStatus" class="mb-6">
                                <div class="flex items-center p-4 bg-slate-700 rounded-xl border border-slate-600">
                                    <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-blue-500 mr-3"></div>
                                    <p class="text-gray-300">Cargando información...</p>
                                </div>
                            </div>
                            <form id="perfilForm" class="hidden space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-semibold text-white mb-2">
                                            <i class="fas fa-user mr-2 text-blue-400"></i>Nombre
                                        </label>
                                        <input type="text" name="nombre" required
                                            class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-slate-700 text-white placeholder-slate-400"
                                            placeholder="Tu nombre">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-white mb-2">
                                            <i class="fas fa-user-tag mr-2 text-blue-400"></i>Apellido
                                        </label>
                                        <input type="text" name="apellido" required
                                            class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-slate-700 text-white placeholder-slate-400"
                                            placeholder="Tu apellido">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-white mb-2">
                                        <i class="fas fa-briefcase mr-2 text-blue-400"></i>Cargo Profesional
                                    </label>
                                    <input type="text" name="cargo" required
                                        class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-slate-700 text-white placeholder-slate-400"
                                        placeholder="Ej: Desarrollador Full Stack">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-semibold text-white mb-2">
                                            <i class="fas fa-envelope mr-2 text-blue-400"></i>Email
                                        </label>
                                        <input type="email" name="email" required
                                            class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-slate-700 text-white placeholder-slate-400"
                                            placeholder="tu@email.com">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-white mb-2">
                                            <i class="fas fa-phone mr-2 text-blue-400"></i>Teléfono
                                        </label>
                                        <input type="text" name="telefono" required
                                            class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-slate-700 text-white placeholder-slate-400"
                                            placeholder="+57 300 123 4567">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-semibold text-white mb-2">
                                            <i class="fas fa-calendar mr-2 text-blue-400"></i>Fecha de Nacimiento
                                        </label>
                                        <input type="date" name="fecha_nacimiento" required
                                            class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-slate-700 text-white">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-white mb-2">
                                            <i class="fas fa-flag mr-2 text-blue-400"></i>Nacionalidad
                                        </label>
                                        <input type="text" name="nacionalidad" required
                                            class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-slate-700 text-white placeholder-slate-400"
                                            placeholder="Colombiana">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-white mb-2">
                                        <i class="fas fa-map-marker-alt mr-2 text-blue-400"></i>Dirección
                                    </label>
                                    <input type="text" name="direccion" required
                                        class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-slate-700 text-white placeholder-slate-400"
                                        placeholder="Calle 123 #45-67">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-sm font-semibold text-white mb-2">
                                            <i class="fas fa-city mr-2 text-blue-400"></i>Ciudad
                                        </label>
                                        <input type="text" name="ciudad" required
                                            class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-slate-700 text-white placeholder-slate-400"
                                            placeholder="Bogotá">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-white mb-2">
                                            <i class="fas fa-globe mr-2 text-blue-400"></i>País
                                        </label>
                                        <input type="text" name="pais" required
                                            class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-slate-700 text-white placeholder-slate-400"
                                            placeholder="Colombia">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-white mb-2">
                                            <i class="fas fa-id-card mr-2 text-blue-400"></i>Tipo de Documento
                                        </label>
                                        <select name="tipo_documento" required
                                            class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-slate-700 text-white">
                                            <option value="">Seleccionar</option>
                                            <option value="CC">Cédula de Ciudadanía</option>
                                            <option value="CE">Cédula de Extranjería</option>
                                            <option value="PP">Pasaporte</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-white mb-2">
                                        <i class="fas fa-hashtag mr-2 text-blue-400"></i>Número de Documento
                                    </label>
                                    <input type="text" name="numero_documento" required
                                        class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-slate-700 text-white placeholder-slate-400"
                                        placeholder="123456789">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-white mb-2">
                                        <i class="fas fa-align-left mr-2 text-blue-400"></i>Descripción Personal
                                    </label>
                                    <textarea name="descripcion" rows="4" required
                                        class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-slate-700 text-white placeholder-slate-400 resize-none"
                                        placeholder="Cuéntanos sobre ti..."></textarea>
                                </div>

                                <button type="submit"
                                    class="w-full bg-blue-600 text-white py-4 px-6 rounded-xl font-semibold hover:bg-blue-700 transform hover:scale-[1.01] transition-all duration-200 shadow-lg">
                                    <i class="fas fa-save mr-2"></i>
                                    Guardar Perfil
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Experiencia Tab -->
                <div id="tab-experiencia" class="tab-content">
                    <div class="space-y-6">
                        <!-- Existing -->
                        <div id="experienciasContainer" class="hidden">
                            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                <i class="fas fa-briefcase mr-2 text-green-400"></i>
                                Tus Experiencias
                            </h3>
                            <div id="experienciasList" class="space-y-4"></div>
                        </div>

                        <!-- Form -->
                        <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden gradient-border">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                    <i class="fas fa-plus mr-2 text-green-400"></i>
                                    Agregar Experiencia
                                </h3>
                                <form id="experienciaForm" class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Empresa</label>
                                            <input type="text" name="empresa" required
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent bg-slate-700 text-white placeholder-slate-400"
                                                placeholder="Nombre de la empresa">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Cargo</label>
                                            <input type="text" name="cargo" required
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent bg-slate-700 text-white placeholder-slate-400"
                                                placeholder="Tu posición">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-white mb-2">Descripción</label>
                                        <textarea name="descripcion" rows="3" required
                                            class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent bg-slate-700 text-white placeholder-slate-400 resize-none"
                                            placeholder="Describe tus responsabilidades..."></textarea>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Fecha Inicio</label>
                                            <input type="date" name="fecha_inicio" required
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent bg-slate-700 text-white">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Fecha Fin</label>
                                            <input type="date" name="fecha_fin"
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent bg-slate-700 text-white">
                                        </div>
                                        <div class="flex items-end">
                                            <label class="flex items-center">
                                                <input type="checkbox" name="es_actual" class="h-5 w-5 text-green-500 rounded">
                                                <span class="ml-2 text-sm text-white">Trabajo actual</span>
                                            </label>
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-xl font-semibold hover:bg-blue-700 transition-all duration-200">
                                        <i class="fas fa-plus mr-2"></i>
                                        Agregar Experiencia
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Educacion Tab -->
                <div id="tab-educacion" class="tab-content">
                    <div class="space-y-6">
                        <div id="educacionesContainer" class="hidden">
                            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                <i class="fas fa-graduation-cap mr-2 text-purple-400"></i>
                                Tu Educación
                            </h3>
                            <div id="educacionesList" class="space-y-4"></div>
                        </div>

                        <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden gradient-border">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                    <i class="fas fa-plus mr-2 text-purple-400"></i>
                                    Agregar Educación
                                </h3>
                                <form id="educacionForm" class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Institución</label>
                                            <input type="text" name="institucion" required
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-700 text-white placeholder-slate-400"
                                                placeholder="Nombre de la institución">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Título</label>
                                            <input type="text" name="titulo" required
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-700 text-white placeholder-slate-400"
                                                placeholder="Título obtenido">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Nivel</label>
                                            <select name="nivel" required
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-700 text-white">
                                                <option value="">Seleccionar</option>
                                                <option value="Bachillerato">Bachillerato</option>
                                                <option value="Técnico">Técnico</option>
                                                <option value="Tecnólogo">Tecnólogo</option>
                                                <option value="Pregrado">Pregrado</option>
                                                <option value="Especialización">Especialización</option>
                                                <option value="Maestría">Maestría</option>
                                                <option value="Doctorado">Doctorado</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Fecha Inicio</label>
                                            <input type="date" name="fecha_inicio" required
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-700 text-white">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Fecha Fin</label>
                                            <input type="date" name="fecha_fin"
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-slate-700 text-white">
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-xl font-semibold hover:bg-blue-700 transition-all duration-200">
                                        <i class="fas fa-plus mr-2"></i>
                                        Agregar Educación
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Certificaciones Tab -->
                <div id="tab-certificaciones" class="tab-content">
                    <div class="space-y-6">
                        <div id="certificadosContainer" class="hidden">
                            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                <i class="fas fa-award mr-2 text-yellow-400"></i>
                                Tus Certificaciones
                            </h3>
                            <div id="certificadosList" class="space-y-4"></div>
                        </div>

                        <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden gradient-border">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                    <i class="fas fa-plus mr-2 text-yellow-400"></i>
                                    Agregar Certificación
                                </h3>
                                <form id="certificadoForm" class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Nombre</label>
                                            <input type="text" name="titulo" required
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-slate-700 text-white placeholder-slate-400"
                                                placeholder="Nombre de la certificación">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Institución</label>
                                            <input type="text" name="institucion" required
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-slate-700 text-white placeholder-slate-400"
                                                placeholder="Institución emisora">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-white mb-2">Fecha de Emisión</label>
                                        <input type="date" name="fecha_emision" required
                                            class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-slate-700 text-white">
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-xl font-semibold hover:bg-blue-700 transition-all duration-200">
                                        <i class="fas fa-plus mr-2"></i>
                                        Agregar Certificación
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Habilidades Tab -->
                <div id="tab-habilidades" class="tab-content">
                    <div class="space-y-6">
                        <div id="habilidadesContainer" class="hidden">
                            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                <i class="fas fa-tools mr-2 text-cyan-400"></i>
                                Tus Habilidades
                            </h3>
                            <div id="habilidadesList" class="space-y-4"></div>
                        </div>

                        <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden gradient-border">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                    <i class="fas fa-plus mr-2 text-cyan-400"></i>
                                    Agregar Habilidad
                                </h3>
                                <form id="habilidadForm" class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Habilidad</label>
                                            <input type="text" name="habilidad" required
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-transparent bg-slate-700 text-white placeholder-slate-400"
                                                placeholder="Ej: JavaScript">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Nivel</label>
                                            <select name="nivel" required
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-transparent bg-slate-700 text-white">
                                                <option value="">Seleccionar</option>
                                                <option value="Básico">Básico</option>
                                                <option value="Intermedio">Intermedio</option>
                                                <option value="Avanzado">Avanzado</option>
                                                <option value="Experto">Experto</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-xl font-semibold hover:bg-blue-700 transition-all duration-200">
                                        <i class="fas fa-plus mr-2"></i>
                                        Agregar Habilidad
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Idiomas Tab -->
                <div id="tab-idiomas" class="tab-content">
                    <div class="space-y-6">
                        <div id="idiomasContainer" class="hidden">
                            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                <i class="fas fa-language mr-2 text-emerald-400"></i>
                                Tus Idiomas
                            </h3>
                            <div id="idiomasList" class="space-y-4"></div>
                        </div>

                        <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden gradient-border">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                    <i class="fas fa-plus mr-2 text-emerald-400"></i>
                                    Agregar Idioma
                                </h3>
                                <form id="idiomaForm" class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Idioma</label>
                                            <input type="text" name="idioma" required
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-slate-700 text-white placeholder-slate-400"
                                                placeholder="Ej: Inglés">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Nivel</label>
                                            <select name="nivel" required
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-slate-700 text-white">
                                                <option value="">Seleccionar</option>
                                                <option value="Básico">Básico</option>
                                                <option value="Conversacional">Conversacional</option>
                                                <option value="Intermedio">Intermedio</option>
                                                <option value="Avanzado">Avanzado</option>
                                                <option value="Nativo">Nativo</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-xl font-semibold hover:bg-blue-700 transition-all duration-200">
                                        <i class="fas fa-plus mr-2"></i>
                                        Agregar Idioma
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Proyectos Tab -->
                <div id="tab-proyectos" class="tab-content">
                    <div class="space-y-6">
                        <div id="proyectosContainer" class="hidden">
                            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                <i class="fas fa-project-diagram mr-2 text-orange-400"></i>
                                Tus Proyectos
                            </h3>
                            <div id="proyectosList" class="space-y-4"></div>
                        </div>

                        <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden gradient-border">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                    <i class="fas fa-plus mr-2 text-orange-400"></i>
                                    Agregar Proyecto
                                </h3>
                                <form id="proyectoForm" class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-white mb-2">Título</label>
                                        <input type="text" name="titulo" required
                                            class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-slate-700 text-white placeholder-slate-400"
                                            placeholder="Nombre del proyecto">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-white mb-2">Descripción</label>
                                        <textarea name="descripcion" rows="3" required
                                            class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-slate-700 text-white placeholder-slate-400 resize-none"
                                            placeholder="Describe el proyecto..."></textarea>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-white mb-2">URL (Opcional)</label>
                                        <input type="url" name="url"
                                            class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-slate-700 text-white placeholder-slate-400"
                                            placeholder="https://github.com/...">
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-xl font-semibold hover:bg-blue-700 transition-all duration-200">
                                        <i class="fas fa-plus mr-2"></i>
                                        Agregar Proyecto
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Publicaciones Tab -->
                <div id="tab-publicaciones" class="tab-content">
                    <div class="space-y-6">
                        <div id="publicacionesContainer" class="hidden">
                            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                <i class="fas fa-book mr-2 text-pink-400"></i>
                                Tus Publicaciones
                            </h3>
                            <div id="publicacionesList" class="space-y-4"></div>
                        </div>

                        <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden gradient-border">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                    <i class="fas fa-plus mr-2 text-pink-400"></i>
                                    Agregar Publicación
                                </h3>
                                <form id="publicacionForm" class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-white mb-2">Título</label>
                                        <input type="text" name="titulo" required
                                            class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent bg-slate-700 text-white placeholder-slate-400"
                                            placeholder="Título del artículo">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-white mb-2">Descripción</label>
                                        <textarea name="descripcion" rows="3" required
                                            class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent bg-slate-700 text-white placeholder-slate-400 resize-none"
                                            placeholder="Resumen..."></textarea>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Fecha</label>
                                            <input type="date" name="fecha" required
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent bg-slate-700 text-white">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">URL (Opcional)</label>
                                            <input type="url" name="url"
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-pink-500 focus:border-transparent bg-slate-700 text-white placeholder-slate-400"
                                                placeholder="https://medium.com/...">
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-xl font-semibold hover:bg-blue-700 transition-all duration-200">
                                        <i class="fas fa-plus mr-2"></i>
                                        Agregar Publicación
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Redes Tab -->
                <div id="tab-redes" class="tab-content">
                    <div class="space-y-6">
                        <div id="redesSocialesContainer" class="hidden">
                            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                <i class="fas fa-share-alt mr-2 text-indigo-400"></i>
                                Tus Redes Sociales
                            </h3>
                            <div id="redesSocialesList" class="space-y-4"></div>
                        </div>

                        <div class="bg-slate-800 rounded-2xl shadow-xl border border-slate-700 overflow-hidden gradient-border">
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                                    <i class="fas fa-plus mr-2 text-indigo-400"></i>
                                    Agregar Red Social
                                </h3>
                                <form id="redSocialForm" class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">Plataforma</label>
                                            <select name="plataforma" required
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-slate-700 text-white">
                                                <option value="">Seleccionar</option>
                                                <option value="LinkedIn">LinkedIn</option>
                                                <option value="GitHub">GitHub</option>
                                                <option value="Twitter">Twitter</option>
                                                <option value="Facebook">Facebook</option>
                                                <option value="Instagram">Instagram</option>
                                                <option value="YouTube">YouTube</option>
                                                <option value="Medium">Medium</option>
                                                <option value="Website">Sitio Web</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-white mb-2">URL</label>
                                            <input type="url" name="url" required
                                                class="w-full px-4 py-3 border border-slate-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent bg-slate-700 text-white placeholder-slate-400"
                                                placeholder="https://...">
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-xl font-semibold hover:bg-blue-700 transition-all duration-200">
                                        <i class="fas fa-plus mr-2"></i>
                                        Agregar Red Social
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- QR Modal -->
    <div id="qrModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center">
        <div class="bg-slate-800 rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden border border-slate-700">
            <div class="bg-blue-900/50 p-6">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-white">Tu Código QR</h3>
                    <button onclick="toggleQRModal()" class="text-white/80 hover:text-white">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <div id="qrContainer" class="text-center">
                    <div class="flex items-center justify-center py-8">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-400"></div>
                    </div>
                </div>
                <div id="cvUrlContainer" class="mt-4 hidden">
                    <p class="text-sm text-slate-300 mb-2">URL de tu CV:</p>
                    <div class="flex items-center bg-slate-700 rounded-lg p-3">
                        <span id="cvUrl" class="text-sm text-white truncate flex-1"></span>
                        <button onclick="copyCVUrl()" class="ml-2 text-blue-400 hover:text-blue-300">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Overlay -->
    <div id="sidebarOverlay" class="lg:hidden fixed inset-0 bg-black/50 z-30 hidden" onclick="toggleMobileSidebar()"></div>

    <script>
        // Toggle Mobile Sidebar
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const menuIcon = document.getElementById('menuIcon');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');

            // Toggle icon direction
            if (sidebar.classList.contains('-translate-x-full')) {
                // Sidebar is closed
                menuIcon.classList.remove('fa-chevron-left');
                menuIcon.classList.add('fa-chevron-right');
            } else {
                // Sidebar is open
                menuIcon.classList.remove('fa-chevron-right');
                menuIcon.classList.add('fa-chevron-left');
            }
        }

        const token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/login';
        }

        // Tab titles
        const tabTitles = {
            'perfil': { title: 'Perfil', subtitle: 'Gestiona tu información personal' },
            'experiencia': { title: 'Experiencia', subtitle: 'Agrega tu historial profesional' },
            'educacion': { title: 'Educación', subtitle: 'Tu formación académica' },
            'certificaciones': { title: 'Certificaciones', subtitle: 'Tus certificaciones y cursos' },
            'habilidades': { title: 'Habilidades', subtitle: 'Tus competencias técnicas' },
            'idiomas': { title: 'Idiomas', subtitle: 'Idiomas que dominas' },
            'proyectos': { title: 'Proyectos', subtitle: 'Proyectos destacados' },
            'publicaciones': { title: 'Publicaciones', subtitle: 'Tus artículos y publicaciones' },
            'redes': { title: 'Redes Sociales', subtitle: 'Tus perfiles sociales' }
        };

        // Close sidebar when switching tabs on mobile
        function switchTab(tabName) {
            // Close mobile sidebar when switching tabs
            if (window.innerWidth < 1024) {
                toggleMobileSidebar();
            }
            // Update nav
            document.querySelectorAll('.nav-item').forEach(item => {
                item.classList.remove('active');
                if (item.dataset.tab === tabName) {
                    item.classList.add('active');
                }
            });

            // Update content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById('tab-' + tabName).classList.add('active');

            // Update title
            document.getElementById('tabTitle').textContent = tabTitles[tabName].title;
            document.getElementById('tabSubtitle').textContent = tabTitles[tabName].subtitle;
        }

        // Toggle QR Modal
        function toggleQRModal() {
            const modal = document.getElementById('qrModal');
            modal.classList.toggle('hidden');
            if (!modal.classList.contains('hidden') && !document.getElementById('qrContainer').innerHTML.includes('img')) {
                loadQRCode();
            }
        }

        // Toggle Progress Modal
        function toggleProgressModal() {
            const modal = document.getElementById('progressModal');
            if (modal) {
                modal.classList.toggle('hidden');
            } else {
                showProgressDetails();
            }
        }

        // Show progress details
        function showProgressDetails() {
            const progressDetails = `
                <div id="progressModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center">
                    <div class="bg-slate-800 rounded-2xl shadow-2xl max-w-sm w-full mx-4 overflow-hidden border border-slate-700">
                        <div class="bg-blue-900/50 p-4">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-bold text-white">Progreso del CV</h3>
                                <button onclick="toggleProgressModal()" class="text-white/80 hover:text-white">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center justify-center mb-4">
                                <div class="relative w-24 h-24">
                                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                                        <path class="text-slate-600" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="3" />
                                        <path id="progressRing" class="text-blue-500" stroke-dasharray="0, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="3" />
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span id="progressPercent" class="text-2xl font-bold text-white">0%</span>
                                    </div>
                                </div>
                            </div>
                            <div id="progressList" class="space-y-2 text-sm">
                                <div class="flex justify-between text-slate-300">
                                    <span>Cargando...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', progressDetails);
            setTimeout(() => document.getElementById('progressModal').classList.remove('hidden'), 10);
            loadProgressDetails();
        }

        // Load progress details
        async function loadProgressDetails() {
            const sections = [
                { key: 'perfil', name: 'Perfil', icon: 'fa-user' },
                { key: 'experiencia', name: 'Experiencia', icon: 'fa-briefcase' },
                { key: 'educacion', name: 'Educación', icon: 'fa-graduation-cap' },
                { key: 'certificaciones', name: 'Certificaciones', icon: 'fa-award' },
                { key: 'habilidades', name: 'Habilidades', icon: 'fa-tools' },
                { key: 'idiomas', name: 'Idiomas', icon: 'fa-language' },
                { key: 'proyectos', name: 'Proyectos', icon: 'fa-project-diagram' },
                { key: 'publicaciones', name: 'Publicaciones', icon: 'fa-book' },
                { key: 'redes', name: 'Redes Sociales', icon: 'fa-share-alt' }
            ];

            let completed = 0;
            const results = await Promise.all(sections.map(async (section) => {
                let hasData = false;
                let endpoint = '';

                switch(section.key) {
                    case 'perfil': endpoint = '/api/perfiles'; break;
                    case 'experiencia': endpoint = '/api/experiencias'; break;
                    case 'educacion': endpoint = '/api/educaciones'; break;
                    case 'certificaciones': endpoint = '/api/certificados'; break;
                    case 'habilidades': endpoint = '/api/habilidades'; break;
                    case 'idiomas': endpoint = '/api/idiomas'; break;
                    case 'proyectos': endpoint = '/api/proyectos'; break;
                    case 'publicaciones': endpoint = '/api/publicaciones'; break;
                    case 'redes': endpoint = '/api/redes-sociales'; break;
                }

                try {
                    const res = await fetch(endpoint, { headers: { 'Authorization': 'Bearer ' + token } });
                    if (res.ok) {
                        const data = await res.json();
                        hasData = section.key === 'perfil' ? !!data : (Array.isArray(data) && data.length > 0);
                    }
                } catch (e) {}

                if (hasData) completed++;
                return { ...section, completed: hasData };
            }));

            const percent = Math.round((completed / sections.length) * 100);

            // Update ring
            document.getElementById('progressRing').setAttribute('stroke-dasharray', `${percent}, 100`);
            document.getElementById('progressPercent').textContent = percent + '%';

            // Update list
            const listHtml = results.map(item => `
                <div class="flex items-center justify-between p-2 rounded-lg ${item.completed ? 'bg-green-900/30' : 'bg-slate-700'}">
                    <div class="flex items-center">
                        <i class="fas ${item.icon} ${item.completed ? 'text-green-400' : 'text-slate-400'} mr-2"></i>
                        <span class="${item.completed ? 'text-green-400' : 'text-slate-400'}">${item.name}</span>
                    </div>
                    <i class="fas ${item.completed ? 'fa-check-circle text-green-400' : 'fa-circle text-slate-500'}"></i>
                </div>
            `).join('');
            document.getElementById('progressList').innerHTML = listHtml;
        }

        // Copy CV URL
        function copyCVUrl() {
            const url = document.getElementById('cvUrl').textContent;
            navigator.clipboard.writeText(url).then(() => {
                showNotification('URL copiada al portapapeles', 'success');
            });
        }

        // Load QR Code
        function loadQRCode() {
            fetch('/api/usuarios/me', {
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Content-Type': 'application/json'
                }
            })
            .then(res => res.json())
            .then(user => {
                if (user.qr_code) {
                    document.getElementById('qrContainer').innerHTML = `
                        <img src="${user.qr_code}" alt="QR Code" class="w-48 h-48 mx-auto">
                    `;
                    document.getElementById('cvUrl').textContent = window.location.origin + '/cv/' + user.slug;
                    document.getElementById('cvUrlContainer').classList.remove('hidden');
                }
            });
        }

        // Fetch user data
        async function loadUser() {
            try {
                const response = await fetch('/api/usuarios/me', {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Error de autenticación');

                const user = await response.json();

                // Update user info
                document.getElementById('userName').textContent = user.nombre + ' ' + user.apellido;

                // Update View CV buttons with user slug
                const cvUrl = window.location.origin + '/cv/' + user.slug;
                document.getElementById('viewCvBtn').href = cvUrl;
                document.getElementById('viewCvBtnMobile').href = cvUrl;

                updateProfileStatus();
                loadProfileForm(user);
                updateProgress();
                loadExperiencias();
                loadEducaciones();
                loadCertificados();
                loadHabilidades();
                loadIdiomas();
                loadProyectos();
                loadPublicaciones();
                loadRedesSociales();

            } catch (error) {
                console.error('Error:', error);
                showErrorMessage();
            }
        }

        function updateProfileStatus() {
            const perfilStatus = document.getElementById('perfilStatus');
            fetch('/api/perfiles', { headers: { 'Authorization': 'Bearer ' + token } })
                .then(res => res.ok ? res.json() : null)
                .then(perfil => {
                    if (perfil) {
                        perfilStatus.innerHTML = `
                            <div class="flex items-center p-4 bg-green-900/30 rounded-xl border border-green-700">
                                <i class="fas fa-check-circle text-green-400 mr-3"></i>
                                <div>
                                    <p class="text-green-400 font-medium">Perfil completado</p>
                                    <p class="text-green-300/70 text-sm">Tu información está actualizada</p>
                                </div>
                            </div>`;
                    } else {
                        perfilStatus.innerHTML = `
                            <div class="flex items-center p-4 bg-yellow-900/30 rounded-xl border border-yellow-700">
                                <i class="fas fa-exclamation-triangle text-yellow-400 mr-3"></i>
                                <div>
                                    <p class="text-yellow-400 font-medium">Perfil incompleto</p>
                                    <p class="text-yellow-300/70 text-sm">Completa la información para continuar</p>
                                </div>
                            </div>`;
                    }
                });
        }

        function loadProfileForm(user) {
            document.getElementById('perfilForm').classList.remove('hidden');
            const form = document.getElementById('perfilForm');

            // Populate usuario fields (nombre, apellido, email)
            if (user.nombre) {
                const nombreInput = form.querySelector('[name="nombre"]');
                if (nombreInput) nombreInput.value = user.nombre;
            }
            if (user.apellido) {
                const apellidoInput = form.querySelector('[name="apellido"]');
                if (apellidoInput) apellidoInput.value = user.apellido;
            }
            if (user.email) {
                const emailInput = form.querySelector('[name="email"]');
                if (emailInput) emailInput.value = user.email;
            }

            // Populate perfil fields
            if (user.perfil) {
                Object.keys(user.perfil).forEach(key => {
                    const input = form.querySelector(`[name="${key}"]`);
                    if (input) input.value = user.perfil[key];
                });
            }
        }

        function updateProgress() {
            let completed = 0;
            const total = 9;

            Promise.all([
                fetch('/api/perfiles', { headers: { 'Authorization': 'Bearer ' + token } }).then(r => r.ok && completed++),
                fetch('/api/experiencias', { headers: { 'Authorization': 'Bearer ' + token } }).then(r => { if (r.ok) r.json().then(d => { if (d.length) completed++ }) }),
                fetch('/api/educaciones', { headers: { 'Authorization': 'Bearer ' + token } }).then(r => { if (r.ok) r.json().then(d => { if (d.length) completed++ }) }),
                fetch('/api/certificados', { headers: { 'Authorization': 'Bearer ' + token } }).then(r => { if (r.ok) r.json().then(d => { if (d.length) completed++ }) }),
                fetch('/api/habilidades', { headers: { 'Authorization': 'Bearer ' + token } }).then(r => { if (r.ok) r.json().then(d => { if (d.length) completed++ }) }),
                fetch('/api/idiomas', { headers: { 'Authorization': 'Bearer ' + token } }).then(r => { if (r.ok) r.json().then(d => { if (d.length) completed++ }) }),
                fetch('/api/proyectos', { headers: { 'Authorization': 'Bearer ' + token } }).then(r => { if (r.ok) r.json().then(d => { if (d.length) completed++ }) }),
                fetch('/api/publicaciones', { headers: { 'Authorization': 'Bearer ' + token } }).then(r => { if (r.ok) r.json().then(d => { if (d.length) completed++ }) }),
                fetch('/api/redes-sociales', { headers: { 'Authorization': 'Bearer ' + token } }).then(r => { if (r.ok) r.json().then(d => { if (d.length) completed++ }) })
            ]).then(() => {
                const percent = Math.round((completed / total) * 100);
                document.getElementById('progressBar').style.width = percent + '%';
                document.getElementById('progressText').textContent = percent + '%';
                // Update mobile badge
                const badge = document.getElementById('progressBadge');
                if (badge) badge.textContent = percent;
            });
        }

        function showErrorMessage() {
            document.getElementById('perfilStatus').innerHTML = `
                <div class="flex items-center p-4 bg-red-900/30 rounded-xl border border-red-700">
                    <i class="fas fa-exclamation-circle text-red-400 mr-3"></i>
                    <div>
                        <p class="text-red-400 font-medium">Error de conexión</p>
                        <p class="text-red-300/70 text-sm">No se pudieron cargar los datos</p>
                    </div>
                </div>`;
        }

        // Logout function
        async function logout() {
            try {
                await fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
            } catch (error) {
                console.error('Logout error:', error);
            } finally {
                localStorage.removeItem('token');
                window.location.href = '/login';
            }
        }

        // Token refresh
        const TOKEN_REFRESH_INTERVAL = 60 * 60 * 1000;
        async function refreshToken() {
            try {
                const response = await fetch('/api/refresh-token', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                if (response.ok) {
                    const data = await response.json();
                    localStorage.setItem('token', data.token);
                } else if (response.status === 401) {
                    logout();
                }
            } catch (error) {
                console.error('Token refresh error:', error);
            }
        }
        setInterval(refreshToken, TOKEN_REFRESH_INTERVAL);

        // Load data functions
        async function loadExperiencias() {
            const res = await fetch('/api/experiencias', { headers: { 'Authorization': 'Bearer ' + token } });
            if (res.ok) {
                const data = await res.json();
                displayExperiencias(data);
            }
        }

        async function loadEducaciones() {
            const res = await fetch('/api/educaciones', { headers: { 'Authorization': 'Bearer ' + token } });
            if (res.ok) {
                const data = await res.json();
                displayEducaciones(data);
            }
        }

        async function loadCertificados() {
            const res = await fetch('/api/certificados', { headers: { 'Authorization': 'Bearer ' + token } });
            if (res.ok) {
                const data = await res.json();
                displayCertificados(data);
            }
        }

        async function loadHabilidades() {
            const res = await fetch('/api/habilidades', { headers: { 'Authorization': 'Bearer ' + token } });
            if (res.ok) {
                const data = await res.json();
                displayHabilidades(data);
            }
        }

        async function loadIdiomas() {
            const res = await fetch('/api/idiomas', { headers: { 'Authorization': 'Bearer ' + token } });
            if (res.ok) {
                const data = await res.json();
                displayIdiomas(data);
            }
        }

        async function loadProyectos() {
            const res = await fetch('/api/proyectos', { headers: { 'Authorization': 'Bearer ' + token } });
            if (res.ok) {
                const data = await res.json();
                displayProyectos(data);
            }
        }

        async function loadPublicaciones() {
            const res = await fetch('/api/publicaciones', { headers: { 'Authorization': 'Bearer ' + token } });
            if (res.ok) {
                const data = await res.json();
                displayPublicaciones(data);
            }
        }

        async function loadRedesSociales() {
            const res = await fetch('/api/redes-sociales', { headers: { 'Authorization': 'Bearer ' + token } });
            if (res.ok) {
                const data = await res.json();
                displayRedesSociales(data);
            }
        }

        // Display functions
        function displayExperiencias(data) {
            const container = document.getElementById('experienciasContainer');
            const list = document.getElementById('experienciasList');
            if (data.length > 0) {
                container.classList.remove('hidden');
                list.innerHTML = data.map(exp => createCard('experiencia', exp, exp.cargo + ' - ' + exp.empresa, exp.descripcion, 'fa-briefcase', 'green')).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function displayEducaciones(data) {
            const container = document.getElementById('educacionesContainer');
            const list = document.getElementById('educacionesList');
            if (data.length > 0) {
                container.classList.remove('hidden');
                list.innerHTML = data.map(edu => createCard('educacion', edu, edu.titulo + ' - ' + edu.institucion, edu.nivel, 'fa-graduation-cap', 'purple')).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function displayCertificados(data) {
            const container = document.getElementById('certificadosContainer');
            const list = document.getElementById('certificadosList');
            if (data.length > 0) {
                container.classList.remove('hidden');
                list.innerHTML = data.map(cert => createCard('certificado', cert, cert.titulo, cert.institucion, 'fa-award', 'yellow')).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function displayHabilidades(data) {
            const container = document.getElementById('habilidadesContainer');
            const list = document.getElementById('habilidadesList');
            if (data.length > 0) {
                container.classList.remove('hidden');
                list.innerHTML = data.map(hab => `
                    <div class="bg-slate-700 border border-slate-600 rounded-xl p-4 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-cyan-600/30 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-tools text-cyan-400"></i>
                            </div>
                            <span class="font-medium text-white">${hab.habilidad}</span>
                            <span class="ml-3 px-3 py-1 bg-cyan-600/30 text-cyan-400 rounded-full text-sm">${hab.nivel}</span>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="deleteHabilidad(${hab.id})" class="text-red-400 hover:text-red-300"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                `).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function displayIdiomas(data) {
            const container = document.getElementById('idiomasContainer');
            const list = document.getElementById('idiomasList');
            if (data.length > 0) {
                container.classList.remove('hidden');
                list.innerHTML = data.map(idioma => `
                    <div class="bg-slate-700 border border-slate-600 rounded-xl p-4 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-emerald-600/30 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-language text-emerald-400"></i>
                            </div>
                            <span class="font-medium text-white">${idioma.idioma}</span>
                            <span class="ml-3 px-3 py-1 bg-emerald-600/30 text-emerald-400 rounded-full text-sm">${idioma.nivel}</span>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="deleteIdioma(${idioma.id})" class="text-red-400 hover:text-red-300"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                `).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function displayProyectos(data) {
            const container = document.getElementById('proyectosContainer');
            const list = document.getElementById('proyectosList');
            if (data.length > 0) {
                container.classList.remove('hidden');
                list.innerHTML = data.map(proy => createCard('proyecto', proy, proy.titulo, proy.descripcion, 'fa-project-diagram', 'orange', proy.url)).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function displayPublicaciones(data) {
            const container = document.getElementById('publicacionesContainer');
            const list = document.getElementById('publicacionesList');
            if (data.length > 0) {
                container.classList.remove('hidden');
                list.innerHTML = data.map(pub => createCard('publicacion', pub, pub.titulo, pub.descripcion, 'fa-book', 'pink', pub.url)).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function displayRedesSociales(data) {
            const container = document.getElementById('redesSocialesContainer');
            const list = document.getElementById('redesSocialesList');
            if (data.length > 0) {
                container.classList.remove('hidden');
                list.innerHTML = data.map(red => `
                    <div class="bg-slate-700 border border-slate-600 rounded-xl p-4 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-indigo-600/30 rounded-lg flex items-center justify-center mr-3">
                                <i class="fab fa-${red.plataforma.toLowerCase()} text-indigo-400 text-lg"></i>
                            </div>
                            <div>
                                <span class="font-medium text-white">${red.plataforma}</span>
                                <a href="${red.url}" target="_blank" class="ml-2 text-indigo-400 hover:underline text-sm">Ver perfil</a>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="deleteRedSocial(${red.id})" class="text-red-400 hover:text-red-300"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                `).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function createCard(type, item, title, subtitle, icon, color, url = null) {
            const colorClasses = {
                green: 'bg-green-600/30 text-green-400',
                purple: 'bg-purple-600/30 text-purple-400',
                yellow: 'bg-yellow-600/30 text-yellow-400',
                orange: 'bg-orange-600/30 text-orange-400',
                pink: 'bg-pink-600/30 text-pink-400'
            };
            const urlHtml = url ? `<a href="${url}" target="_blank" class="text-${color === 'green' ? 'green' : color === 'purple' ? 'purple' : color === 'yellow' ? 'yellow' : color === 'orange' ? 'orange' : 'pink'}-400 hover:underline text-sm mt-1 block"><i class="fas fa-external-link-alt mr-1"></i>Ver más</a>` : '';

            const deleteFn = {
                experiencia: 'deleteExperiencia',
                educacion: 'deleteEducacion',
                certificado: 'deleteCertificado',
                proyecto: 'deleteProyecto',
                publicacion: 'deletePublicacion'
            }[type];

            return `
                <div class="bg-slate-700 border border-slate-600 rounded-xl p-4">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start">
                            <div class="w-10 h-10 ${colorClasses[color]} rounded-lg flex items-center justify-center mr-3">
                                <i class="fas ${icon}"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-white">${title}</h4>
                                <p class="text-sm text-slate-300">${subtitle}</p>
                                ${urlHtml}
                            </div>
                        </div>
                        <button onclick="${deleteFn}(${item.id})" class="text-red-400 hover:text-red-300">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
        }

        // Delete functions
        async function deleteExperiencia(id) {
            if (!confirm('¿Eliminar esta experiencia?')) return;
            await fetch(`/api/experiencias/${id}`, { method: 'DELETE', headers: { 'Authorization': 'Bearer ' + token } });
            showNotification('Experiencia eliminada', 'success');
            loadExperiencias();
            updateProgress();
        }

        async function deleteEducacion(id) {
            if (!confirm('¿Eliminar esta educación?')) return;
            await fetch(`/api/educaciones/${id}`, { method: 'DELETE', headers: { 'Authorization': 'Bearer ' + token } });
            showNotification('Educación eliminada', 'success');
            loadEducaciones();
            updateProgress();
        }

        async function deleteCertificado(id) {
            if (!confirm('¿Eliminar esta certificación?')) return;
            await fetch(`/api/certificados/${id}`, { method: 'DELETE', headers: { 'Authorization': 'Bearer ' + token } });
            showNotification('Certificación eliminada', 'success');
            loadCertificados();
            updateProgress();
        }

        async function deleteHabilidad(id) {
            if (!confirm('¿Eliminar esta habilidad?')) return;
            await fetch(`/api/habilidades/${id}`, { method: 'DELETE', headers: { 'Authorization': 'Bearer ' + token } });
            showNotification('Habilidad eliminada', 'success');
            loadHabilidades();
            updateProgress();
        }

        async function deleteIdioma(id) {
            if (!confirm('¿Eliminar este idioma?')) return;
            await fetch(`/api/idiomas/${id}`, { method: 'DELETE', headers: { 'Authorization': 'Bearer ' + token } });
            showNotification('Idioma eliminado', 'success');
            loadIdiomas();
            updateProgress();
        }

        async function deleteProyecto(id) {
            if (!confirm('¿Eliminar este proyecto?')) return;
            await fetch(`/api/proyectos/${id}`, { method: 'DELETE', headers: { 'Authorization': 'Bearer ' + token } });
            showNotification('Proyecto eliminado', 'success');
            loadProyectos();
            updateProgress();
        }

        async function deletePublicacion(id) {
            if (!confirm('¿Eliminar esta publicación?')) return;
            await fetch(`/api/publicaciones/${id}`, { method: 'DELETE', headers: { 'Authorization': 'Bearer ' + token } });
            showNotification('Publicación eliminada', 'success');
            loadPublicaciones();
            updateProgress();
        }

        async function deleteRedSocial(id) {
            if (!confirm('¿Eliminar esta red social?')) return;
            await fetch(`/api/redes-sociales/${id}`, { method: 'DELETE', headers: { 'Authorization': 'Bearer ' + token } });
            showNotification('Red social eliminada', 'success');
            loadRedesSociales();
            updateProgress();
        }

        // Form submissions
        document.getElementById('perfilForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData);

            // Separate usuario fields from perfil fields
            const usuarioData = {
                nombre: data.nombre,
                apellido: data.apellido,
                email: data.email
            };
            const perfilData = {
                cargo: data.cargo,
                telefono: data.telefono,
                fecha_nacimiento: data.fecha_nacimiento,
                nacionalidad: data.nacionalidad,
                direccion: data.direccion,
                ciudad: data.ciudad,
                pais: data.pais,
                tipo_documento: data.tipo_documento,
                numero_documento: data.numero_documento,
                descripcion: data.descripcion
            };

            // Save usuario data first
            const usuarioRes = await fetch('/api/usuarios/me', {
                method: 'PUT',
                headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                body: JSON.stringify(usuarioData)
            });

            // Then save perfil data
            const perfilRes = await fetch('/api/perfiles', {
                method: 'POST',
                headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                body: JSON.stringify(perfilData)
            });

            if (perfilRes.ok) {
                showNotification('Perfil guardado correctamente', 'success');
                loadUser();
            } else {
                showNotification('Error al guardar', 'error');
            }
        });

        document.getElementById('experienciaForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            data.es_actual = e.target.es_actual.checked;
            const res = await fetch('/api/experiencias', {
                method: 'POST',
                headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            if (res.ok) {
                showNotification('Experiencia guardada', 'success');
                e.target.reset();
                loadExperiencias();
                updateProgress();
            }
        });

        document.getElementById('educacionForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            const res = await fetch('/api/educaciones', {
                method: 'POST',
                headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            if (res.ok) {
                showNotification('Educación guardada', 'success');
                e.target.reset();
                loadEducaciones();
                updateProgress();
            }
        });

        document.getElementById('certificadoForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            const res = await fetch('/api/certificados', {
                method: 'POST',
                headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            if (res.ok) {
                showNotification('Certificación guardada', 'success');
                e.target.reset();
                loadCertificados();
                updateProgress();
            }
        });

        document.getElementById('habilidadForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            const res = await fetch('/api/habilidades', {
                method: 'POST',
                headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            if (res.ok) {
                showNotification('Habilidad guardada', 'success');
                e.target.reset();
                loadHabilidades();
                updateProgress();
            }
        });

        document.getElementById('idiomaForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            const res = await fetch('/api/idiomas', {
                method: 'POST',
                headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            if (res.ok) {
                showNotification('Idioma guardado', 'success');
                e.target.reset();
                loadIdiomas();
                updateProgress();
            }
        });

        document.getElementById('proyectoForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            const res = await fetch('/api/proyectos', {
                method: 'POST',
                headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            if (res.ok) {
                showNotification('Proyecto guardado', 'success');
                e.target.reset();
                loadProyectos();
                updateProgress();
            }
        });

        document.getElementById('publicacionForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            const res = await fetch('/api/publicaciones', {
                method: 'POST',
                headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            if (res.ok) {
                showNotification('Publicación guardada', 'success');
                e.target.reset();
                loadPublicaciones();
                updateProgress();
            }
        });

        document.getElementById('redSocialForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const data = Object.fromEntries(new FormData(e.target));
            const res = await fetch('/api/redes-sociales', {
                method: 'POST',
                headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            if (res.ok) {
                showNotification('Red social guardada', 'success');
                e.target.reset();
                loadRedesSociales();
                updateProgress();
            }
        });

        // Notification
        function showNotification(message, type = 'info') {
            const colors = { success: 'bg-green-500', error: 'bg-red-500', info: 'bg-blue-500' };
            const icons = { success: 'fa-check', error: 'fa-exclamation', info: 'fa-info' };
            const notif = document.createElement('div');
            notif.className = `fixed top-4 right-4 ${colors[type]} text-white px-6 py-3 rounded-xl shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
            notif.innerHTML = `<i class="fas ${icons[type]} mr-2"></i>${message}`;
            document.body.appendChild(notif);
            setTimeout(() => notif.classList.remove('translate-x-full'), 100);
            setTimeout(() => {
                notif.classList.add('translate-x-full');
                setTimeout(() => notif.remove(), 300);
            }, 3000);
        }

        // Init
        loadUser();
    </script>
</body>

</html>
<?php /**PATH C:\Users\USER\Documents\GitHub\vitae-app\resources\views/dashboard.blade.php ENDPATH**/ ?>
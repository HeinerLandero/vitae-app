<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-6">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-3 rounded-xl mr-4">
                        <i class="fas fa-user-circle text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Mi Currículum Digital</h1>
                        <p class="text-sm text-gray-500">Gestiona tu perfil profesional</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button onclick="logout()" class="text-gray-600 hover:text-gray-900 transition-colors">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Cerrar Sesión
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Profile Section -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-user text-blue-600"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Información Personal</h2>
                                <p class="text-sm text-gray-600">Completa tu perfil profesional</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div id="perfilStatus" class="mb-6">
                            <div class="flex items-center">
                                <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-blue-600 mr-3"></div>
                                <p class="text-gray-600">Cargando información del perfil...</p>
                            </div>
                        </div>
                        <form id="perfilForm" class="hidden">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-user mr-2 text-gray-400"></i>Nombre
                                    </label>
                                    <input type="text" name="nombre" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Tu nombre">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-user-tag mr-2 text-gray-400"></i>Apellido
                                    </label>
                                    <input type="text" name="apellido" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Tu apellido">
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-briefcase mr-2 text-gray-400"></i>Cargo Profesional
                                </label>
                                <input type="text" name="cargo" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Ej: Desarrollador Full Stack, Ingeniero de Software">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-envelope mr-2 text-gray-400"></i>Email
                                    </label>
                                    <input type="email" name="email" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        placeholder="tu@email.com">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-phone mr-2 text-gray-400"></i>Teléfono
                                    </label>
                                    <input type="text" name="telefono" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        placeholder="+57 300 123 4567">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-calendar mr-2 text-gray-400"></i>Fecha de Nacimiento
                                    </label>
                                    <input type="date" name="fecha_nacimiento" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-flag mr-2 text-gray-400"></i>Nacionalidad
                                    </label>
                                    <input type="text" name="nacionalidad" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Colombiana">
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>Dirección
                                </label>
                                <input type="text" name="direccion" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Calle 123 #45-67">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-city mr-2 text-gray-400"></i>Ciudad
                                    </label>
                                    <input type="text" name="ciudad" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Bogotá">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-globe mr-2 text-gray-400"></i>País
                                    </label>
                                    <input type="text" name="pais" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Colombia">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-id-card mr-2 text-gray-400"></i>Tipo de Documento
                                    </label>
                                    <select name="tipo_documento" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                        <option value="">Seleccionar</option>
                                        <option value="CC">Cédula de Ciudadanía</option>
                                        <option value="CE">Cédula de Extranjería</option>
                                        <option value="PP">Pasaporte</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-hashtag mr-2 text-gray-400"></i>Número de Documento
                                </label>
                                <input type="text" name="numero_documento" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                    placeholder="123456789">
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-align-left mr-2 text-gray-400"></i>Descripción Personal
                                </label>
                                <textarea name="descripcion" rows="4" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
                                    placeholder="Cuéntanos sobre ti, tu experiencia y objetivos profesionales..."></textarea>
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-6 rounded-lg font-medium hover:from-blue-700 hover:to-purple-700 transform hover:scale-[1.02] transition-all duration-200 shadow-lg">
                                <i class="fas fa-save mr-2"></i>
                                Guardar Perfil
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Work Experience Section -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-50 to-teal-50 px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="bg-green-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-briefcase text-green-600"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Experiencia Laboral</h2>
                                <p class="text-sm text-gray-600">Agrega tu historial profesional</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <!-- Existing Experiences -->
                        <div id="experienciasContainer" class="mb-6 hidden">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tus Experiencias</h3>
                            <div id="experienciasList" class="space-y-4">
                                <!-- Experience cards will be loaded here -->
                            </div>
                        </div>

                        <form id="experienciaForm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-building mr-2 text-gray-400"></i>Empresa
                                    </label>
                                    <input type="text" name="empresa" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Nombre de la empresa">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-user-tie mr-2 text-gray-400"></i>Cargo
                                    </label>
                                    <input type="text" name="cargo" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Tu posición">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-align-left mr-2 text-gray-400"></i>Descripción del Trabajo
                                </label>
                                <textarea name="descripcion" rows="3" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 resize-none"
                                    placeholder="Describe tus responsabilidades y logros..."></textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-calendar-plus mr-2 text-gray-400"></i>Fecha de Inicio
                                    </label>
                                    <input type="date" name="fecha_inicio" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-calendar-minus mr-2 text-gray-400"></i>Fecha de Fin
                                    </label>
                                    <input type="date" name="fecha_fin"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200">
                                </div>
                                <div class="flex items-end">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="es_actual" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                                        <span class="ml-2 text-sm text-gray-700">Trabajo actual</span>
                                    </label>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-green-600 to-teal-600 text-white py-3 px-6 rounded-lg font-medium hover:from-green-700 hover:to-teal-700 transform hover:scale-[1.02] transition-all duration-200 shadow-lg">
                                <i class="fas fa-plus mr-2"></i>
                                Agregar Experiencia
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Education Section -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="bg-purple-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-graduation-cap text-purple-600"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Educación</h2>
                                <p class="text-sm text-gray-600">Agrega tu formación académica</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div id="educacionesContainer" class="mb-6 hidden">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tu Educación</h3>
                            <div id="educacionesList" class="space-y-4">
                                <!-- Education cards will be loaded here -->
                            </div>
                        </div>

                        <form id="educacionForm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-building mr-2 text-gray-400"></i>Institución
                                    </label>
                                    <input type="text" name="institucion" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Nombre de la institución">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-certificate mr-2 text-gray-400"></i>Título
                                    </label>
                                    <input type="text" name="titulo" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Título obtenido">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-layer-group mr-2 text-gray-400"></i>Nivel
                                    </label>
                                    <select name="nivel" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                        <option value="">Seleccionar nivel</option>
                                        <option value="Bachillerato">Bachillerato</option>
                                        <option value="Técnico">Técnico</option>
                                        <option value="Tecnólogo">Tecnólogo</option>
                                        <option value="Pregrado">Pregrado</option>
                                        <option value="Especialización">Especialización</option>
                                        <option value="Maestría">Maestría</option>
                                        <option value="Doctorado">Doctorado</option>
                                        <option value="Postdoctorado">Postdoctorado</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-calendar-plus mr-2 text-gray-400"></i>Fecha de Inicio
                                    </label>
                                    <input type="date" name="fecha_inicio" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-calendar-minus mr-2 text-gray-400"></i>Fecha de Fin
                                    </label>
                                    <input type="date" name="fecha_fin"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 px-6 rounded-lg font-medium hover:from-purple-700 hover:to-indigo-700 transform hover:scale-[1.02] transition-all duration-200 shadow-lg">
                                <i class="fas fa-plus mr-2"></i>
                                Agregar Educación
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Certifications Section -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-award text-yellow-600"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Certificaciones</h2>
                                <p class="text-sm text-gray-600">Agrega tus certificaciones y cursos</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div id="certificadosContainer" class="mb-6 hidden">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tus Certificaciones</h3>
                            <div id="certificadosList" class="space-y-4">
                                <!-- Certification cards will be loaded here -->
                            </div>
                        </div>

                        <form id="certificadoForm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-certificate mr-2 text-gray-400"></i>Nombre de la Certificación
                                    </label>
                                    <input type="text" name="titulo" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Nombre de la certificación">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-building mr-2 text-gray-400"></i>Institución Emisora
                                    </label>
                                    <input type="text" name="institucion" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Institución que emite la certificación">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-calendar mr-2 text-gray-400"></i>Fecha de Emisión
                                </label>
                                <input type="date" name="fecha_emision" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent transition-all duration-200">
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-yellow-600 to-orange-600 text-white py-3 px-6 rounded-lg font-medium hover:from-yellow-700 hover:to-orange-700 transform hover:scale-[1.02] transition-all duration-200 shadow-lg">
                                <i class="fas fa-plus mr-2"></i>
                                Agregar Certificación
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Skills Section -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-tools text-blue-600"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Habilidades</h2>
                                <p class="text-sm text-gray-600">Agrega tus competencias técnicas</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div id="habilidadesContainer" class="mb-6 hidden">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tus Habilidades</h3>
                            <div id="habilidadesList" class="space-y-4">
                                <!-- Skills cards will be loaded here -->
                            </div>
                        </div>

                        <form id="habilidadForm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-code mr-2 text-gray-400"></i>Habilidad
                                    </label>
                                    <input type="text" name="habilidad" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Ej: JavaScript, Python, etc.">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-chart-line mr-2 text-gray-400"></i>Nivel
                                    </label>
                                    <select name="nivel" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                                        <option value="">Seleccionar nivel</option>
                                        <option value="Básico">Básico</option>
                                        <option value="Intermedio">Intermedio</option>
                                        <option value="Avanzado">Avanzado</option>
                                        <option value="Experto">Experto</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 text-white py-3 px-6 rounded-lg font-medium hover:from-blue-700 hover:to-cyan-700 transform hover:scale-[1.02] transition-all duration-200 shadow-lg">
                                <i class="fas fa-plus mr-2"></i>
                                Agregar Habilidad
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Languages Section -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="bg-green-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-language text-green-600"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Idiomas</h2>
                                <p class="text-sm text-gray-600">Agrega los idiomas que dominas</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div id="idiomasContainer" class="mb-6 hidden">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tus Idiomas</h3>
                            <div id="idiomasList" class="space-y-4">
                                <!-- Languages cards will be loaded here -->
                            </div>
                        </div>

                        <form id="idiomaForm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-globe mr-2 text-gray-400"></i>Idioma
                                    </label>
                                    <input type="text" name="idioma" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                        placeholder="Ej: Inglés, Español, Francés">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-chart-line mr-2 text-gray-400"></i>Nivel
                                    </label>
                                    <select name="nivel" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200">
                                        <option value="">Seleccionar nivel</option>
                                        <option value="Básico">Básico</option>
                                        <option value="Conversacional">Conversacional</option>
                                        <option value="Intermedio">Intermedio</option>
                                        <option value="Avanzado">Avanzado</option>
                                        <option value="Nativo">Nativo</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-3 px-6 rounded-lg font-medium hover:from-green-700 hover:to-emerald-700 transform hover:scale-[1.02] transition-all duration-200 shadow-lg">
                                <i class="fas fa-plus mr-2"></i>
                                Agregar Idioma
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Projects Section -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-50 to-red-50 px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="bg-orange-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-project-diagram text-orange-600"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Proyectos</h2>
                                <p class="text-sm text-gray-600">Agrega tus proyectos destacados</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div id="proyectosContainer" class="mb-6 hidden">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tus Proyectos</h3>
                            <div id="proyectosList" class="space-y-4">
                                <!-- Projects cards will be loaded here -->
                            </div>
                        </div>

                        <form id="proyectoForm">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-tag mr-2 text-gray-400"></i>Título del Proyecto
                                </label>
                                <input type="text" name="titulo" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Nombre del proyecto">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-align-left mr-2 text-gray-400"></i>Descripción
                                </label>
                                <textarea name="descripcion" rows="3" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 resize-none"
                                    placeholder="Describe el proyecto, tecnologías utilizadas, etc."></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-link mr-2 text-gray-400"></i>URL del Proyecto (Opcional)
                                </label>
                                <input type="url" name="url"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200"
                                    placeholder="https://github.com/usuario/proyecto">
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-orange-600 to-red-600 text-white py-3 px-6 rounded-lg font-medium hover:from-orange-700 hover:to-red-700 transform hover:scale-[1.02] transition-all duration-200 shadow-lg">
                                <i class="fas fa-plus mr-2"></i>
                                Agregar Proyecto
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Publications Section -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-pink-50 to-rose-50 px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="bg-pink-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-book text-pink-600"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Publicaciones</h2>
                                <p class="text-sm text-gray-600">Agrega tus artículos y publicaciones</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div id="publicacionesContainer" class="mb-6 hidden">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tus Publicaciones</h3>
                            <div id="publicacionesList" class="space-y-4">
                                <!-- Publications cards will be loaded here -->
                            </div>
                        </div>

                        <form id="publicacionForm">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-heading mr-2 text-gray-400"></i>Título de la Publicación
                                </label>
                                <input type="text" name="titulo" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200"
                                    placeholder="Título del artículo o publicación">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-align-left mr-2 text-gray-400"></i>Descripción
                                </label>
                                <textarea name="descripcion" rows="3" required
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200 resize-none"
                                    placeholder="Resumen o descripción de la publicación"></textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-calendar mr-2 text-gray-400"></i>Fecha de Publicación
                                    </label>
                                    <input type="date" name="fecha" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-link mr-2 text-gray-400"></i>URL (Opcional)
                                    </label>
                                    <input type="url" name="url"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-200"
                                        placeholder="https://medium.com/articulo">
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-pink-600 to-rose-600 text-white py-3 px-6 rounded-lg font-medium hover:from-pink-700 hover:to-rose-700 transform hover:scale-[1.02] transition-all duration-200 shadow-lg">
                                <i class="fas fa-plus mr-2"></i>
                                Agregar Publicación
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Social Networks Section -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-share-alt text-indigo-600"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Redes Sociales</h2>
                                <p class="text-sm text-gray-600">Agrega tus perfiles sociales</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div id="redesSocialesContainer" class="mb-6 hidden">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tus Redes Sociales</h3>
                            <div id="redesSocialesList" class="space-y-4">
                                <!-- Social networks cards will be loaded here -->
                            </div>
                        </div>

                        <form id="redSocialForm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-hashtag mr-2 text-gray-400"></i>Plataforma
                                    </label>
                                    <select name="plataforma" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200">
                                        <option value="">Seleccionar plataforma</option>
                                        <option value="LinkedIn">LinkedIn</option>
                                        <option value="GitHub">GitHub</option>
                                        <option value="Twitter">Twitter</option>
                                        <option value="Facebook">Facebook</option>
                                        <option value="Instagram">Instagram</option>
                                        <option value="YouTube">YouTube</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Website">Sitio Web</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="fas fa-link mr-2 text-gray-400"></i>URL del Perfil
                                    </label>
                                    <input type="url" name="url" required
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                                        placeholder="https://linkedin.com/in/tu-perfil">
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 px-6 rounded-lg font-medium hover:from-indigo-700 hover:to-purple-700 transform hover:scale-[1.02] transition-all duration-200 shadow-lg">
                                <i class="fas fa-plus mr-2"></i>
                                Agregar Red Social
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- QR Code Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="bg-purple-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-qrcode text-purple-600"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Mi Código QR</h2>
                                <p class="text-sm text-gray-600">Comparte tu perfil fácilmente</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div id="qrContainer" class="text-center">
                            <div class="flex items-center justify-center">
                                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-purple-600"></div>
                            </div>
                            <p class="text-gray-600 mt-4">Generando código QR...</p>
                        </div>
                    </div>
                </div>

                <!-- Profile Completion Card -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-50 to-red-50 px-6 py-4 border-b border-gray-100">
                        <div class="flex items-center">
                            <div class="bg-orange-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-chart-pie text-orange-600"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold text-gray-900">Progreso</h2>
                                <p class="text-sm text-gray-600">Estado de tu perfil</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div id="completionStatus">
                            <div class="text-center">
                                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-orange-600 mx-auto"></div>
                                <p class="text-gray-600 mt-2">Calculando progreso...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/login';
        }

        async function getFormData() {
            try {
                const requestData = await fetch('/api/perfiles', {
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {

                        const profileForm = document.getElementById('perfilForm');
                        Object.keys(data).forEach(key => {
                            if (profileForm.elements[key]) {
                                profileForm.elements[key].value = data[key];
                                // console.log(data[key]);
                            }
                        });
                        Object.keys(data.usuario).forEach(key => {
                            if (profileForm.elements[key]) {
                                profileForm.elements[key].value = data.usuario[key];
                                // console.log(data[key]);
                            }
                        });
                        console.log(data.usuario);
                    })
                if (!requestData.ok) {
                    throw new Error('Error de autenticación');
                }
            } catch (error) {
                console.error(error);
                showErrorMessage();
            }
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

                if (!response.ok) {
                    throw new Error('Error de autenticación');
                }

                const user = await response.json();
                updateProfileStatus();
                updateQRCode(user);
                loadProfileForm(user);
                updateCompletionStatus();
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
            fetch('/api/perfiles', {
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                })
                .then(response => response.ok ? response.json() : null)
                .then(perfil => {
                    if (perfil) {
                        perfilStatus.innerHTML = `
                        <div class="flex items-center p-4 bg-green-50 rounded-lg border border-green-200">
                            <i class="fas fa-check-circle text-green-600 mr-3"></i>
                            <div>
                                <p class="text-green-800 font-medium">Perfil completado</p>
                                <p class="text-green-600 text-sm">Tu información está actualizada</p>
                            </div>
                        </div>
                    `;
                    } else {
                        perfilStatus.innerHTML = `
                        <div class="flex items-center p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                            <i class="fas fa-exclamation-triangle text-yellow-600 mr-3"></i>
                            <div>
                                <p class="text-yellow-800 font-medium">Perfil incompleto</p>
                                <p class="text-yellow-600 text-sm">Completa la información para continuar</p>
                            </div>
                        </div>
                    `;
                    }
                })
                .catch(() => {
                    perfilStatus.innerHTML = `
                    <div class="flex items-center p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mr-3"></i>
                        <div>
                            <p class="text-yellow-800 font-medium">Completa tu perfil</p>
                            <p class="text-yellow-600 text-sm">Llena el formulario para empezar</p>
                        </div>
                    </div>
                `;
                });
        }

        function updateQRCode(user) {
            const qrContainer = document.getElementById('qrContainer');

            if (user.qr_code) {
                qrContainer.innerHTML = `
                    <div class="text-center">
                        <div class="bg-white p-4 rounded-xl shadow-inner border border-gray-100 inline-block">
                            <img src="${user.qr_code}" alt="QR Code" class="w-32 h-32 mx-auto">
                        </div>
                        <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs text-gray-600 mb-2">URL de tu CV:</p>
                            <div class="flex items-center justify-between bg-white p-2 rounded border">
                                <span class="text-sm text-gray-700 truncate flex-1">
                                    ${window.location.origin}/cv/${user.slug}
                                </span>
                                <button onclick="copyCVUrl('${user.slug}')"
                                        class="ml-2 text-gray-500 hover:text-gray-700 transition-colors">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                        <button onclick="generateQr()"
                                class="mt-3 text-purple-600 hover:text-purple-800 text-sm font-medium transition-colors">
                            <i class="fas fa-sync-alt mr-1"></i>
                            Regenerar QR
                        </button>
                    </div>
                `;
            } else {
                qrContainer.innerHTML = `
                    <div class="text-center">
                        <div class="bg-gray-100 rounded-xl p-8 mb-4">
                            <i class="fas fa-qrcode text-4xl text-gray-400"></i>
                        </div>
                        <p class="text-gray-600 mb-4">Código QR no disponible</p>
                        <button onclick="generateQr()"
                                class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-2 px-4 rounded-lg font-medium hover:from-purple-700 hover:to-pink-700 transition-all duration-200">
                            <i class="fas fa-magic mr-2"></i>
                            Generar Código QR
                        </button>
                    </div>
                `;
            }
        }

        function loadProfileForm(user) {
            document.getElementById('perfilForm').classList.remove('hidden');

            if (user.perfil) {
                const form = document.getElementById('perfilForm');
                Object.keys(user.perfil).forEach(key => {
                    const input = form.querySelector(`[name="${key}"]`);
                    if (input) input.value = user.perfil[key];
                });
            }
        }

        function updateCompletionStatus() {
            // This would calculate and display profile completion percentage
            document.getElementById('completionStatus').innerHTML = `
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto mb-4 relative">
                        <svg class="w-20 h-20 transform -rotate-90" viewBox="0 0 36 36">
                            <path class="text-gray-200" stroke="currentColor" stroke-width="3" fill="none"
                                  d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                            <path class="text-blue-600" stroke="currentColor" stroke-width="3" fill="none"
                                  stroke-dasharray="60, 100"
                                  d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-sm font-bold text-gray-700">60%</span>
                        </div>
                    </div>
                    <p class="text-gray-600">Perfil en progreso</p>
                    <p class="text-xs text-gray-500 mt-1">Completa más secciones para mejorar tu CV</p>
                </div>
            `;
        }

        function showErrorMessage() {
            document.getElementById('perfilStatus').innerHTML = `
                <div class="flex items-center p-4 bg-red-50 rounded-lg border border-red-200">
                    <i class="fas fa-exclamation-circle text-red-600 mr-3"></i>
                    <div>
                        <p class="text-red-800 font-medium">Error de conexión</p>
                        <p class="text-red-600 text-sm">No se pudieron cargar los datos</p>
                    </div>
                </div>
            `;
        }

        // Copy CV URL function
        function copyCVUrl(slug) {
            const url = `${window.location.origin}/cv/${slug}`;
            navigator.clipboard.writeText(url).then(() => {
                // Show success message
                const button = event.target.closest('button');
                const originalHTML = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i>';
                button.classList.add('text-green-600');
                setTimeout(() => {
                    button.innerHTML = originalHTML;
                    button.classList.remove('text-green-600');
                }, 2000);
            });
        }

        // Logout function
        async function logout() {
            try {
                const token = localStorage.getItem('token');
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
                localStorage.removeItem('tokenExpiry');
                window.location.href = '/login';
            }
        }

        // Token refresh logic - refresh every hour
        const TOKEN_REFRESH_INTERVAL = 60 * 60 * 1000; // 1 hour in milliseconds

        async function refreshToken() {
            try {
                const token = localStorage.getItem('token');
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
                    console.log('Token refreshed successfully');
                } else if (response.status === 401) {
                    // Token expired or invalid
                    logout();
                }
            } catch (error) {
                console.error('Token refresh error:', error);
            }
        }

        // Start token refresh timer (every hour)
        setInterval(refreshToken, TOKEN_REFRESH_INTERVAL);

        // Load experiences
        async function loadExperiencias() {
            try {
                const response = await fetch('/api/experiencias', {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    const experiencias = await response.json();
                    displayExperiencias(experiencias);
                }
            } catch (error) {
                console.error('Error loading experiences:', error);
            }
        }

        // Load education
        async function loadEducaciones() {
            try {
                const response = await fetch('/api/educaciones', {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    const educaciones = await response.json();
                    displayEducaciones(educaciones);
                }
            } catch (error) {
                console.error('Error loading education:', error);
            }
        }

        // Load certifications
        async function loadCertificados() {
            try {
                const response = await fetch('/api/certificados', {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    const certificados = await response.json();
                    displayCertificados(certificados);
                }
            } catch (error) {
                console.error('Error loading certifications:', error);
            }
        }

        // Load skills
        async function loadHabilidades() {
            try {
                const response = await fetch('/api/habilidades', {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    const habilidades = await response.json();
                    displayHabilidades(habilidades);
                }
            } catch (error) {
                console.error('Error loading skills:', error);
            }
        }

        // Load languages
        async function loadIdiomas() {
            try {
                const response = await fetch('/api/idiomas', {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    const idiomas = await response.json();
                    displayIdiomas(idiomas);
                }
            } catch (error) {
                console.error('Error loading languages:', error);
            }
        }

        // Load projects
        async function loadProyectos() {
            try {
                const response = await fetch('/api/proyectos', {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    const proyectos = await response.json();
                    displayProyectos(proyectos);
                }
            } catch (error) {
                console.error('Error loading projects:', error);
            }
        }

        // Load publications
        async function loadPublicaciones() {
            try {
                const response = await fetch('/api/publicaciones', {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    const publicaciones = await response.json();
                    displayPublicaciones(publicaciones);
                }
            } catch (error) {
                console.error('Error loading publications:', error);
            }
        }

        // Load social networks
        async function loadRedesSociales() {
            try {
                const response = await fetch('/api/redes-sociales', {
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    const redesSociales = await response.json();
                    displayRedesSociales(redesSociales);
                }
            } catch (error) {
                console.error('Error loading social networks:', error);
            }
        }

        function displayExperiencias(experiencias) {
            const container = document.getElementById('experienciasContainer');
            const list = document.getElementById('experienciasList');

            if (experiencias.length > 0) {
                container.classList.remove('hidden');
                list.innerHTML = experiencias.map(exp => createExperienciaCard(exp)).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function displayEducaciones(educaciones) {
            const container = document.getElementById('educacionesContainer');
            const list = document.getElementById('educacionesList');

            if (educaciones.length > 0) {
                container.classList.remove('hidden');
                list.innerHTML = educaciones.map(edu => createEducacionCard(edu)).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function displayCertificados(certificados) {
            const container = document.getElementById('certificadosContainer');
            const list = document.getElementById('certificadosList');

            if (certificados.length > 0) {
                container.classList.remove('hidden');
                list.innerHTML = certificados.map(cert => createCertificadoCard(cert)).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function displayHabilidades(habilidades) {
            const container = document.getElementById('habilidadesContainer');
            const list = document.getElementById('habilidadesList');

            if (habilidades.length > 0) {
                container.classList.remove('hidden');
                list.innerHTML = habilidades.map(hab => createHabilidadCard(hab)).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function displayIdiomas(idiomas) {
            const container = document.getElementById('idiomasContainer');
            const list = document.getElementById('idiomasList');

            if (idiomas.length > 0) {
                container.classList.remove('hidden');
                list.innerHTML = idiomas.map(idioma => createIdiomaCard(idioma)).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function displayProyectos(proyectos) {
            const container = document.getElementById('proyectosContainer');
            const list = document.getElementById('proyectosList');

            if (proyectos.length > 0) {
                container.classList.remove('hidden');
                list.innerHTML = proyectos.map(proy => createProyectoCard(proy)).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function displayPublicaciones(publicaciones) {
            const container = document.getElementById('publicacionesContainer');
            const list = document.getElementById('publicacionesList');

            if (publicaciones.length > 0) {
                container.classList.remove('hidden');
                list.innerHTML = publicaciones.map(pub => createPublicacionCard(pub)).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function displayRedesSociales(redesSociales) {
            const container = document.getElementById('redesSocialesContainer');
            const list = document.getElementById('redesSocialesList');

            if (redesSociales.length > 0) {
                container.classList.remove('hidden');
                list.innerHTML = redesSociales.map(red => createRedSocialCard(red)).join('');
            } else {
                container.classList.add('hidden');
            }
        }

        function createExperienciaCard(exp) {
            const fechaFin = exp.es_actual ? 'Presente' : (exp.fecha_fin || '');
            return `
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm experiencia-card" data-id="${exp.id}">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h4 class="text-lg font-semibold text-gray-900 editable" data-field="cargo">${exp.cargo}</h4>
                            <p class="text-green-600 font-medium editable" data-field="empresa">${exp.empresa}</p>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="editExperiencia(${exp.id})" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteExperiencia(${exp.id})" class="text-red-600 hover:text-red-800 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 mb-2">
                        <span class="editable" data-field="fecha_inicio">${exp.fecha_inicio}</span>
                        <span> - </span>
                        <span class="editable" data-field="fecha_fin">${fechaFin}</span>
                        ${exp.es_actual ? '<span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs bg-green-100 text-green-800">Actual</span>' : ''}
                    </div>
                    <p class="text-gray-700 editable" data-field="descripcion">${exp.descripcion}</p>
                </div>
            `;
        }

        function createEducacionCard(edu) {
            return `
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm educacion-card" data-id="${edu.id}">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h4 class="text-lg font-semibold text-gray-900 editable" data-field="titulo">${edu.titulo}</h4>
                            <p class="text-purple-600 font-medium editable" data-field="institucion">${edu.institucion}</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-purple-100 text-purple-800 font-medium editable" data-field="nivel">${edu.nivel}</span>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="editEducacion(${edu.id})" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteEducacion(${edu.id})" class="text-red-600 hover:text-red-800 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600">
                        <span class="editable" data-field="fecha_inicio">${edu.fecha_inicio}</span>
                        <span> - </span>
                        <span class="editable" data-field="fecha_fin">${edu.fecha_fin || 'Presente'}</span>
                    </div>
                </div>
            `;
        }

        function createCertificadoCard(cert) {
            return `
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm certificado-card" data-id="${cert.id}">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h4 class="text-lg font-semibold text-gray-900 editable" data-field="titulo">${cert.titulo}</h4>
                            <p class="text-yellow-600 font-medium editable" data-field="institucion">${cert.institucion}</p>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="editCertificado(${cert.id})" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteCertificado(${cert.id})" class="text-red-600 hover:text-red-800 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600">
                        <i class="fas fa-calendar mr-1"></i>
                        <span class="editable" data-field="fecha_emision">${cert.fecha_emision}</span>
                    </div>
                </div>
            `;
        }

        function createHabilidadCard(hab) {
            return `
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm habilidad-card" data-id="${hab.id}">
                    <div class="flex justify-between items-center">
                        <div class="flex-1">
                            <span class="text-lg font-semibold text-gray-900 editable" data-field="habilidad">${hab.habilidad}</span>
                            <span class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800 font-medium editable" data-field="nivel">${hab.nivel}</span>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="editHabilidad(${hab.id})" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteHabilidad(${hab.id})" class="text-red-600 hover:text-red-800 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }

        function createIdiomaCard(idioma) {
            return `
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm idioma-card" data-id="${idioma.id}">
                    <div class="flex justify-between items-center">
                        <div class="flex-1">
                            <span class="text-lg font-semibold text-gray-900 editable" data-field="idioma">${idioma.idioma}</span>
                            <span class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-100 text-green-800 font-medium editable" data-field="nivel">${idioma.nivel}</span>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="editIdioma(${idioma.id})" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteIdioma(${idioma.id})" class="text-red-600 hover:text-red-800 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }

        function createProyectoCard(proy) {
            const urlLink = proy.url ? `<a href="${proy.url}" target="_blank" class="text-orange-600 hover:text-orange-800 text-sm">
                                <i class="fas fa-external-link-alt mr-1"></i>Ver proyecto
                            </a>` : '';
            return `
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm proyecto-card" data-id="${proy.id}">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h4 class="text-lg font-semibold text-gray-900 editable" data-field="titulo">${proy.titulo}</h4>
                            ${urlLink}
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="editProyecto(${proy.id})" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteProyecto(${proy.id})" class="text-red-600 hover:text-red-800 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p class="text-gray-700 editable" data-field="descripcion">${proy.descripcion}</p>
                    <div class="mt-2">
                        <span class="editable hidden" data-field="url">${proy.url || ''}</span>
                    </div>
                </div>
            `;
        }

        function createPublicacionCard(pub) {
            const urlLink = pub.url ? `<a href="${pub.url}" target="_blank" class="text-pink-600 hover:text-pink-800 text-sm">
                                <i class="fas fa-external-link-alt mr-1"></i>Leer publicación
                            </a>` : '';
            return `
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm publicacion-card" data-id="${pub.id}">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h4 class="text-lg font-semibold text-gray-900 editable" data-field="titulo">${pub.titulo}</h4>
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-calendar mr-1"></i>
                                <span class="editable" data-field="fecha">${pub.fecha}</span>
                            </p>
                            ${urlLink}
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="editPublicacion(${pub.id})" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deletePublicacion(${pub.id})" class="text-red-600 hover:text-red-800 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p class="text-gray-700 editable" data-field="descripcion">${pub.descripcion}</p>
                    <div class="mt-2">
                        <span class="editable hidden" data-field="url">${pub.url || ''}</span>
                    </div>
                </div>
            `;
        }

        function createRedSocialCard(red) {
            return `
                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm red-social-card" data-id="${red.id}">
                    <div class="flex justify-between items-center">
                        <div class="flex-1 flex items-center">
                            <i class="fab fa-${red.plataforma.toLowerCase()} text-2xl mr-3 text-indigo-600"></i>
                            <div>
                                <span class="text-lg font-semibold text-gray-900 editable" data-field="plataforma">${red.plataforma}</span>
                                <a href="${red.url}" target="_blank" class="block text-indigo-600 hover:text-indigo-800 text-sm editable" data-field="url">${red.url}</a>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="editRedSocial(${red.id})" class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteRedSocial(${red.id})" class="text-red-600 hover:text-red-800 transition-colors">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
        }

        function editExperiencia(id) {
            const card = document.querySelector(`[data-id="${id}"]`);
            const editables = card.querySelectorAll('.editable');

            editables.forEach(element => {
                const field = element.dataset.field;
                const currentValue = element.textContent.trim();

                if (field === 'fecha_inicio' || field === 'fecha_fin') {
                    element.innerHTML = `<input type="date" class="border border-gray-300 rounded px-2 py-1 text-sm" value="${currentValue === 'Presente' ? '' : currentValue}">`;
                } else if (field === 'descripcion') {
                    element.innerHTML = `<textarea class="border border-gray-300 rounded px-2 py-1 text-sm w-full" rows="3">${currentValue}</textarea>`;
                } else {
                    element.innerHTML = `<input type="text" class="border border-gray-300 rounded px-2 py-1 text-sm w-full" value="${currentValue}">`;
                }
            });

            // Change edit button to save
            const editBtn = card.querySelector('.fa-edit').parentElement;
            editBtn.innerHTML = '<i class="fas fa-save"></i>';
            editBtn.onclick = () => saveExperiencia(id);
        }

        async function saveExperiencia(id) {
            const card = document.querySelector(`[data-id="${id}"]`);
            const inputs = card.querySelectorAll('input, textarea');
            const data = {};

            inputs.forEach(input => {
                const fieldElement = input.closest('.editable');
                const field = fieldElement.dataset.field;
                data[field] = input.value;
            });

            // Handle es_actual checkbox
            const esActualCheckbox = card.querySelector('input[type="checkbox"]');
            if (esActualCheckbox) {
                data.es_actual = esActualCheckbox.checked;
            }

            try {
                const response = await fetch(`/api/experiencias/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    showNotification('Experiencia actualizada correctamente', 'success');
                    loadExperiencias(); // Reload experiences
                } else {
                    showNotification('Error al actualizar la experiencia', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        async function deleteExperiencia(id) {
            if (!confirm('¿Estás seguro de que quieres eliminar esta experiencia?')) {
                return;
            }

            try {
                const response = await fetch(`/api/experiencias/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    showNotification('Experiencia eliminada correctamente', 'success');
                    loadExperiencias(); // Reload experiences
                } else {
                    showNotification('Error al eliminar la experiencia', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        // Education functions
        function editEducacion(id) {
            const card = document.querySelector(`.educacion-card[data-id="${id}"]`);
            const editables = card.querySelectorAll('.editable');
            editables.forEach(element => {
                const field = element.dataset.field;
                const currentValue = element.textContent.trim();
                if (field === 'fecha_inicio' || field === 'fecha_fin') {
                    element.innerHTML = `<input type="date" class="border border-gray-300 rounded px-2 py-1 text-sm" value="${currentValue === 'Presente' ? '' : currentValue}">`;
                } else if (field === 'nivel') {
                    const options = ['Bachillerato', 'Técnico', 'Tecnólogo', 'Pregrado', 'Especialización', 'Maestría', 'Doctorado', 'Postdoctorado'];
                    element.innerHTML = `<select class="border border-gray-300 rounded px-2 py-1 text-sm">${options.map(opt => `<option value="${opt}" ${opt === currentValue ? 'selected' : ''}>${opt}</option>`).join('')}</select>`;
                } else {
                    element.innerHTML = `<input type="text" class="border border-gray-300 rounded px-2 py-1 text-sm w-full" value="${currentValue}">`;
                }
            });
            const editBtn = card.querySelector('.fa-edit').parentElement;
            editBtn.innerHTML = '<i class="fas fa-save"></i>';
            editBtn.onclick = () => saveEducacion(id);
        }

        async function saveEducacion(id) {
            const card = document.querySelector(`.educacion-card[data-id="${id}"]`);
            const inputs = card.querySelectorAll('input, select');
            const data = {};
            inputs.forEach(input => {
                const fieldElement = input.closest('.editable');
                const field = fieldElement.dataset.field;
                data[field] = input.value;
            });
            try {
                const response = await fetch(`/api/educaciones/${id}`, {
                    method: 'PUT',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                if (response.ok) {
                    showNotification('Educación actualizada correctamente', 'success');
                    loadEducaciones();
                } else {
                    showNotification('Error al actualizar la educación', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        async function deleteEducacion(id) {
            if (!confirm('¿Estás seguro de que quieres eliminar esta educación?')) return;
            try {
                const response = await fetch(`/api/educaciones/${id}`, {
                    method: 'DELETE',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' }
                });
                if (response.ok) {
                    showNotification('Educación eliminada correctamente', 'success');
                    loadEducaciones();
                } else {
                    showNotification('Error al eliminar la educación', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        // Certifications functions
        function editCertificado(id) {
            const card = document.querySelector(`.certificado-card[data-id="${id}"]`);
            const editables = card.querySelectorAll('.editable');
            editables.forEach(element => {
                const field = element.dataset.field;
                const currentValue = element.textContent.trim();
                if (field === 'fecha_emision') {
                    element.innerHTML = `<input type="date" class="border border-gray-300 rounded px-2 py-1 text-sm" value="${currentValue}">`;
                } else {
                    element.innerHTML = `<input type="text" class="border border-gray-300 rounded px-2 py-1 text-sm w-full" value="${currentValue}">`;
                }
            });
            const editBtn = card.querySelector('.fa-edit').parentElement;
            editBtn.innerHTML = '<i class="fas fa-save"></i>';
            editBtn.onclick = () => saveCertificado(id);
        }

        async function saveCertificado(id) {
            const card = document.querySelector(`.certificado-card[data-id="${id}"]`);
            const inputs = card.querySelectorAll('input');
            const data = {};
            inputs.forEach(input => {
                const fieldElement = input.closest('.editable');
                const field = fieldElement.dataset.field;
                data[field] = input.value;
            });
            try {
                const response = await fetch(`/api/certificados/${id}`, {
                    method: 'PUT',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                if (response.ok) {
                    showNotification('Certificación actualizada correctamente', 'success');
                    loadCertificados();
                } else {
                    showNotification('Error al actualizar la certificación', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        async function deleteCertificado(id) {
            if (!confirm('¿Estás seguro de que quieres eliminar esta certificación?')) return;
            try {
                const response = await fetch(`/api/certificados/${id}`, {
                    method: 'DELETE',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' }
                });
                if (response.ok) {
                    showNotification('Certificación eliminada correctamente', 'success');
                    loadCertificados();
                } else {
                    showNotification('Error al eliminar la certificación', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        // Skills functions
        function editHabilidad(id) {
            const card = document.querySelector(`.habilidad-card[data-id="${id}"]`);
            const editables = card.querySelectorAll('.editable');
            editables.forEach(element => {
                const field = element.dataset.field;
                const currentValue = element.textContent.trim();
                if (field === 'nivel') {
                    const options = ['Básico', 'Intermedio', 'Avanzado', 'Experto'];
                    element.innerHTML = `<select class="border border-gray-300 rounded px-2 py-1 text-sm">${options.map(opt => `<option value="${opt}" ${opt === currentValue ? 'selected' : ''}>${opt}</option>`).join('')}</select>`;
                } else {
                    element.innerHTML = `<input type="text" class="border border-gray-300 rounded px-2 py-1 text-sm w-full" value="${currentValue}">`;
                }
            });
            const editBtn = card.querySelector('.fa-edit').parentElement;
            editBtn.innerHTML = '<i class="fas fa-save"></i>';
            editBtn.onclick = () => saveHabilidad(id);
        }

        async function saveHabilidad(id) {
            const card = document.querySelector(`.habilidad-card[data-id="${id}"]`);
            const inputs = card.querySelectorAll('input, select');
            const data = {};
            inputs.forEach(input => {
                const fieldElement = input.closest('.editable');
                const field = fieldElement.dataset.field;
                data[field] = input.value;
            });
            try {
                const response = await fetch(`/api/habilidades/${id}`, {
                    method: 'PUT',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                if (response.ok) {
                    showNotification('Habilidad actualizada correctamente', 'success');
                    loadHabilidades();
                } else {
                    showNotification('Error al actualizar la habilidad', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        async function deleteHabilidad(id) {
            if (!confirm('¿Estás seguro de que quieres eliminar esta habilidad?')) return;
            try {
                const response = await fetch(`/api/habilidades/${id}`, {
                    method: 'DELETE',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' }
                });
                if (response.ok) {
                    showNotification('Habilidad eliminada correctamente', 'success');
                    loadHabilidades();
                } else {
                    showNotification('Error al eliminar la habilidad', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        // Languages functions
        function editIdioma(id) {
            const card = document.querySelector(`.idioma-card[data-id="${id}"]`);
            const editables = card.querySelectorAll('.editable');
            editables.forEach(element => {
                const field = element.dataset.field;
                const currentValue = element.textContent.trim();
                if (field === 'nivel') {
                    const options = ['Básico', 'Conversacional', 'Intermedio', 'Avanzado', 'Nativo'];
                    element.innerHTML = `<select class="border border-gray-300 rounded px-2 py-1 text-sm">${options.map(opt => `<option value="${opt}" ${opt === currentValue ? 'selected' : ''}>${opt}</option>`).join('')}</select>`;
                } else {
                    element.innerHTML = `<input type="text" class="border border-gray-300 rounded px-2 py-1 text-sm w-full" value="${currentValue}">`;
                }
            });
            const editBtn = card.querySelector('.fa-edit').parentElement;
            editBtn.innerHTML = '<i class="fas fa-save"></i>';
            editBtn.onclick = () => saveIdioma(id);
        }

        async function saveIdioma(id) {
            const card = document.querySelector(`.idioma-card[data-id="${id}"]`);
            const inputs = card.querySelectorAll('input, select');
            const data = {};
            inputs.forEach(input => {
                const fieldElement = input.closest('.editable');
                const field = fieldElement.dataset.field;
                data[field] = input.value;
            });
            try {
                const response = await fetch(`/api/idiomas/${id}`, {
                    method: 'PUT',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                if (response.ok) {
                    showNotification('Idioma actualizado correctamente', 'success');
                    loadIdiomas();
                } else {
                    showNotification('Error al actualizar el idioma', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        async function deleteIdioma(id) {
            if (!confirm('¿Estás seguro de que quieres eliminar este idioma?')) return;
            try {
                const response = await fetch(`/api/idiomas/${id}`, {
                    method: 'DELETE',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' }
                });
                if (response.ok) {
                    showNotification('Idioma eliminado correctamente', 'success');
                    loadIdiomas();
                } else {
                    showNotification('Error al eliminar el idioma', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        // Projects functions
        function editProyecto(id) {
            const card = document.querySelector(`.proyecto-card[data-id="${id}"]`);
            const editables = card.querySelectorAll('.editable');
            editables.forEach(element => {
                const field = element.dataset.field;
                const currentValue = element.textContent.trim();
                if (field === 'descripcion') {
                    element.innerHTML = `<textarea class="border border-gray-300 rounded px-2 py-1 text-sm w-full" rows="3">${currentValue}</textarea>`;
                } else if (field === 'url') {
                    element.innerHTML = `<input type="url" class="border border-gray-300 rounded px-2 py-1 text-sm w-full" value="${currentValue}">`;
                } else {
                    element.innerHTML = `<input type="text" class="border border-gray-300 rounded px-2 py-1 text-sm w-full" value="${currentValue}">`;
                }
            });
            const editBtn = card.querySelector('.fa-edit').parentElement;
            editBtn.innerHTML = '<i class="fas fa-save"></i>';
            editBtn.onclick = () => saveProyecto(id);
        }

        async function saveProyecto(id) {
            const card = document.querySelector(`.proyecto-card[data-id="${id}"]`);
            const inputs = card.querySelectorAll('input, textarea');
            const data = {};
            inputs.forEach(input => {
                const fieldElement = input.closest('.editable');
                const field = fieldElement.dataset.field;
                data[field] = input.value;
            });
            try {
                const response = await fetch(`/api/proyectos/${id}`, {
                    method: 'PUT',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                if (response.ok) {
                    showNotification('Proyecto actualizado correctamente', 'success');
                    loadProyectos();
                } else {
                    showNotification('Error al actualizar el proyecto', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        async function deleteProyecto(id) {
            if (!confirm('¿Estás seguro de que quieres eliminar este proyecto?')) return;
            try {
                const response = await fetch(`/api/proyectos/${id}`, {
                    method: 'DELETE',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' }
                });
                if (response.ok) {
                    showNotification('Proyecto eliminado correctamente', 'success');
                    loadProyectos();
                } else {
                    showNotification('Error al eliminar el proyecto', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        // Publications functions
        function editPublicacion(id) {
            const card = document.querySelector(`.publicacion-card[data-id="${id}"]`);
            const editables = card.querySelectorAll('.editable');
            editables.forEach(element => {
                const field = element.dataset.field;
                const currentValue = element.textContent.trim();
                if (field === 'fecha') {
                    element.innerHTML = `<input type="date" class="border border-gray-300 rounded px-2 py-1 text-sm" value="${currentValue}">`;
                } else if (field === 'descripcion') {
                    element.innerHTML = `<textarea class="border border-gray-300 rounded px-2 py-1 text-sm w-full" rows="3">${currentValue}</textarea>`;
                } else if (field === 'url') {
                    element.innerHTML = `<input type="url" class="border border-gray-300 rounded px-2 py-1 text-sm w-full" value="${currentValue}">`;
                } else {
                    element.innerHTML = `<input type="text" class="border border-gray-300 rounded px-2 py-1 text-sm w-full" value="${currentValue}">`;
                }
            });
            const editBtn = card.querySelector('.fa-edit').parentElement;
            editBtn.innerHTML = '<i class="fas fa-save"></i>';
            editBtn.onclick = () => savePublicacion(id);
        }

        async function savePublicacion(id) {
            const card = document.querySelector(`.publicacion-card[data-id="${id}"]`);
            const inputs = card.querySelectorAll('input, textarea');
            const data = {};
            inputs.forEach(input => {
                const fieldElement = input.closest('.editable');
                const field = fieldElement.dataset.field;
                data[field] = input.value;
            });
            try {
                const response = await fetch(`/api/publicaciones/${id}`, {
                    method: 'PUT',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                if (response.ok) {
                    showNotification('Publicación actualizada correctamente', 'success');
                    loadPublicaciones();
                } else {
                    showNotification('Error al actualizar la publicación', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        async function deletePublicacion(id) {
            if (!confirm('¿Estás seguro de que quieres eliminar esta publicación?')) return;
            try {
                const response = await fetch(`/api/publicaciones/${id}`, {
                    method: 'DELETE',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' }
                });
                if (response.ok) {
                    showNotification('Publicación eliminada correctamente', 'success');
                    loadPublicaciones();
                } else {
                    showNotification('Error al eliminar la publicación', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        // Social Networks functions
        function editRedSocial(id) {
            const card = document.querySelector(`.red-social-card[data-id="${id}"]`);
            const editables = card.querySelectorAll('.editable');
            editables.forEach(element => {
                const field = element.dataset.field;
                const currentValue = element.textContent.trim();
                if (field === 'plataforma') {
                    const options = ['LinkedIn', 'GitHub', 'Twitter', 'Facebook', 'Instagram', 'YouTube', 'Medium', 'Website', 'Otro'];
                    element.innerHTML = `<select class="border border-gray-300 rounded px-2 py-1 text-sm">${options.map(opt => `<option value="${opt}" ${opt === currentValue ? 'selected' : ''}>${opt}</option>`).join('')}</select>`;
                } else if (field === 'url') {
                    element.innerHTML = `<input type="url" class="border border-gray-300 rounded px-2 py-1 text-sm w-full" value="${currentValue}">`;
                } else {
                    element.innerHTML = `<input type="text" class="border border-gray-300 rounded px-2 py-1 text-sm w-full" value="${currentValue}">`;
                }
            });
            const editBtn = card.querySelector('.fa-edit').parentElement;
            editBtn.innerHTML = '<i class="fas fa-save"></i>';
            editBtn.onclick = () => saveRedSocial(id);
        }

        async function saveRedSocial(id) {
            const card = document.querySelector(`.red-social-card[data-id="${id}"]`);
            const inputs = card.querySelectorAll('input, select');
            const data = {};
            inputs.forEach(input => {
                const fieldElement = input.closest('.editable');
                const field = fieldElement.dataset.field;
                data[field] = input.value;
            });
            try {
                const response = await fetch(`/api/redes-sociales/${id}`, {
                    method: 'PUT',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                if (response.ok) {
                    showNotification('Red social actualizada correctamente', 'success');
                    loadRedesSociales();
                } else {
                    showNotification('Error al actualizar la red social', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        async function deleteRedSocial(id) {
            if (!confirm('¿Estás seguro de que quieres eliminar esta red social?')) return;
            try {
                const response = await fetch(`/api/redes-sociales/${id}`, {
                    method: 'DELETE',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' }
                });
                if (response.ok) {
                    showNotification('Red social eliminada correctamente', 'success');
                    loadRedesSociales();
                } else {
                    showNotification('Error al eliminar la red social', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        // Form submissions
        document.getElementById('perfilForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch('/api/perfiles', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    showNotification('Perfil guardado correctamente', 'success');
                    loadUser();
                } else {
                    showNotification('Error al guardar el perfil', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        });

        document.getElementById('experienciaForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData);
            data.es_actual = formData.get('es_actual') === 'on';

            try {
                const response = await fetch('/api/experiencias', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    showNotification('Experiencia guardada correctamente', 'success');
                    e.target.reset();
                    loadExperiencias(); // Reload experiences list
                } else {
                    showNotification('Error al guardar la experiencia', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        });

        // Education form
        document.getElementById('educacionForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch('/api/educaciones', {
                    method: 'POST',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    showNotification('Educación guardada correctamente', 'success');
                    e.target.reset();
                    loadEducaciones();
                } else {
                    showNotification('Error al guardar la educación', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        });

        // Certifications form
        document.getElementById('certificadoForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch('/api/certificados', {
                    method: 'POST',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    showNotification('Certificación guardada correctamente', 'success');
                    e.target.reset();
                    loadCertificados();
                } else {
                    showNotification('Error al guardar la certificación', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        });

        // Skills form
        document.getElementById('habilidadForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch('/api/habilidades', {
                    method: 'POST',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    showNotification('Habilidad guardada correctamente', 'success');
                    e.target.reset();
                    loadHabilidades();
                } else {
                    showNotification('Error al guardar la habilidad', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        });

        // Languages form
        document.getElementById('idiomaForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch('/api/idiomas', {
                    method: 'POST',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    showNotification('Idioma guardado correctamente', 'success');
                    e.target.reset();
                    loadIdiomas();
                } else {
                    showNotification('Error al guardar el idioma', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        });

        // Projects form
        document.getElementById('proyectoForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch('/api/proyectos', {
                    method: 'POST',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    showNotification('Proyecto guardado correctamente', 'success');
                    e.target.reset();
                    loadProyectos();
                } else {
                    showNotification('Error al guardar el proyecto', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        });

        // Publications form
        document.getElementById('publicacionForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch('/api/publicaciones', {
                    method: 'POST',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    showNotification('Publicación guardada correctamente', 'success');
                    e.target.reset();
                    loadPublicaciones();
                } else {
                    showNotification('Error al guardar la publicación', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        });

        // Social Networks form
        document.getElementById('redSocialForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData);

            try {
                const response = await fetch('/api/redes-sociales', {
                    method: 'POST',
                    headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    showNotification('Red social guardada correctamente', 'success');
                    e.target.reset();
                    loadRedesSociales();
                } else {
                    showNotification('Error al guardar la red social', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        });

        // Generate QR function
        async function generateQr() {
            try {
                const response = await fetch('/api/usuarios/regenerate-qr', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    showNotification('Código QR generado correctamente', 'success');
                    loadUser();
                } else {
                    showNotification('Error al generar el QR', 'error');
                }
            } catch (error) {
                showNotification('Error de conexión', 'error');
            }
        }

        // Notification function
        function showNotification(message, type = 'info') {
            const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas ${type === 'success' ? 'fa-check' : type === 'error' ? 'fa-exclamation' : 'fa-info'}-circle mr-2"></i>
                    ${message}
                </div>
            `;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Load user data when page loads
        loadUser();
        getFormData();
    </script>
</body>

</html>

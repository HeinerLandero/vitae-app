<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CV de {{ $usuario->nombre }} {{ $usuario->apellido }} - Curriculum Vitae Profesional">
    <title>{{ $usuario->nombre }} {{ $usuario->apellido }} - Curriculum Vitae</title>
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
    <style>
        .section-divider {
            background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
            height: 1px;
            margin: 2rem 0;
        }
        .skill-badge {
            transition: all 0.3s ease;
        }
        .skill-badge:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen">
    <!-- PDF Download Button -->
    <button id="downloadPdfBtn" class="fixed top-4 right-4 z-50 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-700 transition-all duration-300 flex items-center space-x-2">
        <i class="fas fa-download"></i>
        <span class="hidden sm:inline">Descargar PDF</span>
    </button>

    <div class="max-w-5xl mx-auto bg-white shadow-2xl">
        <!-- Header Hero Section -->
        <div class="bg-slate-800 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
            <div class="relative p-8 md:p-12">
                <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                    <!-- Profile Photo Placeholder -->
                    <div class="flex-shrink-0">
                        <div class="w-32 h-32 md:w-40 md:h-40 bg-white bg-opacity-20 rounded-full flex items-center justify-center border-4 border-white border-opacity-30">
                            <i class="fas fa-user text-4xl md:text-5xl text-white"></i>
                        </div>
                    </div>

                    <!-- Name and Title -->
                    <div class="text-center md:text-left flex-1">
                        <h1 class="text-4xl md:text-5xl font-bold mb-2">{{ $usuario->nombre }} {{ $usuario->apellido }}</h1>
                        @if($usuario->perfil && $usuario->perfil->cargo)
                            <p class="text-xl md:text-2xl text-blue-100 mb-4">{{ $usuario->perfil->cargo }}</p>
                        @endif

                        <!-- Contact Info -->
                        <div class="flex flex-wrap justify-center md:justify-start gap-4 text-sm">
                            @if($usuario->perfil)
                                <div class="flex items-center">
                                    <i class="fas fa-phone mr-2"></i>
                                    {{ $usuario->perfil->telefono }}
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-envelope mr-2"></i>
                                    {{ $usuario->email }}
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    {{ $usuario->perfil->ciudad }}, {{ $usuario->perfil->pais }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 md:p-8 space-y-8">
            <!-- Professional Profile -->
            @if($usuario->perfil && $usuario->perfil->descripcion)
            <section class="bg-slate-50 rounded-2xl p-6 border border-slate-200">
                <div class="flex items-center mb-6">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-user-tie text-blue-600 text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Perfil Profesional</h2>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm">
                    <p class="text-gray-700 leading-relaxed text-lg">{{ $usuario->perfil->descripcion }}</p>
                </div>
            </section>
            @endif

            <!-- Work Experience -->
            @if($usuario->experiencias->count() > 0)
            <section>
                <div class="flex items-center mb-6">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-briefcase text-blue-600 text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Experiencia Laboral</h2>
                </div>
                <div class="space-y-6">
                    @foreach($usuario->experiencias->sortByDesc('fecha_inicio') as $exp)
                    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $exp->cargo }}</h3>
                                <p class="text-lg text-blue-600 font-semibold mb-2">{{ $exp->empresa }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500 mb-1">
                                    <i class="fas fa-calendar mr-1"></i>
                                    {{ \Carbon\Carbon::parse($exp->fecha_inicio)->format('M Y') }} -
                                    @if($exp->es_actual)
                                        <span class="text-blue-600 font-semibold">Presente</span>
                                    @else
                                        {{ \Carbon\Carbon::parse($exp->fecha_fin)->format('M Y') }}
                                    @endif
                                </p>
                                @if($exp->es_actual)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-800 font-medium">
                                        <i class="fas fa-circle text-blue-500 mr-1"></i>
                                        Trabajo Actual
                                    </span>
                                @endif
                            </div>
                        </div>
                        <p class="text-gray-700 leading-relaxed">{{ $exp->descripcion }}</p>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- Education -->
            @if($usuario->educaciones->count() > 0)
            <section>
                <div class="flex items-center mb-6">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-graduation-cap text-blue-600 text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Educación</h2>
                </div>
                <div class="space-y-4">
                    @foreach($usuario->educaciones->sortByDesc('fecha_inicio') as $edu)
                    <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $edu->titulo }}</h3>
                                <p class="text-lg text-blue-600 font-semibold mb-2">{{ $edu->institucion }}</p>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800 font-medium">
                                    {{ $edu->nivel }}
                                </span>
                            </div>
                            <div class="text-right mt-4 md:mt-0">
                                <p class="text-sm text-gray-500">
                                    <i class="fas fa-calendar mr-1"></i>
                                    {{ \Carbon\Carbon::parse($edu->fecha_inicio)->format('M Y') }} -
                                    {{ \Carbon\Carbon::parse($edu->fecha_fin)->format('M Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            <!-- Complementary Training -->
            @if($usuario->proyectos->count() > 0 || $usuario->publicaciones->count() > 0)
            <section>
                <div class="flex items-center mb-6">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-graduation-cap text-blue-600 text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Formación Complementaria</h2>
                </div>
                <div class="space-y-6">
                    <!-- Projects -->
                    @if($usuario->proyectos->count() > 0)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-project-diagram text-blue-500 mr-2"></i>
                            Proyectos
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($usuario->proyectos as $proyecto)
                            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md hover:shadow-lg transition-shadow duration-300">
                                <h4 class="text-lg font-bold text-gray-900 mb-2">{{ $proyecto->titulo }}</h4>
                                <p class="text-gray-700 mb-3 leading-relaxed text-sm">{{ $proyecto->descripcion }}</p>
                                @if($proyecto->url)
                                <a href="{{ $proyecto->url }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm">
                                    <i class="fas fa-external-link-alt mr-1"></i>
                                    Ver Proyecto
                                </a>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Publications -->
                    @if($usuario->publicaciones->count() > 0)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-book text-blue-500 mr-2"></i>
                            Publicaciones
                        </h3>
                        <div class="space-y-3">
                            @foreach($usuario->publicaciones->sortByDesc('fecha') as $pub)
                            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-md hover:shadow-lg transition-shadow duration-300">
                                <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                                    <div class="flex-1">
                                        <h4 class="text-lg font-bold text-gray-900 mb-1">{{ $pub->titulo }}</h4>
                                        <p class="text-gray-700 leading-relaxed text-sm">{{ $pub->descripcion }}</p>
                                    </div>
                                    <div class="text-right mt-3 md:mt-0 md:ml-4">
                                        <p class="text-xs text-gray-500 mb-1">
                                            <i class="fas fa-calendar mr-1"></i>
                                            {{ \Carbon\Carbon::parse($pub->fecha)->format('M Y') }}
                                        </p>
                                        @if($pub->url)
                                        <a href="{{ $pub->url }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm">
                                            <i class="fas fa-external-link-alt mr-1"></i>
                                            Leer más
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </section>
            @endif

            <!-- Skills -->
            @if($usuario->habilidades->count() > 0)
            <section>
                <div class="flex items-center mb-6">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-tools text-blue-600 text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Habilidades</h2>
                </div>
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-lg">
                    <div class="flex flex-wrap gap-3">
                        @foreach($usuario->habilidades as $hab)
                        <span class="skill-badge bg-blue-600 text-white px-4 py-2 rounded-full font-medium text-sm shadow-md">
                            {{ $hab->habilidad }}
                            <span class="ml-2 text-xs bg-white bg-opacity-20 px-2 py-1 rounded-full">
                                {{ $hab->nivel }}
                            </span>
                        </span>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

            <!-- Languages -->
            @if($usuario->idiomas->count() > 0)
            <section>
                <div class="flex items-center mb-6">
                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-language text-blue-600 text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Idiomas</h2>
                </div>
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-lg">
                    <div class="space-y-4">
                        @foreach($usuario->idiomas as $idioma)
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-gray-900">{{ $idioma->idioma }}</span>
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $idioma->nivel }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @endif

            <!-- Social Networks -->
            @if($usuario->redesSociales->count() > 0)
            <section class="bg-slate-50 rounded-2xl p-6 border border-slate-200">
                <div class="flex items-center justify-center mb-6">
                    <div class="bg-gray-200 p-3 rounded-lg mr-4">
                        <i class="fas fa-share-alt text-gray-600 text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Redes Sociales</h2>
                </div>
                <div class="flex flex-wrap justify-center gap-4">
                    @foreach($usuario->redesSociales as $red)
                    <a href="{{ $red->url }}" target="_blank" class="bg-white border border-gray-200 rounded-lg p-4 shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center">
                            <i class="fab fa-{{ strtolower($red->plataforma) }} text-2xl mr-3 text-blue-600"></i>
                            <span class="font-medium text-gray-900">{{ $red->plataforma }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </section>
            @endif


        </div>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white text-center py-6">
            <p class="text-gray-400">
                Curriculum Vitae generado por Vitae App
                <span class="mx-2">•</span>
                {{ now()->format('Y') }}
            </p>
        </footer>
    </div>

    <script>
        document.getElementById('downloadPdfBtn').addEventListener('click', function() {
            // Redirect to the PDF download route
            window.location.href = '/cv/{{ $usuario->slug }}/pdf';
        });
    </script>
</body>
</html>

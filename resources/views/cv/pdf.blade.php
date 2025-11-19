<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV {{ $usuario->nombre }} {{ $usuario->apellido }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #000000;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20pt;
            border-bottom: 1pt solid #000000;
            padding-bottom: 10pt;
        }

        .name {
            font-size: 18pt;
            font-weight: bold;
            margin-bottom: 8pt;
        }

        .contact-info {
            font-size: 10pt;
            color: #333333;
            margin-bottom: 15pt;
        }

        .section {
            margin-bottom: 15pt;
        }

        .section-title {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 8pt;
            text-transform: uppercase;
            letter-spacing: 1pt;
            border-bottom: 0.5pt solid #000000;
            padding-bottom: 3pt;
        }

        .experience-item {
            margin-bottom: 12pt;
        }

        .job-title {
            font-weight: bold;
            font-size: 11pt;
        }

        .company {
            font-weight: bold;
            color: #333333;
            margin-bottom: 3pt;
        }

        .date {
            font-size: 10pt;
            color: #666666;
            margin-bottom: 5pt;
        }

        .description {
            margin-left: 15pt;
            margin-bottom: 5pt;
        }

        .achievements {
            margin-left: 20pt;
        }

        .achievement-item {
            margin-bottom: 2pt;
        }

        .education-item {
            margin-bottom: 8pt;
        }

        .education-title {
            font-weight: bold;
        }

        .education-institution {
            font-weight: bold;
            color: #333333;
        }

        .education-date {
            font-size: 10pt;
            color: #666666;
        }

        .skills-section {
            margin-bottom: 10pt;
        }

        .skills-title {
            font-weight: bold;
            margin-bottom: 3pt;
        }

        .skills-list {
            line-height: 1.6;
        }

        .language-item {
            margin-bottom: 3pt;
        }

        .bullet {
            margin-right: 5pt;
        }

        .complementary-item {
            margin-bottom: 4pt;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="name">{{ $usuario->nombre }} {{ $usuario->apellido }}</div>
        <div class="contact-info">
            {{ $usuario->perfil->ciudad ?? 'Ciudad' }}, {{ $usuario->perfil->pais ?? 'País' }} |
            {{ $usuario->perfil->telefono ?? 'Teléfono' }} |
            {{ $usuario->email }}
            @if($usuario->redesSociales->where('plataforma', 'LinkedIn')->first())
                | LinkedIn
            @endif
        </div>
    </div>

    <!-- Professional Profile -->
    @if($usuario->perfil && $usuario->perfil->descripcion)
    <div class="section">
        <div class="section-title">Perfil Profesional</div>
        <div>{{ $usuario->perfil->descripcion }}</div>
    </div>
    @endif

    <!-- Work Experience -->
    @if($usuario->experiencias->count() > 0)
    <div class="section">
        <div class="section-title">Experiencia Profesional</div>
        @foreach($usuario->experiencias->sortByDesc('fecha_inicio') as $exp)
        <div class="experience-item">
            <div class="job-title">{{ $exp->cargo }}</div>
            <div class="company">{{ $exp->empresa }}</div>
            <div class="date">
                {{ \Carbon\Carbon::parse($exp->fecha_inicio)->format('F Y') }} –
                @if($exp->es_actual)
                    Actualidad
                @else
                    {{ \Carbon\Carbon::parse($exp->fecha_fin)->format('F Y') }}
                @endif
            </div>
            @if($exp->descripcion)
            <div class="description">{{ $exp->descripcion }}</div>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    <!-- Education -->
    @if($usuario->educaciones->count() > 0)
    <div class="section">
        <div class="section-title">Educación</div>
        @foreach($usuario->educaciones->sortByDesc('fecha_inicio') as $edu)
        <div class="education-item">
            <div class="education-title">{{ $edu->titulo }}</div>
            <div class="education-institution">{{ $edu->institucion }}</div>
            <div class="education-date">
                {{ \Carbon\Carbon::parse($edu->fecha_inicio)->format('F Y') }} –
                {{ \Carbon\Carbon::parse($edu->fecha_fin)->format('F Y') }}
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Complementary Training -->
    @if($usuario->certificados->count() > 0 || $usuario->proyectos->count() > 0 || $usuario->publicaciones->count() > 0)
    <div class="section">
        <div class="section-title">Formación Complementaria</div>

        <!-- Certifications -->
        @if($usuario->certificados->count() > 0)
        @foreach($usuario->certificados as $cert)
        <div class="complementary-item">
            <span class="bullet">•</span>{{ $cert->nombre }} – {{ $cert->entidad }} ({{ \Carbon\Carbon::parse($cert->fecha_expedicion)->format('Y') }})
        </div>
        @endforeach
        @endif

        <!-- Projects -->
        @if($usuario->proyectos->count() > 0)
        @foreach($usuario->proyectos as $proy)
        <div class="complementary-item">
            <span class="bullet">•</span>Proyecto: {{ $proy->titulo }}
        </div>
        @endforeach
        @endif

        <!-- Publications -->
        @if($usuario->publicaciones->count() > 0)
        @foreach($usuario->publicaciones as $pub)
        <div class="complementary-item">
            <span class="bullet">•</span>Publicación: {{ $pub->titulo }} ({{ \Carbon\Carbon::parse($pub->fecha)->format('Y') }})
        </div>
        @endforeach
        @endif
    </div>
    @endif

    <!-- Skills -->
    @if($usuario->habilidades->count() > 0)
    <div class="section">
        <div class="section-title">Habilidades</div>

        <!-- Hard Skills -->
        <div class="skills-section">
            <div class="skills-title">Hard Skills:</div>
            <div class="skills-list">
                @php
                    $hardSkills = $usuario->habilidades->whereIn('nivel', ['Avanzado', 'Experto', 'Intermedio']);
                @endphp
                @if($hardSkills->count() > 0)
                    {{ $hardSkills->pluck('habilidad')->join(' · ') }}
                @endif
            </div>
        </div>

        <!-- Soft Skills -->
        <div class="skills-section">
            <div class="skills-title">Soft Skills:</div>
            <div class="skills-list">
                @php
                    $softSkills = $usuario->habilidades->whereIn('nivel', ['Básico', 'Conversacional']);
                @endphp
                @if($softSkills->count() > 0)
                    {{ $softSkills->pluck('habilidad')->join(' · ') }}
                @else
                    Proactividad · Responsabilidad · Trabajo en equipo · Comunicación efectiva · Autodidacta
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- Languages -->
    @if($usuario->idiomas->count() > 0)
    <div class="section">
        <div class="section-title">Idiomas</div>
        @foreach($usuario->idiomas as $idioma)
        <div class="language-item">
            {{ $idioma->idioma }}: {{ $idioma->nivel }}
        </div>
        @endforeach
    </div>
    @endif
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV <?php echo e($usuario->nombre); ?> <?php echo e($usuario->apellido); ?></title>
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
        <div class="name"><?php echo e($usuario->nombre); ?> <?php echo e($usuario->apellido); ?></div>
        <div class="contact-info">
            <?php echo e($usuario->perfil->ciudad ?? 'Ciudad'); ?>, <?php echo e($usuario->perfil->pais ?? 'País'); ?> |
            <?php echo e($usuario->perfil->telefono ?? 'Teléfono'); ?> |
            <?php echo e($usuario->email); ?>

            <?php if($usuario->redesSociales->where('plataforma', 'LinkedIn')->first()): ?>
                | LinkedIn
            <?php endif; ?>
        </div>
    </div>

    <!-- Professional Profile -->
    <?php if($usuario->perfil && $usuario->perfil->descripcion): ?>
    <div class="section">
        <div class="section-title">Perfil Profesional</div>
        <div><?php echo e($usuario->perfil->descripcion); ?></div>
    </div>
    <?php endif; ?>

    <!-- Work Experience -->
    <?php if($usuario->experiencias->count() > 0): ?>
    <div class="section">
        <div class="section-title">Experiencia Profesional</div>
        <?php $__currentLoopData = $usuario->experiencias->sortByDesc('fecha_inicio'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="experience-item">
            <div class="job-title"><?php echo e($exp->cargo); ?></div>
            <div class="company"><?php echo e($exp->empresa); ?></div>
            <div class="date">
                <?php echo e(\Carbon\Carbon::parse($exp->fecha_inicio)->format('F Y')); ?> –
                <?php if($exp->es_actual): ?>
                    Actualidad
                <?php else: ?>
                    <?php echo e(\Carbon\Carbon::parse($exp->fecha_fin)->format('F Y')); ?>

                <?php endif; ?>
            </div>
            <?php if($exp->descripcion): ?>
            <div class="description"><?php echo e($exp->descripcion); ?></div>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

    <!-- Education -->
    <?php if($usuario->educaciones->count() > 0): ?>
    <div class="section">
        <div class="section-title">Educación</div>
        <?php $__currentLoopData = $usuario->educaciones->sortByDesc('fecha_inicio'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="education-item">
            <div class="education-title"><?php echo e($edu->titulo); ?></div>
            <div class="education-institution"><?php echo e($edu->institucion); ?></div>
            <div class="education-date">
                <?php echo e(\Carbon\Carbon::parse($edu->fecha_inicio)->format('F Y')); ?> –
                <?php echo e(\Carbon\Carbon::parse($edu->fecha_fin)->format('F Y')); ?>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

    <!-- Complementary Training -->
    <?php if($usuario->certificados->count() > 0 || $usuario->proyectos->count() > 0 || $usuario->publicaciones->count() > 0): ?>
    <div class="section">
        <div class="section-title">Formación Complementaria</div>

        <!-- Certifications -->
        <?php if($usuario->certificados->count() > 0): ?>
        <?php $__currentLoopData = $usuario->certificados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="complementary-item">
            <span class="bullet">•</span><?php echo e($cert->nombre); ?> – <?php echo e($cert->entidad); ?> (<?php echo e(\Carbon\Carbon::parse($cert->fecha_expedicion)->format('Y')); ?>)
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <!-- Projects -->
        <?php if($usuario->proyectos->count() > 0): ?>
        <?php $__currentLoopData = $usuario->proyectos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="complementary-item">
            <span class="bullet">•</span>Proyecto: <?php echo e($proy->titulo); ?>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <!-- Publications -->
        <?php if($usuario->publicaciones->count() > 0): ?>
        <?php $__currentLoopData = $usuario->publicaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="complementary-item">
            <span class="bullet">•</span>Publicación: <?php echo e($pub->titulo); ?> (<?php echo e(\Carbon\Carbon::parse($pub->fecha)->format('Y')); ?>)
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Skills -->
    <?php if($usuario->habilidades->count() > 0): ?>
    <div class="section">
        <div class="section-title">Habilidades</div>

        <!-- Hard Skills -->
        <div class="skills-section">
            <div class="skills-title">Hard Skills:</div>
            <div class="skills-list">
                <?php
                    $hardSkills = $usuario->habilidades->whereIn('nivel', ['Avanzado', 'Experto', 'Intermedio']);
                ?>
                <?php if($hardSkills->count() > 0): ?>
                    <?php echo e($hardSkills->pluck('habilidad')->join(' · ')); ?>

                <?php endif; ?>
            </div>
        </div>

        <!-- Soft Skills -->
        <div class="skills-section">
            <div class="skills-title">Soft Skills:</div>
            <div class="skills-list">
                <?php
                    $softSkills = $usuario->habilidades->whereIn('nivel', ['Básico', 'Conversacional']);
                ?>
                <?php if($softSkills->count() > 0): ?>
                    <?php echo e($softSkills->pluck('habilidad')->join(' · ')); ?>

                <?php else: ?>
                    Proactividad · Responsabilidad · Trabajo en equipo · Comunicación efectiva · Autodidacta
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Languages -->
    <?php if($usuario->idiomas->count() > 0): ?>
    <div class="section">
        <div class="section-title">Idiomas</div>
        <?php $__currentLoopData = $usuario->idiomas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idioma): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="language-item">
            <?php echo e($idioma->idioma); ?>: <?php echo e($idioma->nivel); ?>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
</body>
</html>
<?php /**PATH C:\Users\USER\Documents\GitHub\vitae-app\resources\views/cv/pdf.blade.php ENDPATH**/ ?>
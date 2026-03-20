<?php

use App\Http\Controllers\ExperiencesController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\VerificationController;
use App\Models\Certificado;
use App\Models\Usuario;
use App\Models\Perfil;
use App\Models\Experiencia;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;



Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

// Public CV view
Route::get('/cv/{slug}', function ($slug) {
    $usuario = Usuario::where('slug', $slug)->firstOrFail();
    return view('cv.public', compact('usuario'));
});

// Email verification route
Route::get('/email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');

// PDF CV download route
Route::get('/cv/{slug}/pdf', function ($slug) {
    $usuario = Usuario::where('slug', $slug)->firstOrFail();

    $pdf = Pdf::loadView('cv.pdf', compact('usuario'))
        ->setPaper('a4', 'portrait')
        ->setOptions(['defaultFont' => 'sans-serif']);

    return $pdf->download('CV_' . $usuario->nombre . '_' . $usuario->apellido . '-Fullstack.pdf');
})->name('cv.pdf');

// API routes - order matters, put specific routes first
Route::prefix('api')->group(function () {
    Route::post('usuarios', [UsuarioController::class, 'store']); // Public registration
    Route::post('login', [UsuarioController::class, 'login']);
    Route::post('logout', [UsuarioController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('refresh-token', [UsuarioController::class, 'refreshToken'])->middleware('auth:sanctum');
    Route::post('usuarios/regenerate-qr', [UsuarioController::class, 'regenerateQr'])->middleware('auth:sanctum');
    Route::get('usuarios/me', [UsuarioController::class, 'me'])->middleware('auth:sanctum');
    Route::put('usuarios/me', [UsuarioController::class, 'updateMe'])->middleware('auth:sanctum');
    Route::resource('usuarios', UsuarioController::class)->middleware('auth:sanctum')->except(['store']);

    // Simple profile routes using closures
    // Profiles start
    Route::post('perfiles', [ProfilesController::class, 'newUser'])->middleware('auth:sanctum');
    Route::get('perfiles', [ProfilesController::class, 'show'])->middleware('auth:sanctum');
    Route::get('perfiles/{usuario}', [ProfilesController::class, 'getCurrentUser'] )->middleware('auth:sanctum');
    // Profiles end

    // Simple experience routes using closures
    // Experiences start
    Route::get('experiencias', [ExperiencesController::class, 'store'])->middleware('auth:sanctum');
    Route::post('experiencias', [ExperiencesController::class, 'create'] )->middleware('auth:sanctum');
    // Experiences end


    Route::put('experiencias/{experiencia}', function(Request $request, Experiencia $experiencia) {
        $user = $request->user();
        if ($experiencia->usuario_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $experiencia->update($request->all());
        return response()->json($experiencia);
    })->middleware('auth:sanctum');

    Route::delete('experiencias/{experiencia}', function(Request $request, Experiencia $experiencia) {
        $user = $request->user();
        if ($experiencia->usuario_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $experiencia->delete();
        return response()->json(['message' => 'Experience deleted successfully']);
    })->middleware('auth:sanctum');

    // Education routes
    Route::get('educaciones', function(Request $request) {
        $user = $request->user();
        $educaciones = \App\Models\Educacion::where('usuario_id', $user->id)->orderBy('fecha_inicio', 'desc')->get();
        return response()->json($educaciones);
    })->middleware('auth:sanctum');

    Route::post('educaciones', function(Request $request) {
        $user = $request->user();
        $data = $request->all();
        $data['usuario_id'] = $user->id;
        $educacion = \App\Models\Educacion::create($data);
        return response()->json($educacion, 201);
    })->middleware('auth:sanctum');

    Route::put('educaciones/{educacion}', function(Request $request, \App\Models\Educacion $educacion) {
        $user = $request->user();
        if ($educacion->usuario_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $educacion->update($request->all());
        return response()->json($educacion);
    })->middleware('auth:sanctum');

    Route::delete('educaciones/{educacion}', function(Request $request, \App\Models\Educacion $educacion) {
        $user = $request->user();
        if ($educacion->usuario_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $educacion->delete();
        return response()->json(['message' => 'Education deleted successfully']);
    })->middleware('auth:sanctum');

    // Certifications routes
    Route::get('certificados', function(Request $request) {
        $user = $request->user();
        $certificados = Certificado::where('usuario_id', $user->id)->orderBy('fecha_expedicion', 'desc')->get();
        return response()->json($certificados);
    })->middleware('auth:sanctum');

    Route::post('certificados', function(Request $request) {
        $user = $request->user();
        $data = $request->all();
        $data['usuario_id'] = $user->id;
        $certificado = Certificado::create($data);
        return response()->json($certificado, 201);
    })->middleware('auth:sanctum');

    Route::put('certificados/{certificado}', function(Request $request, Certificado $certificado) {
        $user = $request->user();
        if ($certificado->usuario_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $certificado->update($request->all());
        return response()->json($certificado);
    })->middleware('auth:sanctum');

    Route::delete('certificados/{certificado}', function(Request $request, Certificado $certificado) {
        $user = $request->user();
        if ($certificado->usuario_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $certificado->delete();
        return response()->json(['message' => 'Certification deleted successfully']);
    })->middleware('auth:sanctum');

    // Skills routes
    Route::get('habilidades', function(Request $request) {
        $user = $request->user();
        $habilidades = \App\Models\Habilidad::where('usuario_id', $user->id)->orderBy('habilidad')->get();
        return response()->json($habilidades);
    })->middleware('auth:sanctum');

    Route::post('habilidades', function(Request $request) {
        $user = $request->user();
        $data = $request->all();
        $data['usuario_id'] = $user->id;
        $habilidad = \App\Models\Habilidad::create($data);
        return response()->json($habilidad, 201);
    })->middleware('auth:sanctum');

    Route::put('habilidades/{habilidad}', function(Request $request, \App\Models\Habilidad $habilidad) {
        $user = $request->user();
        if ($habilidad->usuario_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $habilidad->update($request->all());
        return response()->json($habilidad);
    })->middleware('auth:sanctum');

    Route::delete('habilidades/{habilidad}', function(Request $request, \App\Models\Habilidad $habilidad) {
        $user = $request->user();
        if ($habilidad->usuario_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $habilidad->delete();
        return response()->json(['message' => 'Skill deleted successfully']);
    })->middleware('auth:sanctum');

    // Languages routes
    Route::get('idiomas', function(Request $request) {
        $user = $request->user();
        $idiomas = \App\Models\Idioma::where('usuario_id', $user->id)->orderBy('idioma')->get();
        return response()->json($idiomas);
    })->middleware('auth:sanctum');

    Route::post('idiomas', function(Request $request) {
        $user = $request->user();
        $data = $request->all();
        $data['usuario_id'] = $user->id;
        $idioma = \App\Models\Idioma::create($data);
        return response()->json($idioma, 201);
    })->middleware('auth:sanctum');

    Route::put('idiomas/{idioma}', function(Request $request, \App\Models\Idioma $idioma) {
        $user = $request->user();
        if ($idioma->usuario_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $idioma->update($request->all());
        return response()->json($idioma);
    })->middleware('auth:sanctum');

    Route::delete('idiomas/{idioma}', function(Request $request, \App\Models\Idioma $idioma) {
        $user = $request->user();
        if ($idioma->usuario_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $idioma->delete();
        return response()->json(['message' => 'Language deleted successfully']);
    })->middleware('auth:sanctum');

    // Projects routes
    Route::get('proyectos', function(Request $request) {
        $user = $request->user();
        $proyectos = \App\Models\Proyecto::where('usuario_id', $user->id)->orderBy('titulo')->get();
        return response()->json($proyectos);
    })->middleware('auth:sanctum');

    Route::post('proyectos', function(Request $request) {
        $user = $request->user();
        $data = $request->all();
        $data['usuario_id'] = $user->id;
        $proyecto = \App\Models\Proyecto::create($data);
        return response()->json($proyecto, 201);
    })->middleware('auth:sanctum');

    Route::put('proyectos/{proyecto}', function(Request $request, \App\Models\Proyecto $proyecto) {
        $user = $request->user();
        if ($proyecto->usuario_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $proyecto->update($request->all());
        return response()->json($proyecto);
    })->middleware('auth:sanctum');

    Route::delete('proyectos/{proyecto}', function(Request $request, \App\Models\Proyecto $proyecto) {
        $user = $request->user();
        if ($proyecto->usuario_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $proyecto->delete();
        return response()->json(['message' => 'Project deleted successfully']);
    })->middleware('auth:sanctum');

    // Publications routes
    Route::get('publicaciones', function(Request $request) {
        $user = $request->user();
        $publicaciones = \App\Models\Publicacion::where('usuario_id', $user->id)->orderBy('fecha', 'desc')->get();
        return response()->json($publicaciones);
    })->middleware('auth:sanctum');

    Route::post('publicaciones', function(Request $request) {
        $user = $request->user();
        $data = $request->all();
        $data['usuario_id'] = $user->id;
        $publicacion = \App\Models\Publicacion::create($data);
        return response()->json($publicacion, 201);
    })->middleware('auth:sanctum');

    Route::put('publicaciones/{publicacion}', function(Request $request, \App\Models\Publicacion $publicacion) {
        $user = $request->user();
        if ($publicacion->usuario_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $publicacion->update($request->all());
        return response()->json($publicacion);
    })->middleware('auth:sanctum');

    Route::delete('publicaciones/{publicacion}', function(Request $request, \App\Models\Publicacion $publicacion) {
        $user = $request->user();
        if ($publicacion->usuario_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $publicacion->delete();
        return response()->json(['message' => 'Publication deleted successfully']);
    })->middleware('auth:sanctum');

    // Social Networks routes
    Route::get('redes-sociales', function(Request $request) {
        $user = $request->user();
        $redesSociales = \App\Models\RedSocial::where('usuario_id', $user->id)->orderBy('plataforma')->get();
        return response()->json($redesSociales);
    })->middleware('auth:sanctum');

    Route::post('redes-sociales', function(Request $request) {
        $user = $request->user();
        $data = $request->all();
        $data['usuario_id'] = $user->id;
        $redSocial = \App\Models\RedSocial::create($data);
        return response()->json($redSocial, 201);
    })->middleware('auth:sanctum');

    Route::put('redes-sociales/{redSocial}', function(Request $request, \App\Models\RedSocial $redSocial) {
        $user = $request->user();
        if ($redSocial->usuario_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $redSocial->update($request->all());
        return response()->json($redSocial);
    })->middleware('auth:sanctum');

    Route::delete('redes-sociales/{redSocial}', function(Request $request, \App\Models\RedSocial $redSocial) {
        $user = $request->user();
        if ($redSocial->usuario_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $redSocial->delete();
        return response()->json(['message' => 'Social network deleted successfully']);
    })->middleware('auth:sanctum');
});

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experiencia;
use Exception;

// use App\Models\Perfil;

class ExperiencesController extends Controller
{
    //List the experiences
    public function store(Request $request)
    {
        try {
            $user = $request->user();
            $experiences = Experiencia::where('usuario_id', $user->id)
                ->orderBy('fecha_inicio', 'desc')
                ->get();
            return response()->json($experiences, 202);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'success' => 'false',
                'messaje' => $e->getMessage()
            ], 404);
        }
    }

    public function create(Request $request)
    {
        try {
            $user = $request->user();
            $data = $request->all();
            $data['usuario_id'] = $user->id;
            $experience = Experiencia::create($data);
            return response()->json($experience, 202);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'success' => 'false',
                'messaje' => $e->getMessage()
            ], 404);
        }
    }
}

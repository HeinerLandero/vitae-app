<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;
use Exception;

class ProfilesController extends Controller
{
    public function newUser(Request $request)
    {
        try {
            $user = $request->user();
            $data = $request->all();
            $data['usuario_id'] = $user->id;

            // Check if profile already exists
            $existingPerfil = Perfil::where('usuario_id', $user->id)->first();
            if ($existingPerfil) {
                $existingPerfil->update($data);
                return response()->json($existingPerfil);
            } else {
                $perfil = Perfil::create($data);
                return response()->json($perfil, 201);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'success' => 'false',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function show(Request $request)
    {
        try {
            $user = $request->user();
            $perfil = Perfil::with('usuario:id,nombre,email,apellido')
                ->where('usuario_id', $user->id)
                ->first();
            return response()->json($perfil ?: null);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'success' => 'false',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function getCurrentUser($usuario)
    {
        $perfil = Perfil::where('usuario_id', $usuario)->first();
        return response()->json($perfil ?: null);
    }
}

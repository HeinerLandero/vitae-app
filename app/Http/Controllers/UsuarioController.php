<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Usuario::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|min:8|confirmed',
            'plantilla_id' => 'required|exists:plantillas,id',
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'slug' => Str::slug($request->nombre . '-' . $request->apellido . '-' . Str::random(5)),
            'plantilla_id' => $request->plantilla_id,
        ]);

        // Generate QR code
        $url = url('/cv/' . $usuario->slug);
        $qrCode = QrCode::size(200)->format('svg')->generate($url);
        $usuario->update(['qr_code' => 'data:image/svg+xml;base64,' . base64_encode($qrCode)]);

        return response()->json($usuario, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Usuario::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());
        return response()->json($usuario);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Usuario::destroy($id);
        return response()->json(['message' => 'Usuario deleted']);
    }

    /**
     * Login user and return token.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Usuario::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('API Token')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token]);
    }

    /**
     * Logout user.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    /**
     * Refresh user token.
     */
    public function refreshToken(Request $request)
    {
        // Delete current token
        $request->user()->currentAccessToken()->delete();

        // Create new token
        $token = $request->user()->createToken('API Token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    /**
     * Get current user.
     */
    public function me(Request $request)
    {
        // Get fresh user from database
        $user = Usuario::find($request->user()->id);

        // Generate QR if not exists
        if (!$user || !$user->qr_code) {
            $url = url('/cv/' . $user->slug);
            $qrCode = QrCode::size(200)->format('svg')->generate($url);
            $user->update(['qr_code' => 'data:image/svg+xml;base64,' . base64_encode($qrCode)]);
            $user = $user->fresh(); // Refresh to get updated data
        }

        return response()->json($user);
    }

    /**
     * Regenerate QR code for user.
     */
    public function regenerateQr(Request $request)
    {
        // Get fresh user from database
        $user = Usuario::find($request->user()->id);

        $url = url('/cv/' . $user->slug);
        $qrCode = QrCode::size(200)->format('svg')->generate($url);
        $user->update(['qr_code' => 'data:image/svg+xml;base64,' . base64_encode($qrCode)]);

        return response()->json(['message' => 'QR regenerado', 'qr_code' => $user->fresh()->qr_code]);
    }
}

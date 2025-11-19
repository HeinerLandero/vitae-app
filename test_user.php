<?php
require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $user = Usuario::create([
        'nombre' => 'Juan',
        'apellido' => 'Perez',
        'email' => 'juan@example.com',
        'password' => Hash::make('password123'),
        'slug' => 'juan-perez-test123',
        'plantilla_id' => 1
    ]);

    echo "User created with ID: " . $user->id . "\n";
    echo "Email: " . $user->email . "\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

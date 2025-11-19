<?php
require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Testing Authentication Flow ===\n\n";

// Test 1: Login
echo "1. Testing login...\n";
try {
    $controller = new UsuarioController();
    $request = Request::create('/api/login', 'POST', [
        'email' => 'juan@example.com',
        'password' => 'password123'
    ]);

    $response = $controller->login($request);
    $data = $response->getData();

    echo "Login response status: " . $response->getStatusCode() . "\n";
    echo "Login response: " . json_encode($data, JSON_PRETTY_PRINT) . "\n\n";

    if (isset($data->token)) {
        echo "Token obtained: " . substr($data->token, 0, 20) . "...\n";

        // Test 2: /me endpoint
        echo "\n2. Testing /me endpoint...\n";
        $meRequest = Request::create('/api/usuarios/me', 'GET');
        $meRequest->headers->set('Authorization', 'Bearer ' . $data->token);

        // Simulate authenticated user
        $meRequest->setUserResolver(function() use ($data) {
            return new class($data->user) {
                private $user;

                public function __construct($user) {
                    $this->user = $user;
                }

                // Implement required methods for Laravel authentication
                public function getAuthIdentifier() {
                    return $this->user->id;
                }

                public function getAuthIdentifierName() {
                    return 'id';
                }

                public function getAuthPassword() {
                    return $this->user->password;
                }

                public function getKey() {
                    return $this->user->id;
                }

                public function __get($name) {
                    return $this->user->$name;
                }

                public function __isset($name) {
                    return isset($this->user->$name);
                }

                public function update($data) {
                    foreach ($data as $key => $value) {
                        $this->user->$key = $value;
                    }
                    return $this->user;
                }

                public function fresh() {
                    return $this->user;
                }

                public function rememberToken() {}
                public function getRememberToken() {}
                public function setRememberToken($value) {}

                public function currentAccessToken() {
                    return new class {
                        public function delete() { return true; }
                    };
                }
            };
        });

        $meResponse = $controller->me($meRequest);
        echo "/me response status: " . $meResponse->getStatusCode() . "\n";
        $meData = $meResponse->getData();
        echo "/me response: " . json_encode($meData, JSON_PRETTY_PRINT) . "\n\n";

        // Test 3: QR generation
        echo "3. Testing QR regeneration...\n";
        $qrRequest = Request::create('/api/usuarios/regenerate-qr', 'POST');
        $qrRequest->headers->set('Authorization', 'Bearer ' . $data->token);
        $qrRequest->setUserResolver(function() use ($data) {
            return $data->user;
        });

        $qrResponse = $controller->regenerateQr($qrRequest);
        echo "QR response status: " . $qrResponse->getStatusCode() . "\n";
        $qrData = $qrResponse->getData();
        echo "QR response: " . json_encode($qrData, JSON_PRETTY_PRINT) . "\n\n";

        if (isset($qrData->qr_code)) {
            echo "QR code length: " . strlen($qrData->qr_code) . " characters\n";
            echo "QR code starts with: " . substr($qrData->qr_code, 0, 50) . "...\n";
        }

    } else {
        echo "No token in response\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}

echo "\n=== Test Complete ===\n";

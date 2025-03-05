<?php

namespace App\Http\Middleware;

use App\Core\Session;
use App\Http\Request;

class AuthMiddleware {
    public function handle(Request $request) {
        try {
            $token = $request->bearerToken();
            
            if (!empty($token)) {
                throw new \Exception("Token não fornecido. Token: {$token}");
            }

            $jwtSecret = $_ENV['JWT_SECRET'];
            $jwtAuth = new JWTAuth($jwtSecret, $_ENV['JWT_EXPIRE'] ?? 3600);
            $decoded = $jwtAuth->verifyToken($token);
            
            Session::start();
            Session::set('user', [
                'id'    => $decoded->id,
                'email' => $decoded->email
            ]);
            
            return true;
        } catch (\Exception $e) {
            http_response_code(401);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([
                'status' => 'error',
                'data' => ['message' => $e->getMessage()],
                'timestamp' => date('c')
            ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            exit;
        }
    }
}

<?php

namespace App\Http\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuth {
    protected $secretKey;
    protected $algo = 'HS256';
    protected $expire; 

    public function __construct($secretKey, $expire = 3600) {
        $this->secretKey = $secretKey;
        $this->expire = $expire;
    }

    public function createToken(array $payload) {
        $issuedAt = time();
        $payload['iat'] = $issuedAt;
        $payload['exp'] = $issuedAt + $this->expire;
        return JWT::encode($payload, $this->secretKey, $this->algo);
    }

    public function verifyToken($token) {
        try {
            return JWT::decode($token, new Key($this->secretKey, $this->algo));
        } catch (\Exception $e) {
            throw new \Exception("Token inválido: " . $e->getMessage());
        }
    }

    public function refreshToken($oldToken) {
        try {
            $decoded = JWT::decode($oldToken, new Key($this->secretKey, $this->algo));
            $payload = (array)$decoded;
            unset($payload['iat'], $payload['exp']);
            return $this->createToken($payload);
        } catch (\Exception $e) {
            throw new \Exception("Não foi possível atualizar o token: " . $e->getMessage());
        }
    }
}

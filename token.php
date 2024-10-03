<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenManager
{
    private $secretKey = "clave_secreta"; // Cambia esta clave secreta en producción

    // Generar el JWT
    public function generateToken($email)
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600;  // El token expira en 1 hora

        $payload = array(
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'email' => $email
        );

        return JWT::encode($payload, $this->secretKey, 'HS256');
    }

    // Verificar el JWT
    public function validateToken($token)
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return $decoded;
        } catch (Exception $e) {
            return null;
        }
    }
}

<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenManager
{
    private $secretKey = "supersecretpass";

    // Generar el JWT
    public function generateToken($email)
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600;  // Expires in 1 hour

        $payload = array(
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'email' => $email
        );

        return JWT::encode($payload, $this->secretKey, 'HS256');
    }

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

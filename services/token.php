<?php
require '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenManager
{
    private $secretKey = "scpssldap2024";  

    // Generación de JWT
    public function generateToken($email)
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + 86400;  // Expira en 1 dia

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
?>

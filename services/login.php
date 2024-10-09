<?php

require_once 'ldap.php';
require_once 'token.php';

class Login
{
    private $ldap;
    private $tokenManager;

    public function __construct()
    {
        $this->ldap = new LDAPConnection();
        $this->tokenManager = new TokenManager();
    }

    // Se recibe correo, contraseña y tipo usuario
    public function authenticate($email, $password, $ou)
    {
        $this->ldap->connect();

        if ($this->ldap->authenticate($email, $password, $ou)) {
            $token = $this->tokenManager->generateToken($email, $ou);
            return ["status" => "success", "token" => $token];
        } else {
            return ["status" => "error", "message" => "Credenciales incorrectas."];
        }
    }
}
?>

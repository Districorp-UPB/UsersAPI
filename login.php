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

    public function authenticate($email, $password)
    {
        $this->ldap->connect();

        if ($this->ldap->authenticate($email, $password)) {
            $token = $this->tokenManager->generateToken($email);
            return ["status" => "success", "token" => $token];
        } else {
            return ["status" => "error", "message" => "Credenciales incorrectas."];
        }
    }
}

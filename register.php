<?php

require_once 'ldap.php';

class Register
{
    private $ldap;

    public function __construct()
    {
        $this->ldap = new LDAPConnection();
    }

    public function createUser($username, $password, $email, $phone, $role)
    {
        $this->ldap->connect();
        if ($this->ldap->addUser($username, $password, $email, $phone, $role)) {
            return ["status" => "success", "message" => "Usuario creado con éxito."];
        } else {
            return ["status" => "error", "message" => "Error al crear el usuario."];
        }
    }
}

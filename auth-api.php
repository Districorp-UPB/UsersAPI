<?php

require_once 'login.php';

class AuthAPI
{
    private $login;

    public function __construct()
    {
        $this->login = new Login();
    }

    // Método para login
    public function login($email, $password, $ou)
    {
        return $this->login->authenticate($email, $password, $ou);
    }
}

// Creación del servidor
$options = array('uri' => "https://localhost:443/soap-server.php");
$server = new SoapServer(NULL, $options);
$server->setClass("AuthAPI");
$server->handle();
?>

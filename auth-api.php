<?php

require_once 'login.php';
require_once 'register.php';

class AuthAPI
{
    private $login;
    private $register;

    public function __construct()
    {
        $this->login = new Login();
        $this->register = new Register();
    }

    public function login($email, $password)
    {
        return $this->login->authenticate($email, $password);
    }

    public function createUser($username, $password, $email, $phone, $role)
    {
        return $this->register->createUser($username, $password, $email, $phone, $role);
    }
}

// Crear el servidor SOAP
$options = array('uri' => "http://localhost/soap-server.php");
$server = new SoapServer(NULL, $options);
$server->setClass("AuthAPI");
$server->handle();

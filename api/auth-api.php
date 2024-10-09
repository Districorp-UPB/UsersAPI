<?php

require_once '../services/login.php';

class AuthAPI
{
    private $login;

    public function __construct()
    {
        $this->login = new Login();
    }

    public function login($loginRequest)
    {
        $email = $loginRequest->email;
        $password = $loginRequest->password;
        $ou = $loginRequest->ou;

        return $this->login->authenticate($email, $password, $ou);
    }
}

// Opciones del servidor con WSDL
$options = array(
    // 'uri' => "https://localhost:443/soap-server.php",
    'soap_version' => SOAP_1_2,
    'cache_wsdl' => WSDL_CACHE_NONE,
    'stream_context' => stream_context_create([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ])
);

// Ruta al archivo WSDL
$wsdl = __DIR__ . "/../wsdl/auth.wsdl";

// Creación del servidor
$server = new SoapServer($wsdl, $options);
$server->setClass("AuthAPI");
$server->handle();

<?php

require_once '../services/register.php';

class RegisAPI
{
    private $register;

    public function __construct()
    {
        $this->register = new Register();
    }

    public function register($registerRequest)
    {
        $name = $registerRequest->name;
        $surname = $registerRequest->surname;
        $email = $registerRequest->email;
        $phone = $registerRequest->phone;
        $document = $registerRequest->document;
        $password = $registerRequest->password;
        $ou = $registerRequest->ou;

        return $this->register->addUser($name, $surname, $email, $phone, $document, $password, $ou);
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
$wsdl = __DIR__ . "/../wsdl/regis.wsdl";

// Creación del servidor
$server = new SoapServer($wsdl, $options);
$server->setClass("RegisAPI");
$server->handle();

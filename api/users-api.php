<?php

require_once '../services/users.php';

class UserAPI
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function getUsersByGroup($getUsersByGroupRequest)
    {
        $ou = $getUsersByGroupRequest->ou;
        return $this->user->getUsersByGroup($ou);
    }
}

// Opciones del servidor con WSDL
$options = array(
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
$wsdl = __DIR__ . "/../wsdl/users.wsdl";

// Creación del servidor SOAP
$server = new SoapServer($wsdl, $options);
$server->setClass("UserAPI");
$server->handle();

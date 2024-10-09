<?php
require_once '../services/delete.php';

class DeleteAPI
{
    private $delete;

    public function __construct()
    {
        $this->delete = new Delete();
    }

    public function delete($deleteRequest)
    {
        $email = $deleteRequest->email;
        $ou = $deleteRequest->ou;

        return $this->delete->deleteUser($email, $ou);
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
$wsdl = __DIR__ . "/../wsdl/del.wsdl";

// Creación del servidor
$server = new SoapServer($wsdl, $options);
$server->setClass("DeleteAPI");
$server->handle();

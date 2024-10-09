<?php
require_once '../services/edit.php';

class EditAPI
{
    private $edit;

    public function __construct()
    {
        $this->edit = new Edit();
    }

    public function edit($editRequest)
    {
        $email = $editRequest->email;
        $ou = $editRequest->ou;
        $attributes = [
            "cn" => $editRequest->name,
            "sn" => $editRequest->surname,
            "telephoneNumber" => $editRequest->phone,
            "employeeNumber" => $editRequest->document
        ];

        echo "Edit Request: Email: $email, OU: $ou, Attributes: " . json_encode($attributes) . "\n";

        return $this->edit->editUser($email, $ou, $attributes);
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
$wsdl = __DIR__ . "/../wsdl/edit.wsdl";

// Creación del servidor
$server = new SoapServer($wsdl, $options);
$server->setClass("EditAPI");
$server->handle();

<?php
require_once 'ldap.php';

class Edit
{
    private $ldap;

    public function __construct()
    {
        $this->ldap = new LDAPConnection();
    }

    public function editUser($email, $ou, $attributes)
    {
        $this->ldap->connect();

        // Separar el uid del correo
        $uid = strstr($email, '@', true);
        $dn = "uid=$uid,ou=$ou,dc=districorp,dc=com";

        if (ldap_modify($this->ldap->getConnection(), $dn, $attributes)) {
            return ["status" => "success", "message" => "Usuario editado con éxito"];
        } else {
            return ["status" => "error", "message" => "Error editando usuario: " . ldap_error($this->ldap->getConnection())];
        }
    }
}

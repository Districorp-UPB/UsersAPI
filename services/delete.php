<?php
require_once 'ldap.php';

class Delete
{
    private $ldap;

    public function __construct()
    {
        $this->ldap = new LDAPConnection();
    }

    public function deleteUser($email, $ou)
    {
        $this->ldap->connect();

        // Separar el uid del correo
        $uid = strstr($email, '@', true);
        $dn = "uid=$uid,ou=$ou,dc=districorp,dc=com";

        if (@ldap_delete($this->ldap->getConnection(), $dn)) {
            return ["status" => "success", "message" => "Usuario eliminado con éxito"];
        } else {
            return ["status" => "error", "message" => "Error eliminando usuario: " . ldap_error($this->ldap->getConnection())];
        }
    }
}

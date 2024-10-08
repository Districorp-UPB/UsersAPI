<?php
require_once 'ldap.php';

class Register
{
    private $ldap;

    public function __construct()
    {
        $this->ldap = new LDAPConnection();
    }

    public function addUser($name, $surname, $email, $phone, $password, $role)
    {
        $this->ldap->connect();

        // Separar el uid del correo
        $uid = strstr($email, '@', true);

        $dn = "uid=$uid,ou=$role,dc=districorp,dc=com";

        $entry = [
            "uid" => $uid,
            "cn" => $name,
            "sn" => $surname,
            "mail" => $email,
            "telephoneNumber" => $phone,
            "objectClass" => ["inetOrgPerson", "posixAccount", "top"],
            "userPassword" => $password,
            "uidNumber" => 10000,
            "gidNumber" => 5000,
            "homeDirectory" => "/home/$uid"
        ];

        if (@ldap_add($this->ldap->getConnection(), $dn, $entry)) {
            return ["status" => "success", "message" => "Usuario añadido con éxito"];
        } else {
            return ["status" => "error", "message" => "Error añadiendo usuario: " . ldap_error($this->ldap->getConnection())];
        }
    }
}

<?php
require_once 'ldap.php';

class User
{
    private $ldap;

    public function __construct()
    {
        $this->ldap = new LDAPConnection();
    }

    public function getUsersByGroup($ou)
    {
        $this->ldap->connect();

        $baseDn = "ou=$ou,dc=districorp,dc=com";
        $filter = "(objectClass=inetOrgPerson)";
        $attributes = ["uid", "cn", "sn", "mail", "telephonenumber", "employeenumber"];

        $result = ldap_search($this->ldap->getConnection(), $baseDn, $filter, $attributes);

        if ($result) {
            $entries = ldap_get_entries($this->ldap->getConnection(), $result);
            $users = [];

            for ($i = 0; $i < $entries["count"]; $i++) {
                $users[] = [
                    "uid" => $entries[$i]["uid"][0],
                    "name" => $entries[$i]["cn"][0],
                    "surname" => $entries[$i]["sn"][0],
                    "email" => $entries[$i]["mail"][0],
                    "role" => $ou,
                    "phone" => $entries[$i]["telephonenumber"][0],
                    "document" => $entries[$i]["employeenumber"][0],
                ];
            }

            return ["status" => "success", "data" => $users];
        } else {
            return ["status" => "error", "message" => "Error buscando usuarios: " . ldap_error($this->ldap->getConnection())];
        }
    }
}

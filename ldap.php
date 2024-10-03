<?php

class LDAPConnection
{
    private $ldapHost = "ldaps://207.248.81.69";
    private $ldapBaseDn = "dc=districorp,dc=com";
    private $ldapConn;

    public function connect()
    {
        $this->ldapConn = ldap_connect($this->ldapHost);

        if (!$this->ldapConn) {
            throw new Exception("No se puede conectar al servidor LDAP.");
        }

        ldap_set_option($this->ldapConn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($this->ldapConn, LDAP_OPT_REFERRALS, 0);
    }

    public function authenticate($email, $password)
    {
        $userDn = "uid=" . ldap_escape($email, "", LDAP_ESCAPE_DN) . "," . $this->ldapBaseDn;
        return @ldap_bind($this->ldapConn, $userDn, $password);
    }

    public function addUser($username, $password, $email, $phone, $role)
    {
        // Aquí iría la lógica para registrar un nuevo usuario en LDAP
        return false;
    }

    public function getConnection()
    {
        return $this->ldapConn;
    }
}

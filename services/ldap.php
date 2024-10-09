<?php

class LDAPConnection
{
    private $ldapHost = "ldaps://207.248.81.69:636";  // O localhost
    private $ldapBaseDn = "dc=districorp,dc=com";
    private $ldapConn;

    public function connect()
    {
        // ldap_set_option(NULL, LDAP_OPT_X_TLS_REQUIRE_CERT, LDAP_OPT_X_TLS_NEVER);  // Fuck
        $this->ldapConn = ldap_connect($this->ldapHost);

        if (!$this->ldapConn) {
            throw new Exception("No se puede conectar al servidor LDAP.");
        }

        ldap_set_option($this->ldapConn, LDAP_OPT_PROTOCOL_VERSION, 3);

        $admin_dn = "cn=admin,dc=districorp,dc=com";
        $admin_password = "cpda2024*/";

        if (!@ldap_bind($this->ldapConn, $admin_dn, $admin_password)) {
            throw new Exception("Error en la autenticación: " . ldap_error($this->ldapConn));
        }
    }

    public function authenticate($email, $password, $ou)
    {
        // Separar el UID del correo
        $uid = strstr($email, '@', true);

        // Construir el DN con uid y ou
        $userDn = "uid=$uid,ou=$ou," . $this->ldapBaseDn;

        // Intentar autenticar con el DN construido
        return @ldap_bind($this->ldapConn, $userDn, $password);
    }

    public function getConnection()
    {
        return $this->ldapConn;
    }
}

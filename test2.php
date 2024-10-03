<?php
$ldap_server = "ldap://207.248.81.69"; 
$bind_dn = "cn=admin,dc=districorp,dc=com"; 
$password = "cpda2024*/"; 

$ldap_conn = ldap_connect($ldap_server);
ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3); 

if ($ldap_conn) {
    echo "Conexión LDAP exitosa.<br>";

    $ldap_bind = ldap_bind($ldap_conn, $bind_dn, $password);
    if ($ldap_bind) {
        echo "Autenticación exitosa.<br>";
    } else {
        echo "Error de autenticación: " . ldap_error($ldap_conn) . "<br>";
    }
} else {
    echo "Error de conexión LDAP.<br>";
}
?>

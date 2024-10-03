<?php
$ldap_host = "ldaps://207.248.81.69"; 
$ldap_port = 636; 
$admin_dn = "cn=admin,dc=districorp,dc=com"; 
$admin_password = "cpda2024*/"; 
$ca_cert_path = "";

ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7);
$ldap_connection = ldap_connect($ldap_host, $ldap_port);
ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3); 

if ($ldap_connection) {
    echo "Conexión LDAP exitosa.<br>";

    
    if (@ldap_bind($ldap_connection, $admin_dn, $admin_password)) {
        echo "Autenticación exitosa.<br>";
    } else {
        echo "Error de autenticación: " . ldap_error($ldap_connection) . "<br>";
    }
} else {
    echo "No se pudo conectar al servidor LDAP.<br>";
}
?>

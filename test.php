<?php
$ldap_host = "ldaps://207.248.81.69"; // Cambia esto si tu servidor LDAP no está en localhost
$ldap_port = 636; // El puerto predeterminado para LDAP
$admin_dn = "cn=admin,dc=districorp,dc=com"; // DN del administrador
$admin_password = "cpda2024*/"; // Contraseña del administrador
$ca_cert_path = "";



// Conectar al servidor LDAP
ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7);
$ldap_connection = ldap_connect($ldap_host, $ldap_port);
ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3); // Establecer la versión del protocolo LDAP

if ($ldap_connection) {
    echo "Conexión LDAP exitosa.<br>";

    // Intentar enlazar con el servidor LDAP
    if (@ldap_bind($ldap_connection, $admin_dn, $admin_password)) {
        echo "Autenticación exitosa.<br>";
    } else {
        echo "Error de autenticación: " . ldap_error($ldap_connection) . "<br>";
    }
} else {
    echo "No se pudo conectar al servidor LDAP.<br>";
}
?>

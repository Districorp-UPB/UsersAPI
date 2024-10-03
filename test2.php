<?php
// Configuración del servidor LDAP
$ldap_server = "ldap://207.248.81.69"; // URL del servidor LDAP sin SSL
$bind_dn = "cn=admin,dc=districorp,dc=com"; // DN del usuario administrador
$password = "cpda2024*/"; // Reemplaza con la contraseña correcta

// Conectar al servidor LDAP
$ldap_conn = ldap_connect($ldap_server);
ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3); // Usar la versión 3 del protocolo LDAP

if ($ldap_conn) {
    echo "Conexión LDAP exitosa.<br>";

    // Intentar realizar el bind
    $ldap_bind = ldap_bind($ldap_conn, $bind_dn, $password);
    if ($ldap_bind) {
        echo "Autenticación exitosa.<br>";
    } else {
        echo "Error de autenticación: " . ldap_error($ldap_conn) . "<br>";
    }
} else {
    echo "Error de conexión LDAP.<br>";
}

// Cerrar la conexión LDAP
ldap_unbind($ldap_conn);
?>

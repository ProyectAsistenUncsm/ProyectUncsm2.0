<?php 
// Conecta el archivo de configuración global
require_once("global.php");

// Conecta a la Base de datos
$conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Configura el juego de caracteres de la conexión
mysqli_query($conexion, 'SET NAMES "' . DB_ENCODE . '"');

// Alerta cuando no se conecta a la base de datos
if ($conexion->connect_error) {
    die("ALGO SALIÓ MAL: " . $conexion->connect_error);
}

// Creación de funciones de consultas
if (!function_exists('ejecutarConsulta')){
    function ejecutarConsulta($sql) {
        global $conexion;
        // Ejecuta la consulta SQL y devuelve el resultado
        $query = $conexion->query($sql);
        if (!$query) {
            die("Error en la consulta: " . $conexion->error);
        }
        return $query;
    }

    function ejecutarConsultaSimplesFila($sql) {
        global $conexion;
        // Ejecuta la consulta SQL y devuelve una fila de resultados
        $query = $conexion->query($sql);
        if (!$query) {
            die("Error en la consulta: " . $conexion->error);
        }
        $row = $query->fetch_assoc();
        return $row;
    }

    // Devuelve el ID insertado en una consulta de inserción
    function ejecutarConsulta_RetornarID($sql){
        global $conexion;
        $query = $conexion->query($sql);
        if (!$query) {
            die("Error en la consulta: " . $conexion->error);
        }
        return $conexion->insert_id;
    }

    // Limpia la cadena escapando caracteres especiales y HTML para evitar inyecciones XSS
    function limpiarCadena($str) {
        global $conexion;
        $str = mysqli_real_escape_string($conexion, trim($str));
        return htmlspecialchars($str);
    }
}

// Cierra la conexión cuando ya no se necesita
// mysqli_close($conexion); / Descomentar para cerrar explícitamente si es necesario

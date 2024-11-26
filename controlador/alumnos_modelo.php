<?php 
require 'conexion/conexion.php'; // Verifica que esta ruta sea correcta
error_log("Archivo de conexión cargado correctamente."); // Esto debe mostrarse si la inclusión es exitosa.

class Alumnos
{
    public function __construct() {}

    public function insertar($nombre, $apellidos, $login, $email, $password, $codigo, $telefono, $carrera, $imagen) {
    $sql = "INSERT INTO alumnos (nombre, apellidos, login, email, password, codigo, telefono, carrera, imagen, status)
            VALUES ('$nombre', '$apellidos', '$login', '$email', '$password', '$codigo', '$telefono', '$carrera', '$imagen', '1')";
    return ejecutarConsulta($sql);
}


    public function editar($alumno_id, $nombre, $apellidos, $login, $email, $password, $codigo, $telefono, $carrera, $imagen)
    {
        if (!empty($password)) {
            $sql = "UPDATE alumnos 
                    SET nombre='$nombre', apellidos='$apellidos', login='$login', email='$email', 
                    password='$password', codigo='$codigo', telefono='$telefono', carrera='$carrera', imagen='$imagen'
                    WHERE alumno_id='$alumno_id'";
        } else {
            $sql = "UPDATE alumnos 
                    SET nombre='$nombre', apellidos='$apellidos', login='$login', email='$email', 
                    codigo='$codigo', telefono='$telefono', carrera='$carrera', imagen='$imagen'
                    WHERE alumno_id='$alumno_id'";
        }
        return ejecutarConsulta($sql);
    }

    public function desactivar($alumno_id)
    {
        $sql = "UPDATE alumnos SET status='0' WHERE alumno_id='$alumno_id'";
        return ejecutarConsulta($sql);
    }

    public function activar($alumno_id)
    {
        $sql = "UPDATE alumnos SET status='1' WHERE alumno_id='$alumno_id'";
        return ejecutarConsulta($sql);
    }

    public function mostrar($alumno_id)
    {
        $sql = "SELECT * FROM alumnos WHERE alumno_id='$alumno_id'";
        return ejecutarConsultaSimplesFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT * FROM alumnos";
        $result = ejecutarConsulta($sql);
        
        // Depuración: verificar si hay resultados
        if ($result->num_rows > 0) {
            error_log("La consulta devolvió " . $result->num_rows . " filas");
        } else {
            error_log("La consulta no devolvió resultados");
        }
        
        return $result;
    }

    public function cantidad_alumno()
    {
        $sql = "SELECT COUNT(*) AS cantidad FROM alumnos";
        return ejecutarConsulta($sql);
    }

    public function verificar($login, $password)
    {
        $sql = "SELECT * FROM alumnos WHERE login='$login' AND password='$password' AND status='1'";
        return ejecutarConsulta($sql);
    }
}

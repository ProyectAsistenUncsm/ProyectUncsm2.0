<?php 
require_once __DIR__ . '/conexion/conexion.php'; // Corregida la ruta de inclusión

class Asistencia_alumno
{
    // Implementamos nuestro constructor
    public function __construct()
    {
    }

    // Listar registros
    public function listar()
    {
        $sql = "SELECT a.*, CONCAT(e.nombre, ' ', e.apellidos) AS alumno, e.codigo
                FROM asistencias_alumnos a 
                INNER JOIN alumnos e ON a.alumno_id = e.alumno_id 
                ORDER BY a.alumno_id DESC";
        return ejecutarConsulta($sql); // Asegúrate de que esta función maneje la seguridad
    }
    
    // Listar reporte de asistencias entre fechas para un alumno específico
    public function listar_reporte($fecha_inicio, $fecha_fin, $alumno_id)
    {
        // Usar consultas preparadas para evitar inyecciones SQL
        $sql = "SELECT a.*, CONCAT(e.nombre, ' ', e.apellidos) AS alumno, e.codigo
                FROM asistencias_alumnos a 
                INNER JOIN alumnos e ON a.alumno_id = e.alumno_id 
                WHERE DATE(a.fecha) >= '$fecha_inicio' 
                  AND DATE(a.fecha) <= '$fecha_fin' 
                  AND a.alumno_id = '$alumno_id'";
        return ejecutarConsulta($sql);
    }
}
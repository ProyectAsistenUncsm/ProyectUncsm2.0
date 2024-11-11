<?php 
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Corregida la ruta de inclusión
require_once __DIR__ . '/asistencias_alumnos_modelo.php';

// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$asistencia = new Asistencia_alumno();

// Verifica que 'op' esté definido en $_GET
if (!isset($_GET["op"])) {
    echo json_encode(["error" => "Operación no especificada"]);
    exit;
}

// Habilitar el reporte de errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Al principio del script, registra que se ha accedido al archivo
error_log("Acceso a Asistencias_alumno.php: " . date('Y-m-d H:i:s'));

// Antes de ejecutar la consulta, registra los parámetros recibidos
error_log("Operación solicitada: " . ($_GET['op'] ?? 'No especificada'));

// Agregar depuración
file_put_contents('debug.log', "Script accessed at " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);
file_put_contents('debug.log', "GET parameters: " . print_r($_GET, true) . "\n", FILE_APPEND);

header('Content-Type: application/json');

switch ($_GET["op"]) {
    case 'listar': 
        // Caso para listar todas las asistencias
        $rspta = $asistencia->listar(); 
        $data = array(); 
        $item = 0; 
        while ($reg = $rspta->fetch_object()) {
            $data[] = array( 
                "0" => $item,
                "1" => $reg->codigo,
                "2" => $reg->alumno,
                "3" => $reg->hora,
                "4" => $reg->fecha,
                "5" => ($reg->tipo == 'Entrada') ? '<span class="label bg-green">' . $reg->tipo . '</span>' : '<span class="label bg-orange">' . $reg->tipo . '</span>',
            );
            $item++; 
        }
        $results = array(
            "sEcho" => 1, 
            "iTotalRecords" => count($data), 
            "iTotalDisplayRecords" => count($data), 
            "aaData" => $data 
        );
        echo json_encode($results); 
        break;

    case 'listar_asistencia': 
        // Caso para listar las asistencias dentro de un rango de fechas y para un maestro específico
        $fecha_inicio = $_REQUEST["fecha_inicio"]; 
        // Se obtiene la fecha de inicio del rango
        $fecha_fin = $_REQUEST["fecha_fin"]; 
        // Se obtiene la fecha de fin del rango
        $alumno_id = $_REQUEST["alumno_id"]; 
        // Se obtiene el ID del alumno

        // Verificar que las fechas y el ID del alumno no estén vacíos
        if (empty($fecha_inicio) || empty($fecha_fin) || empty($alumno_id)) {
            echo json_encode(["error" => "Faltan parámetros requeridos."]);
            exit;
        }



        $rspta = $asistencia->listar_reporte($fecha_inicio, $fecha_fin, $alumno_id); 
        $data = array(); 
        $item = 0; 
        while ($reg = $rspta->fetch_object()) { 
            $data[] = array( 
                "0" => $item,
                "1" => $reg->codigo,
                "2" => $reg->alumno,
                "3" => $reg->fecha,
                "4" => $reg->hora,
                "5" => ($reg->tipo == 'Entrada') ? '<span class="label bg-green">' . $reg->tipo . '</span>' : '<span class="label bg-orange">' . $reg->tipo . '</span>',
            );
            $item++; 
        }
        $results = array(
            "sEcho" => 1, 
            "iTotalRecords" => count($data), 
            "iTotalDisplayRecords" => count($data), 
            "aaData" => $data 
        );

        echo json_encode($results); 
        break;

    default:
        echo json_encode(["error" => "Operación no válida"]);
        break;
}
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

ob_start(); // Inicia el almacenamiento en búfer de salida

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluimos el archivo de la clase alumno
require 'alumnos_modelo.php';

// Creamos una instancia del objeto alumno
$alumno = new Alumnos(); 
// Cambié $alumno_id a $alumno, ya que estás creando la instancia aquí
// Recibimos los datos enviados por el formulario
$alumno_id = isset($_POST['alumno_id']) ? limpiarCadena($_POST['alumno_id']) : "";
$nombre = isset($_POST['nombre']) ? limpiarCadena($_POST['nombre']) : "";
$apellidos = isset($_POST['apellidos']) ? limpiarCadena($_POST['apellidos']) : "";
$login = isset($_POST['login']) ? limpiarCadena($_POST['login']) : "";
$email = isset($_POST['email']) ? limpiarCadena($_POST['email']) : "";
$password = isset($_POST['password']) ? limpiarCadena($_POST['password']) : "";
$codigo = isset($_POST['codigo']) ? limpiarCadena($_POST['codigo']) : "";
$telefono = isset($_POST['telefono']) ? limpiarCadena($_POST['telefono']) : "";
$carrera = isset($_POST['carrera']) ? limpiarCadena($_POST['carrera']) : "";
$area_de_conocimiento = isset($_POST['area_de_conocimiento']) ? limpiarCadena($_POST['area_de_conocimiento']) : "";
$imagen = isset($_POST["imagen"]) ? limpiarCadena($_POST["imagen"]) : "";

$op = isset($_GET['op']) ? limpiarCadena($_GET['op']) : '';
if (empty($op)) {
    die("Operación no especificada");
}


switch ($_GET['op']) {
    case 'guardaryeditar':
        $clavehash = '';
        // Verificamos si se subió una nueva imagen
        $imagen = "";
if (isset($_FILES['imagen']) && file_exists($_FILES['imagen']['tmp_name']) && is_uploaded_file($_FILES['imagen']['tmp_name'])) {
    // Procesamos la nueva imagen
    $ext = explode(".", $_FILES["imagen"]["name"]);
    if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png") {
        $imagen = round(microtime(true)) . '.' . end($ext);
        $upload_dir = __DIR__ . '/files/alumnos/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        move_uploaded_file($_FILES['imagen']['tmp_name'], $upload_dir . $imagen);
    }
} else {
    //   Usamos la imagen actual si no se subió una nueva
    $imagen = isset($_POST['imagenactual']) ? $_POST['imagenactual'] : "";
}

        if (!empty($password)) {
            $password = hash("SHA256", $password); // Generamos el hash de la nueva contraseña
        } else {
            //    Aseguramos que 'clave_actual' esté definida antes de usarla
            $password = isset($_POST['clave_actual']) ? limpiarCadena($_POST['clave_actual']) : "";
        }

        // Verificamos si se está insertando un nuevo alumno o editando uno existente
        if (empty($alumno_id)) {
            // Si es un nuevo alumno, llamamos al método insertar de la clase alumno
            $rspsta = $alumno->insertar($nombre, $apellidos, $login, $email, $password, $codigo, $telefono, $carrera, $area_de_conocimiento, $imagen);
            // Devolvemos un mensaje según el resultado de la operación
            echo $rspsta ? "Datos registrados correctamente" : "No se pudo registrar todos los datos del alumno";
        } else {
            // Si es un alumno existente, llamamos al método editar de la clase alumno
            $rspsta = $alumno->editar($alumno_id, $nombre, $apellidos, $login, $email, $password, $codigo, $telefono, $carrera, $area_de_conocimiento, $imagen);
            // Devolvemos un mensaje según el resultado de la operación
            echo $rspsta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
        }
        break;

    case 'desactivar':
        // Llamamos al método desactivar de la clase alumno
        $rspsta = $alumno->desactivar($alumno_id);
        // Devolvemos un mensaje según el resultado de la operación
        echo $rspsta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
        break;

    case 'activar':
        // Llamamos al método activar de la clase alumno
        $rspsta = $alumno->activar($alumno_id);
        // Devolvemos un mensaje según el resultado de la operación
        echo $rspsta ? "Datos activados correctamente" : "No se pudo activar los datos";
        break;

    case 'mostrar':
        // Llamamos al método mostrar de la clase alumno
        $rspta = $alumno->mostrar($alumno_id);
        // Devolvemos el resultado como un objeto JSON
        echo json_encode($rspta);
        break;

    case 'listar':
        error_log("Entrando en el caso 'listar'");
        
        // Llamamos al método listar de la clase alumno
        $rspta = $alumno->listar();
        error_log("Resultado de listar: " . print_r($rspta, true));
        
        // Inicializamos un array para almacenar los datos
        $data = array();
        
        // Iteramos sobre los registros obtenidos y los almacenamos en el array
        while ($reg = $rspta->fetch_object()) {
            error_log("Procesando registro: " . print_r($reg, true));
            $data[] = array(
                "0" => ($reg->status) ?
                '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->alumno_id . ')"><i class="fa fa-pencil"></i></button>' .
                ' <button class="btn btn-danger btn-xs" onclick="desactivar(' . $reg->alumno_id . ')"><i class="fa fa-close"></i></button>' :
                '<button class="btn btn-warning btn-xs" onclick="mostrar(' . $reg->alumno_id . ')"><i class="fa fa-pencil"></i></button>' .
                ' <button class="btn btn-primary btn-xs" onclick="activar(' . $reg->alumno_id. ')"><i class="fa fa-check"></i></button>',
            "1" => htmlspecialchars($reg->nombre),
            "2" => htmlspecialchars($reg->apellidos),
            "3" => htmlspecialchars($reg->login),
            "4" => htmlspecialchars($reg->email),
            "5" => '****', // No se debe mostrar la contraseña
            "6" => htmlspecialchars($reg->codigo),
            "7" => htmlspecialchars($reg->telefono),
            "8" => ($reg->status) ? '<span class="label bg-green">Activado</span>' : '<span class="label bg-red">Desactivado</span>',
            "9" => htmlspecialchars($reg->carrera),
            "10" => htmlspecialchars($reg->area_de_conocimiento),
            "11" => '<img src="files/alumnos/' . htmlspecialchars($reg->imagen) . '" height="50" width="50" alt="Imagen de alumno">'
            );
        }
        
        error_log("Datos procesados: " . print_r($data, true));

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        
        error_log("Resultados finales: " . print_r($results, true));
        
        header('Content-Type: application/json');
        echo json_encode($results);
        exit();

        case 'verificar':
            try {
                // Validación de entrada
                $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
                $clavea = filter_input(INPUT_POST, 'clavea', FILTER_SANITIZE_STRING);
    
                if (!$login || !$clavea) {
                    throw new Exception("Datos de entrada inválidos");
                }
    
                // Hash SHA256 para la contraseña
                $clavehash = hash("SHA256", $clavea);
    
                // Llamamos al método verificar de la clase alumno
                $rspta = $alumno->verificar($login, $clavehash);
    
                // Verificamos si se encontró un alumno
                if ($rspta) {
                    $fetch = $rspta->fetch_object();
                    echo json_encode($fetch);
                } else {
                    echo json_encode(["error" => "Usuario no encontrado"]);
                }
    
            } catch (Exception $e) {
                // En caso de error, devolvemos un JSON con el mensaje de error
                echo json_encode(["error" => $e->getMessage()]);
            }
            break;

    case 'salir':
        session_unset();
        session_destroy();
        header("Location: /Programa/admin/index.php");
        break;

    default:
        echo json_encode(["error" => "Operación no válida"]);
        exit();
}

$output = ob_get_clean(); // Captura cualquier salida y limpia el búfer
if (!empty($output)) {
    file_put_contents(__DIR__ . 'debug_output.txt', $output); // Guarda la salida en un archivo de depuración
}

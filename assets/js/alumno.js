var tabla;

// Función que se ejecuta al inicio
function init() {
    mostrarform(true);
    listar();
    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });
}

// Función para limpiar los campos del formulario
function limpiar() {
    $("#nombre").val("");
    $("#apellidos").val("");
    $("#email").val("");
    $("#login").val("");
    $("#password").val("");
    $("#telefono").val("");
    $("#codigo").val("");
    $("#carrera").val("");
    $("#imagenmuestra").attr("src", "");
    $("#imagenactual").val("");
    $("#alumno_id").val("");
}

// Función para mostrar el formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").show();
        $("#formularioregistro").hide();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").show();
    } else {
        $("#listadoregistros").hide();
        $("#formularioregistro").show();
        $("#btnagregar").hide();
    }
}

// Función para cancelar el formulario
function cancelarform() {
    limpiar();
    mostrarform(true);
}

// Función para listar los registros
function listar() {
    tabla = $('#tbllistado').DataTable({
        "ajax": {
            url: 'controlador/Alumnos_controlador.php?op=listar',
            type: "GET",
            dataType: "json",
            dataSrc: function(json) {
                if (json.aaData) {
                    console.log("Datos recibidos (aaData):", json.aaData);
                    return json.aaData;
                } else {
                    console.error("Estructura de JSON incorrecta:", json);
                    bootbox.alert("Error en la estructura de datos. Por favor, verifica el servidor.");
                    return [];
                }
            },
            error: function(xhr, error, code) {
                console.error("Error al cargar datos:", error);
                console.error("Código de error:", code);
                console.error("Respuesta del servidor:", xhr.responseText);
                bootbox.alert("Ocurrió un error al cargar los datos. Por favor, inténtalo de nuevo.");
            }
        },
        "processing": true,
        "serverSide": true,
        // Otras opciones de configuración...
    });
}


// Función para guardar o editar
function guardaryeditar(e) {
    e.preventDefault(); // Evita la acción predeterminada del formulario

    // Validar campos obligatorios
    if ($("#nombre").val() === "" || $("#apellidos").val() === "" || $("#email").val() === "" || $("#login").val() === "") {
        bootbox.alert("Por favor, completa todos los campos obligatorios.");
        return;
    }

    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
        url: 'controlador/Alumnos_controlador.php?op=guardaryeditar',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            bootbox.alert(datos, function() {
                limpiar(); // Limpia solo después de un éxito
                mostrarform(false);
                tabla.ajax.reload();
            });
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
            bootbox.alert("Ocurrió un error. Por favor, inténtalo de nuevo.");
        }
    });
}

// Función para mostrar un registro por ID
function mostrar(alumno_id) {
    $.post("Alumnos_controlador.php?op=mostrar", { alumno_id: alumno_id }, function(data, status) {
        try {
            data = JSON.parse(data);
            mostrarform(true);
            $("#nombre").val(data.nombre);
            $("#apellidos").val(data.apellidos);
            $("#email").val(data.email);
            $("#login").val(data.login);
            $("#password").val(""); // Muestra vacío para la seguridad
            $("#codigo").val(data.codigo);
            $("#telefono").val(data.telefono);
            $("#carrera").val(data.carrera);
            $("#imagenmuestra").show();
            $("#imagenmuestra").attr("src", "/files/alumnos" + data.imagen);
            $("#imagenactual").val(data.imagen);
            $("#alumno_id").val(data.alumno_id);
        } catch (e) {
            console.error("Error al analizar JSON:", e);
            console.error("Respuesta del servidor:", data);
            bootbox.alert("Ocurrió un error al cargar los datos. Por favor, inténtalo de nuevo.");
        }
    });
}

// Función para desactivar un registro
function desactivar(alumno_id) {
    bootbox.confirm("¿Está seguro de desactivar este dato?", function(result) {
        if (result) {
            $.post("controlador/Alumnos_controlador.php?op=desactivar", { alumno_id: alumno_id }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

// Función para activar un registro
function activar(alumno_id) {
    bootbox.confirm("¿Está seguro de activar este dato?", function(result) {
        if (result) {
            $.post("controlador/Alumnos_controlador.php?op=activar", { alumno_id: alumno_id }, function(e) {
                bootbox.alert(e);
                tabla.ajax.reload();
            });
        }
    });
}

init(); // Aseguramos que la función init se ejecute al cargar el script

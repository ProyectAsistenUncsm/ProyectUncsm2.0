$("#frmAcceso").on('submit', function(e) {
    // Evita que el formulario se envíe de forma predeterminada
    e.preventDefault();
    // Obtiene los valores de los campos de entrada
    const login = $("#login").val();
    const clavea = $("#clavea").val();

    $.ajax({
        url: "/Alumnos_controlador.php?op=verificar",
        type: "POST",
        data: {
            "login": login,
            "clavea": clavea
        },
        dataType: 'json', // Cambia a 'json'
        success: function(data) {
            console.log("Respuesta del servidor:", data); // Imprime la respuesta completa
            
            if (data.error) {
                // Manejo de error si se devuelve un mensaje de error
                bootbox.alert(data.error);
            } else if (data) {
                // Lógica para manejar la respuesta exitosa
                switch (data.tipo) {
                    case "Alumno":
                        window.location.href = "/alumno.php";
                        break;
                    case "Maestro":
                        window.location.href = "/Programa/Admin/maestro/maestro.php";
                        break;
                    case "Empleado":
                        window.location.href = "/Programa/Admin/empleado/empleado.php";
                        break;
                    default:
                        bootbox.alert("Tipo de usuario no reconocido");
                }
            } else {
                bootbox.alert("Usuario y/o Password incorrectos");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error en la solicitud AJAX:", textStatus, errorThrown);
            console.log("Respuesta del servidor:", jqXHR.responseText);
            bootbox.alert("Error en la solicitud: " + textStatus);
        }
    });
});

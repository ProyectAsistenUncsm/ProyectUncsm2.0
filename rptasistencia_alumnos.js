function init() {

  listar();
  
  // Cargamos los items al select alumno
  $.post("Alumnos_controlador.php?op=select_alumno", function (response) {
    $("#alumno_id").html(response);
    $('#alumno_id').selectpicker('refresh'); // Refrescamos el selectpicker para que se actualicen los valores
  });
}

function listar() {
  tabla = $('#tbllistado').DataTable({
    "aProcessing": true, // Activamos el procesamiento del DataTable
    "aServerSide": true, // Paginación y filtrado realizados por el servidor
    dom: 'Bfrtip',       // Definimos los elementos de control de la tabla
    buttons: [
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdfHtml5'
    ],
    "ajax": {
      url: 'Asistencias_alumno_controlador.php',
      type: "GET",
      data: { op: 'listar' },
      dataType: "json",
      error: function(xhr, status, error) {
        console.log("Error en la solicitud AJAX:");
        console.log("Status: " + status);
        console.log("Error: " + error);
        console.log("Respuesta: " + xhr.responseText);
      }
    },
    "iDisplayLength": 10, // Paginación: cuántos registros mostrar
    "order": [[0, "desc"]] // Ordenar por la primera columna de forma descendente
  });
}



// Llamamos a la función init cuando el DOM esté listo
$(document).ready(function() {
  init();
});


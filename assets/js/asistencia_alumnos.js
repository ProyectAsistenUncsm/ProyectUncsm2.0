var tabla;
//funcion que se ejecuta al inicio
function init() {
  listar();
}
//funcion listar
function listar() {
  tabla = $('#tbllistado').dataTable({
    "aProcessing": true, // activamos el procedimiento del datatable
    "aServerSide": true, // paginación y filtrado realizados por el server
    dom: 'Bfrtip', // definimos los elementos del control de la tabla
    buttons: [
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdf'
    ],
    "ajax": {
      url: 'controlador/Asistencias_alumno_controlador.php',
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
    "bDestroy": true,
    "iDisplayLength": 10, // paginación
    "order": [[0, "desc"]] // ordenar (columna, orden)
  }).DataTable();
}

init();

<?php
require_once __DIR__ . '/conexion.php';


// Iniciamos sesión si aún no lo está
session_start();



require 'header.php';
?>
<title>Reporte de Asistencias de Alumnos</title>
<!--CONTENIDO -->
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="row">

      <div class="col-md-12">
        <div class="box">

          <!--box-header-->
          <div class="box-header with-border">
            <h1 class="box-title">Reporte de Asistencias de Alumnos por Fechas</h1>
            <div class="box-tools pull-right"></div>
          </div>
          <!--box-header-->

          <!--centro-->
          <!-- Formulario para seleccionar fechas y alumno -->
          <div class="panel-body table-responsive" id="listadoregistros">

            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <label>Fecha Inicio</label>
              <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d"); ?>">
            </div>

            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <label>Fecha Fin</label>
              <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d"); ?>">
            </div>

            <div class="form-inline col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Alumno</label>
              <select name="alumno_id" id="alumno_id" class="form-control selectpicker" data-live-search="true" required>
              </select>
              <br>
              <button class="btn btn-success" type="button" onclick="listar();">
                Mostrar
              </button>
            </div>

            <!-- Tabla para listar datos -->
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>#</th>
                <th>Código</th>
                <th>Nombre del Alumno</th>
                <th>Hora</th>
                <th>Fecha</th>
                <th>Tipo de Asistencia</th>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <th>#</th>
                <th>Código</th>
                <th>Nombre del Alumno</th>
                <th>Hora</th>
                <th>Fecha</th>
                <th>Tipo de Asistencia</th>
              </tfoot>
            </table>

          </div>
          <!--fin tabla para listar datos-->
        </div>
        <!--fin box-->
      </div>
    </div>
    <!-- fin Default-box -->

  </section>
  <!-- /.content -->

</div>
<!--FIN CONTENIDO -->

  <?php 
  require 'footer.php';
?>

<script src="rptasistencia_alumnos.js"></script>

<?php 
ob_end_flush();
?>

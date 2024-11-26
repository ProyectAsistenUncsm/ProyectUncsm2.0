<?php
ob_start();
session_start();

    require 'estructura/header.php';

?>
<title>Lista de Asistencias de Alumnos</title>
<!--CONTENIDO -->
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="row">

      <!-- /.col-md12 -->
      <div class="col-md-12">

        <!--fin box-->
        <div class="box">

          <!--box-header-->
          <div class="box-header with-border">
            <h1 class="box-title">Lista de Asistencias de Alumnos</h1>
            <div class="box-tools pull-right">
              
            </div>
          </div>
          <!--box-header-->

          <!--centro-->

          <!--tabla para listar datos-->
          <div class="panel-body table-responsive" id="listadoregistros">

            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Opciones</th>
                <th>codigo</th>
                <th>Nombre del Alumno</th>
                <th>Hora</th>
                <th>Fecha</th>
                <th>Tipo de Asistencia</th>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
              <th>Opciones</th>
              <th>codigo</th>
                <th>Nombre del Alumno</th>
                <th>Hora</th>
                <th>Fecha</th>
                <th>Tipo de Asistencia</th>
              </tfoot>   
            </table>

          </div>
          <!--fin tabla para listar datos-->

          <!--formulatio para datos-->

          <!--fin formulatio para datos-->

          <!--fin centro-->

        </div>
        <!--fin box-->

      </div>
      <!-- /.col-md12 -->

    </div>
    <!-- fin Default-box -->

  </section>
  <!-- /.content -->

</div>
<!--FIN CONTENIDO -->

<?php 
require 'estructura/footer.php';
 ?>

 <script src="assets/js/asistencia_alumnos.js"></script>
 <?php 
 ob_end_flush();
 ?>
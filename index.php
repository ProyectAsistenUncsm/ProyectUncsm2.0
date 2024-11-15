<?php
ob_start();
session_start();

// Incluir la cabecera
require 'header.php';
?>

<!-- CONTENIDO -->
<div class="content-wrapper">
    <title>Lista de Alumnos</title>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">

            <div class="col-md-12">
                <!-- fin box -->
                <div class="box">

                    <!-- box-header -->
                    <div class="box-header with-border">
                        <h1 class="box-title">Lista de Alumnos 
                            <button class="btn btn-success" onclick="mostrarform(false)" id="btnagregar">
                                <i class="fa fa-plus-circle"></i> Agregar
                            </button>
                        </h1>
                        <div class="box-tools pull-right"></div>
                    </div>
                    <!-- box-header -->

                    <!-- centro -->

                    <!-- tabla para listar datos -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Login</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Código</th>
                                    <th>Teléfono</th>
                                    <th>Status</th>
                                    <th>Carrera</th>
                                    <th>Area de conocimiento</th>
                                    <th>Imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se llenarán los datos mediante JavaScript -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Login</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Código</th>
                                    <th>Teléfono</th>
                                    <th>Status</th>
                                    <th>Carrera</th>
                                    <th>Area de conocimiento</th>
                                    <th>Imagen</th>
                                </tr>
                            </tfoot>   
                        </table>
                    </div>
                    <!-- fin tabla para listar datos -->

                    <!-- formulario para datos -->
                    <div class="panel-body" id="formularioregistro">
                        <form name="formulario" id="formulario" method="POST" enctype="multipart/form-data">
                            <div class="form-group col-lg-4 col-md-4 col-xs-12">
                                <label for="nombre">Nombre(*): </label>
                                <input class="form-control" type="hidden" name="alumno_id" id="alumno_id">
                                <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                            </div>

                            <div class="form-group col-lg-4 col-md-4 col-xs-12">
                                <label for="apellidos">Apellidos(*): </label>
                                <input class="form-control" type="text" name="apellidos" id="apellidos" maxlength="100" placeholder="Apellidos" required>
                            </div>

                            <div class="form-group col-lg-4 col-md-4 col-xs-12">
                                <label for="email">Email(*): </label>
                                <input class="form-control" type="email" name="email" id="email" maxlength="70" placeholder="Email" required>
                            </div>

                            <div class="form-group col-lg-4 col-md-4 col-xs-12">
                                <label for="login">Login(*): </label>
                                <input class="form-control" type="text" name="login" id="login" maxlength="20" placeholder="Nombre de Alumno" required>
                            </div>

                            <div class="form-group col-lg-4 col-md-4 col-xs-12">
                                <label for="password">Password(*): </label>
                                <input class="form-control" type="password" name="password" id="password" maxlength="64" placeholder="Password" required>
                            </div>

                            <div class="form-group col-lg-4 col-md-4 col-xs-12">
                                <label for="codigo">Cédula(*): </label>
                                <input class="form-control" type="text" name="codigo" id="codigo" maxlength="64" placeholder="Cédula" required>
                            </div>

                            <div class="form-group col-lg-4 col-md-4 col-xs-12">
                                <label for="telefono">Teléfono(*): </label>
                                <input class="form-control" type="text" name="telefono" id="telefono" maxlength="20" placeholder="999999999" required>
                            </div>

                            <div class="form-group col-lg-4 col-md-4 col-xs-12">
                                <label for="carrera">Carrera(*): </label>
                                <input class="form-control" type="text" name="carrera" id="carrera" maxlength="64" placeholder="Carrera" required>
                            </div>
                            
                            <div class="form-group col-lg-4 col-md-4 col-xs-12">
                                <label for="area_de_conocimiento">Area de Conocimiento(*): </label>
                                <input class="form-control" type="text" name="area_de_conocimiento" id="carrera" maxlength="64" placeholder="Carrera" required>
                            </div>

                            <div class="form-group col-lg-4 col-md-4 col-xs-12">
                                <label for="">Imagen(*): </label>
                                <input class="form-control filestyle" data-buttonText="Seleccionar Foto" type="file" name="imagen" id="imagen" required>
                                <input type="hidden" name="imagen_actual" id="imagen_actual">
                                <img src="" alt="" width="150px" height="120" id="imagenmuestra">
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                                <button class="btn btn-danger" onclick="cancelarform()" type="button" id="btnCancelar"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                            </div>
                        </form>
                    </div>
                    <!-- fin formulario para datos -->

                </div>
                <!-- fin box -->
            </div>
            <!-- /.col-md12 -->

        </div>
        <!-- fin Default-box -->

    </section>
    <!-- /.content -->

</div>
<!-- FIN CONTENIDO -->

<?php 
// Incluir el pie de página
require 'footer.php';
?>

<!-- Incluir el script para manejar la lógica -->
<script src="alumno.js"></script>

<?php 
ob_end_flush(); 
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="/public/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/public/css/font-awesome.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/public/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/public/css/_all-skins.min.css">
  <link rel="apple-touch-icon" href="/public/img/apple-touch-icon.png">
  <link rel="shortcut icon" href="https:/scontent-mia3-2.xx.fbcdn.net/v/t39.30808-6/400595656_122104794320107964_4772515281726951398_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=jSkJxRM5O0wQ7kNvgE_XNr2&_nc_ht=scontent-mia3-2.xx&_nc_gid=Ab0e9xLXh7DvElKCp-VA8PP&oh=00_AYAdoMN3ob8jhV84PHeos9nGIqjOfqbQ66B5DMaGMfQBbQ&oe=66F9231F">

  <!-- DATATABLES -->
  <link rel="stylesheet" type="text/css" href="/public/datatables/jquery.dataTables.min.css">
  <link rel="stylesheet" href="/public/datatables/buttons.dataTables.min.css">
  <link rel="stylesheet" href="/public/datatables/responsive.dataTables.min.css">

  <link rel="stylesheet" type="text/css" href="/public/css/bootstrap-select.min.css">

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>UNCSM</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Navegación</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="/files/alumnos/<?php echo $_SESSION['imagen']; ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="/files/alumnos/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image">

                  <p>
                    CompartiendoCódigos - Desarrollo web
                    <small>2021-2022</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Perfil</a>
                  </div>
                  <div class="pull-right">
                    <a href="Alumnos_controlador.php?op=salir" class="btn btn-default btn-flat">Salir Alumno</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->

          </ul>
        </div>
        
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

          <li><a href="escritorio.php"><i class="fa  fa-dashboard (alias)"></i> <span>Escritorio</span></a></li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-list"></i> <span>Asistencias</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">

              <li><a href="asistencia_alumnos.php"><i class="fa fa-circle-o"></i> Asistencias de Alumnos</a></li>

              <li class="treeview">
                <a href="#">
                  <i class="fa fa-list"></i> <span>Reportes</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">

                  <li><a href="rptasistencia_alumnos.php"><i class="fa fa-circle-o"></i> Reporte de Alumnos</a></li>
                </ul>
              </li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-users"></i> <span>Usuarios</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="index.php"><i class="fa fa-circle-o"></i> Alumnos</a></li>
            </ul>
          </li>

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

  </div>
</body>
</html>

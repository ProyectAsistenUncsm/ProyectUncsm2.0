<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <link rel="stylesheet" href="../public/css/bootstrap.min.css">
  <link rel="stylesheet" href="../public/css/font-awesome.css">
  <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../public/css/blue.css">
  <link rel="shortcut icon" href="../public/img/favicon.ico">
  <link rel="stylesheet" href="../public/css/_all-skins.min.css">

  <script src="/assets/plugins/qrCode.min.js"></script>

  <style>
    #preview {
      width: 80%;
      margin: auto;
    }
    .main-footer {
      position: fixed;
      bottom: 0;
      width: 100%;
    }
  </style>
  <title>Asistencia</title>
</head>
<body class="hold-transition skin-blue layout-top-nav">
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../../index2.html" class="navbar-brand"><b>UNCSM</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class=""><a href="../admin">ADMIN</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <div class="container text-center">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-xs-12">
<h5 class="text-center">Escanear codigo QR</h5>
      <div class="row text-center">
        <a id="btn-scan-qr" href="#">
          <img src="https://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg" class="img-fluid text-center" width="175">
        <a>
        <canvas hidden="" id="qr-canvas" class="img-fluid"></canvas>
        </div>
        <div class="row mx-5 my-3">
        <button class="btn btn-success btn-sm rounded-3 mb-2" onclick="encenderCamara()">Encender camara</button>
        <button class="btn btn-danger btn-sm rounded-3" onclick="cerrarCamara()">Detener camara</button>
      </div>

      


    </div>
  </div>

  

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.0.1.1
    </div>
    <strong>Copyright &copy; 2024-2025 <a target="_blank" href="">Universidad Nacional Casimiro Sotelo Montenegro</a></strong> Todos los derechos reservados.
  </footer>

  <script src="../public/js/jquery-3.1.1.min.js"></script>
  <script src="../public/js/bootstrap.min.js"></script>
    <audio id="audioScaner" src="/assets/sonido.mp3"></audio>
  <script src="/assets/js/qr.js"></script>
</body>
</html>


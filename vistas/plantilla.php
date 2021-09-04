<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Taller | Santo Domingo</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.css">
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="shortcut icon" href="vistas/img/mecanico.png" type="image/x-icon">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
  <script src="vistas/bower_components/jquery/dist/jquery.js"></script>
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.js"></script>
  <script src="vistas/bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  <script src="vistas/dist/js/adminlte.js"></script>
  <script src="vistas/dist/js/demo.js"></script>
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
  <style>
    .bc {
      background: #222d32;
      background-color: #222d32;
      color: white;
    }

    .bc:hover,
    .bc:active,
    .bc::before,
    .bc::after,
    .bc:focus {
      background-color: #222d32;
      color: white;
    }

    .swal2-popup {
      font-size: 1.2em !important;
    }
  </style>
</head>

<body class="hold-transition skin-black sidebar-collapse sidebar-mini login-page">

  <?php
  if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
    echo '<div class="wrapper">';
    include 'vistas/modulos/cabezote.php';
    include 'vistas/modulos/menu.php';
    if (isset($_GET['ruta'])) {
      if (
        $_GET['ruta'] == 'inicio' ||
        $_GET['ruta'] == 'usuarios' ||
        $_GET['ruta'] == 'clientes' ||
        $_GET['ruta'] == 'ventas' ||
        $_GET['ruta'] == 'crear-venta' ||
        $_GET['ruta'] == 'reportes' ||
        $_GET['ruta'] == 'salir'
      ) {
        include 'vistas/modulos/' . $_GET['ruta'] . '.php';
      } else {
        include 'vistas/modulos/404.php';
      }
    } else {
      include 'vistas/modulos/inicio.php';
    }
    include 'vistas/modulos/footer.php';
    echo '</div>';
  } else {
    include 'vistas/modulos/login.php';
  };
  ?>
  <script src="vistas/js/plantilla.js"></script>
  <script src="vistas/js/usuarios.js"></script>
  <script src="vistas/plugins/sa2/sweetalert2.all.js"></script>
</body>

</html>
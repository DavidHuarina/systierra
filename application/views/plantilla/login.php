<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="apps/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="apps/assets/img/ft.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="google-site-verification" content="-zaEBt2oiX31hmc-eEbWxDM8sF_qWoj-J3UmlcQWBQk" />
  <title>
    SIS-TIERRA
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="apps/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="apps/assets/css/now-ui-dashboard.css?v=1.2.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="apps/assets/demo/demo.css" rel="stylesheet" />
  <link href="apps/css/micss.css" rel="stylesheet" />
</head>

<body class="offline-doc">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent  bg-danger  navbar-absolute">
    <div class="container">
      <div class="navbar-wrapper">
        <div class="navbar-toggle">
          <button type="button" class="navbar-toggler">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
          </button>
        </div>
        <a class="navbar-brand" href="#">TIERRA</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" target="_blank" href="http://www.ftierra.org/index.php">
              Ir a pagina web
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cregister2">
              Registrarme
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="page-header clear-filter" filter-color="blue">
    <div class="page-header-image" style="background-image: url('apps/assets/img/417933.jpg');"></div>
    <div class="container text-center">
      <div class="col-md-8 ml-auto mr-auto">
        <div class="brand">
          <h1 class="title">
            SysTierra
          </h1>
          <h3 class="description">Version v1.1.1</h3>
          <br/>
              <form action="" onsubmit="validateLogin(); return false;" method="POST">
                 <center>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" id="usuario" class="form-control input-gray" value="" placeholder="Usuario o Correo">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Clave</label>
                        <input type="password" id="contrasena" class="form-control input-gray" placeholder="Clave" value="">
                      </div>
                    </div>
                </center>
                <input type="submit" class="btn btn-secondary btn-round btn-lg" value="Ingresar al sistema">
              </form>
          <div id="mensaje"></div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer d-md-flex d-lg-flex d-none">
    <div class="container">
      <nav>
        <ul>
          <li>
            <a href="#">
              DHSoft
            </a>
          </li>
          <li>
            <a href="#">
              Acerca de
            </a>
          </li>
          <li>
            <a href="#">
              Blog
            </a>
          </li>
        </ul>
      </nav>
      <div class="copyright" id="copyright">
        &copy;
        <script>
          document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
        </script>, Creado por
        <a href="#" target="_blank">David Huarina</a>. En base a
        <a href="#" target="_blank">Now UI</a>.
      </div>
    </div>
  </footer>
  <!--   Core JS Files   -->
  <script src="apps/assets/js/core/jquery.min.js"></script>
  <script src="apps/assets/js/core/popper.min.js"></script>
  <script src="apps/assets/js/core/bootstrap.min.js"></script>
  <script src="apps/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="apps/assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="apps/assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="apps/assets/js/now-ui-dashboard.min.js?v=1.2.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="apps/assets/demo/demo.js"></script>

  <!-- Mis funciones-->
  <script src="apps/js/funciones.js"></script>
</body>

</html>
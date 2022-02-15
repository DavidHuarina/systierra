<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="apps/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="apps/assets/img/ft.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
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
  <link rel="stylesheet" href="apps/plugins/datepicker/css/datepicker.css" />
  <link rel="stylesheet" href="apps/plugins/chosen/chosen.min.css" />
  

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="apps/assets/demo/demo.css" rel="stylesheet" />
  <link href="apps/css/micss.css" rel="stylesheet" />
</head>

<body class="offline-doc">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent  bg-primary  navbar-absolute">
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
            <a class="nav-link" href="login">
              Iniciar sesi&oacute;n
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="page-header clear-filter" filter-color="orange">
    <div class="page-header-image" style="background-image: url('apps/assets/img/f_1.jpg');"></div>
    <div class="container text-center">
      <div class="col-md-8 ml-auto mr-auto">
        <div class="brand">
            <h3 class="description">Registro</h3>          
              <form action="#" method="POST">
                 <center>
                  <div class="row">
                   <div class="col-md-6"> 
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" id="nombre_u" class="form-control input-gray" value="" placeholder="Nombre">
                      </div>
                      
                      <div class="form-group">
                        <label>Sexo</label>
                        <select id="sexo" name="sexo" class="form-control input-gray select-single-plantilla">
                          <option value="1">Hombre</option>
                          <option value="2">Mujer</option>
                        </select>
                      </div>
                   </div> 
                   <div class="col-md-6">
                     <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" id="apellido_u" class="form-control input-gray" value="" placeholder="Apellido">
                      </div>
                      <div class="form-group">
                        <label>Fecha de nacimiento</label>
                    <input type="text" class="form-control input-gray" id="fnac_u" placeholder="Ej: dd/mm/aaaa">
                      </div>
                   </div> 
                  </div>

                      <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" class="form-control" id="usuario_u"placeholder="Usuario" required>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label>Clave</label>
                        <input type="password" class="form-control" id="contra_u"placeholder="Contrase&ntilde;a" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Confirmar clave</label>
                        <input type="password" class="form-control" id="contrac_u"placeholder="Confirmar Contrase&ntilde;a" required>
                      </div>
                    </div>
                      </div>  
                </center>
                <input type="button" class="btn btn-primary btn-round btn-lg" onclick="validateRegister();" value="Enviar datos">
              </form>
          <div id="mensajeR"></div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer">
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
  <script src="apps/plugins/chosen/chosen.jquery.min.js"></script>
  <script src="apps/plugins/datepicker/js/bootstrap-datepicker.js"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="apps/assets/demo/demo.js"></script>

  <!-- Mis funciones-->
  <script src="apps/js/funciones.js"></script>
</body>

</html>
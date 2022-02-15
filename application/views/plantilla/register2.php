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
  <link rel="stylesheet" type="text/css" href="apps/plugins/circle/css/demo.css" />
  <link rel="stylesheet" type="text/css" href="apps/plugins/circle/css/common.css" />
  <link rel="stylesheet" type="text/css" href="apps/plugins/circle/css/style4.css" />

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
  <div class="page-header clear-filter" filter-color="verde">
    <div class="page-header-image" style="background-image: url('apps/assets/img/yun.jpeg');"></div>
    <div class="container text-center">
      <div id="opciones_reg">
        <h3 class="description">ESCOJA UNA REGIONAL</h3>
      <ul class="ch-grid">
        <li>
            <div class="ch-item ch-img-4">
              <div class="ch-info-wrap">
                <div class="ch-info">
                  <div class="ch-info-front ch-img-4"></div>
                  <div class="ch-info-back">
                    <h3>OFICINA NACIONAL</h3>
                    <p>La Paz <a href="#" onclick="setearSel(1003,'OFICINA NACIONAL','apps/plugins/circle/images/14.gif')">Seleccionar</a></p>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="ch-item ch-img-1">        
              <div class="ch-info-wrap">
                <div class="ch-info">
                  <div class="ch-info-front ch-img-1"></div>
                  <div class="ch-info-back">
                    <h3>REGIONAL ALTIPLANO</h3>
                    <p>La Paz <a href="#" onclick="setearSel(1000,'REGIONAL ALTIPLANO','apps/plugins/circle/images/11.jpg')">Seleccionar</a></p>
                  </div>  
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="ch-item ch-img-2">
              <div class="ch-info-wrap">
                <div class="ch-info">
                  <div class="ch-info-front ch-img-2"></div>
                  <div class="ch-info-back">
                    <h3>REGIONAL VALLES</h3>
                    <p>Sucre <a href="#" onclick="setearSel(1002,'REGIONAL VALLES','apps/plugins/circle/images/12.jpg')">Seleccionar</a></p>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="ch-item ch-img-3">
              <div class="ch-info-wrap">
                <div class="ch-info">
                  <div class="ch-info-front ch-img-3"></div>
                  <div class="ch-info-back">
                    <h3>REGIONAL ORIENTE</h3>
                    <p>Santa Cruz <a href="#" onclick="setearSel(1003,'REGIONAL ORIENTE','apps/plugins/circle/images/13.jpg')">Seleccionar</a></p>
                  </div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div> 
      <div id="menu_register" class="col-md-8 ml-auto mr-auto" style="display:none">

        <div class="brand">
            <h3 class="description"><label id="titulo_label"></label><img id="my_image" src="" class="img-thumbnail float-left" width="60" height="60"></h3>
              <h3 class="description">Nuevo Usuario</h3>
              <form action="#" method="POST">
                 <center>
                  <div class="form-group">
                        <input type="hidden" id="reg_i" name="reg_i">
                      </div>
                  <div class="row">
                   <div class="col-md-6"> 
                      <div class="form-group">
                        <label>Nombres</label>
                        <input type="text" id="nombre_u" name="nombre_u" class="form-control input-gray" value="" placeholder="Nombre">
                      </div>
                      
                      <div class="form-group">
                        <label>Sexo</label>
                        <select id="sexo" name="sexo" class="form-control input-gray">
                          <option value="1">Hombre</option>
                          <option value="2">Mujer</option>
                        </select>
                      </div>
                   </div> 
                   <div class="col-md-6">
                     <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" id="apellido_u" name="apellido_u"class="form-control input-gray" value="" placeholder="Apellido">
                      </div>
                      <div class="form-group">
                        <label>Fecha de nacimiento</label>
                    <input type="text" class="form-control input-gray" id="fnac_u" name="fnac_u" placeholder="Ej: dd/mm/aaaa">
                      </div>
                   </div> 
                  </div>

                      <div class="form-group">
                        <label>Correo</label>
                        <input type="text" class="form-control input-gray" id="correo" name="correo"placeholder="correo@gmail.com">
                      </div>  
                </center>
                <input type="button" class="btn btn-primary btn-round btn-lg" onclick="validateRegister2();" value="Enviar datos">
              </form>
              <a class="float-left btn btn-info" href="">Volver</a>
          <div id="mensajeR"></div>
        </div>
      </div>
    </div>
  </div>

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
  <script type="text/javascript" src="apps/plugins/circle/js/modernizr.custom.79639.js"></script> 
</body>

</html>
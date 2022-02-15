<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Autenticaci&oacute;n de usuario</title>
  <!-- plugins:css -->
        <link rel="icon" type="image/png" href="imagenes/logoBo.gif"/>
        <link rel="stylesheet" href="apps/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="apps/vendors/iconfonts/ti-icons/css/themify-icons.css">
        <link rel="stylesheet" href="apps/vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="apps/vendors/css/vendor.bundle.addons.css">
        <link rel="stylesheet" type="text/css" href="apps/datatables/dataTables.bootstrap4.css">
        <link rel="stylesheet" href="apps/vendors/iconfonts/font-awesome/css/font-awesome.min.css" />
        <link rel="stylesheet" href="apps/datepicker/css/datepicker.css" />
        <link rel="stylesheet" href="apps/chosen/chosen.min.css" />
        <link rel="stylesheet" href="apps/tagsinput/jquery.tagsinput.css" />
        <link rel="stylesheet" type="text/css" href="apps/micss.css">
        <link rel="stylesheet" href="apps/css/style.css">
        <link rel="stylesheet" href="apps/jscrollpane/css/jquery.jscrollpane.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="apps/css/style.css">
  <link rel="stylesheet" href="apps/micss.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <h2 class="text-center mb-4">Registrar</h2>
            <div class="auto-form-wrapper">
              <form action="#">
                <center>
                  <img src="imagenes/autenticacion/ftierra_logo_p.png" class="logo-login">
                </center>
                <br>
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" id="nombre_u"placeholder="Nombre" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" id="apellido_u"placeholder="Apellido" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" id="correo_u"placeholder="Correo">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                    <select id="sexo" name="sexo" class="form-control select-single-plantilla">
                      <option value="1">Hombre</option>
                      <option value="2">Mujer</option>
                    </select>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" id="fnac_u" placeholder="Fecha de nacimiento (dd-mm-yyyy) Ej: 10/07/1994">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <hr class="hr">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" id="usuario_u"placeholder="Usuario" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <input type="password" class="form-control" id="contra_u"placeholder="Contrase&ntilde;a" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <input type="password" class="form-control" id="contrac_u"placeholder="Confirmar Contrase&ntilde;a" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" checked> Acepto los t&eacute;rminos
                    </label>
                  </div>
                </div>
                <div id="mensajeR"></div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block"onclick="validateRegister();">Registrar</button>
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Ya tienes una cuenta ?</span>
                  <a href="login" class="text-black text-small">Iniciar sesi&oacute;n</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <!-- container-scroller -->
    <script src="apps/jquery/jquery.min.js"></script>
    <script src="apps/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="apps/datatables/jquery.dataTables.js"></script>
    <script src="apps/datatables/dataTables.bootstrap4.js"></script>
    <script src="apps/funciones/funcionesAjax.js"></script>
    <script src="apps/jscrollpane/js/jquery.jscrollpane.min.js"></script>

    <script src="apps/datepicker/js/bootstrap-datepicker.js"></script>
    
    <script src="apps/tagsinput/jquery.tagsinput.min.js"></script>
    <script src="apps/chosen/chosen.jquery.min.js"></script>

    <script src="apps/datepicker.js"></script>
    <script src="apps/mijs.js"></script>
    <script src="apps/js/off-canvas.js"></script>
  <script src="apps/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="apps/js/dashboard.js"></script>
  <!-- endinject -->
</body>

</html>	

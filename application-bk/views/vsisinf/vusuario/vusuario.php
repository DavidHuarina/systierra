<div class="panel-header-sm bg-cafe-claro">
</div>
<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Mi Perfil <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a></h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="title text-center">Informaci&oacute;n Personal</p>
                    <table>
                         <tr><td><label>Nombre:</label></td><td><label class="text-lg text-dark"><?=$nombreUsuario?> <?=$apellidos_usuario?></label></td></tr>
                         <tr><td><label>Direccion:</label></td><td><label class="text-lg text-dark"><?=$direccion?></label></td></tr>
                         <tr><td><label>Correo:</label></td><td><label class="text-lg text-dark"><?=$correo_usuario?></label></td></tr>
                         <tr><td><label>Fecha de Nacimiento:</label></td><td><label class="text-lg text-dark"><?=strftime('%d de %B de %Y',strtotime($fnac_usuario))?></label></td></tr>
                         <tr><td><label>Usuario:</label></td><td><label class="text-lg text-dark"><?=$usuario?></label></td></tr>
                         <tr><td><label>Telefono:</label></td><td><label class="text-lg text-dark">+591 <?=$telefono_usuario?></label></td></tr>
                    </table> <br>
                    <a href="cusuario_edit" class="btn btn-primary"><i class=""></i> Editar datos del perfil</a>
                    <a href="cusuario_editC" class="btn btn-warning float-right"><i class=""></i> Cambiar Contraseña</a>
                  </div>
                  <div class="col-md-4">
                    <div class="float-right">
                      <p class="title text-center"><?=$nombreUsuario?></p>
                     <center><h5 class=""><img class="" src="<?=$imagen_usuario?>" width="200" alt="images"></h5></center>
                     <hr>
                     <p class="description text-center"><?=$sobre_mi?></p>
                     <div class="card-body">
                <p class="text-muted">Escoja un avatar</p><hr>
                <?php 
                    for ($i=0; $i<62; $i++) { 
                      ?><a onclick="" href="cusuario_editC/cambiar_avatar/<?=$i+1?>" class="avatar-sel"><img class="icon-sm" src="imagenes/storage/users/avatars/<?=$i+1?>.png" alt="images"></a><?php
                    }
                ?>
              </div>
                     <center>
                       <div class="button-container">
                         <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                           <i class="fa fa-facebook-f"></i>
                         </button>
                         <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                           <i class="fa fa-twitter"></i>
                         </button>
                         <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                           <i class="fa fa-google-plus-g"></i>
                         </button>
                         </div>
                       </center>
                     </div>
                   </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-8 pr-1">
                      <div class="form-group">
                        <label>Sobre mi</label><br>
                      </div>
                      <label class="text-lg text-dark"><?=$sobre_mi?></label>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
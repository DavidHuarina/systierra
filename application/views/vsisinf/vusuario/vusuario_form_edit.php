<div class="bg-cafe-claro panel-header-sm">
</div>
<div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Editar Perfil <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a></h5>
              </div>
              <div class="card-body">
                <form action="cusuario_edit/edit_u" class="validate-form" method="POST">
                  <div class="row">
                    <div class="col-md-3 pr-1">
                      <div class="form-group">
                        <label>Cargo (disabled)</label>
                        <input type="text" class="form-control" disabled="" placeholder="Company" value="<?=$cargo_usuario?>">
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" class="form-control" readonly placeholder="Username" value="<?=$usuario?>">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group validate-input" data-validate="Ingrese su Email">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" id="correo_u" name="correo_u" readonly class="form-control" placeholder="ejemplo@eje.com" value="<?=$correo_usuario?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group validate-input" data-validate="Ingrese su nombre">
                        <label>Nombre</label>
                        <input type="text" id="nombre_u" name="nombre_u" class="form-control" placeholder="Company" value="<?=$nombreUsuario?>">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group validate-input" data-validate="Ingrese su apellido">
                        <label>Apellido</label>
                        <input type="text" class="form-control" id="apellido_u" name="apellido_u" placeholder="Last Name" value="<?=$apellidos_usuario?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Direcci&oacute;n</label>
                        <input type="text" class="form-control" id="dir_u" name="dir_u" placeholder="Zona, calle, Ciudad" value="<?=$direccion?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Categoria</label>
                        <input type="text" class="form-control" id="cat" name="cat" readonly placeholder="City" value="<?=$rol?>">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group validate-input" data-validate="Error en la fecha">
                        <label>Fecha de nacimiento</label>
                        <input type="text" class="form-control"id="fi_p" name="fi_p" placeholder="Ej: dd/mm/aaaa" value="<?=strftime('%d/%m/%Y',strtotime($fnac_usuario))?>">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Telefono</label>
                        <input type="text" class="form-control" id="telefono_u" name="telefono_u" placeholder="telefono" value="<?=$telefono_usuario?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Sobre m&iacute;</label>
                        <textarea rows="4" cols="80" id="sobre" name="sobre" class="form-control" placeholder="Ingrese una descripci&oacute;n aqu&iacute;" value=""><?=$sobre_mi?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="float-left">
                      <a href="cusuario" class="btn btn-danger">Cancelar</a>
                    </div>
                  <div class="float-right">
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="apps/assets/img/fondo_u.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="<?=$imagen_usuario?>" alt="images">
                    <h5 class="title"><?=$nombreUsuario?> <?=$apellidos_usuario?></h5>
                  </a>
                  <p class="description">
                    <?=$usuario?>
                  </p>
                </div>
                <p class="description text-center">
                  <?=$sobre_mi?>
                </p>
                <form action="cusuario_editC/editar_imagen" method="post" enctype="multipart/form-data">
                <input id="imagen_u" name="imagen_u" onchange="cambiar()" type="file" accept="image/*" style="display:none !important;">   
                        <label class="btn btn-warning text-white float-right" for="imagen_u"><i class="now-ui-icons design_image"></i> Subir foto</label>
                        
                <button type="submit" onclick="" class="btn btn-primary"><i class="now-ui-icons ui-1_send"></i> Guardar</button>
                <div id="info"></div>
                </form>
              </div>
              <hr>
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
              <div class="card-body">
                <p class="text-muted">&oacute; Escoja un avatar</p><hr>
                <?php 
                    for ($i=0; $i<62; $i++) { 
                      ?><a onclick="" href="cusuario_editC/cambiar_avatar/<?=$i+1?>" class="avatar-sel"><img class="icon-sm" src="imagenes/storage/users/avatars/<?=$i+1?>.png" alt="images"></a><?php
                    }
                ?>
              </div>
              
            </div>
          </div>
        </div>
      </div>
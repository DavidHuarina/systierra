<div class="bg-cafe-claro panel-header-sm">
</div>

       <div class="content"><!--principio de Panel-->
          <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                <h5 class="title">Cambiar contraseña <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a></h5>
              </div>
                <div class="card-body">
                  <p class="card-description">
                    Los campos marcados con <b class="text-danger"> * </b> son obligatorios
                  </p>
                  <form action="#"class="forms-sample">
                    <div class="form-group">
                      <label for="usuario_u">Usuario</label>
                      <input type="text" class="form-control" id="usuario_u" value="<?=$usuario?>"placeholder="Usuario"  disabled>
                    </div>
                    <div class="form-group">
                      <label for="rol_u">Categoria</label>
                      <input type="text" class="form-control" id="rol_u" value="<?=$rol?>" disabled>
                    </div>
                    <div class="form-group">
                      <label for="contra_a_u">Contrase&ntilde;a actual <b class="text-danger"> * </b></label>
                      <input type="password" class="form-control" id="contra_a_u">
                    </div>
                    <div class="form-group">
                      <label for="contra_n_u">Contrase&ntilde;a nueva <b class="text-danger"> * </b></label>
                      <input type="password" class="form-control" id="contra_n_u">
                    </div>
                    <div class="form-group">
                      <label for="contra_nr_u">Repetir contrase&ntilde;a nueva <b class="text-danger"> * </b></label>
                      <input type="password" class="form-control" id="contra_nr_u">
                    </div>
                    <div id="mensajeC"></div>
                    <div class="float-left">
                      <a href="cusuario" class="btn btn-danger">Cancelar</a>
                    </div>
                    <div class="float-right">
                      <button class="btn btn-warning">Limpiar</button>
                      <button onclick="editarUContra();" class="btn btn-primary">Guardar</button>
                    </div>                    
                  </form>
                </div>
              </div>
            </div>
        </div><!-- fin panel-->
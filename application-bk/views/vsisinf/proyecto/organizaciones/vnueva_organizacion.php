<div class="panel-header-sm bg-plomo">
</div>
<div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Nueva Organizacion <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a></h5>
              </div>
              <div class="card-body">
                <form action="corganizacion/norg" method="POST" class="validate-form">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group validate-input" data-validate="Campo requerido">
                        <label>Nombre de la organizaci&oacute;n</label>
                        <input name="nombre_o" type="text" class="form-control" placeholder="Ingrese el nombre de la organizacion" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group validate-select" data-validate="Seleccione">
                        <label>Tipo</label>
                        <select id="select-org" name="select-org" class="form-control select-single-plantilla" onchange="cargarProvincia(this.value)">
                              <option value="0">Tipo</option>
                              <?php
                               foreach ($tipo->result() as $tip) {
                                ?><option value="<?=$tip->id_tipo_org?>"><?=$tip->descripcion?></option><?php
                               }
                              ?>
                            </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Descripci&oacute;n</label>
                        <textarea name="des_o" rows="4" cols="80" class="form-control" placeholder="Ingrese una descripci&oacute;n aqu&iacute;" value=""></textarea>
                      </div>
                    </div>
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
                <img src="apps/assets/img/orga.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="apps/full-icon/flat/social/009-connection-1.png" alt="images">
                    <h5 class="title">Organizaciones</h5>
                  </a>
                  <p class="description text-dark">
                    <?=$norgtot->num?>
                  </p>
                </div>
                <p class="description text-center">
                  Una organización es un sistema diseñado para alcanzar ciertas metas y objetivos. Estos sistemas pueden, a su vez, estar conformados por otros subsistemas relacionados que cumplen funciones específicas.
                </p>
                <hr>
                <small class="description text-center">Fuente: https://definicion.de/organizacion/</small>
              </div>
            </div>
          </div>
        </div>
      </div>
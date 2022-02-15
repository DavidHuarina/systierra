<div class="panel-header-sm bg-azul-oscuro">
</div>
<div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Lista de comunidades <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a></h5>
              </div>
              <div class="card-body">
                <form action="ccomun/lista" method="POST" class="validate-form">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group validate-select" data-validate="Seleccione">
                        <label>Departamento</label>
                        <select id="select-dep" name="select-dep" class="form-control select-single-plantilla" onchange="cargarProvincia(this.value)">
                              <option value="0">Departamento</option>
                              <?php
                               foreach ($departamento->result() as $dept) {
                                ?><option value="<?=$dept->dep_id?>"><?=$dept->dep_des?></option><?php
                               }
                              ?>
                            </select>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group validate-select" data-validate="Seleccione">
                        <label>Provincia</label>
                        <select id="select-prov" name="select-prov" class="form-control select-single-plantilla" onchange="cargarMunicipio(this.value)">
                            <option value="0">Provincia</option>
                            </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group validate-select" data-validate="Seleccione">
                        <label>Municipio</label>
                         <select id="select-mun" name="select-mun" class="form-control select-single-plantilla">
                            <option value="0">Municipio</option>
                            </select>
                      </div>
                    </div>
                  </div>
                  <div class="float-right">
                      <button type="submit" class="btn btn-warning">Listar Comunidades</button>
                    </div>
                    <div class="float-left">
                      <a href="ccomunidad" class="btn btn-primary">Nueva Comunidad</a>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="apps/assets/img/flores.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="apps/full-icon/flat/campos/036-village.png" alt="images">
                    <h5 class="title">Comunidades</h5>
                  </a>
                  <p class="description text-dark">
                    <?=$ncomtot->num?>
                  </p>
                </div>
                <p class="description text-center">
                  Una comunidad es un conjunto de individuos, ya sea humano o animal, que tienen en común diversos elementos, como el territorio que habitan, las tareas, los valores, los roles, el idioma o la religión.
                </p>
                <hr>
                <small class="description text-center">Fuente: https://concepto.de/comunidad/#ixzz5fFa7wXds</small>
              </div>
            </div>
          </div>
        </div>
      </div>
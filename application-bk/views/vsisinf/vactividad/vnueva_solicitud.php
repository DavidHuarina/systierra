<div class="panel-header panel-header-sm">
</div>
<div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><img class="icon-sm" src="apps/full-icon/flat/negocio/change.png" alt="images"> Solicitud de Fondos<a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a>
                </h5>
                
              </div>
              <div class="card-body">
                <form autocomplete="off" action="cenviar_solicitud/agregar?id=<?=$proy->id_proyecto?>&ac=<?=$actividad->act_id?>" class="validate-form" method="post">
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group validate-select" data-validate="Seleccione un Destinatario">
                          <label>Dirigida a:</label>
                            <select id="select-act_ml" name="select-act_ml" data-placeholder="Seleccione un destinatario" class="form-control select-plantilla">
                              <option value="0">Ninguno</option>
                              <?php foreach ($receptores->result() as $per) {
                                ?><option value="<?=$per->id_usuario?>"><?=$per->nombre_persona?> <?=$per->apellido_persona?></option><?php
                              }?>
                            </select>
                         </div>
                    </div>
                  </div>
                
                  <hr class="hr"></hr>                  
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
                <img src="apps/assets/img/money.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="apps/full-icon/flat/negocio/change.png" alt="images">
                    <h5 class="title">Solicitud de Fondos</h5>
                  </a>
                  <p class="description">
                    Para enviar una solicitud primero debe tener registrada una actividad referida a un proyecto especifico
                  </p>
                </div>
                <p class="description text-center">
                  Solicitud de Fondos
                </p>
                
              </div>
            </div>
          </div>
        </div>
      </div>

      
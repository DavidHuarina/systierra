<div class="panel-header panel-header-sm">
   </div>
<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Fondo <a class="float-right" href="#" data-toggle="modal" data-target="#InfoNproy">
                    <i class="now-ui-icons travel_info text-muted"></i></a>
                </h5>
                
              </div>
              <div class="card-body">
                <form autocomplete="off" action="cfondo_proy/agregar?id=<?=$proy->id_proyecto?>" class="validate-form" method="post">
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Codigo (deshabilitado)</label>
                        <input type="text" name="codigo_p" class="form-control" disabled="" placeholder="id" value="<?=$proy->id_proyecto?>">
                      </div>
                    </div>
                  </div>
                 
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group validate-input" data-validate="Campo requerido">
                        <label>Nombre del fondo</label>
                        <input type="text" id="fondo_p" name="fondo_p" class="form-control" placeholder="" value="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Observaci&oacute;n</label>
                        <input type="text" id="fuente_p" name="fuente_p" class="form-control" placeholder="" value="">
                      </div>
                    </div>
                  </div>
                  <!--<div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group validate-input" data-validate="Campo requerido">
                        <label>Monto de Inversi&oacute;n</label>
                        <input type="text" id="fondo_p" name="fondo_p" class="form-control" placeholder="" value="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Fuente</label>
                        <input type="text" id="fuente_p" name="fuente_p" class="form-control" placeholder="" value="">
                      </div>
                    </div>
                  </div>-->
                  <div class="float-right">
                      <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>                
              </div>
            </div>
          </div>
        </div>
      </div>
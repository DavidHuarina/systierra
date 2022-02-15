
    <!-- Sart Modal -->
    <div class="modal fade" id="ajus" tabindex="-2" role="dialog" aria-labelledby="ajusLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <p id="titulo_ep" class=""></p>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="cfulldetalles/ajustar?id=<?=$proy->id_proyecto?>" class="validate-form" method="post">
                  <div class="row">
                    <div class="col-md-12">                    
                      <div class="form-group">  
                      <label>Tipo de Cambio</label><br>                 
                         <select id="select-cambio" name="select-cambio" class="select-single-plantilla">
                            <option value="0">BOLIVIANOS</option>
                            <?php 
                            foreach ($cambio->result() as $cam) {
                              if($cambioMon->id_cambio==$cam->id_cambio){
                              ?><option value="<?=$cam->id_cambio?>" selected><?=$cam->pais?> - <?=$cam->moneda?></option><?php
                              }else{
                               ?><option value="<?=$cam->id_cambio?>"><?=$cam->pais?> - <?=$cam->moneda?></option><?php
                              }
                             
                            }
                            ?>
                            </select>
                        </div>    
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="codigo_ep" name="codigo_ep" readonly="readonly">
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Ajuste</label>
                        <input type="text" class="form-control" id="ajus_ep" name="ajus_ep" placeholder="Monto de ajuste">
                      </div>
                    </div>
                  </div>                 
                  <hr class="hr"></hr>
                  <div class="float-right">
                      <button type="submit" class="btn btn-info">Guardar</button>
                    </div>
                </form>
          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->

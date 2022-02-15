<!-- Sart Modal -->
    <div class="modal fade" id="modnact" role="dialog" aria-labelledby="modnactLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-secondary text-white">
            <label class="">Nueva Actividad</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="clista_actividad/nact" method="post">
                <input id="factividad" name="factividad" type="hidden" value="none">
                <input id="act_padre" name="act_padre" type="hidden" value="0">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Seleccione el proyecto</label>
                         <select id="proyect" name="proyect" class="form-control select-single-plantilla">
                              <?php
                               foreach ($proyecto->result() as $proy) {
                                ?><option value="<?=$proy->id_proyecto?>"><?=$proy->nombre_proyecto?></option><?php
                               }
                              ?>
                          </select>
                      </div>
                    </div>
                  </div>                 
                  <hr class="hr"></hr>
                  <div class="float-right">
                      <button type="submit" class="btn btn-secondary">Registrar</button>
                    </div>
                </form>
          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->
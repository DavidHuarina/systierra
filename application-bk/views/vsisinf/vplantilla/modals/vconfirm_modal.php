<!-- Sart Modal -->
    <div class="modal fade" id="systierra" role="dialog" aria-labelledby="systierraLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-celeste text-white">
            <h5><label class=""><span class="fa fa-info-circle"></span> <b>Sys Tierra</b></label></h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                        <label>Desarrollado por Ing. David Omar Huarina Mendoza en 2019.</label>
                    </div>
                  </div>                 
                  <!--<hr class="hr"></hr>
                  <div class="float-right">
                      <button type="submit" class="btn btn-secondary">Registrar</button>
                    </div>-->
          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->

    <!-- Sart Modal -->
    <div class="modal fade" id="solmod" role="dialog" aria-labelledby="solmodLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-celeste text-white">
            <h5><label class=""><span class="fa fa-info-circle"></span><b> Confirmaci&oacute;n</b></label></h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                        <small><label>¿<?=$nombreUsuario?>, estas seguro de enviar la solicitud?.</label>
                          <div class="container-fluid">
                             <label class="text-muted"><span class="fa fa-warning text-warning"></span> Ya no podras hacer ninguna modificaci&oacute;n</label><br>
                             <label class="text-muted"><span class="fa fa-warning text-warning"></span> Ya no podras borrar la actividad referente a esta solicitud.</label><br>
                             <label class="text-muted"><span class="fa fa-warning text-warning"></span> S&oacute;lo volver&aacute; a ser editable cuando tu solicitud sea rechazada por el Usuario Receptor.</label>
                             <br><br>
                             <label class="text-muted"><span class="fa fa-exclamation-circle text-danger"></span> Verifica bien los datos antes de enviar.</label> 
                          </div>                        
                      </small>
                    </div>
                  </div>                 
                  <hr class="hr"></hr>
                  <div class="float-right">
                      <a href="cenviar_solicitud/fin_sol?id=<?=$actividad->act_id?>&idp=<?=$proy->id_proyecto?>&sol=<?=$sol?>" class="btn btn-secondary">Entiendo, Enviar</a>
                  </div>
          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->


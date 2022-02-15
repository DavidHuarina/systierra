
    <!-- Sart Modal -->
    <div class="modal fade" id="descargosM" tabindex="-1" role="dialog" aria-labelledby="descargosMLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-success text-white">
            <p class="">Finalizar Descargo</p>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              
                  <div class="row">
                    <div class="col-md-12">
                        <small><label>¿<?=$nombreUsuario?>, Complete algunos datos antes del envio.</label>
                         <!-- <div class="container-fluid">
                             <label class="text-muted"><span class="fa fa-warning text-warning"></span> Una vez enviado se realizaran los cambios respectivos al presupuesto del proyecto</label><br>
                             <br><br>
                             <label class="text-muted"><span class="fa fa-exclamation-circle text-danger"></span> Verifica bien los datos antes de enviar.</label> 
                          </div>-->                        
                          
                      </small>
                      <table class="table table-small">
                        <tr><td><label class="text-muted">Importe Recibido</label></td><td><label class="text-muted">Descargo</label></td><td><label class="text-muted">Saldo</label></td></tr>
                        <tr><td><b class="text-dark" id="importedepo"></b></td><td><b class="text-dark"><?=number_format($totdes, 2, '.', ',');?></b></td><td><b class="text-success" id="saldodepo"></b></td></tr>
                      
                      </table>
                    </div>
                   
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="totdesca" name="totdesca" value="<?=$totdes?>">
                      </div>
                      <div class="form-group" id="importe_monto">
                        <label>Importe recibido (Bs)<span class='text-danger'>*</span></label>
                        <input type="text" onkeypress="return validarMontoSupImpuesto(event);" class="form-control" id="monto_importe" name="monto_importe" placeholder="">
                      </div>
                      
                      <div class="float-right" id="calculaSaldoDes">
                      <a href="#" onclick="calculaSaldoDes()" class="btn btn-success" id="env_1">Enviar</a>
                      </div>
                      
                     <div id="datosbanco" style="display:none">  
                      <div class="form-group">
                       <label for="banco">Banco <span class='text-danger'>*</span></label>
                        <input type="text" class="form-control" id="banco" name="banco">
                      </div>
                      <div class="form-group">
                        <label for="ncheque">N. Cheque <span class='text-danger'>*</span></label>
                        <input type="text" class="form-control" id="ncheque" name="ncheque" placeholder="">
                      </div>
                      </div>
                      
                    </div>
                    <div class="col-md-12">
                      <div class="float-right" id="calculaSaldoDesDes" style="display:none">
                      <a href="#" onclick="calculaSaldoDesDes()" class="btn btn-warning btn-small" id="env_2">Editar Importe</a>
                      </div>
                    </div>   
                  </div>                 
                  <hr class="hr"></hr>
                  <div class="float-right" id="findescar" style="display:none">
                      <a href="#" onclick="finDescargo(<?=$df?>)" class="btn btn-success" id="enviar_btn_a">Enviar descargo</a>
                    </div>
                    <div id="mensajito">
                    </div>

          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->
 <!-- Sart Modal -->
    <div class="modal fade" id="reem" tabindex="-1" role="dialog" aria-labelledby="reemLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <p class="">Reembolso de <label id="monto_r"></label> Bs</p>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Justificaci&oacute;n <span class='text-danger'>*</span></label>
                        <textarea type="text" class="form-control" id="reembolso" name="reembolso"></textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Monto Bs.<span class='text-danger'>*</span></label>
                        <input type="text" readonly class="form-control" id="monto_rem" name="monto_rem">
                      </div>
                    </div>
                  </div>                 
                  <hr class="hr"></hr>
                  <div class="float-right">
                      <a href="#" onclick="nreembolso(<?=$df?>)" class="btn btn-secondary">Enviar Reembolso</a>
                    </div>
                    <label class="text-small text-muted">Se guardara el descargo automat&iacute;camente</label>
                    <div id="mensajite">
                    </div>

          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->
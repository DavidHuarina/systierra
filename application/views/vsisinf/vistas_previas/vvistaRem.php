<?php 
  $recep=$this->solicitud->getAllReceptor($sol);
  $soli=$this->solicitud->getAllSolicitante($sol);
?>
<div class="panel-header-sm bg-warning">
</div>
   <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Vista previa <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a>
                  <img class='icon-lg float-right' src='images/logo.png' alt='Sin imagen'></h5>
                <p class="category">REEMBOLSO
                  <a href="#">Formulario N° 4</a>
                </p>

              </div>
              <div class="card-body">
                <table class="table table-sm">
                         <tr><td><label>Solicitado por:</label></td><td><label class="text-lg text-dark"><?=$soli->nombre_persona?> <?=$soli->apellido_persona?></label></td>
              
                         </tr>
                         <tr><td><label>Autorizado por:</label></td><td><label class="text-lg text-dark"><?=$recep->nombre_persona?> <?=$recep->apellido_persona?></label></td>
                         </tr>
                         <tr><td><label>Fecha del descargo:</label></td><td><label class="text-lg text-dark">
                           <?php if($descargo->f_descargo=='0001-01-01 00:00:00'){
                            ?> Sin fecha de descargo<?php
                           }else{
                             ?><?=strftime('%d de %B de %Y',strtotime($descargo->f_descargo))?><?php
                           }
                           ?>
                          </label></td></tr>
                    </table>
                    <hr>
                    <label>Descripcion del reembolso esto no ira a la impresi&oacute;n...</label>
                    <p class="title text-primary text-center">
                          Reembolso</p>

                    <div class="row">
                      <div class="col-md-4 text-center">
                        <label>Total (Bs):</label> 
                      <h4 class="title text-danger">
                        <?php if($reembolso==null){
                         ?><?=number_format(0, 2, '.', ',');?><?php
                        }else{
                         ?><?=number_format($reembolso->monto, 2, '.', ',');?><?php
                        }?>
                          </small></h4> 
                      <hr>
                      </div>
                      <div class="col-md-8 text-center">
                        <label>Justificaci&oacute;n</label><hr>
                        <?php if($reembolso==null){
                         ?>Sin Justificación. No registro el reembolso<?php
                        }else{
                         ?><label><?=$reembolso->justificacion?></label><?php
                        }?>
                         
                      </div>
                    </div>
                      <div class="float-right">
                      <a href="javascript:history.back(-1);" class="btn btn-danger">Ok</a>
                    </div>
                    <div class="float-right">
                      <a href="cvistaRem/descargar/<?=$proy->id_proyecto?>/<?=$actividad->act_id?>" class="btn btn-secondary"><i class="now-ui-icons arrows-1_cloud-download-93"></i> Descargar</a>
                    </div>
                       
              </div>
            </div>
          </div>
        </div>
      </div>

      
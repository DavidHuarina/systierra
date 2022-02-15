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
                <p class="category">DESCARGO DE FONDOS
                  <a href="#">Formulario N° 3</a>
                </p>

              </div>
              <div class="card-body">
                <table class="table table-sm">
                         <tr><td><label>Presentado por:</label></td><td><label class="text-lg text-dark"><?=$soli->nombre_persona?> <?=$soli->apellido_persona?></label></td>
                          <td><label>Banco:</label></td><td><label class="text-lg text-dark"><?=$descargo->banco?></label></td>
                         </tr>
                         <tr><td><label>Aprobado por:</label></td><td><label class="text-lg text-dark"><?=$recep->nombre_persona?> <?=$recep->apellido_persona?></label></td>
                         <td><label>Nro. de cheque:</label></td><td><label class="text-lg text-dark"><?=$descargo->n_cheque?></label></td></tr>
                         <tr><td><label>Autorizado por:</label></td><td></td><td><label>Fecha del descargo:</label></td><td><label class="text-lg text-dark">
                           <?php if($descargo->f_descargo=='0001-01-01 00:00:00'){
                            ?> Sin fecha de descargo<?php
                           }else{
                             ?><?=strftime('%d de %B de %Y',strtotime($descargo->f_descargo))?><?php
                           }
                           ?>
                          </label></td></tr>
                    </table>
                    <hr>
                    <label>Descripcion del descargo esto no ira a la impresi&oacute;n...</label>
<?php $porciones = explode("@", $actividad->sub_nom);?>
                    <p class="title text-primary text-center">
                          <?=$porciones[0]?></p>

                    <div class="row">
                      <div class="col-md-4 text-center">
                        <label>Importe Recibido (Bs):</label> 
                      <?php
                            $importe=0;
                               foreach ($sm->result() as $smi) {
                               $importe=$importe+$smi->monto;
                               }
                               if($importe<=0){
                                $solicitude=$this->solicitud->getById($sol);
                               ?>
                              <h4 class="title text-secondary">
                                <?=number_format($solicitude->total, 2, '.', ',')?></small></h4>
                               <?php
                               }else{
                              ?>
                              <h4 class="title text-secondary">
                                <?=number_format($importe, 2, '.', ',');?></small></h4>
                               <?php
                               }
                              ?>
                       
                      <hr>
                      </div>
                      <div class="col-md-4 text-center">
                        <label>Total gastos (Bs):</label> 
                      <?php $totalsol=0;$totalsol2=0;
                     foreach ($dg->result() as $detg) {
                      $totalsol=$detg->monto+$totalsol;
                      $totalsol2=$detg->monto_impuesto+$totalsol2;
                      }
                      ?>
                      <h4 class="title text-danger">
                          <?=number_format($totalsol, 2, '.', ',');?></small></h4> 
                      <hr>
                      </div>
                      <div class="col-md-4 text-center">
                        <label>Saldo a depositar (Bs):</label> 
                      <?php $saldo=$importe-$totalsol;
                           if($saldo<=0){
                            ?>
                            <h4 class="title text-success">
                          <?=number_format($saldo-$saldo, 2, '.', ',');?></small></h4> 
                            <?php
                           }else{
                            ?>
                            <h4 class="title text-success">
                          <?=number_format($saldo, 2, '.', ',');?></small></h4> 
                            <?php
                           }
                      ?>
                      
                      <hr>
                      </div>
                    </div>
                      <div class="table-responsive">
                  <table class="table table-sm table-bordered">
                    <thead class=" text-primary text-small">
                      <th>
                        #
                      </th>
                      <th>
                        Razon social
                      </th>
                      <th>
                        Detalle
                      </th>
                      <th>
                        Factura / Recibo
                      </th>
                      <th>
                        Impuesto
                      </th>                      
                      <th class="text-right text-warning">
                        Monto
                      </th>
                      <th class="text-right text-warning">
                        Monto + impuesto
                      </th>
                    </thead>
                    <tbody>
                      <?php
                      $numero=0;
                     foreach ($dg->result() as $detg) {
                      $numero=$numero+1;
                      ?>
                       <tr>
                        <td>
                          <?=$numero?>
                        </td>
                        <td>
                          <?php $porciones = explode("@", $detg->descripcion);?>
                          <?=$porciones[0]?>
                        </td>
                        <td>
                          <?=$detg->nombre_detalle?>
                        </td>
                        <?php 
                         if($detg->impuesto_serv>0){
                          ?>
                          <td>
                          No aplica
                          </td>
                          <td>
                          Serv. <?=$detg->impuesto_serv?> %
                          </td> 
                          <?php
                         }else{
                           if($detg->impuesto_bien>0){
                             ?>
                             <td>
                              <?=$detg->n_fac_reci?>
                             </td>
                             <td>
                             Bien. <?=$detg->impuesto_bien?> %
                             </td>
                             <?php
                           }else{
                             ?>
                             <td>
                              <?=$detg->n_fac_reci?>
                             </td>
                             <td>
                             No aplica
                             </td>
                             <?php
                           }
                          
                         } 
                        ?>
                        
                        <td class="text-right">
                          <small class="text-dark">Bs.</small> <?=number_format($detg->monto, 2, '.', ',');?>
                        </td>
                        <td class="text-right">
                          <small class="text-dark">Bs.</small> <?=number_format($detg->monto_impuesto, 2, '.', ',');?>
                        </td>
                      </tr> 
                      <?php
                     }
                      ?>
                     <tr>
                        <td>
                          <b>Total gastos</b>
                        </td>
                        <td>
                         
                        </td>
                        <td>
                          
                        </td>
                        <td>
                          
                        </td>
                        <td>
                          
                        </td>
                        <td class="text-right">
                           <small class="text-dark">Bs.</small><?=number_format($totalsol, 2, '.', ',');?>
                        </td>
                        <td class="text-right">
                           <small class="text-dark">Bs.</small><b><?=number_format($totalsol2, 2, '.', ',');?></b>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div> 
                      
                      
                      
                      <div class="float-right">
                      <a href="javascript:history.back(-1);" class="btn btn-danger">Ok</a>
                    </div>
                    <div class="float-right">
                      <a href="cvistaDes/descargar/<?=$proy->id_proyecto?>/<?=$actividad->act_id?>" class="btn btn-secondary"><i class="now-ui-icons arrows-1_cloud-download-93"></i> Descargar</a>
                    </div>
                       
              </div>
            </div>
          </div>
        </div>
      </div>

      
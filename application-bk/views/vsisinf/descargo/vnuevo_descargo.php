<?php

  $i=0;
  echo "<script>var detalle=[],imagen_det=[];</script>";
  foreach ($detalle->result() as $det) {
     echo "<script>detalle[".$i."]='".$det->nombre_detalle."';</script>";
     echo "<script>imagen_det[".$i."]='imagenes/proyecto/s.png';</script>";
    ?>
   <?php
    $i=$i+1;
   }
   $i=0;
  echo "<script>var rs=[],imagen_rs=[];</script>";
  foreach ($rs->result() as $r) {
     echo "<script>rs[".$i."]='".$r->descripcion."';</script>";
     echo "<script>imagen_rs[".$i."]='imagenes/proyecto/r.jpg';</script>";
    ?>
   <?php
    $i=$i+1;
   }
  ?>
                    <?php $solx=0;
                     foreach ($sm->result() as $smi) {
                        $solx=$solx+$smi->monto;
                       }
                     $ninguno=0;$saldo=0;$depo=0;
                     foreach ($dg->result() as $detg) {
                      $ninguno=$ninguno+1;
                      $depo=$detg->monto+$depo;
                      }
                      $saldo=$solx-$depo;
                      ?>
<div class="panel-header-sm bg-warning">
</div>
<div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><img class='icon-sm' src='apps/full-icon/flat/negocio/point-of-service.png' alt='Sin imagen'> Descargo de fondos / actividad <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a>
                </h5>                
              </div>
              <div class="card-body">
                <form id="form_cb" autocomplete="off" action="cnuevo_descargo/agregar?ac=<?=$actividad->act_id?>&id=<?=$proy->id_proyecto?>&df=<?=$df?>" class="validate-form" method="post">
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <input type="hidden" name="cod_det" id="cod_det"  class="form-control" readonly="readonly" placeholder="" value="NN">
                      </div>
                    </div>
                    <div class="col-md-7 pr-1">
                      <div class="form-group">
                        <input type="hidden" name="cod_rs" id="cod_rs" class="form-control" readonly="readonly" placeholder="" value="NN">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Seleccione el Item</label>
                        <select id="select-sm" name="select-sm" class="form-control select-single-plantilla">
                              <?php
                               foreach ($sm->result() as $smi) {
                                ?><option value="<?=$smi->id_solm?>"><?php $porciones = explode("@", $smi->descrip);?>
                                PARTIDA: <b><?=$porciones[1]?></b> , &nbsp;&nbsp;&nbsp;ITEM: <?=$porciones[0]?>  <!--- Bs. <?=$smi->monto?>--></option><?php
                               }
                              ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 pr-1 pl-1">
                      <div class="form-group validate-input" data-validate="Campo requerido">
                        <label>Detalle</label>
                        <input type="text" id="detalle" name="detalle" class="form-control" placeholder="" value="">
                      </div>
                    </div>
                  <div class="row">   
                    <div class="col-md-6 pr-1">
                      <div class="form-group validate-input" data-validate="Campo requerido">
                        <label>Nombre &oacute; Razon Social</label>
                        <input type="text" id="rs" name="rs" class="form-control" placeholder="" value="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                           <div class="form-group validate-input" data-validate="Error en la fecha">
                             <label>Fecha</label>
                             <input type="text" id="fi_p" name="fi_p" class="form-control" placeholder="dd/mm/yyyy" value="">
                           </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label class="cb-radio" onclick="displayBlockServ('optradio1','optradio2')"><input type="radio" value="1" name="optradio" id="optradio1" checked="checked">Servicios</label>
                    
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label class="cb-radio" onclick="displayBlockServ('optradio2','optradio1')"><input type="radio" value="2" name="optradio" id="optradio2">Bienes</label>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6 pr-1">
                     <div id="lista-com">
                      <div class="row">
                        <div class="col-md-6 pr-1">
                          <div class="form-group">
                             <label>Impuesto %</label>
                               <input type="text" onkeypress="return validarNumero(event)" id="impuesto_ser" name="impuesto_ser" class="form-control"  value="15">
                          </div>
                        </div>
                        <div class="col-md-6 pl-1">
                          <div class="form-group">
                             <label>Monto ajustado</label>
                               <input type="text" onkeypress="return validarNumero(event)" id="monto_serv" name="monto_serv" class="form-control"  value="0" readonly="readonly">
                          </div>
                        </div>
                      </div>      
                     </div>
                    <div id="otro-com" style="display:none">
                        <div class="row">
                          <div class="col-md-12">
                           <div class="row">
                            <div class="col-md-6 pr-1">
                              <div class="form-group">
                                <label class="cb-radio" onclick="displayBlockFact('d_optradio1','d_optradio2')"><input type="radio" value="1" name="d_optradio" id="d_optradio1" checked="checked">FACTURA</label>
                    
                              </div>
                            </div>
                            <div class="col-md-6 pl-1">
                              <div class="form-group">
                                <label class="cb-radio" onclick="displayBlockFact('d_optradio2','d_optradio1')"><input type="radio" value="2" name="d_optradio" id="d_optradio2">RECIBO</label>
                              </div>
                            </div>
                           </div>
                           <div id="lista-com_d">
                             <div id="div-impuesto" class="form-group">
                             <label>N. Factura / N. Recibo</label>
                               <input type="text" onkeypress="return validarNumero(event)" id="fac" name="fac" class="form-control"  value="0">
                              </div>
                            </div>
                            <div id="otro-com_d" style="display:none">
                              <div class="row">
                                <div class="col-md-4 pr-1">
                                  <div class="form-group">
                                     <label>Impuesto %</label>
                                     <input type="text" onkeypress="return validarNumero(event)" id="impuesto" name="impuesto" class="form-control"  value="8">
                                  </div>
                                </div>
                                <div class="col-md-8 pl-1">
                                  <div class="form-group">
                                     <label>Monto ajustado</label>
                                     <input type="text" onkeypress="return validarNumero(event)" id="monto_bien" name="monto_bien" class="form-control"  value="0" readonly="readonly">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>                    
                         </div>
                     </div> 
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="pl-1 pr-1">
                      <div class="form-group validate-input" data-validate="Campo requerido">
                        <label>Monto Bs (0000.00)</label>
                        <input type="text" onkeypress="return validarMontoSupImpuesto(event);" id="monto" name="monto" class="form-control" placeholder="" value="">
                      </div>
                    </div>
                    </div>                        
                        
                  </div>
                  
                  <hr class="hr"></hr>
                  <?php
                   if($ninguno!=0){
                    ?>
                   <div class="float-left">
                            <a href="#" data-toggle="modal" data-target="#descargosM" class="btn btn-success">Enviar Descargo</a>
                   </div>
                    <?php
                      if($saldo<0){
                        $saldo2=number_format(abs($saldo), 2, '.', ',');
                        ?>
                        <!--<div class="float-right">
                             <a href="cvistaRem?ac=<?=$actividad->act_id?>&id=<?=$proy->id_proyecto?>" class="btn btn-secondary">Vista reembolso</a>
                         </div>
                          <div class="float-left">
                             <a href="#" onclick="mandaHtml('<?=$saldo2?>','reembolso');cambiarlbl('<?=$saldo2?>','monto_r');mandaVal('<?=abs($saldo)?>','monto_rem');" data-toggle="modal" data-target="#reem" class="btn btn-danger">Reembolso <?=$saldo2?></a>
                         </div>-->
                    <?php
                      }else{
                        $rem_detg=$this->rem_detg->getByDF($df);
                        if($rem_detg!=null){
                           $this->rem_detg->delete($rem_detg->id_rd);
                           $this->rem->delete($rem_detg->id_rem);
                        } 
                         ?>                    
                        <!--<div class="float-left">
                            <a href="#" data-toggle="modal" data-target="#descargosM" class="btn btn-info">Enviar Descargo</a>
                        </div>-->
                        <?php                      
                      }
                    
                   }else{
                    $rem_detg=$this->rem_detg->getByDF($df);
                        if($rem_detg!=null){
                           $this->rem_detg->delete($rem_detg->id_rd);
                           $this->rem->delete($rem_detg->id_rem);
                        }     
                   }
                  ?>
                  <div class="float-right">
                      <a href="cvistaDes?ac=<?=$actividad->act_id?>&id=<?=$proy->id_proyecto?>" class="btn btn-secondary">Vista previa</a>
                    </div>
                  <div class="float-right">
                      <button type="submit" class="btn btn-primary">Agregar</button>
                    </div>
                    <div class="float-left">
                      <button class="btn btn-default" id="btn-impuesto" onclick="obtenerPorcentaje(); return false;">Calcular impuesto</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="apps/assets/img/contabilidad.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="apps/full-icon/flat/negocio/point-of-service.png" alt="images">
                    <h5 class="title">Descargo. para <?php $porciones = explode("@", $actividad->sub_nom);?>
                          <?=$porciones[0]?></h5>
                  </a>
                  <?php 
                   $recep=$this->solicitud->getAllReceptor($sol);
                   $soli=$this->solicitud->getAllSolicitante($sol);
                  ?>
                  <p class="text-center text-info">Dirigida a: <small class="text-muted"><?=$recep->nombre_persona?> <?=$recep->apellido_persona?></small></p>
                  <p class="text-center text-primary">De: <small class="text-muted"><?=$soli->nombre_persona?> <?=$soli->apellido_persona?></small></p>
                  <p class="description">
                   Sin descripcion
                  </p>
                </div>
                <p class="text-muted text-center">
                  <b class="text-primary">Nombre del proyecto:</b> " <?=$proy->nombre_proyecto?> "
                </p>
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <?php $totalsol=0;
                     foreach ($dg->result() as $detg) {
                      $totalsol=$detg->monto_impuesto+$totalsol;
                      }
                      ?>
                <h5 class="card-title"> Total gastos <small class="text-primary"><?=number_format($totalsol, 2, '.', ',');?></small><label for="" class="text-primary"></label> <small class="text-muted">Bs</small></h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table text-small">
                    <thead class="bg-plomo text-white">
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
                      <th class="text-right">
                        Quitar
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
                          <small class="text-dark">Bs.</small> <?=$detg->monto?>
                        </td>
                        <td class="text-right">
                          <small class="text-dark">Bs.</small> <?=$detg->monto_impuesto?>
                        </td>
                        <td class="text-right"><a class="" href="cnuevo_descargo/quitarDG?ac=<?=$actividad->act_id?>&id=<?=$proy->id_proyecto?>&idg=<?=$detg->id_det?>">
                              <i class="fa fa-times text-danger fa-fw"></i></a></td>
                      </tr> 
                      <?php
                     }
                      ?>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

</div>

      
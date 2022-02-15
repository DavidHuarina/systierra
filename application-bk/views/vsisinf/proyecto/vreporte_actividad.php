                   <?php
                     $tori=0;$taju=0;$tac=0;
                     foreach ($ep->result() as $pr) {
                      $tori=$pr->original+$tori;
                      $taju=$pr->ajustes+$taju;
                      $tac=$pr->actual+$tac;
                      }
                      ?>
                    <?php
                     $tsal=0;$tper=0;$tacu=0;
                     foreach ($ep->result() as $pr) {
                      $tsal=$pr->saldos+$tsal;
                      $tper=$pr->periodo+$tper;
                      $tacu=$pr->acumulado+$tacu;
                      }

                      $por_p=($tac*100)/$tori;
                      $por_e=($tacu*100)/$tac;
                      $por_s=($tsal*100)/$tac;
                      ?>

<div class="panel-header-sm bg-celesverde">
</div>  
<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                  <h4 class="card-title mb-4">Reportes por Actividad de <small class="text-celesverde"><?=$proy->nombre_proyecto?></small></h4>
                </div>
              <div class="card-body">
                <p class="text-center text-muted">
                  Presupuestado <small class="text-muted">(<?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>)</small>
                  <small class="text-muted">Original </small><label id="lb-original" for="" class="text-primary"><?=number_format($tori, 2, '.', ',');?></label> 
                  <small class="text-muted">Ajustes </small><label id="lb-ajustes" for="" class="text-info"><?=number_format($taju, 2, '.', ',');?></label>
                  <small class="text-muted">Actual </small><label id="lb-actual" for="" class="text-info"><?=number_format($tac, 2, '.', ',');?></label>
                
                </p> 
                <div class="row">
                    <div class="col-md-6">
                      <p class="text-center"><small class="text-primary">Presupuesto actual:</small> <?=number_format($tac, 2, '.', ',');?><small class="text-info"> <?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?></small></p>
                 <p class="text-center"><small class="text-primary">Ejecuci&oacute;n:</small> <?=number_format($tacu, 2, '.', ',');?><small class="text-primary"> <?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?></small></p>
                 <p class="text-center"><small class="text-primary">Saldo:</small> <?=number_format($tsal, 2, '.', ',');?><small class="text-success"> <?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?></small></p>
                    </div>
                    <div class="col-md-6">
                      <p class="text-center"><small class="text-primary">Presupuesto actual:</small> <?=number_format($por_p, 1, '.', '.');?><small class="text-info"> %</small></p>
                 <p class="text-center"><small class="text-primary">Ejecuci&oacute;n:</small> <?=number_format($por_e, 1, '.', '.');?><small class="text-primary"> %</small></p>
                 <p class="text-center"><small class="text-primary">Saldo:</small> <?=number_format($por_s, 1, '.', '.');?><small class="text-success"> %</small></p>
                    </div>
                 </div>                
                 <hr>
                 <a class="btn btn-danger float-left" href="cdetalle_proyecto?id=<?=$proy->id_proyecto?>"> Atras</a>
                 
                 <div class="dropdown float-left">
                   <a class="btn btn-danger btn-simple dropdown-toggle" href="#" id="expo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img class="" src="apps/full-icon/flat/oficina/usb.png" width="16" height="16"> Exportar
                   </a>
                   <div class="dropdown-menu dropdown-menu-left" aria-labelledby="expo">
                    <?php if($cambioMon==null){
                      $ca_expo=0;
                    }else{
                      $ca_expo=$cambioMon->id_cambio;
                    }
                    $fii = str_replace("/", "-", $fi);
                    $fff = str_replace("/", "-", $ff);
                    ?>
                     <a href="creporte_actividad/exportar/<?=$proy->id_proyecto?>/<?=$ca_expo?>/<?=$ver?>/<?=$fii?>/<?=$fff?>"class="dropdown-item"><img class="" src="apps/full-icon/flat/documentos/pdf-5.png" width="16" height="16"> PDF</a>
                      <a href="creporte_actividad/exportarExcel/<?=$proy->id_proyecto?>/<?=$ca_expo?>/<?=$ver?>/<?=$fii?>/<?=$fff?>" class="dropdown-item"><img class="" src="apps/full-icon/flat/docs/034-excel.png" width="16" height="16"> CSV (Excel)</a>
                   </div>
                 </div>
                 <form action="creporte_actividad/fechasBuscar/<?=$proy->id_proyecto?>/<?=$ver?>/<?=$ca_expo?>" method="post">
                 <button class="btn btn-info float-right" type="submit">Filtrar</button>
                 <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                          <div class="form-group validate-input" data-validate="Ingrese una fecha">
                            <label>Desde</label>
                             <input type="text" id="fi_p" name="fi_p"class="form-control" placeholder="Ej: dd/mm/aaaa" value="<?=$fi?>">    
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group validate-input" data-validate="Ingrese una fecha">
                            <label>Hasta</label>
                            <input type="text" id="ff_p" name="ff_p"class="form-control" placeholder="Ej: dd/mm/aaaa" value="<?=$ff?>">
                          </div>
                        </div>
                      </div>
                      </form>
                    <hr>  
                  
                  <?php if($cambioMon!=null){
                    ?>
                     <!--<a href="#" onclick="notificacion('top','left','holitas','danger','now-ui-icons ui-1_bell-53')">mensaje</a> -->
                    <center><label>Valor del cambio:</label> <p class="text-lg"><?=$cambioMon->valor?> <small><?=$cambioMon->moneda?></small></p></center><?php
                  }?>
                     
                  <div class="form-group col-md-3 float-right">
                         <select id="select-mun" name="select-mun" onchange="window.location.href='creporte_actividad?id=<?=$proy->id_proyecto?>&v=<?=$ver?>&c='+this.value" class="form-control select-single-plantilla">
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
                  <?php 
                   switch ($ver) {
                     case 1:
                       $radio="";
                       $radio2="selected";
                       $radio3="";
                       break;
                       case 2:
                       $radio="";
                       $radio2="";
                       $radio3="selected";
                       break;     
                     default:
                       $radio="selected";
                       $radio2="";
                       $radio3="";
                       break;
                   }
                  ?>
                   <div class="form-group col-md-3 float-right">
                         <select id="select-ram" name="select-ram" onchange="window.location.href='creporte_actividad?id=<?=$proy->id_proyecto?>&c=<?=$ca_expo?>&v='+this.value" class="form-control select-single-plantilla">
                            <option value="0" <?=$radio?>>TODOS</option>
                            <option value="1" <?=$radio2?>>CON EJECUCION</option>
                            <option value="2" <?=$radio3?>>SIN EJECUCION</option>
                            </select>
                  </div>
              </div>
            </div>
          </div>         
        </div>
         <div class="col-md-12">
            <div class="card">
              <div class="card-header">                            
              </div>
              <div class="card-body">
                <?php
                     foreach ($ep->result() as $pr) {
                      $nacttt=0;
                      //$descargos=$this->descargo->getAllDes($ep->id_ep);
                      foreach ($actividad->result() as $act) {
                        $activ = explode("@", $act->sub_nom);
                        $sm=$this->sol_act->getAllByIdA($act->act_id);
                        foreach ($sm->result() as $smi) {
                            if($pr->id_ep==$smi->id_ep){
                            $nacttt++;
                          }
                        }
                        
                      }
                      if($ver!=1){
                        $nacttt=1;
                      }
                      if($nacttt!=0){
                      ?>
                      <div class="row">
                        <div class="col-md-4">
                         <?php
                      if($cambioMon==null){ $moneda= "Bs";}else{ $moneda= $cambioMon->moneda;}
                      $porciones = explode("@", $pr->descripcion);
                      echo "<h5 class='text-muted'>".$porciones[0]." @ <small>".$pr->descripcionr."</small></h5><br>";
                      ?>
                      <table class="table text-small">
                        <tr>
                          <td class="text-azul-oscuro text-center">Oringinal</td>
                          <td class="text-danger text-center">Ajuste</td>
                          <td class="text-info text-center">Actual</td>
                        </tr>
                        <tr class="">
                         <td class="text-center">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <?=number_format($pr->original, 2, '.', ',');?>
                        </td>
                        <td class="text-center">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <?=number_format($pr->ajustes, 2, '.', ',');?>
                        </td>
                        <td class="text-center">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <?=number_format($pr->actual, 2, '.', ',');?>
                        </td>
                        </tr>
                      </table>                      
                      <?php
                      if($pr->saldos<0){
                        $estilosaldo="btn-secondary";
                      }else{
                        $estilosaldo="btn-success";
                      }
                      echo "<div class='float-right'><label>Saldo</label><br> <p class='btn ".$estilosaldo."'>".$moneda." ".number_format($pr->saldos, 2, '.', ',')."</p></div><div class='float-left'><label>Ejecutado</label><br> <p class='btn btn-warning'>".$moneda." ".number_format($pr->periodo, 2, '.', ',')."</p></div><br><br><br>";
                      ?>
                        </div>
                        <div class="col-md-8">
                         <table id="" class="table text-small">
                           <thead>
                           <tr class="bg-naranja">
                             <th>
                               <b class="text-naranja"><small>N</small></b>
                            </th>
                             <th>
                                <b class="text-white"><small>Actividad</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Solicitante</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Fecha</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Monto (<?=$moneda?>)</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Gasto (<?=$moneda?>)</small></b>
                             </th>
                           </tr>
                           </thead>
                            <tbody>
                      <?php
                      $numero=1;
                      //$descargos=$this->descargo->getAllDes($ep->id_ep);
                      foreach ($actividad->result() as $act) {
                        $activ = explode("@", $act->sub_nom);
                        $sm=$this->sol_act->getAllByIdA($act->act_id);
                        foreach ($sm->result() as $smi) {
                            if($pr->id_ep==$smi->id_ep){
                              $detalle=$this->detalle_gastos->getByIdSol($smi->id_solm);
                              echo "<tr>";
                               ?>
                               <td><?=$numero?></td>
                               <td><a class="nav-link" href='cdetalle_actividad?id=<?=$proy->id_proyecto?>&ac=<?=$act->act_id?>'><?=$activ[0]?></a></td>
                               <td><img class="icon-sm" src="<?=$smi->dir_imagen?>"> <?=$smi->nombre_persona?> <?=$smi->apellido_persona?></td>
                               <td><?=strftime('%d de %B de %Y',strtotime($act->act_fecha))?></td>

                              
                              <?php 
                              if($act->id_estado==4){
                                    ?><td><?=number_format($smi->monto/$valmon, 2, '.', ',')?></td><?php
                                  }else{
                                    ?><td class="text-muted"><?=number_format($smi->monto/$valmon, 2, '.', ',')?></td><?php
                                  }
                                if($detalle==null){
                                  ?><td>Sin Descargo</td><?php
                                }else{
                                  $montoDescargo=0;
                                  foreach ($detalle->result() as $det) {
                                    $montoDescargo=$montoDescargo+$det->monto_impuesto;
                                  }
                                  if($act->id_estado==4){
                                    ?><td class="text-muted"><?=number_format($montoDescargo/$valmon, 2, '.', ',')?></td><?php
                                  }else{
                                    ?><td><?=number_format($montoDescargo/$valmon, 2, '.', ',')?></td><?php
                                  }
                                  
                                }
                              ?>                             
                               <?php
                               echo "</a></tr>"; 
                            $numero++;}
                        }
                        
                      }?>
                       </tbody>
                      </table> 
                     </div>
                  </div>
                  <br><br><hr>
                      <?php

                      }
                } ?>                    
              </div>
            </div>
          </div>
      </div>

      
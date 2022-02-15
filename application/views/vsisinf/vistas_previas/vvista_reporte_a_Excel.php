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
<?php
setlocale(LC_TIME, "Spanish");
//Devuelve el resultado en español

header('Content-type: application/vnd.ms-excel; charset=iso-8859-1');
header('Content-Disposition: attachment; filename=reporte.xls');

?>

<html>
  <head>
  </head>

<body>


  <footer>
  <center><label id="footer_texto"><?=$ciudad?>,  <?=strftime('%d de %B de %Y',time())?></label></center><!--<img class="logo-pie" src="imagenes/logo_tierra1.png">-->   
  </footer>

<div id="header_titulo_texto" style="color:#494f4a; font-size:35px;">TIERRA<br>
   "<?=utf8_decode($proy->nombre_proyecto)?>"<br>
   REPORTES / ACTIVIDAD - ITEM
</div>
<br><br><br>

<div class="content">
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
                    ?><div class="row">
                        <div class="col-md-4">
                         <?php
                      if($cambioMon==null){ $moneda= "Bs";}else{ $moneda= $cambioMon->moneda;}
                      $porciones = explode("@", $pr->descripcion);
                      echo "<h5 class='text-muted'>".utf8_decode($porciones[0])." @ <small>".utf8_decode($pr->descripcionr)."</small></h5><br>";
                      ?>
                      <table class="table text-small">
                        <tr>
                          <td class="text-azul-oscuro text-center" style='color:blue'>Oringinal</td>
                          <td class="text-danger text-center" style='color:red'>Ajuste</td>
                          <td class="text-info text-center" style='color:green'>Actual</td>
                        </tr>
                        <tr>
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
                      echo "<div class='float-right' style='color:green'><label>Saldo</label><br> <p class='btn ".$estilosaldo."'>".$moneda." ".number_format($pr->saldos, 2, '.', ',')."</p></div><div class='float-left' style='color:#c2990b'><label>Ejecutado</label><br> <p class='btn btn-warning'>".$moneda." ".number_format($pr->periodo, 2, '.', ',')."</p></div><br><br><br>";
                      ?>
                        </div>
                        <div class="col-md-8">
                         <table id="" class="table text-small" border="1">
                           <thead>
                           <tr style="background:#e4821a;color:white;">
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
                               <td><?=utf8_decode($activ[0])?></td>
                               <td> <?=$smi->nombre_persona?> <?=$smi->apellido_persona?></td>
                               <td><?=strftime('%d de %B de %Y',strtotime($smi->fecha_s))?></td>
                               <?php 
                              if($act->id_estado==4){
                                    ?><td><?=number_format($smi->monto/$valmon, 2, '.', ',')?></td><?php
                                  }else{
                                    ?><td class="text-danger"><?=number_format($smi->monto/$valmon, 2, '.', ',')?></td><?php
                                  }
                                if($detalle==null){
                                  ?><td>Sin Descargo</td><?php
                                }else{
                                  $montoDescargo=0;
                                  foreach ($detalle->result() as $det) {
                                    $montoDescargo=$montoDescargo+$det->monto;
                                  }
                                  if($act->id_estado==4){
                                    ?><td class="text-danger"><?=number_format($montoDescargo/$valmon, 2, '.', ',')?></td><?php
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

      </body>
</html>
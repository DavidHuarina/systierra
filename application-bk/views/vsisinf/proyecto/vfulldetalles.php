                   <?php
                     $tori=0;$taju=0;$tac=0;$cro=[];$craj=[];$crac=[];$crr=null;
                     foreach ($ep->result() as $pr) {
                      $tori=$pr->original+$tori;
                      $taju=$pr->ajustes+$taju;
                      $tac=$pr->actual+$tac;
                       
                       if($crr==null){
                          $cro[$pr->codigor]=$pr->original;
                          $craj[$pr->codigor]=$pr->ajustes;
                          $crac[$pr->codigor]=$pr->actual;
                          $crr=$pr->codigor;
                      }else{
                        if($crr!=$pr->codigor){
                          $cro[$pr->codigor]=$pr->original;
                          $craj[$pr->codigor]=$pr->ajustes;
                          $crac[$pr->codigor]=$pr->actual;
                        }else{
                           $cro[$pr->codigor]=$pr->original+$cro[$pr->codigor];
                           $craj[$pr->codigor]=$pr->ajustes+$craj[$pr->codigor];
                          $crac[$pr->codigor]=$pr->actual+$crac[$pr->codigor];
                        }
                      }
                        $crr=$pr->codigor;
                      }
                      ?>
                    <?php
                     $tsal=0;$tper=0;$tacu=0;$cro2=[];$craj2=[];$crac2=[];$craj3=[];$crac3=[];$crr2=null;
                     foreach ($ep->result() as $pr) {
                      $tsal=$pr->saldos+$tsal;
                      $tper=$pr->periodo+$tper;
                      $tacu=$pr->acumulado+$tacu;
                      if($crr2==null){
                          $cro2[$pr->codigor]=$pr->saldos;
                          $craj2[$pr->codigor]=$pr->periodo;
                          $crac2[$pr->codigor]=$pr->acumulado;
                          $crr2=$pr->codigor;
                      }else{
                        if($crr2!=$pr->codigor){
                          $cro2[$pr->codigor]=$pr->saldos;
                          $craj2[$pr->codigor]=$pr->periodo;
                          $crac2[$pr->codigor]=$pr->acumulado;
                        }else{
                           $cro2[$pr->codigor]=$pr->saldos+$cro2[$pr->codigor];
                           $craj2[$pr->codigor]=$pr->periodo+$craj2[$pr->codigor];
                          $crac2[$pr->codigor]=$pr->acumulado+$crac2[$pr->codigor];
                        }
                      }
                        $crr2=$pr->codigor;
                      }

                      $por_p=($tac*100)/$tori;
                      $por_e=($tacu*100)/$tac;
                      $por_s=($tsal*100)/$tac;
                      ?>
  <!--<div class="panel-header">
        <div class="header text-center">
        <h2 class="title"><?=$proy->nombre_proyecto?></h2>
          <p class="category"><?php if($proy->resumen==""){ echo "Sin descripción";}else{ echo "".$proy->resumen."";}?>

          </p>
        </div>
    </div>-->
<div class="panel-header panel-header-sm">
</div>
<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-user">
              <div class="image">
                <img src="apps/assets/img/f_11.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="imagenes/proyecto/p.jpg" alt="images">
                    <h5 class="title"><?=$proy->nombre_proyecto?></h5>
                  </a>
                  <p class="description text-dark">
                   Codigo: <?=$proy->id_proyecto?> / Fondo: <?=$fondos->descripcion?>
                  </p>
                </div>
                <p class="text-center description">
                  " <?=$proy->resumen?> "
                </p>
                <p class="text-center">Duraci&oacute;n: <?php
                  $f1=new DateTime($proy->fecha_inicio);
                  $f2=new DateTime($proy->fecha_fin);
                  $ed = $f1->diff($f2);
                  if((string)$ed->y=='1'){
                    echo $ed->y.' <small class="text-primary">Año,</small> ';
                  }else{
                  echo $ed->y.' <small class="text-primary">Años,</small> ';
                   } 
                   if((string)$ed->m=='1'){
                    echo $ed->m.' <small class="text-primary">Mes,</small> ';
                  }else{
                  echo $ed->m.' <small class="text-primary">Meses,</small> ';
                   } 
                  if((string)$ed->days=='1'){
                    echo $ed->d .' <small class="text-primary">dia</small>';
                  }else{
                  echo $ed->d .' <small class="text-primary">dias</small>';
                   }

                   ?>
                      <a class="text-info" href="#"> Ampliar plazo</a></p>
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
                  <a class="btn dt-button-primary float-left" href="cdetalle_proyecto?id=<?=$proy->id_proyecto?>">
                     ATRAS</a>
                  <div class="dropdown float-left">
                   <a class="btn btn-secondary btn-simple dropdown-toggle" href="#" id="expo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img class="" src="apps/full-icon/flat/oficina/usb.png" width="16" height="16"> Exportar
                   </a>
                   <div class="dropdown-menu dropdown-menu-left" aria-labelledby="expo">
                    <?php if($cambioMon==null){
                      $ca_expo=0;
                    }else{
                      $ca_expo=$cambioMon->id_cambio;
                    }?>
                     <a href="cfulldetalles/exportar/<?=$proy->id_proyecto?>/<?=$ca_expo?>"class="dropdown-item"><img class="" src="apps/full-icon/flat/documentos/pdf-5.png" width="16" height="16"> PDF</a>
                      <a href="cfulldetalles/exportarExcel/<?=$proy->id_proyecto?>/<?=$ca_expo?>" class="dropdown-item"><img class="" src="apps/full-icon/flat/docs/034-excel.png" width="16" height="16"> CSV (Excel)</a>
                   </div>
                 </div>
                  <?php if($cambioMon!=null){
                    ?>
                     <!--<a href="#" onclick="notificacion('top','left','holitas','danger','now-ui-icons ui-1_bell-53')">mensaje</a> -->
                    <center><label>Valor del cambio:</label> <p class="text-lg"><?=$cambioMon->valor?> <small><?=$cambioMon->moneda?></small></p></center><?php
                  }?>
                      
                  <div class="form-group col-md-3 float-right">
                         <select id="select-dinero-cm" name="select-dinero-cm" onchange="window.location.href='cfulldetalles?id=<?=$proy->id_proyecto?>&c='+this.value" class="form-control select-single-plantilla">
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

              </div>
            </div>
          </div>         
        </div>
         <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                 
                <h5 class="card-title">Presupuestado <small class="text-muted">(<?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>)</small>
                  <small class="text-muted">Original </small><label id="lb-original" for="" class="text-primary"><?=number_format($tori, 2, '.', ',');?></label> 
                  <small class="text-muted">Ajustes </small><label id="lb-ajustes" for="" class="text-info"><?=number_format($taju, 2, '.', ',');?></label>
                  <small class="text-muted">Actual </small><label id="lb-actual" for="" class="text-info"><?=number_format($tac, 2, '.', ',');?></label>
                </h5>
                <a href="cfondo_proy_edit?id=<?=$proy->id_proyecto?>" class="btn btn-primary btn-sm">Editar Presupuesto</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-fixed text-small">
                    <thead class="bg-plomo text-white">
                      <th>
                        C&oacute;digo
                      </th>
                      <th>
                        Descripci&oacute;n
                      </th>
                      <th class="text-right">
                        Original
                      </th>
                      <th class="text-right">
                        Ajustes
                      </th>
                      <th class="text-right">
                        Actual
                      </th>
                      <th class="text-right">
                        Ajustar
                      </th>
                    </thead>
                    <tbody>
                      <?php
                      $idep=null;
                     foreach ($ep->result() as $pr) {
                      
                      if($idep==null){
                        ?>
                          <tr>
                        <td>
                          <b><?=$pr->codigor?></b>
                        </td>
                        <td>
                          <b><?=$pr->descripcionr?></b>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <b><?=number_format($cro[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <b><?=number_format($craj[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <b><?=number_format($crac[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                        <td class="text-right"></td>
                      </tr> 
                        <?php
                      }else{
                        if($idep!=$pr->codigor){
                          ?>
                          <tr>
                        <td>
                          <b><?=$pr->codigor?><b>
                        </td>
                        <td>
                          <b><?=$pr->descripcionr?></b>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <b><?=number_format($cro[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <b><?=number_format($craj[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <b><?=number_format($crac[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                        <td class="text-right"></td>
                      </tr> 
                          <?php
                        }
                      }
                        $idep=$pr->codigor;
                      ?>
                       <tr>
                        <td>
                          <?=$pr->codigo?>
                        </td>
                        <td>
                          <?php $porciones = explode("@", $pr->descripcion);?>
                          <?=$porciones[0]?>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <?=number_format($pr->original, 2, '.', ',');?>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <?=number_format($pr->ajustes, 2, '.', ',');?>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <?=number_format($pr->actual, 2, '.', ',');?>
                        </td>
                        <td class="text-right"><a class="" href="#" data-toggle="modal" onclick="mandaVal(<?=$pr->id_ep?>,'codigo_ep'); cambiarlbl('<?=$porciones[0]?>','titulo_ep');" data-target="#ajus">
                              <i class="fa fa-plus text-warning fa-fw"></i></a></td>
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">

                <h5 class="card-title">Ejecuci&oacute;n <small class="text-muted">(<?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>)</small>
                  <small class="text-muted">Saldo a ejecutar </small><label for="" class="text-success"><?=number_format($tsal, 2, '.', ',');?></label> 
                  <small class="text-muted">Periodo </small><label for="" class="text-info"><?=number_format($tper, 2, '.', ',');?></label>
                  <small class="text-muted">Acumulado </small><label for="" class="text-info"><?=number_format($tacu, 2, '.', ',');?></label>
                </h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-fixed text-small">
                    <thead class="bg-plomo text-white">
                      <th>
                        C&oacute;digo
                      </th>
                      <th>
                        Descripci&oacute;n
                      </th>
                      <th class="text-right">
                        Actual
                      </th>
                      <th class="text-right">
                        Periodo
                      </th>
                      <th class="text-right text-warning">
                        %P
                      </th>
                      <th class="text-right">
                        Acum.
                      </th>
                      <th class="text-right text-warning">
                        %A
                      </th>
                      <th class="text-right">
                        Saldos
                      </th>
                    </thead>
                    <tbody>
                      <?php
                      $idep2=null;
                     foreach ($ep->result() as $pr) {
                      if($idep2==null){
                        ?>
                          <tr>
                        <td>
                          <b><?=$pr->codigor?></b>
                        </td>
                        <td>
                          <b><?=$pr->descripcionr?></b>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <b><?=number_format($crac[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <b><?=number_format($craj2[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                        <td class="text-right">
                          <?php $craj3[$pr->codigor]=($craj2[$pr->codigor]*100)/$crac[$pr->codigor];?><b><?=number_format($craj3[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <b><?=number_format($crac2[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                        <td class="text-right">
                          <b><?=number_format($craj3[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <b><?=number_format($cro2[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                      </tr> 
                        <?php
                      }else{
                        if($idep2!=$pr->codigor){
                          ?>
                          <tr>
                        <td>
                          <b><?=$pr->codigor?><b>
                        </td>
                        <td>
                          <b><?=$pr->descripcionr?></b>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <b><?=number_format($crac[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <b><?=number_format($craj2[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                        <td class="text-right">
                          <?php $craj3[$pr->codigor]=($craj2[$pr->codigor]*100)/$crac[$pr->codigor];?><b><?=number_format($craj3[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <b><?=number_format($crac2[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                        <td class="text-right">
                          <b><?=number_format($craj3[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <b><?=number_format($cro2[$pr->codigor], 2, '.', ',');?></b>
                        </td>
                      </tr> 
                          <?php
                        }
                      }
                        $idep2=$pr->codigor;
                      ?>
                       <tr>
                        <td>
                          <?=$pr->codigo?>
                        </td>
                        <td>
                          <?php $porciones = explode("@", $pr->descripcion);?>
                          <?=$porciones[0]?>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <?=number_format($pr->actual, 2, '.', ',');?>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <?=number_format($pr->periodo, 2, '.', ',');?>
                        </td>
                        <td class="text-right">
                          <?=$pr->por_per?>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <?=number_format($pr->acumulado, 2, '.', ',');?>
                        </td>
                        <td class="text-right">
                          <?=$pr->por_acu?>
                        </td>
                        <td class="text-right text-success">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <?=number_format($pr->saldos, 2, '.', ',');?>
                        </td>
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

      
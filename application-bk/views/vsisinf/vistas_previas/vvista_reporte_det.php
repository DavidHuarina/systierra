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
?>
<html>
  <head>

  <!-- CSS Files -->
  <link rel="stylesheet" href="apps/dompdf.css">
  <link href="apps/css/micss.css" rel="stylesheet" />
  </head>

<body>

  <header>            
      <img class="imagen-logo" src="images/logo.png">
 </header>


  <footer>
  <center><label id="footer_texto"><?=$ciudad?>,  <?=strftime('%d de %B de %Y',time())?></label></center><!--<img class="logo-pie" src="imagenes/logo_tierra1.png">-->   
  </footer>
  <div id="header_titulo_texto">TIERRA<br>
  "<?=$proy->nombre_proyecto?>"<br> REPORTES / PRESUPUESTO
</div>
<div class="content">
         <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                 
                <h5 class="card-title">Presupuestado <small class="text-muted">(<?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>)</small>
                  <small class="text-muted">Original </small><label id="lb-original" for="" class="text-primary"><?=number_format($tori, 2, '.', ',');?></label> 
                  <small class="text-muted">Ajustes </small><label id="lb-ajustes" for="" class="text-info"><?=number_format($taju, 2, '.', ',');?></label>
                  <small class="text-muted">Actual </small><label id="lb-actual" for="" class="text-info"><?=number_format($tac, 2, '.', ',');?></label>
                </h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                      <th>
                        #
                      </th>
                      <th>
                        Descripci&oacute;n
                      </th>
                      <th>
                        Rubro
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
                      </tr>
                      
                    </thead>
                    <tbody>
                      <?php
                     foreach ($ep->result() as $pr) {
                      ?>
                       <tr>
                        <td>
                          <?=$pr->id_subr?>
                        </td>
                        <td>
                          <?php $porciones = explode("@", $pr->descripcion);?>
                          <?=$porciones[0]?>
                        </td>
                        <td>
                          <?=$pr->descripcionr?>
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
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
                       <th>
                        #
                      </th>
                      <th>
                        Descripci&oacute;n
                      </th>
                      <th>
                        Rubro
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
                      </tr>
                      
                    </thead>
                    <tbody>
                      <?php
                     foreach ($ep->result() as $pr) {
                      ?>
                       <tr>
                        <td>
                          <?=$pr->id_subr?>
                        </td>
                        <td>
                          <?php $porciones = explode("@", $pr->descripcion);?>
                          <?=$porciones[0]?>
                        </td>
                        <td>
                          <?=$pr->descripcionr?>
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

      </body>
</html>
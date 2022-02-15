<?php 
  $recep=$this->solicitud->getAllReceptor($sol);
  $soli=$this->solicitud->getAllSolicitante($sol);
$solicitude=$this->solicitud->getById($sol);
   $importe=0;
      foreach ($sm->result() as $smi) {
     $importe=$importe+$smi->monto;
      }
$totalsol=0;
  foreach ($dg->result() as $detg) {
   $totalsol=$detg->monto_impuesto+$totalsol;
   }
   if($importe==0){
   $saldo=$solicitude->total-$totalsol;
   }else{
    $saldo=$importe-$totalsol;
   }

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

  <header class="headDes">            
      
 </header>


  <footer>
  <center><label id="footer_texto"><?=$ciudad?>,  <?=strftime('%d de %B de %Y',time())?></label></center><!--<img class="logo-pie" src="imagenes/logo_tierra1.png">-->   
  </footer>

<div class="cont_des">
  <img class="imagen-logo" src="images/logo.png">
<?php $porciones = explode("@", $actividad->sub_nom);?>
<div id="header_titulo_texto_des">TIERRA</div>
<?=$regional?>
<div id="header_titulo_texto">DESCARGO DE FONDOS FORMULARIO N° 3</div>
<br><br><br>
<div class="card-body">
                <div class="card">
                 <div class="card-body">
                  <table class="table-inf">
                      <tr>
                        <td>
                        <table class="table-inf">
                   <tr>
                    <td><label class="text-muted">Presentado por</label><br>(Nombre y firma)</td>
                    <td><label class="text-dark">_____________________________<br><?=$soli->nombre_persona?> <?=$soli->apellido_persona?></label></td>
                  </tr>
                  <tr>
                    <td><label class="text-muted">Cargo</label></td>
                    <td><label class="text-dark"><?=$soli->nombre_cargo?></label></td>
                  </tr>
                  <tr><td></td><td></td></tr>
                  <tr><td></td><td></td></tr>
                  <tr><td></td><td></td></tr>
                  <tr><td></td><td></td></tr>
                  <tr>
                    <td><label class="text-muted">Importe recibido (Bs)</label></td>
                    <td><label class="text-dark"><?php 
                            if($importe<=0){
                                
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
                    </label></td>
                  </tr>
                  <tr>
                    <td><label class="text-muted">Banco</label></td>
                    <td><label class="text-dark"><?=$descargo->banco?></label></td>
                  </tr>
                  <tr>
                    <td><label class="text-muted">N. de Cheque</label></td>
                    <td><label class="text-dark"><?=$descargo->n_cheque?></label></td>
                  </tr>
                  <tr>
                    <td><label class="text-muted">Total Gastos (Bs)</label></td>
                    <td><label class="text-dark"><?=number_format($totalsol, 2, '.', ',');?></label></td>
                  </tr>
                  <tr><td></td><td></td></tr>
                  <tr><td></td><td></td></tr>
                  <tr><td></td><td></td></tr>
                  <tr><td></td><td></td></tr>
                  <tr>
                    <td><label class="text-muted">Saldo depositado (Bs)</label></td>
                    <td><label class="text-dark">
                    <?php 
                     if($saldo<=0){
                            ?>
                          <?=number_format($saldo-$saldo, 2, '.', ',');?>
                            <?php
                           }else{
                            ?>
                           
                          <?=number_format($saldo, 2, '.', ',');?> 
                            <?php
                           }
                    ?>
                     </label></td>
                  </tr>
                  <tr>
                    <td><label class="text-muted">Fecha del descargo</label></td>
                    <td><label class="text-dark"><?php if($descargo->f_descargo=='0001-01-01 00:00:00'){
                            ?> Sin fecha de descargo<?php
                           }else{
                             ?><?=strftime('%d de %B de %Y',strtotime($descargo->f_descargo))?><?php
                           }
                           ?></label></td>
                  </tr>
                  </table>
                        </td>
                        <td>
                        <table class="firma">
                         <tr>
                           <td class="ref"><b>APROBADO POR:</b><br>
                          Director de Área Organizacional</td>
                           <td class="ref" valign="top">_________________________________________</td>
                           
                         </tr>
                         <tr><td></td><td></td></tr>
                         <tr><td></td><td></td></tr>
                         <tr><td></td><td></td></tr>
                         <tr><td></td><td></td></tr>
                         <tr><td></td><td></td></tr>
                         <tr><td></td><td></td></tr>
                         <tr><td></td><td></td></tr>
                         <tr><td></td><td></td></tr>
                         <tr><td></td><td></td></tr>
                         <tr><td></td><td></td></tr>
                         <tr><td></td><td></td></tr>
                         <tr><td></td><td></td></tr>
                         <tr>
                          <td class="ref"><b> &oacute; AUTORIZADO POR:</b><br>
                          Administrador Financiero</td>
                          <td class="ref" valign="top">_________________________________________</td>
                        </tr>
                    </table>
                        </td>
                      </tr>
                  </table>
                  
                  <br><br>
                  <div>
                  <table class="table-des">
                    <tr class="">
                      <td class=" center-txt">
                        <b>Factura / Recibo</b>
                      </td>
                      <td class=" center-txt">
                        <b>Fecha</b>
                      </td>
                      <td class=" center-txt">
                        <b>Razon social</b>
                      </td>
                      <td class=" center-txt">
                        <b>Detalle</b>
                      </td>
                      <td class="derecha">
                        <b>Monto total</b>
                      </td>
                    </tr>
                      <?php
                      $numero=0;
                     foreach ($dg->result() as $detg) {
                      $numero=$numero+1;
                      ?>
                       <tr class="bg-pluma">
                        <?php 
                         if($detg->impuesto_serv>0){
                          ?>
                          <td>
                          No aplica
                          </td>
                          <?php
                         }else{
                           if($detg->impuesto_bien>0){
                             ?>
                             <td class="center-txt">
                              <?=$detg->n_fac_reci?>
                             </td>
                             <?php
                           }else{
                             ?>
                             <td class="center-txt">
                               <?=$detg->n_fac_reci?>
                             </td>
                             <?php
                           }
                          
                         } 
                        ?>
                        
                        <td class="center-txt">
                          <?=strftime('%d de %B de %Y',strtotime($detg->fecha))?>
                        </td>
                        <td class="center-txt">
                          <?php $porciones = explode("@", $detg->descripcion);?>
                          <?=$porciones[0]?>
                        </td>
                        <td class="center-txt">
                          <?=$detg->nombre_detalle?>
                        </td>
                        <td class="derecha">
                          <small class="text-dark">Bs.</small> <?=number_format($detg->monto_impuesto, 2, '.', ',');?>
                        </td>
                      </tr> 
                      <?php
                     }
                      ?>
                     <tr class="fila-totales">
                        <td class="title center-text">
                          Total Gastos Bs.
                        </td>
                        <td>
                          
                        </td>
                        <td>
                          
                        </td>
                        <td>
                          
                        </td>
                        <td class="title derecha">
                           <small class="text-dark">Bs.</small><?=number_format($totalsol, 2, '.', ',');?>
                        </td>
                      </tr>
                  </table>
                </div> 
                <br><br>
                <div></div>            
                 </div>
               </div>                       
              </div>
     </div>
      </body>
</html>
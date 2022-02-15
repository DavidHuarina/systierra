<?php 
  $recep=$this->solicitud->getAllReceptor($sol);
  $soli=$this->solicitud->getAllSolicitante($sol);

   $importe=0;
      foreach ($sm->result() as $smi) {
     $importe=$importe+$smi->monto;
      }
$totalsol=0;
  foreach ($dg->result() as $detg) {
   $totalsol=$detg->monto+$totalsol;
   }
$saldo=$importe-$totalsol;
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
  <center><label id="footer_texto">La Paz,  <?=strftime('%d de %B de %Y',time())?></label></center><!--<img class="logo-pie" src="imagenes/logo_tierra1.png">-->   
  </footer>

<?php $porciones = explode("@", $actividad->sub_nom);?>
<div id="header_titulo_texto">TIERRA<br>
  DESCARGO DE FONDOS Formulario N° 3 
</div>
<br><br><br>
<div class="card-body">
                <div class="card">
                 <div class="card-body">
                  <table class="table-inf">
                   <tr>
                    <td><label class="text-muted">Presentado por</label></td>
                    <td><label class="text-dark"><?=$soli->nombre_persona?> <?=$soli->apellido_persona?></label></td>
                  </tr>
                  <tr>
                    <td><label class="text-muted">Cargo</label></td>
                    <td><label class="text-dark"><?=$soli->nombre_cargo?></label></td>
                  </tr>
                  <tr><td></td><td></td></tr>
                  <tr><td></td><td></td></tr>
                  <tr>
                    <td><label class="text-muted">Importe recibido (Bs)</label></td>
                    <td><label class="text-dark"><?=number_format($importe, 2, '.', ',');?></label></td>
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
                  <tr>
                    <td><label class="text-muted">Saldo depositado (Bs)</label></td>
                    <td><label class="text-dark"><?=number_format($saldo, 2, '.', ',');?></label></td>
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
                  <hr>

                 <!-- <p class="title">Algun comentario</p>-->
                  <br><br><br><br><br>
                  <div>
                  <table class="table-des">
                    <tr class="fila-secondary">
                      <td class=" center-txt">
                        #
                      </td>
                      <td class=" center-txt">
                        Factura / Recibo
                      </td>
                      <td class=" center-txt">
                        Fecha
                      </td>
                      <td class=" center-txt">
                        Razon social
                      </td>
                      <td class=" center-txt">
                        Detalle
                      </td>
                      <td class="derecha">
                        Monto total
                      </td>
                    </tr>
                      <?php
                      $numero=0;
                     foreach ($dg->result() as $detg) {
                      $numero=$numero+1;
                      ?>
                       <tr>
                        <td class="center-txt">
                          <?=$numero?>
                        </td>
                        <td class="center-txt">
                          <?=$detg->n_fac_reci?>
                        </td>
                        <td class="center-txt">
                          <?=$detg->fecha?>
                        </td>
                        <td class="center-txt">
                          <?php $porciones = explode("@", $detg->descripcion);?>
                          <?=$porciones[0]?>
                        </td>
                        <td class="center-txt">
                          <?=$detg->nombre_detalle?>
                        </td>
                        <td class="derecha">
                          <small class="text-dark">Bs.</small> <?=number_format($detg->monto, 2, '.', ',');?>
                        </td>
                      </tr> 
                      <?php
                     }
                      ?>
                     <tr class="fila-totales">
                        <td class="title center-text">
                          Total gastos
                        </td>
                        <td>
                         
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
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <div><table class="firma">
                         <tr>
                           <td class="ref">_________________________</td>
                           <td class="ref">_________________________</td>
                           <td class="ref">_________________________</td>
                         </tr>
                         <tr>
                          <td class="ref" valign="top"><b>FIRMA</b><br>
                            <?=$soli->nombre_persona?> <?=$soli->apellido_persona?></td>
                          <td class="ref" valign="top"><b>APROBADO POR</b><br>
                          Director de Área Organizacional</td>
                          <td class="ref" valign="top"><b> &oacute; AUTORIZADO POR</b><br>
                          Administrador Financiero</td>
                        </tr>
                    </table></div>            
                 </div>
               </div>                       
              </div>

      </body>
</html>
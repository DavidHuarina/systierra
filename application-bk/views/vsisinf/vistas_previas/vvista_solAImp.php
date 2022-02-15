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

<body class="solImp">

  <header>            
      <img class="imagen-logo-izq" src="images/logo.png">
 </header>


  <footer>
  <center><label id="footer_texto"><?=$ciudad?>,  <?=strftime('%d de %B de %Y',time())?></label></center><!--<img class="logo-pie" src="imagenes/logo_tierra1.png">-->   
  </footer>

<?php 
  $recep=$this->solicitud->getAllReceptor($sol);
  $soli=$this->solicitud->getAllSolicitante($sol);
  $solici=$this->solicitud->getById($sol);
  $totalsol=0;$item=0;
 $totalsol=0;$item=0;
                     foreach ($sm->result() as $sum) {
                      $totalsol=$sum->monto+$totalsol;
                      }
                      
                      ?>
<div id="header_titulo_texto">TIERRA<br>
  SOLICITUD DE FONDOS EN AVANCE FORMULARIO N° 2 
</div><br><br>
   <div class="content">
        <div class="cont">
          <div class="cont-borde">
            <div class="cont-borde-in">
              <div class="cont-cuerpo">
                    <table>
                      <tr><td valign="top"><label>PROYECTO:</label></td><td valign="top" colspan="3"><label class="text-md text-dark"><b><?php $porProy = explode("/",$proy->nombre_proyecto);?><?=$porProy[0]?></b></label></td></tr>
                        <tr><td valign="top"><label>LUGAR Y FECHA DE SOLICITUD:</label></td><td valign="top" colspan="3"><label class="text-dark"><?=$ciudad?>, <?=strftime('%d de %B de %Y',strtotime($solici->fecha_s))?></label></td></tr>
                         <!--<tr><td><label>BANCO</label></td><td><label class="text-md text-dark"></label></td><td><label>N° CUENTA</label></td><td><label class="text-md text-dark"></label></td></tr>-->
                         <tr><td><label>DESCRIPCION DE GASTOS (Expresado en Bs.)</label></td><td></td></tr>
                    </table>
                    <hr>
                      
                    <br><br>
                    <label>Solicita a la Administraci&oacute;n Financiera del Taller de Iniciativas en Estudios Rurales y Reforma Agraria "TIERRA", autorice el desembolso de fondos en avance para la realización de las siguientes actividades</label>
                    <br><br>
                  <?php $porciones = explode("@", $actividad->sub_nom);?>
                    <div id="header_titulo_texto">
                          <?=strtoupper($porciones[0])?></div>
                          <br>
                 Observaciones
                 <br>
                <table class="tabla_p" cellspacing="0">
                  <tr><td style="text-align: left;" colspan="4"><b>GASTOS OPERATIVOS</b></td></tr>
                           <tr>
                             <td>
                               <b class="text-white"><small>Item<small></b>
                            </td>
                             <td>
                                <b class="text-white" style="text-align: left;"><small>Detalle<small></b>
                             </td>
                             <td>
                                <b class="text-white" style="text-align: left;"><small>Partida Presupuestaria<small></b>
                             </td>
                             <td>
                                <b class="text-white"><small>Monto (Bs)<small></b>
                             </td>
                           </tr>
                    <?php
                    foreach ($sm->result() as $sum) {
                      $item++;
                      ?>
                      <tr>
                        <td><?=$item?></td>
                         <td><?php $porciones = explode("@", $sum->descrip);?> <?=$porciones[0]?></td>
                         <td><b><?=$porciones[1]?><b></td>
                         <td align="right"><?=number_format($sum->monto, 2, '.', ',');?></td>
                      </tr>
                      <?php
                    }
                    $nuevoDias=(int)$actividad->act_dias-1;
                    ?>
                    <tr>
                        <td style="text-align: center;" colspan="3"><b>TOTAL GASTOS OPERATIVOS</b></td>
                         <td align="right"><b><?=number_format($totalsol, 2, '.', ',');?></b></td>
                      </tr>
                   </table>
                   <br>
                   <table>
                
                        <tr><td valign="top"><label>Desde:</label></td><td class="fechassol"><label class="text-dark"><?=strftime('%d de %B de %Y',strtotime($actividad->act_fecha))?></label></td></tr>
                        <?php $end = strtotime ( '+'.$nuevoDias.' day' , strtotime ($actividad->act_fecha)) ;
                  $end=strftime('%d de %B de %Y',$end);
                  ?>
                         <tr><td><label>Hasta:</label></td><td class="fechassol"><?=$end?></td></tr>
                    </table>
             <br><br>
                      <label>Fondos Solicitados Por:</label><br><br>
                      <div><table class="firma">
                         <tr>
                           <td valign="top"><b>FIRMA</b></td>
                           <td>............................................................</td>
                         </tr>
                         <tr>
                          <td valign="top"><b>NOMBRE: </b></td>
                          <td valign="top"><?=$soli->nombre_persona?> <?=$soli->apellido_persona?></td>
                        </tr>
                        <tr>
                          <td valign="top"><b>CARGO: </b></td>
                          <td valign="top"><?=$soli->nombre_cargo?></td>
                        </tr>
                    </table></div>                     
              </div>
            </div>
          </div>
        </div>
  </div> 
  <!--<div style="page-break-after:always;"></div>-->
   <div class="container">
       <div class="cont">  
          <div class="cont-borde">
            <div class="cont-borde-in">
              <div class="cont-cuerpo">
                <p class="text-derecha">(Cuadro a ser llenado por Oficina Nacional)</p>
                      <table class="firma2">
                         <tr>
                           <td valign="top">FECHA DE RECEPCION DE LA SOLICITUD</td>
                           <td>........./........./.........</td>
                         </tr>
                         <tr><td></td><td></td></tr>
                         <tr>
                          <td valign="top">MONTO AUTORIZADO PARA LA TRANSFERENCIA</td>
                          <td>..............................</td>
                        </tr>
                        <tr><td></td><td></td></tr>
                        <tr>
                           <td valign="top">FECHA DE ENVIO DE FONDOS</b></td>
                           <td>........./........./.........</td>
                         </tr>
                    </table>
                    <br>
                    <table class="firma2">
                         <tr>
                           <td align="center">Revisado por:  Elizabeth Mollinedo Garcia</td>
                           <td align="center">Aprobado por: Jose Luis Eyzaguirre</td>
                         </tr>
                         <tr>
                          <td align="center"><b>Contadora</b></td>
                          <td align="center"><b>Administrador Financiero</b></td>
                        </tr>
                    </table>                      
              </div>
            </div>
          </div>
        </div>
      </div>
   <div class="container">
       <div class="cont">  
          <div class="cont-borde">
            <div class="cont-borde-in">
              <div class="cont-cuerpo-2">
                <center><b>IMPORTANTE</b></center>
                  Toda Solicitud de fondos debe adiuntar la "Libreta Bancaria" actualizada a la fecha de solicitud.                     
              </div>
            </div>
          </div>
        </div>
   </div>
      </body>
</html>
<?php 
  $recep=$this->solicitud->getAllReceptor($sol);
  $soli=$this->solicitud->getAllSolicitante($sol);

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

<?php $porciones = explode("@", $actividad->sub_nom);?>
<br><br><br><br>
<div class="content">
                <div class="cont">
                 <div class="cont-borde">
                  <br><div class="derecha"><b>FORMULARIO  N° 4</b></div>
                      <div id="header_titulo_texto">TIERRA<br>FORMULARIO DE REEMBOLSO</div>
                      
                      <br><br><br>
                  <table class="table-inf-reem">
                   <tr>
                    <td width="30%"><label class=""><b>Nombres y Apellidos</b></label></td>
                    <td width="70%"><label class="text-dark"><?=$soli->nombre_persona?> <?=$soli->apellido_persona?></label></td>
                  </tr>
                  <tr>
                    <td width="30%"><label class=""><b>Cargo</b></label></td>
                    <td width="70%"><label class="text-dark"><?=$soli->nombre_cargo?></label></td>
                  </tr>
                  <tr>
                    <td width="30%"><label class=""><b>Nro. De Memorando</b></label><br>(Cuando corresponda)</td>
                    <td width="70%"><label class="text-dark"></label></td>
                  </tr>
                  <tr>
                    <td width="30%"><label class=""><b>Total Reembolso (Bs)</b></label></td>
                    <td width="70%"><label class="text-dark"><?php if($reembolso==null){
                         ?><?=number_format(0, 2, '.', ',');?><?php
                        }else{
                         ?><?=number_format($reembolso->monto, 2, '.', ',');?><?php
                        }?></label></td>
                  </tr>
                  </table>
                  <div>
                          <br><br><br>
                           <p class="title">JUSTIFICACION DEL REEMBOLSO</p>
                           <div class="hr"></div>
                           
                           <div class="justi justificar">
                  <?php if($reembolso==null){
                         ?>Sin Justificación. No registro el reembolso<?php
                        }else{
                         ?><label><?=$reembolso->justificacion?></label><?php
                        }?>
                         </div>
                         <br><br>
                         <p><b>Bs.<?php if($reembolso==null){
                         ?><?=number_format(0, 2, '.', ',');?><?php
                        }else{
                         ?><?=number_format($reembolso->monto, 2, '.', ',');?><?php
                        }?></b></p>
                  
                </div> 
                <br><br><br><br><br><br><br><div class="hr"></div><br><br><br>
                <div><table class="firma">
                         <tr>
                           <td class="ref">____________________________________</td>
                           <td class="ref">____________________________________</td>
                         </tr>
                         <tr><td></td><td></td></tr>
                         <tr>
                          <td class="ref" valign="top"><b>SOLICITADO POR</b><br>
                            <?=$soli->nombre_persona?> <?=$soli->apellido_persona?></td>
                          <td class="ref" valign="top"><b>AUTORIZADO POR</b><br>Gerente Nacional o<br>Director Regional o<br>Gerente de Proyecto
                          </td>
                        </tr>
                    </table></div>
                    <br><br><br><br>
                    <p class=""><b>Lugar, fecha y año:</b> <?=$ciudad?> - <?=strftime('%d de %B de %Y',time())?></p>            
                 </div>
               </div>                       
              </div>

      </body>
</html>
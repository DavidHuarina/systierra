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

<body class="sbody">

  <header class="header2">            
      <img class="imagen-logo" src="images/logo.png">
 </header>


<?php $porciones = explode("@", $actividad->sub_nom);?>
<div id="header_titulo_texto">TIERRA</div>
<div id="header_titulo_texto_inf">INFORME DE ACTIVIDADES</div>

<br>
<div class="contInforme">
                <div class="card">
                 <div class="card-body">
                  <table class="table-inf">
                   <tr><td width="20%"><p class="title">PROYECTO</p></td><td width="80%"><?=strtoupper($proy->nombre_proyecto)?></td></tr>
                  </table>
                  <div class="informetecnico">
                  <table class="table-inf">
                   <tr>
                    <td><label class="text-muted">Fecha</label></td>
                    <td><label class="text-dark"><?=strftime('%d de %B de %Y',strtotime($actividad->act_fecha))?></label></td>
                    <td><label class="text-muted">Departamento</label></td>
                    <td><label class="text-dark"><?=$ubicacion->dep_des?></label></td>
                  </tr>
                  <tr>
                    <td><label class="text-muted">Provincia</label></td>
                    <td><label class="text-dark"><?=$ubicacion->pro_des?></label></td>
                    <td><label class="text-muted">Municipio</label></td>
                    <td><label class="text-dark"><?=$ubicacion->mun_des?></label></td>
                  </tr>
                  <tr>
                    <?php
                     if($ubicacion->com_id==0){
                    ?><td><label class="text-muted">Direcci&oacute;n</label></td><td><label class="text-dark"><?=$ubicacion->direccion?></label></td><?php
                     }else{
                     ?><td><label class="text-muted">Comunidad:</label><td><label class="text-dark"><?=$ubicacion->com_nom?></label></td><?php
                     }
                   ?>
                    <td></td>
                    <td></td>
                  </tr>
                  </table>
                </div>
                <div class="informetecnico">
                <p class="title">DETALLE DE ACTIVIDAD</p>
                  
                  <table class="table-inf">
                   <tr>
                    <td width="20%"><label class="text-muted">Actividad</label></td>
                    <td width="80%"><label class="text-dark"><?=$porciones[0]?></label></td>
                  </tr>
                  <tr>
                    <td width="20%"><label class="text-muted">Tipo</label></td>
                    <td width="80%"><label class="text-dark"><?=$actividad->tipo_nom?></label></td>      
                  </tr>
                  <tr>
                    <td width="20%"><label class="text-muted">D&iacute;as</label></td>
                    <td width="80%"><label class="text-dark"><?=$actividad->act_dias?></label></td>      
                  </tr>
                  </table>
                </div>
                <div class="informetecnico">
                  <p class="title">EQUIPO DE TRABAJO</p>
                  
                  <table class="table-inf">
                   <tr>
                    <td width="20%"><label class="text-muted">Responsable</label></td>
                    <td width="80%"><?php 
                    foreach ($resp->result() as $respi) {
                      echo "<label class='text-primary'>".$respi->nombre_persona." ".$respi->apellido_persona."</label><br>";
                    }
                    ?></td>
                  </tr>
                  <tr>
                    <td width="20%"><label class="text-muted">Colaboradores</label></td>
                    <td width="80%"><?php 
                    foreach ($equipo->result() as $eq) {
                      echo "<label class='text-dark'> ".$eq->nombre_persona." ".$eq->apellido_persona.", </label>";
                    }
                    foreach ($equipoi->result() as $eqi) {
                      echo "<label class='text-dark'> ".$eqi->nombre_persona." ".$eqi->apellido_persona.", </label>";
                    }
                    ?> </td>      
                  </tr>
                  </table>
                  </div>
                <div class="informetecnico">
                  <p class="title">RESUMEN</p>
                  
                  <table class="table-inf">
                   <tr>
                    <td width="20%"><label class="text-muted">Objetivos</label></td>
                    <td width="80%" ALIGN="justify"><label class="text-dark"><?=$resumen->objetivos?></label></td>
                  </tr>
                  
                  <tr>
                    <td width="20%"><label class="text-muted">Descripci&oacute;n</label></td>
                    <td width="80%" ALIGN="justify"><label class="text-dark"><?=$resumen->descripcion?></label></td>      
                  </tr>
                  
                  <tr>
                    <td width="20%"><label class="text-muted">Logros</label></td>
                    <td width="80%" ALIGN="justify"><label class="text-dark"><?=$resumen->logros?></label></td>      
                  </tr>
                  </table>
                  </div>
                <div class="informetecnico">
                   <p class="title">DATOS COMPLEMENTARIOS</p>
                   
                  <table class="table-inf">
                   <tr>
                    <td><label class="text-muted">Comunidades</label></td>
                    <td>
                   <?php $n=0;
                    foreach ($comunidades->result() as $com) { 
                        if($n==0){
                        ?><label class="text-dark"><?=$com->com_nom?></label><?php
                      }else{
                        ?>
                    <label class="text-dark">, <?=$com->com_nom?></label>
                     <?php
                      }
                     $n=$n+1; }
                    ?>
                    </td>
                    <td><label class="text-muted">N° de Comunidades</label></td>
                    <td><label class="text-dark"><?=$n?></label></td> 
                  </tr>
                   <?php if($ubicacion->act_resumen==""){
                         
                         }else{
                           ?><tr><td><label class="text-muted">Organizaciones</label></td>
                             <td><label class="text-dark"><?=$ubicacion->act_resumen?></label></td></tr>
                           <?php
                         }?> 
                  </table>
                  </div>
                <div class="informetecnico">
                  <p class="title">OBSERVACIONES</p>
              
                  <label><?=$ubicacion->act_obs?></label> 
                  </div>
                  <p class="title">PARTICIPANTES DATOS GENERALES</p>
                  
                 <div class="col-md-6">
                    <table class="table-infPar tablas">
                    <tr><td class="">Participantes</td><td class=" center-txt">Hombres</td><td class=" center-txt">Mujeres</td><td class=" center-txt">Total</td></tr>
                    <?php 
                    $nh=0;$nm=0;$nt=0;
                       foreach ($participante->result() as $par) {
                        $nh=$nh+$par->cant_h;
                        $nm=$nm+$par->cant_m;
                        $nt=$nt+$par->total;
                         ?><tr><td width="80%"><?=$par->nombre_tipopar?></td><td width="10%" class="center-txt"><?=$par->cant_h?></td><td width="10%" class="center-txt"><?=$par->cant_m?></td><td width="10%" class="center-txt"><?=$par->total?></td></tr><?php
                       }
                    ?>
                     <tr class="fila-totales"><td width="80%" class="title">Totales</td><td width="10%" class="title center-txt"><?=$nh?></td><td width="10%" class="title center-txt"><?=$nm?></td><td width="10%" class="title center-txt"><?=$nt?></td></tr>
                   </table>
                  </div>
                  <br><br><br><br>
                  <table class="firma">
                         <tr>
                           <td class="ref">__________________________________</td>
                         </tr>
                         <tr>
                          <td class="ref" valign="top"><b>FIRMA</b><br>
                            <?php foreach ($resp->result() as $respe) {
                               echo $respe->nombre_persona." ".$respe->apellido_persona."<br>";
                            }?>
                          </td>
                        </tr>
                    </table>                
                 </div>
               </div>                       
              </div>

      </body>
</html>
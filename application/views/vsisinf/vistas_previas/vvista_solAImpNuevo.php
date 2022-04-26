<?php
setlocale(LC_TIME, "Spanish");
//Devuelve el resultado en español

  $recep=$this->solicitud->getAllReceptor($sol);
  $soli=$this->solicitud->getAllSolicitante($sol);
  $solici=$this->solicitud->getById($sol);
  $totalsol=0;$item=0;
 $totalsol=0;$item=0;
                     foreach ($sm->result() as $sum) {
                      $totalsol=$sum->monto+$totalsol;
                      }
 $porciones = explode("@", $actividad->sub_nom); 



//DATOS DE LA SOLICITUD

 $sqlSolicitud="SELECT p.nombre_proyecto,r.descripcion as resultado,so.sub_nom as nombre_actividad,
f.id_solicitante,f.id_receptor,s.fecha_s,t.tipo_nom,a.act_fecha,a.act_fecha_salida,ml.descripcion as actividad_proyecto,a.act_id,
  a.com_id,a.id_lugar,(SELECT CONCAT(com_nom,' - ',dep_des) from comunidad where com_id=a.com_id)as lugar,(SELECT CONCAT(l.direccion,' - ',d.dep_des) FROM lugar l join municipio m on m.mun_id=l.mun_id
join provincia p on p.pro_id=m.pro_id
join departamento d on d.dep_id=p.dep_id where l.id_lugar=a.id_lugar) as lugar2
FROM solicitud s 
join formulario f on f.id_form=s.id_form
join sol_act sa on sa.id_sol=s.id_sol 
join actividad a on a.act_id=sa.act_id
join sub_tipoact so on so.sub_id=a.sub_id
join tipoact t on t.tipo_id=so.tipo_id

--para ir hasta el proyecto
join res_act ra on ra.act_id=a.act_id
join act_ml ml on ml.id_act_ml=ra.id_result
join indicador i on i.id_ind=ml.id_ind
join resultados r on r.id_result=i.id_result
join obe o on o.id_obe=r.id_obe
join proyecto p on p.id_proyecto=o.id_proyecto
--fin hasta el proyecto
where s.id_sol=$sol;";

$res=$this->funciones->queryGeneral($sqlSolicitud);
foreach ($res->result() as $row) {
  $nombreProyecto=$row->nombre_proyecto;
  $resultado=$row->resultado;
  $actividad_proyecto=$row->actividad_proyecto;
  $solicitante=$this->funciones->obtenerNombrePersonaCompletoDatos($row->id_solicitante);
  $receptor=$this->funciones->obtenerNombrePersonaCompletoDatos($row->id_receptor);
  $fechaSolicitud=$row->fecha_s;
  $tipoActividad=strtoupper($row->tipo_nom);
  $nombreActividad=strtoupper(explode("@",$row->nombre_actividad)[0]);
  $fechaActividad=$row->act_fecha;
  $fechaActividadSalida=$row->act_fecha_salida;
  $equipo=$this->col_act->getAllAct($row->act_id);
  $com_id=$row->com_id;
  if($com_id>0){
    $lugarActividad=strtoupper($row->lugar);
  }else{
    $lugarActividad=strtoupper($row->lugar2);
  } 
}

?>
<html>
  <head>

  <!-- CSS Files -->
  <link rel="stylesheet" href="apps/dompdf2.css">
  <link href="apps/css/micss.css" rel="stylesheet" />
  <style type="text/css">
  .cont-cuerpo{
    padding-left: 8px;
    padding-right: 8px;
    padding-top: 8px;
    padding-bottom: 8px;
  }
  @page { margin-top: 230px; margin-left: 40px; margin-right: 40px; margin-bottom: 40px;}
  header { position: fixed; top: -200px; left: 0px; right: 0px; height: 770px !important;}
</style>
  </head>

<body class="solImp">

  <header>            
      <img class="imagen-logo-izq" src="images/logo.png">
      <div id="header_titulo_texto">FORM-2<br>SOLICITUD DE AUTORIZACIÓN DE ACTIVIDAD </div><br><br>
   <div class="content">
        <div class="cont">
          <div class="">
            <div class="">
              <div class="cont-cuerpo">
                    <table style="width:100%">
                      <tr>
                        <td valign="top" width="30%"><label>PROYECTO:</label></td>
                        <td align="center" valign="top" style="border-bottom: 1px solid #000;"><label class="text-md text-dark"><b><?=$nombreProyecto?></b></label></td>
                      </tr>
                      <tr>
                        <td valign="top" width="30%"><label>RESULTADO:</label></td>
                        <td align="center" valign="top" style="border-bottom: 1px solid #000;"><label class="text-md text-dark"><?=$resultado?></label></td>
                      </tr>
                      <tr>
                        <td valign="top" width="30%"><label>ACTIVIDAD DE PROYECTO:</label></td>
                        <td align="center" valign="top" style="border-bottom: 1px solid #000;"><label class="text-md text-dark"><?=$actividad_proyecto?></label></td>
                      </tr>                        
                    </table>                   
              </div>
            </div>
          </div>
       </div>
    </div>      
 </header>


  <footer>
  <center><label id="footer_texto"><?=$ciudad?>,  <?=strftime('%d de %B de %Y',time())?></label></center><!--<img class="logo-pie" src="imagenes/logo_tierra1.png">-->   
  </footer>

<?php 
                      ?>

   <div class="content">
        <div class="cont">


          <!--PRIMERA SECCION DE LA SOLICITUD-->
          <div class="cont-borde">
            <div class="cont-borde-in">
              <div class="cont-cuerpo">
                    <label style="font-weight:bold">I. SOLICITUD DE AUTORIZACIÓN</label>
                    <table style="width:100%">
                      <tr>
                        <td width="15%"><label>DE:</label></td>
                        <td align="center" width="25%" style="border-bottom: 1px solid #000;"><label><?=$solicitante->nombre_persona." ".$solicitante->apellido_persona?></label></td>
                        <td width="26%" style="padding-left: 8px;"><label>PARA APROBACIÓN DE:</label></td>
                        <td align="center" style="border-bottom: 1px solid #000;"><label><?=$receptor->nombre_persona." ".$receptor->apellido_persona?></label></td>
                      </tr>  
                      <tr>
                        <td width="15%"><label>CARGO:</label></td>
                        <td align="center" width="25%" style="border-bottom: 1px solid #000;"><label><?=$solicitante->nombre_cargo?></label></td>
                        <td width="26%" style="padding-left: 8px;"><label>CARGO:</label></td>
                        <td align="center" style="border-bottom: 1px solid #000;"><label><?=$receptor->nombre_cargo?></label></td>
                      </tr>  
                      <tr>
                        <td width="15%"><label>OFICINA:</label></td>
                        <td align="center" width="25%" style="border-bottom: 1px solid #000;"><label><?=$solicitante->nombre_regional?></label></td>
                        <td width="26%" style="padding-left: 8px;"><label>FECHA DE SOLICITUD:</label></td>
                        <td align="center" style="border-bottom: 1px solid #000;"><label><?=date("d/m/Y",strtotime($fechaSolicitud))?></label></td>
                      </tr>                       
                    </table> 




                    <hr>
                    <label style="font-weight:bold">II: INFORMACIÓN PARA PLANIFICACIÓN</label>
                    <table style="width:100%">
                      <tr>
                        <td width="25%"><label>Tipo de actividad desarrollar:</label></td>
                        <td align="center" style="border-bottom: 1px solid #000;"><label><?=$tipoActividad?></label></td>
                      </tr>  
                      <tr>
                        <td width="25%"><label>Nombre de la actividad:</label></td>
                        <td align="center" style="border-bottom: 1px solid #000;"><label><?=$nombreActividad?></label></td>
                      </tr>  
                      <tr>
                        <td width="25%"><label>Lugar de la actividad:</label></td>
                        <td align="center" style="border-bottom: 1px solid #000;"><label><?=$lugarActividad?></label></td>
                      </tr>
                      <tr>
                        <td width="25%"><label>Adjunto respaldo de la solicitud</label></td>
                        <td align="center" style="border-bottom: 1px solid #000;"><label>MEMORANDUM</label></td>
                      </tr>                       
                    </table>  
                    <label><b>Fecha de la actividad</b></label>
                    <table style="width:100%">
                      <tr>
                        <td width="15%"><label>Fecha de incio:</label></td>
                        <td align="center" width="25%" style="border-bottom: 1px solid #000;"><label><?=date("d/m/Y",strtotime($fechaActividad))?></label></td>
                        <td width="26%" style="padding-left: 8px;"><label>Fecha de salida:</label></td>
                        <td align="center" style="border-bottom: 1px solid #000;"><label><?=date("d/m/Y",strtotime($fechaActividadSalida))?></label></td>
                      </tr>                      
                    </table>

                    <hr>
                    <label style="font-weight:bold">III. EQUIPO DE TRABAJO</label> 
                    <!--equipo de trabajo aqui-->
                    <center><table class="tabla_p" cellspacing="0" style="width: 90%;margin-left: 100px;"><tr><th align="center">NOMBRE(S)</th><th align="center">OFICINA</th><th align="center">CÉDULA DE IDENTIDAD</th></tr>  
                    <?php 
                    $index=1;
                    foreach ($equipo->result() as $eqt) {
                      ?><tr><td style="text-align: left;"><?=$index?>. <?=$eqt->nombre_persona?> <?=$eqt->apellido_persona?></td><td style="text-align: center;"><?=$eqt->nombre_regional?></td><td style="text-align: center;"><?=$eqt->numero_ci?></td></tr><?php
                      $index++;
                    }
                    ?>
                  </table></center>
              </div>
            </div>
          </div>
          <br>
          <!--PRIMERA SECCION DE LA SOLICITUD-->
          <div class="cont-borde">
            <div class="cont-borde-in">
              <div class="cont-cuerpo">
                    <label style="font-weight:bold">IV. PROGRAMACIÓN DE PASAJES ÁEREOS</label>
                    <center><table class="tabla_p" cellspacing="0" style="width: 95%;margin-left: 20px;"><tr><th align="center" colspan="2">¿Requiere asigancio de pasaje aerero?</th><th align="center">Fecha y Hora</th><th align="center">Origen</th><th align="center">Destino</th></tr>
                    <?php 
                    $index=1;
                    foreach ($equipo->result() as $eqt) {
                      $dataFind=$this->funciones->obtenerCantidadSolDetalleMontos($sol,$eqt->id_persona,1,2);
                      $valor=$dataFind[0];
                      if($valor>0){
                        if($valor==1){                          
                          $salida='SALIDA SI';
                          $hora=date("d / m / Y  H:i",strtotime($dataFind[6]));                          
                          $origen=$this->funciones->obtenerDepartamentoName($dataFind[2]);
                          $destino=$this->funciones->obtenerDepartamentoName($dataFind[3]);
                          $salida.='<div style="border-bottom:1px solid #000"></div>RETORNO NO';
                          $hora.='<div style="border-bottom:1px solid #000"></div>-';                          
                          $origen.='<div style="border-bottom:1px solid #000"></div>-';
                          $destino.='<div style="border-bottom:1px solid #000"></div>-';                                                   
                        }else if($valor==2){
                          $salida='SALIDA SI';
                          $hora=date("d / m / Y  H:i",strtotime($dataFind[6]));                          
                          $origen=$this->funciones->obtenerDepartamentoName($dataFind[2]);
                          $destino=$this->funciones->obtenerDepartamentoName($dataFind[3]);
                          $salida.='<div style="border-bottom:1px solid #000"></div>RETORNO SI';
                          $hora.='<div style="border-bottom:1px solid #000"></div>'.date("d / m / Y  H:i",strtotime($dataFind[7]));                                                            
                          $origen.='<div style="border-bottom:1px solid #000"></div>'.$this->funciones->obtenerDepartamentoName($dataFind[4]);
                          $destino.='<div style="border-bottom:1px solid #000"></div>'.$this->funciones->obtenerDepartamentoName($dataFind[5]);                          
                        }
                        ?><tr><td style="text-align: left;"><?=$index?>. <?=$eqt->nombre_persona?> <?=$eqt->apellido_persona?></td><td style="text-align: center;"><?=$salida?></td><td style="text-align: center;"><?=$hora?></td><td style="text-align: center;"><?=$origen?></td><td style="text-align: center;"><?=$destino?></td></tr><?php
                        $index++;

                      }                      
                    }
                    ?>
                    </table></center>
                    <br>

                    <hr>
                    <label style="font-weight:bold">V. PROGRAMACIÓN PERDIEM</label>                    
                    <?php 
                    $index=1;
                    $sql="SELECT v.id,v.descripcion,(SELECT precio_bruto from via_item_localidad where id_tipo_localidad=v.id and id_item=1) as precio_bruto FROM via_tipo_localidad v where v.estado=1;";                    
                    $res=$this->funciones->queryGeneral($sql);                             
                    ?>
                    <center><table class="tabla_p" cellspacing="0" style="width: 95%;margin-left: 20px;"><tr><th align="center"></th>
                    <?php
                    foreach ($res->result() as $row) {                      
                        ?><th align="center" colspan="2"><?=$row->descripcion?></th><?php
                    }
                    ?><th align="center" width="10%">TOTAL DÍAS</th>
                    </tr><?php
                    foreach ($equipo->result() as $eqt){
                      $totalDias=0;
                      ?><tr><td style="text-align: left;"><?=$index?>. <?=$eqt->nombre_persona?> <?=$eqt->apellido_persona?></td><?php
                      foreach ($res->result() as $row) {
                        $dataFind=$this->funciones->obtenerCantidadSolDetalleMontos($sol,$eqt->id_persona,$row->id,1);
                        $diasConf=$dataFind[0];                        
                        $totalDias+=$diasConf;
                        $lugar=$this->funciones->obtenerLugarName($dataFind[1]);
                         ?><td style="text-align: left;"><?=$lugar?></td><td style="text-align: center;" width="5%"><?=$diasConf?></td><?php
                                                  
                      }
                      if($totalDias==0){
                        $totalDias="-";
                      }
                      ?><td style="text-align: right;"><b><?=$totalDias?></b></td>
                      </tr><?php
                      $index++; 
                    }
                    ?>
                    </table></center>
                    <br>
                    <hr>
                    <label style="font-weight:bold">VI. PROGRAMACION DE HOSPEDAJE</label> 
                    <?php 
                    $index=1;
                    $sql="SELECT v.id,v.descripcion,(SELECT precio_bruto from via_item_localidad where id_tipo_localidad=v.id and id_item=3) as precio_bruto FROM via_tipo_localidad v where v.estado=1;";                    
                    $res=$this->funciones->queryGeneral($sql);                             
                    ?>
                    <center><table class="tabla_p" cellspacing="0" style="width: 95%;margin-left: 20px;"><tr><th align="center"></th>
                    <?php
                    foreach ($res->result() as $row) {                      
                        ?><th align="center" colspan="2"><?=$row->descripcion?></th><?php
                    }
                    ?><th align="center" width="10%">TOTAL DÍAS</th>
                    </tr><?php
                    foreach ($equipo->result() as $eqt){
                      $totalDias=0;
                      ?><tr><td style="text-align: left;"><?=$index?>. <?=$eqt->nombre_persona?> <?=$eqt->apellido_persona?></td><?php
                      foreach ($res->result() as $row) {
                        $dataFind=$this->funciones->obtenerCantidadSolDetalleMontos($sol,$eqt->id_persona,$row->id,3);
                        $diasConf=$dataFind[0];                        
                        $totalDias+=$diasConf;
                        $lugar=$this->funciones->obtenerLugarName($dataFind[1]);
                         ?><td style="text-align: left;"><?=$lugar?></td><td style="text-align: center;" width="5%"><?=$diasConf?></td><?php                        
                      }
                      if($totalDias==0){
                        $totalDias="-";
                      }
                      ?><td style="text-align: right;"><b><?=$totalDias?></b></td>
                      </tr><?php
                      $index++; 
                    }
                    ?>
                    </table></center>
                    <br>
                    <hr>
                    <label style="font-weight:bold">VII. FONDOS A ASIGNAR</label> 
                    <br>
                    <table class="tabla_p" cellspacing="0">
                        <!-- <tr><td style="text-align: left;" colspan="4"><b>GASTOS OPERATIVOS</b></td></tr> -->
                                 <tr>
                                   <td>
                                     <b class="text-white"><small>Nro.<small></b>
                                  </td>
                                   <td>
                                      <b class="text-white" style="text-align: left;"><small>Detalle de Gasto<small></b>
                                   </td>
                                   <td>
                                      <b class="text-white" style="text-align: left;"><small>Partida Presupuestaria<small></b>
                                   </td>
                                   <td>
                                      <b class="text-white"><small>Monto (Bs)<small></b>
                                   </td>
                                 </tr>

                                 <tr><td style="text-align: center;" colspan="4"><b>A. GASTOS DE VIAJE</b></td></tr>
                          <?php
                          foreach ($sm_fondos->result() as $sum) {                            
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
                          ?><tr><td style="text-align: center;" colspan="4"><b>B. FONDOS EN AVANCE</b></td></tr>
                          <?php
                          foreach ($sm_gastos->result() as $sum) {                            
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

              </div>
            </div>
          </div>
          <br>

          <div class="cont-borde">
            <div class="cont-borde-in">
              <div class="cont-cuerpo">                                  
                    <label style="font-weight:bold">VIII. APROBACIÓN DE ACTIVIDAD</label>
                    <br><br>
                    <br>
                    <br>
                    <br>
                    <table class="firma2">
                         <tr>
                           <td align="center" style="border-top:1px solid #000"><b>FIRMA SOLICITANTE</b><br><?=$solicitante->nombre_persona." ".$solicitante->apellido_persona?><br><?=$solicitante->nombre_cargo?></td>
                           <td width="15%"></td>
                           <td align="center" style="border-top:1px solid #000"><b>APROBADO POR</b><br><?=$receptor->nombre_persona." ".$receptor->apellido_persona?><br><?=$receptor->nombre_cargo?></td>

                    </table>                     
              </div>
            </div>
          </div>
        </div>
  </div> 
      </body>
</html>
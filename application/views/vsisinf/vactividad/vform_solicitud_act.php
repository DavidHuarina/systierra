<?php
 if($actividad->id_estado!=2){
  redirect('home');
 }
  $i=0;
  echo "<script>var subrubro=[],imagen_s=[];</script>";
  foreach ($subru->result() as $sr) {
     echo "<script>subrubro[".$i."]='".$sr->descripcion."';</script>";
     echo "<script>imagen_s[".$i."]='imagenes/proyecto/s.png';</script>";
    ?>
   <?php
    $i=$i+1;
   }
   $i=0;
  echo "<script>var rubro=[],imagen_r=[];</script>";
  foreach ($ru->result() as $r) {
     echo "<script>rubro[".$i."]='".$r->descripcion."';</script>";
     echo "<script>imagen_r[".$i."]='imagenes/proyecto/r.jpg';</script>";
    ?>
   <?php
    $i=$i+1;
   }
  ?>
<?php $ninguno=0;
                     foreach ($sm->result() as $sum) {
                      $ninguno=$ninguno+1;
                      }
                      ?>

<script type="text/javascript">
  function cambiarFormulario(tipo){
    $("#tipo_solicitud").val(tipo);
    if(tipo==1){
      calcularMontosPerdiem();
      calcularMontosAereo();
      calcularMontosPerNocte();
      $("#sub_rubro").attr("required",false);
      $("#monto").attr("required",false);      
      $("#panel_viatico").attr("class","");
      $("#panel_fondo").attr("class","d-none");
      $("#boton_enviar").attr("class","btn btn-success");
      $("#boton_enviar").html("Procesar");
      $("#titulo_formulario").html("Solicitud - Registrar Viáticos");
      $("#boton_fondo").attr("class","btn btn-default float-right btn-sm"); 
      $("#boton_viatico").attr("class","btn btn-success float-right btn-sm");       
    }else{
      $("#sub_rubro").attr("required",true);
      $("#monto").attr("required",true);
      $("#panel_fondo").attr("class","");
      $("#panel_viatico").attr("class","d-none");
      $("#boton_enviar").attr("class","btn btn-primary");
      $("#boton_enviar").html("Registrar");
      $("#titulo_formulario").html("Solicitud - Registrar Fondos en Avance");
      $("#boton_viatico").attr("class","btn btn-default float-right btn-sm"); 
      $("#boton_fondo").attr("class","btn btn-success float-right btn-sm"); 
    }
  }

function calcularMontosPerdiem(){
  var costoFila=[];
  var costoRetencion=[];
  var totalSuma=0;
  $(".perdiem").each(function(){
    var id=$(this).attr("id");
    var persona=id.split("_")[2];    
    costoFila[persona]=0;
    costoRetencion[persona]=0;    
  });  
  $(".perdiem").each(function(){
    var id=$(this).attr("id");
    var persona=id.split("_")[2];    
    costoFila[persona]+=parseFloat($(this).val())*parseFloat($("#localidad_"+id.split("_")[1]).val());        
  });

  //retenciones   
  for (var i = 0; i < costoFila.length; i++) {
    costoRetencion[i]+=(costoFila[i]*parseFloat($("#ret_1").val()))/100;
    $("#costo_"+i).val(Number(costoFila[i]).toFixed(2));            
    $("#ret_1_"+i).val(Number(costoRetencion[i]).toFixed(2));  
    $("#liquido_"+i).val(parseFloat($("#costo_"+i).val())-parseFloat($("#ret_1_"+i).val()));            
    if($("#liquido_"+i).val()>0||$("#liquido_"+i).val()<0||$("#liquido_"+i).val()==0){
      totalSuma+=parseFloat($("#liquido_"+i).val());
    }    
  }
  $("#total_perdiem").val(Number(totalSuma).toFixed(2));
}



function calcularMontosAereo(){
  var costoFila=[];
  var costoRetencion=[];
  var costoRetencion2=[];
  var totalSuma=0;
  $(".aereo").each(function(){
    var id=$(this).attr("id");
    var persona=id.split("_")[2];    
    costoFila[persona]=0;
    costoRetencion[persona]=0;  
    costoRetencion2[persona]=0;    
  });  
  $(".aereo").each(function(){
    var id=$(this).attr("id");
    var persona=id.split("_")[2];    
    costoFila[persona]+=parseFloat($(this).val())*parseFloat($("#localidada_"+id.split("_")[1]).val());        
  });

  //retenciones   
  for (var i = 0; i < costoFila.length; i++) {
    costoRetencion[i]+=(costoFila[i]*parseFloat($("#reta_2").val()))/100;
    costoRetencion2[i]+=(costoFila[i]*parseFloat($("#reta_3").val()))/100;
    $("#costoa_"+i).val(Number(costoFila[i]).toFixed(2));            
    $("#reta_2_"+i).val(Number(costoRetencion[i]).toFixed(2));
    $("#reta_3_"+i).val(Number(costoRetencion2[i]).toFixed(2));  
    $("#liquidoa_"+i).val(parseFloat($("#costoa_"+i).val())-parseFloat($("#reta_2_"+i).val())-parseFloat($("#reta_3_"+i).val()));            
    if($("#liquidoa_"+i).val()>0||$("#liquidoa_"+i).val()<0||$("#liquidoa_"+i).val()==0){
      totalSuma+=parseFloat($("#liquidoa_"+i).val());
    }    
  }
  $("#total_aereo").val(Number(totalSuma).toFixed(2));
}


function calcularMontosPerNocte(){
  var costoFila=[];
  // var costoRetencion=[];
  // var costoRetencion2=[];
  var totalSuma=0;
  $(".pernocte").each(function(){
    var id=$(this).attr("id");
    var persona=id.split("_")[2];    
    costoFila[persona]=0;
    // costoRetencion[persona]=0;  
    // costoRetencion2[persona]=0;    
  });  
  $(".pernocte").each(function(){
    var id=$(this).attr("id");
    var persona=id.split("_")[2];    
    costoFila[persona]+=parseFloat($(this).val())*parseFloat($("#localidadp_"+id.split("_")[1]).val());        
  });

  //retenciones   
  for (var i = 0; i < costoFila.length; i++) {
    // costoRetencion[i]+=(costoFila[i]*parseFloat($("#retp_2").val()))/100;
    // costoRetencion2[i]+=(costoFila[i]*parseFloat($("#retp_3").val()))/100;
    $("#costop_"+i).val(Number(costoFila[i]).toFixed(2));            
    // $("#retp_2_"+i).val(Number(costoRetencion[i]).toFixed(2));
    // $("#retp_3_"+i).val(Number(costoRetencion2[i]).toFixed(2));  
    $("#liquidop_"+i).val(parseFloat($("#costop_"+i).val()));            
    if($("#liquidop_"+i).val()>0||$("#liquidop_"+i).val()<0||$("#liquidop_"+i).val()==0){
      totalSuma+=parseFloat($("#liquidop_"+i).val());
    }    
  }
  $("#total_pernocte").val(Number(totalSuma).toFixed(2));
}

</script>

<style type="text/css">
  .activar_perdiem{
    padding: 2px;    
    background:#FFE933 !important;
  }
  .activar_aereo{
    padding: 2px;    
    background:#FFE933 !important;
  }
</style>

<div class="panel-header-sm bg-warning">
</div>
<div class="content">
<center>         
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><i class='now-ui-icons business_money-coins text-success'></i> <label id="titulo_formulario">Solicitud - Registrar Fondos en Avance</label> <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a>
                    <a href="#" class="btn btn-default float-right btn-sm" id="boton_viatico" onclick="cambiarFormulario(1)">REGISTRAR VIÁTICOS</a>
                    <a href="#" class="btn btn-success float-right btn-sm" id="boton_fondo" onclick="cambiarFormulario(2)">REGISTRAR FONDOS EN AVANCE</a> 

                </h5>
                
              </div>
              <div class="card-body">
                <form autocomplete="off" action="cenviar_solicitud/act_sol?id=<?=$actividad->act_id?>&idp=<?=$proy->id_proyecto?>&sol=<?=$sol?>" id="formulario_validacion" class="" method="post">
                  <input type="hidden" name="tipo_solicitud" id="tipo_solicitud" value="2">
                  <div id="panel_fondo">
                    <div class="row">
                      <div class="col-md-3 pr-1">
                        <div class="form-group">
                          <!--<label>Codigo de Proyecto</label>-->
                          <input type="hidden" class="form-control" disabled="" placeholder="id" value="<?=$proy->id_proyecto?>">
                        </div>
                      </div>
                      <div class="col-md-4 pr-1">
                        <div class="form-group">
                          <!--<label>Codigo de Fondo</label>-->
                          <input type="hidden" class="form-control" name="cod_fondo" id="cod_fondo"  placeholder="id" value="<?=$fondo->id_proy_ep?>">
                        </div>
                      </div>
                      <div class="col-md-5 pl-1">
                        <div class="form-group">
                          <!--<label>Codigo subrubro</label>-->
                          <input type="hidden" name="cod_sr" id="cod_sr" class="form-control" readonly="readonly" placeholder="0000-000" value="00000">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Sub rubro</label>
                          <input type="text" id="sub_rubro" name="sub_rubro" class="form-control" placeholder="" value="" required="true">
                        </div>
                      </div>
                      <div class="col-md-6 pl-1">
                        <div class="form-group">
                          <label>Rubro</label>
                          <input type="text" id="rubro" name="rubro" class="form-control" placeholder="" value="" readonly>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Monto solicitado Bs (0000.00)</label>
                          <input type="text" onkeypress="return validarMontoSup(event)" id="monto" name="monto" class="form-control" placeholder="" value="" required="true">
                        </div>
                      </div>
                      <div class="col-md-6 pl-1">
                        <div class="form-group">
                          <label>Detalle / Descripci&oacute;n</label>
                          <textarea class="form-control texta-lg" id="des" name="des" placeholder="Breve detalle..."></textarea>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                  <div id="panel_viatico" class="d-none">
                    <h4>PERDIEM</h4>
                    <table id="table-equipo" class="table">
                           <thead class="bg-success text-white text-small">
                           <tr>                            
                             <th>
                                <b>Nombres y Apellidos</b>
                             </th>                                                        
                             <th><b>Regional</b></th>
                             <th><b>Cargo</b></th>
                             <th><b>Documento<br>Identidad</b></th>
                             <?php 
                             $cols=0;
                             $sql="SELECT v.id,v.descripcion,(SELECT precio_bruto from via_item_localidad where id_tipo_localidad=v.id and id_item=1) as precio_bruto FROM via_tipo_localidad v where v.estado=1;";
                             $res=$this->funciones->queryGeneral($sql);
                             foreach ($res->result() as $row) {
                              $cols++;
                                ?><th><small>DIAS<br><?=$row->descripcion?></small><br><?=number_format($row->precio_bruto,2,'.',',')." Bs."?><input type="hidden" id="localidad_<?=$row->id?>" name="localidad_<?=$row->id?>" value="<?=$row->precio_bruto?>"></th><?php
                             }
                             ?>
                             <th>COSTO<br>TOTAL</th>
                             <?php 
                             $sql="SELECT id,descripcion,porcentaje FROM via_retenciones where estado=1;";
                             $resRet=$this->funciones->queryGeneral($sql);
                             foreach ($resRet->result() as $rowRet) {
                              $cols++;
                                ?><th class="bg-default"><small><?=$rowRet->descripcion?></small><br><?=number_format($rowRet->porcentaje,1,'.',',')." %"?><input type="hidden" id="ret_<?=$rowRet->id?>" name="ret_<?=$rowRet->id?>" value="<?=$rowRet->porcentaje?>"></th><?php
                             }
                             ?>
                             <th>LIQUIDO<br>PAGABLE</th>
                           </tr>
                           </thead>
                            <tbody>
                            <?php foreach ($equipot->result() as $eqt){                                                             
                              ?>
                              <tr>
                              
                              <td><?=$eqt->nombre_persona?> <?=$eqt->apellido_persona?></td>
                              <td><?=$eqt->nombre_regional?></td>
                              <td><?=$eqt->nombre_cargo?></td>
                              <td><?=$eqt->numero_ci?></td>
                              <?php
                              foreach ($res->result() as $row) {
                                $diasConf=$this->funciones->obtenerCantidadSolDetalleMontos($sol,$eqt->id_persona,$row->id,1);
                                ?><td><input type="number" class="form-control perdiem" name="dias_<?=$row->id?>_<?=$eqt->id_persona?>" id="dias_<?=$row->id?>_<?=$eqt->id_persona?>" value="<?=$diasConf?>" onchange="calcularMontosPerdiem();" onkeyup="calcularMontosPerdiem()"></td><?php
                               }
                               ?>
                               <td><input type="text" readonly class="form-control" name="costo_<?=$eqt->id_persona?>" id="costo_<?=$eqt->id_persona?>" value=""></td>
                               <?php
                              foreach ($resRet->result() as $rowRet) {         
                                $claseActivar="";
                                if($rowRet->id==1){
                                  $claseActivar="activar_perdiem";
                                }                       
                                ?><td><input type="text" class="form-control <?=$claseActivar?>" name="ret_<?=$rowRet->id?>_<?=$eqt->id_persona?>" id="ret_<?=$rowRet->id?>_<?=$eqt->id_persona?>" value="0" readonly></td><?php
                               }
                               ?>
                               <td><input type="text" readonly class="form-control" name="liquido_<?=$eqt->id_persona?>" id="liquido_<?=$eqt->id_persona?>" value=""></td>
                              </tr>
                               <?php } ?>
                               <tr><td colspan="<?=($cols+5)?>" align="center">TOTAL PERDIEM</td><td><input type="number" readonly class="form-control" name="total_perdiem" id="total_perdiem" value=""></td></tr>
                           </tbody>
                          </table>  





                          <h4>PASAJES AEREOS</h4>
                    <table class="table">
                           <thead class="bg-success text-white text-small">
                           <tr>                            
                             <th>
                                <b>Nombres y Apellidos</b>
                             </th>                                                        
                             <th><b>Regional</b></th>
                             <th><b>Cargo</b></th>
                             <th><b>Documento<br>Identidad</b></th>
                             <?php 
                             $cols=0;
                             $sql="SELECT v.id,v.descripcion,(SELECT precio_bruto from via_item_localidad where id_tipo_localidad=v.id and id_item=2) as precio_bruto FROM via_tipo_localidad v where v.estado=1;";
                             $res=$this->funciones->queryGeneral($sql);
                             foreach ($res->result() as $row) {
                              $cols++;
                                ?><th><small>CANTIDAD<br><?=$row->descripcion?></small><br><?=number_format($row->precio_bruto,2,'.',',')." Bs."?><input type="hidden" id="localidada_<?=$row->id?>" name="localidada_<?=$row->id?>" value="<?=$row->precio_bruto?>"></th><?php
                             }
                             ?>
                             <th>COSTO<br>TOTAL</th>
                             <?php 
                             $sql="SELECT id,descripcion,porcentaje FROM via_retenciones where estado=1;";
                             $resRet=$this->funciones->queryGeneral($sql);
                             foreach ($resRet->result() as $rowRet) {
                              $cols++;
                                ?><th class="bg-default"><small><?=$rowRet->descripcion?></small><br><?=number_format($rowRet->porcentaje,1,'.',',')." %"?><input type="hidden" id="reta_<?=$rowRet->id?>" name="reta_<?=$rowRet->id?>" value="<?=$rowRet->porcentaje?>"></th><?php
                             }
                             ?>
                             <th>LIQUIDO<br>PAGABLE</th>
                           </tr>
                           </thead>
                            <tbody>
                            <?php foreach ($equipot->result() as $eqt) {                                                            
                              ?>
                              <tr>
                              
                              <td><?=$eqt->nombre_persona?> <?=$eqt->apellido_persona?></td>
                              <td><?=$eqt->nombre_regional?></td>
                              <td><?=$eqt->nombre_cargo?></td>
                              <td><?=$eqt->numero_ci?></td>
                              <?php
                              foreach ($res->result() as $row) {
                                $diasConf=$this->funciones->obtenerCantidadSolDetalleMontos($sol,$eqt->id_persona,$row->id,2);
                                ?><td><input type="number" class="form-control aereo" name="diasa_<?=$row->id?>_<?=$eqt->id_persona?>" id="diasa_<?=$row->id?>_<?=$eqt->id_persona?>" value="<?=$diasConf?>" onchange="calcularMontosAereo();" onkeyup="calcularMontosAereo()"></td><?php
                               }
                               ?>
                               <td><input type="text" readonly class="form-control" name="costoa_<?=$eqt->id_persona?>" id="costoa_<?=$eqt->id_persona?>" value=""></td>
                               <?php
                              foreach ($resRet->result() as $rowRet) {         
                                $claseActivar="";
                                if($rowRet->id==2||$rowRet->id==3){
                                  $claseActivar="activar_aereo";
                                }                       
                                ?><td><input type="text" class="form-control <?=$claseActivar?>" name="reta_<?=$rowRet->id?>_<?=$eqt->id_persona?>" id="reta_<?=$rowRet->id?>_<?=$eqt->id_persona?>" value="0" readonly></td><?php
                               }
                               ?>
                               <td><input type="text" readonly class="form-control" name="liquidoa_<?=$eqt->id_persona?>" id="liquidoa_<?=$eqt->id_persona?>" value=""></td>
                              </tr>
                               <?php } ?>
                               <tr><td colspan="<?=($cols+5)?>" align="center">TOTAL TRANSPORTE AEREO</td><td><input type="number" readonly class="form-control" name="total_aereo" id="total_aereo" value=""></td></tr>
                           </tbody>
                          </table>  






                          <h4>PERNOCTE</h4>
                    <table class="table">
                           <thead class="bg-success text-white text-small">
                           <tr>                            
                             <th>
                                <b>Nombres y Apellidos</b>
                             </th>                                                        
                             <th><b>Regional</b></th>
                             <th><b>Cargo</b></th>
                             <th><b>Documento<br>Identidad</b></th>
                             <?php 
                             $cols=0;
                             $sql="SELECT v.id,v.descripcion,(SELECT precio_bruto from via_item_localidad where id_tipo_localidad=v.id and id_item=3) as precio_bruto FROM via_tipo_localidad v where v.estado=1;";
                             $res=$this->funciones->queryGeneral($sql);
                             foreach ($res->result() as $row) {
                              $cols++;
                                ?><th><small>CANTIDAD<br><?=$row->descripcion?></small><br><?=number_format($row->precio_bruto,2,'.',',')." Bs."?><input type="hidden" id="localidadp_<?=$row->id?>" name="localidadp_<?=$row->id?>" value="<?=$row->precio_bruto?>"></th><?php
                             }
                             ?>
                             <th>COSTO<br>TOTAL</th>
                             <?php 
                             $sql="SELECT id,descripcion,porcentaje FROM via_retenciones where estado=1;";
                             $resRet=$this->funciones->queryGeneral($sql);
                             foreach ($resRet->result() as $rowRet) {
                              $cols++;
                                ?><th class="bg-default"><small><?=$rowRet->descripcion?></small><br><?=number_format($rowRet->porcentaje,1,'.',',')." %"?><input type="hidden" id="retp_<?=$rowRet->id?>" name="retp_<?=$rowRet->id?>" value="<?=$rowRet->porcentaje?>"></th><?php
                             }
                             ?>
                             <th>LIQUIDO<br>PAGABLE</th>
                           </tr>
                           </thead>
                            <tbody>
                            <?php foreach ($equipot->result() as $eqt) {                                                            
                              ?>
                              <tr>
                              
                              <td><?=$eqt->nombre_persona?> <?=$eqt->apellido_persona?></td>
                              <td><?=$eqt->nombre_regional?></td>
                              <td><?=$eqt->nombre_cargo?></td>
                              <td><?=$eqt->numero_ci?></td>
                              <?php
                              foreach ($res->result() as $row) {
                                $diasConf=$this->funciones->obtenerCantidadSolDetalleMontos($sol,$eqt->id_persona,$row->id,3);
                                ?><td><input type="number" class="form-control pernocte" name="diasp_<?=$row->id?>_<?=$eqt->id_persona?>" id="diasp_<?=$row->id?>_<?=$eqt->id_persona?>" value="<?=$diasConf?>" onchange="calcularMontosPerNocte();" onkeyup="calcularMontosPerNocte()"></td><?php
                               }
                               ?>
                               <td><input type="text" readonly class="form-control" name="costop_<?=$eqt->id_persona?>" id="costop_<?=$eqt->id_persona?>" value=""></td>
                               <?php
                              foreach ($resRet->result() as $rowRet) {         
                                $claseActivar="";
                                // if($rowRet->id==){
                                //   $claseActivar="activar_pernocte";
                                // }                       
                                ?><td><input type="text" class="form-control <?=$claseActivar?>" name="retp_<?=$rowRet->id?>_<?=$eqt->id_persona?>" id="retp_<?=$rowRet->id?>_<?=$eqt->id_persona?>" value="0" readonly></td><?php
                               }
                               ?>
                               <td><input type="text" readonly class="form-control" name="liquidop_<?=$eqt->id_persona?>" id="liquidop_<?=$eqt->id_persona?>" value=""></td>
                              </tr>
                               <?php } ?>
                               <tr><td colspan="<?=($cols+5)?>" align="center">TOTAL PERNOCTE</td><td><input type="number" readonly class="form-control" name="total_pernocte" id="total_pernocte" value=""></td></tr>
                           </tbody>
                          </table>  
                  </div>


                  <hr class="hr"></hr>
                  <?php if($ninguno!=0){
                   ?>
                   <div class="float-left">
                      <a href="#" data-toggle="modal" data-target="#solmod" class="btn btn-info">Finalizar Solicitud</a>
                  </div>
                   <?php
                  }?>
                  <div class="float-right">
                      <a href="cvista_solA?ac=<?=$actividad->act_id?>&id=<?=$proy->id_proyecto?>&sol=<?=$sol?>" class="btn btn-secondary">Vista previa</a>
                    </div>
                  <div class="float-right">
                      <button type="submit" class="btn btn-primary" id="boton_enviar">Registrar</button>
                    </div>
                </form>
              </div>
            </div>
          </div>          
           
        </center>
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <?php $totalsol=0;$numro=0;
                     foreach ($sm->result() as $sum) {

                      $totalsol=$sum->monto+$totalsol;
                      }
                      ?>
                <h5 class="card-title"> Solicitud <small class="text-primary"><?=number_format($totalsol, 2, '.', ',');?></small><label for="" class="text-primary"></label> <small class="text-muted">Bs</small></h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table text-small">
                    <thead class="bg-plomo text-white">
                      <th>
                        Nro
                      </th>
                      <th>
                        Descripci&oacute;n
                      </th>
                      <th>
                        Detalle
                      </th>
                      <th>
                        Partida
                      </th>
                      <th class="text-right text-warning">
                        Monto
                      </th>
                      <th class="text-right">
                        Quitar
                      </th>
                    </thead>
                    <tbody>
                      <?php
                     foreach ($sm->result() as $sum) {
                      $numro++;
                      ?>
                       <tr>
                        <td>
                          <?=/*$sum->id_sol_act*/$numro?>
                        </td>
                        <td WIDTH="30%">
                          <?=$sum->descripcionobs?>
                        </td>
                        <td>
                          <?php $porciones = explode("@", $sum->descrip);?>
                          <?=$porciones[0]?>
                        </td>
                        <td>
                          <?=$sum->descripcionr?>
                        </td>
                        <td class="text-right">
                          <small class="text-dark">Bs.</small> <?=$sum->monto?>
                        </td>
                        <?php 
                        if($sum->id_via_item>0){
                          ?><td class="text-right">VIÁTICOS</td><?php
                        }else{
                            ?>
                            <td class="text-right"><a class="" href="cenviar_solicitud/quitarSol?id=<?=$actividad->act_id?>&idp=<?=$proy->id_proyecto?>&sol=<?=$sol?>&s=<?=$sum->id_solm?>">
                              <i class="fa fa-times text-danger fa-fw"></i></a></td>
                            <?php
                        }
                        ?>                        
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
      
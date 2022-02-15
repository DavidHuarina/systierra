
<div class="panel-header panel-header-sm">
   </div>
<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Informe T&eacute;cnico (Edici&oacute;n)<a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a></a>
                </h5>
                <p><label class="text-muted">Para editar el equipo de trabajo (Colaboradores), dirijase a equipo de trabajo en las opciones de actividad o mediante el siguiente enlace</label><br><a href="cnequipo?ac=<?=$actividad->act_id?>" class="btn btn-primary"> Editar Equipo de trabajo</a></p>
              </div>
              <div class="card-body">
                <form autocomplete="off" action="cedit_informe/agregar?ac=<?=$actividad->act_id?>&p=<?=$idproy?>" class="validate-form" method="post">
                    <div class="col-md-12 pr-1">
                      <div class="rounded titulos"><center><p class="text-md">Resumen</p></center></div><br>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group validate-input" data-validate="Campo requerido">
                            <label>Objetivos</label>
                            <textarea type="text" id="obs" name="obs" class="form-control" placeholder="Escriba aqui..."><?=$resumen->objetivos?></textarea>
                         </div>
                        </div>
                         <div class="col-md-4">
                          <div class="form-group validate-input" data-validate="Campo requerido">
                            <label>Descripci&oacute;n</label>
                            <textarea type="text" id="des" name="des" class="form-control" placeholder="Escriba aqui..."><?=$resumen->descripcion?></textarea>
                         </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group validate-input" data-validate="Campo requerido">
                            <label>Logros</label>
                            <textarea type="text" id="log" name="log" class="form-control" placeholder="Escriba aqui..."><?=$resumen->logros?></textarea>
                         </div>
                        </div>
                      </div>
                      <div class="rounded titulos"><center><p class="text-md">Observaciones</p></center></div><br>
                      <div class="col-md-12">
                          <div class="form-group">
                            <label>Observaci&oacute;n</label>
                            <textarea type="text" id="obser" name="obser" class="form-control" placeholder="Escriba aqui..."><?=$ubicacion->act_obs?></textarea>
                         </div>
                      </div>
                      <div class="rounded titulos"><center><p class="text-md">Comunidades</p></center></div><br>
                      <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label><input type="radio" value="1" name="optradio" id="optradio1" onclick="displayBlock(this.id,'optradio2')" checked>Comunidades</label>
                    
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label><input type="radio" value="2" name="optradio" id="optradio2" onclick="displayBlock(this.id,'optradio1')">Todas</label>
    
                      </div>
                    </div>
                  </div>
                  <div class="container col-md-8"><center>
                        <div id="lista-com">
                         <div class="form-group">
                        <label>Comunidad</label>
                         <select id="sel-com" name="sel-com[]" class="form-control select-plantilla" data-placeholder="Buscar comunidades..." multiple="multiple">
                              <?php
                              $estac=false;
                               foreach ($comunidades->result() as $com) {
                                foreach ($comunidadesP->result() as $comun) {
                                  if($comun->com_id==$com->com_id){
                                    $estac=true;
                                    ?><option value="<?=$com->com_id?>" selected><?=$com->com_nom?> @ <?=$com->dep_des?></option><?php
                                    break;
                                  }else{
                                    $estac=false;
                                  }
                                }
                                if($estac==false){
                                  ?><option value="<?=$com->com_id?>"><?=$com->com_nom?> @ <?=$com->dep_des?></option><?php
                                }
                                
                               }
                              ?>
                          </select>
                      </div>
                        </div>   
                  </center></div>
                      <div class="rounded titulos"><center><p class="text-md">Organizaciones</p></center></div><br>
                      <div class="col-md-12">
                          <div class="form-group">
                            <label>Organizaciones</label>
                            <textarea type="text" id="org_inf" name="org_inf" class="form-control" placeholder="Escriba aqui..."><?=$ubicacion->act_resumen?></textarea>
                         </div>
                      </div>
                      <div class="rounded titulos"><center><p class="text-md">Participantes</p></center></div><br>
                      <div class="form-group">
                      <label class="col-form-label col-lg-4">Datos de Participantes</label>
                      <center>

                      <div class="col-md-8 table-responsive">  
                      <table class="table table-sm">
                        <thead>
                        <tr class="text-primary text-small">
                          <th><b>Datos de participantes</b></th>
                          <th><b>Hombres</b></th>
                          <th><b>Mujeres</b></th>
                          <!--<th>Total</th>-->
                        </tr>
                        </thead>
                        <tbody>
                          <?php 
                    $nh=0;$nm=0;$nt=0;$ii=0;
                       foreach ($participante->result() as $par) {
                        $nh=$nh+$par->cant_h;
                        $nm=$nm+$par->cant_m;
                        $nt=$nt+$par->total;
                        $ii++;
                         ?>
                         <tr>
                            <td class="text-small"><?=$par->nombre_tipopar?></td>
                          <td><input id="h<?=$ii?>" name="h<?=$ii?>" value="<?=$par->cant_h?>" onkeypress="return validarNumero(event)" type="text" align='right' placeholder="0" class="form-control input-sm n-border"/></td>
                          <td><input id="m<?=$ii?>" name="m<?=$ii?>" value="<?=$par->cant_m?>" onkeypress="return validarNumero(event)" type="text" align='right' placeholder="0" class="form-control input-sm n-border"/></td>
                         </tr><?php
                       }
                    ?>
                      
                      </tbody>
                      </table>
                     </div>
                     </center> 
                    </div>
                     </div>                    
                  <hr>
                  <div class="float-right">
                      <input type="submit" onclick="" class="btn btn-primary" value="Guardar Cambios Realizados">
                    </div>
                </form>                
              </div>
            </div>
          </div>
        </div>
      </div>
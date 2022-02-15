
<div class="panel-header panel-header-sm">
   </div>
<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Informe T&eacute;cnico <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a></a>
                </h5>
                
              </div>
              <div class="card-body">
                <form autocomplete="off" action="cnuevo_informe/agregar?ac=<?=$actividad->act_id?>&p=<?=$idproy?>" class="validate-form" method="post">
                    <div class="col-md-12 pr-1">
                      <div class="rounded titulos"><center><p class="text-md">Resumen</p></center></div><br>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group validate-input" data-validate="Campo requerido">
                            <label>Objetivos</label>
                            <textarea type="text" id="obs" name="obs" class="form-control" placeholder="Escriba aqui..."></textarea>
                         </div>
                        </div>
                         <div class="col-md-4">
                          <div class="form-group validate-input" data-validate="Campo requerido">
                            <label>Descripci&oacute;n</label>
                            <textarea type="text" id="des" name="des" class="form-control" placeholder="Escriba aqui..."></textarea>
                         </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group validate-input" data-validate="Campo requerido">
                            <label>Logros</label>
                            <textarea type="text" id="log" name="log" class="form-control" placeholder="Escriba aqui..."></textarea>
                         </div>
                        </div>
                      </div>
                      <div class="rounded titulos"><center><p class="text-md">Observaciones</p></center></div><br>
                      <div class="col-md-12">
                          <div class="form-group">
                            <label>Observaci&oacute;n</label>
                            <textarea type="text" id="obser" name="obser" class="form-control" placeholder="Escriba aqui..."></textarea>
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
                               foreach ($comunidades->result() as $com) {
                                ?><option value="<?=$com->com_id?>"><?=$com->com_nom?> @ <?=$com->dep_des?></option><?php
                               }
                              ?>
                          </select>
                      </div>
                        </div>   
                  </center></div>
                      <div class="rounded titulos"><center><p class="text-md">Organizaciones</p></center></div><br>
                      <div class="form-group">
                            <label>Organizaciones</label>
                            <textarea type="text" id="org_inf" name="org_inf" class="form-control" placeholder="Ingrese aqui las organizaciones..."></textarea>
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
                        <tr>
                          <td class="text-small">Autoridades Originarias y/&oacute; Sindicales</td>
                          <td><input id="h1" name="h1" onkeypress="return validarNumero(event)" type="text" align='right' placeholder="0" class="form-control input-sm n-border"/></td>
                          <td><input id="m1" name="m1" onkeypress="return validarNumero(event)" type="text" align='right' placeholder="0" class="form-control input-sm n-border"/></td>
                          <!--<td id="b_t">0</td>-->
                        </tr>
                        <tr>
                          <td class="text-small">Promotores y/&oacute; Lideres</td>
                          <td><input id="h2" name="h2" onkeypress="return validarNumero(event)"type="text" placeholder="0" class="form-control input-sm n-border"/></td>
                          <td><input id="m2" name="m2" onkeypress="return validarNumero(event)"type="text" placeholder="0" class="form-control input-sm n-border"/></td>
                          <!--<td id="a_t">0</td>-->
                        </tr>
                        <tr>
                          <td class="text-small">Publico en general y/&oacute; Bases</td>
                          <td><input id="h3" name="h3" onkeypress="return validarNumero(event)"type="text" placeholder="0" class="form-control input-sm n-border"/></td>
                          <td><input id="m3" name="m3" onkeypress="return validarNumero(event)"type="text" placeholder="0" class="form-control input-sm n-border"/></td>
                          <!--<td id="p_t">0</td>-->                          
                        </tr>
                        <tr>
                          <td class="text-small">Autoridades politicas  (GAM, GAD, ESTADO)</td>
                          <td><input id="h4" name="h4" onkeypress="return validarNumero(event)"type="text" placeholder="0" class="form-control input-sm n-border"/></td>
                          <td><input id="m4" name="m4" onkeypress="return validarNumero(event)"type="text" placeholder="0" class="form-control input-sm n-border"/></td>
                          <!--<td id="o_t">0</td>-->                          
                        </tr>
                        <tr>
                          <td class="text-small">Otros</td>
                          <td><input id="h5" name="h5" onkeypress="return validarNumero(event)"type="text" placeholder="0" class="form-control input-sm n-border"/></td>
                          <td><input id="m5" name="m5" onkeypress="return validarNumero(event)"type="text" placeholder="0" class="form-control input-sm n-border"/></td>
                          <!--<td id="g_t">0</td>-->
                        </tr>
                      </tbody>
                        <!--<tr>
                          <th>Totales</th>
                          <th>0</th>
                          <th>0</th>
                          <th>0</th>
                        </tr>-->
                      </table>
                     </div>
                     </center> 
                    </div>
                     </div>                    
                  <hr>
                  <div class="float-right">
                      <input type="submit" onclick="" class="btn btn-primary" value="Guardar Datos">
                    </div>
                </form>                
              </div>
            </div>
          </div>
        </div>
      </div>
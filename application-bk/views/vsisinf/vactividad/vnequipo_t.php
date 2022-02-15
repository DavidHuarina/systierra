
<div class="panel-header-sm bg-warning">
   </div>
<div class="content">
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Agregar 
                </h5>
                
              </div>
              <div class="card-body">
                <form id="form_cb" autocomplete="off" action="#" class="validate-form" method="post">
                 <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label class="cb-radio" onclick="displayBlock('optradio1','optradio2')"><input type="radio" value="1" name="optradio" id="optradio1"  checked="checked">Personal</label>
                        <label class="cb-radio" onclick="displayBlock('optradio2','optradio1')"><input type="radio" value="2" name="optradio" id="optradio2">Invitado</label>
                        <hr>
                        <div id="lista-com">
                         <div class="form-group">
                          <label>Seleccione al personal</label>
                            <select id="equipo-trab" onchange="llenatabla(<?=$actividad->act_id?>,this.value,'personal')" data-placeholder="Seleccione un colaborador" class="form-control select-plantilla">
                              <option value="-1">Ninguno</option>
                              <?php foreach ($personasMe->result() as $per) {
                                 $pers1=$this->col_act->getAllActPer($actividad->act_id,$per->id_persona);
                                if($pers1==null){
                                 ?><option value="<?=$per->id_persona?>"><?=$per->nombre_persona?> <?=$per->apellido_persona?></option><?php
                                }else{
                                  ?><option value="<?=$per->id_persona?>" disabled><?=$per->nombre_persona?> <?=$per->apellido_persona?></option><?php
                                }
                                
                              }?>
                            </select>
                         </div>
                        </div>
                        <div id="otro-com" style="display:none">
                          <div class="form-group">
                          <label>Seleccione Invitados registrados</label>
                          <select id="invitado-trab" onchange="llenatabla(<?=$actividad->act_id?>,this.value,'invitado')" data-placeholder="Seleccione un colaborador" class="form-control select-plantilla">
                              <option value="-1">Ninguno</option>
                              <?php foreach ($persona->result() as $per) {
                                $pers2=$this->col_act->getAllActPer($actividad->act_id,$per->id_persona);
                                if($pers2==null){
                                 ?><option value="<?=$per->id_persona?>"><?=$per->nombre_persona?> <?=$per->apellido_persona?></option><?php
                                }else{
                                  ?><option value="<?=$per->id_persona?>" disabled><?=$per->nombre_persona?> <?=$per->apellido_persona?></option><?php
                                }
                              }?>
                            </select>
                        </div>
                        <hr>
                        <label class="text-info">Registrar nuevo Invitado</label><br>
                         <div class="form-group">
                          <label>Nombre <span class='text-danger'>*</span></label>
                          <input type="text" id="nombre_otro" name="nombre_otro" class="form-control" placeholder="" value="">
                         </div>
                         <div class="form-group">
                          <label>Apellido <span class='text-danger'>*</span></label>
                          <input type="text" id="ap_otro" name="ap_otro" class="form-control" placeholder="" value="">
                         </div>
                         <div class="form-group">
                          <label>Telefono / Celular</label>
                          <input type="text" id="tel_otro" name="cargo_otro" class="form-control" placeholder="" value="">
                         </div>
                         <div id="mensaje">
                        </div>
                         <a href="#" id="btn-register-invitado" onclick="llenatablaInv(<?=$actividad->act_id?>)" class="btn btn-secondary float-right" style="display:none;">Registrar Invitado</a>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  
                  <hr>
                  <div class="float-left">
                      <a href="clista_actividad"class="btn btn-danger">Atras</a>
                    </div>
                  <div class="float-right">
                      <input type="button" onclick="guardarE(<?=$actividad->act_id?>)" class="btn btn-warning" value="Registrar lista">
                    </div>
                </form>                
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Equipo de trabajo <a href="#" class="text-success text-sm" onclick="agregarFiltros('table-equipo')">Agregar filtro</a> <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a>
                </h5>
                
              </div>
              <div class="card-body">
                  <div class="row">
                      <div class="col-md-12 table-responsive">
                          <table id="table-equipo" class="table">
                           <thead class="bg-plomo text-white text-small">
                           <tr>
                             <th>
                               <b class="text-plomo">Img</b>
                            </th>
                             <th>
                                <b>Nombre(s)</b>
                             </th>
                             <th>
                                <b>Apellido(s)</b>
                             </th>
                             <th>
                                <b class="text-warning">Descripci&oacute;n</b>
                             </th>
                             <th>
                                <b>Quitar</b>
                             </th>
                           </tr>
                           </thead>
                            <tbody id="cuerpo-tabla">
                              <?php 
                              $verificaResp=false;
                                foreach ($equipot->result() as $eqtt) {
                                  if($eqtt->resp==1){
                                    $verificaResp=true;
                                    break;
                                  }
                                 ?><?php
                                }
                              ?>
                            <?php foreach ($equipot->result() as $eqt) {
                              $perss=$this->personal->getAllIdPersona($eqt->id_persona);
                              $sel="personal";
                              if($perss==null){
                                $sel="invitado";
                                    $imagen="imagenes/storage/users/default-img/person.jpg";
                              }else{
                                $imagen=$perss->dir_imagen;
                              }
                              ?>
                              <tr id='<?=$eqt->id_persona?>'>
                              <td><img src='<?=$imagen?>' class="rounded-circle" width='50' height='50' alt='image' /></td>
                              <td><?=$eqt->nombre_persona?></td><td><?=$eqt->apellido_persona?></td>
                              <?php
                               if($eqt->resp==0){
                                if($verificaResp==false){
                                 ?><td><a href="cnequipo/resp?ac=<?=$actividad->act_id?>&id=<?=$eqt->id_persona?>" class='btn btn-secondary btn-simple btn-sm'>Hacer responsable</a></td><?php
                                }else{
                                 ?><td><a href="#" class='btn btn-secondary btn-simple btn-sm'>Colaborador</a></td><?php
                                }
                                
                               }else{
                                if($eqt->resp==2){
                                    ?><td><a href="#" class='btn btn-secondary btn-simple btn-sm'>Invitado</a></td><?php
                                }else{
                                  ?><td><a href="cnequipo/respn?ac=<?=$actividad->act_id?>&id=<?=$eqt->id_persona?>" class='btn btn-success btn-simple btn-sm'>Responsable</a></td><?php
                                }                                
                               }
                              ?>
                              
                              <td><a class='btn-default' onclick="borrarTabla(<?=$actividad->act_id?>,<?=$eqt->id_persona?>,'<?=$sel?>')"><i class='fa fa-times text-danger fa-fw'></i></a></td>
                              </tr>
                               <?php } ?>
                           </tbody>
                          </table>
                          </div>
                  </div>
                </form>                
              </div>
            </div>
          </div>
        </div>
      </div>
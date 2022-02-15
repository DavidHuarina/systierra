<div class="panel-header-sm bg-info">
</div>
 <div class="content"><!--principio de Panel-->
          <div class="row">
               <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Reportes</h5>
                </div>
               </div> 
           </div>          
           <div class="row">
              <div class="card">
                <div class="card-body">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Proyectos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Actividades</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Informes</a>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                      <form id="pro_form" action="creportes/enviar" method="POST" class="form-group">
                      <div class="container-fluid">
                          <div class="rounded titulos"><center><p class="text-md">Proyectos</p></center></div><br>
                          <label>Filtre los datos seg&uacute;n vea conveniente.</label><br>
                          <div class="proyectos">
                          <!--<div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="reportes_obj" value="option1" onclick="mostrarChecked(this.id,'form_obj')">
                            <label class="form-check-label" for="">OBJETIVOS ESPECIFICOS</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="">RESULTADOS</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
                            <label class="form-check-label" for="">INDICADORES DE RESULTADOS</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="option4">
                            <label class="form-check-label" for="">ACTIVIDADES DE MARCO LOGICO</label>
                          </div>-->
                          <?php 
                          $cc=0;
                          foreach ($proyecto->result() as $proy) {
                            $cc++;
                            if($proy==null){
                             ?><label>No Hay Ningun Proyecto Disponible</label><br><?php
                            }else
                            {
                              ?>
                              <div id="div_p_<?=$cc?>">
                             <label class="cb-checkbox" id="todos_p<?=$cc?>" onclick="mostrarChecked('rep_proy_<?=$cc?>','form-obj-<?=$proy->id_proyecto?>')">
                              <table>
                               <tr>
                                 <td valign="top"><input class="form-check-input" type="checkbox" id="rep_proy_<?=$cc?>" name="proy[]" value="<?=$proy->id_proyecto?>" checked="checked"></td>
                                 <td valign="top"><label><?=$proy->nombre_proyecto?></label></td>
                               </tr>
                              </table>
                             </label>
                             <div id="form-obj-<?=$proy->id_proyecto?>" class="container-fluid">
                              <div class="rounded titulos"><center><p class="text-md">Objetivos Espec&iacute;ficos</p></center></div><br>
                              <?php
                              echo "<script></script>";
                              $objetivo=$this->obe->getByIdProy($proy->id_proyecto);
                                 foreach ($objetivo->result() as $obj) {
                                   ?>
                                  <div class="checkbox-row-<?=$cc?>">
                                 <label class="cb-checkbox" onclick="mostrarChecked('rep_obj_<?=$obj->id_obe?>','form-res-<?=$obj->id_obe?>')">
                                  <table>
                                    <tr>
                                     <td valign="top"><input class="form-check-input" type="checkbox" id="rep_obj_<?=$obj->id_obe?>" name="obe[]" value="<?=$obj->id_obe?>" checked="checked"></td>
                                     <td valign="top"><label class="" for=""><?=$obj->descripcion?></label></td>
                                    </tr>
                                  </table>
                                 </label>
                                 </div>
                                 <div id="form-res-<?=$obj->id_obe?>" class="container-fluid">
                                  <div class="rounded titulos"><center><p class="text-md">Resultados</p></center></div><br>
                                  <?php
                                  $result=$this->resultados->getByIdObe($obj->id_obe);
                                  foreach ($result->result() as $res) {
                                   ?>
                                   <label class="cb-checkbox" onclick="mostrarChecked('rep_res_<?=$res->id_result?>','form-ind-<?=$res->id_result?>')">
                                     <table>
                                       <tr>
                                        <td valign="top"><input class="form-check-input" type="checkbox" id="rep_res_<?=$res->id_result?>" name="res[]" value="<?=$res->id_result?>" checked="checked"></td>
                                        <td valign="top"><label class="" for=""><?=$res->descripcion?></label></td>
                                       </tr>
                                     </table>
                                   </label>
                                   <div id="form-ind-<?=$res->id_result?>" class="container-fluid">
                                    <div class="rounded titulos"><center><p class="text-md">Indicadores de resultados</p></center></div><br>
                                  <?php 
                                   $indicador=$this->indicador->getByIdResult($res->id_result);
                                     foreach ($indicador->result() as $ind) {
                                   ?>
                                     <label class="cb-checkbox" onclick="mostrarChecked('rep_ind_<?=$ind->id_ind?>','form-act-<?=$ind->id_ind?>')">
                                       <table>
                                         <tr>
                                         <td valign="top"><input class="form-check-input" type="checkbox" id="rep_ind_<?=$ind->id_ind?>" name="ind[]" value="<?=$ind->id_ind?>" checked="checked"></td>
                                          <td valign="top"><label class="" for=""><?=$ind->descripcion?></label></td>
                                         </tr>
                                       </table>
                                     </label>
                                     <div id="form-act-<?=$ind->id_ind?>" class="container-fluid">
                                      <div class="rounded titulos"><center><p class="text-md">Actividades de Marco L&oacute;gico</p></center></div><br>
                                    <?php 
                                    $act_ml=$this->act_ml->getByIdInd($ind->id_ind); 
                                      foreach ($act_ml->result() as $ml) {
                                     ?>
                                       <label class="cb-checkbox">
                                         <table>
                                           <tr>
                                           <td valign="top"><input class="form-check-input" type="checkbox" id="rep_ml_<?=$ml->id_act_ml?>" name="ml[]" value="<?=$ml->id_act_ml?>" checked="checked"></td>
                                            <td valign="top"><label class="" for=""><?=$ml->descripcion?></label></td>
                                           </tr>
                                         </table>
                                       </label>
                                      <?php                                                          
                                       }
                                      ?></div><?php                                                                   
                                     } 
                                    ?></div><?php                            
                                   }
                                  ?></div><?php
                                  }
                                 ?></div></div><?php
                            }
                          }?>
                          </div>
                          
                                      
                      </div>
                    </div>
                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <div class="rounded titulos"><center><p class="text-md">Fecha de la actividad</p></center></div><br>
                      <div class="row">
                        <div class="col-md-6 pr-1">
                          <div class="form-group validate-input" data-validate="Ingrese una fecha">
                            <label>Desde</label>
                             <input type="text" id="fi_p" name="fi_p"class="form-control" placeholder="Ej: dd/mm/aaaa" value="">    
                          </div>
                        </div>
                        <div class="col-md-6 pr-1">
                          <div class="form-group validate-input" data-validate="Ingrese una fecha">
                            <label>Hasta</label>
                            <input type="text" id="ff_p" name="ff_p"class="form-control" placeholder="Ej: dd/mm/aaaa" value="">
                          </div>
                        </div>
                      </div>
                      <div class="rounded titulos"><center><p class="text-md">Tipo de actividad</p></center></div><br>
                      <!--<div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label><input type="radio" value="1" name="optradio" id="optradio1" onclick="displayBlock(this.id,'optradio2')" checked>Todos</label>
                    
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label><input type="radio" value="2" name="optradio" id="optradio2" onclick="displayBlock(this.id,'optradio1')">Seleccione</label>
    
                      </div>
                    </div>
                  </div>-->
                 <!-- <div id="lista-com"></div>
                  <div id="otro-com" style="display:none">-->     
                      <div class="row">
                        <div class="container-fluid example1">
                          <div class="">
                            <label class="cb-checkbox" id="todos_tipo">
                            <table>
                              <tr>
                              <td valign="top"><input type="checkbox" name="todos_tipo" value="1" onclick="seleccionarTodo(this.id)"></td>
                               <td valign="top"><label class="" for="">Todo</label></td>
                              </tr>
                            </table>
                          </label>
                          </div>
                          <?php 
                          $cont=0;
                           foreach ($tipo->result() as $tip) {
                            ?>
                          <div class="checkbox-row">
                            <label class="cb-checkbox">
                            <table>
                              <tr>
                              <td valign="top"><input class="tipo_act" type="checkbox" id="tipo<?=$cont?>" value="tipo<?=$cont?>"></td>
                               <td valign="top"><label class="" for=""><?=$tip->tipo_nom?></label></td>
                              </tr>
                            </table>
                          </label>
                          </div>
                          
                            <?php
                           $cont++;
                           }
                          ?>
                        </div>
                      </div> 
                   <!--</div> -->
                    <!--<div class="rounded titulos"><center><p class="text-md">Otros datos</p></center></div><br>
                      <div class="row">                        
                        <div class="col-md-5">
                          <div class="form-group">
                          <label>Duraci&oacute;n</label><br>
                          <select id="sel_dias" name="sel_dias" class="form-control select-single-plantilla">
                              <?php 
                              for ($i=0; $i < $dias->dias; $i++) { 
                                ?><option value="<?=$i+1?>"><?=$i+1?></option><?php
                              }
                              ?> 
                          </select>
                         </div> 
                        </div>
                        <div class="col-md-7">
                        </div>
                      </div>-->
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                      <div class="rounded titulos"><center><p class="text-md">Datos del Informe Tecnico</p></center></div><br>
                      <div class="row">
                        <div class="col-md-6">
                         <div class="form-group">
                          <label>Responsable</label>
                            <select id="sel_resp"  data-placeholder="Seleccione una persona" class="form-control select-plantilla">
                              <option value="-1">Todos</option>
                              <?php foreach ($personasMe->result() as $per) {
                                 ?><option value="<?=$per->id_persona?>"><?=$per->nombre_persona?> <?=$per->apellido_persona?></option><?php 
                              }?>
                            </select>
                         </div>
                        </div>
                        
                        <div class="col-md-6">
                          <?php 
                          $part=0;
                           foreach ($participante->result() as $par) {
                            ?>
                          <div class="form-check">
                            <table>
                              <tr>
                              <td valign="top"><input class="form-check-input" type="checkbox" id="tipo<?=$part?>" value="tipo<?=$part?>" checked></td>
                               <td valign="top"><label class="" for=""><?=$par->nombre_tipopar?></label></td>
                              </tr>
                            </table>
                          </div>
                            <?php
                           $part++;
                           }
                          ?>
                        </div>
                      </div>
                      <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="reportes_obj" value="option1" onclick="mostrarChecked(this.id,'form_obj')">
                            <label class="form-check-label" for="">OBSERVACION</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="">COMUNIDADES</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="">SUB-ACTIVIDADES</label>
                          </div>

                          <div class="float-right">
                           <button type="submit" class="btn btn-info">Obtener Reporte</button>
                         </div>
                       </form>
                    </div>
                  </div>
                </div>               
               </div>
           </div>  
<!-- fin panel-->
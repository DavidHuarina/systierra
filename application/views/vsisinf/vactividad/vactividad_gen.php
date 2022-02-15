<div class="panel-header-sm bg-rojo">
</div>
 <div class="content"><!--principio de Panel-->
          <div class="row">          
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title mb-4">Otras actividades <small class="text-info"><?=$nact->num?></small></h4>
                </div>
                <div class="card-body">                  
                  <div class="fluid-container">
                    <?php
                    foreach ($actividad->result() as $act) {
                      switch ($act->id_estado) {
                        case 1:
                          $estilotext="text-muted";
                          $estadotext="Sin Solicitud";
                          $estilo="btn-secondary";
                          break;
                         case 2:
                          $estilotext="text-danger";
                          $estadotext="Solicitud sin enviar";
                          $estilo="btn-danger";
                          break;
                          case 3:
                          $estilotext="text-warning";
                          $estadotext="Solicitud enviada";
                          $estilo="btn-warning";
                          break;
                          case 4:
                          $estilotext="text-primary";
                          $estadotext="Solicitud Aprobada";
                          $estilo="btn-primary";
                          break;
                          case 5:
                          $estilotext="text-success";
                          $estadotext="Descargo enviado";
                          $estilo="btn-success";
                          break;

                        default:
                          # code...
                          break;
                      }
                      $idmensaje="mensaje".$act->act_id;
                      ?>
                      <div class="ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="row">
                      <div class="col-md-1 d-md-flex d-none">
                        <img class="img-lg rounded-circle" src="apps/full-icon/flat/iconos-sys/attachment.png" alt="profile image">
                      </div>
                      <?php 
                          $idper=$this->personal->getByIdUsuario($this->session->userdata('id_usuario_sesion'));
                          $respon=$this->personal->getByIdUsuario($act->act_resp);
                           $equipotrab=$this->col_act->Existe($idper->id_persona,$act->act_id);
                        ?>
                      <div class="ticket-details col-md-11">
                        <div class="d-flex">                          
                          <p class="text-rojo mr-1 mb-0"><?php $porciones = explode("@", $act->sub_nom);?>
                          Actividad. <?=$porciones[0]?></p>                   
                          <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap"><small>Creado por:</small> <?=$respon->nombre_persona?> <?=$respon->apellido_persona?></p>
                          
                        </div>
                        
                        <small class="text-muted">Proyecto:</small><label class="text-rojo"><?=$act->nombre_proyecto?></label>
                        <br>
                        <div id="<?=$idmensaje?>"></div>
                          <?php 
                          
                           if($equipotrab->num!=0){
                            $nparti=$this->parti->getByIdActN($act->act_id);
                             if($nparti->num==0){
                              ?>
                               <a class="btn btn-sm btn-secondary btn-simple tooltip-bg" data-toggle="tooltip" data-animated="fade" data-placement="left" data-html="true" 
                        title="<table>
                                 <tr>
                                   <td><img class='icon-sm' src='apps/full-icon/flat/contacto/inbox-3.png' alt='Sin imagen'></td>
                                   <td>
                                       <label class='text-white'> Completar Datos del informe técnico
                                      </label>
                                   </td>
                                 </tr>  
                               </table>"href="cnuevo_informe?id=<?=$act->id_proyecto?>&ac=<?=$act->act_id?>">
                                 <img class='icon-xsm' src='apps/full-icon/flat/contacto/inbox-3.png' alt='Sin imagen'></a>
                             <?php
                            }else{
                               ?>
                               <a class="btn btn-sm btn-secondary btn-simple tooltip-bg" data-toggle="tooltip" data-animated="fade" data-placement="left" data-html="true" 
                        title="<table>
                                 <tr>
                                   <td><img class='icon-sm' src='apps/full-icon/flat/contacto/inbox-1.png' alt='Sin imagen'></td>
                                   <td>
                                      <label class='text-white'>  Ver Informe Tecnico
                                      </label>
                                   </td>
                                 </tr>  
                               </table>"href="cvista_infTec?id=<?=$act->id_proyecto?>&ac=<?=$act->act_id?>">
                                 <img class='icon-xsm' src='apps/full-icon/flat/contacto/inbox-1.png' alt='Sin imagen'></a>
                              <?php   
                             }
                            ?>
                            <a href="#" onclick="eliminarEquipo(<?=$act->act_id?>,<?=$idper->id_persona?>)"class="btn btn-sm btn-secondary btn-simple tooltip-bg" data-toggle="tooltip" data-animated="fade" data-placement="bottom" data-html="true" 
                        title="<table>
                                 <tr>
                                   <td><i class='fa fa-tag'></i></td>
                                   <td>
                                       <label class='text-white'> Ya eres parte de esta actividad
                                      </label>
                                   </td>
                                 </tr>  
                               </table>"><i class="fa fa-tag"></i></a>
                               
                            <?php
                           }else{
                            $noti=$this->notificacion->solEmisor($this->session->userdata('id_usuario_sesion'));
                            $existenot=false;
                            foreach ($noti->result() as $notifi) {
                              $actividad = explode("%", $notifi->referencia);
                              if($actividad[2]==$act->act_id){
                                $existenot=true;
                                break;
                              }
                            }
                            if($existenot==true){
                             ?>
                            <a href="cnequipo/cancelarParte/<?=$act->act_id?>/<?=$this->session->userdata('id_usuario_sesion')?>/<?=$act->act_resp?>" class="btn btn-sm btn-secondary btn-simple tooltip-bg" data-toggle="tooltip" data-animated="fade" data-placement="bottom" data-html="true" 
                        title="<table>
                                 <tr>
                                   <td><i class='fa fa-user-times text-danger'></i></td>
                                   <td>
                                       <label class='text-white'> Cancelar la solicitud
                                      </label>
                                   </td>
                                 </tr>  
                               </table>"><i class="fa fa-user-times"></i></a>
                            <?php
                            }else{
                              ?>
                            <a href="cnequipo/serParte/<?=$act->act_id?>/<?=$this->session->userdata('id_usuario_sesion')?>/<?=$act->act_resp?>" class="btn btn-sm btn-warning btn-simple tooltip-bg" data-toggle="tooltip" data-animated="fade" data-placement="bottom" data-html="true" 
                        title="<table>
                                 <tr>
                                   <td><i class='fa fa-user-plus text-warning'></i></td>
                                   <td>
                                       <label class='text-white'> Enviar solicitud para formar parte del equipo técnico
                                      </label>
                                   </td>
                                 </tr>  
                               </table>"><i class="fa fa-user-plus"></i></a>
                            <?php
                            }
                            
                           }
                          ?>
                         
                         <a href="cnuevo_mensaje" class="btn btn-sm btn-secondary tooltip-bg" data-toggle="tooltip" data-animated="fade" data-placement="top" data-html="true" 
                        title="<table>
                                 <tr>
                                   <td><img class='icon-lg' src='<?=$respon->dir_imagen?>' alt='Sin imagen'></td>
                                   <td>
                                     <label class='text-white'>   Enviar mensaje al creador de la actividad:<br>
                                        <?=$respon->nombre_persona?>
                                      </label>
                                   </td>
                                 </tr>  
                               </table>"><i class="now-ui-icons ui-1_email-85"></i></a>
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Fecha:</small>
                            <small class="Last-responded mr-2 mb-0 text-muted"><?=strftime('%d de %B de %Y',strtotime($act->act_fecha))?></small>
                          </div>
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Duraci&oacute;n:</small>
                            <small class="Last-responded mr-2 mb-0 text-muted"><?php if($act->act_dias==1){ echo $act->act_dias." día";}else{ echo $act->act_dias." días";}?></small>
                          </div>
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Estado:</small>
                            <small class="Last-responded mr-2 mb-0 <?=$estilotext?>"><?=$estadotext?></small>
                          </div>
                        </div>
                      </div>                      
                    </div>
                    
                  </div>

                      <?php
                    }
                    ?>
                    
                  </div>
                </div>
              </div>
            </div>
          
          </div>
        </div><!-- fin panel-->
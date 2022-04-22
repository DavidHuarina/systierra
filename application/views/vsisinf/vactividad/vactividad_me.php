   <div class="panel-header">
        <div class="header text-center">
          <h2 class="title">Actividades</h2>
          <p class="category"><a href="#" data-toggle="modal" data-target="#modnact">Nueva Actividad</a> 

          </p>
        </div>
    </div>
 <div class="content"><!--principio de Panel-->
          <div class="row">          
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title mb-4">Mis Actividades <small class="text-info"><?=$nact->num?></small></h4>
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
                      ?>
                      <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-md-1 d-md-flex d-none">
                        <img class="img-sm rounded-circle mb-4 mb-md-0" src="apps/full-icon/flat/negocio/briefcase.png" alt="profile image">
                      </div>
                      <div class="ticket-details col-md-9">
                        <div class="d-flex">                          
                          <p class="text-info mr-1 mb-0"><?php $porciones = explode("@", $act->sub_nom);?>
                          <?=$porciones[0]?></p>
                          <!--<p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap"> <?=$act->tipo_nom?></p>-->
                          <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap"> - <?=$act->nombre_proyecto?></p>
                        </div>
                        <p class="text-muted ellipsis mb-2"><?php if($act->descripcion==""){ echo "Sin descripción";}else{ echo "".$act->descripcion."";}?>
                        </p>
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Inici&oacute; el:</small>
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
                      <div class="ticket-actions col-md-2">
                        <div class="btn-group dropdown">
                          <button type="button" class="btn btn-round <?=$estilo?> dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="now-ui-icons loader_gear"></i>
                          </button>
                          <div class="dropdown-menu">
                            <?php 
                               //$ncol_act=$this->col_act->getByIdActN($act->act_id);
                               $nparti=$this->parti->getByIdActN($act->act_id);
                                if($act->id_estado==1||$act->id_estado==2||$act->id_estado==3||$act->id_estado==4){
                                    if($act->id_estado==4||$act->id_estado==3){
                                      echo "<a class='dropdown-item' href='cnequipo?ac=".$act->act_id."'>
                                       <img class='icon-sm' src='apps/full-icon/flat/equipo/team-2.png' alt='Sin imagen'> <small>Equipo de trabajo</small></a>";
                                      if($nparti->num==0){
                                        ?>
                                        <a class="dropdown-item" href="cnuevo_informe?id=<?=$act->id_proyecto?>&ac=<?=$act->act_id?>">
                                          <img class='icon-sm' src='apps/full-icon/flat/contacto/inbox-3.png' alt='Sin imagen'> <small>Complementar datos</small></a>
                                       <?php
                                      }else{
                                        ?>
                                        <a class="dropdown-item" href="cvista_infTec?id=<?=$act->id_proyecto?>&ac=<?=$act->act_id?>">
                                          <img class='icon-sm' src='apps/full-icon/flat/contacto/inbox-1.png' alt='Sin imagen'> <small>Informe Técnico</small></a>
                                       <?php   
                                      }
                                       $soli=$this->sol_act->getByIdA($act->act_id);
                                         ?> 
                                          <div class="dropdown-divider"></div>
                                          <?php
                                         if($act->id_estado==4){                                          
                                          echo "<a class='dropdown-item' href='cnuevo_descargo?id=".$act->id_proyecto."&ac=".$act->act_id."'>
                                           <img class='icon-sm' src='apps/full-icon/flat/negocio/point-of-service.png' alt='Sin imagen'> <small>Descargo Fondo</small></a>";
                                         }
                                     }else{
                                        echo "<a class='dropdown-item' href='cenviar_solicitud?id=".$act->id_proyecto."&ac=".$act->act_id."' target='_blank'>
                                       <img class='icon-sm' src='apps/full-icon/flat/negocio/change.png' alt='Sin imagen'> Solicitar Fondo</a>";
                                     }
                                    
                                   }else{
                              ?>
                              
                                  <?php
                                   }

                            ?>
                            <a class="dropdown-item" href="cdetalle_actividad?id=<?=$act->id_proyecto?>&ac=<?=$act->act_id?>">
                              <img class='icon-sm' src='apps/full-icon/flat/documentos/text-2.png' alt='Sin imagen'> <small>Ver Detalles</small></a>
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
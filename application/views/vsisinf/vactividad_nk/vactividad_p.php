<div class="panel-header-sm bg-cafe">
</div> 
 <div class="content">
          <div class="row">          
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title mb-4">Actividades <small class="text-info"><?=$nact->num?></small><a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a></h4>
                </div>
                <div class="card-body">                  
                  <div class="fluid-container">
                    <?php
                    foreach ($actividad->result() as $act) {
                      ?>
                      <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-md-2 d-md-flex d-none">
                        <img class="img-sm rounded-circle mb-4 mb-md-0" src="imagenes/proyecto/AA.jpg" alt="profile image">
                      </div>
                      <div class="ticket-details col-md-8">
                        <div class="d-flex">                          
                          <p class="text-info mr-1 mb-0"><?php $porciones = explode("@", $act->sub_nom);?>
                          <?=$porciones[0]?></p>
                          <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap"> <?=$act->descripcion?></p>
                        </div>
                        <p class="text-muted ellipsis mb-2"><?php if($act->tipo_nom==""){ echo "Sin descripción";}else{ echo "".$act->tipo_nom."";}?>
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
                        </div>
                      </div>
                      <?php if($act->id_estado==1){
                        
                          $estilo="btn-danger";
                        }else{
                          if($act->id_estado==2){
                             $estilo="btn-warning";
                          }else{
                             $estilo="btn-success";
                          }
                        }?>
                      <div class="ticket-actions col-md-2">
                        <!--<div class="btn-group dropdown">
                          <button type="button" class="btn btn-round <?=$estilo?> dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="now-ui-icons loader_gear"></i>
                          </button>
                          <div class="dropdown-menu">
                            <?php if($act->id_estado==1||$act->id_estado==2){
                                    echo "<a class='dropdown-item' href='cenviar_solicitud?id=".$proy->id_proyecto."&ac=".$act->act_id."'>
                                     <img class='icon-sm' src='apps/full-icon/flat/negocio/change.png' alt='Sin imagen'><label class='text-small'>Solicitar Fondo</label></a>";
                                   }else{
                              ?>
                              <a class="dropdown-item " href="#">
                              <i class="now-ui-icons location_map-big"></i> Nueva actividad</a>
                              <a class="dropdown-item" href="#">
                              <i class="now-ui-icons design_bullet-list-67"></i> Ver detalles</a>
                              <a class="dropdown-item" href="#">
                              <i class="fa fa-world fa-fw text-primary"></i> Ver Actividades</a>
                              <div class="dropdown-divider"></div>
                                  <?php
                                   }
                            ?>
                          </div>
                        </div>-->
                      </div>
                    </div>
                      <?php
                    }
                    ?>
                    
                  </div>
                </div>
              </div>
            </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="apps/assets/img/f_1.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="imagenes/proyecto/p.jpg" alt="images">
                    <h5 class="title"><?=$proy->nombre_proyecto?></h5>
                  </a>
                  <p class="description">
                    <?=$proy->id_proyecto?>
                  </p>
                </div>
                <p class="description text-center">
                  " <?=$proy->resumen?> "
                </p>
              </div>
            </div>
          </div>
          </div>
        </div><!-- fin panel-->
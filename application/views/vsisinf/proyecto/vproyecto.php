<div class="panel-header-sm bg-celesverde">
</div>    
 <div class="content"><!--principio de Panel-->    
          <div class="row">          
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title mb-4">Proyectos <small class="text-celesverde"><?=$nproy->num?></small><a class="float-right nav-link" href="cnuevo_proyecto">
                    <img class="icon-sm" src="apps/full-icon/flat/iconos-sys/plus.png"></a></h4>
                </div>
                <div class="card-body">                  
                  <div class="fluid-container">
                    <?php
                    foreach ($proyecto->result() as $proy) {
                          $fondo=$this->proy_EP->getByIdProyecto($proy->id_proyecto);
                          $respon=$this->personal->getByIdUsuario($proy->id_responsable);
                      ?>
                      <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-md-1 d-md-flex d-none">
                        <img class="img-lg mb-4 mb-md-0" src="imagenes/proyecto/p.jpg" alt="profile image">
                      </div>
                      <div class="ticket-details col-md-9">
                        <div class="d-flex row">
                          <div class="col-md-9"><p class="text-celesverde mr-1 mb-0"><?=$proy->nombre_proyecto?></p></div>                          
                          <div class="col-md-3"><p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap"> <small>C&oacute;digo: <?=$proy->id_proyecto?></small></p></div>
                        </div>
                        <p class="text-muted ellipsis mb-2"><?php if($proy->resumen==""){ echo "Sin descripción";}else{ echo "Descripción. ".$proy->resumen."";}?>
                        </p>
                        <hr>
                        <div class="row">
                          <div class="col-md-1"><img class="img-sm" src="<?=$respon->dir_imagen?>" alt="profile image"></div>
                          <div class="col-md-11"><label class="text-primary"><small class="text-muted">Creado por:</small> <?=$respon->nombre_persona?> <?=$respon->apellido_persona?></label></div>
                        </div> 
                        <hr>
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Inici&oacute; el:</small>
                            <small class="Last-responded mr-2 mb-0 text-muted"><?=strftime('%d de %B de %Y',strtotime($proy->fecha_inicio))?></small>
                          </div>
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Terminar&aacute; el:</small>
                            <small class="Last-responded mr-2 mb-0 text-muted"><?=strftime('%d de %B de %Y',strtotime($proy->fecha_fin))?></small>
                          </div>
                        </div>
                      </div>
                      <?php 
                if($idrol==4000||$idrol==5000){
                      if($proy->presupuesto==1){
                        if($fondo==null){
                          $estilo="btn-danger";
                          $labelBoton="No disponible";
                        }else{
                         $estilo="btn-warning";
                         $labelBoton="No disponible"; 
                       }                        
                      }else{
                        $estilo="btn-success";
                        $labelBoton="Disponible";
                      }
                      ?>
                      <div class="ticket-actions col-md-2">
                        <div class="btn-group dropdown">
                          <button type="button" class="btn btn-round <?=$estilo?> dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <?=$labelBoton?><!--<i class="now-ui-icons loader_gear"></i>-->
                          </button>
                          <div class="dropdown-menu">
                            <?php if($proy->presupuesto==1){
                                    echo "<a class='dropdown-item' href='cfondo_proy?id=$proy->id_proyecto'>
                                     <img class='icon-sm' src='apps/full-icon/flat/negocio/atm.png' alt='Sin imagen'> <small>Agregar presupuesto</small></a>";
                                   }else{
                              ?>
                              <a class="dropdown-item " href="cnueva_actividad?id=<?=$proy->id_proyecto?>&fa=none&p=0">
                              <img class='icon-sm' src='apps/full-icon/flat/oficina/clipboard.png' alt='Sin imagen'> <small>Nueva Actividad</small></a>
                              
                              <a class="dropdown-item" href="clista_actividad_proy?id=<?=$proy->id_proyecto?>">
                              <img class='icon-sm' src='apps/full-icon/flat/iconos-sys/attachment.png' alt='Sin imagen'> <small>Ver Actividades</small></a>
                              <div class="dropdown-divider"></div>
                                  <?php
                                   }
                            ?>
                            <a class="dropdown-item" href="cdetalle_proyecto?id=<?=$proy->id_proyecto?>">
                              <img class='icon-sm' src='apps/full-icon/flat/oficina/notes-1.png' alt='Sin imagen'> <small>Ver detalles</small></a>
                            <!--<a class="dropdown-item" href="#">
                              <i class="fa fa-history fa-fw"></i>Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-check text-success fa-fw"></i>Resolve Issue</a>
                            <a class="dropdown-item" href="cnuevo_proyecto/eliminar?id=<?=$proy->id_proyecto?>">
                              <i class="fa fa-times text-danger fa-fw"></i>Eliminar</a>-->
                          </div>
                        </div>
                      </div>
                      <?php 
                 }?>
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
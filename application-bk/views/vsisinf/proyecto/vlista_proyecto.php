
        <div class="content-wrapper"><!--principio de Panel-->
          <div class="row">
            <?php
            $cont=1;
            foreach ($proyecton->result() as $proy) { 
              if($cont<=4){
                ?>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <h5 class="card-title mb-4"><?=$proy->nombre_proyecto?></h5>
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-layers text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Presupuesto</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">$65,650</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> 65% en progreso
                  </p>
                  <!--<button class="btn btn-success btn-sm">detalle de gastos</button>-->
                </div>
              </div>
            </div>
             <?php
              }
              $cont=$cont+1;
            }
            ?>
            
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-4">Mis proyectos</h5>
                  <hr class="hr">
                  <div class="fluid-container">
                    <?php
                    foreach ($proyecto->result() as $proy) {
                      ?>
                      <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-md-1">
                        <img class="img-lg rounded-circle" src="imagenes/proyecto/p.jpg" alt="profile image">
                      </div>
                      <div class="ticket-details col-md-9">
                        <div class="d-flex">
                          <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap"><?=$proy->nombre_proyecto?> :</p>
                          <p class="text-primary mr-1 mb-0">CODIGO: <?=$proy->id_proyecto?></p>
                          <p class="mb-0 ellipsis">Donec rutrum congue leo eget malesuada.</p>
                        </div>
                        <p class="text-gray ellipsis mb-2">Donec rutrum congue leo eget malesuada. Quisque velit nisi, pretium ut lacinia in, elementum id enim
                          vivamus.
                        </p>
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-gray">Inici&oacute; el:</small>
                            <small class="Last-responded mr-2 mb-0 text-gray"><?=strftime('%d de %B de %Y',strtotime($proy->fecha_inicio))?></small>
                          </div>
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-gray">Terminar&aacute; el:</small>
                            <small class="Last-responded mr-2 mb-0 text-gray"><?=strftime('%d de %B de %Y',strtotime($proy->fecha_fin))?></small>
                          </div>
                        </div>
                      </div>
                      <?php 
                        if($idrol==4000||$idrol==5000){
                          ?>
                       <div class="ticket-actions col-md-2">
                        <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fa fa-cog fa-fw"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="cnueva_actividad?c=<?=$proy->id_proyecto?>">
                              <i class="fa fa-plus fa-fw text-warning"></i>Añadir actividad</a>
                              <a class="dropdown-item" href="cvista_detalles_proyecto?id=<?=$proy->id_proyecto?>">
                              <i class="fa fa-history fa-fw text-success"></i>Ver detalles</a>
                              <a class="dropdown-item" href="#">
                              <i class="mdi mdi-calendar-check text-primary"></i>Ver Actividades</a>
                              <div class="dropdown-divider"></div>
                            <!--<a class="dropdown-item" href="#">
                              <i class="fa fa-history fa-fw"></i>Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-check text-success fa-fw"></i>Resolve Issue</a>-->
                            <a class="dropdown-item" href="cnuevo_proyecto/eliminar?id=<?=$proy->id_proyecto?>">
                              <i class="fa fa-times text-danger fa-fw"></i>Eliminar</a>
                          </div>
                        </div>
                      </div>
                          <?php
                        }
                      ?>
                      
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
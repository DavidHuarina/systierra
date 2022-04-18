                    
   <div class="panel-header">
        <div class="header text-center">
          <h2 class="title">Solicitudes de Fondos en Avance</h2>
        </div>
    </div>
 <div class="content"><!--principio de Panel-->
          <div class="row">          
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title mb-4">Solicitudes <small class="text-info"><?=$nsol->num?></small></h4>
                </div>
                <div class="card-body">                  
                  <div class="fluid-container">
                    <?php
                    foreach ($solicitud->result() as $sol) {
                       if($sol->estado_s==1){
                          $estado="Sin Aprobación";
                          $estilo="btn-danger";
                          $estilotext="text-danger";
                        }else{
                          if($sol->estado_s==2){
                            $estado="Aprobado con pendiente Descargo";
                             $estilo="btn-warning";
                             $estilotext="text-warning";
                          }else{
                             $estado="Aprobado y Descargo recibido";
                             $estilo="btn-success";
                             $estilotext="text-success";
                          }
                        }?>
                      <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-md-1 d-md-flex d-none">
                        <img class="img-sm mb-4 mb-md-0" src="apps/full-icon/flat/negocio/change.png" alt="profile image">
                      </div>
                      <div class="ticket-details col-md-9">
                        <div class="d-flex">                          
                          <p class="text-info mr-1 mb-0"><?php $porciones = explode("@", $sol->sub_nom);?>
                          <?=$porciones[0]?></p>
                          <!--<p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap"> <?=$sol->tipo_nom?></p>-->
                          <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap"> - <?=$sol->nombre_persona?> <?=$sol->apellido_persona?></p>
                          <label class="text-lg text-primary"><b><?=number_format($sol->total, 2, '.', ',');?></b> <small>Bs</small></label>
                        </div>
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Solicitado el:</small>
                            <small class="Last-responded mr-2 mb-0 text-muted"><?=strftime('%d de %B de %Y',strtotime($sol->fecha_s))?></small>
                          </div>
                          <div class="col-8 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Estado:</small>
                            <small class="Last-responded mr-2 mb-0 <?=$estilotext?>"><?=$estado?></small>
                          </div>
                        </div>
                      </div>
                      
                      <div class="ticket-actions col-md-2">
                        <div class="btn-group dropdown">
                          <button type="button" class="btn btn-round <?=$estilo?> dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="now-ui-icons loader_gear"></i>
                          </button>
                          <div class="dropdown-menu">
                            <?php if((($sol->estado_s==1||$sol->estado_s==2||$sol->estado_s==3)&&$idrol==3000)||$global_usuario=="ADMIN-01"){
                                    if($sol->estado_s==2){
                                       echo "<a class='dropdown-item' href='#'>
                                       <img class='icon-sm' src='apps/full-icon/flat/oficina/trash.png' alt='Sin imagen'> <small>Cancelar Aprobacion</small></a>";
                                     }else{
                                      if($sol->estado_s==3){

                                      }else{
                                        echo "<a class='dropdown-item' href='csolicitudes/aprobar?q=".$sol->id_sol."&z=".$sol->act_id."'>
                                       <img class='icon-sm' src='apps/full-icon/flat/negocio/stamp-1.png' alt='Sin imagen'> <small>Aprobar solicitud</small></a>";
                                      }
                                        
                                     }
                                    
                                   }
                                   $act=$this->actividad->getById($sol->act_id);
                              ?>
                              <a class="dropdown-item " href="storage/solfa/<?=$sol->id_sol?>-SOL/solfa.pdf" download="solFA - actividad <?=$act->sub_nom?>.pdf">
                              <img class='icon-sm' src='apps/full-icon/flat/documentos/pdf-5.png' alt='Sin imagen'> <small>Descargar en PDF</small></a>
                              <!--<a class="dropdown-item" href="#">
                              <img class='icon-sm' src='apps/full-icon/flat/docs/001-word.png' alt='Sin imagen'> <small>Descargar en Word</small></a>-->
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#">
                              <img class='icon-sm' src='apps/full-icon/flat/equipo/contract.png' alt='Sin imagen'> <small>Ver a Detalle</small></a>
                              
                                
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
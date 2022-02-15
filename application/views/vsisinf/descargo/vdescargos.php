                    
   <div class="panel-header">
        <div class="header text-center">
          <h2 class="title">Descargos de Fondos</h2>
          <p class="category"><a href="#">lista de descargos</a> 
          </p>
        </div>
    </div>
 <div class="content"><!--principio de Panel-->
          <div class="row">          
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title mb-4">Descargos recibidos <small class="text-info"><?=$ndes->num?></small></h4>
                </div>
                <div class="card-body">                  
                  <div class="fluid-container">
                    <?php
                    foreach ($descargo->result() as $descar) {
                       if($descar->estado_s==1){
                          $estado="Sin Aprobación";
                          $estilo="btn-danger";
                          $estilotext="text-danger";
                        }else{
                          if($descar->estado_s==2){
                            $estado="Aprobado con pendiente Descargo";
                             $estilo="btn-primary";
                             $estilotext="text-primary";
                          }else{
                            if($descar->estado_s==4){
                              $estado="Aprobado y Descargo recibido";
                              $estilo="btn-warning";
                              $estilotext="text-warning";
                            }else{
                              $estado="Aprobado y Descargo recibido";
                              $estilo="btn-success";
                              $estilotext="text-success";
                            }
                             
                          }
                        }?>
                      <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-md-1 d-md-flex d-none">
                        <img class="img-sm mb-4 mb-md-0" src="apps/full-icon/flat/negocio/notes-2.png" alt="profile image">
                      </div>
                      <div class="ticket-details col-md-9">
                        <div class="d-flex">                          
                          <p class="text-info mr-1 mb-0">
                          <?=$descar->banco?></p>
                          <!--<p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap"> <?=$descar->tipo_nom?></p>-->
                          <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap"> - <?=$descar->n_cheque?></p>
                          <small class="text-dark font-weight-semibold mr-2 mb-0 no-wrap"> / <?=$descar->nombre_persona?> <?=$descar->apellido_persona?></small>
                          <?php if($descar->tgasto==0){
                            ?>
                           <label class="text-lg text-primary">Solicitado <b><?=number_format($descar->total, 2, '.', ',');?></b> <small>Bs</small></label>
                           <label class="text-lg text-danger">&nbsp;A&uacute;n no lleg&oacute; el descargo</label> 
                       <?php
                          } else{
                            ?>
                          <label class="text-lg text-primary">Solicitado <b><?=number_format($descar->total, 2, '.', ',');?></b> <small>Bs</small></label> 
                          <label class="text-lg text-danger">&nbsp;Total Gasto <b><?=number_format($descar->tgasto, 2, '.', ',');?></b> <small>Bs</small></label> 
                          
                            <?php
                            if($descar->saldo<0){
                              ?>
                             <label class="text-lg text-warning">&nbsp;Reembolso <b><?=number_format(abs($descar->saldo), 2, '.', ',');?></b> <small>Bs</small></label> 
                              <?php
                            }else{
                              ?>
                             <label class="text-lg text-success">&nbsp;Total Depositado <b><?=number_format($descar->saldo, 2, '.', ',');?></b> <small>Bs</small></label> 
                              <?php
                            }
                          }?>
                          
                        </div>
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-6 d-flex">
                            <small class="mb-0 mr-2 text-muted">Fecha de solicitud:</small>
                            <small class="Last-responded mr-2 mb-0 text-muted"><?=strftime('%d de %B de %Y',strtotime($descar->fecha_s))?></small>
                          </div>
                          <?php if($descar->tgasto==0){
                            ?>
                           <div class="col-6 d-flex">
                            <small class="mb-0 mr-2 text-muted">Fecha de Descargo:</small>
                            <small class="Last-responded mr-2 mb-0 text-muted">Sin descargo</small>
                          </div>
                       <?php
                          } else{
                            ?>
                          <div class="col-6 d-flex">
                            <small class="mb-0 mr-2 text-muted">Fecha de Descargo:</small>
                            <small class="Last-responded mr-2 mb-0 text-muted"><?=strftime('%d de %B de %Y',strtotime($descar->f_descargo))?></small>
                          </div><?php
                          }?>
                          
                        </div>
                      </div>
                      
                      <div class="ticket-actions col-md-2">
                        <div class="btn-group dropdown">
                          <button type="button" class="btn btn-round <?=$estilo?> dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="now-ui-icons loader_gear"></i>
                          </button>
                          <div class="dropdown-menu">
                              <a class="dropdown-item " href="storage/descar/<?=$descar->act_id?>-des/des.pdf" download="DF - actividad <?=$descar->act_id?>.pdf">
                              <img class='icon-sm' src='apps/full-icon/flat/documentos/pdf-5.png' alt='Sin imagen'> <small>Descargar en PDF</small></a>
                              <a class="dropdown-item" href="#">
                              <img class='icon-sm' src='apps/full-icon/flat/docs/001-word.png' alt='Sin imagen'> <small>Descargar en Word</small></a>
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
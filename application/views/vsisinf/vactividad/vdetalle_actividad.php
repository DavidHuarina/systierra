<?php $porciones = explode("@", $actividad->sub_nom);?>
<div class="panel-header-sm bg-warning">
</div>
   <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Detalle de actividad <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a>
                    <img class='icon-lg float-right' src='images/logo.png' alt='Sin imagen'></h5>
                <p class="category">Actividad
                  <a href="#"><?=$porciones[0]?></a>
                </p>

              </div>
              <div class="card-body">
                <div class="card">
                 <div class="card-body">
                  <p><small>Estado de la actividad</small> <?php 
                  switch ($actividad->id_estado) {
                    case 1:
                      $estilobar="bg-secondary";
                      $bar='10%';
                       echo "<label class='text-secondary'>Nueva Actividad!</label>";
                       ?>
                       <div class="progress">
                        <div class="progress-bar <?=$estilobar?>" style="width:<?=$bar?>"><?=$bar?></div>
                       </div>
                       <hr>
                       <a href='cenviar_solicitud?id=<?=$proy->id_proyecto?>&ac=<?=$actividad->act_id?>' class='btn btn-danger'>Enviar Solicitud</a>
                       <?php

                      break;
                    case 2:
                      $estilobar="bg-danger";
                      $bar='15%';
                       echo "<label class='text-danger'>Sin enviar solicitud!</label>";
                       ?>
                       <hr>
                       <div class="progress">
                        <div class="progress-bar <?=$estilobar?>" style="width:<?=$bar?>"><?=$bar?></div>
                       </div>
                       <hr>
                       <a href='cenviar_solicitud?id=<?=$proy->id_proyecto?>&ac=<?=$actividad->act_id?>' class='btn btn-danger'>Enviar Solicitud</a>
                       <?php
                      break;
                      case 3:
                      $estilobar="bg-warning";
                      $bar='25%';
                       echo "<label class='text-warning'>Solicitud enviada!</label>";
                       ?>
                       <div class="progress">
                        <div class="progress-bar <?=$estilobar?>" style="width:<?=$bar?>"><?=$bar?></div>
                       </div>
                       <hr>
                       <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                         <a href="cvista_solA?ac=<?=$actividad->act_id?>&id=<?=$proy->id_proyecto?>&sol=<?=$soli->id_sol?>" class="btn btn-secondary">Solicitud <small>de <?=$soli->total?> BS.</small></a>
                          <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                            </button>
                           <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="storage/solfa/<?=$soli->id_sol?>-SOL/solfa.pdf" download="solFA - actividad <?=$actividad->sub_nom?>.pdf">
                             <img class='icon-sm' src='apps/full-icon/flat/documentos/pdf-5.png' alt='Sin imagen'> <small>Descargar en PDF</small></a>
                             <a class="dropdown-item" href="#" onclick="verPdf('visor-pdf','storage/solfa/<?=$soli->id_sol?>-SOL/solfa.pdf#zoom=90%')">
                             <img class='icon-sm' src='apps/full-icon/flat/documentos/email-1.png' alt='Sin imagen'> <small>Ver en SysTierra</small></a>
                             </div>
                           </div>
                        </div>
                       <?php
                      break;
                      case 4:
                      $estilobar="bg-primary";
                      $bar='60%';
                       echo "<label class='text-primary'>Solicitud aprovada!</label>";
                       ?>                       
                       <div class="progress">
                        <div class="progress-bar <?=$estilobar?>" style="width:<?=$bar?>"><?=$bar?></div>
                       </div>
                       <hr>
                       <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                         <a href="cvista_solA?ac=<?=$actividad->act_id?>&id=<?=$proy->id_proyecto?>&sol=<?=$soli->id_sol?>" class="btn btn-secondary">Solicitud <small>de <?=$soli->total?> BS.</small></a>
                          <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                            </button>
                           <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="storage/solfa/<?=$soli->id_sol?>-SOL/solfa.pdf" download="solFA - actividad <?=$actividad->sub_nom?>.pdf">
                             <img class='icon-sm' src='apps/full-icon/flat/documentos/pdf-5.png' alt='Sin imagen'> <small>Descargar en PDF</small></a>
                             <a class="dropdown-item" href="#" onclick="verPdf('visor-pdf','storage/solfa/<?=$soli->id_sol?>-SOL/solfa.pdf#zoom=90%')">
                             <img class='icon-sm' src='apps/full-icon/flat/documentos/email-1.png' alt='Sin imagen'> <small>Ver en SysTierra</small></a>
                             </div>
                           </div>
                        </div>
                       <a href='cnuevo_descargo?id=<?=$proy->id_proyecto?>&ac=<?=$actividad->act_id?>' class='btn btn-danger'>Nuevo Descargo</a>
                       <?php
                      break;
                    default:
                     $estilobar="bg-success";
                     $bar='100%';
                       echo "<label class='text-success'>Completada!</label>";
                       ?>
                       <div class="progress">
                        <div class="progress-bar <?=$estilobar?>" style="width:<?=$bar?>"><?=$bar?></div>
                       </div>
                       <hr>
                       <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                         <a href="cvista_solA?ac=<?=$actividad->act_id?>&id=<?=$proy->id_proyecto?>&sol=<?=$soli->id_sol?>" class="btn btn-secondary">Solicitud <small>de <?=$soli->total?> BS.</small></a>
                          <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                            </button>
                           <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="storage/solfa/<?=$soli->id_sol?>-SOL/solfa.pdf" download="solFA - actividad <?=$actividad->sub_nom?>.pdf">
                             <img class='icon-sm' src='apps/full-icon/flat/documentos/pdf-5.png' alt='Sin imagen'> <small>Descargar en PDF</small></a>
                             <a class="dropdown-item" href="#" onclick="verPdf('visor-pdf','storage/solfa/<?=$soli->id_sol?>-SOL/solfa.pdf#zoom=90%')">
                             <img class='icon-sm' src='apps/full-icon/flat/documentos/email-1.png' alt='Sin imagen'> <small>Ver en SysTierra</small></a>
                             </div>
                           </div>
                        </div>
                        
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                         <a href="cvistaDes?ac=<?=$actividad->act_id?>&id=<?=$proy->id_proyecto?>" class="btn btn-secondary">Descargo <small>de <?=$des->total?> BS.</small></a>
                          <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                            </button>
                           <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="storage/descar/<?=$actividad->act_id?>-des/des.pdf" download="DF - actividad <?=$actividad->act_id?>.pdf">
                             <img class='icon-sm' src='apps/full-icon/flat/documentos/pdf-5.png' alt='Sin imagen'> <small>Descargar en PDF</small></a>
                             <a class="dropdown-item" href="#" onclick="verPdf('visor-pdf','storage/descar/<?=$actividad->act_id?>-des/des.pdf#zoom=90%')">
                             <img class='icon-sm' src='apps/full-icon/flat/documentos/email-1.png' alt='Sin imagen'> <small>Ver en SysTierra</small></a>
                             </div>
                           </div>
                        </div>
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                         <a href="cvista_infTec?id=<?=$proy->id_proyecto?>&ac=<?=$actividad->act_id?>" class="btn btn-secondary">Informe Tecnico</a>
                        </div>
                        <?php 
                         if($des->saldo<0){
                          ?>
                          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                         <a href="cvistaRem?ac=<?=$actividad->act_id?>&id=<?=$proy->id_proyecto?>" class="btn btn-secondary btn-simple">Reembolso <small>de <?=abs($des->saldo)?> BS.</small></a>
                          <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                            </button>
                           <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="storage/rem/<?=$actividad->act_id?>-rem/rem.pdf" download="Reem - actividad <?=$actividad->sub_nom?>.pdf">
                             <img class='icon-sm' src='apps/full-icon/flat/documentos/pdf-5.png' alt='Sin imagen'> <small>Descargar en PDF</small></a>
                             <a class="dropdown-item" href="#" onclick="verPdf('visor-pdf','storage/rem/<?=$actividad->act_id?>-rem/rem.pdf#zoom=90%')">
                             <img class='icon-sm' src='apps/full-icon/flat/documentos/email-1.png' alt='Sin imagen'> <small>Ver en SysTierra</small></a>
                             </div>
                           </div>
                        </div> 
                          <?php
                         }
                      break;
                  }?></p>
                  
                 <!-- <div class="progress">
                    <div class="progress-bar bg-danger" style="width:40%">
                      Solicitud de fondos
                    </div>
                    <div class="progress-bar bg-warning" style="width:15%">
                      Informe t&eacute;cnico
                    </div>
                    <div class="progress-bar bg-success" style="width:20%">
                      Descargo / reembolso
                    </div>
                  </div>-->
                  <hr>
                  <div id="visor-pdf" style="display:none">
                   <iframe id="pdframe" src="storage/solfa/<?=$soli->id_sol?>-SOL/solfa.pdf#zoom=90%" width="100%" height="600px">
                      <p>Su equipo no cuenta con Adobe Reader<a href="storage/solfa/<?=$soli->id_sol?>-SOL/solfa.pdf">
                          <?php 
                            $tamanopdf=filesize('storage/solfa/<?=$soli->id_sol?>-SOL/solfa.pdf');
                            $b='Kb';
                                 $tam=round($tamanopdf/1024);
                            if($tamanopdf/1024>=1024){
                                $tam=round($tamanopdf/1048576,2);
                              $b='Mb';
                                  }
                           ?> click para descargar (<?=$tam?> <?=$b?>)</a></p>
                       </iframe>
                  </div>                  
                  <div class="float-right">
                    <a href="javascript:history.back(-1);" class="btn btn-danger">Ok</a>
                  </div>                      
              </div>
            </div>
          </div>
        </div>
      </div>

      
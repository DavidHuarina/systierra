
<div class="panel-header-sm bg-amarillo">
</div>
 <div class="content"><!--principio de Panel-->
          <div class="row">
               <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Descargos <small class="text-amarillo"><?=$ndes->num?></small></h5>
                </div>
               </div> 
           </div>      
           <div class="row">
              <div class="card">
                <div class="card-body">                  
                  <div class="table-responsive-sm">
                    <table id="table-actividad" class="table">
                           <thead>
                           <tr class="bg-amarillo text-small">
                             <th>
                               <b class="text-amarillo"><small>Img</small></b>
                            </th>
                             <th>
                                <b class="text-white"><small>Banco</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Cheque N°</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Emisor</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Solicitado Bs</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Gasto Bs</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Descargo</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Estado</small></b>
                             </th>
                           </tr>
                           </thead>
                            <tbody>
                    <?php
                    foreach ($descargo->result() as $descar) {
                      $actividad=$this->actividad->getById($descar->act_id);
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
                      <tr class="text-small">
                        <td><?php if($descar->saldo<0){
                            ?><img class="img-sm rounded-circle mb-4 mb-md-0" src="apps/full-icon/flat/negocio/piggy-bank-1.png" alt="img"><?php
                         }else{
                          ?><img class="img-sm rounded-circle mb-4 mb-md-0" src="apps/full-icon/flat/negocio/notes-2.png" alt="img"><?php
                         }
                           ?>
                          </td>
                         <td><?=$descar->banco?></td>
                         <td><?=$descar->n_cheque?></td>
                         <td><?=$descar->nombre_persona?> <?=$descar->apellido_persona?></td>
                         <td><label class="text-lg text-primary"><b><?=number_format($descar->total, 2, '.', ',');?></b></label></td>
                         <td><?php if($descar->tgasto==0){
                            ?><label class="text-lg text-danger"><b><?=number_format($descar->tgasto, 2, '.', ',');?></b></label><?php
                         }else{
                          ?><label class="text-lg text-danger"><b><?=number_format($descar->tgasto, 2, '.', ',');?></b></label><?php
                         }
                        ?></td>
                        <td><?php
                            if($descar->saldo<0){
                              $estilo="btn-warning";
                            ?><label class="text-lg text-warning">&nbsp;Reembolso <b><?=number_format(abs($descar->saldo), 2, '.', ',');?></b> <small>Bs</small></label><?php  
                            }else{
                            ?><label class="text-lg text-success">&nbsp;Total Depositado <b><?=number_format($descar->saldo, 2, '.', ',');?></b> <small>Bs</small></label><?php
                            }
                              ?>
                        </td>
                         <td>
                          <div class="btn-group dropdown">
                          <button type="button" class="btn btn-round <?=$estilo?> dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <?=$estado?>
                          </button>
                          <div class="dropdown-menu">
                              <a class="dropdown-item " href="storage/descar/<?=$descar->act_id?>-des/des.pdf" download="DF - actividad <?=$descar->act_id?>.pdf">
                              <img class='icon-sm' src='apps/full-icon/flat/documentos/pdf-5.png' alt='Sin imagen'> <label class="text-small">Descargar en PDF</label></a>
                              <!--<a class="dropdown-item" href="#">
                              <img class='icon-sm' src='apps/full-icon/flat/docs/001-word.png' alt='Sin imagen'> <label class="text-small">Descargar en Word</label></a>-->
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="cvistaDes?ac=<?=$descar->act_id?>&id=<?=$actividad->id_proyecto?>">
                              <img class='icon-sm' src='apps/full-icon/flat/equipo/contract.png' alt='Sin imagen'> <label class="text-small">Ver a Detalle</label></a>
                              <?php 
                              if($descar->saldo<0){
                                ?>
                                <hr class="hr">
                                <a class="dropdown-item " href="storage/rem/<?=$descar->act_id?>-rem/rem.pdf" download="REM - actividad <?=$descar->act_id?>.pdf">
                              <img class='icon-sm' src='apps/full-icon/flat/documentos/pdf-5.png' alt='Sin imagen'> <label class="text-small">Reembolso en PDF</label></a>
                              <div class="dropdown-divider"></div>
                               <a class="dropdown-item" href="cvistaRem?ac=<?=$actividad->act_id?>&id=<?=$actividad->id_proyecto?>">
                              <img class='icon-sm' src='apps/full-icon/flat/negocio/piggy-bank-1.png' alt='Sin imagen'> <label class="text-small">Ver Reembolso</label></a>
                                <?php
                              }
                              ?>
                              
                              
                                
                          </div>
                        </div>
                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                    </tbody>
                   </table>  
                  </div>
                </div>
              </div>        
        </div><!-- fin panel-->
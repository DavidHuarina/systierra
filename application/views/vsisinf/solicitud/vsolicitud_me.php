<div class="panel-header-sm bg-naranja">
</div>
 <div class="content"><!--principio de Panel-->
          <div class="row">
               <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Solicitudes <small class="text-naranja"><?=$nsol->num?></small></h5>
                </div>
               </div> 
           </div>      
           <div class="row">
              <div class="card">
                <div class="card-body">                  
                  <div class="table-responsive-sm">
                    <table id="table-actividad" class="table">
                           <thead>
                           <tr class="bg-naranja text-small">
                             <th>
                               <b class="text-naranja"><small>Img</small></b>
                            </th>
                             <th>
                                <b class="text-white"><small>Actividad</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Solicitante</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Fecha de actividad</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Fecha de solicitud</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Monto (Bs)</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Estado</small></b>
                             </th>
                           </tr>
                           </thead>
                            <tbody>
                    <?php
                    foreach ($solicitud->result() as $sol) {
                      $act=$this->actividad->getById($sol->act_id);
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
                      <tr class="text-small">
                        <td><img class="img-sm rounded-circle mb-4 mb-md-0" src="apps/full-icon/flat/negocio/change.png" alt="img"></td>
                         <td><?php $porciones = explode("@", $sol->sub_nom);?> <?=$porciones[0]?></td>
                         <td><?=$sol->nombre_persona?> <?=$sol->apellido_persona?></td>
                         <td><?=strftime('%d de %B de %Y',strtotime($act->act_fecha))?></td>
                         <td><?=strftime('%d de %B de %Y',strtotime($sol->fecha_s))?></td>
                         <td class="text-center"><b><?=number_format($sol->total, 2, '.', ',');?></b></td>
                         <td class="">
                          <div class="btn-group dropdown">
                          <button type="button" class="btn <?=$estilo?> btn-round dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <span class="spinner-grow spinner-grow-sm"></span> <?=$estado?>
                          </button>
                          <div class="dropdown-menu">
                            <?php if((($sol->estado_s==1||$sol->estado_s==2||$sol->estado_s==3)&&($idrol==3000))||$global_usuario=="ADMIN-01"){
                                    if($sol->estado_s==2){
                                       echo "";
                                     }else{
                                      if($sol->estado_s==3){

                                      }else{
                                        echo "<a class='dropdown-item' href='csolicitudes/aprobar?q=".$sol->id_sol."&z=".$sol->act_id."'>
                                       <img class='icon-sm' src='apps/full-icon/flat/negocio/stamp-1.png' alt='Sin imagen'> <label class='text-small'>Aprobar solicitud</label></a>";
                                       echo "<a class='dropdown-item' href='csolicitudes/denegar?q=".$sol->id_sol."&z=".$sol->act_id."'>
                                       <img class='icon-sm' src='apps/full-icon/flat/iconos-sys/garbage-1.png' alt='Sin imagen'> <label class='text-small'>Rechazar solicitud</label></a>";
                                      }
                                        
                                     }
                                    
                                   }
                                   
                              ?>
                              <a class="dropdown-item " href="storage/solfa/<?=$sol->id_sol?>-SOL/solfa.pdf" download="solFA - actividad <?=$act->sub_nom?>.pdf">
                              <img class='icon-sm' src='apps/full-icon/flat/documentos/pdf-5.png' alt='Sin imagen'> <label class='text-small'>Descargar en PDF</label></a>
                              <!--<a class="dropdown-item" href="#">
                              <img class='icon-sm' src='apps/full-icon/flat/docs/001-word.png' alt='Sin imagen'> <label class='text-small'>Descargar en Word</label></a>-->
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="cvista_solA?ac=<?=$act->act_id?>&id=<?=$act->id_proyecto?>&sol=<?=$sol->id_sol?>">
                              <img class='icon-sm' src='apps/full-icon/flat/equipo/contract.png' alt='Sin imagen'> <label class='text-small'>Ver a Detalle</label></a>
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
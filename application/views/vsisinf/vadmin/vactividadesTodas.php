<div class="panel-header-sm bg-info">
</div>
 <div class="content"><!--principio de Panel-->
          <div class="row">
               <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Todas las Actividades <small class="text-info"><?=$nact->num?></small>
                  </h5>
                </div>
               </div> 
           </div>      
           <div class="row">
              <div class="card">
                <div class="card-body">                  
                  <div class="table-responsive-sm">
                    <table id="table-actividad" class="table">
                           <thead>
                           <tr class="bg-info text-small">
                             <th>
                               <b class="text-info"><small>Img</small></b>
                            </th>
                             <th>
                                <b><small class="text-white">Actividad</small></b>
                             </th>
                             <th>
                                <b><small class="text-white">Creador</small></b>
                             </th>
                             <th>
                                <b><small class="text-white">Proyecto</small></b>
                             </th>
                             <th>
                                <b><small class="text-white">Fecha</small></b>
                             </th>
                             <th>
                                <b><small class="text-white">Duración (días)</small></b>
                             </th>
                             <th>
                                <b><small class="text-white">Estado</small></b>
                             </th>
                             <th>
                                <b class="text-info"><small>Op</small></b>
                             </th>
                           </tr>
                           </thead>
                            <tbody>
                    <?php
                    foreach ($actividad->result() as $act) {
                      $personn=$this->personal->getAllIdUsuario($act->act_resp);
                      $nsub=$this->actividad->getNActSub($act->act_id);
                      switch ($act->id_estado) {
                        case 1:
                          $estilotext="text-muted";
                          $estadotext="Incompleta";
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
                      <tr class="text-small">
                        <td><img class="img-sm rounded-circle" src="<?=$personn->dir_imagen?>" alt="image" />
                         <td><?php $porciones = explode("@", $act->sub_nom);?> <?=$porciones[0]?></td>
                         <td><?=$personn->nombre_persona?> <?=$personn->apellido_persona?></td>
                         <td><?=$act->nombre_proyecto?></td>
                         <td><?=strftime('%d de %B de %Y',strtotime($act->act_fecha))?></td>
                         <td class="text-center"><?php if($act->act_dias==1){ echo $act->act_dias;}else{ echo $act->act_dias;}?></td>
                         <td class="">
                          <div class="btn-group dropdown">
                          <button type="button" class="btn <?=$estilo?> btn-round dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <span class="spinner-grow spinner-grow-sm"></span> <?=$estadotext?>
                          </button>
                          <div class="dropdown-menu">
                            <?php 
                               //$ncol_act=$this->col_act->getByIdActN($act->act_id);
                               $nparti=$this->parti->getByIdActN($act->act_id);

                              

                                    if($act->id_estado==4||$act->id_estado==3){
                                      echo "<a class='dropdown-item' href='cnequipo?ac=".$act->act_id."'>
                                       <img class='icon-sm' src='apps/full-icon/flat/equipo/team-2.png' alt='Sin imagen'> <label class='text-small'>Equipo de trabajo</label></a>";
                                      if($nparti->num==0){
                                        ?>
                                        <a class="dropdown-item" href="cnuevo_informe?id=<?=$act->id_proyecto?>&ac=<?=$act->act_id?>">
                                          <img class='icon-sm' src='apps/full-icon/flat/contacto/inbox-3.png' alt='Sin imagen'> <label class='text-small'>Complementar datos</label></a>
                                       <?php
                                      }else{
                                        ?>
                                        <a class="dropdown-item" href="cvista_infTec?id=<?=$act->id_proyecto?>&ac=<?=$act->act_id?>">
                                          <img class='icon-sm' src='apps/full-icon/flat/contacto/inbox-1.png' alt='Sin imagen'> <label class='text-small'>Informe Técnico</label></a>
                                          <a class="dropdown-item" href="cedit_informe?id=<?=$act->id_proyecto?>&ac=<?=$act->act_id?>">
                                          <img class='icon-sm' src='apps/full-icon/flat/iconos-sys/settings-4.png' alt='Sin imagen'> <label class='text-small'>Editar INF-TEC</label></a>
                                       <?php   
                                      }
                                       $soli=$this->sol_act->getByIdA($act->act_id);
                                         ?> 
                                          <div class="dropdown-divider"></div>
                                          <?php
                                         if($act->id_estado==4){                                          
                                          echo "<a class='dropdown-item' href='cnuevo_descargo?id=".$act->id_proyecto."&ac=".$act->act_id."'>
                                           <img class='icon-sm' src='apps/full-icon/flat/negocio/point-of-service.png' alt='Sin imagen'> <label class='text-small'>Descargo Fondo</label></a>";
                                          echo "<a class='dropdown-item' href='clista_actividad_me/eliminarSol/".$act->act_id."'>
                                           <img class='icon-sm' src='apps/full-icon/flat/iconos-sys/forbidden.png' alt='Sin imagen'> <label class='text-small'>Eliminar Solicitud</label></a>"; 
                                           echo "<a class='dropdown-item' href='clista_actividad_me_sub?a=".$act->act_id."'>
                                           <img class='icon-sm' src='apps/full-icon/flat/iconos-sys/layers.png' alt='Sin imagen'> <label class='text-small'>Sub Actividad ".$nsub->num."</label></a>";
                                         }
                                     }else{
                                       echo "<a class='dropdown-item' href='cnequipo?ac=".$act->act_id."'>
                                       <img class='icon-sm' src='apps/full-icon/flat/equipo/team-2.png' alt='Sin imagen'> <label class='text-small'>Equipo de trabajo</label></a>";
                                       if($nparti->num==0){
                                        ?>
                                        <a class="dropdown-item" href="cnuevo_informe?id=<?=$act->id_proyecto?>&ac=<?=$act->act_id?>">
                                          <img class='icon-sm' src='apps/full-icon/flat/contacto/inbox-3.png' alt='Sin imagen'> <label class='text-small'>Complementar datos</label></a>
                                          <?php if($act->id_estado==5){
                                             ?><a class="dropdown-item " href="storage/descar/<?=$act->act_id?>-des/des.pdf" download="Descargo - actividad <?=$act->act_id?>.pdf">
                                             <img class='icon-sm' src='apps/full-icon/flat/documentos/pdf-5.png' alt='Sin imagen'> <small>Descargar en PDF</small></a><?php
                                           }else{
                                            echo "<a class='dropdown-item' href='cnuevo_descargo?id=".$act->id_proyecto."&ac=".$act->act_id."'>
                                           <img class='icon-sm' src='apps/full-icon/flat/negocio/point-of-service.png' alt='Sin imagen'> <label class='text-small'>Descargo Fondo</label></a>";
                                           }
                                      }else{
                                        ?>
                                        <a class="dropdown-item" href="cvista_infTec?id=<?=$act->id_proyecto?>&ac=<?=$act->act_id?>">
                                          <img class='icon-sm' src='apps/full-icon/flat/contacto/inbox-1.png' alt='Sin imagen'> <label class='text-small'>Informe Técnico</label></a>
                                          <!--<a class="dropdown-item" href="cedit_informe?id=<?=$act->id_proyecto?>&ac=<?=$act->act_id?>">
                                          <img class='icon-sm' src='apps/full-icon/flat/iconos-sys/settings-4.png' alt='Sin imagen'> <label class='text-small'>Editar INF-TEC</label></a>-->
                                          <?php 
                                           if($act->id_estado==5){
                                            ?><a class="dropdown-item " href="storage/descar/<?=$act->act_id?>-des/des.pdf" download="Descargo - actividad <?=$act->act_id?>.pdf">
                                             <img class='icon-sm' src='apps/full-icon/flat/documentos/pdf-5.png' alt='Sin imagen'> <small>Descargar en PDF</small></a><?php
                                           }else{
                                            echo "<a class='dropdown-item' href='cnuevo_descargo?id=".$act->id_proyecto."&ac=".$act->act_id."'>
                                           <img class='icon-sm' src='apps/full-icon/flat/negocio/point-of-service.png' alt='Sin imagen'> <label class='text-small'>Descargo Fondo</label></a>";
                                           }                         
                                         
                                      }
                                
                                     }
                                    
                                  if($act->id_estado==5){
                                    echo "<a class='dropdown-item' href='clista_actividad_me/eliminarDes/".$act->act_id."'>
                                           <img class='icon-sm' src='apps/full-icon/flat/iconos-sys/forbidden.png' alt='Sin imagen'> <label class='text-small'>Eliminar Descargo</label></a>"; 
                                    echo "<a class='dropdown-item' href='clista_actividad_me_sub?a=".$act->act_id."'>
                                           <img class='icon-sm' src='apps/full-icon/flat/iconos-sys/layers.png' alt='Sin imagen'> <label class='text-small'>Sub Actividad ".$nsub->num."</label></a>";
                              ?>
                                   
                                  <?php
                                   }

                            ?>
                            <a class="dropdown-item" href="cdetalle_actividad?id=<?=$act->id_proyecto?>&ac=<?=$act->act_id?>">
                              <img class='icon-sm' src='apps/full-icon/flat/documentos/text-2.png' alt='Sin imagen'> <label class='text-small'>Ver Detalles</label></a>
                             <!--<a class='dropdown-item' href='clista_actividad_me_sub?a=<?=$act->act_id?>'>
                                           <img class='icon-sm' src='apps/full-icon/flat/iconos-sys/layers.png' alt='Sin imagen'> <label class='text-small'>Sub Actividad <?=$nsub->num?></label></a>-->
                          </div>
                        </div>
                        </td>
                        <?php if($act->id_estado==1||$act->id_estado==2){
                          ?><td><!--<a class="nav-link" href="#"><i class="fa fa-pencil text-success"></i></a>-->
                                 <a class="nav-link tooltip-bg" href="cnueva_actividad/delete/<?=$act->act_id?>" data-toggle="tooltip" data-animated="fade" data-placement="left" data-html="true" 
                        title="<table>
                                 <tr>
                                   <td><img class='icon-lg' src='apps/full-icon/flat/oficina/trash.png' alt='Sin imagen'></td>
                                   <td><label class='text-white'><b>Eliminar Actividad</b><br>
                                        Se eliminara tambien la solicitud de fondos.
                                      </label>
                                   </td>
                                 </tr>  
                               </table>"><i class="fa fa-remove text-danger"></i></a>
                            </td><?php
                            }else{
                              ?><td></td><?php
                            }?>
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
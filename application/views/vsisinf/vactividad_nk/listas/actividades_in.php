<div class="panel-header-sm bg-celeste">
</div>
 <div class="content"><!--principio de Panel-->
          <div class="row">
               <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Actividades <small class="text-celeste"><?=$nact?></small></h5>
                </div>
               </div> 
           </div>      
           <div class="row">
              <div class="card">
                <div class="card-body">                  
                  <div class="table-responsive-sm">
                    <table id="table-actividad" class="table">
                           <thead>
                           <tr class="bg-celeste text-small">
                             <th>
                               <b class="text-celeste"><small>Img<small></b>
                            </th>
                             <th>
                                <b class="text-white"><small>Actividad<small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Proyecto<small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Fecha<small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Duración (días)<small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Estado<small></b>
                             </th>
                           </tr>
                           </thead>
                            <tbody>
                    <?php
                    foreach ($actividad->result() as $act) {
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
                      $idper=$this->personal->getByIdUsuario($this->session->userdata('id_usuario_sesion'));
                           $equipotrab=$this->col_act->Existe($idper->id_persona,$act->act_id);
                           if($equipotrab->num!=0){
                      ?>
                      <tr class="text-small">
                        <td><img class="img-sm rounded-circle mb-4 mb-md-0" src="imagenes/proyecto/AA.jpg" alt="img"></td>
                         <td><?php $porciones = explode("@", $act->sub_nom);?> <?=$porciones[0]?></td>
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
                                          <?php echo "<a class='dropdown-item' href='cnuevo_descargo?id=".$act->id_proyecto."&ac=".$act->act_id."'>
                                           <img class='icon-sm' src='apps/full-icon/flat/negocio/point-of-service.png' alt='Sin imagen'> <label class='text-small'>Descargo Fondo</label></a>";
                                         
                                      }
                                       $soli=$this->sol_act->getByIdA($act->act_id);
                                         ?> 
                                          <div class="dropdown-divider"></div>
                                          <?php
                                         if($act->id_estado==4){                                          
                                          echo "<a class='dropdown-item' href='cnuevo_descargo?id=".$act->id_proyecto."&ac=".$act->act_id."'>
                                           <img class='icon-sm' src='apps/full-icon/flat/negocio/point-of-service.png' alt='Sin imagen'> <label class='text-small'>Descargo Fondo</label></a>";
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
                              ?>
                              
                                  <?php
                                   }

                            ?>
                            <a class="dropdown-item" href="cdetalle_actividad?id=<?=$act->id_proyecto?>&ac=<?=$act->act_id?>">
                              <img class='icon-sm' src='apps/full-icon/flat/documentos/text-2.png' alt='Sin imagen'> <label class='text-small'>Ver Detalles</label></a>
                          </div>
                        </div>
                        </td>
                      </tr>
                      <?php
                     }
                    }
                    ?>
                    </tbody>
                   </table>  
                  </div>
                </div>
              </div>        
        </div><!-- fin panel-->
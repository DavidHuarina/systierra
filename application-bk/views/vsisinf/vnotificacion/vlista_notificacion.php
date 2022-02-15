   <div class="panel-header panel-header-sm">
   </div>
       <div class="content"><!--principio de Panel-->
         <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Notificaciones <small class="text-primary"><?=$nnot->num?></small><a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a></h4>
                  
                </div>
                <div class="card-body">
                  <?php
                   $dia=null;
                   $hoy=strftime('%d de %B de %Y',time());
                   $ayer=strftime('%d de %B de %Y',strtotime('yesterday'));
                   if($nnot->num==0){
                    ?>
                    <center><small class="text-gray">No tienes conversaciones</small></center>
                    <?php
                   }else{
                  foreach ($listaN->result() as $listaN) {
                    switch ($listaN->id_tipo_notificacion) {
                      case 6:
                        $noti_imagen="apps/full-icon/flat/equipo/reunion.png";
                        $href="#";
                        break;
                      case 5:
                        $noti_imagen="apps/full-icon/flat/oficina/id-card.png";
                        $href="clista_actividad_in";
                        break;
                        case 2:
                        $noti_imagen="apps/full-icon/flat/negocio/change.png";
                        $href="csolicitudes";
                        break;
                      default:
                        $noti_imagen="apps/full-icon/flat/oficina/advertencia.png";
                        $href="#";
                        break;
                    }
                    if($listaN->leido_notificacion==0){
                     $tit="text-primary text-neg";
                     $ref_estilo="text-dark text-neg";
                  }else{
                    $tit="text-muted";
                    $ref_estilo="text-dark";
                  }
                   $dia=strftime('%d de %B de %Y',strtotime($listaN->creado_en));
                  ?>
                  <a class="link-boton" onclick="leidoNot(<?=$listaN->id_notificacion?>);" href="<?=$href?>">
                  <div class="fluid-container">
                    <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-md-1">
                        <img class="rounded-circle mb-4 mb-md-0" width="50" height="50" src="<?=$noti_imagen?>" alt="Sin imagen">
                      </div>
                      <div class="ticket-details col-md-9">
                        <div class="d-flex">
                          <p class="font-weight-semibold mr-2 mb-0 no-wrap <?=$tit?>"><?=$listaN->titulo?> </p>
                        </div>
                        <?php 
                        $porciones = explode("%", $listaN->referencia);
                        $acti=explode("@", $porciones[1]);
                        ?>
                        <p class="ellipsis mb-2 <?=$ref_estilo?>"><?=$listaN->nombre_persona?>, <?=$porciones[0]?> 
                        </p>
                        <?php 
                        if($listaN->id_tipo_notificacion==6){            
                          ?><label class="text-dark">para la actividad:</label> <?=$acti[0]?> 
                          <!--<button class="btn btn-danger btn-sm float-right">Negar</button>-->
                          <?php 
                            if($listaN->leido_notificacion==0){
                              ?>
                               <button onclick="leidoNot(<?=$listaN->id_notificacion?>);nequipo(<?=$listaN->id_persona?>,<?=$porciones[2]?>);" class="btn btn-secondary btn-sm float-right">Agregar al equipo</button>
                              <?php
                            }else{
                              ?>
                               <button onclick="window.location.href='cnequipo?ac='+<?=$porciones[2]?>" class="btn btn-success btn-sm float-right">Ha sido agregado</button>
                              <?php
                            }
                          ?>
                          
                          <?php
                        }else{
                          if($listaN->id_tipo_notificacion==5||$listaN->id_tipo_notificacion==2){
                            ?><label class="text-dark">Nombre de la actividad:</label> <?=$acti[0]?> 
                          <?php 
                          }
                        }
                        ?> 
                        <div id="mensaje"></div>
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-12 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted"></small>
                        <?php
                            if($dia==$hoy){
                        ?>
                      <small class="Last-responded mr-2 mb-0 text-muted text-muted">Hoy <?=strftime('%H:%M ',strtotime($listaN->creado_en))?></small>
                      <?php
                      }else{
                        if($dia==$ayer){
                          ?>
                          <small class="Last-responded mr-2 mb-0 text-muted text-muted">Ayer <?=strftime('%H:%M ',strtotime($listaN->creado_en))?></small>
                         <?php
                        }else{
                         ?>
                          <small class="Last-responded mr-2 mb-0 text-muted text-muted"><?=$dia." ".strftime('%H:%M ',strtotime($listaN->creado_en))?></small>
                         <?php 
                        }                      
                      }
                      ?>
          
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </a>
                  <?php
                   }}
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div><!-- fin panel-->


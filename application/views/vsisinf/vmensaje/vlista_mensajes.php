   <div class="panel-header panel-header-sm">
   </div>
       <div class="content"><!--principio de Panel-->
         <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Conversaciones <small class="text-primary"><?=$nfilasl?></small><a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a></h4>
                  
                </div>
                <div class="card-body">
                  <?php
                   $dia=null;
                   $hoy=strftime('%d de %B de %Y',time());
                   $ayer=strftime('%d de %B de %Y',strtotime('yesterday'));
                   if($nfilasl==0){
                    ?>
                    <center><small class="text-gray">No tienes conversaciones</small></center>
                    <?php
                   }else{
                  for ($j=0; $j < $nfilasl; $j++) {

                   $dia=strftime('%d de %B de %Y',strtotime($listaC[$j]['time']));
                  ?>
                  <a class="link-boton" href="cchat_mensajes?user=<?=$listaC[$j]['persona']->id_usuario?>&conv=<?=$listaC[$j]['conv']?>">
                  <div class="fluid-container">
                    <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-md-1">
                        <img class="rounded-circle mb-4 mb-md-0" width="52" height="50" src="<?=$listaC[$j]['persona']->dir_imagen?>" alt="Sin imagen">
                      </div>
                      <div class="ticket-details col-md-9">
                        <div class="d-flex">
                          <p class="font-weight-semibold mr-2 mb-0 no-wrap"><?=$listaC[$j]['titulo']?> 
                            <small><label class="now-ui-icons arrows-1_cloud-upload-94 text-dark"></label> <?=$listaC[$j]['nmensa']->numero-$listaC[$j]['nmensr']->numero?></small> 
                            <small><label class="now-ui-icons arrows-1_cloud-download-93 text-dark"></label> <?=$listaC[$j]['nmensr']->numero?></small>
                            <small><label class="text-dark">Todos</label> <?=$listaC[$j]['nmensa']->numero?></small></p>
                        </div>
                        <p class="text-dark ellipsis mb-2"><?=$listaC[$j]['tu']?> <?=$listaC[$j]['sms']->contenido?> 
                            <?php

                            if($listaC[$j]['nmen']->numero!=0){
                              ?><span class="badge badge-secondary"><?=$listaC[$j]['nmen']->numero?></span><?php
                            }
                            ?> 
                        </p>
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-12 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted"></small>
                        <?php
                            if($dia==$hoy){
                        ?>
                      <small class="Last-responded mr-2 mb-0 text-muted text-muted">Hoy <?=strftime('%H:%M ',strtotime($listaC[$j]['time']))?></small>
                      <?php
                      }else{
                        if($dia==$ayer){
                          ?>
                          <small class="Last-responded mr-2 mb-0 text-muted text-muted">Ayer <?=strftime('%H:%M ',strtotime($listaC[$j]['time']))?></small>
                         <?php
                        }else{
                         ?>
                          <small class="Last-responded mr-2 mb-0 text-muted text-muted"><?=$dia." ".strftime('%H:%M ',strtotime($listaC[$j]['time']))?></small>
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


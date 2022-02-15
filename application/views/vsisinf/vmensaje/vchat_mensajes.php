   <div class="panel-header panel-header-sm">
   </div>
       <div class="content"><!--principio de Panel-->
        <div class="row">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">
                    <div class="col-md-12">
                        <img class="rounded-circle mb-0 mb-md-0" width="52" height="50" src="<?=$datostitulo->dir_imagen?>" alt="Sin imagen">
                        <?=$datostitulo->nombre_persona?> <?=$datostitulo->apellido_persona?>
                        <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a>
                    </div>
                  </h4>
                </div>
                <div class="card-body">
                  <div id="chat-div" class="container-chat">
                   <?php
                   setlocale(LC_TIME, 'Spanish');
                   $dia=null;
                   $hoy=strftime('%d de %B de %Y',time());
                   $ayer=strftime('%d de %B de %Y',strtotime('yesterday'));
                   foreach ($mensajes->result() as $men) {
                    
                    if($dia==strftime('%d de %B de %Y',strtotime($men->creado_en))){
                       
                    }else{
                      $dia=strftime('%d de %B de %Y',strtotime($men->creado_en));
                      if($dia==$hoy){
                        ?>
                      <div class="date-chat"><p class="sms-me text-dark text-small"><?=strtoupper('hoy')?></p></div>
                      <?php
                      }else{
                        if($dia==$ayer){
                          ?>
                          <div class="date-chat"><p class="sms-me text-dark text-small"><?=strtoupper('ayer')?></p></div>
                         <?php
                        }else{
                         ?>
                          <div class="date-chat"><p class="sms-me text-dark text-small"><?=strtoupper($dia)?></p></div>
                         <?php 
                        }                      
                      }
                    }
                    
                    if($men->id_usuario==$this->session->userdata('id_usuario_sesion')){
                     ?>
                     <div class="pull-right">
                       <div class="bg-primary sms">
                         <p class="mb-0 text-white sms-you"><?=$men->contenido?></p>
                       </div>
                       <small class="text-muted hora-sms pull-right"><?=strftime('%H:%M ',strtotime($men->creado_en))?></small>
                     </div>
                   <br><br><br>
                     <?php
                    }else{
                      ?>
                     <div class="pull-left"> 
                       <div class=" bg-secondary sms">
                         <p class="mb-0 text-white sms-you"><?=$men->contenido?></p>
                        </div>
                        <small class="text-muted hora-sms"><?=strftime('%H:%M ',strtotime($men->creado_en))?></small>
                      </div>   
                      <br><br><br>
                    <?php
                    }
                   }
                   ?>
                 </div>
                 <script>
                 var objDiv=document.getElementById('chat-div');
                 objDiv.scrollTop=objDiv.scrollHeight;
                 </script>
                 <br>
                   <form autocomplete="off" action="cnuevo_mensaje/enviar_chat?iduser=<?=$datostitulo->id_usuario?>" method="post">
                        <div class="form-group">
                          <div class="input-group">
                              <input id="btn-input" name="sms_enviar" type="text" autofocus class="form-control" placeholder="Escribir mensaje" />
                             <div class="input-group-append">
                                 <button class="input-group-text" style="cursor:pointer;"><i class="now-ui-icons ui-1_send text-success"></i></button>
                              </div> 
                         </div>                     
                      </div>
                  </form>              
                </div>
              </div>
            
          </div> 
        </div><!-- fin panel-->
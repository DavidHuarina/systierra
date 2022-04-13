   <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg fixed-top navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#inicio"><?=$title_nav?></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form action="cbuscar_personas" autocomplete="off" method="post">
               <?php
                        $i=0;
                        echo "<script>var personasall=[],imagenes_perfilall=[];</script>";
                        foreach ($personasall->result() as $per) {
                          echo "<script>personasall[".$i."]='".$per->nombre_persona." ".$per->apellido_persona."';</script>";
                          echo "<script>imagenes_perfilall[".$i."]='".$per->dir_imagen."';</script>";
                         
                         ?>
                        <?php
                         $i=$i+1;
                        }
                        ?>
              <div class="input-group no-border">
                <input type="text" id="buscarPersona" name="buscarPersona" value="" class="form-control" placeholder="Buscar personas..">
                <div class="input-group-append">
                    <button class="input-group-text" type="submit" style="cursor:pointer;"><i class="now-ui-icons ui-1_zoom-bold"></i></button>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <!--<li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="now-ui-icons location_map-big"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Actividades</span>
                  </p>
                </a>
              </li>-->
              
          <?php
                  setlocale(LC_TIME, 'Spanish');
                   $dia=null;
                   $hoy=strftime('%d de %B de %Y',time());
                   $ayer=strftime('%d de %B de %Y',strtotime('yesterday'));
          ?>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="now-ui-icons ui-1_email-85"></i>
              <?php if($nmens!=0||$nmens!=null){ 
                        if((int)$nmens>99){
                          ?><span class="count">+99</span><?php
                        }else{
                          ?><span class="count"><label id="nmensaje"><?=$nmens?></label></span><?php 
                        } 
                      } 
                ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <div class="mb-0 font-weight-normal float-left"><?php if($nmens==0){echo "No tienes mensajes sin leer";}else{ if($nmens==1){echo "Tienes ".$nmens." mensaje sin leer";}else{echo "Tienes ".$nmens." mensajes sin leer";}}?>
                <a href="clista_mensajes"><span class="badge badge-warning badge-pill">Ver todo</span></a>
              </div>
              </div>
               <?php
                 if($nfilasl!=0){
                    if($nfilasl>3){
                     $nfilasl=3;
                   }
                  for ($j=0; $j < $nfilasl; $j++) {

                   $dia=strftime('%d de %B de %Y',strtotime($listaC[$j]['time']));
                  ?>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="cchat_mensajes?user=<?=$listaC[$j]['persona']->id_usuario?>&conv=<?=$listaC[$j]['conv']?>">
                
                <img class="imgRedonda float-left" src="<?=$listaC[$j]['persona']->dir_imagen?>" width="30" height="30" alt="...">
                <div class="preview-item-content flex-grow">

                    <?php
                      if($dia==$hoy){
                        ?>
                      <span class="float-right category">Hoy <?=strftime('%H:%M ',strtotime($listaC[$j]['time']))?></span>
                      <?php
                      }else{
                        if($dia==$ayer){
                          
                          ?>
                          <span class="float-right category">Ayer <?=strftime('%H:%M ',strtotime($listaC[$j]['time']))?></span>
                         <?php
                        }else{
                         ?>
                          <span class="float-right category"><?=strftime('%b,%d',strtotime($listaC[$j]['time']))." ".strftime('%H:%M ',strtotime($listaC[$j]['time']))?></span>
                         <?php 
                        }                      
                      }
                      ?>
                  <div class="col-md-8">
                    <?php
                       if($listaC[$j]['nmen']->numero!=0){
                              ?><span class="badge badge-secondary count-mensaje-badge"><?=$listaC[$j]['nmen']->numero?></span><?php
                        }
                      ?>
                    <p class="font-weight-light contenido-chat small-text">
                    <?php if(strlen($listaC[$j]['sms']->contenido)>15){
                      $mensajito=substr($listaC[$j]['sms']->contenido, 0, 15)."...";
                    }else{
                      $mensajito=$listaC[$j]['sms']->contenido;
                    } ?> 
                    <?=$listaC[$j]['tu']?> <?=$mensajito?>
                    
                    </p>

                  </div> 

                </div>
              </a>
               <?php
                   }
                 }
                ?>
              <div class="dropdown-divider"></div>
              <a href="cnuevo_mensaje"class="dropdown-item"><i class="now-ui-icons ui-1_send"></i> Nuevo Mensaje</a>
            </div>

          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="now-ui-icons ui-1_bell-53"></i>
              <?php if((int)$nnotn->num!=0){ 
                        if((int)$nnotn->num>99){
                          ?><span class="count">+99</span><?php
                        }else{
                          ?><span class="count"><label id="icacion"><?=$nnotn->num?></label></span><?php 
                        } 
                      } 
                ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <div class="dropdown-item">
                <div class="mb-0 font-weight-normal float-left"><?php if($nnotn->num==0){echo "No hay notificaciones";}else{ if($nnotn->num==1){echo "Tienes ".$nnotn->num." notificaciones nuevas";}else{echo "Tienes ".$nnotn->num." notificacion nueva";}}?>
                  <a href="clista_notificacion"><span class="badge badge-danger badge-pill">Ver todo</span></a>
                </div>                
              </div>
              <?php
              $cnoti=0;
                 foreach ($listaN->result() as $listaN) {
                  switch ($listaN->id_tipo_notificacion) {
                      case 6:
                        $noti_imagen="apps/full-icon/flat/equipo/reunion.png";
                        $href="clista_notificacion";
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
                  if($cnoti==3){
                    break;
                  }
                  if($listaN->leido_notificacion==0){
                     $tit="text-primary text-neg";
                     $ref_estilo="text-dark text-neg";
                  }else{
                    $tit="text-muted";
                    $ref_estilo="";
                  }
                  $cnoti=$cnoti+1;
                   $dia=strftime('%d de %B de %Y',strtotime($listaN->creado_en));
                  ?>
               <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?=$href?>">
                
                <img class="rounded-circle float-left" src="<?=$noti_imagen?>" width="30" height="30" alt="...">
                <div class="preview-item-content flex-grow">

                    <?php
                      if($dia==$hoy){
                        ?>
                      <span class="float-right category">Hoy <?=strftime('%H:%M ',strtotime($listaN->creado_en))?></span>
                      <?php
                      }else{
                        if($dia==$ayer){
                          
                          ?>
                          <span class="float-right category">Ayer <?=strftime('%H:%M ',strtotime($listaN->creado_en))?></span>
                         <?php
                        }else{
                         ?>
                          <span class="float-right category"><?=strftime('%b,%d',strtotime($listaN->creado_en))." ".strftime('%H:%M ',strtotime($listaN->creado_en))?></span>
                         <?php 
                        }                      
                      }
                      ?>
                  <div class="col-md-8">
                    <p class="contenido-chat font-weight-medium <?=$tit?>"><b><?=$listaN->titulo?></b></p><br>
                    <p class="contenido-chat small-text <?=$ref_estilo?>">
                    <?php if(strlen($listaN->referencia)>15){
                      $referencia=substr($listaN->referencia, 0, 15)."...";
                    }else{
                      $referencia=$listaN->referencia;
                    } ?> 
                    <?=$listaN->nombre_persona?>, <?=$referencia?>
                    
                    </p>

                  </div> 

                </div>
              </a>
               <?php
                 }
                ?>   
              <!--<div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-alert-circle-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject font-weight-medium text-dark"><b>SysTierra</b></p><br>
                  <p class="font-weight-light small-text">
                    Versi&oacute;n de prueba.
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-comment-text-outline mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject font-weight-medium text-dark"><b>SysTierra</b></p><br>
                  <p class="font-weight-light small-text">
                    , Bienvenido a SysTierra...
                  </p>
                </div>
              </a>-->
            </div>
           </li>
           <?php if($idrol==5000||$idrol==4000){
            ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons emoticons_satisfied"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Administraci&oacute;n</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a href="cadminUsuarios"class="dropdown-item"><i class="now-ui-icons business_badge text-naranja"></i> Usuarios</a>
                  <a href="cadminCambio"class="dropdown-item"><i class="now-ui-icons objects_diamond text-celeste"></i> Tipo de cambio</a>
                   <div class="dropdown-divider"></div>
                   <a href="clista_actividad_me_all"class="dropdown-item"><i class="now-ui-icons ui-1_settings-gear-63 text-secondary"></i> Actividades</a>
                </div>
              </li>
            <?php
           }?>
           
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons design_bullet-list-67"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Menu</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">



                  <?php 
           if($idrol!=3000){
              if($idrol==1000){

              }else{
                    ?>
                    <a href="clista_actividad_me"class="dropdown-item"><i class="now-ui-icons arrows-1_minimal-right text-primary"></i> Actividades</a>
                    <?php if($idrol==2000){
                    ?>
                    <a href="csolicitudes_me"class="dropdown-item"><i class="now-ui-icons arrows-1_minimal-right text-primary"></i> Solicitudes</a>
                    <a href="cdescargos_me"class="dropdown-item"><i class="now-ui-icons arrows-1_minimal-right text-primary"></i> Descargos</a>
                        <?php
                       }
                   }
              }
          ?>         
        <?php 
        if($idrol==5000||$idrol==3000||$idrol==4000){
              
                   ?>  
               <a href="csolicitudes"class="dropdown-item"><i class="now-ui-icons arrows-1_minimal-right text-primary"></i> Solicitudes</a>
               <a href="cdescargos"class="dropdown-item"><i class="now-ui-icons arrows-1_minimal-right text-primary"></i> Descargos</a>
               <a href="creembolso"class="dropdown-item"><i class="now-ui-icons arrows-1_minimal-right text-primary"></i> Reembolsos</a>
               <a href="creportes"class="dropdown-item"><i class="now-ui-icons arrows-1_minimal-right text-primary"></i> Reportes</a>            
                <?php
                if($idrol==3000){
                  ?>
                  <?php
              }else{
                 ?>
                 <a href="clista_proyecto"class="dropdown-item"><i class="now-ui-icons arrows-1_minimal-right text-primary"></i> Proyectos</a>            
                  <?php 
               }
         }
          ?>
                   
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block"><?=$nombreUsuario?></span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a href="cusuario"class="dropdown-item"><i class="now-ui-icons users_single-02 text-primary"></i> Mi perfil</a>
                   <a class="dropdown-item" href="storage/manual/MANUAL SYSTIERRA.pdf" download="MANUAL DE USUARIO SYSTIERRA.pdf"><i class="now-ui-icons travel_info text-primary"></i> Ayuda</a>
                   <a class="dropdown-item"><i class="now-ui-icons ui-1_settings-gear-63 text-primary"></i> Configuraci&oacute;n</a>
                   <div class="dropdown-divider"></div>
                   <a href="#" data-toggle="modal" data-target="#myModal" class="dropdown-item"><i class="now-ui-icons ui-1_simple-remove text-danger"></i> Cerrar sesi&oacute;n</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
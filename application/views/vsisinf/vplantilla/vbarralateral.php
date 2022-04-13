        <?php
        switch ($idrol) {
          case 1000:
            $lateral="orange";
            break;
          case 2000:
            $lateral="orange";
            break;
            case 3000:
            $lateral="orange";
            break;
            case 4000:
            $lateral="orange";
            break;
            case 5000:
            $lateral="orange";
            break;
          default:
            $lateral="orange";
            break;
        }
          switch($title_nav){
            case "Proyecto":
            $proyecto_e="active";
            $inicio_e="";
            $actividad_e="";
            $perfil_e="";
            $soli_e="";
            $des_e="";
            $rem="";
            $repo="";
            break;
            case "Actividades del proyecto":
            $proyecto_e="active";
            $inicio_e="";
            $actividad_e="";
            $perfil_e="";
            $soli_e="";
            $des_e="";
            $rem="";
            $repo="";
            break;
            
            case "Inicio":
            $proyecto_e="";
            $inicio_e="active";
            $actividad_e="";
            $perfil_e="";
            $soli_e="";
            $des_e="";
            $rem="";
            $repo="";
            $lateral="green";
            break;            
            case "Actividades":
            $proyecto_e="";
            $inicio_e="";
            $actividad_e="active";
            $perfil_e="";
            $soli_e="";
            $des_e="";
            $rem="";
            $repo="";
            break;
            case "Solicitud":
            $proyecto_e="";
            $inicio_e="";
            $actividad_e="active";
            $perfil_e="";
            $soli_e="";
            $des_e="";
            $rem="";
            $repo="";
            break;
            case "Perfil":
            $proyecto_e="";
            $inicio_e="";
            $actividad_e="";
            $perfil_e="active";
            $soli_e="";
            $des_e="";
            $rem="";
            $repo="";
            break;
            case "Solicitudes":
            $proyecto_e="";
            $inicio_e="";
            $actividad_e="";
            $perfil_e="";
            $soli_e="active";
            $des_e="";
            $rem="";
            $repo="";
            break;
            case "Descargos":
            $proyecto_e="";
            $inicio_e="";
            $actividad_e="";
            $perfil_e="";
            $soli_e="";
            $des_e="active";
            $rem="";
            $repo="";
            break;
            case "Reembolsos":
            $proyecto_e="";
            $inicio_e="";
            $actividad_e="";
            $perfil_e="";
            $soli_e="";
            $des_e="";
            $rem="active";
            $repo="";
            break;
            case "Reportes":
            $proyecto_e="";
            $inicio_e="";
            $actividad_e="";
            $perfil_e="";
            $soli_e="";
            $des_e="";
            $rem="";
            $repo="active";
            $lateral="blue";
            break;
            default:
            $proyecto_e="active";
            $inicio_e="";
            $actividad_e="";
            $perfil_e="";
            $soli_e="";
            $des_e="";
            $rem="";
            $repo="";
            break;
          }


        ?>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="<?=$lateral?>">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">

        <a href="home" class="simple-text logo-normal">
          Tierra 
          <?=$regional?>
        </a>
      </div>
                
      <div class="sidebar-wrapper">
               
        <ul class="nav">
          <li class="<?=$perfil_e?>">
                <a href="cusuario"><div class="profile-image">
                  <center><img class="rounded-circle img-side" src="<?=$this->session->userdata('id_usuario_profile')?>" alt="profile image"></center>
                </div>
                <div class="text-side-user">
                  <center><p class=""><?=$nombreUsuarioCompleto?></p></center>
                  <div>
                    <center><small class="designation"><?=$rol?><span class="status-indicator online"></span></small></center>                    
                  </div>
                </div></a>
          </li>
          <!-- <li class="<?=$inicio_e?>">
            <a href="home">
              

              <img class="icon-xsm" src="apps/full-icon/flat/iconos-sys/home-1.png" alt="img"> <label class="barra-lat-img">Inicio</label>
            </a>
          </li> -->
          <?php 
           if($idrol!=3000){
              if($idrol==1000){

              }else{
                    ?>
               <li class="<?=$actividad_e?>">
                 <a href="clista_actividad_me">
                   <img class="icon-xsm" src="apps/full-icon/flat/iconos-sys/blueprint.png" alt="img"> <label class="barra-lat-img">Actividades</label>
                 </a>
               </li>
                    <?php if($idrol==2000){
                    ?>
                    <li class="<?=$soli_e?>">
                      <a href="csolicitudes_me">
                        <img class="icon-xsm" src="apps/full-icon/flat/iconos-sys/notepad-2.png" alt="img"> <label class="barra-lat-img">Solicitudes</label>
                      </a>
                    </li>
                    <li class="<?=$des_e?>">
                      <a href="cdescargos_me">
                        <img class="icon-xsm" src="apps/full-icon/flat/iconos-sys/calculator-1.png" alt="img"> <label class="barra-lat-img">Descargos</label>
                      </a>
                    </li>
                        <?php
                       }
                   }
              }
          ?>         
        <?php 
        if($idrol==5000||$idrol==3000||$idrol==4000){
              
                   ?>  
               <li class="<?=$soli_e?>">
                 <a href="csolicitudes">
                   <img class="icon-xsm" src="apps/full-icon/flat/iconos-sys/notepad-2.png" alt="img"> <label class="barra-lat-img">Solicitudes</label>
                 </a>
               </li>
          
               <li class="<?=$des_e?>">
                 <a href="cdescargos">
                   <img class="icon-xsm" src="apps/full-icon/flat/iconos-sys/calculator-1.png" alt="img"> <label class="barra-lat-img">Descargos</label>
                 </a>
               </li>
               <li class="<?=$rem?>">
                 <a href="creembolso">
                   <img class="icon-xsm" src="apps/full-icon/flat/iconos-sys/diamond.png" alt="img"> <label class="barra-lat-img">Reembolsos</label>
                 </a>
               </li>
               <li class="<?=$repo?>">
                 <a href="creportes">
                   <img class="icon-xsm" src="apps/full-icon/flat/iconos-sys/pie-chart-1.png" alt="img"> <label class="barra-lat-img">Reportes</label>
                 </a>
               </li>            
                <?php
                if($idrol==3000){
                  ?>
                <!--<li class="">
                 <a href="#">
                   <i class="now-ui-icons business_money-coins"></i>
                   <p>Fondos</p>
                 </a>
               </li>-->
                  <?php
              }else{
                 ?><li class="<?=$proyecto_e?>">
                   <a href="clista_proyecto">
                     <img class="icon-xsm" src="apps/full-icon/flat/iconos-sys/network.png" alt="img"> <label class="barra-lat-img">Proyectos</label>
                   </a>
                 </li>
                  <?php 
               }
         }
          ?>
        </ul>
      </div>
    </div>
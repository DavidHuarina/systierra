
<!--<div class="panel-header">
        <div class="header text-center">
          <h2 class="title"><?=$proy->nombre_proyecto?></h2>
          <p class="category"><?php if($proy->resumen==""){ echo "Sin descripción";}else{ echo "".$proy->resumen."";}?>

          </p>
        </div>
    </div>-->
<div class="panel-header-sm bg-celesverde">
</div>
<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-user">
              <div class="image">
                <img src="apps/assets/img/f_11.jpg" alt="...">
              </div>
              <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="imagenes/proyecto/p.jpg" alt="images">
                    <h5 class="title"><?=$proy->nombre_proyecto?></h5>
                  </a>
                  <p class="description text-dark">
                   Codigo: <?=$proy->id_proyecto?> / Fondo: 
                   <?php
                     if($fondos==null){
                      echo "Sin Fondo";
                     }else{
                      echo $fondos->descripcion;
                     }
                   ?>
                  </p>
                </div>
                <p class="text-center description">
                  " <?=$proy->resumen?> "
                </p>
                <p class="text-center">Duraci&oacute;n: <?php
                  $f1=new DateTime($proy->fecha_inicio);
                  $f2=new DateTime($proy->fecha_fin);
                  $ed = $f1->diff($f2);
                  if((string)$ed->y=='1'){
                    echo $ed->y.' <small class="text-primary">Año,</small> ';
                  }else{
                  echo $ed->y.' <small class="text-primary">Años,</small> ';
                   } 
                   if((string)$ed->m=='1'){
                    echo $ed->m.' <small class="text-primary">Mes,</small> ';
                  }else{
                  echo $ed->m.' <small class="text-primary">Meses,</small> ';
                   }  
              
                  if((string)$ed->d=='1'){
                    echo $ed->d.' <small class="text-primary">dia</small>';
                  }else{
                  echo $ed->d.' <small class="text-primary">dias</small>';
                   }                           
                 ?></p>
                 <hr>
                 <?php 
                   if($proy->presupuesto!=1){
                  ?>
                   <a class="btn dt-button-primary buttons-copy float-right" href="cfulldetalles?id=<?=$proy->id_proyecto?>">
                       PRESUPUESTO</a>
                      <a class="btn dt-button-primary buttons-copy float-right" href="creporte_actividad?id=<?=$proy->id_proyecto?>">
                       REPORTES</a>
                  <?php
                   }
                 ?>
                  
                  <a class="btn dt-button-primary buttons-excel float-left" href="ceditar_proyecto?id=<?=$proy->id_proyecto?>">
                      Editar Datos Generales</a>
                      <a class="btn dt-button-primary buttons-excel float-left" href="cvista_Proy?id=<?=$proy->id_proyecto?>">
                      Ver Datos Generales</a>
              </div>
            </div>
          </div>         
        </div>
        <div class="row"><center>
          <div class="col-md-10">
            <div id="accordion">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Objetivo General
                    </button>
                  </h5>
                </div>
               <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                 <div class="card-body">
                    <?php if($proy->obj_gen!=""){
                      ?><p class="">
                        <?=$proy->obj_gen?>
                        </p><?php
                           }else{
                            ?><a class="btn btn-primary btn-simple btn-sm" href="cdetalle_proy/nuevoOG?id=<?=$proy->id_proyecto?>">
                               <i class="fa fa-plus text-success fa-fw"></i>Nuevo</a>
                              <?php 
                            }?>
                 </div>
               </div>
              <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Objetivos espec&iacute;ficos <small class="text-primary"><?=$nobe->num?></small>
                  </button>
                  <a class="nav-link float-right" href="#" href="#" data-toggle="modal" data-target="#NOBE">
                      <i class="fa fa-plus text-info"></i></a>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                       <table class="table">
                        <thead class="text-primary">
                         <th class="text-sm">
                           #
                         </th>
                      <th class="text-sm">
                        Objetivo Espec&iacute;fico
                      </th>
                      <th class="text-sm">
                        Indicador
                      </th>
                      <th class="text-sm">
                        N. Resul.
                      </th>
                      <th class="text-right text-sm">
                        Opciones
                      </th>
                    </thead>
                    <tbody>
                         <?php $numo=1;
                        foreach ($obes->result() as $ob) {
                          $nresultados=$this->resultados->getNresultados($ob->id_obe);
                        ?><tr>
                            <td><p class=""><?=$numo?></p></td>
                            <td><p class=""><?=$ob->descripcion?></p></td>
                            <td><p class=""><?=$ob->indicador?></p></td>
                            <td><p class="text-primary"><b><?=$nresultados->num?></b></p></td>
                            <td>
                          <div class="btn-group dropdown">
                          <button type="button" class="btn btn-round dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="now-ui-icons loader_gear"></i>
                          </button>

                          <div class="dropdown-menu">
                              <a class="dropdown-item " onclick="mandaVal('<?=$ob->id_obe?>','obe_p_c');mandaHtml('<?=$ob->descripcion?>','obe_p_e');mandaHtml('<?=$ob->indicador?>','indobe_p_e');" href="#" data-toggle="modal" data-target="#EOBE">
                              <i class="fa fa-pencil text-warning"></i> Editar</a>
                              <a class="dropdown-item" href="#" onclick="mandaVal('<?=$ob->id_obe?>','obe_cod');mandaHtml('<?=$ob->descripcion?>','obe_n');mandaHtml('<?=$ob->indicador?>','ind_n');" data-toggle="modal" data-target="#ELOBE">
                              <i class="fa fa-trash text-danger"></i> Eliminar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#" onclick="verResultados(<?=$ob->id_obe?>)">
                              <i class="fa fa-flag text-info"></i> Ver <small class="text-primary"><b><?=$nresultados->num?></b></small> resultados</a>
                          </div>
                        </div>

                            </td>
                          </tr>  
                    
                        <?php $numo=$numo+1; } ?> 
                    </tbody>                       
                       </table>    
                    </div>
                  </div>                                 
                </div>
              </div>
              </div>
            </div> <!--acordion-->      
          </div></center>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <h5 class="text-sm text-danger"><i class="fa fa-flag text-danger"></i> Resultados</h5>
                <div id="resultados">
                  <p>Ningun resultado</p>
               </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <h5 class="text-sm text-warning"><i class="fa fa-newspaper-o text-warning"></i> Indicadores de Resultados</h5>
                <div id="indicador">
                  <p>Ningun Indicador</p>
               </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <h5 class="text-sm text-info"><i class="fa fa-tags text-info"></i> Actividad por Indicador</h5>
                <div id="actividad">
                  <p>Ninguna actividad</p>
               </div>
            </div>
          </div>
        </div>
        </div>
        <div class="row">
          <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="">
                    Comunidades <small class="text-primary"><?=$ncom->num?></small> <a class="nav-link float-right" href="#" onclick="chosen_escoje()" data-toggle="modal" data-target="#ncomu">
                      <i class="fa fa-plus text-info"></i></a>
                  </h5>
                </div>
                <div class="card-body">
                  <table class="table">
                    <tr class="text-primary">
                      <td>#</td>
                      <td>Comunidad</td>
                      <td>Departamento</td>
                      <td>Opciones</td>
                    </tr>
                    <?php $ncom=1; foreach ($comunidad->result() as $com) {
                      ?><tr>
                          <td><?=$ncom?></td>
                          <td><img src="apps/full-icon/flat/campos/036-village.png" class="icon-sm" alt="image" /> <?=$com->com_nom?></td>
                          <td><?=$com->dep_des?></td>
                          <td class="text-center"><a class="" href="cdetalle_proyecto/elcom?id=<?=$proy->id_proyecto?>&idcom=<?=$com->com_id?>">
                              <i class="fa fa-trash text-danger"></i></a></td>
                      </tr><?php
                    $ncom=$ncom+1; }?>
                  </table>
                </div>
              </div>                   
          </div>
           <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="">
                    Organizaciones <small class="text-primary"><?=$norg->num?></small> <a class="nav-link float-right" href="#" onclick="" data-toggle="modal" data-target="#norg">
                      <i class="fa fa-plus text-info"></i></a>
                  </h5>
                </div>
                <div class="card-body">
                  <table class="table">
                    <tr class="text-primary">
                      <td>#</td>
                      <td>Organizaci&oacute;n</td>
                      <td>Opciones</td>
                    </tr>
                    <?php $norg=1; foreach ($organizacion->result() as $org) {
                      ?><tr>
                          <td><?=$norg?></td>
                          <td><img src="apps/full-icon/flat/social/009-connection-1.png" class="icon-sm" alt="image" /> <?=$org->nombre_org?></td>
                          <td class="text-center"><a class="" href="cdetalle_proyecto/elorg?id=<?=$proy->id_proyecto?>&idorg=<?=$org->id_org?>">
                              <i class="fa fa-trash text-danger"></i></a></td>
                      </tr><?php
                    $norg=$norg+1; }?>
                  </table>
                </div>
              </div>                   
          </div>
      </div>
</div>
      
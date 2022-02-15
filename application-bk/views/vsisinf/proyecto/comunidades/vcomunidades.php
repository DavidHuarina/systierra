  <div class="panel-header-sm bg-azul-oscuro">
</div>      
        <div class="content">
          <!--principio de Panel-->
          <div class="row">
          <div class="col-md-12">
            <div class="card card-user">
              <div class="image">
                <img src="apps/assets/img/flores2.jpg" width="100%" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="ccomun">
                    <img class="avatar border-gray" src="apps/full-icon/flat/campos/036-village.png" alt="images">
                    <h5 class="title">Comunidades en Bolivia</h5>
                  </a>
                  <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a>
                  <p class="text-dark">
                   <a href="ccomunidad" class="nav-link">Nueva comunidad</a>
                  </p>
                  <p class="description text-black">
                   <a href="corganizaciones" class="nav-link">Organizaciones</a>
                  </p>
                </div>                 
              </div>
            </div>
          </div>         
        </div>
          <div class="row">
              <div class="card">
                <div class="card-header">
                <h5 class="title">Lista de Comunidades <small class="text-info"><?=$ncomtot->num?></small></h5>
              </div>
                <div class="card-body">
                  <p class="text-primary"><small class="text-muted">Municipio de</small> <?=$comu->mun_des?>, <small class="text-muted">Provincia</small> <?=$comu->pro_des?>, <small class="text-muted">Departamento de</small> <?=$comu->dep_des?></p>
                  <p class="text-primary"><small class="text-muted">Numero de comunidades</small> <?=$ncomu->num?></p>
                  <div class="table-responsive-sm">
                    <table id="table-com" class="table text-peq">
                      <thead>
                        <tr class="text-azul-oscuro">
                          <th class="mit-sm">
                            <b>Nro.</b>
                          </th>
                          <th class="mit-sm">
                            <b></b>
                          </th>
                          <th class="mit">
                            <b>Nombre</b>
                          </th>
                          <th class="mit">
                            <b>Viviendas</b>
                          </th>
                          <th class="mit">
                            <b>Proyectos</b>
                          </th>
                          <th class="mit">
                            <b>Departamento</b>
                          </th>
                          <th class="mit-sm">
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $n=0;
                        foreach ($comunidades->result() as $comun) {
                          $n=$n+1;
                          $nproy=$this->com_proy->getNByIdCom($comun->com_id);
                          $proyects=$this->com_proy->getAllByIdCom($comun->com_id);
                        ?>
                        <tr>
                          <td>
                            <?=$n?>
                          </td>
                          <td class="">
                            
                          </td>
                          <td>
                            <?=$comun->com_nom?>
                          </td>
                          <td>
                            <?=$comun->viviendas?>
                          </td>
                          <td>
                            <p class="text-azul-oscuro"><b><?=$nproy->num?></b></p>
                            <?php foreach ($proyects->result() as $pro) {
                              ?><small class="text-azul-oscuro"><b><?=$pro->nombre_proyecto?></b></small><br><?php
                            }?>
                          </td>
                          <td>
                            <?=$comun->dep_des?>
                          </td>
                          <td>
                        <div class="btn-group dropdown">
                          <button type="button" class="btn btn-round dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fa fa-cog"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ecom" onclick="
                              mandaVal(<?=$comun->com_id?>,'com_id');
                              mandaVal('<?=$comun->com_nom?>','com_nom');
                              mandaVal('<?=$comun->viviendas?>','com_sup');
                              mandaVal('<?=$comun->poblacion?>','com_fa');
                              mandaVal('<?=$comun->region?>','com_pa');
                              mandaVal('<?=$comun->obs_ft1?>','com_obs');">
                              <i class="fa fa-pencil fa-fw text-warning"></i> Editar</a>
                              <a class="dropdown-item" href="#">
                              <i class="fa fa-history fa-fw text-success"></i> Ver informacion</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#elcom" onclick="
                              mandaVal('<?=$comun->com_id?>','com_ide');
                              mandaVal('<?=$comun->com_nom?>','com_nome');">
                              <i class="fa fa-times text-danger fa-fw"></i> Eliminar</a>
                          </div>
                       </div>
                          </td>
                        </tr>
                        <?php
                        }?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div><!-- fin panel-->
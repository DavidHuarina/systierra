  <div class="panel-header-sm bg-plomo">
</div>      
        <div class="content">
          <!--principio de Panel-->
          <div class="row">
          <div class="col-md-12">
            <div class="card card-user">
              <div class="image">
                <img src="apps/assets/img/orga2.jpg" width="100%" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="apps/full-icon/flat/social/009-connection-1.png" alt="images">
                    <h5 class="title">Organizaciones</h5>
                  </a>
                  <p class="text-dark">
                   <a href="corganizacion" class="nav-link">Nueva organizaci&oacute;n</a>
                  </p>
                  <p class="description text-dark">
                   <a href="ccomun" class="nav-link">Comunidades</a>
                  </p>
                </div>                 
              </div>
            </div>
          </div>         
        </div>
          <div class="row">
              <div class="card">
                <div class="card-header">
                <h5 class="title">Lista de Organizaciones <small class="text-info"><?=$norgtot->num?></small></h5>
              </div>
                <div class="card-body">
                  <div class="table-responsive-sm">
                    <table id="table-com" class="table text-peq">
                      <thead>
                        <tr class="text-plomo">
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
                            <b>Proyectos</b>
                          </th>
                          <th class="mit">
                            <b>Tipo</b>
                          </th>
                          <th class="mit-sm">
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $n=0; foreach ($organizaciones->result() as $orgs) {
                          $n=$n+1;
                          $nproy=$this->org_proy->getNByIdOrg($orgs->id_org);
                          $proyects=$this->org_proy->getAllByIdOrg($orgs->id_org);
                        ?>
                        <tr>
                          <td class="mit-sm">
                            <?=$n?>
                          </td>
                          <td class="">
                            <img src="apps/full-icon/flat/social/009-connection-1.png" class="icon-sm" alt="image" />
                          </td>
                          <td>
                            <?=$orgs->nombre_org?>
                          </td>
                          <td>
                            <p class="text-plomo"><b><?=$nproy->num?></b></p>
                            <?php foreach ($proyects->result() as $pro) {
                              ?><small class="text-plomo"><b><?=$pro->nombre_proyecto?></b></small><br><?php
                            }?>
                          </td>
                          <td>
                            <?=$orgs->descripcion?>
                          </td>
                          <td>
                        <div class="btn-group dropdown">
                          <button type="button" class="btn btn-round dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fa fa-cog"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#eorg" onclick="
                              mandaVal('<?=$orgs->nombre_org?>','nombre_org');
                              mandaVal('<?=$orgs->id_org?>','id_org');
                              mandaVal('<?=$orgs->descripcion_o?>','des_org');">
                              <i class="fa fa-pencil fa-fw text-warning"></i> Editar</a>
                              <a class="dropdown-item" href="#">
                              <i class="fa fa-history fa-fw text-success"></i> Ver informacion</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#elorg" onclick="
                              mandaVal('<?=$orgs->nombre_org?>','nombre_orge');
                              mandaVal('<?=$orgs->id_org?>','id_orge');">
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
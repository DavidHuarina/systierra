<div class="panel-header-sm bg-celeste">
</div>
   <div class="content">
          <div class="row">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Monedas registradas <small class="text-celeste"><?=$nca->num?></small></h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive-sm">
                    <table id="table-actividad" class="table table-striped table-sm text-small">
                      <thead>
                        <tr>
                          <th>
                            <b>IM</b>
                          </th>
                          <th>
                            <b>PAIS</b>
                          </th>
                          <th>
                            <b>UNIDAD</b>
                          </th>
                          <th>
                            <b>MONEDA</b>
                          </th>
                          <th>
                            <b>VALOR (Bs)</b>
                          </th>
                          <th>
                            <b>Opciones</b>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($lista_cambio->result() as $cambio) {
                        ?>
                        <tr>
                          <td class="py-1">
                            <img class="img-sm rounded-circle" src="apps/full-icon/flat/negocio/coin-9.png" alt="image" />
                          </td>
                          <td>
                            <?=$cambio->pais?>
                          </td>
                          <td>
                            <?=$cambio->unidad_mon?>
                          </td>
                          <td>
                            <?=$cambio->moneda?>
                          </td>
                          <td>
                            <?=$cambio->valor?>
                          </td>
                          <td>
                        <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fa fa-cog"></i> Opciones
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">
                              </a>
                              <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="#">
                              </a>
                          </div>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ecom" onclick="
                              mandaVal(<?=$cambio->id_cambio?>,'com_id');
                              mandaVal('<?=$cambio->pais?>','com_nom');
                              mandaVal('<?=$cambio->unidad_mon?>','com_sup');
                              mandaVal('<?=$cambio->moneda?>','com_fa');
                              mandaVal('<?=$cambio->valor?>','com_pa');">
                              <img class='icon-sm' src='apps/full-icon/flat/negocio/check.png' alt='Sin imagen'> <label class='text-small'>Editar</label></a>
                    
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
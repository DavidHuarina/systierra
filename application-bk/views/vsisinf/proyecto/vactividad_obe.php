<p class="text-primary">Indicador <a class="nav-link float-right" href="#" onclick="mandaVal('<?=$indicador->id_ind?>','ind_codigo');" data-toggle="modal" data-target="#nact">
                      <i class="fa fa-plus text-info"></i></a></p><small><?=$indicador->descripcion?></small>

<table class="table">
                        <thead class="text-danger">
                         <th class="text-sm">
                           #
                         </th>
                      <th class="text-sm">
                        Actividad
                      </th>
                      <th class="text-right text-sm">
                        Opciones
                      </th>
                    </thead>
                    <tbody>
                         <?php $numr=1;
                        foreach ($actividad->result() as $act) {
                        ?><tr>
                            <td><p class=""><?=$numr?></p></td>
                            <td><p class=""><?=$act->descripcion?></p></td>
                            <td>
                          <div class="btn-group dropdown">
                          <button type="button" class="btn btn-round dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="now-ui-icons loader_gear"></i>
                          </button>

                          <div class="dropdown-menu">
                              <a class="dropdown-item " href="#" onclick="mandaVal('<?=$act->id_act_ml?>','ind_codigo_e');mandaVal('<?=$act->descripcion?>','act_i_e');" data-toggle="modal" data-target="#eact">
                              <i class="fa fa-pencil text-warning"></i> Editar</a>
                              <a class="dropdown-item" href="#" onclick="mandaVal('<?=$act->id_act_ml?>','ind_codigo_el');mandaVal('<?=$act->descripcion?>','act_i_el');" data-toggle="modal" data-target="#elact">
                              <i class="fa fa-trash text-danger"></i> Eliminar</a>
                              <div class="dropdown-divider"></div>          
                          </div>
                        </div>

                            </td>
                          </tr>  
                    
                        <?php $numr=$numr+1; } ?> 
                    </tbody>                       
                       </table>
                       <?php
                        if($numr==1){
                          echo "<label class='text-muted'>Ninguna actividad encontrada</label>";
                        } ?>
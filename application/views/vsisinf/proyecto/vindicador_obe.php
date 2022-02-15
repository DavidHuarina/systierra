<p class="text-primary">Resultado <a class="nav-link float-right" href="#" onclick="mandaVal('<?=$result->id_result?>','res_codd');" data-toggle="modal" data-target="#nind">
                      <i class="fa fa-plus text-info"></i></a></p><small><?=$result->descripcion?></small>

<table class="table">
                        <thead class="text-danger">
                         <th class="text-sm">
                           #
                         </th>
                      <th class="text-sm">
                        Indicador
                      </th>
                      <th class="text-right text-sm">
                        Opciones
                      </th>
                    </thead>
                    <tbody>
                         <?php $numr=1;
                        foreach ($indicador->result() as $ind) {
                         $nact_ml=$this->act_ml->getByIdIndN($ind->id_ind);
                        ?><tr>
                            <td><p class=""><?=$numr?></p></td>
                            <td><p class=""><?=$ind->descripcion?></p></td>
                            <td>
                          <div class="btn-group dropdown">
                          <button type="button" class="btn btn-round dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="now-ui-icons loader_gear"></i>
                          </button>

                          <div class="dropdown-menu">
                              <a class="dropdown-item " href="#" onclick="mandaVal('<?=$ind->id_ind?>','codind_e');mandaVal('<?=$ind->descripcion?>','ind_e');" data-toggle="modal" data-target="#eind">
                              <i class="fa fa-pencil text-warning"></i> Editar</a>
                              <a class="dropdown-item" href="#" onclick="mandaVal('<?=$ind->id_ind?>','codind_el');mandaVal('<?=$ind->descripcion?>','ind_el');" data-toggle="modal" data-target="#elind">
                              <i class="fa fa-trash text-danger"></i> Eliminar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#" onclick="verActividad(<?=$ind->id_ind?>)">
                              <i class="fa fa-tags text-info"></i> Ver <small class="text-primary"><b><?=$nact_ml->num?></b></small> Actividades ML</a>
                
                          </div>
                        </div>

                            </td>
                          </tr>  
                    
                        <?php $numr=$numr+1; } ?> 
                    </tbody>                       
                       </table>
                       <?php
                        if($numr==1){
                          echo "<label class='text-muted'>Ningun indicador encontrado</label>";
                        } ?>
<p class="text-primary">Objetivo Especifico <a class="nav-link float-right" href="#" onclick="mandaVal('<?=$objetivo->id_obe?>','obe_codd');" data-toggle="modal" data-target="#nres">
                      <i class="fa fa-plus text-info"></i></a></p><small><?=$objetivo->descripcion?></small>

<table class="table">
                        <thead class="text-danger">
                         <th class="text-sm">
                           #
                         </th>
                      <th class="text-sm">
                        Resultado
                      </th>
                      <th class="text-right text-sm">
                        Opciones
                      </th>
                    </thead>
                    <tbody>
                         <?php $numr=1;
                        foreach ($result->result() as $res) {
                         $nindicador=$this->indicador->getByIdResultN($res->id_result);
                        ?><tr>
                            <td><p class=""><?=$numr?></p></td>
                            <td><p class=""><?=$res->descripcion?></p></td>
                            <td>
                          <div class="btn-group dropdown">
                          <button type="button" class="btn btn-round dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="now-ui-icons loader_gear"></i>
                          </button>

                          <div class="dropdown-menu">
                              <a class="dropdown-item " href="#" onclick="mandaVal('<?=$res->id_result?>','codres_e');mandaVal('<?=$res->descripcion?>','res_e');" data-toggle="modal" data-target="#eres">
                              <i class="fa fa-pencil text-warning"></i> Editar</a>
                              <a class="dropdown-item" href="#" onclick="mandaVal('<?=$res->id_result?>','cod_el');mandaVal('<?=$res->descripcion?>','res_el');" data-toggle="modal" data-target="#elres">
                              <i class="fa fa-trash text-danger"></i> Eliminar</a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#" onclick="verIndicador(<?=$res->id_result?>)">
                              <i class="fa fa-newspaper-o text-warning"></i> Ver <small class="text-primary"><b><?=$nindicador->num?></b></small> Indicadores</a>
                
                          </div>
                        </div>

                            </td>
                          </tr>  
                    
                        <?php $numr=$numr+1; }
                        ?> 
                    </tbody>                       
                       </table>
                       <?php
                        if($numr==1){
                          echo "<label class='text-muted'>Ningun resultado encontrado</label>";
                        } ?>
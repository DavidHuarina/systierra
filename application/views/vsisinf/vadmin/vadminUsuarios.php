<div class="panel-header-sm bg-naranja">
</div>
   <div class="content">
          <div class="row">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Usuarios registrados <small class="text-naranja"><?=$nus->num?></small>
                    <a class="float-right" href="cregister2">
                    <img class="icon-sm" src="apps/full-icon/flat/iconos-sys/plus.png"></a></h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive-sm">
                    <table id="table-actividad" class="table table-sm text-small">
                      <thead>
                        <tr>
                          <th>
                            <b>Usuario</b>
                          </th>
                          <th>
                            <b>Nombre</b>
                          </th>
                          <th>
                            <b>Categoria</b>
                          </th>
                          <th>
                            <b>Cargo</b>
                          </th>
                          <th>
                            <b>E-mail</b>
                          </th>
                          <th>
                            <b>Opciones</b>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($lista_usuarios->result() as $usuarios) {
                          if($usuarios->estado_per==0){
                            $habil="btn-danger";
                            $fondoLi="bg-secondary text-white";
                            $diri="apps/full-icon/flat/essencial/hide.png";
                          }else{
                             $habil="btn-success";
                             $fondoLi="";
                             $diri=$usuarios->dir_imagen;
                          }
                        ?>
                        <tr class="<?=$fondoLi?>">
                          <td class="py-1">
                            <img class="img-sm rounded-circle" src="<?=$diri?>" alt="image" />
                          </td>
                          <td>
                            <?php if($usuarios->online==1){
                              echo "<span class='status-indicator online'></span>";
                            }else{
                              echo "<span class='status-indicator offline'></span>";
                            }?> <?=$usuarios->nombre_persona?>
                          </td>
                          <td>
                            <?=ucfirst(strtolower($usuarios->descripcion))?>
                          </td>
                          <td>
                            <?=$usuarios->nombre_cargo?>
                          </td>
                          <td>
                            <?=$usuarios->correo?>
                          </td>
                          <td>
                        <div class="btn-group dropdown">
                          <button type="button" class="btn <?=$habil?> dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fa fa-cog"></i> Opciones
                          </button>
                          <div class="dropdown-menu">
                              <?php 
                             if($usuarios->estado_per==0){
                               ?>
                                <a class="dropdown-item" href="ceditarCargo/habilitarPersonal/<?=$usuarios->id_persona?>/<?=$usuarios->id_usuario?>">
                              <img class='icon-sm' src='apps/full-icon/flat/documentos/text-4.png' alt='Sin imagen'> <label class='text-small'>HABILITAR</label></a>
                               <?php
                             }else{
                               ?>
                               <a class="dropdown-item" href="ceditarRol?id=<?=$usuarios->id_persona?>">
                              <img class='icon-sm' src='apps/full-icon/flat/oficina/id-card-1.png' alt='Sin imagen'> <label class='text-small'>Editar Rol</label></a>
                              <a class="dropdown-item" href="ceditarCargo?id=<?=$usuarios->id_persona?>">
                              <img class='icon-sm' src='apps/full-icon/flat/equipo/promotion.png' alt='Sin imagen'> <label class='text-small'>Editar Cargo</label></a>
                              <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="ceditarCargo/eliminarPersonal/<?=$usuarios->id_persona?>/<?=$usuarios->id_usuario?>">
                              <img class='icon-sm' src='apps/full-icon/flat/documentos/text-3.png' alt='Sin imagen'> <label class='text-small'>INHABILITAR</label></a>
                               <?php
                             }
                              ?>
                           
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
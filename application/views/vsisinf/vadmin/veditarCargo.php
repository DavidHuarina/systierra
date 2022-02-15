<div class="panel-header-sm bg-cafe-claro">
</div>
<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Edici&oacute;n de Cargos - Tierra <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a></h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="title text-center">Informaci&oacute;n Personal</p>
                    <table>
                         <tr><td><label>Nombre:</label></td><td><label class="text-lg text-dark"><?=$personax->nombre_persona?> <?=$personax->apellido_persona?></label></td></tr>
                         <tr><td><label>Direccion:</label></td><td><label class="text-lg text-dark"><?=$personax->direccion?></label></td></tr>
                         <tr><td><label>Correo:</label></td><td><label class="text-lg text-dark"><?=$personax->correo?></label></td></tr>
                         <tr><td><label>Fecha de Nacimiento:</label></td><td><label class="text-lg text-dark"><?=strftime('%d de %B de %Y',strtotime($personax->fecha_nacimiento))?></label></td></tr>
                         <tr><td><label>Telefono:</label></td><td><label class="text-lg text-dark">+591 <?=$personax->telefono?></label></td></tr>
                         <tr><td><label>Cargo de Personal:</label></td><td><label class="text-lg text-dark"><b><?=$personax->nombre_cargo?></b></label></td></tr>
                    </table> <br>
                    <form class="" action="ceditarCargo/editar/<?=$personax->id_persona?>" method="post">
                    <p class="title text-center">Cargos de personal TIERRA</p>
                    <div class="row">
                       <div class="col-md-2"><img class="icon-lg" src="apps/full-icon/flat/equipo/promotion.png" alt="images"></div>
                       <div class="col-md-10">
                       <div class="form-group">
                          <label>Lista de cargos registrados</label>  
                          <select id="cargo-sel" name="cargo-sel" class="form-control select-single-plantilla">
                              <?php
                               foreach ($cargoper->result() as $com) {
                                if($personax->id_cargo==$com->id_cargo){
                                 ?><option value="<?=$com->id_cargo?>" selected><?=$com->nombre_cargo?></option><?php   
                                }else{
                                  ?><option value="<?=$com->id_cargo?>"><?=$com->nombre_cargo?></option><?php
                                }
                                
                               }
                              ?>
                          </select>
                         </div> 
                       </div>                             
                    </div>    
                    <button type="submit" class="btn btn-success float-right"><i class=""></i> Guardar Cambios</button>
                    </form>
                  </div>
                  <div class="col-md-4">
                    <div class="float-right">
                      <p class="title text-center"><?=$personax->nombre_persona?></p>
                     <center><h5 class=""><img class="" src="<?=$personax->dir_imagen?>" width="200" alt="images"></h5></center>
                     <hr>
                     <p class="description text-center"><?=$personax->sobre_mi?></p>
                     <center>
                       <div class="button-container">
                         <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                           <i class="fa fa-facebook-f"></i>
                         </button>
                         <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                           <i class="fa fa-twitter"></i>
                         </button>
                         <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                           <i class="fa fa-google-plus-g"></i>
                         </button>
                         </div>
                       </center>
                     </div>
                   </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
<div class="panel-header panel-header-sm">
   </div>
<div class="content">  
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><img class="icon-sm" src="apps/full-icon/flat/negocio/diagram.png"> Editar proyecto 
                  <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a>
                </h5>
                
              </div>
              <div class="card-body">
                <form autocomplete="off" action="ceditar_proyecto/editar?id=<?=$proy->id_proyecto?>" class="validate-form" method="post">
                  <div class="rounded titulos"><center><p class="text-md">Informacion General</p></center></div><br>
                  <div class="row">
                    <div class="col-md-7 pr-1">
                      <div class="form-group validate-input" data-validate="Ingrese un nombre de proyecto">
                        <label>Nombre del proyecto</label>
                        <input type="text" id="nombre_p" name="nombre_p" class="form-control" placeholder="" value="<?=$proy->nombre_proyecto?>">
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group validate-input" data-validate="Error en la fecha">
                        <label>Fecha Inicio</label>
                        <input type="text" id="fi_p" name="fi_p"class="form-control" placeholder="Ej: dd/mm/aaaa" value="<?=strftime('%d/%m/%Y',strtotime($proy->fecha_inicio))?>">
                      </div>
                    </div>
                    <div class="col-md-2 pl-1">
                      <div class="form-group validate-input" data-validate="Error en la fecha">
                        <label>Fecha Final</label>
                        <input type="text" id="ff_p" name="ff_p" class="form-control" placeholder="Ej: dd/mm/aaaa" value="<?=strftime('%d/%m/%Y',strtotime($proy->fecha_fin))?>">
                      </div>
                    </div>
                  </div>
                  <div class="rounded titulos"><center><p class="text-md">Objetivos General</p></center></div><br>
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group validate-input" data-validate="Ingrese un objetivo general">
                        <label>Objetivo General</label>
                        <textarea type="text" id="obj_gen" onkeypress="return validarEnter(event)" name="obj_gen" class="form-control texta-lg" placeholder="Escriba aquí..."><?=$proy->obj_gen?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="rounded titulos"><center><p class="text-md">Descripci&oacute;n del proyecto</p></center></div><br>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Breve descripci&oacute;n / &oacute; Resumen del proyecto</label>
                        <textarea id="resumen" name="resumen" rows="4" cols="80" class="form-control" placeholder="Ingrese una descripci&oacute;n aqu&iacute;" value=""><?=$proy->resumen?></textarea>
                      </div>
                      <div class="float-left">
                        <a href="javascript:history.back(-1);" class="btn btn-danger">Cancelar</a>
                       </div>
                      <div class="float-right">
                        <button type="submit" class="btn btn-warning">Guardar cambios</button>
                       </div>
                    </div>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
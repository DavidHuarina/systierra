<div class="panel-header panel-header-sm">
   </div>
<div class="content">  
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><img class="icon-sm" src="imagenes/proyecto/p.jpg"> Nuevo proyecto 
                  <a class="float-right" href="#" data-toggle="modal" data-target="#InfoNproy">
                    <i class="now-ui-icons travel_info text-muted"></i></a>
                </h5>
                
              </div>
              <div class="card-body">
                <form autocomplete="off" action="cnuevo_proyecto/agregar" class="validate-form" method="post">
                  <div class="rounded titulos"><center><p class="text-md">Informacion General</p></center></div><br>
                  <div class="row">
                    <div class="col-md-7 pr-1">
                      <div class="form-group validate-input" data-validate="Ingrese un nombre de proyecto">
                        <label>Nombre del proyecto</label>
                        <input type="text" id="nombre_p" name="nombre_p" class="form-control" placeholder="" value="">
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group validate-input" data-validate="Error en la fecha">
                        <label>Fecha Inicio</label>
                        <input type="text" id="fi_p" name="fi_p"class="form-control" placeholder="Ej: dd/mm/aaaa" value="">
                      </div>
                    </div>
                    <div class="col-md-2 pl-1">
                      <div class="form-group validate-input" data-validate="Error en la fecha">
                        <label>Fecha Final</label>
                        <input type="text" id="ff_p" name="ff_p" class="form-control" placeholder="Ej: dd/mm/aaaa" value="">
                      </div>
                    </div>
                  </div>
                  <div class="rounded titulos"><center><p class="text-md">Objetivos General</p></center></div><br>
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group validate-input" data-validate="Ingrese un objetivo general">
                        <label>Objetivo General</label>
                        <textarea type="text" id="obj_gen" onkeypress="return validarEnter(event)" name="obj_gen" class="form-control texta-lg" placeholder="Escriba aquí..." value=""></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="rounded titulos"><center><p class="text-md">Objetivos Especificos</p></center></div><br>
                  <div class="row">
                    <div class="col-md-7 pr-1">
                      <div class="form-group validate-input" data-validate="Campo requerido">
                        <label>Objetivo especifico 1</label>
                        <textarea type="text" id="obj_es1" onkeypress="return validarEnter(event)" name="obj_es1" class="form-control texta-md" placeholder="Escriba aquí..." value=""></textarea>
                      </div>
                      <div class="form-group">
                        <label>Objetivo especifico 2</label>
                        <textarea type="text" id="obj_es2" onkeypress="return validarEnter(event)" name="obj_es2" class="form-control texta-md" placeholder="Escriba aquí..." value=""></textarea>
                      </div>
                      <div class="form-group">
                        <label>Objetivo especifico 3</label>
                        <textarea type="text" id="obj_es3" onkeypress="return validarEnter(event)" name="obj_es3" class="form-control texta-md" placeholder="Escriba aquí..." value=""></textarea>
                      </div>
                    </div>
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Indicador del Objetivo especifico 1</label>
                        <textarea type="text" id="obj_es_ind1" onkeypress="return validarEnter(event)" name="obj_es_ind1" class="form-control texta-md" placeholder="Escriba aquí..." value=""></textarea>
                      </div>
                      <div class="form-group">
                        <label>Indicador del Objetivo especifico 2</label>
                        <textarea type="text" id="obj_es_ind2" onkeypress="return validarEnter(event)" name="obj_es_ind2" class="form-control texta-md" placeholder="Escriba aquí..." value=""></textarea>
                      </div>
                      <div class="form-group">
                        <label>Indicador del Objetivo especifico 3</label>
                        <textarea type="text" id="obj_es_ind3" onkeypress="return validarEnter(event)" name="obj_es_ind3" class="form-control texta-md" placeholder="Escriba aquí..." value=""></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row d-none">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Comunidades</label>
                          <select id="ncomunidad" name="ncomunidad[]" data-placeholder="Buscar comunidades..."  class="form-control select-plantilla" multiple="multiple" tabindex="4">
                              <?php
                               foreach ($comunidad->result() as $com) {
                                echo "<option value=\'".$com->com_id."\'>".$com->com_nom." - ".$com->dep_des."</option>";
                               }
                              ?>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="rounded titulos"><center><p class="text-md">Descripci&oacute;n del proyecto</p></center></div><br>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Breve descripci&oacute;n / &oacute; Resumen del proyecto</label>
                        <textarea id="resumen" name="resumen" rows="4" cols="80" class="form-control" placeholder="Ingrese una descripci&oacute;n aqu&iacute;" value=""></textarea>
                      </div>
                      <div class="float-right">
                        <button type="submit" class="btn btn-info btn-lg">Registrar</button>
                       </div>
                    </div>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
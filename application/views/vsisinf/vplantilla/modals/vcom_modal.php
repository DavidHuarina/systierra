
 <!-- Sart Modal -->
    <div class="modal fade" id="ecom" role="asd" aria-labelledby="ecomLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <label class="">Editar</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="ccomunidad/edit" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="com_id" name="com_id" readonly>
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Comunidad</label>
                        <input type="text" class="form-control" id="com_nom" name="com_nom" placeholder="Nombre de comunidad">
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Viviendas</label>
                        <input type="text" class="form-control" id="com_sup" name="com_sup" placeholder="Superficie">
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Poblaci&oacute;n</label>
                        <input type="text" class="form-control" id="com_fa" name="com_fa" placeholder="Nero de familias">
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Regi&oacute;n</label>
                        <input type="text" class="form-control" id="com_pa" name="com_pa" placeholder="Nro de parcelas">
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Descripci&oacute;n</label>
                        <input type="text" class="form-control" id="com_obs" name="com_obs" placeholder="Descripci&oacute;n">
                      </div>
                    </div>
                  </div>                 
                  <hr class="hr"></hr>
                  <div class="float-right">
                      <button type="submit" class="btn btn-info">Guardar</button>
                    </div>
                </form>
          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->
     <!-- Sart Modal -->
    <div class="modal fade" id="elcom" role="asd" aria-labelledby="elcomLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <label class="">¿Seguro que quiere eliminar?</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="ccomunidad/borrar" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="com_ide" name="com_ide" readonly>
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Comunidad</label>
                        <input readonly type="text" class="form-control" id="com_nome" name="com_nome" placeholder="descripcion">
                      </div>
                    </div>
                  </div>                 
                  <hr class="hr"></hr>
                  <div class="float-right">
                      <button type="submit" class="btn btn-danger">Si, Quiero eliminar</button>
                    </div>
                </form>
          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->


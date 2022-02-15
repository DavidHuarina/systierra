
 <!-- Sart Modal -->
    <div class="modal fade" id="eorg" role="asd" aria-labelledby="eorgLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <label class="">Editar</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="corganizacion/edit" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="id_org" name="id_org" readonly>
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Organizacion</label>
                        <input type="text" class="form-control" id="nombre_org" name="nombre_org" placeholder="descripcion">
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Descripci&oacute;n</label>
                        <input type="text" class="form-control" id="des_org" name="des_org" placeholder="descripcion">
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
    <div class="modal fade" id="elorg" role="asd" aria-labelledby="elorgLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <label class="">¿Seguro que quiere eliminar?</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="corganizacion/borrar" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="id_orge" name="id_orge" readonly>
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Organizacion</label>
                        <input readonly type="text" class="form-control" id="nombre_orge" name="nombre_orge" placeholder="descripcion">
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



    
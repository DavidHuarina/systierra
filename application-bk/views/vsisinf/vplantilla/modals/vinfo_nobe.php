
    <!-- Sart Modal -->
    <div class="modal fade" id="NOBE" tabindex="-2" role="dialog" aria-labelledby="NOBELabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <label class="">Nuevo objetivo</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="cdetalle_proyecto/nobe?id=<?=$proy->id_proyecto?>" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Objetivo especifico</label>
                        <textarea type="text" class="form-control" id="obe_p" onkeypress="return validarEnter(event)" name="obe_p" placeholder="descripcion"></textarea>
                      </div>
                      <div class="form-group">
                        <label>Indicador</label>
                        <textarea type="text" class="form-control" id="indobe_p" name="indobe_p" placeholder="Indicador"></textarea>
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
    <div class="modal fade" id="EOBE" role="asd" aria-labelledby="EOBELabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <label class="">Editar</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="cdetalle_proyecto/eobe?id=<?=$proy->id_proyecto?>" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="obe_p_c" name="obe_p_c" readonly>
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Objetivo especifico</label>
                        <textarea type="text" class="form-control" onkeypress="return validarEnter(event)" id="obe_p_e" name="obe_p_e" placeholder="descripcion"></textarea>
                      </div>
                      <div class="form-group">
                        <label>Indicador</label>
                        <textarea type="text" class="form-control" id="indobe_p_e" name="indobe_p_e" placeholder="Indicador"></textarea>
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
    <div class="modal fade" id="ELOBE" role="asd" aria-labelledby="ELOBELabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <label class="">¿Seguro que quiere eliminar?</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="cdetalle_proyecto/elobe?id=<?=$proy->id_proyecto?>" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="obe_cod" name="obe_cod" readonly>
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Objetivo especifico</label>
                        <textarea readonly type="text" class="form-control" id="obe_n" name="obe_n" placeholder="descripcion"></textarea>
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Indicador</label>
                        <textarea readonly type="text" class="form-control" id="ind_n" name="ind_n" placeholder="Indicador"></textarea>
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



     <!-- RESULTADOS___________________________________________________________RESULTADOS______________________________________ -->



         <!-- Sart Modal -->
    <div class="modal fade" id="eres" role="asd" aria-labelledby="eresLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <label class="">Editar resultado</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="#" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="codres_e" name="codres_e" readonly>
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Resultado</label>
                        <textarea type="text" class="form-control" onkeypress="return validarEnter(event)" id="res_e" name="res_e" placeholder="descripcion"></textarea>
                      </div>
                    </div>
                  </div>                 
                  <hr class="hr"></hr>
                  <div class="float-right">
                      <a href="#" onclick="eres('<?=$proy->id_proyecto?>')" class="btn btn-primary">Editar</a>
                    </div>
                </form>
          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->
     <!-- Sart Modal -->
    <div class="modal fade" id="nres" role="asd" aria-labelledby="nresLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <label class="">Nuevo resultado</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="#" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="obe_codd" name="obe_codd" readonly>
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Resultado</label>
                        <textarea type="text" class="form-control" onkeypress="return validarEnter(event)" id="res_o" name="res_o" placeholder="descripcion"></textarea>
                      </div>
                    </div>
                  </div>                 
                  <hr class="hr"></hr>
                  <div class="float-right">
                      <a href="#" onclick="nres('<?=$proy->id_proyecto?>')" class="btn btn-primary">Guardar</a>
                    </div>
                    <div id="mensaje_modal">
                    </div>
                </form>
          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->

             <!-- Sart Modal -->
    <div class="modal fade" id="elres" role="asd" aria-labelledby="elresLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <label class="">Eliminar resultado</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="#" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="cod_el" name="cod_el" readonly>
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Resultado</label>
                        <textarea type="text" class="form-control" id="res_el" name="res_el" placeholder="descripcion"></textarea>
                      </div>
                    </div>
                  </div>                 
                  <hr class="hr"></hr>
                  <div class="float-right">
                      <a href="#" onclick="elres('<?=$proy->id_proyecto?>')" class="btn btn-primary">Guardar</a>
                    </div>
                </form>
          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->


 <!-- Sart Modal -->
    <div class="modal fade" id="eind" role="asd" aria-labelledby="eindLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <label class="">Editar Indicador</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="#" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="codind_e" name="codind_e" readonly>
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Indicador</label>
                        <textarea type="text" class="form-control" onkeypress="return validarEnter(event)" id="ind_e" name="ind_e" placeholder="descripcion"></textarea>
                      </div>
                    </div>
                  </div>                 
                  <hr class="hr"></hr>
                  <div class="float-right">
                      <a href="#" onclick="eind('<?=$proy->id_proyecto?>')" class="btn btn-primary">Guardar</a>
                    </div>
                </form>
          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->
     <!-- Sart Modal -->
    <div class="modal fade" id="nind" role="asd" aria-labelledby="nindLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <label class="">Nuevo Indicador</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="#" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="res_codd" name="res_codd" readonly>
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Indicador</label>
                        <textarea type="text" class="form-control" onkeypress="return validarEnter(event)" id="ind_r" name="ind_r" placeholder="descripcion"></textarea>
                      </div>
                    </div>
                  </div>                 
                  <hr class="hr"></hr>
                  <div class="float-right">
                      <a href="#" onclick="nind('<?=$proy->id_proyecto?>')" class="btn btn-primary">Guardar</a>
                    </div>
                </form>
          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->

             <!-- Sart Modal -->
    <div class="modal fade" id="elind" role="asd" aria-labelledby="elindLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <label class="">Eliminar Indicador</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="#" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="codind_el" name="codind_el" readonly>
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Indicador</label>
                        <textarea type="text" class="form-control" id="ind_el" name="ind_el" placeholder="descripcion"></textarea>
                      </div>
                    </div>
                  </div>                 
                  <hr class="hr"></hr>
                  <div class="float-right">
                      <a href="#" onclick="elind('<?=$proy->id_proyecto?>')" class="btn btn-primary">Guardar</a>
                    </div>
                </form>
          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->


    <!--accccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc-->

     <!-- Sart Modal -->
    <div class="modal fade" id="eact" role="asd" aria-labelledby="eactLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <label class="">Editar Actividad</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="#" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="ind_codigo_e" name="ind_codigo_e" readonly>
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Actividad</label>
                        <textarea type="text" class="form-control" onkeypress="return validarEnter(event)" id="act_i_e" name="act_i_e" placeholder="descripcion"></textarea>
                      </div>
                    </div>
                  </div>                 
                  <hr class="hr"></hr>
                  <div class="float-right">
                      <a href="#" onclick="eact('<?=$proy->id_proyecto?>')" class="btn btn-primary">Guardar</a>
                    </div>
                </form>
          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->
     <!-- Sart Modal -->
    <div class="modal fade" id="nact" role="asd" aria-labelledby="nactLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <label class="">Nueva Actividad de Marco l&oacute;gico</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="#" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="ind_codigo" name="ind_codigo" readonly>
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Actividad</label>
                        <textarea type="text" class="form-control" onkeypress="return validarEnter(event)" id="act_i" name="act_i" placeholder="descripcion"></textarea>
                      </div>
                    </div>
                  </div>                 
                  <hr class="hr"></hr>
                  <div class="float-right">
                      <a href="#" onclick="nact('<?=$proy->id_proyecto?>')" class="btn btn-primary">Guardar</a>
                    </div>
                </form>
          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->

             <!-- Sart Modal -->
    <div class="modal fade" id="elact" role="asd" aria-labelledby="elactLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <label class="">Eliminar Actividad</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="#" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" class="form-control" id="ind_codigo_el" name="ind_codigo_el" readonly>
                      </div>
                      <div class="form-group validate-input" data-validate="No se admite campo vacío">
                        <label>Actividad</label>
                        <textarea type="text" class="form-control" id="act_i_el" name="act_i_el" placeholder="descripcion"></textarea>
                      </div>
                    </div>
                  </div>                 
                  <hr class="hr"></hr>
                  <div class="float-right">
                      <a href="#" onclick="elact('<?=$proy->id_proyecto?>')" class="btn btn-primary">Guardar</a>
                    </div>
                </form>
          </div>
        </div>        
      </div>
    </div>
    <!--  End Modal -->
<!-- Sart Modal COMUNIDADESSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS-->

<!-- Sart Modal -->
    <div class="modal fade" id="ncomu" role="dialog" aria-labelledby="ncomuLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <label class="">Agregar comunidad</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="cdetalle_proyecto/ncom?id=<?=$proy->id_proyecto?>" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Comunidad</label>
                         <select id="sel-com" name="sel-com[]" class="form-control select-plantilla" multiple="multiple">
                              <?php
                               foreach ($comunidades->result() as $com) {
                                ?><option value="<?=$com->com_id?>"><?=$com->com_nom?> @ <?=$com->dep_des?></option><?php
                               }
                              ?>
                          </select>
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

    <!-- Sart Modal ORGANIZACIONESSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS-->

<!-- Sart Modal -->
    <div class="modal fade" id="norg" role="dialog" aria-labelledby="norgLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <label class="">Agregar Organizaci&oacute;n</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>            
          </div>
          <div class="modal-body">
              <form autocomplete="off" action="cdetalle_proyecto/norg?id=<?=$proy->id_proyecto?>" method="post">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Organizaci&oacute;n</label>
                         <select id="sel-org" name="sel-org[]" class="form-control select-plantilla" multiple="multiple">
                              <?php
                               foreach ($organizaciones->result() as $org) {
                                ?><option value="<?=$org->id_org?>"><?=$org->nombre_org?> @ <?=$org->descripcion?></option><?php
                               }
                              ?>
                          </select>
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
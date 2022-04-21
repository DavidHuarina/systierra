  <?php
  $i=0;
  echo "<script>var detalle=[],imagen_d=[];</script>";
  foreach ($detalle->result() as $det) {
     echo "<script>detalle[".$i."]='".$det->sub_nom."';</script>";
     echo "<script>imagen_d[".$i."]='imagenes/proyecto/AA.jpg';</script>";
    ?>
   <?php
    $i=$i+1;
   }
   $i=0;
  echo "<script>var tipo=[],imagen_a=[];</script>";
  foreach ($tipo->result() as $tip) {
     echo "<script>tipo[".$i."]='".$tip->tipo_nom."';</script>";
     echo "<script>imagen_a[".$i."]='imagenes/proyecto/t.jpg';</script>";
    ?>
   <?php
    $i=$i+1;
   }
  ?> 
   <div class="panel-header-sm bg-warning">
   </div>   
      <div class="content">
           <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title mb-4">Nueva actividad <small class="text-primary">/ <?=$proy->nombre_proyecto?></small>
                     <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a>
                  </h5>
                </div>
                <div class="card-body">
                  <form id="form_cb" autocomplete="off" action="cnueva_actividad/agregar?id=<?=$proy->id_proyecto?>&a=<?=$pa?>" class="validate-form" method="POST">
                  <div class="rounded titulos"><center><p class="text-md">Datos Generales</p></center></div><br>
                  <div class="row">
                    <div class="col-md-7 pr-1">
                      <div class="form-group validate-input" data-validate="Ingrese el nombre de la actividad">
                        <label>Nombre de la actividad</label>
                        <input type="text" id="det_a" name="det_a" class="form-control" placeholder="Ej. Taller de capacitacion" value="">
                      </div>
                    </div>
                    <input type="hidden" id="tipo_a" name="tipo_a" class="form-control" placeholder="Ej. Taller de capacitacion" value="">
                    <div class="col-md-5 pl-1">
                      <div class="form-group">
                          <label>Tipo de actividad</label>
                          <select id="sel-tipo" name="sel-tipo" class="form-control select-single-plantilla">
                              <?php
                               foreach ($tipo->result() as $com) {
                                ?><option value="<?=$com->tipo_id?>"><?=$com->tipo_nom?></option><?php
                               }
                              ?>
                          </select>
                         </div>
                    </div>
                  </div>
                  <div class="rounded titulos"><center><p class="text-md">Datos Espec&iacute;ficos</p></center></div><br>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group validate-input" data-validate="Ingrese una fecha">
                        <label>Fecha de la actividad</label>
                        <?php if($fa=="none"){
                          ?><input type="text" id="fi_p" name="fi_p"class="form-control" placeholder="Ej: dd/mm/aaaa" value=""><?php
                        }else{
                          ?><input type="text" id="fi_p" name="fi_p"class="form-control" placeholder="Ej: dd/mm/aaaa" value="<?=$fa?>"><?php
                        }?>
                        
                      </div>
                    </div>
                    <div class="col-md-3 pr-1">
                      <div class="form-group validate-input" data-validate="Ingrese una fecha">
                        <label>Fecha de Salida</label>
                        <?php if($fa=="none"){
                          ?><input type="text" id="fi_p_salida" name="fi_p_salida"class="form-control" placeholder="Ej: dd/mm/aaaa" value=""><?php
                        }else{
                          ?><input type="text" id="fi_p_salida" name="fi_p_salida"class="form-control" placeholder="Ej: dd/mm/aaaa" value="<?=$fa?>"><?php
                        }?>
                        
                      </div>
                    </div>
                    <div class="col-md-5 pr-1">
                      <div class="form-group validate-input" data-validate="Ingrese el tiempo de duracion">
                        <label>Duraci&oacute;n (d&iacute;as)</label>
                        <input type="text" id="dias" name="dias" class="form-control" placeholder="0" value="1">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 pr-1">
                     <div class="form-group validate-select" data-validate="Seleccione una actividad">
                        <label>Actividades de Marco l&oacute;gico</label>
                        <select id="select-act_ml" name="select-act_ml[]" class="form-control select-plantilla" multiple="multiple">
                              <option value="0">--Elija una Actividad--</option>
                              <?php
                               foreach ($act_ml->result() as $ml) {
                                ?><option value="<?=$ml->id_act_ml?>">Actividad: <?=$ml->ml_des?> / Obj. Esp.: <?=$ml->o_des?> / Resultado: <?=$ml->r_des?> / Indicador: <?=$ml->i_des?></option><?php
                               }
                              ?>
                        </select>
                      </div>
                    </div>
                  </div>
               <div class="rounded titulos"><center><p class="text-md">Ubicaci&oacute;n de la actividad</p></center></div><br>
                  <div id="radio_actividad" class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label class="cb-radio" onclick="displayBlock('optradio1','optradio2')"><input type="radio" value="1" name="optradio" id="optradio1" checked="checked">Comunidad</label>
                    
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label class="cb-radio" onclick="displayBlock('optradio2','optradio1')"><input type="radio" value="2" name="optradio" id="optradio2">Otra direccion</label>
    
                      </div>
                    </div>
                  </div>
                  <div class="container col-md-8"><center>
                        <div id="lista-com">
                         <div class="form-group">
                          <label>Lista de comunidades registradas al proyecto</label>
                          <select id="select-com" name="select-com" class="form-control select-single-plantilla">
                              <option value="0">--Elija una Comunidad--</option>
                              <?php
                               foreach ($comunidades->result() as $com) {
                                ?><option value="<?=$com->com_id?>"><?=$com->com_nom?> @ <?=$com->dep_des?></option><?php
                               }
                              ?>
                          </select>
                         </div>
                        </div>
                        <div id="otro-com" style="display:none">
                         <div class="form-group">
                          <label>Departamento</label><br>
                          <select id="select-dep-a" name="select-dep" class="form-control select-single-plantilla" onchange="cargarProvinciaA(this.value)">
                              <option value="0">--Elija un Departamento--</option>
                              <?php
                               foreach ($departamento->result() as $dep) {
                                ?><option value="<?=$dep->dep_id?>"><?=$dep->dep_des?></option><?php
                               }
                              ?>
                              <option value="100">EXTRANJERO</option>
                          </select>
                         </div>
                         <div id="div-lugar">
                         <div class="form-group">
                        <label>Provincia</label><br>
                        <select id="select-prov-a" name="select-prov" class="form-control select-single-plantilla" onchange="cargarMunicipioA(this.value)">
                            <option value="0">--Elija una Provincia--</option>
                            </select>
                         </div>
                         <div class="form-group">
                         <label>Municipio</label><br>
                         <select id="select-mun-a" name="select-mun" class="form-control select-single-plantilla">
                            <option value="-1">--Elija un Municipio--</option>
                            </select>
                         </div>
                       </div>
                       <div id="div-extranjero" style="display:none;">
                         <div class="form-group">
                         <label>Pa&iacute;s</label>
                         <input type="text" id="dir_otro_pais" name="dir_otro_pais" class="form-control" placeholder="Ingrese el País" value="">
                         </div>
                         <div class="form-group">
                         <label>Ciudad</label>
                         <input type="text" id="dir_otro_ciudad" name="dir_otro_ciudad" class="form-control" placeholder="Ciudad" value="">
                         </div>
                       </div>
                         <div class="form-group">
                         <label>Direcci&oacute;n</label>
                         <input type="text" id="dir_otro" name="dir_otro" class="form-control" placeholder="Dirección de Zona y/o Barrio..." value="">
                         </div>
                        </div>   
                  </center></div>
                  <div class="float-right">
                      <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                  </form>
              </div>
            </div>
        </div><!-- fin panel-->
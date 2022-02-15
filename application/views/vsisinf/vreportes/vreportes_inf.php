<div class="panel-header-sm bg-info">
</div>
 <div class="content"><!--principio de Panel-->
          <div class="row">
               <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Reportes
                    <img class="icon-sm" src="apps/full-icon/flat/iconos-sys/pie-chart-1.png"></h5>
                </div>
               </div> 
           </div>          
           <div class="row">
              <div class="card">
                <div class="card-body">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="ubic-tab" data-toggle="tab" href="#ubic" role="tab" aria-controls="ubic" aria-selected="true"><img class="icon-sm" src="apps/full-icon/flat/iconos-sys/network.png"> <label class="text-info">Ubicacion</label></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><img class="icon-sm" src="apps/full-icon/flat/iconos-sys/network.png"> <label class="text-info">Proyectos</label></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><img class="icon-sm" src="apps/full-icon/flat/iconos-sys/blueprint.png"> <label class="text-info">Actividades</label></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><img class="icon-sm" src="apps/full-icon/flat/iconos-sys/inbox-1.png"> <label class="text-info">Informe T&eacute;cnico</label></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="repor-tab" data-toggle="tab" href="#reportab" role="tab" aria-controls="reportab" aria-selected="false"><img class="icon-sm" src="apps/full-icon/flat/iconos-sys/note.png"> <label class="text-info">Ver el reporte</label></a>
                    </li>
                  </ul>
                  <form  action="creportes/generarPDF" method="POST">
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="ubic" role="tabpanel" aria-labelledby="ubic-tab">
                      <div class="container-fluid">
                          <div class="rounded titulos"><center><p class="text-md">Ubicacion</p></center></div><br>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                      <div class="container-fluid">
                          <div class="rounded titulos"><center><p class="text-md">Proyectos</p></center></div><br>
                          <div id="proy_cb" class="proyectos">
                          <?php 
                          $cc=0;
                          foreach ($proyecto->result() as $proy) {
                            $cc++;
                            if($proy==null){
                             ?><label>No Hay Ningun Proyecto Disponible</label><br><?php
                            }else
                            {
                              ?>
                             <label class="cb-checkbox">
                              <table>
                               <tr>
                                 <td valign="top"><input class="form-check-input" type="checkbox" id="rep_proy_<?=$cc?>" name="proy[]" value="<?=$proy->id_proyecto?>" checked="checked"></td>
                                 <td valign="top"><label><?=$proy->nombre_proyecto?></label></td>
                               </tr>
                              </table>
                             </label><hr>
                              <?php
                            }
                          }?>
                          </div>
                          <hr>
                          <div class="float-right">
                            <a class="btn btn-primary" data-toggle="tab" href="#" onclick="activaTab('profile')">Siguiente</a>            
                          </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <div class="rounded titulos"><center><p class="text-md">Fecha de la actividad</p></center></div><br>
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-3 pr-1">
                          <div class="form-group validate-input" data-validate="Ingrese una fecha">
                            <label>Desde</label>
                             <input type="text" id="fi_p" name="fi_p"class="form-control" placeholder="Ej: dd/mm/aaaa" value="">    
                          </div>
                        </div>
                        <div class="col-md-3 pr-1">
                          <div class="form-group validate-input" data-validate="Ingrese una fecha">
                            <label>Hasta</label>
                            <input type="text" id="ff_p" name="ff_p"class="form-control" placeholder="Ej: dd/mm/aaaa" value="">
                          </div>
                        </div>
                        <div class="col-md-3"></div>
                      </div>
                      <div class="rounded titulos"><center><p class="text-md">Tipo de actividad</p></center></div><br>    
                      <div class="row">
                        <div class="container-fluid medio example1"><br>
                          <div class="">
                            <label class="cb-checkbox" id="todos_tipo">
                            <table>
                              <tr>
                              <td valign="top"><input type="checkbox" name="todos_tipo" value="1" checked="checked"></td>
                               <td valign="top"><label class="" for="">Todo</label></td>
                              </tr>
                            </table>
                          </label>
                          </div><hr>
                          <?php 
                          $cont=0;
                           foreach ($tipo->result() as $tip) {
                            ?>
                          <div class="checkbox-row">
                            <label class="cb-checkbox">
                            <table>
                              <tr>
                              <td valign="top"><input class="" type="checkbox" id="tipo<?=$cont?>" name="tipo[]" value="<?=$tip->tipo_id?>" checked="checked"></td>
                               <td valign="top"><label class="" for=""><?=$tip->tipo_nom?></label></td>
                              </tr>
                            </table>
                          </label><hr>
                          </div>
                          
                            <?php
                           $cont++;
                           }
                          ?>
                        </div>
                      </div> 
                      <hr>
                      <div class="float-right">
                            <a class="btn btn-primary" data-toggle="tab" href="#" onclick="activaTab('contact')">Siguiente</a>            
                      </div>
                      <div class="float-left">
                            <a class="btn btn-secondary" data-toggle="tab" href="#" onclick="activaTab('home')">Anterior</a>            
                      </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                      <div class="rounded titulos"><center><p class="text-md">Datos del Informe Tecnico</p></center></div><br>
                      <div class="row">
                        <div class="col-md-6">
                         <div class="form-group">
                          <label>Responsable</label>
                            <select id="sel_resp"  data-placeholder="Seleccione una persona" class="form-control select-plantilla">
                              <option value="-1">Todos</option>
                              <?php foreach ($personasMe->result() as $per) {
                                 ?><option value="<?=$per->id_persona?>"><?=$per->nombre_persona?> <?=$per->apellido_persona?></option><?php 
                              }?>
                            </select>
                         </div>
                        </div>
                        
                        <div class="col-md-6 examplePar">
                          <label class="cb-checkbox" id="todos_par">
                            <table>
                              <tr>
                              <td valign="top"><input type="checkbox" name="todos_par" value="1" checked="checked"></td>
                               <td valign="top"><label class="" for="">Todo</label></td>
                              </tr>
                            </table>
                          </label>
                          <?php 
                          $part=0;
                           foreach ($participante->result() as $par) {
                            ?>
                            <div class="checkbox-row">
                          <label class="cb-checkbox">
                            <table>
                              <tr>
                              <td valign="top"><input class="" name="parti[]" type="checkbox" id="tipo<?=$part?>" value="<?=$par->id_tipopar?>" checked="checked"></td>
                               <td valign="top"><label class="" for=""><?=$par->nombre_tipopar?></label></td>
                              </tr>
                            </table>
                          </label>
                        </div>
                            <?php
                           $part++;
                           }
                          ?>
                        </div>
                      </div>
                      <hr>
                      <div class="float-right">
                            <a class="btn btn-primary" data-toggle="tab" href="#" onclick="activaTab('reportab')">Siguiente</a>            
                      </div>
                      <div class="float-left">
                            <a class="btn btn-secondary" data-toggle="tab" href="#" onclick="activaTab('profile')">Anterior</a>            
                      </div>
                    </div>
                     <div class="tab-pane fade" id="reportab" role="tabpanel" aria-labelledby="repor-tab">

                         
                           
                       
                    </div>
                  </div>
                 </form> 
                        <div class=""><br><br><center>
                            <a href="#" onclick="generarReporte()" class="btn btn-info btn-lg"><i class="now-ui-icons business_chart-pie-36"></i> Obtener Reporte</a></center>
                         </div><hr>
                         <div class="row container-fluid">
                          <button id="btn-reportes" type="submit" onclick="cargaCookie('PDF')" class="btn btn-primary" style="display:none">Exportar a PDF</button>
                         <button id="btn-reportes-excel" onclick="cargaCookie('EXCEL')" class="btn btn-warning" style="display:none">Exportar a Excel</button>
                         </div>
                         <div id="mensaje"></div>
                </div>               
               </div>
           </div>
            
<!-- fin panel-->
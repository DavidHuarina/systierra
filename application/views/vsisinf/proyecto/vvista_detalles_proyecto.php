<div class="content-wrapper">
          <div class="row">
           <div class="col-md-9 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><i class="mdi mdi-layers text-success mdi-24px"></i> <?=$proyecto->nombre_proyecto?></h4>
                  <hr class="hr">
                  <p class="text-gray">Tiempo de duraci&oacute;n: <?php
                  $f1=new DateTime($proyecto->fecha_inicio);
                  $f2=new DateTime($proyecto->fecha_fin);
                  $diff = $f1->diff($f2);
                  if((string)$diff->days=='1'){
                    echo $diff->days .' dia calendario';
                  }else{
                  echo $diff->days .' dias calendario';
                   }                           
                 ?></p>
                          <div class="col-12 d-flex">
                            <small class="mb-0 mr-2 text-muted text-gray">Inicio:</small>
                            <small class="Last-responded mr-2 mb-0 text-gray"><?=strftime('%d de %B de %Y',strtotime($proyecto->fecha_inicio))?></small>
                          </div>
                          <div class="col-12 d-flex">
                            <small class="mb-0 mr-2 text-muted text-gray">Fin:</small>
                            <small class="Last-responded mr-2 mb-0 text-gray"><?=strftime('%d de %B de %Y',strtotime($proyecto->fecha_fin))?></small>
                          </div>
                   <div class="subt-proyecto">
                      <h6 class="card-title">Objetivo General</h6>
                   </div>
                   <button class="btn btn-primary btn-sm" onclick="mostrarElemento('obj-g');"><i class="fa fa-plus"></i>Agregar</button>
                   <div id="obj-g" class="form-group d-none">
                    <textarea class="form-control" rows="12" id="obj-g-text"></textarea>
                  </div>
                   <p class="text-gray">Aqui va a describir el objetivo general del proyecto.</p>
                   <div class="subt-proyecto">
                      <h6 class="card-title">Objetivos Especificos</h6>
                      
                   </div>
                   <p class="text-gray">Aqui van a describir los objetivos especificos del proyecto.</p>
                   <button class="btn btn-success btn-sm" onclick="mostrarElemento('obj-e');"><i class="fa fa-plus"></i>Agregar</button>
                   <div id="obj-e" class="form-group d-none">
                    <textarea class="form-control" rows="12" id="obj-e-text"></textarea>
                  </div>
                </div>
              </div>
              <!--Detalle de ultima actividad-->
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><i class="mdi mdi-calendar-check text-primary mdi-24px"></i> Ultima Actividad</h4>
                  <hr class="hr">
                   loading...
                </div>
              </div>   
            </div>
            <div class="col-md-3 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><i class="mdi mdi-view-list text-danger mdi-24px"></i> Detalles</h4>
                  <hr class="hr">
                   <div class="wrapper">
                    <div class="d-flex justify-content-between">
                      <p class="mb-2 text-dark">En progreso</p>
                      <p class="mb-2 text-gray">79%</p>
                    </div>
                    <div class="progress mb-4">
                      <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: 79%" aria-valuenow="88"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="wrapper d-flex justify-content-between">
                    <div class="side-left">
                      <p class="mb-2">Presupuesto</p>
                      <p class="display-3 mb-4 font-weight-light">45,500</p>
                    </div>
                    <div class="side-right">
                      <small class="text-muted">Bs</small>
                    </div>
                  </div>
                  <div class="wrapper d-flex justify-content-between">
                    <div class="side-left">
                      <p class="mb-2">Costo</p>
                      <p class="display-3 mb-5 font-weight-light">35,700</p>
                    </div>
                    <div class="side-right">
                      <small class="text-muted">Bs</small>
                    </div>
                  </div>
                  <div class="wrapper d-flex justify-content-between">
                    <div class="side-left">
                      <p class="mb-2">Actividades</p>
                      <p class="display-3 mb-5 font-weight-light">23</p>
                    </div>
                    <div class="side-right">
                      <small class="text-muted">2019</small>
                    </div>
                  </div>
                  <a class="btn btn-secondary" href="#">Ver detalles de costos</a>
                </div>
               </div>
             </div>
         </div>        
</div><!-- fin panel-->
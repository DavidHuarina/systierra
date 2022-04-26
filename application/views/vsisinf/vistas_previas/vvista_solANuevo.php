


<?php 
  $recep=$this->solicitud->getAllReceptor($sol);
  $soli=$this->solicitud->getAllSolicitante($sol);

  $proy_id=$_GET['id'];
  $actividad_id=$_GET['ac'];
  $solicitud_id=$_GET['sol'];
?>
<div class="panel-header-sm bg-info">
</div>
   <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Solicitud Fondos <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a>
                  <img class='icon-lg float-right' src='images/logo.png' alt='Sin imagen'></h5>
                <p class="category">SOLICITUD DE FONDOS EN AVANCE
                  <a href="#">Formulario N° 2</a>
                </p>

              </div>
              <div class="card-body">
                <!-- <table>
                         <tr><td><label>Solicitado por:</label></td><td><label class="text-lg text-dark"><?=$soli->nombre_persona?> <?=$soli->apellido_persona?></label></td></tr>
                         <tr><td><label>Dirigida a:</label></td><td><label class="text-lg text-dark"><?=$recep->nombre_persona?> <?=$recep->apellido_persona?></label></td></tr>
                    </table>
                      <div class="row text-gray d-md-flex d-none">
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Inici&oacute; el:</small>
                            <small class="Last-responded mr-2 mb-0 text-muted"><?=strftime('%d de %B de %Y',strtotime($actividad->act_fecha))?></small>
                          </div>
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Duraci&oacute;n:</small>
                            <small class="Last-responded mr-2 mb-0 text-muted"><?php if($actividad->act_dias==1){ echo $actividad->act_dias." día";}else{ echo $actividad->act_dias." días";}?></small>
                          </div>
                        </div> 
                    <hr>
                    <label>Solicita a la Gerencia Nacional de la Fundación TIERRA, autorice el desembolso de fondos en avance para la realización de las siguientes actividades</label>
<?php $porciones = explode("@", $actividad->sub_nom);?>
                    <p class="title text-primary text-center">
                          <?=$porciones[0]?></p>

                      <label>Se solicita en monto de (Bs):</label> 
                      <?php $totalsol=0;$item=0;
                     foreach ($sm->result() as $sum) {
                      $totalsol=$sum->monto+$totalsol;
                      }
                      ?>
                      <h4 class="title text-success text-center">
                          <?=number_format($totalsol, 2, '.', ',');?></small></h4> 
                      <hr> -->
                      <div class="table-responsive-sm">
                    <!-- <table id="null" class="table">
                           <thead>
                           <tr class="bg-celeste text-small">
                             <th>
                               <b class="text-white"><small>Nro<small></b>
                            </th>
                             <th>
                                <b class="text-white"><small>Item<small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Descripcion / Detalle<small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Monto (Bs)<small></b>
                             </th>
                           </tr>
                           </thead>
                            <tbody>
                    <?php
                    foreach ($sm->result() as $sum) {
                      $item++;
                      ?>
                      <tr class="text-small">
                        <td><?=$item?></td>
                         <td><?php $porciones = explode("@", $sum->descrip);?> <?=$porciones[0]?> / <?=$porciones[1]?></td>
                         <td><?=$sum->descripcionobs?></td>
                         <td class="text-right"><?=number_format($sum->monto, 2, '.', ',');?></td>
                      </tr>
                      <?php
                    }
                    ?>
                    <tr>
                        <td><b>Total</b></td>
                         <td></td>
                         <td><b><?=number_format($totalsol, 2, '.', ',');?></b></td>
                      </tr>
                    </tbody>
                   </table> -->  
                   <iframe src="cvista_solA/descargar/<?=$proy_id?>/<?=$actividad_id?>/<?=$solicitud_id?>/1" style="width:100%;border: none;height:600px"></iframe>
                  </div>
                      <div class="float-right">
                      <a href="javascript:history.back(-1);" class="btn btn-danger">Ok</a>
                    </div>
                    <div class="float-right">
                      <a href="cvista_solA/descargar/<?=$proy->id_proyecto?>/<?=$actividad->act_id?>/<?=$sol?>" class="btn btn-secondary"><i class="now-ui-icons arrows-1_cloud-download-93"></i> Descargar</a>
                    </div>
                       
              </div>
            </div>
          </div>
        </div>
      </div>

      
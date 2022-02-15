<?php
 if($actividad->id_estado!=2){
  redirect('home');
 }
  $i=0;
  echo "<script>var subrubro=[],imagen_s=[];</script>";
  foreach ($subru->result() as $sr) {
     echo "<script>subrubro[".$i."]='".$sr->descripcion."';</script>";
     echo "<script>imagen_s[".$i."]='imagenes/proyecto/s.png';</script>";
    ?>
   <?php
    $i=$i+1;
   }
   $i=0;
  echo "<script>var rubro=[],imagen_r=[];</script>";
  foreach ($ru->result() as $r) {
     echo "<script>rubro[".$i."]='".$r->descripcion."';</script>";
     echo "<script>imagen_r[".$i."]='imagenes/proyecto/r.jpg';</script>";
    ?>
   <?php
    $i=$i+1;
   }
  ?>
<?php $ninguno=0;
                     foreach ($sm->result() as $sum) {
                      $ninguno=$ninguno+1;
                      }
                      ?>
<div class="panel-header-sm bg-warning">
</div>
<div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><i class='now-ui-icons business_money-coins text-success'></i> Solicitud de fondos / actividad <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a>
                </h5>
                
              </div>
              <div class="card-body">
                <form autocomplete="off" action="cenviar_solicitud/act_sol?id=<?=$actividad->act_id?>&idp=<?=$proy->id_proyecto?>&sol=<?=$sol?>" class="validate-form" method="post">
                  <div class="row">
                    <div class="col-md-3 pr-1">
                      <div class="form-group">
                        <!--<label>Codigo de Proyecto</label>-->
                        <input type="hidden" class="form-control" disabled="" placeholder="id" value="<?=$proy->id_proyecto?>">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <!--<label>Codigo de Fondo</label>-->
                        <input type="hidden" class="form-control" name="cod_fondo" id="cod_fondo"  placeholder="id" value="<?=$fondo->id_proy_ep?>">
                      </div>
                    </div>
                    <div class="col-md-5 pl-1">
                      <div class="form-group">
                        <!--<label>Codigo subrubro</label>-->
                        <input type="hidden" name="cod_sr" id="cod_sr" class="form-control" readonly="readonly" placeholder="0000-000" value="00000">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group validate-input" data-validate="Ingrese un subrubro">
                        <label>Sub rubro</label>
                        <input type="text" id="sub_rubro" name="sub_rubro" class="form-control" placeholder="" value="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Rubro</label>
                        <input type="text" id="rubro" name="rubro" class="form-control" placeholder="" value="" readonly>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group validate-input" data-validate="Ingrese un monto">
                        <label>Monto solicitado Bs (0000.00)</label>
                        <input type="text" onkeypress="return validarMontoSup(event)" id="monto" name="monto" class="form-control" placeholder="" value="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Detalle / Descripci&oacute;n</label>
                        <textarea class="form-control texta-lg" id="des" name="des" placeholder="Breve detalle..."></textarea>
                      </div>
                    </div>
                  </div>
                  <hr class="hr"></hr>
                  <?php if($ninguno!=0){
                   ?>
                   <div class="float-left">
                      <a href="#" data-toggle="modal" data-target="#solmod" class="btn btn-info">Finalizar Solicitud</a>
                  </div>
                   <?php
                  }?>
                  <div class="float-right">
                      <a href="cvista_solA?ac=<?=$actividad->act_id?>&id=<?=$proy->id_proyecto?>&sol=<?=$sol?>" class="btn btn-secondary">Vista previa</a>
                    </div>
                  <div class="float-right">
                      <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <img src="apps/assets/img/money.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="apps/full-icon/flat/negocio/change.png" alt="images">
                    <h5 class="title">Sol. para <?php $porciones = explode("@", $actividad->sub_nom);?>
                          <?=$porciones[0]?></h5>
                  </a>
                  <?php 
                   $recep=$this->solicitud->getAllReceptor($sol);
                   $soli=$this->solicitud->getAllSolicitante($sol);
                  ?>
                  <p class="text-center text-info">Dirigida a: <small class="text-muted"><?=$recep->nombre_persona?> <?=$recep->apellido_persona?></small></p>
                  <p class="text-center text-primary">De: <small class="text-muted"><?=$soli->nombre_persona?> <?=$soli->apellido_persona?></small></p>
                  <p class="text-muted text-center">
                  <b class="text-primary">Proyecto:</b> " <?=$proy->nombre_proyecto?> "
                </p>
                 <!-- <p class="descripcion">Descripci&oacute;n</p>
                  <textarea class="form-control texta-lg" readonly><?=$actividad->descripcion?></textarea>-->
                </div>
                
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <?php $totalsol=0;$numro=0;
                     foreach ($sm->result() as $sum) {

                      $totalsol=$sum->monto+$totalsol;
                      }
                      ?>
                <h5 class="card-title"> Solicitud <small class="text-primary"><?=number_format($totalsol, 2, '.', ',');?></small><label for="" class="text-primary"></label> <small class="text-muted">Bs</small></h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table text-small">
                    <thead class="bg-plomo text-white">
                      <th>
                        Nro
                      </th>
                      <th>
                        Descripci&oacute;n
                      </th>
                      <th>
                        Detalle
                      </th>
                      <th>
                        Partida
                      </th>
                      <th class="text-right text-warning">
                        Monto
                      </th>
                      <th class="text-right">
                        Quitar
                      </th>
                    </thead>
                    <tbody>
                      <?php
                     foreach ($sm->result() as $sum) {
                      $numro++;
                      ?>
                       <tr>
                        <td>
                          <?=/*$sum->id_sol_act*/$numro?>
                        </td>
                        <td WIDTH="30%">
                          <?=$sum->descripcionobs?>
                        </td>
                        <td>
                          <?php $porciones = explode("@", $sum->descrip);?>
                          <?=$porciones[0]?>
                        </td>
                        <td>
                          <?=$sum->descripcionr?>
                        </td>
                        <td class="text-right">
                          <small class="text-dark">Bs.</small> <?=$sum->monto?>
                        </td>
                        <td class="text-right"><a class="" href="cenviar_solicitud/quitarSol?id=<?=$actividad->act_id?>&idp=<?=$proy->id_proyecto?>&sol=<?=$sol?>&s=<?=$sum->id_solm?>">
                              <i class="fa fa-times text-danger fa-fw"></i></a></td>
                      </tr> 
                      <?php
                     }
                      ?>
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

      </div>

      
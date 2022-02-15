<?php
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
<?php
                 $ninguno=0;
                     foreach ($ep->result() as $pr) {
                      $ninguno=$ninguno+1;
                      }
                      ?>
<div class="panel-header">
        <div class="header text-center">
          <h2 class="title"><?=$proy->nombre_proyecto?></h2>
          <p class="category"><?php if($proy->resumen==""){ echo "Sin descripción";}else{ echo "".$proy->resumen."";}?>

          </p>
        </div>
    </div>
<div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title"><i class='now-ui-icons business_money-coins text-success'></i> Presupuesto <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a>
                </h5>
                <?php if($cambioMon!=null){
                    ?>
                    
                    <center><label>1 <?=$cambioMon->moneda?> (<?=$cambioMon->unidad_mon?>) equivale a:</label> <p class="text-lg"><?=$cambioMon->valor?> <small>Bs</small></p></center><?php
                  }?>
              </div>
              <div class="card-body">
                <form autocomplete="off" action="cpresupuesto_proy/agregarP?id=<?=$proy->id_proyecto?>&f=<?=$fondos->id_proy_ep?>" class="validate-form" method="post">
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <label>Tipo de Cambio</label>
                      <div class="form-group">                    
                         <select id="select-bs" name="select-bs" onchange="window.location.href='cfondo_proy?id=<?=$proy->id_proyecto?>&c='+this.value" class="select-single-plantilla">
                            <option value="0">BOLIVIANOS</option>
                            <?php 
                            foreach ($cambio->result() as $cam) {
                              if($cambioMon->id_cambio==$cam->id_cambio){
                              ?><option value="<?=$cam->id_cambio?>" selected><?=$cam->pais?> - <?=$cam->moneda?></option><?php
                              }else{
                               ?><option value="<?=$cam->id_cambio?>"><?=$cam->pais?> - <?=$cam->moneda?></option><?php
                              }
                             
                            }
                            ?>
                            </select>
                        </div>    
                   </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group validate-input" data-validate="Ingrese un subrubro">
                        <label>Sub rubro / descripcion</label>
                        <input type="text" id="sub_rubro" name="sub_rubro" class="form-control" placeholder="" value="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group validate-input" data-validate="Ingrese un rubro">
                        <label>Rubro</label>
                        <input type="text" id="rubro" name="rubro" class="form-control" placeholder="" value="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group validate-input" data-validate="Ingrese un subrubro">
                        <label>Sub rubro Codigo</label>
                        <input type="text" onkeypress="return validarNumero(event)" id="c_sub_rubro" name="c_sub_rubro" class="form-control" placeholder="" value="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group validate-input" data-validate="Ingrese un rubro">
                        <label>Rubro Codigo</label>
                        <input type="text" onkeypress="return validarNumero(event)" id="c_rubro" name="c_rubro" class="form-control" placeholder="" value="">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group validate-input" data-validate="Ingrese un monto">
                        <label>Monto original <?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?></label>
                        <input type="text" onkeypress="return validarMontoSup(event)" id="monto" name="monto" class="form-control" placeholder="" value="">
                      </div>
                    </div>
        
                  </div>
                  <hr class="hr"></hr>
                  <?php
                       if($ninguno!=0){
                     ?>
                     <div class="float-left">
                      <a href="cpresupuesto_proy/fin?id=<?=$proy->id_proyecto?>" class="btn btn-info">Finalizar Presupuesto</a>
                  </div>
                     <?php
                       }
                      ?>
                  
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
                <img src="apps/assets/img/f_1.jpg" alt="...">
              </div>
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <img class="avatar border-gray" src="imagenes/proyecto/p.jpg" alt="images">
                    <h5 class="title"><?=$proy->nombre_proyecto?></h5>
                  </a>
                  <p class="description">
                    <?=$proy->id_proyecto?>
                  </p>
                </div>
                <p class="description text-center">
                  " <?=$proy->resumen?> "
                </p>
                <a href="cdetalle_proyecto?id=<?=$proy->id_proyecto?>" class="btn btn-warning">
                Ver detalles del proyecto
              </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                 <?php
                 $totalep=0;
                     foreach ($ep->result() as $pr) {
                      $totalep=$pr->original+$totalep;
                      }
                      ?>
                <h5 class="card-title"> Ejecuci&oacute;n Presupuestaria <label for="" class="text-primary"><?=number_format($totalep, 2, '.', ',');?></label> <small class="text-muted"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?></small></h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table text-small">
                    <thead class="bg-plomo text-white">
                      <th>
                        Codigo
                      </th>
                      <th>
                        Descripci&oacute;n
                      </th>
                      <th>
                        Rubro
                      </th>
                      <th class="text-right">
                        Monto
                      </th>
                      <th class="text-right">
                        Quitar
                      </th>
                    </thead>
                    <tbody>
                      <?php
                     foreach ($ep->result() as $pr) {
                      ?>
                       <tr>
                        <td>
                          <b><?=$pr->codigo?></b>
                        </td>
                        <td>
                          <?php $porciones = explode("@", $pr->descripcion);?>
                          <?=$porciones[0]?>
                        </td>
                        <td>
                          <?=$pr->descripcionr?>
                        </td>
                        <td class="text-right">
                          <small class="text-dark"><?php if($cambioMon==null){ echo "Bs";}else{ echo $cambioMon->moneda;}?>.</small> <?=number_format($pr->original, 2, '.', ',');?>
                        </td>
                        <td class="text-right"><a class="" href="cpresupuesto_proy/quitarEP?idep=<?=$pr->id_ep?>&id=<?=$proy->id_proyecto?>">
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

      
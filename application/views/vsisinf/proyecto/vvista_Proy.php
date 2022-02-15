
<div class="panel-header-sm bg-celesverde">
</div>
<div class="content">
        <div class="row">
            <div class="card">
              <div class="card-header">
               <h5>Datos Generales<a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a></h5>
              </div>
              <div class="card-body">
                <p class="text-muted"><?=$proy->nombre_proyecto?></p>
                <div class="dropdown float-right">
                   <a class="btn btn-secondary btn-simple dropdown-toggle" href="#" id="expo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <img class="" src="apps/full-icon/flat/oficina/usb.png" width="16" height="16"> Exportar
                   </a>
                   <div class="dropdown-menu dropdown-menu-left" aria-labelledby="expo">
                     <a href="cvista_Proy/exportar/<?=$proy->id_proyecto?>"class="dropdown-item"><img class="" src="apps/full-icon/flat/documentos/pdf-5.png" width="16" height="16"> PDF</a>
                   </div>
                 </div>
              </div>
            </div>     
        </div>
        <div class="row">
          <div class="card">
            <div class="card-header">
              Objetivo General
            </div>
            <div class="card-body">
              <p class="text-muted"><?=$proy->obj_gen?></p>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              Objetivos Especificos
            </div>
            <div class="card-body">
              <?php $numo=1;
                        foreach ($obes->result() as $ob) {
                          $nresultados=$this->resultados->getNresultados($ob->id_obe);
                        ?><p class="text-primary"><small class=""><?=$numo?>.- </small><?=$ob->descripcion?></p>
                        <div class="container-fluid">
                          <p>Indicador del Objetivo</p>
                         <p class="text-muted"><?=$ob->indicador?></p>
                         <div class="container-fluid">
                          <p>Resultado</p>
                          <?php 
                           $resultado=$this->resultados->getByIdObe($ob->id_obe);
                           $nress=1;
                          foreach ($resultado->result() as $ress) {
                            ?>
                             <p class="text-info"><small class=""><?=$nress?>.- </small><?=$ress->descripcion?></p>
                             <div class="container-fluid">
                              <p>Indicador de resultado</p>
                            <?php 
                            $indicador=$this->indicador->getByIdResult($ress->id_result);
                            $nindd=1;
                            foreach ($indicador->result() as $indd) {
                              ?><p class="text-naranja"><small class=""><?=$nindd?>.- </small><?=$indd->descripcion?></p>
                                 <div class="container-fluid">
                                    <p>Actividades de Marco L&oacute;gico</p>
                              <?php
                              $actividadesML=$this->act_ml->getByIdInd($indd->id_ind);
                              $nactml=1;
                              foreach ($actividadesML->result() as $actml) {
                                 ?><p class="text-muted"><small class=""><?=$nactml?>.- </small><?=$actml->descripcion?></p>
                              <?php
                              $nactml=$nactml+1;
                            }
                              ?></div><?php
                            $nindd=$nindd+1;
                          } ?></div><?php                          
                          $nress=$nress+1;
                        }?>
                        </div>
                         </div>
                        <?php  
                        ?>
              <?php $numo=$numo+1; } ?>            
          </div>
        </div>
</div>
      
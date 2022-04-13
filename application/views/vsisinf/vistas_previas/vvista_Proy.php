<html>
  <head>

  <!-- CSS Files -->
  <link rel="stylesheet" href="apps/dompdf.css">
  <link href="apps/css/micss.css" rel="stylesheet" />
  </head>

<body>

  <header>            
      <img class="imagen-logo" src="images/logo.png">
 </header>


  <footer>
  <center><label id="footer_texto">La Paz,  <?=strftime('%d de %B de %Y',time())?></label></center><!--<img class="logo-pie" src="imagenes/logo_tierra1.png">-->   
  </footer>
<div id="header_titulo_texto" style="width:85% !important">TIERRA<br>
  "<?=$proy->nombre_proyecto?>"<br> DATOS GENERALES DEL PROYECTO 
</div>
<div class="content">
        <div class="row">
          <div class="card">
            <div class="card-header">
              Objetivo General
            </div>
            <div class="card-body">
              <p class=""><?=$proy->obj_gen?></p>
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
                        <div class="cont">
                          <p>Indicador del Objetivo</p>
                         <p class=""><?=$ob->indicador?></p>
                         <div class="cont">
                          <p>Resultado</p>
                          <?php 
                           $resultado=$this->resultados->getByIdObe($ob->id_obe);
                           $nress=1;
                          foreach ($resultado->result() as $ress) {
                            ?>
                             <p class="text-info"><small class=""><?=$nress?>.- </small><?=$ress->descripcion?></p>
                             <div class="cont">
                              <p>Indicador de resultado</p>
                            <?php 
                            $indicador=$this->indicador->getByIdResult($ress->id_result);
                            $nindd=1;
                            foreach ($indicador->result() as $indd) {
                              ?><p class="text-naranja"><small class=""><?=$nindd?>.- </small><?=$indd->descripcion?></p>
                                 <div class="cont">
                                    <p>Actividades de Marco L&oacute;gico</p>
                              <?php
                              $actividadesML=$this->act_ml->getByIdInd($indd->id_ind);
                              $nactml=1;
                              foreach ($actividadesML->result() as $actml) {
                                 ?><p class=""><small class=""><?=$nactml?>.- </small><?=$actml->descripcion?></p>
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
</body>
</html>      
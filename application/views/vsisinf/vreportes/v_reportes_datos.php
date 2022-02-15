           <div class="row">
               <div class="card">
                <div class="card-body">
                  <div class="row container-fluid">
                    <div class="col-md-7">
                       <table class="table text-small table-bordered">
                        <tr><td colspan="4" align="center"><h5><b>Datos del Reporte</b></h5></td></tr>
                          <tr><td><b>Proyectos</b></td><td><?=$nreg?></td><td colspan="2"><?php foreach ($proy->result() as $pro) {
                            echo "- ".$pro->nombre_proyecto."<br><br>";
                          }?></td></tr> 
                          <tr><td><b>Actividades</b></td><td><?=$nact?></td><td><b>Fechas</b></td><td>
                           <?php if($desde!=""&&$hasta!=""){
                               //echo strftime('%d de %B de %Y',strtotime($desde))." - ".echo strftime('%d de %B de %Y',strtotime($hasta));
                                 echo $desde." - ".$hasta;
                           }else{
                               echo "Sin fecha definida";
                           }?>
                          </td></tr>    
                        </table>
                    </div>
                    <div id="parti_div" class="col-md-5">
                     <canvas id="chart-uno" class="repo-canvas"></canvas>
                    </div>   
                    
                  </div>
                  <hr>
                  <div class="row container-fluid">
                     <div class="col-md-4 bg-primary text-white grow">
                       <center><h5>Actividades</h5></center>
                       <hr>
                       <table class="table text-small text-white">
                          <tr><td><b>Tipo</b></td><td><b>N.</b></td></tr> 
                          <?php 
                          $sumtt=0;
                          for ($i=0; $i < count($tt) ; $i++) {
                          $tipoAct=$this->tipoact->getById($i+1); 
                            if($tt[$i]!=0){
                              $sumtt=$sumtt+$tt[$i];
                              ?>
                             <tr><td><?=$tipoAct->tipo_nom?></td><td><?=$tt[$i]?></td></tr>
                            <?php
                            }
                          }
                          ?> 
                          <tr><td><b>Total</b></td><td><b><?=$sumtt?></b></td></tr>    
                        </table>
                     </div>
                     <div class="col-md-8 bg-amarillo text-white grow">
                        <center><h5>Participantes</h5></center>
                        <hr>
                        <table class="table text-small text-white">
                          <tr><td><b>Descripci&oacute;n</b></td><td><b>Hombres</b></td><td><b>Mujeres</b></td><td><b>Total</b></td></tr>   
                          <?php 
                          $tth=0;$ttm=0;
                          for ($i=0; $i < count($parti) ; $i++) {
                          $tipop=$this->parti->getTipo($parti[$i]);
                          $tth=$tth+$ph[$tipop->id_tipopar-1];
                          $ttm=$ttm+$pm[$tipop->id_tipopar-1];
                             ?><tr><td><?=$tipop->nombre_tipopar?></td><td><?=$ph[$tipop->id_tipopar-1]?></td><td><?=$pm[$tipop->id_tipopar-1]?></td><td><?=$ph[$tipop->id_tipopar-1]+$pm[$tipop->id_tipopar-1]?></td></tr><?php
                            
                            }
                             
                             ?> 
                             <tr><td><b>Totales</b></td><td><b><?=$tth?></b></td><td><b><?=$ttm?></b></td><td><b><?=$tth+$ttm?></b></td></tr>
                        </table>
                     </div>
                     <!--<div class="col-md-3 bg-white grow">
                      <center><h5>Datos</h5></center>
                       <hr>
                       <canvas id="chart-uno"></canvas>
                     </div>-->
                  </div>
                </div>
               </div> 
           </div>      
           <div class="row">
              <div class="card">
                <div class="card-body">                  
                  <div class="table-responsive-sm">
                    <table id="table-repo" class="table">
                           <thead>
                           <tr class="bg-celes text-small">
                             <th>
                               <b class="text-white"><small>N.</small></b>
                            </th>
                             <th>
                                <b class="text-white"><small>Proyecto</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Actividad</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Duraci&oacute;n</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Creado por</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>Tipo</small></b>
                             </th>
                             <th>
                                <b class="text-white"><small>FECHA</small></b>
                             </th>
                           </tr>
                           </thead>
                            <tbody>
                    <?php
                    setlocale(LC_TIME, "Spanish");
                    $cont=0;         
                      foreach ($acti->result() as $ac) {
                        $persona=$this->personal->getAllIdUsuario($ac->act_resp);
                        $cont++;
                        ?>
                       <tr class="text-small">
                        <td><?=$cont?></td>
                         <td><?=$ac->nombre_proyecto?></td>
                         <td><?php $porciones = explode("@", $ac->sub_nom);?> <?=$porciones[0]?></td>
                         <td><?=$ac->act_dias?></td>
                         <td><?=$persona->nombre_persona?> <?=$persona->apellido_persona?></td>
                         <td><?=$ac->tipo_nom?></td>
                         <td><?=strftime('%d de %B de %Y',strtotime($ac->act_fecha))?></td>
                      </tr>
                        <?php
                        }
                    ?>
                    </tbody>
                   </table>  
                  </div>
                </div>
              </div>        
        </div><!-- fin panel-->
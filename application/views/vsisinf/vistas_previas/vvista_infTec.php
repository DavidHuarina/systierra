<?php $porciones = explode("@", $actividad->sub_nom);?>
<div class="panel-header-sm bg-warning">
</div>
   <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Vista previa <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a>
                    <img class='icon-lg float-right' src='images/logo.png' alt='Sin imagen'></h5>
                <p class="category">INFORME DE ACTIVIDADES
                  <a href="#">TIERRA</a> / 
                   <a href="cedit_informe?id=<?=$proy->id_proyecto?>&ac=<?=$actividad->act_id?>">EDITAR</a>
                  
                </p>

              </div>
              <div class="card-body">
                <div class="card">
                 <div class="card-body">
                  <table class="table">
                   <tr><td width="20%"><p class="title">PROYECTO</p></td><td width="80%"><p class="title text-primary"><?=$proy->nombre_proyecto?></p></td></tr>
                  </table>
                  <table class="table table-sm">
                   <tr>
                    <td><label class="text-muted">Fecha</label></td>
                    <td><label class="text-dark"><?=strftime('%d de %B de %Y',strtotime($actividad->act_fecha))?></label></td>
                    <td><label class="text-muted">Departamento</label></td>
                    <td><label class="text-dark"><?=$ubicacion->dep_des?></label></td>
                  </tr>
                  <tr>
                    <td><label class="text-muted">Provincia</label></td>
                    <td><label class="text-dark"><?=$ubicacion->pro_des?></label></td>
                    <td><label class="text-muted">Municipio</label></td>
                    <td><label class="text-dark"><?=$ubicacion->mun_des?></label></td>
                  </tr>
                  <tr>
                    <?php
                     if($ubicacion->com_id==0){
                    ?><td><label class="text-muted">Direcci&oacute;n</label></td><td><label class="text-dark"><?=$ubicacion->direccion?></label></td><?php
                     }else{
                     ?><td><label class="text-muted">Comunidad:</label><td><label class="text-dark"><?=$ubicacion->com_nom?></label></td><?php
                     }
                   ?>
                    <td></td>
                    <td></td>
                  </tr>
                  </table>

                  <p class="title">DETALLE DE ACTIVIDAD</p>
                  <table class="table table-sm">
                   <tr>
                    <td width="25%"><label class="text-muted">Actividad</label></td>
                    <td width="75%"><label class="text-dark"><?=$porciones[0]?></label></td>
                  </tr>
                  <tr>
                    <td width="25%"><label class="text-muted">Tipo</label></td>
                    <td width="75%"><label class="text-dark"><?=$actividad->tipo_nom?></label></td>      
                  </tr>
                  <tr>
                    <td width="25%"><label class="text-muted">D&iacute;as</label></td>
                    <td width="75%"><label class="text-dark"><?=$actividad->act_dias?></label></td>      
                  </tr>
                  </table>
                  <p class="title">EQUIPO DE TRABAJO</p>
                  <table class="table table-sm">
                   <tr>
                    <td width="25%"><label class="text-muted">Responsable</label></td>
                    <td width="75%"><?php 
                    foreach ($resp->result() as $resp) {
                      echo "<img class='img-sm rounded-circle' src='".$resp->dir_imagen."'>  <label class='text-primary'>".$resp->nombre_persona." ".$resp->apellido_persona."</label><br>";
                    }
                    ?></td>
                  </tr>
                  <tr>
                    <td width="25%"><label class="text-muted">Colaboradores</label></td>
                    <td width="75%"><?php 
                    foreach ($equipo->result() as $eq) {
                      echo "<img class='img-sm rounded-circle' src='".$eq->dir_imagen."'> <label class='text-dark'> ".$eq->nombre_persona." ".$eq->apellido_persona."</label><br><br>";
                    }
                    foreach ($equipoi->result() as $eqi) {
                      echo "<img class='img-sm rounded-circle' src='imagenes/storage/users/default-img/person.jpg'> <label class='text-muted'> ".$eqi->nombre_persona." ".$eqi->apellido_persona."</label><br><br>";
                    }
                    ?> </td>      
                  </tr>
                  </table>
                  <p class="title">RESUMEN</p>
                  <table class="table table-sm">
                   <tr>
                    <td width="25%"><label class="text-muted">Objetivos</label></td>
                    <td width="75%"><label class="text-dark"><?=$resumen->objetivos?></label></td>
                  </tr>
                  <tr>
                    <td width="25%"><label class="text-muted">Descripci&oacute;n</label></td>
                    <td width="75%"><label class="text-dark"><?=$resumen->descripcion?></label></td>      
                  </tr>
                  <tr>
                    <td width="25%"><label class="text-muted">Logros</label></td>
                    <td width="75%"><label class="text-dark"><?=$resumen->logros?></label></td>      
                  </tr>
                  </table>
                   <p class="title">DATOS COMPLEMENTARIOS</p>
                  <table class="table table-sm">
                   <tr>
                    <td width="25%"><label class="text-muted">Comunidades</label></td>
                    <td width="75%">
                   <?php $n=0;
                    foreach ($comunidades->result() as $com) { 
                      if($n==0){
                        ?><label class="text-dark"><?=$com->com_nom?></label><?php
                      }else{
                        ?>
                    <label class="text-dark">, <?=$com->com_nom?></label>
                     <?php
                      }
                      
                     $n=$n+1; }
                    ?>
                    </td>
                  </tr>     
                  <tr>
                    <td width="25%"><label class="text-muted">N° de Comunidades</label></td>
                    <td width="75%"><label class="text-dark"><?=$n?></label></td>      
                  </tr>
                   <?php if($ubicacion->act_resumen==""){
                         
                         }else{
                           ?><tr><td width="25%"><label class="text-muted">Organizaciones</label></td>
                             <td width="75%"><label class="text-muted"><?=$ubicacion->act_resumen?></label></td></tr>
                           <?php
                         }?> 
                  </table>
                  <p class="title">OBSERVACIONES</p>
                  <label><?=$ubicacion->act_obs?></label> 
                  <hr>
                  <p class="title">PARTICIPANTES DATOS GENERALES</p>
                  <center><div class="col-md-6">
                    <table class="table table-sm table-hover table-bordered text-small">
                    <tr class="text-primary"><th>Participantes</th><th>Hombres</th><th>Mujeres</th><th>Total</th></tr>
                    <?php 
                    $nh=0;$nm=0;$nt=0;
                       foreach ($participante->result() as $par) {
                        $nh=$nh+$par->cant_h;
                        $nm=$nm+$par->cant_m;
                        $nt=$nt+$par->total;
                         ?><tr><td><?=$par->nombre_tipopar?></td><td><?=$par->cant_h?></td><td><?=$par->cant_m?></td><td><?=$par->total?></td></tr><?php
                       }
                    ?>
                     <tr><th>Totales</th><th><?=$nh?></th><th><?=$nm?></th><th><?=$nt?></th></tr>
                   </table>
                  </div></center>                  
                 </div>
               </div>
                 <hr>
                  <div class="float-right">
                    <a href="javascript:history.back(-1);" class="btn btn-danger">Ok</a>
                  </div>
                  <div class="float-right">
                      <a href="cvista_infTec/descargar/<?=$proy->id_proyecto?>/<?=$actividad->act_id?>" class="btn btn-secondary"><i class="now-ui-icons arrows-1_cloud-download-93"></i> Descargar</a>
                  </div>
                                   
                    <div class="float-left">
                      <a href="cedit_informe?id=<?=$proy->id_proyecto?>&ac=<?=$actividad->act_id?>" class="btn btn-primary"> Editar Informe</a>
                  </div>
                    
                  
                       
              </div>
            </div>
          </div>
        </div>
      </div>

      
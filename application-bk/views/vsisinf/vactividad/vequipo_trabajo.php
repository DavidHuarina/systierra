<div class="panel-header panel-header-sm">
</div>
 <div class="content"><!--principio de Panel-->
          <div class="row"> 
          <!--<div class="col-md-8">
            	<div class="card">
                	<div class="card-header">
                       <center><img class="icon-lg" src="apps/full-icon/flat/equipo/reunion.png" alt="Card image"></center>
                	</div>
                 <div class="card-body">
                 	Datos generales
                 </div>
               </div>
            </div> -->        
            <div class="col-md-12">
            	<?php 
               foreach ($actividad->result() as $act) {
               	$per=$this->personal->getByIdUsuario($act->act_resp);
                 $col=$this->col_act->getAllActE($act->act_id);
                 if($col!=null){
                 	$eres=false;$nro=0;
                 	foreach ($col->result() as $cole) {
                 		if($cole->id_usuario==$this->session->userdata('id_usuario_sesion')){
                          $eres=true;
                 		}
                 		$nro=$nro+1;
                 	}
                 	if($eres==true){
                 		?>
                <div class="card">
                	<div class="card-header">
                		<label>Equipo de trabajo</label>
                       <img class="icon-md float-left" src="apps/full-icon/flat/equipo/reunion.png" alt="Card image">
                	</div>
                 
                 <div class="card-body">
                   <label class="card-title"><?php $porciones = explode("@", $act->sub_nom);?>
                          Actividad: <?=$porciones[0]?> <hr>Creado por: <small class="text-primary text-small"><?=$per->nombre_persona?></small></label>
                   <div class="panel-group">
                     <div class="panel panel-default">
                       <div class="panel-heading">
                         <label class="panel-title float-right">
                           <a class="btn btn-warning" data-toggle="collapse" href="#collapse<?=$act->act_id?>">Integrantes <?=$nro?></a>
                         </label>
                       </div>
                       <div id="collapse<?=$act->act_id?>" class="panel-collapse collapse">
                         <ul class="list-group">
                 		<?php
                 		foreach ($col->result() as $equi) {
                 			$pers=$this->personal->getAllIdPersona($equi->id_persona);
                 			if($pers->id_usuario==$this->session->userdata('id_usuario_sesion')){
                 			?>
                             <li class="list-group-item"><img class="icon-sm" src="<?=$pers->dir_imagen?>" alt="Sin Im"> <small class="text-primary"><?=$equi->nombre_persona?> <?=$equi->apellido_persona?></small></li>                                   
                 			<?php
                 			}else{
                 			?>
                             <li class="list-group-item"><img class="icon-sm" src="<?=$pers->dir_imagen?>" alt="Sin Im"> <small><?=$equi->nombre_persona?> <?=$equi->apellido_persona?></small></li>                                   
                 			<?php
                 			}
                 		}
                 		?>
                 		  </ul>
                 		  <div class="panel-footer"><a href="#" class="btn btn-danger btn-sm">Dejar equipo</a></div>
                       </div>
                     </div>
                   </div>  
                   <!--<a href="#" class="btn btn-secondary">Dejar equipo</a>-->
                 </div>
               </div>
                 		<?php
                 	}
                 }
               }
            	?>
            </div>
                      
          </div>
        </div><!-- fin panel-->
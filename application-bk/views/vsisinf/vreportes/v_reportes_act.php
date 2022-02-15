<div class="panel-header-sm bg-celeste">
</div>
<div class="content"><!--principio de Panel-->
    <div class="card">
     <div class="card-header">
       <h5 class="card-title">Reportes
         <img class="icon-sm" src="apps/full-icon/flat/iconos-sys/pie-chart-1.png"> / <img class="icon-sm" src="apps/full-icon/flat/iconos-sys/pencil-case.png">Reporte de Informes
       
       <?php 
         if($idrol==2||$idrol==1000||$idrol==2000||$idrol==3000){
          
          }else{
            ?>
             <a class="float-right nav-link" href="creportesproy">
          <img class="icon-sm" src="apps/full-icon/flat/iconos-sys/get-money.png"><small>Reporte Econ&oacute;mico</small></a>
            <?php
          }
       ?> 
       </h5>
     </div>
     <div class="card-body">
          
     	<div class="row">
     		<div class="col-md-4">
     			<div class="form-group">
                     <label>Proyectos</label>
                     <select id="sel_proy"  data-placeholder="Seleccione una persona" class="form-control select-plantilla">
                       <option value="">Todos</option>
                       <?php foreach ($proyecto->result() as $per) {
                          ?><option value="<?=$per->nombre_proyecto?>"><?=$per->nombre_proyecto?></option><?php 
                       }?>
                     </select>
               </div>
     		</div>
     		<div class="col-md-4">
     			<div class="form-group">
                     <label>Resultado</label>
                     <select id="sel_res"  data-placeholder="Seleccione una persona" class="form-control select-plantilla">
                       <option value="">Todos</option>
                       <?php foreach ($resultados->result() as $fi) {
                          ?><option value="<?=$fi->descripcion?>"><?=$fi->descripcion?></option><?php 
                       }?>
                
                     </select>
               </div>
     		</div>
     		<div class="col-md-4">
     			<div class="form-group">
                     <label>Comunidades</label>
                     <select id="sel_com"  data-placeholder="Seleccione una persona" class="form-control select-plantilla">
                       <option value="">Todas</option>
                       <option value="Sin comunidad">Sin Comunidad</option>
                       <?php foreach ($comunidades->result() as $com) {
                          ?><option value="<?=$com->com_nom?>"><?=$com->com_nom?></option><?php 
                       }?>
                     </select>
               </div>
     		</div>
     		
     	</div>
     	
        <div class="row">
        	<div class="col-md-4">
     			<div class="form-group">
                     <label>Tipo de actividad</label>
                     <select id="sel_ta"  data-placeholder="Seleccione una persona" class="form-control select-plantilla">
                       <option value="">Todos</option>
                       <?php foreach ($tipo->result() as $tip) {
                          ?><option value="<?=$tip->tipo_nom?>"><?=$tip->tipo_nom?></option><?php 
                       }?>
                     </select>
               </div>
     		</div>
     		<div class="col-sm-4 text-center">
					<label for="">Fechas:</label>	
				<input id="Date_search" type="text" class="form-control" placeholder="Busca entre fechas" />
			</div> 
			<!--<div class="col-sm-2 text-center">
				<input type="button" class="btn btn-success btn-sm boton_ocultar_mostrar" value="DEPARTAMENTO">
			</div>
			<div class="col-sm-2 text-center">
				<input type="button" class="btn btn-success btn-sm boton_ocultar_mostrar" value="PROVINCIA">
			</div>
			<div class="col-sm-2 text-center">
				<input type="button" class="btn btn-success btn-sm boton_ocultar_mostrar" value="MUNICIPIO">
			</div>-->
      <div class="col-md-4">
            <div class="form-group">
                     <label>RESPONSABLE</label>
                     <select id="sel_resp"  data-placeholder="Seleccione una persona" class="form-control select-plantilla">
                       <option value="">Todos</option>
                       <?php foreach ($personallist->result() as $pers) {
                          ?><option value="<?=$pers->nombre_persona?> <?=$pers->apellido_persona?>"><?=$pers->nombre_persona?> <?=$pers->apellido_persona?></option><?php 
                       }?>
                     </select>
               </div>
        </div>
						<!--<div class="col-sm-2 text-center">
				<input type="button" class="btn btn-warning btn-sm boton_ocultar_mostrar" value="VISTA MEDIA">
			</div>
			<div class="col-sm-2 text-center">
				<input type="button" class="btn btn-warning btn-sm boton_ocultar_mostrar" value="VISTA AVANZADA">
			</div>-->
                             
		</div>
    <div class="col-sm-4 text-center">
          <label for="">Vista:</label><br>  
        <button id="v_basica" class="dt-button buttons-copy">Completa</button>
        <div id="mensaje_v"></div>
      </div>

		<hr class="hr">
        <div class="">
     	<table id="table-rep-act" class="table table-striped table-sm">     		
            <thead>
            <tr class="text-small bg-warning text-black">
                <th class="text-small bg-primary text-white text-center" colspan="31">Actividades Realizadas</th>
            </tr>    	
            <tr class="text-small bg-warning text-black">
            	
              <th class="text-small bg-plomo text-white" rowspan="2">
              	 <b>Nº</b>
              </th>
              <th class="text-small bg-super-cel text-white" rowspan="2">
                <b>CODIGO</b>
              </th>
              <th class="text-small bg-super-cel text-white" rowspan="2">
                <b>DEPARTAMENTO</b>
              </th>
              <th class="text-small bg-super-cel text-white" rowspan="2">
              	<b>PROVINCIA</b>
              </th>
              <th class="text-small bg-super-cel text-white" rowspan="2">
              	<b>MUNICIPIO</b>
              </th>
              <th class="text-small bg-plomo text-white" rowspan="2">
              	<b>COMUNIDAD</b>
              </th>
              <th class="text-small bg-plomo-claro text-white" rowspan="2">
              	<b>Direcci&oacute;n</b>
              </th>
              <th class="text-small bg-plomo text-white" rowspan="2">
                <b>FECHA</b>
              </th>
              <th class="text-small bg-plomo text-white" rowspan="2">
              	<b>PROYECTO</b>
              </th>
              <th class="text-small bg-plomo text-white" rowspan="2">
              	<b>RESULTADO</b>
              </th>
              <th class="text-small bg-plomo text-white" rowspan="2">
              	<b>TIPO</b>
              </th>
              <th class="text-small bg-plomo text-white" rowspan="2">
              	<b>DETALLE</b>
              </th> 
              
              <th class="text-small bg-plomo text-white" rowspan="2">
                <b>DIAS</b>
              </th>  
              <th class="text-small bg-super-cel text-white" rowspan="2">
              	<b>RES. OBJETIVOS</b>
              </th>
              <th class="text-small bg-super-cel text-white" rowspan="2">
              	<b>RES. DESCRIPCION</b>
              </th>
              <th class="text-small bg-super-cel text-white" rowspan="2">
              	<b>RES. LOGROS</b>
              </th>
              <th class="text-small bg-plomo text-white" rowspan="2">
              	<b>RESPONSABLE DE INFORME</b>
              </th> 
              <th class="text-small bg-plomo text-white" rowspan="2">
              	<b>COLABORADORES</b>
              </th>
              <th class="text-small bg-success text-white" colspan="2">
              	AUTORIDADES ORIGINARIAS
            </th>
            <th class="text-small bg-success text-white" colspan="2">
              	PROMOTORES / LIDERES
            </th>
            <th class="text-small bg-success text-white" colspan="2">
              	PUBLICO GRAL. / BASES
            </th>
            <th class="text-small bg-success text-white" colspan="2">
              	AUTORIDADES POLITICAS
            </th>
            <th class="text-small bg-success text-white" colspan="2">
              	OTROS
            </th>
            <th class="text-small bg-warnig text-white" colspan="2">
              	TOTAL
            </th>
            <th class="text-small bg-success text-white" rowspan="2">
              	TOTAL
            </th>
          </tr>
          <tr class="text-small bg-plomo text-white">
          	<th class="text-small bg-super-cel text-white">
              	<b>H</b>
            </th>
            <th class="text-small bg-super-cel text-white">
              	<b>M</b>
            </th>
            <th class="text-small bg-super-cel text-white">
              	<b>H</b>
            </th>
            <th class="text-small bg-super-cel text-white">
              	<b>M</b>
            </th>
            <th class="text-small bg-super-cel text-white">
              	<b>H</b>
            </th>
            <th class="text-small bg-super-cel text-white">
              	<b>M</b>
            </th>
            <th class="text-small bg-super-cel text-white">
              	<b>H</b>
            </th>
            <th class="text-small bg-super-cel text-white">
              	<b>M</b>
            </th>
            <th class="text-small bg-super-cel text-white">
              	<b>H</b>
            </th>
            <th class="text-small bg-super-cel text-white">
              	<b>M</b>
            </th>
            <th class="text-small bg-warning text-white">
              	<b>T. H</b>
            </th>
            <th class="text-small bg-warning text-white">
              	<b>T. M</b>
            </th>
          </tr>       
             </thead>
             <tbody>
             	<?php 
                foreach ($fullactividad->result() as $fila) {
                	$cola=$this->col_act->getAllByIdActPer($fila->act_id);
                	$parti=$this->v_datos_usuario->getPartiRepo($fila->act_id);
                  $res=$this->v_datos_usuario->getResActF($fila->act_id);                 	
                 ?>
                <tr class="clickable-row text-small"><td></td>
                  <td>ACT-<?=$fila->act_id?></td>
                	<td><?=$fila->dep_des?></td>
                	<td><?=$fila->pro_des?></td>
                	<td><?=$fila->mun_des?></td>
                	<td><?=$fila->com_nom?></td>
                	<td>Sin direcci&oacute;n especifica</td>
                  <td><?=strftime('%Y-%m-%d',strtotime($fila->act_fecha))?></td>
                	<td><div class="cortar"><?=$fila->nombre_proyecto?></div></td>
                	<td><div class="cortar"><?php foreach ($res->result() as $col) {
                    echo "".$col->resultado."<br>";
                  }?></div></td>
                	<td><?=$fila->tipo_nom?></td>
                	<td><?php $porcion = explode("@", $fila->sub_nom);?><?=$porcion[0]?></td>                	
                  <td><?=$fila->act_dias?></td>
                	<td><div class="cortar"><?=$fila->r_obetivos?></div></td>
                	<td><div class="cortar"><?=$fila->r_descripcion?></div></td>
                	<td><div class="cortar"><?=$fila->r_logros?></div></td>
                	<td><img class="icon-sm" src="<?=$fila->dir_imagen?>"><?=$fila->nombre_persona?> <?=$fila->apellido_persona?></td>
                	<td><?php foreach ($cola->result() as $col) {
                		echo "@".$col->nombre_persona." ".$col->apellido_persona."<br>";
                	}?></td>
                	<?php 
                     if($parti->result()==null){
                     	for ($i=0; $i < 5; $i++) { 
                     		echo "<td>NN</td><td>NN</td>";
                     	}
                     	echo "<td>0</td><td>0</td>";
                     	echo "<td>0</td>";
                        }else{
                        	$th=0;$tm=0;
                     	foreach ($parti->result() as $par) {
                     		$th=$th+$par->cant_h;
                     		$tm=$tm+$par->cant_m;
                		echo "<td>".$par->cant_h."</td><td>".$par->cant_m."</td>";
                	   }
                	   $vart=$th+$tm;
                	    echo "<td>".$th."</td><td>".$tm."</td>";
                     	echo "<td>".$vart."</td>";
                     }

                	?>
                </tr>
                 <?php
                }
                /*BLOQUE DE ACTIVIDADES SIN ID_COMUNIDAD*/
                foreach ($fullactividadsin->result() as $filas) {
                	$cola=$this->col_act->getAllByIdActPer($filas->act_id);
                	$parti=$this->v_datos_usuario->getPartiRepo($filas->act_id); 
                  $res=$this->v_datos_usuario->getResActF($filas->act_id);                   	
                 ?>
                <tr class="clickable-row text-small"><td></td>
                  <td>ACT-<?=$filas->act_id?></td>
                	<td><?=$filas->dep_des?></td>
                	<td><?=$filas->pro_des?></td>
                	<td><?=$filas->mun_des?></td>
                	<td>Sin comunidad</td>
                	<td><?=$filas->direccion?></td>
                  <td><?=strftime('%Y-%m-%d',strtotime($filas->act_fecha))?></td>
                	<td><div class="cortar"><?=$filas->nombre_proyecto?></div></td>
                	<td><div class="cortar"><?php foreach ($res->result() as $col) {
                    echo "".$col->resultado."<br>";
                  }?></div></td>
                	<td><?=$filas->tipo_nom?></td>
                	<td><?php $porcion = explode("@", $filas->sub_nom);?><?=$porcion[0]?></td>
                  <td><?=$filas->act_dias?></td>
                	<td><div class="cortar"><?=$filas->r_obetivos?></div></td>
                	<td><div class="cortar"><?=$filas->r_descripcion?></div></td>
                	<td><div class="cortar"><?=$filas->r_logros?></div></td>
                	<td><img class="icon-sm" src="<?=$filas->dir_imagen?>"> <?=$filas->nombre_persona?> <?=$filas->apellido_persona?></td>
                	<td><?php foreach ($cola->result() as $col) {
                		echo "@".$col->nombre_persona." ".$col->apellido_persona."<br>";
                	}?></td>
                	<?php 
                     if($parti->result()==null){
                     	for ($i=0; $i < 5; $i++) { 
                     		echo "<td>NN</td><td>NN</td>";
                     	}
                     	echo "<td>0</td><td>0</td>";
                     	echo "<td>0</td>";
                        }else{
                        	$th=0;$tm=0;
                     	foreach ($parti->result() as $par) {
                     		$th=$th+$par->cant_h;
                     		$tm=$tm+$par->cant_m;
                		echo "<td>".$par->cant_h."</td><td>".$par->cant_m."</td>";
                	   }
                	   $vart=$th+$tm;
                	    echo "<td>".$th."</td><td>".$tm."</td>";
                     	echo "<td>".$vart."</td>";
                     }

                	?>
                </tr>
                 <?php
                }
             	?>
             </tbody>
          	
     	</table>
     	</div>
     </div>
    </div> 

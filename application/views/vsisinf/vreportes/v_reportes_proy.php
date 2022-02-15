<div class="panel-header-sm bg-amarillo">
</div>
<div class="content"><!--principio de Panel-->
    <div class="card">
     <div class="card-header">
       <h5 class="card-title">Reportes
         <img class="icon-sm" src="apps/full-icon/flat/iconos-sys/pie-chart-1.png"> / <img class="icon-sm" src="apps/full-icon/flat/iconos-sys/get-money.png">Reporte Econ&oacute;mico
         <a class="float-right nav-link" href="creportes">
          <img class="icon-sm" src="apps/full-icon/flat/iconos-sys/pencil-case.png"><small>Reporte de Informes</small></a>
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
                     <label>Tipo de actividad</label>
                     <select id="sel_ta"  data-placeholder="Seleccione una persona" class="form-control select-plantilla">
                       <option value="">Todos</option>
                       <?php foreach ($tipo->result() as $tip) {
                          ?><option value="<?=$tip->tipo_nom?>"><?=$tip->tipo_nom?></option><?php 
                       }?>
                     </select>
               </div>
        </div>
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
     		
     	</div>
     	
        <div class="row">
        	
     		
       <div class="col-sm-4 text-center">
          <label for="">Expandir y contraer Detalles:</label><br>  
        <button id="btn-show-all-children" type="button" class="dt-button buttons-copy">E/C</button>
      </div>
			<div class="col-sm-4 text-center">
					<label for="">Vista:</label><br>	
				<button id="v_basica" class="dt-button buttons-copy">Completa</button>
				<div id="mensaje_v"></div>
			</div>
      <div class="col-sm-4 text-center">
          <label for="">Fechas:</label> 
          <input id="Date_search" type="text" class="form-control" placeholder="Busca entre fechas" />
        </div> 
                             
		</div>
    
		<hr class="hr">
        <div class="">
     	<table id="table-rep-proy" class="table table-striped table-sm">     		
            <thead>    	
            <tr class="text-small bg-warning text-black">
              <th class="text-small bg-plomo text-white">
                
              </th>
              <th class="text-small bg-plomo text-white">
              	 <b>Nº</b>
              </th>
              <th class="text-small bg-super-cel text-white">
                <b>CODIGO DF</b>
              </th>
              <th class="text-small bg-super-cel text-white">
                <b>CODIGO</b>
              </th>
              <th class="text-small bg-super-cel text-white">
                <b>ACTIVIDAD</b>
              </th>
              <th class="text-small bg-super-cel text-white">
              	<b>TIPO</b>
              </th>
              <th class="text-small bg-super-cel text-white">
                <b>PROYECTO</b>
              </th>
              <th class="text-small bg-super-cel text-white">
              	<b>FECHA ACTIVIDAD</b>
              </th>
              <th class="text-small bg-plomo text-white">
              	<b>MONTO TOTAL</b>
              </th>
              <th class="text-small bg-plomo text-white">
              	<b>BANCO</b>
              </th>
              <th class="text-small bg-plomo text-white">
              	<b>N CHEQUE</b>
              </th>
              <th class="text-small bg-plomo text-white">
              	<b>TOTAL SOLICITADO</b>
              </th>
              <th class="text-small bg-plomo text-white">
              	<b>RESPONSABLE</b>
              </th> 
              <th class="text-small bg-plomo text-white">
              	<b>FECHA Y HORA DEL DESCARGO</b>
              </th>
          </tr>

             </thead>
             <tbody>
             	<?php 
                foreach ($descargosall->result() as $fila) { 
                  $proy=$this->actividad->getById($fila->act_id);
                $smi=$this->personal->getAllIdUsuario($fila->act_resp);
                $porcion = explode("@", $fila->sub_nom);               	
                 ?>
                <tr class="text-small"><td class="details-control"></td><td></td>
                  <td><?=$fila->id_df?></td>
                  <td>ACT-<?=$fila->act_id?></td>
                	<td><?=$porcion[0]?></td>
                	<td><?=$fila->tipo_nom?></td>
                  <td><div class="cortar"><?=$proy->nombre_proyecto?></div></td>
                	<td><?=strftime('%Y-%m-%d',strtotime($fila->act_fecha))?></td>
                	<td class="text-right"><?=number_format($fila->df_total, 2, '.', ',')?></td>
                  <?php if($fila->banco!=null){
                    ?><td><?=$fila->banco?></td><?php
                  }else{
                    echo "<td>No se registraron los datos</td>";
                  }?>
                  <?php if($fila->n_cheque!=null){
                    ?><td><?=$fila->n_cheque?></td><?php
                  }else{
                    echo "<td>No se registraron los datos</td>";
                  }?>
                  <td class="text-right"><?=number_format($fila->total, 2, '.', ',')?></td>
                  <td><img class="icon-sm" src="<?=$smi->dir_imagen?>"> <?=$smi->nombre_persona?> <?=$smi->apellido_persona?></td>
                  <td><?=$fila->f_descargo?></td>
                </tr>
                 <?php
                }
                ?>
             </tbody>
          	
     	</table>
     	</div>
     </div>
    </div> 

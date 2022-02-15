<div class="panel-header-sm bg-celeste">
</div>
 <div class="content"><!--principio de Panel-->
          <div class="row">
               <div class="card">
                <div class="card-header">
                  <h5 class="card-title"><small class="text-celeste">Agenda Systierra</small></h5>
                </div>
                <div class="card-body">
                  <div class="row col-md-6">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Dia</label>
                        <input type="text" id="dia_c" name="dia_c" onkeypress="return validarNumero(event)" class="form-control" placeholder="01" value="" maxlength="2">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Mes</label>
                        <input type="text" id="mes_c" name="mes_c" onkeypress="return validarNumero(event)" class="form-control" placeholder="07" value="" maxlength="2">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Año</label>
                        <input type="text" id="ano_c" name="ano_c" onkeypress="return validarNumero(event)" class="form-control" placeholder="1994" value="" maxlength="4">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label></label>
                        <button class="btn btn-info btn-round" onclick="irafecha()">Buscar</button>
                      </div>
                    </div>
                  </div>
                  <!--<div class="row col-md-6">
                    <div class="form-group">
                        <label></label>
                        <button class="btn btn-info btn-round" onclick="listarDias()">Listar</button>
                      </div>
                    <p>Lunes: <label id="lunes_evento"></label></p>
                  </div>-->
                  <label id="men_fecha"></label>
                 </div> 
               </div> 
           </div>      
           <div class="row">
              <div class="card">
                <div class="card-body"> 
                <script>var eventoCalendar=[];</script>
                <?php foreach ($actividad->result() as $act) {
                  $idper=$this->personal->getByIdUsuario($this->session->userdata('id_usuario_sesion'));
                     $equipotrab=$this->col_act->Existe($idper->id_persona,$act->act_id);
                              if($equipotrab->num!=0){
                              $eresP="Eres miebro del equipo de trabajo";
                              }else{
                              $eresP="No formas parte de esta actividad";
                              }
                              if($act->act_padre!=0){
                               $sub="S";
                              }else{
                                $sub="A";
                              }
                  switch ($act->id_estado) {
                        case 1:
                          $color="#716e6e";
                          break;
                         case 2:
                          $color="#c12808";
                          break;
                          case 3:
                          $color="#dcab49";
                          break;
                          case 4:
                          $color="#6145a5";
                          break;
                          case 5:
                          $color="#429f42";
                          break;

                        default:
                          # code...
                          break;
                      }
                   $personaU=$this->personal->getAllIdUsuario($act->act_resp);
                  $end = strtotime ( '+'.$act->act_dias.' day' , strtotime ($act->act_fecha)) ;
                  $end=strftime('%Y-%m-%d',$end);
                    $porciones = explode("@", $act->sub_nom);
                     $porcionesProy = explode("/", $act->nombre_proyecto);
                    echo "<script>eventoCalendar.push({
                          title: '".$sub." - ".$porciones[0]."',
                          start: '".$act->act_fecha."',
                          end: '".$end."',
                          description: 'Proyecto: ".$porcionesProy[0]." / Duración: ".$act->act_dias." / Creado por: #".$personaU->nombre_persona." / (".$eresP.")',
                          url: '#',
                          color:'".$color."'});</script>";
                }
               /* foreach ($actividadIn->result() as $acti) {
                 $idper=$this->personal->getByIdUsuario($this->session->userdata('id_usuario_sesion'));
                     $equipotrab=$this->col_act->Existe($idper->id_persona,$acti->act_id);
                              if($equipotrab->num!=0){
                              $end = strtotime ( '+'.$acti->act_dias.' day' , strtotime ($acti->act_fecha)) ;
                              $end=strftime('%Y-%m-%d',$end);
                                $porciones = explode("@", $acti->sub_nom);
                                echo "<script>eventoCalendar.push({
                                      title: '".$porciones[0]."',
                                      start: '".$acti->act_fecha."',
                                      end: '".$end."',
                                      description: 'Proyecto: ".$acti->nombre_proyecto." Duración: ".$acti->act_dias."',
                                      url: '#'
                                    });</script>";
                              }
                 }*/
                ?>                 
                   <div id="calendar"></div>
                </div>
              </div>        
        </div><!-- fin panel-->

        <!--URL DE EVENTOcALENDAR:_________________ url:'cdetalle_actividad?id=".$acti->id_proyecto."&ac=".$acti->act_id."' ______________-->
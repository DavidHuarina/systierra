     <div class="panel-header panel-header-sm">
     </div>
       <div class="content"><!--principio de Panel-->
          <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                <h4 class="card-title">Nuevo Mensaje <a class="float-right" href="javascript:history.back(-1);">
                    <i class="now-ui-icons ui-1_simple-remove text-muted"></i></a></h4>
                </div>
                <div class="card-body">
                  <form autocomplete="off" action="cnuevo_mensaje/enviar" class="forms-sample" method="post">
                        <?php
                        $i=0;
                        echo "<script>var personas=[],imagenes_perfil=[];</script>";
                        foreach ($personas->result() as $per) {
                          echo "<script>personas[".$i."]='".$per->nombre_persona." ".$per->apellido_persona."';</script>";
                          echo "<script>imagenes_perfil[".$i."]='".$per->dir_imagen."';</script>";
                         
                         ?>
                        <?php
                         $i=$i+1;
                        }
                        ?>
                    <div class="autocomplete form-group" style="width:100%;">
                       <label for="receptor_u">Para :</label>
                       <input id="receptor_u" type="text" name="receptor_u" class="form-control" placeholder="Usuario destino" required>
                    </div>

                    <div class="form-group">
                      <label for="mensaje_u">Mensaje :</label>
                      <textarea class="form-control" id="mensaje_u" name="mensaje_u"  placeholder="Redactar mensaje..."></textarea>
                    </div>

                    <div class="float-left">
                      <a href="home" class="btn btn-danger">Cancelar</a>
                    </div>
                    <div class="float-right">
                      <button class="btn btn-warning">Limpiar</button>
                      <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>                    
                  </form>
                </div>
              </div>
            </div>
        </div><!-- fin panel-->
   <div class="panel-header bg-fondo">
        <div class="header text-center">
          <h2 class="title">SysTierra</h2>
          <p class="category">SysTierra es una aplicacion que permite a los usuarios interactuar con los proyectos y actividades en curso realizados en <a target="_blank" href="http://www.ftierra.org/index.php">Tierra</a>. Descripcion - Open Source (Codigo abierto) 

          </p>
        </div>
    </div>
    <div class="content">
      
        <div class="row">
          <div class="col-lg-12">
            <!-- <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category"></h5>
                <h4 class="card-title">TCO's</h4>
              </div>
              <div class="card-body">
                <div id="mapid" class="map"></div>
                 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2274.5445573611214!2d-68.12719850543722!3d-16.510302241537723!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x915f206196ee1bbf%3A0x5f362f71c6d07eaf!2sFundaci%C3%B3n+TIERRA!5e0!3m2!1ses!2sbo!4v1551908405947" width="400" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Ahora
                </div>
              </div>
            </div>  -->
            <div class="row">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Datos Estad&iacute;sticos</h5>
                <h4 class="card-title">SYSTIERRA: Actividades/Año</h4>
                <select class="form-control col-md-2" onchange="cambiaAEsta2(this.value)">
                  <?php for ($i=(int)date("Y"); $i >=2000 ; $i--) { 
                    if ($i==(int)date("Y")){
                      ?><option value="<?=$i?>" selected><?=$i?></option><?php
                    }else{
                      ?><option value="<?=$i?>"><?=$i?></option><?php
                    }
                   
                  }?>
                </select>
              </div>
              <div class="card-body">
                <div id="mensajeA"></div>
              <canvas id="proy"></canvas>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Ahora
                </div>
              </div>
            </div>
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Datos Estad&iacute;sticos</h5>
                <h4 class="card-title">SYSTIERRA: Actividades/Año</h4>
                <select class="form-control col-md-2" onchange="cambiaAEsta(this.value)">
                  <?php for ($i=(int)date("Y"); $i >=2000 ; $i--) { 
                    if ($i==(int)date("Y")){
                      ?><option value="<?=$i?>" selected><?=$i?></option><?php
                    }else{
                      ?><option value="<?=$i?>"><?=$i?></option><?php
                    }
                   
                  }?>
                </select>
              </div>
              <div class="card-body">
              <canvas id="actividad-chart"></canvas>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Ahora
                </div>
              </div>
            </div>
           </div> 
            <!--<div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category"><?=$nproy->num?></h5>
                <h4 class="card-title">Proyectos</h4>
              </div>
              <div class="card-body">
               <div id="demo" class="carousel slide" data-ride="carousel">
                
                <ul class="carousel-indicators">
                  <li data-target="#demo" data-slide-to="0" class="active"></li>
                  <li data-target="#demo" data-slide-to="1"></li>
                  <li data-target="#demo" data-slide-to="2"></li>
                  <li data-target="#demo" data-slide-to="3"></li>
                </ul>
                
                <div class="carousel-inner">
                  <div class="carousel-item active">
                  <img src="imagenes/web/systierra.png" alt="img" class="carrusel">
                    <div class="carousel-caption">
                      <label class="text-white"><b>SYSTIERRA</b> </label>
                      <p><small>Versi&oacute;n 1.1.0 <br>Developer: David Huarina M.</small></p>
                    </div>
                  </div>
                  <div class="carousel-item">
                  <img src="imagenes/web/sys.png" alt="img" class="carrusel">
                    <div class="carousel-caption">
                      <label class="text-white"><b>SYSTIERRA</b> </label>
                      <p><small>Primer Panel</small></p>
                    </div>
                  </div>
                  <div class="carousel-item">
                  <img src="imagenes/web/sys2.png" alt="img" class="carrusel">
                    <div class="carousel-caption">
                      <label class="text-white"><b>SYSTIERRA</b> </label>
                      <p><small>Panel Actividades</small></p>
                    </div>
                  </div>
                  <div class="carousel-item">
                  <img src="imagenes/web/sys3.png" alt="img" class="carrusel">
                    <div class="carousel-caption">
                      <label class="text-white"><b>SYSTIERRA</b> </label>
                      <p><small>Panel Solicitudes</small></p>
                    </div>
                  </div>
                  <div class="carousel-item">
                  <img src="imagenes/web/sys4.png" alt="img" class="carrusel">
                    <div class="carousel-caption">
                      <label class="text-white"><b>SYSTIERRA</b> </label>
                      <p><small>Panel Proyectos</small></p>
                    </div>
                  </div>

                  <div class="carousel-item">
                  <img src="imagenes/web/tierra.png" alt="img" class="carrusel">
                    <div class="carousel-caption">
                      <label class="text-white"><b>TIERRA</b> </label>
                      <p><small>NOTICIAS</small></p>
                    </div>
                  </div>
                  <div class="carousel-item">
                  <img src="imagenes/web/conferencia.jpg" alt="img" class="carrusel">
                    <div class="carousel-caption">
                      <label class="text-white"><b>"MADRE TIERRA, LA AGENDA ABANDONADA”, EN BUSCA DE RESPUESTAS A ESTA REALIDAD </b> </label>
                      <p><small>Leer más...</small></p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="imagenes/web/inauguracion-SCZ.jpg" alt="img" class="carrusel">
                    <div class="carousel-caption">
                     <label class="text-white"><b>TIERRA</b> </label>
                      <p><small>Leer más...</small></p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="imagenes/web/mesa-dialogo.jpg" alt="img" class="carrusel">
                    <div class="carousel-caption">
                     <label class="text-white"><b>CAMPESINOS E INDÍGENAS REPLANTEAN SU AGENDA DE REIVINDICACIONES</b> </label>
                      <p><small>Leer más...</small></p>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="imagenes/web/mesa-binacional.jpg" alt="img" class="carrusel">
                    <div class="carousel-caption">
                     <label class="text-white"><b>TIERRA ORGANIZÓ UN ENCUENTRO ENTRE CAMPESINOS E INDÍGENAS DE BOLIVIA Y PERÚ</b> </label>
                      <p><small>Leer más...</small></p>
                    </div>
                  </div>
                </div>

                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                 <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                 <span class="carousel-control-next-icon"></span>
                </a>
               </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Ahora
                </div>
              </div>
            </div>-->
          </div>
        </div>
      </div>
      
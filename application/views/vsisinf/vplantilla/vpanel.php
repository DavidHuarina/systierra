   <div class="panel-header">
        <div class="header text-center">
          <h2 class="title">SysTierra</h2>
          <p class="category">SysTierra es una aplicacion que permite a los usuarios interactuar con los proyectos y actividades en curso realizados en <a target="_blank" href="http://www.ftierra.org/index.php">Tierra</a>. Descripcion - Open Source (Codigo abierto) 

          </p>
        </div>
    </div>
    <div class="content">
      
        <div class="row">
          <div class="col-lg-6">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category"><?=$nproy->num?></h5>
                <h4 class="card-title">Proyectos</h4>
                <div class="dropdown">
                  <button type="button" class="btn btn-round btn-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                    <i class="now-ui-icons loader_gear"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Opcion</a>
                    <a class="dropdown-item" href="#">Otra opcion</a>
                    <a class="dropdown-item" href="#">Opcion 3</a>
                    <a class="dropdown-item text-danger" href="#">Eliminar</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <button id="actividadbtn" class="btn btn-secondary">
                    <i class="now-ui-icons arrows-1_refresh-69"></i> Actualizar datos
                </button>
                <div class="chart-area">
                  <canvas id="proy"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Ahora
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category"><?=$nact->num?></h5>
                <h4 class="card-title">Actividades</h4>
                <div class="dropdown">
                  <button type="button" class="btn btn-round btn-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                    <i class="now-ui-icons loader_gear"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Opcion</a>
                    <a class="dropdown-item" href="#">Otra opcion</a>
                    <a class="dropdown-item" href="#">Opcion 3</a>
                    <a class="dropdown-item text-danger" href="#">Eliminar</a>
                  </div>
                </div>

              </div>
              <div class="card-body">
                <button id="renderBtn" class="btn btn-danger">
                    <i class="now-ui-icons arrows-1_refresh-69"></i> Actualizar datos
                </button><br>
                <div class="chart-area">
                 <canvas id="actividad-chart"></canvas>
                </div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Ahora
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
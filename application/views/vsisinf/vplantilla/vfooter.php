<!-- Sart Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header justify-content-center">
            <p class="text-lg">Salir del sistema</p>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>
            
          </div>
          <div class="modal-body">
            <p><?=$nombreUsuario?>, ¿Estas seguro  que quieres cerrar tu sesi&oacute;n?
            </p>
          </div>
          <div class="modal-footer">
            <button onclick="window.location.href='salirSistema'" type="button" class="btn btn-default">Si</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
    </div>
    <!--  End Modal -->


<footer class="footer">
        <div class="container">
          <nav>
            <ul>
              <li>
                <a href="http://facebook.com/da.mendozZ" target="_blank">
                  Facebook
                </a>
              </li>
              <li>
                <a href="https://dhuarinasoft.blogspot.com/" target="_blank">
                  Blog
                </a>
              </li>
              <li>
                <a href="#">
                  Acerca de
                </a>
              </li>
              
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy;
            <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Creado por
            <a href="https://davidhuarina25.wixsite.com/davidhuarina" target="_blank">David Huarina</a>. En base a
            <a href="#" target="_blank">Now UI</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="apps/assets/js/core/jquery.min.js"></script>
  <script src="apps/assets/js/core/popper.min.js"></script>
  <script src="apps/assets/js/core/bootstrap.min.js"></script>
  <script src="apps/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB73ke5Q_aeGB2pp0RU3t6mzFv0OKtMFmE"></script>
  <!-- Chart JS -->
  <script src="apps/assets/js/plugins/chartjs.min.js"></script>
  <script src="apps/assets/demo/demo.js"></script>
  <!--  Notifications Plugin    -->
  <script src="apps/assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="apps/assets/js/now-ui-dashboard.min.js?v=1.2.0" type="text/javascript"></script>
  <script src="apps/plugins/chosen/chosen.jquery.min.js"></script>
   <script src="apps/plugins/datepicker/js/bootstrap-datepicker.js"></script>
  <script src="apps/plugins/jscrollpane/js/jquery.jscrollpane.min.js"></script>
  <script src="apps/datatables/jquery.dataTables.js"></script>
    <script src="apps/datatables/dataTables.bootstrap4.js"></script>
     <!--CARGAR DATOS PARA EL FILTRO DATATABLE-->
  <script src="apps/datatables/dataTables.buttons.min.js"></script>
  <script src="apps/datatables/buttons.flash.min.js"></script>
  <script src="apps/datatables/jszip.min.js"></script>
  <script src="apps/datatables/pdfmake.min.js"></script>
  <script src="apps/datatables/vfs_fonts.js"></script>
  <script src="apps/datatables/buttons.html5.min.js"></script>
  <script src="apps/datatables/buttons.print.min.js "></script>
  <script src="apps/datatables/dataTables.fixedColumns.min.js"></script>
  <script src="apps/datatables/moment.min.js"></script>
  <script src="apps/datatables/daterangepicker.min.js"></script>
  <!--FIN DE DATOS DATATABLE-->
  
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="apps/plugins/fullcalendar/lib/moment.min.js" type="text/javascript"></script>
  <script src="apps/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>
  <script src='apps/plugins/fullcalendar/locale-all.js'></script>

  <script src="apps/plugins/checksi/src/0.1.3/js/checkBo.min.js"></script>
  <script>
    $('.example1').checkBo({checkAllButton:"#todos_tipo",checkAllTarget:".checkbox-row",checkAllTextDefault:"Check All",checkAllTextToggle:"Un-check All"});
    
    $('.examplePar').checkBo({checkAllButton:"#todos_par",checkAllTarget:".checkbox-row",checkAllTextDefault:"Check All",checkAllTextToggle:"Un-check All"});
     $('#form_cb').checkBo();
     $('#proy_cb').checkBo();
  </script>
  <script src="apps/js/export.min.js"></script>
  <script src="apps/js/funciones.js"></script>

  <script src="apps/plugins/tab/demo/src/tabulous.min.js"></script>

  <!--MAPAS LEAFLET-->
  <script src="apps/plugins/leaflet/leaflet.js"></script>

  <script src="apps/plugins/leafletshapefile/leaflet.shpfile.js"></script>
  <script src="apps/plugins/leafletshapefile/shp.js"></script>
   <script src="apps/js/mapas.js"></script>
   <script src="apps/plugins/StickyTableHeaders-master/js/jquery.stickytableheaders.js"></script>
  <script>
    $(document).ready(function() {
     <?php 
       //if($title_nav=='Inicio'){
        ?>//notificacion('bottom','right','<table><tr><td><img src=\'imagenes/autenticacion/quienes-somos.jpg\'></td><td class=\'text-white\'>SYS-TIERRA<BR>Bienvenido al sistema de informacion y seguimiento de actividades en proyectos</td></tr></table>','warning','');
        <?php
       //}
     ?>
     
    $('#calendar').fullCalendar({
      locale: 'es',
      header: {
        center: 'listYear,month,basicWeek,listWeek' // buttons for switching between views
      },
      eventRender: function(eventObj, $el) {
      $el.popover({
        title: eventObj.title,
        content: eventObj.description,
        trigger: 'hover',
        placement: 'top',
        container: 'body'
      });
    },
     events: eventoCalendar,
     eventColor:'#1498e9',
      eventClick: function(info) {
      var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
      var f=new Date(info.start.format('YYYY'),info.start.format('MM'),info.start.format('DD'));

      notificacion('bottom','right',' '+info.title+' <br> Fecha: '+info.start.format('DD/MM/YYYY')+' <br>'+info.description,'info','now-ui-icons ui-1_calendar-60');
      },
     dayClick: function(date, jsEvent, view) {
       
       $('#modnact').modal('show');
       $('#factividad').val(date.format("DD/MM/YYYY"));
     }
    });

});
    var fechaactualN = new Date();
var anionnn = fechaactualN.getFullYear();
      estadisticaPanel(nactAno[anionnn]);
      estadisticaPanel2(nactAno[anionnn]);

  </script>
</body>

</html>
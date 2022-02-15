<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="apps/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="apps/assets/img/ft.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    SIS-TIERRA
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="apps/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="apps/assets/css/now-ui-dashboard.css?v=1.2.0" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="apps/datatables/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="apps/plugins/jscrollpane/css/jquery.jscrollpane.css">
  <link rel="stylesheet" href="apps/plugins/datepicker/css/datepicker.css" />
    <link rel="stylesheet" href="apps/plugins/chosen/chosen.min.css" />

    <link rel="stylesheet" href="apps/plugins/fullcalendar/fullcalendar.css">

  <!-- CSS Just for demo purpose, don't include it in your project -->
  
<link rel="stylesheet" href="apps/plugins/checksi/src/0.1.3/css/checkBo.min.css">
<!--=====================================ICONS==========================================================-->
  <link rel="stylesheet" type="text/css" href="apps/icons/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="apps/icons/iconic/css/material-design-iconic-font.min.css">
  <!--Mi css-->
  <link href="apps/css/micss.css" rel="stylesheet" />
  <link href='apps/plugins/tab/demo/src/tabulous.css' rel='stylesheet' type='text/css'>

  <!--MAPAS LEAFLET-->
  <link rel="stylesheet" href="apps/plugins/leaflet/leaflet.css"
   rel='stylesheet' type='text/css'/>
   <link rel="stylesheet" href="apps/plugins/geotierra/src/L.Control.SlideMenu.css">
</head>

<body style="margin: 0; padding: 0;">
        <div id="mapi" style="position: absolute; width: 100%; height: 100%;"></div>

  <!--   Core JS Files   -->
  <script src="apps/assets/js/core/jquery.min.js"></script>
  <script src="apps/assets/js/core/popper.min.js"></script>
  <script src="apps/assets/js/core/bootstrap.min.js"></script>
  <script src="apps/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="apps/assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="apps/assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="apps/assets/js/now-ui-dashboard.min.js?v=1.2.0" type="text/javascript"></script>
  <script src="apps/plugins/chosen/chosen.jquery.min.js"></script>
  <script src="apps/plugins/datepicker/js/bootstrap-datepicker.js"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="apps/assets/demo/demo.js"></script>

  <!-- Mis funciones-->
  <script src="apps/js/funciones.js"></script>
  <script type="text/javascript" src="apps/plugins/circle/js/modernizr.custom.79639.js"></script> 

  <script src="apps/plugins/leaflet/leaflet.js"></script>

  <script src="apps/plugins/leafletshapefile/leaflet.shpfile.js"></script>
  <script src="apps/plugins/leafletshapefile/shp.js"></script>
  
  <script src="apps/plugins/geotierra/src/L.Control.SlideMenu.js"></script>



<script>
function cargaChartGeo(){
  var chartUno = document.getElementById("chart-geo");
  var datosChartUno = {
    labels: lblChartUno,
    datasets: [
        {
            data: dataChartUno,
            backgroundColor: colorChartUno,
            hoverBackgroundColor: hoverColor
        }]
};
var pieChart = new Chart(chartUno, {
    type: 'bar',
    data: datosChartUno,
     options: {
          scales: { xAxes: [{ ticks: { fontSize: 8 } }],yAxes: [{ ticks: { fontSize: 10 } }] },
            legend: {
              position: 'bottom',
                display: false
            },
            responsive: true,
            title: { display: true, text: 'TCO\'s' },

        }
  });
}
/*INICIAR MAPA */
var mymap = L.map('mapi',{
                center: [-17.500919, -64.775806],
                zoom: 5,
                zoomControl: false
            });

L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
        maxZoom: 18,
        attribution: 'SysTierra',
        id: 'mapbox.streets'
    }).addTo(mymap);

//ICONO O IMAGEN MARKER 
// http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}
// http://www.ide.cl/noticias-2/item/creacion-de-visor-de-mapas-con-qgis-y-leaflet.html   LEAFLET QGIS TUT
var greenIcon = L.icon({
    iconUrl: 'apps/full-icon/flat/map/024-placeholder.png',
    //shadowUrl: 'apps/full-icon/flat/oficina/id-card.png',

    iconSize:     [38, 38] // size of the icon
    //shadowSize:   [38, 38],  size of the shadow
    //iconAnchor:   [0, 0],  point of the icon which will correspond to marker's location
    //shadowAnchor: [0, 0],   the same for the shadow
    //popupAnchor:  [-3, -76]  point from which the popup should open relative to the iconAnchor
});

//MARKER


function stylePolygon(feature) {
 return {
   weight: 1.3, // grosor de línea
   color: '#075027', // color de línea
   opacity: 1.0, // tansparencia de línea
   fillColor: '#07a04b', // color de relleno
   fillOpacity: 1.0 // transparencia de relleno
 };
};

function stylePolygonA(feature) {
 return {
   weight: 1.3, // grosor de línea
   color: 'red', // color de línea
   opacity: 1.0, // tansparencia de línea
   fillColor: 'yellow', // color de relleno
   fillOpacity: 1.0 // transparencia de relleno
 };
};


var contarDatos=0;
var shpfile = new L.Shapefile('apps/shapes/tco.zip', {style: stylePolygon,
            onEachFeature: function(feature, layer) {
             var out = [];             
                if (feature.properties) {
                   for(var key in feature.properties){
                    if(key=='CODCAT'){
                      out.push(key+": "+feature.properties[key]);
                    }
                        
                      } 
                    layer.bindPopup("<center><b class='titulo-pop'>Propiedades de TCO</b></center><br>"+out.join("<br />"), {
                        maxHeight: 200,
                        className:'custom'
                    });
                }
            }
        });

var shpfile2 = new L.Shapefile('apps/shapes/natural.zip', {style: stylePolygonA,
            onEachFeature: function(feature, layer) {               
                if (feature.properties) {
                    layer.bindPopup(Object.keys(feature.properties).map(function(k) {
                      //contarDatos++;
                        return k + ": " + feature.properties[k];
                    }).join("<br />"), {
                        maxHeight: 200,
                        className:'custom2'
                    });
                }
            }
        });
//shpfile2.addTo(mymap);
shpfile.addTo(mymap);
//alert(contarDatos);
//AREA CIRCULAR
/*var circle = L.circle([-16.5104811, -68.1240739], {
    color: 'red',
    fillColor: '#f03',
    fillOpacity: 0.5,
    radius: 500
}).addTo(mymap);

//POLIGONO
var polygon = L.polygon([
    [51.509, -0.08],
    [51.503, -0.06],
    [51.51, -0.047]
]).addTo(mymap);
*/

          

            // contents
            var left  = "<p class='titulo-menu'>GEO VISOR DE TIERRA</p>";

            left+="<canvas id='chart-geo'></canvas>";
            left += "<hr><h4 class='text-geo-secondary'>Noticias</h4>";
            left += '<p>Noticias de ftierra.<br>';
            left+="<div id='demo_geo_tierra' class='carousel slide' data-ride='carousel'><ul class='carousel-indicators'><li data-target='#demo_geo_tierra' data-slide-to='0' class='active'></li><li data-target='#demo_geo_tierra' data-slide-to='1'></li><li data-target='#demo_geo_tierra' data-slide-to='2'></li><li data-target='#demo_geo_tierra' data-slide-to='3'></li></ul><div class='carousel-inner'><div class='carousel-item active'><img src='imagenes/web/systierra.png' alt='img' class='carrusel'><div class='carousel-caption'><label class='text-white'><b>SYSTIERRA</b> </label><p><small>Versi&oacute;n 1.1.0 <br>Developer: David Huarina M.</small></p></div></div><div class='carousel-item'><img src='imagenes/web/sys.png' alt='img' class='carrusel'><div class='carousel-caption'><label class='text-white'><b>SYSTIERRA</b> </label><p><small>Primer Panel</small></p></div></div><div class='carousel-item'><img src='imagenes/web/sys2.png' alt='img' class='carrusel'><div class='carousel-caption'><label class='text-white'><b>SYSTIERRA</b></label><p><small>Panel Actividades</small></p></div></div><div class='carousel-item'><img src='imagenes/web/sys3.png' alt='img' class='carrusel'><div class='carousel-caption'><label class='text-white'><b<p><small>Panel Solicitudes</small></p></div></div><div class='carousel-item'><img src='imagenes/web/sys4.png' alt='img' class='carrusel'><div class='carousel-caption'><label class='text-white'><b>SYSTIERRA</b> </label><p><small>Panel Proyectos</small></p></div></div><div class='carousel-item'><img src='imagenes/web/tierra.png' alt='img' class='carrusel'><div class='carousel-caption'><label class='text-white'><b>TIERRA</b> </label><p><small>NOTICIAS</small></p></div></div><div class='carousel-item'><img src='imagenes/web/conferencia.jpg' alt='img' class='carrusel'><div class='carousel-caption'><label class='text-white'><b>'MADRE TIERRA, LA AGENDA ABANDONADA”, EN BUSCA DE RESPUESTAS A ESTA REALIDAD </b> </label><p><small>Leer más...</small></p></div></div><div class='carousel-item'><img src='imagenes/web/inauguracion-SCZ.jpg' alt='img' class='carrusel'><div class='carousel-caption'><label class='text-white'><b>TIERRA</b> </label><p><small>Leer más...</small></p></div></div><div class='carousel-item'><img src='imagenes/web/mesa-dialogo.jpg' alt='img' class='carrusel'><div class='carousel-caption'><label class='text-white'><b>CAMPESINOS E INDÍGENAS REPLANTEAN SU AGENDA DE REIVINDICACIONES</b> </label><p><small>Leer más...</small></p></div></div><div class='carousel-item'><img src='imagenes/web/mesa-binacional.jpg' alt='img' class='carrusel'><div class='carousel-caption'><label class='text-white'><b>TIERRA ORGANIZÓ UN ENCUENTRO ENTRE CAMPESINOS E INDÍGENAS DE BOLIVIA Y PERÚ</b> </label><p><small>Leer más...</small></p></div></div></div><a class='carousel-control-prev' href='#demo_geo_tierra' data-slide='prev'><span class='carousel-control-prev-icon'></span></a><a class='carousel-control-next' href='#demo_geo_tierra' data-slide='next'><span class='carousel-control-next-icon'></span></a></div>";

            var right = "<h3 class='titulo-menu-der'>Filtros en capas</h3>";
            var contents = '<hr>';
            contents += "<h4 class='text-geo-secondary'>Descripción de los mapas de los TCO's</h4>";
            contents += '<p>Descripcion de los datos de un shape.<br>';
            contents += 'Actualizaremos los datos segun requerimiento, cargando archivos shapes al sistema.<br>';
            contents += 'Sector para noticias y cuadros estadisticos en el geovisor TIERRA.</p>';
            /*contents += '<h3>Usage</h3>';
            contents += '<p>L.control.slideMenu("&lt;p&gt;test&lt;/p&gt;").addTo(map);</p>';
            contents += '<h3>Arguments</h3>';
            contents += '<p>L.control.slideMenu(&lt;String&gt;innerHTML, &lt;SlideMenu options&gt;options?)</p>';
            contents += '<h3>Options</h3>';
            contents += '<p>position<br>';
            contents += 'menuposition<br>';
            contents += 'width<br>';
            contents += 'height<br>';
            contents += 'direction<br>';
            contents += 'changeperc<br>';
            contents += 'delay<br>';
            contents += 'icon<br>';
            contents += 'hidden</p>';
            contents += '<h3>Methods</h3>';
            contents += '<p>setContents(&lt;String&gt;innerHTML)</p>';
            contents += '<h3>License</h3>';
            contents += '<p>MIT</p>';*/

            // left
            L.control.slideMenu(left + contents).addTo(mymap);

            // right
            var slideMenu = L.control.slideMenu('', {position: 'topright', menuposition: 'topright', width: '30%', height: '400px', delay: '50', icon: 'fa-chevron-left'}).addTo(mymap);
            slideMenu.setContents(right + contents);
            
            /*lblChartUno[0]='holas';
             dataChartUno[0]=78;
             colorChartUno[0]='#224c04';

             lblChartUno[1]='chao';
             dataChartUno[1]=48;
             colorChartUno[1]='#a27800';
             hoverColor[0]='#b25134';
             hoverColor[1]='#b25134';*/
             lblChartUno=['OP1','OP2','OP3','OP4','OP5','OP6','OP7','OP8','OP9','OP10'];
             dataChartUno=[78,45,35,55,45,88,51,47,28,70];
             colorChartUno=['#b25134','#b25134','#b25134','#b25134','#b25134','#b25134','#b25134','#b25134','#b25134','#b25134'];
             hoverColor=['#fa450f','#fa450f','#fa450f','#fa450f','#fa450f','#fa450f','#fa450f','#fa450f','#fa450f','#fa450f']; 
            cargaChartGeo();

        </script>
</body>

</html>
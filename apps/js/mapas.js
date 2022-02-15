/*INICIAR MAPA */
var mymap = L.map('mapid').setView([-17.500919, -64.775806], 5);

L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=sk.eyJ1IjoiZGF2aWRodWFyaW5hMjUiLCJhIjoiY2pzeXBlaHZoMTVqNTQ5b2IyaWdqM3ZtOCJ9._57pleihDl8BVxaEeB9B0g', {
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
var marker = L.marker([-16.5104811, -68.1240739]/*,{icon: greenIcon}*/).addTo(mymap);
marker.bindPopup("<b>Tierra</b><br>Regional Altiplano<br><img class='img-sm' src='"+dirRegAl[1]+"'> "+dirRegAl[0]).openPopup();
var marker2 = L.marker([-17.775861, -63.1605]).addTo(mymap);
marker2.bindPopup("<b>Tierra</b><br>Regional Oriente<br><img class='img-sm' src='"+dirRegVa[1]+"'> "+dirRegVa[0]);
var marker3 = L.marker([-19.0498142, -65.2651583]).addTo(mymap);
marker3.bindPopup("<b>Tierra</b><br>Regional Valles<br><img class='img-sm' src='"+dirRegOr[1]+"'> "+dirRegOr[0]);

function stylePolygon(feature) {
 return {
   weight: 1.3, // grosor de línea
   color: 'white', // color de línea
   opacity: 1.0, // tansparencia de línea
   fillColor: 'green', // color de relleno
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
                        maxHeight: 200
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



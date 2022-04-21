/*
NUEVO CHAR DE COLORES HTML PASTEL
var oilCanvas = document.getElementById("oilChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var oilData = {
    labels: [
        "Saudi Arabia",
        "Russia",
        "Iraq",
        "United Arab Emirates",
        "Canada"
    ],
    datasets: [
        {
            data: [133.3, 86.2, 52.2, 51.2, 50.2],
            backgroundColor: [
                "#FF6384",
                "#63FF84",
                "#84FF63",
                "#8463FF",
                "#6384FF"
            ]
        }]
};

var pieChart = new Chart(oilCanvas, {
  type: 'pie',
  data: oilData
});*/
function calculaSaldoDes(){
  var importe=$('#monto_importe').val();
  var descargo=$('#totdesca').val();
  var saldo=importe-descargo;
  if(importe==""){
  document.getElementById('mensajito').innerHTML="<span class='fa fa-warning text-warning'></span> <small class='text-dark'>Debe ingresar el importe..<small>";
  }else{
    if(importe<=descargo){
      document.getElementById('mensajito').innerHTML="<span class='fa fa-exclamation-circle text-danger'></span> <small class='text-dark'>El importe es menor al total descargado!!<small>";
       document.getElementById('banco').value="";
       document.getElementById('ncheque').value="";
    }else{
      document.getElementById('mensajito').innerHTML="";
      document.getElementById('datosbanco').style.display="block";
      
    }
    document.getElementById('calculaSaldoDes').style.display="none";
    document.getElementById('calculaSaldoDesDes').style.display="block";
    document.getElementById('importe_monto').style.display="none";
    document.getElementById('saldodepo').innerHTML=saldo;
    document.getElementById('importedepo').innerHTML=importe;
    document.getElementById('findescar').style.display="block";
  }
  
}
function calculaSaldoDesDes(){
  document.getElementById('mensajito').innerHTML="";
  document.getElementById('calculaSaldoDes').style.display="block";
  document.getElementById('calculaSaldoDesDes').style.display="none";
  document.getElementById('importe_monto').style.display="block";

  document.getElementById('datosbanco').style.display="none";
  document.getElementById('findescar').style.display="none";
  document.getElementById('saldodepo').innerHTML="Editando...";


}

function exportTableToExcelAux(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel;charset=ISO-8859-1';
    var tableSelect = document.getElementById(tableID);

    var cabecera="<table>"+
               "<tr style='color:white;background:blue;'>"+
                   "<td><div style='background:red'>Reportes:</div></td>"+
                   "<td>Financiero</td>"+
                   "<td>seee</td>"+
               "</tr>"+
              "</table>";

    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    tableHTML=cabecera+tableHTML;
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(["\ufeff", tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file

        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
function exportTableToExcel(tableID, filename){

    var tableSelect = document.getElementById(tableID);
    Exporter.export(tableSelect, filename+'.xls','TIERRA');
}
function exportTableToCSV($table, filename) {
     //rescato los títulos y las filas
     var $Tabla_Nueva = $table.find('tr:has(td,th)');
     // elimino la tabla interior.
     var Tabla_Nueva2= $Tabla_Nueva.filter(function() {
          return (this.childElementCount != 1 );
     });
 
     var $rows = Tabla_Nueva2,
         // Los caracteres delimitadores temporales no se pueden escribir con el teclado
         // Esto es para evitar dividir accidentalmente el contenido real
         tmpColDelim = String.fromCharCode(11), // vertical tab character
         tmpRowDelim = String.fromCharCode(0), // null character
 
         // Solo Dios Sabe por que puse esta linea
         colDelim = (filename.indexOf("xls") !=-1)? '"\t"': '","',
         rowDelim = '"\r\n"',
 
 
         // Toma texto de la tabla en una cadena con formato CSV
         csv = '"' + $rows.map(function (i, row) {
             var $row = $(row);
             var   $cols = $row.find('td:not(.hidden),th:not(.hidden)');
              alert($row.text());
             return $cols.map(function (j, col) {
                 var $col = $(col);
                 var text = $col.text().replace(/\./g, '');

                 alert($col.text());//muestra el contenido de las columnas
                 return text.replace('"', '""'); // escapar comillas dobles
 
             }).get().join(tmpColDelim);
             csv =csv +'"\r\n"' +'fin '+'"\r\n"';
         }).get().join(tmpRowDelim)
             .split(tmpRowDelim).join(rowDelim)
             .split(tmpColDelim).join(colDelim) + '"';
 
 
      download_csv(csv, filename);
 
 
 }


function download_csv(csv, filename) {

     var csvFile;
     var downloadLink;

     // CSV FILE
     csvFile = new Blob([csv],{type:'application/vnd.ms-excel'});
 
     // Download link
     downloadLink = document.createElement("a");
 
     // File name
     downloadLink.download = filename;
 
     // We have to create a link to the file
     downloadLink.href = window.URL.createObjectURL(csvFile);
    // link.href = 'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,' + encodeURIComponent(data)
     alert(downloadLink.href);
     // Make sure that the link is not displayed
     downloadLink.style.display = "none";
 
     // Add the link to your DOM
     document.body.appendChild(downloadLink);
 
     // Lanzamos
     downloadLink.click();
 }
 function s2ab(s) {
  var buf = new ArrayBuffer(s.length);
  var view = new Uint8Array(buf);
  for (var i=0; i!=s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
  return buf;
}
function format ( d ) {
  var html='';
  var parametros={"id_df":d[2]};
   var re= $.ajax({
        type: "POST",
        dataType: 'html',
        url: "creportesproy/cargarDetalle",
        data: parametros,
        async: false
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});

  return re.responseText;
    // `d` is the original data object for the row
}

function activaTab(tab){ 
  $('.nav-tabs a[href="#' + tab + '"]').tab('show'); 
}
function mostrarChecked(id,div) {
  //$('#'+id).removeAttr('checked');
  var checkBox = document.getElementById(id);
  // Get the output text
  var text = document.getElementById(div);

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "none";
  } else {
    text.style.display = "block";
  }
}
function generarReporte(){

  var proy = $('[name="proy[]"]').serializeArray();
  var tipo = $('[name="tipo[]"]').serializeArray();
  var parti = $('[name="parti[]"]').serializeArray();
  var desde = $("#fi_p").val();
  var hasta = $("#ff_p").val();
   var parametros={"proy":proy,"tipo":tipo,"desde":desde,"hasta":hasta,"parti":parti};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "creportes/enviarDatos",
        data: parametros,
        beforeSend: function () {
          //notificacion('top','right','Procesando datos espere....','info','now-ui-icons ui-1_calendar-60');
        //$('#mensaje').html('<center><img width=\'100\' height=\'100\' src=\'imagenes/carga.gif\'></center><div class=\'progress\'><div class=\'progress-bar bg-warning\' style=\'width:40%\'>40%</div></div>');
          $('#mensaje').html('<center><img width=\'100\' height=\'100\' src=\'imagenes/carga.gif\'></center>');
          
        },
        success:  function (resp) {
          //notificacion('top','right','Reporte Genereado','primary','now-ui-icons business_chart-pie-36');
          $('#mensaje').html(resp);
          $('#table-repo').DataTable();
          cargaChartUno();
          var btn=document.getElementById('btn-reportes');
          btn.style.display = "block";
          var btn2=document.getElementById('btn-reportes-excel');
          btn2.style.display = "block";
          //$('#mensaje').hide().fadeIn(1500)
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function generarReportePDF(){

  var proy = $('[name="proy[]"]').serializeArray();
  var tipo = $('[name="tipo[]"]').serializeArray();
  var parti = $('[name="parti[]"]').serializeArray();
  var desde = $("#fi_p").val();
  var hasta = $("#ff_p").val();
  window.location.href="creportes/generarPDF?proy="+proy+"&tipo="+tipo+"&desde="+desde+"&hasta="+hasta+"&parti="+parti;    
}
var lblChartUno= [];
var colorChartUno= [];
var dataChartUno= [];
var hoverColor= [];
function cargaChartUno(){
  var chartUno = document.getElementById("chart-uno");
  var datosChartUno = {
    labels: lblChartUno,
    datasets: [
        {
            data: dataChartUno,
            backgroundColor: colorChartUno
        }]
};
  var pieChart = new Chart(chartUno, {
    type: 'pie',
    data: datosChartUno,
     options: {
            legend: {
              position: 'bottom',
                display: true
            },
            responsive: true,
            maintainAspectRatio: false,
            title: { display: true, text: 'Participantes' },
            animation: {
                duration: 1200,
                easing: "easeOutQuart",
                onComplete: function () {
                    var ctx = this.chart.ctx;
                    ctx.font='11px LatoRegular, Helvetica,sans-serif';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'bottom';
                    this.data.datasets.forEach(function (dataset) {
                        for (var i = 0; i < dataset.data.length; i++) {
                            var m = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                    t = dataset._meta[Object.keys(dataset._meta)[0]].total,
                                 mR = m.innerRadius +(m.outerRadius - m.innerRadius) / 2,
                                sA = m.startAngle,
                                eA = m.endAngle,
                                mA = sA + (eA - sA)/2;
                            var x = mR * Math.cos(mA);
                            var y = mR * Math.sin(mA);
                            ctx.fillStyle = '#fff';

                            var p = String(Math.round(dataset.data[i]/t*100)) + "%";
                            if(dataset.data[i] > 0) {
                                ctx.fillText(dataset.data[i], m.x + x, m.y + y-10);
                                ctx.fillText(p, m.x + x, m.y + y + 5);
                            }
                        }
                    });
                }
            }

        }
  });

}

function cargarObj(id,id2){
  var checkBox = document.getElementById(id2);

  if (checkBox.checked != true){
   id='NINUGNO';
  }
  var parametros={"id_p":id};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "creportes/cargaObj",
        data: parametros,
        beforeSend: function () {

        },
        success:  function (resp) {
          $('#sel-obj').html(resp);
          $("#sel-obj").trigger("chosen:updated");
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function setearSel(x,n,im){
  $("#reg").val(x);
  $("#reg_i").val(x);
  $("#titulo_label").html(n);
  $('#opciones_reg').hide().fadeOut(1500);
  $('#menu_register').hide().fadeIn(1500);
  $('#my_image').attr('src',im);
}

$("#nombre_otro").on("keyup", function() {
  if($("#nombre_otro").val().length==0){
  document.getElementById('btn-register-invitado').style.display="none"; 
  }else{
    document.getElementById('btn-register-invitado').style.display="block"; 
  }
  
});

 function subActividad(ac){
  $('#act_padre').val(ac);
 }
 $('#radioB').change(function(){
            var selected_value = $("input[name='optradio']:checked").val();
                  alert(selected_value);
              });
function cambiaAEsta(anex){
    chartActividad.destroy();
    estadisticaPanel(nactAno[anex]);
  }
  function cambiaAEsta2(anex){
    chartActividad2.destroy();
    estadisticaPanel2(nactAno[anex]);

  }
  function subirnuevosDatos(chartn,n,xdato){
   for (var i=0;i<n;i++){
     chartn.data.labels.push(i);
    chartn.data.datasets.forEach((dataset) => {
        dataset.data.push(xdato[i]);
    });
    chartn.update();
    }
    
  }
function eliminarDatosChart(chartn,n){
  for (var i=1;i<=n;i++){
     chartn.data.labels.pop();
    chartn.data.datasets.forEach((dataset) => {
        dataset.data.pop();
    });
    chartn.update();
  }
  
}
function agregarCalendario(){
   $('#calendar').fullCalendar({
      locale: 'es',
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
     eventClick: function(info) {
      notificacion('top','center','hola','red','');
      }
    });
}
function irafecha(){
  if($('#ano_c').val()==""||$('#mes_c').val()==""||$('#dia_c').val()==""){
    $('#men_fecha').html("debe llenar los espacios");
  }
  var fecha=$('#ano_c').val();
  fecha=fecha+$('#mes_c').val();
  fecha=fecha+$('#dia_c').val();
  $('#calendar').fullCalendar('gotoDate',fecha);
}
function listarDias(){
  var contador= [0,0,0,0,0,0,0];
  var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
  
  for (var i = 0; i < eventoCalendar.length; i++) {

    var f=new Date(eventoCalendar[i].start.format('YYYY'),eventoCalendar[i].start.format('MM'),eventoCalendar[i].start.format('DD'));
    switch(diasSemana[f.getDay()]){
      case "Domingo":
      contador[f.getDay()]++;
      break;
      case "Lunes":
      contador[f.getDay()]++;
      break;
      case "Martes":
      contador[f.getDay()]++;
      break;
      case "Miércoles":
      contador[f.getDay()]++;
      break;
      case "Jueves":
      contador[f.getDay()]++;
      break;
      case "Viernes":
      contador[f.getDay()]++;
      break;
      case "Sábado":
      contador[f.getDay()]++;
      break;
    }
  }
  $('#lunes_evento').html(contador[1]);
}
function notificacion(a,e,txt,col,ic){
  color=col,
  $.notify({
    icon:ic,
    message:txt
   },{
    type:color,
    timer:8e3,
    placement:{from:a,align:e}
  })}

function verPdf(div,dir){
  $('#'+div).show(1000);
  $('#pdframe').attr('src',dir);
}

function nres(idp){
    var obe_codd = $("#obe_codd").val();
    var res_o = $("#res_o").val();
    var parametros={"obe_codd":obe_codd,"res_o":res_o,"id":idp};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cdetalle_proyecto/nres",
        data: parametros,
        beforeSend: function () {
               $("#mensaje_modal").html("");
        },
        success:  function (resp) {
                $('#nres').modal('toggle');
                $("#res_o").val("");
                $("#obe_codd").val("");
                verResultados(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function nind(idp){
    var res_codd = $("#res_codd").val();
    var ind_r = $("#ind_r").val();
    var parametros={"res_codd":res_codd,"ind_r":ind_r,"id":idp};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cdetalle_proyecto/nind",
        data: parametros,
        beforeSend: function () {
               $("#mensaje_modal").html("");
        },
        success:  function (resp) {
                $('#nind').modal('toggle');
                $("#ind_r").val("");
                $("#res_codd").val("");
                verIndicador(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function nact(idp){
    var ind_codigo = $("#ind_codigo").val();
    var act_i = $("#act_i").val();
    var parametros={"ind_codigo":ind_codigo,"act_i":act_i,"id":idp};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cdetalle_proyecto/nact",
        data: parametros,
        beforeSend: function () {
               $("#mensaje_modal").html("");
        },
        success:  function (resp) {
                $('#nact').modal('toggle');
                $("#act_i").val("");
                $("#ind_codigo").val("");
                verActividad(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function eres(idp){
    var codres_e = $("#codres_e").val();
    var res_e = $("#res_e").val();
    var parametros={"codres_e":codres_e,"res_e":res_e,"id":idp};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cdetalle_proyecto/eres",
        data: parametros,
        beforeSend: function () {
               $("#mensaje_modal").html("");
        },
        success:  function (resp) {
                $('#eres').modal('toggle');
                $("#res_e").val("");
                $("#codres_e").val("");
                verResultados(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function eind(idp){
    var codind_e = $("#codind_e").val();
    var ind_e = $("#ind_e").val();
    var parametros={"codind_e":codind_e,"ind_e":ind_e,"id":idp};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cdetalle_proyecto/eind",
        data: parametros,
        beforeSend: function () {
               $("#mensaje_modal").html("");
        },
        success:  function (resp) {
                $('#eind').modal('toggle');
                $("#ind_e").val("");
                $("#codind_e").val("");
                verIndicador(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function eact(idp){
    var ind_codigo_e = $("#ind_codigo_e").val();
    var act_i_e = $("#act_i_e").val();
    var parametros={"ind_codigo_e":ind_codigo_e,"act_i_e":act_i_e,"id":idp};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cdetalle_proyecto/eact",
        data: parametros,
        beforeSend: function () {
               $("#mensaje_modal").html("");
        },
        success:  function (resp) {
                $('#eact').modal('toggle');
                $("#act_i_e").val("");
                $("#ind_codigo_e").val("");
                verActividad(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function elres(idp){
    var cod_el = $("#cod_el").val();
    var parametros={"cod_el":cod_el,"id":idp};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cdetalle_proyecto/elres",
        data: parametros,
        beforeSend: function () {
               $("#mensaje_modal").html("");
        },
        success:  function (resp) {
                $('#elres').modal('toggle');
                $("#cod_el").val("");
                verResultados(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert("fallo al eliminar!, elimine los indicadores que estan registrados primero...");});
}
function elind(idp){
    var codind_el = $("#codind_el").val();
    var parametros={"codind_el":codind_el,"id":idp};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cdetalle_proyecto/elind",
        data: parametros,
        beforeSend: function () {
               $("#mensaje_modal").html("");
        },
        success:  function (resp) {
                $('#elind').modal('toggle');
                $("#codind_el").val("");
                verIndicador(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert("fallo al eliminar!, elimine las actividades que estan registradas primero...");});
}
function elact(idp){
    var ind_codigo_el = $("#ind_codigo_el").val();
    var parametros={"ind_codigo_el":ind_codigo_el,"id":idp};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cdetalle_proyecto/elact",
        data: parametros,
        beforeSend: function () {
               $("#mensaje_modal").html("");
        },
        success:  function (resp) {
                $('#elact').modal('toggle');
                $("#ind_codigo_el").val("");
                verActividad(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert("fallo al eliminar!, elimine los indicadores que estan registrados primero...");});
}
function editar_usuario(){
  var nombre_u = $("#nombre_u").val();
    var apellido_u = $("#apellido_u").val();
    var telefono_u = $("#telefono_u").val();
    var correo_u = $("#correo_u").val();
    var fnac_u = $("#fnac_u").val();
    var dir = $("#dir_u").val();
    var sobre = $("#sobre").val();
    var parametros={"nombre_u":nombre_u,"apellido_u":apellido_u,"telefono_u":telefono_u,"correo_u":correo_u,"fnac_u":fnac_u,"dir_u":dir,"sobre":sobre};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cusuario_edit/edit_u",
        data: parametros,
        beforeSend: function () {
               
        },
        success:  function (resp) {
                alert("se actualizo");
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});    
}
function editarUContra(){
    var contra_a_u = $("#contra_a_u").val();
    var contra_n_u = $("#contra_n_u").val();
    var contra_nr_u = $("#contra_nr_u").val();
    var parametros={"contra_a_u":contra_a_u,"contra_n_u":contra_n_u,"contra_nr_u":contra_nr_u};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cusuario_editC/edit_c",
        data: parametros,
        beforeSend: function () {
                $("#mensajeC").html("<label>Procesando datos espere...</label>");
        },
        success:  function (resp) {
                $("#mensajeC").html(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
    
}

function cambiar(){
    var pdrs=document.getElementById('imagen_u').files[0].name;
    document.getElementById('info').innerHTML='<label class=\'text-muted\'>'+pdrs+'</label>';
}

var tfiltro=0;
function agregarFiltros(tabla_id){
  if(tfiltro==0){
    $('#'+tabla_id).DataTable();
    tfiltro=1;
  }else{
     $('#'+tabla_id).DataTable().destroy();
     tfiltro=0;
  }
  
}

function chosen_escoje(){ 
 $("#sel-com").chosen({width: "95%"});
}
function verResultados(id){
  $("#resultados").load("cdetalle_proyecto/resultados?ido="+id);
}
function verIndicador(id){
  $("#indicador").load("cdetalle_proyecto/indicador?idres="+id);
}
function verActividad(id){
  $("#actividad").load("cdetalle_proyecto/actividad?idind="+id);
}
var contmenu=0;
function cambiaMenu(){
  if(contmenu==0){
    $("#img-menu").attr("src","apps/full-icon/flat/contacto/archive-3.png");
    contmenu=1;
  }else{
    $("#img-menu").attr("src","apps/full-icon/flat/contacto/archive-2.png");
    contmenu=0;
  }
  
}
var contmenu2=0;
function cambiaMenu2(){
  if(contmenu2==0){
    $("#img-menu").attr("src","apps/full-icon/flat/documentos/documents.png");
    contmenu2=1;
  }else{
    $("#img-menu").attr("src","apps/full-icon/flat/documentos/inbox-1.png");
    contmenu2=0;
  }
  
}

$("#nuevoProy").click(function () {  
                  $("#nproy").fadeOut(1000,function(){
                         $("#nproyecto").css("display", "block");
                  });           
      });

function mandarId(cad){
  var parametros={"n_s":cad};
  $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cenviar_solicitud/getIdS",
        data: parametros,
        beforeSend: function () {
                $("#cod_sr").val("Verificando...");
        },
        success:  function (resp) {
                $("#cod_sr").val(resp);
        }
    });
}
function finDescargo(id){
  var banco = $("#banco").val();
  var ncheque = $("#ncheque").val();
  var impo = $("#monto_importe").val();//sin la solicitud de debe requerir este campo
  var parametros={"banco":banco,"ncheque":ncheque,"id":id,"importe":impo};
  $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cnuevo_descargo/fin",
        data: parametros,
        beforeSend: function () {
                $("#mensajito").html("Procesando datos... Espere un momento por favor");
                $('#enviar_btn_a').attr("disabled", true);
        },
        success:  function (resp) {
                $("#mensajito").html("<label class='text-danger'>"+resp+"</label>");
                window.location.href="clista_actividad_me";
        }
    });
}
function nreembolso(id){
  var justi = $("#reembolso").val();
  var monto = $("#monto_rem").val();
  var parametros={"justi":justi,"monto":monto,"id":id};
  $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cnuevo_descargo/reembolso",
        data: parametros,
        beforeSend: function () {
                $("#mensajite").html("Verificando...");
        },
        success:  function (resp) {
                $("#mensajite").html(resp);
              window.location.href="clista_actividad_me";
        }
    });
}
function mandarIdD(cad){
  var parametros={"n_d":cad};
  $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cnuevo_descargo/getIdD",
        data: parametros,
        beforeSend: function () {
                $("#cod_det").val("Verificando...");
        },
        success:  function (resp) {
                $("#cod_det").val(resp);
        }
    });
}
function mandarIdRS(cad){
  var parametros={"n_rs":cad};
  $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cnuevo_descargo/getIdRS",
        data: parametros,
        beforeSend: function () {
                $("#cod_rs").val("Verificando...");
        },
        success:  function (resp) {
                $("#cod_rs").val(resp);
        }
    });
}
function guardarE(id_a){
     $("#equipo-trab option").each(function(){
        if ($(this).val() != "" ){
          if($(this).val()!="-1"&& $(this).is(":disabled")){
            nequipo(($(this).val()),id_a);
          }                
        }
     });
     $("#invitado-trab option").each(function(){
        if ($(this).val() != "" ){
          if($(this).val()!="-1"&& $(this).is(":disabled")){
            nequipo(($(this).val()),id_a);
          }                
        }
     });       
}

function nequipo(id,id_a){
  var parametros={"id_p":id,"id_a":id_a};
  $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cnequipo/nequipo",
        data: parametros,
        beforeSend: function () {
                $("#mensaje").html("Verificando...");
        },
        success:  function (resp) {
                $("#mensaje").html(resp);
                window.location.href="cnequipo?ac="+id_a;
        }
    });
}
 function leidoNot(id){
  var parametros={"id":id};
  $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cnotificacion/leidoNot",
        data: parametros,
        beforeSend: function () {
                $("#mensaje").html("Enviando...");
        },
        success:  function (resp) {
                $("#mensaje").html(resp);
        }
    });
}
function llenatabla(ac,id,sel){
   if(sel=='invitado'){
     $("#invitado-trab").val('-1');
     $("#invitado-trab").find("option[value='"+id+"']").prop("disabled",true);
     $("#invitado-trab").trigger("chosen:updated");
   }else{
     $("#equipo-trab").val('-1');
     $("#equipo-trab").find("option[value='"+id+"']").prop("disabled",true);
     $("#equipo-trab").trigger("chosen:updated"); 
    }   
  var parametros={"id_us":id,"id_sel":sel,"ac":ac};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cnueva_actividad/llenaT",
        data: parametros,
        beforeSend: function () {
        },
        success:  function (resp) {
          $('#cuerpo-tabla').append(resp);
        }
    });
}
function llenatablaInv(ac){ 
  var nom=$('#nombre_otro').val().trim();
  var ap=$('#ap_otro').val().trim();
  var tel=$('#tel_otro').val().trim();
  if(nom==""||ap==""){
    $("#mensaje").html("<small class='text-danger'>Llene los campos Nombre y Apellido</small>");
  }else{
     var parametros={"ac":ac,"nom":nom,"ap":ap,"tel":tel};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cnueva_actividad/llenaTI",
        data: parametros,
        beforeSend: function () {
        },
        success:  function (resp) {
          var arr = resp.split('@');
          if(arr[1]=="0"){
            $("#mensaje").html("<label class='text-warning'>La persona ya se encuentra registrada!</label>");
          }else{
            $('#invitado-trab').append($('<option>', {
                value: arr[0].trim(),
                text: arr[2].trim()
            }));
            $("#invitado-trab").val('-1');
            $("#invitado-trab").find("option[value='"+arr[0].trim()+"']").prop("disabled",true);
            $("#invitado-trab").trigger("chosen:updated");
          $('#nombre_otro').val("");
          $('#ap_otro').val("");
          $('#tel_otro').val("");
          $('#cuerpo-tabla').append(arr[1].trim());
          $("#mensaje").html("<label class='text-success'>Persona agregada!</label>");
          }          
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
  }
}
function borrarTabla(ac,id,sel){
  if(sel=='invitado'){
     $("#invitado-trab").find("option[value='"+id+"']").prop("disabled",false);
     $("#invitado-trab").trigger("chosen:updated");
   }else{
     $("#equipo-trab").find("option[value='"+id+"']").prop("disabled",false);
     $("#equipo-trab").trigger("chosen:updated"); 
    }   
   $('#'+id).remove();
    var parametros={"id":id,"ac":ac};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cnequipo/delete",
        data: parametros,
        beforeSend: function () {
          $("#mensaje").html("<label class='text-success'>Eliminando...</label>");
        },
        success:  function (resp) {
          $("#mensaje").html("<label class='text-success'>Persona eliminada!</label>");       
        }
    });
}
function eliminarEquipo(ac,id){
  var parametros={"id":id,"ac":ac};
   $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cnequipo/delete",
        data: parametros,
        beforeSend: function () {
          $("#mensaje"+ac).html("<label class='text-success'>Eliminando...</label>");
        },
        success:  function (resp) {
          $("#mensaje"+ac).html("<label class='text-success'>Persona eliminada!</label>");
          window.location.href="clista_actividad_gen";      
        }
    });
}

function borrarTablaInv(id){
   $('#'+id).remove();
}
var contacookie=0;
function cargaCookie(x){
    var cookie=x;
if(contacookie==0){

contacookie=contacookie+1;
}else{
    document.cookie='ckie='+encodeURIComponent(cookie)+';max-age=-3600;path=/';
    contacookie=0;
}
document.cookie='ckie='+encodeURIComponent(cookie)+';max-age=+3600;path=/';
 }
function mandaVal(x,y){
  $('#'+y).val(x);
}
function mandaHtml(x,y){
  $('#'+y).html(x);
}
function cambiarlbl(x,y){
  $('#'+y).text(x);
}
$(function() {
  
  // elementos de la lista
  var menues = $(".sidebar-wrapper .nav li"); 

  // manejador de click sobre todos los elementos
  menues.click(function() {
     // eliminamos active de todos los elementos
     menues.removeClass("active");
     // activamos el elemento clicado.
     $(this).addClass("active");
  });

});


(function ($) {
    "use strict";

    /*==================================================================
    [ Focus Contact2 ]*/
    $('.form-control').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })


    /*==================================================================
    [ Validate after type ]*/
    $('.validate-input .form-control').each(function(){
        $(this).on('blur', function(){
            if(validate(this) == false){
                showValidate(this);
            }
            else {
                $(this).parent().addClass('true-validate');
            }
        })    
    });
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .form-control');
    var select = $('#select-prueba');
    var select2 = $('#select-act_ml');
    var select3 = $('#select-dep');
    var select4 = $('#select-prov');
    var select5 = $('#select-mun');
    var select6 = $('#select-org');
    $('#fi_p').on('changeDate',function(e){
     $(this).parent().addClass('true-validate');
    });
    $('#ff_p').on('changeDate',function(e){
     $(this).parent().addClass('true-validate');
    });
    $(select).on('change', function() {
     if(validateSel(select) == false){
                showValidate(select);
            }
            else {
               hideValidate(select);
            }
    });
    $(select2).on('change', function() {
     if(validateSel(select2) == false){
                showValidate(select2);
            }
            else {
               hideValidate(select2);
            }
    });
    $(select3).on('change', function() {
     if(validateSel(select3) == false){
                showValidate(select3);
            }
            else {
               hideValidate(select3);
            }
    });
    $(select4).on('change', function() {
     if(validateSel(select4) == false){
                showValidate(select4);
            }
            else {
               hideValidate(select4);
            }
    });
    $(select5).on('change', function() {
     if(validateSel(select5) == false){
                showValidate(select5);
            }
            else {
               hideValidate(select5);
            }
    });
    $(select6).on('change', function() {
     if(validateSel(select6) == false){
                showValidate(select6);
            }
            else {
               hideValidate(select6);
            }
    });

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }
        //Select de formulario de proyecto
        if(validateSel(select)==false){
             showValidate(select);
                check=false;
        }else{
          hideValidate(select);
        }
        //Select de formulario de actividad
        if(validateSel(select2)==false){
             showValidate(select2);
                check=false;
        }else{
          hideValidate(select2);
        }
        //Select de formulario de actividad
        if(validateSel(select3)==false){
             showValidate(select3);
                check=false;
        }else{
          hideValidate(select3);
        }
        //Select de formulario de actividad
        if(validateSel(select4)==false){
             showValidate(select4);
                check=false;
        }else{
          hideValidate(select4);
        }
        //Select de formulario de actividad
        if(validateSel(select5)==false){
             showValidate(select5);
                check=false;
        }else{
          hideValidate(select5);
        }
        //Select de formulario de actividad
        if(validateSel(select6)==false){
             showValidate(select6);
                check=false;
        }else{
          hideValidate(select6);
        }

        return check;
    });


    $('.validate-form .form-control').each(function(){
        $(this).focus(function(){
           hideValidate(this);
           $(this).parent().removeClass('true-validate');
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).attr('type') == 'date' || $(input).attr('name') == 'fi_p') {
                if($(input).val().trim().match(/^(?:(?:(?:0?[1-9]|1\d|2[0-8])[/](?:0?[1-9]|1[0-2])|(?:29|30)[/](?:0?[13-9]|1[0-2])|31[/](?:0?[13578]|1[02]))[/](?:0{2,3}[1-9]|0{1,2}[1-9]\d|0?[1-9]\d{2}|[1-9]\d{3})|29[/]0?2[/](?:\d{1,2}(?:0[48]|[2468][048]|[13579][26])|(?:0?[48]|[13579][26]|[2468][048])00))$/) == null) {
                   return false;
                 }
             }else{
                if($(input).val().trim() == ''){
                   return false;
                 }
             }            
        }
    }
  function validateSel (sel) {
      if(sel.val()=="0"){
        return false;
      }
    }
    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }

})(jQuery);

function displayBlock(vd,vi){
  $('#'+vd).attr('checked', 'checked');
  $('#'+vi).removeAttr('checked');
  if(vi=='optradio1'){
     $('#lista-com').css("display", "none");
     $('#otro-com').css("display", "block");
     //ocultarSelectValidate('#select-com');
  }else{
    $('#lista-com').css("display", "block");
     $('#otro-com').css("display", "none");
     //hideValidate(select3);
  }
}
function displayBlockServ(vd,vi,vk){
  $('#'+vd).attr('checked', 'checked');
  $('#'+vi).removeAttr('checked');
  $('#'+vk).removeAttr('checked');

  switch(vd){
    case 'optradio1':
     $('#lista-com').css("display", "block");//div de servicios
     $('#otro-com').css("display", "none"); //div de bienes 
     $('#lista-com-via').css("display", "none"); //div de bienes 
    break;
    case 'optradio2':
     $('#lista-com').css("display", "none");//div de servicios
     $('#otro-com').css("display", "block");//div de bienes
     $('#lista-com-via').css("display", "none"); //div de bienes 
    break;
    case 'optradio3':
     $('#lista-com').css("display", "none");//div de servicios
     $('#otro-com').css("display", "none");//div de bienes
     $('#lista-com-via').css("display", "block"); //div de bienes 
    break;
  }
  
}
function displayBlockFact(vd,vi){
  $('#'+vd).attr('checked', 'checked');
  $('#'+vi).removeAttr('checked');
  if(vi=='d_optradio1'){
    // $('#lista-com_d').css("display", "none");
     $('#otro-com_d').css("display", "block");
     //ocultarSelectValidate('#select-com');
  }else{
    //$('#lista-com_d').css("display", "block");
     $('#otro-com_d').css("display", "none");
     //hideValidate(select3);
  }
}

    $("#checkboxDiv").click(function() {
    if ($("#checkbox").is(':checked'))
    {
        $("#checkbox").next().removeClass("checked");
        $('#checkbox').each(function(){ this.checked = false; });
    } else {
        $("#checkbox").next().addClass("checked");
        $('#checkbox').each(function(){ this.checked = true; });
    }
});



function validarNumero(e){
var tecla=(document.all)? e.keyCode: e.which;
  if((tecla>=48&&tecla<=57)||tecla==8){
    return true;
  }
  else{
    return false;
  }
}
function validarEnter(e){
var tecla=(document.all)? e.keyCode: e.which;
  if(tecla==13){
    return false;
  }
  else{
    return true;
  }
}
var sipunto=0;
function validarMontoSup(e){
  var cadena=$('#monto').val();
  if(cadena.indexOf('.') != -1){
    sipunto=1;
  }else{
    sipunto=0;
  }
var tecla=(document.all)? e.keyCode: e.which;
  if((tecla>=48&&tecla<=57)||tecla==8||tecla==46){
    if(tecla==46){
         sipunto++;
         if(sipunto==1){
         return true;
       }else{
         return false; 
       }
    }else{
      return true;
    }    
  }
  else{
    return false;
  }
}
function dividirCadena(cadenaADividir,separador) {
   var arrayDeCadenas = cadenaADividir.split(separador);
   return arrayDeCadenas;
}
function obtenerPorcentaje(){
  var cadena=$('#monto').val();
  var i1=$('#impuesto').val();
  var i2=$('#impuesto_ser').val();
  var i3=$('#via_impuesto').val();

    var porcent1=(parseFloat(cadena)*parseFloat(i1))/100;
    var porcent2=(parseFloat(cadena)*parseFloat(i2))/100;
    var porcent3=(parseFloat(cadena)*parseFloat(i3))/100;
    document.getElementById('monto_bien').value=(parseFloat(cadena)+porcent1).toFixed(2);
    document.getElementById('monto_serv').value=(parseFloat(cadena)+porcent2).toFixed(2);
    document.getElementById('via_monto').value=(parseFloat(cadena)+porcent3).toFixed(2);
}
$('input[name=monto]').change(function() { 
obtenerPorcentaje();
 });
 $('input[name=impuesto]').change(function() { 
obtenerPorcentaje();
 });
 $('input[name=impuesto_ser]').change(function() { 
obtenerPorcentaje();
 });
 $('input[name=via_impuesto]').change(function() { 
obtenerPorcentaje();
 });
function validarMontoSupImpuesto(e,cad){
  var cadena=$('#'+cad).val();

  if(cadena.indexOf('.') != -1){
    sipunto=1;
  }else{
    sipunto=0;
  }
var tecla=(document.all)? e.keyCode: e.which;
  if((tecla>=48&&tecla<=57)||tecla==8||tecla==46){
     
    if(tecla==46){
         sipunto++;
         if(sipunto==1){
        
         return true;
       }else{
         return false; 
       }
    }else{
      if(sipunto==0){
        
         return true;
       }else{
         var decimal=dividirCadena(cadena,".");
         if(decimal[1].length==2){
          return false;
         }else{
        
          return true;
         }
       }
    
      return true;
    }

  }
  else{
    return false;
  }
}
function validarMonto(e){
var tecla=(document.all)? e.keyCode: e.which;
  if((tecla>=48&&tecla<=57)||tecla==8||tecla==46){
    if(tecla==46){
         sipunto++;
         if(sipunto==1){
         return true;
       }else{
         return false; 
       }
    }else{
      return true;
    }    
  }
  else{
    return false;
  }
}

$("#asdasdasdsdsadasds").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
        });
    }
});
function obtenerRubro(sub){
  var parametros={"s_r":sub};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cfondo_proy/obtenerRubro",
        data: parametros,
        beforeSend: function () {
                $("#rubro").val("Verificando...");
        },
        success:  function (resp) {
                $("#rubro").val(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function obtenerCodRubro(sub){
  var parametros={"s_r":sub};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cfondo_proy/obtenerCodRubro",
        data: parametros,
        beforeSend: function () {
                $("#c_rubro").val("Verificando...");
        },
        success:  function (resp) {
                $("#c_rubro").val(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function obtenerCodSubRubro(sub){
  var parametros={"s_r":sub};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cfondo_proy/obtenerCodSubRubro",
        data: parametros,
        beforeSend: function () {
                $("#c_sub_rubro").val("Verificando...");
        },
        success:  function (resp) {
                $("#c_sub_rubro").val(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function obtenerCodRubroPorRubro(sub){
  var parametros={"s_r":sub};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cfondo_proy/obtenerCodRubroPorRubro",
        data: parametros,
        beforeSend: function () {
                $("#c_rubro").val("Verificando...");
        },
        success:  function (resp) {
                $("#c_rubro").val(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function obtenerTipoA(det){
  var parametros={"d_a":det};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cnueva_actividad/obtenerTipoA",
        data: parametros,
        beforeSend: function () {
                $("#tipo_a").val("Verificando...");
        },
        success:  function (resp) {
                $("#tipo_a").val(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}


jQuery(document).ready(function(){
 minDateFilter = "";
 maxDateFilter = "";
$.fn.dataTableExt.afnFiltering.push(
  function(oSettings, aData, iDataIndex) {
    if (typeof aData._date == 'undefined') {
      aData._date = new Date(aData[7]);
    }
    if (minDateFilter && !isNaN(minDateFilter)) {
      if (aData._date < minDateFilter) {
        return false;
      }
    }

    if (maxDateFilter && !isNaN(maxDateFilter)) {
      if (aData._date > maxDateFilter) {
        return false;
      }
    }

    return true;
  }
);
  //iniciarGoogle();
   $('#tabs').tabulous({
      effect: 'scale'
    });
   $('#table-com').DataTable();
   if ($('#table-actividad').length) {
       $('#table-actividad').DataTable();
     }


/*TABLA DE REPORTES DE PROYECTO FINANCIEROOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO*/
if ($('#table-rep-proy').length) {
  $('#btn-show-all-children').on('click', function(){
        // Expand row details
        table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
    });

   
      /*$('#table-rep-proy tfoot tr th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );*/
      var table = $('#table-rep-proy').DataTable({
        "columnDefs": [
            {
                "targets": [2],
                "visible": false,
                "searchable": false
            }
        ],
         deferRender:    true, 
  "autoWidth": false,     
  "search": {
    "regex": true,
    "caseInsensitive": false,
  },
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                messageTop:'Reporte Financiero de los Descargos realizados por actividad - TIERRA',
                exportOptions: {
                    columns: ':visible'
                }
            }, 
            {
                extend: 'csv',
                messageTop:'Reporte Financiero de los Descargos realizados por actividad - TIERRA',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                              extend: 'excel',
                              "oSelectorOpts": { filter: 'applied', order: 'current' },
                              "sFileName": "reportes actividades.xlsx",
                              action : function( e, dt, button, config ) {
                                exportTableToExcel("table-rep-proy","Reportes Descargos");
                                  //exportTableToCSV.apply(this, [$('#table-rep-proy'), 'reporte financiero.xls']);

 
                              }
 
            },
            {
                extend: 'pdf',
                messageTop:'Reporte Financiero de los Descargos realizados por actividad - TIERRA',
                exportOptions: {
                    columns: ':visible'
                },
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }, 
            {
                extend: 'print',
                messageTop:'Reporte Financiero de los Descargos realizados por actividad - TIERRA',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
        "order": [[ 1, 'asc' ]]
       });

      table.on( 'order.dt search.dt', function () {
        table.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            table.cell(cell).invalidate('dom');
        } );
    } ).draw();
       
/*
    // Apply the search
    table.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that.search( this.value ).draw();
            }
        } );
    } );*/

      /*SELECT DE FILTROS EN LA VISTA*/
       $('#sel_proy').on('change', function(){
          table.column(6).search(this.value).draw();   
       });

       $('#sel_ta').on('change', function(){
          table.column(5).search(this.value).draw();   
       });
       $('#sel_resp').on('change', function(){
          table.column(12).search(this.value).draw();   
       });
      /*FIN DE SELECTS*/
      
      $("#Date_search").val("");

       $(".boton_ocultar_mostrar").on('click', function(){
      var indice = $(this).index(".boton_ocultar_mostrar");
      $(".boton_ocultar_mostrar").eq(indice).toggleClass("btn-danger");
      var columna = table.column(indice+1);
      columna.visible(!columna.visible());
       });
       var v_cc=0;
      $("#v_basica").on('click', function(){
        var indice = $(this).index("#v_basica");
        $("#v_basica").toggleClass("buttons-print");
        if(v_cc==0){
          $("#v_basica").html('B&aacute;sica');
          v_cc=1;
        }else{
          $("#v_basica").html('Completa');         
          v_cc=0;
        }        
        var cols=[9,10,11,13];
        for (var i = 0; i < cols.length; i++) {
          table.column(cols[i]).visible(!table.column(cols[i]).visible());   
        }
       });

$('#table-rep-proy tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
    

$("#Date_search").daterangepicker({
  ranges: {
           'Hoy': [moment(), moment()],
           'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
           'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
           'Este Mes': [moment().startOf('month'), moment().endOf('month')],
           'Anterior Mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
           'Ultimos 6 Meses': [moment().subtract(5,'month').startOf('month'), moment().endOf('month')],
           'Ultimos 12 Meses':[moment().subtract(11,'month').startOf('month'), moment().endOf('month')]
        },
        "alwaysShowCalendars": true,
  "locale": {
    "format": "DD/MM/YYYY",
    "separator": " hasta ",
    "applyLabel": "Aplicar",
    "cancelLabel": "Cancelar",
    "fromLabel": "Desde",
    "toLabel": "Hasta",
    "customRangeLabel": "Aleatorio",
    "weekLabel": "W",
    "daysOfWeek": [
      "Do",
      "Lu",
      "Ma",
      "Mi",
      "Ju",
      "Vi",
      "Sa"
    ],
    "monthNames": [
      "Enero",
      "Febrero",
      "Marzo",
      "Abril",
      "Mayo",
      "Junio",
      "Julio",
      "Agosto",
      "Septiembre",
      "Octubre",
      "Noviembre",
      "Diciembre"
    ],
    "firstDay": 1
  },
  "opens": "right",
},function(start, end, label) {
  maxDateFilter = new Date(end);
  maxDateFilter.setDate(maxDateFilter.getDate() -1);
  minDateFilter = new Date(start);
  minDateFilter.setDate(minDateFilter.getDate() -1);
  table.draw();  
});
     }
     /*FIN REPORTE FINANCIEROOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO*/
     if ($('#table-rep-act').length) {
      /*$('#table-rep-act tfoot tr th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );*/
      var table = $('#table-rep-act').DataTable({
         deferRender:    true, 
  "autoWidth": false,     
  "search": {
    "regex": true,
    "caseInsensitive": false,
  },
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':visible'
                }
            }, 
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible'
                }
            }, 
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            }, 
            {
                extend: 'pdf',
                messageTop:'Reporte De Informes - TIERRA',
                exportOptions: {
                    columns: ':visible'
                },
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }, 
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ],
        "order": [[ 1, 'asc' ]]
       });

      table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
            table.cell(cell).invalidate('dom');
        } );
    } ).draw();
       
/*
    // Apply the search
    table.columns().every( function () {
        var that = this;
        $( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that.search( this.value ).draw();
            }
        } );
    } );*/

      /*SELECT DE FILTROS EN LA VISTA*/
       $('#sel_proy').on('change', function(){
         var parametros={"nproy":this.value};
            $.ajax({
            type: "POST",
            dataType: 'html',
            url: "creportes/selcom",
            data: parametros,
            success:  function (resp) {
                $("#sel_res").html(resp);
                $("#sel_res").trigger("chosen:updated");
           }
          }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});

          table.column(8).search(this.value).draw();   
       });
       $('#sel_com').on('change', function(){
          table.column(5).search(this.value).draw();   
       });
       $('#sel_ta').on('change', function(){
          table.column(10).search(this.value).draw();   
       });
       $('#sel_res').on('change', function(){
          table.column(9).search(this.value).draw();   
       });
       $('#sel_resp').on('change', function(){
          table.column(16).search(this.value).draw();   
       });
      /*FIN DE SELECTS*/
      
      $("#Date_search").val("");

       $(".boton_ocultar_mostrar").on('click', function(){
      var indice = $(this).index(".boton_ocultar_mostrar");
      $(".boton_ocultar_mostrar").eq(indice).toggleClass("btn-danger");
      var columna = table.column(indice+1);
      columna.visible(!columna.visible());
       });
       var v_cc=0;
      $("#v_basica").on('click', function(){
        var indice = $(this).index("#v_basica");
        $("#v_basica").toggleClass("buttons-print");
        if(v_cc==0){
          $("#v_basica").html('B&aacute;sica');
          v_cc=1;
        }else{
          $("#v_basica").html('Completa');         
          v_cc=0;
        }        
        var cols=[2,3,4,9,13,14,15,18,19,20,21,22,23,24,25,26,27];
        for (var i = 0; i < cols.length; i++) {
          table.column(cols[i]).visible(!table.column(cols[i]).visible());   
        }
       });


    

$("#Date_search").daterangepicker({
  ranges: {
           'Hoy': [moment(), moment()],
           'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
           'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
           'Este Mes': [moment().startOf('month'), moment().endOf('month')],
           'Anterior Mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
           'Ultimos 6 Meses': [moment().subtract(5,'month').startOf('month'), moment().endOf('month')],
           'Ultimos 12 Meses':[moment().subtract(11,'month').startOf('month'), moment().endOf('month')]
        },
        "alwaysShowCalendars": true,
  "locale": {
    "format": "DD/MM/YYYY",
    "separator": " hasta ",
    "applyLabel": "Aplicar",
    "cancelLabel": "Cancelar",
    "fromLabel": "Desde",
    "toLabel": "Hasta",
    "customRangeLabel": "Aleatorio",
    "weekLabel": "W",
    "daysOfWeek": [
      "Do",
      "Lu",
      "Ma",
      "Mi",
      "Ju",
      "Vi",
      "Sa"
    ],
    "monthNames": [
      "Enero",
      "Febrero",
      "Marzo",
      "Abril",
      "Mayo",
      "Junio",
      "Julio",
      "Agosto",
      "Septiembre",
      "Octubre",
      "Noviembre",
      "Diciembre"
    ],
    "firstDay": 1
  },
  "opens": "right",
},function(start, end, label) {
  maxDateFilter = new Date(end);
  maxDateFilter.setDate(maxDateFilter.getDate() -1);
  minDateFilter = new Date(start);
  minDateFilter.setDate(minDateFilter.getDate() -1);
  table.draw();  
});
     }
   
    if ($('#nproyecto').length) {
       $("#nproyecto").css("display", "none");
     }
    jQuery('.container-chat').jScrollPane();
    if ($('#sub_rubro').length) {
       autocomplete(document.getElementById("sub_rubro"), subrubro, imagen_s);
     }
     if ($('#rubro').length) {
       autocomplete(document.getElementById("rubro"), rubro, imagen_r);
     }
     if ($('#receptor_u').length) {
           autocomplete(document.getElementById("receptor_u"), personas, imagenes_perfil);
     }
     if ($('#buscarPersona').length) {
           autocomplete(document.getElementById("buscarPersona"), personasall, imagenes_perfilall);
     }
     if ($('#det_a').length) {
           autocomplete(document.getElementById("det_a"), detalle, imagen_d);
     }
     if ($('#tipo_a').length) {
           autocomplete(document.getElementById("tipo_a"), tipo, imagen_a);
     }
     if ($('#detalle').length) {
       autocomplete(document.getElementById("detalle"), detalle, imagen_det);
     }
     if ($('#rs').length) {
       autocomplete(document.getElementById("rs"), rs, imagen_rs);
     }
$('.tooltip-bg').tooltip();
 
 $('input').checks();
});

$(".select-plantilla").chosen();
    $(".select-single-plantilla").chosen({
        allow_single_deselect: true,disable_search_threshold:10
    });
$('#fnac_u').datepicker({
  format:'dd/mm/yyyy',
  startDate:'-3d'
});
$('#fi_p').datepicker({
  format:'dd/mm/yyyy',
  startDate:'-3d'
});
$('#ff_p').datepicker({
  format:'dd/mm/yyyy',
  startDate:'-3d'
});
$('#fi_p_salida').datepicker({
  format:'dd/mm/yyyy',
  startDate:'-3d'
});

function validateLogin(){
   var us = $("#usuario").val();
    var cn = $("#contrasena").val();
    var parametros={"us":us,"cn":cn};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "validarLogin/validarCampo",
        data: parametros,
        beforeSend: function () {
                $("#mensaje").html("Procesando, espere por favor...");
        },
        success:  function (resp) {
                $("#mensaje").html(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
    
}
function validateRegister(){
   var n_u = $("#nombre_u").val();
    var a_u = $("#apellido_u").val();
    var f_u = $("#fnac_u").val();
    var u_u = $("#usuario_u").val();
    var p_u = $("#contra_u").val();
    var p2_u = $("#contrac_u").val();
    var sex = $("#sexo").val();
    var parametros={"n_u":n_u,"a_u":a_u,"f_u":f_u,"u_u":u_u,"p_u":p_u,"p2_u":p2_u,"sex":sex};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cregister/registrarNuevo",
        data: parametros,
        beforeSend: function () {
                $("#mensajeR").html("Procesando datos, espere por favor...");
        },
        success:  function (resp) {
                $("#mensajeR").html(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
    
}
function validateRegister2(){
   var n_u = $("#nombre_u").val();
    var a_u = $("#apellido_u").val();
    var f_u = $("#fnac_u").val();
    var u_u = $("#correo").val();
    var sex = $("#sexo").val();
    var reg = $("#reg_i").val();
    var parametros={"nombre_u":n_u,"apellido_u":a_u,"fnac_u":f_u,"correo":u_u,"sexo":sex,"reg":reg};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cregister2/registrarNuevo",
        data: parametros,
        beforeSend: function () {
                $("#mensajeR").html("Procesando datos, espere por favor...");
        },
        success:  function (resp) {
                $("#mensajeR").html(resp);
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
    
}
function irUrl(urln){
window.location.href=urln;                                    
}
function cargarComunidad(id){

  var parametros={"id_dep":id};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cnueva_actividad/cargaCom",
        data: parametros,
        beforeSend: function () {
        },
        success:  function (resp) {
          $('#ncomunidad').html(resp);
          $("#ncomunidad").trigger("chosen:updated");
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function cargarResultado(id){
  var parametros={"id_obe":id};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cnueva_actividad/cargaRes",
        data: parametros,
        beforeSend: function () {
        },
        success:  function (resp) {
          $('#select-res').html(resp);
          $("#select-res").trigger("chosen:updated");
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function cargarIndicador(id){
  var parametros={"id_obe":id};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cnueva_actividad/cargaInd",
        data: parametros,
        beforeSend: function () {
        },
        success:  function (resp) {
          $('#select-ind').html(resp);
          $("#select-ind").trigger("chosen:updated");
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function cargarActividad(id){
  var parametros={"id_obe":id};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "cnueva_actividad/cargaAct",
        data: parametros,
        beforeSend: function () {
        },
        success:  function (resp) {
          $('#select-act').html(resp);
          $("#select-act").trigger("chosen:updated");
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function cargarProvincia(id){
  var parametros={"id_dep":id};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "ccomunidad/cargaProv",
        data: parametros,
        beforeSend: function () {
        },
        success:  function (resp) {
          $('#select-prov').html(resp);
          $("#select-prov").trigger("chosen:updated");
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
function cargarMunicipio(id){

  var parametros={"id_prov":id};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "ccomunidad/cargaMun",
        data: parametros,
        beforeSend: function () {
        },
        success:  function (resp) {
          $('#select-mun').html(resp);
          $("#select-mun").trigger("chosen:updated");
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
//AUTOCOMPLETE JS
function cargarProvinciaA(id){
  if(id==100){
  document.getElementById('div-lugar').style.display="none";
  document.getElementById('div-extranjero').style.display="block";
  }else{
    document.getElementById('div-lugar').style.display="block";
    document.getElementById('div-extranjero').style.display="none";
    var parametros={"id_dep":id};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "csolicitudes/cargaProv",
        data: parametros,
        beforeSend: function () {
        },
        success:  function (resp) {
          $('#select-prov-a').html(resp);
          $("#select-prov-a").trigger("chosen:updated");
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
  }
  
}
function cargarMunicipioA(id){

  var parametros={"id_prov":id};
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "csolicitudes/cargaMun",
        data: parametros,
        beforeSend: function () {
        },
        success:  function (resp) {
          $('#select-mun-a').html(resp);
          $("#select-mun-a").trigger("chosen:updated");
        }
    }).fail(function(jqXHR,textStatus,errorThrown){alert(jqXHR.status);});
}
//AUTOCOMPLETE JS


function autocomplete(inp, arr, img_url) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          b.setAttribute("class", "text-dark");
          /*make the matching letters bold:*/
          b.innerHTML = "<img src='"+img_url[i]+"' style='width:40px;height:40px;'> <strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
              b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              if ($('#sub_rubro').length) {
                if(inp!=document.getElementById("rubro")){
                   obtenerRubro(this.getElementsByTagName("input")[0].value);
                   obtenerCodRubro(this.getElementsByTagName("input")[0].value);
                   obtenerCodSubRubro(this.getElementsByTagName("input")[0].value);
                }else{
                     obtenerCodRubroPorRubro(this.getElementsByTagName("input")[0].value);
                }
                var cadena1=this.getElementsByTagName("input")[0].value;
                var res = cadena1.split("@")[0];
                inp.value = res;
                if($('#cod_sr').length){
                  mandarId(cadena1);
                }   
              }else{
                if ($('#det_a').length) {
                  if(inp!=document.getElementById("tipo_a")){
                      obtenerTipoA(this.getElementsByTagName("input")[0].value);
                    }
                     var cadena2=this.getElementsByTagName("input")[0].value;
                     var res2 = cadena2.split("@")[0];
                     inp.value = res2;   
                  }else{
                    if($('#cod_rs').length){
                      inp.value = this.getElementsByTagName("input")[0].value;
                        if(inp!=document.getElementById("detalle")){
                          mandarIdRS(inp.value);
                        }else{
                          mandarIdD(inp.value);
                        }
                     }else{
                      inp.value = this.getElementsByTagName("input")[0].value;
                     }
                  
                  }
              }
              
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}

<?php
if($this->session->userdata('login')!=TRUE){
           redirect('login');
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="apps/assets/img/ft.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    <?=$titulo?>
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="apps/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="apps/assets/css/now-ui-dashboard.css?v=1.2.0" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="apps/datatables/dataTables.bootstrap4.css">
  <link rel="stylesheet" type="text/css" href="apps/datatables/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="apps/datatables/fixedColumns.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="apps/datatables/daterangepicker.css">
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
</head>

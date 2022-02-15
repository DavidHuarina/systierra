<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exportar_excel extends CI_Controller {

	public function index()
  { 
      header('Content-type: application/vnd.ms-excel');
      header("Content-Disposition: attachment; filename=nombre_del_archivo.xls");
      header("Pragma: no-cache");
      header("Expires: 0");
    echo "<h1>Tabla de asistencias Pase-gol de los jugadores de Millonarios F.C.</h1>
 
<table class='table table-striped' cellspacing='0' cellpadding='0'>
 <tr class='bg-primary'>
 <th>Pedro Franco</th>
 <th>Wilson Carpintero</th>
 <th>&Aacute;lvaro Barros</th>
 <th>Mayer Candelo</th>
 </tr>
 <tr>
 <td>20</td>
 <td>80</td>
 <td>10</td>
 <td>=SUMA(A4:C4)</td>
 </tr>
 <tr>
 <td>78</td>
 <td>90</td>
 <td>10</td>
 <td>02</td>
 </tr>
</table>";
  }
}


 

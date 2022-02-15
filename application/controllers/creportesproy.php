<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Creportesproy extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Reportes - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos();
    if($datosUsuario['idrol']==2||$datosUsuario['idrol']==1000||$datosUsuario['idrol']==2000||$datosUsuario['idrol']==3000){
      redirect("home");
    }
		$datosUsuario['title_nav']="Reportes";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		$this->load->view('vsisinf/vreportes/v_reportes_proy');
		$this->load->view('vsisinf/vplantilla/menus/vmenu_actividad');
		$this->load->view('vsisinf/vplantilla/modals/vact_modal');
		$this->load->view('vsisinf/vplantilla/modals/vconfirm_modal');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function completarDatos(){
		//$datos['proyecto']=$this->proyecto->getAlls();
		$datos['proyecto']=$this->proyecto->getAllsDis();
    $datos['tipo']=$this->tipoact->getAll();
    $datos['personallist']=$this->personal->getAllEst();
    //$datos['resultados']=$this->v_datos_usuario->getResAct();
    //$datos['comunidades']=$this->comunidad->getAllComAct();
		$datos['descargosall']=$this->v_datos_usuario->getActividadFullDescargos();
    //$datos['fullactividadsin']=$this->v_datos_usuario->getActividadFullReporteSin();    	
		return $datos;
	}
  function selcom(){
    $nproy=$_POST['nproy'];
    $html="<option value=''>Todos</option>";
    if($nproy==""){
      $resul=$this->v_datos_usuario->getResAct();
                               foreach ($resul->result() as $res) {
                                $html.="<option value=".$res->descripcion.">".$res->descripcion."</option>";
                               }                    
    }else{
      $resul=$this->v_datos_usuario->getResActByNProy($nproy);
                               foreach ($resul->result() as $res) {
                                $html.="<option value=".$res->descripcion.">".$res->descripcion."</option>";
                               }                    
        
    }
    echo $html;
  }
  function cargarDetalle(){
    $det=$this->v_datos_usuario->getActividadFullDetalle($_POST['id_df']);
   $x=0; $totalm=0;$totali=0;
    $html='<table cellpadding="5" cellspacing="0" border="1" style="padding-left:50px;">
             <tr class="text-small">
                 <th style="display:none"></th>
                 <th style="background: #93f0c7;">Nro</th>
                 <th style="background: #93f0c7;">Tipo</th>
                 <th style="background: #93f0c7;">Factura</th>
                 <th style="background: #93f0c7;">Detalle</th>
                 <th style="background: #93f0c7;">Razon Social</th>
                 <th style="background: #93f0c7;">Monto</th>
                 <th style="background: #93f0c7;">Monto + Impuesto</th>
                 <th style="background: #60f3ff;">Partida</th>
                 <th style="background: #60f3ff;">Sub Partida</th>
                 <th style="background: #60f3ff;">SALDO</th>
                 <th style="background: #93f0c7;">Fecha</th>                 
             </tr>';
                               foreach ($det->result() as $det) {
                                $totalm=$totalm+$det->monto;
                                $totali=$totali+$det->monto_impuesto;
                                $porcion = explode("@", $det->sub_rubro);
                                $x++;
                                 $html.='<tr class="text-small">';
                                 $html.='<td style="display:none"></td><td style="background: #fff7d6 ">'.$x.'</td>';
                                       if($det->impuesto_bien==0){
                                         $html.='<td style="background: #fff7d6 ">SERVICIO ('.$det->impuesto_serv.' %)</td><td style="background: #fff7d6 ">No aplica</td>';   
                                         }else{
                                          $html.='<td style="background: #fff7d6 ">BIEN ('.$det->impuesto_bien.' %)</td><td style="background: #fff7d6 ">'.$det->n_fac_reci.'</td>';   
                                         }
                                   $html.='<td style="background: #fff7d6 ">'.$det->nombre_detalle.'</td>
                                           <td style="background: #fff7d6 ">'.$det->razon_social.'</td>
                                           <td style="background: #fff7d6 ;text-align: right;">'.number_format($det->monto, 2, '.', ',').'</td>
                                           <td style="background: #fff7d6 ;text-align: right;">'.number_format($det->monto_impuesto, 2, '.', ',').'</td>
                                           <td style="background: #d0d0ca">'.$det->rubro.' (COD:'.$det->rb_codigo.')</td>
                                           <td style="background: #d0d0ca">'.$porcion[0].'(COD:'.$det->sr_codigo.')</td>
                                           <td style="background: #d0d0ca;text-align: right;">'.number_format($det->saldos, 2, '.', ',').'</td>
                                           <td style="background: #fff7d6 ">'.$det->fecha.'</td>
                                        </tr>';
                               }
                           $html.='<tr>
                                      <td style="display:none"></td>
                                      <td style="background: #fff7d6 "></td>
                                      <td style="background: #fff7d6 "><b>TOTAL</b></td>
                                      <td style="background: #fff7d6 "></td>
                                      <td style="background: #fff7d6 "></td>
                                      <td style="background: #fff7d6 "></td>
                                      <td style="background: #fff7d6; text-align: right;"><b>'.number_format($totalm, 2, '.', ',').'</b></td>
                                      <td style="background: #fff7d6; text-align: right;"><b>'.number_format($totali, 2, '.', ',').'</b></td>
                                      <td style="background: #fff7d6 "></td>
                                      <td style="background: #fff7d6 "></td>
                                      <td style="background: #fff7d6 "></td>
                                      <td style="background: #fff7d6 "></td>
                                   </tr>';     
          $html.='</table>';
        echo $html;
  }
  function decodeUFT8full(){
    $texto=$_POST['texto'];
    $html=$texto;
    echo $html;
  }
	function cargaObj(){
		$obes=$this->obe->getByIdProy($_POST['id_p']);
		$html="";
                               foreach ($obes->result() as $obe) {
                                $html.="<option value=".$obe->id_obe.">".$obe->descripcion."</option>";
                               }                    
        echo $html;

	}
	function enviarDatos(){
        $dataProy = array();
        $dataTipo= array();
        $dataParti= array();
        $acti=null;
		$proyectos=$this->input->post('proy');
        $tipos=$this->input->post('tipo');
        $parti=$this->input->post('parti');
        $desde=$this->input->post('desde');
        $hasta=$this->input->post('hasta');

          for ($i=0;$i<count($proyectos);$i++)    
          {      
          	$dataProy[$i]=$proyectos[$i]['value'];
          }
          for ($j=0;$j<count($tipos);$j++)    
          {      
          	$dataTipo[$j]=$tipos[$j]['value'];
          }
          for ($k=0;$k<count($parti);$k++)    
          {      
            $dataParti[$k]=$parti[$k]['value'];
          }
          $data['nreg']=count($proyectos);
           
          if($dataProy!=null){
          	if($desde==""||$hasta==""){
          		$prueba=$this->v_datos_usuario->getByIdMl($dataProy,$dataTipo);
              $proy=$this->v_datos_usuario->getProy($dataProy);
          	}else{
          		$prueba=$this->v_datos_usuario->getByIdMlFechas($dataProy,$dataTipo,$desde,$hasta);
              $proy=$this->v_datos_usuario->getProy($dataProy);
          	}   	
           //$prueba=$this->v_datos_usuario->getReporte($dataProy);

         	 $data['proy']=$proy;
           $data['acti']=$prueba;
           $data['tipo']=$dataTipo;
           $data['desde']=$desde;
           $data['hasta']=$hasta;
           $nact=0;
           $tt[0]=0;$tt[1]=0;$tt[2]=0;$tt[3]=0;$tt[4]=0;$tt[5]=0;$tt[6]=0;$tt[7]=0;
           $ph[0]=0;$ph[1]=0;$ph[2]=0;$ph[3]=0;$ph[4]=0;
           $pm[0]=0;$pm[1]=0;$pm[2]=0;$pm[3]=0;$pm[4]=0;
           foreach ($prueba->result() as $pr) {
            $nact++;
            $participantes=$this->parti->getAllByIdA($pr->act_id);
            if($participantes!=null){
              foreach ($participantes->result() as $partit) {
                switch ($partit->id_tipopar) {
                case 1:
                $ph[0]=$ph[0]+$partit->cant_h;
                $pm[0]=$pm[0]+$partit->cant_m;
                break;
                case 2:
                $ph[1]=$ph[1]+$partit->cant_h;
                $pm[1]=$pm[1]+$partit->cant_m;
                break;
                case 3:
                $ph[2]=$ph[2]+$partit->cant_h;
                $pm[2]=$pm[2]+$partit->cant_m;
                break;
                case 4:
                $ph[3]=$ph[3]+$partit->cant_h;
                $pm[3]=$pm[3]+$partit->cant_m;
                break;
                case 5:
                $ph[4]=$ph[4]+$partit->cant_h;
                $pm[4]=$pm[4]+$partit->cant_m;
                break;
              }
              }
              
            }
             switch ($pr->tipo_id) {
               case 1: $tt[$pr->tipo_id-1]++; break;
               case 2: $tt[$pr->tipo_id-1]++; break;
               case 3: $tt[$pr->tipo_id-1]++; break;
               case 4: $tt[$pr->tipo_id-1]++; break;
               case 5: $tt[$pr->tipo_id-1]++; break;
               case 6: $tt[$pr->tipo_id-1]++; break;
               case 7: $tt[$pr->tipo_id-1]++; break;
               case 8: $tt[$pr->tipo_id-1]++; break;
             }
           }

           
           $data['parti']=$dataParti;
           $data['pm']=$pm;
           $data['ph']=$ph;
           $data['tt']=$tt;
           $data['nact']=$nact;
          
          echo "<script>
             lblChartUno=[];
             dataChartUno=[];
             colorChartUno=[];</script>";
             $colores[0]="#ED763F";
             $colores[1]="#a27800";
             $colores[2]="#344CE8";
             $colores[3]="#302b2b";
             $colores[4]="#224c04";

           for ($i=0; $i < count($dataParti) ; $i++) {
            $tipop=$this->parti->getTipo($dataParti[$i]);
            $datoss=$ph[$tipop->id_tipopar-1]+$pm[$tipop->id_tipopar-1];
             echo "<script>
             lblChartUno[".$i."]='".$tipop->nombre_tipopar."';
             dataChartUno[".$i."]=".$datoss.";
             colorChartUno[".$i."]='".$colores[$i]."';</script>";
             }
            	$this->load->view('vsisinf/vreportes/v_reportes_datos',$data);
              /* echo "<div class='progress'>
                        <div class='progress-bar bg-success' style='width:100%'>100%</div>
                       </div>";*/
          }else{
            /*echo "<p><label>Ningun Proyecto seleccionado!</label></p>
            <div class='progress'>
                        <div class='progress-bar bg-danger' style='width:40%'>40%</div>
                       </div>";*/
                       echo "<p><label>Ningun Proyecto seleccionado!</label></p>";
          }   
         }

 function generarPDF(){
  $doc=$_COOKIE['ckie'];
        $dataProy = array();
        $dataTipo= array();
        $dataParti= array();
        $acti=null;
        $proyectos=$this->input->post('proy');
        $tipos=$this->input->post('tipo');
        $parti=$this->input->post('parti');
        $desde=$this->input->post('fi_p');
        $hasta=$this->input->post('ff_p');

          for ($i=0;$i<count($proyectos);$i++)    
          {      
            $dataProy[$i]=$proyectos[$i];
          }
          for ($j=0;$j<count($tipos);$j++)    
          {      
            $dataTipo[$j]=$tipos[$j];
          }
          for ($k=0;$k<count($parti);$k++)    
          {      
            $dataParti[$k]=$parti[$k];
          }
          $data['nreg']=count($proyectos);
           
            if($desde==""||$hasta==""){
              $prueba=$this->v_datos_usuario->getByIdMl($dataProy,$dataTipo);
              $proy=$this->v_datos_usuario->getProy($dataProy);
            }else{
              $prueba=$this->v_datos_usuario->getByIdMlFechas($dataProy,$dataTipo,$desde,$hasta);
              $proy=$this->v_datos_usuario->getProy($dataProy);
            }     
           $data['proy']=$proy;
           $data['acti']=$prueba;
           $data['tipo']=$dataTipo;
           $data['desde']=$desde;
           $data['hasta']=$hasta;
           $nact=0;
           $tt[0]=0;$tt[1]=0;$tt[2]=0;$tt[3]=0;$tt[4]=0;$tt[5]=0;$tt[6]=0;$tt[7]=0;
           $ph[0]=0;$ph[1]=0;$ph[2]=0;$ph[3]=0;$ph[4]=0;
           $pm[0]=0;$pm[1]=0;$pm[2]=0;$pm[3]=0;$pm[4]=0;
           foreach ($prueba->result() as $pr) {
            $nact++;
            $participantes=$this->parti->getAllByIdA($pr->act_id);
            if($participantes!=null){
              foreach ($participantes->result() as $partit) {
                switch ($partit->id_tipopar) {
                case 1:
                $ph[0]=$ph[0]+$partit->cant_h;
                $pm[0]=$pm[0]+$partit->cant_m;
                break;
                case 2:
                $ph[1]=$ph[1]+$partit->cant_h;
                $pm[1]=$pm[1]+$partit->cant_m;
                break;
                case 3:
                $ph[2]=$ph[2]+$partit->cant_h;
                $pm[2]=$pm[2]+$partit->cant_m;
                break;
                case 4:
                $ph[3]=$ph[3]+$partit->cant_h;
                $pm[3]=$pm[3]+$partit->cant_m;
                break;
                case 5:
                $ph[4]=$ph[4]+$partit->cant_h;
                $pm[4]=$pm[4]+$partit->cant_m;
                break;
              }
              }
              
            }
             switch ($pr->tipo_id) {
               case 1: $tt[$pr->tipo_id-1]++; break;
               case 2: $tt[$pr->tipo_id-1]++; break;
               case 3: $tt[$pr->tipo_id-1]++; break;
               case 4: $tt[$pr->tipo_id-1]++; break;
               case 5: $tt[$pr->tipo_id-1]++; break;
               case 6: $tt[$pr->tipo_id-1]++; break;
               case 7: $tt[$pr->tipo_id-1]++; break;
               case 8: $tt[$pr->tipo_id-1]++; break;
             }
           }

           
           $data['parti']=$dataParti;
           $data['pm']=$pm;
           $data['ph']=$ph;
           $data['tt']=$tt;
           $data['nact']=$nact;
           if($doc=="PDF"){
             $html=$this->load->view('vsisinf/vreportes/v_reportes_datos_pdf',$data,true);
             $this->load->library('mydompdf');
             ob_clean();
             $this->mydompdf->load_html($html);
             $this->mydompdf->render();
             $this->mydompdf->set_base_path('apps/dompdf.css','apps/css/micss.css');
             $this->mydompdf->stream("cvistaDes.pdf", array("Attachment" => true));
           }else{
             $this->load->view('vsisinf/vreportes/v_reportes_datos_Excel',$data);
           }
          
              

         
         
  }





	function enviar(){
        $dataProy = array();
        $dataObe = array();
        $dataRes = array();
        $dataInd = array();
        $dataMl = array();
		$proyectos=$this->input->post('proy');
		$objetivos=$this->input->post('obe');
		$resultados=$this->input->post('res');
		$indicadores=$this->input->post('ind');
		$act_ml=$this->input->post('ml');
          for ($i=0;$i<count($proyectos);$i++)    
          {      
          	$dataProy[$i]=$proyectos[$i];
          }
          
          $contador=1;
         $prueba=$this->v_datos_usuario->getReportes($dataProy,$dataObe,$dataRes,$dataInd,$dataMl);
         foreach ($prueba->result() as $pru) {
         	echo "<br> nombre de proyecto - ".$contador.": " . $pru->nombre_proyecto." id_act_ml= ".$pru->id_act_ml; 
            $contador++;
         }
	}
}
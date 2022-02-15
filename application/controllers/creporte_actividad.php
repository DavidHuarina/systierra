<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Creporte_actividad extends C_datos {

	public function index()
	{ 
		
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$id_p=$_REQUEST["id"];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		if(!isset($_REQUEST["c"])){
            $ca=0;   
		}else{
           $ca=$_REQUEST['c'];
		}
		if(!isset($_REQUEST["ds"])){
            $desde=0;   
		}else{
           $desde=$_REQUEST['ds'];
           $desde = str_replace("-", "/", $desde);
		}
		if(!isset($_REQUEST["hs"])){
            $hasta=0;   
		}else{
           $hasta=$_REQUEST['hs'];
           $hasta = str_replace("-", "/", $hasta);
		}
		if(!isset($_REQUEST["v"])){
            $ver=0;   
		}else{
           $ver=$_REQUEST['v'];
		}
		$datosUsuario+=$this->completarDatos($id_p,$ca,$ver,$desde,$hasta);

		if($datosUsuario['idrol']==2||$datosUsuario['idrol']==1000||$datosUsuario['idrol']==2000||$datosUsuario['idrol']==3000){
			redirect("home");
		}
		$datosUsuario['title_nav']="Detalles del proyecto";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');	
		$this->load->view('vsisinf/proyecto/vreporte_actividad');
		$this->load->view('vsisinf/vplantilla/menus/vmenu_proyecto');
		$this->load->view('vsisinf/vplantilla/modals/vajus');
		$this->load->view('vsisinf/vplantilla/vfooter');
		echo "<script>notificacion('top','center','holitas','warning','now-ui-icons ui-1_bell-53')</script>";	
	}
	function fechasBuscar($id,$v,$c){
		$desde=$this->input->post('fi_p');
		$hasta=$this->input->post('ff_p');
		$desde = str_replace("/", "-", $desde);
		$hasta = str_replace("/", "-", $hasta);
		redirect("creporte_actividad?id=".$id."&v=".$v."&c=".$c."&ds=".$desde."&hs=".$hasta);
	}
   function completarDatos($id,$ca,$ver,$desde,$hasta){
		$datos['proy']=$this->proyecto->getById($id);
		if($datos['proy']==null){
         redirect('clista_proyecto');
       }
              if($datos['proy']->presupuesto==1){
              	redirect("cdetalle_proyecto?id=".$id);
              }
              if($desde==0||$hasta==0){
              	$datos['fi']="";$datos['ff']="";
              	$datos['actividad']=$this->actividad->getAllByPro2($id);
              }else{
              	$datos['actividad']=$this->actividad->getAllByPro3($id,$desde,$hasta);
              	$datos['fi']=$desde;$datos['ff']=$hasta;
              }
        //
	    $datos['fondos']=$this->proy_EP->getByIdProyecto($id);
	    $datos['obes']=$this->obe->getByIdProy($id);
	    $datos['ver']=$ver;
	    $datos['nobe']=$this->obe->getNObe($id);
	    $datos['cambio']=$this->cambio->getAll();
	    if($datos['fondos']!=null){
	    	if($ca==0){
	    		if($ver==0){
                   $datos['ep']=$this->ep->getAllByIdFondo($datos['fondos']->id_proy_ep);
	    		}else{
                   $datos['ep']=$this->ep->getAllByIdFondoVer($datos['fondos']->id_proy_ep,$ver);
	    		}	    	 
	    	 $datos['cambioMon']=null;
	    	 $datos['valmon']=1;
	    	}else{
	    	 foreach ($datos['cambio']->result() as $cam) {
	    		if($ca==$cam->id_cambio){
	    			if($ver==0){
                        $datos['ep']=$this->ep->getAllByIdFondoCambio($datos['fondos']->id_proy_ep,$cam->valor,$ver);
	    			}else{
                      $datos['ep']=$this->ep->getAllByIdFondoCambioVer($datos['fondos']->id_proy_ep,$cam->valor,$ver);
	    			}	    			
	    			$datos['cambioMon']=$cam;
	    			$datos['valmon']=$cam->valor;
	    			break;
	    		}
	    	 }
	    	}		
		}	
		return $datos;
	}
	function nobe(){
		$id_p=$_REQUEST["id"];
		$obe=$this->input->post('obe_p');
        $nobe=new Obe();
        $nobe->id_proyecto=$id_p;
        $nobe->descripcion=$obe;
        $nobe->add();
        redirect('cdetalle_proyecto?id='.$id_p);
	}
	function ajustar(){
		$id_p=$_REQUEST["id"];
		$cod=$this->input->post('codigo_ep');
		$aj=$this->input->post('ajus_ep');
		$tipo=$this->input->post('select-cambio');
		if($tipo==0){
		$this->ep->ajustar($aj,$cod);	
		}else{
		$tipo_m=$this->cambio->getById($tipo);
		$this->ep->ajustar($aj*$tipo_m->valor,$cod);
		}		
		redirect('cfulldetalles?id='.$id_p.'&c='.$tipo);
	}
	function exportar($id,$ca,$ver,$desde,$hasta){  
       if($desde==""){$desde=0;}
       if($hasta==""){$hasta=0;}
      $datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id,$ca,$ver,$desde,$hasta);
		$datosUsuario['sol']=$sol;
		$html=$this->load->view('vsisinf/vistas_previas/vvista_reporte_a',$datosUsuario,true);

        //$direccion="storage/solfa/ufci.pdf";
         $this->load->library('mydompdf');
         ob_clean();
         $this->mydompdf->load_html($html);
         $this->mydompdf->render();
         //$salida=$this->mydompdf->output();
         //file_put_contents($direccion,$salida);
        $this->mydompdf->set_base_path('apps/dompdf.css','apps/css/micss.css');
         $this->mydompdf->stream("reporte_act.pdf", array("Attachment" => true));
	}
	function exportarExcel($id,$ca,$ver,$desde,$hasta){
		if($desde==""){$desde=0;}
		if($hasta==""){$hasta=0;}
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id,$ca,$ver,$desde,$hasta);
		$this->load->view('vsisinf/vistas_previas/vvista_reporte_a_Excel',$datosUsuario);
	}
}
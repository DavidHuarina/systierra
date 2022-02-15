<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cfulldetalles extends C_datos {

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
		$datosUsuario+=$this->completarDatos($id_p,$ca);

		if($datosUsuario['idrol']==2||$datosUsuario['idrol']==1000||$datosUsuario['idrol']==2000||$datosUsuario['idrol']==3000){
			redirect("home");
		}
		$datosUsuario['title_nav']="Detalles del proyecto";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');	
		$this->load->view('vsisinf/proyecto/vfulldetalles');
		$this->load->view('vsisinf/vplantilla/menus/vmenu_proyecto');
		$this->load->view('vsisinf/vplantilla/modals/vajus');
		$this->load->view('vsisinf/vplantilla/vfooter');
			
	}
   function completarDatos($id,$ca){
		$datos['proy']=$this->proyecto->getById($id);
		if($datos['proy']==null){
         redirect('clista_proyecto');
       }
              if($datos['proy']->presupuesto==1){
              	redirect("cdetalle_proyecto?id=".$id);
              }

	    $datos['fondos']=$this->proy_EP->getByIdProyecto($id);
	    $datos['obes']=$this->obe->getByIdProy($id);
	    $datos['nobe']=$this->obe->getNObe($id);
	    $datos['cambio']=$this->cambio->getAll();
	    if($datos['fondos']!=null){
	    	if($ca==0){
	    	 $datos['ep']=$this->ep->getAllByIdFondo($datos['fondos']->id_proy_ep);
	    	 $datos['cambioMon']=null;
	    	}else{
	    	 foreach ($datos['cambio']->result() as $cam) {
	    		if($ca==$cam->id_cambio){
	    			$datos['ep']=$this->ep->getAllByIdFondoCambio($datos['fondos']->id_proy_ep,$cam->valor);
	    			$datos['cambioMon']=$cam;
	    			break;
	    		}
	    	 }
	    	}		
		}	
		return $datos;
	}
	function exportar($id,$ca){
      $datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id,$ca);
		$html=$this->load->view('vsisinf/vistas_previas/vvista_reporte_det',$datosUsuario,true);
        //$direccion="storage/solfa/ufci.pdf";
         $this->load->library('mydompdf');
         ob_clean();
         $this->mydompdf->load_html($html);
         $this->mydompdf->render();
         //$salida=$this->mydompdf->output();
         //file_put_contents($direccion,$salida);
        $this->mydompdf->set_base_path('apps/dompdf.css','apps/css/micss.css');
         $this->mydompdf->stream("reporte_Det.pdf", array("Attachment" => true));
	}
	function exportarExcel($id,$ca){
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id,$ca);
		$this->load->view('vsisinf/vistas_previas/vvista_reporte_det_Excel',$datosUsuario);
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
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cvista_Proy extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$id_p=$_REQUEST["id"];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id_p);
		if($datosUsuario['idrol']==2||$datosUsuario['idrol']==1000||$datosUsuario['idrol']==2000||$datosUsuario['idrol']==3000){
			redirect("home");
		}
		$datosUsuario['title_nav']="Detalles del proyecto";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');	
		$this->load->view('vsisinf/proyecto/vvista_Proy');
		$this->load->view('vsisinf/vplantilla/modals/vinfo_nobe');
		$this->load->view('vsisinf/vplantilla/menus/vmenu_proyecto');
		$this->load->view('vsisinf/vplantilla/vfooter');	
	}
   function completarDatos($id){
		$datos['proy']=$this->proyecto->getById($id);
		if($datos['proy']==null){
         redirect('clista_proyecto');
       }
		$datos['comunidad']=$this->com_proy->getByAllIdProy($id);
		$datos['ncom']=$this->com_proy->getNByAllIdProy($id);
		$datos['norg']=$this->org_proy->getNByAllIdProy($id);
		$datos['organizacion']=$this->org_proy->getByAllIdProy($id);
	    $datos['fondos']=$this->proy_EP->getByIdProyecto($id);
	    $datos['obes']=$this->obe->getByIdProy($id);
	    $datos['nobe']=$this->obe->getNObe($id);

	    $datos['comunidades']=$this->comunidad->getAllCP($id);
	    $datos['organizaciones']=$this->organizacion->getAllOP($id);
		return $datos;
	}
	function exportar($id){
      $datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id);
		$html=$this->load->view('vsisinf/vistas_previas/vvista_Proy',$datosUsuario,true);
         $this->load->library('mydompdf');
         ob_clean();
         $this->mydompdf->load_html($html);
         $this->mydompdf->render();
        $this->mydompdf->set_base_path('apps/dompdf.css','apps/css/micss.css');
         $this->mydompdf->stream("Gen_Proy.pdf", array("Attachment" => true));
	}


}
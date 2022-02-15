<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Clista_actividad_me_sub extends C_datos {

	public function index()
	{ 
		
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$ac=$_REQUEST['a'];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($ac);
		$datosUsuario['title_nav']="Actividades";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		//$this->load->view('vsisinf/vactividad/vactividad_me');
		$this->load->view('vsisinf/vactividad/listas/actividades_sub');
		$this->load->view('vsisinf/vplantilla/menus/vmenu_actividad');
		$this->load->view('vsisinf/vplantilla/modals/vact_modal');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function completarDatos($ac){
		//$datos['proyecto']=$this->proyecto->getAlls();
		$datos['proyecto']=$this->proyecto->getAllsDis();
		$datos['actividad']=$this->actividad->getAllSub($ac);
		$datos['activ']=$this->actividad->getById($ac);
		$datos['nact']=$this->actividad->getNActSub($ac);
		return $datos;
	}
}
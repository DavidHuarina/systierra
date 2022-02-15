<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Clista_actividad_gen extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos();
		$datosUsuario['title_nav']="Actividades";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		$this->load->view('vsisinf/vactividad/vactividad_gen');
		$this->load->view('vsisinf/vplantilla/menus/vmenu_actividad');
		$this->load->view('vsisinf/vplantilla/modals/vact_modal');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function completarDatos(){
		$datos['proyecto']=$this->proyecto->getAllsDis();
		//$datos['actividad']=$this->actividad->getAll($this->session->userdata('id_usuario_sesion'));
		$datos['actividad']=$this->actividad->getAllEq($this->session->userdata('id_usuario_sesion'));
		$datos['nact']=$this->actividad->getNActEq($this->session->userdata('id_usuario_sesion'));
		return $datos;
	}
	function nact(){
		redirect('cnueva_actividad?id='.$this->input->post('proyect'));
	}
	
}
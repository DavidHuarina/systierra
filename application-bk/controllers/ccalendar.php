<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Ccalendar extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos();
		$datosUsuario['title_nav']="Actividades";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		//$this->load->view('vsisinf/vactividad/vactividad_in');
		$this->load->view('vsisinf/vactividad/listas/calendar');
		$this->load->view('vsisinf/vplantilla/modals/vact_modal');
		$this->load->view('vsisinf/vplantilla/menus/vmenu_actividad');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function completarDatos(){
		$datos['proyecto']=$this->proyecto->getAllsDis();
		//$datos['actividad']=$this->actividad->getAll($this->session->userdata('id_usuario_sesion'));
		$datos['actividad']=$this->actividad->getAlls();
		$datos['actividadIn']=$this->actividad->getAllIn($this->session->userdata('id_usuario_sesion'));
		//$datos['nact']=$this->actividad->getNActIn($this->session->userdata('id_usuario_sesion'));
		return $datos;
	}
}
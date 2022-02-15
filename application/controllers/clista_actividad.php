<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Clista_actividad extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos();
		$datosUsuario['title_nav']="Actividades";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		//$this->load->view('vsisinf/vactividad/vactividad_me');
		$this->load->view('vsisinf/vactividad/listas/mis_actividades');
		$this->load->view('vsisinf/vplantilla/menus/vmenu_actividad');
		$this->load->view('vsisinf/vplantilla/modals/vact_modal');
		$this->load->view('vsisinf/vplantilla/modals/vconfirm_modal');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function completarDatos(){
		$datos['proyecto']=$this->proyecto->getAllsDis();
		$datos['actividad']=$this->actividad->getAll($this->session->userdata('id_usuario_sesion'));
		$datos['ultima_act']=$this->actividad->getUltima($this->session->userdata('id_usuario_sesion'));
		$datos['actividadR']=$this->actividad->getEstadoRandom($this->session->userdata('id_usuario_sesion'),4);
		$datos['nact']=$this->actividad->getNAct($this->session->userdata('id_usuario_sesion'));
		return $datos;
	}
	function nact(){
		$fact=$this->input->post('factividad');
		$pa=$this->input->post('act_padre');
		redirect('cnueva_actividad?id='.$this->input->post('proyect').'&fa='.$fact.'&p='.$pa);	
	}
	
}
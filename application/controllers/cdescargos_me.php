<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cdescargos_me extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos();
		$datosUsuario['title_nav']="Descargos";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		$this->load->view('vsisinf/descargo/descargo');
		//$this->load->view('vsisinf/vplantilla/modals/vact_modal');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function completarDatos(){
		$datos['descargo']=$this->descargo->getAllDesMe($this->session->userdata('id_usuario_sesion'));
		$datos['ndes']=$this->descargo->getNDDesMe($this->session->userdata('id_usuario_sesion'));
		return $datos;
	}
	
}
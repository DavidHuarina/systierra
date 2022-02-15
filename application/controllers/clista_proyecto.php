<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Clista_proyecto extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos();
		if($datosUsuario['idrol']==2||$datosUsuario['idrol']==1000||$datosUsuario['idrol']==2000){
			redirect("home");
		}
		$datosUsuario['title_nav']="Proyecto";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		$this->load->view('vsisinf/proyecto/vproyecto');
		$this->load->view('vsisinf/vplantilla/menus/vmenu_proyecto');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function completarDatos(){
		
		//$datos['proyecto']=$this->proyecto->getAll($this->session->userdata('id_usuario_sesion'));
		$datos['proyecto']=$this->proyecto->getAlls();
		//$datos['nproy']=$this->proyecto->getNProy($this->session->userdata('id_usuario_sesion'));
		$datos['nproy']=$this->proyecto->getNproyS();
		$datos['proyecton']=$this->proyecto->getAllN($this->session->userdata('id_usuario_sesion'));

		return $datos;
	}
	
}
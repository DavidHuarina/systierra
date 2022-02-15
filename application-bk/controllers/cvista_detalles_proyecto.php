<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cvista_detalles_proyecto extends C_datos {

	public function index()
	{ 
		
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$id_proy=$_REQUEST["id"];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id_proy);
		
		$this->load->view('vsisinf/vplantilla/vnavegacion',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vbarralateral');
		$this->load->view('vsisinf/proyecto/vvista_detalles_proyecto');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function completarDatos($id_proy){
		$datos['proyecto']=$this->proyecto->getById($id_proy);
		if($datos['proyecto']==null){
         redirect('clista_proyecto');
       }
		return $datos;
	}
	
}
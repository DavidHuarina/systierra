<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cdetalle_gasto extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->complementarDatos();
		$this->load->view('vsisinf/vplantilla/vnavegacion',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vbarralateral');
		$this->load->view('vsisinf/vactividad/vdetalle_gasto');
		$this->load->view('vsisinf/vplantilla/vfooter');	
	}
	function complementarDatos(){
		$datos['personas']=$this->personal->getAllNotMe($this->session->userdata('id_usuario_sesion'));
		$datos['departamento']=$this->comunidad->getAllDep();
		$datos['proyecto']=$this->proyecto->getAll($this->session->userdata('id_usuario_sesion'));
        $datos['tipoact']=$this->tipoact->getAll();
		//$datos['comunidad']=$this->comunidad->getAll();
		return $datos;
	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cbuscar_personas extends C_datos {

	public function index()
	{ 

        
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$nomp=$this->input->post('buscarPersona');
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
        $datosUsuario+=$this->complementarDatos($nomp);
		$datosUsuario['title_nav']="Personas";		
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion',$datosUsuario);
		if($datosUsuario['personax']!=null){
          $this->load->view('vsisinf/vusuario/vbuscar_persona',$datosUsuario);
		}else{
			$this->load->view('vsisinf/vusuario/vbuscar_personal',$datosUsuario);
		}
		
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function complementarDatos($nomp){
		$datos['busper']=$nomp;
		   $datos['personax']=$this->v_datos_usuario->getByNombre($nomp);	
		$datos['nus']=$this->v_datos_usuario->getAllN();
    return $datos;

	}
}
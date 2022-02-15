<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class CadminUsuarios extends C_datos {

	public function index()
	{ 
		 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		if($this->session->userdata('id_usuario_rol')==5000||$this->session->userdata('id_usuario_rol')==4000){
          
          }else{
          redirect('salirSistema');	
          }
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
        $datosUsuario+=$this->complementarDatos();
		$datosUsuario['title_nav']="Administracion / Usuarios";		
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion',$datosUsuario);
		$this->load->view('vsisinf/vadmin/vadminUsuarios',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function complementarDatos(){
		$datos['lista_usuarios']=$this->v_datos_usuario->getAll();
		$datos['nus']=$this->v_datos_usuario->getAllN();
    return $datos;

	}
}
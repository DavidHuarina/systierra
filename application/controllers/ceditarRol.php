<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class CeditarRol extends C_datos {

	public function index()
	{ 
		 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		if($this->session->userdata('id_usuario_rol')==5000||$this->session->userdata('id_usuario_rol')==4000){
          
          }else{
          redirect('salirSistema');	
          }
          $per=$_REQUEST["id"];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
        $datosUsuario+=$this->complementarDatos($per);
		$datosUsuario['title_nav']="Administracion / Usuarios";		
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');
		$this->load->view('vsisinf/vadmin/veditarRol');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function complementarDatos($per){
		//$datos['lista_usuarios']=$this->v_datos_usuario->getAll();
		//$datos['nus']=$this->v_datos_usuario->getAllN();
		$datos['personax']=$this->personal->getAllIdPersona($per);
		if($datos['personax']==null){
         redirect('home');
       }
		$datos['rolesper']=$this->rol->getAll();
    return $datos;

	}
	function editar($idu,$idp){
     $rol=$this->input->post('role-sel');
     $this->usuario->editarRol($idu,$rol);
     redirect('cadminUsuarios');
	}
}
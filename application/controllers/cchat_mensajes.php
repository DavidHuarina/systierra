<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cchat_mensajes extends C_datos {

	public function index()
	{ 
		
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$id_conv=$_REQUEST["conv"];
		$id_user=$_REQUEST["user"];
        $this->mensaje->leido_mensaje($id_conv,$id_user);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->complementarDatos($id_conv,$id_user);
		$datosUsuario['title_nav']="Chat";
	    $this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');
		$this->load->view('vsisinf/vmensaje/vchat_mensajes');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function complementarDatos($id_conv,$idUser2){
		$datos['datostitulo']=$this->personal->getAllIdUsuario($idUser2);
		if($datos['datostitulo']==null){
			redirect('home');
		}
		$datos['mensajes']=$this->mensaje->getByIdConv($id_conv,1000);
		return $datos;
	}
	
}
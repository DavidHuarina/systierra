<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cusuario extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
       $datosUsuario+=$this->complementarDatos($this->session->userdata('id_usuario_sesion'));
       $datosUsuario['title_nav']="Perfil";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		$this->load->view('vsisinf/vusuario/vusuario');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function complementarDatos($idUser){
		$personal = $this->v_datos_usuario->getById($idUser);
		$datos['apellidos_usuario']=$personal->apellido_persona;
		$datos['cargo_usuario']=$personal->nombre_cargo;
		$datos['telefono_usuario']=$personal->telefono;
		$datos['correo_usuario']=$personal->correo;
		$datos['fnac_usuario']=$personal->fecha_nacimiento;
		$datos['usuario']=$personal->usuario;
		$datos['imagen_usuario']=$personal->dir_imagen;
		$datos['direccion']=$personal->direccion;
        $datos['sobre_mi']=$personal->sobre_mi;
		return $datos;
	}
	
}
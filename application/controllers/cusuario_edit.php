<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cusuario_edit extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
       $datosUsuario+=$this->complementarDatos($this->session->userdata('id_usuario_sesion'));
       $datosUsuario['title_nav']="Perfil";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		$this->load->view('vsisinf/vusuario/vusuario_form_edit');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function complementarDatos($idUser){
		$personal = $this->v_datos_usuario->getById($idUser);
		$datos['apellidos_usuario']=$personal->apellido_persona;
		$datos['cargo_usuario']=$personal->nombre_cargo;		
		$datos['correo_usuario']=$personal->correo;
		if($personal->telefono==0){
           $datos['telefono_usuario']="";
		}else{
			$datos['telefono_usuario']=$personal->telefono;
		}
		
		$datos['fnac_usuario']=$personal->fecha_nacimiento;
		$datos['usuario']=$personal->usuario;
		$datos['imagen_usuario']=$personal->dir_imagen;
		$datos['direccion']=$personal->direccion;
        $datos['sobre_mi']=$personal->sobre_mi;
		return $datos;
	}
	function edit_u(){
       $tel=$this->input->post('telefono_u');
       if($tel==""){
       	$tel=0;
       }
       $personales=$this->personal->getByIdUsuario($this->session->userdata('id_usuario_sesion'));
       $personales->nombre_persona=$this->input->post('nombre_u');
       $personales->apellido_persona=$this->input->post('apellido_u');
       $personales->telefono=$tel;
       $personales->correo=$this->input->post('correo_u');
       $personales->fecha_nacimiento=$this->input->post('fi_p');
       $personales->direccion=$this->input->post('dir_u');
       $personales->update();
       
       $user=$this->usuario->getById($this->session->userdata('id_usuario_sesion'));
       $user->sobre_mi=$this->input->post('sobre');
       $user->update();

       redirect('cusuario');
	}
	
}
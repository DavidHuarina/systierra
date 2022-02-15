<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cusuario_editC extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
        $datosUsuario+=$this->complementarDatos($this->session->userdata('id_usuario_sesion'));
		
		$datosUsuario['title_nav']="Perfil";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');
		$this->load->view('vsisinf/vusuario/vusuario_form_editc');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function complementarDatos($idUser){
		//$usuario=$this->usuario->getById($idUser);
		$personal = $this->v_datos_usuario->getById($idUser);
		$datos['usuario']=$personal->usuario;   
		return $datos;
	}

	function edit_c(){ 	 	
		$contra_a=$this->input->post('contra_a_u');
		$contra_n=$this->input->post('contra_n_u');
		$contra_nr=$this->input->post('contra_nr_u');
        $user=$this->usuario->getById($this->session->userdata('id_usuario_sesion'));
        if($contra_a==""||$contra_n==""||$contra_nr==""){
       	echo "<script>$('#mensajeC').append('<label class=\'text-danger\'>No se admiten los campos vacios !</label>');$('#mensajeC').hide().fadeIn(1500);</script>"; 	
        }else{
        	if($contra_n!=$contra_nr){
        		echo "<script>$('#mensajeC').append('<label class=\'text-warning\'>Las contraseñas no coinciden !.</label>');$('#mensajeC').hide().fadeIn(1500);</script>"; 	
        	}else{
        		if($contra_a!=$user->contrasena){
                echo "<script>$('#mensajeC').append('<label class=\'text-danger\'>Error en la contraseña.</label>');$('#mensajeC').hide().fadeIn(1500);</script>"; 	
                }else{
                  $user->contrasena=$this->input->post('contra_n_u');
                //$user->dir_imagen=$this->input->post('telefono_u');
                  $user->update();
                 echo "<script>irUrl('cusuario');</script>";
                }
        	}
        }
	}
	function editar_imagen(){
		$nomimg=$_FILES["imagen_u"]["name"];
		$archivo=$_FILES["imagen_u"]["tmp_name"];
		$extencion=end(explode(".", $nomimg));
		$imagen_actual=$this->session->userdata('id_usuario_profile');
		if($nomimg!=null&&$archivo!=null){
			$carpeta="imagenes/storage/users/".$this->session->userdata('id_usuario_sesion')."-img";
                if(!file_exists($carpeta)){
                  mkdir($carpeta,0777,true);
                }
                $nombre=strftime('%Y%m%d_%H%M%S',time());
                $direccion=$carpeta."/".$nombre.".".$extencion;
                if($imagen_actual=="imagenes/storage/users/default-img/default-h.png"){
                  
                }else{
                	if($imagen_actual=="imagenes/storage/users/default-img/default-m.png"){

                	}else{
                		unlink($imagen_actual);
                	}                	
                }    
		        move_uploaded_file($archivo, $direccion);
		        $usuario=$this->usuario->getById($this->session->userdata('id_usuario_sesion'));
		        $usuario->dir_imagen=$direccion;
		        $usuario->update();
		        $usuario=$this->usuario->getById($this->session->userdata('id_usuario_sesion'));
		        $data=array('usuario_sesion'=>$usuario->usuario,'id_usuario_sesion'=>$usuario->id_usuario,'id_usuario_profile'=>$usuario->dir_imagen,'id_usuario_rol'=>$usuario->id_rol,'id_reg'=>$usuario->id_regional,'login'=>true);
			    $this->session->set_userdata($data);
		}
	redirect("cusuario");
  }
  function cambiar_avatar($id){
  	$carpeta="imagenes/storage/users/".$this->session->userdata('id_usuario_sesion')."-img";
    if(!file_exists($carpeta)){
      mkdir($carpeta,0777,true);
    }
    copy("imagenes/storage/users/avatars/".$id.".png", $carpeta."/".$id.".png");
    $usuario=$this->usuario->getById($this->session->userdata('id_usuario_sesion'));
    unlink($usuario->dir_imagen);
    $usuario->dir_imagen=$carpeta."/".$id.".png";
    $usuario->update();
    $usuario=$this->usuario->getById($this->session->userdata('id_usuario_sesion'));
    $data=array('usuario_sesion'=>$usuario->usuario,'id_usuario_sesion'=>$usuario->id_usuario,'id_usuario_profile'=>$usuario->dir_imagen,'id_usuario_rol'=>$usuario->id_rol,'id_reg'=>$usuario->id_regional,'login'=>true);
     $this->session->set_userdata($data);
	redirect("cusuario");
  }
}
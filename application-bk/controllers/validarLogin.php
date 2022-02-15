<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ValidarLogin extends CI_Controller {

	function index()
	{ 
	

	}
	public function validarCampo()
	 { 
	  $us=$_POST["us"];
	  $cn=$_POST["cn"];

	  if($us==""){
      echo "<script>$('#mensaje').append('<label class=\'text-warning\'>El campo de usuario esta vacío.</label>');$('#mensaje').hide().fadeIn(1500);</script>";
	  }else{
	  	if($cn==""){
	  	 echo "<script>$('#mensaje').append('<label class=\'text-warning\'>Es requerida una clave de usuario.</label>');$('#mensaje').hide().fadeIn(1500);</script>";
	  	}else{
	  		$usuario=$this->usuario->getLogin($us,$cn);
	  		if($usuario!=null){
	  			$data=array('usuario_sesion'=>$usuario->usuario,'id_usuario_sesion'=>$usuario->id_usuario,'id_usuario_profile'=>$usuario->dir_imagen,'id_usuario_rol'=>$usuario->id_rol,'id_reg'=>$usuario->id_regional,'login'=>true);
			    $this->session->set_userdata($data);
			    $this->usuario->online($usuario->id_usuario,1);
                echo "<script>$('#mensaje').append('<label class=\'text-success\'>Datos Correctos!.</label>');$('#mensaje').hide().fadeIn(1500);
                irUrl('home');</script>"; 
	  		}else{
	  			$personita=$this->usuario->getCorreoPer($us);
	  			if($personita!=null){
                    $usuario=$this->usuario->getById($personita->id_usuario);
                    if($usuario->contrasena==$cn){
                    	$data=array('usuario_sesion'=>$usuario->usuario,'id_usuario_sesion'=>$usuario->id_usuario,'id_usuario_profile'=>$usuario->dir_imagen,'id_usuario_rol'=>$usuario->id_rol,'id_reg'=>$usuario->id_regional,'login'=>true);
			            $this->session->set_userdata($data);
			            $this->usuario->online($usuario->id_usuario,1);
                        echo "<script>$('#mensaje').append('<label class=\'text-success\'>Datos Correctos!.</label>');$('#mensaje').hide().fadeIn(1500);
                        irUrl('home');</script>"; 
                    }
	  			}else{
                echo "<script>$('#mensaje').append('<label class=\'text-danger\'>No hay registros del usuario ingresado.</label>');$('#mensaje').hide().fadeIn(1500);
	  			</script>";
	  			}
	  			
	  		}

	  	}
	  }
	}
	public function validarCampoAux()
	 { 
	  $us=$_POST["us"];
	  $cn=$_POST["cn"];

	  if($us==""){
      echo "<script>cambiarClase('icon-u','bg-info','bg-warning');$('#mensaje').append('<label class=\'text-warning\'>El campo de usuario esta vacío.</label>');$('#mensaje').hide().fadeIn(1500);</script>";
	  }else{
	  	if($cn==""){
	  	 echo "<script>cambiarClase('icon-c','bg-info','bg-warning');$('#mensaje').append('<label class=\'text-warning\'>Es requerida una clave de usuario.</label>');$('#mensaje').hide().fadeIn(1500);</script>";
	  	}else{
	  		$usuario=$this->usuario->getLogin($us,$cn);
	  		if($usuario!=null){
	  			$data=array('usuario_sesion'=>$usuario->usuario,'id_usuario_sesion'=>$usuario->id_usuario,'id_usuario_rol'=>$usuario->id_rol,'login'=>true);
			    $this->session->set_userdata($data);
                echo "<script>irUrl('home');</script>"; 
	  		}else{
	  			echo "<script>cambiarClase('icon-u','bg-info','bg-danger');cambiarClase('icon-c','bg-info','bg-danger');$('#mensaje').append('<label class=\'text-warning\'>No hay registros del usuario ingresado.</label>');$('#mensaje').hide().fadeIn(1500);</script>";
	  		}

	  	}
	  }
	}
}
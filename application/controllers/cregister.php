<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cregister extends CI_Controller {

	public function index()
	{ 
		$this->load->view('plantilla/register');

	}
	function registrarNuevo(){
	  $n_u=$_POST["n_u"];
	  $a_u=$_POST["a_u"];
	  $f_u=$_POST["f_u"];
	  $u_u=$_POST["u_u"];
	  $p_u=$_POST["p_u"];
	  $p2_u=$_POST["p2_u"];
      $sex=$_POST['sex'];
      if($sex==1){
       $dir_i="imagenes/storage/users/default-img/default-h.png";
      }else{
      	$dir_i="imagenes/storage/users/default-img/default-m.png";
      }
	  if($p_u!=$p2_u){
      echo "<script>$('#mensajeR').append('<label class=\'mensaje-error\'>Las contraseñas no coinciden.</label>');$('#mensajeR').hide().fadeIn(1500);</script>";
	  }else{
	  	if($f_u==""){
	  	 echo "<script>$('#mensajeR').append('<label class=\'mensaje-error\'>La fecha de nacimiento no es valida.</label>');$('#mensajeR').hide().fadeIn(1500);</script>";
	  	}else{
	  		$usuario=$this->usuario->getByUsuario($u_u);
	  		if($usuario==null){
	  			$usuarion=New Usuario();
	  			$usuarion->usuario=$u_u;
	  			$usuarion->contrasena=$p_u;
	  			$usuarion->id_rol=1000;
	  			$usuarion->dir_imagen=$dir_i;
	  			$usuarion->sobre_mi="";
	  			$usuarion->add();
	  			$user=$this->usuario->getByUsuario($u_u);
	  			$personaln= New Personal();
	  			$personaln->numero_ci="000000-LP";
	  			$personaln->nombre_persona=$n_u;
	  			$personaln->apellido_persona=$a_u; 
	  			$personaln->correo="";
	  			$personaln->id_sexo=$sex; 
	  			$personaln->fecha_nacimiento=$f_u;
	  			$personaln->direccion="";
	  			$personaln->id_usuario=$user->id_usuario;
	  			$personaln->id_cargo="00-N";  
	  			$personaln->add();  

	  			$data=array('usuario_sesion'=>$user->usuario,'id_usuario_sesion'=>$user->id_usuario,'id_usuario_profile'=>$user->dir_imagen,'id_usuario_rol'=>$user->id_rol,'login'=>true);
			    $this->session->set_userdata($data);
                echo "<script>irUrl('home');</script>"; 
	  		}else{
	  			echo "<script>$('#mensajeR').append('<label class=\'mensaje-error\'>El nombre de usuario ya se encuentra registrado !</label>');$('#mensajeR').hide().fadeIn(1500);</script>";
	  		}

	  	}
	  }
	}
}

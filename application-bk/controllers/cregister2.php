<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "./apps/plugins/mail_p/send.php";
class Cregister2 extends CI_Controller {

	public function index()
	{ 
		$dato['regional']=$this->regional->getAll();
		$this->load->view('plantilla/register2',$dato);

	}
	function registrarNuevo(){
		$DesdeLetra = "a";
        $HastaLetra = "z";
        $DesdeNumero = 0;
        $HastaNumero = 9;
        $letra_num=null;
        $codigo=null;
        for ($i=0; $i < 8; $i++) { 
        	$letra_num=rand(0, 100);
            if($letra_num%2==0){
              $letraAleatoria = chr(rand(ord($DesdeLetra), ord($HastaLetra)));
              $codigo=$codigo."".$letraAleatoria;
            }else{
              $numeroAleatorio = rand($DesdeNumero, $HastaNumero);
              $codigo=$codigo."".$numeroAleatorio;
            }
        
        } 

     $nombre=$this->input->post('nombre_u');
     $apellido=$this->input->post('apellido_u');
     $sexo=$this->input->post('sexo');
     $fechan=$this->input->post('fnac_u');
     $correo=$this->input->post('correo');
     $reg=$this->input->post('reg');
     $ia=substr($apellido, 0, 1);
     $in=substr($nombre, 0, 1);
     $cadena = str_replace(' ', '', $apellido);
     $usr=$ia."".$in."".$cadena;
     if($sexo==1){
       $dir_i="imagenes/storage/users/default-img/default-h.png";
      }else{
      	$dir_i="imagenes/storage/users/default-img/default-m.png";
      }
      if($nombre==""||$apellido==""||$fechan==""||$correo==""){
       echo "<script>$('#mensajeR').append('<label class=\'text-warning\'>Debe llenar todos los campos</label>');$('#mensajeR').hide().fadeIn(1500);
       notificacion('top','center','Debe llenar todos los campos','info','now-ui-icons objects_key-25');</script>";
      }else{
       $usuario=$this->usuario->getByUsuario($usr);
       $emailc=$this->usuario->getCorreo($correo);
	  		if($usuario==null){                  
	  			if($emailc==null){
	  		   $mensaje="Usuario: ".$usr." <br> Contrasena: ".$codigo;
                 //Mando a llamar la funcion que se encarga de enviar el correo electronico
				
				/*Configuracion de variables para enviar el correo*/
				$mail_username="systierra2019@gmail.com";//Correo electronico saliente ejemplo: tucorreo@gmail.com
				$mail_userpassword="ft9419tierra";//Tu contraseña de gmail
				$mail_addAddress=$correo;//correo electronico que recibira el mensaje
				$template="./apps/plugins/mail_p/email_template.html";//Ruta de la plantilla HTML para enviar nuestro mensaje
				
				/*Inicio captura de datos enviados por $_POST para enviar el correo */
				$mail_setFromEmail="systierra2019@gmail.com";
				$mail_setFromName="SySTierra";
				$txt_message=$mensaje;
				$mail_subject="Registro de usuario";
				
				if(sendemail($mail_username,$mail_userpassword,$mail_setFromEmail,$mail_setFromName,$mail_addAddress,$txt_message,$mail_subject,$template)!=false)//Enviar el mensaje
	               {
	  				$usuarion=New Usuario();
	  			$usuarion->usuario=$usr;
	  			$usuarion->contrasena=$codigo;
	  			$usuarion->id_rol=1000;
	  			$usuarion->dir_imagen=$dir_i;
	  			$usuarion->sobre_mi="";
	  			$usuarion->id_regional=$reg;
	  			$usuarion->add();
	  			$user=$this->usuario->getByUsuario($usr);
	  			$personaln= New Personal();
	  			$personaln->numero_ci="000000-LP";
	  			$personaln->nombre_persona=$nombre;
	  			$personaln->apellido_persona=$apellido; 
	  			$personaln->correo=$correo;
	  			$personaln->id_sexo=$sexo; 
	  			$personaln->fecha_nacimiento=$fechan;
	  			$personaln->direccion="";
	  			$personaln->id_usuario=$user->id_usuario;
	  			$personaln->id_cargo="00-N";  
	  			$personaln->add();
                   }
			}else{
				echo "<script>$('#mensajeR').append('<label class=\'text-danger\'>Ese correo ya ha sido registrado</label>');$('#mensajeR').hide().fadeIn(1500);
				notificacion('top','center','Ya existe el correo','warning','now-ui-icons objects_key-25');</script>";
			}
	  			

	  		}else{
	  			echo "<script>$('#mensajeR').append('<label class=\'text-warning\'>El nombre de usuario ya se encuentra registrado !</label>');$('#mensajeR').hide().fadeIn(1500);
	  			notificacion('top','center','El nombre de usuario ya se encuentra registrado','warning','now-ui-icons objects_key-25');</script>";
	  		}

	}		
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cnuevo_mensaje extends C_datos {

	public function index()
	{ 	
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);		
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		$this->load->view('vsisinf/vmensaje/vnuevo_mensaje');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}


	function enviar(){
		$fecha=strftime('%Y-%m-%d %H:%M:%S',time());
		$persona=$this->personal->getByIdUsuario($this->session->userdata('id_usuario_sesion'));
		$recep=$this->personal->getByNombreApellidoUnido($this->input->post('receptor_u'));
		if($recep==null){
			redirect("cnuevo_mensaje");
		}
		$conv=$this->conversacion->getByIdUsuarios($persona->id_usuario,$recep->id_usuario);
		if($conv==null){
		  $conversacion=New Conversacion();
		  $conversacion->id_emisor=$persona->id_usuario;
		  $conversacion->id_receptor=$recep->id_usuario;
		  //$conversacion->creado_en=$fecha;
		  $conversacion->add();
		  $conv=$this->conversacion->getByIdUsuarios($persona->id_usuario,$recep->id_usuario);	
		}
		$mensaje=New Mensaje();
		$mensaje->id_usuario=$persona->id_usuario;
		$mensaje->id_conversacion=$conv->id_conversacion;
		$men=str_replace("'","''",$this->input->post('mensaje_u'));
		$mensaje->contenido=$men;
		$mensaje->leido_mensaje=0;
		//$mensaje->creado_en=$fecha;
		$mensaje->add();
		redirect('cchat_mensajes?user='.$recep->id_usuario.'&conv='.$conv->id_conversacion.'');
	}
	function buscar(){
		$recep=$this->personal->getByNombreApellidoUnido($this->input->post('receptor_u'));
		$conv=$this->conversacion->getByIdUsuarios($this->session->userdata('id_usuario_sesion'),$recep->id_usuario);
		redirect('cchat_mensajes?user='.$recep->id_usuario.'&conv='.$conv->id_conversacion.'');
	}
	function enviar_chat(){
		$iduser=$_REQUEST['iduser'];
		$persona=$this->personal->getByIdUsuario($this->session->userdata('id_usuario_sesion'));
		$recep=$this->personal->getByIdUsuario($iduser);
		$conv=$this->conversacion->getByIdUsuarios($persona->id_usuario,$recep->id_usuario);
		if($conv==null){
		  $conversacion=New Conversacion();
		  $conversacion->id_emisor=$persona->id_usuario;
		  $conversacion->id_receptor=$recep->id_usuario;
		  //$conversacion->creado_en=$fecha;
		  $conversacion->add();
		  $conv=$this->conversacion->getByIdUsuarios($persona->id_usuario,$recep->id_usuario);	
		}
		$mensaje=New Mensaje();
		$mensaje->id_usuario=$persona->id_usuario;
		$mensaje->id_conversacion=$conv->id_conversacion;
		$men=str_replace("'","''",$this->input->post('sms_enviar'));
		$mensaje->contenido=$men;
		$mensaje->leido_mensaje=0;
		//$mensaje->creado_en=$fecha;
		$mensaje->add();
		redirect('cchat_mensajes?user='.$iduser.'&conv='.$conv->id_conversacion.'');
	}
	function busqueda_u(){
		$persona=$this->personal->getByNombreApellido($_POST['var_b']);
		foreach ($persona->result() as $per) {
			echo "<script>$('#id_receptor_u').html('<option id=\'".$per->id_usuario."\' value=\'".$per->nombre_persona." ".$per->apellido_persona."\'>');</script>";
		}		
	}
}



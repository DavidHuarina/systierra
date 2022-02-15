<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cnueva_solicitud extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos();
		$datosUsuario['title_nav']="Solicitud";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');

		$this->load->view('vsisinf/vactividad/vnueva_solicitud');	

		$this->load->view('vsisinf/vplantilla/modals/vinfo_nproy');
		$this->load->view('vsisinf/vplantilla/vfooter');	
	}
   function completarDatos(){
		$datos['receptores']=$this->personal->getAllReceptores();
		return $datos;
	}
	function agregar(){
		$recep=$this->input->post('dest');
		if($this->formulario->existe($recep,$this->session->userdata('id_usuario_sesion'))->num==0){
			$nform=New Formulario();
            $nform->id_solicitante=$this->session->userdata('id_usuario_sesion');
            $nform->id_receptor=$recep;
            $nform->descripcion="";
            $formulario=$nform->add();

             $nsolicitud=New Solicitud();
             $nsolicitud->id_form=$formulario->id_form;
             $nsolicitud->descripcion="";
             $nsolicitud->total=0;
             $solicitud=$nsolicitud->add();
            //redirect('cenviar_solicitud');
            redirect('cenviar_solicitud?id='.$solicitud->id_sol);
		 }
		
	}
}
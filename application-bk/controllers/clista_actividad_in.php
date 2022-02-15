<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Clista_actividad_in extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos();
		$datosUsuario['title_nav']="Actividades";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		//$this->load->view('vsisinf/vactividad/vactividad_in');
		$this->load->view('vsisinf/vactividad/listas/actividades_in');
		$this->load->view('vsisinf/vplantilla/menus/vmenu_actividad');
		$this->load->view('vsisinf/vplantilla/modals/vact_modal');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function completarDatos(){
		$datos['proyecto']=$this->proyecto->getAllsDis();
		$datos['actividad']=$this->actividad->getAllIn($this->session->userdata('id_usuario_sesion'));
		$datos['ultima_act']=$this->actividad->getUltima($this->session->userdata('id_usuario_sesion'));
		$datos['actividadR']=$this->actividad->getEstadoRandom($this->session->userdata('id_usuario_sesion'),2);
		$contador=0;
		foreach ($datos['actividad']->result() as $act) {
		$idper=$this->personal->getByIdUsuario($this->session->userdata('id_usuario_sesion'));
        $equipotrab=$this->col_act->Existe($idper->id_persona,$act->act_id);
                 if($equipotrab->num!=0){
                 $contador=$contador+1;	
                 }
		}
		$datos['nact']=$contador;
		//$datos['nact']=$this->actividad->getNActIn($this->session->userdata('id_usuario_sesion'));
		return $datos;
	}
}
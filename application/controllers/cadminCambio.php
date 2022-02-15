<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class CadminCambio extends C_datos {

	public function index()
	{ 
		 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		if($this->session->userdata('id_usuario_rol')==5000||$this->session->userdata('id_usuario_rol')==4000){
          
          }else{
          redirect('salirSistema');	
          }
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
        $datosUsuario+=$this->complementarDatos();
		$datosUsuario['title_nav']="Administracion / Cambio";		
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion',$datosUsuario);
		$this->load->view('vsisinf/vadmin/vadminCambio',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/modals/vcam_modal');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function complementarDatos(){
		$datos['lista_cambio']=$this->cambio->getAll();
		$datos['nca']=$this->cambio->getAllN();
    return $datos;

	}
	function edit(){
        $com_id=$this->input->post('com_id');
         $com_nom=$this->input->post('com_nom');
         $com_sup=$this->input->post('com_sup');
         $com_fa=$this->input->post('com_fa');
         $com_pa=$this->input->post('com_pa');
         $this->cambio->update($com_id,$com_nom,$com_sup,$com_fa,$com_pa);
         
         redirect('cadminCambio');

    }
    function borrar(){
        $com_id=$this->input->post('com_ide');
         $this->cambio->delete($com_id);         
         redirect('cadminCambio');

    }
}
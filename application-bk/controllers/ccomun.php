<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Ccomun extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
       $datosUsuario+=$this->complementarDatos($this->session->userdata('id_usuario_sesion'));
       $datosUsuario['title_nav']="Comunidad";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		$this->load->view('vsisinf/proyecto/comunidades/vfiltro');
    $this->load->view('vsisinf/vplantilla/menus/vmenu_proyecto');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function complementarDatos($idUser){
        $datos['ncomtot']=$this->comunidad->getAllCN();
		$datos['departamento']=$this->comunidad->getAllDep();
		return $datos;
	}
    function lista(){
        $mc=$this->input->post('select-mun');
        redirect('ccomunidades?m='.$mc);
    }

	function cargaProv(){
		$provincia=$this->comunidad->getAllProv($_POST['id_dep']);
		$html="<option value='-1'>Provincia</option>";
                               foreach ($provincia->result() as $prov) {
                                $html.="<option value=".$prov->pro_id.">".$prov->pro_des."</option>";
                               }                    
        echo $html;

	}
	function cargaMun(){
		$municipio=$this->comunidad->getAllMun($_POST['id_prov']);
		$html="";
                               foreach ($municipio->result() as $mun) {
                                $html.="<option value=".$mun->mun_id.">".$mun->mun_des."</option>";
                               }                    
        echo $html;

	}
	
}



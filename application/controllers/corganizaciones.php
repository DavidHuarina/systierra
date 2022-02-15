<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Corganizaciones extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
       $datosUsuario+=$this->complementarDatos($this->session->userdata('id_usuario_sesion'));
       $datosUsuario['title_nav']="Comunidad";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		$this->load->view('vsisinf/proyecto/organizaciones/vorganizaciones');
        $this->load->view('vsisinf/vplantilla/menus/vmenu_proyecto');
        $this->load->view('vsisinf/vplantilla/modals/vorg_modal');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function complementarDatos($idUser){
        $datos['norgtot']=$this->organizacion->getAllON();
		$datos['organizaciones']=$this->organizacion->getAllO();
		return $datos;
	}


    
	function ncom(){
         $nc=$this->input->post('nombre_c');
         $dc=$this->input->post('select-dep');
         $pc=$this->input->post('select-prov');
         $mc=$this->input->post('select-mun');
         $sc=$this->input->post('sup_c');
         $nfc=$this->input->post('nfa_c');
         $npc=$this->input->post('npa_c');
         $desc=$this->input->post('des_c');

         $comunidad=New Comunidad();
         $comunidad->com_nom=$nc;
         $comunidad->mun_id=$mc;
         $comunidad->pro_id=$pc;
         $comunidad->dep_id=$dc;
         $comunidad->com_sup=$sc;
         $comunidad->com_nrofam=$nfc;
         $comunidad->com_nropar=$npc;
         $comunidad->com_obs=$desc;
         $comunidad->add();
         redirect('clista_proyecto');

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



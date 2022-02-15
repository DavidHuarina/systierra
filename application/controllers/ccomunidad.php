<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Ccomunidad extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
       $datosUsuario+=$this->complementarDatos($this->session->userdata('id_usuario_sesion'));
       $datosUsuario['title_nav']="Comunidad";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		$this->load->view('vsisinf/proyecto/comunidades/vnueva_comunidad');
    $this->load->view('vsisinf/vplantilla/menus/vmenu_proyecto');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function complementarDatos($idUser){
        $datos['ncomtot']=$this->comunidad->getAllCN();
		$datos['departamento']=$this->comunidad->getAllDep();
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
         
         $dept=$this->comunidad->getDeptId($dc);
         $comunidad=New Comunidad();
         $comunidad->com_nom=$nc;
         $comunidad->mun_id=$mc;
         $comunidad->pro_id=$pc;
         $comunidad->dep_id=$dc;
         $comunidad->dep_des=$dept->dep_des;
         $comunidad->viviendas=$sc;
         $comunidad->poblacion=$nfc;
         $comunidad->region=$npc;
         $comunidad->obs_ft1=$desc;
         $comunidad->add();
         redirect('ccomunidades');

	}
    function edit(){
        $com_id=$this->input->post('com_id');
         $com_nom=$this->input->post('com_nom');
         $com_sup=$this->input->post('com_sup');
         $com_fa=$this->input->post('com_fa');
         $com_pa=$this->input->post('com_pa');
         $com_obs=$this->input->post('com_obs');
         $this->comunidad->update($com_id,$com_nom,$com_sup,$com_fa,$com_pa,$com_obs);
         
         redirect('ccomunidades');

    }
    function borrar(){
        $com_id=$this->input->post('com_ide');
         $this->comunidad->delete($com_id);         
         redirect('ccomunidades');

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



<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Ccomunidades extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
        if(!isset($_REQUEST['m'])){
        $id_m=2;
        }else{
            if($_REQUEST['m']==""||$_REQUEST['m']==null){
             $id_m=8;
            }else{
               $id_m=$_REQUEST['m']; 
           }         
        }
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
       $datosUsuario+=$this->complementarDatos($this->session->userdata('id_usuario_sesion'),$id_m);
       $datosUsuario['title_nav']="Comunidad";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		$this->load->view('vsisinf/proyecto/comunidades/vcomunidades');
        $this->load->view('vsisinf/vplantilla/menus/vmenu_proyecto');
        $this->load->view('vsisinf/vplantilla/modals/vcom_modal');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function complementarDatos($idUser,$id_m){
        $datos['ncomtot']=$this->comunidad->getAllCN();
		$datos['comunidades']=$this->comunidad->getAllCMun($id_m);
        if($datos['comunidades']==null){
           redirect('ccomun');
        }
        $datos['comu']=$this->comunidad->getAllCMun1($id_m);
        $datos['ncomu']=$this->comunidad->getAllCMunN($id_m);
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
         $comunidad->viviendas=$sc;
         $comunidad->poblacion=$nfc;
         $comunidad->region=$npc;
         $comunidad->obs_ft1=$desc;
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



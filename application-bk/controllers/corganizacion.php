<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Corganizacion extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
       $datosUsuario+=$this->complementarDatos($this->session->userdata('id_usuario_sesion'));
       $datosUsuario['title_nav']="Comunidad";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		$this->load->view('vsisinf/proyecto/organizaciones/vnueva_organizacion');
    $this->load->view('vsisinf/vplantilla/menus/vmenu_proyecto');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function complementarDatos($idUser){
        $datos['norgtot']=$this->organizacion->getAllON();
		$datos['tipo']=$this->organizacion->getAllTO();
		return $datos;
	}
    
	function norg(){
         $no=$this->input->post('nombre_o');
         $to=$this->input->post('select-org');
         $deso=$this->input->post('des_o');

         $organizacion=New Organizacion();
         $organizacion->nombre_org=$no;
         $organizacion->id_tipo_org=$to;
         $organizacion->descripcion_o=$deso;
         $organizacion->add();
         redirect('corganizaciones');

	}
    function edit(){
        $org_id=$this->input->post('id_org');
         $org_nom=$this->input->post('nombre_org');
         $org_des=$this->input->post('des_org');
         $this->organizacion->update($org_id,$org_nom,$org_des);
         
         redirect('corganizaciones');

    }
    function borrar(){
        $id_org=$this->input->post('id_orge');
         $this->organizacion->delete($id_org);         
         redirect('corganizaciones');

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



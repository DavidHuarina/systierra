<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Csolicitudes extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos();
		$datosUsuario['title_nav']="Solicitudes";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		//$this->load->view('vsisinf/solicitud/vsolicitudes');
		$this->load->view('vsisinf/solicitud/vsolicitud_me');
		//$this->load->view('vsisinf/vplantilla/modals/vact_modal');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function completarDatos(){
		$datos['solicitud']=$this->solicitud->getAll($this->session->userdata('id_usuario_sesion'));
		$datos['nsol']=$this->solicitud->getNS($this->session->userdata('id_usuario_sesion'));
		return $datos;
	}
	function aprobar(){
		$id_sol=$_REQUEST['q'];
		$id_ac=$_REQUEST['z'];
		$this->solicitud->aprobar($id_sol);
        $this->actividad->modificarEstado(4,$id_ac);
		$solm=$this->solm->getByIdSol($id_sol);
		foreach ($solm->result() as $sm) {
			$this->ep->peracu($sm->id_ep,$sm->monto);
		}		
		redirect('csolicitudes');
	}
	function denegar(){
		$id_sol=$_REQUEST['q'];
		$id_ac=$_REQUEST['z'];
		//$this->solicitud->aprobar($id_sol);
        $this->actividad->modificarEstado(2,$id_ac);
         $carpeta="storage/solfa/".$id_sol."-SOL";
        $direccion=$carpeta."/solfa.pdf";
        unlink($direccion);
		redirect('csolicitudes');
	}
	function cargaProv(){
		$idde=$_POST['id_dep'];
		if($idde!=0){
		  if($idde==100){
           
		  }else{
		  	$provincia=$this->comunidad->getAllProv($idde);
		    $html="<option value='-1'>Provincia</option>";
                               foreach ($provincia->result() as $prov) {
                                $html.="<option value=".$prov->pro_id.">".$prov->pro_des."</option>";
                               }                    
            echo $html;
		  }	
		}
		

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
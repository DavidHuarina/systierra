<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cdetalle_actividad extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$id_p=$_REQUEST["id"];
		$id_ac=$_REQUEST["ac"];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id_p,$id_ac);
		$datosUsuario['title_nav']="Actividad";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');
		  $this->load->view('vsisinf/vactividad/vdetalle_actividad');	
		//$this->load->view('vsisinf/vplantilla/modals/vinfo_nproy');
		$this->load->view('vsisinf/vplantilla/vfooter');	
	}
   function completarDatos($id,$ac){
		$datos['proy']=$this->proyecto->getById($id);
		if($datos['proy']==null){
         redirect('clista_actividad_me');
       }
		$datos['actividad']=$this->actividad->getById($ac);
		if($datos['actividad']==null){
         redirect('clista_actividad_me');
       }
		$sol=$this->sol_act->getByIdA($ac);
		if($sol!=null){
		 $datos['soli']=$this->solicitud->getById($sol->id_sol);
		 $datos['des']=$this->descargo->getByIdSol($sol->id_sol);
		}
		
		if($datos['actividad']->com_id==0){
            $datos['ubicacion']=$this->lugar->getByAllAct($ac);
		}else{
			$datos['ubicacion']=$this->comunidad->getAllByAct($ac);
		}
		$datos['equipo']=$this->col_act->getAllActRN($ac);
		$datos['equipoi']=$this->col_act->getAllActRNI($ac);
		$datos['resp']=$this->col_act->getAllActR($ac);
		$datos['resumen']=$this->resumen->getByAct($ac);
		$datos['comunidades']=$this->com_act->getByAct($ac);
		$datos['participante']=$this->parti->getAllByIdA($ac);
		return $datos;
	}  
}
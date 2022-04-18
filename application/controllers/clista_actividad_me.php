<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Clista_actividad_me extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos();
		$datosUsuario['title_nav']="Actividades";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		$this->load->view('vsisinf/vactividad/listas/mis_actividades');
		$this->load->view('vsisinf/vplantilla/menus/vmenu_actividad');
		$this->load->view('vsisinf/vplantilla/modals/vact_modal');
		$this->load->view('vsisinf/vplantilla/modals/vconfirm_modal');
		$this->load->view('vsisinf/vplantilla/vfooter');
	}
	function completarDatos(){
		//$datos['proyecto']=$this->proyecto->getAlls();
		$datos['proyecto']=$this->proyecto->getAllsDis();
		if(isset($_GET['des'])){
			$datos['actividad']=$this->actividad->getAllEstado($this->session->userdata('id_usuario_sesion'),4);
		}else{			
			$datos['actividad']=$this->actividad->getAll($this->session->userdata('id_usuario_sesion'));
		}
		
		$datos['ultima_act']=$this->actividad->getUltima($this->session->userdata('id_usuario_sesion'));
		$datos['actividadR']=$this->actividad->getEstadoRandom($this->session->userdata('id_usuario_sesion'),4);
		$datos['nact']=$this->actividad->getNAct($this->session->userdata('id_usuario_sesion'));
		$datos['sin_descargo']=$this->actividad->getCantidadActividades($this->session->userdata('id_usuario_sesion'),4)->cantidad_sin_descargo;
		
		return $datos;
	}
	function eliminarSol($ac){
		$actividad=$this->actividad->getById($ac);
		$sola=$this->sol_act->getByIdA($ac);
		$solm=$this->solm->getByIdSol($sola->id_sol);
		foreach ($solm->result() as $solma) {
			$this->ep->peracuDes($solma->id_ep,$solma->monto);
		}
		$this->actividad->modificarEstado(2,$ac);
		$this->solicitud->modificarEstado(1,$sola->id_sol);
		if($actividad->act_padre==0){
       redirect('clista_actividad_me');
      }else{
        redirect('clista_actividad_me_sub?a='.$actividad->act_padre);
      }  
        
	}

	function eliminarUp($ac,$monto){
		$actividad=$this->actividad->getById($ac);
		$sola=$this->sol_act->getByIdA($ac);
		$solm=$this->solm->getByIdSol($sola->id_sol);
		foreach ($solm->result() as $solma) {
			$this->ep->peracuDes($solma->id_ep,450);
			break;
		}
        
	}

	function eliminarDes($ac){
		$actividad=$this->actividad->getById($ac);
		$sola=$this->sol_act->getByIdA($ac);
		$solm=$this->solm->getByIdSol($sola->id_sol);
		foreach ($solm->result() as $solma) {
			$det=$this->detalle_gastos->getByIdSol($solma->id_solm);
			foreach ($det->result() as $dett) {
				$this->ep->peracuDes($solma->id_ep,$dett->monto);
			}
			foreach ($det->result() as $dett) {
				$this->detalle_gastos->delete($dett->id_det);
			}				
		}
		$this->descargo->cero($sola->id_sol);
		$this->actividad->modificarEstado(2,$ac);
		$this->solicitud->modificarEstado(1,$sola->id_sol);
		if($actividad->act_padre==0){
       redirect('clista_actividad_me');
      }else{
        redirect('clista_actividad_me_sub?a='.$actividad->act_padre);
      }  
       
	}

	function delete($id){
      $actividad=$this->actividad->getById($id);
      switch($actividad->id_estado){
          case 1:
          $this->actividad->delete($id);
          break;
          case 2:
          $sola=$this->sol_act->getByIdA($id);
          if($sola==null){
           $solm=null;
          }else{
          	$solm=$this->solm->getByIdSol($sola->id_sol);
          }                  
          if($solm!=null){
          	foreach ($solm->result() as $solm) {
          		$this->solm->delete($solm->id_solm);
          	}             
          }
          $this->sol_act->delete($sola->id_sol_act);
          $this->descargo->delete2($sola->id_sol);
          $this->solicitud->delete($sola->id_sol);
          $this->actividad->delete($id);
          break;
      }
      if($actividad->act_padre==0){
       redirect('clista_actividad_me');
      }else{
        redirect('clista_actividad_me_sub?a='.$actividad->act_padre);
      }    
	}
}
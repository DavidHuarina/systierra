<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Home extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		echo "<script>var nactAno=[];</script>";
		for ($j=2000; $j <= (int)date("Y"); $j++) { 
			echo "<script>var nactMes=[0,0,0,0,0,0,0,0,0,0,0,0];</script>";
		for ($i=0; $i <12 ; $i++) { 
			$nact=$this->actividad->getActMes($j,$i+1)->num;
			
			echo "<script>nactMes[".$i."]=".$nact.";</script>";
			
		 }
		 echo "<script>nactAno[".$j."]=nactMes;</script>";
		}		
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos();
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');
		// $this->load->view('vsisinf/vplantilla/vpanelhome');
		$this->load->view('vsisinf/solicitud/vsolicitud_me');
		$this->load->view('vsisinf/vplantilla/vfooter');
		
	}
	function completarDatos(){
		$datos['solicitud']=$this->solicitud->getAllMe($this->session->userdata('id_usuario_sesion'));
		$datos['nsol']=$this->solicitud->getNSMe($this->session->userdata('id_usuario_sesion'));
		$datos['nproy']=$this->proyecto->getNproyS();
		$datos['nact']=$this->actividad->getNActS();
		return $datos;
	}
	function estadisti(){
		$ano=$_POST["ano"];
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

}
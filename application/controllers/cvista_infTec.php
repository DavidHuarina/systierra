<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cvista_infTec extends C_datos {

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
		  $this->load->view('vsisinf/vistas_previas/vvista_infTec');	
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
	function descargar($id,$ac){
        $datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id,$ac);

		$html=$this->load->view('vsisinf/vistas_previas/vvista_infTecImp',$datosUsuario,true);

        $direccion="storage/solfa/ufinf.pdf";
         $this->load->library('mydompdf');
         ob_clean();
         $this->mydompdf->load_html($html);
         $this->mydompdf->render();
         $salida=$this->mydompdf->output();
         file_put_contents($direccion,$salida);
        $this->mydompdf->set_base_path('apps/dompdf.css','apps/css/micss.css');
         $this->mydompdf->stream("informeTecnico.pdf", array("Attachment" => true));


	}
	function guardar($id,$ac){
        $datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id,$ac);
		$datosUsuario['sol']=$sol;
		$html=$this->load->view('vsisinf/vistas_previas/vvista_infTecImp',$datosUsuario,true);
        
        $carpeta="storage/infTec/".$ac."-INFT";
                if(!file_exists($carpeta)){
                  mkdir($carpeta,0777,true);
                }
        $direccion=$carpeta."/informeTecnico.pdf";
         $this->load->library('mydompdf');
         ob_clean();
         $this->mydompdf->load_html($html);
         $this->mydompdf->render();
         $salida=$this->mydompdf->output();
         file_put_contents($direccion,$salida);
         redirect('clista_actividad');
	}
  
}
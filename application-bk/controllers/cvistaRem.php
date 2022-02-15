<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class CvistaRem extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
			$id_p=$_REQUEST["id"];
		$id_ac=$_REQUEST["ac"];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id_p,$id_ac);
		$datosUsuario['title_nav']="Solicitud";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');
		  $this->load->view('vsisinf/vistas_previas/vvistaRem');	
		$this->load->view('vsisinf/vplantilla/modals/vinfo_nproy');
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
		$soli=$this->sol_act->getByIdA($ac);
		$df=$this->descargo->getByIdSol($soli->id_sol);
		$datos['sol']=$soli->id_sol;
		$datos['df']=$df->id_df;
		$datos['descargo']=$df;
		$datos['reembolso']=$this->rem_detg->getAllByIdDF($df->id_df);
		return $datos;
	}
	function descargar($id,$ac){
        $datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id,$ac);

		$html=$this->load->view('vsisinf/vistas_previas/vvistaRemImp',$datosUsuario,true);

        $direccion="storage/solfa/ufrem.pdf";
         $this->load->library('mydompdf');
         ob_clean();
         $this->mydompdf->load_html($html);
         $this->mydompdf->render();
         $salida=$this->mydompdf->output();
         file_put_contents($direccion,$salida);
        $this->mydompdf->set_base_path('apps/dompdf.css','apps/css/micss.css');
         $this->mydompdf->stream("cvistaRem.pdf", array("Attachment" => true));


	}
	function guardar($id,$ac){
        $datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id,$ac);
		$html=$this->load->view('vsisinf/vistas_previas/vvistaRemImp',$datosUsuario,true);
        
        $carpeta="storage/rem/".$ac."-rem";
                if(!file_exists($carpeta)){
                  mkdir($carpeta,0777,true);
                }
        $direccion=$carpeta."/rem.pdf";
         $this->load->library('mydompdf');
         ob_clean();
         $this->mydompdf->load_html($html);
         $this->mydompdf->render();
         $salida=$this->mydompdf->output();
         file_put_contents($direccion,$salida);
         //echo "<label class='text-success'>Se guardo el reembolso</label>";
         
	}
}
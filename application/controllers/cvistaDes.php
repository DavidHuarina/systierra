<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class CvistaDes extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$id_p=$_REQUEST["id"];
		$id_ac=$_REQUEST["ac"];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id_p,$id_ac);
		$datosUsuario['title_nav']="Solicitud";
		//$datosUsuario['sol']=$_REQUEST['sol'];
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');
		  $this->load->view('vsisinf/vistas_previas/vvistaDes');	
		$this->load->view('vsisinf/vplantilla/modals/vinfo_nproy');
		$this->load->view('vsisinf/vplantilla/vfooter');	
	}
   function completarDatos($id,$ac){
		$datos['proy']=$this->proyecto->getById($id);
          if($datos['proy']==null){
         redirect('clista_actividad_me');
       }
        $datos['detalle']=$this->detalle->getAll();
		$datos['rs']=$this->rs->getAll();

		$datos['actividad']=$this->actividad->getById($ac);
		if($datos['actividad']==null){
         redirect('clista_actividad_me');
       }
		$soli=$this->sol_act->getByIdA($ac);
		$df=$this->descargo->getByIdSol($soli->id_sol);
		
        $datos['sm']=$this->sol_act->getAllByIdA($datos['actividad']->act_id);
		$datos['dg']=$this->detalle_gastos->getAllByIdDF($df->id_df);
		$datos['sol']=$soli->id_sol;
		$datos['df']=$df->id_df;
		$datos['descargo']=$df;
		return $datos;
	}
	function descargar($id,$ac){
        $datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id,$ac);

		$html=$this->load->view('vsisinf/vistas_previas/vvistaDesImp',$datosUsuario,true);

        $direccion="storage/solfa/ufdes.pdf";
         $this->load->library('mydompdf');
         ob_clean();
         $this->mydompdf->set_paper ('a4','landscape'); 
         $this->mydompdf->load_html($html);
         $this->mydompdf->render();
         $salida=$this->mydompdf->output();
         file_put_contents($direccion,$salida);
        $this->mydompdf->set_base_path('apps/dompdf.css','apps/css/micss.css');
         $this->mydompdf->stream("cvistaDes.pdf", array("Attachment" => true));


	}
	function guardar($id,$ac,$rembol){
        $datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id,$ac);
		$html=$this->load->view('vsisinf/vistas_previas/vvistaDesImp',$datosUsuario,true);
        
        $carpeta="storage/descar/".$ac."-des";
                if(!file_exists($carpeta)){
                  mkdir($carpeta,0777,true);
                }
        $direccion=$carpeta."/des.pdf";
         $this->load->library('mydompdf');
         ob_clean();
         $this->mydompdf->set_paper ('a4','landscape');
         $this->mydompdf->load_html($html);
         $this->mydompdf->render();
         $salida=$this->mydompdf->output();
         file_put_contents($direccion,$salida);
          if($rembol==true||$rembol==1){
            redirect('cvistaRem/guardar/'.$id.'/'.$ac);
          }
         
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cvista_solA extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$id_p=$_REQUEST["id"];
		$id_ac=$_REQUEST["ac"];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id_p,$id_ac);
		$datosUsuario['title_nav']="Solicitud";
		$datosUsuario['sol']=$_REQUEST['sol'];


		//$this->load->view('vsisinf/vplantilla/vbarralateral');
		$this->load->view('vsisinf/vplantilla/vnavegacion_entero',$datosUsuario);
		  //$this->load->view('vsisinf/vistas_previas/vvista_solA');	///
		$this->load->view('vsisinf/vistas_previas/vvista_solANuevo');	
		$this->load->view('vsisinf/vplantilla/modals/vinfo_nproy');
		$this->load->view('vsisinf/vplantilla/vfooter');	
	}
   function completarDatos($id,$ac){
		$datos['proy']=$this->proyecto->getById($id);
		if($datos['proy']==null){
         redirect('clista_actividad_me');
       }
		$datos['fondo']=$this->proy_EP->getByIdProyecto($id);
		$datos['actividad']=$this->actividad->getById($ac);
		if($datos['actividad']==null){
         redirect('clista_actividad_me');
       }
		$datos['subru']=$this->subrubro->getAllByIdProy($id);
		$datos['ru']=$this->rubro->getAll();
		$datos['sm']=$this->sol_act->getAllByIdA($datos['actividad']->act_id);
		$datos['sm_fondos']=$this->sol_act->getAllByIdAFondosAvance($datos['actividad']->act_id);
		$datos['sm_gastos']=$this->sol_act->getAllByIdAGastosViaje($datos['actividad']->act_id);
		$datos['receptores']=$this->personal->getAllReceptores();
		return $datos;
	}
	function descargar($id,$ac,$sol,$mostrar=0){
        $datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id,$ac);
		$datosUsuario['sol']=$sol;
		// $html=$this->load->view('vsisinf/vistas_previas/vvista_solAImp',$datosUsuario,true);
		$html=$this->load->view('vsisinf/vistas_previas/vvista_solAImpNuevo',$datosUsuario,true);

        $direccion="storage/solfa/ufci.pdf";
         $this->load->library('mydompdf');
         $this->mydompdf->set_paper('letter', 'portrait');
         ob_clean();
         $this->mydompdf->load_html($html);
         $this->mydompdf->render();
         $canvas = $this->mydompdf->get_canvas();
    		 $canvas->page_text(520, 765, "Página:  {PAGE_NUM} de {PAGE_COUNT}",null, 9, array(0,0,0)); 
         $salida=$this->mydompdf->output();
         file_put_contents($direccion,$salida);
        $this->mydompdf->set_base_path('apps/dompdf.css','apps/css/micss.css');
        if($mostrar==0){
        	$this->mydompdf->stream("solicitud_fa.pdf", array("Attachment" => true));	
        }else{
        	$this->mydompdf->stream("solicitud_fa.pdf", array("Attachment" => false));
        }

	}

	function guardar($id,$ac,$sol){
        $datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id,$ac);
		$datosUsuario['sol']=$sol;
		$html=$this->load->view('vsisinf/vistas_previas/vvista_solAImp',$datosUsuario,true);
        
        $carpeta="storage/solfa/".$sol."-SOL";
                if(!file_exists($carpeta)){
                  mkdir($carpeta,0777,true);
                }
        $direccion=$carpeta."/solfa.pdf";
         $this->load->library('mydompdf');
         ob_clean();
         $this->mydompdf->load_html($html);
         $this->mydompdf->render();
         $salida=$this->mydompdf->output();
         file_put_contents($direccion,$salida);
         redirect('clista_actividad');
	}
  
}
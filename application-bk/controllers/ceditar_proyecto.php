<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Ceditar_proyecto extends C_datos {

	public function index()
	{ 
		
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$id_p=$_REQUEST["id"];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id_p);
		if($datosUsuario['idrol']==2||$datosUsuario['idrol']==1000||$datosUsuario['idrol']==2000||$datosUsuario['idrol']==3000){
			redirect("home");
		}
		//$datosUsuario['comunidad']=$this->comunidad->getAllC();
		$datosUsuario['title_nav']="Proyectos";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');
			//$this->load->view('vsisinf/proyecto/vnuevo_proyecto_paso2');
		$this->load->view('vsisinf/proyecto/veditar_proyecto');			
		$this->load->view('vsisinf/vplantilla/menus/vmenu_proyecto');
		$this->load->view('vsisinf/vplantilla/modals/vinfo_nproy');
		$this->load->view('vsisinf/vplantilla/vfooter');	
	}
	function completarDatos($id){
		$datos['proy']=$this->proyecto->getById($id);
		if($datos['proy']==null){
         redirect('clista_proyecto');
       }
		$datos['comunidad']=$this->com_proy->getByAllIdProy($id);
		$datos['ncom']=$this->com_proy->getNByAllIdProy($id);
		$datos['norg']=$this->org_proy->getNByAllIdProy($id);
		$datos['organizacion']=$this->org_proy->getByAllIdProy($id);
	    $datos['fondos']=$this->proy_EP->getByIdProyecto($id);
	    $datos['obes']=$this->obe->getByIdProy($id);
	    $datos['nobe']=$this->obe->getNObe($id);

	    $datos['comunidades']=$this->comunidad->getAllCP($id);
	    $datos['organizaciones']=$this->organizacion->getAllOP($id);
		return $datos;
	}
	function cantidadF($arreglo){
    $cont=0;
    foreach ($arreglo as $elemento) {
      $cont++;
    }
    return $cont;
   }
	function editar(){
		$id_p=$_REQUEST["id"];
		$np=$this->input->post('nombre_p');
		$fip=$this->input->post('fi_p');
		$ffp=$this->input->post('ff_p');
		$objgen=$this->input->post('obj_gen');
        $resumen=$this->input->post('resumen');

		$fecha_inicio=str_replace('/','-',$fip);
		$fecha_fin=str_replace('/','-',$ffp);
		if(strtotime($fecha_inicio)<strtotime($fecha_fin)) {
			$data = array(
				'nombre_proyecto' => $np,
				'fecha_inicio' => $fecha_inicio,
				'fecha_fin' => $fecha_fin,
				'obj_gen' => $objgen,
				'resumen' => $resumen);

			$this->proyecto->updateProy($data,$id_p);
		
		redirect('clista_proyecto');	
		}else{
			redirect('ceditar_proyecto?id='.$id_p);
		}
		
	}
	function eliminar(){
		$id=$_GET["id"];
		$this->proyecto->delete($id);
		redirect('clista_proyecto');
	}
}
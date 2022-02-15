<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cnuevo_proyecto extends C_datos {

	public function index()
	{ 
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		if($datosUsuario['idrol']==2||$datosUsuario['idrol']==1000||$datosUsuario['idrol']==2000||$datosUsuario['idrol']==3000){
			redirect("home");
		}
		$datosUsuario['comunidad']=$this->comunidad->getAllC();
		$datosUsuario['title_nav']="Proyectos";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');
			//$this->load->view('vsisinf/proyecto/vnuevo_proyecto_paso2');
		$this->load->view('vsisinf/proyecto/vnuevo_proyecto');			
		$this->load->view('vsisinf/vplantilla/menus/vmenu_proyecto');
		$this->load->view('vsisinf/vplantilla/modals/vinfo_nproy');
		$this->load->view('vsisinf/vplantilla/vfooter');	
	}
	function cantidadF($arreglo){
    $cont=0;
    foreach ($arreglo as $elemento) {
      $cont++;
    }
    return $cont;
   }
	function agregar(){
		$np=$this->input->post('nombre_p');
		$fip=$this->input->post('fi_p');
		$ffp=$this->input->post('ff_p');

		$objgen=$this->input->post('obj_gen');
		$objes1=$this->input->post('obj_es1');
		$objes2=$this->input->post('obj_es2');
		$objes3=$this->input->post('obj_es3');
		$obj_ind1=$this->input->post('obj_es_ind1');
		$obj_ind2=$this->input->post('obj_es_ind2');
		$obj_ind3=$this->input->post('obj_es_ind3');
		//$ncomunidad=$this->input->post('ncomunidad');
        

        $resumen=$this->input->post('resumen');

		$fecha_inicio=str_replace('/','-',$fip);
		$fecha_fin=str_replace('/','-',$ffp);
		if(strtotime($fecha_inicio)<strtotime($fecha_fin)) {
		$proyecto=New Proyecto();
		$proyecto->nombre_proyecto=strtoupper($np);
		$proyecto->fecha_inicio=$fip;
		$proyecto->fecha_fin=$ffp;
		$proyecto->id_responsable=$this->session->userdata('id_usuario_sesion');
		$proyecto->id_estado=1;
		$proyecto->resumen=$resumen;
		$proyecto->obj_gen=$objgen;
		$proyecto->presupuesto=1;
		$proy=$proyecto->add();

        if($objes1!=null){
        	$obe= New Obe();
        	$obe->descripcion=$objes1;
        	$obe->id_proyecto=$proy->id_proyecto;
        	if($obj_ind1!=null){
              $obe->indicador=$obj_ind1;
        	}else{
              $obe->indicador="";
        	}        	
        	$obe->add();
        }
        if($objes2!=null){
        	$obe= New Obe();
        	$obe->descripcion=$objes2;
        	$obe->id_proyecto=$proy->id_proyecto;
        	if($obj_ind2!=null){
              $obe->indicador=$obj_ind2;
        	}else{
              $obe->indicador="";
        	}
        	$obe->add();
        }
        if($objes3!=null){
        	$obe= New Obe();
        	$obe->descripcion=$objes3;
        	$obe->id_proyecto=$proy->id_proyecto;
        	if($obj_ind3!=null){
              $obe->indicador=$obj_ind3;
        	}else{
              $obe->indicador="";
        	}
        	$obe->add();
        }

        /* if($ncomunidad!=null){
         	$n=$this->cantidadF($ncomunidad);        
         for ($i=0; $i < $n; $i++) {           
          $com_proy = New Com_proy();
          $idc=str_replace("\'","",$ncomunidad[$i]);
          $com_proy->com_id=$idc;
          $com_proy->id_proyecto=$proy->id_proyecto;
          $com_proy->add();
          }

         }*/
		
		redirect('clista_proyecto');	
		}
		redirect('cnuevo_proyecto');
	}
	function eliminar(){
		$id=$_GET["id"];
		$this->proyecto->delete($id);
		redirect('clista_proyecto');
	}
}
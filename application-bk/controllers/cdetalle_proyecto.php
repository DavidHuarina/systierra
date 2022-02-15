<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cdetalle_proyecto extends C_datos {

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
		$datosUsuario['title_nav']="Detalles del proyecto";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');	
		$this->load->view('vsisinf/proyecto/vdetalle_proy');
		$this->load->view('vsisinf/vplantilla/modals/vinfo_nobe');
		$this->load->view('vsisinf/vplantilla/menus/vmenu_proyecto');
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
	function nobe(){
		$id_p=$_REQUEST["id"];
		$obe=$this->input->post('obe_p');
		if($obe!=""){
	    $ind=$this->input->post('indobe_p');
        $nobe=new Obe();
        $nobe->id_proyecto=$id_p;
        $nobe->descripcion=preg_replace("/[\r\n|\n|\r]+/", " ", $obe);
        $nobe->indicador=preg_replace("/[\r\n|\n|\r]+/", " ", $ind);
        $nobe->add();
        }
        redirect('cdetalle_proyecto?id='.$id_p);	
	}
	function eobe(){
		$id_p=$_REQUEST["id"];
		$cod=$this->input->post('obe_p_c');
		$obe=$this->input->post('obe_p_e');
		if($obe!=""){
		$ind=$this->input->post('indobe_p_e');
        $nobe=$this->obe->updateObe($cod,preg_replace("/[\r\n|\n|\r]+/", " ", $obe),preg_replace("/[\r\n|\n|\r]+/", " ", $ind));
       }
        redirect('cdetalle_proyecto?id='.$id_p);
	}
	function elobe(){
		$id_p=$_REQUEST["id"];
		$cod=$this->input->post('obe_cod');
		$res=$this->resultados->getByIdObe($cod);
		if($res->result()!=null){
         redirect('cdetalle_proyecto?id='.$id_p);
		}else{
		$this->obe->delete($cod);
        redirect('cdetalle_proyecto?id='.$id_p);
		}
        
	}
	function resultados(){
		$id_o=$_REQUEST["ido"];
		$datos['objetivo']=$this->obe->getById($id_o);
		$datos['result']=$this->resultados->getByIdObe($id_o);
		//$datos['nindicador']=$this->indicador->getByIdResult($id_o);
		$this->load->view('vsisinf/proyecto/vresultados_obe',$datos);	
	}
	function indicador(){
		$id_res=$_REQUEST["idres"];
		$datos['result']=$this->resultados->getById($id_res);
		$datos['indicador']=$this->indicador->getByIdResult($id_res);
		$this->load->view('vsisinf/proyecto/vindicador_obe',$datos);	
	}
	function actividad(){
		$id_ind=$_REQUEST["idind"];
		$datos['indicador']=$this->indicador->getById($id_ind);
		$datos['actividad']=$this->act_ml->getByIdInd($id_ind);
		$this->load->view('vsisinf/proyecto/vactividad_obe',$datos);	
	}
	function nres(){
		$id_p=$_POST["id"];		
		$cod=$_POST['obe_codd'];
		$res=$_POST['res_o'];
		if($res!=""){
        $nres=new Resultados();
        $nres->id_obe=$cod;
        $res = preg_replace("/[\r\n|\n|\r]+/", " ", $res);
        $nres->descripcion=$res;
        $nres->add();
        echo $cod;
        }
        //redirect('cdetalle_proyecto?id='.$id_p);
	}
	function eres(){
		$id_p=$_POST["id"];
		$cod=$this->input->post('codres_e');
		$res=$this->input->post('res_e');
		if($res!=""){
		$ind=$this->input->post('resin_e');
		$res = preg_replace("/[\r\n|\n|\r]+/", " ", $res);
        $this->resultados->updateRes($cod,$res);
        $resultados=$this->resultados->getById($cod);
        echo $resultados->id_obe;
        }
        //redirect('cdetalle_proyecto?id='.$id_p);
	}
	function elres(){
		$id_p=$_REQUEST["id"];
		$cod=$this->input->post('cod_el');
		$resultados=$this->resultados->getById($cod);       
		$this->resultados->delete($cod);
		echo $resultados->id_obe;
        //redirect('cdetalle_proyecto?id='.$id_p);
	}

	function nind(){
		$id_p=$_POST["id"];		
		$cod=$this->input->post('res_codd');
		$ind=$this->input->post('ind_r');
		if($ind!=""){
        $nres=new Indicador();
        $nres->id_result=$cod;
        $nres->descripcion=preg_replace("/[\r\n|\n|\r]+/", " ", $ind);
        $nres->add();
        echo $cod;
        }        
        //redirect('cdetalle_proyecto?id='.$id_p);
	}
	function eind(){
		$id_p=$_REQUEST["id"];
		$cod=$this->input->post('codind_e');
		$ind=$this->input->post('ind_e');
		if($ind!=""){
        $this->indicador->updateInd($cod,preg_replace("/[\r\n|\n|\r]+/", " ", $ind));
        $indicador=$this->indicador->getById($cod);
        echo $indicador->id_result;
        }
        //redirect('cdetalle_proyecto?id='.$id_p);
	}
	function elind(){
		$id_p=$_REQUEST["id"];
		$cod=$this->input->post('codind_el');
		$indicador=$this->indicador->getById($cod);        
		$this->indicador->delete($cod);
		echo $indicador->id_result;
        //redirect('cdetalle_proyecto?id='.$id_p);
	}
   
   function nact(){
		$id_p=$_POST["id"];		
		$cod=$this->input->post('ind_codigo');
		$ind=$this->input->post('act_i');
		if($ind!=""){
        $nres=new Act_ml();
        $nres->id_ind=$cod;
        $nres->descripcion=preg_replace("/[\r\n|\n|\r]+/", " ", $ind);
        $nres->add();
        echo $cod;
        }
        //redirect('cdetalle_proyecto?id='.$id_p);
	}
	function eact(){
		$id_p=$_REQUEST["id"];
		$cod=$this->input->post('ind_codigo_e');
		$ind=$this->input->post('act_i_e');
		if($ind!=""){
        $this->act_ml->updateAct($cod,preg_replace("/[\r\n|\n|\r]+/", " ", $ind));
        $actividad=$this->act_ml->getById($cod);
        echo $actividad->id_ind;
         } 
        //redirect('cdetalle_proyecto?id='.$id_p);
	}
	function elact(){
		$id_p=$_REQUEST["id"];
		$cod=$this->input->post('ind_codigo_el');
		$actividad=$this->act_ml->getById($cod);
		$this->act_ml->delete($cod);
        echo $actividad->id_ind;
        //redirect('cdetalle_proyecto?id='.$id_p);
	}
	function ncom(){
		$id_p=$_REQUEST["id"];
		$ncomunidad=$this->input->post('sel-com');
		if($ncomunidad!=null){
         	$n=$this->cantidadF($ncomunidad);        
         for ($i=0; $i < $n; $i++) {           
          $com_proy = New Com_proy();
          $com_proy->com_id=$ncomunidad[$i];
          $com_proy->id_proyecto=$id_p;
          $com_proy->add();
          }
         
         }
        redirect('cdetalle_proyecto?id='.$id_p); 
	}
	function elcom(){
		$id_p=$_REQUEST["id"];
		$id_c=$_REQUEST["idcom"];
		$this->com_proy->delete($id_c,$id_p);
		redirect('cdetalle_proyecto?id='.$id_p);
	}
	function norg(){
		$id_p=$_REQUEST["id"];
		$norganizacion=$this->input->post('sel-org');
		if($norganizacion!=null){
         	$n=$this->cantidadF($norganizacion);        
         for ($i=0; $i < $n; $i++) {           
          $org_proy = New Org_proy();
          $org_proy->id_org=$norganizacion[$i];
          $org_proy->id_proyecto=$id_p;
          $org_proy->add();
          }
         
         }
        redirect('cdetalle_proyecto?id='.$id_p); 
	}
	function elorg(){
		$id_p=$_REQUEST["id"];
		$id_o=$_REQUEST["idorg"];
		$this->org_proy->delete($id_o,$id_p);
		redirect('cdetalle_proyecto?id='.$id_p);
	}
	function cantidadF($arreglo){
    $cont=0;
    foreach ($arreglo as $elemento) {
      $cont++;
    }
    return $cont;
   }
}
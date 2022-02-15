<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cfondo_proy extends C_datos {

	public function index()
	{ 
		
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$id_p=$_REQUEST["id"];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		if(!isset($_REQUEST["c"])){
            $ca=0;   
		}else{
           $ca=$_REQUEST['c'];
		}
		$datosUsuario+=$this->completarDatos($id_p,$ca);
		if($datosUsuario['idrol']==2||$datosUsuario['idrol']==1000||$datosUsuario['idrol']==2000||$datosUsuario['idrol']==3000){
			redirect("home");
		}
		$datosUsuario['title_nav']="Fondo";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');
		if($datosUsuario['fondos']==null){
		 // $this->load->view('vsisinf/proyecto/vfondo_proy');
		 $this->agregarNuevoIdFondo($id_p);	
		}else{
		  $this->load->view('vsisinf/proyecto/vpresupuesto_proy');
		}	

		$this->load->view('vsisinf/vplantilla/modals/vinfo_nproy');
		$this->load->view('vsisinf/vplantilla/vfooter');	
	}
   function completarDatos($id,$ca){
		$datos['proy']=$this->proyecto->getById($id);
		if($datos['proy']==null){
         redirect('clista_proyecto');
       }
		 if($datos['proy']->presupuesto!=1){
		 	redirect('clista_proyecto');
		 }
		$datos['fondos']=$this->proy_EP->getByIdProyecto($id);
		$datos['cambio']=$this->cambio->getAll();
		if($datos['fondos']!=null){
			if($ca==0){
	    	 $datos['ep']=$this->ep->getAllByIdFondo($datos['fondos']->id_proy_ep);
	    	 $datos['cambioMon']=null;
	    	}else{
	    	 foreach ($datos['cambio']->result() as $cam) {
	    		if($ca==$cam->id_cambio){
	    			$datos['ep']=$this->ep->getAllByIdFondoCambio($datos['fondos']->id_proy_ep,$cam->valor);
	    			$datos['cambioMon']=$cam;
	    			break;
	    		}
	    	 }
	    	}
		}		
		$datos['subru']=$this->subrubro->getAll();
		$datos['ru']=$this->rubro->getAll();
		return $datos;
	}
	function agregar(){
		$id_p=$_REQUEST["id"];
		$fondo=$this->input->post('fondo_p');
		$fuente=$this->input->post('fuente_p');
        $fon=$this->proy_EP->getByNombre($fondo);
	
		if($fon==null){
		   $nproy_EP= new Proy_EP();
		   $nproy_EP->id_proyecto=$id_p;
		   $nproy_EP->descripcion=$fondo;
		   $nproy_EP->fondo=$fuente;
		   $nproy_EP->add();
            redirect('Cfondo_proy?id='.$id_p);
		}else{
           $nproy_EP= new Proy_EP();
		   $nproy_EP->id_proyecto=$id_p;
		   $nproy_EP->descripcion=$fondo.'F';
		   $nproy_EP->fondo=$fuente;
		   $nproy_EP->add();
            redirect('cfondo_proy?id='.$id_p);
		}
	}
	function agregarNuevoIdFondo($id_p){
		$nproy_EP= new Proy_EP();
		   $nproy_EP->id_proyecto=$id_p;
		   //$nproy_EP->descripcion="nextval('sq_fondo')";
		   $nproy_EP->fondo="ninguna";
		   $nproy_EP->addF();
           redirect('cfondo_proy?id='.$id_p);
	}
	function obtenerRubro(){
	  $s_r=$_POST["s_r"];
	  if($s_r!=""){
	  	$sub=$this->subrubro->getByNombre($s_r);
	  	$rubro=$this->rubro->getById($sub->id_rubro);	
          echo $rubro->descripcion;
	  }else{
	  	
	  	 echo "";
	  	}
	}
	function obtenerIdRubro(){
	  $s_r=$_POST["s_r"];
	  if($s_r!=""){
	  	$sub=$this->subrubro->getByNombre($s_r);
	  	$rubro=$this->rubro->getById($sub->id_rubro);	
          echo $rubro->id_rubro;
	  }else{
	  	
	  	 echo "";
	  	}
	}
	function obtenerCodRubro(){
	  $s_r=$_POST["s_r"];
	  if($s_r!=""){
	  	$sub=$this->subrubro->getByNombre($s_r);
	  	$rubro=$this->rubro->getById($sub->id_rubro);	
          echo $rubro->codigo;
	  }else{
	  	
	  	 echo "";
	  	}
	}
	function obtenerCodSubRubro(){
	  $s_r=$_POST["s_r"];
	  if($s_r!=""){
	  	$sub=$this->subrubro->getByNombre($s_r);
	  	
          echo $sub->codigo;
	  }else{
	  	
	  	 echo "";
	  	}
	}
	function obtenerCodRubroPorRubro(){
	  $s_r=$_POST["s_r"];
	  if($s_r!=""){
	  	$rubro=$this->rubro->getByNombre($s_r);	
          echo $rubro->codigo;
	  }else{
	  	
	  	 echo "";
	  	}
	}
}
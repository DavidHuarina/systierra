<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cpresupuesto_proy extends C_datos {

	public function index()
	{ 
		
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$id_p=$_REQUEST["id"];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id_p);
		$datosUsuario['title_nav']="Presupuesto";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');	
		$this->load->view('vsisinf/proyecto/vpresupuesto_proy');
		$this->load->view('vsisinf/vplantilla/modals/vinfo_nproy');
		$this->load->view('vsisinf/vplantilla/vfooter');	
	}
   function completarDatos($id){
		$datos['proy']=$this->proyecto->getById($id);
		if($datos['proy']==null){
         redirect('clista_proyecto');
       }
	    $datos['fondos']=$this->proy_EP->getByIdProyecto($id);
		return $datos;
	}
	function quitarEP(){
		$id_p=$_REQUEST["id"];
		$id_ep=$_REQUEST["idep"];
		$this->ep->delete($id_ep);
		redirect('cfondo_proy?id='.$id_p);

	}
	function quitarEP2(){
		$id_p=$_REQUEST["id"];
		$id_ep=$_REQUEST["idep"];
		$this->ep->delete($id_ep);
		redirect('cfondo_proy_edit?id='.$id_p);

	}
	function desaEP2(){
		$id_p=$_REQUEST["id"];
		$id_ep=$_REQUEST["idep"];
		$this->ep->updateEstado($id_ep,0);
		redirect('cfondo_proy_edit?id='.$id_p);

	}
	function habiEP2(){
		$id_p=$_REQUEST["id"];
		$id_ep=$_REQUEST["idep"];
		$this->ep->updateEstado($id_ep,1);
		redirect('cfondo_proy_edit?id='.$id_p);

	}
	function fin(){
		$id_p=$_REQUEST["id"];
		$this->proyecto->updatePresupuesto($id_p);
		redirect('clista_proyecto');
	}
	function agregarP(){
        $id_p=$_REQUEST["id"];
        $id_f=$_REQUEST["f"];
		$sub=$this->input->post('sub_rubro');
		$rub=$this->input->post('rubro');
		$csub=$this->input->post('c_sub_rubro');
		$crub=$this->input->post('c_rubro');
		$mon=$this->input->post('monto');
		$tipo=$this->input->post('select-bs');
		$rubro=$this->rubro->getByNombre($rub);
			
		    if($rubro==null){
             $nrubro= new Rubro();
             $nrubro->descripcion=$rub;
             $nrubro->codigo=$crub;
             $nrubro->add();
             $auxr=$this->rubro->getByNombre($rub);
		    }else{
		    	if($crub!=""){
                $this->rubro->updateCodigo($rubro->id_rubro,$crub);
		    	}
		        $auxr=$rubro;	
		    }

		    $subrubro=$this->subrubro->getByNombre($sub."@".$auxr->descripcion);
		    if($subrubro==null){
		    	  $nombre=$sub."@".$auxr->descripcion;
                  $nsubrubro= new Subrubro();
                  $nsubrubro->descripcion=$nombre;
                  $nsubrubro->codigo=$csub;
                  $nsubrubro->id_rubro=$auxr->id_rubro;
                  $nsubrubro->add();
                  $auxs=$this->subrubro->getByNombre($nombre);
		    }
		    else{
		    	if($csub!=""){
                $this->subrubro->updateCodigo($subrubro->id_subr,$csub);
		    	}
		    	$auxs=$subrubro;
		    }     	          
		    	  	
		    //$aep=$this->ep->getExiste($auxs->id_subr,$id_f);
		    //if($aep->num==0){	           
           $nep=new Ep();
           if($tipo==0){
           	$nep->original=$mon; 
           }else{
           	$tipo_m=$this->cambio->getById($tipo);
            $nep->original=$mon*$tipo_m->valor; 
           }                     
           $nep->id_subr=$auxs->id_subr;
           $nep->id_proy_ep=$id_f;
           $nep->add();
           redirect('cfondo_proy?id='.$id_p.'&c='.$tipo);
		//}else{
		//	redirect('cfondo_proy?id='.$id_p);
		//}
	}
	function agregarP2(){
        $id_p=$_REQUEST["id"];
        $id_f=$_REQUEST["f"];
		$sub=$this->input->post('sub_rubro');
		$rub=$this->input->post('rubro');
		$mon=$this->input->post('monto');
		$csub=$this->input->post('c_sub_rubro');
		$crub=$this->input->post('c_rubro');
		$tipo=$this->input->post('select-bs');
		$rubro=$this->rubro->getByNombre($rub);
			
		    if($rubro==null){
             $nrubro= new Rubro();
             $nrubro->descripcion=$rub;
             $nrubro->codigo=$crub;
             $nrubro->add();
             $auxr=$this->rubro->getByNombre($rub);
		    }else{
		    	if($crub!=""){
                $this->rubro->updateCodigo($rubro->id_rubro,$crub);
		    	}
		     $auxr=$rubro;	
		    }

		    $subrubro=$this->subrubro->getByNombre($sub."@".$auxr->descripcion);
		    if($subrubro==null){
		    	  $nombre=$sub."@".$auxr->descripcion;
                  $nsubrubro= new Subrubro();
                  $nsubrubro->descripcion=$nombre;
                  $nsubrubro->codigo=$csub;
                  $nsubrubro->id_rubro=$auxr->id_rubro;
                  $nsubrubro->add();
                  $auxs=$this->subrubro->getByNombre($nombre);
		    }
		    else{
		    	if($csub!=""){
                $this->subrubro->updateCodigo($subrubro->id_subr,$csub);
		    	}
		    	$auxs=$subrubro;
		    }     	          
		    	  	
		    //$aep=$this->ep->getExiste($auxs->id_subr,$id_f);
		    //if($aep->num==0){	           
           $nep=new Ep();
           if($tipo==0){
           	$nep->original=$mon; 
           }else{
           	$tipo_m=$this->cambio->getById($tipo);
            $nep->original=$mon*$tipo_m->valor; 
           }                     
           $nep->id_subr=$auxs->id_subr;
           $nep->id_proy_ep=$id_f;
           $nep->add();
           redirect('cfondo_proy_edit?id='.$id_p.'&c='.$tipo);
		//}else{
		//	redirect('cfondo_proy?id='.$id_p);
		//}
	}
}
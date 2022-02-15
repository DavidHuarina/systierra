<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cnequipo extends C_datos {

	public function index()
	{ 
		
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$id_ac=$_REQUEST["ac"];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id_ac);
		$datosUsuario['title_nav']="Equipo trabajo";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');

		$this->load->view('vsisinf/vactividad/vnequipo_t');

		$this->load->view('vsisinf/vplantilla/modals/vinfo_nproy');
		$this->load->view('vsisinf/vplantilla/vfooter');	
	}
   function completarDatos($ac){
   	    
		$datos['actividad']=$this->actividad->getById($ac);
		if($datos['actividad']==null){
         redirect('clista_actividad_me');
       }
		$datos['persona']=$this->persona->getAllInv();
		$datos['personasMe']=$this->personal->getAll();
		$datos['equipot']=$this->col_act->getAllAct($ac);
		return $datos;
	}
	function serParte($ac,$u,$r){
		$actividad=$this->actividad->getById($ac);
     $noti=new Notificacion();
     $noti->referencia="Solicita Unirse al grupo de trabajo"."%".$actividad->sub_nom."%".$ac;
     $noti->id_emisor=$u;
     $noti->id_receptor=$r;
     $noti->id_tipo_notificacion=6;
     $noti->add();
     redirect("clista_actividad_gen");
	}
	function darParte($ac,$u,$r){
		$actividad=$this->actividad->getById($ac);
     $noti=new Notificacion();
     $noti->referencia="Te agregó a una actividad"."%".$actividad->sub_nom."%".$ac;
     $noti->id_emisor=$u;
     $noti->id_receptor=$r;
     $noti->id_tipo_notificacion=5;
     $noti->add();
	}
	function cancelarDarParte($ac,$u){
		 $noti=$this->notificacion->solEmisor($this->session->userdata('id_usuario_sesion'));
         $idnoti=null;
         foreach ($noti->result() as $notifi) {
           $actividad = explode("%", $notifi->referencia);
           if($actividad[2]==$ac){
             $idnoti=$notifi->id_notificacion;
             break;
           }
         }
         $this->notificacion->delete($idnoti);
	}
	function cancelarParte($ac,$u,$r){
		 $noti=$this->notificacion->solEmisor($this->session->userdata('id_usuario_sesion'));
         $idnoti=null;
         foreach ($noti->result() as $notifi) {
           $actividad = explode("%", $notifi->referencia);
           if($actividad[2]==$ac){
             $idnoti=$notifi->id_notificacion;
             break;
           }
         }
         $this->notificacion->delete($idnoti);
         redirect("clista_actividad_gen");
	}
	function nequipo(){
		$id_p=$_POST["id_p"];
		$id_a=$_POST["id_a"];
		if($this->col_act->Existe($id_p,$id_a)->num==0){
		 $persona=$this->personal->getById($id_p);
		 if($persona==null){
		 	$resp=2;
		 }else{
		 	$resp=0;
		 }
        $nequipo=new Col_act();
		$nequipo->id_persona=$id_p;
		$nequipo->act_id=$id_a;
		$nequipo->resp=$resp;
		$nequipo->add();
		//$this->actividad->modificarEstado(4,$id_a);
		echo "ok";
        $this->darParte($id_a,$this->session->userdata('id_usuario_sesion'),$persona->id_usuario);
		}else{

			echo "ya existe el usuario";
		}		
	}
	function resp(){
		$id=$_REQUEST["id"];
		$ac=$_REQUEST["ac"];
		$this->col_act->updateResp($id,$ac,1);
		redirect("cnequipo?ac=".$ac);
	}
	function respn(){
		$id=$_REQUEST["id"];
		$ac=$_REQUEST["ac"];
		$this->col_act->updateResp($id,$ac,0);
		redirect("cnequipo?ac=".$ac);
	}
	function delete(){
		$id=$_POST["id"];
		$ac=$_POST["ac"];
		$per=$this->col_act->getAllActPer($ac,$id);
		$this->col_act->delete($per->col_id);
		$this->cancelarDarParte($ac,$this->session->userdata('id_usuario_sesion'));
	}
}
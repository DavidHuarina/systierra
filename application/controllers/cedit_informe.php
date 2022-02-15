<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cedit_informe extends C_datos {

	public function index()
	{ 
		
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
    $id_ac=$_REQUEST["ac"];
    $id_p=$_REQUEST["id"];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id_ac,$id_p);
		$datosUsuario['title_nav']="Equipo trabajo";
		$this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');
		$this->load->view('vsisinf/vactividad/vedit_informe');
		$this->load->view('vsisinf/vplantilla/vfooter');	
	}
   function completarDatos($ac,$ip){
   	$datos['proy']=$this->proyecto->getById($ip);
    if($datos['proy']==null){
         redirect('clista_actividad_me');
       }
       $datos['idproy']=$ip;
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
    $datos['comunidadesP']=$this->com_act->getByAct($ac);
    $datos['comunidades']=$this->com_proy->getByAllIdProy($ip);
    $datos['participante']=$this->parti->getAllByIdA($ac);
    return $datos;
	}
	function agregar(){
    $id_a=$_REQUEST['ac'];
    $id_p=$_REQUEST['p'];

        $tipopar=$this->parti->getAllTipo(); 
        $obser=$this->input->post('obser');
        $obs=$this->input->post('obs');
        $des=$this->input->post('des');
        $log=$this->input->post('log');
        $org=$this->input->post('org_inf');
        if($this->input->post('h1')==""){$dat[0][0]=0;}else{$dat[0][0]=$this->input->post('h1');}
        if($this->input->post('m1')==""){$dat[0][1]=0;}else{$dat[0][1]=$this->input->post('m1');}
        if($this->input->post('h2')==""){$dat[1][0]=0;}else{$dat[1][0]=$this->input->post('h2');}
        if($this->input->post('m2')==""){$dat[1][1]=0;}else{$dat[1][1]=$this->input->post('m2');}
        if($this->input->post('h3')==""){$dat[2][0]=0;}else{$dat[2][0]=$this->input->post('h3');}
        if($this->input->post('m3')==""){$dat[2][1]=0;}else{$dat[2][1]=$this->input->post('m3');}
        if($this->input->post('h4')==""){$dat[3][0]=0;}else{$dat[3][0]=$this->input->post('h4');}
        if($this->input->post('m4')==""){$dat[3][1]=0;}else{$dat[3][1]=$this->input->post('m4');}
        if($this->input->post('h5')==""){$dat[4][0]=0;}else{$dat[4][0]=$this->input->post('h5');}
        if($this->input->post('m5')==""){$dat[4][1]=0;}else{$dat[4][1]=$this->input->post('m5');}

        $j=0;$i=0;
        $particip=$this->parti->getAllByIdA($id_a);
        foreach ($particip->result() as $par) {
       // Update
            $datos=array('cant_h'=>$dat[$j][$i],'total'=>$dat[$j][$i]+$dat[$j][$i+1],'cant_m'=>$dat[$j][$i+1],'id_tipopar'=>$par->id_tipopar,'act_id'=>$id_a);
            $this->db->where('id_participante',$par->id_participante);
            $this->db->update('participante',$datos);
            $j=$j+1;
            $i=0;
        }
        $this->actividad->updateObser($id_a,$obser);
        $this->actividad->updateOrg($id_a,$org);
        $act=$this->actividad->getById($id_a);
        $this->resumen->updateRes($act->id_res,$obs,$des,$log);
        
        $rad=$this->input->post('optradio');

        $comunidadesAntiguas=$this->com_act->getByAct($id_a);
        foreach ($comunidadesAntiguas->result() as $comunic) {
          $this->com_act->delete($comunic->id_com_act);
        }
    if($rad==2){
      $comunidadesTotal=$this->com_proy->getByAllIdProy($id_p);
      foreach ($comunidadesTotal->result() as $comun) {
          $com_act = New Com_act();
          $com_act->com_id=$comun->com_id;
          $com_act->act_id=$id_a;
          $com_act->add();
      }
    }else{
      $ncomunidad=$this->input->post('sel-com');
    if($ncomunidad!=null){
          $n=$this->cantidadF($ncomunidad);        
         for ($i=0; $i < $n; $i++) {           
          $com_act = New Com_act();
          $com_act->com_id=$ncomunidad[$i];
          $com_act->act_id=$id_a;
          $com_act->add();
          }
         
         }
    }
        
    //$this->actividad->modificarEstado(4,$id_a);
    //redirect('cvista_infTec/guardar/'.$id_p.'/'.$id_a.'/'.$sol);
         redirect('clista_actividad');
  }
  function cantidadF($arreglo){
    $cont=0;
    foreach ($arreglo as $elemento) {
      $cont++;
    }
    return $cont;
   }
}
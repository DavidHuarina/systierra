<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cnuevo_informe extends C_datos {

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

		$this->load->view('vsisinf/vactividad/vnuevo_informe');

		$this->load->view('vsisinf/vplantilla/modals/vinfo_nproy');
		$this->load->view('vsisinf/vplantilla/vfooter');	
	}
   function completarDatos($ac,$ip){
   	$datos['comunidades']=$this->com_proy->getByAllIdProy($ip);
    $datos['organizaciones']=$this->org_proy->getByAllIdProy($ip);
    if($datos['comunidades']==null){
         redirect('clista_actividad_me');
       }
		$datos['actividad']=$this->actividad->getById($ac);
    if($datos['actividad']==null){
         redirect('clista_actividad_me');
       }
       $datos['idproy']=$ip;
		$datos['persona']=$this->persona->getAllInv();
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
        foreach ($tipopar->result() as $tp) {
           $nparti=new Parti();
		   $nparti->cant_h=$dat[$j][$i];
		   $nparti->total=$dat[$j][$i]+$dat[$j][$i+1];
		   $nparti->cant_m=$dat[$j][$i+1];
		   $nparti->id_tipopar=$tp->id_tipopar;
		   $nparti->act_id=$id_a;
		   $nparti->add();
		   $j=$j+1;
		   $i=0;
        }
        $this->actividad->updateObser($id_a,$obser);
        $this->actividad->updateOrg($id_a,$org);
        $act=$this->actividad->getById($id_a);
        $this->resumen->updateRes($act->id_res,$obs,$des,$log);
        
        $rad=$this->input->post('optradio');
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
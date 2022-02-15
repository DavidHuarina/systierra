<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cnuevo_descargo extends C_datos {

	public function index()
	{ 
	    
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$id_p=$_REQUEST["id"];
	    $id_a=$_REQUEST["ac"];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->complementarDatos($id_p,$id_a);
		$datosUsuario['title_nav']="Descargo";

        $this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		$this->load->view('vsisinf/descargo/vnuevo_descargo');
		$this->load->view('vsisinf/vplantilla/modals/vdes_modal');
		$this->load->view('vsisinf/vplantilla/vfooter');	
	}
	function complementarDatos($id,$ac){
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
		if($df->total!=0){
			redirect('home');
		}
        $datos['sm']=$this->sol_act->getAllByIdA($datos['actividad']->act_id);
		$datos['dg']=$this->detalle_gastos->getAllByIdDF($df->id_df);
		$datos['sol']=$soli->id_sol;
		$totalsol=0;
          foreach ($datos['dg']->result() as $detg) {
           $totalsol=$detg->monto_impuesto+$totalsol;
           }
        $datos['totdes']=$totalsol;
		$datos['df']=$df->id_df;
		return $datos;
	}
	function agregar(){

		$id_p=$_REQUEST["id"];
		$id_ac=$_REQUEST["ac"];
        $id_df=$_REQUEST["df"];
         $df=$this->descargo->getById($id_df);
		   if($df->total!=0){
		  	 redirect('home');
		   }
        $det=$this->input->post('cod_det');
		$rs=$this->input->post('cod_rs');

		$rss=$this->input->post('rs');
		$dett=$this->input->post('detalle');

		$sm=$this->input->post('select-sm');
		$monto=$this->input->post('monto');

		$fecha=$this->input->post('fi_p');
		$fac=$this->input->post('fac');
		if($fac==""){
			$fac=0;
		}


		$radio1=$this->input->post('optradio');
        
        if($rs=="NN"){
         $raz=$this->rs->getByNombre($rss);
         if($raz==null){
         	$razon=New Rs();
            $razon->descripcion=$rss;
            $ra=$razon->add();
            $rs=$ra->id_rs;
         }else{
         	$rs=$raz->id_rs;
         }	
        }
        if($det=="NN"){
        	$deta=$this->detalle->getByNombre($dett);
        	if($deta==null){
        	   $detalle=New Detalle();
               $detalle->nombre_detalle=$dett;
               $de=$detalle->add();
               $det=$de->id_detalle;
        	}else{
        		$det=$deta->id_detalle;
        	}          	
        }
        
        switch ($radio1) {
        	case 1:
           $imp_serv=$this->input->post('impuesto_ser');
        	if($imp_serv==""){
			$imp_serv=15;
		    }
        	$imp_bien=0;
        	$imp=($monto*$imp_serv)/100;
        	$monto_impuesto=$monto+$imp;		
            break;
            case 2:
            $radio2=$this->input->post('d_optradio');
              if($radio2==1){
               //factura
              	$imp_serv=0;
        	    $imp_bien=0;
        	    $monto_impuesto=$monto;
              }else{
               //recibo
              	$imp_bien=$this->input->post('impuesto');
              	if($imp_bien==""){
			    $imp_bien=8;
		        }
        	    $imp_serv=0;
        	    $imp=($monto*$imp_bien)/100;
        	    $monto_impuesto=$monto+$imp;
              } 		
            break;
            case 3:
              $imp_bien=$this->input->post('via_impuesto');
        	  if($imp_bien==""){
			  $imp_bien=13;
		      }
              $imp_serv=0;
        	  $imp=($monto*$imp_bien)/100;
        	  $monto_impuesto=$monto+$imp;
              $fac=$this->input->post('via_reci');	
            break;
        }

		$ndet=New Detalle_gastos();
		$ndet->n_fac_reci=$fac;
		$ndet->fecha=$fecha;
		$ndet->monto=$monto;
		$ndet->id_df=$id_df;
		$ndet->id_detalle=$det;
		$ndet->id_rs=$rs;
		$ndet->id_solm=$sm;
		$ndet->monto_impuesto=$monto_impuesto;
		$ndet->impuesto_serv=$imp_serv;
		$ndet->impuesto_bien=$imp_bien;
		$ndet->add();
        redirect('cnuevo_descargo?id='.$id_p.'&ac='.$id_ac);
	}
	function getIdD(){
		$n_d=$_POST["n_d"];
		$det=$this->detalle->getByNombre($n_d);
		echo $det->id_detalle;
	}
	function getIdRS(){
		$n_rs=$_POST["n_rs"];
		$rs=$this->rs->getByNombre($n_rs);
		echo $rs->id_rs;
	}
	function quitarDG(){
		$id_p=$_REQUEST["id"];
		$id_ac=$_REQUEST["ac"];

		$idg=$_REQUEST["idg"];
		$this->detalle_gastos->delete($idg);
		redirect('cnuevo_descargo?id='.$id_p.'&ac='.$id_ac);

	}
	function fin2($id_df){
	  $df=$this->descargo->getById($id_df);
	  $sol=$df->id_sol;
      $this->solicitud->modificarEstado(3,$sol);
      $ac=$this->sol_act->getBySol($sol);
	  $this->actividad->modificarEstado(5,$ac->act_id);
	  $act=$this->actividad->getById($ac->act_id);
	  redirect('cvistaDes/guardar/'.$act->id_proyecto.'/'.$ac->act_id);
	}
	function fin(){
		$banco=$_POST["banco"];
		$ncheque=$_POST["ncheque"];
		$impo=$_POST["importe"];
		$id_df=$_POST["id"];
		if($banco=="NN"||$ncheque=="NN"||$impo==""){
			echo "No se admiten campos vacios";
		}else{
			//if() para reembolso
			$df=$this->descargo->getById($id_df);
		   if($df->total!=0){
		  	 redirect('home');
		   }
		   $sol=$df->id_sol;
		   $this->solicitud->updateTotal($sol,$impo);
		   $this->descargo->updateDescargo($id_df,$banco,$ncheque);
		   if($this->rem_detg->existe($id_df)->num==0){
		   	$this->solicitud->modificarEstado(3,$sol);
		   }else{
		   	$this->solicitud->modificarEstado(4,$sol);
		   }		   
		   $ac=$this->sol_act->getBySol($sol);
		   $this->actividad->modificarEstado(5,$ac->act_id);
		   $act=$this->actividad->getById($ac->act_id);
		   echo "ok";
		   $remm=0;
		   redirect('cvistaDes/guardar/'.$act->id_proyecto.'/'.$ac->act_id.'/'.$remm);
		}
		
	}

	function reembolso(){
		$justi=$_POST["justi"];
		$monto=$_POST["monto"];
		$id_df=$_POST["id"];
		if($justi==""||$monto==""){
			echo "<label class='text-danger'>No se admiten campos vacios</label>";
		}else{
			if($this->rem_detg->existe($id_df)->num==0){
            $rem=New Rem();
            $rem->id_solicitante=$this->session->userdata('id_usuario_sesion');
            $rem->monto=$monto;
            $rem->justificacion=$justi;
            $remi=$rem->add();
			//$df=$this->descargo->getById($id_df);
			$rem_detg=New Rem_detg();
			$rem_detg->id_rem=$remi->id_rem;
			$rem_detg->id_df=$id_df;
			$rem_detg->add();
			$df=$this->descargo->getById($id_df);
			$this->descargo->updateDescargo($id_df,"Ninguno","Ninguno");

			$sol_a=$this->sol_act->getByIdSol($df->id_sol);
			$acti=$this->actividad->getById($sol_a->act_id);
			
	        $sol=$df->id_sol;
            $this->solicitud->modificarEstado(3,$sol);
            $ac=$this->sol_act->getBySol($sol);
	        $this->actividad->modificarEstado(5,$ac->act_id);
	        redirect('cvistaDes/guardar/'.$acti->id_proyecto.'/'.$acti->act_id.'/'.true);
			
			}else{
				echo "<label class='text-warning'>Ya se guardó el reembolso</label>";
			}
           //se puede actualizar el estado de la solicitud o descargo
		}
		
	}
	
}
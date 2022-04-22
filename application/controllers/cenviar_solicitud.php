<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cenviar_solicitud extends C_datos {

	public function index()
	{ 
		
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
		$id_p=$_REQUEST["id"];
		$id_ac=$_REQUEST["ac"];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->completarDatos($id_p,$id_ac);
		$datosUsuario['title_nav']="Solicitud";
		// $this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		// $this->load->view('vsisinf/vplantilla/vnavegacion');
		$this->load->view('vsisinf/vplantilla/vnavegacion_entero',$datosUsuario);
		if($datosUsuario['actividad']->id_estado==1){
		  $this->load->view('vsisinf/vactividad/vnueva_solicitud');	
		}else{
			if(isset($_REQUEST['sol'])){
				$datosUsuario['sol']=$_REQUEST['sol'];
			}else{
				$soli=$this->solicitud->getByAc($id_ac);
				$datosUsuario['sol']=$soli->id_sol;
			}
		  $this->load->view('vsisinf/vactividad/vform_solicitud_act',$datosUsuario);
		}	
        $this->load->view('vsisinf/vplantilla/modals/vconfirm_modal');
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
		$datos['receptores']=$this->personal->getAllReceptores();
		$datos['equipot']=$this->col_act->getAllAct($ac);
		return $datos;
	}
   function agregar(){
     	$id_p=$_REQUEST["id"];
		$id_ac=$_REQUEST["ac"];
		$recep=$this->input->post('select-act_ml');
		
		if($this->formulario->existe($recep,$this->session->userdata('id_usuario_sesion'))->num==0){
			$nform=New Formulario();
            $nform->id_solicitante=$this->session->userdata('id_usuario_sesion');
            $nform->id_receptor=$recep;
            $nform->descripcion="";
            $formulario=$nform->add();
          }else{
          	$formulario=$this->formulario->getByIds($recep,$this->session->userdata('id_usuario_sesion'));
          }
             $nsolicitud=New Solicitud();
             $nsolicitud->id_form=$formulario->id_form;
             $nsolicitud->descripcion="";
             $nsolicitud->total=0;
             $solicitud=$nsolicitud->add();

             $ndescargo=New Descargo();
             //$ndescargo->total=0; total de gastos
             //$ndescargo->saldo=0; //saldo depositado
             //$ndescargo->f_descargo=null;
             //$ndescargo->observacion="";
             $ndescargo->id_sol=$solicitud->id_sol;
             $ndescargo->add();

             $this->actividad->modificarEstado(2,$id_ac);
              
             if($this->sol_act->existe($solicitud->id_sol,$id_ac)->num==0){
              $sol_act= new Sol_act();
              $sol_act->act_id=$id_ac;
              $sol_act->id_sol=$solicitud->id_sol;
              $sol_act->add();
              }
            //redirect('cenviar_solicitud');
             redirect('cenviar_solicitud?id='.$id_p.'&ac='.$id_ac.'&sol='.$solicitud->id_sol);
		
	}

	
	function getIdS(){
		$n_s=$_POST["n_s"];
		$sub=$this->subrubro->getByNombre($n_s);
		echo $sub->id_subr;
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
	function quitarSol(){
		$id_a=$_REQUEST["id"];
		$id_p=$_REQUEST["idp"];
		$sol=$_REQUEST["sol"];
		$id_solm=$_REQUEST["s"];
		$sm=$this->solm->getById($id_solm);
		$this->solicitud->updateTotalMenos($sol,$sm->monto);
		$this->solm->delete($id_solm);
		redirect('cenviar_solicitud?id='.$id_p.'&ac='.$id_a.'&sol='.$sol);
	}
	function fin_sol(){
		$id_a=$_REQUEST["id"];
		$id_p=$_REQUEST["idp"];
		$sol=$_REQUEST["sol"];
		$this->actividad->modificarEstado(3,$id_a);
		$solicitud=$this->solicitud->getAllByIdS($sol);
		$actividad=$this->actividad->getById($id_a);
		$noti=new Notificacion();
        $noti->referencia="Tienes una solicitud"."%".$actividad->sub_nom."%".$id_a;
        $noti->id_emisor=$solicitud->id_solicitante;
        $noti->id_receptor=$solicitud->id_receptor;
        $noti->id_tipo_notificacion=2;
        $noti->add();
		redirect('cvista_solA/guardar/'.$id_p.'/'.$id_a.'/'.$sol);
	}
	function act_sol(){
		$id_a=$_REQUEST["id"];
		$id_p=$_REQUEST["idp"];
		$sol=$_REQUEST["sol"];		
		$s=$this->input->post('cod_sr');
		$f=$this->input->post('cod_fondo');
		$monto=$this->input->post('monto');
		$des=$this->input->post('des');
		$tipoForm=$this->input->post('tipo_solicitud');
		$ep=$this->ep->getByIdSF($s,$f);
         
         //if($this->solm->existe($ep->id_ep)->num==0){
		if(!($ep==null||$ep==211)&&$tipoForm!=1){
			$ver=$this->solm->existe2($ep->id_ep,$sol);
			if($ver->num==0){
              $solm=new Solm();
		        $solm->monto=$monto;
		        $solm->id_ep=$ep->id_ep;
		        $solm->id_sol=$sol;
		        $solm->descripcion=$des;
		        $id=$solm->add();
		        $this->solicitud->updateTotal($sol,$monto);
			}            
		}else{
			$epGeneral=211;

			//BORRAR DETALLES
			$sql="SELECT id_solm FROM sol_montos where id_sol='$sol' and id_via_item>0;";
         $res=$this->funciones->queryGeneral($sql);
         foreach ($res->result() as $row) {
         	$idSolMonto=$row->id_solm;
         	$sqlDel="DELETE FROM sol_montos_detalle_item WHERE id_sol_monto='$idSolMonto';";
         	$this->funciones->queryGeneral($sqlDel);
         	$sqlDel="DELETE FROM sol_montos_detalle_retencion WHERE id_sol_monto='$idSolMonto';";
         	$this->funciones->queryGeneral($sqlDel);
         }
         $sqlDel="DELETE FROM sol_montos WHERE id_sol='$sol' and id_via_item>0;";
         $this->funciones->queryGeneral($sqlDel);
         

         //REGISTRAR DETALLE Y SOLICITUD PERDIEM
         if($this->input->post("total_perdiem")>0){         	
         	$equipo=$this->col_act->getAllAct($id_a);
	         $solm=new Solm();
	         $solm->monto=0;
	         $solm->id_ep=$epGeneral;
	         $solm->id_sol=$sol;
	         $solm->descripcion='PERDIEM GASTOS';
	         $id=$solm->add();
	         $sqlUpdate="UPDATE sol_montos SET id_via_item=1 WHERE id_solm='$id->id_solm'";
	         $this->funciones->queryGeneral($sqlUpdate);
	         //
	         foreach ($equipo->result() as $per) {
				  $sql="SELECT v.id,v.descripcion,(SELECT precio_bruto from via_item_localidad where id_tipo_localidad=v.id and id_item=1) as precio_bruto FROM via_tipo_localidad v where v.estado=1;";
	           $res=$this->funciones->queryGeneral($sql);           
	           $montoRetencion=$this->input->post("ret_1_".$per->id_persona);
	           $porcentajeItem=$this->input->post("ret_1");
	           foreach ($res->result() as $row) {
	           		$montoItem=$this->input->post("localidad_".$row->id);
	           		$cantidadItem=$this->input->post("dias_".$row->id."_".$per->id_persona); 
	           		             		           	          		
	           		$sqlInsert="INSERT INTO sol_montos_detalle_item(id_persona,id_via_localidad,id_via_item,id_sol_monto,monto,cantidad) VALUES ('$per->id_persona','$row->id','1','$id->id_solm','$montoItem','$cantidadItem')";
	         		$this->funciones->queryGeneral($sqlInsert);	         			         			
	           }//for item         	
	           $sqlInsert="INSERT INTO sol_montos_detalle_retencion(id_persona,id_via_retencion,id_via_item,id_sol_monto,monto,porcentaje) VALUES ('$per->id_persona','1','1','$id->id_solm','$montoRetencion','$porcentajeItem')";
	           $this->funciones->queryGeneral($sqlInsert);
	         }//for equipo
	         $sqlUpdate="UPDATE sol_montos SET monto='".$this->input->post("total_perdiem")."' WHERE id_solm='$id->id_solm'";
	         $this->funciones->queryGeneral($sqlUpdate);         
         }


         //REGISTRAR DETALLE Y SOLICITUD AEREO
         if($this->input->post("total_aereo")>0){         	
         	$equipo=$this->col_act->getAllAct($id_a);
	         $solm=new Solm();
	         $solm->monto=0;
	         $solm->id_ep=$epGeneral;
	         $solm->id_sol=$sol;
	         $solm->descripcion='TRASPORTE AEREO GASTOS';
	         $id=$solm->add();
	         $sqlUpdate="UPDATE sol_montos SET id_via_item=2 WHERE id_solm='$id->id_solm'";
	         $this->funciones->queryGeneral($sqlUpdate);
	         //
	         foreach ($equipo->result() as $per) {
				  $sql="SELECT v.id,v.descripcion,(SELECT precio_bruto from via_item_localidad where id_tipo_localidad=v.id and id_item=2) as precio_bruto FROM via_tipo_localidad v where v.estado=1;";
	           $res=$this->funciones->queryGeneral($sql);           
	           $montoRetencion=$this->input->post("reta_2_".$per->id_persona);
           	  $porcentajeItem=$this->input->post("reta_2");
           	  $montoRetencion2=$this->input->post("reta_3_".$per->id_persona);
           	  $porcentajeItem2=$this->input->post("reta_3"); 
	           foreach ($res->result() as $row) {
	           		$montoItem=$this->input->post("localidada_".$row->id);
	           		$cantidadItem=$this->input->post("diasa_".$row->id."_".$per->id_persona); 
	           		            		           	          		
	           		$sqlInsert="INSERT INTO sol_montos_detalle_item(id_persona,id_via_localidad,id_via_item,id_sol_monto,monto,cantidad) VALUES ('$per->id_persona','$row->id','2','$id->id_solm','$montoItem','$cantidadItem')";
	         		$this->funciones->queryGeneral($sqlInsert);	         			         			
	           }//for item         	
	           $sqlInsert="INSERT INTO sol_montos_detalle_retencion(id_persona,id_via_retencion,id_via_item,id_sol_monto,monto,porcentaje) VALUES ('$per->id_persona','2','2','$id->id_solm','$montoRetencion','$porcentajeItem')";
	           $this->funciones->queryGeneral($sqlInsert);
      		  $sqlInsert="INSERT INTO sol_montos_detalle_retencion(id_persona,id_via_retencion,id_via_item,id_sol_monto,monto,porcentaje) VALUES ('$per->id_persona','3','2','$id->id_solm','$montoRetencion2','$porcentajeItem2')";
      		  $this->funciones->queryGeneral($sqlInsert);
	         }//for equipo
	         $sqlUpdate="UPDATE sol_montos SET monto='".$this->input->post("total_aereo")."' WHERE id_solm='$id->id_solm'";
	         $this->funciones->queryGeneral($sqlUpdate);         
         }


         //REGISTRAR DETALLE Y SOLICITUD PERDIEM
         if($this->input->post("total_pernocte")>0){         	
         	$equipo=$this->col_act->getAllAct($id_a);
	         $solm=new Solm();
	         $solm->monto=0;
	         $solm->id_ep=$epGeneral;
	         $solm->id_sol=$sol;
	         $solm->descripcion='PERNOCTE GASTOS';
	         $id=$solm->add();
	         $sqlUpdate="UPDATE sol_montos SET id_via_item=3 WHERE id_solm='$id->id_solm'";
	         $this->funciones->queryGeneral($sqlUpdate);
	         //
	         foreach ($equipo->result() as $per) {
				  $sql="SELECT v.id,v.descripcion,(SELECT precio_bruto from via_item_localidad where id_tipo_localidad=v.id and id_item=3) as precio_bruto FROM via_tipo_localidad v where v.estado=1;";
	           $res=$this->funciones->queryGeneral($sql);           	           
	           foreach ($res->result() as $row) {
	           		$montoItem=$this->input->post("localidadp_".$row->id);
	           		$cantidadItem=$this->input->post("diasp_".$row->id."_".$per->id_persona); 
	           		            		           	          		
	           		$sqlInsert="INSERT INTO sol_montos_detalle_item(id_persona,id_via_localidad,id_via_item,id_sol_monto,monto,cantidad) VALUES ('$per->id_persona','$row->id','3','$id->id_solm','$montoItem','$cantidadItem')";
	         		$this->funciones->queryGeneral($sqlInsert);	         			         			
	           }//for item         	
	         }//for equipo
	         $sqlUpdate="UPDATE sol_montos SET monto='".$this->input->post("total_pernocte")."' WHERE id_solm='$id->id_solm'";
	         $this->funciones->queryGeneral($sqlUpdate);         
         }

		}		           
         //}		       
        
        //$this->actividad->modificarEstado(3,$id_a);
		redirect('cenviar_solicitud?id='.$id_p.'&ac='.$id_a.'&sol='.$sol);
	}
}
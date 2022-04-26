<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH."controllers/c_datos.php";
class Cnueva_actividad extends C_datos {

	public function index()
	{ 
	   
		$titulo = array('titulo' => "Sistema de gestión - Fundacion Tierra");
		$this->load->view('vsisinf/vplantilla/vcabecera',$titulo);
     $id_p=$_REQUEST["id"];
      $fa=$_REQUEST["fa"];
      $pa=$_REQUEST["p"];
		$datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
		$datosUsuario+=$this->complementarDatos($id_p);
		$datosUsuario['fa']=$fa;
    $datosUsuario['pa']=$pa;
		$datosUsuario['title_nav']="Actividad";
        $this->load->view('vsisinf/vplantilla/vbarralateral',$datosUsuario);
		$this->load->view('vsisinf/vplantilla/vnavegacion');		
		$this->load->view('vsisinf/vactividad/vnueva_actividad');
		$this->load->view('vsisinf/vplantilla/vfooter');	
	}
	function complementarDatos($id){
		$datos['proy']=$this->proyecto->getById($id);
    if($datos['proy']==null){
      redirect('clista_actividad_me');
    }
		//$datos['obes']=$this->obe->getByIdProy($id);
		$datos['act_ml']=$this->act_ml->getByIdProy($id);
		$datos['comunidades']=$this->com_proy->getByAllIdProy($id);
		$datos['departamento']=$this->comunidad->getAllDep();
		$datos['detalle']=$this->sub_tipoact->getAll();
        $datos['tipo']=$this->tipoact->getAll();
		return $datos;
	}
	function delete($id){
      $actividad=$this->actividad->getById($id);
      switch($actividad->id_estado){
          case 1:
          $sola=$this->sol_act->getByIdA($id);
          if($sola==null){
           $solm=null;
          }else{
            $solm=$this->solm->getByIdSol($sola->id_sol);
          }                  
          if($solm!=null){
            foreach ($solm->result() as $solm) {
              $this->solm->delete($solm->id_solm);
            }             
          }
          $this->sol_act->delete($sola->id_sol_act);

          $descargosf=$this->descargo->getByIdSol($sola->id_sol);
           $rem_det=$this->rem_detg->getByDF($descargosf->id_df);
            if($rem_det!=null){
              $this->rem_detg->delete($rem_det->id_rd);
              $this->rem->delete($rem_det->id_rem);
            }
          $this->descargo->delete2($sola->id_sol);
          $this->solicitud->delete($sola->id_sol);
          $this->com_act->deleteGroup($id);
          $this->col_act->deleteGroup($id);
          $this->res_act->deleteGroup($id);
          $this->parti->deleteGroup($id);
          $this->resumen->delete($actividad->id_res);
          $this->res_act->deleteGroup($id);
          $this->actividad->delete($id);
          break;
          case 2:
          $sola=$this->sol_act->getByIdA($id);
          if($sola==null){
           $solm=null;
          }else{
          	$solm=$this->solm->getByIdSol($sola->id_sol);
          }                  
          if($solm!=null){
          	foreach ($solm->result() as $solm) {
          		$this->solm->delete($solm->id_solm);
          	}             
          }
          $this->sol_act->delete($sola->id_sol_act);

          $descargosf=$this->descargo->getByIdSol($sola->id_sol);
           $rem_det=$this->rem_detg->getByDF($descargosf->id_df);
            if($rem_det!=null){
              $this->rem_detg->delete($rem_det->id_rd);
              $this->rem->delete($rem_det->id_rem);
            }
          $this->descargo->delete2($sola->id_sol);
          $this->solicitud->delete($sola->id_sol);
          $this->com_act->deleteGroup($id);
          $this->col_act->deleteGroup($id);
          $this->parti->deleteGroup($id);
          $this->resumen->delete($actividad->id_res);
          $this->res_act->deleteGroup($id);
          $this->actividad->delete($id);
          break;
      }
      if($actividad->act_padre==0){
       redirect('clista_actividad_me');
      }else{
        redirect('clista_actividad_me_sub?a='.$actividad->act_padre);
      }    
	}
	function cargaRes(){
		$resultado=$this->resultados->getByIdObe($_POST['id_obe']);
		$html="<option value='-1'>Ninguno</option>";
                               foreach ($resultado->result() as $res) {
                                $html.="<option value=".$res->id_result.">".$res->descripcion."</option>";
                               }                    
        echo $html;

	}
	function cargaInd(){
		$indicador=$this->indicador->getByIdResult($_POST['id_obe']);
		$html="<option value='-1'>Ninguno</option>";
                               foreach ($indicador->result() as $res) {
                                $html.="<option value=".$res->id_ind.">".$res->descripcion."</option>";
                               }                    
        echo $html;

	}
	function cargaAct(){
		$actividad=$this->act_ml->getByIdInd($_POST['id_obe']);
                               foreach ($actividad->result() as $res) {
                                $html.="<option value=".$res->id_act_ml.">".$res->descripcion."</option>";
                               }                    
        echo $html;

	}
	function obtenerTipoA(){
	  $d_a=$_POST["d_a"];
	  if($d_a!=""){
	  	$det=$this->sub_tipoact->getByNombre($d_a);
	  	$tipoact=$this->tipoact->getById($det->tipo_id);	
          echo $tipoact->tipo_nom;
	  }else{
	  	
	  	 echo "";
	  	}
	}
    function cantidadF($arreglo){
    $cont=0;
    foreach ($arreglo as $elemento) {
      $cont++;
    }
    return $cont;
   }
   function agregar(){
        $id_p=$_REQUEST["id"];
        $pa=$_REQUEST["a"];
		$det=$this->input->post('det_a');
		//$tipo=$this->input->post('tipo_a');
    $tipo=$this->input->post('sel-tipo');
    $tipon=$this->tipoact->getById($tipo);
    $tipo=$tipon->tipo_nom;
    $tipoact=$this->tipoact->getByNombre($tipo);
		$f_a=$this->input->post('fi_p');
    $fi_p_salida=$this->input->post('fi_p_salida');
		$dias=$this->input->post('dias');
		$res=$this->input->post('select-act_ml');
		$com_otro=$this->input->post('optradio');

		 if($tipoact==null){
             $ntipoact= new Tipoact();
             $ntipoact->tipo_nom=$tipo;
             $ntipoact->add();
             $auxt=$this->tipoact->getByNombre($tipo);
		    }else{
		     $auxt=$tipoact;	
		    }
		    $sub_tipoact=$this->sub_tipoact->getByNombre($det."@".$auxt->tipo_nom);

		    	if($sub_tipoact==null){
		    		$nombre=$det."@".$auxt->tipo_nom;
                    $nsub_tipoact= new Sub_tipoact();
                    $nsub_tipoact->sub_nom=$nombre;
                    $nsub_tipoact->tipo_id=$auxt->tipo_id;
                    $nsub_tipoact->add();
                    $auxd=$this->sub_tipoact->getByNombre($nombre);
		    	}else{
		    		$auxd=$sub_tipoact;
		    	}   	


		   /* $aep=$this->actividad->getExiste($auxd->sub_id,$obe);
		    if($aep->num==0){	  */ 
		     if($com_otro=='1'){
                  $com=$this->input->post('select-com');
                  if($com!="0"){
                  	$lug=0;
                  }else{
                  	redirect('cnueva_actividad?id='.$id_p);
                  }
                  
               }else{
               	  $com=0;
                  $depto=$this->input->post('select-dep');
                  if($depto=="100"){
                    $pais=$this->input->post('dir_otro_pais');
                    $ciudad=$this->input->post('dir_otro_ciudad');
                    $mun=0;
                  }else{
                    $pais="";
                    $ciudad="";
                    $mun=$this->input->post('select-mun');
                  }
               	  
               	  $dir=$this->input->post('dir_otro');
               	  if($mun!="-1"){
                    if($this->lugar->getByDireccionN($dir,$mun)->num==0){
                     $lugar=New Lugar();
                     $lugar->mun_id=$mun;
                     $lugar->direccion=$dir;
                     $lugar->pais=$pais;
                     $lugar->ciudad=$ciudad;
                     $nlugar=$lugar->add();
                     $lug=$nlugar->id_lugar;
               	   }else{
                     $lugar=$this->lugar->getByDireccionM($dir,$mun);
                     $lug=$lugar->id_lugar;
               	   }
               	  }else{
               	  	redirect('cnueva_actividad?id='.$id_p);
               	  }
               	  
               	  
               } 
               

               if($res!=null){
               $resumen=new Resumen();
               $resumen->objetivos="";
               $resumen->descripcion=""; 
               $resumen->logros=""; 
               $resu=$resumen->add();

               $nactividad=new Actividad();
               $nactividad->act_fecha=$f_a;
               $nactividad->act_fecha_salida=$fi_p_salida;
               $nactividad->act_resp=$this->session->userdata('id_usuario_sesion');
               $nactividad->act_dias=$dias;
               $nactividad->sub_id=$auxd->sub_id;
               $nactividad->com_id=$com;
               $nactividad->id_lugar=$lug;           
               $nactividad->id_act_ml=0;
               $nactividad->id_res=$resu->id_res;
               $nactividad->act_padre=$pa;
               $ida=$nactividad->add();

                  $n=$this->cantidadF($res);        
                 for ($i=0; $i < $n; $i++) {           
                  $res_act = New Res_act();
                  $res_act->id_result=$res[$i];
                  $res_act->act_id=$ida->act_id;
                  $res_act->add();
                  }
               //creacion de formulario para la solicitud

                // $id_p=$_REQUEST["id"];
                $id_ac=$ida->act_id;
                $recep="ADMIN-04"; //ID DEL USUSARIO RECEPTOR
    
                if($this->formulario->existe($recep,$this->session->userdata('id_usuario_sesion'))->num==0){
            $nform=New Formulario();
            $nform->id_solicitante=$this->session->userdata('id_usuario_sesion');
            $nform->id_receptor=$recep;
            $nform->descripcion="";
            $formulario=$nform->add();
          }else{
            $formulario=$this->formulario->getByIds($recep,$this->session->userdata('id_usuario_sesion'));
          }
             // $nsolicitud=New Solicitud();
             // $nsolicitud->id_form=$formulario->id_form;
             // $nsolicitud->descripcion="";
             // $nsolicitud->total=0;
             // $solicitud=$nsolicitud->add();

             // $ndescargo=New Descargo();
             // //$ndescargo->total=0; total de gastos
             // //$ndescargo->saldo=0; //saldo depositado
             // //$ndescargo->f_descargo=null;
             // //$ndescargo->observacion="";
             // $ndescargo->id_sol=$solicitud->id_sol;
             // $ndescargo->add();

             // //$this->actividad->modificarEstado(2,$id_ac);
              
             // if($this->sol_act->existe($solicitud->id_sol,$id_ac)->num==0){
             //  $sol_act= new Sol_act();
             //  $sol_act->act_id=$id_ac;
             //  $sol_act->id_sol=$solicitud->id_sol;
             //  $sol_act->add();
             //  } 

          //FIN DE LA INSERCION DE FORMULARIO SOLICITUD

    //SOL_MONTOS DE TODOS LOS ITEMS YA QUE ESTA OPCION ESTA DESHABILITADA
            $id_a=$id_ac;
    //$id_p=$_REQUEST["idp"];
            
//    $allep=$this->ep->getAll();
//             $fondo=$this->proy_EP->getByIdProyecto($id_p);

// foreach ($allep->result() as $allep) {
//     $sol=$solicitud->id_sol;
//     $s=$allep->id_subr;
//     $f=$fondo->id_proy_ep;
//     $monto=0;
//     $des="Sin descripcion";
//     $ep=$this->ep->getByIdSF($s,$f);
         
//       //if($this->solm->existe($ep->id_ep)->num==0){
//     if($ep!=null){
//       $ver=$this->solm->existe2($ep->id_ep,$sol);
//       if($ver->num==0){
//                 $solm=new Solm();
//             $solm->monto=$monto;
//             $solm->id_ep=$ep->id_ep;
//             $solm->id_sol=$sol;
//             $solm->descripcion=$des;
//             $id=$solm->add();
//             $this->solicitud->updateTotal($sol,$monto);
//       }            
//     }
// }
    
           
////////////////////////////////////////////////////FIN DE SOL_MONTOS

//finalizacion de solicitud con solmontos

    //$this->actividad->modificarEstado(3,$ida);
    // $solicitud=$this->solicitud->getAllByIdS($sol);
    // $actividad=$this->actividad->getById($ida->act_id);
    // $noti=new Notificacion();
    //     $noti->referencia="Tienes una solicitud"."%".$actividad->sub_nom."%".$ida->act_id;
    //     $noti->id_emisor=$solicitud->id_solicitante;
    //     $noti->id_receptor=$solicitud->id_receptor;
    //     $noti->id_tipo_notificacion=2;
    //     $noti->add();

        ////////////////////////////////////////

               if($pa==0){
               redirect('clista_actividad'); 
             }else{
              redirect('clista_actividad_me_sub?a='.$pa);
             }

               }else{
                redirect('clista_actividad'); 
               }
                  
        
		/*}else{
			redirect('clista_actividad_proy?id='.$id_p);
		}*/
	}
	function llenaT(){
		$act=$_POST["ac"];
		$id=$_POST['id_us'];
		$sel=$_POST['id_sel'];
		if($sel=='invitado'){
			$persona=$this->persona->getById($id);
			$imagen="imagenes/storage/users/default-img/person.jpg";
		}else{
			$persona=$this->personal->getAllIdPersona($id);
			$imagen=$persona->dir_imagen;
		}
		if($id!='-1'){		
		$html="";
        $html.="<tr id='".$persona->id_persona."'>
        <td><img class='rounded-circle' src='".$imagen."' width='50' height='50' alt='image' /></td>
        <td>".$persona->nombre_persona."</td><td>".$persona->apellido_persona."</td>
        <td>Sin registrar</td>
        <td><a class='btn-default' onclick='borrarTabla(".$act.",".$persona->id_persona.",\"".$sel."\")'><i class='fa fa-times text-danger fa-fw'></i></a></td>
        </tr>";  
        echo $html;                                              
		}		          
	}
	function llenaTI(){
		$act=$_POST["ac"];
		$nom=$_POST["nom"];
		$ap=$_POST["ap"];
		$tel=$_POST["tel"];
        if($tel==""){$tel=0;}
		$existep=$this->persona->getByNombreApTelN($nom." ".$ap);
		if($existep->num==0){
		$npersona=New Persona();
		$npersona->nombre_persona=$nom;
		$npersona->apellido_persona=$ap;	
		$npersona->telefono=$tel;
		$pe=$npersona->add();
		$persona=$this->persona->getById($pe->id_persona);		
		$html="";
        $html.="<tr id='".$persona->id_persona."'>
        <td><img class='rounded-circle' src='imagenes/storage/users/default-img/person.jpg' width='50' height='50' alt='image' /></td>
        <td>".$persona->nombre_persona."</td><td>".$persona->apellido_persona."</td>
        <td>Sin registrar</td>
        <td><a class='btn-default' onclick='borrarTabla(".$act.",".$persona->id_persona.",\"invitado\")'><i class='fa fa-times text-danger fa-fw'></i></a></td>
        </tr>";  
        echo $persona->id_persona."@".$html."@".$persona->nombre_persona." ".$persona->apellido_persona;
		}else{
			//$persona=$this->persona->getByNombreApTel($nom." ".$ap." ".$tel);
			echo "-1"."@"."0"."@"."NN";
		}
		                                              	          
	}
	function cargaProv(){
		$provincia=$this->comunidad->getAllProv($_POST['id_dep']);
		$html="<option value='-1'>Provincia</option>";
                               foreach ($provincia->result() as $prov) {
                                $html.="<option value=".$prov->pro_id.">".$prov->pro_des."</option>";
                               }                    
        echo $html;

	}
	function cargaMun(){
		$municipio=$this->comunidad->getAllMun($_POST['id_prov']);
		$html="";
                               foreach ($municipio->result() as $mun) {
                                $html.="<option value=".$mun->mun_id.">".$mun->mun_des."</option>";
                               }                    
        echo $html;

	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_datos extends CI_Controller {

	public function index()
  { 
   // $datosUsuario=$this->obtenerDatosUsuario($this->session->userdata('id_usuario_sesion'));
    //echo "<script>document.getElementById('nmensaje').value='123';</script>";
   // $this->load->view('vsisinf/vplantilla/vnav_datos',$datosUsuario);
   // echo "<script>alert('jejej');</script>";
  
  }
  function obtenerDatosUsuario($idUser){
    
    $dRA=$this->personal->getByCargo2("24-C");
    if($dRA!=null){
      echo "<script>var dirRegAl=['".$dRA->nombre_persona." ".$dRA->apellido_persona."','".$dRA->dir_imagen."'];</script>";
    }else{
      echo "<script>var dirRegAl=['No Hay Director registrado','imagenes/perfiles/default-a.png'];</script>";
    }

    $dRV=$this->personal->getByCargo2("25-C");
    if($dRV!=null){
      echo "<script>var dirRegVa=['".$dRV->nombre_persona." ".$dRV->apellido_persona."','".$dRV->dir_imagen."'];</script>";
    }else{
      echo "<script>var dirRegVa=['No Hay Director registrado','imagenes/perfiles/default-a.png'];</script>";
    }

    $dRO=$this->personal->getByCargo2("26-C");
    if($dRO!=null){
      echo "<script>var dirRegOr=['".$dRO->nombre_persona." ".$dRO->apellido_persona."','".$dRO->dir_imagen."'];</script>";
    }else{
      echo "<script>var dirRegOr=['No Hay Director registrado','imagenes/perfiles/default-a.png'];</script>";
    }
    
    //$usuario=$this->usuario->getById($idUser);
    $personal = $this->personal->getByIdUsuario($idUser);
    $roles=$this->rol->getById($this->session->userdata('id_usuario_rol'));
    $datos['nombreUsuario']=$personal->nombre_persona;
    $datos['title_nav']="Inicio";
    $datos['nombreUsuarioCompleto']=$personal->nombre_persona." ".$personal->apellido_persona;
    $datos['rol']=ucfirst(strtolower($roles->descripcion." "));
    $datos['idrol']=$roles->id_rol;
    $datos['cargop']=$personal->nombre_cargo;
    $datos['personas']=$this->personal->getAllNotMe($idUser);
    $datos['personasall']=$this->personal->getAll();
    if($this->session->userdata('id_reg')==null){
      $id_reg=1000;
    }else{
      $id_reg=$this->session->userdata('id_reg');
    }
    $regionales=$this->regional->getById($id_reg);
    $municipioLocal=$this->comunidad->getAllMunId($regionales->mun_id);
    $datos['ciudad']=$municipioLocal->mun_des;
    $datos['regional']=$regionales->nombre_regional;
   $lconver=$this->conversacion->getAllCn($personal->id_usuario);
    if($lconver->row()==null){
     $datos['nfilasl']=0;
     $datos['nmens']=null;  
     }else{
      $datos['listaC']=$this->listarConversaciones($lconver);
      
      $datos['nfilasl']=$this->numeroF($datos['listaC']);
      $datos['nmens']=$this->nmens($datos['listaC'],$datos['nfilasl']);
        usort($datos['listaC'],array($this, "date_sort"));    
    }
    $datos['listaN']=$this->notificacion->getAllNoti($personal->id_usuario);
      $datos['nnot']=$this->notificacion->getAllNotiN($personal->id_usuario);
      $datos['nnotn']=$this->notificacion->getAllNotiNu($personal->id_usuario);
        
    return $datos;
  }
  function date_sort($a,$b){
         return strcasecmp($a['time'],$b['time'])*-1;
  }
  function listarConversaciones($lcover){
          $lista[][]=null;
          $i=0;
                   foreach ($lcover->result() as $conv) {
                        if($conv->id_receptor==$this->session->userdata('id_usuario_sesion')){
                                  $lista[$i]['persona']=$this->personal->getAllIdUsuario($conv->id_emisor);
                                  $lista[$i]['titulo']=$lista[$i]['persona']->nombre_persona." ".$lista[$i]['persona']->apellido_persona;
                                  $lista[$i]['sms']=$this->mensaje->getByUltimoMensaje($conv->id_conversacion);
                         }else{
                                  $lista[$i]['persona']=$this->personal->getAllIdUsuario($conv->id_receptor);
                                  $lista[$i]['titulo']=$lista[$i]['persona']->nombre_persona." ".$lista[$i]['persona']->apellido_persona; 
                                  $lista[$i]['sms']=$this->mensaje->getByUltimoMensaje($conv->id_conversacion);         
                        }
                        $lista[$i]['conv']=$conv->id_conversacion;
                        $lista[$i]['time']=$lista[$i]['sms']->creado_en; 
                        $lista[$i]['nmen']=$this->mensaje->getNMensajesNoLeidos($conv->id_conversacion,$this->session->userdata('id_usuario_sesion'));
                        $lista[$i]['nmensr']=$this->mensaje->getNMensajesRes($conv->id_conversacion,$this->session->userdata('id_usuario_sesion'));
                        $lista[$i]['nmensa']=$this->mensaje->getNMensajes($conv->id_conversacion);
                        if($lista[$i]['sms']->leido_mensaje==0&&$lista[$i]['sms']->id_usuario!=$this->session->userdata('id_usuario_sesion')){
                          
                          $lista[$i]['style']="text-primary";
                        } else{
                          $lista[$i]['style']="text-dark";
                         
                        } 
                        if($lista[$i]['sms']->id_usuario!=$this->session->userdata('id_usuario_sesion')){
                         $lista[$i]['tu']="";
                        }else{
                        $lista[$i]['tu']="Tú: ";
                        }
                        $i=$i+1;                     
                   }
    return $lista;
   }
   function numeroF($arreglo){
    $cont=0;
    foreach ($arreglo as $elemento) {
      $cont++;
    }
    return $cont;
   }
   function nmens($arreglo,$nfilas){
    $n=0;
    for ($i=0; $i < $nfilas; $i++) { 
     $n=$n+$arreglo[$i]['nmen']->numero;
    }
    return $n;
   }
}
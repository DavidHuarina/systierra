<?php
/**
* @author davidhuarina25@gmail.com
* @class Usuarios
* @brief Modelo de base de datos para la tabla de usuarios
**/

class V_datos_usuario extends CI_Model{
	public static $tablename = "v_datos_usuario";
         
	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_usuario='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
    public function getByNombre($var){
    	$var=strtolower($var);
		$sql = "select * from ".self::$tablename." where lower(nombre_persona)||' '||lower(apellido_persona)='$var'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
    public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}
	public function getProyecto_ml(){
	
		return $this->db->query("select * from v_proyecto_ml");
	}
	public function getActividadFullDescargos(){
	
		return $this->db->query("select * from v_total_descargos order by act_id");
	}
	public function getActividadFullDetalle($id){
	
		return $this->db->query("select * from v_detalle_completo where id_df=$id");
	}
	public function getActividadFullDetalleDescargo(){
	
		return $this->db->query("select * from v_detalle_completo a,v_total_descargos b where a.id_df=b.id_df");
	}

	public function getActividadFullReporte(){
	
		return $this->db->query("select * from v_total_act_reporte");
	}
	public function getActividadFullReporteSin(){
	
		return $this->db->query("select * from v_total_act_reporte_sin_com");
	}
	public function getResAct(){
	
		return $this->db->query("select distinct * from v_resultados_act");
	}
	public function getResActF($id){
	
		return $this->db->query("select * from v_resultados_actividad where act_id=$id");
	}

	public function getResActByNProy($np){
		return $this->db->query("select * from v_resultados_proye where nombre_proyecto='$np'");
	}
	public function getPartiRepo($id){
	
		return $this->db->query("select * from v_parti_reporte where act_id=$id");
	}
	public function getAllN(){
	
		return $this->db->query('select count(*) as num from '.self::$tablename)->row();
	}
	/*public function getReporte($data){
		$query = $this->db->get_where('v_proyecto_ml', $data);
	   return $query;
	}*/
	public function getProy($id_p){
   	 	$where0="(";
   	 	for ($j=0; $j <count($id_p) ; $j++){ 
			if($j+1==count($id_p)){
				$where0.="id_proyecto = '".$id_p[$j]."')";
			}else{
				$where0.="id_proyecto = '".$id_p[$j]."' or ";
			}	
		}
		 if(count($id_p)==1){
		   $this->db->where("id_proyecto =", $id_p[0]);
		  }else{
		   $this->db->where($where0, NULL, FALSE);
	      }
       $query = $this->db->get('proyecto');
   		return $query;
     }
	public function getByIdMl($id_p,$tipos){
   	 	$where0="(";
   	 	for ($j=0; $j <count($id_p) ; $j++){ 
			if($j+1==count($id_p)){
				$where0.="id_proyecto = '".$id_p[$j]."')";
			}else{
				$where0.="id_proyecto = '".$id_p[$j]."' or ";
			}	
		}
		 if(count($id_p)==1){
		   $this->db->where("id_proyecto =", $id_p[0]);
		  }else{
		   $this->db->where($where0, NULL, FALSE);
	      }

        $where1="(";
   	 	//$this->db->where('id_act_ml =', $id);
   		for ($i=0; $i <count($tipos) ; $i++){ 
			   	   if($i+1==count($tipos)){
			   	   	$where1.="tipo_id =".$tipos[$i].")";
			   	   }else{
			   	   	$where1.="tipo_id =".$tipos[$i]." or ";
			   	   }
		}
		if($tipos!=null){
		  if(count($tipos)==1){
		   $this->db->where('tipo_id =', $tipos[0]);
		  }else{
		   $this->db->where($where1, NULL, FALSE);
	      }
		}else{
		$this->db->where('tipo_id =', 11111);/*el valor 11111 espara que no encuentre el tipact y no muestre todos los resultados como siempre*/	
		}
		$this->db->order_by('act_fecha','ASC');
       $query = $this->db->get('v_actividad_al_2');
   		return $query;
     }
     /*otra funcionnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn*/
     public function getByIdMlFechas($id_p,$tipos,$desde,$hasta){
     	$where0="(";
   	 	for ($j=0; $j <count($id_p) ; $j++){ 
			if($j+1==count($id_p)){
				$where0.="id_proyecto = '".$id_p[$j]."')";
			}else{
				$where0.="id_proyecto = '".$id_p[$j]."' or ";
			}	
		}
		 if(count($id_p)==1){
		   $this->db->where("id_proyecto =", $id_p[0]);
		  }else{
		   $this->db->where($where0, NULL, FALSE);
	      }

     $where1="(";
   		for ($i=0; $i <count($tipos) ; $i++){ 
			   	   if($i+1==count($tipos)){
			   	   	$where1.="tipo_id =".$tipos[$i].")";
			   	   }else{
			   	   	$where1.="tipo_id =".$tipos[$i]." or ";
			   	   }
		}
		if($tipos!=null){
		  if(count($tipos)==1){
		   $this->db->where('tipo_id =', $tipos[0]);
		  }else{
		   $this->db->where($where1, NULL, FALSE);
	      }
		}else{
		$this->db->where('tipo_id =', 11111);/*el valor 11111 espara que no encuentre el tipact y no muestre todos los resultados como siempre*/	
		}
		$this->db->where("act_fecha BETWEEN '".$desde."' AND '".$hasta."'", NULL, FALSE);
		$this->db->order_by('act_fecha','ASC');
       $query = $this->db->get('v_actividad_al_2');
   		return $query;
     }




    public function getReporte($id_p){
		for ($i=0; $i <count($id_p) ; $i++){ 
			if($i==0){
              $this->db->where('id_proyecto =', $id_p[$i]);
			}else{
              $this->db->or_where('id_proyecto =', $id_p[$i]);
			}	
		}
       $query = $this->db->get('v_proyecto_ml');
	   return $query;		  
	}
    
   

	public function getReportes($id_p,$id_o,$res,$ind,$ml){
		for ($i=0; $i <count($id_p) ; $i++) { 
			if($i==0){
              $this->db->where('id_proyecto =', $id_p[$i]);
			}else{
              $this->db->or_where('id_proyecto =', $id_p[$i]);
			}
			
		}
		for ($o=0; $o <count($id_o) ; $o++) { 
				if($o==0){
                   $this->db->where('id_obe =', $id_o[$o]);
			     }else{
                   $this->db->or_where('id_obe =', $id_o[$o]);
			     }
			}
		for ($rr=0; $rr <count($res) ; $rr++) { 
				if($rr==0){
                   $this->db->where('id_result =', $res[$rr]);
			     }else{
                   $this->db->or_where('id_result =', $res[$rr]);
			     }
			}	
		for ($ii=0; $ii <count($ind) ; $ii++) { 
				if($ii==0){
                   $this->db->where('id_ind =', $ind[$ii]);
			     }else{
                   $this->db->or_where('id_ind =', $ind[$ii]);
			     }
			}	
		for ($m=0; $m <count($ml) ; $m++) { 
				if($m==0){
                   $this->db->where('id_act_ml =', $ml[$m]);
			     }else{
                   $this->db->or_where('id_act_ml =', $ml[$m]);
			     }
			}					
        //$this->db->or_where('mail =', $mail);
        $query = $this->db->get('v_proyecto_ml');
	   return $query;
	}

}

?>
<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Res_act extends CI_Model{
	public static $tablename = "res_act";
         
	public function __construct(){
	
		$act_id=0;
		$id_result=0;
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_res_act,act_id,id_result) ";
		$sql .= "values (nextval('sq_res_act'),$this->act_id,$this->id_result)";
		return $query = array($this->db->query($sql),'');
	}
     public function deleteGroup($id){
		$sql = "delete from ".self::$tablename." where act_id=$id";
		$query = array($this->db->query($sql),'');
	}
	

	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
<?php
/**
* @author davidhuarina25@gmail.com
* @class rem
* @brief Modelo de base de datos para la tabla de rem
**/

class Rem extends CI_Model{
	public static $tablename = "reembolso";
         
	public function __construct(){
	
		$monto=0;
		$id_solicitante='';
		$justificacion='';
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_rem,monto,id_solicitante,justificacion) ";
		$sql .= "values (nextval('sq_reembolso'),$this->monto,'$this->id_solicitante','$this->justificacion')
		RETURNING id_rem";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_rem=$id";
		$query = array($this->db->query($sql),'');
	}
// partiendo de que ya tenemos creado un objecto rem previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',com_id='$this->com_id' where id_rem='$this->id'";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_rem=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
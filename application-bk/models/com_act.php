<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Com_act extends CI_Model{
	public static $tablename = "com_act";
         
	public function __construct(){
	
		$com_id=0;
		$act_id=0;
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_com_act,com_id,act_id) ";
		$sql .= "values (nextval('sq_com_act'),$this->com_id,$this->act_id)";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_com_act=$id";
		$query = array($this->db->query($sql),'');
	}
	public function deleteGroup($id){
		$sql = "delete from ".self::$tablename." where act_id=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_com_act='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto com_act previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',com_id='$this->com_id' where id_com_act='$this->id'";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_com_act='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
public function Existe($id,$id2){
		$sql = "select count(*) as num from ".self::$tablename." where com_id=$id and act_id=$id2";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getBycom_act($com_act){
		$sql = "select * from ".self::$tablename." where id_proyecto='$com_act'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByAct($ac){
		$sql = "select * from com_act cm,comunidad c,municipio m, provincia p, departamento d 
    where cm.com_id=c.com_id and c.mun_id=m.mun_id and m.pro_id=p.pro_id and p.dep_id=d.dep_id and cm.act_id=$ac";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getByAllIdProy($id){
		$sql = "select * from ".self::$tablename." c, comunidad cm, departamento d where c.com_id=cm.com_id and cm.dep_id=d.dep_id and c.id_proyecto='$id' order by cm.com_nom";
		$query = $this->db->query($sql);
		return $query;
	}
     
	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
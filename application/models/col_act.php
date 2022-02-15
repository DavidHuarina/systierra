<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Col_act extends CI_Model{
	public static $tablename = "col_act";
         
	public function __construct(){
	
		$id_persona=0;
		$act_id=0;
		$resp=0;
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (col_id,id_persona,act_id,resp) ";
		$sql .= "values (nextval('sq_col_act'),$this->id_persona,$this->act_id,$this->resp)";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where col_id=$id";
		$query = array($this->db->query($sql),'');
	}
	public function deleteGroup($id){
		$sql = "delete from ".self::$tablename." where act_id=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_col_act='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto col_act previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',com_id='$this->com_id' where id_col_act='$this->id'";
		$query = array($this->db->query($sql),'');
	}
    public function updateResp($id,$ac,$r){
		$sql = "update ".self::$tablename." set resp=$r where act_id=$ac and id_persona=$id";
		$query = array($this->db->query($sql),'');
	}
//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_col_act='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
public function Existe($id,$id2){
		$sql = "select count(*) as num from ".self::$tablename." where id_persona=$id and act_id=$id2";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getBycol_act($col_act){
		$sql = "select * from ".self::$tablename." where id_proyecto='$col_act'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByIdAct($id){
		$sql = "select * from ".self::$tablename." where act_id=$id";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getByIdActN($id){
		$sql = "select count(*) as num from ".self::$tablename." where act_id=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByAllIdProy($id){
		$sql = "select * from ".self::$tablename." c, comunidad cm, departamento d where c.com_id=cm.com_id and cm.dep_id=d.dep_id and c.id_proyecto='$id' order by cm.com_nom";
		$query = $this->db->query($sql);
		return $query;
	}
public function getAllAct($id){
		$sql = "select * from col_act cl,persona p where p.id_persona=cl.id_persona and cl.act_id=$id order by p.nombre_persona";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getAllActE($id){
		$sql = "select * from col_act cl,personal p where p.id_persona=cl.id_persona and cl.act_id=$id order by p.nombre_persona";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getAllEquipos(){
		$sql = "select p.id_usuario,p.nombre_persona,p.apellido_persona, cl.act_id from col_act cl,personal p,usuario u 
where p.id_persona=cl.id_persona and p.id_usuario=u.id_usuario order by cl.act_id";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getAllActRN($id){
		$sql = "select * from col_act cl,personal p,usuario u 
where p.id_persona=cl.id_persona and p.id_usuario=u.id_usuario and cl.act_id=$id and cl.resp=0 order by p.nombre_persona";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getAllActRNI($id){
		$sql = "select * from col_act cl,persona p
where p.id_persona=cl.id_persona and cl.act_id=$id and cl.resp=2 order by p.nombre_persona";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getAllActR($id){
		$sql = "select * from col_act cl,personal p,usuario u
where p.id_persona=cl.id_persona and p.id_usuario=u.id_usuario and cl.act_id=$id and cl.resp=1 order by p.nombre_persona";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getAllActPer($id,$per){
		$sql = "select * from col_act cl,persona p where p.id_persona=cl.id_persona and cl.act_id=$id and cl.id_persona=$per";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAllByIdActPer($id){
		$sql = "select * from col_act cl,persona p where p.id_persona=cl.id_persona and cl.act_id=$id";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
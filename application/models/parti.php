<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Parti extends CI_Model{
	public static $tablename = "participante";
         
	public function __construct(){
	
		$act_id=0;
		$total=0;
		$descripcion='';
		$cant_h=0;
		$cant_m=0;
		$id_tipopar=0;
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_participante,total,descripcion,cant_h,cant_m,id_tipopar,act_id) ";
		$sql .= "values (nextval('sq_participante'),$this->total,'',$this->cant_h,$this->cant_m,$this->id_tipopar,$this->act_id)";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_participante='$id'";
		$query = array($this->db->query($sql),'');
	}
	public function deleteGroup($id){
		$sql = "delete from ".self::$tablename." where act_id=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_participante='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto participante previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',com_id='$this->com_id' where id_participante='$this->id'";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_participante='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
public function existe($sol,$ac){
		$sql = "select count(*) as num from ".self::$tablename." where act_id=$ac and id_tipopar=$sol";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByparticipante($participante){
		$sql = "select * from ".self::$tablename." where id_proyecto='$participante'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAllTipo(){
		$sql = "select * from tipopar";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getTipo($id){
		$sql = "select * from tipopar where id_tipopar=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByIdA($id){
		$sql = "select * from ".self::$tablename." where act_id=$id limit 1";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAllByIdA($id){
		$sql = "select * from participante p, tipopar t where p.id_tipopar=t.id_tipopar and p.act_id=$id order by p.id_tipopar";
		$query = $this->db->query($sql);
		return $query;
	}
    public function getByIdActN($ac){
		$sql = "select count(*) as num from participante where act_id=$ac";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
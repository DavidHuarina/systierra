<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Solm extends CI_Model{
	public static $tablename = "sol_montos";
         
	public function __construct(){
	
		$monto=0;
		$id_ep=0;
		$estado=0;
		$fecha=null;
		$id_sol=0;
		$descripcion="";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_solm,monto,id_ep,estado,fecha,id_sol,descripcion) ";
		$sql .= "values (nextval('sq_sol_montos'),$this->monto,$this->id_ep,1,now(),$this->id_sol,'$this->descripcion')
		RETURNING id_solm";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_solm=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_solm='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto solm previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',com_id='$this->com_id' where id_solm='$this->id'";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_solm=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
public function existe($id){
		$sql = "select count(*) as num from ".self::$tablename." where id_ep=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function existe2($id,$sol){
		$sql = "select count(*) as num from ".self::$tablename." where id_ep=$id and id_sol=$sol";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getBysolm($solm){
		$sql = "select * from ".self::$tablename." where id_proyecto='$solm'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByIdSol($so){
		$sql = "select * from ".self::$tablename." where id_sol=$so";
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
<?php 
/**
 * 
 */
class Tipoact extends CI_Model
{
	public static $tablename = "tipoact";
	function __construct()
	{
		 parent::__construct();
		 $tipo_nom="";
		
	}

	public function add()
	{
		$sql="insert into ".self::$tablename." VALUES(nextval('sq_tipoact'), '$this->tipo_nom',1,1)";
		return $query = array($this->db->query($sql)); 
	}

	public function update($id_tipoact){
		$sql = "update".self::$tablename." set descripcion='$this->descripcion' WHERE id_tipoact=$this->id_tipoact";
		$query = array($this->db->query($sql),'');
	}

	public function delete($id_tipoact){
		$sql = "delete".self::$tablename." from where id_tipoact=$id_tipoact";
		$query = array($this->db->query($sql),'');
	}

	public function getById($id)
	{
		$sql = "select * from ".self::$tablename." where tipo_id=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByNombre($descripcion)
	{
		$sql = "select * from ".self::$tablename." where tipo_nom='$descripcion'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename."");
	}
}
 ?>
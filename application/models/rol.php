<?php 
/**
 * 
 */
class Rol extends CI_Model
{
	public static $tablename = "rol";
	function __construct()
	{
		 parent::__construct();
		 $descripcion ='';
	}

	public function add()
	{
		$sql="insert into".self::$tablename." VALUES(nextval('sq_rol'), 'descripcion')";
		$query = $this->db->query($sql);
		return $query = array($this->db->query($sql)); 
	}

	public function update($id_rol){
		$sql = "update".self::$tablename." set descripcion='$this->descripcion' WHERE id_rol=$this->id_rol";
		$query = array($this->db->query($sql),'');
	}

	public function delete($id_rol){
		$sql = "delete".self::$tablename." from where id_rol=$id_rol";
		$query = array($this->db->query($sql),'');
	}

	public function getById($id_rol)
	{
		$sql = "select * from ".self::$tablename." where id_rol=$id_rol";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByNombreOficina($descripcion)
	{
		$sql = "select * from ".self::$tablename." where descripcion='$descripcion'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename.' order by descripcion');
	}
}
 ?>
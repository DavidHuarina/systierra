<?php 
/**
 * 
 */
class Regional extends CI_Model
{
	public static $tablename = "regional";
	function __construct()
	{
		 parent::__construct();
		 $nombre_regional ='';
		 $direccion='';
		 $mun_id=0;
	}

	public function add()
	{
		$sql="insert into".self::$tablename." VALUES(nextval('sq_regional'), 'nombre_regional')";
		$query = $this->db->query($sql);
		return $query = array($this->db->query($sql)); 
	}

	public function update($id_regional){
		$sql = "update".self::$tablename." set nombre_regional='$this->nombre_regional' WHERE id_regional=$this->id_regional";
		$query = array($this->db->query($sql),'');
	}

	public function delete($id_regional){
		$sql = "delete".self::$tablename." from where id_regional=$id_regional";
		$query = array($this->db->query($sql),'');
	}

	public function getById($id_regional)
	{
		$sql = "select * from ".self::$tablename." where id_regional=$id_regional";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByNombreOficina($nombre_regional)
	{
		$sql = "select * from ".self::$tablename." where nombre_regional='$nombre_regional'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAll(){
		return $this->db->query('select * from '.self::$tablename.' order by nombre_regional');
	}
}
 ?>
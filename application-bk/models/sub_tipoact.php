<?php 
/**
 * 
 */
class Sub_tipoact extends CI_Model
{
	public static $tablename = "sub_tipoact";
	function __construct()
	{
		 parent::__construct();
		 $sub_nom="";
		 $tipo_id=0;
		
	}

	public function add()
	{
		$sql="insert into ".self::$tablename." VALUES(nextval('sq_sub_tipoact'),'$this->sub_nom',$this->tipo_id,1,1)";
		return $query = array($this->db->query($sql)); 
	}

	public function update($id_sub_tipoact){
		$sql = "update".self::$tablename." set descripcion='$this->descripcion' WHERE id_sub_tipoact=$this->id_sub_tipoact";
		$query = array($this->db->query($sql),'');
	}

	public function delete($id_sub_tipoact){
		$sql = "delete".self::$tablename." from where id_sub_tipoact=$id_sub_tipoact";
		$query = array($this->db->query($sql),'');
	}

	public function getById($id)
	{
		$sql = "select * from ".self::$tablename." where sub_id=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAllByIdTipo($id)
	{
		$sql = "select * from ".self::$tablename." where tipo_id=$id";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getByNombre($descripcion)
	{
		$sql = "select * from ".self::$tablename." where sub_nom='$descripcion'";
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
	
		return $this->db->query('select * from '.self::$tablename." order by sub_nom");
	}
}
 ?>
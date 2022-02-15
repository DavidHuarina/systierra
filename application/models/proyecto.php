<?php 
/**
 * 
 */
class Proyecto extends CI_Model
{
	public static $tablename = "proyecto";
	function __construct()
	{
		 parent::__construct();
		 $nombre_proyecto="";
         $fecha_inicio=NULL;
         $fecha_fin=NULL;
         $obj_gen="";
         $resumen="";
         $id_estado=0;
         $f_registro=null;
         $id_responsable="";
         $presupuesto=1;
	}

	public function add()
	{
		$sql="insert into ".self::$tablename." VALUES('0'||nextval('sq_proyecto')||':'||'PROY-'||DATE_PART('YEAR',NOW()), '$this->nombre_proyecto','$this->fecha_inicio','$this->fecha_fin','$this->obj_gen','','$this->resumen',now(),'$this->id_responsable',$this->id_estado,$this->presupuesto)
		 RETURNING id_proyecto";
		return $this->db->query($sql)->row();
	}

	public function update($id_proyecto){
		$sql = "update".self::$tablename." set descripcion='$this->nombre_proyecto' WHERE id_proyecto=$this->id_proyecto";
		$query = array($this->db->query($sql),'');
	}
	public function updateProy($data,$id){
		$this->db->where('id_proyecto', $id);
        $this->db->update(self::$tablename,$data);
	}
    
    public function updatePresupuesto($id){
		$sql = "update ".self::$tablename." set presupuesto=2 WHERE id_proyecto='$id'";
		$query = array($this->db->query($sql),'');
	}
	public function delete($id_proyecto){
		$sql = "delete from ".self::$tablename."  where id_proyecto='$id_proyecto'";
		$query = array($this->db->query($sql),'');
	}

	public function getById($id_proyecto)
	{
		$sql = "select * from ".self::$tablename." where id_proyecto='$id_proyecto'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByNombre($nombre)
	{
		$sql = "select * from ".self::$tablename." where nombre_proyecto='$nombre'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByNombreOficina($descripcion)
	{
		$sql = "select * from ".self::$tablename." where descripcion='$descripcion'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAll($id){
	
		return $this->db->query("select * from ".self::$tablename. " where id_responsable='$id' order by f_registro desc");
	}
	public function getAlls(){
	
		return $this->db->query("select * from ".self::$tablename. " order by f_registro desc");
	}
	public function getAllsDis(){
	
		return $this->db->query("select * from ".self::$tablename. " where presupuesto!=1 order by f_registro desc");
	}
	public function getNproy($id){
	
		return $this->db->query("select count(*) as num from ".self::$tablename. " where id_responsable='$id'")->row();
	}
	public function getNproyS(){
	
		return $this->db->query("select count(*) as num from ".self::$tablename)->row();
	}
	public function getAllN($id){
	
		return $this->db->query("select * from ".self::$tablename. " where id_estado=1 order by f_registro desc");
	}
}
 ?>
<?php 
/**
 * 
 */
class Organizacion extends CI_Model
{
	public static $tablename = "organizacion";
	function __construct()
	{
		 parent::__construct();
		 $nombre_org='';
         $descripcion_o ='';
         $id_tipo_org =0;
         $estado=0;
	}

	public function add()
	{
		$sql="insert into ".self::$tablename." (id_org,nombre_org,descripcion_o,id_tipo_org,estado) 
		values(nextval('sq_organizacion'),'$this->nombre_org','$this->descripcion_o',$this->id_tipo_org,1)";
		$query = $this->db->query($sql);
	}

	public function update($id,$nom,$des){
		$data = array(
          'nombre_org' => $nom,
          'descripcion_o' => $des
          );
		$this->db->where('id_org', $id);
        $this->db->update(self::$tablename,$data);
	}

	public function delete($id_organizacion){
		$sql = "delete from ".self::$tablename." where id_org=$id_organizacion";
		$query = array($this->db->query($sql),'');
	}
   public function getAllTO(){
	
		return $this->db->query("select * from tipo_org order by descripcion");
	}
	public function getAll($id){
	
		return $this->db->query("select * from ".self::$tablename." where dep_id=$id order by com_nom ");
	}
	public function getAllProv($id){
	
		return $this->db->query("select * from provincia where dep_id=$id order by pro_des ");
	}
	public function getAllMun($id){
	
		return $this->db->query("select * from municipio where pro_id=$id order by mun_des ");
	}
	public function getAllO(){
	
		return $this->db->query("select * from ".self::$tablename." c,tipo_org d where c.id_tipo_org=d.id_tipo_org order by c.nombre_org ");
	}
	public function getAllOP($id){
	
		return $this->db->query("select c.id_org, c.nombre_org, d.descripcion from ".self::$tablename." c,tipo_org d where c.id_tipo_org=d.id_tipo_org EXCEPT
			 select co.id_org, co.nombre_org, de.descripcion from ".self::$tablename." co,tipo_org de, org_proy op where co.id_tipo_org=de.id_tipo_org and op.id_proyecto='$id' and op.id_org=co.id_org order by nombre_org");
	}
	public function getAllON(){
	
		return $this->db->query("select count(*) as num from ".self::$tablename)->row();
	}
}
 ?>
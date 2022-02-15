
<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Org_proy extends CI_Model{
	public static $tablename = "org_proy";
         
	public function __construct(){
	
		$id_proyecto='';
		$id_org=0;
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_org_proy,id_proyecto,id_org) ";
		$sql .= "values (nextval('sq_org_proy'),'$this->id_proyecto',$this->id_org)";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id,$idp){
		$sql = "delete from ".self::$tablename." where id_org=$id and id_proyecto='$idp'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto org_proy previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',com_id='$this->com_id' where id_org_proy='$this->id'";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_org_proy='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getByorg_proy($org_proy){
		$sql = "select * from ".self::$tablename." where id_proyecto='$org_proy'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getNByAllIdProy($id){
		$sql = "select count(*) as num from ".self::$tablename." where id_proyecto='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getNByIdOrg($ido){
		$sql = "select count(*) as num from ".self::$tablename." where id_org=$ido";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByAllIdProy($id){
		$sql = "select * from ".self::$tablename." o, organizacion org, tipo_org t where o.id_org=org.id_org and org.id_tipo_org=t.id_tipo_org and o.id_proyecto='$id' order by org.nombre_org";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getAllByIdOrg($id){
		$sql = "select * from org_proy cp,proyecto p where cp.id_proyecto=p.id_proyecto and cp.id_org=$id";
		$query = $this->db->query($sql);
		return $query;
	}

	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
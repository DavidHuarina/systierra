
<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Com_proy extends CI_Model{
	public static $tablename = "com_proy";
         
	public function __construct(){
	
		$id_proyecto='';
		$com_id=0;
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_com_proy,id_proyecto,com_id) ";
		$sql .= "values (nextval('sq_com_proy'),'$this->id_proyecto',$this->com_id)";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id,$idp){
		$sql = "delete from ".self::$tablename." where com_id=$id and id_proyecto='$idp'";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_com_proy='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto com_proy previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',com_id='$this->com_id' where id_com_proy='$this->id'";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_com_proy='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getBycom_proy($com_proy){
		$sql = "select * from ".self::$tablename." where id_proyecto='$com_proy'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getNByIdCom($com){
		$sql = "select count(*) as num from ".self::$tablename." where com_id=$com";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getNByAllIdProy($id){
		$sql = "select count(*) as num from ".self::$tablename." where id_proyecto='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAllByIdCom($id){
		$sql = "select * from com_proy cp,proyecto p where cp.id_proyecto=p.id_proyecto and cp.com_id=$id";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getByAllIdProy($id){
		$sql = "select * from ".self::$tablename." c, comunidad cm where c.com_id=cm.com_id and c.id_proyecto='$id' order by cm.com_nom";
		$query = $this->db->query($sql);
		return $query;
	}

	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
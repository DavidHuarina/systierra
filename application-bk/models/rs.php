
<?php
/**
* @author davidhuarina25@gmail.com
* @class rs
* @brief Modelo de base de datos para la tabla de rs
**/

class Rs extends CI_Model{
	public static $tablename = "razon_social";
         
	public function __construct(){	
		$descripcion='';
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_rs,descripcion) ";
		$sql .= "values (nextval('sq_razon_social'),'$this->descripcion') RETURNING id_rs";
		return $this->db->query($sql)->row();
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_rs='$id'";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_rs='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto rs previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set descripcion='$this->descripcion'='$this->id_subr' where id_rs='$this->id'";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_rs='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getByNombre($rs){
		$sql = "select * from ".self::$tablename." where descripcion='$rs'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	

	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>

<?php
/**
* @author davidhuarina25@gmail.com
* @class detalle
* @brief Modelo de base de datos para la tabla de detalle
**/

class Detalle extends CI_Model{
	public static $tablename = "detalle";
         
	public function __construct(){
	
		$nombre_detalle='';
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_detalle,nombre_detalle) ";
		$sql .= "values (nextval('sq_detalle'),'$this->nombre_detalle') RETURNING id_detalle";
		return $this->db->query($sql)->row();
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_detalle='$id'";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_detalle='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto detalle previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set nombre_detalle='$this->nombre_detalle',id_subr='$this->id_subr' where id_detalle='$this->id'";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_detalle='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getByNombre($detalle){
		$sql = "select * from ".self::$tablename." where nombre_detalle='$detalle'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	

	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
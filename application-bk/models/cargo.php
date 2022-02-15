
<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Cargo extends CI_Model{
	public static $tablename = "cargo";
         
	public function __construct(){
	
		$nombre_cargo='';
		$salario=0;
	}

      /*function getFullname(){ 
		return $this->cargo." ".$this->contrasena; 
	}  */

	public function add(){
		$sql = "insert into ".self::$tablename." (id_cargo,nombre_cargo,salario) ";
		$sql .= "values (nextval('sq_cargo'),'$this->nombre_cargo',$this->salario)";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_cargo='$id'";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_cargo='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto cargo previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set nombre_cargo='$this->nombre_cargo',salario='$this->salario' where id_cargo='$this->id'";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_cargo='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getByCargo($cargo){
		$sql = "select * from ".self::$tablename." where nombre_cargo='$cargo'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	

	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
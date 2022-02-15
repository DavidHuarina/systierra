
<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Rubro extends CI_Model{
	public static $tablename = "rubro";
         
	public function __construct(){
	
		$descripcion='';
		$codigo='';
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_rubro,descripcion,codigo) ";
		$sql .= "values (nextval('sq_rubro'),'$this->descripcion','$this->codigo')";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_rubro='$id'";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_rubro='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto rubro previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',descripcion='$this->descripcion' where id_rubro='$this->id'";
		$query = array($this->db->query($sql),'');
	}
    
    public function updateCodigo($id,$cod){
		$sql = "update ".self::$tablename." set codigo='$cod' where id_rubro=$id";
		$query = array($this->db->query($sql),'');
	}
//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_rubro=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getByNombre($rubro){
		$sql = "select * from ".self::$tablename." where descripcion='$rubro'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	
	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Formulario extends CI_Model{
	public static $tablename = "formulario";
         
	public function __construct(){

		$id_receptor='';
		$id_solicitante='';
		$descripcion='';
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_form,id_receptor,id_solicitante,descripcion) ";
		$sql .= "values (nextval('sq_formulario'),'$this->id_receptor','$this->id_solicitante','$this->descripcion')
		RETURNING id_form";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_form='$id'";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_form='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto form previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',com_id='$this->com_id' where id_form='$this->id'";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_form='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
    public function existe($id,$id2){
		$sql = "select count(*) as num from ".self::$tablename." where id_receptor='$id' and id_solicitante='$id2'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByIds($id,$id2){
		$sql = "select * from ".self::$tablename." where id_receptor='$id' and id_solicitante='$id2'";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
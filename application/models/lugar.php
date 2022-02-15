<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Lugar extends CI_Model{
	public static $tablename = "lugar";
         
	public function __construct(){
	
		$direccion="";
		$mun_id=0;
		$pais="";
		$ciudad="";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_lugar,direccion,mun_id,pais,ciudad) ";
		$sql .= "values (nextval('sq_lugar'),'$this->direccion',$this->mun_id,'$this->pais','$this->ciudad') RETURNING id_lugar";
		return $this->db->query($sql)->row();
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_lugar='$id'";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_lugar='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto lugar previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',com_id='$this->com_id' where id_lugar='$this->id'";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_lugar='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
public function Existe($id,$id2){
		$sql = "select count(*) as num from ".self::$tablename." where id_usuario='$id' and direccion=$id2";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getBylugar($lugar){
		$sql = "select * from ".self::$tablename." where id_proyecto='$lugar'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByAllAct($ac){
		$sql = "select * from actividad a, lugar l, municipio m, provincia p, departamento d 
where a.id_lugar=l.id_lugar and l.mun_id=m.mun_id and m.pro_id=p.pro_id and p.dep_id=d.dep_id and a.act_id=$ac";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByDireccionN($dir,$mun){
		$sql = "select count(*) as num from ".self::$tablename." where mun_id=$mun and direccion='$dir'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
   public function getByDireccionM($dir,$mun){
		$sql = "select * from ".self::$tablename." where mun_id=$mun and direccion='$dir'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
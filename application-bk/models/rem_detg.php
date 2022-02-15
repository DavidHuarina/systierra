<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Rem_detg extends CI_Model{
	public static $tablename = "rem_detg";
         
	public function __construct(){
	
		$id_rem=0;
		$id_df=0;
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_rd,id_rem,id_df) ";
		$sql .= "values (nextval('sq_rem_detg'),$this->id_rem,$this->id_df)";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_rd=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_rem_detg='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto rem_detg previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',com_id='$this->com_id' where id_rem_detg='$this->id'";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_rem_detg='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
public function existe($id){
		$sql = "select count(*) as num from ".self::$tablename." where id_df=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByrem_detg($rem_detg){
		$sql = "select * from ".self::$tablename." where id_proyecto='$rem_detg'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getBySol($sol){
		$sql = "select * from ".self::$tablename." where id_df=$sol";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByIdA($id){
		$sql = "select * from ".self::$tablename." where id_rem=$id limit 1";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByDF($id){
		$sql = "select * from ".self::$tablename." where id_df=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAllByIdA($id){
		$sql = "select sm.id_dfm, sa.id_rem_detg, r.descripcion as descripcionr, sm.monto, s.descripcion 
from rem_detg sa, sol_montos sm,solicitud so, ep e,sub_rubro s,rubro r 
where sa.id_df=so.id_df and so.id_df=sm.id_df and sm.id_ep=e.id_ep and e.id_subr=s.id_subr and s.id_rubro=r.id_rubro and sa.id_rem=$id";
		$query = $this->db->query($sql);
		return $query;
	}

	public function getAllByIdDF($id){
		$sql = "select * from rem_detg r, reembolso rem where rem.id_rem=r.id_rem and id_df=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Detalle_gastos extends CI_Model{
	public static $tablename = "detalle_gastos";
         
	public function __construct(){
	    
	    $n_fac_reci='';
	    $fecha=null;
		$monto=0;
		$id_df=0;
		$id_detalle=0;
		$id_rs=0;
		$estado=0;		
		$id_solm=0;
		$monto_impuesto=0;
		$impuesto_bien=0;
		$impuesto_serv=0;
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_det,n_fac_reci,fecha,monto,id_df,id_detalle,id_rs,estado,id_solm,monto_impuesto,impuesto_bien,impuesto_serv) ";
		$sql .= "values (nextval('sq_detalle_gastos'),'$this->n_fac_reci','$this->fecha',$this->monto,$this->id_df,$this->id_detalle,$this->id_rs,1,$this->id_solm,$this->monto_impuesto,$this->impuesto_bien,$this->impuesto_serv)
		RETURNING id_det";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_det=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_detalle_gastos='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto detalle_gastos previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',com_id='$this->com_id' where id_detalle_gastos='$this->id'";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_detalle_gastos=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
public function existe($id){
		$sql = "select count(*) as num from ".self::$tablename." where id_df=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getBydetalle_gastos($detalle_gastos){
		$sql = "select * from ".self::$tablename." where id_proyecto='$detalle_gastos'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByIdSol($so){
		$sql = "select * from ".self::$tablename." where id_solm=$so";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getAllByIdDF($id){
		$sql = "select * from ".self::$tablename." d, detalle dt, razon_social rs 
where d.id_detalle=dt.id_detalle and d.id_rs=rs.id_rs and id_df=$id";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getAllByIdDFSuma($id){
		$sql = " select sum(monto_impuesto) as monto, id_solm from detalle_gastos  where id_df=$id group by id_solm";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getAllByIdDF1($id){
		$sql = "select * from ".self::$tablename." d, detalle dt, razon_social rs 
where d.id_detalle=dt.id_detalle and d.id_rs=rs.id_rs and id_df=$id limit 1";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAllByIdDFUl($id){
		$sql = "select * from ".self::$tablename." d, detalle dt, razon_social rs 
where d.id_detalle=dt.id_detalle and d.id_rs=rs.id_rs and id_df=$id order by id_det desc limit 1";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
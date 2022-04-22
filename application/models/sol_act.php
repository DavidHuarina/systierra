<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Sol_act extends CI_Model{
	public static $tablename = "sol_act";
         
	public function __construct(){
	
		$act_id=0;
		$id_sol=0;
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_sol_act,act_id,id_sol) ";
		$sql .= "values (nextval('sq_sol_act'),$this->act_id,$this->id_sol)";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_sol_act=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_sol_act='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto sol_act previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',com_id='$this->com_id' where id_sol_act='$this->id'";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_sol_act=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByIdSol($id){
		$sql = "select * from ".self::$tablename." where id_sol=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
public function existe($sol,$ac){
		$sql = "select count(*) as num from ".self::$tablename." where act_id=$ac and id_sol=$sol";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getBysol_act($sol_act){
		$sql = "select * from ".self::$tablename." where id_proyecto='$sol_act'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getBySol($sol){
		$sql = "select * from ".self::$tablename." where id_sol=$sol";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByIdA($id){
		$sql = "select * from ".self::$tablename." where act_id=$id limit 1";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAllByIdA($id){
		$sql = "select sm.id_solm,sm.descripcion as descripcionobs,e.id_ep, sa.id_sol_act, r.descripcion as descripcionr, sm.monto, s.descripcion as descrip,so.*,f.*,p.*,u.*,sm.id_via_item
from sol_act sa, sol_montos sm,solicitud so, ep e,sub_rubro s,rubro r,formulario f,personal p ,usuario u 
where sa.id_sol=so.id_sol and so.id_sol=sm.id_sol and sm.id_ep=e.id_ep and e.id_subr=s.id_subr and s.id_rubro=r.id_rubro 
and f.id_form=so.id_form and f.id_solicitante=p.id_usuario and u.id_usuario=p.id_usuario and sa.act_id=$id and e.estado_ep!=0 order by r.descripcion";
		$query = $this->db->query($sql);
		return $query;
	}

	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
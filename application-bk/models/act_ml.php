
<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Act_ml extends CI_Model{
	public static $tablename = "act_ml";
         
	public function __construct(){
	
		$id_ind=0;
		$descripcion='';
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_act_ml,id_ind,descripcion) ";
		$sql .= "values (nextval('sq_act_ml'),$this->id_ind,'$this->descripcion')";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_act_ml=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_ind='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto act_ml previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_ind='$this->id_ind',descripcion='$this->descripcion' where id_ind='$this->id'";
		$query = array($this->db->query($sql),'');
	}
	public function updateAct($cod,$res){
    	$data = array(
          'descripcion' => $res
          );
		$this->db->where('id_act_ml', $cod);
        $this->db->update(self::$tablename,$data);
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_act_ml=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
    public function getByIdInd($id){
		$sql = "select * from ".self::$tablename." where id_ind=$id order by id_act_ml";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getByIdProy($id){
		$sql = "select ml.id_act_ml,ml.descripcion as ml_des, i.descripcion as i_des, r.descripcion as r_des, o.descripcion as o_des, p.nombre_proyecto 
from ".self::$tablename." ml, indicador i, resultados r, obe o, proyecto p
where ml.id_ind=i.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and p.id_proyecto='$id'";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getByIdIndN($id){
		$sql = "select count(*) as num from ".self::$tablename." where id_ind=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getByact_ml($act_ml){
		$sql = "select * from ".self::$tablename." where id_ind='$act_ml'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	

	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
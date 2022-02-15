
<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Resumen extends CI_Model{
	public static $tablename = "resumen";
         
	public function __construct(){
	
		$objetivos='';
		$descripcion='';
		$logros='';
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_res,objetivos,descripcion,logros) ";
		$sql .= "values (nextval('sq_resumen'),'$this->objetivos','$this->descripcion','$this->logros') RETURNING id_res";
		return $this->db->query($sql)->row();
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_res=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_resumen='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto resumen previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set objetivos='$this->objetivos',descripcion='$this->descripcion' where id_resumen='$this->id'";
		$query = array($this->db->query($sql),'');
	}
	public function updateRes($cod,$obs,$des,$log){
    	$data = array(
    	  'objetivos' => $obs,
          'descripcion' => $des,
          'logros' => $log
          );
		$this->db->where('id_res', $cod);
        $this->db->update(self::$tablename,$data);
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_resumen='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
    public function getByIdObe($id){
		$sql = "select * from ".self::$tablename." where objetivos=$id order by id_res";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getNresumen($id){
		$sql = "select count(*) as num from ".self::$tablename." where objetivos=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
public function getByAct($id){
		$sql = "select * from actividad a, resumen r where a.id_res=r.id_res and a.act_id=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByresumen($resumen){
		$sql = "select * from ".self::$tablename." where objetivos='$resumen'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	

	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
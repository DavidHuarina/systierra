
<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Indicador extends CI_Model{
	public static $tablename = "indicador";
         
	public function __construct(){
	
		$id_result=0;
		$descripcion='';
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_ind,id_result,descripcion) ";
		$sql .= "values (nextval('sq_indicador'),$this->id_result,'$this->descripcion')";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_ind=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_ind='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto indicador previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_result='$this->id_result',descripcion='$this->descripcion' where id_ind='$this->id'";
		$query = array($this->db->query($sql),'');
	}
	public function updateInd($cod,$res){
    	$data = array(
          'descripcion' => $res
          );
		$this->db->where('id_ind', $cod);
        $this->db->update(self::$tablename,$data);
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_ind=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
    public function getByIdResult($id){
		$sql = "select * from ".self::$tablename." where id_result=$id order by id_ind";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getByIdResultN($id){
		$sql = "select count(*) as num from ".self::$tablename." where id_result=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getByindicador($indicador){
		$sql = "select * from ".self::$tablename." where id_result='$indicador'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	

	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
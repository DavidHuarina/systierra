
<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Resultados extends CI_Model{
	public static $tablename = "resultados";
         
	public function __construct(){
	
		$id_obe=0;
		$descripcion='';
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_result,id_obe,descripcion) ";
		$sql .= "values (nextval('sq_resultados'),$this->id_obe,'$this->descripcion')";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_result=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_resultados='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto resultados previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_obe='$this->id_obe',descripcion='$this->descripcion' where id_resultados='$this->id'";
		$query = array($this->db->query($sql),'');
	}
	public function updateRes($cod,$res){
    	$data = array(
          'descripcion' => $res
          );
		$this->db->where('id_result', $cod);
        $this->db->update(self::$tablename,$data);
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_result=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
    public function getByIdObe($id){
		$sql = "select * from ".self::$tablename." where id_obe=$id order by id_result";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getNresultados($id){
		$sql = "select count(*) as num from ".self::$tablename." where id_obe=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	 public function getByIdProy($id){
		$sql = "select r.descripcion,r.id_result from resultados r,obe o,proyecto p
where r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and p.id_proyecto='$id' order by id_result";
		$query = $this->db->query($sql);
		return $query;
	}

	public function getByresultados($resultados){
		$sql = "select * from ".self::$tablename." where id_obe='$resultados'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	

	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
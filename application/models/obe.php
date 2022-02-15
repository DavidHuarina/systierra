
<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Obe extends CI_Model{
	public static $tablename = "obe";
         
	public function __construct(){
	
		$id_proyecto='';
		$descripcion='';
		$indicador='';
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_obe,id_proyecto,descripcion,indicador) ";
		$sql .= "values (nextval('sq_obe'),'$this->id_proyecto','$this->descripcion','$this->indicador')";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_obe=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_obe='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto obe previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',descripcion='$this->descripcion' where id_obe='$this->id'";
		$query = array($this->db->query($sql),'');
	}
    public function updateObe($cod,$obe,$ind){
    	$data = array(
          'descripcion' => $obe,
          'indicador' => $ind
          );
		$this->db->where('id_obe', $cod);
        $this->db->update(self::$tablename,$data);
	}
//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_obe='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
    public function getByIdProy($id){
		$sql = "select * from ".self::$tablename." where id_proyecto='$id' order by id_obe";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getNObe($id){
		$sql = "select count(*) as num from ".self::$tablename." where id_proyecto='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getByobe($obe){
		$sql = "select * from ".self::$tablename." where id_proyecto='$obe'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	

	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
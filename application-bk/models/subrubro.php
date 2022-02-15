
<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Subrubro extends CI_Model{
	public static $tablename = "sub_rubro";
         
	public function __construct(){
	
		$descripcion='';
		$codigo='';
		$id_rubro=0;
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_subr,descripcion,id_rubro,codigo) ";
		$sql .= "values (nextval('sq_sub_rubro'),'$this->descripcion',$this->id_rubro,'$this->codigo')";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_subrubro='$id'";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_subrubro='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto subrubro previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',descripcion='$this->descripcion' where id_subrubro='$this->id'";
		$query = array($this->db->query($sql),'');
	}
	public function updateCodigo($id,$cod){
		$sql = "update ".self::$tablename." set codigo='$cod' where id_subr=$id";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_subrubro='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getByNombre($subrubro){
		$sql = "select * from ".self::$tablename." where descripcion='$subrubro'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	
	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}
	public function getAllByIdProy($id){
	
		return $this->db->query("select s.descripcion from ep e,proy_ep pe, sub_rubro s,rubro r
where e.id_proy_ep=pe.id_proy_ep and e.id_subr=s.id_subr and s.id_rubro=r.id_rubro and pe.id_proyecto='$id'");
	}

}

?>
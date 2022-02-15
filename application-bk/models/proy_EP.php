
<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Proy_EP extends CI_Model{
	public static $tablename = "proy_EP";
         
	public function __construct(){
	    $original=0;
	    $id_proyecto='';
	    $descripcion='';
	    $anio=0;
	    $fondo='';
	    $entidad='';
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_proy_ep,id_proyecto,descripcion,fondo)";
		$sql .= "values (nextval('sq_proy_ep'),'$this->id_proyecto','$this->descripcion','$this->fondo')";
		return $query = array($this->db->query($sql),'');
	}
	public function addF(){
		$sql = "insert into ".self::$tablename." (id_proy_ep,id_proyecto,descripcion,fondo)";
		$sql .= "values (nextval('sq_proy_ep'),'$this->id_proyecto','0'||nextval('sq_fondo')||':F-ID','$this->fondo')";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_proy_EP='$id'";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_proy_EP='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto proy_EP previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',descripcion='$this->descripcion' where id_proy_EP='$this->id'";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_proy_EP='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
    public function getByIdProyecto($id){
		$sql = "select * from ".self::$tablename." where id_proyecto='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByNombre($proy_EP){
		$sql = "select * from ".self::$tablename." where descripcion='$proy_EP'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	
	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
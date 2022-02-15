
<?php
/**
* @author davidhuarina25@gmail.com
* @class personal
* @brief Modelo de base de datos para la tabla de personal
**/

class Persona extends CI_Model{
	public static $tablename = "persona";
         
	function __construct()
	{
		parent::__construct();
      $numero_ci="000000-LP";
      $nombre_persona="";
      $apellido_persona="";
      $telefono=0;
      $correo="";
      $id_sexo=1;
      $fecha_nacimiento="";
      $direccion="";	
    }
	public function add(){
		$sql = "insert into ".self::$tablename." (id_persona,numero_ci,nombre_persona,apellido_persona,telefono,correo,fecha_nacimiento,direccion,id_sexo) ";
		$sql .= "values (nextval('sq_persona'),'000000-NN','$this->nombre_persona','$this->apellido_persona',$this->telefono,'','0001-01-01','',1)
		RETURNING id_persona";
		return $this->db->query($sql)->row();
	}

	
	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_persona=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getByNombreApellidoUnido($var){
		$var=strtolower($var);
		$sql = "select * from ".self::$tablename." where lower(nombre_persona)||' '||lower(apellido_persona)='$var'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByNombreApTel($var){
		$var=strtolower($var);
		$sql = "select * from ".self::$tablename." where lower(nombre_persona)||' '||lower(apellido_persona)='$var'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByNombreApTelN($var){
		$var=strtolower($var);
		$sql = "select count(*) as num from ".self::$tablename." where lower(nombre_persona)||' '||lower(apellido_persona)='$var'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAll(){
        return $this->db->query("select * from ".self::$tablename." p, usuario u where p.id_usuario=u.id_usuario");
	}
	public function getAllInv(){
        return $this->db->query("select * from ".self::$tablename." where numero_ci='000000-NN' order by nombre_persona");
	}

}

?>
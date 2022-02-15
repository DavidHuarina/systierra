
<?php
/**
* @author davidhuarina25@gmail.com
* @class personal
* @brief Modelo de base de datos para la tabla de personal
**/

class Personal extends CI_Model{
	public static $tablename = "personal";
         
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
      $fecha_contratacion="";
      $id_cargo="00-N";
      $id_usuario="";		
    }
    function getFullname(){ return $this->nombre_persona." ".$this->apellido_persona; }
	public function add(){
		$sql = "insert into ".self::$tablename." (id_persona,numero_ci,nombre_persona,apellido_persona,correo,fecha_nacimiento,direccion,id_sexo,id_cargo,id_usuario) ";
		$sql .= "values (nextval('sq_persona'),'$this->numero_ci','$this->nombre_persona','$this->apellido_persona','$this->correo','$this->fecha_nacimiento','$this->direccion',$this->id_sexo,'$this->id_cargo','$this->id_usuario')";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_persona=$id";
		$query = array($this->db->query($sql),'');
	}
	public function deleteP($id){
		$sql = "delete from ".self::$tablename." where id_personal=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_persona=$this->id";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto personal previamente utilizamos el contexto
	public function update(){
		
		$this->db->set('nombre_persona',$this->nombre_persona);
		$this->db->set('apellido_persona',$this->apellido_persona);
		$this->db->set('correo',$this->correo);
		$this->db->set('telefono',$this->telefono);
		$this->db->set('fecha_nacimiento',$this->fecha_nacimiento);
		$this->db->set('direccion',$this->direccion);
		$this->db->where('id_persona',$this->id_persona);
		$this->db->update(self::$tablename);
	}
	public function update_bk(){
		$sql = "update ".self::$tablename." set nombre_persona='$this->nombre_persona',apellido_persona='$this->apellido_persona',telefono=$this->telefono,correo='$this->correo',fecha_nacimiento='$this->fecha_nacimiento',direccion='$this->direccion' where id_persona=$this->id_persona";
		return $query = array($this->db->query($sql),'');
	}
	public function updateById($id){
		$sql = "update ".self::$tablename." set numero_ci='$this->numero_ci',nombre_persona='$this->nombre_persona',apellido_persona='$this->apellido_persona',telefono=$this->telefono,correo='$this->correo',fecha_nacimiento='$this->fecha_nacimiento',direccion='$this->direccion',fecha_contratacion='$this->fecha_contratacion',id_cargo='$this->id_cargo',id_usuario='$this->id_usuario' where id_persona=$id";
		$query = array($this->db->query($sql),'');
	}
	public function editarCargo($id,$car){
		$sql = "update ".self::$tablename." set id_cargo='$car' where id_persona=$id";
		$query = array($this->db->query($sql),'');
	}
//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_persona=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByIdM($id){
		$sql = "select * from ".self::$tablename." where id_persona=$id";
		$query = $this->db->query($sql);
		return Model::one($query,new Personal());
	}
	public function getByCargo2($id){
		$sql = "select * from ".self::$tablename." p, usuario u where p.id_usuario=u.id_usuario and p.id_cargo='$id' limit 1";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getByNombre($nombre){
		$sql = "select * from ".self::$tablename." where nombre_persona='$nombre'";
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
		$sql = "select * from persona where lower(nombre_persona)||' '||lower(apellido_persona)||' '||lower(telefono)='$var'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByCargo($cargo){
		$sql = "select * from ".self::$tablename." where id_cargo='$cargo' order by apellido_persona";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getByNombreApellido($busca){
		$busca=strtolower($busca);
		$sql = "select * from ".self::$tablename." where lower(nombre_persona) like '%$busca%' or lower(apellido_persona) like '%$busca%' order by nombre_persona";
		$query = $this->db->query($sql);
		return $query;
	}

    public function getByUsuario($nombre){
		$sql = "select * from ".self::$tablename." f,usuario u,cargo c where f.id_usuario=u.id_usuario and f.id_cargo=c.id_cargo and usuario='$nombre'";
		return $this->db->query($sql);
	}
	public function getByIdUsuario($id){
		$sql = "select * from ".self::$tablename." f,usuario u,cargo c where f.id_usuario=u.id_usuario and f.id_cargo=c.id_cargo and f.id_usuario='$id'";
		$query = $this->db->query($sql);
		return Model::one($query,new Personal());
	}
	public function getAllEst(){
        return $this->db->query("select * from ".self::$tablename." p, usuario u where p.id_usuario=u.id_usuario and p.estado_per!=0 order by p.nombre_persona");
	}
	public function getAll(){
        return $this->db->query("select * from ".self::$tablename." p, usuario u where p.id_usuario=u.id_usuario order by p.nombre_persona");
	}
	public function getAllReceptores(){
        return $this->db->query("select * from ".self::$tablename." p, usuario u,cargo c where p.id_cargo=c.id_cargo and u.id_usuario=p.id_usuario and (c.id_cargo='17-C' or c.id_cargo='19-C' or c.id_cargo='22-C' or c.id_cargo='20-C' or c.id_cargo='24-C' or c.id_cargo='25-C' or c.id_cargo='26-C') order by p.nombre_persona");
	}     
    public function getAllNotMe($idme){
        return $this->db->query("select * from ".self::$tablename." p, usuario u where p.id_usuario=u.id_usuario and u.id_usuario!='$idme'");
	}
	public function getAllIdUsuario($idme){
        return $this->db->query("select * from ".self::$tablename." p, usuario u where p.id_usuario=u.id_usuario and u.id_usuario='$idme'")->row();
	}
    public function getAllIdPersona($idme){
        return $this->db->query("select * from ".self::$tablename." p, usuario u,rol r,cargo c where p.id_usuario=u.id_usuario and r.id_rol=u.id_rol and c.id_cargo=p.id_cargo and p.id_persona='$idme'")->row();
	}
}

?>
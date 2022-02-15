
<?php
/**
* @author davidhuarina25@gmail.com
* @class Usuarios
* @brief Modelo de base de datos para la tabla de usuarios
**/

class Usuario extends CI_Model{
	public static $tablename = "usuario";
         
	public function __construct(){
	
		$usuario='';
		$contrasena='';
		$dir_imagen='imagenes/perfiles/default.png';
		$sobre_mi="";
		$id_rol=1010;
		$id_regional=1000;
	}

      /*function getFullname(){ 
		return $this->usuario." ".$this->contrasena; 
	}  */

	public function add(){
		$sql = "insert into ".self::$tablename." (id_usuario,usuario,contrasena,dir_imagen,sobre_mi,id_rol,id_regional) ";
		$sql .= "values (nextval('sq_usuario'),'$this->usuario','$this->contrasena','$this->dir_imagen','$this->sobre_mi',$this->id_rol,$this->id_regional)";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_usuario='$id'";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_usuario='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto Usuarios previamente utilizamos el contexto
	public function update(){
		$this->db->set('contrasena',$this->contrasena);
		$this->db->set('dir_imagen',$this->dir_imagen);
		$this->db->set('sobre_mi',$this->sobre_mi);
		$this->db->where('id_usuario',$this->id_usuario);
		$this->db->update(self::$tablename);
	}

	public function update_passwd(){
		$sql = "update ".self::$tablename." set contrasena='$this->contrasena' where id_usuario='$this->id'";	
		$query = array($this->db->query($sql),'');
	}
    
    public function online($id,$v){
		$sql = "update ".self::$tablename." set online=$v where id_usuario='$id'";
		$query = array($this->db->query($sql),'');
	}
	public function editarRol($idu,$rol){
		$sql = "update ".self::$tablename." set id_rol=$rol where id_usuario='$idu'";	
		$query = array($this->db->query($sql),'');
	}
//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_usuario='$id'";
		$query = $this->db->query($sql);
		return Model::one($query,new Usuario());
	}

	public function getByUsuario($usuario){
		$sql = "select * from ".self::$tablename." where usuario='$usuario'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getCorreo($correo){
		$sql = "select * from persona where correo='$correo'";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getCorreoPer($correo){
		$sql = "select * from personal where correo='$correo'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByImagen($nombre){
		$sql = "select * from ".self::$tablename." where dir_imagen='$nombre'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getLogin($usuario,$contrasena){
		$sql = "select * from ".self::$tablename." where usuario='$usuario' and contrasena='$contrasena'";
	    $query = $this->db->query($sql)->row();
		return $query;
	}
	public function getLogin2($usuario,$contrasena){
		$sql = "select * from ".self::$tablename." where correo='$usuario' and contrasena='$contrasena'";
	    $query = $this->db->query($sql)->row();
		return $query;
	}

public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
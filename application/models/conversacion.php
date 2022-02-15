
<?php
/**
* @author davidhuarina25@gmail.com
* @class conversaciones
* @brief Modelo de base de datos para la tabla de conversaciones
**/

class Conversacion extends CI_Model{
	public static $tablename = "conversacion";
         
	public function __construct(){
	
		$id_emisor='';
		$id_receptor='';
        $creado_en="";
	}

	public function getSender(){ return $this->personal->getByUsuarioId($this->sender_id);}
	public function getReceptor(){ return $this->personal->getByUsuarioId($this->receptor_id);}

	public function add(){
		$sql = "insert into ".self::$tablename." (
			id_conversacion,
			id_emisor,
			id_receptor,
			creado_en
			) ";
		$sql .= "values (
			nextval('sq_conversacion'),
			'$this->id_emisor',
			'$this->id_receptor',
			now()
			)";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_conversacion=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_conversacion=$this->id";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto conversaciones previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set 
		    id_emisor='$this->id_emisor',
		    id_receptor='$this->id_receptor',
			creado_en='$this->creado_en'

		where id_conversacion=$this->id_conversacion";
		$query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_conversacion=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByIdUsuarios($id1,$id2){
		$sql = "select * from ".self::$tablename." where (id_emisor='$id1' and id_receptor='$id2') or (id_emisor='$id2' and id_receptor='$id1')";
		$query = $this->db->query($sql)->row();
		return $query;
	}
   public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}
    public function getAllCn($id_user){
	
		$sql="select * from ".self::$tablename." where id_emisor='$id_user' or id_receptor='$id_user' order by creado_en desc";
		$query=$this->db->query($sql);
		return $query;
	}
	public function getAllC($id_user){
	
		return $this->db->query("select c.id_conversacion,nombre_persona, apellido_persona,contenido,m.creado_en,dir_imagen 
          from (select * from conversacion c, personal p where p.id_usuario=c.id_receptor) c,mensaje m ,usuario u
         where c.id_conversacion=m.id_conversacion and (c.id_emisor='$id_user' or c.id_receptor='$id_user') and u.id_usuario=c.id_usuario;

        ");
	}

}

?>
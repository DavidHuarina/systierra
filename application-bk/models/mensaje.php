
<?php
/**
* @author davidhuarina25@gmail.com
* @class mensajees
* @brief Modelo de base de datos para la tabla de mensajees
**/

class Mensaje extends CI_Model{
	public static $tablename = "mensaje";
         
	public function __construct(){
	
		$contenido='';
		$id_usuario='';
        $id_conversacion=0;
        $leido_mensaje=0;
        $creado_en="";
	}


	public function add(){
		$sql = "insert into ".self::$tablename." (
			id_mensaje,
			contenido,
			id_usuario,
			id_conversacion,
			leido_mensaje,
			creado_en
			) ";
		$sql .= "values (
			nextval('sq_mensaje'),
			'$this->contenido',
			'$this->id_usuario',
			$this->id_conversacion,
			$this->leido_mensaje,
			now()
			)";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_mensaje=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_mensaje=$this->id";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto mensajees previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set 
		    contenido='$this->contenido',
		    id_usuario='$this->id_usuario',
			id_conversacion=$this->id_conversacion,
			leido_mensaje=$this->leido_mensaje,
			creado_en='$this->creado_en'

		where id_mensaje=$this->id_mensaje";
		$query = array($this->db->query($sql),'');
	}
	public function leido_mensaje($conv,$idUser){
		$this->db->set('leido_mensaje',1);
		$this->db->where('id_conversacion',$conv);
		$this->db->where('id_usuario',$idUser);
		$this->db->update(self::$tablename);
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_mensaje=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
    public function getByUltimoMensaje($id_c){
		$sql = "select * from ".self::$tablename." where id_conversacion=$id_c order by creado_en desc limit 1";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getNMensajesNoLeidos($id_c,$id_u){
		$sql = "select count(*) as numero from ".self::$tablename." where id_conversacion=$id_c and leido_mensaje=0 and id_usuario!='$id_u'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getNMensajesRes($id_c,$id_u){
		$sql = "select count(*) as numero from ".self::$tablename." where id_conversacion=$id_c and id_usuario!='$id_u'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getNMensajes($id_c){
		$sql = "select count(*) as numero from ".self::$tablename." where id_conversacion=$id_c";
		$query = $this->db->query($sql)->row();
		return $query;
	}
public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}
	public function getByIdConv($conv,$limit){
	
		return $this->db->query("select m.id_usuario,id_emisor,id_receptor,m.creado_en,contenido from mensaje m, conversacion c where m.id_conversacion=c.id_conversacion and m.id_conversacion=$conv order by m.creado_en");
	}
	public function getByIdConvAUX($conv,$limit){
	
		return $this->db->query("select m.id_usuario,id_emisor,id_receptor,m.creado_en,contenido from mensaje m, conversacion c where m.id_conversacion=c.id_conversacion and m.id_conversacion=$conv order by m.creado_en limit $limit
     offset (select count(*) from mensaje)-$limit;");
	}

}

?>
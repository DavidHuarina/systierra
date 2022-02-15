
<?php
/**
* @author davidhuarina25@gmail.com
* @class notificaciones
* @brief Modelo de base de datos para la tabla de notificaciones
**/

class Notificacion extends CI_Model{
	public static $tablename = "notificacion";
         
	public function __construct(){
	
		$referencia='';
		$id_emisor='';
        $id_receptor="";
        $id_tipo_notificacion=0;
        $leido_notificacion=0;
        $creado_en="";
	}


	public function add(){
		$sql = "insert into ".self::$tablename." (
			id_notificacion,
			referencia,
			id_emisor,
			id_receptor,
			id_tipo_notificacion,
			leido_notificacion,
			creado_en
			) ";
		$sql .= "values (
			nextval('sq_notificacion'),
			'$this->referencia',
			'$this->id_emisor',
			'$this->id_receptor',
			$this->id_tipo_notificacion,
			0,
			now()
			)";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_notificacion='$id'";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_notificacion='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto notificaciones previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set 
		    referencia='$this->referencia',
		    id_emisor='$this->id_emisor',
			id_receptor='$this->id_receptor',
			id_tipo_notificacion=$this->id_tipo_notificacion,
			leido_notificacion=$this->leido_notificacion,
			creado_en='$this->creado_en'

		where id_notificacion='$this->id_notificacion'";
		$query = array($this->db->query($sql),'');
	}
	public function updateLeido($id,$estado){
     $sql="update notificacion set leido_notificacion=$estado where id_notificacion='$id'";
     $query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_notificacion='$id'";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function getByNotificacion($notificacion){
		$sql = "select * from ".self::$tablename." where referencia='$notificacion'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
   public function solEmisor($idu){
		$sql = "select * from ".self::$tablename." where id_emisor='$idu'";
		$query = $this->db->query($sql);
		return $query;
	}
    public function getAllNoti($id){
	
		return $this->db->query("select * from notificacion n, tipo_notificacion tn,personal p where n.id_tipo_notificacion=tn.id_tipo_notificacion and p.id_usuario=n.id_emisor and n.id_receptor='$id' order by creado_en desc");
	}
	public function getAllNotiNu($id){
	
		$query= $this->db->query("select count(*) as num from notificacion n, tipo_notificacion tn where n.id_tipo_notificacion=tn.id_tipo_notificacion and n.id_receptor='$id' and n.leido_notificacion=0");
	    return $query->row();
	}
	public function getAllNotiN($id){
	
		$query= $this->db->query("select count(*) as num from notificacion n, tipo_notificacion tn where n.id_tipo_notificacion=tn.id_tipo_notificacion and n.id_receptor='$id'");
	    return $query->row();
	}

}

?>
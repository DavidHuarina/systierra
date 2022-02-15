
<?php
/**
* @author davidhuarina25@gmail.com
* @class notificaciones
* @brief Modelo de base de datos para la tabla de notificaciones
**/

class cambio extends CI_Model{
	public static $tablename = "cambio";
         
	public function __construct(){
	
		$pais='';
		$unidad_mon='';
        $moneda="";
        $valor=0;
        $valor2=0;
        $descripcion="";
	}


	public function add(){
		$sql = "insert into ".self::$tablename." (
			id_cambio,
			pais,
			unidad_mon,
			moneda,
			valor,
			valor2,
			descripcion
			) ";
		$sql .= "values (
			nextval('sq_cambio'),
			'$this->pais',
			'$this->unidad_mon',
			'$this->moneda',
			$this->valor,
			0,
			now()
			)";
		return $query = array($this->db->query($sql),'');
	}
public function update($id,$pais,$unidad_mon,$moneda,$valor){
		$data = array(
          'pais' => $pais,
          'unidad_mon' => $unidad_mon,
          'moneda' => $moneda,
          'valor' => $valor
          );
		$this->db->where('id_cambio', $id);
        $this->db->update(self::$tablename,$data);
	}

	public function delete($id_cambio){
		$sql = "delete from ".self::$tablename." where id_cambio=$id_cambio";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_cambio='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto cambioes previamente utilizamos el contexto
	public function updateLeido($id,$estado){
     $sql="update cambio set valor2=$estado where id_cambio='$id'";
     $query = array($this->db->query($sql),'');
	}

//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_cambio=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	 public function getAll(){	
		return $this->db->query("select * from cambio where id_cambio!=2 order by id_cambio");
	}
	public function getAllN(){	
		return $this->db->query("select count(*) as num from cambio where id_cambio!=2")->row();
	}


}

?>
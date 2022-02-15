<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Solicitud extends CI_Model{
	public static $tablename = "solicitud";
         
	public function __construct(){

		$id_form=0;
		$estado_s=0;
		$fecha_s=null;
		$total=0;
		$descripcion='';
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_sol,id_form,estado_s,fecha_s,total,descripcion) ";
		$sql .= "values (nextval('sq_solicitud'),$this->id_form,1,now(),$this->total,'$this->descripcion')
		RETURNING id_sol";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_sol=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_form='$this->id'";
		$query = array($this->db->query($sql),'');
	}
    public function modificarEstado($e,$idsol){
		$sql = "update ".self::$tablename." set estado_s=$e WHERE id_sol=$idsol";
		$query = array($this->db->query($sql),'');
	}
// partiendo de que ya tenemos creado un objecto form previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',com_id='$this->com_id' where id_form='$this->id'";
		$query = array($this->db->query($sql),'');
	}
	public function aprobar($id){
		$sql = "update ".self::$tablename." set estado_s=2 where id_sol=$id";
		$query = array($this->db->query($sql),'');
	}
	public function updateTotal($ids,$monto){
		$soli=$this->solicitud->getById($ids);
		$total=$soli->total+$monto;
		$sql = "update ".self::$tablename." set total=$total where id_sol=$ids";
		$query = array($this->db->query($sql),'');
	}
    public function updateTotalMenos($ids,$monto){
		$soli=$this->solicitud->getById($ids);
		$total=$soli->total-$monto;
		$sql = "update ".self::$tablename." set total=$total where id_sol=$ids";
		$query = array($this->db->query($sql),'');
	}
//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_sol=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByAc($ac){
		$sql = "select * from sol_act where act_id=$ac";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAllReceptor($sol){
		$sql = "select nombre_persona,apellido_persona from solicitud s, formulario f, usuario u, personal p where s.id_form=f.id_form and f.id_receptor=u.id_usuario and p.id_usuario=u.id_usuario and s.id_sol=$sol";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAllSolicitante($sol){
		$sql = "select nombre_persona,apellido_persona,nombre_cargo from solicitud s, formulario f, usuario u, personal p,cargo cg 
where s.id_form=f.id_form and f.id_solicitante=u.id_usuario and p.id_usuario=u.id_usuario and cg.id_cargo=p.id_cargo and s.id_sol=$sol";
		$query = $this->db->query($sql)->row();
		return $query;
	}

    public function existe($id,$id2){
		$sql = "select count(*) as num from ".self::$tablename." where fecha_s='$id' and total='$id2'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
		public function getAllByIdS($sol){
		$sql = "select sm.id_solm, so.id_sol,f.id_solicitante,f.id_receptor, sa.id_sol_act, r.descripcion as descripcionr, sm.monto, s.descripcion 
from sol_act sa,formulario f, sol_montos sm,solicitud so, ep e,sub_rubro s,rubro r 
where sa.id_sol=so.id_sol and so.id_sol=sm.id_sol and sm.id_ep=e.id_ep and e.id_subr=s.id_subr and s.id_rubro=r.id_rubro and f.id_form=so.id_form and so.id_sol=$sol";
		$query = $this->db->query($sql)->row();
		return $query;
	}
    public function getAll($id){
	
		return $this->db->query("select s.id_sol,a.act_id, nombre_persona,apellido_persona,s.fecha_s,s.total,sb.sub_nom,t.tipo_nom,s.estado_s
from solicitud s, formulario f, usuario u, personal p ,actividad a, sol_act sa,sub_tipoact sb,tipoact t
where s.id_form=f.id_form and f.id_solicitante=u.id_usuario and p.id_usuario=u.id_usuario and sa.id_sol=s.id_sol 
   and sa.act_id=a.act_id and a.sub_id=sb.sub_id and sb.tipo_id=t.tipo_id and (a.id_estado=3 or a.id_estado=4 or a.id_estado=5) order by s.fecha_s desc");
	}
	public function getAllMe($id){
	
		return $this->db->query("select s.id_sol,a.act_id, nombre_persona,apellido_persona,s.fecha_s,s.total,sb.sub_nom,t.tipo_nom,s.estado_s
from solicitud s, formulario f, usuario u, personal p ,actividad a, sol_act sa,sub_tipoact sb,tipoact t
where s.id_form=f.id_form and f.id_solicitante=u.id_usuario and p.id_usuario=u.id_usuario and sa.id_sol=s.id_sol 
   and sa.act_id=a.act_id and a.sub_id=sb.sub_id and sb.tipo_id=t.tipo_id and f.id_solicitante='$id' order by s.fecha_s desc");
	}
	public function getNS($id){
	
		$sql="select count(*) as num
		from solicitud s, formulario f, usuario u, personal p ,actividad a, sol_act sa,sub_tipoact sb,tipoact t
         where s.id_form=f.id_form and f.id_solicitante=u.id_usuario and p.id_usuario=u.id_usuario and sa.id_sol=s.id_sol 
          and sa.act_id=a.act_id and a.sub_id=sb.sub_id and sb.tipo_id=t.tipo_id";
          $query = $this->db->query($sql)->row();
		return $query;
	}
	public function getNSMe($id){
	
		$sql="select count(*) as num
		from solicitud s, formulario f, usuario u, personal p ,actividad a, sol_act sa,sub_tipoact sb,tipoact t
         where s.id_form=f.id_form and f.id_solicitante=u.id_usuario and p.id_usuario=u.id_usuario and sa.id_sol=s.id_sol 
          and sa.act_id=a.act_id and a.sub_id=sb.sub_id and sb.tipo_id=t.tipo_id and f.id_solicitante='$id'";
          $query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAlls(){
	
		return $this->db->query('select * from '.self::$tablename);
	}

}

?>
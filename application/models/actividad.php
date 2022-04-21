<?php 
/**
 * 
 */
class Actividad extends CI_Model
{
	public static $tablename = "actividad";
	function __construct()
	{
		 parent::__construct();
         $act_fecha=NULL;
         $act_fecha_salida=NULL;
         $act_resp="";
         $act_resumen="";
         $act_obs="";
         $act_dias=1;
         $f_registro=null; 
         $sub_id=0;
         $id_lugar=0;
         $com_id=0;
         $id_estado=1;
         $id_act_ml=0;
         $id_res=0;
         $act_padre=0;
	}

	public function add()
	{
		$sql="insert into ".self::$tablename." (act_id,act_fecha,act_resp,act_dias,f_registro,sub_id,id_lugar,com_id,id_estado,id_act_ml,id_res,act_padre,act_fecha_salida) 
		VALUES(nextval('sq_actividad'),'$this->act_fecha','$this->act_resp',$this->act_dias,now(),$this->sub_id,$this->id_lugar,$this->com_id,1,$this->id_act_ml,$this->id_res,$this->act_padre,'$this->act_fecha_salida') 
		RETURNING act_id";
		return $this->db->query($sql)->row();
	}

	public function update($id_actividad){
		$sql = "update".self::$tablename." set descripcion='$this->nombre_actividad' WHERE id_actividad=$this->id_actividad";
		$query = array($this->db->query($sql),'');
	}
    public function modificarEstado($e,$id_actividad){
		$sql = "update ".self::$tablename." set id_estado=$e WHERE act_id=$id_actividad";
		$query = array($this->db->query($sql),'');
	}
	public function updateObser($id_actividad,$obs){
		$sql = "update ".self::$tablename." set act_obs='$obs' WHERE act_id=$id_actividad";
		$query = array($this->db->query($sql),'');
	}
	public function updateOrg($id_actividad,$obs){
		$sql = "update ".self::$tablename." set act_resumen='$obs' WHERE act_id=$id_actividad";
		$query = array($this->db->query($sql),'');
	}
    public function updatePresupuesto($id){
		$sql = "update ".self::$tablename." set presupuesto=2 WHERE id_actividad='$id'";
		$query = array($this->db->query($sql),'');
	}
	public function delete($id_actividad){
		$sql = "delete from ".self::$tablename."  where act_id=$id_actividad";
		$query = array($this->db->query($sql),'');
	}

	public function getById($id)
	{
		$sql = "select distinct p.id_proyecto,a.act_id,a.com_id, a.f_registro,a.act_dias,a.act_id,a.act_fecha,a.act_resumen,a.id_res,a.id_estado, 
			 p.nombre_proyecto,s.sub_nom,t.tipo_nom,a.act_padre 
			from ".self::$tablename. " a,res_act res, act_ml ml, indicador i, resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where res.id_result=ml.id_act_ml and i.id_ind=ml.id_ind and i.id_result=r.id_result and res.act_id=a.act_id and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and a.act_id=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByIdMl($id)
	{
		$sql = "select distinct p.id_proyecto,a.act_id,a.id_act_ml,a.com_id, a.f_registro,a.act_dias,a.act_id,a.act_fecha,a.act_resumen,a.id_res,a.id_estado, 
			 p.nombre_proyecto,s.sub_nom,t.tipo_nom,a.act_padre,t.tipo_id 
			from ".self::$tablename. " a,act_ml ml, indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where a.act_id=re.act_id and re.id_result=ml.id_act_ml and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and a.id_act_ml=$id";
		$query = $this->db->query($sql);
		return $query;
	}
	public function getActMes($año,$mes)
	{
		$sql = "select count(*) as num from actividad where DATE_PART('YEAR',act_fecha)='$año' and DATE_PART('MONTH',act_fecha)='$mes'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getActMesRegis($año,$mes)
	{
		$sql = "select count(*) as num from actividad where DATE_PART('YEAR',f_registro)='$año' and DATE_PART('MONTH',f_registro)='$mes'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByNombre($nombre)
	{
		$sql = "select * from ".self::$tablename." where nombre_actividad='$nombre'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByNombreOficina($descripcion)
	{
		$sql = "select * from ".self::$tablename." where descripcion='$descripcion'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getExiste($sub_id,$obe){
     $sql = "select count(*) as num from ".self::$tablename." where sub_id=$sub_id and id_obe=$obe";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAll($id){
	
		return $this->db->query("select distinct a.f_registro,a.act_dias,a.act_id,a.act_fecha,a.act_resumen,a.id_estado, 
			 p.nombre_proyecto,p.id_proyecto, s.sub_nom,t.tipo_nom,a.act_padre 
			from ".self::$tablename. " a,act_ml ml, indicador i,res_act res,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where res.id_result=ml.id_act_ml and res.act_id=a.act_id and i.id_ind=ml.id_ind and i.id_result=r.id_result and  r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and a.act_resp='$id' and a.act_padre=0 order by f_registro desc");
	}

	public function getAllEstado($id,$estado){
	
		return $this->db->query("select distinct a.f_registro,a.act_dias,a.act_id,a.act_fecha,a.act_resumen,a.id_estado, 
			 p.nombre_proyecto,p.id_proyecto, s.sub_nom,t.tipo_nom,a.act_padre 
			from ".self::$tablename. " a,act_ml ml, indicador i,res_act res,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where res.id_result=ml.id_act_ml and res.act_id=a.act_id and i.id_ind=ml.id_ind and i.id_result=r.id_result and  r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and a.act_resp='$id' and a.act_padre=0 and a.id_estado=$estado order by f_registro desc");
	}

	public function getAllSub($ac){
	
		return $this->db->query("select distinct a.id_act_ml, a.f_registro,a.act_dias,a.act_id,a.act_fecha,a.act_resumen,a.id_estado, 
		 p.nombre_proyecto,p.id_proyecto, s.sub_nom,t.tipo_nom 
			from actividad a,res_act re,act_ml ml, indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where a.act_id=re.act_id and re.id_result=ml.id_act_ml and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and a.act_padre=$ac order by f_registro desc");
	}
	public function getUltima($id){
	
		return $this->db->query("select distinct a.id_act_ml, a.f_registro,a.act_dias,a.act_id,a.act_fecha,a.act_resumen,a.id_estado, 
		 p.nombre_proyecto,p.id_proyecto, s.sub_nom,t.tipo_nom 
			from ".self::$tablename. " a,act_ml ml,res_act re, indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where a.act_id=re.act_id and re.id_result=ml.id_act_ml and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and a.act_resp='$id' order by f_registro desc limit 1")->row();
	}
	public function getEstadoRandom($id,$estado){
	
		return $this->db->query("select a.id_act_ml, a.f_registro,a.act_dias,a.act_id,a.act_fecha,a.act_resumen,a.id_estado, 
			 p.nombre_proyecto,p.id_proyecto, s.sub_nom,t.tipo_nom 
			from ".self::$tablename. " a,act_ml ml,res_act re, indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where a.act_id=re.act_id and re.id_result=ml.id_act_ml and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and a.act_resp='$id' and a.id_estado=$estado order by random() limit 1")->row();
	}

	public function getCantidadActividades($id,$estado){
	
		return $this->db->query("select count(*) as cantidad_sin_descargo			 
			from ".self::$tablename. " a,act_ml ml,res_act re, indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where a.act_id=re.act_id and re.id_result=ml.id_act_ml and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and a.act_resp='$id' and a.id_estado=$estado ")->row();
	}

	public function getAllIn($id){
	
		return $this->db->query("select distinct a.id_act_ml, a.f_registro,a.act_dias,a.act_id,a.act_fecha,a.act_resumen,a.id_estado, 
			 p.nombre_proyecto,p.id_proyecto, s.sub_nom,t.tipo_nom 
			from ".self::$tablename. " a,act_ml ml,res_act re, indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where a.act_id=re.act_id and re.id_result=ml.id_act_ml and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and a.act_resp!='$id' order by f_registro desc");
	}
	public function getNActIn($id){
	
		return $this->db->query("select distinct count(*) as num 
			from ".self::$tablename. " a,act_ml ml,res_act re, indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where a.act_id=re.act_id and re.id_result=ml.id_act_ml and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and a.act_resp!='$id'")->row();
	}
	public function getAlls(){
	
		return $this->db->query("select distinct a.id_act_ml, a.act_resp, a.f_registro,a.act_dias,a.act_id,a.act_fecha,a.act_resumen,a.id_estado, 
		 p.nombre_proyecto,p.id_proyecto, s.sub_nom,t.tipo_nom,a.act_padre 
			from ".self::$tablename. " a,act_ml ml,res_act re, indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where a.act_id=re.act_id and re.id_result=ml.id_act_ml and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and act_padre=0 order by f_registro desc");
	}
	public function getAlleq($id){
	
		return $this->db->query("select distinct a.id_act_ml,a.act_resp, a.f_registro,a.act_dias,a.act_id,a.act_fecha,a.act_resumen,a.id_estado, 
		 p.nombre_proyecto,p.id_proyecto, s.sub_nom,t.tipo_nom 
			from ".self::$tablename. " a,act_ml ml, res_act re,indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where a.act_id=re.act_id and re.id_result=ml.id_act_ml and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and a.id_estado!=5 and a.act_resp!='$id' order by f_registro desc");
	}
	public function getNActEq($id){
	
		return $this->db->query("select count(*) as num
			from ".self::$tablename. " a,act_ml ml, res_act re,indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where a.act_id=re.act_id and re.id_result=ml.id_act_ml and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and a.id_estado!=5 and a.act_resp!='$id'")->row();
	}
	public function getAllByP($id,$proy){
	
		return $this->db->query("select distinct a.id_act_ml,a.f_registro,a.act_dias,a.act_id,a.act_fecha,a.act_resumen,a.id_estado, 
			 p.nombre_proyecto,s.sub_nom,t.tipo_nom 
			from ".self::$tablename. " a,act_ml ml,res_act re, indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where a.act_id=re.act_id and re.id_result=ml.id_act_ml and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and a.act_resp='$id' and p.id_proyecto='$proy' order by f_registro desc");
	}
	public function getAllByPro($proy){
	
		return $this->db->query("select distinct a.f_registro,a.act_dias,a.act_id,a.act_fecha,a.act_resumen,a.id_estado, 
			 p.nombre_proyecto,s.sub_nom,t.tipo_nom,ml.descripcion 
			from ".self::$tablename. " a,act_ml ml,res_act res, indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where res.id_result=ml.id_act_ml and res.act_id=a.act_id and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and p.id_proyecto='$proy' order by f_registro desc");
	}
	public function getAllByPro2($proy){
	
		return $this->db->query("select distinct a.f_registro,a.act_dias,a.act_id,a.act_fecha,a.act_resumen,a.id_estado, 
			 p.nombre_proyecto,s.sub_nom,t.tipo_nom 
			from ".self::$tablename. " a,act_ml ml,res_act res, indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where res.id_result=ml.id_act_ml and res.act_id=a.act_id and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and (a.id_estado=3 or a.id_estado=4 or a.id_estado=5) and p.id_proyecto='$proy' order by f_registro desc");
	}
	public function getAllByPro3($proy,$desde,$hasta){
	
		return $this->db->query("select distinct a.f_registro,a.act_dias,a.act_id,a.act_fecha,a.act_resumen,a.id_estado, 
			 p.nombre_proyecto,s.sub_nom,t.tipo_nom 
			from ".self::$tablename. " a,act_ml ml,res_act res, indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where res.id_result=ml.id_act_ml and res.act_id=a.act_id and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and (a.id_estado=3 or a.id_estado=4 or a.id_estado=5) and p.id_proyecto='$proy' and act_fecha BETWEEN '$desde' AND '$hasta' order by f_registro desc");
	}
	public function getByIdOBE($oe){
	
		return $this->db->query("select distinct a.act_id,a.id_act_ml, a.f_registro,a.act_dias,a.act_id,a.act_fecha,a.act_resumen,a.id_estado, 
			 p.nombre_proyecto,s.sub_nom,t.tipo_nom 
			from ".self::$tablename. " a,act_ml ml,res_act res, indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where a.act_id=res.act_id and res.id_result=ml.id_act_ml and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and a.id_act_ml=$oe order by f_registro desc")->row();
	}
	public function getNAct($id){
	
		return $this->db->query("select count(*) as num from ".self::$tablename. " where act_resp='$id' and act_padre=0")->row();
	}
	public function getNActSub($ac){
	
		return $this->db->query("select count(*) as num from ".self::$tablename. " where act_padre=$ac")->row();
	}
	public function getMaxDias(){
	
		return $this->db->query("select max(act_dias) as dias from actividad")->row();
	}
	public function getNActP($id,$proy){
	
		return $this->db->query("select count(*) as num 
			from ".self::$tablename. " a,act_ml ml,res_act res, indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where a.act_id=res.act_id and res.id_result=ml.id_act_ml and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and a.act_resp='$id' and p.id_proyecto='$proy'")->row();
	}
	public function getNActPro($proy){
	
		return $this->db->query("select count(*) as num 
			from ".self::$tablename. " a,act_ml ml, res_act res,indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where a.act_id=res.act_id and res.id_result=ml.id_act_ml and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and p.id_proyecto='$proy'")->row();
	}
	public function getNActS(){
	
		return $this->db->query("select count(*) as num 
			from ".self::$tablename. " a,act_ml ml,res_act res, indicador i,resultados r,obe o,proyecto p,sub_tipoact s,tipoact t 
			where a.act_id=res.act_id and res.id_result=ml.id_act_ml and i.id_ind=ml.id_ind and i.id_result=r.id_result and r.id_obe=o.id_obe and o.id_proyecto=p.id_proyecto and a.sub_id=s.sub_id and s.tipo_id=t.tipo_id and a.act_padre=0")->row();
	}
	public function getAllN($id){
	
		return $this->db->query("select * from ".self::$tablename. " where id_estado=1 order by f_registro desc");
	}
}
 ?>
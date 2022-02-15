<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Descargo extends CI_Model{
	public static $tablename = "descargo_fondos";
         
	public function __construct(){

		$total=0;
		$saldo=0;
		$f_descargo=null;
		$observacion=0;
		$banco='';
		$n_cheque='';
		$id_sol=0;
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_df,total,saldo,f_descargo,observacion,banco,n_cheque,id_sol) ";
		$sql .= "values (nextval('sq_descargo_fondos'),0,0,'0001-01-01','','','',$this->id_sol)
		RETURNING id_df";
		$query = $this->db->query($sql)->row();
		return $query;
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where total='$id'";
		$query = array($this->db->query($sql),'');
	}
	public function delete2($id){
		$sql = "delete from ".self::$tablename." where id_sol=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where total='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto form previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',com_id='$this->com_id' where total='$this->id'";
		$query = array($this->db->query($sql),'');
	}
	public function cero($id){
		$sql = "update ".self::$tablename." set total=0,saldo=0 where id_sol=$id";
		$query = array($this->db->query($sql),'');
	}
	public function aprobar($id){
		$sql = "update ".self::$tablename." set saldo=2 where id_df=$id";
		$query = array($this->db->query($sql),'');
	}
	public function updateobservacion($ids,$monto){
		$soli=$this->descargo_fondos->getById($ids);
		$observacion=$soli->observacion+$monto;
		$sql = "update ".self::$tablename." set observacion=$observacion where id_df=$ids";
		$query = array($this->db->query($sql),'');
	}
	public function updateDescargo($id,$b,$ch){
		$detg=$this->detalle_gastos->getAllByIdDFSuma($id);
		$descar=$this->descargo->getById($id);
		$sol=$this->solicitud->getById($descar->id_sol);
		//$aux=$this->detalle_gastos->getAllByIdDF1($id);
		//$ultimo=$this->detalle_gastos->getAllByIdDFUl($id);
		$monto=0;$saldo=0;
		foreach ($detg->result() as $dg) {
				$monto=$monto+$dg->monto;
				$solm=$this->solm->getById($dg->id_solm);
				$subsaldo=$solm->monto-$dg->monto;				
				$this->ep->peracuDes($solm->id_ep,$subsaldo);		
		}
		$saldo=$sol->total-$monto;
		if($saldo>0){

		}
		$sql = "update ".self::$tablename." set total=$monto, saldo=$saldo,f_descargo=now(),banco='$b',n_cheque='$ch' where id_df=$id";
		$query = array($this->db->query($sql),'');
	}
	public function updateDescargoAux($id,$b,$ch){
		$detg=$this->detalle_gastos->getAllByIdDF($id);
		$descar=$this->descargo->getById($id);
		$sol=$this->solicitud->getById($descar->id_sol);
		$aux=$this->detalle_gastos->getAllByIdDF1($id);
		$ultimo=$this->detalle_gastos->getAllByIdDFUl($id);
		$monto=0;$saldo=0;$suma=0;
		foreach ($detg->result() as $dg) {
			if($aux->id_solm==$dg->id_solm){
				$suma=$suma+$dg->monto;
				
			}else{
				$monto=$monto+$suma;
				$solm=$this->solm->getById($aux->id_solm);
				$subsaldo=$solm->monto-$suma;
				
				$this->ep->peracuDes($solm->id_ep,$subsaldo);
				$suma=0;
			}	
			$aux=$dg;		
			
		}
		$suma=0;
        $suma=$suma+$ultimo->monto;
        $monto=$monto+$suma;
        $solm=$this->solm->getById($ultimo->id_solm);
		$subsaldo=$solm->monto-$suma;
		$this->ep->peracuDes($solm->id_ep,$subsaldo);

		$saldo=$sol->total-$monto;
		if($saldo>0){

		}
		$sql = "update ".self::$tablename." set total=$monto, saldo=$saldo,f_descargo=now(),banco='$b',n_cheque='$ch' where id_df=$id";
		$query = array($this->db->query($sql),'');
	}
    public function updateobservacionMenos($ids,$monto){
		$soli=$this->descargo_fondos->getById($ids);
		$observacion=$soli->observacion-$monto;
		$sql = "update ".self::$tablename." set observacion=$observacion where id_df=$ids";
		$query = array($this->db->query($sql),'');
	}
//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_df=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByIdSol($id){
		$sql = "select * from ".self::$tablename." where id_sol=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
		
    public function getAll($id){
	
		return $this->db->query("select s.id_sol,a.act_id, nombre_persona,apellido_persona,df.total as tgasto,df.f_descargo,df.saldo,df.banco,df.n_cheque, s.fecha_s,s.total,sb.sub_nom,t.tipo_nom,s.estado_s
from solicitud s, formulario f, usuario u, personal p ,actividad a, sol_act sa,sub_tipoact sb,tipoact t, descargo_fondos df
where s.id_form=f.id_form and f.id_solicitante=u.id_usuario and p.id_usuario=u.id_usuario and sa.id_sol=s.id_sol 
   and sa.act_id=a.act_id and a.sub_id=sb.sub_id and sb.tipo_id=t.tipo_id and df.id_sol=s.id_sol order by s.fecha_s desc");
	}
	public function getAllDes($id){
	
		return $this->db->query("select s.id_sol,a.*, nombre_persona,apellido_persona,df.total as tgasto,df.f_descargo,df.saldo,df.banco,df.n_cheque, s.fecha_s,s.total,sb.sub_nom,t.tipo_nom,s.estado_s
from solicitud s, formulario f, usuario u, personal p ,actividad a, sol_act sa,sub_tipoact sb,tipoact t, descargo_fondos df
where s.id_form=f.id_form and f.id_solicitante=u.id_usuario and p.id_usuario=u.id_usuario and sa.id_sol=s.id_sol 
   and sa.act_id=a.act_id and a.sub_id=sb.sub_id and sb.tipo_id=t.tipo_id and df.id_sol=s.id_sol and df.total!=0 order by s.fecha_s desc");
	}
	public function getAllDesMe($id){
	
		return $this->db->query("select s.id_sol,a.act_id, nombre_persona,apellido_persona,df.total as tgasto,df.f_descargo,df.saldo,df.banco,df.n_cheque, s.fecha_s,s.total,sb.sub_nom,t.tipo_nom,s.estado_s
from solicitud s, formulario f, usuario u, personal p ,actividad a, sol_act sa,sub_tipoact sb,tipoact t, descargo_fondos df
where s.id_form=f.id_form and f.id_solicitante=u.id_usuario and p.id_usuario=u.id_usuario and sa.id_sol=s.id_sol 
   and sa.act_id=a.act_id and a.sub_id=sb.sub_id and sb.tipo_id=t.tipo_id and df.id_sol=s.id_sol and df.total!=0 and f.id_solicitante='$id' order by s.fecha_s desc");
	}
    public function getND($id){
	
		$sql="select count(*) as num from solicitud s, formulario f, usuario u, personal p ,actividad a, sol_act sa,sub_tipoact sb,tipoact t, descargo_fondos df
where s.id_form=f.id_form and f.id_solicitante=u.id_usuario and p.id_usuario=u.id_usuario and sa.id_sol=s.id_sol 
   and sa.act_id=a.act_id and a.sub_id=sb.sub_id and sb.tipo_id=t.tipo_id and df.id_sol=s.id_sol";
          $query = $this->db->query($sql)->row();
		return $query;
	}
	public function getNDDes($id){
	
		$sql="select count(*) as num from solicitud s, formulario f, usuario u, personal p ,actividad a, sol_act sa,sub_tipoact sb,tipoact t, descargo_fondos df
where s.id_form=f.id_form and f.id_solicitante=u.id_usuario and p.id_usuario=u.id_usuario and sa.id_sol=s.id_sol 
   and sa.act_id=a.act_id and a.sub_id=sb.sub_id and sb.tipo_id=t.tipo_id and df.id_sol=s.id_sol and df.total!=0";
          $query = $this->db->query($sql)->row();
		return $query;
	}
	public function getNDDesMe($id){
	
		$sql="select count(*) as num from solicitud s, formulario f, usuario u, personal p ,actividad a, sol_act sa,sub_tipoact sb,tipoact t, descargo_fondos df
where s.id_form=f.id_form and f.id_solicitante=u.id_usuario and p.id_usuario=u.id_usuario and sa.id_sol=s.id_sol 
   and sa.act_id=a.act_id and a.sub_id=sb.sub_id and sb.tipo_id=t.tipo_id and df.id_sol=s.id_sol and df.total!=0 and f.id_solicitante='$id'";
          $query = $this->db->query($sql)->row();
		return $query;
	}
   public function getAllRem($id){
	
		return $this->db->query("select s.id_sol,a.act_id, nombre_persona,apellido_persona,df.total as tgasto,df.f_descargo,df.saldo,df.banco,df.n_cheque, s.fecha_s,s.total,sb.sub_nom,t.tipo_nom,s.estado_s
from solicitud s, formulario f, usuario u, personal p ,actividad a, sol_act sa,sub_tipoact sb,tipoact t, descargo_fondos df
where s.id_form=f.id_form and f.id_solicitante=u.id_usuario and p.id_usuario=u.id_usuario and sa.id_sol=s.id_sol 
   and sa.act_id=a.act_id and a.sub_id=sb.sub_id and sb.tipo_id=t.tipo_id and df.id_sol=s.id_sol and (s.estado_s=4 or s.estado_s=3) and df.saldo<0 order by s.fecha_s desc");
	}
    public function getNDRem($id){
	
		$sql="select count(*) as num from solicitud s, formulario f, usuario u, personal p ,actividad a, sol_act sa,sub_tipoact sb,tipoact t, descargo_fondos df
where s.id_form=f.id_form and f.id_solicitante=u.id_usuario and p.id_usuario=u.id_usuario and sa.id_sol=s.id_sol 
   and sa.act_id=a.act_id and a.sub_id=sb.sub_id and sb.tipo_id=t.tipo_id and df.id_sol=s.id_sol and (s.estado_s=4 or s.estado_s=3) and df.saldo<0";
          $query = $this->db->query($sql)->row();
		return $query;
	}
}

?>
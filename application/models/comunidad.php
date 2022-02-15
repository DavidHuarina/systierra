<?php 
/**
 * 
 */
class Comunidad extends CI_Model
{
	public static $tablename = "comunidad";
	function __construct()
	{
		 parent::__construct();
		 $com_nom='';
         $gid ='';
         $dep_id ='';
         $dep_des ='';
         $codigoprov ='';
         $pro_id ='';
         $nombreprov ='';
         $codigo_mun ='';
         $nombre_mun ='';
         $codigo_com ='';
         $clc_comuni ='';
         $id_unico ='';
         $censo ='';
         $tipo_area ='';
         $viviendas ='';
         $poblacion ='';
         $viviendass ='';
         $region ='';
         $obs_ft1 ='';
         $mun_id =0;
	}

	public function add()
	{
		$sql="insert into ".self::$tablename." (com_id,com_nom,dep_id,dep_des,pro_id,mun_id,viviendas,poblacion,region,obs_ft1) 
		values(nextval('sq_comunidad'),'$this->com_nom','$this->dep_id','$this->dep_des','$this->pro_id',$this->mun_id,'$this->viviendas','$this->poblacion','$this->region','$this->obs_ft1')";
		$query = $this->db->query($sql);
	}

	public function update($id,$nom,$sup,$fa,$par,$obs){
		$data = array(
          'com_nom' => $nom,
          'viviendas' => $sup,
          'poblacion' => $fa,
          'region' => $par,
          'obs_ft1' => $obs
          );
		$this->db->where('com_id', $id);
        $this->db->update(self::$tablename,$data);
	}

	public function delete($id_comunidad){
		$sql = "delete from ".self::$tablename." where com_id=$id_comunidad";
		$query = array($this->db->query($sql),'');
	}
   public function getAllDep(){
	
		return $this->db->query("select * from departamento order by dep_des");
	}
	public function getAll($id){
	
		return $this->db->query("select * from ".self::$tablename." where dep_id=$id order by com_nom ");
	}
	public function getAllProv($id){
	
		return $this->db->query("select * from provincia where dep_id=$id order by pro_des ");
	}
	public function getAllMun($id){
	
		return $this->db->query("select * from municipio where pro_id=$id order by mun_des ");
	}
	public function getAllMunId($id){
	
		return $this->db->query("select * from municipio where mun_id=$id")->row();
	}
	public function getDeptId($id){
	
		return $this->db->query("select * from departamento where dep_id=$id")->row();
	}
	public function getAllC(){
	
		return $this->db->query("select * from ".self::$tablename." order by com_nom");
	}
	public function getAllCDep($id){
	
		return $this->db->query("select * from ".self::$tablename." where dep_id='$id' order by com_nom");
	}
	public function getAllCMun($id){
	
		$query= $this->db->query("select * from ".self::$tablename." where mun_id=$id order by com_nom");
		$result = $query->result_array();
        $count = count($result);

       if (!empty($count)) {
           return $query;
       }
       else{
           redirect('ccomun');
       }
	}
	public function getAllCMunN($id){
	
		return $this->db->query("select count(*) as num from ".self::$tablename." where mun_id=$id")->row();
	}
	public function getAllCMun1($id){
	
		return $this->db->query("select * from ".self::$tablename." c,municipio m, provincia p, departamento d where c.mun_id=m.mun_id and m.pro_id=p.pro_id and p.dep_id=d.dep_id and c.mun_id=$id")->row();
	}
	public function getAllCP($id){
	
		return $this->db->query("select co.com_id, co.com_nom , co.dep_des from comunidad co EXCEPT 
			select c.com_id, c.com_nom , c.dep_des from ".self::$tablename." c, com_proy cp where cp.id_proyecto='$id' and cp.com_id=c.com_id order by com_nom");
	}
	public function getAllByAct($id){
	
		return $this->db->query("select * from actividad a, comunidad c,municipio m, provincia p, departamento d 
			where a.com_id=c.com_id and c.mun_id=m.mun_id and m.pro_id=p.pro_id and p.dep_id=d.dep_id and act_id=$id")->row();
	}
	public function getAllComAct(){
	
		return $this->db->query("select c.com_nom from actividad a, comunidad c
			where a.com_id=c.com_id group by com_nom");
	}
	public function getAllCN(){
	
		return $this->db->query("select count(*) as num from ".self::$tablename)->row();
	}
}
 ?>
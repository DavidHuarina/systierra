
<?php
/**
* @author davidhuarina25@gmail.com
* @class cargo
* @brief Modelo de base de datos para la tabla de cargo
**/

class Ep extends CI_Model{
	public static $tablename = "ep";
         
	public function __construct(){
	    $original=0;
	    $ajustes=0;
	    $actual=0;
	    $periodo=0;
	    $acumulado=0;
	    $por_per=0;
	    $por_acu=0;
	    $por_per=0;
		$saldos=0;
		$id_subr=0;
		$id_proy_ep=0;
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (id_ep,original,ajustes,actual,periodo,acumulado,por_per,por_acu,saldos,id_subr,id_proy_ep) ";
		$sql .= "values (nextval('sq_ep'),$this->original,0,$this->original,0,0,0,0,$this->original,$this->id_subr,$this->id_proy_ep)";
		return $query = array($this->db->query($sql),'');
	}

	public function delete($id){
		$sql = "delete from ".self::$tablename." where id_ep=$id";
		$query = array($this->db->query($sql),'');
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id_ep='$this->id'";
		$query = array($this->db->query($sql),'');
	}

// partiendo de que ya tenemos creado un objecto ep previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set id_proyecto='$this->id_proyecto',descripcion='$this->descripcion' where id_ep='$this->id'";
		$query = array($this->db->query($sql),'');
	}
	public function updateEstado($id,$estado){
		$sql = "update ".self::$tablename." set estado_ep=$estado where id_ep=$id";
		$query = array($this->db->query($sql),'');
	}
    public function ajustar($aj,$cod){
    	$ep=$this->ep->getById($cod);
    	$act = $ep->actual + $aj;
    	$sal=$act-$ep->acumulado;
		$sql = "update ".self::$tablename." set ajustes=$act-$ep->original,actual=$act,saldos=$sal where id_ep=$cod";
		$query = array($this->db->query($sql),'');
	}
	public function peracu($cod,$mon){
    	$ep=$this->ep->getById($cod);
    	$per=$ep->periodo+$mon;
    	$sal=$ep->actual-$per;
    	$por=number_format(($per*100)/$ep->actual, 2, '.', '');
		$sql = "update ".self::$tablename." set periodo=$per,acumulado=$per,saldos=$sal,por_per=$por,por_acu=$por where id_ep=$cod";
		$query = array($this->db->query($sql),'');
	}
	public function peracuDes($cod,$mon){
    	$ep=$this->ep->getById($cod);
    	$per=$ep->periodo-$mon;
    	$sal=$ep->actual-$per;
    	$por=number_format(($per*100)/$ep->actual, 2, '.', '');
		$sql = "update ".self::$tablename." set periodo=$per,acumulado=$per,saldos=$sal,por_per=$por,por_acu=$por where id_ep=$cod";
		$query = array($this->db->query($sql),'');
	}
//FUNCIONES QUE RETORNAN DE CONSULTA

	public function getById($id){
		$sql = "select * from ".self::$tablename." where id_ep=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
     public function getByIdS($id){
		$sql = "select * from ".self::$tablename." where id_subr=$id";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByIdSF($id,$ido){
		$sql = "select * from ".self::$tablename." where id_subr=$id and id_proy_ep=$ido";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getByNombre($ep){
		$sql = "select * from ".self::$tablename." where descripcion='$ep'";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getExiste($sr,$pe){
		$sql = "select count(*) as num from ".self::$tablename." where id_subr=$sr and id_proy_ep=$pe";
		$query = $this->db->query($sql)->row();
		return $query;
	}
	public function getAll(){
	
		return $this->db->query('select * from '.self::$tablename);
	}
	public function getAllByIdFondo($id){	
		return $this->db->query('select e.id_ep,e.id_subr,e.actual,e.ajustes,e.periodo,e.por_per,e.acumulado,e.por_acu,e.saldos, s.descripcion, s.codigo, r.descripcion as descripcionr ,r.codigo as codigor, e.original from '.self::$tablename." e, sub_rubro s, rubro r where e.id_subr=s.id_subr and s.id_rubro=r.id_rubro and e.id_proy_ep=$id order by s.codigo");
	}
	public function getAllByIdFondoEdit($id){	
		return $this->db->query('select e.estado_ep,e.id_ep,e.id_subr,e.actual,e.ajustes,e.periodo,e.por_per,e.acumulado,e.por_acu,e.saldos, s.descripcion, s.codigo, r.descripcion as descripcionr ,r.codigo as codigor, e.original from '.self::$tablename." e, sub_rubro s, rubro r where e.id_subr=s.id_subr and s.id_rubro=r.id_rubro and e.id_proy_ep=$id order by s.codigo");
	}
	public function getAllByIdFondoVer($id,$ver){
	switch ($ver) {
			case 1:
				return $this->db->query('select e.id_ep,e.id_subr,e.actual,e.ajustes,e.periodo,e.por_per,e.acumulado,e.por_acu,e.saldos, s.descripcion, s.codigo, r.descripcion as descripcionr ,r.codigo as codigor, e.original from '.self::$tablename." e, sub_rubro s, rubro r where e.id_subr=s.id_subr and s.id_rubro=r.id_rubro and e.id_proy_ep=$id and e.periodo!=0 order by s.codigo");
				break;
			case 2:
				return $this->db->query('select e.id_ep,e.id_subr,e.actual,e.ajustes,e.periodo,e.por_per,e.acumulado,e.por_acu,e.saldos, s.descripcion, s.codigo, r.descripcion as descripcionr ,r.codigo as codigor, e.original from '.self::$tablename." e, sub_rubro s, rubro r where e.id_subr=s.id_subr and s.id_rubro=r.id_rubro and e.id_proy_ep=$id and e.periodo=0 order by s.codigo");
				break;
			default:
				return $this->db->query('select e.id_ep,e.id_subr,e.actual,e.ajustes,e.periodo,e.por_per,e.acumulado,e.por_acu,e.saldos, s.descripcion, s.codigo, r.descripcion as descripcionr ,r.codigo as codigor, e.original from '.self::$tablename." e, sub_rubro s, rubro r where e.id_subr=s.id_subr and s.id_rubro=r.id_rubro and e.id_proy_ep=$id order by s.codigo");
				break;
		}	
		
	}
	public function getAllByIdFondoCambio($id,$ca){
		return $this->db->query("select e.id_ep,e.id_subr,
			e.actual/$ca as actual,
			e.ajustes/$ca as ajustes,
			e.periodo/$ca as periodo,
			e.por_per,
			e.acumulado/$ca as acumulado,
			e.por_acu,
			e.saldos/$ca as saldos, 
			s.descripcion, s.codigo, 
			r.descripcion as descripcionr, r.codigo as codigor,
			e.original/$ca as original
   from ep e, sub_rubro s, rubro r where e.id_subr=s.id_subr and s.id_rubro=r.id_rubro and e.id_proy_ep=$id order by s.codigo");
	}
	public function getAllByIdFondoCambioEdit($id,$ca){
		return $this->db->query("select e.id_ep,e.id_subr,
			e.actual/$ca as actual,
			e.ajustes/$ca as ajustes,
			e.periodo/$ca as periodo,
			e.por_per,
			e.acumulado/$ca as acumulado,
			e.por_acu,
			e.saldos/$ca as saldos, 
			s.descripcion, s.codigo, 
			r.descripcion as descripcionr, r.codigo as codigor,
			e.original/$ca as original
   from ep e, sub_rubro s, rubro r where e.id_subr=s.id_subr and s.id_rubro=r.id_rubro and e.periodo=0 and e.id_proy_ep=$id order by s.codigo");
	}
	public function getAllByIdFondoCambioVer($id,$ca,$ver){
		switch ($ver) {
			case 1:
				return $this->db->query("select e.id_ep,e.id_subr,
			e.actual/$ca as actual,
			e.ajustes/$ca as ajustes,
			e.periodo/$ca as periodo,
			e.por_per,
			e.acumulado/$ca as acumulado,
			e.por_acu,
			e.saldos/$ca as saldos, 
			s.descripcion, s.codigo, 
			r.descripcion as descripcionr, r.codigo as codigor,
			e.original/$ca as original
   from ep e, sub_rubro s, rubro r where e.id_subr=s.id_subr and s.id_rubro=r.id_rubro and e.id_proy_ep=$id and e.periodo!=0 order by s.codigo");
				break;
			case 2:
				return $this->db->query("select e.id_ep,e.id_subr,
			e.actual/$ca as actual,
			e.ajustes/$ca as ajustes,
			e.periodo/$ca as periodo,
			e.por_per,
			e.acumulado/$ca as acumulado,
			e.por_acu,
			e.saldos/$ca as saldos, 
			s.descripcion, s.codigo, 
			r.descripcion as descripcionr, r.codigo as codigor,
			e.original/$ca as original
   from ep e, sub_rubro s, rubro r where e.id_subr=s.id_subr and s.id_rubro=r.id_rubro and e.id_proy_ep=$id and e.periodo=0 order by s.codigo");
				break;
			default:
				return $this->db->query("select e.id_ep,e.id_subr,
			e.actual/$ca as actual,
			e.ajustes/$ca as ajustes,
			e.periodo/$ca as periodo,
			e.por_per,
			e.acumulado/$ca as acumulado,
			e.por_acu,
			e.saldos/$ca as saldos, 
			s.descripcion, s.codigo, 
			r.descripcion as descripcionr, r.codigo as codigor,
			e.original/$ca as original
   from ep e, sub_rubro s, rubro r where e.id_subr=s.id_subr and s.id_rubro=r.id_rubro and e.id_proy_ep=$id order by s.codigo");
				break;
		}	
		
	}

}

?>
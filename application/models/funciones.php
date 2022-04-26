<?php
/**
* @author davidhuarina25@gmail.com
* @class Usuarios
* @brief Modelo de base de datos para la tabla de usuarios
**/

class Funciones extends CI_Model{       
	public function queryGeneral($sql){				
		$query = $this->db->query($sql);
		return $query;
	}

	public function obtenerCantidadSolDetalleMontos($sol,$persona,$localidad,$item){
		$sql ="SELECT smo.cantidad,smo.id_capital_int_rural,smo.id_origensalida,smo.id_destinosalida,smo.id_origenvuelta,smo.id_destinovuelta,smo.fechasalida,smo.fechavuelta
		 FROM sol_montos_detalle_item smo join sol_montos sm on sm.id_solm=smo.id_sol_monto 
		where sm.id_sol='$sol' and smo.id_persona='$persona' and smo.id_via_localidad='$localidad' and smo.id_via_item = '$item'";
		$query = $this->db->query($sql)->row();
		if(isset($query->cantidad)){
			return array($query->cantidad,$query->id_capital_int_rural,$query->id_origensalida,$query->id_destinosalida,$query->id_origenvuelta,$query->id_destinovuelta,$query->fechasalida,$query->fechavuelta);
		}else{
			return array(0,0,0,0,0,0,'','');
		}
	}
	public function obtenerNombrePersonaCompletoDatos($idUsuario){
		$sql ="SELECT u.id_usuario,p.id_persona,p.nombre_persona,p.apellido_persona,c.nombre_cargo,r.nombre_regional  FROM usuario u join personal p on p.id_usuario=u.id_usuario 
				join cargo c on c.id_cargo=p.id_cargo
				join regional r on r.id_regional=u.id_regional
				WHERE u.id_usuario='$idUsuario';";
		$query = $this->db->query($sql)->row();
		if(isset($query->id_usuario)){

			return $query;
		}else{
			return null;
		}	
	}
	public function obtenerDepartamentoName($depa){
		$sql ="SELECT dep_des FROM departamento where dep_id='$depa';";
		$query = $this->db->query($sql)->row();
		if(isset($query->dep_des)){
			return $query->dep_des;
		}else{
			return "";
		}
	}
	public function obtenerLugarName($lugar){
		$sql ="SELECT descripcion FROM capital_intermedia_rural where id='$lugar'";
		$query = $this->db->query($sql)->row();
		if(isset($query->descripcion)){
			return $query->descripcion;
		}else{
			return "";
		}
	}
}

?>
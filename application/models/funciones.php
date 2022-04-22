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
		$sql ="SELECT smo.cantidad as valor FROM sol_montos_detalle_item smo join sol_montos sm on sm.id_solm=smo.id_sol_monto 
		where sm.id_sol='$sol' and smo.id_persona='$persona' and smo.id_via_localidad='$localidad' and smo.id_via_item = '$item'";
		$query = $this->db->query($sql)->row();
		if(isset($query->valor)){
			return $query->valor;
		}else{
			return 0;
		}
	}
}

?>
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
}

?>
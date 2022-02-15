<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SalirSistema extends CI_Controller {

	public function index()
	{ 
		$this->usuario->online($this->session->userdata('id_usuario_sesion'),0);
		$this->session->sess_destroy();
		redirect('login');

	}

}
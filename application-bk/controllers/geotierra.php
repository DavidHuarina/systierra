<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GeoTierra extends CI_Controller {

	public function index()
	{ 
		if($this->session->userdata('login')==FALSE){
           redirect('login');
         }else{
         	$this->load->view('geotierra/geotierra');
         }
		

	}
}

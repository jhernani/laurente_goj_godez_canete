<?php
class Main extends CI_Controller{
	public function index(){
		$this->load->view('pages/index');
	}
	
	public function _remap(){
		$this->index();
	}
}
?>
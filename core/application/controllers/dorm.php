<?php
class Dorm extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('sys');
	}
	public function index()
	{
		$data['base'] = $this->config->item('base_url');
        $data['title'] = 'Search Room';
		$data += $this->sys->status_check();
		
		$this->load->view('templates/m_head', $data);
		$this->load->view('templates/user/nav');
		$this->load->view('pages/user/dormitory', $data);
		$this->load->view('templates/foot');
	}
	
	public function blg($id = null){
		$data['base'] = $this->config->item('base_url');
        $data['title'] = 'Search Room';
		$data += $this->sys->status_check();
		
		$blg_id = $this->uri->segment(3);
        $offset = $this->uri->segment(4);

        $total = $this->sys->search_room_count($blg_id);
        $per_page = 5;

        $this->load->library('pagination');
        $config['base_url'] = $data['base'] . '/index.php/dorm/blg/' . $blg_id;
		$config['uri_segment'] = 4;
        $config['total_rows'] = $total;
        $config['per_page'] = $per_page;
		
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = "</ul>";
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='active'><a>";
		$config['cur_tag_close'] = '</li></a>';
		$config['next_link'] = '>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '<';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['room'] = $this->sys->search_room($offset, $per_page, $blg_id);
		
		$this->load->view('templates/m_head', $data);
		$this->load->view('templates/user/nav');
		$this->load->view('pages/user/building', $data);
		$this->load->view('templates/foot');
	}
	
	public function myreservation(){
		$data['title'] = "My Reservation";
		$data += $this->sys->status_check();
		$u_id = $this->session->userdata('u_id');
		
		$query = $this->sys->user_details($u_id);
		foreach($query->result() as $row)
		{
			$data['path'] = $row->IMAGE_PATH;
		}
		if(empty($data['path']))
		{
			$data['path'] = "profiles/profile-default.png";
		}
		
		$query = $this->sys->reservation_details($u_id);
		foreach ($query->result() as $row){
			$data['reserve_date'] = date('F d, Y g:i A ', strtotime($row->RESERVE_DATE));
			$status = $row->RESERVE_STATUS;
			$data['room_id'] = $row->ROOM;
		}
		$data['expire_date'] = date('F d, Y g:i A ', strtotime("+14 day", strtotime($data['reserve_date'])));
		
		switch($status){
			case '0': $data['status'] = "Pending";
					break;
			case '1': $data['status'] = "Accepted";
					break;
			case '2': $data['status'] = "Denied";
					break;
			case '3': $data['status'] = "Expired";
					break;
		}
		
		$query = $this->sys->room_details($data['room_id']);
		foreach ($query->result() as $row){
			$data['room'] = $row->BLG_NAME . " Room " . $row->ROOM_NO;
		}   
		
		$this->load->view('templates/m_head', $data);
		$this->load->view('templates/user/nav');
		$this->load->view('pages/user/myreservation', $data);
		$this->load->view('templates/foot');
	
	}
	
	public function myroom(){
		$data['title'] = "My Room";
		$data += $this->sys->status_check();
		$u_id = $this->session->userdata('u_id');
		
		$query = $this->sys->user_details($u_id);
		foreach ($query->result() as $row){
			$room_id = $row->ROOM;
			$data['path'] = $row->IMAGE_PATH;
			$data['start_date'] = date('F d, Y', strtotime($row->START_DATE));
		}
		
		if(empty($data['path']))
		{
			$data['path'] = "profiles/profile-default.png";
		}
		
		$query = $this->sys->room_details($room_id);
		foreach ($query->result() as $row){
			$data['room'] = $row->BLG_NAME . " Room " . $row->ROOM_NO;
			$data['cap'] = $row->CAP;
			$data['population'] = $row->POPULATION;
			$data['reserved'] = $row->RESERVED;
			$room_type = $row->TYPE;
			$room_gender = $row->GENDER;
		}
		
		$data['available'] = $data['cap'] - ($data['reserved'] + $data['population']);
		
		switch($room_type){
			case '0' : $data['room_type'] = "Standard";
					break;
			case '1' : $data['room_type'] = "Premium";
					break;
		}
		
		switch($room_gender){
			case 'M' : $data['room_gender'] = "Male";
					break;
			case 'F' : $data['room_gender'] = "Female";
					break;
		}
		
		$data['roommates'] = $this->sys->get_roommates($room_id);
		
		$this->load->view('templates/m_head', $data);
		$this->load->view('templates/user/nav');
		$this->load->view('pages/user/myroom', $data);
		$this->load->view('templates/foot');
	}
	
	public function pdf_print()
	{
		$this->load->helper('pdf');
		$u_id = $this->session->userdata('u_id');
		
		$query = $this->sys->user_details($u_id);
		foreach($query->result() as $row)
		{
			$data['name'] = $row->FNAME . " " . $row->MNAME . " " . $row->LNAME;
			$data['ismis_id'] = $row->ISMIS_ID;
			$data['id'] = $row->ACC_ID;
		}
		
		$query = $this->sys->reservation_details($u_id);
		foreach($query->result() as $row)
		{
			$data['reserve_date'] = date('F d, Y', strtotime($row->RESERVE_DATE));
			$data['expire_date'] = date('F d, Y', strtotime("+14 day", strtotime($data['reserve_date'])));
			$room_id = $row->ROOM;
		}
		
		$query = $this->sys->room_details($room_id);
		foreach($query->result() as $row)
		{
			$data['room'] = $row->BLG_NAME . " Room " . $row->ROOM_NO;
		}
		$this->load->view('pages/user/pdf', $data);
	}
}
?>
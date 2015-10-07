<?php
class User extends CI_Controller {	
	function __construct(){
		parent::__construct();
		$this->load->model('sys');
		date_default_timezone_set('Asia/Manila');
	}
	
	public function privacy()
	{
		$data['title'] = "Privacy";
		$data += $this->sys->status_check();
		$u_id = $this->session->userdata('u_id');
		$query = $this->sys->user_details($u_id);
		
		$row = $query->row();
		$data['path'] = $row->IMAGE_PATH;
		
		$query = $this->sys->get_privacy($u_id);
		
		$privacy = $query->row();
		$data['p_course'] = $privacy->COURSE;
		$data['p_bdate'] = $privacy->BDATE;
		$data['p_gender'] = $privacy->GENDER;
		$data['p_email'] = $privacy->EMAIL;
		
		if(empty($data['path']))
		{
			$data['path'] = "profiles/profile-default.png";
		}
		
		$this->load->view('templates/user/headers');
		$this->load->view('templates/m_head', $data);
		$this->load->view('templates/user/nav');
		$this->load->view('pages/user/privacy', $data);
		$this->load->view('templates/foot');
	}
	public function profile()
	{
		$data['title'] = "My Profile";
		$data += $this->sys->status_check();
		$u_id = $this->session->userdata('u_id');
		$query = $this->sys->user_details($u_id);
		
		$row = $query->row();
		$data['name'] = $row->FNAME  . " " . $row->MNAME . " " . $row->LNAME;
		$data['email'] = $row->EMAIL;
		$data['bdate'] = date('F d, Y', strtotime($row->BDATE));
		$data['path'] = $row->IMAGE_PATH;
		$data['ismis_id'] = $row->ISMIS_ID;
		$data['start_date'] = date('F d, Y', strtotime($row->START_DATE));
		$yr_lvl = $row->YEAR;
		$gender = $row->GENDER;
		$c_id = $row->C_ID;
		$room_id = $row->ROOM;
		
		if($gender == 'M')
		{
			$data['gender'] = "Male"; 
		}
		else 
		{
			$data['gender'] = "Female";
		}
		
		if(empty($data['path']))
		{
			$data['path'] = "profiles/profile-default.png";
		}
	
		switch($yr_lvl)
		{
			case 1: $data['yr_lvl'] = "1st year";
					break;
			case 2: $data['yr_lvl'] = "2nd year";
					break;
			case 3: $data['yr_lvl'] = "3rd year";
					break;
			case 4: $data['yr_lvl'] = "4th year";
					break;
			case 5: $data['yr_lvl'] = "5th year";
					break;	
		}
		
		$data['course'] = $this->sys->get_course($c_id);
		
		if($data['has_room'] == TRUE)
		{
			$query = $this->sys->room_details($room_id);
			$row = $query->row();
			
			$data['room'] = $row->BLG_NAME . " Room " . $row->ROOM_NO;
		}
		else
		{
			$data['room'] = "No room";
		}
		
		
		$this->load->view('templates/user/headers');
		$this->load->view('templates/m_head', $data);
		$this->load->view('templates/user/nav');
		$this->load->view('pages/user/profile', $data);
		$this->load->view('templates/foot');
	}
	
	public function settings()
	{		
		$data['title'] = "Settings";
		$data['error'] = "";
		$data += $this->sys->status_check();
		
		$u_id = $this->session->userdata('u_id');
		$query = $this->sys->user_details($u_id);
		
		foreach ($query->result() as $row)
		{
			$data['fname'] = $row->FNAME;
			$data['lname'] = $row->LNAME;
			$data['mname'] = $row->MNAME;
			$data['email'] = $row->EMAIL;
			$data['uname'] = $row->UNAME;
			$data['bdate'] = date('F d, Y', strtotime($row->BDATE));
			$data['path'] = $row->IMAGE_PATH;
			$gender = $row->GENDER;
			$data['g_fname'] = $row->G_FNAME;
			$data['g_lname'] = $row->G_LNAME;
			$data['g_mname'] = $row->G_MNAME;
			$data['contact'] = $row->CONTACT;
			   
		   if($gender == 'M')
				$data['gender'] = "Male";
		   else
				$data['gender'] = "Female";
		}
		
		if(empty($data['path']))
		{
			$data['path'] = "profiles/profile-default.png";
		}
		
		$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/assets/profiles/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['file_name'] = $u_id;
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);

		if($this->input->post('upload'))
		{
			if ( ! $this->upload->do_upload())
			{
				$data['error'] = $this->upload->display_errors();
				
				$this->load->view('templates/user/headers');
				$this->load->view('templates/m_head', $data);
				$this->load->view('templates/user/nav');
				$this->load->view('pages/user/settings', $data);
				$this->load->view('templates/foot');
			}
			else
			{
				$upload_data = $this->upload->data();
				$image = array();
				
				$config['image_library'] = 'gd2';
				$config['source_image']	= $upload_data['full_path'];
				$config['maintain_ratio'] = false;
				$config['width'] = 200;
				$config['height'] = 200;
				
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				
				$path = $upload_data['full_path'];
				$root = $this->input->server('DOCUMENT_ROOT') . "/assets";
				$image_path = str_replace($root, '', $path);
				
				$update_path = array('IMAGE_PATH' => $image_path);
				$this->db->where('ACC_ID', $u_id);
				$this->db->update('ACCOUNT', $update_path);
				
				redirect('/user/settings');
			}
		}
		else
		{
			$this->load->view('templates/user/headers');
			$this->load->view('templates/m_head', $data);
			$this->load->view('templates/user/nav');
			$this->load->view('pages/user/settings', $data);
			$this->load->view('templates/foot');
		}
	}
	
	public function assessment()
	{
		$data['title'] = "Assessment";
		$data += $this->sys->status_check();
		
		$u_id = $this->session->userdata('u_id');
		$data['u_id'] = $u_id;
		
		$query = $this->sys->user_details($u_id);
		$row = $query->row();
		
		$data['path'] = $row->IMAGE_PATH;		
		if(empty($data['path']))
		{
			$data['path'] = "profiles/profile-default.png";
		}
		
		$data += $this->sys->get_current_due($u_id);
		$data['fee'] = $this->sys->get_payable($u_id, $data['end']);
		$data['due'] = $this->sys->get_dues($u_id);
		$data['over_due'] = $this->sys->get_over_due($u_id);
		
		$data['total'] = 0.0;
		foreach ($data['due']->result() as $row)
		{
			$due = $row->DUE_DATE;
			$status = $row->DUE_STATUS;
			
			if($status != '1')
			{
				$data['total'] += $this->sys->get_due_total($u_id, $due);			
			}
		}
		
		$this->load->view('templates/user/headers');
		$this->load->view('templates/m_head', $data);
		$this->load->view('templates/user/nav');
		$this->load->view('pages/user/assessment', $data);
		$this->load->view('templates/foot');
	}
	
	public function print_assessment()
	{
		$this->load->helper('pdf');
		$u_id = $this->session->userdata('u_id');
		$data['u_id'] = $u_id;
		
		$query = $this->sys->user_details($u_id);
		$row = $query->row();
		
		$data['name'] = $row->FNAME . " " . $row->MNAME . " " . $row->LNAME;
		$data['ismis'] = $row->ISMIS_ID;
		$abbr = $this->sys->get_course_abbr($row->C_ID);
		$data['course'] = $abbr . " " . $row->YEAR;
		
		
		$data += $this->sys->get_current_due($u_id);
		$data['fee'] = $this->sys->get_payable($u_id, $data['end']);
		$data['due'] = $this->sys->get_dues($u_id);
		$data['over_due'] = $this->sys->get_over_due($u_id);
		
		$data['total'] = 0.0;
		foreach ($data['due']->result() as $row)
		{
			$due = $row->DUE_DATE;
			$status = $row->DUE_STATUS;
			
			if($status != '1')
			{
				$data['total'] += $this->sys->get_due_total($u_id, $due);			
			}
		}
		
		$this->load->view('templates/user/headers');
		$this->load->view('pages/user/pdf_assessment', $data);
	}
}
?>
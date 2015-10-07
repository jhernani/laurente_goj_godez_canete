<?php
class Admin extends CI_Controller {	
	function __construct(){
		parent::__construct();
		$this->load->model('sys');
		$this->sys->monitor_dues();
		$this->sys->monitor_reservation();
		date_default_timezone_set('Asia/Manila');	
	}
	
	public function settings()
	{		
		$data['title'] = "Settings";
		$data['error'] = "";
		
		$u_id = $this->session->userdata('u_id');
		$a_type = $this->session->userdata('a_type');
		$query = $this->sys->user_details($u_id);
		
		$row = $query->row();
		
		$data['uname'] = $row->UNAME;
		$data['email'] = $row->EMAIL;

		switch($a_type)
		{
			case 1: $this->load->view('templates/admin/supervisor/headers');
					break;
			case 2: $this->load->view('templates/admin/finance/headers');
					break;
			case 3: $this->load->view('templates/admin/system/headers');
					break;
		}

		$this->load->view('templates/m_head', $data);
		
		switch($a_type)
		{
			case 1: $this->load->view('templates/admin/supervisor/nav');
					break;
			case 2: $this->load->view('templates/admin/finance/nav');
					break;
			case 3: $this->load->view('templates/admin/system/nav');
					break;
		}
		$this->load->view('pages/admin/settings', $data);
		$this->load->view('templates/foot');
	}

	/**START OF SYSTEM ADMINISTRATOR CONTROLLER
	**FUNCTIONS INCLUDES
	**BUILDING AND ROOM MANAGEMENT
	**CREATING ADMINISTRATOR ACCOUNTS
	**VIEWING ADMINISTRATOR LOGS
	**/
	public function sys($view = null){			
		if($view == 'createadmin')
		{			
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');

			$this->form_validation->set_rules('type', '', 'callback_type');
			$this->form_validation->set_rules('fname', '','trim|required|alpha|xss_clean');
			$this->form_validation->set_rules('lname', '', 'trim|required|alpha|xss_clean');
			$this->form_validation->set_rules('pword', '', 'required|min_length[6]');
			$this->form_validation->set_rules('pwordconf', '', 'required|matches[pword]');
			$this->form_validation->set_rules('email', '', 'trim|required|callback_unique_add|valid_email');
			$this->form_validation->set_rules('bdate', '', 'callback_bdate');
			$this->form_validation->set_rules('terms', '', 'callback_terms');
			
			$this->form_validation->set_message('alpha', "Can only contain aphabetical characters.");
			$this->form_validation->set_message('required', "You can't leave this empty.");
			$this->form_validation->set_message('min_length', 'Password must contain atleast 6 characters.');
			$this->form_validation->set_message('matches', 'Passwords do not match.');
			$this->form_validation->set_message('valid_email', 'Please provide a valid email address.');
	
			if ($this->form_validation->run() == FALSE){
				$data['title'] = "Create Administrator Account";
				
				$this->load->view('templates/admin/system/headers');
				$this->load->view('templates/m_head', $data);
				$this->load->view('templates/admin/system/nav');
				$this->load->view('pages/admin/system/createadmin');
				$this->load->view('templates/foot');
			}
			else
			{
				$id = $this->sys->generate_id();
			
				$admin_type = $this->input->post('admin_type');
				$fname = $this->input->post('fname');
				$lname = $this->input->post('lname');
				$pword = $this->input->post('pword');
				$salt = "TEST";
				$email = $this->input->post('email');
				$month = $this->input->post('month');
				$day = $this->input->post('day');
				$year = $this->input->post('year');
				$gender = $this->input->post('gender');
				
				$fname = strtolower($fname);
				$fname = ucwords($fname);
				$lname = strtolower($lname);
				$lname = ucwords($lname);
			
				$bdate = "$year-$month-$day";
				$pword = "$pword$salt";
				$pword = md5($pword);			
				
				$info = array(
				'INFO_ID' => $id ,
				'FNAME' => $fname ,
				'LNAME' => $lname ,
				'BDATE' => $bdate ,
				'GENDER' => $gender);
				
				$acc = array(
				'ACC_ID' => $id ,
				'ACC_TYPE' => '1',
				'ADMIN_TYPE' => $admin_type,
				'PWORD' => $pword ,
				'SALT' => $salt ,
				'EMAIL' => $email);
				
				$logsdata = array(
				'USER' => $this->session->userdata('u_id'),
				'ACTV' => 'Create Admin Account',
				'ACTV_DATE' => date('Y-n-j H:i'));
													
				$this->sys->insert_log($logsdata);	
				$this->db->insert('INFO', $info);
				$this->db->insert('ACCOUNT', $acc);
				
				$data['title'] = "Account Created";
				
				$this->load->view('templates/admin/system/headers');
				$this->load->view('templates/m_head', $data);
				$this->load->view('templates/admin/system/nav');
				$this->load->view('pages/admin/system/success');
				$this->load->view('templates/foot');
			}
		}
		
		else if($view == 'adminlogs')
		{	
			$admin = $this->input->post('admin');
			$type = $this->input->post('type');
			
			$data['title'] = "Administrator Logs";
			$data['admin_list'] = $this->sys->get_admin_list();
			$data['logs'] = $this->sys->get_logs($admin, $type);
			$data['log_type'] = $this->sys->get_log_type();
			
			$this->load->view('templates/admin/system/headers');			
			$this->load->view('templates/m_head', $data);
			$this->load->view('templates/admin/system/nav');
			$this->load->view('pages/admin/system/logs', $data);
			$this->load->view('templates/foot');
		}
		
		else if($view == 'print_logs')
		{	
			$this->load->helper('pdf');
			$admin = $this->input->post('admin');
			$type = $this->input->post('type');
			
			$data['logs'] = $this->sys->get_logs($admin, $type);
			
			if($admin != "All")
			{
				$query = $this->sys->user_details($admin);
				
				$row = $query->row();
				$data['name'] = $row->LNAME . ", " . $row->FNAME;
			}
			else
			{
				$data['name'] = false;
			}
			
			$this->load->view('templates/admin/system/headers');
			$this->load->view('pages/admin/system/print_logs', $data);
		}
		
		else if($view == "dormitory")
		{
			$data['title'] = "Dormitory";
			$blg = $this->input->post('blg');
			
			$data['blg'] = $this->sys->get_buildings();
			$data['room'] = $this->sys->get_room($blg);
			
			$this->load->view('templates/admin/system/headers');
			$this->load->view('templates/m_head', $data);
			$this->load->view('templates/admin/system/nav');
			$this->load->view('pages/admin/system/dorm', $data);
			$this->load->view('templates/foot');
		}
		
		else if($view == "add_room")
		{
			$blg = $this->input->post('blg');
			$type = $this->input->post('type');
			$cap = $this->input->post('cap');
			$gender = $this->input->post('gender');
			
			$this->sys->add_room($blg, $type, $cap, $gender);
			
			$logsdata = array(
					'USER' => $this->session->userdata('u_id'),
					'ACTV' => 'Added a room',
					'ACTV_DATE' => date('Y-n-j H:i'));
					
			$this->sys->insert_log($logsdata);
			redirect('/admin/sys/dormitory');
		}
	}
	
	/**START OF SUPERVISOR CONTROLLER
	**FUNCTIONS INCLUDES
	**RESERVATION MANAGEMENT
	**ADDITIONAL FEES MANAGEMENT
	**USER MANAGEMENT
	**/
	
	public function supv($view = NULL)
	{
		if($view == "reservation")
		{
			$data['title'] = "Reservation List";
			$data['base'] = $this->config->item('base_url');
			
			$blg = $this->input->post('blg');
			$status = $this->input->post('status');
			$key = $this->input->post('key');

			$total = $this->sys->get_reservation_count($blg, $status, $key);
			$per_page = 10;
			$offset = $this->uri->segment(4);

			$this->load->library('pagination');
			$config['base_url'] = $data['base'].'/index.php/admin/supv/reservation';
			$config['total_rows'] = $total;
			$config['per_page'] = $per_page;
			$config['uri_segment'] = 4;
			
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
			$data['query'] = $this->sys->get_reservation_list($offset, $per_page, $blg, $status, $key);
			$data['blg'] = $this->sys->get_buildings();
			
			$this->load->view('templates/admin/supervisor/headers');
			$this->load->view('templates/m_head', $data);
			$this->load->view('templates/admin/supervisor/nav');
			$this->load->view('pages/admin/supervisor/reservation', $data);
			$this->load->view('templates/foot');
		}
		
		else if($view == "manage")
		{
			$data['title'] = "Manage Reservation";
			$u_id = $this->uri->segment(4);
			$data['u_id'] = $u_id;
			
			$query = $this->sys->user_details($u_id);		
			foreach ($query->result() as $row)
			{
				$data['name'] = $row->FNAME . " " . $row->MNAME . " " . $row->LNAME;
				$data['bdate'] = date('F d, Y', strtotime($row->BDATE));
				$data['email'] = $row->EMAIL;
				$data['path']  = $row->IMAGE_PATH;
				$data['ismis_id']  = $row->ISMIS_ID;
				$data['guardian'] = $row->G_FNAME . " " . $row->G_MNAME . " " . $row->G_FNAME;
				$data['contact'] = $row->CONTACT;
				$gender = $row->GENDER;
				$c_id = $row->C_ID;
				$yr_lvl = $row->YEAR;
			}
			
			if(empty($data['path']))
			{
				$data['path'] = "profiles/profile-default.png";
			}
			
			switch($gender)
			{
				case 'M': $data['gender'] = "Male";
						break;
				case 'F': $data['gender'] = "Female";
						break;	
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
			
			$query = $this->sys->reservation_details($u_id);
			$row = $query->row();

			$data['status'] = $row->RESERVE_STATUS;
			$data['reserve_date'] = date('F d, Y g:i A ', strtotime($row->RESERVE_DATE));
			$data['room_id'] = $room_id = $row->ROOM;
			$data['expire_date'] = date('F d, Y g:i A ', strtotime("+14 day", strtotime($data['reserve_date'])));
			
			$query = $this->sys->room_details($room_id);
			$row = $query->row();
			$data['room'] = $row->BLG_NAME . " Room " . $row->ROOM_NO;
			
			$this->load->view('templates/admin/supervisor/headers');
			$this->load->view('templates/m_head', $data);
			$this->load->view('templates/admin/supervisor/nav');
			$this->load->view('pages/admin/supervisor/manage', $data);
			$this->load->view('templates/foot');
		}
		
		else if($view == "users")
		{
			$data['title'] = "Users";
			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$blg = $this->input->post('blg');
			$course = $this->input->post('course');
			$gender = $this->input->post('gender');
			$status = $this->input->post('status');
			$key = $this->input->post('key');
			
			$data['base'] = $this->config->item('base_url');
				
			$per_page = 10;
			$offset = $this->uri->segment(4);
			$total = $this->sys->get_user_count($start, $end, $blg, $course, $gender, $status, $key);
						
			$this->load->library('pagination');
			$config['base_url'] = $data['base'].'/index.php/admin/supv/users';
			$config['total_rows'] = $total;
			$config['per_page'] = $per_page;
			$config['uri_segment'] = 4;
			
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
			$data['users'] = $this->sys->get_user($start, $end, $blg, $course, $gender, $status, $key, $offset, $per_page);
			$data['blg'] = $this->sys->get_buildings();
			$data['course'] = $this->sys->get_all_course();
			$data['total'] = $data['users']->num_rows();
			
			$this->load->view('templates/admin/supervisor/headers');
			$this->load->view('templates/m_head', $data);
			$this->load->view('templates/admin/supervisor/nav');
			$this->load->view('pages/admin/supervisor/users', $data);
			$this->load->view('templates/foot');
		}
		
		else if($view == "info")
		{
			$data['title'] = "User Information";
			$u_id = $this->uri->segment(4);
			
			$data += $this->sys->get_current_due($u_id);
			$data['user_fee'] = $this->sys->get_user_fee($u_id, $data['end']);
			$data['u_id'] = $u_id;
			
			$query = $this->sys->user_details($u_id);		
			foreach ($query->result() as $row){
				$data['name'] = $row->FNAME . " " . $row->MNAME . " " . $row->LNAME;
				$data['bdate'] = date('F d, Y', strtotime($row->BDATE));
				$data['email'] = $row->EMAIL;
				$data['path'] = $row->IMAGE_PATH;
				$data['ismis_id'] = $row->ISMIS_ID;
				$data['status'] = $row->STATUS;
				$data['start_date'] = date('F d, Y', strtotime($row->START_DATE));
				$data['end_date'] = $row->END_DATE;
				$data['guardian'] = $row->G_FNAME . " " . $row->G_MNAME . " " . $row->G_FNAME;
				$data['contact'] = $row->CONTACT;
				$gender = $row->GENDER;
				$c_id = $row->C_ID;
				$yr_lvl = $row->YEAR;
				$room_id = $row->ROOM;
			}
			
			if($data['end_date'] == "0000-00-00")
			{
				$data['end_date'] = "Currently in the dormitory";
			}
			else
			{
				$data['end_date'] = date('F d, Y', strtotime($row->END_DATE));
			}
			
			if(empty($data['path']))
			{
				$data['path'] = "profiles/profile-default.png";
			}
			
			$query = $this->sys->room_details($room_id);
			foreach ($query->result() as $row){
				$data['room'] = $row->BLG_NAME . " Room " . $row->ROOM_NO;
			}
			
			switch($gender){
				case 'M': $data['gender'] = "Male";
						break;
				case 'F': $data['gender'] = "Female";
						break;	
			}
			
			switch($yr_lvl){
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
			$data['fees'] = $this->sys->get_active_fees();
			
			$this->load->view('templates/admin/supervisor/headers');
			$this->load->view('templates/m_head', $data);
			$this->load->view('templates/admin/supervisor/nav');
			$this->load->view('pages/admin/supervisor/view', $data);
			$this->load->view('templates/foot');
		}
		
		else if($view == "payable")
		{
			$active_fee = $this->sys->get_active_fees();
			$u_id = $this->input->post('u_id');
			
			foreach($active_fee->result() as $row)
			{
				$checked = false;
				$fee_id = $row->FEE_ID;
				if($this->input->post($fee_id) == true)
				{
					$this->sys->insert_payable($fee_id, $u_id);
				}
				else
				{
					$this->sys->delete_payable($fee_id, $u_id);
				}
			}
			redirect('/admin/supv/info/' . $u_id);
		}
		
		else if($view == "checkout")
		{
			$u_id = $this->input->post('u_id');	
			
			$query = $this->sys->user_details($u_id);
			$row = $query->row();		
			$room_id = $row->ROOM; 
			
			$this->db->set('POPULATION', 'POPULATION - 1', FALSE);
			$this->db->where('ROOM_ID', $room_id);
			$this->db->update('ROOM');
			
			$this->db->where('ACC_ID', $u_id);
			$this->db->set('END_DATE', date('Y-n-j'));
			$this->db->set('STATUS', '0');
			$this->db->update('ACCOUNT');
			
			redirect('/admin/supv/users');
		}
		
		else if($view == "print_users")
		{
			$this->load->helper('pdf');
			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$blg = $this->input->post('blg');
			$course = $this->input->post('course');
			$gender = $this->input->post('gender');
			$status = $this->input->post('status');
			$key = $this->input->post('key');
			
			$data['users'] = $this->sys->get_user_print($start, $end, $blg, $course, $gender, $status, $key);
			$data['blg'] = $this->sys->get_buildings();
			$data['course'] = $this->sys->get_all_course();
			$data['total'] = $data['users']->num_rows();

			$this->load->view('templates/admin/supervisor/headers');
			$this->load->view('pages/admin/supervisor/print_users', $data);
		}
	}
	
	/**START OF ACCOUNTING CONTROLLER
	**FUNCTIONS INCLUDES
	**FEE MANAGEMENT
	**VIEWING USER ASSESSMENT AND HISTORY
	**MAKING PAYMENTS
	**REPORTS
	**/
	
	public function acctg($view = NULL)
	{
		if($view == "report")
		{			
			$data['title'] = "Report";
			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$blg = $this->input->post('blg');
			$course = $this->input->post('course');
			$gender = $this->input->post('gender');
			$key = $this->input->post('key');
			
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');

			$this->form_validation->set_rules('start', '', 'required');
			$this->form_validation->set_rules('end', '', 'required');
	
			if ($this->form_validation->run() == FALSE){
				$data['title'] = "Create Administrator Account";
				$data['blg'] = $this->sys->get_buildings();
				$data['course'] = $this->sys->get_all_course();
				
				$this->load->view('templates/admin/finance/headers');
				$this->load->view('templates/m_head', $data);
				$this->load->view('templates/admin/finance/nav');
				$this->load->view('pages/admin/finance/reports-form', $data);
				$this->load->view('templates/foot');
			}
			else
			{
				$data['blg'] = $this->sys->get_buildings();
				$data['course'] = $this->sys->get_all_course();
				$data['account'] = $this->sys->get_accounts($start, $end, $blg, $course, $gender, $key);
				$data['total'] = $data['account']->num_rows();
				
				$this->load->view('templates/admin/finance/headers');
				$this->load->view('templates/m_head', $data);
				$this->load->view('templates/admin/finance/nav');
				$this->load->view('pages/admin/finance/reports', $data);
				$this->load->view('templates/foot');
			}
		}
		
		else if($view == "change_fee")
		{
			$fee_id = $this->input->post('fee_id');
			$price = $this->input->post('price');
			
			$this->db->where('FEE_ID', $fee_id);
			$this->db->set('ACTIVE', '0');
			$this->db->update('FEE');
			
			$this->db->where('FEE_ID', $fee_id);
			$query = $this->db->get('FEE');
			$row = $query->row();
			
			$fee_name = $row->FEE_NAME;
			$category = $row->CATEGORY;
			
			$data = array(
				'FEE_NAME' => $fee_name,
				'VALUE' => $price,
				'CATEGORY' => $category);
				
			$this->db->insert('FEE', $data);
			
			redirect('/admin/acctg/settings');
		}
		
		if($view == "print_report")
		{
			$data['title'] = "Report";
			$this->load->helper('pdf');
			
			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$blg = $this->input->post('blg');
			$course = $this->input->post('course');
			$gender = $this->input->post('gender');
			$status = $this->input->post('status');
			$key = $this->input->post('key');
			
			$data['account'] = $this->sys->get_accounts($start, $end, $blg, $course, $gender, $key);
			$data['blg'] = $this->sys->get_buildings();
			$data['course'] = $this->sys->get_all_course();
			$data['total'] = $data['account']->num_rows();
			
			$this->load->view('templates/admin/finance/headers');
			$this->load->view('pages/admin/finance/print_reports', $data);
		}
		
		if($view == "settings")
		{
			$data['title'] = "Settings";
			$data['active_fee'] = $this->sys->get_active_fee();
			$data['all_fee'] = $this->sys->get_fee();
			
			$this->load->view('templates/admin/finance/headers');
			$this->load->view('templates/m_head', $data);
			$this->load->view('templates/admin/finance/nav');
			$this->load->view('pages/admin/finance/settings', $data);
			$this->load->view('templates/foot');
		}
		
		else if($view == "accounts")
		{
			$data['title'] = "Users";
			
			$start = $this->input->post('start');
			$end = $this->input->post('end');
			$blg = $this->input->post('blg');
			$course = $this->input->post('course');
			$gender = $this->input->post('gender');
			$status = $this->input->post('status');
			$key = $this->input->post('key');
			
			$per_page = 10;
			$offset = $this->uri->segment(4);

			$total = $this->sys->get_user_count($start, $end, $blg, $course, $gender, $status, $key);
			
			$this->load->library('pagination');
			
			$data['base'] = $this->config->item('base_url');
			$config['base_url'] = $data['base'].'/index.php/admin/acctg/accounts';
			$config['total_rows'] = $total;
			$config['per_page'] = $per_page;
			$config['uri_segment'] = 4;
			
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
			
			$data['users'] = $this->sys->get_user($start, $end, $blg, $course, $gender, $status, $key, $offset, $per_page);
			$data['blg'] = $this->sys->get_buildings();
			$data['course'] = $this->sys->get_all_course();
			$data['total'] = $data['users']->num_rows();
			
			$this->load->view('templates/admin/finance/headers');
			$this->load->view('templates/m_head', $data);
			$this->load->view('templates/admin/finance/nav');
			$this->load->view('pages/admin/finance/accounts', $data);
			$this->load->view('templates/foot');
		}
		
		else if($view == "payment")
		{
			$u_id = $this->uri->segment(4);
			$data['title'] = "Payment";
			$query = $this->sys->user_details($u_id);
			$data['u_id'] = $u_id;
			
			foreach($query->result() as $row)
			{
				$data['path'] = $row->IMAGE_PATH;
				$data['name'] = $row->FNAME . " " . $row->MNAME . " " . $row->LNAME;
			}
			
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
			
			$this->load->view('templates/admin/finance/headers');
			$this->load->view('templates/m_head', $data);
			$this->load->view('templates/admin/finance/nav');
			$this->load->view('pages/admin/finance/user_fee', $data);
			$this->load->view('templates/foot');
		}
	}
	
	function type()
	{	
		if ($this->input->post('admin_type') == 0){
			$this->form_validation->set_message('type', "Please select administrator type.");
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	function bdate()
	{
		if ($this->input->post('month') == 0 || $this->input->post('day') == 0 || $this->input->post('year') == 0){
			$this->form_validation->set_message('bdate', "Please provide birth date.");
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	function unique_add()
	{
		$email = $this->input->post('email');
		
		$this->db->where('EMAIL', $email);
		$query = $this->db->get('ACCOUNT');
		
		$result = $query->num_rows();
		if ($result > 0)
		{
			$this->form_validation->set_message('email', "Email is already in use");
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
}
?>
<?php
class Auth extends CI_Controller {	
	function __construct(){
		parent::__construct();
		$this->load->model('sys');	
	}
	public function register()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="label label-danger">', '</span>');
		
		$this->form_validation->set_rules('id_number', '','trim|required|callback_ismis|is_natural|exact_length[8]');
		$this->form_validation->set_rules('fname', '','trim|required');
		$this->form_validation->set_rules('lname', '', 'trim|required');
		$this->form_validation->set_rules('pword', '', 'required|min_length[6]');
		$this->form_validation->set_rules('pwordconf', '', 'required|matches[pword]');
		$this->form_validation->set_rules('email', '', 'trim|required|is_unique[account.email]|valid_email');
		$this->form_validation->set_rules('contact', '', 'trim|required|is_natural|exact_length[11]');
		$this->form_validation->set_rules('course', '', 'callback_course');
		$this->form_validation->set_rules('bdate', '', 'callback_bdate');
		$this->form_validation->set_rules('terms', '', 'callback_terms');
		$this->form_validation->set_rules('lv', '', '');
		$this->form_validation->set_rules('month', '', '');
		$this->form_validation->set_rules('day', '', '');
		$this->form_validation->set_rules('year', '', '');
		$this->form_validation->set_rules('gender', '', '');
		
		$this->form_validation->set_message('is_natural', "Can only contain numeric characters.");
		$this->form_validation->set_message('alpha', "Can only contain aphabetical characters.");
		$this->form_validation->set_message('min_length', "Must contain atleast 6 characters.");
		$this->form_validation->set_message('exact_length', "Must be 8 characters in length.");
		$this->form_validation->set_message('required', "You can't leave this empty.");
		$this->form_validation->set_message('matches', 'Passwords do not match.');
		$this->form_validation->set_message('is_unique', 'Email is already in use.');
		$this->form_validation->set_message('valid_email', 'Please provide a valid email address.');

		if ($this->form_validation->run() == FALSE)
		{
			$data['title'] = 'Registration';
			
			$this->load->view('templates/m_head', $data);
			$this->load->view('templates/m_nav');
			$this->load->view('pages/register');
			$this->load->view('templates/foot');
		}
		else
		{
			$u_id = $this->sys->generate_id();
		
			$id_number = $this->input->post('id_number');
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$pword = $this->input->post('pword');
			$salt = "TEST";
			$email = $this->input->post('email');
			$course = $this->input->post('course');
			$lv = $this->input->post('lv');
			$month = $this->input->post('month');
			$day = $this->input->post('day');
			$year = $this->input->post('year');
			$gender = $this->input->post('gender');
			$contact = $this->input->post('contact');
			
			$fname = strtolower($fname);
			$fname = ucwords($fname);
			$lname = strtolower($lname);
			$lname = ucwords($lname);
			
			$bdate = "$year-$month-$day";
			$pword = "$pword$salt";
			$pword = md5($pword);			
			
			$info = array(
   			'INFO_ID' => $u_id ,
   			'FNAME' => $fname ,
   			'LNAME' => $lname ,
			'C_ID' => $course ,
			'CONTACT' => $contact,
			'YEAR' => $lv ,
			'BDATE' => $bdate ,
			'GENDER' => $gender);
			
			$acc = array(
   			'ACC_ID' => $u_id ,
			'ISMIS_ID' => $id_number,
   			'PWORD' => $pword ,
   			'SALT' => $salt ,
			'EMAIL' => $email);
			
			$privacy = array(
   			'ACC_ID' => $u_id);

			$this->db->insert('INFO', $info);
			$this->db->insert('ACCOUNT', $acc);
			$this->db->insert('PRIVACY', $privacy);
			
			$sessiondata = array(
			'signin' => TRUE,
			'u_id' => $u_id,
			'u_type' => '0',
			'u_gen' => $gender,
			'a_type' => '0');
					
			$this->session->set_userdata($sessiondata);
			redirect('/dorm');
		}
	}
	
	public function signin()
	{
		$data['error'] = '';
		$data['title'] = 'Sign In';
			
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-warning">', '</div>');
		
		$this->form_validation->set_rules('user', '','required');
		$this->form_validation->set_rules('pass', '','required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('templates/signin-header');
			$this->load->view('templates/m_head', $data);
			$this->load->view('pages/signin', $data);
			$this->load->view('templates/foot');
		}
		else{// start matching for email
			$user = $this->input->post('user');
			$pass = $this->input->post('pass');	
	
			$this->db->where('EMAIL', $user);	
			$query = $this->db->get('ACCOUNT');	
			
			$valid = $query->num_rows();
			if($valid){ //email matching - found an account with the provided email
				foreach($query->result() as $row){
					$db_salt = $row->SALT;
					$pass = "$pass$db_salt";
					$pass = md5($pass);
					
					$this->db->where('EMAIL', $user);
					$this->db->where('PWORD', $pass);
					$this->db->from('ACCOUNT');
					$this->db->join('INFO', 'ACCOUNT.ACC_ID = INFO.INFO_ID');
					$query = $this->db->get();
					
					$valid = $query->num_rows();
					if($valid){
						foreach($query->result() as $row){
							$u_id = $row->ACC_ID;
							$u_type = $row->ACC_TYPE;
							$u_gen = $row->GENDER;
							
							if($u_type == '1'){
								$a_type = $row->ADMIN_TYPE;		
								$sessiondata = array(
										'signin' => TRUE,
										'u_id' => $u_id,
										'u_type' => $u_type,
										'u_gen' => $u_gen,
										'a_type' => $a_type);
								
								$logsdata = array(
								'USER' => $u_id,
								'ACTV' => 'Sign In',
								'ACTV_DATE' => date('Y-n-j H:i'));
													
								$this->sys->insert_log($logsdata);
								$this->session->set_userdata($sessiondata);
								
								switch($a_type)
								{
									case '1': redirect('/admin/supv/reservation');
										break;
									case '2': redirect('/admin/acctg/accounts');
										break;
									case '3': redirect('/admin/sys/dormitory');
										break;
								
								}
							}
							else
							{
								$sessiondata = array(
								'signin' => TRUE,
								'u_id' => $u_id,
								'u_type' => $u_type,
								'u_gen' => $u_gen,
								'a_type' => '0');
													
								$this->session->set_userdata($sessiondata);
								
								$has_room = $this->sys->check_for_room();
								$has_reservation = $this->sys->check_reservation();
								
								if($has_room == true)
								{
									redirect('/dorm/myroom');
								}
								else if($has_reservation == true)
								{
									redirect('/dorm/myreservation');
								}
								else
								{
									redirect('/dorm');
								}
							}
						}
						
					}
					else
					{
						$data['error'] = "<div class='alert alert-warning'>Incorrect email or password.</div>";
						$this->load->view('templates/m_head', $data);
						$this->load->view('pages/signin', $data);
						$this->load->view('templates/foot');	
					}
				}
			}
			//end of email matching
			//no account found with the provided email
			//start matching for username
			else
			{ 
				$this->db->where('UNAME', $user);	
				$query = $this->db->get('ACCOUNT');	
				
				$valid = $query->num_rows();
				if($valid){
					foreach($query->result() as $row){
						$db_salt = $row->SALT;
						$pass = "$pass$db_salt";
						$pass = md5($pass);
						
						$this->db->where('UNAME', $user);
						$this->db->where('PWORD', $pass);
						$this->db->from('ACCOUNT');
						$this->db->join('INFO', 'ACCOUNT.ACC_ID = INFO.INFO_ID');
						$query = $this->db->get();
						
						$valid = $query->num_rows();
						if($valid){
							foreach($query->result() as $row){
								$u_id = $row->ACC_ID;
								$u_type = $row->ACC_TYPE;
								$u_gen = $row->GENDER;
								
								if($u_type == '1'){
									$a_type = $row->ADMIN_TYPE;	
									$sessiondata = array(
									'signin' => TRUE,
									'u_id' => $u_id,
									'u_type' => $u_type,
									'u_gen' => $u_gen,
									'a_type' => $a_type);
									
									$logsdata = array(
									'USER' => $u_id,
									'ACTV' => 'Sign In',
									'ACTV_DATE' => date('Y-n-j H:i'));
													
									$this->sys->insert_log($logsdata);														
									$this->session->set_userdata($sessiondata);
									
									switch($a_type)
									{
										case '1': redirect('/admin/supv/reservation');
											break;
										case '2': redirect('/admin/acctg/accounts');
											break;
										case '3': redirect('/admin/sys/dormitory');
											break;
									
									}
								}
								else
								{
									$sessiondata = array(
									'signin' => TRUE,
									'u_id' => $u_id,
									'u_type' => $u_type,
									'u_gen' => $u_gen,
									'a_type' => '0');
														
									$this->session->set_userdata($sessiondata);
									
									$has_room = $this->sys->check_for_room();
									$has_reservation = $this->sys->check_reservation();
									
									if($has_room == true)
									{
										redirect('/dorm/myroom');
									}
									else if($has_reservation == true)
									{
										redirect('/dorm/myreservation');
									}
									else
									{
										redirect('/dorm');
									}
								}
							}
							
						}
						else{
							$data['error'] = "<div class='alert alert-warning'>Incorrect email or password.</div>";
							$this->load->view('templates/m_head', $data);
							$this->load->view('pages/signin', $data);
							$this->load->view('templates/foot');	
						}
					}
				}
			}
			//end of username matching
			//cannot find username/email
			$data['error'] = "<div class='alert alert-warning'>Incorrect email or password.</div>";
			
			$this->load->view('templates/m_head', $data);
			$this->load->view('pages/signin', $data);
			$this->load->view('templates/foot');
		}
		//end of email matching
	}
	
	public function signout()
	{
		if($this->session->userdata('u_type') == '1')
		{
			$u_id = $this->session->userdata('u_id');
			
			$logsdata = array(
					'USER' => $u_id,
					'ACTV' => 'Sign Out',
					'ACTV_DATE' => date('Y-n-j H:i'));
					
			$this->sys->insert_log($logsdata);	
		}
		$this->session->sess_destroy();
		redirect('/auth/signin/');
	}
	
	function course()
	{	
		if ($this->input->post('course') == 0 || $this->input->post('lv') == 0){
			$this->form_validation->set_message('course', "Please select your course and year level.");
			return FALSE;
		}
		else
		{
			$c_id = $this->input->post('course');
			$lv = $this->input->post('lv');
			
			$this->db->where('C_ID', $c_id);
			$query = $this->db->get('COURSE');		
			$row = $query->row();
			
			$max = $row->MAX_YEAR;
			
			if($lv > $max)
			{
				$this->form_validation->set_message('course', "Invalid year level.");
				return false;
			}
			else
			{
				return true;
			}
		}
	}
	
	function bdate()
	{
		if ($this->input->post('month') == 0 || $this->input->post('day') == 0 || $this->input->post('year') == 0)
		{
			$this->form_validation->set_message('bdate', "Please provide your birth date.");
			return FALSE;
		}
		else
		{
			if (checkdate($this->input->post('month'), $this->input->post('day'), $this->input->post('year')))
			{
				$month = $this->input->post('month');
				$day = $this->input->post('day');
				$year = $this->input->post('year');
				
				$bdate =  "$year-$month-$day";
				$today = date('Y-n-j');
				
				$diff = abs(strtotime($today) - strtotime($bdate));
				$diff = floor($diff / (365*60*60*24));
				if($diff < 15)
				{
					$this->form_validation->set_message('bdate', "Must be atleast 15 years old to register.");
					return false;
				}
				else
				{
					return true;
				}
				
				return true;
			}
			else
			{
				$this->form_validation->set_message('bdate', "Please provide a valid date.");
				return false;
			}
		}
	}
	
	function terms()
	{	
		if ($this->input->post('terms') == FALSE){
			$this->form_validation->set_message('terms', "You must agree to terms.");
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	function ismis()
	{
		$id_number = $this->input->post('id_number');
		
		if ($this->sys->ismis($id_number) == true){
			$this->form_validation->set_message('ismis', "This student is already in the dormitory.");
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
}
?>
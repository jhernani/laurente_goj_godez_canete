<?php
class Settings extends CI_Controller {	

	public function password()
	{
		$pword = $this->input->post('pword');
		$newpword = $this->input->post('newpword');
		$newpwordconf = $this->input->post('newpwordconf');	
		
		if($newpword == $newpwordconf){
			$u_id = $this->session->userdata('u_id');
		
			$this->db->where('ACC_ID', $u_id);	
			$query = $this->db->get('ACCOUNT');
			
			if($query->num_rows()){
				foreach($query->result() as $row){
					$db_salt = $row->SALT;
					$db_pword = $row->PWORD;
				}
				
				$pword = "$pword$db_salt";
				$pword = md5($pword);
				
				if($pword == $db_pword){
					$newpword = "$newpword$db_salt";
					$newpword = md5($newpword);
					
					$data = array(
								'PWORD' => $newpword
								);
	
					$this->db->where('ACC_ID', $u_id);
					$this->db->update('ACCOUNT', $data); 				
					echo "<span class='label label-success'>Password has been changed.</span>";
				}
				else{
					echo "<span class='label label-danger'>Incorrect password.</span>";
				}
			}
		}
		else{
			echo "<span class='label label-danger'>Passwords do not match.</span>";	
		}	
	}
	
	public function username(){
		$uname = $this->input->post('uname');
		$pword = $this->input->post('pword');	
		
		$this->db->where('UNAME', $uname);
		$query = $this->db->get('ACCOUNT');
		
		$inuse = $query->num_rows();
		
		if($inuse){
			echo "<span class='label label-danger'>Username is already in use.</span>";
		}
		else{
			$u_id = $this->session->userdata('u_id');
		
			$this->db->where('ACC_ID', $u_id);	
			$query = $this->db->get('ACCOUNT');
			
			if($query->num_rows()){
				foreach($query->result() as $row){
					$db_salt = $row->SALT;
					$db_pword = $row->PWORD;
				}
				
				$pword = "$pword$db_salt";
				$pword = md5($pword);
				
				if($pword == $db_pword){			
					$data = array(
							'UNAME' => $uname);
	
					$this->db->where('ACC_ID', $u_id);
					$this->db->update('ACCOUNT', $data); 				
					echo "<span class='label label-success'>Username has been set.</span>";
				}
				else{
					echo "<span class='label label-danger'>Incorrect password.</span>";
				}
			}
		}	
	}
	
	public function name(){
		$fname = $this->input->post('fname');
		$mname = $this->input->post('mname');
		$lname = $this->input->post('lname');
		$pword = $this->input->post('pword');	

		$fullname = "$fname$mname$lname";
		
		$this->load->library('form_validation');
		$valid = $this->form_validation->alpha($fullname);
		if(!$valid){
			echo "<span class='label label-danger'>Can only contain alphabetical characters.</span>";
			return;
		}
		
		$fname = ucfirst($fname);
		$mname = ucfirst($mname);
		$lname = ucfirst($lname);
		
		$u_id = $this->session->userdata('u_id');
		
		$this->db->where('ACC_ID', $u_id);	
		$query = $this->db->get('ACCOUNT');
		
		if($query->num_rows()){
			foreach($query->result() as $row){
				$db_salt = $row->SALT;
				$db_pword = $row->PWORD;
			}
			
			$pword = "$pword$db_salt";
			$pword = md5($pword);
			
			if($pword == $db_pword){			
				$data = array(
               				'FNAME' => $fname,
							'MNAME' => $mname,
							'LNAME' => $lname
            				);

				$this->db->where('INFO_ID', $u_id);
				$this->db->update('INFO', $data); 				
				echo "<span class='label label-success'>Name has been updated.</span>";
			}
			else{
				echo "<span class='label label-danger'>Incorrect password.</span>";
			}
		}	
	}
	
	public function bdate(){
		$month = $this->input->post('month');
		$day = $this->input->post('day');
		$year = $this->input->post('year');
		$pword = $this->input->post('pword');	
	
		$u_id = $this->session->userdata('u_id');
		
		$this->db->where('ACC_ID', $u_id);	
		$query = $this->db->get('ACCOUNT');
		
		if($query->num_rows()){
			foreach($query->result() as $row){
				$db_salt = $row->SALT;
				$db_pword = $row->PWORD;
			}
			
			$pword = "$pword$db_salt";
			$pword = md5($pword);
			
			if($pword == $db_pword){
				$bdate = "$year-$month-$day";		
				$data = array(
               				'BDATE' => $bdate,
            				);

				$this->db->where('INFO_ID', $u_id);
				$this->db->update('INFO', $data); 				
				echo "<span class='label label-success'>Birth date has been updated.</span>";
			}
			else{
				echo "<span class='label label-danger'>Incorrect password.</span>";
			}
		}	
	}
	
	public function gfullname(){
		$fname = $this->input->post('fname');
		$mname = $this->input->post('mname');
		$lname = $this->input->post('lname');
		$pword = $this->input->post('pword');	
		
		$fname = ucfirst($fname);
		$mname = ucfirst($mname);
		$lname = ucfirst($lname);
		
		$u_id = $this->session->userdata('u_id');
		
		$this->db->where('ACC_ID', $u_id);	
		$query = $this->db->get('ACCOUNT');
		
		if($query->num_rows()){
			foreach($query->result() as $row){
				$db_salt = $row->SALT;
				$db_pword = $row->PWORD;
			}
			
			$pword = "$pword$db_salt";
			$pword = md5($pword);
			
			if($pword == $db_pword){			
				$data = array(
               				'G_FNAME' => $fname,
							'G_MNAME' => $mname,
							'G_LNAME' => $lname
            				);

				$this->db->where('INFO_ID', $u_id);
				$this->db->update('INFO', $data); 				
				echo "<span class='label label-success'>Guardian's name has been updated.</span>";
			}
			else{
				echo "<span class='label label-danger'>Incorrect password.</span>";
			}
		}	
	}
	
	public function emailadd(){
		$email = $this->input->post('email');
		$pword = $this->input->post('pword');
		
		$this->load->library('form_validation');			
		$valid = $this->form_validation->valid_email($email);		
		if(!$valid)
		{
			echo "<span class='label label-danger'>Please provide a valid email address.</span>";
			return;
		}
			
		$this->db->where('EMAIL', $email);
		$query = $this->db->get('ACCOUNT');		
		$inuse = $query->num_rows();
		
		if($inuse){
			echo "<span class='label label-danger'>Email is already in use. </span>";
		}
		else{
			$u_id = $this->session->userdata('u_id');

			$this->db->where('ACC_ID', $u_id);	
			$query = $this->db->get('ACCOUNT');
			
			if($query->num_rows()){
				foreach($query->result() as $row){
					$db_salt = $row->SALT;
					$db_pword = $row->PWORD;
				}
				
				$pword = "$pword$db_salt";
				$pword = md5($pword);
				
				if($pword == $db_pword){			
					$data = array(
								'EMAIL' => $email,
								);
	
					$this->db->where('ACC_ID', $u_id);
					$this->db->update('ACCOUNT', $data); 				
					echo "<span class='label label-success'>E-mail address has been updated.</span>";
				}
				else{
					echo "<span class='label label-danger'>Incorrect password.</span>";
				}
			}
		}
	}
	
	public function contact()
	{
		$contact = $this->input->post('contact');
		$pword = $this->input->post('pword');
		
		$this->load->library('form_validation');			
		$valid = $this->form_validation->is_natural($contact);		
		if(!$valid)
		{
			echo "<span class='label label-danger'>Can only contain numeric characters</span>";
			return;
		}
			
		$u_id = $this->session->userdata('u_id');
		$this->db->where('ACC_ID', $u_id);	
		$query = $this->db->get('ACCOUNT');
		
		if($query->num_rows())
		{
			foreach($query->result() as $row)
			{
				$db_salt = $row->SALT;
				$db_pword = $row->PWORD;
				
				$pword = "$pword$db_salt";
				$pword = md5($pword);
				
				if($pword == $db_pword)
				{			
					$data = array(
						'CONTACT' => $contact);

					$this->db->where('ACC_ID', $u_id);
					$this->db->update('ACCOUNT', $data); 				
					echo "<span class='label label-success'>Contact number has been updated.</span>";
				}
				else
				{
					echo "<span class='label label-danger'>Incorrect password.</span>";
				}
			}
		}
	}
	
	public function privacy()
	{
		$u_id = $this->session->userdata('u_id');
		$var = $this->input->post('var');
		$var = strtoupper($var);
		
		$this->db->where('ACC_ID', $u_id);
		$query = $this->db->get('PRIVACY');
		
		$row = $query->row();
		
		$status = $row->$var;
		
		if($status == '0')
		{
			$data = array($var => '1');
			$this->db->where('ACC_ID', $u_id);
			$this->db->update('PRIVACY', $data);
		}
		else
		{
			$data = array($var => '0');
			$this->db->where('ACC_ID', $u_id);
			$this->db->update('PRIVACY', $data);
		}
		
		redirect('/user/privacy');
	}
}
?>
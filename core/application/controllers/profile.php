<?php
class Profile extends CI_Controller {	
	function __construct(){
		parent::__construct();
		$this->load->model('sys');
		date_default_timezone_set('Asia/Manila');
	}
	
	public function view($u_id = null)
	{
		$data['title'] = "Profile";
		$u_id = $this->uri->segment(3);
		$query = $this->sys->user_details($u_id);
		
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
			   $data['name'] = $row->FNAME  . " " . $row->MNAME . " " . $row->LNAME;
			   $data['email'] = $row->EMAIL;
			   $data['bdate'] = date('F d, Y', strtotime($row->BDATE));
			   $data['path'] = $row->IMAGE_PATH;
			   $data['start_date'] = date('F d, Y', strtotime($row->START_DATE));
			   $yr_lvl = $row->YEAR;
			   $gender = $row->GENDER;
			   $c_id = $row->C_ID;
			   $room_id = $row->ROOM;
			   
			   if($gender == 'M') 
				$data['gender'] = "Male"; 
			   else 
				$data['gender'] = "Female";
			}
			
			if(empty($data['path']))
			{
				$data['path'] = "profiles/profile-default.png";
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
			
			$query = $this->sys->room_details($room_id);
			foreach ($query->result() as $row)
			{
				$data['room'] = $row->BLG_NAME . " Room " . $row->ROOM_NO;
			}
			
			$query = $this->sys->get_privacy($u_id);
		
			$privacy = $query->row();
			$data['p_course'] = $privacy->COURSE;
			$data['p_bdate'] = $privacy->BDATE;
			$data['p_gender'] = $privacy->GENDER;
			$data['p_email'] = $privacy->EMAIL;
			
			$this->load->view('templates/m_head', $data);
			$this->load->view('templates/m_nav');
			$this->load->view('pages/profile', $data);
			$this->load->view('templates/foot');
		}
		else
		{
			echo "Not found";
		}
	}
}
?>
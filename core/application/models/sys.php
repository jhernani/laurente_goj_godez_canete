<?php
class Sys extends CI_Model{
	function __construct(){
        parent::__construct();
		date_default_timezone_set('Asia/Manila');
    }
	
	function user_details($u_id){		
		$this->db->select('*');
		$this->db->from('INFO');
		$this->db->where('INFO_ID', $u_id);
		$this->db->join('ACCOUNT', 'INFO.INFO_ID = ACCOUNT.ACC_ID');	
		$query = $this->db->get();
			
		return $query;
	}
	
	function reservation_details($u_id){		
		$this->db->where('ACC', $u_id);
		$this->db->join('ROOM', 'ROOM.ROOM_ID = RESERVATION.ROOM');	
		$query = $this->db->get('RESERVATION');
			
		return $query;
	}
	
	function room_details($room){
		$this->db->where('ROOM_ID', $room);
		$query = $this->db->get('ROOM');
		
		return $query;	
	}
	
	function search_room($offset, $per_page, $blg)
	{
		$gen = $this->session->userdata('u_gen');
		
		$this->db->select("ROOM_ID, BLG_ID, BLG_NAME, ROOM_NO, TYPE, RESERVED, POPULATION, GENDER, CAP, (POPULATION + RESERVED) AS TOTAL");		
		$this->db->where('BLG_ID', $blg);
		$this->db->having('TOTAL <', '6');
		$this->db->where('GENDER', $gen);
		$this->db->limit($per_page, $offset);
		$this->db->order_by('ROOM_ID','asc');		
		$query = $this->db->get('ROOM');
		
		return $query;
	}
	
	function search_room_count($blg)
	{
		$gen = $this->session->userdata('u_gen');
		
		$this->db->select("ROOM_ID, BLG_ID, BLG_NAME, ROOM_NO, TYPE, RESERVED, POPULATION, GENDER, CAP, (POPULATION + RESERVED) AS TOTAL");		
		$this->db->where('BLG_ID', $blg);
		$this->db->having('TOTAL <', '6');
		$this->db->where('GENDER', $gen);
		$this->db->order_by('ROOM_ID','asc');		
		$query = $this->db->get('ROOM');

		return $query->num_rows();
	}
	
	function get_reservation_list($offset, $per_page, $blg, $status, $key)
	{	
		$this->db->join('INFO', 'INFO.INFO_ID = RESERVATION.ACC');
		$this->db->join('ACCOUNT', 'INFO.INFO_ID = ACCOUNT.ACC_ID');
		$this->db->join('ROOM', 'ROOM.ROOM_ID = RESERVATION.ROOM');
		$this->db->like("CONCAT(FNAME, ' ', LNAME, ' ', INFO_ID)", $key);
		$this->db->limit($per_page, $offset);
		$this->db->order_by("RESERVE_DATE", "DESC");
		
		if($blg > 0)
		{
			$this->db->where('BLG_ID', $blg);
		}
		
		if($status != 4)
		{
			$this->db->where('RESERVATION.RESERVE_STATUS', $status);
		}
		
		$query = $this->db->get('RESERVATION');	
		return $query;	
	}
	
	function get_reservation_count($blg, $status, $key)
	{		
		$this->db->join('INFO', 'INFO.INFO_ID = RESERVATION.ACC');
		$this->db->join('ACCOUNT', 'INFO.INFO_ID = ACCOUNT.ACC_ID');
		$this->db->join('ROOM', 'ACCOUNT.ROOM = ROOM.ROOM_ID');
		$this->db->like("CONCAT(FNAME, ' ', LNAME, ' ', INFO_ID)", $key);
		
		if($blg > 0)
		{
			$this->db->where('BLG_ID', $blg);
		}
		
		if($status != 4)
		{
			$this->db->where('RESERVATION.RESERVE_STATUS', $status);
		}
		
		$query = $this->db->get('RESERVATION');			
		return $query->num_rows();	
	}
	
	function get_course_abbr($c_id)
	{
		$this->db->where('C_ID', $c_id);
		$query = $this->db->get('COURSE');
		
		foreach($query->result() as $row){
			$c_name = $row->C_ABBR;	
		}
		return $c_name;
	}
	
	function get_course($c_id)
	{
		$this->db->where('C_ID', $c_id);
		$query = $this->db->get('COURSE');
		
		foreach($query->result() as $row){
			$c_name = $row->C_NAME;	
		}
		return $c_name;
	}
	
	function get_admin_list()
	{
		$this->db->select('*');
		$this->db->from('ACCOUNT');
		$this->db->WHERE('ACC_TYPE', '1');
		$this->db->join('INFO', 'INFO.INFO_ID = ACCOUNT.ACC_ID');
		$query = $this->db->get();
		
		return $query;
	}
	
	function get_logs($admin, $type)
	{
		if($admin != "All")
		{
			$this->db->where('USER', $admin);
		}
		if($type != "All")
		{
			$this->db->where('ACTV', $type);
		}
		
		$this->db->join('INFO', 'LOG.USER = INFO.INFO_ID');
		$this->db->order_by('ACTV_DATE', 'DESC');
		$query = $this->db->get('LOG');

		return $query;	
	}
	
	function get_log_type()
	{
		$this->db->select('ACTV');
		$this->db->distinct();
		$query = $this->db->get('LOG');
		
		return $query;
	}
	
	function generate_id(){
		$year = date('Y') % 1000;
		$digits = date('mdH');
		$generate = "$year$digits";
	
		do{		
		$this->db->where('INFO_ID', $generate);	
		$result = $this->db->get('INFO');	
	
		$invalid = $result->num_rows();
		if($invalid)
			$generate++;
		}while($invalid);
		
		return $generate;
	}
	
	function check_reservation()
	{
		$u_id = $this->session->userdata('u_id');
		$this->db->where('ACC', $u_id);
		$query = $this->db->get('RESERVATION');
		
		if($query->num_rows())
			return	TRUE;
		else
			return FALSE;
	}
	
	function check_for_room(){
		$u_id = $this->session->userdata('u_id');
		$this->db->select('ROOM');
		$this->db->where('ACC_ID', $u_id);
		$query = $this->db->get('ACCOUNT');
		
		foreach ($query->result() as $row){
			$found = $row->ROOM;
		}	
		if($found)
			return TRUE;
		else
			return FALSE;
	}
	
	function insert_log($data){
		$this->db->insert('LOG', $data);
	}
	
	function reserve_deny($u_id)
	{				
		$this->db->set('RESERVE_STATUS', '2');
		$this->db->where('ACC', $u_id);
		$this->db->update('RESERVATION');
	}
	
	function reserve_accept($u_id, $room_id)
	{
		$start_date = date('Y-n-j');
	
		$this->db->set('ROOM', $room_id);
		$this->db->set('START_DATE', $start_date);
		$this->db->where('ACC_ID', $u_id);
		$this->db->update('ACCOUNT');
		
		$this->db->set('POPULATION', 'POPULATION + 1', FALSE);
		$this->db->where('ROOM_ID', $room_id);
		$this->db->update('ROOM');
		
		$this->db->set('RESERVED', 'RESERVED - 1', FALSE);
		$this->db->where('ROOM_ID', $room_id);
		$this->db->update('ROOM');
		
		$this->db->where('ACC', $u_id);
		$this->db->delete('RESERVATION');
		
		$query = $this->room_details($room_id);
		
		foreach($query->result() as $row)
		{
			$type = $row->TYPE;
			$cap = $row->CAP;
			$id = null;
			if($type == '0')
			{
				switch($cap)
				{
					case '1': $id = $this->get_fee_id('Standard Room for 1');
							break;
					case '2': $id = $this->get_fee_id('Standard Room for 2');
							break;
					case '4': $id = $this->get_fee_id('Standard Room for 4');
							break;
					case '6': $id = $this->get_fee_id('Standard Room for 6');
							break;
				}
			}
			else
			{
				switch($cap)
				{
					case '1': $id = $this->get_fee_id('Premium Room for 1');
							break;
					case '2': $id = $this->get_fee_id('Premium Room for 2');
							break;
					case '4': $id = $this->get_fee_id('Premium Room for 4');
							break;
					case '6': $id = $this->get_fee_id('Premium Room for 6');
							break;
				}
			}
			
			$due_date = date('Y-n-j', strtotime('+30 days'));		
			$data = array(
					'FEE_ID' => $id,
					'ACC' => $u_id,
					'DUE_DATE' => $due_date);
			$this->db->insert('PAYABLE', $data);
			
			$due = array(
					'ACC_ID' => $u_id,
					'DUE_START' => $start_date,
					'DUE_DATE' => $due_date);
					
			$this->db->insert('DUE', $due);			
		}
	}
		
	function get_fee_id($name)
	{
		$this->db->where('FEE_NAME', $name);
		$this->db->where('ACTIVE', '1');
		$query = $this->db->get('FEE');
		
		$id = null;
		foreach($query->result() as $row)
		{
			$id = $row->FEE_ID;
		}
		return $id;
	}
	
	function status_check(){
		$u_id = $this->session->userdata('u_id');
		$data['has_room'] = $this->check_for_room($u_id);
		$data['has_reservation'] = $this->check_reservation($u_id);
		
		return $data;
	}
	
	function get_due_total($u_id, $due)
	{
		$this->db->select_sum('VALUE');
		$this->db->where('ACC', $u_id);
		$this->db->where('PAYABLE.DUE_DATE', $due);
		$this->db->join('FEE', 'FEE.FEE_ID = PAYABLE.FEE_ID');
		$query = $this->db->get('PAYABLE');
		$row = $query->row();
		
		return $row->VALUE;
	}
	
	function get_over_due($u_id)
	{
		$this->db->where('ACC_ID', $u_id);
		$this->db->where('DUE_STATUS', '2');
		$query = $this->db->get('DUE');
		
		return $query;
	}
	
	function get_roommates($room_id){
		$this->db->where('ROOM', $room_id);
		$this->db->join('ACCOUNT', 'ACCOUNT.ROOM = ROOM.ROOM_ID');
		$this->db->join('INFO', 'ACCOUNT.ACC_ID = INFO.INFO_ID');
		$query = $this->db->get('ROOM');
		
		return $query;
	}
	
	function get_fee()
	{
		$this->db->order_by('FEE_NAME', 'ASC');
		$query = $this->db->get('FEE');
		
		return $query;
	}
	
	function get_active_fee()
	{
		$this->db->where('ACTIVE', '1');
		$query = $this->db->get('FEE');
		
		return $query;
	}
	
	function get_active_fees()
	{
		$this->db->not_like('FEE_NAME', 'Room');
		$this->db->where('ACTIVE', '1');
		$query = $this->db->get('FEE');
		
		return $query;
	}
	
	function get_user_fee($u_id, $due_date)
	{
		$this->db->where('ACC', $u_id);
		$this->db->where('DUE_DATE', $due_date);
		$query = $this->db->get('PAYABLE');
		
		return $query;
	}
	
	function insert_payable($fee, $id)
	{
		$data = $this->sys->get_current_due($id);
		
		$this->db->where('FEE_ID', $fee);
		$this->db->where('ACC', $id);
		$this->db->where('DUE_DATE', $data['end']);
		$query = $this->db->get('PAYABLE');
		
		if($query->num_rows() == 0)
		{
			$data = array(
				'FEE_ID' => $fee,
				'ACC' => $id,
				'DUE_DATE' => $data['end']);
			
			$this->db->insert('PAYABLE', $data);
		}
	}
	
	function delete_payable($fee, $id)
	{
		$data = $this->sys->get_current_due($id);
		
		$this->db->where('FEE_ID', $fee);
		$this->db->where('ACC', $id);
		$this->db->where('DUE_DATE', $data['end']);
		$query = $this->db->delete('PAYABLE');
	}
	
	function get_payable($u_id, $due_date)
	{
		$this->db->where('ACC', $u_id);
		$this->db->where('DUE_DATE', $due_date);
		$this->db->join('FEE', 'FEE.FEE_ID = PAYABLE.FEE_ID');
		$query = $this->db->get('PAYABLE');
		
		return $query;
	}
	
	function toggle_fee($id)
	{
		$this->db->where('FEE_ID', $id);
		$query = $this->db->get('FEE');
		
		foreach($query->result() as $row)
		{
			$status = $row->ACTIVE;
		}
		
		if($status == '0')
		{
			$data = array('ACTIVE' => '1');
			$this->db->where('FEE_ID', $id);
			$this->db->update('FEE', $data);
		}
		else
		{
			$data = array('ACTIVE' => '0');
			$this->db->where('FEE_ID', $id);
			$this->db->update('FEE', $data);
		}	
	}
	
	function get_user_print($start, $end, $blg, $course, $gender, $status, $key)
	{
		$this->db->like("CONCAT(FNAME, ' ', LNAME, ' ', ISMIS_ID)", $key);
		$this->db->join('ACCOUNT', 'INFO.INFO_ID = ACCOUNT.ACC_ID');
		$this->db->join('ROOM', 'ACCOUNT.ROOM = ROOM.ROOM_ID');
		$this->db->join('COURSE', 'COURSE.C_ID = INFO.C_ID');
		$this->db->order_by('LNAME');
		
		if($start != "")
		{
			$this->db->where('START_DATE >=', $start);
		}
		if($end != "")
		{
			$this->db->where('END_DATE <=', $end);
			$this->db->or_where('END_DATE', '000-00-00');
		}
		
		if($blg > 0)
		{
			$this->db->where('BLG_ID', $blg);
		}
		
		if($course > 0)
		{
			$this->db->where('INFO.C_ID', $course);
		}
		
		if($gender != "")
		{
			$this->db->where('INFO.GENDER', $gender);
		}
		
		if($status != 2)
		{
			$this->db->where('STATUS', $status);
		}

		return $this->db->get('INFO');
	}
	
	function get_user($start, $end, $blg, $course, $gender, $status, $key, $offset, $per_page)
	{
		$this->db->like("CONCAT(FNAME, ' ', LNAME, ' ', ISMIS_ID)", $key);
		$this->db->join('ACCOUNT', 'INFO.INFO_ID = ACCOUNT.ACC_ID');
		$this->db->join('ROOM', 'ACCOUNT.ROOM = ROOM.ROOM_ID');
		$this->db->join('COURSE', 'COURSE.C_ID = INFO.C_ID');
		$this->db->limit($per_page, $offset);
		$this->db->order_by('LNAME');
		
		if($start != "")
		{
			$this->db->where('START_DATE >=', $start);
		}
		if($end != "")
		{
			$this->db->where('END_DATE <=', $end);
			$this->db->or_where('END_DATE', '000-00-00');
		}
		
		if($blg > 0)
		{
			$this->db->where('BLG_ID', $blg);
		}
		
		if($course > 0)
		{
			$this->db->where('INFO.C_ID', $course);
		}
		
		if($gender != "")
		{
			$this->db->where('INFO.GENDER', $gender);
		}
		
		if($status != 2)
		{
			$this->db->where('STATUS', $status);
		}
		return $this->db->get('INFO');
	}
	
	function get_user_count($start, $end, $blg, $course, $gender, $status, $key)
	{
		$this->db->like("CONCAT(FNAME, ' ', LNAME, ' ', ISMIS_ID)", $key);
		$this->db->join('ACCOUNT', 'INFO.INFO_ID = ACCOUNT.ACC_ID');
		$this->db->join('ROOM', 'ACCOUNT.ROOM = ROOM.ROOM_ID');
		$this->db->join('COURSE', 'COURSE.C_ID = INFO.C_ID');
		$this->db->order_by('LNAME');
		
		if($start != "")
		{
			$this->db->where('START_DATE >=', $start);
		}
		if($end != "")
		{
			$this->db->where('END_DATE <=', $end);
			$this->db->or_where('END_DATE', '000-00-00');
		}
		
		if($blg > 0)
		{
			$this->db->where('BLG_ID', $blg);
		}
		
		if($course > 0)
		{
			$this->db->where('INFO.C_ID', $course);
		}
		
		if($gender != "")
		{
			$this->db->where('INFO.GENDER', $gender);
		}
		
		if($status != 2)
		{
			$this->db->where('STATUS', $status);
		}

		$query =  $this->db->get('INFO');
		
		return $query->num_rows();
	}
	
	
	function get_accounts($start, $end, $blg, $course, $gender, $key)
	{
		$this->db->like("CONCAT(FNAME, ' ', LNAME, ' ', ISMIS_ID)", $key);
		$this->db->join('INFO', 'TRANSACTION.ACC_ID = INFO.INFO_ID');
		$this->db->join('ACCOUNT', 'ACCOUNT.ACC_ID = INFO.INFO_ID');
		$this->db->select('DISTINCT(TRANSACTION.ACC_ID)');
		$this->db->order_by('LNAME');
		
		if($start != "")
		{
			$this->db->where('TRANSACTION.TRANS_DATE >=', $start);
		}
		
		if($end != "")
		{
			$this->db->where('TRANSACTION.TRANS_DATE <=', $end);
		}
		
		if($blg > 0)
		{
			$this->db->where('BLG_ID', $blg);
		}
		
		if($course > 0)
		{
			$this->db->where('INFO.C_ID', $course);
		}
		
		if($gender != "")
		{
			$this->db->where('INFO.GENDER', $gender);
		}
		
		$query = $this->db->get('TRANSACTION');
		return $query;
	}
	
	function get_privacy($u_id)
	{
		$this->db->where('ACC_ID', $u_id);
		$query = $this->db->get('PRIVACY');
		
		return $query;
	}
	
	function ismis($id_number)
	{
		$this->db->where('ISMIS_ID', $id_number);
		$this->db->where('STATUS', '1');
		$query =  $this->db->get('ACCOUNT');
		
		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function get_dues($u_id)
	{
		$this->db->where('ACC_ID', $u_id);
		$this->db->order_by('DUE_DATE', 'DESC');
		$query = $this->db->get('DUE');
	
		return $query;
	}
	
	function get_current_due($u_id)
	{
		$data = array();
		
		$this->db->where('ACC_ID', $u_id);
		$this->db->where("DUE_STATUS = '0'");
		$query = $this->db->get('DUE');
		
		if($query->num_rows() == 0)
		{
			$this->db->where('ACC_ID', $u_id);
			$this->db->order_by('DUE_DATE', 'DESC');
			$this->db->limit('1');
			$query = $this->db->get('DUE');
			$row = $query->row();
			
			$data['start'] = $row->DUE_START;
			$data['end'] = $row->DUE_DATE;
		}
		else
		{
			$row = $query->row();			
			$data['start'] = $row->DUE_START;
			$data['end'] = $row->DUE_DATE;
		}
		
		return $data;
	}
	
	function get_account_status($u_id)
	{
		$this->db->where('ACC_ID', $u_id);
		$query = $this->db->get('ACCOUNT');
		$row = $query->row();
		
		$status = $row->STATUS;
		if($status == '1')
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	function get_all_course()
	{
		$this->db->select('C_ID, C_ABBR');
		$query = $this->db->get('COURSE');
		
		return $query;
	}
	
	function get_buildings()
	{
		$this->db->select('BLG_ID, BLG_NAME');
		$this->db->distinct();
		$query = $this->db->get('ROOM');
		
		return $query;
	}
	
	function due_details($u_id, $due)
	{
		$this->db->where('ACC_ID', $u_id);
		$this->db->where('DUE_DATE', $due);
		$query = $this->db->get('DUE');
		
		return $query;
	}
	
	function due_total($u_id, $due)
	{
		$this->db->select_sum('VALUE');
		$this->db->where('ACC', $u_id);
		$this->db->where('PAYABLE.DUE_DATE', $due);
		$this->db->join('FEE', 'FEE.FEE_ID = PAYABLE.FEE_ID');
		$query = $this->db->get('PAYABLE');
		$row = $query->row();
		
		return $row->VALUE;
	}
	
	function monitor_dues()
	{
		$this->db->where('DUE_STATUS', '0');
		$all_dues = $this->db->get('DUE');
		
		foreach($all_dues->result() as $row)
		{
			$u_id = $row->ACC_ID;
			$due_date = $row->DUE_DATE;
			$today = date('Y-n-j');
			
			$new_due_date = date('Y-n-j', strtotime($due_date . "+30days"));
			$new_start_date = date('Y-n-j', strtotime($due_date . "+1days"));
			
			if(strtotime($due_date) < strtotime($today))
			{
				$this->db->where('ACC_ID', $row->ACC_ID);
				$this->db->where('DUE_DATE', $row->DUE_DATE);
				$this->db->set('DUE_STATUS', '2');
				$this->db->update('DUE');
				
				$this->db->where('ACC', $u_id);
				$this->db->where('DUE_DATE', $due_date);
				$payable = $this->db->get('PAYABLE');
				
				foreach($payable->result() as $payable_row)
				{			
					$new_payable_data = array(
								'FEE_ID' => $payable_row->FEE_ID,
								'ACC' => $u_id,
								'DUE_DATE' => $new_due_date);
								
					$this->db->insert('PAYABLE', $new_payable_data);				
				}
				
				$new_due_data = array(
								'ACC_ID' => $u_id,
								'DUE_DATE' => $new_due_date,
								'DUE_START' => $new_start_date);
				
				$this->db->insert('DUE', $new_due_data);	
			}	
		}
	}
	
	function get_amount_total($u_id, $start, $end)
	{
		$this->db->join('FEE', 'FEE.FEE_ID = TRANSACTION.FEE_ID');
		$this->db->where('ACC_ID', $u_id);
		
		if($start != "")
		{
			$this->db->where('TRANS_DATE >=', $start);
		}
		
		if($end != "")
		{
			$this->db->where('TRANS_DATE <=', $end);
		}
		
		$this->db->select_sum('VALUE');
		$query = $this->db->get('TRANSACTION');
		$row = $query->row();
		
		return $row->VALUE;	
	}
	
	function get_room($blg)
	{
		$this->db->where('BLG_ID', $blg);
		$query = $this->db->get('ROOM');
		
		return $query;
	}
	
	function add_room($blg, $type, $cap, $gender)
	{
		$this->db->select('BLG_NAME, MAX(ROOM_NO) AS NUMBER');
		$this->db->where('BLG_ID', $blg);
		$query = $this->db->get('ROOM');
		$row = $query->row();
		
		$room_no = $row->NUMBER + 1;
		$blg_name = $row->BLG_NAME;
		
		$data = array(
				'BLG_ID' => $blg,
				'BLG_NAME' => $blg_name,
				'ROOM_NO' => $room_no,
				'CAP' => $cap,
				'GENDER' => $gender,
				'TYPE' => $type,
				);
		
		$this->db->insert('ROOM', $data);
	}
	
	function monitor_reservation()
	{
		$this->db->where('RESERVE_STATUS', '0');
		$all_reservation = $this->db->get('RESERVATION');
		
		foreach($all_reservation->result() as $row)
		{
			$u_id = $row->ACC;
			$room_id = $row->ROOM;
			$reserve_date = $row->RESERVE_DATE;
			$today = date('Y-n-j');
			
			if(strtotime($reserve_date) < strtotime($today))
			{
				$this->db->where('ACC', $row->ACC);
				$this->db->set('RESERVE_STATUS', '3');
				$this->db->update('RESERVATION');
				
				$this->db->where('ROOM_ID', $room_id);
				$this->db->set('RESERVED', 'RESERVED - 1', FALSE);
				$this->db->update('ROOM');	
			}	
		}
	}
}
?>
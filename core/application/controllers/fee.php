<?php
class Fee extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('sys');	
	}
	
	function toggle_fee()
	{
		$fee_id = $this->input->post('fee_id');
		$this->sys->toggle_fee($fee_id);
		
		redirect('/admin/acctg/settings');		
	}
	
	function pay_due()
	{
		$due_date = $this->input->post('due_date');
		$u_id = $this->input->post('u_id');
		$new_due_date = date('Y-n-j', strtotime($due_date . "+30days"));
		$new_start_date = date('Y-n-j', strtotime($due_date . "+1days"));
		
		$this->db->where('ACC', $u_id);
		$this->db->where('DUE_DATE', $due_date);
		$this->db->set('PAYABLE_STATUS', '1');
		$this->db->update('PAYABLE');
		
		$account_status = $this->sys->get_account_status($u_id);
		
		if($account_status == true)
		{			
			$due_detail = $this->sys->due_details($u_id, $due_date);
			$row = $due_detail->row();
			
			if($row->DUE_STATUS == '0')
			{
				$new_due_data = array(
								'ACC_ID' => $u_id,
								'DUE_DATE' => $new_due_date,
								'DUE_START' => $new_start_date);
				
				$this->db->insert('DUE', $new_due_data);
				
				$this->db->where('ACC', $u_id);
				$this->db->where('DUE_DATE', $due_date);
				$payable = $this->db->get('PAYABLE');
			
				foreach($payable->result() as $payable_row)
				{
					$trans_data = array(
								'TRANS_DATE' => date('Y-n-j'),
								'FEE_ID' => $payable_row->FEE_ID,
								'ACC_ID' => $payable_row->ACC);
								
					$new_payable_data = array(
								'FEE_ID' => $payable_row->FEE_ID,
								'ACC' => $u_id,
								'DUE_DATE' => $new_due_date);
								
					$this->db->insert('TRANSACTION', $trans_data);
					$this->db->insert('PAYABLE', $new_payable_data);				
				}
			}
			else
			{
				$this->db->where('ACC', $u_id);
				$this->db->where('DUE_DATE', $due_date);
				$payable = $this->db->get('PAYABLE');
			
				foreach($payable->result() as $payable_row)
				{
					$trans_data = array(
								'TRANS_DATE' => date('Y-n-j'),
								'FEE_ID' => $payable_row->FEE_ID,
								'ACC_ID' => $payable_row->ACC);
								
					$this->db->insert('TRANSACTION', $trans_data);				
				}
			}
		}
		
		$this->db->where('ACC_ID', $u_id);
		$this->db->where('DUE_DATE', $due_date);
		$this->db->set('DUE_STATUS', '1');
		$this->db->update('DUE');
		
		redirect('/admin/acctg/payment/' . $u_id);
	}
	
	public function history()
	{
		$data['title'] = "History";
		$due = $this->input->post('due_date');
		$u_id = $this->input->post('u_id');
		$query = $this->sys->user_details($u_id);
		
		$row = $query->row();
		$data['name'] = $row->FNAME  . " " . $row->MNAME . " " . $row->LNAME;
		$data['path'] = $row->IMAGE_PATH;
		$data['ismis_id'] = $row->ISMIS_ID;
		
		if(empty($data['path']))
		{
			$data['path'] = "profiles/profile-default.png";
		}
		
		$due_query = $this->sys->due_details($u_id, $due);
		
		$due_row = $due_query->row();
		$data['start'] = $due_row->DUE_START;
		$data['end'] = $due_row->DUE_DATE;
		
		$data['total'] = $this->sys->due_total($u_id, $due);	
		$data['fee'] = $this->sys->get_payable($u_id, $due);
		
		$this->load->view('templates/m_head', $data);
		$this->load->view('templates/m_nav');
		$this->load->view('pages/history', $data);
		$this->load->view('templates/foot');		
	}
}
?>
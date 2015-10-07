<?php
class Reservation extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('sys');	
	}
	public function reserve(){
		$room_id = $this->input->post('room_id');
						
		$data = array(
				'ROOM' => $room_id,
				'RESERVE_DATE' => date('Y-n-j H:i'),
				'ACC' => $this->session->userdata('u_id'));				
				
		$this->db->insert('RESERVATION', $data);

		$this->db->set('RESERVED', 'RESERVED + 1', FALSE);
		$this->db->where('ROOM_ID', $room_id);
		$this->db->update('ROOM');				
			
		redirect('dorm/myreservation');
	}

	public function manage_reservation(){
		$u_id = $this->input->post('u_id');
		$room_id = $this->input->post('room_id');
		$act = $this->input->post('act');
		
		switch($act){
			case 1: $this->sys->reserve_deny($u_id);
					redirect('/admin/supv/reservation');
					break;
			case 2: $this->sys->reserve_accept($u_id, $room_id);
					redirect("/admin/supv/info/" . $u_id);
					break;			
		}
	}
	
	function cancel_reservation(){
		$u_id = $this->session->userdata('u_id');
		$room_id = $this->input->post('room_id');
		
		$this->db->where('ACC', $u_id);
		$this->db->delete('RESERVATION');
		
		$update = array('RESERVED' => 'RESERVED - 1');
		$this->db->where('ROOM_ID', $room_id);
		$this->db->update('ROOM', $update);
		redirect('/dorm');
	}
}
?>
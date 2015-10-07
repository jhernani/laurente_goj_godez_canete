<?php
	if($this->session->userdata('signin') == true)
	{
		if($this->session->userdata('u_type') == '0')
		{
			redirect('/user/profile');
		}
		else
		{
			$a_type = $this->session->userdata('a_type');
			
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
	}
?>
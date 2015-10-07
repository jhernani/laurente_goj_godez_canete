<?php
	if($this->session->userdata('signin') == true && $this->session->userdata('a_type') == '1')
	{
	
	}
	else
	{
		redirect('/auth/signin');
	}
?>
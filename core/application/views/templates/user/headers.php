<?php
	if($this->session->userdata('signin') == true && $this->session->userdata('u_type') == '0')
	{
	
	}
	else
	{
		redirect('/auth/signin');
	}
?>
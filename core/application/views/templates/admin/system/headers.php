<?php
	if($this->session->userdata('signin') == true && $this->session->userdata('a_type') == '3')
	{
	
	}
	else
	{
		redirect('/auth/signin');
	}
?>
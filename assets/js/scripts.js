$(document).ready(function(){
	$('#acc-tab').click(function(){
		$('#acc').toggleClass('hide', '');
	})
	$('#contact-tab').click(function(){
		$('#contact').toggleClass('hide', '');
	})
	$('#pass-tab').click(function(){
		$('#pass').toggleClass('hide', '');
	})
	$('#username-edit').click(function(){
		$('#username-form').toggleClass('hide', '');
	})	
	$('#pass-edit').click(function(){
		$('#pass-form').toggleClass('hide', '');
	})
	$('#name-edit').click(function(){
		$('#name-form').toggleClass('hide', '');
	})
	$('#email-edit').click(function(){
		$('#email-form').toggleClass('hide', '');
	})
	$('#phone-edit').click(function(){
		$('#phone-form').toggleClass('hide', '');
	})
	$('#address-edit').click(function(){
		$('#address-form').toggleClass('hide', '');
	})
	$('#bdate-edit').click(function(){
		$('#bdate-form').toggleClass('hide', '');
	})
	$('#gname-edit').click(function(){
		$('#gname-form').toggleClass('hide', '');
	})
	$('#gender-edit').click(function(){
		$('#gender-form').toggleClass('hide', '');
	})
	$('#fees-panel-button').click(function(){
		$('#fees-panel').toggleClass('hide', '');
	})
});
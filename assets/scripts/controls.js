$(document).ready(function(){
	
	$('#login').mouseenter(function(){
		$('#login').removeClass('login-icon');
		$('#login').addClass('login-icon-active');
	});
	
	$('#login').mouseleave(function(){
		$('#login').removeClass('login-icon-active');
		$('#login').addClass('login-icon');
	});
	
	$('#reg').mouseenter(function(){
		$('#reg').removeClass('register-icon');
		$('#reg').addClass('register-icon-active');
	});
	
	$('#reg').mouseleave(function(){
		$('#reg').removeClass('register-icon-active');
		$('#reg').addClass('register-icon');
	});
	
	$('#about').mouseenter(function(){
		$('#about').removeClass('about-icon');
		$('#about').addClass('about-icon-active');
	});
	
	$('#about').mouseleave(function(){
		$('#about').removeClass('about-icon-active');
		$('#about').addClass('about-icon');
	});
	
});
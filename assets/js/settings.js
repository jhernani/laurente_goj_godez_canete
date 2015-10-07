function password(){
	var pword = document.getElementById("pword_form_pword").value;
	var newpword = document.getElementById("pword_form_newpword").value;
	var newpwordconf = document.getElementById("pword_form_newpwordconf").value;
	
	var xmlhttp;
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}
	else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("pword_form_result").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST","/index.php/settings/password",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("pword="+pword+"&newpword="+newpword+"&newpwordconf="+newpwordconf);
	xmlhttp.send();
}

function username(){
	var uname = document.getElementById("username_form_user").value;
	var pword = document.getElementById("username_form_pword").value;
	
	var xmlhttp;
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}
	else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("username_form_result").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST","/index.php/settings/username",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("uname="+uname+"&pword="+pword);
	xmlhttp.send();
}

function fullname(){
	var fname = document.getElementById("name_form_fname").value;
	var mname = document.getElementById("name_form_mname").value;
	var lname = document.getElementById("name_form_lname").value;
	var pword = document.getElementById("name_form_pword").value;
	
	var xmlhttp;
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}
	else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("name_form_result").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST","/index.php/settings/name",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("fname="+fname+"&mname="+mname+"&lname="+lname+"&pword="+pword);
	xmlhttp.send();
}

function bdate(){
	var month = document.getElementById("bdate_form_month").value;
	var day = document.getElementById("bdate_form_day").value;
	var year = document.getElementById("bdate_form_year").value;
	var pword = document.getElementById("bdate_form_pword").value;
	
	var xmlhttp;
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}
	else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("bdate_form_result").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST","/index.php/settings/bdate",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("month="+month+"&day="+day+"&year="+year+"&pword="+pword);
	xmlhttp.send();
}

function gfullname(){
	var fname = document.getElementById("g_name_form_fname").value;
	var mname = document.getElementById("g_name_form_mname").value;
	var lname = document.getElementById("g_name_form_lname").value;
	var pword = document.getElementById("g_name_form_pword").value;
	
	var xmlhttp;
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}
	else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("g_name_form_result").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST","/index.php/settings/gfullname",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("fname="+fname+"&mname="+mname+"&lname="+lname+"&pword="+pword);
	xmlhttp.send();
}

function emailadd(){
	var email = document.getElementById("email_form_email").value;;
	var pword = document.getElementById("email_form_pword").value;
	
	var xmlhttp;
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}
	else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("email_form_result").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST","/index.php/settings/emailadd",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("email="+email+"&pword="+pword);
	xmlhttp.send();
}

function contact()
{
	alert('asdasd');
	var contact = document.getElementById("contact_form_contact").value;;
	var pword = document.getElementById("contact_form_pword").value;
	
	var xmlhttp;
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}
	else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("contact_form_result").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST","/index.php/settings/contact",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("contact="+contact+"&pword="+pword);
	xmlhttp.send();
}
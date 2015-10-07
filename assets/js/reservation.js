function manage_reservation(){
	var u_id = document.getElementById("act_form_u_id").value;
	var room_id = document.getElementById("act_form_room_id").value;
	var act = document.getElementById("act_form_act").value;

	var xmlhttp;
	if (window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}
	else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("act_form_result").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST","/index.php/reservation/manage_reservation",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("u_id="+u_id+"&room_id="+room_id+"&act="+act);
	xmlhttp.send();
}
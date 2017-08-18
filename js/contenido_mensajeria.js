function load(str)
{
var xmlhttp;
var n=document.getElementById('tipo_servicio').value;

document.getElementById("resultado").innerHTML="";
 document.getElementById("origen1").innerHTML="";
	   document.getElementById("destino1").innerHTML="";
	    document.getElementById("contenido1").innerHTML="";
		 document.getElementById("contenido2").innerHTML="";
		  document.getElementById("contenido3").innerHTML="";
		   document.getElementById("contenido4").innerHTML="";
		    document.getElementById("contenido5").innerHTML="";
			 document.getElementById("contenido6").innerHTML="";
			  document.getElementById("contenido7").innerHTML="";


if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
data = xmlhttp.responseText.split("||");

document.getElementById("origen1").innerHTML = data[0];
document.getElementById("destino1").innerHTML = data[1];
document.getElementById("contenido1").innerHTML = data[2];
document.getElementById("contenido2").innerHTML = data[3];
document.getElementById("contenido3").innerHTML = data[4];
document.getElementById("contenido4").innerHTML = data[5];
document.getElementById("contenido5").innerHTML = data[6];
document.getElementById("contenido6").innerHTML = data[7];
document.getElementById("contenido7").innerHTML = data[8];
}
}
xmlhttp.open("POST","../Logistica/contenido_mensajeria.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("q="+str+"&&"+"a="+n);
}
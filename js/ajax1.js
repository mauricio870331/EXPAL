function loadXMLDoc()
{
var xmlhttp;


var tipo_servicio = document.getElementById("tipo_servicio").value
var contenido = document.getElementById("contenido").value
var origen=document.getElementById("origen").value;

var destino=document.getElementById('destino').value;
var kilos=document.getElementById('kilos').value;

var valor=document.getElementById('valor').value;

var forma_pago=document.getElementById('forma_pago').value;

var campo1 = document.getElementById('tipo_servicio'); //OJO
var campo2 = document.getElementById('contenido');
var campo3 = document.getElementById('origen'); 
var campo4 = document.getElementById('destino');
var campo5 = document.getElementById('kilos');
var campo6 = document.getElementById('valor');
var campo7 = document.getElementById('forma_pago');
 
 if (document.tarifas.contenido.selectedIndex==2){ 
 	
var largo=document.getElementById('largo').value;
var ancho=document.getElementById('ancho').value;
var alto=document.getElementById('alto').value;
var cajas=document.getElementById('cajas').value;

var campo8 = document.getElementById('largo');
var campo9 = document.getElementById('ancho');
var campo10 = document.getElementById('alto');
var campo11 = document.getElementById('cajas');

	if(largo == ''){
	alert("Debe digitar el largo") 
      	 document.tarifas.largo.focus() 
      	 return false; 
    }
	if(isNaN(largo)){
	alert("Digite un valor numerico ejemplo (1.5)") 
      	 document.tarifas.largo.focus() 
      	 return false; 
    }
	 if(ancho == ''){
	alert("Debe digitar el ancho") 
      	 document.tarifas.ancho.focus() 
      	 return false; 
    }
	if(isNaN(ancho)){
	alert("Digite un valor numerico ejemplo (1.5)") 
      	 document.tarifas.ancho.focus() 
      	 return false; 
    }
	 if(alto == ''){
	alert("Debe digitar el alto") 
      	 document.tarifas.alto.focus() 
      	 return false; 
    }
	if(isNaN(alto)){
	alert("Digite un valor numerico ejemplo (1.5)") 
      	 document.tarifas.alto.focus() 
      	 return false; 
    }
	 if(cajas == ''){
	alert("Debe digitar numero de cajas") 
      	 document.tarifas.cajas.focus() 
      	 return false; 
    }
	if(cajas % 1 != 0 || isNaN(cajas)){
	alert("Debe digitar un numero entero ejemplo (5)") 
      	 document.tarifas.cajas.focus() 
      	 return false; 
    }
	
}  
	if (document.tarifas.origen.selectedIndex==0){ 
      	 alert("Debe seleccionar un origen") 
      	 document.tarifas.origen.focus() 
      	 return false; 
   	}  
	if(document.tarifas.destino.selectedIndex==0){
		 alert("Debe seleccionar un destino") 
      	 document.tarifas.destino.focus() 
      	 return false; 
	}
	
    if(kilos == ''){
	alert("Debe digitar el peso") 
      	 document.tarifas.kilos.focus() 
      	 return false; 
    }
	if(isNaN(kilos)){
	alert("Digite un valor numerico ejemplo (1.6)") 
      	 document.tarifas.kilos.focus() 
      	 return false; 
    }
	 if(valor == ''){
	alert("Debe digitar el valor declarado") 
      	 document.tarifas.valor.focus() 
      	 return false; 
    }
	if(isNaN(valor)){
	alert("Digite un valor numerico ejemplo (10000)") 
      	 document.tarifas.valor.focus() 
      	 return false; 
    }
	if (document.tarifas.forma_pago.selectedIndex==0){ 
      	 alert("Debe seleccionar forma de pago") 
      	 document.tarifas.forma_pago.focus() 
      	 return false; 
   	} 
	
	
//Condicion de no mayor de 5Kg para mensajeria - documentos
/*if (document.tarifas.tipo_servicio.selectedIndex==2 && document.tarifas.contenido.selectedIndex==1){
if(kilos > 5){
	alert("El maximo peso para mensajeria de documentos es de 5Kg") 
      	 document.tarifas.kilos.focus() 
      	 return false; 
    }
} 
//Condicion de no mayor de 5Kg para mensajeria - mercancia
if (document.tarifas.tipo_servicio.selectedIndex==2 && document.tarifas.contenido.selectedIndex==2){
var vol = (largo * ancho * alto * cajas) /2500; 
if(vol > 5){
	alert("El maximo volumen para mensajeria de mercancia es de 5 kg") 
      	 document.tarifas.largo.focus() 
      	 return false; 
    }
} */
/*if (document.tarifas.tipo_servicio.selectedIndex==2 && document.tarifas.contenido.selectedIndex==2){
if(kilos > 5){
	alert("El maximo peso para mensajeria de documentos es de 5Kg") 
      	 document.tarifas.kilos.focus() 
      	 return false; 
    }
} */

//Condicion de cada unidad no puede pasar de 50Kg para expreso -mercancia
/*if (document.tarifas.tipo_servicio.selectedIndex==2 && document.tarifas.contenido.selectedIndex==2){
var resultado = kilos/cajas;
if(resultado>50){
	alert("cada unidad de empaque no puede pesar mas de 50Kg") 
      	 document.tarifas.kilos.focus() 
      	 return false; 
    }
}

//Condicion de cada unidad no puede pasar de 50Kg para expreso-mercancia
if (document.tarifas.tipo_servicio.selectedIndex==1 && document.tarifas.contenido.selectedIndex==2){
var resultado = kilos/cajas;
if(resultado>50){
	alert("cada unidad de empaque no puede pesar mas de 50Kg") 
      	 document.tarifas.kilos.focus() 
      	 return false; 
    }
}
//Condicion de cada unidad no puede pasar de 50Kg para Super expreso-mercancia
if (document.tarifas.tipo_servicio.selectedIndex==3 && document.tarifas.contenido.selectedIndex==2){
var resultado = kilos/cajas;
if(resultado>50){
	alert("cada unidad de empaque no puede pesar mas de 50Kg") 
      	 document.tarifas.kilos.focus() 
      	 return false; 
    }
}
//Condicion de cada unidad no puede pasar de 50Kg para Super expreso-mercancia
if (document.tarifas.tipo_servicio.selectedIndex==3 && document.tarifas.contenido.selectedIndex==2){
var resu = (largo * ancho * alto * cajas) /2500; 
if(resu>50){
	alert("cada unidad de empaque no puede pesar mas de 50Kg. Digite nuevamente el volumen") 
      	 document.tarifas.largo.focus() 
      	 return false; 
    }
}
if (document.tarifas.tipo_servicio.selectedIndex==1 && document.tarifas.contenido.selectedIndex==2){
var resu1 = (largo * ancho * alto * cajas) /2500;
if(resu1 > 50){
	alert("cada unidad de empaque no puede pesar mas de 50Kg. Digite nuevamente el volumen") 
      	 document.tarifas.largo.focus() 
      	 return false; 
    }
}
//El peso debe ser mayor o igual que 2 para expreso-mercancia
if (document.tarifas.tipo_servicio.selectedIndex==1 && document.tarifas.contenido.selectedIndex==2){

if(kilos < 2){
	alert("Digite un numero mayor que uno") 
      	 document.tarifas.kilos.focus() 
      	 return false; 
    }
}
//El peso debe ser mayor o igual que 2 en volumen para expreso-mercancia
if (document.tarifas.tipo_servicio.selectedIndex==1 && document.tarifas.contenido.selectedIndex==2){

var vol = (largo * ancho * alto * cajas) /2500; 
if(vol < 2){
	alert("El volumen tiene que ser mayor que un kilo") 
      	 document.tarifas.largo.focus() 
		 
      	 return false; 
    }

}


 /*campo1.disabled = true; 
 campo2.disabled = true; 
 campo3.disabled = true; 
 campo4.disabled = true; 
 campo5.disabled = true; 
 campo6.disabled = true; 
 campo7.disabled = true;*/
 


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
document.getElementById("resultado").innerHTML=xmlhttp.responseText;

}
}
xmlhttp.open("POST","../calcula.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

xmlhttp.send("tipo_servicio="+tipo_servicio+"&&"+"contenido="+contenido+"&&"+"origen="+origen+"&&"+
"destino="+destino+" &&"+"kilos="+kilos +"&&"+ "largo="+largo+ "&&"+ "ancho="+ancho +"&&"+ "alto="+alto+ "&&"+ "cajas="+cajas +"&&"+"valor="+valor + "&&" + "forma_pago="+forma_pago);

/*campo8.disabled = true; 
campo9.disabled = true; 
campo10.disabled = true; 
campo11.disabled = true; */

}


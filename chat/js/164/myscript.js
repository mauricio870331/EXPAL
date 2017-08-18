// JavaScript Document
//busca caracteres que no sean espacio en blanco en una cadena   
function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function validaNombre(F) {   
           
        if( vacio(F.value) == false ) {   
                alert("Debe introducir un nombre de usuario.")
//				F.focus()   
				return false
        } else {   
               // alert("OK")   
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario   
                return true   
        }   
           
}  

function revisar(R){    
		if (validaNombre(document.surveyForm.name) == false)
		{
			document.surveyForm.close();
		}
		document.surveyForm.submit();
		return true
}  

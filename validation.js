
	/* ajaxCRUD validation javascript (optional) */

	$(document).ready(function(){
		doValidation();
	});

	function doValidation(){

		// mask some fields with desired input mask
		// use "modifyFieldWithClass" to set a css class on the fields you need to mask (e.g. phone, zip)
		$("input.phone").mask("(999) 999-9999");
		$("input.zip").mask("");
		$("input.hora").mask("99:99","");
	
   
		//add any other validation entries here
         
		//put a date picker on a field (comment this out if you do not use calendars)
		try{
	
			$( ".datepicker" ).datepicker
		({
					
				dateFormat: 'yy-mm-dd',
				showOn: "button",
					buttonImage: "calendar.gif",
					buttonImageOnly: true,
					onSelect: function (date) {
 var f = new Date();
 var mes = (f.getMonth() +1);
 
 if (mes<10){
 var mes = '0'+mes;
 }
 var dia = f.getDate();
 if(dia<10){
 var dia = '0'+dia;
 }
 var fecha=f.getFullYear() + "-" + mes + "-" + dia;

 if(date < fecha){
 //alert("La fecha de viaje debe ser mayor a hoy");

 }
},
				onClose: function(){
					this.focus();
					
				}

			});
		}
		catch(err){
			//no fields have a datepicker on them
			
		}
	}


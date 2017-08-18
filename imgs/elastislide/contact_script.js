jQuery( document ).ready(function() {



if(jQuery('#owl-demo').length){
jQuery("#owl-demo").owlCarousel({
 
      navigation : false,  
	   autoPlay : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
   pagination : true,
    paginationNumbers: false 
    
 
  });

}

  


jQuery("#contact_ciudades").on("change",function(){


jQuery(".city-data").css("display","none");

var ciudad = jQuery("#contact_ciudades option:selected").val();


jQuery(".city-data-container"+ciudad).css("display","inline");

 
});


});
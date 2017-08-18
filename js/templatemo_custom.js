"use strict";

jQuery(document).ready(function($){

   
    /************** Menu Content Opening *********************/
	$(".main_menu a, .responsive_menu a").click(function(){
		var id =  $(this).attr('class');
		id = id.split('-');
		$("#menu-container .content").hide();
		$("#menu-container #menu-"+id[1]).addClass("animated fadeInDown").show();
		$("#menu-container .homepage").hide();
		$(".support").hide();
		$(".testimonials").hide();
		return false;
	});

    
       $.get = function(key)   {  
        key = key.replace(/[\[]/, '\\[');  
        key = key.replace(/[\]]/, '\\]');  
        var pattern = "[\\?&]" + key + "=([^&#]*)";  
        var regex = new RegExp(pattern);  
        var url = unescape(window.location.href);  
        var results = regex.exec(url);  
        if (results === null) {  
            return null;  
        } else {  
            return results[1];  
        }  
    } 
    var a = $.get("token");
    

	$( window ).load(function() {
	  if (a=="lpok" || a=="lpoC") {
         $( "#imgRegistrar" ).trigger( "click" );
         $('#imgRegistrar').attr("src", "images/btnregistrarpress.png");
	     $("#imgComoGanar").removeClass("act");
	     $("#imgInicio").removeClass("act");          
	     $("#imgGanadores").removeClass("act"); 	     	     
      }
      
        
	}); 
 
	

	$(".main_menu a.templatemo_home, .responsive_menu a.templatemo_home").click(function(){
		$(".contact").hide();
		$("#menu-container .homepage").addClass("animated fadeInDown").show();
		$(this).addClass('active');
		$(".main_menu a.templatemo_page1, .responsive_menu a.templatemo_page1").removeClass('active');
		$(".main_menu a.templatemo_page2, .responsive_menu a.templatemo_page2").removeClass('active');
		$(".main_menu a.templatemo_page3, .responsive_menu a.templatemo_page3").removeClass('active');
		$(".main_menu a.templatemo_page5, .responsive_menu a.templatemo_page5").removeClass('active');		
		return false;
	});


	//add mauricio
	$(".main_menu a.templatemo_page1, .responsive_menu a.templatemo_page1").click(function(){
		$(".contact").hide();
		$("#menu-container .comoparticipar").addClass("animated fadeInDown").show();
		$('this').addClass('active');
		$(".main_menu a.templatemo_home, .responsive_menu a.templatemo_home").removeClass('active');
		$(".main_menu a.templatemo_page2, .responsive_menu a.templatemo_page2").removeClass('active');
		$(".main_menu a.templatemo_page3, .responsive_menu a.templatemo_page3").removeClass('active');
		$(".main_menu a.templatemo_page5, .responsive_menu a.templatemo_page5").removeClass('active');		
		return false;
	});
	//fin add mauricio


 //add mauricio2
	/*$("#login_acepted").click(function(){
		$(".contact").hide();
		$(".service").hide();			
		$(".main_menu a.templatemo_page1, .responsive_menu a.templatemo_page1").removeClass('active');
		$(".main_menu a.templatemo_home, .responsive_menu a.templatemo_home").removeClass('active');
		$(".main_menu a.templatemo_page2, .responsive_menu a.templatemo_page2").removeClass('active');
		$(".main_menu a.templatemo_page3, .responsive_menu a.templatemo_page3").removeClass('active');
		$(".main_menu a.templatemo_page5, .responsive_menu a.templatemo_page5").removeClass('active');
		return false;
	});*/
	//fin add mauricio2


	$(".main_menu a.templatemo_page2, .responsive_menu a.templatemo_page2").click(function(){
		$(".contact").hide();
		$("#menu-container .service").addClass("animated fadeInDown").show();
		$(this).addClass('active');
		$(".main_menu a.templatemo_home, .responsive_menu a.templatemo_home").removeClass('active');
		$(".main_menu a.templatemo_page1, .responsive_menu a.templatemo_page1").removeClass('active');
		$(".main_menu a.templatemo_page3, .responsive_menu a.templatemo_page3").removeClass('active');
		$(".main_menu a.templatemo_page5, .responsive_menu a.templatemo_page5").removeClass('active');		
		return false;
	});

	$(".main_menu a.templatemo_page3, .responsive_menu a.templatemo_page3").click(function(){
		$(".contact").hide();
		$("#menu-container .portfolio").addClass("animated fadeInDown").show();		
		$(".our-services").show();
		$(this).addClass('active');
		$(".main_menu a.templatemo_page1, .responsive_menu a.templatemo_page1").removeClass('active');
		$(".main_menu a.templatemo_page2, .responsive_menu a.templatemo_page2").removeClass('active');
		$(".main_menu a.templatemo_home, .responsive_menu a.templatemo_home").removeClass('active');
		$(".main_menu a.templatemo_page5, .responsive_menu a.templatemo_page5").removeClass('active');		
		return false;
	});


//add mauricio
	$(".main_menu a.templatemo_page5, .responsive_menu a.templatemo_page5").click(function(){
		$("#menu-container .contact").addClass("animated fadeInDown").show();
		$(this).addClass('active');
		$(".contact").show();
		$(".main_menu a.templatemo_home, .responsive_menu a.templatemo_home").removeClass('active');
		$(".main_menu a.templatemo_page1, .responsive_menu a.templatemo_page1").removeClass('active');
		$(".main_menu a.templatemo_page2, .responsive_menu a.templatemo_page2").removeClass('active');
		$(".main_menu a.templatemo_page3, .responsive_menu a.templatemo_page3").removeClass('active');		
		
		return false;
	});
	//fin add mauricio
	



	/************** Gallery Hover Effect *********************/
	$(".overlay").hide();

	$('.gallery-item').hover(
	  function() {
	    $(this).find('.overlay').addClass('animated fadeIn').show();
	  },
	  function() {
	    $(this).find('.overlay').removeClass('animated fadeIn').hide();
	  }
	);


	/************** LightBox *********************/
	$(function(){
		$('[data-rel="lightbox"]').lightbox();
	});


	$("a.menu-toggle-btn").click(function() {
	  $(".responsive_menu").stop(true,true).slideToggle();
	  return false;
	});
 
    $(".responsive_menu a").click(function(){
		$('.responsive_menu').hide();
	});

});


function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
      'callback=initialize';
  document.body.appendChild(script);
}

function initialize() {
    var mapOptions = {
      zoom: 15,
      center: new google.maps.LatLng(16.8496189,96.1288854)
    };
    var map = new google.maps.Map(document.getElementById('templatemo_map'),  mapOptions);
}


/*----------------- Previous Next button ---------------------- */
$(window).load(function(){
$(document).ready(function(){				   
    $(".divs div.content").each(function(e) {
        if (e != 0)
            $(this).hide();
    });
    
    $("#next").click(function(){
			loadScript();
        if ($(".divs div.content:visible").next().length != 0)
            $(".divs div.content:visible").next().addClass("animated fadeInDown").show().prev().hide() ;
        else {
            $(".divs div.content:visible").hide();
            $(".divs div.content:first").addClass("animated fadeInDown").show() ;
			
        }
        return false;
    });

    $("#prev").click(function(){
				loadScript();				  
        if ($(".divs div.content:visible").prev().length != 0)
            $(".divs div.content:visible").prev().addClass("animated fadeInDown").show().next().hide();
        else {
            $(".divs div.content:visible").hide();
            $(".divs div.content:last").addClass("animated fadeInDown").show();
			
        }
        return false;
    });
});

});

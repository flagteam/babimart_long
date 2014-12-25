// JavaScript Document
jQuery.noConflict()(function($){
    // jQuery code here
		//-------------- Menu danh mục sản phẩm --------------
		var windowwidth = $(window).width();
	   var _pathName = window.location.pathname; 
	    var _objMenuMouse = $(".menu .menu-hori .menu-pc");
	    var _objMenu = $(".menu .menu-hori .menu-pc .menu-verti");
	   if (( _pathName == "") &&( windowwidth>600)) {
	       $(_objMenu).addClass("menu-verti-active mrg5");
		  
	   }
	   else {
	       $(_objMenuMouse).mouseenter(function () {
	           $(_objMenu).fadeIn('slow');
	            $(_objMenu).addClass("menu-verti-active");
	        }).mouseleave(function () {
//	            $(_objMenu).css({ 'display': 'none' });
	           $(_objMenu).removeClass("menu-verti-active");
	        });
	   }

	//width slider
	var wresize = function() {
			var menuheight = $( 'ul.menu-verti').outerHeight();	
		//	$('#menu ul.menu-verti').css("height",(menuheight));	  
			$('#menu ul.menu-hori-1').css("height",(menuheight -22));	
			var sliderwidth = $( '#slider1').width();	
			$('#slider1 .bitem').css("width",(sliderwidth/4)-45);	
			if( $(window).width() <600){
				$('#slider1 .bitem').css("width",(sliderwidth/2)-45); 
				//$('.home #container').css("margin-top",menuheight);
				 $('.sub-menu').css("display",'none');
				}
			if( $(window).width() <300){$('#slider1 .bitem').css("width",(sliderwidth)-45); }

		};
		$(window).resize(wresize);
		wresize();				


	
//-- slider--//	
	            // Set starting slide to 1
            var startSlide = 1;
            // Get slide number if it exists
            if (window.location.hash) {
                startSlide = window.location.hash.replace('#','');
            }
            // Initialize Slides
            $('#slides').slides({
                generatePagination: true,
                play: 5000,
                pause: 2500,
                hoverPause: true,
                start: startSlide
            });
//////////////////    
	
	            // Set starting slide to 1
            var startcombo = 1;
            // Get slide number if it exists
            if (window.location.hash) {
                startcombo = window.location.hash.replace('#','');
            }
            // Initialize Slides
            $('#combo').slides({
                generatePagination: true,
                play: 5000,
                pause: 2500,
                hoverPause: true,
                start: startcombo
            });
    
//////////////////    
	
	            // Set starting slide to 1
            var starthd = 1;
            // Get slide number if it exists
            if (window.location.hash) {
                starthd = window.location.hash.replace('#','');
            }
            // Initialize Slides
            $('#hotdeal').slides({
                generatePagination: true,
                play: 5000,
                pause: 2500,
                hoverPause: true,
                start: starthd
            });
   //-----------------//
	$('#slider1').tinycarousel(); 



  
	});
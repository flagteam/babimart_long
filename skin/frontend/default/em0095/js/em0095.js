/**
 * EMThemes
 *
 * @license commercial software
 * @copyright (c) 2012 Codespot Software JSC - EMThemes.com. (http://www.emthemes.com)
 */

(function($) {

if (typeof EM == 'undefined') EM = {};
if (typeof EM.tools == 'undefined') EM.tools = {};
var imgH = 0;

var isMobile = /iPhone|iPod|iPad|Phone|Mobile|Android|webOS|iPod|BlackBerry|hpwos/i.test(navigator.userAgent);
var isPhone = /iPhone|iPod|Phone|Mobile|Android|webOS|iPod|BlackBerry/i.test(navigator.userAgent);

var domLoaded = false, 
	windowLoaded = false, 
	last_adapt_i, 
	last_adapt_width;


/**
 * Auto positioning product items in products-grid
 *
 * @param (selector/element) productsGridEl products grid element
 * @param (object) options
 * - (integer) width: width of product item
 * - (integer) spacing: spacing between 2 product items
 */
EM.tools.decorateProductsGrid = function (productsGridEl, options) {
};


/**
 * Decorate Product Tab
 */ 
EM.tools.decorateProductCollateralTabs = function() {
	$(document).ready(function() {
		if($('.box-collateral').length > 1){
            $('.product-collateral').each(function(i) {
				$(this).wrap('<div class="tabs_wrapper_detail collateral_wrapper" />');
	            $(this).prepend('<ul class="tabs_control"></ul>');
	            $(this).children(".product-collateral-item").addClass("ui-slider-tabs-content-container");

				$('.box-collateral', this).addClass('tab-item').each(function(j) {
					var id = 'box_collateral_'+i+'_'+j;
					$(this).addClass('content_'+id);
	                $(this).attr('id',id);
					$('.tabs_wrapper_detail ul.tabs_control').append('<li><a href="#'+id+'">'+$('h2', this).html()+'</a></li>');
				});
	            $("div.tabs_wrapper_detail .product-collateral").sliderTabs();
			});
		
		}
	});
};



/**
 * Fix iPhone/iPod auto zoom-in when text fields, select boxes are focus
 */
function fixIPhoneAutoZoomWhenFocus() {
	var viewport = $('head meta[name=viewport]');
	if (viewport.length == 0) {
		$('head').append('<meta name="viewport" content="width=device-width, initial-scale=1.0"/>');
		viewport = $('head meta[name=viewport]');
	}
	
	var old_content = viewport.attr('content');
	
	function zoomDisable(){
		viewport.attr('content', old_content + ', user-scalable=0');
	}
	function zoomEnable(){
		viewport.attr('content', old_content);
	}
	
	$("input[type=text], textarea, select").mouseover(zoomDisable).mousedown(zoomEnable);
}


/**
 * Adjust elements to make it responsive
 *
 * Adjusted elements:
 * - Image of product items in products-grid scale to 100% width
 */
function responsive() {
	
	// resize products-grid's product image to full width 100% {{{
	var position = $('.products-grid .item').css('position');
	if (position != 'absolute' && position != 'fixed' && position != 'relative')
		$('.products-grid .item').css('position', 'relative');
		
	var img = $('.products-grid .item .product-image img');
	img.each(function() {
		img.data({
			'width': $(this).width(),
			'height': $(this).height()
		})
	});
	//img.removeAttr('width').removeAttr('height').css('width', '100%');
	// }}}
	
	$('.custom-logo').each(function() {
		$(this).css({
			'max-width': $(this).width(),
			'width': '100%'
		});
	});
}

window.onresize = function(){
	var $ = jQuery;
	if (typeof em_slider!=='undefined')
        em_slider = new EM_Slider(em_slider.config);

    if($("#bg_fade_color").css('display') == "block"){
    	if( $('body').hasClass("adapt-0") == true){
    		var bg	=	$("#bg_fade_color");
			$(".storediv").hide();
			bg.css("opacity",0);
			bg.css("visibility","hidden");
    	}
    	var top =( $(window).height() - $(".storediv").height() ) / 2;
		var left = ( $(window).width() - $(".storediv").width() ) / 2;
		$(".storediv").css('top', top+'px');
		$(".storediv").css('left', left+'px');
    }
}
/**
*   persistentMenu
**/
function persistentMenu() {
	var $ = jQuery;

	$(function () {
		$(window).scroll(function () {
			window.freezedTopMenu = (isPhone!=1 && FREEZED_TOP_MENU) ? 1: 0;
			if ($(this).scrollTop() > 145 && window.freezedTopMenu) {
				$('.hnav').parent(".em_nav").first().addClass('fixed-top');
			} else {
				$('.hnav').parent(".em_nav").first().removeClass('fixed-top');
			}
		});
	});
}


/**
 * Function called when layout size changed by adapt.js
 */
function whenAdapt(i, width) {
	
	$('body').removeClass('adapt-0 adapt-1 adapt-2 adapt-3 adapt-4 adapt-5 adapt-6')
		.addClass('adapt-'+i);
	
	if (typeof em_slider!=='undefined')
        em_slider = new EM_Slider(em_slider.config);

	//disable freezed top menu when in iphone
	window.freezedTopMenu = (isMobile!=1 && FREEZED_TOP_MENU) ? 1: 0;
	
	if (window.freezedTopMenu && $(window).scrollTop() > 145) { 
		$('.hnav').parent(".em_nav").first().addClass('fixed-top');
	} else {
		$('.hnav').parent(".em_nav").first().removeClass('fixed-top');
	}	

}

// Back to top
function backToTop(){
    // hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('#back-top').fadeIn();
		} else {
			$('#back-top').fadeOut();
		}
	});

	// scroll body to 0px on click
	$('#back-top a').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

}
/**
 * Callback function called when stylesheet is changed by adapt.js
 */
ADAPT_CONFIG.callback = function(i, width) {
	last_adapt_i = i;
	last_adapt_width = width;
	
	whenAdapt(last_adapt_i, last_adapt_width);
};

function toolbar(){
	$('.show').each(function(){
		$(this).insertUl();
		$(this).selectUl();
	});

	$('.sortby').each(function(){
		$(this).insertUl();
		$(this).selectUl();
	});

}

function hoverTopCart(){
	$(function($) {
		
		$('.dropdown-cart').each(function(){
			if(isMobile==true){
				$('.dropdown-cart').find('.amount a').attr('href','javascript:void(0);');	
				$(this).unbind('click');
				var divWrapper = $(this);
				$(this).find('.icon.cart, .amount a').click(function (e) {
					e.preventDefault();	
					divWrapper.find('.cart-popup').slideToggle();
				});
			} else{
				var tm;
				function show(el) {
					clearTimeout(tm);
					tm = setTimeout(function() {
						el.slideDown();
					}, 200);
				}
				function hide(el) {
					clearTimeout(tm);
					tm = setTimeout(function() {
						el.slideUp();
					}, 200);
				}
				$(this)
					.bind('mouseenter', show.curry($('.cart-popup', this)))
					.bind('mouseleave', hide.curry($('.cart-popup', this)))
					.find('.cart-popup').slideUp();
			}
		});
		
	});
}

function toogleMyAccount(){
    var $=jQuery;
    $('.em-account').hide();
    /* Wishlist Link */ 
    if(isMobile == true){
    	if(ISLOGIN==0){

    		$('.account-link').find('.login_signin a').attr('href','javascript:void(0);');	
		
    		$('.account-link').find('.account-link-content a.link-account').attr('href','javascript:void(0);');
			$('.account-link').find('.icon.account, .account-link-content a.link-account, .login_signin a').click(function (e) {
				e.preventDefault();	
				$('.em-account').toggle('slow');
			});
    	}    	
    }else{
        var timeout1 = null;
        $('.account-link').mouseover(function(){ 
            if (timeout1)
                clearTimeout(timeout1);
            timeout1 = setTimeout(function() {
                timeout1 = null;
                $('.em-account').slideDown('fast');
                $('.account-link').addClass('over');
            }, 200);
        });
        
        $('.account-link').mouseout(function(){
            if (timeout1)
                clearTimeout(timeout1);
            timeout1 = setTimeout(function() {
                timeout1 = null;
                $('.em-account').slideUp('fast');
                $('.account-link').removeClass('over');
            }, 200);
        });
    }
};

function menuVertical() {
	if($('.vnav > .menu-item-link > .menu-container > li.fix-top').length > 0){
		$('.vnav > .menu-item-link > .menu-container > li.fix-top').parent().parent().mouseover(function() {
			var $container = $(this).children('.menu-container,ul.level0');
			var $containerHeight = $container.outerHeight();
			var $containerTop = $container.offset().top;
			var $winHeight = $(window).height();
			var $maxHeight = $containerHeight + $containerTop;
			//if($maxHeight >= $winHeight){
				$setTop = $(this).parent().offset().top -  $(this).offset().top;
				if(($setTop+$containerHeight) < $(this).height()){
					$setTop  = $(this).outerHeight() - $containerHeight;
				}
			/*}else{
				$setTop = (-1);
			}*/
			var $grid = $(this).parents('.em_nav').first().parents().first();
			$container.css('top', $setTop);
			if($maxHeight < $winHeight){
				$('.vnav ul.level0,.vnav > .menu-item-link > .menu-container').first().css('top', $setTop-9 +'px');
			}
			
		});
		$('.vnav .menu-item-link > .menu-container,.vnav ul.level0').parent().mouseout(function() {
			var $container = $(this).children('.menu-container,ul.level0');
			$container.removeAttr('style');
		});
	}
}

$(document).ready(function() {
	domLoaded = true;  
    toogleMyAccount(); 
    //initToggleTabs_Product('#product-content-tabs');
	isMobile && fixIPhoneAutoZoomWhenFocus();
	alternativeProductImage();
	
	setupReviewLink();
	if (FREEZED_TOP_MENU) persistentMenu();
	hoverTopCart();

    if($('body').viewPC()){
		$('.cat-search').each(function(){
			$(this).insertUlCategorySearch();
			$(this).selectUlCategorySearch();
		});
	}
	
    toogleStore();
	menuVertical();
});
$(window).bind('load', function() {
	windowLoaded = true;
	responsive();
	whenAdapt(last_adapt_i, last_adapt_width);
	//$(".accordion" ).accordion();
	$(".accordion").awsAccordion({
	    type:"vertical",
	    cssAttrsVer:{
	        ulWidth:"responsive",
	        liHeight:10
	    },
	    cssAttrsHor:{
	        ulWidth:"responsive",
	        liWidth:100,
	        liHeight:300
	    },
	    startSlide:2,
	    openCloseHelper:{
	        openIcon:"ok-circle",
	        closeIcon:"ok-sign"
	    },
	    openOnebyOne:true,
	    classTab:"active",
	    slideOn:"click"
	});
	//initButtonCart();
});

$(window).bind('orientationchange', function () {
    
});
	
jQuery(document).ready(function(){
    backToTop();
});

})(jQuery);

function showAgreementPopup(e) {
	
	//jQuery('#checkout-agreements .agreement-content').show();
	//$('agreement-content-popup').show();
		
	jQuery('#checkout-agreements label.a-click').parent().parent().children('.agreement-content').show()
		.css({
			'left': (parseInt(document.viewport.getWidth()) - jQuery('#checkout-agreements label.a-click').parent().parent().children('.agreement-content').width())/2 +'px',
			'top': (parseInt(document.viewport.getHeight()) - jQuery('#checkout-agreements label.a-click').parent().parent().children('.agreement-content').height())/2 + 'px'
		});
	
};


function hideAgreementPopup(e) {
	//$('opc-agreement-popup-overlay').hide();
	jQuery('#checkout-agreements .agreement-content').hide();
	
};

/**
*   showReviewTab
**/
function showReviewTab() {
	var $ = jQuery;
	function getReviewTabHandle() {
		var currentId = $('.box-reviews').attr('id');
		
		var classes = $('#'+currentId).attr('class').split(' ');
		var href = '';
		$(classes).each(function (i, e) {
			if (/content_box_collateral/.test(e)) {
				href = e.replace('content_', '');
			}
		});
		return $('[href="#'+href+'"]');
	}
	var hasTab = $('.product-collateral').children().hasClass('ui-slider-tabs-content-container');
	var reviewTab = getReviewTabHandle();//$('.tabs_control li:contains(Review)');
	if (hasTab) {
		// scroll to review tab
		$('html, body').animate({
			 scrollTop: reviewTab.offset().top
		}, 500);
		 
		 // show review tab
		reviewTab.click();
	} else if ($('#customer-reviews').size()) {
		// scroll to customer review
		$('html, body').animate({ scrollTop: $('#customer-reviews').offset().top }, 500);
	} else {
		return false;
	}
	return true;
}

/**
*   setupReviewLink
**/
function setupReviewLink() {
	jQuery('.r-lnk').click(function (e) {
		if (showReviewTab())
			e.preventDefault();
	});
}

/**
 * Change the alternative product image when hover
 */
function alternativeProductImage() {
    var $=jQuery;
	var tm;
	function swap() {
		clearTimeout(tm);
		setTimeout(function() {
			el = $(this).find('img[data-alt-src]');
			var newImg = $(el).data('alt-src');
			var oldImg = $(el).attr('src');
			$(el).attr('src', newImg).data('alt-src', oldImg);
			$(el).fadeIn(300, "easeInCubic");

		}.bind(this), 400);
	}	
	$('.item .product-image img[data-alt-src]').parents('.product-image').bind('mouseenter', swap).bind('mouseleave', swap);
}


/**
*	Hover product item
**/
function hoverProduct(){
	var $ = jQuery;
	$('.products-grid > .item').each(function(){
		$(this).hoverProductItem();
	});
}

/**
*   After Layer Update
**/
window.afterLayerUpdate = function () {
	var $=jQuery;
    alternativeProductImage();
    qs({
        itemClass: '.products-grid li.item, .products-list li.item, li.item .cate_product, .product-upsell-slideshow li.item, .mini-products-list li.item, #crosssell-products-list li.item', //selector for each items in catalog product list,use to insert quickshop image
        aClass: 'a.product-image', //selector for each a tag in product items,give us href for one product
        imgClass: '.product-image img' //class for quickshop href
    });
}

function toogleStore(){
    var $=jQuery;
    //initSlider('#slider_storeview ul');
    $('.storediv').hide();
    $(".btn_storeview").click(function() {
		store_show();
	});

	$(".btn_storeclose").click(function() {
		store_hide();
	});

	function store_show(){
		var bg	=	$("#bg_fade_color");
		bg.css("opacity",0.5);
		bg.css("display","block");
		$(".storediv").show();
        var top =( $(window).height() - $(".storediv").height() ) / 2;
        var left = ( $(window).width() - $(".storediv").width() ) / 2;
        $(".storediv").css('top', top+'px');
        $(".storediv").css('left', left+'px');
	}

	function store_hide(){
		var bg	=	$("#bg_fade_color");
		$(".storediv").hide();
		bg.css("opacity",0);
		bg.css("display","none");
	}
}
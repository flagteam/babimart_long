;(function ($) {
	$.csslider = function(el,options) {
		var defaults = {
			selector : ".slides > li.item",
			move : 1,
			speed : 400,
			direction : 'horizontal',
			textClassName : '.product-name',
			delay : 0,
			WidthViewport : 0,
			heightViewport : 0,
			textPrev : 'Prev',
			textNext : 'Next',
			circular : 0
		}
		
		var vars = $.extend({}, defaults, options);
		var slider = $(el),
        //touch = ("ontouchstart" in window) || window.DocumentTouch && document instanceof DocumentTouch,
        eventType = "click",
		vertical = vars.direction === "vertical",
		auto = vars.delay > 0;
		slider.addClass('csslider'),
		rtlStyle = $('div.page').first().css('direction') == 'rtl';
		var time = 0;
		slider.containerSelector = vars.selector.substr(0,vars.selector.search(' '));
		slider.container = $(slider.containerSelector, slider);
		slider.slides = $(vars.selector, slider);
		slider.target = 0;
		slider.currentHideNav = 'prev';
		if(vertical)
			slider.addClass('vertical');
		else
			slider.addClass('horizontal');
		slider.scrolling = false;
		
		slider.setup = function(){
			slider.viewport = $('<div class="viewport"></div>');
			slider.viewport.append(slider.container);
			slider.append(slider.viewport);
			slider.controlNav();
			if(vars.WidthViewport > 0){
				slider.viewport.width(vars.WidthViewport);
			}
			if(vars.heightViewport > 0){
				slider.viewport.height(vars.heightViewport);
			}
			slider.init();
			slider.hammer = new Hammer(slider.container[0], {"swipe_time": 200/*,"prevent_default" : true*/});
			slider.touchHamer();
		}
		
		slider.init = function (){
			if($(vars.textClassName,slider))
				$(vars.textClassName,slider).hide();
			if(slider.interval && auto)
				clearTimeout(slider.interval);
			slider.reset();

			var maxWidth = 0,maxOuterWidth = 0,maxHeight = 0,i=0,maxHeight = 0,maxOuterHeight = 0;
			slider.slides.each(function(index,value){
				if(maxWidth < $(this).width()){
					maxWidth = $(this).width();
					maxOuterWidth = $(this).outerWidth(true);
					i = index;
				}
				if(maxHeight < $(this).height()){
					maxHeight = $(this).height();
					maxOuterHeight = $(this).outerHeight(true);
				}
			});
			if(!vertical){ // horizontal
				slider.lengthPx = slider.viewport.width();
				if(slider.lengthPx < maxWidth){
					var newWidth = slider.lengthPx - (maxOuterWidth - maxWidth);
					var ratio = (newWidth/maxWidth);
					var delta = maxWidth - newWidth;
					maxWidth = newWidth;
					maxOuterWidth = maxOuterWidth - delta;
					maxHeight = Math.ceil(maxHeight*ratio);
					slider.slides.height(maxHeight);
				}
				slider.slides.width(maxWidth);
				var first = slider.slides.first();
				slider.stepLength = (maxOuterWidth)*vars.move;
				var lengthPx = slider.slides.length*(maxOuterWidth);
				slider.container.width(lengthPx);
				slider.container.lengthPx = lengthPx;
			} else { // vertical
				if(slider.viewport.width() < maxWidth){
					var newWidth = slider.viewport.width() - (maxOuterWidth - maxWidth);
					var ratio = (newWidth/maxWidth);
					maxWidth = newWidth;
					slider.slides.width(maxWidth);
					newHeight = Math.ceil(maxHeight*ratio);
					var delta = maxHeight - newHeight;
					maxOuterHeight -= delta;
					maxHeight = newHeight;
				}
				slider.lengthPx = slider.viewport.height();
				slider.slides.height(maxHeight);
				var first = slider.slides.first();
				slider.stepLength = (maxOuterHeight)*vars.move;
				var lengthPx = slider.slides.length*(maxOuterHeight);
				slider.container.height(lengthPx);
				slider.container.lengthPx = lengthPx;
			}
			if($(vars.textClassName,slider))
				$(vars.textClassName,slider).show();
				
			slider.finalTarget = slider.lengthPx - slider.container.lengthPx; 
			slider.target = 0;
			slider.resetScroll();
			slider.slide(slider.target,vars.speed);	
			//slider.prev.hide();
			/*if(auto)
				slider.interval = setTimeout(slider.nextSlide,vars.delay);*/
		}
		
		slider.reset = function(){
			slider.container.css('height','');
			slider.slides.css('height','');
			slider.container.css('width','');
			slider.slides.css('width','');
		}
		
		slider.resetScroll = function(){
			slider.scrolling = false;
			if(auto)
				slider.interval = setTimeout(slider.nextSlide,vars.delay);
		}
		
		slider.touchHamer = function(){
			var targetVirtual,flow, time, distance;
			if(typeof addEventListener == 'function'){
				el.addEventListener("touchmove", function(ev){
					if(ev.touches.length == 1)
						ev.preventDefault();
				}, false);
			}
			
			function cancelEvent(event)
			{
				event = event || window.event;
				if(event.preventDefault){
					event.preventDefault();
					event.stopPropagation();
				}else{
					event.returnValue = false;
					event.cancelBubble = true;
				}
			}
			
			slider.hammer.ondragstart = function(ev) {
				if(slider.interval && auto)
					clearTimeout(slider.interval);
				if(slider.scrolling 
					|| (vertical && (ev.direction == 'left' || ev.direction == 'right')) 
					|| (!vertical && (ev.direction == 'up' || ev.direction == 'down'))){
					return;
				}	
				targetVirtual = 0;
				flow = 0;
				time = Number( new Date() );
				distance = 0;
			}
			
			slider.hammer.ondrag = function(ev) {
				if(slider.interval && auto)
					clearTimeout(slider.interval);
				if(slider.scrolling
					|| (vertical && (ev.direction == 'left' || ev.direction == 'right')) 
					|| (!vertical && (ev.direction == 'up' || ev.direction == 'down'))){
					cancelEvent(ev);	
					return;
				}
				if(ev.touches.length > 1 || ev.scale && ev.scale !== 1 || slider.scrolling){
					cancelEvent(ev);
					return;
				}	
				distance = (vertical) ? ev.distanceY : ev.distanceX;
				targetVirtual = slider.target + distance;
				if(targetVirtual > slider.stepLength/2){// last slide right
					flow = 1;
					return;
				}	
				if(slider.container.lengthPx + targetVirtual < slider.lengthPx - (slider.stepLength/2)){//first slide left
					flow = -1;
					return;
				}	
				if(vertical)
					slider.container.animate({ marginTop: targetVirtual + 'px'}, 0);
				else
					slider.container.animate({ marginLeft: targetVirtual + 'px'}, 0);
				
			};
			
			slider.hammer.ondragend = function(ev) {
				if(slider.scrolling
					|| (vertical && (ev.direction == 'left' || ev.direction == 'right')) 
					|| (!vertical && (ev.direction == 'up' || ev.direction == 'down'))){
					cancelEvent(ev);	
					return;
				}	
				//slider.hammer.cancelEvent(ev);	
				if(flow < 0){
					slider.target = slider.finalTarget;
				} else if(flow > 0){
					slider.target = 0;
				} else {
					var remainDistance = Math.floor(Math.abs(distance)%slider.stepLength),remainStep;
					if(remainDistance < (slider.stepLength/2)){
						remainStep = (ev.direction == 'left' || ev.direction == 'up') ? remainDistance : remainDistance*(-1);
					} else {
						remainStep = (ev.direction == 'left' || ev.direction == 'up') ? (slider.stepLength-remainDistance)*(-1) : (slider.stepLength-remainDistance);
					}
					slider.target = targetVirtual + remainStep;
					
				}
		
				slider.slide(slider.target,vars.speed);
			};
			
			slider.hammer.onswipe = function(ev) {
				if(slider.scrolling){
					cancelEvent(ev);	
					return;
				}	
				if(!vertical){
					if(ev.direction == 'left')
						slider.nextSlide();
					else if(ev.direction == 'right')	
						slider.prevSlide();
				} else {
					if(ev.direction == 'up')
						slider.nextSlide();
					else if(ev.direction == 'down')	
						slider.prevSlide();
				}
			}
			
		}		
		
		slider.slide = function(target, durationVal){
			if(slider.interval && auto)
				clearTimeout(slider.interval);
			slider.scrolling = true;
			var targetCss = target + 'px';
			if(!vertical)
				if(rtlStyle)
					slider.container.animate({ marginRight: targetCss}, durationVal, 'swing',slider.resetScroll);
				else	
					slider.container.animate({ marginLeft: targetCss}, durationVal, 'swing',slider.resetScroll);
			else	
				slider.container.animate({ marginTop: targetCss}, durationVal, 'swing',slider.resetScroll);
		}
		
		slider.nextSlide = function(){
			/*if(!slider.scrolling){
				if(slider.interval && auto)
					clearTimeout(slider.interval);
				//slider.target -= slider.stepLength;
				if(slider.container.lengthPx + slider.target - slider.stepLength <= slider.lengthPx - slider.stepLength/2){
					if(vars.circular > 0){
						slider.target = 0;
						slider.target -= slider.stepLength;
						slider.slide(slider.target,vars.speed);
					}	
					else {
						slider.currentHideNav = 'next';
						//slider.next.hide();
					}	
				} else{	
					slider.target -= slider.stepLength;
					if((slider.currentHideNav == 'prev') && (vars.circular > 0))
						slider.prev.show();
					slider.slide(slider.target,vars.speed);
				}	
			}*/
			
			if(!slider.scrolling){
				if(slider.interval && auto)
					clearTimeout(slider.interval);
				slider.target -= slider.stepLength;
				console.log(slider.container.lengthPx + ' ' + slider.target);
				console.log(slider.lengthPx - slider.stepLength/2);
				if(slider.container.lengthPx + slider.target <= slider.lengthPx - slider.stepLength/2){
					console.log('come back');
					slider.target = 0;
				}	
				slider.slide(slider.target,vars.speed);
			}
		}
		
		slider.prevSlide = function(){
			/*if(!slider.scrolling){
				if(slider.interval && auto)
					clearTimeout(slider.interval);
				//slider.target += slider.stepLength;
				if(slider.target + slider.stepLength > slider.stepLength/2){
					if(vars.circular > 0){
						slider.target += slider.stepLength;
						slider.target = slider.finalTarget;
					}	
					else {
						slider.currentHideNav = 'prev';
						slider.prev.hide();
					}	
				} else {
					slider.target += slider.stepLength;
					if((slider.currentHideNav == 'next') && (vars.circular > 0))
						slider.next.show();
					slider.slide(slider.target,vars.speed);
				}
					
				
			}	*/
			if(!slider.scrolling){
				if(slider.interval && auto)
					clearTimeout(slider.interval);
				slider.target += slider.stepLength;
				if(slider.target > slider.stepLength/2)
					slider.target = slider.finalTarget;
				slider.slide(slider.target,vars.speed);
			}	
		}
		
		slider.controlNav = function(){
			var navHtml =  $("<div class='controls'><a href='#' title='" + vars.textPrev + "' class='prev'>" + vars.textPrev + "</a><a title='" + vars.textNext + "' href='#' class='next'>" + vars.textNext + "</a></div>");
			slider.append(navHtml);
			slider.next = $('a.next',slider);
			slider.prev = $('a.prev',slider);
			slider.next.bind(eventType, function(event) {
				event.preventDefault();
				slider.nextSlide();
			});
			
			slider.prev.bind(eventType, function(event) {
				event.preventDefault();
				slider.prevSlide();
			});
		}
		
		slider.showHideNav = function(){
			if(slider.target < 0){
				slider.prev.show();
			} else {
				slider.prev.hide();
			}
		}
		
		slider.setup();
		$(window).bind("emadaptchange orientationchange", function(){
			setTimeout(slider.init,300);
		});
	}
	
	$.fn.csslider = function(options) {
		return this.each(function(){
			new $.csslider(this,options);
		});
	}
})(jQuery);
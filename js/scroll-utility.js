var utils = (function(me, $){
	// This is the height at which the button will show up.
	me._MIN_HEIGHT = 120;
	// This is the scroll speed variable. Lower numbers mean faster scroll speeds.
	me._SCROLL_SPEED = 3;
	// THis controls how quickly the fade in/out happens
	me._FADE_TIME = 1000;

	me.setClickHandler = function(){
		$('#toTopLink').bind('click', function(){
			$('html, body').animate({scrollTop: 0}, $(window).scrollTop() / me._SCROLL_SPEED);
			return false;
		});
	};

	me.checkScrollPosition = function(){
		if($(window).scrollTop() > me._MIN_HEIGHT){
			$('#toTopLink').fadeIn(me._FADE_TIME);
		} else {
			$('#toTopLink').fadeOut(me._FADE_TIME);
		}
	}

	me.setScrollHandler = function(){
		$(window).bind('scroll', function(){
			me.checkScrollPosition();
		});
	};

	me.setToTopFunctionality = function(){
		me.setClickHandler();
		me.setScrollHandler();
	}

	return me;
})(utils || {}, jQuery);

utils.setToTopFunctionality();

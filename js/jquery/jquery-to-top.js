(function($){
	$.fn.toTopScroll = function(option){
		var settings = $.extend({
			min_height: 120
			, scroll_speed: 3
			, fade_time: 1000
		}, options);

		this.bind('click', function(){
			$('html,body').animate({scrollTop:0}, $(window).scrollTop() / settings.scroll_speed);
		});
		$(window).bind('scroll', function(){
			if($(window).scrollTop() > settings.min_height){
				this.fadeIn(settings.fade_time);
			} else {
				this.fadeOut(settings.fade_time);
			}
		}.bind(this));
	}
})(jQuery);

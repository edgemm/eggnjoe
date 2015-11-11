(function($){

$( '.home-slides' ).slidesjs({
	width: 960,
	height: 545,
	play: {
		active: false,
		interval: 6000,
		auto:true,
		swap: true
	},
	effect: {
		slide: {
			speed: 1500
		}
	},
	pagination: {
		active: false
	},
	navigation: {
		active: true,
		effect: "slide"
	}
});

// Hide slider navs when less than 2 slides
var numSlides = $( '.home-slide' ).length;
if (numSlides <= 1) {
	$( '.slidesjs-navigation' ).css( 'display', 'none' );
}

})(jQuery);
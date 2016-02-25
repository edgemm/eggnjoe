function triggerSlideshow( s, w, h ) { // slideshow selector(must be ID for pages with multiple slideshows), width of slideshow, height of slideshow

	var 	slider = jQuery( s ),
		interval = 5000,
		stoppedClass = "slidesjs-stopped";

	// start slideshow only if more than one slide
	var numSlides = jQuery( s ).children().length;

	if (numSlides > 1) {

		// play slideshow if already stopped, otherwise define slideshow
		if ( slider.hasClass( stoppedClass ) ) {
			slider.removeClass( stoppedClass );
			var delayPlay = window.setTimeout( slider.find( ".slidesjs-play" ).click(), 10000 );
		} else {
			slider.slidesjs({
				width: w,
				height: h,
				play: {
					active: true,
					interval: interval,
					auto: true,
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
		}
	} else {
		slider.find( '.slidesjs-navigation' ).css( 'display', 'none' );
	}	

}

(function($){

// start home slideshow if present
var homeSlider = ".home-slides";
if ( $( ".home-slides" ).length ) triggerSlideshow( homeSlider, 960, 545 );

})(jQuery);
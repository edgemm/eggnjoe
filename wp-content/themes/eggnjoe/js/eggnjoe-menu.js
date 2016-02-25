(function($){

    var masonryOptions = { 'itemSelector': '.tab-pane.active .menucardBox', 'columnWidth': '.tab-pane.active .grid-sizer', 'gutter': '.tab-pane.active .gutter-sizer' }; // masonry options
    var $container = $( '.menu .tab-pane.active' ); // container of initial content to be re-arranged
    
    // get full viewport width and height so masonry uses same sizes as CSS media queries
    // source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript
    function viewport() {
	var e = window, a = 'inner';
	if (!('innerWidth' in window )) {
	    a = 'client';
	    e = document.documentElement || document.body;
	}
	return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
    }
    
    var viewportWidth = viewport().width;
    
    function fireMasonry() {
	if ( viewportWidth > 767 ) {
	    $container.imagesLoaded( function(){
		$container.masonry( masonryOptions );
	    });	
	}
    }
    
    fireMasonry();

    // start active slideshow if home slidshow not present
    var activeSlideshowId = "#" + $( ".menu-slider.active" ).attr( "id" );
    
    if ( $( ".home-slides" ).length < 1 ) triggerSlideshow( activeSlideshowId, 940, 351 );

    $( '.menu .filter a' ).click( function(e) {

	if ( !$(this).parent( "li" ).hasClass( "nofilter" ) ) {

	    e.preventDefault();

	    var menuTab = $(this).attr( "href" );	
	    $container = $( '.menu ' + menuTab );
	    var activeClass = "active";

	    // stop current slider, set class to denote stopped slideshow
	    $( ".menu-slider.active" )
		.addClass( "slidesjs-stopped" )
		.find( ".slidesjs-stop" ).click();

	    // remove active class from current elements, add to new
	    $( ".tab-pane.active" ).removeClass( "active" ).fadeOut( 250 );
	    $( ".menu-slider.active" ).removeClass( "active" ).fadeOut( 250 );
	    $( ".menu .filter li" ).removeClass( activeClass );
	    $(this).parent().addClass( activeClass );
    
	    // stop current slider, start new
	    var slider_id = $(this).attr( "data-slider-id" );
	    var slider = $( ".menu-slider.slider-" + slider_id );
	    slider.fadeIn( 250 ).addClass( "active" );
	    triggerSlideshow( "#" + slider.attr( "id" ), 940, 351 );

	    $( menuTab ).fadeIn( 250, function() {
		$( menuTab ).addClass( "active" );
		fireMasonry();
	    });
    
	}
    });
})( jQuery );
<!-- sidebar -->
<aside class="sidebar five columns" role="complementary">

	<div class="sidebar-widget">
	<?php

	// get contact widget area first
	if( is_page( 'contact' ) ) :

		if( function_exists('dynamic_sidebar') ) dynamic_sidebar( 'widget-contact-sidebar' );

	endif;

	if( function_exists('dynamic_sidebar') ) dynamic_sidebar( 'widget-main-sidebar' );

	?>
	</div>

</aside>
<!-- /sidebar -->

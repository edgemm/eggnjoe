<?php get_header(); ?>

	<main class="main container clear" role="main">
		
		<section id="content">

				<article <?php post_class( array( 'sixteen', 'columns' ) ); ?>>
	
					<?php get_template_part('loop'); ?>
	
				</article>

		</section>
		<!-- /#conent -->

	</main>

<?php get_footer(); ?>

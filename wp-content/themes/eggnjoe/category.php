<?php get_header(); ?>

	<main class="main container clear" role="main">
		
		<section id="content">

				<?php get_template_part('loop'); ?>
	
				<?php get_template_part('pagination'); ?>

		</section>
		<!-- /#conent -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

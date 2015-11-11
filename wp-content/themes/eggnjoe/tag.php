<?php get_header(); ?>

	<main class="main clear" role="main">
		
		<section id="content">

			<header class="tkh-entry-header">
				<h1 class="tkh-entry-title container"><?php _e( 'Tag Archive: ', 'html5blank' ); echo single_tag_title('', false); ?></h1>
			</header>

			<div class="container clear">

				<?php get_template_part('loop'); ?>
	
				<?php get_template_part('pagination'); ?>

			</div>
			<!-- /.container -->

		</section>
		<!-- /#conent -->
	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

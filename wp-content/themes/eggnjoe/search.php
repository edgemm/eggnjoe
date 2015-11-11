<?php get_header(); ?>

	<main class="main clear" role="main">
		
		<section id="content">

			<header class="tkh-entry-header">
				<h1 class="tkh-entry-title container">Search Results</h1>
			</header>

			<div class="container clear">

			<article <?php post_class( array( 'sixteen', 'columns' ) ); ?>>

				<header>
					<h1 class="entry-title"><?php echo sprintf( __( '%s Search Results for ', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>
				</header>

				<?php get_template_part('loop'); ?>
	
				<?php get_template_part('pagination'); ?>

			</article>

			</div>
			<!-- /.container -->

		</section>
		<!-- /#conent -->

	</main>

<?php get_footer(); ?>

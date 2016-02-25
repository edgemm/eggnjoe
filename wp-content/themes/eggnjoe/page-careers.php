<?php // Template Name: Careers ?>

<?php get_header(); ?>
		
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'sixteen', 'columns' ) ); ?>>
	
					<?php echo do_shortcode( '[contact-form-7 id="252" title="Employee Application"]' ); ?>
	
				</article>
	
			<?php endwhile; ?>
	
			<?php endif; ?>

<?php get_footer(); ?>
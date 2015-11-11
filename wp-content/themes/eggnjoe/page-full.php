<?php // Template Name: Full-width ?>

<?php get_header(); ?>
		
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<?php

				if( has_post_thumbnail() ) :

					$banner_args = array(
						'class' => 'post-banner-img',
					);

				?>
				<div class="post-banner">
					<?php the_post_thumbnail( "post_banner", $banner_args ); ?>
				</div>
				<?php

				endif;

				?>
	
				<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'sixteen', 'columns' ) ); ?>>
	
					<?php the_content(); ?>
	
				</article>
	
			<?php endwhile; ?>
	
			<?php endif; ?>

<?php get_footer(); ?>
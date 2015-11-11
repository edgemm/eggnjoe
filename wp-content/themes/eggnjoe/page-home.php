<?php // Template Name: Home ?>

<?php get_header(); ?>

			<?php if( is_home() || is_front_page() ) { ?>
			<div class="container-slides home-slides">
				<?php // get from home slides post type with SlidesJS plugin

				// WP_Query arguments				
				//$slide_args = array (
				//	'post_type'		=> 'slide',
				//	'posts_per_page'	=> -1,
				//	'meta_key'		=> 'home_slide_order',
				//	'orderby'		=> 'meta_value_num',
				//	'order'			=> 'ASC'
				//);
	
				$slide_args = array(
					'post_type'		=> 'slide',
					'post_status'		=> 'publish',
					'posts_per_page'	=> -1,
					'tax_query'		=> array(
						array(
						'taxonomy'		=> 'slide_category',
						'field'			=> 'slug',
						'terms'			=> 'home-slider'
					)),
					'meta_key'		=> 'home_slide_order',
					'orderby'		=> 'meta_value_num',
					'order'			=> 'ASC'
				);
				
				// The Query
				$slides = new WP_Query( $slide_args );
				
				// The Loop
				if ( $slides->have_posts() ) {
					while ( $slides->have_posts() ) {
						$slides->the_post();

						$slide_thmb_url = wp_get_attachment_image_src( get_post_thumbnail_id( $slides->ID ), 'full' );
						$slide_thmb_alttitle = trim( strip_tags( get_the_title() ) );
				?>
					<div class="home-slide">
						<?php
						
						if( get_field( "slide_url" ) ) :
						
						?>
						<a href="<?php the_field( "slide_url" ); ?>">
						<? endif; ?>
							<img class="home-slide-img" src="<?php echo $slide_thmb_url['0']; ?>" alt="<?php echo $slide_thmb_alttitle; ?>" />
							<span class="img-title"><?php the_title(); ?></span>
						<?php
						
						if( get_field( "slide_url" ) ) :
						
						?>
						</a>
						<? endif; ?>
					</div>
				<?php
					}
				}

				// Restore original Post Data
				wp_reset_postdata(); ?>
			</div>
			<?php } ?>

			<div class="featured clear">

				<ul class="features">
					<li class="feature">
						<?php

						$hf_left = get_field( "home_feature_left" );
						$hf_left_link = get_field( "home_feature_left_url" );

						?>
						<a class="feature-link" href="<?php echo $hf_left_link; ?>">
							<img class="feature-thmb" src="<?php echo $hf_left[ 'url' ]; ?>" alt="<?php echo $hf_left[ 'title' ]; ?>" />
							<span class="img-title"><?php echo $hf_left[ 'title' ]; ?></span>
						</a>
					</li>
					<li class="feature">
						<?php

						$hf_middle = get_field( "home_feature_middle" );
						$hf_middle_link = get_field( "home_feature_middle_url" );

						?>
						<a class="feature-link" href="<?php echo $hf_middle_link; ?>">
							<img class="feature-thmb" src="<?php echo $hf_middle[ 'url' ]; ?>" alt="<?php echo $hf_middle[ 'title' ]; ?>" />
							<span class="img-title"><?php echo $hf_middle[ 'title' ]; ?></span>
						</a>
					</li>
					<li class="feature">
						<?php

						$hf_right = get_field( "home_feature_right" );
						$hf_right_link = get_field( "home_feature_right_url" );

						?>
						<a class="feature-link" href="<?php echo $hf_right_link; ?>">
							<img class="feature-thmb" src="<?php echo $hf_right[ 'url' ]; ?>" alt="<?php echo $hf_right[ 'title' ]; ?>" />
							<span class="img-title"><?php echo $hf_right[ 'title' ]; ?></span>
						</a>
					</li>
				</ul>

			</div>

			<?php add_navigation( "home" ); ?>

<?php get_footer(); ?>
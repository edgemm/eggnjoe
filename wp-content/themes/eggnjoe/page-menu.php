<?php // Template Name: Menu ?>

<?php get_header(); ?>

		<?php // retrieve and sort menu categories by sort order

		// array to store category ids
		$arr_menu_cats = array();

		$menu_cats_args = array(
			'fields'	=> "ids",
			'parent'	=> 0,
			'hide_empty'	=> 0
		);
		$menu_cats = get_terms( "menu_category", $menu_cats_args );

		if( !empty( $menu_cats ) ) :

			// add menu ids to array
			foreach( $menu_cats as $i ) :

				$sort_order = get_tax_meta( $i, "menu_cat_meta_sort" );
				$arr_menu_cats[ $sort_order ] = $i;

			endforeach;

			// sort categories by sort order
			ksort( $arr_menu_cats, SORT_NUMERIC );

		endif;

		$tab = $_GET['t'];

		if( !empty( $arr_menu_cats ) ) :

			echo '<div class="menu-sliders">';
				
			// counting sliders
			$counter_slider = 1;

			foreach( $arr_menu_cats as $s ) :

				$m = get_term( $s, "menu_category" );
				$cat_slug = $m->slug;

				// active class
				$a = " active";
	
				$menu_slider_args = array(
					'post_type'		=> 'slide',
					'post_status'		=> 'publish',
					'posts_per_page'	=> -1,
					'tax_query'		=> array(
						array(
						'taxonomy'		=> 'slide_category',
						'field'			=> 'slug',
						'terms'			=> $cat_slug
					)),
					'meta_key'		=> 'slide_order',
					'orderby'		=> 'meta_value_num',
					'order'			=> 'ASC'
				);
	
				$menu_slider_query = new WP_Query( $menu_slider_args );
	
				if( $menu_slider_query->have_posts() ) :
				
					// if equal to set tab, set active slide
					if( $cat_slug == $tab ) :

						$slider_active = $a;

					elseif( !$tab ) :

						$slider_active = ( $counter_slider == 1 ) ? $a : "";
						
					else :

						$slider_active = "";

					endif;

				?>
				<div id="slider-<?php echo $cat_slug; ?>" class="menu-slider slider-<?php echo $cat_slug . $slider_active; ?>" data-slider="<?php echo $cat_slug; ?>">
				<?php

					while( $menu_slider_query->have_posts() ) :

						$menu_slider_query->the_post();

						$slide_thmb_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'menu_slide' );
						$slide_thmb_alttitle = trim( strip_tags( get_the_title() ) );

					?>
					<img class="menu-slide" src="<?php echo $slide_thmb_url['0']; ?>" alt="<?php echo $slide_thmb_alttitle; ?>" />
					<?php

					endwhile;
				?>
				</div>
				<!-- /.menu-slider -->
				<?

				endif;
				
				$counter_slider++;

			endforeach;

			echo '</div>';
			echo "\n\t\t\t<!-- /.menu-sliders -->";

		endif;

		if( !empty( $arr_menu_cats ) ) :

			// start filter list
			echo '<ul class="filter">';

			// counter for filters
			$counter_filters = 1;

			// output filter menu of sorted categories
			foreach( $arr_menu_cats as $i ) :

				$m = get_term( $i, "menu_category" );
				$cat_name = $m->name;
				$cat_slug = $m->slug;

				// active class
				$a = ' class="active"';
				$filter_active = "";
				
				// if equal to set tab, set active slide, otherwise use counter
				if( $cat_slug == $tab ) :
				
					$filter_active = $a;

				elseif( !$tab ) :

					$filter_active = ( $counter_filters == 1 ) ? $a : '';

				else :

					$filter_active = "";

				endif;

				$html = '<li' . $filter_active . '>';
				$html .= '<a href="#tab-' . $cat_slug . '" data-slider-id="' . $cat_slug . '">';
				$html .= $cat_name;
				$html .= "</a></li>";

				echo $html;

				$counter_filters++;

			endforeach;

			// close filter list
			echo '</ul>';

			?>
			<div class="tab-content">
			<?php

			// counter for parent categories
			$counter_cats = 1;

			// output each subcategory and its items
			foreach( $arr_menu_cats as $c ) :

				// store parent category name
				$p = get_term( $c, "menu_category" );

				// active class
				$a = " active";

				// if equal to set tab, set active slide, otherwise use counter
				if( $p->slug == $tab ) :
				
					$cat_active = $a;

				elseif( !$tab ) :

					$cat_active = ( $counter_cats == 1 ) ? $a : '';

				else :

					$cat_active = "";

				endif;

			?>
				<div class="tab-pane row-fluid<?php echo $cat_active; ?>" id="tab-<?php echo $p->slug; ?>">
					<div class="grid-sizer"></div>
					<div class="gutter-sizer"></div>
			<?php
			
				// array for storing subcategory ids
				$arr_menu_subcats = array();

				$menu_subcat_args = array(
					'fields'	=> "ids",
					'parent'	=> $c
				);
				$menu_subcats = get_terms( "menu_category", $menu_subcat_args );
				
				if( !empty( $menu_subcats ) ) :

					// add menu ids to array
					foreach( $menu_subcats as $i ) :
						$sort_order = get_tax_meta( $i, "menu_cat_meta_sort" );
						$sort_order = ( $sort_order != "0" ) ? $sort_order : 99999 + $i;
						$arr_menu_subcats[ $sort_order ] = $i;
					endforeach;
		
					// sort categories by sort order
					ksort( $arr_menu_subcats, SORT_NUMERIC );
				
					foreach( $arr_menu_subcats as $i ) :
					
						$m = get_term( $i, "menu_category" );
						$name = $m->name;
						$desc = $m->description;

				?>
					<article class="menucardBox">
						<header>
							<h1 class="menucardBox-title"><?php echo $name; ?></h1>
						</header>
						<?php // add description if available

						if( !empty( $desc ) ) :
						
						?>
						<p class="menucardBox-desc"><?php echo $desc; ?></p>
						<?php
						
						endif;
						
						?>
						<ul class="menucardBox-items">
						<?php // retrieve and list all items in subcategory

						$subcat_items_args = array(
							'post_type'		=> 'menu_item',
							'post_status'		=> 'publish',
							'posts_per_page'	=> -1,
							'tax_query'		=> array(
								array(
								'taxonomy'		=> 'menu_category',
								'field'			=> 'id',
								'terms'			=> $i
							)),
							'meta_key'		=> 'menu_item_sort_order',
							'orderby'		=> 'meta_key',
							'order'			=> 'ASC'
						);

						$subcat_items_query = new WP_Query( $subcat_items_args );

						if( $subcat_items_query->have_posts() ) :
							while( $subcat_items_query->have_posts() ) :
								$subcat_items_query->the_post();
							?>
							<li class="menucardBox-item clear">
								<?php


								// display image if present
								if( has_post_thumbnail() ) :

									$imgThmb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'menu_thmb' );
									$imgThmb = $imgThmb['0'];
									$imgFull = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'menu_thmb' );
									$imgFull = $imgFull['0'];

								?>
								<figure class="menucardBox-item-img">
									<!--<a class="fancybox" href="<?php echo $imgFull; ?>">-->
									    <img class="menucardBox-item-thmb" src="<?php echo $imgThmb; ?>" alt="">
									<!--</a>-->
								</figure>
								<?php

								endif;
								
								?>
								<h2 class="menucardBox-item-title"><?php the_title(); ?></h2>
								<?php the_content(); ?>
							</li>
							<?php
							endwhile;
						else :
							echo "nothing to see here";
						endif;

						wp_reset_query();

						?>
						</ul>
					</article>
				<?php

					endforeach;
					
				endif;

				?>
				</div>
			
			<?php
			
			$counter_cats++;
		
			endforeach;
			
			?>
			</div>

		<?php
		endif;
		?>

<?php get_footer(); ?>
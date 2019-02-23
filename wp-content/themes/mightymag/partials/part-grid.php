<div id="mgm-grid">
		
		<?php // Query to get posts with thumbnails only

		if (is_category( )) {
			
			$cat = get_query_var('cat');
			$yourcat = get_category ($cat);
			
			/* Category Query */
			$args = array(
			'posts_per_page' => 5,
			'meta_key' => '_thumbnail_id',
			'category_name' => $yourcat->slug
			);
			
		} else {
			
			/* Homepage Query */			
			$args = array(
			'posts_per_page' => 3,
			'meta_key' => '_thumbnail_id',
			'offset' => of_get_option('mgm_slider_1_count'),
			'ignore_sticky_posts' => 1,
//			'cat' => of_get_option('mgm_grid_cat'),
			);
			
		}
		query_posts($args); 	
		?>

		<?php 
		$count = 1;  
		while(have_posts()) : the_post(); 
		?>
		
			<div class="mgm-grid-block<?php if($count == 1) { echo ' mgm-grid-wide'; } ?>">
			
			
			
				<a class="mgm-overtitle" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'mightymag' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
					<span class="mgm-grid-title"><?php the_title();?></span>
				</a>
				
				<?php if($count == 1) { the_post_thumbnail('grid-wide'); } else { the_post_thumbnail('grid'); } ?>

			</div>
			
		<?php $count++; endwhile; ?>
		
		<?php wp_reset_query(); ?>
		
</div><!-- mgm.grid -->
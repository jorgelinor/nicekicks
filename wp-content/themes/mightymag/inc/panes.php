<?php
function mgm_cat_tabs($content) { ?>

<ul class="clearfix">
	<?php
	$tab_tag = of_get_option($content.'_tag'); 
	$tab_cat = of_get_option($content.'_category');
	$tab_display = of_get_option($content.'_display'); 
     ?>
	
	<?php if($tab_display == 'category') { ?>
	<?php query_posts(array('posts_per_page' => 3, 'cat' => $tab_cat )); ?>
	<?php } ?>
	<?php if($tab_display == 'latest') { ?>
	<?php query_posts(array('posts_per_page' => 3 )); ?>
	<?php } ?>
	<?php if($tab_display == 'tag') { ?>
	<?php query_posts(array('posts_per_page' => 3, 'tag' => $tab_tag )); ?>
	<?php } ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
	<?php 
	
	$category = get_the_category(); 
	$category_ID =  $category[0]->cat_ID;		
	$category_parent = pa_category_top_parent_id ($category_ID);
	
	// Get current category CSS
	$category_color = get_tax_meta($category_ID,'mgm_color_field_id');

	// Get Video Icon
	$mgm_video = get_post_meta(get_the_ID(), 'mgm_video_encode', true);
	$mgm_has_video = $mgm_video != ""; 
?>
	
	<li class="col-md-4 col-sm-6 article-content-wrapper">

		<div class="img-frame<?php if ( !has_post_thumbnail() ) echo ' no-thumb'?>">
			<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'loop', array( 'alt' => get_the_title(), 'title' => get_the_title() ) );
					
					} else {
						
				echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'"><span class="no-thumb-img"></span></a>'; }
			
				if ( $mgm_has_video ) { echo '<span class="mgm-video-icon"><span class="glyphicon glyphicon-play"></span></span>'; }
			?>
			
			<a class="img-hover-info" href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?> "><?php _e('Read More', 'mightymag')?>
			
			<?php
					$mgm_review_enable = get_post_meta(get_the_ID(), 'mgm_review_enable', true);
					$mgm_review_scale = get_post_meta(get_the_ID(), 'mgm_review_scale', true);
					$mgm_overall_score = get_post_meta(get_the_ID(), 'mgm_overall_score', true);
	
					if ( $mgm_review_enable ) { 
				
						if ( $mgm_review_scale == 'percent' ) {
					
						?>
						<span class="entry-rating-wrap">
							<span class="entry-rating" style="width: <?php echo $mgm_overall_score ?>%"><?php echo $mgm_overall_score ?></span>
						</span>

						<?php } else { ?>
						
						<span class="rw-criteria stars-preview stars-small">
							<span class="criteria-stars-color">
								<span class="criteria-stars-overlay" style="width:<?php echo $mgm_overall_score; ?>%"></span>
							</span>
						</span>
						
						<?php } 
				}
			?>
			</a><!-- .img-hover-info -->
		
		</div><!-- img-frame -->
	

		<div class="boxed entry-block">
			<h3 class="entry-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3>
		
			<span class="entry-details">
				
					<span class="entry-posted-on"><?php mgm_posted_on(); ?></span>
					<span class="pull-right">
						
						<span class="entry-details-item">
							<?php echo mgm_get_post_views(get_the_ID()); //Show Post Views ?>
						</span>
						
						<span class="entry-details-item">
							<a href="<?php comments_link(); ?>">
								<span class="glyphicon glyphicon-comment"></span>
								<?php comments_number( '0', '1', '%' ); ?>
							</a>
						</span>
						
					</span>
				</span>
				
		</div><!-- boxed -->	
		
	</li>
	<?php endwhile; ?>

	<?php  endif; ?>
	<?php wp_reset_query(); ?>
</ul>

<?php } ?>
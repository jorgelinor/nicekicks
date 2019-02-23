<?php
/**
 * @package MightyMag
 * @since MightyMag 1.0
 */
?>

<?php 

$mgm_video = get_post_meta(get_the_ID(), 'mgm_video_encode', true);
$mgm_has_video = $mgm_video != ""; 


if ( !is_search() ) {
$category = get_the_category();
$category_ID =  $category[0]->cat_ID;		
$category_parent = pa_category_top_parent_id ($category_ID);
$category_color = get_tax_meta($category_ID,'mgm_color_field_id');
}

$cat_tooltip = of_get_option('mgm_cat_tooltip');

$mgm_review_enable = get_post_meta(get_the_ID(), 'mgm_review_enable', true);
$mgm_review_scale = get_post_meta(get_the_ID(), 'mgm_review_scale', true);
$mgm_overall_score = get_post_meta(get_the_ID(), 'mgm_overall_score', true);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('pull-left box'); // Apply Masonry Classes ?>>

<div class="article-content-wrapper wow fadeInUp entry-main-content<?php if ( is_sticky() ) echo ' sticky';?><?php if ( !has_post_thumbnail() ) echo ' without-featured'?>">

			
	<?php if ( has_post_thumbnail() OR $mgm_has_video ) { ?>
	
	<div class="entry-img">
		<div class="img-frame">

			<?php if ( has_post_thumbnail() ) { ?>
		
					<?php the_post_thumbnail('loop'); ?>
								
			<?php } else { 
			
			 echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" ><span class="no-thumb-img"></span></a>'; 
			 
			 } ?>
			
			<?php if ( $mgm_has_video ) { echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" ><span class="mgm-video-icon"><span class="glyphicon glyphicon-play"></span></span></a>'; } ?>
			
			
			<a class="img-hover-info<?php if ( $mgm_review_scale == 'percent' ) { echo ' preview-percent'; } ?>" href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?> ">
			<?php _e('Read More', 'mightymag')?>
			
			<?php 			
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
	</div><!--entry-img -->
	<?php } ?>


		<div class="entry-block boxed">
		
				<header>
				
					<?php if ( has_post_thumbnail() OR $mgm_has_video ) echo ''; ?>
	
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'mightymag' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2>
			
					<?php if ( 'post' == get_post_type() ) : ?>
					
					<?php endif; ?>
					
				</header><!-- .entry-header -->
	
					<?php 
					$excerpt = get_the_excerpt();
					$excerpt_count = of_get_option('mgm_excerpt_count');	
						
						if (of_get_option('mgm_excerpt') == 'moretag') 
							the_content( '<span class="label label-cat" style="background-color: '. $category_color .'"> ' . __('Continue Reading', 'mightymag') . ' <span class="meta-nav">&rarr;</span></span>' );
					
						elseif ($excerpt != '0') {
							 echo '<p>';
							 echo mgm_string_limit_words($excerpt,$excerpt_count);
							 echo '<a href="';
							 echo the_permalink();
							 echo '" title="';
							 echo the_title();
							 echo '" class="readmore">...More</a>';
							 echo '</p>';
						};
					?>
	
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span>' . __( 'Pages:', 'mightymag' ) . '</span>', 'after' => '</div>' ) ); ?>
				
				<span class="entry-details">
				
					<span class="entry-posted-on"><?php mgm_posted_on(); ?></span>
					
					<?php if ( is_sticky() ) {?>
					<span class="mgm-sticky"><span class="glyphicon glyphicon-paperclip"></span><?php _e('Sticky!', 'mightymag')?></span>
					<?php } ?>
					
					<span class="pull-right">
						

						
						<span class="entry-details-item">
							<a href="<?php comments_link(); ?>">
								<span class="glyphicon glyphicon-comment"></span>
								<?php comments_number( '0', '1', '%' ); ?>
							</a>
						</span>
						
					</span>
				</span>
				
		</div><!-- .boxed -->
		
		<?php include ( get_template_directory() . '/partials/part-social-share.php'); // Get ratings output ?>
	
	</div><!-- article-content-wrapper-->
</article><!-- #post-<?php the_ID(); ?> -->
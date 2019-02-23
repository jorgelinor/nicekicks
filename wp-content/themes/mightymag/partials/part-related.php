<?php
$tags = wp_get_post_tags($post->ID);
if ($tags) {
$tag_ids = array();
foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

$mgm_related_count = of_get_option('mgm_related_count');

$args=array(
'tag__in' => $tag_ids,
'post__not_in' => array($post->ID),
'showposts'=> $mgm_related_count,  // Number of related posts that will be shown.
'ignore_sticky_posts'=>1
);

$i = 1;

$my_query = new wp_query($args);
if( $my_query->have_posts() ) {
	
echo '<div id="mgm-related-wrap" class="row">';

echo '<h4 class="mgm-title col-md-12">
		<span>' . __('You may also like' , 'mightymag') . '</span>
	  </h4>';

while ($my_query->have_posts()) {
$my_query->the_post();
?>

<?php 
$mgm_video = get_post_meta(get_the_ID(), 'mgm_video_encode', true);
$mgm_has_video = $mgm_video != ""; 
?>
<div class="mgm-related-item col-md-6 wow fadeInUp">
	<div class="boxed custom-widget<?php if ( !has_post_thumbnail() ) { echo ' img-less'; } ?>">
				
		<h3 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title() ?></a>
			
			<?php 
			
			$mgm_review_enable = get_post_meta(get_the_ID(), 'mgm_review_enable', true);
			$mgm_overall_score = get_post_meta(get_the_ID(), 'mgm_overall_score', true);
			$mgm_review_scale = get_post_meta(get_the_ID(), 'mgm_review_type', true);		
			
			if ( $mgm_review_enable ) { 
		
				if ( $mgm_review_scale == 'percent' ) {
			
				?>
			
				<span class="entry-rating-wrap">
					<span class="entry-rating"><?php echo $mgm_overall_score ?></span>
				</span>
			
				<?php } else { ?>
				
				<span class="rw-criteria stars-preview stars-small">
					<span class="criteria-stars-color">
						<span class="criteria-stars-overlay" style="width:<?php echo $mgm_overall_score; ?>%"></span>
					</span>
				</span>
				
				<?php } 
			} ?>
		
		</h3>
		
		
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="entry-img">
			<div class="img-frame pull-left">
					
			<?php the_post_thumbnail( 'mini-square', array( 'alt' => get_the_title(), 'title' => get_the_title() ) );
			
				if ( $mgm_has_video ) { echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'" ><span class="mgm-video-icon mgm-video-icon-xs"><span class="glyphicon glyphicon-play"></span></span></a>'; }
			?>	
			</div><!--.img-frame-->
			
		</div><!--.entry-img -->
		<?php } ?>
		
		<p>
		<?php echo mgm_string_limit_words(get_the_excerpt(), 15); ?>...<a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="readmore"><?php _e('More', 'mightymag')?></a>
		</p>
		
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
	
	</div><!-- .boxed .related-posts -->
</div>

<?php 

if ( ($i % 2 == 0) && $mgm_related_count > 2 ) {
	
	echo '<div class="clear with-space"></div>';} 

$i++;

}
echo '</div>';
}
}
wp_reset_query();
?>

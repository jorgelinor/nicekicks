<?php
/**
 * @package MightyMag
 * @since MightyMag 1.0
 */
?>

<?php

/* Get ratings output */
include ('inc/rating-values.php');

/* Variables */
$full_width = get_post_meta(get_the_ID(), 'mgm_full_width_switch', true);
$small_featured = get_post_meta(get_the_ID(), 'mgm_small_featured_switch', true); 
$hide_featured = get_post_meta(get_the_ID(), 'mgm_hide_featured_switch', true); 
$has_post_thumbnail = has_post_thumbnail();
$mgm_video = get_post_meta(get_the_ID(), 'mgm_video_encode', true);
$mgm_has_video = $mgm_video != "";
$social_multicheck = of_get_option('mgm_social_share'); 
$mgm_comment_type = get_post_meta(get_the_ID(), 'mgm_comment_type', true);
$social_share = of_get_option('mgm_social_share_switch');
$social_share_pos = of_get_option('mgm_social_share_position');

/* Load Facebook SDK when needed */
if ($social_multicheck['fb_share'] == true OR $mgm_comment_type == 'fb') { include(locate_template('partials/part-fb-sdk.php')); }

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header boxed">
		
		<?php if ( of_get_option('mgm_breadcrumb') ) echo mgm_breadcrumb(); ?>
		
		<h1 class="entry-title"><?php the_title(); ?></h1>		
		
		<div class="clear"></div>
		
		<div class="entry-details clearfix">
			
			<div class="mgm-cat">
			
				<?php
					$categories = get_the_category();
					$separator = ' ';
					$output = '';
					
					if($categories){
						foreach($categories as $category) {
							
							$category_ID =  $category->cat_ID;	
							$category_color = get_tax_meta($category_ID,'mgm_color_field_id');	
							
							$output .= '<a style="background-color: ' . $category_color . '" href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'mightymag' ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
						}
					echo trim($output, $separator);
					}
				?>

			</div>
			
			<span class="mgm-details">
			
				<span class="entry-posted-on"><?php mgm_posted_on(); ?></span>
				

				
				<span class="entry-details-item">
					<a href="<?php comments_link(); ?>">
						<span class="glyphicon glyphicon-comment"></span>
						<?php comments_number( '0', '1', '%' ); ?>
					</a>
				</span>
				
			</span>

		</div><!--entry-details-->
				
<div class="addthis_jumbo_share"></div>

	</header><!-- .entry-header -->
	
	<?php 
	/* Social Share Links with small featured images (before) */
	
	if ( $small_featured ) { 
	
		if ( $social_share AND $social_share_pos == 'top' OR $social_share_pos == 'both' ) {get_template_part( 'partials/part', 'social-share' ); } 
	
	} ?>


	<?php 
	/* Include Featured Image / Video */
	if (!$hide_featured) include(locate_template('partials/part-featured-image.php')); 
	?>

	<?php 
	/* Social Share Link with regular featured images (after) */
	
	if ( !$small_featured ) { 
	
		if ( $social_share AND $social_share_pos == 'top' OR $social_share_pos == 'both' ) {get_template_part( 'partials/part', 'social-share' ); } 
	
	} ?>
	
		<?php //Get Affiliate Link Stripe
		$mgm_affiliate = get_post_meta($post->ID, 'mgm_affiliate', true);
			if ($mgm_affiliate != NULL ) { get_template_part ('partials/part', 'review-affiliate'); 
		} ?>
	<?php 
	/* Display top rating box if enabled */ 
		if ( ($mgm_review_enable) AND ($mgm_box_position) == 'top' ) {  
			
			if ( ($mgm_review_scale) == 'percent' ) {
				include('partials/part-review-percent.php');
			} else {
				include('partials/part-review-stars.php');	
			}
		}
	?>

	
	<div class="entry-content clearfix">
		
		<?php the_content(); ?>
		<?php wp_link_pages( array(
					 'before' 	  => '<div class="page-links"><span class="mgm-share-text">' . __( 'Pages:', 'mightymag' ) . '</span>', 
					 'after' 	  => '</div>',
					 'pagelink'   => '<span class="page-links-numbers">%</span>',

					 ) 
		); ?>

		
	</div><!-- .entry-content -->
	

	<?php 
	/* Display bottom rating box if enabled */ 
		if ( ($mgm_review_enable) AND ($mgm_box_position) == 'bottom' ) {  
			
			if ( ($mgm_review_scale) == 'percent' ) {
				include('partials/part-review-percent.php');
			} else {
				include('partials/part-review-stars.php');	
			}
		}
	?>
	
	<?php 
	/* Social Share Link */
	$social_share = of_get_option('mgm_social_share_switch');
	$social_share_pos = of_get_option('mgm_social_share_position');
	
	if ( $social_share AND $social_share_pos == 'bottom' OR $social_share_pos == 'both'  ) {get_template_part( 'partials/part', 'social-share' ); } 
	?>
	
	<footer class="entry-meta clearfix">
		
		
		<div class="tag-list">
			<span class="mgm-share-text"><?php _e('Tagged','mightymag'); ?></span>
			
			<?php /* Show tags mod @since MGM 1.2 */
			
			$tags = get_the_tags();
				
				if( $tags ) :
			  		foreach( $tags as $tag ) { ?>
					<a href="<?php echo get_tag_link($tag->term_id); ?>"><span><?php echo $tag->name; ?></span></a>
			<?php }
			
			endif; ?>
			
		</div>
		

		<?php edit_post_link( '<div class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit Post', '<span class="edit-link">', '</span></div>' ); ?>
	</footer><!-- .entry-meta -->
	
</article><!-- #post-<?php the_ID(); ?> -->

<?php 
/*Get Author Box*/
if ('post' == get_post_type() && ( of_get_option('mgm_author')) ) echo get_template_part ('partials/part', 'author');
?>

<div id="wvn_600">
<?php
	/** WOVEN **/
	if ( function_exists('woven_render_adunit') ) {
		if ( 'desktop' == woven_platform_detect() ) {
			woven_render_adunit( 'btf', 600 );
		}
	}
?>
</div>

<?php 
/*Get Related Posts*/
if (of_get_option('mgm_related')) get_template_part('partials/part', 'related');?>
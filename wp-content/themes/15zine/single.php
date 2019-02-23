<?php

get_header();
$cb_post_id = $post->ID;
$cb_featured_image_style_override_onoff = ot_get_option('cb_post_style_override_onoff', 'off');
$cb_featured_image_style_override_style = ot_get_option('cb_post_style_override', 'standard');
$cb_post_format = get_post_format();
$cb_video_post_select = get_post_meta( $cb_post_id, 'cb_video_post_select', true );
$cb_audio_post_select = get_post_meta( $cb_post_id, 'cb_audio_post_style', true );
$cb_featured_image_style = get_post_meta( $cb_post_id, 'cb_featured_image_style', true );
$cb_featured_image_style_override_post_onoff = get_post_meta( $cb_post_id, 'cb_featured_image_style_override', true );
$cb_sidebar_position = cb_get_sidebar_setting();
$cb_featured_image_style_cache = NULL;

if ( ( $cb_featured_image_style_override_onoff == 'on' ) && ( $cb_featured_image_style_override_post_onoff != 'on') ) {
   $cb_featured_image_style = $cb_featured_image_style_override_style;
}

if ( $cb_featured_image_style == NULL ) {
     $cb_featured_image_style = 'standard';
}
if ( $cb_featured_image_style == 'standard-uncrop' ) {
	$cb_featured_image_style = 'standard';
}

if ( ( $cb_post_format == 'video') || ( $cb_post_format == 'audio') ) {
	$cb_featured_image_style_cache = $cb_featured_image_style;
	$cb_featured_image_style = $cb_post_format;
}
if ( $cb_post_format == 'gallery' ) {
	$cb_gallery_post_images = get_post_meta( $cb_post_id, 'cb_gallery_post_images', true );
        
    if ( $cb_gallery_post_images != NULL ) {

		$cb_featured_image_style = $cb_post_format;
	}
}
if ( ( $cb_featured_image_style != 'off' ) && ( $cb_featured_image_style_cache != 'off' ) && ( $cb_featured_image_style != 'standard' ) && ( $cb_featured_image_style_cache != 'standard' )  ) { do_shortcode ( cb_featured_image_style( $cb_featured_image_style, $post ) ); } 

?>

	<div class="adslot visible-mobile hidden-desktop hidden-tablet"><!-- /1015938/nicekicks_320x50_ROS -->
	<div id='div-gpt-ad-1466196178639-3' style='min-height:50px; width:320px;'>
	<script type='text/javascript'>
	googletag.cmd.push(function() { googletag.display('div-gpt-ad-1466196178639-3'); });
	</script>
	</div></div>

	<div class="adslot visible-desktop visible-tablet hidden-mobile" id="div-gpt-ad-1467959679894-4" style="min-width: 970px;" data-zone="Pushdown" data-cids="" data-size="[[970, 1], [970, 66], [970, 250]]"></div>

<div id="cb-content" class="wrap clearfix">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<div id="main" class="cb-main" role="main">

			<?php cb_breadcrumbs(); ?>

                        <?php if(function_exists('the_ratings')) { the_ratings(); } ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

				<?php if ( ( $cb_featured_image_style == 'off' ) || ( $cb_featured_image_style == 'standard' ) || ( $cb_featured_image_style_cache == 'standard' ) || ( $cb_featured_image_style_cache == 'off' )  ) { cb_featured_image_style( $cb_featured_image_style, $post ); }; ?>

				<section class="cb-entry-content clear fix">

					<?php the_content(); ?>
					<?php wp_link_pages('before=<div class="cb-pagination clearfix">&after=</div>&next_or_number=number&pagelink=<span class="cb-page">%</span>'); ?>

				</section> <!-- end article section -->

				<footer class="cb-article-footer">
					<?php
						if ( ot_get_option('cb_tags_onoff', 'on') != 'off' ) { the_tags('<p class="cb-tags cb-post-footer-block"> ', '', '</p>'); }
						echo cb_sharing_block( $post ); 
						echo cb_post_footer_ad();
						if ( $post->post_type != 'attachment' ) { cb_previous_next_links(); }
						echo cb_about_author( $post );
					?>

						<div class="visible-desktop visible-tablet">
						    <div class="adslot" id="div-gpt-ad-1466196178639-5" style="width: 600px; min-height: 0; margin: 0 auto 20px;">
						        <script type='text/javascript'>
						            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1466196178639-5'); });
						        </script>
						    </div>
						</div>
					
					<?php
						cb_related_posts(); 
						comments_template(); 
                     ?>
				</footer> <!-- end article footer -->

			</article> <!-- end article -->

		</div> <!-- end #main -->

	<?php endwhile; ?>

	<?php endif; ?>

	<?php 
		if ( ( $cb_sidebar_position != 'nosidebar' )  && ( $cb_sidebar_position != 'nosidebar-fw' ) ) { 
			get_sidebar(); 
		} 
	?>


</div> <!-- end #cb-content -->

<?php get_footer(); ?>
<?php
/**
 * Single
 *
 * @package      NiceKicks
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

/**
 * Top Area
 *
 */
function be_single_top_area() {
	wp_enqueue_script( 'be-single' );

	$video = get_post_meta( get_the_ID(), 'be_show_video', true );
	if( $video )
		$video = wp_oembed_get( esc_url( get_post_meta( get_the_ID(), 'be_video_url', true ) ), array( 'width' => '970' ) );
	$gallery = get_post_meta( get_the_ID(), 'be_gallery', true );
	if( empty( $video ) && empty( $gallery ) )
		return;
	
	$class = !empty( $video ) ? 'top-area video' : 'top-area gallery';	
	echo '<div class="' . $class . '">';
	if( $video ) {
		echo $video;
	} else {
		echo '<div class="flexslider"><ul class="slides">';
		foreach( $gallery as $image_id )
			echo '<li>' . wp_get_attachment_image( $image_id, 'be_top' ) . '</li>'; 
		echo '</ul></div>';
	}
	echo '</div>';
}
add_action( 'genesis_before_content_sidebar_wrap', 'be_single_top_area' );

// Sharing after post info
add_action( 'genesis_before_post_content', 'be_sharing', 15 );

	
// Remove After Nav widget area
remove_action( 'genesis_after_header', 'be_after_nav_widget_area' );
?>


<?php 

/**
 * Single Thumbnail
 *
 */
function be_single_thumbnail() {
	global $post;
	$exclude = get_post_meta( $post->ID, 'be_no_featured_image', true );
	
	if( !has_post_thumbnail() || 'on' == $exclude ) 
		return;
	
	echo '<div class="featured-image">' . get_the_post_thumbnail( $post->ID, 'be_full' ) . '</div>';
}

// If statement to hide Featured Image on multipage posts except for first page
$paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : false;
   if( $paged === false ) {
add_action( 'genesis_before_post_content', 'be_single_thumbnail', 20 );
	}

// Post Meta
add_action( 'genesis_after_post_content', 'genesis_post_meta' );


/**
 * Related Posts
 *
 */
 function be_related_posts() {
 	global $be_exclude;
	$be_exclude = array( get_the_ID() );
	$tags = wp_get_post_tags( get_the_ID() );
	$tags = wp_list_pluck( $tags, 'term_id' );
	if( empty( $tags ) )
		return;

	$args = array(
		'tag__in'               => $tags,
		'post__not_in'          => $be_exclude,
		'posts_per_page'        => 5,
		'ignore_sticky_posts'   => 1,
	);

	remove_action( 'genesis_before_post_content', 'be_sharing', 15 );
	remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_post_content', 'be_nicekicks_content' );
remove_action( 'genesis_before_post_content', 'be_single_thumbnail', 20 );
	remove_action( 'genesis_after_post_content', 'be_related', 20 );
	remove_action( 'genesis_loop_else', 'genesis_do_noposts' );
	remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );


	echo '<div class="related-posts"><h3>More Stories</h3>';
	genesis_custom_loop( $args );
	echo '</div>';
}
add_action( 'genesis_after_loop', 'be_related_posts' );

genesis();

?>

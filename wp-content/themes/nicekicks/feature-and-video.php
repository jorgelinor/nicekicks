<?php
/**
 * Feature tag
 *
 * @package      NiceKicks
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright © 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */


// Remove Items from posts
remove_action( 'genesis_before_post_content', 'genesis_post_info' );
remove_action( 'genesis_post_content', 'be_nicekicks_content' );
remove_action( 'genesis_after_post_content', 'be_sharing', 15 );

/**
 * Change Image Size
 *
 */
function be_feature_tag_image_size( $size ) {
	return 'be_full';
}
add_filter( 'genesis_pre_get_option_image_size', 'be_feature_tag_image_size' );

/**
 * Post Class
 *
 */
function be_feature_post_class( $classes ) {
	$classes[] = 'feature-style';
	return $classes;
}
add_filter( 'post_class', 'be_feature_post_class' );

genesis();
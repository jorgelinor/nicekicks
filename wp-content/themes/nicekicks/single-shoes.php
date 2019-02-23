<?php
/**
 * Single Shoe
 *
 * @package      NiceKicks
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */

// Remove Post Info
remove_action( 'genesis_before_post_content', 'genesis_post_info' );

// Remove After Nav widget area
remove_action( 'genesis_after_header', 'be_after_nav_widget_area' );

/**
 * Single Thumbnail
 *
 */
function be_single_thumbnail() {
	if( !has_post_thumbnail() ) return;
	
	global $post;
	echo '<div class="featured-image">' . get_the_post_thumbnail( $post->ID, 'be_full' ) . '</div>';
}
add_action( 'genesis_before_post_content', 'be_single_thumbnail', 20 );

/**
 * Shoe Information
 *
 */
function be_shoe_information() {
	global $post;
	$model = esc_attr( get_post_meta( $post->ID, 'be_shoe_model', true ) );
	$color = esc_attr( get_post_meta( $post->ID, 'be_shoe_color', true ) );
	$article = esc_attr( get_post_meta( $post->ID, 'be_shoe_article', true ) );
	$date = esc_attr( get_post_meta( $post->ID, 'be_shoe_release_date', true ) );
	if( !empty( $date ) ) {
		$format = esc_attr( get_post_meta( $post->ID, 'be_shoe_release_date_format', true ) );
		$format = ( 'day' == $format ) ? 'day' : 'month';
		$date = ( 'day' == $format ) ? date( 'M j, Y', $date ) : date( 'M, Y', $date );
	}
	$price = esc_attr( get_post_meta( $post->ID, 'be_shoe_price', true ) );
	echo '<p class="info">';
	the_terms( $post->ID, 'brand', 'Brand: ', ' ', '<br />' );
	if( !empty( $model ) ) echo 'Model: ' . $model . '<br />';
	if( !empty( $color ) ) echo 'Color: ' . $color . '<br />';
	if( !empty( $article ) ) echo 'Article #: ' . $article . '<br />';
	if( !empty( $date ) ) echo 'Release: ' . $date . '<br />';
	if( !empty( $price ) ) echo 'MSRP: $' . number_format( $price ) . '<br />';
	echo '</p>';
}
add_action( 'genesis_after_post_content', 'be_shoe_information' );

genesis();
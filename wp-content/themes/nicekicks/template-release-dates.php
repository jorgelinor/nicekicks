<?php
/**
 * Template Name: Release Dates
 *
 * @package      NiceKicks
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */
 
/**
 * Upcoming Shoes Loop
 *
 */
function be_upcoming_shoes_loop() {
	$args = array(
		'post_type' => 'shoes',
		'posts_per_page' => '-1',
		'orderby' => 'meta_value_num',
		'order' => 'ASC',
		'meta_key' => 'be_shoe_release_date',
		'meta_query' => array(
			array(
				'key' => 'be_shoe_release_date',
				'value' => time(),
				'compare' => '>'
			),
				array(
				'key' => 'be_shoe_featured',
				'value' => 'on'
			)
		)
	);
	
	be_shoe_loop( $args, true );

}
add_action( 'genesis_after_post_content', 'be_upcoming_shoes_loop' );
 
genesis();
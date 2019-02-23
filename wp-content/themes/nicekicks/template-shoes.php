<?php
/**
 * Template Name: Shoes
 *
 * @package      NiceKicks
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */
 
/**
 * Add Shoes Loop
 *
 */
function be_shoes_loop() {
	$args = array(
		'post_type' => 'shoes'
	);
	
	be_shoe_loop( $args );
}
add_action( 'genesis_after_loop', 'be_shoes_loop' );
 
genesis();
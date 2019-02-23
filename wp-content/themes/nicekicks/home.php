<?php
/**
 * Home
 *
 * @package      NiceKicks
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */
 
/**
 * Home Scripts
 *
 */
function be_home_scripts() {
	wp_enqueue_style( 'flexslider' );
	wp_enqueue_script( 'be-home' );
}
add_action( 'wp_enqueue_scripts', 'be_home_scripts' );

/** 
 * Add widget area above posts
 *
 */
function be_home_rotator() {
	$args = array(
		'posts_per_page' => 5, 
'ignore_sticky_posts' => 1,
		'meta_query' => array(
			array(
				'key' => 'be_rotator_include',
				'value' => 'on',
			)
		)
	);
	$loop = new WP_Query( $args );
	if( $loop->have_posts() ):
		echo '<div class="flexslider"><ul class="slides">';
		while( $loop->have_posts() ): $loop->the_post();
			echo '<li data-thumb="' . genesis_get_image( array( 'size' => 'be_rotator', 'format' => 'url' ) ) . '">
				<a href="' . get_permalink() . '">' . genesis_get_image( array( 'size' => 'be_rotator' ) ) . '</a>
				<div class="flex-caption"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>
			</li>';
		endwhile;
		echo '</ul></div>';
	endif;
	wp_reset_postdata();
}
add_action( 'genesis_before_loop', 'be_home_rotator' );

genesis();
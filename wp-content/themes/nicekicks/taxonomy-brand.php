<?php
/**
 * Brand Taxonomy
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
function be_tax_shoes_loop() {

	// So sidebar scrolls
	wp_enqueue_script( 'be-single' );

	// Shoe Listing
	$args = array(
		'post_type' => 'shoes',
		'brand' => get_query_var( 'brand' ),
		'posts_per_page' => -1,
	);
	echo '<div class="shoes-listing">';
	echo '<h3>Upcoming Releases</h3>';
	be_shoe_loop( $args );
	echo '</div>';
	
	// Related Posts
	$term =  get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );	
	$related = get_option( 'brand_' . $term->term_id . '_related_category' );
	if( !empty( $related ) ):

		$args = array(
			'posts_per_page'        => 5,
			'ignore_sticky_posts'   => 1,
			'cat'                   => $related,
		);
	
		remove_action( 'genesis_before_post_content', 'be_sharing', 15 );
		remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
		remove_action( 'genesis_after_post_content', 'be_related', 20 );
		remove_action( 'genesis_loop_else', 'genesis_do_noposts' );
		remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
	
		
		echo '<div class="related-posts"><h3>Related Stories</h3>';
		genesis_custom_loop( $args );
		echo '</div>';
	endif;
}
add_action( 'genesis_loop', 'be_tax_shoes_loop' );
remove_action( 'genesis_loop', 'genesis_do_loop' );
 
genesis();
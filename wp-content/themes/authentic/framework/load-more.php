<?php
/**
 * Load More Posts via AJAX.
 *
 * @package Authentic Wordpress Theme
 * @subpackage Framework
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * Localize the main theme scripts.
 */
function csco_load_more_js() {

	$query_args = csco_get_query_args();

	if ( 'ajax' === $query_args['pagination_type'] ) {

		global $wp_query;

		$args = array(
			'nonce'       => wp_create_nonce( 'csco-load-more-nonce' ),
			'url'         => admin_url( 'admin-ajax.php' ),
			'query_args'  => wp_json_encode( $query_args ),
			'query_vars'  => wp_json_encode( $wp_query->query_vars ),
			'translation' => array(
				'load_more' => esc_html__( 'Load More', 'authentic' ),
				'loading'   => esc_html__( 'Loading…', 'authentic' ),
				),
		);

		wp_localize_script( 'csco_js_scripts', 'csco_ajax_pagination', $args );

	}
}

add_action( 'wp_enqueue_scripts', 'csco_load_more_js' );

/**
 * AJAX Load More
 */
function csco_ajax_load_more() {

	check_ajax_referer( 'csco-load-more-nonce', 'nonce' );

	$args = isset( $_POST['query_vars'] ) ? json_decode( stripslashes( $_POST['query_vars'] ), true ) : array();
	$args['post_type'] = isset( $args['post_type'] ) ? $args['post_type'] : 'post';
	$args['paged'] = intval( $_POST['page'] );
	$args['post_status'] = 'publish';

	ob_start();

	$loop = new WP_Query( $args );

	if ( $loop->have_posts() ) :

		// Get archive settings. See /framework/core-functions.php for details.
		$query_args = isset( $_POST['query_args'] ) ? json_decode( stripslashes( $_POST['query_args'] ), true ) : array();

		// Set query vars, so that we can get them across all templates.
		set_query_var( 'csco_query', $query_args );

		// Get total number of posts.
		$total = $loop->post_count;

		while ( $loop->have_posts() ) : $loop->the_post();

			// Start counting posts.
			$current = $loop->current_post + 1 + $args['posts_per_page'] * $args['paged'] - $args['posts_per_page'];

			// Get content template part. See /framework/core-functions.php.
			csco_get_content_template( $current, $query_args );

		endwhile;

	endif;

	wp_reset_postdata();

	$data = ob_get_clean();

	wp_send_json_success( $data );

}

add_action( 'wp_ajax_csco_ajax_load_more', 'csco_ajax_load_more' );
add_action( 'wp_ajax_nopriv_csco_ajax_load_more', 'csco_ajax_load_more' );

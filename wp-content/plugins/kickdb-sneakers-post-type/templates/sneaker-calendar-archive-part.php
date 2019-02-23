<?php
/**
 * Post Archive
 *
 * The main archive template.
 * See all archive parts at template-parts/loop/
 *
 * @package Authentic
 * @subpackage Template Parts
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

echo '<div class="post-archive">';

do_action( 'csco_archive_start' );

if ( have_posts() ) {

	// Get archive settings. See /framework/core-functions.php for details.
	$query_args = csco_get_query_args();

	$query_args['archive_type'] = 'grid';
	$query_args['show_first'] = false;
	$query_args['columns'] = '2';
	$query_args['summary'] = false;
	$query_args['summary_type'] = 'excerpt';
	$query_args['excerpt_length'] = '30';
	$query_args['thumbnail_width'] = '4';
	$query_args['thumbnail_size'] = 'medium';
	$query_args['widgets'] = true;
	$query_args['widgets_sidebar'] = 'sidebar-footer';
	$query_args['widgets_after'] = '3';
	$query_args['widgets_repeat'] = true;
	$query_args['pagination_type'] = 'standard';
	$query_args['infinite_load'] = false;

	// Get allowed post meta. See /framework/post-meta.php for details.
	$post_meta  = get_theme_mod( 'post_meta', array( 'date', 'category', 'comments', 'reading_time', 'views', 'author' ) );

	// Set query vars, so that we can get them across all templates.
	set_query_var( 'csco_query', $query_args );
	set_query_var( 'csco_meta', $post_meta );

	$type  = $query_args['archive_type'];
	$class = 'archive-main archive-' . $type;

	// Get archive class, containing number of columns for masonry and grid archives.
	if ( 'grid' === $type || 'masonry' === $type ) {
		$class .= ' columns-' . $query_args['columns'];
	}

	// Get total number of posts.
	$total = $wp_query->post_count;

	while ( have_posts() ) : the_post();

		// Start counting posts.
		$current = $wp_query->current_post + 1;

		// First standard post.
		if ( 1 === $current && $query_args['show_first'] && 'standard' !== $type ) {
			// Get standard post content template part for the first post.
			echo '<div class="archive-first archive-standard">';
			require plugin_dir_path(__FILE__) . 'sneaker-calendar-content-part.php';
			echo '</div>';
		}

		// Starting wrapper div.
		if ( 1 === $current && $total >= 1 ) {
			// Wrap post archive in a div.
			echo '<div class="' . esc_html( $class ) . '">';
			// Add columns for masonry layout.
			if ( 'masonry' === $type ) {
				echo '<div class="archive-col archive-col-1"></div>';
				echo '<div class="archive-col archive-col-2"></div>';
				if ( '3' === $query_args['columns'] ) {
					echo '<div class="archive-col archive-col-3"></div>';
				}
			}
		}

		// All other posts.
		if ( ! ( 1 === $current && $query_args['show_first'] && 'standard' !== $type ) ) {
			// Get content template part. See /framework/core-functions.php.
			require plugin_dir_path(__FILE__) . 'sneaker-calendar-content-part.php';
		}

		// Close wrapper div.
		if ( $current === $total && $total >= 1 ) {
			echo '</div>'; // .archive-main
		}
	endwhile;

	if ( $wp_query->max_num_pages > 1 ) {

		echo '<div class="archive-pagination">';

		if ( 'standard' === $query_args['pagination_type'] ) {
			the_posts_pagination( array(
				'mid_size'  => 2,
				'prev_text' => esc_html__( 'Previous', 'authentic' ),
				'next_text' => esc_html__( 'Next', 'authentic' ),
			) );
		}

		echo '</div>'; // .archive-pagination

	}
} else {
	require plugin_dir_path(__FILE__) . 'sneaker-calendar-content-part.php';
} // End if().

do_action( 'csco_archive_end' );

echo '</div>'; // .post-archive

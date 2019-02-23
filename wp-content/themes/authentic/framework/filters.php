<?php
/**
 * Filters
 *
 * All filters for native WordPress and plugins' functions.
 *
 * @package Authentic
 * @subpackage Framework
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * Exclude Featured Posts from the Main Query
 *
 * @param array $query Default query.
 */
function csco_exclude_featured_posts_from_homepage_query( $query ) {
	if ( ( $query->is_home() && $query->is_main_query() ) ) {
		$post_ids = csco_get_featured_post_ids();
		if ( ! $post_ids ) {
			return;
		}
		$query->set( 'post__not_in', $post_ids );
	}
}

add_action( 'pre_get_posts', 'csco_exclude_featured_posts_from_homepage_query' );

/**
 * Excerpt
 *
 * @param string $excerpt passes the excerpt.
 */
function csco_get_the_excerpt( $excerpt ) {

	global $wp_query;
	$output     = '';
	$query_args = csco_get_query_args();
	$archive    = $query_args['archive_type'];

	// Set the first post to standard.
	if ( $query_args['show_first'] && 0 === $wp_query->current_post ) {
		$archive    = 'standard';
	}

	// Output excerpt.
	if ( $excerpt && $query_args['summary'] ) {
		$output  .= '<div class="post-excerpt">' . $excerpt . '</div>';
	}

	// Output Read More button.
	if ( $query_args['more_button'] ) {
		$more_class = 'btn btn-primary btn-effect';
		// Set Read More button class for standard posts.
		if ( 'standard' === $archive ) {
			$more_class .= ' btn-lg';
		}
		$output .= csco_read_more( $more_class );
	}

	return $output;
}

add_filter( 'get_the_excerpt', 'csco_get_the_excerpt' );

/**
 * Excerpt Length
 *
 * @param string $length of the excerpt.
 */
function csco_excerpt_length( $length ) {
	$query_args = csco_get_query_args();
	return intval( $query_args['excerpt_length'] );
}

add_filter( 'excerpt_length', 'csco_excerpt_length' );

/**
 * Excerpt Suffix
 *
 * @param string $more suffix for the excerpt.
 */
function csco_excerpt_more( $more ) {
	return '&hellip;';
}

add_filter( 'excerpt_more', 'csco_excerpt_more' );

/**
 * Filter Comment Form Fields
 *
 * @param array $fields array of comment form fields.
 */
function csco_comment_form_fields( $fields ) {

	$commenter = wp_get_current_commenter();

	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$fields = array(

	'author' =>
	  '<div class="form-group comment-form-author"><label for="author">' . esc_html__( 'Name', 'authentic' ) . '</label> ' .
	  ( $req ? '<span class="required">*</span>' : '' ) .
	  '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
	  '" size="30"' . $aria_req . ' /></div>',

	'email' =>
	  '<div class="form-group comment-form-email"><label for="email">' . esc_html__( 'Email', 'authentic' ) . '</label> ' .
	  ( $req ? '<span class="required">*</span>' : '' ) .
	  '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
	  '" size="30"' . $aria_req . ' /></div>',

	'url' =>
	  '<div class="form-group comment-form-url"><label for="url">' . esc_html__( 'Website', 'authentic' ) . '</label>
	  <input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
	  '" size="30" /></div>',
	);

	return $fields;
}

add_filter( 'comment_form_default_fields', 'csco_comment_form_fields' );

/**
 * Comment Form Textarea and Submit Button
 *
 * @param array $args array of comment form default args.
 */
function csco_comment_form( $args ) {

	$args['comment_field'] =
	'<div class="form-group comment-form-comment">
      <label for="comment">' . esc_html__( 'Your Comment', 'authentic' ) . '</label>  <span class="required">*</span>
      <textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea>
    </div>';

	$args['class_submit'] = 'btn btn-primary';
	return $args;
}

add_filter( 'comment_form_defaults', 'csco_comment_form' );

/**
 *  Add responsive container to embeds, except for Instagram and Twitter
 *
 * @param string $html oembed markup.
 */
function csco_embed_oembed_html( $html ) {
	// Skip if Jetpack is active.
	if ( class_exists( 'Jetpack' ) ) {
		return $html;
	}
	// Skip for Instagram and Twitter embeds.
	if ( strpos( $html, 'instagram' ) || strpos( $html, 'twitter-tweet' ) ) {
		return $html;
	}
	return '<div class="embed embed-responsive embed-responsive-16by9">' . $html . '</div>';
}

add_filter( 'embed_oembed_html', 'csco_embed_oembed_html', 10, 3 );

/**
 * Paginated Post Pagination
 *
 * @param string $args Paginated posts pagination args.
 */
function csco_wp_link_pages_args( $args ) {
	if ( 'next_and_number' === $args['next_or_number'] ) {
		global $page, $numpages, $multipage, $more, $pagenow;
		$args['next_or_number'] = 'number';
		$prev = '';
		$next = '';
		if ( $multipage ) {
			if ( $more ) {
				$i = $page - 1;
				if ( $i && $more ) {
					$prev .= _wp_link_page( $i );
					$prev .= $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>';
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$next .= _wp_link_page( $i );
					$next .= $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>';
				}
			}
		}
		$args['before'] = $args['before'] . $prev;
		$args['after'] = $next . $args['after'];
	}
	return $args;
}

add_filter( 'wp_link_pages_args', 'csco_wp_link_pages_args' );

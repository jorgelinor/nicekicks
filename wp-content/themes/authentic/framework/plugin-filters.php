<?php
/**
 * Filters and Functions for Third Party Plugins
 *
 * @package Authentic
 * @subpackage Framework
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * -------------------------------------------------------------------------
 * [ WP Instagram Widget ]
 * -------------------------------------------------------------------------
 */

/**
 * Button Class
 */
function csco_instagram_link_class() {
	return 'btn btn-secondary';
}

add_filter( 'wpiw_link_class', 'csco_instagram_link_class' );

/**
 * Template Part Location
 */
function csco_instagram_template_part() {
	return 'template-parts/wp-instagram-widget.php';
}

add_filter( 'wpiw_template_part', 'csco_instagram_template_part' );

/**
 * -------------------------------------------------------------------------
 * [ Co-Authors Plus ]
 * -------------------------------------------------------------------------
 */

/**
 * Social Accounts fields in Guest Author profiles
 *
 * @param array $fields Fields to be returned.
 * @param array $groups Field groups.
 */
function csco_filter_guest_author_fields( $fields, $groups ) {
	if ( in_array( 'all', $groups, true ) || in_array( 'contact-info', $groups, true ) ) {
		$social_accounts = csco_get_social_accounts();
		foreach ( $social_accounts as $slug => $name ) {
			$fields[] = array(
				'key'      => $slug,
				'label'    => $name,
				'group'    => 'contact-info',
				);
		}
	}
	return $fields;
}

add_filter( 'coauthors_guest_author_fields', 'csco_filter_guest_author_fields', 10, 2 );

/**
 * -------------------------------------------------------------------------
 * [ Gridable ]
 * -------------------------------------------------------------------------
 */

/**
 * Row Class
 */
function csco_gridable_row_class() {
	return array( 'row' );
}
add_filter( 'gridable_row_class',  'csco_gridable_row_class' );

/**
 * Column Class
 *
 * @param array  $classes Available classes.
 * @param int    $size    Column size.
 * @param array  $atts    Attributes.
 * @param string $content Content.
 */
function csco_gridable_column_class( $classes, $size, $atts, $content ) {

	$classes = array( 'col-md-' . $size );

	return $classes;
}
add_filter( 'gridable_column_class',  'csco_gridable_column_class', 10, 4 );

/**
 * Remove Default Styles
 */
add_filter( 'gridable_load_public_style', '__return_false' );

/**
 * Remove Default Scripts
 */
function csco_gridable_load_public_scripts() {
	wp_dequeue_script( 'gridable' );
}
add_action( 'wp_print_scripts', 'csco_gridable_load_public_scripts' );

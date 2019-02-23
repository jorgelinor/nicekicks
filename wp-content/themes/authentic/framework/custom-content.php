<?php
/**
 * Additional Content.
 *
 * Includes customizer settings and actions to insert custom content.
 *
 * @package Authentic Wordpress Theme
 * @subpackage Framework
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * Define array of Additional Content Locations
 */
function csco_get_custom_content_locations() {
	$content = array(
		array(
			'slug'     => 'header',
			'name'     => esc_html__( 'Header', 'authentic' ),
			'template' => array( 'home', 'single', 'page', 'archive' ),
			),
		array(
			'slug'     => 'slider',
			'name'     => esc_html__( 'Post Slider', 'authentic' ),
			'template' => array( 'home' ),
			),
		array(
			'slug'     => 'tiles',
			'name'     => esc_html__( 'Post Tiles', 'authentic' ),
			'template' => array( 'home' ),
			),
		array(
			'slug'     => 'carousel',
			'name'     => esc_html__( 'Post Carousel', 'authentic' ),
			'template' => array( 'home' ),
			),
		array(
			'slug'     => 'site_content',
			'name'     => esc_html__( 'Site Content', 'authentic' ),
			'template' => array( 'home', 'single', 'page', 'archive' ),
			),
		array(
			'slug'     => 'main',
			'name'     => esc_html__( 'Main', 'authentic' ),
			'template' => array( 'home', 'single', 'page', 'archive' ),
			),
		array(
			'slug'     => 'post',
			'name'     => esc_html__( 'Post', 'authentic' ),
			'template' => array( 'single' ),
			),
		array(
			'slug'     => 'post_content',
			'name'     => esc_html__( 'Post Content', 'authentic' ),
			'template' => array( 'single' ),
			),
		array(
			'slug'     => 'page',
			'name'     => esc_html__( 'Page', 'authentic' ),
			'template' => array( 'page' ),
			),
		array(
			'slug'     => 'page_content',
			'name'     => esc_html__( 'Page Content', 'authentic' ),
			'template' => array( 'page' ),
			),
		array(
			'slug'     => 'author',
			'name'     => esc_html__( 'Post Author', 'authentic' ),
			'template' => array( 'single' ),
			),
		array(
			'slug'     => 'pagination',
			'name'     => esc_html__( 'Post Pagination', 'authentic' ),
			'template' => array( 'single' ),
			),
		array(
			'slug'     => 'subscribe',
			'name'     => esc_html__( 'Subscribe', 'authentic' ),
			'template' => array( 'single' ),
			),
		array(
			'slug'     => 'carousel',
			'name'     => esc_html__( 'Post Carousel', 'authentic' ),
			'template' => array( 'single' ),
			),
		array(
			'slug'     => 'comments',
			'name'     => esc_html__( 'Comments', 'authentic' ),
			'template' => array( 'single', 'page' ),
			),
		array(
			'slug'     => 'footer',
			'name'     => esc_html__( 'Footer', 'authentic' ),
			'template' => array( 'home', 'single', 'page', 'archive' ),
			),
	);
	return apply_filters( 'csco_custom_content_locations', $content );
}

$locations = csco_get_custom_content_locations();

/**
 * Define array of Additional Content Pages
 */
function csco_get_custom_content_pages() {
	$pages = array(
		'home'     => esc_html__( 'Homepage', 'authentic' ),
		'single'   => esc_html__( 'Post', 'authentic' ),
		'page'     => esc_html__( 'Page', 'authentic' ),
		'archive'  => esc_html__( 'Archive', 'authentic' ),
	);
	return $pages;
}

$pages = csco_get_custom_content_pages();

/**
 * Customizer Settings
 */

Kirki::add_panel( 'custom_content', array(
	'title'       => esc_html__( 'Additional Content', 'authentic' ),
	'priority'    => 140,
) );

Kirki::add_section( 'custom_content_general', array(
	'title'       => esc_html__( 'General', 'authentic' ),
	'panel'       => 'custom_content',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'custom_content_adsense',
	'label'       => esc_html__( 'Load Google AdSense Scripts', 'authentic' ),
	'description' => esc_html__( 'Enable this if you\'re using Google AdSense.', 'authentic' ),
	'section'     => 'custom_content_general',
	'default'     => false,
	'priority'    => 10,
) );

foreach ( $pages as $page_slug => $page_name ) {

	Kirki::add_section( 'custom_content_' . $page_slug, array(
		'title'       => $page_name,
		'panel'       => 'custom_content',
		'priority'    => 10,
	) );

	foreach ( $locations as $location ) {

		// Check if ads location is supported by the current page template.
		if ( in_array( $page_slug, $location['template'], true ) ) {

			Kirki::add_field( 'csco_theme_mod', array(
				'type'        => 'custom',
				'settings'    => 'custom_content_collapsible_' . $page_slug . '_' . $location['slug'],
				'section'     => 'custom_content_' . $page_slug,
				'default'     => '<div class="customize-collapsible"><h3>' . $location['name'] . '</h3></div>',
				'priority'    => 10,
			) );

			Kirki::add_field( 'csco_theme_mod', array(
				'type'     => 'textarea',
				'settings' => 'custom_content_' . $page_slug . '_' . $location['slug'] . '_before',
				'label'    => esc_html__( 'Before', 'authentic' ),
				'section'  => 'custom_content_' . $page_slug,
				'default'  => '',
				'priority' => 10,
				'sanitize_callback' => 'csco_unsanitize',
			) );

			Kirki::add_field( 'csco_theme_mod', array(
				'type'     => 'textarea',
				'settings' => 'custom_content_' . $page_slug . '_' . $location['slug'] . '_after',
				'label'    => esc_html__( 'After', 'authentic' ),
				'section'  => 'custom_content_' . $page_slug,
				'default'  => '',
				'priority' => 10,
				'sanitize_callback' => 'csco_unsanitize',
			) );

		}
	}
} // End foreach().

/**
 * Removes Sanitizing
 *
 * @param string $content Initial content.
 */
function csco_unsanitize( $content ) {
	return $content;
}

/**
 * Load Google AdSense scripts
 */
function csco_custom_content_enqueue_scripts() {

	if ( get_theme_mod( 'custom_content_adsense', false ) ) {

		// Register Google AdSense scripts.
		wp_register_script( 'csco_adsense', '//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js' );
		// Enqueue Google AdSense.
		wp_enqueue_script( 'csco_adsense' );

	}
}
add_action( 'wp_enqueue_scripts', 'csco_custom_content_enqueue_scripts' );

/**
 * Actions
 */
function csco_custom_content_display() {

	// Get current action name.
	$current = current_filter();

	// Get ads pages.
	$pages = csco_get_custom_content_pages();

	foreach ( $pages as $page_slug => $page_name ) {

		$location = "is_$page_slug";

		if ( $location() ) {

			// Get ads locations.
			$locations = csco_get_custom_content_locations();

			// Loop through all locations.
			foreach ( $locations as $location ) {
				// Check if ads location is supported by the current page template.
				if ( in_array( $page_slug, $location['template'], true ) ) {
					// Before.
					if ( 'csco_' . $location['slug'] . '_before' === $current ) {
						$code = get_theme_mod( 'custom_content_' . $page_slug . '_' . $location['slug'] . '_before' );
						if ( $code ) {
							echo '<section class="custom-content custom-content-' . esc_html( $location['slug'] ) . '-before">' . do_shortcode( $code ) . '</section>';
						}
					}
					// After.
					if ( 'csco_' . $location['slug'] . '_after' === $current ) {
						$code = get_theme_mod( 'custom_content_' . $page_slug . '_' . $location['slug'] . '_after' );
						if ( $code ) {
							echo '<section class="custom-content custom-content-' . esc_html( $location['slug'] ) . '-after">' . do_shortcode( $code ) . '</section>';
						}
					}
				}
			}
		}
	}
}

foreach ( $locations as $location ) {
	add_action( 'csco_' . $location['slug'] . '_before', 'csco_custom_content_display', 5 );
	add_action( 'csco_' . $location['slug'] . '_after', 'csco_custom_content_display', 5 );
}

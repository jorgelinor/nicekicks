<?php
/**
 * Assets
 *
 * All enqueues of scripts and styles.
 *
 * @package Authentic
 * @subpackage Framework
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

if ( ! defined( 'WP_ENV' ) ) {
	// Fallback if WP_ENV isn't defined in your WordPress config.
	// Used to check for 'development' or 'production'.
	define( 'WP_ENV', 'production' );
}

/**
 * Enqueues all theme assets.
 */
function csco_enqueue_scripts() {

	// Enqueue different assets for production and development environments.
	if ( WP_ENV === 'development' ) {
		$version = time();
	} else {
		$version = false;
	}

	// Enqueue Comment Reply script.
	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register theme scripts.
	wp_register_script( 'csco_js_vendors', get_template_directory_uri() . '/js/vendors.min.js', array( 'jquery' ), $version, true );
	wp_register_script( 'csco_js_scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery', 'csco_js_vendors' ), $version, true );

	// Localization array.
	$translation_array = array(
		'next'       => esc_html__( 'Next', 'authentic' ),
		'previous'   => esc_html__( 'Previous', 'authentic' ),
		);

	// Localize the main theme scripts.
	wp_localize_script( 'csco_js_scripts', 'translation', $translation_array );

	// Enqueue jQuery.
	wp_enqueue_script( 'jquery' );

	// Enqueue theme scripts.
	wp_enqueue_script( 'csco_js_vendors' );
	wp_enqueue_script( 'csco_js_scripts' );

	// Register theme styles.
	wp_register_style( 'csco_css_vendors', get_template_directory_uri() . '/css/vendors.min.css', false, $version );
	wp_register_style( 'csco_css_styles', get_template_directory_uri() . '/style.css', false, $version );

	// Enqueue theme styles.
	wp_enqueue_style( 'csco_css_vendors' );
	wp_enqueue_style( 'csco_css_styles' );

	// Add RTL support.
	wp_style_add_data( 'csco_css_styles', 'rtl', 'replace' );

	// Dequeue standard Post Views Counter styles.
	if ( function_exists( 'pvc_get_post_views' ) ) {
		wp_dequeue_style( 'post-views-counter-frontend', 10 );
	}

}

add_action( 'wp_enqueue_scripts', 'csco_enqueue_scripts' );

/**
 * Enqueues admin assets.
 *
 * @param string $page Current admin page.
 */
function csco_admin_enqueue_scripts( $page ) {

	// Enqueue different assets for production and development environments.
	if ( WP_ENV === 'development' ) {
		$version = time();
	} else {
		$version = wp_get_theme()->get( 'Version' );
	}

	// Register admin styles.
	wp_register_style( 'csco_admin_styles', get_template_directory_uri() . '/css/admin-style.css', false, $version );

	// Enqueue admin styles.
	wp_enqueue_style( 'csco_admin_styles' );
}

add_action( 'admin_enqueue_scripts', 'csco_admin_enqueue_scripts', 10 );

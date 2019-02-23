<?php
/**
 * Body Classes
 *
 * @package Authentic WordPress Theme
 * @subpackage Framework
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * Adds classes to <body> tag
 *
 * @param array $classes is an array of all body classes.
 */
function csco_body_class( $classes ) {

	// Header.
	if ( csco_has_header() ) {
		$classes[] = 'header-enabled';
	} else {
		$classes[] = 'header-disabled';
	}

	// Page Layout.
	$page_layout = csco_get_page_layout();
	if ( 'layout-sidebar-right' === $page_layout || 'layout-sidebar-left' === $page_layout ) {
		$classes[] = 'layout-sidebar';
	}
	$classes[] = $page_layout;

	// Page Header Type.
	$classes[] = 'page-header-' . csco_get_page_header_type();

	// Post Sidebar.
	if ( is_single() && function_exists( 'bsb_display_shares' ) && get_option( 'bsb_post-sidebar_display_share_buttons' ) ) {
		$classes[] = 'post-sidebar-enabled';
	}

	// Pin It Buttons.
	if ( ! get_theme_mod( 'pin_it_disabled', false ) ) {
		$classes[] = 'pin-it-enabled';
	}

	// Lightbox.
	if ( ! get_theme_mod( 'lightbox_disabled', false ) ) {
		$classes[] = 'lightbox-enabled';
	}

	// Parallax.
	if ( get_theme_mod( 'effects_parallax', true ) ) {
		$classes[] = 'parallax-enabled';
	} else {
		$classes[] = 'parallax-disabled';
	}

	// Sticky Sidebar.
	if ( get_theme_mod( 'effects_sticky_sidebar', true ) ) {
		$classes[] = 'sticky-sidebar-enabled';
	}

	// Lazy Load Effect.
	if ( get_theme_mod( 'effects_lazy_load', true ) ) {
		$classes[] = 'lazy-load-enabled';
	}

	// Navbar Scroll.
	if ( get_theme_mod( 'effects_navbar_scroll', true ) ) {
		$classes[] = 'navbar-scroll-enabled';
	}

	return $classes;
}

add_filter( 'body_class', 'csco_body_class' );

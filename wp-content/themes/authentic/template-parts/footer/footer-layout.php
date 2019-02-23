<?php
/**
 * General Layout for Footer Components.
 *
 * @package Authentic
 * @subpackage Footer Components
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

// Get available footer components.
$components = get_theme_mod( 'footer_components', array( 'instagram', 'subscribe', 'widgets', 'info' ) );

if ( $components && is_array( $components ) ) {

	// Loop through the components.
	foreach ( $components as $component ) {

		// Get Instagram component template part.
		if ( 'instagram' === $component && get_theme_mod( 'footer_instagram_username' )   ) {
			get_template_part( 'template-parts/footer/footer-instagram' );
		}

		// Get Subscribe component template part.
		if ( 'subscribe' === $component && get_option( 'csco_mailchimp_embedded_form_url' ) ) {
			get_template_part( 'template-parts/footer/footer-subscribe' );
		}

		// Get Widget Area component template part.
		if ( 'widgets' === $component && ( is_active_sidebar( 'sidebar-footer' ) || is_active_sidebar( 'sidebar-footer-2' ) || is_active_sidebar( 'sidebar-footer-3' ) ) ) {
			get_template_part( 'template-parts/footer/footer-widgets' );
		}

		// Get Info component template part.
		if ( 'info' === $component && (
				get_theme_mod( 'footer_logo_url', get_template_directory_uri() . '/images/logo-footer.png' ) ||
				get_theme_mod( 'footer_text', get_bloginfo( 'description' ) ) ||
				has_nav_menu( 'footer_navigation' )
		) ) {
			get_template_part( 'template-parts/footer/footer-info' );
		}
	}// End foreach().
}// End if().

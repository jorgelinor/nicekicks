<?php
/**
 * Kirki Functions
 *
 * @package Authentic WordPress Theme
 * @subpackage Customizer
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

// Include Kirki.
include_once( get_template_directory() . '/framework/includes/kirki/kirki.php' );

/**
 * Kirki Config
 *
 * @param array $config is an array of Kirki configuration parameters.
 */
function csco_kirki_config( $config ) {

	// Set the Customizer logo.
	$config['logo_image']   	= get_template_directory_uri() . '/images/logo-customizer.png';

	// Set Description.
	$config['description']  	= esc_html__( 'Lifestyle Blog & Magazine WordPress Theme', 'authentic' );

	// Disable Kirki preloader styles.
	$config['disable_loader'] = true;

	// Set correct path for Kirki library.
	$config['url_path'] = get_template_directory_uri() . '/framework/includes/kirki/';

	return $config;

}
add_filter( 'kirki/config', 'csco_kirki_config' );

/**
 * Export dynamic CSS to file.
 */
function csco_customizer_css_to_file() {
	if ( get_option( 'csco_customizer_css_to_file', false ) ) {
		return 'file';
	}
}
add_filter( 'kirki/dynamic_css/method', 'csco_customizer_css_to_file' );

// Register Theme Mods.
Kirki::add_config( 'csco_theme_mod', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
));

// Register Options.
Kirki::add_config( 'csco_option', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'option',
));

/**
 * Load custom customizer scripts
 */
function csco_customize_controls_enqueue_scripts() {
	wp_enqueue_script( 'csco_customize_js', get_template_directory_uri() . '/js/customizer.js', array( 'jquery', 'customize-controls' ), false, true );
}

add_action( 'customize_controls_enqueue_scripts', 'csco_customize_controls_enqueue_scripts' );

/**
 * Load custom customizer styles
 */
function csco_customize_controls_print_styles() {
	wp_enqueue_style( 'csco_customize_css', get_template_directory_uri() . '/css/customizer.css', array(), false );
}

add_action( 'customize_controls_print_styles', 'csco_customize_controls_print_styles', 100 );

/**
 * Include theme mods and options.
 */
include_once( get_template_directory() . '/framework/customizer/theme-mods.php' );
include_once( get_template_directory() . '/framework/customizer/options.php' );

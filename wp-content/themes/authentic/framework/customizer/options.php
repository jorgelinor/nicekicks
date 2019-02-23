<?php
/**
 * Options
 *
 * @package Authentic WordPress Theme
 * @subpackage Customizer
 * @since Authentic 2.1.0
 * @version 1.0.0
 */

/**
 * -------------------------------------------------------------------------
 * [ Advanced ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'advanced', array(
	'title'       => esc_html__( 'Advanced', 'authentic' ),
	'priority'    => 9999,
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Advanced > ACF Pro ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_option', array(
	'type'        => 'checkbox',
	'settings'    => 'csco_acf_menu_item',
	'label'       => esc_html__( 'Enable Custom Fields menu item', 'authentic' ),
	'section'     => 'advanced',
	'default'     => false,
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Advanced > Customizer CSS To File ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_option', array(
	'type'        => 'checkbox',
	'settings'    => 'csco_customizer_css_to_file',
	'label'       => esc_html__( 'Save customization styles to external stylesheet', 'authentic' ),
	'description' => wp_kses_post( 'Make sure, you\'ve purged your site cache and refreshed your browser cache after each save.', 'authentic' ),
	'section'     => 'advanced',
	'default'     => false,
	'priority'    => 10,
) );

<?php
/**
 * Dashboard Functions
 *
 * @package Authentic WordPress Theme
 * @subpackage Framework
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * Adds custom user contact methods
 *
 * @param array $user_contacts array of all user contacts.
 */
function csco_user_contactmethods( $user_contacts ) {
	$social_accounts = csco_get_social_accounts();
	$user_contacts = array_merge( $user_contacts, $social_accounts );
	return $user_contacts;
}

add_filter( 'user_contactmethods','csco_user_contactmethods', 10, 1 );

/**
 * Add Dropcap style
 *
 * @param array $buttons array of buttons.
 */
function csco_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

add_filter( 'mce_buttons_2', 'csco_mce_buttons_2' );

/**
 * Add Dropcap style
 *
 * @param array $init_array array of style formats.
 */
function csco_mce_before_init_insert_formats( $init_array ) {

	$style_formats = array(
		array(
			'title' => esc_html__( 'Drop Cap','authentic' ),
			'items' => array(
				array(
					'title' => esc_html__( 'Simple','authentic' ),
					'block' => 'p',
					'classes' => 'dropcap dropcap-simple',
					'wrapper' => false,
					),
				array(
					'title' => esc_html__( 'Bordered','authentic' ),
					'block' => 'p',
					'classes' => 'dropcap dropcap-borders',
					'wrapper' => false,
					),
				array(
					'title' => esc_html__( 'Border Right','authentic' ),
					'block' => 'p',
					'classes' => 'dropcap dropcap-border-right',
					'wrapper' => false,
					),
				array(
					'title' => esc_html__( 'Background Inverse','authentic' ),
					'block' => 'p',
					'classes' => 'dropcap dropcap-bg-inverse',
					'wrapper' => false,
					),
				array(
					'title' => esc_html__( 'Background','authentic' ),
					'block' => 'p',
					'classes' => 'dropcap dropcap-bg',
					'wrapper' => false,
					),
				),
			),
		array(
			'title' => esc_html__( 'Lead','authentic' ),
			'block' => 'p',
			'classes' => 'lead',
			),
		array(
			'title' => esc_html__( 'Container','authentic' ),
			'items' => array(
				array(
					'title' => esc_html__( 'Borders','authentic' ),
					'items' => array(
						array(
							'title' => esc_html__( 'Top','authentic' ),
							'block' => 'div',
							'classes' => 'content-block block-border-top',
							),
						array(
							'title' => esc_html__( 'Bottom','authentic' ),
							'block' => 'div',
							'classes' => 'content-block block-border-bottom',
							),
						array(
							'title' => esc_html__( 'Left','authentic' ),
							'block' => 'div',
							'classes' => 'content-block block-border-left',
							),
						array(
							'title' => esc_html__( 'Right','authentic' ),
							'block' => 'div',
							'classes' => 'content-block block-border-right',
							),
						array(
							'title' => esc_html__( 'All','authentic' ),
							'block' => 'div',
							'classes' => 'content-block block-border-all',
							),
						),
					),
				array(
					'title' => esc_html__( 'Background','authentic' ),
					'items' => array(
						array(
							'title' => esc_html__( 'Inverse','authentic' ),
							'block' => 'div',
							'classes' => 'content-block block-bg block-bg-inverse',
							),
						array(
							'title' => esc_html__( 'Default','authentic' ),
							'block' => 'div',
							'classes' => 'content-block block-bg block-default',
							),
						),
					),
				array(
					'title' => esc_html__( 'Float','authentic' ),
					'items' => array(
						array(
							'title' => esc_html__( 'Left','authentic' ),
							'block' => 'div',
							'classes' => 'content-block block-float-left',
							),
						array(
							'title' => esc_html__( 'Right','authentic' ),
							'block' => 'div',
							'classes' => 'content-block block-float-right',
							),
						),
					),
				),
			),
		);

	$init_array['style_formats'] = wp_json_encode( $style_formats );

	return $init_array;

}

add_filter( 'tiny_mce_before_init', 'csco_mce_before_init_insert_formats' );

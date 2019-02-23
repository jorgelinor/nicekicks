<?php
/**
 * Shortcode Social Accounts
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Basic Social Accounts
 */

/**
 * Social Account Shortcode
 *
 * @param array  $atts      User defined attributes in shortcode tag.
 * @param string $content   Shorcode tag content.
 * @return string           Shortcode result HTML.
 */
function bsa_account_shortcode( $atts, $content = '' ) {
	$params = shortcode_atts( array(
		'network'               => false,
		'cache'                 => true,
	), $atts );

	$params['cache']   = filter_var( $params['cache'], FILTER_VALIDATE_BOOLEAN );

	if ( $params['network'] ) {
		return bsa_get_count( $params['network'], false, $params['cache'] );
	} else {
		return esc_html__( 'Account name is incorrect!', 'basic-social-accounts' );
	}
}
add_shortcode( 'basic_account', 'bsa_account_shortcode' );


/**
 * Social Accounts Shortcode
 *
 * @param array  $atts      User defined attributes in shortcode tag.
 * @param string $content   Shorcode tag content.
 * @return string           Shortcode result HTML.
 */
function bsa_social_accounts_shortcode( $atts, $content = '' ) {
	$params = shortcode_atts( array(
		'title'                 => esc_html__( 'Social Accounts', 'basic-social-accounts' ),
		'template'              => 'default',
		'cache'                 => true,
		'labels'                => true,
		'titles'                => true,
		'counts'                => true,
	), $atts );

	ob_start();

	$params['cache']   = filter_var( $params['cache'], FILTER_VALIDATE_BOOLEAN );
	$params['labels']  = filter_var( $params['labels'], FILTER_VALIDATE_BOOLEAN );
	$params['titles']  = filter_var( $params['titles'], FILTER_VALIDATE_BOOLEAN );
	$params['counts']  = filter_var( $params['counts'], FILTER_VALIDATE_BOOLEAN );

	bsa_template_appearance( $params );

	return ob_get_clean();
}
add_shortcode( 'basic_social_accounts', 'bsa_social_accounts_shortcode' );

/**
 * Map Social Accounts Shortcode into the Basic Shortcodes Plugin
 */
if ( function_exists( 'bsc_register_shortcode' ) ) :

	$shortcode_map = array(
		'name'			=> 'accounts',
		'title'			=> esc_html__( 'Social Accounts', 'basic-social-accounts' ),
		'priority'		=> 110,
		'base'			=> 'basic_social_accounts',
		'autoregister'	=> false,
		'fields'		=> array(
			array(
				'type'		=> 'checkbox',
				'name'		=> 'labels',
				'label'		=> esc_html__( 'Labels', 'basic-social-accounts' ),
				'default'	=> true,
			),
			array(
				'type'		=> 'checkbox',
				'name'		=> 'titles',
				'label'		=> esc_html__( 'Titles', 'basic-social-accounts' ),
				'default'	=> true,
			),
			array(
				'type'		=> 'checkbox',
				'name'		=> 'counts',
				'label'		=> esc_html__( 'Counts', 'basic-social-accounts' ),
				'default'	=> true,
			),
		),
	);

	if ( bsa_templates_check() ) {
		$shortcode_map['fields'][] = array(
			'type'		=> 'select',
			'name'		=> 'template',
			'label'		=> esc_html__( 'Template', 'basic-social-accounts' ),
			'default'	=> 'default',
			'options'	=> bsa_get_templates_options(),
		);
	}

	bsc_register_shortcode( $shortcode_map );

endif;

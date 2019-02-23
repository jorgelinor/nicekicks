<?php
/**
 * Shortcode Share Buttons
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Basic Share Buttons
 */

/**
 * Share Buttons Shortcode
 *
 * @param array  $atts      User defined attributes in shortcode tag.
 * @param string $content   Shorcode tag content.
 * @return string           Shortcode result HTML.
 */
function bsb_share_buttons_shortcode( $atts, $content = '' ) {

	$params = shortcode_atts( array(
		'accounts'              => '',
		'total'                 => false,
		'labels'                => false,
		'counts'                => false,
		'scheme'                => 'default',
	), $atts );

	$params['total']  = filter_var( $params['total'], FILTER_VALIDATE_BOOLEAN );
	$params['labels'] = filter_var( $params['labels'], FILTER_VALIDATE_BOOLEAN );
	$params['counts'] = filter_var( $params['counts'], FILTER_VALIDATE_BOOLEAN );

	ob_start();

	// Accounts.
	if ( $params['accounts'] ) {
		$params['accounts'] = explode( ',', $params['accounts'] );

		if ( $params['accounts'] ) {
			foreach ( $params['accounts'] as $key => $val ) {
				$params['accounts'][ $key ] = trim( $val );
			}
		}
	}

	// Check Scheme.
	$scheme = ( $scheme ) ? $scheme : 'default';

	// Get Shares.
	bsb_get_shares( $params['accounts'], $params['total'], $params['labels'], $params['counts'], $params['scheme'], '' );

	return ob_get_clean();
}
add_shortcode( 'basic_share_buttons', 'bsb_share_buttons_shortcode' );

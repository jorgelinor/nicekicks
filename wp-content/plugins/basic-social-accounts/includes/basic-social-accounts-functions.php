<?php
/**
 * Functions for the plugin
 *
 * @link       https://codesupply.co
 * @since      1.1.1
 *
 * @package    Basic Social Accounts
 * @subpackage Includes
 */

/**
 * Get social params with filter
 *
 * @param string $id ID group.
 * @param string $key Filter key.
 * @return mix Specific social params.
 */
function bsa_specific_param( $id, $key = false ) {
	$params = apply_filters( 'bsa_social_accounts', array() );

	foreach ( $params as $param ) {
		if ( $key ) {
			if ( $param['id'] === $id && isset( $param[ $key ] ) ) {
				return $param[ $key ];
			}
		} else {
			if ( $param['id'] === $id ) {
				return $param;
			}
		}
	}
}

/**
 *
 * Check templates
 *
 * @return bool Logic var.
 */
function bsa_templates_check() {
	$templates = apply_filters( 'bsa_templates', array() );

	if ( count( $templates ) > 1 ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Get templates options
 *
 * @return array Items.
 */
function bsa_get_templates_options() {
	$options = array();

	$templates = apply_filters( 'bsa_templates', array() );

	if ( $templates ) {
		foreach ( $templates as $key => $item ) {
			if ( isset( $item['name'] ) ) {
				$options[ $key ] = $item['name'];
			}
		}
	}

	return $options;
}


/**
 * Adapt link with option
 *
 * @param array  $link Url link social.
 * @param string $id   ID group.
 */
function bsa_parse_user( $link, $id ) {

	$parse = array();

	if ( is_array( $link ) ) {
		foreach ( $link as $extra_name => $links ) {
			$link_type = get_option( $extra_name );
			foreach ( $links as $type => $url ) {
				if ( $link_type === $type ) {
					$link = $url;
				}
			}
		}
	}

	if ( ! is_array( $link ) ) {
		preg_match( '/%(bsa_.*?)%/', $link, $parse );

		// Return replaced value.
		if ( isset( $parse[0] ) && isset( $parse[1] ) ) {
			return str_replace( $parse[0], get_option( $parse[1] ), $link );
		}

		return $link;
	}

	// Return empty value.
	return '';
}


/**
 * Template appearance
 *
 * @param array $params Parameters.
 */
function bsa_template_appearance( $params ) {

	// Socials list.
	$accounts = array();

	$accounts_order = get_option( 'bsa_order_multiple_accounts', array() );
	$accounts_check = get_option( 'bsa_multiple_accounts', array() );

	// Sort.
	if ( $accounts_order && $accounts_check ) {
		$accounts_order = array_flip( $accounts_order );

		foreach ( $accounts_order as $key => $val ) {
			if ( in_array( $key, $accounts_check, true ) ) {
				$accounts[] = $key;
			}
		}
	}

	// Limit.
	if ( isset( $params['limit'] ) && intval( $params['limit'] ) ) {
		$accounts = array_slice( $accounts, 0, $params['limit'], true );
	}

	// Counter mode.
	$counter_mode = get_option( 'bsa_counter_mode', 'php' );

	// Name template.
	$params['template'] = ( $params['template'] ) ? $params['template'] : 'default';

	// Wrap Class.
	$wrap_class = sprintf( 'bsa-%s', $params['template'] );

	// Wrap Class | Counts, titles, labels.
	$wrap_class .= ( $params['titles'] ) ? ' bsa-titles-enabled' : ' bsa-titles-disabled';
	$wrap_class .= ( $params['counts'] ) ? ' bsa-counts-enabled' : ' bsa-counts-disabled';
	$wrap_class .= ( $params['labels'] ) ? ' bsa-labels-enabled' : ' bsa-labels-disabled';

	switch ( $counter_mode ) {
		case 'php':
			$wrap_class .= ' php-mode';
			break;

		case 'rest':
			$wrap_class .= ' rest-mode';

			// Smart Load restapi scripts.
			add_action( 'wp_footer', 'bsa_rest_api_scripts', 99 );
			break;
	}

	// Link Attributes.
	$target = get_option( 'bsa_link_target', 'new' ) === 'new' ? '_blank' : '_self';
	$rel    = get_option( 'bsa_nofollow' ) ? 'nofollow' : '';

	// Icon prefix.
	$bsa_icon_prefix = apply_filters( 'bsa_icon_prefix', 'icon' );
	?>
	<div class="bsa-wrap <?php echo esc_attr( $wrap_class ); ?>">
		<div class="bsa-items">
			<?php
			if ( $accounts ) {
				foreach ( $accounts as $item ) {
					$id = is_array( $item ) ? $item['id'] : $item;

					$title  = get_option( sprintf( 'bsa_title_%s', $id ) );
					$label  = get_option( sprintf( 'bsa_label_%s', $id ) );

					$link   = bsa_parse_user( bsa_specific_param( $id, 'link' ), $id ); // Link User.
					$class  = '';

					// Account Count.
					$result = array();
					if ( $params['counts'] ) {
						switch ( $counter_mode ) {
							case 'php':
								$result = bsa_get_count( $id, $params['labels'], $params['cache'], true ); // Count User.

								$class .= ( ! $result['count'] ) ? ' bsa-no-count' : '';
								$class .= ( isset( $result['error'] ) ) ? ' bsa-error' : '';
								break;
						}
					}
				?>
					<div class="bsa-item bsa-<?php echo esc_attr( $id ); ?> <?php echo esc_attr( isset( $class ) ? $class : '' ); ?>" data-id="<?php echo esc_attr( $id ); ?>">
						<?php if ( ! isset( $result['error'] ) ) : ?>
							<a href="<?php echo esc_url( $link ); ?>" class="bsa-link" target="<?php echo esc_attr( $target ); ?>" rel="<?php echo esc_attr( $rel ); ?>">
								<i class="bsa-icon <?php echo sprintf( '%2$s %2$s-%1$s', esc_attr( $id ), esc_attr( $bsa_icon_prefix ) ); ?>"></i>
								<?php if ( $params['titles'] && $title ) { ?>
									<span class="bsa-title"><?php echo esc_html( $title ); ?></span>
								<?php } ?>

								<?php
								if ( $params['counts'] ) {

									switch ( $counter_mode ) {
										case 'php':
											?>
												<span class="bsa-count"><?php echo esc_html( $result['count'] ); ?></span>
											<?php
											break;
										case 'rest':
											?>
												<span class="bsa-rest-count"></span>
											<?php
											break;
									}
								}
								?>

								<?php if ( $params['labels'] && $label ) { ?>
									<span class="bsa-label"><?php echo esc_html( $label ); ?></span>
								<?php } ?>
							</a>
						<?php else : ?>
							<div class="bsa-alert alert alert-warning">
								<?php echo esc_attr( bsa_specific_param( $id, 'name' ) ); ?>: <?php echo esc_html( $result['error'] ); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php
				} // End foreach().
			} else {
				?>
				<div class="bsa-alert alert alert-warning">
					<?php esc_html_e( 'No social networks selected!', 'basic-share-buttons' ); ?>
				</div>
				<?php
			} // End if().
			?>
		</div>
	</div>
	<?php
}


/**
 * Function get social accounts
 *
 * @param bool   $labels Display labels.
 * @param bool   $titles Display titles.
 * @param bool   $counts Display counts.
 * @param string $template Template accounts.
 * @param mixed  $limit Limit the number of accounts.
 */
function bsa_get_accounts( $labels = true, $titles = true, $counts = true, $template = 'default', $limit = false ) {
	$params = array(
		'template'              => $template,
		'cache'                 => true,
		'labels'                => $labels,
		'titles'                => $titles,
		'counts'                => $counts,
		'limit'                 => $limit,
	);

	bsa_template_appearance( $params );
}


/**
 * Add Social Accounts REST API Scripts
 */
function bsa_rest_api_scripts() {
	?>
	<script type="text/javascript">
		"use strict";

		(function($) {

			$( window ).load( function() {

				// Get all accounts.
				var bsaIds = [],
					bsaRestBox = $( '.bsa-wrap.rest-mode' );

				bsaRestBox.find( '.bsa-item' ).each( function() {
					if ( $( this ).attr( 'data-id' ).length > 0 ) {
						bsaIds.push( $( this ).attr( 'data-id' ) );
					}
				});

				// Generate accounts data.
				var bsaData = {};

				if( bsaIds.length > 0 ) {
					bsaData = { 'ids' : bsaIds.join() };
				}

				// Get results by REST API.
				$.ajax({
					type: 'GET',
					url: '<?php echo esc_url( home_url() ); ?>/wp-json/social-counts/v1/get-counts',
					data: bsaData,
					beforeSend: function(){

						// Add Loading Class.
						bsaRestBox.addClass( 'restapi-loading' );
					},
					success: function( response ) {

						if ( ! $.isEmptyObject( response ) && ! response.hasOwnProperty( 'code' ) ) {

							// Accounts loop.
							$.each( response, function( index, data ) {

								// Find Bsa Item.
								var bsaItem = bsaRestBox.find( '.bsa-item[data-id="' + index + '"]');

								// Set Class.
								if ( data.hasOwnProperty( 'class' ) ) {
									bsaItem.addClass( data.class );
								}

								// Set Count.
								if ( data.hasOwnProperty( 'result' ) && data.result !== null && data.result.hasOwnProperty( 'count' ) ) {

									// Bsa Item.
									bsaItem.addClass( 'bsa-item-count' );

									// Count item.
									bsaItem.find( '.bsa-rest-count' ).html( data.result.count );
								} else {
									bsaItem.addClass( 'bsa-no-count' );
								}

							});
						}

						// Remove Loading Class.
						bsaRestBox.removeClass( 'restapi-loading' );
					},
					error: function() {

						// Remove Loading Class.
						bsaRestBox.removeClass( 'restapi-loading' );
					}
				});
			});

		})(jQuery);
	</script>
	<?php
}


/**
 * This is our callback function that embeds our resource in a WP_REST_Response
 *
 * @param array $request REST API Request.
 */
function bsa_get_accounts_restapi( $request ) {

	// Get Social Accounts.
	$social_accounts = apply_filters( 'bsa_social_accounts', array() );
	$social_accounts = array_keys( $social_accounts );

	// Error, when Social Accounts are empty.
	if ( empty( $social_accounts ) ) {
		return rest_ensure_response( array(
			'code'		=> 'accounts_not_found',
			'message'	=> esc_html__( 'Social Accounts not found.', 'basic-share-buttons' ),
		) );
	}

	// Labels.
	if ( isset( $request['labels'] ) ) {
		$labels = (bool) $request['labels'];
	} else {
		$labels = false;
	}

	// Cache Results.
	if ( isset( $request['cache'] ) ) {
		$cache = (bool) $request['cache'];
	} else {
		$cache = true;
	}

	// Get Counts.
	$account_counts = array();

	if ( isset( $request['ids'] ) ) {
		$ids = explode( ',', $request['ids'] );
		$ids = array_map( 'trim', $ids );
	} else {
		$ids = $social_accounts;
	}

	foreach ( $ids as $account_id ) {
		if ( in_array( $account_id, $social_accounts, true ) ) {

			$result = bsa_get_count( $account_id, $labels, $cache, true ); // Count User.

			$class = ( ! $result['count'] ) ? ' bsa-no-count' : '';
			$class .= ( isset( $result['error'] ) ) ? ' bsa-error' : '';

			$account_counts[ $account_id ] = array(
				'result'	=> $result,
				'class'		=> $class,
			);
		}
	}

	// Return Succes Result.
	return rest_ensure_response( $account_counts );
}

/**
 * This function is where we register our routes for our example endpoint.
 */
function bsa_register_api_routes() {

	register_rest_route( 'social-counts/v1', '/get-counts', array(
		// By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
		'methods'  => WP_REST_Server::READABLE,
		// Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
		'callback' => 'bsa_get_accounts_restapi',
	) );
}
add_action( 'rest_api_init', 'bsa_register_api_routes' );

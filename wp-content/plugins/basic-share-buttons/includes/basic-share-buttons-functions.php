<?php
/**
 * Functions for the plugin
 *
 * @link       https://codesupply.co
 * @since      1.1.1
 *
 * @package    Basic Share Buttons
 * @subpackage Includes
 */

/**
 * Autoload files in the directory.
 *
 * @param string $path Directory path.
 * @param string $pattern Regex pattern.
 * @since    1.0.0
 */
function bsb_autoload_files( $path, $pattern = false ) {
	if ( is_dir( $path ) ) {
		$files = scandir( $path );
	} else {
		return false;
	}

	// loop folders.
	foreach ( $files as $file ) {
		$path_file = $path . '/' . basename( $file );

		if ( $pattern && ! preg_match( "/$pattern/", basename( $file ) ) ) {
			continue;
		}

		if ( file_exists( $path_file ) && 'index.php' !== $file ) {

			if ( is_dir( $path_file ) && file_exists( $path_file . "/$file.php" ) ) {
				require_once( $path_file . "/$file.php" );
			} elseif ( is_file( $path_file ) && preg_match( '/\.php$/i', $path_file ) ) {
				require_once( $path_file );
			}
		}
	}
}


/**
 *
 * Has option
 *
 * @param array $name  Name of option.
 * @return bool Logic var.
 */
function bsb_has_option( $name ) {
	$alloptions = wp_load_alloptions();

	if ( array_key_exists( $name, $alloptions ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 *
 * Check scheme
 *
 * @param array $schemes   Schemes.
 * @return bool Logic var.
 */
function bsb_scheme_check( $schemes = array() ) {
	if ( count( $schemes ) > 1 ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Get cache time
 *
 * @since 1.0.0
 * @param string|int $post_id   Post ID.
 */
function bsb_get_cache_time( $post_id = false ) {

	// Options cache time.
	if ( 'options' === $post_id ) {
		$seconds = apply_filters( 'bsb_options_cache_time', 3600 );

		return $seconds;
	}

	// Post Id.
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	// Post age in seconds.
	$post_age = floor( intval( date( 'U' ) ) - intval( get_post_time( 'U', true, $post_id ) ) );

	$three_months_period = apply_filters( 'bsb_three_months', 5184000 );
	$three_weeks_period  = apply_filters( 'bsb_three_weeks', 1814400 );

	if ( isset( $post_age ) && $post_age > $three_months_period ) {

		// Post older than 60 days - expire cache after 12 hours.
		$seconds = apply_filters( 'bsb_refresh_60_days', 43200 );

	} elseif ( isset( $post_age ) && $post_age > $three_weeks_period ) {

		// Post older than 21 days - expire cache after 4 hours.
		$seconds = apply_filters( 'bsb_refresh_21_days', 14400 );

	} else {

		// Expire cache after one hour.
		$seconds = apply_filters( 'bsb_refresh_1_hour', 3600 );
	}

	return $seconds;
}

/**
 * Get Current Post ID
 *
 * @since 1.0.0
 * @param string $url  Custom URL.
 */
function bsb_get_current_post_id( $url ) {

	// Custom URL.
	if ( $url ) {
		return 'options';
	}

	// Auto.
	global $post;

	if ( isset( $post->ID ) ) {
		return $post->ID;

	} else {
		return 'options';
	}
}

/**
 * Get Share URL
 *
 * @since 1.0.0
 * @param string|int $post_id   Post ID.
 * @param string     $url       Custom URL.
 */
function bsb_get_share_url( $post_id = false, $url = null ) {

	// Custom URL.
	if ( $url ) {
		return $url;
	}

	// Auto URL.
	if ( ! $post_id ) {
		$post_id = bsb_get_current_post_id( $url );
	}

	if ( 'options' === $post_id ) {
		return preg_replace( '/\?.*/', '', home_url( add_query_arg( null, null ) ) );

	} else {
		return get_permalink( intval( $post_id ) );
	}
}

/**
 * Get Cached Counts
 *
 * @since 1.0.0
 * @param string     $account      Account Name.
 * @param string|int $post_id      Post ID.
 * @param string     $url          Custom URL.
 * @param bool       $igonre_time  Ignore Cache Time.
 */
function bsb_get_cached_count( $account, $post_id, $url = null, $igonre_time = false ) {

	if ( 'options' === $post_id ) {

		// Get Url Shares.
		$share_url  = bsb_get_share_url( $post_id, $url );
		$url_shares = get_transient( substr( 'bsb_share_count_' . $account . '_' . md5( $share_url ), 0, 170 ) );

		return $url_shares;

	} else {

		// Get Post Shares.
		$post_shares = false;

		if ( $igonre_time ) {
			$post_shares = get_post_meta( intval( $post_id ), 'bsb_share_count_' . $account, true );

		} else {
			$share_transient = get_post_meta( intval( $post_id ), 'bsb_share_transient_' . $account, true );

			if ( intval( date( 'U' ) ) < intval( $share_transient ) ) {
				$post_shares = get_post_meta( intval( $post_id ), 'bsb_share_count_' . $account, true );
			}
		}

		return $post_shares;
	}
}

/**
 * Set Cache Counts
 *
 * @since 1.0.0
 * @param string     $account   Account Name.
 * @param string|int $post_id   Post ID.
 * @param int        $count     Shares Count.
 * @param string     $url       Custom URL.
 */
function bsb_set_cache_count( $account, $post_id, $count, $url = null ) {

	// Get Cache Time.
	$cache_time = bsb_get_cache_time( $post_id );

	// Set Cache.
	if ( 'options' === $post_id ) {

		// Set Url Shares Count.
		$share_url  = bsb_get_share_url( $post_id, $url );
		set_transient( substr( 'bsb_share_count_' . $account . '_' . md5( $share_url ), 0, 170 ), $count, $cache_time );

	} else {

		// Set Post Shares Count.
		$cache_time  = bsb_get_cache_time( $post_id ) + intval( date( 'U' ) );

		update_post_meta( intval( $post_id ), 'bsb_share_transient_' . $account, $cache_time );
		update_post_meta( intval( $post_id ), 'bsb_share_count_' . $account, $count );
	}

	return false;
}

/**
 * Get Account Data
 *
 * @since 1.0.0
 * @param string     $account   Account Name.
 * @param string|int $post_id   Post ID.
 * @param string     $url       Custom URL.
 */
function bsb_get_accounts( $account = false, $post_id = false, $url = null ) {

	$post_id = (int) $post_id;
	if ( $post_id <= 0 ) {
		$post_id = false;
	}

	// Get Current Share URL.
	$share_url = bsb_get_share_url( $post_id, $url );

	// Get All Accounts.
	$all_accounts = apply_filters( 'bsb_share_accounts', array(), $share_url, $post_id );

	if ( ! $account ) {
		return $all_accounts;

	} elseif ( isset( $all_accounts[ $account ] ) ) {

		return $all_accounts[ $account ];
	}

	return false;
}

/**
 * Get Share Count
 *
 * @since 1.0.0
 * @param string     $account   Account Name.
 * @param string|int $post_id   Post ID.
 * @param string     $url       Custom URL.
 */
function bsb_get_shares_count( $account, $post_id = false, $url = null ) {

	// Get Account Data.
	$account_data = bsb_get_accounts( $account, $post_id, $url );

	if ( isset( $account_data['count_walker'] ) ) {
		$func = $account_data['count_walker'];

		if ( function_exists( $func ) ) {
			return call_user_func_array( $func, array( $account, $post_id, $url ) );
		}
	}

	return false;
}

/**
 * Get Total Count
 *
 * @since 1.0.0
 * @param array      $accounts  Accounts List.
 * @param string|int $post_id   Post ID.
 * @param string     $url       Custom URL.
 */
function bsb_get_total_count( $accounts, $post_id = false, $url = null ) {

	$total_count = 0;

	foreach ( $accounts as $account ) {
		$total_count += intval( bsb_get_shares_count( $account, $post_id, $url ) );
	}

	return $total_count;
}

/**
 * Get Shares
 *
 * @since 1.0.0
 * @param array  $accounts  Accounts List.
 * @param int    $total     Total Count.
 * @param int    $labels    Show labels.
 * @param int    $counts    Show Counts.
 * @param string $scheme    Color Sheme.
 * @param string $class     Additional class.
 * @param string $url       Custom URL.
 */
function bsb_get_shares( $accounts = array( 'facebook', 'twitter', 'googleplus' ), $total = true, $labels = true, $counts = true, $scheme = 'default', $class = null, $url = null ) {

	// Check accounts list.
	if ( empty( $accounts ) ) {
		return false;
	}

	// Counter mode.
	$counter_mode = get_option( 'bsb_counter_mode', 'php' );

	// Total Title.
	$total_title = get_option( 'bsb_total_title', 'Total' );

	// Total Label.
	$total_label = get_option( 'bsb_total_label', 'Shares' );

	// Post ID.
	$post_id = bsb_get_current_post_id( $url );

	// Wrap Classes.
	$classes = array( 'bsb-wrap' );

	if ( $scheme ) {
		$classes[] = 'bsb-' . $scheme;
	}

	if ( $counts ) {
		$classes[] = 'bsb-has-counts';
	}

	if ( $total ) {
		$classes[] = 'bsb-has-total-counts';
	}

	if ( $class ) {
		$classes[] = $class;
	}

	switch ( $counter_mode ) {
		case 'php':
			$classes[] = 'php-mode';
			break;

		case 'rest':
			$classes[] = 'rest-mode';

			// Smart Load restapi scripts.
			add_action( 'wp_footer', 'bsb_rest_api_scripts', 99 );
			break;
	}

	// Icon prefix.
	$bsb_icon_prefix = apply_filters( 'bsb_icon_prefix', 'icon' );

	?>
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" data-post-id="<?php echo esc_attr( $post_id ); ?>" data-share-url="<?php echo esc_url( bsb_get_share_url( $post_id, $url ) ); ?>">

			<?php
			if ( $total ) {

				if ( 'php' === $counter_mode ) {
					$total_count = bsb_get_total_count( $accounts, $post_id, $url );

					if ( intval( $total_count ) > 0 ) {
						?>
							<div class="bsb-total">
								<div class="bsb-title"><?php echo esc_html( $total_title ); ?></div>
								<div class="bsb-count"><?php echo esc_html( bsb_count_format( $total_count ) ); ?></div>
								<div class="bsb-label"><?php echo esc_html( $total_label ); ?></div>
							</div>
						<?php
					}
				} else {
					?>
						<div class="bsb-total" style="display: none;">
							<div class="bsb-title"><?php echo esc_html( $total_title ); ?></div>
							<div class="bsb-count"></div>
							<div class="bsb-label"><?php echo esc_html( $total_label ); ?></div>
						</div>
					<?php
				}
			}
			?>

			<div class="bsb-items">

				<?php
				foreach ( $accounts as $account ) {

					// Get Account Data.
					$account_data = bsb_get_accounts( $account, $post_id, $url );

					// Break if account is unregistered.
					if ( ! $account_data ) {
						continue;
					}

					// Label.
					$label = get_option( "bsb_label_{$account}", $account_data['label'] );

					// Item Classes.
					$item_classes   = array( 'bsb-item', 'bsb-' . $account );
					switch ( $counter_mode ) {
						case 'php':
							// Get Account Count.
							$account_count  = $counts ? bsb_get_shares_count( $account, $post_id, $url ) : false;

							$item_classes[] = $account_count ? 'bsb-item-count' : 'bsb-no-count';
							break;

						case 'rest':
							$account_count = false;

							break;
					}
					?>
						<div class="<?php echo esc_attr( implode( ' ', $item_classes ) ); ?>" data-id="<?php echo esc_attr( $account ); ?>">

							<a href="<?php echo esc_url( $account_data['share_url'], null, '' ); ?>" class="bsb-link" target="_blank">

								<i class="bsb-icon <?php echo sprintf( '%2$s %2$s-%1$s', esc_attr( $account ), esc_attr( $bsb_icon_prefix ) ); ?>"></i>

								<?php if ( $labels ) { ?>
									<span class="bsb-label"><?php echo esc_html( $label ); ?></span>
								<?php } ?>

								<?php
								switch ( $counter_mode ) {
									case 'php':

										if ( $account_count ) {
											?>
												<span class="bsb-count"><?php echo esc_html( bsb_count_format( $account_count ) ); ?></span>
											<?php
										}
										break;

									case 'rest':
										?>
											<span class="bsb-rest-count"></span>
										<?php
										break;
								}
								?>
							</a>
						</div>
					<?php
				} // End foreach().
				?>
			</div>
		</div>
	<?php
}


/**
 * Return format color schemes
 *
 * @param array $location Params of location.
 */
function bsb_format_color_schemes( $location ) {
	$schemes = apply_filters( 'bsb_color_schemes', array() );

	// Default schemes.
	if ( isset( $location['fields']['schemes'] ) ) {
		$default_schemes = $location['fields']['schemes'];
		$schemes_build = array();
		if ( is_array( $default_schemes ) && $default_schemes && $schemes ) {
			foreach ( $default_schemes as $scheme_key ) {
				if ( array_key_exists( $scheme_key, $schemes ) ) {
					$schemes_build[ $scheme_key ] = $schemes[ $scheme_key ];
				}
			}
		}
		$schemes = $schemes_build;
	}

	return $schemes;
}

/**
 * Return color scheme
 *
 * @param string $location_name Name of location.
 */
function bsb_handler_color_scheme( $location_name ) {
	$locations = apply_filters( 'bsb_locations', array() );

	foreach ( $locations as $item ) {
		if ( $location_name === $item['location'] ) {
			$scheme   = get_option( "bsb_{$location_name}_scheme" );

			$format_schemes = bsb_format_color_schemes( $item );

			if ( $format_schemes ) {
				if ( $scheme && array_key_exists( $scheme, $format_schemes ) ) {
					return $scheme;
				} else {
					return key( $format_schemes );
				}
			}
		}
	}

	return 'default';
}

/**
 * Display Shares in Locations
 *
 * @since 1.0.0
 * @param string $location  Shares location.
 * @param string $url       Custom URL.
 */
function bsb_display_shares( $location = 'after-content', $url = null ) {

	// Display share.
	$display_share = get_option( "bsb_{$location}_display_share_buttons" );

	if ( $display_share ) {

		$accounts = array();

		$accounts_order = get_option( "bsb_{$location}_order_multiple_buttons", array() );
		$accounts_check = get_option( "bsb_{$location}_multiple_buttons", array() );

		// Sort.
		if ( $accounts_order && $accounts_check ) {
			$accounts_order = array_flip( $accounts_order );

			foreach ( $accounts_order as $key => $val ) {
				if ( in_array( $key, $accounts_check, true ) ) {
					$accounts[] = $key;
				}
			}
		}

		$total    = get_option( "bsb_{$location}_display_total_share_count" );
		$labels   = get_option( "bsb_{$location}_display_labels" );
		$counts   = get_option( "bsb_{$location}_display_count" );
		$scheme   = get_option( "bsb_{$location}_scheme" );
		$class    = null;

		// Scheme.
		$scheme = bsb_handler_color_scheme( $location );

		// Add location to the wrapper class.
		$class = trim( 'bsb-' . $location . ' ' . $class );

		// Get Shares.
		bsb_get_shares( $accounts, $total, $labels, $counts, $scheme, $class, $url );
	}
}

/**
 * Count format
 *
 * @since 1.0.0
 * @param int $value    Count number.
 */
function bsb_count_format( $value = 0 ) {
	$result = '';
	$value  = (int) $value;

	$count_format = apply_filters( 'bsb_count_format', true );

	if ( $count_format ) {
		if ( $value > 999 && $value <= 999999 ) {
			$result = floor( $value / 1000 ) . esc_html( 'K', 'basic-share-buttons' );
		} elseif ( $value > 999999 ) {
			$result = floor( $value / 1000000 ) . esc_html( 'M', 'basic-share-buttons' );
		} else {
			$result = $value;
		}
	} else {
		$result = $value;
	}

	return $result;
}

/**
 * Add Social Share REST API Scripts
 */
function bsb_rest_api_scripts() {
	?>
	<script type="text/javascript">
		"use strict";

		(function($) {

			$( window ).load( function() {

				// Each All Share boxes.
				$( '.bsb-wrap.rest-mode' ).each( function() {

					var bsbIds = [],
						bsbBox = $( this );

					// Check Counts.
					if ( ! bsbBox.hasClass( 'bsb-has-counts' ) && ! bsbBox.hasClass( 'bsb-has-total-counts' ) ) {
						return;
					}

					bsbBox.find( '.bsb-item' ).each( function() {
						if ( $( this ).attr( 'data-id' ).length > 0 ) {
							bsbIds.push( $( this ).attr( 'data-id' ) );
						}
					});

					// Generate accounts data.
					var bsbData = {};

					if( bsbIds.length > 0 ) {
						bsbData = {
							'ids'     : bsbIds.join(),
							'post_id' : bsbBox.attr( 'data-post-id' ),
							'url'     : bsbBox.attr( 'data-share-url' ),
						};
					}

					// Get results by REST API.
					$.ajax({
						type: 'GET',
						url: '<?php echo esc_url( home_url() ); ?>/wp-json/social-share/v1/get-shares',
						data: bsbData,
						beforeSend: function(){

							// Add Loading Class.
							bsbBox.addClass( 'restapi-loading' );
						},
						success: function( response ) {

							if ( ! $.isEmptyObject( response ) && ! response.hasOwnProperty( 'code' ) ) {

								// Accounts loop.
								$.each( response, function( index, data ) {

									if ( index !== 'total_count' ) {

										// Find Bsa Item.
										var bsbItem = bsbBox.find( '.bsb-item[data-id="' + index + '"]');

										// Set Class.
										if ( data.hasOwnProperty( 'class' ) ) {
											bsbItem.addClass( data.class );
										}

										// Set Count.
										if ( data.hasOwnProperty( 'count' ) && 'false' !== data.count ) {

											bsbItem.addClass( 'bsb-item-count' );
											bsbItem.find( '.bsb-rest-count' ).addClass( 'bsb-count' ).html( data.count );

										} else {
											bsbItem.addClass( 'bsb-no-count' );
										}
									}
								});

								if ( bsbBox.hasClass( 'bsb-has-total-counts' ) && response.hasOwnProperty( 'total_count' ) ) {
									var bsbTotalBox = bsbBox.find( '.bsb-total' );

									bsbTotalBox.find( '.bsb-count' ).html( response.total_count );
									bsbTotalBox.show();
								}
							}

							// Remove Loading Class.
							bsbBox.removeClass( 'restapi-loading' );
						},
						error: function() {

							// Remove Loading Class.
							bsbBox.removeClass( 'restapi-loading' );
						}
					});
				});
			});

		})(jQuery);
	</script>
	<?php
}

/**
 * Social Share APi Response
 *
 * @param array $request REST API Request.
 */
function bsb_get_accounts_restapi( $request ) {

	// Get Social Accounts.
	$social_accounts = bsb_get_accounts();
	$social_accounts = array_keys( $social_accounts );

	// Error, when Social Accounts are empty.
	if ( empty( $social_accounts ) ) {
		return rest_ensure_response( array(
			'code'		=> 'accounts_not_found',
			'message'	=> esc_html__( 'Social Accounts not found.', 'basic-share-buttons' ),
		) );
	}

	// Post ID.
	if ( isset( $request['post_id'] ) ) {
		$post_id = (int) $request['post_id'];

		if ( $post_id <= 0 ) {
			$post_id = false;
		}
	} else {
		$post_id = false;
	}

	// URL.
	if ( isset( $request['url'] ) ) {
		$url = $request['url'];
	} else {
		$url = null;
	}

	// Get Counts.
	$share_counts = array();

	if ( isset( $request['ids'] ) ) {
		$ids = explode( ',', $request['ids'] );
		$ids = array_map( 'trim', $ids );
	} else {
		$ids = $social_accounts;
	}

	$total_count = 0;

	foreach ( $ids as $account ) {
		if ( in_array( $account, $social_accounts, true ) ) {

			$account_count = bsb_get_shares_count( $account, $post_id, $url );
			$class         = $account_count ? 'bsb-item-count' : 'bsb-no-count';

			$total_count  += (int) $account_count;

			$share_counts[ $account ] = array(
				'count'	=> $account_count,
				'class'	=> $class,
			);
		}
	}

	$share_counts['total_count'] = bsb_count_format( $total_count );

	// Return Succes Result.
	return rest_ensure_response( $share_counts );
}

/**
 * Register Share REST API Route
 */
function bsb_register_api_routes() {

	register_rest_route( 'social-share/v1', '/get-shares', array(
		'methods'  => WP_REST_Server::READABLE,
		'callback' => 'bsb_get_accounts_restapi',
	) );
}
add_action( 'rest_api_init', 'bsb_register_api_routes' );

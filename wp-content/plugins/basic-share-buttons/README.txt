=== Basic Share Buttons ===
Contributors: codesupplyco
Donate link: https://codesupply.co/donate/
Tags: twitter, bootstrap
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Add Share Account Filter ==
	* Go to includes/basic-share-buttons-accounts.php and add a filter bsb_share_accounts. Example:

		/**
		 * Add Facebook provider.
		 *
		 * @param array      $accounts   Social Accounts List.
		 * @param string     $share_url  Url for Share.
		 * @param int|string $post_id    Post Id or options.
		 */
		function bsb_add_facebook_share( $accounts, $share_url, $post_id ) {

			/* Share url */
			$share_url = esc_url( 'https://www.facebook.com/sharer.php?u=' . $share_url, null, '' );

			/* Add account */
			$accounts['facebook'] = array(
				'share_url'		=> $share_url,
				'name'			=> esc_html__( 'Facebook', 'basic-share-buttons' ),
				'label'			=> esc_html__( 'Like', 'basic-share-buttons' ),
				'count_walker'	=> 'bsb_share_facebook_counter', // Shares Count function.
			);

			return $accounts;
		}
		add_filter( 'bsb_share_accounts', 'bsb_add_facebook_share', 10, 3 );

	* Add your count walker fucntion to the file - includes/basic-share-buttons-counters.php.


== Color Sheme Filter ==
	* bsb_color_schemes	array  Schemes List.

	Example:
	function register_custom_scheme( $schemes = array() ) {
		$schemes['YOUR_CUSTOM_SHEME_SLUG'] = array(
			'name' => 'YOUR_CUSTOM_SHEME_NAME',
		);

		return $schemes;
	}
	add_filter( 'bsb_color_schemes', 'register_custom_scheme' );


== Locations Filter ==

	* bsb_locations 	array  Locations List.

	Example:
	function register_custom_locations( $locations = array() ) {
		$locations[] = array(
			'name'     => 'YOUR_CUSTOM_NAME',
			'location' => 'YOUR_CUSTOM_LOCATION',
			'display'  => true,  // Optional
			'fields'   => array(
				'total'			=> true,  // Optional
				'labels'		=> true,  // Optional
				'counts'		=> true,  // Optional
				'schemes'  		=> array( 'CUSTOM_SHEME1', 'CUSTOM_SHEME2' ), // Optional
			),
			'shares'   => array( 'facebook', 'twitter', 'pinterest' ),  // Optional
			'scheme'   => 'CUSTOM_SHEME1',  // Optional
		);

		return $locations;
	}
	add_filter( 'bsb_locations', 'register_custom_locations' );

== Smart Cache Time Filters ==
	* bsb_options_cache_time	Default: 3600.
	* bsb_three_months 			Default: 5184000.
	* bsb_three_weeks			Default: 1814400.
	* bsb_refresh_60_days		Default: 43200.
	* bsb_refresh_21_days		Default: 14400.
	* bsb_refresh_1_hour		Default: 3600.

== Other Filters ==
	* bsb_icon_prefix		string  Icon Prefix for Networks.
	* bsb_enqueue_styles	bool	Include front-end styles. Default: true.

== Get Single Account Shares Count ==

	* @param string     $account   Account Name.
	* @param string|int $post_id   Post ID or 'options'. A place where the data will be saved.
	* @param string     $url       Custom Share URL.

	Example with default values:
	bsb_get_shares_count( $account, $post_id = false, $url = null );

== Get Total Shares Count ==

	* @param array      $accounts  Accounts List.
	* @param string|int $post_id   Post ID or 'options'. A place where the data will be saved.
	* @param string     $url       Custom Share URL.

	Example with default values:
	bsb_get_total_count( $accounts, $post_id = false, $url = null );

== Get Shares by Parameters ==

	* @param array  $accounts  Accounts List.
	* @param int    $total     Total Count.
	* @param int    $labels    Show labels.
	* @param int    $counts    Show Counts.
	* @param string $scheme    Color Sheme.
	* @param string $class     Additional class.
	* @param string $url       Custom Share URL.

	Example with default values:
	bsb_get_shares( $accounts = array( 'facebook', 'twitter', 'googleplus' ), $total = true, $labels = true, $counts = true, $scheme = 'default', $class = null, $url = null );


== Display Shares in Locations ==

	* @param string $location  Shares location (registered by filter).
	* @param string $url       Custom Share URL.

	Example with default values:
	function bsb_display_shares( $location = 'after-content', $url = null ) {


== REST API - Get Shares Count ==

	%SITE_URL%/wp-json/social-share/v1/get-shares/

	Aviable GET parameters:
	* ids     - Filter social networks by network names ( Separate by "," )
	* post_id - Post ID for Share
	* url     - Share URL (optional)

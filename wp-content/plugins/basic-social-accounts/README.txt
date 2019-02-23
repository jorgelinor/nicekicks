=== Basic Social Accounts ===
Contributors: codesupplyco
Donate link: https://codesupply.co/donate/
Tags: tweets, bootstrap
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Adding a new network ==

	* File "includes/basic-social-accounts-social-list.php":
		In the filter bsa_social_accounts add an array with parameters, for example:
			$list['facebook'] = array(
				'id'		=> 'facebook',
				'name'		=> esc_html__( 'Facebook', 'basic-social-accounts' ),
				'label'		=> esc_html__( 'Likes', 'basic-social-accounts' ),
				'link'		=> esc_url( 'https://facebook.com/%bsa_facebook_user%' ),
				'fields'	=> array(
					'bsa_facebook_user'		=> esc_html__( 'Facebook User', 'basic-social-accounts' ),
				),
			);

	* Add connect options and instructions, if it's needed in the "includes/basic-social-accounts-social-params.php":
	* Add config fields in the file "extra/class-api-config.php":

== Get Followers Count ==

	$network  string     Social network name.
	$labels   bool       Show network labels.
	$cache    bool       Cache results.
	$array_format  bool  Format of output (array or string).

	bsa_get_count( $network, $labels, $cache, $array_format );


== Get Social Accounts ==

	$labels     bool     Display labels.
	$titles     bool     Display titles.
	$counts     bool     Display counts.
	$template   string   Template accounts.
	$template   mixed    Limit the number of accounts.

	bsa_get_accounts( $labels, $titles, $counts, $template, $limit );


== Register Template ==

	function register_custom_template( $templates = array() ) {
		$templates['YOUR_CUSTOM_TEMPLATE_SLUG'] = array(
			'name' => 'YOUR_CUSTOM_TEMPLATE_NAME',
		);

		return $templates;
	}
	add_filter( 'bsa_templates', 'register_custom_template' );


== Other Filters ==

	* bsa_count_format		bool	Enable compact version for counters. Default: true.
	* bsa_enqueue_styles	bool	Include front-end styles. Default: true.
	* bsa_templates			array	Registered templates List. Default: array().
	* bsa_icon_prefix		string	Networks icon prefix. Default: fa.


== REST API - Get Accounts Count ==

	%SITE_URL%/wp-json/social-counts/v1/get-counts/

	Aviable GET parameters:
	* ids     - Filter social accounts by names ( Separate by "," ).
	* labels  - Show Labels ( by default: false ).
	* cache   - Cache results ( by default: true ).


<?php
/**
 * Social API Config
 *
 * @link       https://codesupply.co
 * @since      1.1.1
 *
 * @package    Basic Social Accounts
 * @subpackage Extra
 */

/**
 * Social API Config Class
 */
class Api_Config {

	/**
	 * Cache Timeout
	 *
	 * @var string $cache_timeout  Cache Timeout.
	 */
	public static $cache_timeout;

	/**
	 * Users
	 *
	 * @var string $users  Users List.
	 */
	public static $users = array();

	/**
	 * Api keys
	 *
	 * @var string $api_keys  Api keys.
	 */
	public static $api_keys = array();

	/**
	 * Api keys
	 *
	 * @var string $extra  Extra data.
	 */
	public static $extra = array();

	/**
	 * Initialize.
	 *
	 * @since 1.0.0
	 */
	function __construct() {
		self::$cache_timeout        = (int) get_option( 'bsa_cache_timeout', 60 );

		self::$users['dribbble_user']        = get_option( 'bsa_dribbble_user' );
		self::$users['facebook_user']        = get_option( 'bsa_facebook_user' );
		self::$users['google_plus_id']       = get_option( 'bsa_google_plus_id' );
		self::$users['youtube_slug']         = get_option( 'bsa_youtube_slug' );
		self::$users['pinterest_user']       = get_option( 'bsa_pinterest_user' );
		self::$users['soundcloud_user_id']   = get_option( 'bsa_soundcloud_user_id' );
		self::$users['vimeo_user']           = get_option( 'bsa_vimeo_user' );
		self::$users['twitter_user']         = get_option( 'bsa_twitter_user' );
		self::$users['behance_user']         = get_option( 'bsa_behance_user' );
		self::$users['github_user']          = get_option( 'bsa_github_user' );
		self::$users['vk_id']                = get_option( 'bsa_vk_id' );
		self::$users['bsa_rss_url']          = get_option( 'bsa_bsa_rss_url' );

		self::$extra['youtube_channel_type']  = get_option( 'bsa_youtube_channel_type' );
		self::$extra['linkedin_slug']         = get_option( 'bsa_linkedin_slug' );

		self::$api_keys['dribbble_token']       = get_option( 'csco_dribbble_token' );
		self::$api_keys['instagram_token']      = get_option( 'csco_instagram_token' );
		self::$api_keys['google_key']           = get_option( 'csco_google_key' );
		self::$api_keys['youtube_key']          = get_option( 'csco_youtube_key' );
		self::$api_keys['facebook_app_id']      = get_option( 'csco_facebook_app_id' );
		self::$api_keys['facebook_app_secret']  = get_option( 'csco_facebook_app_secret' );
		self::$api_keys['soundcloud_client_id'] = get_option( 'csco_soundcloud_client_id' );
		self::$api_keys['vimeo_token']          = get_option( 'csco_vimeo_token' );
		self::$api_keys['twitter_consumer_key']          = get_option( 'csco_twitter_consumer_key' );
		self::$api_keys['twitter_consumer_secret']       = get_option( 'csco_twitter_consumer_secret' );
		self::$api_keys['twitter_access_token']          = get_option( 'csco_twitter_access_token' );
		self::$api_keys['twitter_access_token_secret']   = get_option( 'csco_twitter_access_token_secret' );
		self::$api_keys['behance_client_id']     = get_option( 'csco_behance_client_id' );
		self::$api_keys['github_client_id']      = get_option( 'csco_github_client_id' );
		self::$api_keys['github_client_secret']  = get_option( 'csco_github_client_secret' );
	}
}

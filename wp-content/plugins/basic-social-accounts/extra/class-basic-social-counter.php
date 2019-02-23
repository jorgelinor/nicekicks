<?php
/**
 * Get Social Accounts
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Basic Social Accounts
 * @subpackage Extra
 */

/**
 * Include Config
 */
require_once( dirname( __FILE__ ) . '/class-api-config.php' );

/**
 * Social Counter Class
 */
class Basic_Social_Counter {

	/**
	 * Social users
	 *
	 * @since 1.0.0
	 * @var   array $users    List of user names.
	 */
	public $users = array();

	/**
	 * Api Keys
	 *
	 * @since 1.0.0
	 * @var   array $api_keys    List of api keys.
	 */
	public $api_keys = array();

	/**
	 * Extra data
	 *
	 * @since 1.0.0
	 * @var   array $extra    Extra data.
	 */
	public $extra = array();

	/**
	 * Transient Prefix
	 *
	 * @since 1.0.0
	 * @var   string $cache_timeout    Cache Timeout (minutes).
	 */
	private $trans_prefix = 'bsa_social_counter_';

	/**
	 * Cache Results
	 *
	 * @since 1.0.0
	 * @var   int $cache_timeout    Cache Timeout (minutes).
	 */
	public $cache_timeout = 60;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 */
	function __construct() {
		$this->run_api();
	}

	/**
	 * Run users name , api keys and clients id
	 *
	 * @since 1.0.0
	 */
	public function run_api() {

		$config = new Api_Config();

		// Cache Timeout.
		$this->cache_timeout = $config::$cache_timeout;

		// Users.
		$this->users = $config::$users;

		// Keys.
		$this->api_keys = $config::$api_keys;

		// Extra.
		$this->extra = $config::$extra;

	}

	/**
	 * Curl request data
	 *
	 * @since 1.0.0
	 * @param array $args   Api params.
	 */
	function curl_get_api( $args ) {

		// Get Cached Data.
		if ( $args['cache'] && $this->cache_timeout > 0 ) {
			$data = get_transient( $this->trans_prefix . $args['network'] );
		} else {
			$data = false;
		}

		if ( ! $data ) {

			// Generate Url.
			$params = http_build_query( $args['params'] );
			$remote_url = $params ? $args['url'] . '?' . $params : $args['url'];

			// Request_params.
			$request_params = array(
				'timeout'		=> 2,
				'sslverify'		=> false,
				'user-agent'	=> $this->get_random_user_agent(),
			);

			$response = wp_remote_get( $remote_url, $request_params );

			if ( is_wp_error( $response ) ) {
				return false;
			}

			// Retrieve data.
			$data = wp_remote_retrieve_body( $response );

			// JSON Decode.
			if ( $args['decode'] ) {
				$data = json_decode( $data );
			}
		}

		return $data;
	}

	/**
	 * Maybe Set Cache
	 *
	 * @since 1.0.0
	 * @param string $network   Social Network.
	 * @param int    $count     Followers Count.
	 * @param int    $cache     Cache Results.
	 */
	function maybe_set_cache( $network, $count, $cache = true ) {

		if ( $cache && $this->cache_timeout > 0 ) {
			$args = array(
				'count' => $count,
			);
			set_transient( $this->trans_prefix . $network, $args, 60 * $this->cache_timeout );
		}
	}

	/**
	 * Get pinterest followers count
	 *
	 * @since 1.0.0
	 * @param bool $cache  Cache Results.
	 */
	public function get_pinterest( $cache = true ) {

		$network = 'pinterest';
		$result  = array(
			'count' => 0,
		);

		// Check username.
		if ( ! $this->users['pinterest_user'] ) {
			$result['error'] = esc_html( 'Please enter a pinterest user name.', 'basic-social-accounts' );

			return $result;
		}

		// Get Count.
		$data = $this->curl_get_api( array(
			'network'	=> $network,
			'url'		=> 'https://api.pinterest.com/v3/pidgets/users/' . $this->users['pinterest_user'] . '/pins',
			'params'	=> array(),
			'cache'		=> $cache,
			'decode'	=> true,
		));

		// Set count.
		if ( is_array( $data ) && isset( $data['count'] ) ) {

			// Cached Count.
			$result['count'] = $this->count_format( $data['count'] );

		} elseif ( isset( $data->status ) && 'failure' === $data->status ) {

			// API Error.
			if ( isset( $data->message ) ) {
				$result['error'] = $data->message;
			}
		} elseif ( isset( $data->data->user->follower_count ) ) {

			// Live Count.
			$count = $data->data->user->follower_count;
			$result['count'] = $this->count_format( $count );

			// Maybe Set Cache.
			$this->maybe_set_cache( $network, $count, $cache );
		}

		return $result;
	}

	/**
	 * Get dribbble followers count
	 *
	 * @since 1.0.0
	 * @param bool $cache  Cache Results.
	 */
	public function get_dribbble( $cache = true ) {

		$network = 'dribbble';
		$result  = array(
			'count' => 0,
		);

		// Check username.
		if ( ! $this->users['dribbble_user'] ) {
			$result['error'] = esc_html( 'Please enter a dribbble user name.', 'basic-social-accounts' );

			return $result;
		}

		// Check token.
		if ( ! $this->api_keys['dribbble_token'] ) {
			$result['error'] = esc_html( 'Please enter a dribbble token.', 'basic-social-accounts' );

			return $result;
		}

		// Get Count.
		$data = $this->curl_get_api( array(
			'network'	=> $network,
			'url'		=> 'https://api.dribbble.com/v1/users/' . $this->users['dribbble_user'],
			'params'	=> array(
				'access_token'	=> $this->api_keys['dribbble_token'],
			),
			'cache'		=> $cache,
			'decode'	=> true,
		));

		// Set count.
		if ( is_array( $data ) && isset( $data['count'] ) ) {

			// Cached Count.
			$result['count'] = $this->count_format( $data['count'] );

		} elseif ( isset( $data->message ) ) {

			// API Error.
			$result['error'] = $data->message;

		} elseif ( isset( $data->followers_count ) ) {

			// Live Count.
			$count = $data->followers_count;
			$result['count'] = $this->count_format( $count );

			// Maybe Set Cache.
			$this->maybe_set_cache( $network, $count, $cache );
		}

		return $result;
	}

	/**
	 * Get facebook fans count
	 *
	 * @since 1.0.0
	 * @param bool $cache  Cache Results.
	 */
	public function get_facebook( $cache = true ) {

		$network = 'facebook';
		$result  = array(
			'count' => 0,
		);

		// Check username.
		if ( ! $this->users['facebook_user'] ) {
			$result['error'] = esc_html( 'Please enter a Facebook user name.', 'basic-social-accounts' );

			return $result;
		}

		// Check token.
		if ( ! $this->api_keys['facebook_app_id'] ) {
			$result['error'] = esc_html( 'Please enter a Facebook app id.', 'basic-social-accounts' );

			return $result;
		}

		// Check token.
		if ( ! $this->api_keys['facebook_app_secret'] ) {
			$result['error'] = esc_html( 'Please enter a Facebook app secret.', 'basic-social-accounts' );

			return $result;
		}

		// Get Count.
		$data = $this->curl_get_api( array(
			'network'	=> $network,
			'url'		=> 'https://graph.facebook.com/v2.8/' . $this->users['facebook_user'],
			'params'	=> array(
				'access_token'	=> $this->api_keys['facebook_app_id'] . '|' . $this->api_keys['facebook_app_secret'],
				'fields'		=> 'fan_count',
			),
			'cache'		=> $cache,
			'decode'	=> true,
		));

		// Set count.
		if ( is_array( $data ) && isset( $data['count'] ) ) {

			// Cached Count.
			$result['count'] = $this->count_format( $data['count'] );

		} elseif ( isset( $data->error->message ) ) {

			// API Error.
			$result['error'] = $data->error->message;

		} elseif ( isset( $data->fan_count ) ) {

			// Live Count.
			$count = $data->fan_count;
			$result['count'] = $this->count_format( $count );

			// Maybe Set Cache.
			$this->maybe_set_cache( $network, $count, $cache );
		}

		return $result;
	}

	/**
	 * Get instagram followers count
	 *
	 * @since 1.0.0
	 * @param bool $cache  Cache Results.
	 */
	public function get_instagram( $cache = true ) {

		$network = 'instagram';
		$result  = array(
			'count' => 0,
		);

		// Check token.
		if ( ! $this->api_keys['instagram_token'] ) {
			$result['error'] = esc_html( 'Please enter an Instagram token.', 'basic-social-accounts' );

			return $result;
		}

		// Get Count.
		$data = $this->curl_get_api( array(
			'network'	=> $network,
			'url'		=> 'https://api.instagram.com/v1/users/self/',
			'params'	=> array(
				'access_token' => $this->api_keys['instagram_token'],
			),
			'cache'		=> $cache,
			'decode'	=> true,
		));

		// Set count.
		if ( is_array( $data ) && isset( $data['count'] ) ) {

			// Cached Count.
			$result['count'] = $this->count_format( $data['count'] );

		} elseif ( isset( $data->meta->error_message ) ) {

			// API Error.
			$result['error'] = $data->meta->error_message;

		} elseif ( isset( $data->data->counts->followed_by ) ) {

			// Live Count.
			$count = $data->data->counts->followed_by;
			$result['count'] = $this->count_format( $count );

			// Maybe Set Cache.
			$this->maybe_set_cache( $network, $count, $cache );
		}

		return $result;
	}

	/**
	 * Get google followers count
	 *
	 * @since 1.0.0
	 * @param bool $cache  Cache Results.
	 */
	public function get_google_plus( $cache = true ) {

		$network = 'google-plus';
		$result  = array(
			'count' => 0,
		);

		// Check username.
		if ( ! $this->users['google_plus_id'] ) {
			$result['error'] = esc_html( 'Please enter a Google Plus ID.', 'basic-social-accounts' );

			return $result;
		}

		// Check token.
		if ( ! $this->api_keys['google_key'] ) {
			$result['error'] = esc_html( 'Please enter a Google Key.', 'basic-social-accounts' );

			return $result;
		}

		// Get Count.
		$data = $this->curl_get_api( array(
			'network'	=> $network,
			'url'		=> 'https://www.googleapis.com/plus/v1/people/' . $this->users['google_plus_id'],
			'params'	=> array(
				'key'	=> $this->api_keys['google_key'],
			),
			'cache'		=> $cache,
			'decode'	=> false,
		));

		if ( is_string( $data ) ) {
			$data = json_decode( $data, true );
		}

		// Set count.
		if ( is_array( $data ) && isset( $data['count'] ) ) {

			// Cached Count.
			$result['count'] = $this->count_format( $data['count'] );

		} elseif ( isset( $data['error']['message'] ) ) {

			// API Error.
			$result['error'] = $data['error']['message'];

		} elseif ( isset( $data['circledByCount'] ) ) {

			// Live Count.
			$count = $data['circledByCount'];
			$result['count'] = $this->count_format( $count );

			// Maybe Set Cache.
			$this->maybe_set_cache( $network, $count, $cache );
		}

		return $result;
	}

	/**
	 * Get youtube subscribers count
	 *
	 * @since 1.0.0
	 * @param bool $cache  Cache Results.
	 */
	public function get_youtube( $cache = true ) {

		$network = 'youtube';
		$result  = array(
			'count' => 0,
		);

		// Check username.
		if ( ! $this->users['youtube_slug'] ) {
			$result['error'] = esc_html( 'Please enter an YouTube User.', 'basic-social-accounts' );

			return $result;
		}

		// Check token.
		if ( ! $this->api_keys['youtube_key'] ) {
			$result['error'] = esc_html( 'Please enter a YouTube Key.', 'basic-social-accounts' );

			return $result;
		}

		// Generate Params.
		switch ( $this->extra['youtube_channel_type'] ) {
			case 'channel':
				$params = array(
					'part'		=> 'statistics',
					'id'		=> $this->users['youtube_slug'],
					'fields'	=> 'items/statistics/subscriberCount',
					'key'		=> $this->api_keys['youtube_key'],
				);
				break;

			// User.
			default:
				$params = array(
					'part'			=> 'statistics',
					'forUsername'	=> $this->users['youtube_slug'],
					'key'			=> $this->api_keys['youtube_key'],
				);
				break;
		}

		// Get Count.
		$data = $this->curl_get_api( array(
			'network'	=> $network,
			'url'		=> 'https://www.googleapis.com/youtube/v3/channels/',
			'params'	=> $params,
			'cache'		=> $cache,
			'decode'	=> true,
		));

		// Set count.
		if ( is_array( $data ) && isset( $data['count'] ) ) {

			// Cached Count.
			$result['count'] = $this->count_format( $data['count'] );

		} elseif ( isset( $data->error->message ) ) {

			// API Error.
			$result['error'] = $data->error->message;

		} elseif ( isset( $data->items[0]->statistics->subscriberCount ) ) {

			// Live Count.
			$count = $data->items[0]->statistics->subscriberCount;
			$result['count'] = $this->count_format( $count );

			// Maybe Set Cache.
			$this->maybe_set_cache( $network, $count, $cache );
		} elseif ( isset( $data->items ) && empty( $data->items ) ) {

			// API Error 2.
			$result['error'] = esc_html( 'Please check your username or channel.', 'basic-social-accounts' );

		}

		return $result;
	}

	/**
	 * Get soundcloud followers count
	 *
	 * @since 1.0.0
	 * @param bool $cache  Cache Results.
	 */
	public function get_soundcloud( $cache = true ) {

		$network = 'soundcloud';
		$result  = array(
			'count' => 0,
		);

		// Check username.
		if ( ! $this->users['soundcloud_user_id'] ) {
			$result['error'] = esc_html( 'Please enter a SoundCloud User ID.', 'basic-social-accounts' );

			return $result;
		}

		// Check token.
		if ( ! $this->api_keys['soundcloud_client_id'] ) {
			$result['error'] = esc_html( 'Please enter a SoundCloud Client ID.', 'basic-social-accounts' );

			return $result;
		}

		// Get Count.
		$data = $this->curl_get_api( array(
			'network'	=> $network,
			'url'		=> 'http://api.soundcloud.com/users/' . $this->users['soundcloud_user_id'],
			'params'	=> array(
				'client_id' => $this->api_keys['soundcloud_client_id'],
			),
			'cache'		=> $cache,
			'decode'	=> true,
		));

		// Set count.
		if ( is_array( $data ) && isset( $data['count'] ) ) {

			// Cached Count.
			$result['count'] = $this->count_format( $data['count'] );

		} elseif ( ! $data ) {

			// API Error.
			$result['error'] = esc_html( 'SoundCloud API Error.', 'basic-social-accounts' );

		} elseif ( isset( $data->followers_count ) ) {

			// Live Count.
			$count = $data->followers_count;
			$result['count'] = $this->count_format( $count );

			// Maybe Set Cache.
			$this->maybe_set_cache( $network, $count, $cache );
		}

		return $result;
	}

	/**
	 * Get vimeo followers count
	 *
	 * @since 1.0.0
	 * @param bool $cache  Cache Results.
	 */
	public function get_vimeo( $cache = true ) {

		$network = 'vimeo';
		$result  = array(
			'count' => 0,
		);

		// Check username.
		if ( ! $this->users['vimeo_user'] ) {
			$result['error'] = esc_html( 'Please enter a Vimeo User.', 'basic-social-accounts' );

			return $result;
		}

		// Check token.
		if ( ! $this->api_keys['vimeo_token'] ) {
			$result['error'] = esc_html( 'Please enter a Vimeo Token.', 'basic-social-accounts' );

			return $result;
		}

		// Get Count.
		$data = $this->curl_get_api( array(
			'network'	=> $network,
			'url'		=> 'https://api.vimeo.com/users/' . $this->users['vimeo_user'] . '/followers',
			'params'	=> array(
				'access_token' => $this->api_keys['vimeo_token'],
			),
			'cache'		=> $cache,
			'decode'	=> true,
		));

		// Set count.
		if ( is_array( $data ) && isset( $data['count'] ) ) {

			// Cached Count.
			$result['count'] = $this->count_format( $data['count'] );

		} elseif ( isset( $data->error ) ) {

			// API Error.
			$result['error'] = $data->error;

		} elseif ( isset( $data->total ) ) {

			// Live Count.
			$count = $data->total;
			$result['count'] = $this->count_format( $count );

			// Maybe Set Cache.
			$this->maybe_set_cache( $network, $count, $cache );
		}

		return $result;
	}

	/**
	 * Get twitter followers count
	 *
	 * @since 1.0.0
	 * @param bool $cache  Cache Results.
	 */
	public function get_twitter( $cache = true ) {

		$network = 'twitter';
		$result  = array(
			'count' => 0,
		);

		// Check username.
		if ( ! $this->users['twitter_user'] ) {
			$result['error'] = esc_html( 'Please enter a Twitter User.', 'basic-social-accounts' );

			return $result;
		}

		// Check Twitter Consumer Key.
		if ( ! $this->api_keys['twitter_consumer_key'] ) {
			$result['error'] = esc_html( 'Please enter a Twitter Consumer Key.', 'basic-social-accounts' );

			return $result;
		}

		// Check Twitter Consumer Secret.
		if ( ! $this->api_keys['twitter_consumer_secret'] ) {
			$result['error'] = esc_html( 'Please enter a Twitter Consumer Secret.', 'basic-social-accounts' );

			return $result;
		}

		// Check Twitter Access Token.
		if ( ! $this->api_keys['twitter_access_token'] ) {
			$result['error'] = esc_html( 'Please enter a Twitter Access Token.', 'basic-social-accounts' );

			return $result;
		}

		// Check Twitter Access Token Secret.
		if ( ! $this->api_keys['twitter_access_token_secret'] ) {
			$result['error'] = esc_html( 'Please enter a Twitter Access Token Secret.', 'basic-social-accounts' );

			return $result;
		}

		// Twitter API Class.
		if ( ! class_exists( 'TwitterAPIExchange' ) ) {
			require_once( dirname( __FILE__ ) . '/api/TwitterAPIExchange.php' );
		}

		// Get Cached Data.
		if ( $cache && $this->cache_timeout > 0 ) {
			$data = get_transient( $this->trans_prefix . $network );

		} else {
			$data = false;
		}

		// Get Count.
		if ( ! $data ) {
			$settings = array(
				'oauth_access_token'		=> $this->api_keys['twitter_access_token'],
				'oauth_access_token_secret'	=> $this->api_keys['twitter_access_token_secret'],
				'consumer_key'				=> $this->api_keys['twitter_consumer_key'],
				'consumer_secret'			=> $this->api_keys['twitter_consumer_secret'],
			);
			$twitter      = new TwitterAPIExchange( $settings );
			$follow_count = $twitter->setGetfield( '?screen_name=' . $this->users['twitter_user'] )
			->buildOauth( 'https://api.twitter.com/1.1/statuses/user_timeline.json', 'GET' )
			->performRequest();

			$data = json_decode( $follow_count, true );
		}

		// Set count.
		if ( is_array( $data ) && isset( $data['count'] ) ) {

			// Cached Count.
			$result['count'] = $this->count_format( $data['count'] );

		} elseif ( isset( $data['errors'] ) ) {

			// API Error.
			foreach ( $data['errors'] as $error ) {
				if ( isset( $error['message'] ) ) {
					$result['error'] = $error['message'];

					break;
				}
			}
		} elseif ( isset( $data[0]['user']['followers_count'] ) ) {

			// Live Count.
			$count = $data[0]['user']['followers_count'];
			$result['count'] = $this->count_format( $count );

			// Maybe Set Cache.
			$this->maybe_set_cache( $network, $count, $cache );
		}

		return $result;
	}

	/**
	 * Get github followers count
	 *
	 * @since 1.0.0
	 * @param bool $cache  Cache Results.
	 */
	public function get_github( $cache = true ) {

		$network = 'github';
		$result  = array(
			'count' => 0,
		);

		// Check username.
		if ( ! $this->users['github_user'] ) {
			$result['error'] = esc_html( 'Please enter a GitHub User.', 'basic-social-accounts' );

			return $result;
		}

		// Check client id.
		if ( ! $this->api_keys['github_client_id'] ) {
			$result['error'] = esc_html( 'Please enter a GitHub Client ID.', 'basic-social-accounts' );

			return $result;
		}

		// Check client id.
		if ( ! $this->api_keys['github_client_secret'] ) {
			$result['error'] = esc_html( 'Please enter a GitHub Client Secret.', 'basic-social-accounts' );

			return $result;
		}

		// Get Count.
		$data = $this->curl_get_api( array(
			'network'	=> $network,
			'url'		=> 'https://api.github.com/users/' . $this->users['github_user'],
			'params'	=> array(
				'client_id'		=> $this->api_keys['github_client_id'],
				'client_secret'	=> $this->api_keys['github_client_secret'],
			),
			'cache'		=> $cache,
			'decode'	=> true,
		));

		// Set count.
		if ( is_array( $data ) && isset( $data['count'] ) ) {

			// Cached Count.
			$result['count'] = $this->count_format( $data['count'] );

		} elseif ( isset( $data->message ) ) {

			// API Error.
			$result['error'] = $data->message;

		} elseif ( isset( $data->followers ) ) {

			// Live Count.
			$count = $data->followers;
			$result['count'] = $this->count_format( $count );

			// Maybe Set Cache.
			$this->maybe_set_cache( $network, $count, $cache );
		}

		return $result;
	}

	/**
	 * Get behance followers count
	 *
	 * @since 1.0.0
	 * @param bool $cache  Cache Results.
	 */
	public function get_behance( $cache = true ) {

		$network = 'behance';
		$result  = array(
			'count' => 0,
		);

		// Check username.
		if ( ! $this->users['behance_user'] ) {
			$result['error'] = esc_html( 'Please enter a Behance User.', 'basic-social-accounts' );

			return $result;
		}

		// Check client id.
		if ( ! $this->api_keys['behance_client_id'] ) {
			$result['error'] = esc_html( 'Please enter a Behance Client ID.', 'basic-social-accounts' );

			return $result;
		}

		// Get Count.
		$data = $this->curl_get_api( array(
			'network'	=> $network,
			'url'		=> 'https://api.behance.net/v2/users/' . $this->users['behance_user'],
			'params'	=> array(
				'client_id' => $this->api_keys['behance_client_id'],
			),
			'cache'		=> $cache,
			'decode'	=> true,
		));

		// Set count.
		if ( is_array( $data ) && isset( $data['count'] ) ) {

			// Cached Count.
			$result['count'] = $this->count_format( $data['count'] );

		} elseif ( isset( $data->valid ) && 0 === $data->valid ) {

			// API Error.
			if ( isset( $data->messages ) ) {
				foreach ( (array) $data->messages as $message ) {
					if ( 'error' === $message->type ) {
						$result['error'] = $message->message;
					}
				}
			} else {
				$result['error'] = esc_html( 'Please check your username and client_id.', 'basic-social-accounts' );
			}
		} elseif ( isset( $data->user->stats->followers ) ) {

			// Live Count.
			$count = $data->user->stats->followers;
			$result['count'] = $this->count_format( $count );

			// Maybe Set Cache.
			$this->maybe_set_cache( $network, $count, $cache );
		}

		return $result;
	}

	/**
	 * Get vk followers count
	 *
	 * @since 1.0.0
	 * @param bool $cache  Cache Results.
	 */
	public function get_vk( $cache = true ) {

		$network = 'vk';
		$result  = array(
			'count' => 0,
		);

		// Check vk id.
		if ( ! $this->users['vk_id'] ) {
			$result['error'] = esc_html( 'Please enter a Group/Page ID.', 'basic-social-accounts' );

			return $result;
		}

		// Get Count.
		$data = $this->curl_get_api( array(
			'network'	=> $network,
			'url'		=> 'https://api.vk.com/method/groups.getById',
			'params'	=> array(
				'group_id' => trim( $this->users['vk_id'] , 'id' ),
				'fields'   => 'members_count',
			),
			'cache'		=> $cache,
			'decode'	=> true,
		));

		// Set count.
		if ( is_array( $data ) && isset( $data['count'] ) ) {

			// Cached Count.
			$result['count'] = $this->count_format( $data['count'] );

		} elseif ( isset( $data->error->error_msg ) ) {

			// API Error.
			$result['error'] = $data->error->error_msg;

		} elseif ( isset( $data->response[0]->members_count ) ) {

			// Live Count.
			$count = $data->response[0]->members_count;
			$result['count'] = $this->count_format( $count );

			// Maybe Set Cache.
			$this->maybe_set_cache( $network, $count, $cache );
		}

		return $result;
	}

	/**
	 * Get random user agent
	 *
	 * @since 1.0.0
	 */
	public function get_random_user_agent() {
		$user_agents = array(
			'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6',
			'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)',
			'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)',
			'Opera/9.20 (Windows NT 6.0; U; en)',
			'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; en) Opera 8.50',
			'Mozilla/4.0 (compatible; MSIE 6.0; MSIE 5.5; Windows NT 5.1) Opera 7.02 [en]',
			'Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; fr; rv:1.7) Gecko/20040624 Firefox/0.9',
			'Mozilla/5.0 (Macintosh; U; PPC Mac OS X; en) AppleWebKit/48 (like Gecko) Safari/48',
		);
		$random = rand( 0, count( $user_agents ) - 1 );

		return $user_agents[ $random ];
	}

	/**
	 * Count format
	 *
	 * @since 1.0.0
	 * @param int $value  Count number.
	 */
	public function count_format( $value = 0 ) {
		$result = '';
		$value  = (int) $value;

		$count_format = apply_filters( 'bsa_count_format', true );

		if ( $count_format ) {
			if ( $value > 999 && $value <= 999999 ) {
				$result = floor( $value / 1000 ) . esc_html( 'K', 'basic-social-accounts' );
			} elseif ( $value > 999999 ) {
				$result = floor( $value / 1000000 ) . esc_html( 'M', 'basic-social-accounts' );
			} else {
				$result = $value;
			}
		} else {
			$result = $value;
		}

		return $result;
	}

	/**
	 * Get Network Count
	 *
	 * @since 1.0.0
	 * @param string $network    Social network name.
	 * @param bool   $cache      Cache Results.
	 */
	public function get_count( $network, $cache = true ) {
		$count_function = 'get_' . str_replace( '-', '_', $network );

		// Get Count.
		if ( method_exists( $this, $count_function ) ) {
			return $this->$count_function( $cache );
		}
	}
}

/**
 * Get Count
 *
 * @param string $network    Social network name.
 * @param bool   $labels     Show network labels.
 * @param bool   $cache      Cache results.
 * @param bool   $array_format   Format of output.
 */
function bsa_get_count( $network = '', $labels = true, $cache = true, $array_format = false ) {

	// Get Count.
	$counter = new Basic_Social_Counter();
	$result = $counter->get_count( $network, $cache );

	if ( $array_format ) {
		return $result;
	} else {

		if ( isset( $result['error'] ) ) {
			$output = $result['error'];
		} else {
			$output = $result['count'];
		}

		return $output;
	}

}

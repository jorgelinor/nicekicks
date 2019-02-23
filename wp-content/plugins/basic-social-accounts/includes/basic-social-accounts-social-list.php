<?php
/**
 * Register Social List
 *
 * @link       https://codesupply.co
 * @since      1.1.1
 *
 * @package    Basic Social Accounts
 * @subpackage Includes
 */

/**
 * Set list social
 *
 * @param array $list Array social params.
 * @return array Array social params.
 */
function bsa_social_accounts( $list = array() ) {

	// Facebook.
	$list['facebook'] = array(
		'id'		=> 'facebook',
		'name'		=> esc_html__( 'Facebook', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Likes', 'basic-social-accounts' ),
		'link'		=> esc_url( 'https://facebook.com/%bsa_facebook_user%' ),
		'fields'	=> array(
			'bsa_facebook_user'		=> esc_html__( 'Facebook User', 'basic-social-accounts' ),
		),
	);

	// Twitter.
	$list['twitter'] = array(
		'id'		=> 'twitter',
		'name'		=> esc_html__( 'Twitter', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Followers', 'basic-social-accounts' ),
		'link'		=> esc_url( 'https://twitter.com/%bsa_twitter_user%' ),
		'fields'	=> array(
			'bsa_twitter_user'				=> esc_html__( 'Twitter User', 'basic-social-accounts' ),
		),
	);

	// Instagram.
	$list['instagram'] = array(
		'id'		=> 'instagram',
		'name'		=> esc_html__( 'Instagram', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Followers', 'basic-social-accounts' ),
		'link'		=> esc_url( 'https://www.instagram.com/%bsa_instagram_user%' ),
		'fields'	=> array(
			'bsa_instagram_user'		=> esc_html__( 'Instagram User', 'basic-social-accounts' ),
		),
	);

	// Pinterest.
	$list['pinterest'] = array(
		'id'		=> 'pinterest',
		'name'		=> esc_html__( 'Pinterest', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Followers', 'basic-social-accounts' ),
		'link'		=> esc_url( 'https://pinterest.com/%bsa_pinterest_user%' ),
		'fields'	=> array(
			'bsa_pinterest_user'		=> esc_html__( 'Pinterest User', 'basic-social-accounts' ),
		),
	);

	// Google Plus.
	$list['google-plus'] = array(
		'id'		=> 'google-plus',
		'name'		=> esc_html__( 'Google Plus', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Followers', 'basic-social-accounts' ),
		'link'		=> esc_url( 'https://plus.google.com/u/0/%bsa_google_plus_id%' ),
		'fields'	=> array(
			'bsa_google_plus_id'		=> esc_html__( 'Google Plus ID', 'basic-social-accounts' ),
		),
	);

	// YouTube.
	$list['youtube'] = array(
		'id'		=> 'youtube',
		'name'		=> esc_html__( 'YouTube', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Subscribers', 'basic-social-accounts' ),
		'link'		=> array(
			'bsa_youtube_channel_type'	=> array(
				'user'		=> esc_url( 'https://www.youtube.com/user/%bsa_youtube_slug%' ),
				'channel'	=> esc_url( 'https://www.youtube.com/channel/%bsa_youtube_slug%' ),
			),
		),
		'fields'	=> array(
			'bsa_youtube_channel_type'	=> array(
				'title'   => esc_html__( 'YouTube Channel Type', 'basic-social-accounts' ),
				'options' => array(
					'user'		=> esc_html__( 'User', 'basic-social-accounts' ),
					'channel'	=> esc_html__( 'Channel', 'basic-social-accounts' ),
				),
			),
			'bsa_youtube_slug'			=> esc_html__( 'YouTube Slug', 'basic-social-accounts' ),
		),
	);

	// Vimeo.
	$list['vimeo'] = array(
		'id'		=> 'vimeo',
		'name'		=> esc_html__( 'Vimeo', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Followers', 'basic-social-accounts' ),
		'link'		=> esc_url( 'https://vimeo.com/%bsa_vimeo_user%' ),
		'fields'	=> array(
			'bsa_vimeo_user'			=> esc_html__( 'Vimeo User', 'basic-social-accounts' ),
		),
	);

	// SoundCloud.
	$list['soundcloud'] = array(
		'id'		=> 'soundcloud',
		'name'		=> esc_html__( 'SoundCloud', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Followers', 'basic-social-accounts' ),
		'link'		=> esc_url( 'https://soundcloud.com/%bsa_soundcloud_user_id%' ),
		'fields'	=> array(
			'bsa_soundcloud_user_id'	=> esc_html__( 'SoundCloud User ID', 'basic-social-accounts' ),
		),
	);

	// Spotify.
	$list['spotify'] = array(
		'id'		=> 'spotify',
		'name'		=> esc_html__( 'Spotify', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Followers', 'basic-social-accounts' ),
		'link'		=> esc_url( 'https://open.spotify.com/user/%bsa_spotify_user%' ),
		'fields'	=> array(
			'bsa_spotify_user'				=> esc_html__( 'Spotify User', 'basic-social-accounts' ),
		),
	);

	// Dribbble.
	$list['dribbble'] = array(
		'id'		=> 'dribbble',
		'name'		=> esc_html__( 'Dribbble', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Followers', 'basic-social-accounts' ),
		'link'		=> esc_url( 'https://dribbble.com/%bsa_dribbble_user%' ),
		'fields'	=> array(
			'bsa_dribbble_user'		=> esc_html__( 'Dribbble User', 'basic-social-accounts' ),
		),
	);

	// Behance.
	$list['behance'] = array(
		'id'		=> 'behance',
		'name'		=> esc_html__( 'Behance', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Followers', 'basic-social-accounts' ),
		'link'		=> esc_url( 'https://www.behance.net/%bsa_behance_user%' ),
		'fields'	=> array(
			'bsa_behance_user'			=> esc_html__( 'Behance User', 'basic-social-accounts' ),
		),
	);

	// GitHub.
	$list['github'] = array(
		'id'		=> 'github',
		'name'		=> esc_html__( 'GitHub', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Followers', 'basic-social-accounts' ),
		'link'		=> esc_url( 'https://github.com/%bsa_github_user%' ),
		'fields'	=> array(
			'bsa_github_user'			=> esc_html__( 'GitHub User', 'basic-social-accounts' ),
		),
	);

	// VK.
	$list['vk'] = array(
		'id'		=> 'vk',
		'name'		=> esc_html__( 'VK', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Followers', 'basic-social-accounts' ),
		'link'		=> esc_url( 'https://vk.com/%bsa_vk_id%' ),
		'fields'	=> array(
			'bsa_vk_id'				=> esc_html__( 'Page Name', 'basic-social-accounts' ),
		),
	);

	// LinkedIn.
	$list['linkedin'] = array(
		'id'		=> 'linkedin',
		'name'		=> esc_html__( 'LinkedIn', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Followers', 'basic-social-accounts' ),
		'link'		=> array(
			'bsa_linkedin_channel_type'	=> array(
				'personal'	=> esc_url( 'https://www.linkedin.com/in/%bsa_linkedin_slug%' ),
				'business'	=> esc_url( 'https://www.linkedin.com/company/%bsa_linkedin_slug%' ),
			),
		) ,
		'fields'	=> array(
			'bsa_linkedin_channel_type'	=> array(
				'title'   => esc_html__( 'Profile Type', 'basic-social-accounts' ),
				'options' => array(
					'personal'	=> esc_html__( 'Personal', 'basic-social-accounts' ),
					'business'	=> esc_html__( 'Business', 'basic-social-accounts' ),
				),
			),
			'bsa_linkedin_slug'	=> esc_html__( 'LinkedIn Slug', 'basic-social-accounts' ),
		),
	);

	// Tumblr.
	$list['tumblr'] = array(
		'id'		=> 'tumblr',
		'name'		=> esc_html__( 'Tumblr', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Followers', 'basic-social-accounts' ),
		'link'		=> '%bsa_tumblr_url%',
		'fields'	=> array(
			'bsa_tumblr_url'				=> esc_html__( 'Tumblr URL', 'basic-social-accounts' ),
		),
	);

	// Bloglovin.
	$list['bloglovin'] = array(
		'id'		=> 'bloglovin',
		'name'		=> esc_html__( 'Bloglovin', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Followers', 'basic-social-accounts' ),
		'link'		=> '%bsa_bloglovin_url%',
		'fields'	=> array(
			'bsa_bloglovin_url'				=> esc_html__( 'Bloglovin URL', 'basic-social-accounts' ),
		),
	);

	// RSS.
	$list['rss'] = array(
		'id'		=> 'rss',
		'name'		=> esc_html__( 'RSS', 'basic-social-accounts' ),
		'label'		=> esc_html__( 'Feed', 'basic-social-accounts' ),
		'link'		=> '%bsa_rss_url%',
		'fields'	=> array(
			'bsa_rss_url'		=> esc_html__( 'RSS URL', 'basic-social-accounts' ),
		),
	);

	return $list;
}
add_filter( 'bsa_social_accounts', 'bsa_social_accounts' );

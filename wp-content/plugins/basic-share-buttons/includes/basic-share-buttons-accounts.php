<?php
/**
 * Accounts Config
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Basic Share Buttons
 * @subpackage Includes
 */

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
		'count_walker'	=> 'bsb_share_facebook_counter',
	);

	return $accounts;
}
add_filter( 'bsb_share_accounts', 'bsb_add_facebook_share', 10, 3 );


/**
 * Add Facebook Messenger provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function bsb_add_fb_messenger_share( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'fb-messenger://share/?link=' . $share_url, null, '' );

	/* Add account */
	$accounts['fb-messenger'] = array(
		'share_url'		=> $share_url,
		'name'			=> esc_html__( 'Facebook Messenger', 'basic-share-buttons' ),
		'label'			=> esc_html__( 'Like', 'basic-share-buttons' ),
	);

	return $accounts;
}
add_filter( 'bsb_share_accounts', 'bsb_add_fb_messenger_share', 10, 3 );


/**
 * Add Twitter provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function bsb_add_twitter_share( $accounts, $share_url, $post_id ) {

	/* Twitter Text */
	if ( intval( $post_id ) > 0 ) {
		$twitter_text = '&text=' . rawurlencode( get_the_title( $post_id ) );
	} else {
		$twitter_text = '';
	}

	/* Twitter Via */
	$username = get_option( 'bsa_twitter_user' );

	if ( $username ) {
		$via = '&via=' . $username;
	} else {
		$via = '';
	}

	/* Share url */
	$share_url = esc_url( 'https://twitter.com/share?url=' . $share_url . $twitter_text . $via, null, '' );

	/* Add account */
	$accounts['twitter'] = array(
		'share_url'		=> $share_url,
		'name'			=> esc_html__( 'Twitter', 'basic-share-buttons' ),
		'label'			=> esc_html__( 'Tweet', 'basic-share-buttons' ),
	);

	return $accounts;
}
add_filter( 'bsb_share_accounts', 'bsb_add_twitter_share', 10, 3 );


/**
 * Add Pinterest provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function bsb_add_pinterest_share( $accounts, $share_url, $post_id ) {

	/* Media */
	$media = '';
	if ( intval( $post_id ) > 0 ) {

		$thumb_url = false;

		// Parse all images.
		$post_content = get_post_field( 'post_content', intval( $post_id ) );

		if ( $post_content ) {
			//$post_content = apply_filters( 'the_content', $post_content );
			//$post_content = str_replace( ']]>', ']]&gt;', $post_content );
			preg_match_all( '/<img[^>]+>/i', $post_content, $result );

			if ( is_array( $result ) ) {

				$images = array();

				// Parse attributes from finded images.
				foreach ( $result[0] as $img_tag ) {
					preg_match_all( '/(class|src)=("[^"]*")/i', $img_tag, $images[ $img_tag ] );
				}

				if ( is_array( $images ) ) {

					// Post Content images loop.
					foreach ( $images as $image_key => $image ) {

						$temp_src  = false;
						$pin_exist = false;

						// Each attributes per image.
						foreach ( $image[1] as $index => $attr ) {
							if ( 'src' === $attr ) {
								$temp_src = $image[2][ $index ];
							}

							if ( 'class' === $attr && strpos( $image[2][ $index ], 'csco-pinterest-cover' ) !== false ) {
								$pin_exist = true;
							}
						}

						// Finded! Break loop and return image url.
						if ( $pin_exist ) {
							$thumb_url = $temp_src;

							break;
						}
					}
				}
			} // End if().
		} // End if().

		// Show post thumnail, if post content doesn't have pinterest class in images.
		if ( ! $thumb_url ) {
			$thumb_url = get_the_post_thumbnail_url( intval( $post_id ), 'large' );
		}

		if ( $thumb_url ) {
			$media = '&media=' . $thumb_url;
		}
	} // End if().

	/* Share url */
	$share_url = esc_url( 'https://pinterest.com/pin/create/bookmarklet/?url=' . $share_url . $media, null, '' );

	/* Add account */
	$accounts['pinterest'] = array(
		'share_url'		=> $share_url,
		'name'			=> esc_html__( 'Pinterest', 'basic-share-buttons' ),
		'label'			=> esc_html__( 'Pin it', 'basic-share-buttons' ),
		'count_walker'	=> 'bsb_share_pinterest_counter',
	);

	return $accounts;
}
add_filter( 'bsb_share_accounts', 'bsb_add_pinterest_share', 10, 3 );


/**
 * Add Googleplus provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function bsb_add_google_share( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'https://plus.google.com/share?url=' . $share_url, null, '' );

	/* Add account */
	$accounts['googleplus'] = array(
		'share_url'		=> $share_url,
		'name'			=> esc_html__( 'Google Plus', 'basic-share-buttons' ),
		'label'			=> esc_html__( '+1', 'basic-share-buttons' ),
		'count_walker'  => 'bsb_share_google_counter',
	);

	return $accounts;
}
add_filter( 'bsb_share_accounts', 'bsb_add_google_share', 10, 3 );


/**
 * Add LinkedIn provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function bsb_add_linkedin_share( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'https://www.linkedin.com/shareArticle?mini=true&url=' . $share_url, null, '' );

	/* Add account */
	$accounts['linkedin'] = array(
		'share_url'		=> $share_url,
		'name'			=> esc_html__( 'LinkedIn', 'basic-share-buttons' ),
		'label'			=> esc_html__( 'Share', 'basic-share-buttons' ),
		'count_walker'  => 'bsb_share_linkedin_counter',
	);

	return $accounts;
}
add_filter( 'bsb_share_accounts', 'bsb_add_linkedin_share', 10, 3 );


/**
 * Add StumbleUpon provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function bsb_add_stumbleupon_share( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'http://www.stumbleupon.com/submit?url=' . $share_url, null, '' );

	/* Add account */
	$accounts['stumbleupon'] = array(
		'share_url'		=> $share_url,
		'name'			=> esc_html__( 'StumbleUpon', 'basic-share-buttons' ),
		'label'			=> esc_html__( 'Share', 'basic-share-buttons' ),
	);

	return $accounts;
}
add_filter( 'bsb_share_accounts', 'bsb_add_stumbleupon_share', 10, 3 );


/**
 * Add Pocket provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function bsb_add_pocket_share( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'https://getpocket.com/save?url=' . $share_url, null, '' );

	/* Add account */
	$accounts['pocket'] = array(
		'share_url'		=> $share_url,
		'name'			=> esc_html__( 'Pocket', 'basic-share-buttons' ),
		'label'			=> esc_html__( 'Share', 'basic-share-buttons' ),
	);

	return $accounts;
}
add_filter( 'bsb_share_accounts', 'bsb_add_pocket_share', 10, 3 );


/**
 * Add WhatsApp provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function bsb_add_whatsapp_share( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'whatsapp://send?text=' . $share_url, null, '' );

	/* Add account */
	$accounts['whatsapp'] = array(
		'share_url'		=> $share_url,
		'name'			=> esc_html__( 'WhatsApp', 'basic-share-buttons' ),
		'label'			=> esc_html__( 'Share', 'basic-share-buttons' ),
	);

	return $accounts;
}
add_filter( 'bsb_share_accounts', 'bsb_add_whatsapp_share', 10, 3 );


/**
 * Add Viber provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function bsb_add_viber_share( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'viber://forward?text=' . $share_url, null, '' );

	/* Add account */
	$accounts['viber'] = array(
		'share_url'		=> $share_url,
		'name'			=> esc_html__( 'Viber', 'basic-share-buttons' ),
		'label'			=> esc_html__( 'Share', 'basic-share-buttons' ),
	);

	return $accounts;
}
add_filter( 'bsb_share_accounts', 'bsb_add_viber_share', 10, 3 );


/**
 * Add Vkontakte provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function bsb_add_vk_share( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'https://vk.com/share.php?url=' . $share_url, null, '' );

	/* Add account */
	$accounts['vkontakte'] = array(
		'share_url'		=> $share_url,
		'name'			=> esc_html__( 'VK', 'basic-share-buttons' ),
		'label'			=> esc_html__( 'Like', 'basic-share-buttons' ),
	);

	return $accounts;
}
add_filter( 'bsb_share_accounts', 'bsb_add_vk_share', 10, 3 );


/**
 * Add Telegram provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function bsb_add_telegram_share( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'tg://msg?text=' . $share_url, null, '' );

	/* Add account */
	$accounts['telegram'] = array(
		'share_url'		=> $share_url,
		'name'			=> esc_html__( 'Telegram', 'basic-share-buttons' ),
		'label'			=> esc_html__( 'Share', 'basic-share-buttons' ),
	);

	return $accounts;
}
add_filter( 'bsb_share_accounts', 'bsb_add_telegram_share', 10, 3 );


/**
 * Add LINE provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function bsb_add_line_share( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'http://line.me/R/msg/text/?' . $share_url, null, '' );

	/* Add account */
	$accounts['line'] = array(
		'share_url'		=> $share_url,
		'name'			=> esc_html__( 'Line', 'basic-share-buttons' ),
		'label'			=> esc_html__( 'Share', 'basic-share-buttons' ),
	);

	return $accounts;
}
add_filter( 'bsb_share_accounts', 'bsb_add_line_share', 10, 3 );


/**
 * Add Reddit provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function bsb_add_reddit_share( $accounts, $share_url, $post_id ) {

	/* Share url */
	$share_url = esc_url( 'http://www.reddit.com/submit?url=' . $share_url, null, '' );

	/* Add account */
	$accounts['reddit'] = array(
		'share_url'		=> $share_url,
		'name'			=> esc_html__( 'Reddit', 'basic-share-buttons' ),
		'label'			=> esc_html__( 'Share', 'basic-share-buttons' ),
	);

	return $accounts;
}
add_filter( 'bsb_share_accounts', 'bsb_add_reddit_share', 10, 3 );


/**
 * Add Mail provider.
 *
 * @param array      $accounts   Social Accounts List.
 * @param string     $share_url  Url for Share.
 * @param int|string $post_id    Post Id or options.
 */
function bsb_add_mail_share( $accounts, $share_url, $post_id ) {

	/* Twitter Text */
	if ( intval( $post_id ) > 0 ) {
		$post_title = rawurlencode( get_the_title( $post_id ) );
	} else {
		$post_title = esc_html__( 'Share Link', 'basic-share-buttons' );
	}

	/* Share url */
	$share_url = esc_url( 'mailto:?subject=' . $post_title . '&body=' . $post_title . '%20' . $share_url, null, '' );

	/* Add account */
	$accounts['mail'] = array(
		'share_url'		=> $share_url,
		'name'			=> esc_html__( 'Mail', 'basic-share-buttons' ),
		'label'			=> esc_html__( 'Share', 'basic-share-buttons' ),
	);

	return $accounts;
}
add_filter( 'bsb_share_accounts', 'bsb_add_mail_share', 10, 3 );

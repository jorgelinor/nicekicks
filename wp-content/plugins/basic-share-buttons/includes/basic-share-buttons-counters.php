<?php
/**
 * Social Share Counters
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Basic Share Buttons
 * @subpackage Includes
 */

/**
 * Add Facebook Counter.
 *
 * @param array      $account   Account name.
 * @param int|string $post_id   Post ID.
 * @param string     $url       Custom URL.
 */
function bsb_share_facebook_counter( $account, $post_id, $url = null ) {

	// Get Post ID.
	$post_id = bsb_get_current_post_id( $url );

	// Get Chache.
	$count = bsb_get_cached_count( $account, $post_id, $url );

	if ( false !== $count ) {
		return intval( $count );
	}

	// Get Share URL.
	$share_url = bsb_get_share_url( $post_id, $url );

	// Get Counter.
	$endpoint = esc_url( 'https://graph.facebook.com/?id=' . $share_url, null, '' );
	$response = wp_remote_get( $endpoint, array(
		'timeout' => 3,
	) );

	$response = wp_remote_retrieve_body( $response );

	// Create Counter.
	$response_result = json_decode( $response, true );

	if ( isset( $response_result['share']['share_count'] ) ) {
		$count = $response_result['share']['share_count'];
	} else {
		$count = bsb_get_cached_count( $account, $post_id, $url, true );
	}

	// Set Cache.
	bsb_set_cache_count( $account, $post_id, intval( $count ), $url );

	// Return Result.
	return $count;
}

/**
 * Add Google Counter.
 *
 * @param array      $account   Account name.
 * @param int|string $post_id   Post ID.
 * @param string     $url       Custom URL.
 */
function bsb_share_google_counter( $account, $post_id, $url = null ) {

	// Get Post ID.
	$post_id = bsb_get_current_post_id( $url );

	// Get Chache.
	$count = bsb_get_cached_count( $account, $post_id, $url );

	if ( false !== $count ) {
		return intval( $count );
	}

	// Get Share URL.
	$share_url = bsb_get_share_url( $post_id, $url );

	// Get Count.
	$args = array(
		'method' 	=> 'POST',
		'timeout' 	=> 3,
		'blocking'	=> true,
		'headers'	=> array(
			'Content-Type' => 'application/json',
		),
		'body'		=> '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $share_url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]',
	);
	$response = wp_remote_post( esc_url( 'https://clients6.google.com/rpc', null, '' ), $args );
	$response = wp_remote_retrieve_body( $response );

	// Set Count.
	$response_result = json_decode( $response, true );
	if ( isset( $response_result[0]['result']['metadata']['globalCounts']['count'] ) ) {
		$count = $response_result[0]['result']['metadata']['globalCounts']['count'];
	} else {
		$count = bsb_get_cached_count( $account, $post_id, $url, true );
	}

	// Set Cache.
	bsb_set_cache_count( $account, $post_id, intval( $count ), $url );

	// Return Result.
	return $count;
}

/**
 * Add LinkedIn Counter.
 *
 * @param array      $account   Account name.
 * @param int|string $post_id   Post ID.
 * @param string     $url       Custom URL.
 */
function bsb_share_linkedin_counter( $account, $post_id, $url = null ) {

	// Get Post ID.
	$post_id = bsb_get_current_post_id( $url );

	// Get Chache.
	$count = bsb_get_cached_count( $account, $post_id, $url );

	if ( false !== $count ) {
		return intval( $count );
	}

	// Get Share URL.
	$share_url = bsb_get_share_url( $post_id, $url );

	// Get Count.
	$endpoint = esc_url( 'https://www.linkedin.com/countserv/count/share?format=json&url=' . $share_url, null, '' );
	$response = wp_remote_get( $endpoint, array(
		'timeout' => 3,
	) );
	$response = wp_remote_retrieve_body( $response );

	// Set Count.
	$response_result = json_decode( $response, true );

	if ( isset( $response_result['count'] ) ) {
		$count = $response_result['count'];
	} else {
		$count = bsb_get_cached_count( $account, $post_id, $url, true );
	}

	// Set Cache.
	bsb_set_cache_count( $account, $post_id, intval( $count ), $url );

	// Return Result.
	return $count;
}

/**
 * Add Pinterest Counter.
 *
 * @param array      $account   Account name.
 * @param int|string $post_id   Post ID.
 * @param string     $url       Custom URL.
 */
function bsb_share_pinterest_counter( $account, $post_id, $url = null ) {

	// Get Post ID.
	$post_id = bsb_get_current_post_id( $url );

	// Get Chache.
	$count = bsb_get_cached_count( $account, $post_id, $url );

	if ( false !== $count ) {
		return intval( $count );
	}

	// Get Share URL.
	$share_url = bsb_get_share_url( $post_id, $url );

	// Get Count.
	$endpoint = esc_url( 'https://widgets.pinterest.com/v1/urls/count.json?callback=jsonp&url=' . $share_url, null, '' );
	$response = wp_remote_get( $endpoint, array(
		'timeout' => 3,
	) );
	$response = wp_remote_retrieve_body( $response );

	// Set Count.
	$response_body   = str_replace( array( 'jsonp(', ')' ), '', $response );
	$response_result = json_decode( $response_body, true );

	if ( isset( $response_result['count'] ) ) {
		$count = $response_result['count'];
	} else {
		$count = bsb_get_cached_count( $account, $post_id, $url, true );
	}

	// Set Cache.
	bsb_set_cache_count( $account, $post_id, intval( $count ), $url );

	// Return Result.
	return $count;
}

/**
 * Add Vkontakte Counter.
 *
 * @param array      $account   Account name.
 * @param int|string $post_id   Post ID.
 * @param string     $url       Custom URL.
 */
function bsb_share_vkontakte_counter( $account, $post_id, $url = null ) {

	// Get Post ID.
	$post_id = bsb_get_current_post_id( $url );

	// Get Chache.
	$count = bsb_get_cached_count( $account, $post_id, $url );

	if ( false !== $count ) {
		return intval( $count );
	}

	// Get Share URL.
	$share_url = bsb_get_share_url( $post_id, $url );

	// Get Count.
	$endpoint = esc_url( 'https://vk.com/share.php?act=count&index=1&url=' . $share_url, null, '' );
	$response = wp_remote_get( $endpoint, array(
		'timeout' => 3,
	) );
	$response = wp_remote_retrieve_body( $response );

	// Set Count.
	preg_match( '/^VK.Share.count\(1, (\d+)\);$/i', $response, $response_result );

	if ( isset( $response_result[1] ) ) {
		$count = $response_result[1];
	} else {
		$count = bsb_get_cached_count( $account, $post_id, $url, true );
	}

	// Set Cache.
	bsb_set_cache_count( $account, $post_id, intval( $count ), $url );

	// Return Result.
	return $count;
}

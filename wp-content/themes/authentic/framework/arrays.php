<?php
/**
 * Arrays and utility functions.
 *
 * @package Authentic Wordpress Theme
 * @subpackage Framework
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * Returns array of all default image sizes.
 */
function csco_get_custom_image_sizes() {

	$choices = array(
		array(
			// Equivalent for 1080p.
			'name'   => esc_html__( 'Extra Large', 'authentic' ),
			'slug'   => 'xl',
			'width'  => 1920,
			'height' => 0,
			'crop'   => false,
			),
		array(
			// Equivalent for 720p.
			'name'   => esc_html__( 'Large Horizontal', 'authentic' ),
			'slug'   => 'lg-hor',
			'width'  => 1280,
			'height' => 720,
			'crop'   => true,
			),
		array(
			// 1.25 Ratio.
			'name'   => esc_html__( 'Large Vertical', 'authentic' ),
			'slug'   => 'lg-ver',
			'width'  => 960,
			'height' => 1280,
			'crop'   => true,
			),
		array(
			// 1 Ratio.
			'name'   => esc_html__( 'Large Square', 'authentic' ),
			'slug'   => 'lg-sq',
			'width'  => 1280,
			'height' => 1280,
			'crop'   => true,
			),
		array(
			// Equivalent for 480p.
			'name'   => esc_html__( 'Medium Uncropped', 'authentic' ),
			'slug'   => 'md',
			'width'  => 720,
			'height' => 0,
			'crop'   => false,
			),
		array(
			// Equivalent for 480p.
			'name'   => esc_html__( 'Medium Horizontal', 'authentic' ),
			'slug'   => 'md-hor',
			'width'  => 720,
			'height' => 480,
			'crop'   => true,
			),
		array(
			// 1.25 Ratio.
			'name'   => esc_html__( 'Medium Vertical', 'authentic' ),
			'slug'   => 'md-ver',
			'width'  => 540,
			'height' => 720,
			'crop'   => true,
			),
		array(
			// 1 Ratio.
			'name'   => esc_html__( 'Medium Square', 'authentic' ),
			'slug'   => 'md-sq',
			'width'  => 720,
			'height' => 720,
			'crop'   => true,
			),
		array(
			// Small Square.
			'name'   => esc_html__( 'Small Square', 'authentic' ),
			'slug'   => 'sm-sq',
			'width'  => 160,
			'height' => 160,
			'crop'   => true,
			),
		);

	return apply_filters( 'csco_custom_image_sizes', $choices );

}

/**
 * Returns array of all registered image sizes.
 *
 * @param  bool  $show_dimension True for displaying dimension.
 * @param  bool  $add_default    True for adding Default option.
 * @param  bool  $add_disable    True for adding No Image option.
 * @param  array $allowed        Allowed image size options.
 * @return array Image size options.
 */
function csco_get_registered_image_sizes( $show_dimension = false, $add_default = false, $add_disable = false, $allowed = array() ) {

	$choices = array();

	if ( true === $add_disable ) {
		$choices['disable'] = esc_html__( 'No Image', 'authentic' );
	}

	if ( true === $add_default ) {
		$choices['default'] = esc_html__( 'Default', 'authentic' );
	}

	// Add the WordPress default image sizes.
	$choices['large']             = esc_html__( 'Large', 'authentic' );
	$choices['medium']            = esc_html__( 'Medium', 'authentic' );
	$choices['thumbnail']         = esc_html__( 'Thumbnail', 'authentic' );

	if ( true === $show_dimension ) {
		foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
			$choices[ $_size ] = $choices[ $_size ] . ' (' . get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
		}
	}

	// Get the default image sizes.
	$image_sizes = csco_get_custom_image_sizes();

	// Loop through the image sizes array.
	if ( $image_sizes ) {

		foreach ( $image_sizes as $image_size ) {
			$choices[ $image_size['slug'] ] = $image_size['name'];
		}

		if ( true === $show_dimension ) {
			foreach ( $image_sizes as $image_size ) {
				$choices[ $image_size['slug'] ] .= ' (' . intval( $image_size['width'] ) . 'x' . intval( $image_size['height'] ) . ')';
			}
		}
	}

	if ( ! empty( $allowed ) ) {
		foreach ( $choices as $key => $value ) {
			if ( ! in_array( $key, $allowed, true ) ) {
				unset( $choices[ $key ] );
			}
		}
	}

	return apply_filters( 'csco_registered_image_sizes', $choices );

}

/**
 * Returns array of post sources
 *
 * @param string $additional Additional post source.
 */
function csco_get_post_sources( $additional = null ) {

	$choices = array(
		'all'       => esc_html__( 'All Posts', 'authentic' ),
		'category'  => esc_html__( 'Category', 'authentic' ),
		'tag'       => esc_html__( 'Tag', 'authentic' ),
		);

	if ( 'featured' === $additional ) {
		$choices['featured'] = esc_html__( 'Featured Posts', 'authentic' );
	}

	return apply_filters( 'csco_post_sources', $choices );
}

/**
 * Returns Array of all Social Accounts with slug as key and name as value.
 */
function csco_get_social_accounts() {

	$choices = array(
		'facebook'    => esc_html__( 'Facebook', 'authentic' ),
		'twitter'     => esc_html__( 'Twitter', 'authentic' ),
		'google-plus' => esc_html__( 'Google Plus', 'authentic' ),
		'instagram'   => esc_html__( 'Instagram', 'authentic' ),
		'pinterest'   => esc_html__( 'Pinterest', 'authentic' ),
		'youtube'     => esc_html__( 'YouTube', 'authentic' ),
		'vimeo'       => esc_html__( 'Vimeo', 'authentic' ),
		'tumblr'      => esc_html__( 'Tumblr', 'authentic' ),
		'linkedin'    => esc_html__( 'LinkedIn', 'authentic' ),
		'dribbble'    => esc_html__( 'Dribbble', 'authentic' ),
		'bloglovin'   => esc_html__( 'Bloglovin', 'authentic' ),
		'behance'     => esc_html__( 'Behance', 'authentic' ),
		'github'      => esc_html__( 'GitHub', 'authentic' ),
		'soundcloud'  => esc_html__( 'SoundCloud', 'authentic' ),
		'spotify'     => esc_html__( 'Spotify', 'authentic' ),
		'vkontakte'   => esc_html__( 'Vkontakte', 'authentic' ),
		'rss'         => esc_html__( 'RSS', 'authentic' ),
		);

	return apply_filters( 'csco_social_accounts', $choices );

}

/**
 * Returns array of all available icons.
 */
function csco_get_icons() {

	$choices = array(
		'angle-down'    => esc_html__( 'Angle Down', 'authentic' ),
		'angle-left'    => esc_html__( 'Angle Left', 'authentic' ),
		'angle-right'   => esc_html__( 'Angle Right', 'authentic' ),
		'angle-up'      => esc_html__( 'Angle Up', 'authentic' ),
		'arrow-down'    => esc_html__( 'Arrow Down', 'authentic' ),
		'arrow-left'    => esc_html__( 'Arrow Left', 'authentic' ),
		'arrow-right'   => esc_html__( 'Arrow Right', 'authentic' ),
		'arrow-up'      => esc_html__( 'Arrow Up', 'authentic' ),
		'behance'       => esc_html__( 'Behance', 'authentic' ),
		'bloglovin'     => esc_html__( 'Bloglovin', 'authentic' ),
		'chevron-down'  => esc_html__( 'Chevron Down', 'authentic' ),
		'chevron-left'  => esc_html__( 'Chevron Left', 'authentic' ),
		'chevron-right' => esc_html__( 'Chevron Right', 'authentic' ),
		'chevron-up'    => esc_html__( 'Chevron Up', 'authentic' ),
		'circle-plus'   => esc_html__( 'Circle Plus', 'authentic' ),
		'clock'         => esc_html__( 'Clock', 'authentic' ),
		'cross'         => esc_html__( 'Cross', 'authentic' ),
		'delete'        => esc_html__( 'Delete', 'authentic' ),
		'diamond'       => esc_html__( 'Diamond', 'authentic' ),
		'dribbble'      => esc_html__( 'Dribbble', 'authentic' ),
		'ellipsis'      => esc_html__( 'Ellipsis', 'authentic' ),
		'eye'           => esc_html__( 'Eye', 'authentic' ),
		'facebook'      => esc_html__( 'Facebook', 'authentic' ),
		'feed'          => esc_html__( 'Feed', 'authentic' ),
		'googleplus'    => esc_html__( 'Google Plus', 'authentic' ),
		'heart'         => esc_html__( 'Heart', 'authentic' ),
		'image'         => esc_html__( 'Image', 'authentic' ),
		'instagram'     => esc_html__( 'Instagram', 'authentic' ),
		'line'          => esc_html__( 'Line', 'authentic' ),
		'linkedin'      => esc_html__( 'LinkedIn', 'authentic' ),
		'mail'          => esc_html__( 'Mail', 'authentic' ),
		'map-marker'    => esc_html__( 'Map Marker', 'authentic' ),
		'menu'          => esc_html__( 'Menu', 'authentic' ),
		'messenger'     => esc_html__( 'Messenger', 'authentic' ),
		'minus'         => esc_html__( 'Minus', 'authentic' ),
		'phone'         => esc_html__( 'Phone', 'authentic' ),
		'pinterest'     => esc_html__( 'Pinterest', 'authentic' ),
		'plus'          => esc_html__( 'Plus', 'authentic' ),
		'pocket'        => esc_html__( 'Pocket', 'authentic' ),
		'repeat'        => esc_html__( 'Repeat', 'authentic' ),
		'reply'         => esc_html__( 'Reply', 'authentic' ),
		'retweet'       => esc_html__( 'Retweet', 'authentic' ),
		'ribbon'        => esc_html__( 'Ribbon', 'authentic' ),
		'rss'           => esc_html__( 'RSS', 'authentic' ),
		'search'        => esc_html__( 'Search', 'authentic' ),
		'share'         => esc_html__( 'Share', 'authentic' ),
		'soundcloud'    => esc_html__( 'Soundcloud', 'authentic' ),
		'speech-bubble' => esc_html__( 'Speech Bubble', 'authentic' ),
		'spotify'       => esc_html__( 'Spotify', 'authentic' ),
		'stumbleupon'   => esc_html__( 'StumbleUpon', 'authentic' ),
		'telegram'      => esc_html__( 'Telegram', 'authentic' ),
		'tumblr'        => esc_html__( 'Tumblr', 'authentic' ),
		'twitter'       => esc_html__( 'Twitter', 'authentic' ),
		'viber'         => esc_html__( 'Viber', 'authentic' ),
		'video'         => esc_html__( 'Video', 'authentic' ),
		'vimeo'         => esc_html__( 'Vimeo', 'authentic' ),
		'vkontakte'     => esc_html__( 'Vkontakte', 'authentic' ),
		'whatsapp'      => esc_html__( 'WhatsApp', 'authentic' ),
		'youtube'       => esc_html__( 'YouTube', 'authentic' ),
	);

	return apply_filters( 'csco_icons', $choices );

}

/**
 * Returns array of all available menus.
 */
function csco_get_menus() {

	// Get all menus.
	$menus = get_terms( 'nav_menu' );

	$choices = array();

	if ( $menus ) {
		foreach ( $menus as $menu ) {
			// Add each menu ID and name to the array.
			$choices[ $menu->term_id ] = $menu->name;
		}
	}

	return apply_filters( 'csco_menus', $choices );

}

/**
 * Returns the first available menu.
 */
function csco_get_default_menu() {

	// Get all menus.
	$menus = csco_get_menus();

	// Reset the array.
	reset( $menus );

	// Get the key of the first array item.
	$menu = key( $menus );

	return apply_filters( 'csco_default_menu', $menu );

}

/**
 * Returns Array of Header Content Select Options
 *
 * @param array $allow Array of allowed options.
 */
function csco_get_header_content_select( $allowed = array() ) {

	$choices = array(
		'toggle'    => esc_html__( 'Off-Сanvas Toggle', 'authentic' ),
		'search'    => esc_html__( 'Search', 'authentic' ),
		'social'    => esc_html__( 'Social Accounts', 'authentic' ),
		'button'    => esc_html__( 'Button', 'authentic' ),
		'html'      => esc_html__( 'HTML', 'authentic' ),
		'none'      => esc_html__( 'None', 'authentic' ),
		);

	// Check if there're any menus.
	if ( wp_get_nav_menus() ) {
		// Add menu item.
		$choices['menu'] = esc_html__( 'Menu', 'authentic' );
	}

	// Check if WooCommerce is activated.
	if ( class_exists( 'woocommerce' ) ) {
		// Add cart item.
		$choices['cart'] = esc_html__( 'Cart', 'authentic' );
	}

	// Apply filters.
	$choices = apply_filters( 'csco_header_content_select', $choices );

	// Remove disallowed options.
	$choices = array_intersect_key( $choices, array_flip( $allowed ) );

	return $choices;
}

/**
 * Returns Array of Registered Sidebars
 */
function csco_get_registered_sidebars() {
	global $wp_registered_sidebars;
	$choices = array();
	foreach ( $wp_registered_sidebars as $sidebar ) {
		$choices[ $sidebar['id'] ] = $sidebar['name'];
	}
	return $choices;
}

/**
 * Returns Array Post Authors
 */
function csco_get_post_authors() {
	$authors = array();

	$users = get_users( array(
		'blog_id'     => get_current_blog_id(),
		'orderby'     => 'display_name',
		'order'       => 'ASC',
		'count_total' => false,
		'fields'      => array( 'ID', 'display_name' ),
		'has_published_posts' => true,
	) );

	foreach ( $users as $user ) {
		$authors[ $user->ID ] = $user->display_name;
	}

	return $authors;
}

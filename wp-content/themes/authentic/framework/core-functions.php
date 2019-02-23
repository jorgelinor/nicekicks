<?php
/**
 * Core Theme Functions
 *
 * @package Authentic WordPress Theme
 * @subpackage Framework
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * Get locale in uniform format.
 */
function csco_get_locale() {

	$csco_locale = get_locale();

	if ( preg_match( '#^[a-z]{2}\-[A-Z]{2}$#', $csco_locale ) ) {
		$csco_locale = str_replace( '-', '_', $csco_locale );
	} elseif ( preg_match( '#^[a-z]{2}$#', $csco_locale ) ) {
		$csco_locale .= '_' . mb_strtoupper( $csco_locale, 'UTF-8' );
	}

	if ( empty( $csco_locale ) ) {
		$csco_locale = 'en_US';
	}

	return apply_filters( 'csco_locale', $csco_locale );

}

/**
 * Returns Page Layout: layout-sidebar-left, layout-sidebar-right or layout-fullwidth.
 */
function csco_get_page_layout() {

	if ( is_home() || is_front_page() ) {

		// Check if default theme mods shall be used.
		if ( get_theme_mod( 'home_layout_default', true ) ) {

			// Get Layout, specified in Layout > General.
			$layout = get_theme_mod( 'layout', 'layout-sidebar-right' );

		} else {

			// Get Layout, specified in Homepage > Layout.
			$layout = get_theme_mod( 'home_layout', 'layout-sidebar-right' );

		}
	} elseif ( is_singular( array( 'post', 'page' ) ) ) {

		global $post;

		// Get Layout for current post.
		$layout = csco_get_field( 'csco_singular_layout', $post->ID, 'default' );

		if ( 'default' === $layout ) {

			if ( get_theme_mod( get_post_type( $post ) . '_layout_default', true ) ) {

				// Get Layout, specified in Layout > General.
				$layout  = get_theme_mod( 'layout', 'layout-sidebar-right' );

			} else {

				// Get Layout for current post / page.
				$layout = get_theme_mod( get_post_type( $post ) . '_layout', 'layout-sidebar-right' );

			}
		}
	} elseif ( is_404() ) {

		$layout = 'layout-fullwidth';

	} else {

		$layout = get_theme_mod( 'layout', 'layout-sidebar-right' );

	} // End if().

	return apply_filters( 'csco_page_layout', $layout );

}

/**
 * Checks if there's a header
 */
function csco_has_header() {

	// Check if there's a header globally.
	$header = get_theme_mod( 'header', true );

	return apply_filters( 'csco_has_header', $header );

}

/**
 * Returns Page Header Type: simple, small, wide or large.
 */
function csco_get_page_header_type() {

	if ( is_home() || is_front_page() ) {

		$slider      = get_theme_mod( 'home_slider', false );
		$slider_type = get_theme_mod( 'home_slider_type', 'center' );

		if ( 'large' === $slider_type && true === $slider ) {

			$page_header_type = 'large';

		} else {

			$page_header_type = 'none';

		}
	} elseif ( is_singular( array( 'post', 'page' ) ) ) {

		// Get Page Header Type for current post or page.
		$page_header_type = csco_get_field( 'csco_page_header_type', get_the_ID(), 'default' );

		if ( 'default' === $page_header_type ) {

			if ( is_single() && ! get_theme_mod( 'post_page_header_default', true ) ) {

				// Get Page Header Type, specified in Post > Layout.
				$page_header_type = get_theme_mod( 'post_page_header', 'simple' );

			} elseif ( is_page() && ! get_theme_mod( 'page_page_header_default', true ) ) {

				// Get Page Header Type, specified in Page > Layout.
				$page_header_type = get_theme_mod( 'page_page_header', 'simple' );

			} else {

				// Get Page Header Type, specified in Layout > General.
				$page_header_type = get_theme_mod( 'page_header', 'simple' );

			}
		}
	} elseif ( is_category() ) {

		global $cat;

		// Get Page Header Type for current category.
		$page_header_type = csco_get_field( 'csco_page_header_type', 'category_' . $cat, 'default' );

		if ( 'default' === $page_header_type ) {
			// Get default page header.
			$page_header_type = get_theme_mod( 'page_header', 'simple' );

		}
	} else {

		// Set simple page header template for other pages.
		$page_header_type = 'simple';

	}// End if().

	return apply_filters( 'csco_page_header_type', $page_header_type );

}

/**
 * Echoes Page Header Attributes: class, style and data-video.
 *
 * @param string $type          Page Header type.
 * @param string $class         Page Header class names.
 * @param string $thumbnail_url Page Header thumbnail URL.
 * @param string $video_url     Page Header video URL.
 */
function csco_get_page_header_attr( $type, $class = 'page-header', $thumbnail_url = null, $video_url = null ) {

	// Append overlay class for all page headers with background.
	if ( 'simple' !== $type ) {
		$class .= ' overlay parallax';
	}

	// Append ratio class for small page headers.
	if ( 'small' === $type ) {
		$class .= ' ratio ratio-horizontal';
	}

	if ( is_singular() ) {

		if ( 'wide' === $type || 'large' === $type ) {
			$size = 'xl';
		} else {
			if ( 'layout-fullwidth' === csco_get_page_layout() ) {
				$size = 'lg-hor';
			} else {
				$size = 'md-sq';
			}
		}

		$thumbnail     = wp_get_attachment_image_src( get_post_thumbnail_id(), $size );
		$thumbnail_url = $thumbnail[0];

		$video_bg = csco_get_video_background( 'page-header' );

		if ( $video_bg ) {
			$class .= ' parallax-video';
			$video_url = $video_bg['url'];
		}
	} elseif ( is_category() ) {

		global $cat;

		// Get current category thumbnail URL.
		$thumbnail_url = csco_get_field( 'csco_category_thumbnail', 'category_' . $cat );

	} else {
		$thumbnail_url = get_theme_mod( 'page_header_thumbnail' );
	}

	$thumbnail_url = apply_filters( 'csco_page_header_thumbnail_url', $thumbnail_url );

	// Echo classes.
	echo ' class="' . esc_html( $class ) . '"';

	// Return for simple page headers.
	if ( 'simple' === $type ) {
		return;
	}

	// Echo Thumbnail URL attribute.
	if ( isset( $thumbnail_url ) && $thumbnail_url ) {
		echo ' style="background-image: url(' . esc_url( $thumbnail_url ) . ')"';
	}

	// Echo Video URL attribute.
	if ( isset( $video_bg ) && $video_url ) {
		echo ' data-video="' . esc_url( $video_url ) . '"';
	}

	// Echo Video Start Time.
	if ( isset( $video_bg ) && $video_bg['start'] ) {
		echo ' data-start="' . esc_html( $video_bg['start'] ) . '"';
	}

	// Echo Video End Time.
	if ( isset( $video_bg ) && $video_bg['end'] ) {
		echo ' data-end="' . esc_html( $video_bg['end'] ) . '"';
	}
}

/**
 * Returns Archive Settings Array
 */
function csco_get_query_args() {

	// Check if it's an ajax request.
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		// Conditional tags won't work here.
		global $wp_query;
		$query_args = $wp_query->query_vars['csco_query'];
		return apply_filters( 'csco_query_args', $query_args );
	}

	if ( ( is_home() || is_front_page() ) && ! get_theme_mod( 'home_archive_default', true ) ) {

		// Homepage.
		$prefix = 'home';

	} else {

		// Global.
		$prefix = 'layout';

	}// End if().

	$query_args = array(
		'archive_type'    => get_theme_mod( $prefix . '_archive_type', 'standard' ),
		'show_first'      => get_theme_mod( $prefix . '_first_post', true ),
		'columns'         => get_theme_mod( $prefix . '_columns', 2 ),
		'summary'         => get_theme_mod( $prefix . '_summary', true ),
		'summary_type'    => get_theme_mod( $prefix . '_summary_type', 'excerpt' ),
		'excerpt_length'  => get_theme_mod( $prefix . '_excerpt_length', 30 ),
		'more_button'     => get_theme_mod( $prefix . '_more_button', true ),
		'thumbnail_width' => get_theme_mod( $prefix . '_thumbnail_width', 4 ),
		'thumbnail_size'  => get_theme_mod( $prefix . '_thumbnail_size', 'thumbnail' ),
		'widgets'         => get_theme_mod( $prefix . '_widgets', false ),
		'widgets_sidebar' => get_theme_mod( $prefix . '_widgets_sidebar', 'sidebar-archive' ),
		'widgets_after'   => get_theme_mod( $prefix . '_widgets_after', 3 ),
		'widgets_repeat'  => get_theme_mod( $prefix . '_widgets_repeat', false ),
		'pagination_type' => get_theme_mod( $prefix . '_pagination_type', 'standard' ),
		'infinite_load'   => get_theme_mod( $prefix . '_infinite_load', false ),
	);

	return apply_filters( 'csco_query_args', $query_args );

}

/**
 * Returns Post Section Vars Array
 *
 * @param string $type Type of the post section: slider, tiles or carousel.
 */
function csco_get_post_section_vars( $type ) {

	if ( in_array( $type, array( 'slider', 'tiles', 'carousel' ), true ) && ( is_home() || is_front_page() ) ) {

		// Homepage.
		$prefix = 'home_' . $type;

	} elseif ( in_array( $type, array( 'carousel' ), true ) && is_single() ) {

		// Specific post.
		$prefix = 'post_' . $type;

	} else {

		// If post section is disabled.
		return;

	}// End if().

	$args = array(
		'type'       => $type,
		'display'    => get_theme_mod( $prefix, false ),
		'source'     => get_theme_mod( $prefix . '_source', 'all' ),
		'category'   => get_theme_mod( $prefix . '_source_category_slug', '' ),
		'tag'        => get_theme_mod( $prefix . '_source_tag_slug', '' ),
		'orderby'    => get_theme_mod( $prefix . '_orderby', '' ),
		'time_frame' => get_theme_mod( $prefix . '_time_frame', '' ),
	);

	// Additional args for slider.
	if ( 'slider' === $type ) {
		$args['slider_type'] = get_theme_mod( $prefix . '_type', 'center' );
		$args['visible']     = get_theme_mod( $prefix . '_visible', '3' );
		$args['padding']     = get_theme_mod( $prefix . '_padding', '30' );
		$args['autoplay']    = get_theme_mod( $prefix . '_autoplay', true );
		$args['timeout']     = get_theme_mod( $prefix . '_timeout', '4000' );
		$args['total']       = get_theme_mod( $prefix . '_total', '5' );
		$args['parallax']    = get_theme_mod( $prefix . '_parallax', true );
		$args['thumbnail']   = get_theme_mod( $prefix . '_thumbnail', 'lg-hor' );
	}

	// Additional args for tiles.
	if ( 'tiles' === $type ) {
		$args['layout']    = get_theme_mod( $prefix . '_layout', '1' );
		$args['container'] = get_theme_mod( $prefix . '_container', 'container' );
		$args['parallax']  = get_theme_mod( $prefix . '_parallax', true );
	}

	// Additional args for carousel.
	if ( 'carousel' === $type ) {
		$args['title']     = get_theme_mod( $prefix . '_title', esc_html__( 'Trending Posts', 'authentic' ) );
		$args['columns']   = get_theme_mod( $prefix . '_columns', '4' );
		$args['container'] = get_theme_mod( $prefix . '_container', 'container' );
		$args['total']     = get_theme_mod( $prefix . '_total', '8' );
		$args['thumbnail'] = get_theme_mod( $prefix . '_thumbnail', 'md-ver' );
		$args['padding']   = get_theme_mod( $prefix . '_padding', '30' );
	}

	// Additional args and overrides for carousel on single posts.
	if ( 'carousel' === $type && is_single() ) {
		$args['display']   = get_theme_mod( $prefix, true );
		$args['title']     = get_theme_mod( $prefix . '_title', esc_html__( 'You May Also Like', 'authentic' ) );
		$args['container'] = 'post-carousel';
		$args['current']   = get_theme_mod( $prefix . '_current', true );
	}

	return apply_filters( 'csco_post_section_vars', $args );
}

/**
 * Returns additional WP Query args for post source
 *
 * @param array $vars Variables for post sections.
 */
function csco_get_post_source_query_vars( $vars ) {

	if ( ! $vars ) {
		return;
	}

	$args = array();

	// Source.
	if ( 'featured' === $vars['source'] ) {
		// Check if custom taxonomy was registered.
		if ( taxonomy_exists( 'csco_post_featured' ) ) {
			// Featured posts.
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'csco_post_featured',
					'field'    => 'slug',
					'terms'    => $vars['type'],
					),
				);
		}
	} elseif ( 'category' === $vars['source'] ) {
		// Category.
		$args['category_name'] = sanitize_title( $vars['category'] );
	} elseif ( 'tag' === $vars['source'] ) {
		// Tag.
		$args['tag'] = sanitize_title( $vars['tag'] );
	}

	// Post order.
	if ( 'views' === $vars['orderby'] ) {
		// Post Views.
		$args['orderby'] = 'post_views';
		// Time Frame for Post Views.
		if ( $vars['time_frame'] ) {
			$args['date_query'] = array(
				array(
					'column' => 'post_date_gmt',
					'after'  => $vars['time_frame'] . ' ago',
				),
			);
		}
	} elseif ( 'date' === $vars['orderby'] ) {
		// Date.
		$args['orderby'] = 'date';
	}

	// Limit to current category.
	if ( isset( $vars['current'] ) && $vars['current'] ) {
		if ( is_single() ) {

			// Get current post categories.
			$categories = get_the_category( get_the_ID() );

			$category__in = array();

			// Add category IDs to the array.
			foreach ( $categories as $category ) {
				$category__in[] = $category->term_id;
			}

			// Add current post category IDs to the 'category__in'.
			$args['category__in'] = $category__in;
		}
	}

	// Remove current post from related posts.
	if ( is_single() ) {
		$args['post__not_in'] = array( get_the_ID() );
	}

	// Set post_per_type depending on the featured location type.
	if ( 'slider' === $vars['type'] || 'carousel' === $vars['type'] ) {

		$args['posts_per_page'] = $vars['total'];

	} elseif ( 'tiles' === $vars['type'] ) {

		if ( in_array( $vars['layout'], array( '1', '3' ), true ) ) {
			$posts_per_page = 2;
		} elseif ( in_array( $vars['layout'], array( '2', '4', '5' ), true ) ) {
			$posts_per_page = 3;
		} elseif ( in_array( $vars['layout'], array( '6', '7', '8' ), true ) ) {
			$posts_per_page = 5;
		} elseif ( '9' === $vars['layout'] ) {
			$posts_per_page = 8;
		}

		$args['posts_per_page'] = $posts_per_page;

	}

	// Set general arguments.
	$args['post_type'] = 'post';
	$args['order'] = 'DESC';

	return apply_filters( 'csco_post_source_query_args', $args );

}

/**
 * Get Featured Post IDs
 */
function csco_get_featured_post_ids() {

	$featured_in = array();

	if ( get_theme_mod( 'home_slider_exclude', true ) && get_theme_mod( 'home_slider', false ) ) {
		$featured_in[] = 'slider';
	}

	if ( get_theme_mod( 'home_tiles_exclude', true ) && get_theme_mod( 'home_tiles', false ) ) {
		$featured_in[] = 'tiles';
	}

	if ( get_theme_mod( 'home_carousel_exclude', true ) && get_theme_mod( 'home_carousel', false ) ) {
		$featured_in[] = 'carousel';
	}

	if ( ! $featured_in ) {
		return;
	}

	$post_ids = array();

	foreach ( $featured_in as $key => $value ) {

		$settings = csco_get_post_section_vars( $value );
		$args = csco_get_post_source_query_vars( $settings );

		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$post_ids[] = get_the_ID();
			}
			wp_reset_postdata();
		}
	}

	$post_ids = array_unique( $post_ids );

	return apply_filters( 'csco_featured_post_ids', $post_ids );
}

/**
 * Get content template
 *
 * Since we want to have a DRY approach both for loading posts via
 * get_template_part() in template-parts/loop/archive.php and
 * Ajax in framework/load-more.php, we have this additional function.
 *
 * @param int   $current Number of current post.
 * @param array $vars    Archive custom variables.
 */
function csco_get_content_template( $current, $vars ) {

	get_template_part( 'template-parts/loop/content' );

	// Make sure we display widgets on first page only, if repeat option is not true.
	global $paged;
	$current_page = $paged;

	if ( isset( $vars ) && $vars['widgets_repeat'] ) {
		$current_page = 0;
	}

	// Insert content after n-th post.
	if ( $vars['widgets'] && 0 === $current % $vars['widgets_after'] && has_action( 'csco_archive_between_posts' ) && 0 === $current_page ) {
		do_action( 'csco_archive_between_posts', $vars['widgets_sidebar'], $current, $vars['widgets_after'], $vars['widgets_repeat'] );
	}
}

/**
 * Returns Widgets in Post Archives
 *
 * @param string $sidebar   the id of the sidebar.
 * @param int    $current   current post number in the loop, equals to $wp_query->current_post.
 * @param int    $iteration repeat after x posts.
 * @param bool   $repeat    if it's allowed to repeat widgets.
 */
function csco_get_sidebar_archive_widget( $sidebar, $current = 1, $iteration = 3, $repeat = false ) {

	global $wp_registered_widgets;

	$widgets = wp_get_sidebars_widgets();

	// Check if the accepted sidebar has any widgets.
	if ( array_key_exists( $sidebar, $widgets ) && ! empty( $widgets[ $sidebar ] ) ) {

		// Get array of widget ids for the specific sidebar, i.e. array('text-4', 'text-5).
		$widgets = $widgets[ $sidebar ];

		// Get total number widgets in the sidebar.
		$total_widgets = count( $widgets );

		// Return if repeating of widgets is not allowed.
		if ( ! $repeat && $current / $iteration > $total_widgets ) {
			return;
		}

		// Get current widget number.
		$current_widget = ( $current / $iteration - 1 ) % $total_widgets;

		// Get current widget slug, like 'text-4'.
		$widget_slug = $widgets[ $current_widget ];

		// Prevent from errors, if the widget class isn't available anymore.
		if ( isset( $wp_registered_widgets[ $widgets[ $current_widget ] ] ) ) {

			$widget = $wp_registered_widgets[ $widgets[ $current_widget ] ]['callback'][0];

			// Get ID of the widget.
			$widget_id = $wp_registered_widgets[ $widgets[ $current_widget ] ]['params'][0]['number'];

			// Get all settings for all specific widgets, i.e. text.
			$settings = $widget->get_settings();

			// Get class name of the widget.
			$classname = get_class( $widget );

			// Get widget settings.
			$instance = $settings[ $widget_id ];

			$args = array(
				'before_widget' => '<section class="widget %s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h5 class="title-block title-widget">',
				'after_title'   => '</h5>',
			);

			// Output widget.
			the_widget( $classname, $instance, $args );

		}
	} // End if().

}

/**
 * Returns Sidebar Widgets in Post Archives
 *
 * @param string $sidebar   Sidebar slug.
 * @param int    $current   Current post number in the loop, equals to $wp_query->current_post.
 * @param int    $iteration Repeat after x posts.
 * @param bool   $repeat    If it's allowed to repeat widgets.
 */
function csco_archive_widgets( $sidebar, $current, $iteration, $repeat ) {

	csco_get_sidebar_archive_widget( $sidebar, $current, $iteration, $repeat );
}

/**
 * Get rounded number.
 *
 * @param int $number    Input number.
 * @param int $min_value Minimum value to round number.
 * @param int $decimal   How may decimals shall be in the rounded number.
 */
function csco_get_round_number( $number, $min_value = 1000, $decimal = 1 ) {
	if ( $number < $min_value ) {
		return number_format_i18n( $number );
	}
	$alphabets = array( 1000000000 => 'B', 1000000 => 'M', 1000 => 'K' );
	foreach ( $alphabets as $key => $value ) {
		if ( $number >= $key ) {
			return round( $number / $key, $decimal ) . $value;
		}
	}
}

/**
 * Echo rounded number.
 *
 * @param int $number    Input number.
 * @param int $min_value Minimum value to round number.
 * @param int $decimal   How may decimals shall be in the rounded number.
 */
function csco_round_number( $number, $min_value = 1000, $decimal = 1 ) {
	echo esc_html( csco_get_round_number( $number, $min_value, $decimal ) );
}

/**
 * Get Video Background
 *
 * @param string $slug Slug of the background location: slider, tiles, carousel, archive.
 * @param mixed  $id   Post ID.
 */
function csco_get_video_background( $slug, $id = false ) {

	// Get Post Format.
	if ( in_array( get_post_format(), array( 'video' ), true ) ) {

		// Get video URL of the post.
		$url = csco_get_field( 'csco_post_embed', $id, null, false );

		// Get video background locations of the post.
		$location = csco_get_field( 'csco_post_video_bg_location', $id, array( 'slider', 'archive' ), false );

		// Check if there's a video URL and if video background is valid for this featured location.
		if ( $url && $location && in_array( $slug, $location, true ) ) {

			// Get start time.
			$start = csco_get_field( 'csco_post_video_bg_start_time', $id, null, false );

			// Set default start time.
			if ( ! $start ) {
				$start = 0;
			}

			// Get end time.
			$end = csco_get_field( 'csco_post_video_bg_end_time', $id, null, false );

			// Set default end time.
			if ( ! $end ) {
				$end = 0;
			}

			// Save all data as an array.
			$video = array(
				'url'   => $url,
				'start' => $start,
				'end'   => $end,
			);

			return $video;
		}
	}
}

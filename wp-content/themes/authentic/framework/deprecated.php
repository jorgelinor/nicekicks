<?php
/**
 * Deprecated features and migration functions
 *
 * @package Authentic
 * @subpackage Functions
 * @version 1.0.0
 * @since Authentic 2.0.0
 */

/**
 * Run migration based on a check if a new purchaser (after 2.0)
 * or an old one (before 2.0)
 *
 * @param string $old_theme_ver Old Theme version.
 * @param string $theme_ver     Current Theme version.
 */
function csco_run_migration( $old_theme_ver, $theme_ver ) {
	// Most likely an old purchaser at least changed the logo.
	if ( ! get_theme_mod( 'authentic_header_logo_dark_url' ) ) {
		return;
	}
	if ( version_compare( '2.0', $old_theme_ver, '>' ) && function_exists( 'get_field' ) ) {
		csco_migrate_widgets();
	}
	if ( version_compare( '2.0', $old_theme_ver, '>' ) ) {
		csco_migrate_custom_css();
		csco_migrate_theme_settings();
		csco_migrate_custom_fields();
	}
}
add_action( 'csco_theme_deprecated', 'csco_run_migration', 10, 2 );

/**
 * Widgets Migrate
 */
function csco_migrate_widgets() {

	// Widgets List.
	$migrate_widgets = array(
		'authentic_widget_about',
		'authentic_widget_posts',
	);

	// Each widgets.
	foreach ( $migrate_widgets as $widget_name ) {
		$widget_db_name    = 'widget_' . $widget_name;
		$sidebar_widgets   = get_option( $widget_db_name );
		$delete_acf_fields = array();

		if ( ! is_array( $sidebar_widgets ) ) {
			continue;
		}
		// Each added widgets.
		foreach ( $sidebar_widgets as $widget_id => $widgets_fields ) {

			// ACF widget ID.
			$acf_widget_id = $widget_db_name . '-' . $widget_id;

			// Add fields for replacement.
			switch ( $widget_name ) {

				// Widget About.
				case 'authentic_widget_about':
					$replace_fields = array( 'subtitle', 'image', 'text', 'button_url', 'button_text', 'social_accounts' );
					break;

				// Widget Posts.
				case 'authentic_widget_posts':
					$replace_fields = array( 'layout', 'posts_per_page', 'orderby', 'order', 'time_frame', 'category', 'post_meta', 'post_meta_compact', 'featured' );
					break;

				default:
					$replace_fields = array();
					break;
			}

			// Each fields needed for replacement.
			foreach ( $replace_fields as $field_name ) {

				// Get ACF Field.
				$acf_field_value = csco_get_field( $field_name, $acf_widget_id );

				if ( $acf_field_value ) {

					// New field value.
					$new_value = $acf_field_value;

					// Exceptions of replacing.
					switch ( $widget_name ) {

						// Widget About.
						case 'authentic_widget_about':

							// Image field.
							if ( 'image' === $field_name ) {
								$src = wp_get_attachment_image_src( $new_value, 'thumbnail' );
								if ( isset( $src[0] ) ) {
									$new_value = $src[0];
								} else {
									$new_value = '';
								}
							}

							break;
					}

					// Replace field value in the widget.
					$sidebar_widgets[ $widget_id ][ $field_name ] = $new_value;

					// Add ACF field to "Delete list".
					$delete_acf_fields[] = array(
						'field_name' => $field_name,
						'widget_id'  => $acf_widget_id,
					);
				}
			}
		}

		// Update widget.
		$updated = update_option( $widget_db_name, $sidebar_widgets );

		// Delete ACF widget fields.
		foreach ( $delete_acf_fields as $acf_field ) {
			$option_name = $acf_field['widget_id'] . '_' . $acf_field['field_name'];
			delete_option( $option_name );
			delete_option( '_' . $option_name );
		}
	} // Each Widgets.
}

/**
 * Custom CSS Migrate
 */
function csco_migrate_custom_css() {
	if ( function_exists( 'wp_update_custom_css_post' ) ) {
		$custom_css = get_theme_mod( 'authentic_custom_css' );
		if ( $custom_css ) {
			$core_css = wp_get_custom_css();
			$return = wp_update_custom_css_post( $core_css . $custom_css );
			/* if ( ! is_wp_error( $return ) ) {
				// Remove the old theme_mod, so that the CSS is stored in only one place moving forward.
				remove_theme_mod( 'authentic_custom_css' );
			} */
		}
	}
}

/**
 * General Theme Mod Migration Function
 *
 * @param string $old Old theme mod name.
 * @param string $new New theme mod name.
 * @param array  $unset Unset array keys.
 */
function csco_migrate_theme_mod( $old, $new, $unset = array() ) {
	$old = get_theme_mod( $old );
	if ( $old ) {
		if ( is_array( $old ) && $unset ) {
			foreach ( $unset as $param ) {
				unset( $old[ $param ] );
			}
		}
		set_theme_mod( $new, $old );
	}
}

/**
 * Multi-Color to Color Theme Mod Migration Function
 *
 * @param string $old Old theme mod name.
 * @param string $new New theme mod name.
 * @param array  $choices Choices of multicolor field.
 */
function csco_migrate_multicolor_to_color( $old, $new, $choices ) {
	$old = get_theme_mod( $old );
	if ( $old ) {
		foreach ( $choices as $choice ) {
			if ( 'default' === $choice ) {
				set_theme_mod( $new, $old['default'] );
			} else {
				set_theme_mod( $new . '_' . $choice, $old[ $choice ] );
			}
		}
	}
}

/**
 * Typography to Color Theme Mod Migration Function
 *
 * @param string $old Old theme mod name.
 * @param string $new New theme mod name.
 */
function csco_migrate_typography_to_color( $old, $new ) {
	$old = get_theme_mod( $old );
	if ( $old ) {
		set_theme_mod( $new, $old['color'] );
	}
}

/**
 * Checkbox to Multicheck Theme Mod Migration Function
 *
 * @param string $old Old theme mod name.
 * @param string $new New theme mod name.
 * @param string $choice New choice in multicheck field.
 */
function csco_migrate_checkbox_to_multicheck( $old, $new, $choice ) {
	$old = get_theme_mod( $old );
	if ( $old ) {
		$mod = get_theme_mod( $new );
		if ( ! $mod ) {
			$mod = array();
		}
		$mod[ $choice ] = $old;
		set_theme_mod( $new, $mod );
	}
}

/**
 * Theme Settings Migrate
 */
function csco_migrate_theme_settings() {

	$theme_mods = array(
		array(
			'old' => 'authentic_typography_base',
			'new' => 'typography_base',
			'unset' => array( 'line-height', 'color' ),
			),
		array(
			'old' => 'authentic_btn_primary_typography',
			'new' => 'typography_buttons',
			),
		array(
			'old' => 'authentic_btn_secondary_typography',
			'new' => 'typography_buttons',
			),
		array(
			'old' => 'authentic_typography_page_header',
			'new' => 'typography_headings',
			'unset' => array( 'font-size', 'line-height', 'letter-spacing', 'color', 'text-transform' ),
			),
		array(
			'old' => 'authentic_typography_h1',
			'new' => 'typography_h1',
			'unset' => array( 'font-family', 'variant', 'subsets', 'line-height', 'color' ),
			),
		array(
			'old' => 'authentic_typography_h2',
			'new' => 'typography_h2',
			'unset' => array( 'font-family', 'variant', 'subsets', 'line-height', 'color' ),
			),
		array(
			'old' => 'authentic_typography_h3',
			'new' => 'typography_h3',
			'unset' => array( 'font-family', 'variant', 'subsets', 'line-height', 'color' ),
			),
		array(
			'old' => 'authentic_typography_h4',
			'new' => 'typography_h4',
			'unset' => array( 'font-family', 'variant', 'subsets', 'line-height', 'color' ),
			),
		array(
			'old' => 'authentic_typography_h5',
			'new' => 'typography_h5',
			'unset' => array( 'font-family', 'variant', 'subsets', 'line-height', 'color' ),
			),
		array(
			'old' => 'authentic_typography_h6',
			'new' => 'typography_h6',
			'unset' => array( 'font-family', 'variant', 'subsets', 'line-height', 'color' ),
			),
		array(
			'old' => 'authentic_typography_block_title',
			'new' => 'typography_block_title',
			'unset' => array( 'line-height', 'color' ),
			),
		array(
			'old' => 'authentic_typography_post_lead',
			'new' => 'typography_post_lead',
			'unset' => array( 'color' ),
			),
		array(
			'old' => 'authentic_typography_post_dropcap_first_letter',
			'new' => 'typography_post_dropcap',
			),
		array(
			'old' => 'authentic_typography_post_blockquote',
			'new' => 'typography_post_blockquote',
			'unset' => array( 'line-height', 'color' ),
			),
		array(
			'old' => 'authentic_typography_post_meta',
			'new' => 'typography_text_small',
			'unset' => array( 'line-height', 'color' ),
			),
		array(
			'old' => 'authentic_typography_widget_overlay_meta',
			'new' => 'typography_widget_overlay_meta',
			'unset' => array( 'line-height' ),
			),
		array(
			'old' => 'authentic_typography_search',
			'new' => 'typography_search',
			),
		array(
			'old' => 'authentic_layout_archive_page',
			'new' => 'layout',
			),
		array(
			'old' => 'authentic_layout_post_page',
			'new' => 'post_layout',
			),
		array(
			'old' => 'authentic_layout_post_page',
			'new' => 'page_layout',
			),
		array(
			'old' => 'authentic_container_width_home',
			'new' => 'home_layout_width',
			),
		array(
			'old' => 'authentic_container_width_archive',
			'new' => 'layout_width',
			),
		array(
			'old' => 'authentic_container_width_post_sidebar',
			'new' => 'post_layout_sidebar',
			),
		array(
			'old' => 'authentic_container_width_post_fullwidth',
			'new' => 'post_layout_fullwidth',
			),
		array(
			'old' => 'authentic_container_width_page_sidebar',
			'new' => 'page_layout_sidebar',
			),
		array(
			'old' => 'authentic_container_width_page_fullwidth',
			'new' => 'page_layout_fullwidth',
			),
		array(
			'old' => 'authentic_layout_archive',
			'new' => 'layout_archive_type',
			),
		array(
			'old' => 'authentic_layout_archive_columns',
			'new' => 'layout_columns',
			),
		array(
			'old' => 'authentic_layout_first_post',
			'new' => 'layout_first_post',
			),
		array(
			'old' => 'authentic_layout_post_summary',
			'new' => 'layout_summary',
			),
		array(
			'old' => 'authentic_layout_post_summary_type',
			'new' => 'layout_summary_type',
			),
		array(
			'old' => 'authentic_excerpt_length',
			'new' => 'layout_excerpt_length',
			),
		array(
			'old' => 'authentic_home_featured',
			'new' => 'home_slider',
			),
		array(
			'old' => 'authentic_home_featured_type',
			'new' => 'home_slider_type',
			),
		array(
			'old' => 'authentic_home_featured_visible_slides_number',
			'new' => 'home_slider_visible',
			),
		array(
			'old' => 'authentic_home_featured_slides_number',
			'new' => 'home_slider_total',
			),
		array(
			'old' => 'authentic_home_featured_width',
			'new' => 'home_slider_width',
			),
		array(
			'old' => 'authentic_home_featured_height',
			'new' => 'home_slider_height',
			),
		array(
			'old' => 'authentic_home_featured_parallax',
			'new' => 'home_slider_parallax',
			),
		array(
			'old' => 'authentic_home_featured_heading',
			'new' => 'home_slider_heading',
			'unset' => array( 'font-family', 'variant', 'subsets', 'line-height' ),
			),
		array(
			'old' => 'authentic_home_trending',
			'new' => 'home_carousel',
			),
		array(
			'old' => 'authentic_home_trending_time_frame',
			'new' => 'home_carousel_time_frame',
			),
		array(
			'old' => 'authentic_header_logo_dark_url',
			'new' => 'header_logo_default_url',
			),
		array(
			'old' => 'authentic_header_logo_light_url',
			'new' => 'header_logo_overlay_url',
			),
		array(
			'old' => 'authentic_header_logo_width',
			'new' => 'header_logo_width',
			),
		array(
			'old' => 'authentic_header_height',
			'new' => 'header_height',
			),
		array(
			'old' => 'authentic_navbar_logo_select',
			'new' => 'navbar_logo_select',
			),
		array(
			'old' => 'authentic_navbar_logo_dark_url',
			'new' => 'navbar_logo_default_url',
			),
		array(
			'old' => 'authentic_navbar_logo_light_url',
			'new' => 'navbar_logo_overlay_url',
			),
		array(
			'old' => 'authentic_navbar_logo_height',
			'new' => 'navbar_logo_height',
			),
		array(
			'old' => 'authentic_navbar_logo_text',
			'new' => 'navbar_logo_text',
			),
		array(
			'old' => 'authentic_navbar_logo_font',
			'new' => 'navbar_logo_font',
			),
		array(
			'old' => 'authentic_header_navbar_main_links_font',
			'new' => 'typography_menus',
			'unset' => array( 'line-height' ),
			),
		array(
			'old' => 'authentic_header_navbar_submenu_links_font',
			'new' => 'typography_submenus',
			'unset' => array( 'line-height' ),
			),
		array(
			'old' => 'authentic_header_topbar',
			'new' => 'topbar',
			),
		array(
			'old' => 'authentic_footer_bg_color',
			'new' => 'color_footer_bg',
			),
		array(
			'old' => 'authentic_footer_text_color',
			'new' => 'color_footer_text',
			),
		array(
			'old' => 'authentic_footer_title_color',
			'new' => 'color_footer_title',
			),
		array(
			'old' => 'authentic_footer_border_color',
			'new' => 'color_footer_border',
			),
		array(
			'old' => 'authentic_footer_logo_url',
			'new' => 'footer_logo_url',
			),
		array(
			'old' => 'authentic_footer_logo_width',
			'new' => 'footer_logo_width',
			),
		array(
			'old' => 'authentic_footer_text',
			'new' => 'footer_text',
			),
		array(
			'old' => 'authentic_subscribe_title',
			'new' => 'footer_subscribe_title',
			),
		array(
			'old' => 'authentic_subscribe_message',
			'new' => 'footer_subscribe_message',
			),
		array(
			'old' => 'authentic_footer_instagram_username',
			'new' => 'footer_instagram_username',
			),
		array(
			'old' => 'authentic_effects_parallax',
			'new' => 'effects_parallax',
			),
		array(
			'old' => 'authentic_effects_lazy_load',
			'new' => 'effects_lazy_load',
			),
		array(
			'old' => 'authentic_effects_navbar_scroll',
			'new' => 'effects_navbar_scroll',
			),
		array(
			'old' => 'authentic_effects_sticky_sidebar',
			'new' => 'effects_sticky_sidebar',
			),
		);

	$unset = array();

	foreach ( $theme_mods as $theme_mod ) {
		if ( isset( $theme_mod['unset'] ) ) {
			$unset = $theme_mod['unset'];
		}
		csco_migrate_theme_mod( $theme_mod['old'], $theme_mod['new'], $unset );
	}

	$multicolor_to_color_mods = array(
		array(
			'old' => 'authentic_btn_link',
			'new' => 'color_links',
			'choices' => array( 'default', 'hover' ),
			),
		array(
			'old' => 'authentic_headings_link',
			'new' => 'color_headings_links',
			'choices' => array( 'default', 'hover' ),
			),
		array(
			'old' => 'authentic_btn_primary_text_color',
			'new' => 'color_btn_primary_text',
			'choices' => array( 'default', 'hover' ),
			),
		array(
			'old' => 'authentic_btn_primary_bg_color',
			'new' => 'color_btn_primary_bg',
			'choices' => array( 'default', 'hover' ),
			),
		array(
			'old' => 'authentic_btn_secondary_text_color',
			'new' => 'color_btn_secondary_text',
			'choices' => array( 'default', 'hover' ),
			),
		array(
			'old' => 'authentic_btn_secondary_bg_color',
			'new' => 'color_btn_secondary_bg',
			'choices' => array( 'default', 'hover' ),
			),
		array(
			'old' => 'authentic_footer_link',
			'new' => 'color_footer_link',
			'choices' => array( 'default', 'hover' ),
			),
		array(
			'old' => 'authentic_btn_footer_text_color',
			'new' => 'color_footer_btn_text',
			'choices' => array( 'default', 'hover' ),
			),
		array(
			'old' => 'authentic_btn_footer_bg_color',
			'new' => 'color_footer_btn_bg',
			'choices' => array( 'default', 'hover' ),
			),
		);

	foreach ( $multicolor_to_color_mods as $mod ) {
		csco_migrate_multicolor_to_color( $mod['old'], $mod['new'], $mod['choices'] );
	}

	$typography_to_color_mods = array(
		array(
			'old' => 'authentic_typography_post_lead',
			'new' => 'color_leadin_dropcap',
			),
		array(
			'old' => 'authentic_typography_post_dropcap_first_letter',
			'new' => 'color_leadin_dropcap',
			),
		array(
			'old' => 'authentic_typography_post_blockquote',
			'new' => 'color_blockquote',
			),
		array(
			'old' => 'authentic_typography_post_meta',
			'new' => 'color_text_small',
			),
		);

	foreach ( $typography_to_color_mods as $mod ) {
		csco_migrate_typography_to_color( $mod['old'], $mod['new'] );
	}

	$page_header = get_theme_mod( 'authentic_layout_posts_featured_image' );
	if ( $page_header ) {
		if ( 'standard' === $page_header ) {
			$page_header = 'small';
		}
		set_theme_mod( 'page_header', $page_header );
	}

	$checkbox_to_multicheck_mods = array(
		array(
			'old' => 'authentic_meta_date',
			'new' => 'post_meta',
			'choice' => 'date',
			),
		array(
			'old' => 'authentic_meta_comments',
			'new' => 'post_meta',
			'choice' => 'comments',
			),
		array(
			'old' => 'authentic_meta_category',
			'new' => 'post_meta',
			'choice' => 'category',
			),
		array(
			'old' => 'authentic_meta_reading_time',
			'new' => 'post_meta',
			'choice' => 'reading_time',
			),
		array(
			'old' => 'authentic_meta_views',
			'new' => 'post_meta',
			'choice' => 'views',
			),
		array(
			'old' => 'authentic_meta_author',
			'new' => 'post_meta',
			'choice' => 'author',
			),
		);

	foreach ( $checkbox_to_multicheck_mods as $mod ) {
		csco_migrate_checkbox_to_multicheck( $mod['old'], $mod['new'], $mod['choice'] );
	}

	if ( get_theme_mod( 'authentic_header_logo_dark_url' ) ) {
		set_theme_mod( 'header_logo_select', 'image' );
	}

	if ( get_theme_mod( 'authentic_footer_logo_url' ) ) {
		set_theme_mod( 'footer_logo_select', 'image' );
	}

	// Set new defaults.
	$default_theme_mods = array(
		array(
			'name' => 'home_slider',
			'value' => true,
			),
		array(
			'name' => 'home_slider_source',
			'value' => 'featured',
			),
		array(
			'name' => 'home_carousel',
			'value' => true,
			),
		);

	foreach ( $default_theme_mods as $mod ) {
		// Make sure the default value of theme mod was not changed.
		if ( ! get_theme_mod( $mod['name'] ) ) {
			set_theme_mod( $mod['name'], $mod['value'] );
		}
	}

}

/**
 * Custom Fields Migrate
 */
function csco_migrate_custom_fields() {

	// Resave posts featured on homepage.
	$args = array(
		'posts_per_page' => -1,
		'post_type'   => 'post',
		'meta_query'  => array(
			array(
				'key'     => 'csco_post_featured',
				'value'   => 'home',
				'compare' => 'LIKE',
				),
			),
		);

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$term = term_exists( 'slider', 'csco_post_featured' );
			$term_id = $term['term_id'];
			wp_set_post_terms( get_the_ID(), $term_id, 'csco_post_featured', true );
		}
		wp_reset_postdata();
	}

	// Resave posts featured in archives.
	$args = array(
		'posts_per_page' => -1,
		'post_type'   => 'post',
		'meta_query'  => array(
			array(
				'key'     => 'csco_post_featured',
				'value'   => 'loop',
				'compare' => 'LIKE',
				),
			),
		);

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$term = term_exists( 'archive', 'csco_post_featured' );
			$term_id = $term['term_id'];
			wp_set_post_terms( get_the_ID(), $term_id, 'csco_post_featured', true );
		}
		wp_reset_postdata();
	}

	// Resave page headers.
	$args = array(
		'posts_per_page' => -1,
		'post_type' => array( 'post', 'page' ),
		'meta_key'  => 'csco_featured_image_type',
		);

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$page_header_type = get_post_meta( get_the_ID(), 'csco_featured_image_type' );
			if ( 'none' === $page_header_type[0] ) {
				$page_header_type = array( 'simple' );
			} elseif ( 'standard' === $page_header_type[0] ) {
				$page_header_type = array( 'small' );
			}
			$page_header_type = $page_header_type[0];
			update_post_meta( get_the_ID(), 'csco_page_header_type', $page_header_type );
		}
		wp_reset_postdata();
	}

	// Resave layout.
	$args = array(
		'posts_per_page' => -1,
		'post_type' => array( 'post', 'page' ),
		'meta_key'  => 'csco_singular_layout_page',
		);

	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$layout_type = get_post_meta( get_the_ID(), 'csco_singular_layout_page' );
			$layout_type = $layout_type[0];
			update_post_meta( get_the_ID(), 'csco_singular_layout', $layout_type );
		}
		wp_reset_postdata();
	}

}

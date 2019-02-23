<?php
/**
 * Theme Initialization Functions
 *
 * @package Authentic WordPress Theme
 * @subpackage Framework
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * Initial setup and constants
 */
function csco_theme_setup() {

	// Make theme available for translation.
	load_theme_textdomain( 'authentic', get_template_directory() . '/languages' );

	// Add post thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Add excerpts on pages.
	add_post_type_support( 'page','excerpt' );

	// Enable plugins to manage the document title.
	add_theme_support( 'title-tag' );

	// Add HTML5 markup for captions.
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	// Automatic Feed Links.
	add_theme_support( 'automatic-feed-links' );

	// Add post formats.
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'image' ) );

	// Jetpack Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add editor style.
	add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );

	// Get custom image sizes.
	$image_sizes = csco_get_custom_image_sizes();

	// Register image size for each default image size.
	foreach ( $image_sizes as $image_size ) {
		add_image_size( $image_size['slug'], $image_size['width'], $image_size['height'], $image_size['crop'] );
	}

	// Sets $content_width.
	$GLOBALS['content_width'] = apply_filters( 'csco_content_width', 1140 );

}

add_action( 'after_setup_theme', 'csco_theme_setup' );

/**
 * Check Theme Version
 */
function csco_check_theme_version() {

	// Get Theme info.
	$theme_name = get_template();
	$theme      = wp_get_theme( $theme_name );
	$theme_ver  = $theme->get( 'Version' );

	// Get Theme option.
	$csco_theme_version = get_option( 'csco_theme_version_' . $theme_name );

	// Get old version.
	if ( $theme_name && isset( $csco_theme_version ) ) {
		$old_theme_ver = $csco_theme_version;
	}

	// First start.
	if ( ! isset( $old_theme_ver ) ) {
		$old_theme_ver = 0;
	}

	// If versions don't match.
	if ( $old_theme_ver !== $theme_ver ) {

		/**
		 * If different versions call a special hook.
		 *
		 * @param string $old_theme_ver  Old theme version.
		 * @param string $theme_ver      New theme version.
		 */
		do_action( 'csco_theme_deprecated', $old_theme_ver, $theme_ver );

		update_option( 'csco_theme_version_' . $theme_name, $theme_ver );
	}
}
add_action( 'init', 'csco_check_theme_version', 30 );

/**
 * Register header menus
 */
function csco_register_header_menus() {

	// Register wp_nav_menu() menus.
	register_nav_menus(array(
		'primary-menu'   => esc_html__( 'Primary Menu', 'authentic' ),
		'footer-menu'    => esc_html__( 'Footer Menu', 'authentic' ),
	));

}

add_action( 'init', 'csco_register_header_menus' );

/**
 * Register sidebars
 */
function csco_widgets_init() {

	register_sidebar(array(
		'name'          => esc_html__( 'Default Sidebar', 'authentic' ),
		'id'            => 'sidebar-main',
		'before_widget' => '<div class="widget %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="title-block title-widget">',
		'after_title'   => '</h5>',
	));

	register_sidebar(array(
		'name'          => esc_html__( 'Off-canvas', 'authentic' ),
		'id'            => 'sidebar-offcanvas',
		'before_widget' => '<div class="widget %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="title-block title-widget">',
		'after_title'   => '</h5>',
	));

	register_sidebar(array(
		'name'          => esc_html__( 'Archives', 'authentic' ),
		'id'            => 'sidebar-archive',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="title-block title-widget">',
		'after_title'   => '</h5>',
	));

	register_sidebars( 3, array(
		'name'          => esc_html__( 'Footer Sidebar %d', 'authentic' ),
		'id'            => 'sidebar-footer',
		'before_widget' => '<div class="widget %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="title-block title-widget">',
		'after_title'   => '</h5>',
	));
}

add_action( 'widgets_init', 'csco_widgets_init' );


/**
 * Include and register custom widgets
 */
function csco_register_widgets() {
	$csco_widgets = array(
		'posts'         => 'Authentic_Widget_Posts',
		'author'        => 'Authentic_Widget_Author',
		'about'         => 'Authentic_Widget_About',
	);
	foreach ( $csco_widgets as $key => $value ) {
		require_once get_template_directory() . '/framework/widgets/widget-' . sanitize_key( $key ) . '.php';
		register_widget( $value );
	}
}

add_action( 'widgets_init', 'csco_register_widgets' );

/**
 * Register custom featured taxonomy
 */
function csco_register_csco_featured() {

	$labels = array(
		'name' => esc_html__( 'Featured Locations', 'authentic' ),
		'singular_name' => esc_html__( 'Featured Location', 'authentic' ),
		'all_items' => esc_html__( 'All Locations', 'authentic' ),
		);

	$args = array(
		'label' => esc_html__( 'Featured Locations', 'authentic' ),
		'labels' => apply_filters( 'csco_featured_taxonomy_labels', $labels ),
		'public' => false,
		'hierarchical' => true,
		'show_ui' => true,
		'show_in_menu' => false,
		'show_in_nav_menus' => false,
		'query_var' => true,
		'rewrite' => false,
		'show_admin_column' => true,
		'show_in_quick_edit' => true,
		'sort' => true,
	  'capabilities' => array(
			'manage_terms' => false,
			'edit_terms' => false,
			'delete_terms' => false,
		),
	);

	register_taxonomy( 'csco_post_featured', array( 'post' ), apply_filters( 'csco_featured_taxonomy_args', $args ) );
}

add_action( 'init', 'csco_register_csco_featured', 10 );

/**
 * Add default featured terms upon theme activation
 */
function csco_add_featured_terms() {

	if ( get_option( 'csco_authentic_featured_terms_added' ) ) {

		// Return if terms have already been added.
		return;

	} else {

		// Array of Featured Locations.
		$featured_terms = array(
			'slider'   => esc_html__( 'Post Slider', 'authentic' ),
			'tiles'    => esc_html__( 'Post Tiles', 'authentic' ),
			'carousel' => esc_html__( 'Post Carousel', 'authentic' ),
			'archive'  => esc_html__( 'Post Archive', 'authentic' ),
			'widget'   => esc_html__( 'Posts Widget', 'authentic' ),
			);

		// Add terms to custom taxonomy Featured Locations.
		foreach ( apply_filters( 'csco_featured_terms', $featured_terms ) as $term => $name ) {
			if ( ! term_exists( $name, 'csco_post_featured' ) ) {
				wp_insert_term( $name, 'csco_post_featured', $args = array( 'slug' => $term ) );
			}
		}

		// Set an option, that terms have been added.
		update_option( 'csco_authentic_featured_terms_added', true );

	}

}

add_action( 'init', 'csco_add_featured_terms', 20 );

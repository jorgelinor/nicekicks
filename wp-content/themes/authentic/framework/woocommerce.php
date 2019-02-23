<?php
/**
 * WooCommerce compatibility functions.
 *
 * @package Authentic Wordpress Theme
 * @subpackage Framework
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * -------------------------------------------------------------------------
 * [ General ]
 * -------------------------------------------------------------------------
 */

/**
 * Declare WooCommerce Support
 */
function csco_woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
}

add_action( 'after_setup_theme', 'csco_woocommerce_support' );


/**
 * Enqueues WooCommerce assets.
 */
function csco_wc_enqueue_scripts() {

	// Enqueue different assets for production and development environments.
	if ( WP_ENV === 'development' ) {
		$version = time();
	} else {
		$version = false;
	}

	// Register WooCommerce styles.
	wp_register_style( 'csco_css_wc', get_template_directory_uri() . '/css/woocommerce.css', false, $version );

	// Enqueue WooCommerce styles.
	wp_enqueue_style( 'csco_css_wc' );

}

add_action( 'wp_enqueue_scripts', 'csco_wc_enqueue_scripts' );


/**
 * -------------------------------------------------------------------------
 * [ Layout ]
 * -------------------------------------------------------------------------
 */

// Remove default wrappers.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

/**
 * Wrapper Start
 */
function csco_wc_wrapper_start() {
	?><div id="primary" class="content-area"><?php
}

/**
 * Wrapper End
 */
function csco_wc_wrapper_end() {
	?></div><?php
}

add_action( 'woocommerce_before_main_content', 'csco_wc_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'csco_wc_wrapper_end', 10 );

/**
 * Get Page Layout
 *
 * @param string $layout Page layout.
 */
function csco_wc_get_page_layout( $layout ) {

	if ( is_woocommerce() && ! ( is_cart() || is_checkout() || is_account_page() ) ) {

		if ( is_shop() || is_product_category() || is_product_tag() ) {

			$page_id = get_option( 'woocommerce_shop_page_id' );
			$layout = csco_get_field( 'csco_singular_layout', $page_id, 'default' );

			if ( 'default' === $layout ) {

				if ( get_theme_mod( 'page_layout_default', true ) ) {

					// Get Layout, specified in Layout > General.
					$layout  = get_theme_mod( 'layout', 'layout-sidebar-right' );

				} else {

					// Get Layout for pages.
					$layout = get_theme_mod( 'page_layout', 'layout-sidebar-right' );

				}
			}
		} else {

			$layout = 'layout-fullwidth';

		}
	}

	return $layout;

}

add_filter( 'csco_page_layout', 'csco_wc_get_page_layout' );

/**
 * Get Page Header Type
 *
 * @param string $page_header_type Page header type.
 */
function csco_wc_get_page_header_type( $page_header_type ) {

	if ( is_shop() ) {

		global $paged;

		if ( $paged < 1 ) {

			$page_id = get_option( 'woocommerce_shop_page_id' );

			// Get Page Header Type for current post or page.
			$page_header_type = csco_get_field( 'csco_page_header_type', $page_id, 'default' );

			if ( 'default' === $page_header_type ) {

				if ( ! get_theme_mod( 'page_page_header_default', true ) ) {

					// Get Page Header Type, specified in Page > Layout.
					$page_header_type = get_theme_mod( 'page_page_header', 'simple' );

				} else {

					// Get Page Header Type, specified in Layout > General.
					$page_header_type = get_theme_mod( 'page_header', 'simple' );

				}
			}
		} else {

			// Don't show page header except for the first page.
			$page_header_type = 'none';

		}
	} elseif ( is_product_category() ) {

		$cat = get_queried_object();
		$id = $cat->term_id;

		// Get Page Header Type for current category.
		$page_header_type = csco_get_field( 'csco_page_header_type', 'product_cat_' . $id, 'default' );

		if ( 'default' === $page_header_type ) {
			// Get default page header.
			$page_header_type = get_theme_mod( 'page_header', 'simple' );

		}
	}

	return $page_header_type;

}

add_filter( 'csco_page_header_type', 'csco_wc_get_page_header_type' );

/**
 * Page Header Post Thumbnail URL
 *
 * @param string $thumbnail_url Post Thumbnail URL.
 */
function csco_wc_shop_page_thumbnail( $thumbnail_url ) {

	if ( is_shop() || is_product_category() ) {

		$type = csco_get_page_header_type();

		if ( 'wide' === $type || 'large' === $type ) {
			$size = 'xl';
		} else {
			if ( 'layout-fullwidth' === csco_get_page_layout() ) {
				$size = 'lg-hor';
			} else {
				$size = 'md-sq';
			}
		}

		if ( is_shop() ) {

			$thumbnail_id = get_post_thumbnail_id( get_option( 'woocommerce_shop_page_id' ) );

		} elseif ( is_product_category() ) {

			$cat = get_queried_object();
			$id = $cat->term_id;

			$thumbnail_id = get_woocommerce_term_meta( $id, 'thumbnail_id', true );
		}

		$thumbnail     = wp_get_attachment_image_src( $thumbnail_id, $size );
		$thumbnail_url = $thumbnail[0];

	}

	return $thumbnail_url;
}
add_filter( 'csco_page_header_thumbnail_url', 'csco_wc_shop_page_thumbnail' );

/**
 * Add Small and Simple Page Headers
 */
function csco_wc_get_page_header() {
	if ( ! is_product() ) {
		csco_get_page_header();
	}
}
add_action( 'woocommerce_before_main_content', 'csco_wc_get_page_header' );

/**
 * Add Shop Options on Shop Page
 *
 * @param array $location Locations.
 */
if ( function_exists( 'acf_add_local_field_group' ) ) {
	acf_add_local_field_group( array(
		'key' => 'group_shop_page',
		'title' => esc_html__( 'Shop Options', 'authentic' ),
		'fields' => array(
			array(
				'key' => 'field_shop_products_per_row',
				'label' => esc_html__( 'Products per Row', 'authentic' ),
				'name' => 'csco_products_per_row',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
				),
				'default_value' => array(
					3 => 3,
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
			array(
				'key' => 'field_shop_products_per_page',
				'label' => esc_html__( 'Products per Page', 'authentic' ),
				'name' => 'csco_products_per_page',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 9,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page',
					'operator' => '==',
					'value' => get_option( 'woocommerce_shop_page_id' ),
					),
				),
			),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

}// End if().

/**
 * Add Page Header Select on Product Categories
 *
 * @param array $location Locations.
 */
if ( function_exists( 'acf_add_local_field_group' ) ) {
	acf_add_local_field_group( array(
		'key' => 'group_product_cat',
		'title' => esc_html__( 'Page Header', 'authentic' ),
		'fields' => array(
			array(
				'key' => 'field_product_cat_page_header_type',
				'label' => esc_html__( 'Page Header', 'authentic' ),
				'name' => 'csco_page_header_type',
				'type' => 'select',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'default'   => esc_html__( 'Default', 'authentic' ),
					'none'      => esc_html__( 'None', 'authentic' ),
					'simple'    => esc_html__( 'Simple', 'authentic' ),
					'small'     => esc_html__( 'Small', 'authentic' ),
					'wide'      => esc_html__( 'Wide', 'authentic' ),
					'large'     => esc_html__( 'Large', 'authentic' ),
				),
				'default_value' => array(
					0 => 'default',
				),
				'allow_null' => 0,
				'multiple' => 0,
				'ui' => 0,
				'ajax' => 0,
				'return_format' => 'value',
				'placeholder' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'taxonomy',
					'operator' => '==',
					'value' => 'product_cat',
					),
				),
			),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

}// End if().

/**
 * Override Shop Home Page Title
 *
 * @param string $title Page Title.
 */
function csco_wc_the_title( $title ) {

	if ( is_shop() ) {
		$title = get_the_title( get_option( 'woocommerce_shop_page_id' ) );
	} elseif ( is_product_category() || is_product_tag() ) {
		$title = single_term_title( '', false );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'csco_wc_the_title' );

/**
 * Remove Default WooCommerce Page Title
 */
function csco_wc_show_page_title() {
	if ( is_shop() ) {
		return false;
	}
}
add_filter( 'woocommerce_show_page_title', 'csco_wc_show_page_title' );

/**
 * Product Count Template
 */
function csco_wc_archive_product_count() {
	if ( is_archive() ) {
		global $wp_query;
		$found_posts = $wp_query->found_posts; ?>
		<div class="product-count">
			<?php printf( esc_html( _n( '%s product', '%s products', $found_posts, 'authentic' ) ), intval( $found_posts ) ); ?>
		</div>
	<?php }
}

/**
 * Add Product Count
 */
function csco_wc_add_product_count() {
	if ( is_shop() || is_product_category() || is_product_tag() ) {
		remove_action( 'csco_page_header_end', 'csco_archive_post_count' );
		add_action( 'csco_page_header_end', 'csco_wc_archive_product_count' );
	}
}
add_action( 'wp', 'csco_wc_add_product_count' );

/**
 * Register WooCommerce Sidebar
 */
function csco_wc_widgets_init() {

	register_sidebar(array(
		'name'          => esc_html__( 'WooCommerce', 'authentic' ),
		'id'            => 'sidebar-woocommerce',
		'before_widget' => '<div class="widget %1$s %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="title-block title-widget">',
		'after_title'   => '</h5>',
	));
}

add_action( 'widgets_init', 'csco_wc_widgets_init' );

/**
 * Overwrite Default Sidebar
 *
 * @param string $sidebar Sidebar slug.
 */
function csco_wc_sidebar( $sidebar ) {
	if ( is_woocommerce() ) {
		return 'sidebar-woocommerce';
	}
	return $sidebar;
}

add_filter( 'csco_sidebar', 'csco_wc_sidebar' );

/**
 * Display Cart in Header
 *
 * @param array $fragments Cart fragments.
 */
function csco_wc_header_add_to_cart_fragment( $fragments ) {

	global $woocommerce;
	ob_start();	?>

	<a class="header-cart" href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" title="<?php esc_html_e( 'View your shopping cart', 'authentic' ); ?>">
		<i class="icon icon-cart"></i>
		<span class="cart-quantity"><?php echo intval( $woocommerce->cart->cart_contents_count ); ?></span>
	</a>

	<?php

	$fragments['a.header-cart'] = ob_get_clean();

	return $fragments;

}
add_filter( 'add_to_cart_fragments', 'csco_wc_header_add_to_cart_fragment' );

/**
 * Add Cart Checkbox To Navbar Customizer
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'navbar_collapsible_cart',
	'section'     => 'navbar',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Cart', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'navbar_cart',
	'label'       => esc_html__( 'Cart', 'authentic' ),
	'section'     => 'navbar',
	'default'     => false,
	'priority'    => 10,
) );

/**
 * Loop
 */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/**
 * Open Thumbnail Wrap
 */
function csco_wc_before_shop_loop_item() {
	?>
	<div class="product-thumbnail">
<?php }
add_action( 'woocommerce_before_shop_loop_item', 'csco_wc_before_shop_loop_item', 5 );

/**
 * Close Link
 */
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15 );

/**
 * Add To Cart Button
 */
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 20 );

/**
 * Close Thumbnail Wrap
 */
function csco_wc_before_shop_loop_item_title() {
	?>
	</div>
<?php }
add_action( 'woocommerce_before_shop_loop_item_title', 'csco_wc_before_shop_loop_item_title', 25 );

/**
 * Open Link
 */
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 30 );

/**
 * Override number of products per row
 */
function csco_wc_loop_columns() {
	$products_per_row = csco_get_field( 'csco_products_per_row', get_option( 'woocommerce_shop_page_id' ), 3 );
	return $products_per_row;
}
add_filter( 'loop_shop_columns', 'csco_wc_loop_columns' );

/**
 * Override number of products per row
 */
function csco_wc_loop_shop_per_page() {
	$products_per_page = csco_get_field( 'csco_products_per_page', get_option( 'woocommerce_shop_page_id' ), 9 );
	return $products_per_page;
}
add_filter( 'loop_shop_per_page', 'csco_wc_loop_shop_per_page', 20 );

/**
 * Adds classes to <body> tag
 *
 * @param array $classes is an array of all body classes.
 */
function csco_wc_body_class( $classes ) {
	if ( is_shop() || is_product_category() || is_product_tag() ) {
		$classes[] = 'wc-col-' . intval( csco_get_field( 'csco_products_per_row', get_option( 'woocommerce_shop_page_id' ), 3 ) );
	}
	if ( is_product() ) {
		$classes[] = 'wc-col-4';
	}
	return $classes;
}
add_filter( 'body_class', 'csco_wc_body_class' );

/**
 * Override pagination
 */
function csco_wc_woocommerce_pagination() {

	global $wp_query;

	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	?>

	<div class="archive-pagination">

	<?php the_posts_pagination( apply_filters( 'woocommerce_pagination_args', array(
			'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
			'format'       => '',
			'add_args'     => false,
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'prev_text'    => esc_html__( 'Previous', 'authentic' ),
			'next_text'    => esc_html__( 'Next', 'authentic' ),
			'end_size'     => 3,
			'mid_size'     => 3,
	) ) ); ?>

	</div>

	<?php
}

remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'csco_wc_woocommerce_pagination', 10 );

/**
 * Single Product
 */

/**
 * Open Gallery Wrapper
 */
function csco_wc_open_gallery_image_wrapper() {
	?>
	<div class="owl-container product-gallery-wrapper">
		<div class="owl-carousel">
	<?php
}
add_action( 'woocommerce_product_thumbnails', 'csco_wc_open_gallery_image_wrapper', 15 );

/**
 * Close Gallery Wrapper
 */
function csco_wc_close_gallery_image_wrapper() {
	?>
		</div>
		<div class="owl-dots"></div>
	</div>
	<?php
}
add_action( 'woocommerce_product_thumbnails', 'csco_wc_close_gallery_image_wrapper', 25 );

/**
 * Remove Product Description Title
 */
add_filter( 'woocommerce_product_description_heading', '__return_null' );

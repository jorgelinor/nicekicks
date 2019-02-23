<?php
/**
 * Theme Mods
 *
 * @package Authentic WordPress Theme
 * @subpackage Customizer
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * -------------------------------------------------------------------------
 * [ Variables ]
 * -------------------------------------------------------------------------
 */

$font_family_base       = 'Lato';
$font_family_headings   = 'Montserrat';
$font_family_btn        = 'Montserrat';
$font_size_base         = '1rem';
$color_base             = '#777777';

$template_directory_uri = get_template_directory_uri();
$default_menu           = csco_get_default_menu();
$menus                  = csco_get_menus();
$icons                  = csco_get_icons();
$site_url               = get_site_url();
$post_sources           = csco_get_post_sources( 'featured' );
$registered_image_sizes = csco_get_registered_image_sizes( true );

/**
 * -------------------------------------------------------------------------
 * [ Colors ]
 * -------------------------------------------------------------------------
 */

Kirki::add_panel( 'colors', array(
	'title'       => esc_html__( 'Colors', 'authentic' ),
	'priority'    => 1,
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Colors > Presets ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'colors_presets', array(
	'title'       => esc_html__( 'Presets', 'authentic' ),
	'panel'       => 'colors',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'preset',
	'settings'    => 'color_presets',
	'label'       => esc_html__( 'Color Presets', 'authentic' ),
	'description' => esc_html__( 'Please note: selecting a pre-defined color preset will reset all current color settings.', 'authentic' ),
	'section'     => 'colors_presets',
	'default'     => 'monochrome',
	'priority'    => 10,
	'multiple'    => 3,
	'transport'   => 'auto',
	'choices'     => apply_filters( 'csco_color_palettes', array() ),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Colors > Base Colors ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'colors_base', array(
	'title'       => esc_html__( 'Base', 'authentic' ),
	'panel'       => 'colors',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_body_bg',
	'label'       => esc_html__( 'Body Background', 'authentic' ),
	'section'     => 'colors_base',
	'default'     => '#FFFFFF',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => 'body, .offcanvas, #search, .navbar-stuck, input[type=search], input[type=text], input[type=number], input[type=email], input[type=tel], input[type=password], textarea, .form-control, .card',
			'property' => 'background-color',
			),
		array(
			'element'  => '.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a',
			'property' => 'border-bottom-color',
			),
		array(
			'element'  => '.tabs-vertical .nav-tabs',
			'property' => 'border-bottom-color',
			'media_query' => '@media ( min-width: 768px )',
			),
		array(
			'element'  => '.content .block-bg-dark, .dropcap-bg-inverse:first-letter, .dropcap-bg-dark:first-letter',
			'property' => 'color',
			'suffix' => '!important',
			),
		array(
			'element'  => '.tabs-vertical .nav-tabs .nav-link.active, .tabs-vertical .nav-tabs .nav-item.show .nav-link',
			'property' => 'border-right-color',
			'media_query' => '@media ( min-width: 768px )',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_text',
	'label'       => esc_html__( 'Main Text', 'authentic' ),
	'section'     => 'colors_base',
	'default'     => '#777777',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => 'body, input[type=search], input[type=text], input[type=number], input[type=email], input[type=tel], input[type=password], textarea',
			'property' => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_text_secondary',
	'label'       => esc_html__( 'Secondary Text', 'authentic' ),
	'section'     => 'colors_base',
	'default'     => '#c9c9c9',
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'blockquote cite, label, .text-small, .comment-metadata, .logged-in-as, .post-categories, .post-count, .product-count, .post-meta, .post-tags, .sub-title, .tagcloud, .timestamp, #wp-calendar caption, .comment-metadata a, .comment-metadata, .bsa-wrap .bsa-count, .bsa-wrap .bsa-label, .bsb-default .bsb-count, .title-share, .btw-default .btw-tweet:before, .woocommerce ul.products li.product .price, .woocommerce .widget_price_filter .price_slider_amount, .woocommerce ul.cart_list li .reviewer, .woocommerce ul.product_list_widget li .reviewer, .woocommerce .woocommerce-result-count, .woocommerce .product_meta, .woocommerce div.product p.price del,.woocommerce div.product span.price del, .woocommerce .woocommerce-review-link, .woocommerce-review__published-date, .woocommerce table.shop_table th, .woocommerce table.shop_table_responsive tr td::before, .woocommerce-page table.shop_table_responsive tr td::before',
			'property' => 'color',
			),
		array(
			'element' => '.owl-dot span',
			'property' => 'background-color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_links',
	'label'       => esc_html__( 'Links', 'authentic' ),
	'section'     => 'colors_base',
	'priority'    => 10,
	'default'     => '#000000',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => 'a, #search .close, .bsa-wrap .bsa-count, .bsa-wrap .bsa-icon, .bsa-wrap .bsa-title, .bsb-default .bsb-link, .bsb-wrap .bsb-total .bsb-label, .woocommerce ul.products li.product .price ins, .woocommerce .widget_layered_nav ul li.chosen a:before, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce .quantity-controls input, .woocommerce .woocommerce-review-link:hover, .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce p.stars a:hover, .woocommerce .order-total .amount',
			'property'  => 'color',
			),
		array(
			'element'  => '.owl-dot.active span',
			'property' => 'background-color',
			),
		array(
			'element'   => '.woocommerce a.remove',
			'property'  => 'color',
			'suffix'  => '!important',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_links_hover',
	'label'       => esc_html__( 'Links Hover', 'authentic' ),
	'section'     => 'colors_base',
	'priority'    => 10,
	'default'     => '#A0A0A0',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => 'a:hover, #search .close:hover, .woocommerce .widget_layered_nav ul li.chosen a:hover:before, .woocommerce p.stars a, .woocommerce .woocommerce-MyAccount-navigation-link.is-active a',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_borders',
	'label'       => esc_html__( 'Borders', 'authentic' ),
	'section'     => 'colors_base',
	'default'     => '#EEEEEE',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => 'section.widget, .form-control, input[type=search], input[type=text], input[type=number], input[type=email], input[type=tel], input[type=password], textarea, select, .card, .woocommerce .cart-collaterals .cart_totals, .woocommerce form.checkout_coupon, .woocommerce form.login, .woocommerce form.register, .select2-container--default .select2-selection--single, .select2-dropdown, .woocommerce form .form-row.woocommerce-validated .select2-container, .woocommerce form .form-row.woocommerce-validated input.input-text, .woocommerce form .form-row.woocommerce-validated select, .woocommerce table.woocommerce-checkout-review-order-table, #add_payment_method #payment, .woocommerce-cart #payment, .woocommerce-checkout #payment, #add_payment_method table.cart td.actions .coupon .input-text, .woocommerce-cart table.cart td.actions .coupon .input-text, .woocommerce-checkout table.cart td.actions .coupon .input-text, .woocommerce table.woocommerce-table--order-details, .woocommerce .woocommerce-MyAccount-navigation ul',
			'property' => 'border-color',
			),
		array(
			'element'  => '.header-enabled .navbar-primary:not(.navbar-stuck) .navbar, .navigation.comment-navigation, .site-main > article > .post-author, .post-main .post-author, .comment-body + .comment-respond, .comment-list + .comment-respond, .comment-list article, .comment-list .pingback, .comment-list .trackback, .post-standard:not(.post-featured) + .post-standard:not(.post-featured), .archive-first + .archive-main > article:first-child, .single .section-carousel, .widget_nav_menu .menu > .menu-item:not(:first-child), .widget_pages li:not(:first-child) a, .widget_meta li:not(:first-child) a, .widget_categories > ul > li:not(:first-child), .widget_archive > ul > li:not(:first-child), .widget_recent_comments li:not(:first-child), .widget_recent_entries li:not(:first-child), #wp-calendar tbody td, .single .navigation.pagination, .navigation.pagination + .post-tags, .fb-comments, .post-tags, .sidebar-offcanvas .widget + .widget, .page-header-simple .page-header + .post-archive, .section-carousel + .site-content > .container:before, .section-grid + .site-content > .container:before, .archive-pagination:not(:empty), .woocommerce .widget_shopping_cart .total, .woocommerce.widget_shopping_cart .total, .widget_product_categories > ul > li:not(:first-child), .woocommerce .widget_layered_nav > ul > li:not(:first-child), .woocommerce .product_meta, .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce #review_form, .woocommerce table.shop_table td, #add_payment_method .cart-collaterals .cart_totals tr td, #add_payment_method .cart-collaterals .cart_totals tr th, .woocommerce-cart .cart-collaterals .cart_totals tr td, .woocommerce-cart .cart-collaterals .cart_totals tr th, .woocommerce-checkout .cart-collaterals .cart_totals tr td, .woocommerce-checkout .cart-collaterals .cart_totals tr th, .woocommerce table.shop_table tbody th, .woocommerce table.shop_table tfoot td, .woocommerce table.shop_table tfoot th',
			'property' => 'border-top-color',
			),
		array(
			'element'  => '.navbar-primary:not(.navbar-stuck) .navbar, .navbar-stuck, .topbar, .navbar-offcanvas, .navigation.comment-navigation, .bsc-separator, .nav-tabs, .woocommerce div.product .woocommerce-tabs ul.tabs',
			'property' => 'border-bottom-color',
			),
		array(
			'element'  => '.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a',
			'property' => 'border-left-color',
			),
		array(
			'element'  => '.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a',
			'property' => 'border-right-color',
			),
		array(
			'element'  => '.tabs-vertical .nav-tabs',
			'property' => 'border-right-color',
			'media_query' => '@media ( min-width: 768px )',
			),
		array(
			'element'  => '.tabs-vertical .nav-tabs .nav-link.active, .tabs-vertical .nav-tabs .nav-item.show .nav-link',
			'property' => 'border-bottom-color',
			'media_query' => '@media ( min-width: 768px )',
			),
		array(
			'element'  => '.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content, .nav-tabs .nav-link:not(.active):focus, .nav-tabs .nav-link:not(.active):hover',
			'property' => 'background-color',
			),
		array(
			'element'  => '.woocommerce .star-rating::before',
			'property' => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_accent',
	'label'       => esc_html__( 'Accent', 'authentic' ),
	'section'     => 'colors_base',
	'default'     => '#F8F8F8',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.site-main .bmc-wrap, .post-comments, .content .dropcap-bg:first-letter, .content .dropcap-bg-light:first-letter, .content .block-bg-default, .content .block-bg-light, .bsa-horizontal .bsa-link, .bsb-after-post.bsb-default .bsb-link, .bsb-before-post.bsb-default .bsb-link, .basic_mailchimp_widget, .btw-slider, div.quantity input, .woocommerce-error, .woocommerce-info, .woocommerce-message, .card-header, .progress, .woocommerce div.product .woocommerce-tabs ul.tabs li:not(.active) a:hover, .woocommerce table.shop_attributes tr:nth-child(even) td, .woocommerce table.shop_attributes tr:nth-child(even) th, .woocommerce .woocommerce-Reviews #comments, .woocommerce #review_form_wrapper, #add_payment_method #payment div.form-row, .woocommerce-cart #payment div.form-row, .woocommerce-checkout #payment div.form-row',
			'property' => 'background-color',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Colors > Headings ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'colors_headings', array(
	'title'       => esc_html__( 'Headings', 'authentic' ),
	'panel'       => 'colors',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_headings',
	'label'       => esc_html__( 'Headings', 'authentic' ),
	'section'     => 'colors_headings',
	'default'     => '#000000',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'   => 'h1, h2, h3, h4, h5, h6, .comment .fn, #search input[type="search"], .woocommerce .widget_shopping_cart .total strong, .woocommerce.widget_shopping_cart .total strong, .woocommerce .widget_shopping_cart .total .amount, .woocommerce.widget_shopping_cart .total .amount, .woocommerce-review__author, .comment-reply-title, #ship-to-different-address > label',
			'property'  => 'color',
			),
		array(
			'element'   => '#search input[type="search"]:-ms-input-placeholder',
			'property'  => 'color',
			),
		array(
			'element'   => '#search input[type="search"]:-moz-placeholder',
			'property'  => 'color',
			),
		array(
			'element'   => '#search input[type="search"]::-webkit-input-placeholder',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_headings_links',
	'label'       => esc_html__( 'Headings Links', 'authentic' ),
	'section'     => 'colors_headings',
	'priority'    => 10,
	'default'     => '#000000',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => 'h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .comment .fn a',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_headings_links_hover',
	'label'       => esc_html__( 'Headings Links Hover', 'authentic' ),
	'section'     => 'colors_headings',
	'priority'    => 10,
	'default'     => '#A0A0A0',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => 'h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .comment .fn a:hover',
			'property'  => 'color',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Colors > Buttons ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'colors_buttons', array(
	'title'       => esc_html__( 'Buttons', 'authentic' ),
	'panel'       => 'colors',
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Colors > Buttons > Primary Buttons ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'colors_collapsible_buttons_primary',
	'section'     => 'colors_buttons',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Primary Buttons', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_btn_primary_text',
	'label'       => esc_html__( 'Text', 'authentic' ),
	'section'     => 'colors_buttons',
	'priority'    => 10,
	'default'     => '#EEEEEE',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.btn-primary, .bsb-monochrome.bsb-before-post .bsb-link, .bsb-monochrome.bsb-after-post .bsb-link, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce span.onsale, .header-cart .cart-quantity, .woocommerce.widget_product_search input[type=submit], .product-thumbnail .added_to_cart, .woocommerce a.remove:hover, .select2-container--default .select2-results__option--highlighted[aria-selected]',
			'property'  => 'color',
			),
		),
));

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_btn_primary_text_hover',
	'label'       => esc_html__( 'Text Hover', 'authentic' ),
	'section'     => 'colors_buttons',
	'priority'    => 10,
	'default'     => '#FFFFFF',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.btn-primary:hover, .btn-primary:active, .btn-primary:focus, .bsb-monochrome.bsb-before-post .bsb-link:hover, .bsb-monochrome.bsb-after-post .bsb-link:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,  .header-cart:hover .cart-quantity, .post-tags a:focus, .post-tags a:hover, .tagcloud a:focus, .tagcloud a:hover, .woocommerce.widget_product_search input[type=submit]:hover, .product-thumbnail .added_to_cart:hover',
			'property'  => 'color',
			),
		),
));

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_btn_primary_bg',
	'label'       => esc_html__( 'Background', 'authentic' ),
	'section'     => 'colors_buttons',
	'priority'    => 10,
	'default'     => '#282828',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.btn-primary, .nav-pills .nav-link.active, .nav-pills .nav-link.active:focus, .nav-pills .nav-link.active:hover, .bsb-monochrome.bsb-before-post .bsb-link, .bsb-monochrome.bsb-after-post .bsb-link, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce span.onsale, .header-cart .cart-quantity, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce.widget_product_search input[type=submit], .product-thumbnail .added_to_cart, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce a.remove:hover, .select2-container--default .select2-results__option--highlighted[aria-selected]',
			'property'  => 'background-color',
			),
		array(
			'element'   => '.bg-primary',
			'property'  => 'background-color',
			'suffix'    => '!important',
			),
		array(
			'element'   => '.woocommerce .star-rating span::before',
			'property'  => 'color',
			),
		),
));

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_btn_primary_bg_hover',
	'label'       => esc_html__( 'Background Hover', 'authentic' ),
	'section'     => 'colors_buttons',
	'priority'    => 10,
	'default'     => '#000000',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.btn-primary:hover, .btn-primary:active, .btn-primary:focus, .bsb-monochrome.bsb-before-post .bsb-link:hover, .bsb-monochrome.bsb-after-post .bsb-link:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover,  .header-cart:hover .cart-quantity, .post-tags a:focus, .post-tags a:hover, .tagcloud a:focus, .tagcloud a:hover, .woocommerce.widget_product_search input[type=submit]:hover, .product-thumbnail .added_to_cart:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover',
			'property'  => 'background-color',
			),
		),
));

/**
 * -------------------------------------------------------------------------
 * |-- [ Colors > Buttons > Secondary Buttons ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'colors_collapsible_buttons_secondary',
	'section'     => 'colors_buttons',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Secondary Buttons', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_btn_secondary_text',
	'label'       => esc_html__( 'Text', 'authentic' ),
	'section'     => 'colors_buttons',
	'priority'    => 10,
	'default'     => '#A0A0A0',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.btn-secondary, .woocommerce #respond input#submit.disabled, .woocommerce #respond input#submit:disabled, .woocommerce a.button.disabled, .woocommerce a.button:disabled, .woocommerce button.button.disabled, .woocommerce button.button:disabled, .woocommerce input.button.disabled, .woocommerce input.button:disabled, .woocommerce.widget_product_search input[type=submit].disabled, .woocommerce.widget_product_search input[type=submit]:disabled, .woocommerce .added_to_cart.disabled, .woocommerce .added_to_cart:disabled, .woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], .woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce input.button.alt:disabled[disabled]:hover',
			'property'  => 'color',
			),
		),
));

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_btn_secondary_text_hover',
	'label'       => esc_html__( 'Text Hover', 'authentic' ),
	'section'     => 'colors_buttons',
	'priority'    => 10,
	'default'     => '#000000',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.btn-secondary:hover, .btn-secondary:active, .btn-secondary:focus',
			'property'  => 'color',
			),
		),
));

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_btn_secondary_bg',
	'label'       => esc_html__( 'Background', 'authentic' ),
	'section'     => 'colors_buttons',
	'priority'    => 10,
	'default'     => '#EEEEEE',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.btn-secondary, .woocommerce #respond input#submit.disabled, .woocommerce #respond input#submit:disabled, .woocommerce a.button.disabled, .woocommerce a.button:disabled, .woocommerce button.button.disabled, .woocommerce button.button:disabled, .woocommerce input.button.disabled, .woocommerce input.button:disabled, .woocommerce.widget_product_search input[type=submit].disabled, .woocommerce.widget_product_search input[type=submit]:disabled, .woocommerce .added_to_cart.disabled, .woocommerce .added_to_cart:disabled, .woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], .woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce input.button.alt:disabled[disabled]:hover',
			'property'  => 'background-color',
			),
		),
));

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_btn_secondary_bg_hover',
	'label'       => esc_html__( 'Background Hover', 'authentic' ),
	'section'     => 'colors_buttons',
	'priority'    => 10,
	'default'     => '#F8F8F8',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.btn-secondary:hover, .btn-secondary:active, .btn-secondary:focus',
			'property'  => 'background-color',
			),
		),
));

/**
 * -------------------------------------------------------------------------
 * |- [ Colors > Logo ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'colors_logo', array(
	'title'       => esc_html__( 'Logo', 'authentic' ),
	'panel'       => 'colors',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_logo_text',
	'label'       => esc_html__( 'Title', 'authentic' ),
	'section'     => 'colors_logo',
	'priority'    => 10,
	'default'     => '#000000',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.site-title',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_logo_text_hover',
	'label'       => esc_html__( 'Title Hover', 'authentic' ),
	'section'     => 'colors_logo',
	'priority'    => 10,
	'default'     => '#A0A0A0',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.site-title:hover',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_logo_description',
	'label'       => esc_html__( 'Description', 'authentic' ),
	'section'     => 'colors_logo',
	'default'     => '#A0A0A0',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.site-description',
			'property' => 'color',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Colors > Navigation Bar ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'colors_navbar', array(
	'title'       => esc_html__( 'Navigation Bar', 'authentic' ),
	'panel'       => 'colors',
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Colors > Navigation Bar > General ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'colors_collapsible_navbar',
	'section'     => 'colors_navbar',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'General', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'colors_navbar_bg_toggle_next',
	'label'       => esc_html__( 'Background', 'authentic' ),
	'section'     => 'colors_navbar',
	'default'     => false,
	'transport'   => 'auto',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_navbar_bg',
	'label'       => esc_html__( 'Background', 'authentic' ),
	'section'     => 'colors_navbar',
	'default'     => '#FFFFFF',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.navbar-primary',
			'property' => 'background-color',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'colors_navbar_bg_toggle_next',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'colors_navbar_borders',
	'label'       => esc_html__( 'Borders', 'authentic' ),
	'section'     => 'colors_navbar',
	'default'     => true,
	'priority'    => 10,
	'output' => array(
		array(
			'element'       => '.header-enabled .navbar-primary:not(.navbar-stuck) .navbar',
			'property'      => 'border-top-width',
			'value_pattern' => '1px',
			'media_query'   => '@media ( min-width: 992px )',
			'exclude'       => array( false ),
			),
		array(
			'element'       => '.header-enabled .navbar-primary:not(.navbar-stuck) .navbar',
			'property'      => 'border-top-style',
			'value_pattern' => 'solid',
			'media_query'   => '@media ( min-width: 992px )',
			'exclude'       => array( false ),
			),
		array(
			'element'       => '.navbar-primary:not(.navbar-stuck) .navbar, .navbar-stuck',
			'property'      => 'border-bottom-width',
			'value_pattern' => '1px',
			'exclude'       => array( false ),
			),
		array(
			'element'       => '.navbar-primary:not(.navbar-stuck) .navbar, .navbar-stuck',
			'property'      => 'border-bottom-style',
			'value_pattern' => 'solid',
			'exclude'       => array( false ),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_navbar_main_links',
	'label'       => esc_html__( 'Links', 'authentic' ),
	'section'     => 'colors_navbar',
	'priority'    => 10,
	'default'     => '#000000',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.navbar-primary a, .navbar-primary button, .navbar-primary .navbar-nav > li > a, .navbar-primary .bsa-wrap .bsa-icon, .navbar-primary .bsa-wrap .bsa-label, .navbar-primary .bsa-wrap .bsa-title',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_navbar_main_links_hover',
	'label'       => esc_html__( 'Links Hover', 'authentic' ),
	'section'     => 'colors_navbar',
	'priority'    => 10,
	'default'     => '#A0A0A0',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.navbar-primary a:hover, .navbar-primary button:hover, .navbar-primary .navbar-nav > li > a:focus, .navbar-primary .navbar-nav > li > a:hover, .navbar-primary .navbar-nav > li.current-menu-parent > a, .navbar-primary .navbar-nav > li.current-nav-item > a, .navbar-primary .bsa-nav .bsa-item .bsa-link:hover .bsa-icon, .navbar-primary .bsa-nav .bsa-item .bsa-link:hover .bsa-title, .navbar-primary .bsa-wrap .bsa-count',
			'property'  => 'color',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Colors > Navigation Bar > Sub-Menus ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'colors_collapsible_navbar_submenu',
	'section'     => 'colors_navbar',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Sub-Menus', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_navbar_submenu_bg',
	'label'       => esc_html__( 'Background', 'authentic' ),
	'section'     => 'colors_navbar',
	'default'     => '#FFFFFF',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.navbar-nav .sub-menu',
			'property' => 'background-color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'colors_navbar_submenu_borders_toggle_next',
	'label'       => esc_html__( 'Borders', 'authentic' ),
	'section'     => 'colors_navbar',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_navbar_submenu_borders',
	'label'       => esc_html__( 'Borders', 'authentic' ),
	'section'     => 'colors_navbar',
	'default'     => '#EEEEEE',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.navbar-nav .sub-menu',
			'property' => 'border',
			'value_pattern' => '1px $ solid',
			),
		array(
			'element'  => '.navbar-nav .sub-menu .sub-menu',
			'property' => 'margin-top',
			'value_pattern' => '-1px',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'colors_navbar_submenu_borders_toggle_next',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Colors > Navigation Bar > Sub-Menu Items ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'colors_collapsible_navbar_submenu_items',
	'section'     => 'colors_navbar',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Sub-Menu Items', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_navbar_submenu_items_links',
	'label'       => esc_html__( 'Links', 'authentic' ),
	'section'     => 'colors_navbar',
	'priority'    => 10,
	'default'     => '#000000',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.navbar-nav .sub-menu a, .mega-menu > .sub-menu > li > a:hover',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_navbar_submenu_items_links_hover',
	'label'       => esc_html__( 'Links Hover', 'authentic' ),
	'section'     => 'colors_navbar',
	'priority'    => 10,
	'default'     => '#FFFFFF',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.navbar-nav .sub-menu a:hover, .navbar-nav .sub-menu a:focus, .navbar-nav .sub-menu a:active',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_navbar_submenu_items_links_active',
	'label'       => esc_html__( 'Links Active', 'authentic' ),
	'section'     => 'colors_navbar',
	'priority'    => 10,
	'default'     => '#000000',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.navbar-nav .sub-menu .current-menu-item > a, .navbar-nav .sub-menu .current-menu-ancestor > a, .navbar-nav .sub-menu .current-menu-parent > a',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'colors_navbar_submenu_items_borders_toggle_next',
	'label'       => esc_html__( 'Borders', 'authentic' ),
	'section'     => 'colors_navbar',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_navbar_submenu_items_borders',
	'label'       => esc_html__( 'Borders', 'authentic' ),
	'section'     => 'colors_navbar',
	'default'     => '#EEEEEE',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.navbar-nav .sub-menu li + li > a',
			'property' => 'border-top',
			'value_pattern' => '1px $ solid',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'colors_navbar_submenu_items_borders_toggle_next',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_navbar_submenu_links_bg_hover',
	'label'       => esc_html__( 'Background Hover', 'authentic' ),
	'section'     => 'colors_navbar',
	'priority'    => 10,
	'default'     => '#000000',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.navbar-nav .sub-menu a:hover, .navbar-nav .sub-menu a:focus, .navbar-nav .sub-menu a:active',
			'property'  => 'background-color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_navbar_submenu_links_bg_active',
	'label'       => esc_html__( 'Background Active', 'authentic' ),
	'section'     => 'colors_navbar',
	'priority'    => 10,
	'default'     => '#EEEEEE',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.navbar-nav .sub-menu .current-menu-item > a, .navbar-nav .sub-menu .current-menu-ancestor > a, .navbar-nav .sub-menu .current-menu-parent > a',
			'property'  => 'background-color',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Colors > Top Bar ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'colors_topbar', array(
	'title'       => esc_html__( 'Top Bar', 'authentic' ),
	'panel'       => 'colors',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'colors_topbar_bg_toggle_next',
	'label'       => esc_html__( 'Background', 'authentic' ),
	'section'     => 'colors_topbar',
	'default'     => false,
	'transport'   => 'auto',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_topbar_bg',
	'label'       => esc_html__( 'Background', 'authentic' ),
	'section'     => 'colors_topbar',
	'default'     => '#FFFFFF',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.topbar',
			'property' => 'background-color',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'colors_topbar_bg_toggle_next',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'colors_topbar_borders',
	'label'       => esc_html__( 'Borders', 'authentic' ),
	'section'     => 'colors_topbar',
	'default'     => true,
	'priority'    => 10,
	'output' => array(
		array(
			'element'       => '.topbar',
			'property'      => 'border-bottom-width',
			'value_pattern' => '1px',
			'exclude'       => array( false ),
			),
		array(
			'element'       => '.topbar',
			'property'      => 'border-bottom-style',
			'value_pattern' => 'solid',
			'exclude'       => array( false ),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_topbar_main_links',
	'label'       => esc_html__( 'Links', 'authentic' ),
	'section'     => 'colors_topbar',
	'priority'    => 10,
	'default'     => '#A0A0A0',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.topbar a, .topbar .navbar-nav > li > a, .topbar .bsa-wrap .bsa-icon, .topbar .bsa-wrap .bsa-label, .topbar .bsa-wrap .bsa-title',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_topbar_main_links_hover',
	'label'       => esc_html__( 'Links Hover', 'authentic' ),
	'section'     => 'colors_topbar',
	'priority'    => 10,
	'default'     => '#000000',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.topbar a:hover, .topbar .navbar-nav > li > a:focus, .topbar .navbar-nav > li > a:hover, .topbar .navbar-nav > li.current-menu-item > a, .topbar .bsa-nav .bsa-item .bsa-link:hover .bsa-icon, .topbar .bsa-nav .bsa-item .bsa-link:hover .bsa-title, .topbar .bsa-wrap .bsa-count',
			'property'  => 'color',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Colors > Off-canvas ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'colors_offcanvas', array(
	'title'       => esc_html__( 'Off-Canvas Area', 'authentic' ),
	'panel'       => 'colors',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_offcanvas_navbar_links',
	'label'       => esc_html__( 'Links', 'authentic' ),
	'section'     => 'colors_offcanvas',
	'priority'    => 10,
	'default'     => '#000000',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'   => '.offcanvas-header .navbar-brand, .offcanvas-header .navbar-toggle',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_offcanvas_navbar_links_hover',
	'label'       => esc_html__( 'Links Hover', 'authentic' ),
	'section'     => 'colors_offcanvas',
	'priority'    => 10,
	'default'     => '#A0A0A0',
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element'   => '.offcanvas-header .navbar-brand:hover, .offcanvas-header .navbar-brand:focus, .offcanvas-header .navbar-toggle:hover, .offcanvas-header .navbar-toggle:focus',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'colors_offcanvas_navbar_bg',
	'label'       => esc_html__( 'Background', 'authentic' ),
	'section'     => 'colors_offcanvas',
	'default'     => '#FFFFFF',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.offcanvas-header .navbar',
			'property' => 'background-color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'colors_offcanvas_borders',
	'label'       => esc_html__( 'Borders', 'authentic' ),
	'section'     => 'colors_offcanvas',
	'default'     => true,
	'priority'    => 10,
	'output' => array(
		array(
			'element'       => '.navbar-offcanvas',
			'property'      => 'border-bottom-width',
			'value_pattern' => '1px',
			'exclude'       => array( false ),
			),
		array(
			'element'       => '.navbar-offcanvas',
			'property'      => 'border-bottom-style',
			'value_pattern' => 'solid',
			'exclude'       => array( false ),
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Colors > Post Content ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'colors_content', array(
	'title'       => esc_html__( 'Post Content', 'authentic' ),
	'panel'       => 'colors',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_post_paragraph',
	'label'       => esc_html__( 'Paragraph', 'authentic' ),
	'section'     => 'colors_content',
	'priority'    => 10,
	'default'     => '#A0A0A0',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.content p',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_post_links',
	'label'       => esc_html__( 'Links', 'authentic' ),
	'section'     => 'colors_content',
	'priority'    => 10,
	'default'     => '#000000',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.content p > a:not(.btn):not(.button)',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_post_links_hover',
	'label'       => esc_html__( 'Links Hover', 'authentic' ),
	'section'     => 'colors_content',
	'priority'    => 10,
	'default'     => '#A0A0A0',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.content p > a:not(.btn):not(.button):hover',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_category',
	'label'       => esc_html__( 'Category', 'authentic' ),
	'section'     => 'colors_content',
	'priority'    => 10,
	'default'     => '#000000',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.post-categories a',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_category_hover',
	'label'       => esc_html__( 'Category Hover', 'authentic' ),
	'section'     => 'colors_content',
	'priority'    => 10,
	'default'     => '#A0A0A0',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.post-categories a:hover',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_selection_text',
	'label'       => esc_html__( 'Selection Text', 'authentic' ),
	'section'     => 'colors_content',
	'priority'    => 10,
	'default'     => '#FFFFFF',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '::selection',
			'property'  => 'color',
			),
		array(
			'element'   => '::-moz-selection',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_selection_background',
	'label'       => esc_html__( 'Selection Background', 'authentic' ),
	'section'     => 'colors_content',
	'priority'    => 10,
	'default'     => '#000000',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '::selection',
			'property'  => 'background',
			),
		array(
			'element'   => '::-moz-selection',
			'property'  => 'background',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_blockquote',
	'label'       => esc_html__( 'Blockquote', 'authentic' ),
	'section'     => 'colors_content',
	'default'     => '#000000',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.content blockquote, .content blockquote p',
			'property' => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_leadin_dropcap',
	'label'       => esc_html__( 'Lead-Ins & Dropcaps', 'authentic' ),
	'section'     => 'colors_content',
	'default'     => '#000000',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.content .dropcap:first-letter, .content .content-block, .content .lead',
			'property' => 'color',
			),
		array(
			'element'  => '.content .dropcap-bg-inverse:first-letter, .content .dropcap-bg-dark:first-letter, .content .block-border-top:before, .content .block-border-bottom:after, .content .block-bg-inverse, .content .block-bg-dark',
			'property' => 'background-color',
			),
		array(
			'element'  => '.content .dropcap-borders:first-letter, .content .block-border-all',
			'property' => 'border-color',
			),
		array(
			'element'  => '.content .dropcap-border-right:first-letter, .content .block-border-right',
			'property' => 'border-right-color',
			),
		array(
			'element'  => '.content .block-border-left',
			'property' => 'border-left-color',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Colors > Footer ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'colors_footer', array(
	'title'       => esc_html__( 'Footer', 'authentic' ),
	'panel'       => 'colors',
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Colors > Footer > Base ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'colors_collapsible_footer_base',
	'section'     => 'colors_footer',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Base', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_footer_bg',
	'label'       => esc_html__( 'Background', 'authentic' ),
	'section'     => 'colors_footer',
	'default'     => '#000000',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.site-footer',
			'property' => 'background-color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_footer_text',
	'label'       => esc_html__( 'Text', 'authentic' ),
	'section'     => 'colors_footer',
	'default'     => '#A0A0A0',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.site-footer',
			'property' => 'color',
			),
		array(
			'element'  => '.site-footer .owl-dot span, .site-footer .widget_price_filter .ui-slider .ui-slider-handle',
			'property' => 'background-color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_footer_title',
	'label'       => esc_html__( 'Titles', 'authentic' ),
	'section'     => 'colors_footer',
	'default'     => '#777777',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.site-footer .title-widget',
			'property' => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_footer_link',
	'label'       => esc_html__( 'Links', 'authentic' ),
	'section'     => 'colors_footer',
	'priority'    => 10,
	'transport'   => 'auto',
	'default'     => '#FFFFFF',
	'output'    => array(
		array(
			'element'   => '.site-footer a, .site-footer #wp-calendar thead th, .site-footer .owl-dot.active span, .site-footer h2, .site-footer .bsa-wrap .bsa-count, .site-footer .bsa-wrap .bsa-icon, .site-footer .bsa-wrap .bsa-title, .woocommerce .site-footer .widget_shopping_cart .total strong, .site-footer .woocommerce.widget_shopping_cart .total strong, .woocommerce .site-footer .widget_shopping_cart .total .amount, .site-footer .woocommerce.widget_shopping_cart .total .amount, .woocommerce .site-footer .star-rating span::before',
			'property'  => 'color',
			),
		array(
			'element'   => '.site-footer .owl-dot.active span',
			'property'  => 'background-color',
			),
		array(
			'element'   => '.woocommerce .site-footer a.remove',
			'property'  => 'color',
			'suffix'    => '!important',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_footer_link_hover',
	'label'       => esc_html__( 'Links Hover', 'authentic' ),
	'section'     => 'colors_footer',
	'priority'    => 10,
	'transport'   => 'auto',
	'default'     => '#A0A0A0',
	'output'    => array(
		array(
			'element'   => '.site-footer a:hover, site-footer a:hover:active, .site-footer a:focus:active, .site-footer .mega-menu > .sub-menu > li > a:hover',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_footer_border',
	'label'       => esc_html__( 'Borders', 'authentic' ),
	'section'     => 'colors_footer',
	'default'     => '#242424',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.site-footer #wp-calendar tfoot tr #prev + .pad:after, .site-footer #wp-calendar tbody td a, .sidebar-footer .basic_mailchimp_widget, .sidebar-footer .bsa-horizontal .bsa-link, .woocommerce .site-footer .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .site-footer .widget_price_filter .price_slider_wrapper .ui-widget-content',
			'property' => 'background-color',
			),
		array(
			'element'  => '.site-footer .widget, .site-footer .widget_nav_menu .menu > .menu-item:not(:first-child), .site-footer .widget_categories > ul > li:not(:first-child), .site-footer .widget_archive > ul > li:not(:first-child), .site-footer #wp-calendar tbody td, .site-footer .widget_pages li:not(:first-child) a, .site-footer .widget_meta li:not(:first-child) a, .site-footer .widget_recent_comments li:not(:first-child), .site-footer .widget_recent_entries li:not(:first-child), .site-footer #wp-calendar tbody td#today:after, .footer-section + .footer-section > .container > *, .sidebar-footer .widget + .widget, .site-footer .widget_product_categories > ul > li:not(:first-child), .site-footer .widget_layered_nav > ul > li:not(:first-child), .woocommerce .site-footer .widget_shopping_cart .total, .site-footer .woocommerce.widget_shopping_cart .total',
			'property' => 'border-top-color',
			),
		array(
			'element'  => '.woocommerce .site-footer .star-rating::before',
			'property' => 'color',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Colors > Footer > Buttons ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'colors_collapsible_footer_buttons',
	'section'     => 'colors_footer',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Buttons', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_footer_btn_text',
	'label'       => esc_html__( 'Text', 'authentic' ),
	'section'     => 'colors_footer',
	'priority'    => 10,
	'default'     => '#A0A0A0',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.site-footer .btn, .woocommerce .site-footer a.button, .woocommerce .site-footer button.button, .woocommerce .site-footer input.button',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_footer_btn_text_hover',
	'label'       => esc_html__( 'Text', 'authentic' ),
	'section'     => 'colors_footer',
	'priority'    => 10,
	'default'     => '#FFFFFF',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.site-footer .btn:hover, .site-footer .btn:active, .woocommerce .site-footer a.button:hover, .woocommerce .site-footer button.button:hover, .woocommerce .site-footer input.button:hover',
			'property'  => 'color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_footer_btn_bg',
	'label'       => esc_html__( 'Background', 'authentic' ),
	'section'     => 'colors_footer',
	'priority'    => 10,
	'default'     => '#242424',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.site-footer .btn, .site-footer select, .site-footer .authentic_widget_posts .numbered .post-number, .woocommerce .site-footer a.button, .woocommerce .site-footer button.button, .woocommerce .site-footer input.button',
			'property'  => 'background-color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_footer_btn_bg_hover',
	'label'       => esc_html__( 'Background Hover', 'authentic' ),
	'section'     => 'colors_footer',
	'priority'    => 10,
	'default'     => '#141414',
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.site-footer .btn:hover, .site-footer .btn:active, .site-footer .btn:focus, .woocommerce .site-footer a.button:hover, .woocommerce .site-footer button.button:hover, .woocommerce .site-footer input.button:hover',
			'property'  => 'background-color',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Colors > Miscellaneous ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'colors_misc', array(
	'title'       => esc_html__( 'Miscellaneous', 'authentic' ),
	'panel'       => 'colors',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_misc_overlay',
	'label'       => esc_html__( 'Overlay', 'authentic' ),
	'section'     => 'colors_misc',
	'priority'    => 10,
	'default'     => 'rgba(40,40,40,0.125)',
	'choices'     => array(
		'alpha' => true,
	),
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.overlay:before, .page-header.overlay:hover:before, .overlay-static > div:before, .post-thumbnail:before',
			'property'  => 'background-color',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'color',
	'settings'    => 'color_misc_overlay_hover',
	'label'       => esc_html__( 'Overlay Hover', 'authentic' ),
	'section'     => 'colors_misc',
	'priority'    => 10,
	'default'     => 'rgba(40,40,40,0.25)',
	'choices'     => array(
		'alpha' => true,
	),
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.overlay:hover:before, .overlay-static:hover > div:before, .post-thumbnail:hover:before, .pagination-visible:hover .pagination-title',
			'property'  => 'background-color',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * [ Typography ]
 * -------------------------------------------------------------------------
 */

Kirki::add_panel( 'typography', array(
	'priority'    => 2,
	'title'       => esc_html__( 'Typography', 'authentic' ),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Typography > General ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'typography_general', array(
	'title'       => esc_html__( 'General', 'authentic' ),
	'panel'       => 'typography',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_base',
	'label'       => esc_html__( 'Base', 'authentic' ),
	'section'     => 'typography_general',
	'default'     => array(
		'font-family'    => $font_family_base,
		'variant'        => 'regular',
		'subsets'        => array( 'latin-ext' ),
		'font-size'      => '16px',
		'letter-spacing' => '0',
		),
	'choices' => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'700italic',
		),
	),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'body, button, input[type=search], input[type=text], input[type=number], input[type=email], input[type=tel], input[type=password], optgroup, select, textarea',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_text_small',
	'label'       => esc_html__( 'Small Text', 'authentic' ),
	'section'     => 'typography_general',
	'default'     => array(
		'font-family'    => $font_family_headings,
		'subsets'        => array( 'latin-ext' ),
		'variant'        => '600',
		'font-size'      => '11px',
		'letter-spacing' => '0',
		'text-transform' => 'uppercase',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'blockquote cite, label, .text-small, .comment-metadata, .logged-in-as, .post-categories, .post-count, .product-count, .post-meta, .post-tags, .sub-title, .tagcloud, .timestamp, .alert, #wp-calendar caption, .bsa-wrap .bsa-count, .bsa-wrap .bsa-label, .bsb-wrap .bsb-count, .btw-count, .woocommerce .widget_price_filter .price_slider_amount, .woocommerce ul.cart_list li .reviewer, .woocommerce ul.product_list_widget li .reviewer, .woocommerce .woocommerce-result-count, .woocommerce .product_meta,  .woocommerce-error, .woocommerce-info, .woocommerce-message, .woocommerce .woocommerce-review-link, .woocommerce-review__published-date, .woocommerce table.shop_table th, .woocommerce table.shop_table_responsive tr td::before, .woocommerce-page table.shop_table_responsive tr td::before',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_text_large',
	'label'       => esc_html__( 'Large Text', 'authentic' ),
	'section'     => 'typography_general',
	'default'     => array(
		'font-family'    => $font_family_base,
		'subsets'        => array( 'latin-ext' ),
		'variant'        => '400',
		'font-size'      => '1.25rem',
		'letter-spacing' => '0',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.lead, .text-large, .bmc-message',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_buttons',
	'label'       => esc_html__( 'Buttons', 'authentic' ),
	'section'     => 'typography_general',
	'default'     => array(
		'font-family'    => $font_family_btn,
		'variant'        => '700',
		'subsets'        => array( 'latin-ext' ),
		'font-size'      => '11px',
		'letter-spacing' => '1px',
		'text-transform' => 'uppercase',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.btn, .btn-link, .nav-tabs .nav-link, .nav-pills .nav-link, .card-header h5, .pagination-title, .comment-reply-link, .bsa-wrap .bsa-title, .bsb-wrap .bsb-label, .bsb-wrap .bsb-title, .title-share, .btw-username, .btw-label, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce .widget_price_filter .price_slider_amount .button, body .woocommerce.widget_product_search input[type=submit], .woocommerce span.onsale, .product-thumbnail .added_to_cart, .woocommerce div.product form.cart .reset_variations, .woocommerce div.product .woocommerce-tabs ul.tabs li a, #add_payment_method .wc-proceed-to-checkout a.checkout-button, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Typography > Headings ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'typography_headings', array(
	'title'       => esc_html__( 'Headings', 'authentic' ),
	'panel'       => 'typography',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_headings',
	'label'       => esc_html__( 'Heading', 'authentic' ),
	'section'     => 'typography_headings',
	'default'     => array(
		'font-family'    => $font_family_headings,
		'variant'        => '600',
		'subsets'        => array( 'latin-ext' ),
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'h1, h2, h3, h4, h5, h6, .comment .fn, .archive-standard section.basic_mailchimp_widget .title-widget, .archive-list section.basic_mailchimp_widget .title-widget, .woocommerce ul.cart_list li a, .woocommerce ul.product_list_widget li a, .woocommerce .widget_shopping_cart .total strong, .woocommerce.widget_shopping_cart .total strong, .woocommerce .widget_shopping_cart .total .amount, .woocommerce.widget_shopping_cart .total .amount, .woocommerce-review__author, .woocommerce .cart_item .product-name a, #ship-to-different-address > label',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_block_title',
	'label'       => esc_html__( 'Title Block', 'authentic' ),
	'section'     => 'typography_headings',
	'default'     => array(
		'font-family'    => $font_family_headings,
		'variant'        => '700',
		'subsets'        => array( 'latin-ext' ),
		'font-size'      => '13px',
		'letter-spacing' => '0.2px',
		'text-transform' => 'uppercase',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.title-block, .comment-reply-title, .nav-links, section.related.products > h2, .woocommerce .cart_totals > h2, .woocommerce-billing-fields > h3, #ship-to-different-address > label, #order_review_heading, .woocommerce .woocommerce-order-details__title, .woocommerce .woocommerce-customer-details > h2, .woocommerce .woocommerce-column__title, .woocommerce .woocommerce-Address-title h3',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_h1',
	'label'       => esc_html__( 'Heading 1', 'authentic' ),
	'section'     => 'typography_headings',
	'default'     => array(
		'font-size'      => '3rem',
		'letter-spacing' => '-.15rem',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'h1, .archive-standard h2',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_h2',
	'label'       => esc_html__( 'Heading 2', 'authentic' ),
	'section'     => 'typography_headings',
	'default'     => array(
		'font-size'      => '2rem',
		'letter-spacing' => '-.1rem',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'h2, .post-archive .overlay h2, .post-archive .archive-standard:not(.columns-3) .post-outer.overlay h3, .archive-standard section.basic_mailchimp_widget .title-widget, .archive-list section.basic_mailchimp_widget .title-widget',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_h3',
	'label'       => esc_html__( 'Heading 3', 'authentic' ),
	'section'     => 'typography_headings',
	'default'     => array(
		'font-size'      => '1.5rem',
		'letter-spacing' => '-.1rem',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'h3, .archive-grid h2, .archive-masonry h2, .archive-list h2',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_h4',
	'label'       => esc_html__( 'Heading 4', 'authentic' ),
	'section'     => 'typography_headings',
	'default'     => array(
		'font-size'      => '1.25rem',
		'letter-spacing' => '-.05rem',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'h4',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_h5',
	'label'       => esc_html__( 'Heading 5', 'authentic' ),
	'section'     => 'typography_headings',
	'default'     => array(
		'font-size'      => '1rem',
		'letter-spacing' => '-.025rem',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'h5, .woocommerce ul.cart_list li a, .woocommerce ul.product_list_widget li a, .woocommerce .widget_shopping_cart .total strong, .woocommerce.widget_shopping_cart .total strong, .woocommerce-loop-product__title, .woocommerce .cart_item .product-name a',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_h6',
	'label'       => esc_html__( 'Heading 6', 'authentic' ),
	'section'     => 'typography_headings',
	'default'     => array(
		'font-size'      => '15px',
		'letter-spacing' => '-1px',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'h6, .comment .fn, .woocommerce-review__author',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Typography > Menus ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'typography_menus', array(
	'title'       => esc_html__( 'Menus', 'authentic' ),
	'panel'       => 'typography',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_menus',
	'label'       => esc_html__( 'Menu Font', 'authentic' ),
	'section'     => 'typography_menus',
	'default'     => array(
		'font-family'    => $font_family_headings,
		'subsets'        => array( 'latin-ext' ),
		'variant'        => '600',
		'font-size'      => '13px',
		'letter-spacing' => '0.2px',
		'text-transform' => 'uppercase',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.navbar-nav > li > a, .mega-menu > .sub-menu > li > a, .widget_archive li, .widget_categories li, .widget_meta li a, .widget_nav_menu .menu > li > a, .widget_pages .page_item a, .woocommerce.widget_product_categories li, .woocommerce .widget_layered_nav li, .woocommerce .woocommerce-MyAccount-navigation-link a',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_submenus',
	'label'       => esc_html__( 'Submenu Font', 'authentic' ),
	'section'     => 'typography_menus',
	'default'     => array(
		'font-family'    => $font_family_headings,
		'variant'        => 'regular',
		'subsets'        => array( 'latin-ext' ),
		'font-size'      => '13px',
		'letter-spacing' => '-0.2px',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.topbar .navbar-nav > li > a, .nav .sub-menu a, .widget_categories .children li a, .widget_nav_menu .sub-menu a, .widget_product_categories .children li a',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Typography > Post Content ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'typography_post_content', array(
	'title'       => esc_html__( 'Post Content', 'authentic' ),
	'panel'       => 'typography',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_post_lead',
	'label'       => esc_html__( 'Lead', 'authentic' ),
	'section'     => 'typography_post_content',
	'default'     => array(
		'font-family'    => $font_family_headings,
		'variant'        => '700',
		'subsets'        => array( 'latin-ext' ),
		'font-size'      => '2rem',
		'letter-spacing' => '-.1rem',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.content .lead',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_post_dropcap',
	'label'       => esc_html__( 'Drop Cap', 'authentic' ),
	'section'     => 'typography_post_content',
	'default'     => array(
		'font-family'    => $font_family_headings,
		'variant'        => '500',
		'subsets'        => array( 'latin-ext' ),
		'font-size'      => '2.5rem',
		'text-transform' => 'uppercase',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.content .dropcap:first-letter',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_post_blockquote',
	'label'       => esc_html__( 'Blockquote', 'authentic' ),
	'section'     => 'typography_post_content',
	'default'     => array(
		'font-family'    => $font_family_headings,
		'variant'        => '700',
		'subsets'        => array( 'latin-ext' ),
		'font-size'      => '2rem',
		'letter-spacing' => '-.1rem',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.content blockquote',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Typography > Miscellaneous ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'typography_misc', array(
	'title'       => esc_html__( 'Miscellaneous', 'authentic' ),
	'panel'       => 'typography',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_widget_overlay_meta',
	'label'       => esc_html__( 'Posts Widget Number', 'authentic' ),
	'section'     => 'typography_misc',
	'default'     => array(
		'font-family'    => $font_family_headings,
		'subsets'        => array( 'latin-ext' ),
		'variant'        => 'regular',
		'font-size'      => '1.15rem',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.post-number span:first-child',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'typography_search',
	'label'       => esc_html__( 'Search Form', 'authentic' ),
	'section'     => 'typography_misc',
	'default'     => array(
		'font-family'    => $font_family_headings,
		'subsets'        => array( 'latin-ext' ),
		'variant'        => '600',
		'font-size'      => '3rem',
		'letter-spacing' => '-.15rem',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '#search input[type="search"]',
			'suffix'  => '!important',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * [ Layout ]
 * -------------------------------------------------------------------------
 */

Kirki::add_panel( 'layout', array(
	'title'       => esc_html__( 'Layout', 'authentic' ),
	'priority'    => 3,
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Layout > Page Layout ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'layout', array(
	'title'       => esc_html__( 'Page Layout', 'authentic' ),
	'panel'       => 'layout',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'radio-image',
	'settings'    => 'layout',
	'label'       => esc_html__( 'Sidebar', 'authentic' ),
	'section'     => 'layout',
	'default'     => 'layout-sidebar-right',
	'priority'    => 10,
	'choices'     => array(
		'layout-sidebar-left'   => $template_directory_uri . '/images/layout-sidebar-left.png',
		'layout-fullwidth'      => $template_directory_uri . '/images/layout-full.png',
		'layout-sidebar-right'  => $template_directory_uri . '/images/layout-sidebar-right.png',
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'layout_width',
	'label'       => esc_html__( 'Page Width', 'authentic' ),
	'section'     => 'layout',
	'default'     => '1140px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.site-content .container',
			'property' => 'width',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'layout_sidebar_width',
	'label'       => esc_html__( 'Sidebar Width', 'authentic' ),
	'section'     => 'layout',
	'default'     => '300px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.layout-sidebar .site-content .content-area',
			'property' => 'flex-basis',
			'value_pattern' => 'calc(100% - 40px - $)',
			'media_query' => '@media ( min-width: 992px )',
			),
		array(
			'element'  => '.layout-sidebar .site-content .content-area',
			'property' => 'max-width',
			'value_pattern' => 'calc(100% - 40px - $)',
			'media_query' => '@media ( min-width: 992px )',
			),
		array(
			'element'  => '.site-content .sidebar-area',
			'property' => 'flex-basis',
			'value_pattern' => 'calc(40px + $)',
			'media_query' => '@media ( min-width: 992px )',
			),
		array(
			'element'  => '.site-content .sidebar-area',
			'property' => 'max-width',
			'value_pattern' => 'calc(40px + $)',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Layout > Top Bar ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'topbar', array(
	'title'       => esc_html__( 'Top Bar', 'authentic' ),
	'panel'       => 'layout',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'topbar',
	'label'       => esc_html__( 'Top Bar', 'authentic' ),
	'section'     => 'topbar',
	'default'     => true,
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Layout > Top Bar > Layout ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'topbar_collapsible_layout',
	'section'     => 'topbar',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Layout', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'topbar_container',
	'label'       => esc_html__( 'Container', 'authentic' ),
	'section'     => 'topbar',
	'default'     => 'container',
	'priority'    => 10,
	'choices'     => array(
		'container'    => esc_html__( 'Boxed', 'authentic' ),
		'navbar-fluid' => esc_html__( 'Fullwidth', 'authentic' ),
		),
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'topbar_width',
	'label'       => esc_html__( 'Width', 'authentic' ),
	'section'     => 'topbar',
	'default'     => '1140px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.topbar .container',
			'property' => 'width',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'topbar_height',
	'label'       => esc_html__( 'Height', 'authentic' ),
	'section'     => 'topbar',
	'default'     => '40px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.topbar .navbar',
			'property' => 'height',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Layout > Top Bar > Left Column ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'topbar_collapsible_content_left',
	'section'     => 'topbar',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Left Column', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'topbar_content_left_select',
	'label'       => esc_html__( 'Type', 'authentic' ),
	'section'     => 'topbar',
	'default'     => 'menu',
	'priority'    => 10,
	'choices'     => csco_get_header_content_select( array( 'menu', 'search', 'social', 'cart', 'html', 'none' ) ),
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'topbar_content_left_menu',
	'label'       => esc_html__( 'Menu', 'authentic' ),
	'section'     => 'topbar',
	'default'     => $default_menu,
	'priority'    => 10,
	'choices'     => $menus,
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'topbar_content_left_select',
			'operator' => '==',
			'value'    => 'menu',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'textarea',
	'settings'    => 'topbar_content_left_html',
	'label'       => esc_html__( 'HTML', 'authentic' ),
	'section'     => 'topbar',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'topbar_content_left_select',
			'operator' => '==',
			'value'    => 'html',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'topbar_content_left_social_accounts_labels',
	'label'       => esc_html__( 'Labels', 'authentic' ),
	'section'     => 'topbar',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'topbar_content_left_select',
			'operator' => '==',
			'value'    => 'social',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'topbar_content_left_social_accounts_titles',
	'label'       => esc_html__( 'Titles', 'authentic' ),
	'section'     => 'topbar',
	'default'     => false,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'topbar_content_left_select',
			'operator' => '==',
			'value'    => 'social',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'topbar_content_left_social_accounts_counts',
	'label'       => esc_html__( 'Counts', 'authentic' ),
	'section'     => 'topbar',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'topbar_content_left_select',
			'operator' => '==',
			'value'    => 'social',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'number',
	'settings'    => 'topbar_content_left_social_accounts_limit',
	'label'       => esc_html__( 'Limit', 'authentic' ),
	'description' => esc_html__( 'Number of social accounts.', 'authentic' ),
	'section'     => 'topbar',
	'default'     => 3,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'topbar_content_left_select',
			'operator' => '==',
			'value'    => 'social',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Layout > Top Bar > Right Column ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'topbar_collapsible_content_right',
	'section'     => 'topbar',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Right Column', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'topbar_content_right_select',
	'label'       => esc_html__( 'Type', 'authentic' ),
	'section'     => 'topbar',
	'default'     => 'social',
	'priority'    => 10,
	'choices'     => csco_get_header_content_select( array( 'menu', 'search', 'social', 'cart', 'html', 'none' ) ),
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'topbar_content_right_menu',
	'label'       => esc_html__( 'Menu', 'authentic' ),
	'section'     => 'topbar',
	'default'     => $default_menu,
	'priority'    => 10,
	'choices'     => $menus,
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'topbar_content_right_select',
			'operator' => '==',
			'value'    => 'menu',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'textarea',
	'settings'    => 'topbar_content_right_html',
	'label'       => esc_html__( 'HTML', 'authentic' ),
	'section'     => 'topbar',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'topbar_content_right_select',
			'operator' => '==',
			'value'    => 'html',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'topbar_content_right_social_accounts_labels',
	'label'       => esc_html__( 'Labels', 'authentic' ),
	'section'     => 'topbar',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'topbar_content_right_select',
			'operator' => '==',
			'value'    => 'social',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'topbar_content_right_social_accounts_titles',
	'label'       => esc_html__( 'Titles', 'authentic' ),
	'section'     => 'topbar',
	'default'     => false,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'topbar_content_right_select',
			'operator' => '==',
			'value'    => 'social',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'topbar_content_right_social_accounts_counts',
	'label'       => esc_html__( 'Counts', 'authentic' ),
	'section'     => 'topbar',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'topbar_content_right_select',
			'operator' => '==',
			'value'    => 'social',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'number',
	'settings'    => 'topbar_content_right_social_accounts_limit',
	'label'       => esc_html__( 'Limit', 'authentic' ),
	'description' => esc_html__( 'Number of social accounts.', 'authentic' ),
	'section'     => 'topbar',
	'default'     => 3,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'topbar',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'topbar_content_right_select',
			'operator' => '==',
			'value'    => 'social',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Layout > Header ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'header', array(
	'title'       => esc_html__( 'Header', 'authentic' ),
	'panel'       => 'layout',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'header',
	'label'       => esc_html__( 'Header', 'authentic' ),
	'section'     => 'header',
	'default'     => true,
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Layout > Header > Layout ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'header_collapsible_general',
	'section'     => 'header',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'General', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'radio-image',
	'settings'    => 'header_layout',
	'label'       => esc_html__( 'Layout', 'authentic' ),
	'section'     => 'header',
	'default'     => 'center',
	'priority'    => 10,
	'choices'     => array(
		'center' => $template_directory_uri . '/images/header-center.png',
		'left'   => $template_directory_uri . '/images/header-left.png',
		'logo'   => $template_directory_uri . '/images/header-logo.png',
		),
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'header_container',
	'label'       => esc_html__( 'Container', 'authentic' ),
	'section'     => 'header',
	'default'     => 'container',
	'priority'    => 10,
	'choices'     => array(
		'container'       => esc_html__( 'Boxed', 'authentic' ),
		'container-fluid' => esc_html__( 'Fullwidth', 'authentic' ),
		),
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'header_width',
	'label'       => esc_html__( 'Width', 'authentic' ),
	'section'     => 'header',
	'default'     => '1140px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.header .container',
			'property' => 'width',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'header_height',
	'label'       => esc_html__( 'Height', 'authentic' ),
	'section'     => 'header',
	'default'     => '100px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.header-col',
			'property' => 'height',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Layout > Header > Logo ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'header_collapsible_logo',
	'section'     => 'header',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Logo', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'header_logo_select',
	'label'       => esc_html__( 'Type', 'authentic' ),
	'section'     => 'header',
	'default'     => 'text',
	'priority'    => 10,
	'choices'     => array(
		'image'     => esc_html__( 'Image', 'authentic' ),
		'text'      => esc_html__( 'Text', 'authentic' ),
		),
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'image',
	'settings'    => 'header_logo_default_url',
	'label'       => esc_html__( 'Default', 'authentic' ),
	'section'     => 'header',
	'default'     => $template_directory_uri . '/images/logo-dark.png',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_logo_select',
			'operator' => '==',
			'value'    => 'image',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'image',
	'settings'    => 'header_logo_overlay_url',
	'label'       => esc_html__( 'Overlay', 'authentic' ),
	'section'     => 'header',
	'default'     => $template_directory_uri . '/images/logo-light.png',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_logo_select',
			'operator' => '==',
			'value'    => 'image',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'header_logo_width',
	'label'       => esc_html__( 'Width', 'authentic' ),
	'description' => esc_html__( 'Input logo width in pixels. Please note, that the size of the image must be 2x to look sharp on Retina screens.', 'authentic' ),
	'section'     => 'header',
	'default'     => '200px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.header .logo-image',
			'property' => 'width',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_logo_select',
			'operator' => '==',
			'value'    => 'image',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'header_logo_text',
	'label'       => esc_html__( 'Text', 'authentic' ),
	'section'     => 'header',
	'default'     => get_bloginfo( 'name' ),
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_logo_select',
			'operator' => '==',
			'value'    => 'text',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'header_logo_font',
	'label'       => esc_html__( 'Font', 'authentic' ),
	'section'     => 'header',
	'default'     => array(
		'font-family'    => $font_family_headings,
		'variant'        => '600',
		'subsets'        => array( 'latin-ext' ),
		'font-size'      => '2.5rem',
		'letter-spacing' => '-0.1rem',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.header .site-title',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_logo_select',
			'operator' => '==',
			'value'    => 'text',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Layout > Header > Description ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'header_collapsible_description',
	'section'     => 'header',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Site Description', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'header_description_text',
	'label'       => esc_html__( 'Text', 'authentic' ),
	'section'     => 'header',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'header_description_font',
	'label'       => esc_html__( 'Font', 'authentic' ),
	'section'     => 'header',
	'default'     => array(
		'font-family'    => $font_family_headings,
		'variant'        => '300',
		'subsets'        => array( 'latin-ext' ),
		'font-size'      => '14px',
		'letter-spacing' => '-.2px',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.header .site-description',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Layout > Header > Left Column ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'header_collapsible_content_left',
	'section'     => 'header',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Left Column', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_layout',
			'operator' => '==',
			'value'    => 'center',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'header_content_left_select',
	'label'       => esc_html__( 'Type', 'authentic' ),
	'section'     => 'header',
	'default'     => 'button',
	'priority'    => 10,
	'choices'     => csco_get_header_content_select( array( 'menu', 'toggle', 'search', 'social', 'button', 'cart', 'html', 'none' ) ),
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_layout',
			'operator' => '==',
			'value'    => 'center',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'header_content_left_button_text',
	'label'       => esc_html__( 'Text', 'authentic' ),
	'section'     => 'header',
	'default'     => esc_html__( 'Subscribe', 'authentic' ),
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_left_select',
			'operator' => '==',
			'value'    => 'button',
			),
		array(
			'setting'  => 'header_layout',
			'operator' => '==',
			'value'    => 'center',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'header_content_left_button_link',
	'label'       => esc_html__( 'Link', 'authentic' ),
	'section'     => 'header',
	'default'     => $site_url,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_left_select',
			'operator' => '==',
			'value'    => 'button',
			),
		array(
			'setting'  => 'header_layout',
			'operator' => '==',
			'value'    => 'center',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'header_content_left_button_icon',
	'label'       => esc_html__( 'Icon', 'authentic' ),
	'section'     => 'header',
	'default'     => 'mail',
	'priority'    => 10,
	'choices'     => $icons,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_left_select',
			'operator' => '==',
			'value'    => 'button',
			),
		array(
			'setting'  => 'header_layout',
			'operator' => '==',
			'value'    => 'center',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'header_content_left_menu',
	'label'       => esc_html__( 'Menu', 'authentic' ),
	'section'     => 'header',
	'default'     => $default_menu,
	'priority'    => 10,
	'choices'     => $menus,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_left_select',
			'operator' => '==',
			'value'    => 'menu',
			),
		array(
			'setting'  => 'header_layout',
			'operator' => '==',
			'value'    => 'center',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'textarea',
	'settings'    => 'header_content_left_html',
	'label'       => esc_html__( 'HTML', 'authentic' ),
	'section'     => 'header',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_left_select',
			'operator' => '==',
			'value'    => 'html',
			),
		array(
			'setting'  => 'header_layout',
			'operator' => '==',
			'value'    => 'center',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'header_content_left_social_accounts_labels',
	'label'       => esc_html__( 'Labels', 'authentic' ),
	'section'     => 'header',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_left_select',
			'operator' => '==',
			'value'    => 'social',
			),
		array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'center',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'header_content_left_social_accounts_titles',
	'label'       => esc_html__( 'Titles', 'authentic' ),
	'section'     => 'header',
	'default'     => false,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_left_select',
			'operator' => '==',
			'value'    => 'social',
			),
		array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'center',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'header_content_left_social_accounts_counts',
	'label'       => esc_html__( 'Counts', 'authentic' ),
	'section'     => 'header',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_left_select',
			'operator' => '==',
			'value'    => 'social',
			),
		array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'center',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'number',
	'settings'    => 'header_content_left_social_accounts_limit',
	'label'       => esc_html__( 'Limit', 'authentic' ),
	'description' => esc_html__( 'Number of social accounts.', 'authentic' ),
	'section'     => 'header',
	'default'     => 3,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_left_select',
			'operator' => '==',
			'value'    => 'social',
			),
		array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'center',
				),
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Layout > Header > Right Column ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'header_collapsible_content_right',
	'section'     => 'header',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Right Column', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'center',
				),
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'left',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'header_content_right_select',
	'label'       => esc_html__( 'Type', 'authentic' ),
	'section'     => 'header',
	'default'     => 'search',
	'priority'    => 10,
	'choices'     => csco_get_header_content_select( array( 'menu', 'search', 'social', 'button', 'cart', 'html', 'none' ) ),
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'center',
				),
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'left',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'header_content_right_button_text',
	'label'       => esc_html__( 'Text', 'authentic' ),
	'section'     => 'header',
	'default'     => esc_html__( 'Subscribe', 'authentic' ),
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_right_select',
			'operator' => '==',
			'value'    => 'button',
			),
		array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'center',
				),
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'left',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'header_content_right_button_link',
	'label'       => esc_html__( 'Link', 'authentic' ),
	'section'     => 'header',
	'default'     => $site_url,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_right_select',
			'operator' => '==',
			'value'    => 'button',
			),
		array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'center',
				),
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'left',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'header_content_right_button_icon',
	'label'       => esc_html__( 'Icon', 'authentic' ),
	'section'     => 'header',
	'default'     => 'mail',
	'priority'    => 10,
	'choices'     => $icons,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_right_select',
			'operator' => '==',
			'value'    => 'button',
			),
		array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'center',
				),
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'left',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'header_content_right_menu',
	'label'       => esc_html__( 'Menu', 'authentic' ),
	'section'     => 'header',
	'default'     => $default_menu,
	'priority'    => 10,
	'choices'     => $menus,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_right_select',
			'operator' => '==',
			'value'    => 'menu',
			),
		array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'center',
				),
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'left',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'textarea',
	'settings'    => 'header_content_right_html',
	'label'       => esc_html__( 'HTML', 'authentic' ),
	'section'     => 'header',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_right_select',
			'operator' => '==',
			'value'    => 'html',
			),
		array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'center',
				),
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'left',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'header_content_right_social_accounts_labels',
	'label'       => esc_html__( 'Labels', 'authentic' ),
	'section'     => 'header',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_right_select',
			'operator' => '==',
			'value'    => 'social',
			),
		array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'center',
				),
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'left',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'header_content_right_social_accounts_titles',
	'label'       => esc_html__( 'Titles', 'authentic' ),
	'section'     => 'header',
	'default'     => false,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_right_select',
			'operator' => '==',
			'value'    => 'social',
			),
		array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'center',
				),
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'left',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'header_content_right_social_accounts_counts',
	'label'       => esc_html__( 'Counts', 'authentic' ),
	'section'     => 'header',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_right_select',
			'operator' => '==',
			'value'    => 'social',
			),
		array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'center',
				),
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'left',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'number',
	'settings'    => 'header_content_right_social_accounts_limit',
	'label'       => esc_html__( 'Limit', 'authentic' ),
	'description' => esc_html__( 'Number of social accounts.', 'authentic' ),
	'section'     => 'header',
	'default'     => 3,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'header',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'header_content_right_select',
			'operator' => '==',
			'value'    => 'social',
			),
		array(
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'center',
				),
			array(
				'setting'  => 'header_layout',
				'operator' => '==',
				'value'    => 'left',
				),
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Layout > Navigation Bar ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'navbar', array(
	'title'       => esc_html__( 'Navigation Bar', 'authentic' ),
	'panel'       => 'layout',
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Layout > Navigation Bar > Layout ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'navbar_collapsible_layout',
	'section'     => 'navbar',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Layout', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'navbar_container',
	'label'       => esc_html__( 'Container', 'authentic' ),
	'section'     => 'navbar',
	'default'     => 'container',
	'priority'    => 10,
	'choices'     => array(
		'container'       => esc_html__( 'Boxed', 'authentic' ),
		'container-fluid' => esc_html__( 'Fullwidth', 'authentic' ),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'navbar_width',
	'label'       => esc_html__( 'Width', 'authentic' ),
	'section'     => 'navbar',
	'default'     => '1140px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.navbar-primary .container',
			'property' => 'width',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'navbar_height',
	'label'       => esc_html__( 'Height', 'authentic' ),
	'section'     => 'navbar',
	'default'     => '50px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.navbar-primary .navbar',
			'property' => 'height',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'navbar_alignment',
	'label'       => esc_html__( 'Alignment', 'authentic' ),
	'section'     => 'navbar',
	'default'     => 'center',
	'priority'    => 10,
	'choices'     => array(
		'center'    => esc_html__( 'Center', 'authentic' ),
		'left'      => esc_html__( 'Left', 'authentic' ),
		'right'     => esc_html__( 'Right', 'authentic' ),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'navbar_toggle',
	'label'       => esc_html__( 'Off-Canvas Toggle', 'authentic' ),
	'section'     => 'navbar',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'navbar_search',
	'label'       => esc_html__( 'Search', 'authentic' ),
	'section'     => 'navbar',
	'default'     => false,
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Layout > Navigation Bar > Logo ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'navbar_collapsible_logo',
	'section'     => 'navbar',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Logo', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'navbar_logo_select',
	'label'       => esc_html__( 'Type', 'authentic' ),
	'section'     => 'navbar',
	'default'     => 'text',
	'priority'    => 10,
	'choices'     => array(
		'image'     => esc_html__( 'Image', 'authentic' ),
		'text'      => esc_html__( 'Text', 'authentic' ),
		'none'      => esc_html__( 'None', 'authentic' ),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'image',
	'settings'    => 'navbar_logo_default_url',
	'label'       => esc_html__( 'Default', 'authentic' ),
	'section'     => 'navbar',
	'default'     => $template_directory_uri . '/images/logo-dark.png',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'navbar_logo_select',
			'operator' => '==',
			'value'    => 'image',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'image',
	'settings'    => 'navbar_logo_overlay_url',
	'label'       => esc_html__( 'Overlay', 'authentic' ),
	'section'     => 'navbar',
	'default'     => $template_directory_uri . '/images/logo-light.png',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'navbar_logo_select',
			'operator' => '==',
			'value'    => 'image',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'navbar_logo_height',
	'label'       => esc_html__( 'Height', 'authentic' ),
	'description' => esc_html__( 'Input logo height in pixels. Please note, that the size of the image must be 2x to look sharp on Retina screens. Max height is 60px.', 'authentic' ),
	'section'     => 'navbar',
	'default'     => '22px',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.navbar-primary .navbar-brand > img',
			'property' => 'height',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'navbar_logo_select',
			'operator' => '==',
			'value'    => 'image',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'navbar_logo_text',
	'label'       => esc_html__( 'Text', 'authentic' ),
	'section'     => 'navbar',
	'default'     => get_bloginfo( 'name' ),
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'navbar_logo_select',
			'operator' => '==',
			'value'    => 'text',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'navbar_logo_font',
	'label'       => esc_html__( 'Font', 'authentic' ),
	'section'     => 'navbar',
	'default'     => array(
		'font-family'    => $font_family_headings,
		'variant'        => '600',
		'subsets'        => array( 'latin-ext' ),
		'font-size'      => '22px',
		'letter-spacing' => '-1px',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.navbar-primary .navbar-brand',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'navbar_logo_select',
			'operator' => '==',
			'value'    => 'text',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Layout > Navigation Bar > Social Accounts ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'navbar_collapsible_social_icons',
	'section'     => 'navbar',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Social Icons', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'navbar_social',
	'label'       => esc_html__( 'Social Icons', 'authentic' ),
	'section'     => 'navbar',
	'default'     => false,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'navbar_social_accounts_labels',
	'label'       => esc_html__( 'Labels', 'authentic' ),
	'section'     => 'navbar',
	'default'     => false,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'navbar_social',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'navbar_social_accounts_titles',
	'label'       => esc_html__( 'Titles', 'authentic' ),
	'section'     => 'navbar',
	'default'     => false,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'navbar_social',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'navbar_social_accounts_counts',
	'label'       => esc_html__( 'Counts', 'authentic' ),
	'section'     => 'navbar',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'navbar_social',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'number',
	'settings'    => 'navbar_social_accounts_limit',
	'label'       => esc_html__( 'Limit', 'authentic' ),
	'description' => esc_html__( 'Number of social accounts.', 'authentic' ),
	'section'     => 'navbar',
	'default'     => 3,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'navbar_social',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Layout > Off-Canvas ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'offcanvas', array(
	'title'       => esc_html__( 'Off-Canvas Area', 'authentic' ),
	'panel'       => 'layout',
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Layout > Off-Canvas Area > Logo ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'offcanvas_collapsible_topbar',
	'section'     => 'offcanvas',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Top Bar', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'offcanvas_topbar_height',
	'label'       => esc_html__( 'Height', 'authentic' ),
	'section'     => 'offcanvas',
	'default'     => '50px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.offcanvas',
			'property' => 'top',
			),
		array(
			'element'  => '.navbar-offcanvas',
			'property' => 'height',
			),
		array(
			'element'  => '.admin-bar .offcanvas',
			'property' => 'top',
			'media_query' => '@media ( min-width: 601px )',
			'value_pattern' => 'calc($ + 46px)',
			),
		array(
			'element'  => '.admin-bar .offcanvas',
			'property' => 'top',
			'media_query' => '@media ( min-width: 783px )',
			'value_pattern' => 'calc($ + 32px)',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'offcanvas_collapsible_logo',
	'section'     => 'offcanvas',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Logo', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'navbar_height',
	'label'       => esc_html__( 'Height', 'authentic' ),
	'section'     => 'navbar',
	'default'     => '50px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.navbar-primary .navbar',
			'property' => 'height',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'offcanvas_logo_select',
	'label'       => esc_html__( 'Type', 'authentic' ),
	'section'     => 'offcanvas',
	'default'     => 'text',
	'priority'    => 10,
	'choices'     => array(
		'image'     => esc_html__( 'Image', 'authentic' ),
		'text'      => esc_html__( 'Text', 'authentic' ),
		'none'      => esc_html__( 'None', 'authentic' ),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'image',
	'settings'    => 'offcanvas_logo_url',
	'label'       => esc_html__( 'Image', 'authentic' ),
	'section'     => 'offcanvas',
	'default'     => $template_directory_uri . '/images/logo-dark.png',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'offcanvas_logo_select',
			'operator' => '==',
			'value'    => 'image',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'offcanvas_logo_height',
	'label'       => esc_html__( 'Height', 'authentic' ),
	'description' => esc_html__( 'Input logo height in pixels. Please note, that the size of the image must be 2x to look sharp on Retina screens. Max height is 60px.', 'authentic' ),
	'section'     => 'offcanvas',
	'default'     => '22px',
	'priority'    => 10,
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => '.offcanvas-header .navbar .navbar-brand > img',
			'property' => 'height',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'offcanvas_logo_select',
			'operator' => '==',
			'value'    => 'image',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'offcanvas_logo_text',
	'label'       => esc_html__( 'Text', 'authentic' ),
	'section'     => 'offcanvas',
	'default'     => get_bloginfo( 'name' ),
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'offcanvas_logo_select',
			'operator' => '==',
			'value'    => 'text',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'offcanvas_logo_font',
	'label'       => esc_html__( 'Font', 'authentic' ),
	'section'     => 'offcanvas',
	'default'     => array(
		'font-family'    => $font_family_headings,
		'variant'        => '600',
		'subsets'        => array( 'latin-ext' ),
		'font-size'      => '22px',
		'letter-spacing' => '-1px',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.offcanvas-header .navbar .navbar-brand',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'offcanvas_logo_select',
			'operator' => '==',
			'value'    => 'text',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Layout > Page Header ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'page_header', array(
	'title'       => esc_html__( 'Page Header', 'authentic' ),
	'panel'       => 'layout',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'page_header',
	'label'       => esc_html__( 'Type', 'authentic' ),
	'section'     => 'page_header',
	'default'     => 'simple',
	'priority'    => 10,
	'choices'     => array(
		'none'      => esc_html__( 'None', 'authentic' ),
		'simple'    => esc_html__( 'Simple', 'authentic' ),
		'small'     => esc_html__( 'Small', 'authentic' ),
		'wide'      => esc_html__( 'Wide', 'authentic' ),
		'large'     => esc_html__( 'Large', 'authentic' ),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Layout > Post Archive ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'archive', array(
	'title'       => esc_html__( 'Post Archive', 'authentic' ),
	'panel'       => 'layout',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'radio-image',
	'settings'    => 'layout_archive_type',
	'label'       => esc_html__( 'Type', 'authentic' ),
	'section'     => 'archive',
	'default'     => 'standard',
	'priority'    => 10,
	'choices'     => array(
		'standard'  => $template_directory_uri . '/images/layout-full.png',
		'list'      => $template_directory_uri . '/images/layout-list.png',
		'grid'      => $template_directory_uri . '/images/layout-grid.png',
		'masonry'   => $template_directory_uri . '/images/layout-masonry.png',
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'layout_columns',
	'label'       => esc_html__( 'Columns', 'authentic' ),
	'section'     => 'archive',
	'default'     => 2,
	'priority'    => 10,
	'choices'     => array(
		'2'         => '2',
		'3'         => '3',
		),
	'active_callback' => array(
		array(
			array(
				'setting'  => 'layout_archive_type',
				'operator' => '==',
				'value'    => 'grid',
				),
			array(
				'setting'  => 'layout_archive_type',
				'operator' => '==',
				'value'    => 'masonry',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'layout_first_post',
	'label'       => esc_html__( 'Display first post as standard', 'authentic' ),
	'section'     => 'archive',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			array(
				'setting'  => 'layout_archive_type',
				'operator' => '!==',
				'value'    => 'standard',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'layout_summary',
	'label'       => esc_html__( 'Display post summary', 'authentic' ),
	'section'     => 'archive',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'layout_summary_type',
	'label'       => esc_html__( 'Standard Post Summary Type', 'authentic' ),
	'section'     => 'archive',
	'default'     => 'excerpt',
	'priority'    => 10,
	'choices'     => array(
		'excerpt'   => esc_html__( 'Excerpt', 'authentic' ),
		'content'   => esc_html__( 'Full', 'authentic' ),
		),
	'active_callback' => array(
		array(
			array(
				'setting'  => 'layout_archive_type',
				'operator' => '==',
				'value'    => 'standard',
				),
			array(
				'setting'  => 'layout_first_post',
				'operator' => '==',
				'value'    => true,
				),
			),
		array(
			array(
				'setting'  => 'layout_summary',
				'operator' => '==',
				'value'    => true,
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'number',
	'settings'    => 'layout_excerpt_length',
	'label'       => esc_html__( 'Summary Length', 'authentic' ),
	'description' => esc_html__( 'Number of words in excerpt.', 'authentic' ),
	'section'     => 'archive',
	'priority'    => 10,
	'default'     => 30,
	'active_callback' => array(
		array(
			array(
				'setting'  => 'layout_summary',
				'operator' => '==',
				'value'    => true,
				),
			),
		array(
			array(
				'setting'  => 'layout_archive_type',
				'operator' => '!==',
				'value'    => 'standard',
				),
			array(
				'setting'  => 'layout_summary_type',
				'operator' => '==',
				'value'    => 'excerpt',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'layout_more_button',
	'label'       => esc_html__( 'Display more button', 'authentic' ),
	'section'     => 'archive',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'layout_thumbnail_width',
	'label'       => esc_html__( 'Image Width', 'authentic' ),
	'section'     => 'archive',
	'default'     => '4',
	'choices'     => array(
		'4'         => '1/3',
		'6'         => '1/2',
		'8'         => '2/3',
		),
	'priority'    => 10,
	'active_callback' => array(
		array(
			array(
				'setting'  => 'layout_archive_type',
				'operator' => '==',
				'value'    => 'list',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'layout_thumbnail_size',
	'label'       => esc_html__( 'Image Size', 'authentic' ),
	'section'     => 'archive',
	'default'     => 'thumbnail',
	'priority'    => 10,
	'choices'     => $registered_image_sizes,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'layout_pagination_type',
	'label'       => esc_html__( 'Pagination', 'authentic' ),
	'section'     => 'archive',
	'default'     => 'standard',
	'priority'    => 10,
	'choices'     => array(
		'standard'  => esc_html__( 'Standard', 'authentic' ),
		'ajax'      => esc_html__( 'Load More', 'authentic' ),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'layout_infinite_load',
	'label'       => esc_html__( 'Infinite Load', 'authentic' ),
	'section'     => 'archive',
	'default'     => false,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'layout_pagination_type',
			'operator' => '==',
			'value'    => 'ajax',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'layout_widgets',
	'label'       => esc_html__( 'Display widgets in archive', 'authentic' ),
	'section'     => 'archive',
	'default'     => false,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'number',
	'settings'    => 'layout_widgets_after',
	'label'       => esc_html__( 'Display widgets after N-th post', 'authentic' ),
	'section'     => 'archive',
	'default'     => 3,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'layout_widgets',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'layout_widgets_repeat',
	'label'       => esc_html__( 'Repeat widgets', 'authentic' ),
	'section'     => 'archive',
	'default'     => false,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'layout_widgets',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Layout > Footer ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'footer', array(
	'title'       => esc_html__( 'Footer', 'authentic' ),
	'panel'       => 'layout',
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Layout > Footer > Logo  ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'footer_collapsible_logo',
	'section'     => 'footer',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Logo', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'footer_logo_select',
	'label'       => esc_html__( 'Type', 'authentic' ),
	'section'     => 'footer',
	'default'     => 'text',
	'priority'    => 10,
	'choices'     => array(
		'image'     => esc_html__( 'Image', 'authentic' ),
		'text'      => esc_html__( 'Text', 'authentic' ),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'image',
	'settings'    => 'footer_logo_url',
	'label'       => esc_html__( 'Image', 'authentic' ),
	'section'     => 'footer',
	'default'     => $template_directory_uri . '/images/logo-light.png',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'footer_logo_select',
			'operator' => '==',
			'value'    => 'image',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'footer_logo_width',
	'label'       => esc_html__( 'Width', 'authentic' ),
	'description' => esc_html__( 'Input logo width in pixels. Please note, that the size of the image must be 2x to look sharp on Retina screens.', 'authentic' ),
	'section'     => 'footer',
	'default'     => '200px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.site-footer .logo-image',
			'property' => 'width',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'footer_logo_select',
			'operator' => '==',
			'value'    => 'image',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'footer_logo_text',
	'label'       => esc_html__( 'Text', 'authentic' ),
	'section'     => 'footer',
	'default'     => get_bloginfo( 'name' ),
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'footer_logo_select',
			'operator' => '==',
			'value'    => 'text',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'footer_logo_font',
	'label'       => esc_html__( 'Font', 'authentic' ),
	'section'     => 'footer',
	'default'     => array(
		'font-family'    => $font_family_headings,
		'variant'        => '600',
		'subsets'        => array( 'latin-ext' ),
		'font-size'      => '1.75rem',
		'letter-spacing' => '-0.05rem',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.site-footer .site-title',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'footer_logo_select',
			'operator' => '==',
			'value'    => 'text',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'footer_text',
	'label'       => esc_html__( 'Footer Text', 'authentic' ),
	'section'     => 'footer',
	'default'     => get_bloginfo( 'description' ),
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Layout > Footer > Subscribe  ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'footer_collapsible_subscribe',
	'section'     => 'footer',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Subscribe', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'footer_subscribe_title',
	'label'       => esc_html__( 'Title', 'authentic' ),
	'section'     => 'footer',
	'default'     => esc_html__( 'Subscribe', 'authentic' ),
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'footer_subscribe_message',
	'label'       => esc_html__( 'Message', 'authentic' ),
	'section'     => 'footer',
	'default'     => esc_html__( 'Subscribe now to our newsletter', 'authentic' ),
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Layout > Footer > Instagram  ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'footer_collapsible_instagram',
	'section'     => 'footer',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Instagram', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'footer_instagram_username',
	'label'       => esc_html__( 'Instagram Username', 'authentic' ),
	'section'     => 'footer',
	'default'     => '',
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Layout > Footer > Arrangement  ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'footer_collapsible_components',
	'section'     => 'footer',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Arrangement', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'sortable',
	'settings'    => 'footer_components',
	'label'       => esc_html__( 'Components', 'authentic' ),
	'section'     => 'footer',
	'default'     => array( 'instagram', 'subscribe', 'widgets', 'info' ),
	'choices'     => array(
		'instagram' => esc_html__( 'Instagram', 'authentic' ),
		'subscribe' => esc_html__( 'Subscribe', 'authentic' ),
		'widgets' 	=> esc_html__( 'Widgets', 'authentic' ),
		'info' 			=> esc_html__( 'Logo &amp; Navbar', 'authentic' ),
		),
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Layout > Post Meta ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'post_meta', array(
	'title'       => esc_html__( 'Post Meta', 'authentic' ),
	'priority'    => 10,
	'panel'       => 'layout',
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'multicheck',
	'settings'    => 'post_meta',
	'label'       => esc_attr__( 'Post Meta', 'authentic' ),
	'section'     => 'post_meta',
	'default'     => array( 'date', 'category', 'comments', 'reading_time', 'views', 'author' ),
	'priority'    => 10,
	'choices'     => array(
		'date' 				 => esc_html__( 'Date', 'authentic' ),
		'category' 		 => esc_html__( 'Category', 'authentic' ),
		'comments' 		 => esc_html__( 'Comments', 'authentic' ),
		'reading_time' => esc_html__( 'Reading Time', 'authentic' ),
		'views' 			 => esc_html__( 'Views', 'authentic' ),
		'author' 			 => esc_html__( 'Author', 'authentic' ),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Layout > Effects ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'effects', array(
	'title'       => esc_html__( 'Effects', 'authentic' ),
	'priority'    => 10,
	'panel'       => 'layout',
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'effects_parallax',
	'label'       => esc_html__( 'Parallax', 'authentic' ),
	'section'     => 'effects',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'effects_lazy_load',
	'label'       => esc_html__( 'Posts Lazy Load', 'authentic' ),
	'section'     => 'effects',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'effects_navbar_scroll',
	'label'       => esc_html__( 'Navbar Scroll', 'authentic' ),
	'section'     => 'effects',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'effects_sticky_sidebar',
	'label'       => esc_html__( 'Sticky Sidebar', 'authentic' ),
	'section'     => 'effects',
	'default'     => true,
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Layout > Miscellaneous ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'layout_misc', array(
	'title'       => esc_html__( 'Miscellaneous', 'authentic' ),
	'priority'    => 10,
	'panel'       => 'layout',
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'border_radius',
	'label'       => esc_html__( 'Border Radius', 'authentic' ),
	'section'     => 'layout_misc',
	'default'     => '0',
	'priority'    => 10,
	'transport'   => 'auto',
	'output'    => array(
		array(
			'element'   => '.btn, .scroll-to-top:after, .image-popup:after, .pin-it, .content .dropcap:first-letter, .bsa-horizontal .bsa-link, .bsb-after-post .bsb-link, .bsb-before-post .bsb-link, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button',
			'property'  => 'border-radius',
			),
		array(
			'element'   => '.input-group-btn .btn',
			'property'  => 'border-top-right-radius',
			),
		array(
			'element'   => '.input-group-btn .btn',
			'property'  => 'border-bottom-right-radius',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * [ Homepage ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'home', array(
	'title'       => esc_html__( 'Homepage', 'authentic' ),
	'priority'    => 4,
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Homepage > Page Layout ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'home_layout_collapsible_page_layout',
	'section'     => 'home',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Page Layout', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'home_layout_default',
	'label'       => esc_html__( 'Default Settings', 'authentic' ),
	'description' => esc_html__( 'You may change the default settings in Layout &rarr; ', 'authentic' ) . esc_html__( 'Page Layout', 'authentic' ),
	'section'     => 'home',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'radio-image',
	'settings'    => 'home_layout',
	'label'       => esc_html__( 'Sidebar', 'authentic' ),
	'section'     => 'home',
	'default'     => 'layout-sidebar-right',
	'priority'    => 10,
	'choices'     => array(
		'layout-sidebar-left'   => $template_directory_uri . '/images/layout-sidebar-left.png',
		'layout-fullwidth'      => $template_directory_uri . '/images/layout-full.png',
		'layout-sidebar-right'  => $template_directory_uri . '/images/layout-sidebar-right.png',
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_layout_default',
			'operator' => '==',
			'value'    => false,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'home_layout_width',
	'label'       => esc_html__( 'Page Width', 'authentic' ),
	'section'     => 'home',
	'default'     => '1140px',
	'priority'    => 10,
	'output'      => array(
		array(
			'element'  => '.home .site-content .container',
			'property' => 'width',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_layout_default',
			'operator' => '==',
			'value'    => false,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'home_layout_sidebar_width',
	'label'       => esc_html__( 'Sidebar Width', 'authentic' ),
	'section'     => 'home',
	'default'     => '300px',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_layout_default',
			'operator' => '==',
			'value'    => false,
			),
		array(
			'setting'  => 'home_layout',
			'operator' => '!=',
			'value'    => 'layout-fullwidth',
			),
		),
	'output' => array(
		array(
			'element'  => '.home.layout-sidebar .site-content .content-area',
			'property' => 'flex-basis',
			'value_pattern' => 'calc(100% - 40px - $)',
			'media_query' => '@media ( min-width: 992px )',
			),
		array(
			'element'  => '.home.layout-sidebar .site-content .content-area',
			'property' => 'max-width',
			'value_pattern' => 'calc(100% - 40px - $)',
			'media_query' => '@media ( min-width: 992px )',
			),
		array(
			'element'  => '.home .site-content .sidebar-area',
			'property' => 'flex-basis',
			'value_pattern' => 'calc(40px + $)',
			'media_query' => '@media ( min-width: 992px )',
			),
		array(
			'element'  => '.home .site-content .sidebar-area',
			'property' => 'max-width',
			'value_pattern' => 'calc(40px + $)',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Homepage > Post Slider ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'home_layout_collapsible_slider',
	'section'     => 'home',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Post Slider', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'home_slider',
	'label'       => esc_html__( 'Post Slider', 'authentic' ),
	'section'     => 'home',
	'default'     => false,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_slider_source',
	'label'       => esc_html__( 'Source', 'authentic' ),
	'section'     => 'home',
	'default'     => 'all',
	'priority'    => 10,
	'choices'     => $post_sources,
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'home_slider_source_category_slug',
	'label'       => esc_html__( 'Slug', 'authentic' ),
	'section'     => 'home',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'home_slider_source',
			'operator' => '==',
			'value'    => 'category',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'home_slider_source_tag_slug',
	'label'       => esc_html__( 'Slug', 'authentic' ),
	'section'     => 'home',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'home_slider_source',
			'operator' => '==',
			'value'    => 'tag',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_slider_orderby',
	'label'       => esc_html__( 'Order By', 'authentic' ),
	'section'     => 'home',
	'default'     => 'date',
	'priority'    => 10,
	'choices'     => array(
		'date'      => esc_html__( 'Date', 'authentic' ),
		'views'     => esc_html__( 'Views', 'authentic' ),
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'home_slider_time_frame',
	'label'       => esc_html__( 'Time Frame', 'authentic' ),
	'description' => esc_html__( 'Input period of posts in English, i.e. &laquo;2 months&raquo;, &laquo;14 days&raquo; or even &laquo;1 year&raquo;', 'authentic' ),
	'section'     => 'home',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'home_slider_orderby',
			'operator' => '==',
			'value'    => 'views',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'home_slider_exclude',
	'label'       => esc_html__( 'Exclude featured posts from the main archive', 'authentic' ),
	'section'     => 'home',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_slider_type',
	'label'       => esc_html__( 'Type', 'authentic' ),
	'section'     => 'home',
	'default'     => 'center',
	'priority'    => 10,
	'choices'     => array(
		'center'    => esc_html__( 'Center', 'authentic' ),
		'large'     => esc_html__( 'Large', 'authentic' ),
		'boxed'     => esc_html__( 'Boxed', 'authentic' ),
		'multiple'  => esc_html__( 'Multiple', 'authentic' ),
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_slider_visible',
	'label'       => esc_html__( 'Visible Slides', 'authentic' ),
	'section'     => 'home',
	'default'     => '3',
	'priority'    => 10,
	'choices'     => array(
		'2'  => '2',
		'3'  => '3',
		'4'  => '4',
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'home_slider_type',
			'operator' => '==',
			'value'    => 'multiple',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'number',
	'settings'    => 'home_slider_total',
	'label'       => esc_html__( 'Total Slides', 'authentic' ),
	'section'     => 'home',
	'default'     => '5',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_slider_thumbnail',
	'label'       => esc_html__( 'Image Size', 'authentic' ),
	'section'     => 'home',
	'default'     => 'lg-hor',
	'priority'    => 10,
	'choices'     => $registered_image_sizes,
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'home_slider_parallax',
	'label'       => esc_html__( 'Parallax', 'authentic' ),
	'section'     => 'home',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'home_slider_width',
	'label'       => esc_html__( 'Width', 'authentic' ),
	'section'     => 'home',
	'default'     => '1110px',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		array(
			array(
				'setting'  => 'home_slider_type',
				'operator' => '==',
				'value'    => 'boxed',
				),
			array(
				'setting'  => 'home_slider_type',
				'operator' => '==',
				'value'    => 'center',
				),
			),
		),
	'output' => array(
		array(
			'element'     => '.owl-center article',
			'property'    => 'width',
			'media_query' => '@media ( min-width: 1200px )',
			),
		array(
			'element'     => '.owl-boxed',
			'property'    => 'max-width',
			'media_query' => '@media ( min-width: 1200px )',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'home_slider_height',
	'label'       => esc_html__( 'Height', 'authentic' ),
	'section'     => 'home',
	'default'     => '600px',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'home_slider_type',
			'operator' => '!=',
			'value'    => 'large',
			),
		),
	'output' => array(
		array(
			'element'     => '.owl-featured .post-outer',
			'property'    => 'height',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'home_slider_padding',
	'label'       => esc_html__( 'Padding', 'authentic' ),
	'section'     => 'home',
	'default'     => '30px',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		array(
			array(
				'setting'  => 'home_slider_type',
				'operator' => '==',
				'value'    => 'center',
				),
			array(
				'setting'  => 'home_slider_type',
				'operator' => '==',
				'value'    => 'multiple',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'home_slider_autoplay',
	'label'       => esc_html__( 'Auto Play', 'authentic' ),
	'section'     => 'home',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'number',
	'settings'    => 'home_slider_timeout',
	'label'       => esc_html__( 'Time-Out', 'authentic' ),
	'section'     => 'home',
	'default'     => '3000',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'home_slider_autoplay',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'home_slider_heading',
	'label'       => esc_html__( 'Heading', 'authentic' ),
	'section'     => 'home',
	'default'     => array(
		'font-size'      => '3rem',
		'letter-spacing' => '-.15rem',
		'text-transform' => 'none',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_slider',
			'operator' => '==',
			'value'    => true,
			),
		),
	'output'      => array(
		array(
			'element' => '.owl-featured h2',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Homepage > Post Tiles ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'home_layout_collapsible_tiles',
	'section'     => 'home',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Post Tiles', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'home_tiles',
	'label'       => esc_html__( 'Post Tiles', 'authentic' ),
	'section'     => 'home',
	'default'     => false,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_tiles_source',
	'label'       => esc_html__( 'Source', 'authentic' ),
	'section'     => 'home',
	'default'     => 'all',
	'priority'    => 10,
	'choices'     => $post_sources,
	'active_callback' => array(
		array(
			'setting'  => 'home_tiles',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'home_tiles_source_category_slug',
	'label'       => esc_html__( 'Slug', 'authentic' ),
	'section'     => 'home',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_tiles',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'home_tiles_source',
			'operator' => '==',
			'value'    => 'category',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'home_tiles_source_tag_slug',
	'label'       => esc_html__( 'Slug', 'authentic' ),
	'section'     => 'home',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_tiles',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'home_tiles_source',
			'operator' => '==',
			'value'    => 'tag',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_tiles_orderby',
	'label'       => esc_html__( 'Order By', 'authentic' ),
	'section'     => 'home',
	'default'     => 'date',
	'priority'    => 10,
	'choices'     => array(
		'date'      => esc_html__( 'Date', 'authentic' ),
		'views'     => esc_html__( 'Views', 'authentic' ),
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_tiles',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'home_tiles_time_frame',
	'label'       => esc_html__( 'Time Frame', 'authentic' ),
	'description' => esc_html__( 'Input period of posts in English, i.e. &laquo;2 months&raquo;, &laquo;14 days&raquo; or even &laquo;1 year&raquo;', 'authentic' ),
	'section'     => 'home',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_tiles',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'home_tiles_orderby',
			'operator' => '==',
			'value'    => 'views',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'home_tiles_exclude',
	'label'       => esc_html__( 'Exclude featured posts from the main archive', 'authentic' ),
	'section'     => 'home',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_tiles',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'radio-image',
	'settings'    => 'home_tiles_layout',
	'label'       => esc_html__( 'Layout', 'authentic' ),
	'section'     => 'home',
	'default'     => '1',
	'priority'    => 10,
	'choices'     => array(
		'1'   => $template_directory_uri . '/images/tiles-1.png',
		'2'   => $template_directory_uri . '/images/tiles-2.png',
		'3'   => $template_directory_uri . '/images/tiles-3.png',
		'4'   => $template_directory_uri . '/images/tiles-4.png',
		'5'   => $template_directory_uri . '/images/tiles-5.png',
		'6'   => $template_directory_uri . '/images/tiles-6.png',
		'7'   => $template_directory_uri . '/images/tiles-7.png',
		'8'   => $template_directory_uri . '/images/tiles-8.png',
		'9'   => $template_directory_uri . '/images/tiles-9.png',
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_tiles',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_tiles_container',
	'label'       => esc_html__( 'Container', 'authentic' ),
	'section'     => 'home',
	'default'     => 'container',
	'priority'    => 10,
	'choices'     => array(
		'container'       => esc_html__( 'Boxed', 'authentic' ),
		'container-fluid' => esc_html__( 'Fullwidth', 'authentic' ),
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_tiles',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'home_tiles_width',
	'label'       => esc_html__( 'Width', 'authentic' ),
	'section'     => 'home',
	'default'     => '1140px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.home .section-tiles .container',
			'property' => 'width',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_tiles',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'home_tiles_container',
			'operator' => '==',
			'value'    => 'container',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'home_tiles_height',
	'label'       => esc_html__( 'Height', 'authentic' ),
	'section'     => 'home',
	'default'     => '570px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.home .section-tiles .tiles-outer',
			'property' => 'height',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_tiles',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'home_tiles_padding',
	'label'       => esc_html__( 'Padding', 'authentic' ),
	'section'     => 'home',
	'default'     => '30px',
	'priority'    => 10,
	'output'      => array(
		array(
			'element'       => '.home .section-tiles .tiles-outer',
			'property'      => 'margin',
			'value_pattern' => 'calc( -$ / 2 )',
			'media_query'   => '@media ( min-width: 992px )',
			),
		array(
			'element'       => '.home .section-tiles article',
			'property'      => 'padding',
			'value_pattern' => 'calc( $ / 2 )',
			'media_query'   => '@media ( min-width: 992px )',
			),
		array(
			'element'       => '.home .section-tiles .container-fluid',
			'property'      => 'padding',
			'value_pattern' => '0 $',
			'media_query'   => '@media ( min-width: 992px )',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_tiles',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'home_tiles_parallax',
	'label'       => esc_html__( 'Parallax', 'authentic' ),
	'section'     => 'home',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_tiles',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'home_tiles_heading_primary',
	'label'       => esc_html__( 'Heading', 'authentic' ),
	'section'     => 'home',
	'default'     => array(
		'font-size'      => '2.5rem',
		'letter-spacing' => '-.15rem',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.home .section-tiles h2',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_tiles',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'home_tiles_heading_secondary',
	'label'       => esc_html__( 'Secondary Heading', 'authentic' ),
	'section'     => 'home',
	'default'     => array(
		'font-size'      => '1.5rem',
		'letter-spacing' => '-.1rem',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.home .section-tiles .tile-secondary h2',
			'media_query'   => '@media ( min-width: 992px )',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_tiles',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'home_tiles_layout',
			'operator' => '!=',
			'value'    => '1',
			),
		array(
			'setting'  => 'home_tiles_layout',
			'operator' => '!=',
			'value'    => '2',
			),
		array(
			'setting'  => 'home_tiles_layout',
			'operator' => '!=',
			'value'    => '9',
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Homepage > Post Carousel ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'home_layout_collapsible_carousel',
	'section'     => 'home',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Post Carousel', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'home_carousel',
	'label'       => esc_html__( 'Post Carousel', 'authentic' ),
	'section'     => 'home',
	'default'     => false,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'home_carousel_title',
	'label'       => esc_html__( 'Title', 'authentic' ),
	'section'     => 'home',
	'default'     => esc_html__( 'Trending Posts', 'authentic' ),
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_carousel_source',
	'label'       => esc_html__( 'Source', 'authentic' ),
	'section'     => 'home',
	'default'     => 'all',
	'priority'    => 10,
	'choices'     => $post_sources,
	'active_callback' => array(
		array(
			'setting'  => 'home_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'home_carousel_source_category_slug',
	'label'       => esc_html__( 'Slug', 'authentic' ),
	'section'     => 'home',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_carousel',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'home_carousel_source',
			'operator' => '==',
			'value'    => 'category',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'home_carousel_source_tag_slug',
	'label'       => esc_html__( 'Slug', 'authentic' ),
	'section'     => 'home',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_carousel',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'home_carousel_source',
			'operator' => '==',
			'value'    => 'tag',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_carousel_orderby',
	'label'       => esc_html__( 'Order By', 'authentic' ),
	'section'     => 'home',
	'default'     => 'date',
	'priority'    => 10,
	'choices'     => array(
		'date'      => esc_html__( 'Date', 'authentic' ),
		'views'     => esc_html__( 'Views', 'authentic' ),
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'home_carousel_time_frame',
	'label'       => esc_html__( 'Time Frame', 'authentic' ),
	'description' => esc_html__( 'Input period of posts in English, i.e. &laquo;2 months&raquo;, &laquo;14 days&raquo; or even &laquo;1 year&raquo;', 'authentic' ),
	'section'     => 'home',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_carousel',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'home_carousel_orderby',
			'operator' => '==',
			'value'    => 'views',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'home_carousel_exclude',
	'label'       => esc_html__( 'Exclude featured posts from the main archive', 'authentic' ),
	'section'     => 'home',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_carousel_columns',
	'label'       => esc_html__( 'Columns', 'authentic' ),
	'section'     => 'home',
	'default'     => '4',
	'priority'    => 10,
	'choices'     => array(
		'2'         => '2',
		'3'         => '3',
		'4'         => '4',
		'6'         => '6',
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_carousel_container',
	'label'       => esc_html__( 'Container', 'authentic' ),
	'section'     => 'home',
	'default'     => 'container',
	'priority'    => 10,
	'choices'     => array(
		'container'       => esc_html__( 'Boxed', 'authentic' ),
		'container-fluid' => esc_html__( 'Fullwidth', 'authentic' ),
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'home_carousel_width',
	'label'       => esc_html__( 'Width', 'authentic' ),
	'section'     => 'home',
	'default'     => '1140px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.home .section-carousel .container',
			'property' => 'width',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_carousel',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'home_carousel_container',
			'operator' => '==',
			'value'    => 'container',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'home_carousel_padding',
	'label'       => esc_html__( 'Padding', 'authentic' ),
	'section'     => 'home',
	'default'     => '30px',
	'priority'    => 10,
	'output'      => array(
		array(
			'element'       => '.home .section-carousel .container-fluid',
			'property'      => 'padding',
			'value_pattern' => '0 $',
			'media_query'   => '@media ( min-width: 992px )',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'number',
	'settings'    => 'home_carousel_total',
	'label'       => esc_html__( 'Total Slides', 'authentic' ),
	'section'     => 'home',
	'default'     => '8',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_carousel_thumbnail',
	'label'       => esc_html__( 'Image Size', 'authentic' ),
	'section'     => 'home',
	'default'     => 'md-ver',
	'priority'    => 10,
	'choices'     => $registered_image_sizes,
	'active_callback' => array(
		array(
			'setting'  => 'home_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'home_carousel_heading',
	'label'       => esc_html__( 'Heading', 'authentic' ),
	'section'     => 'home',
	'default'     => array(
		'font-size'      => '1rem',
		'letter-spacing' => '-.025rem',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.home .section-carousel article h2',
			'media_query'   => '@media ( min-width: 992px )',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Homepage > Archive ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'home_layout_collapsible_archive',
	'section'     => 'home',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Post Archive', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'home_archive_default',
	'label'       => esc_html__( 'Default Settings', 'authentic' ),
	'description' => esc_html__( 'You may change the default settings in Layout &rarr; ', 'authentic' ) . esc_html__( 'Post Archive', 'authentic' ),
	'section'     => 'home',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'radio-image',
	'settings'    => 'home_archive_type',
	'label'       => esc_html__( 'Type', 'authentic' ),
	'section'     => 'home',
	'default'     => 'standard',
	'priority'    => 10,
	'choices'     => array(
		'standard'  => $template_directory_uri . '/images/layout-full.png',
		'list'      => $template_directory_uri . '/images/layout-list.png',
		'grid'      => $template_directory_uri . '/images/layout-grid.png',
		'masonry'   => $template_directory_uri . '/images/layout-masonry.png',
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_archive_default',
			'operator' => '==',
			'value'    => false,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_columns',
	'label'       => esc_html__( 'Columns', 'authentic' ),
	'section'     => 'home',
	'default'     => '2',
	'priority'    => 10,
	'choices'     => array(
		'2'         => '2',
		'3'         => '3',
		),
	'active_callback' => array(
		array(
			array(
				'setting'  => 'home_archive_default',
				'operator' => '==',
				'value'    => false,
				),
			),
		array(
			array(
				'setting'  => 'home_archive_type',
				'operator' => '==',
				'value'    => 'grid',
				),
			array(
				'setting'  => 'home_archive_type',
				'operator' => '==',
				'value'    => 'masonry',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'home_first_post',
	'label'       => esc_html__( 'Display first post as standard', 'authentic' ),
	'section'     => 'home',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			array(
				'setting'  => 'home_archive_default',
				'operator' => '==',
				'value'    => false,
				),
			),
		array(
			array(
				'setting'  => 'home_archive_type',
				'operator' => '!==',
				'value'    => 'standard',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'home_summary',
	'label'       => esc_html__( 'Display post summary', 'authentic' ),
	'section'     => 'home',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_archive_default',
			'operator' => '==',
			'value'    => false,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_summary_type',
	'label'       => esc_html__( 'Standard Post Summary Type', 'authentic' ),
	'section'     => 'home',
	'default'     => 'excerpt',
	'priority'    => 10,
	'choices'     => array(
		'excerpt'   => esc_html__( 'Excerpt', 'authentic' ),
		'content'   => esc_html__( 'Full', 'authentic' ),
		),
	'active_callback' => array(
		array(
			array(
				'setting'  => 'home_archive_default',
				'operator' => '==',
				'value'    => false,
				),
			),
		array(
			array(
				'setting'  => 'home_archive_type',
				'operator' => '==',
				'value'    => 'standard',
				),
			array(
				'setting'  => 'home_first_post',
				'operator' => '==',
				'value'    => true,
				),
			),
		array(
			array(
				'setting'  => 'home_summary',
				'operator' => '==',
				'value'    => true,
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'number',
	'settings'    => 'home_excerpt_length',
	'label'       => esc_html__( 'Summary Length', 'authentic' ),
	'description' => esc_html__( 'Number of words in excerpt.', 'authentic' ),
	'section'     => 'home',
	'priority'    => 10,
	'default'     => 30,
	'active_callback' => array(
		array(
			array(
				'setting'  => 'home_archive_default',
				'operator' => '==',
				'value'    => false,
				),
			),
		array(
			array(
				'setting'  => 'home_summary',
				'operator' => '==',
				'value'    => true,
				),
			),
		array(
			array(
				'setting'  => 'home_archive_type',
				'operator' => '!==',
				'value'    => 'standard',
				),
			array(
				'setting'  => 'home_summary_type',
				'operator' => '==',
				'value'    => 'excerpt',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'home_more_button',
	'label'       => esc_html__( 'Display more button', 'authentic' ),
	'section'     => 'home',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_archive_default',
			'operator' => '==',
			'value'    => false,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_thumbnail_width',
	'label'       => esc_html__( 'Image Width', 'authentic' ),
	'section'     => 'home',
	'default'     => '4',
	'choices'     => array(
		'4'         => '1/3',
		'6'         => '1/2',
		'8'         => '2/3',
		),
	'priority'    => 10,
	'active_callback' => array(
		array(
			array(
				'setting'  => 'home_archive_default',
				'operator' => '==',
				'value'    => false,
				),
			),
		array(
			array(
				'setting'  => 'home_archive_type',
				'operator' => '==',
				'value'    => 'list',
				),
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_thumbnail_size',
	'label'       => esc_html__( 'Image Size', 'authentic' ),
	'section'     => 'home',
	'default'     => 'thumbnail',
	'priority'    => 10,
	'choices'     => $registered_image_sizes,
	'active_callback' => array(
		array(
			'setting'  => 'home_archive_default',
			'operator' => '==',
			'value'    => false,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'home_pagination_type',
	'label'       => esc_html__( 'Pagination', 'authentic' ),
	'section'     => 'home',
	'default'     => 'standard',
	'priority'    => 10,
	'choices'     => array(
		'standard'  => esc_html__( 'Standard', 'authentic' ),
		'ajax'      => esc_html__( 'Load More', 'authentic' ),
		),
	'active_callback' => array(
		array(
			'setting'  => 'home_archive_default',
			'operator' => '==',
			'value'    => false,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'home_infinite_load',
	'label'       => esc_html__( 'Infinite Load', 'authentic' ),
	'section'     => 'home',
	'default'     => false,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_archive_default',
			'operator' => '==',
			'value'    => false,
			),
		array(
			'setting'  => 'home_pagination_type',
			'operator' => '==',
			'value'    => 'ajax',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'home_widgets',
	'label'       => esc_html__( 'Display widgets in archive', 'authentic' ),
	'section'     => 'home',
	'default'     => false,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_archive_default',
			'operator' => '==',
			'value'    => false,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'number',
	'settings'    => 'home_widgets_after',
	'label'       => esc_html__( 'Display widgets after N-th post', 'authentic' ),
	'section'     => 'home',
	'default'     => 3,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_archive_default',
			'operator' => '==',
			'value'    => false,
			),
		array(
			'setting'  => 'home_widgets',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'home_widgets_repeat',
	'label'       => esc_html__( 'Repeat widgets', 'authentic' ),
	'section'     => 'home',
	'default'     => false,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'home_archive_default',
			'operator' => '==',
			'value'    => false,
			),
		array(
			'setting'  => 'home_widgets',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * [ Posts ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'post', array(
	'title'       => esc_html__( 'Posts', 'authentic' ),
	'priority'    => 5,
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Posts > Page Layout ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'post_collapsible_page_layout',
	'section'     => 'post',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Page Layout', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'post_layout_default',
	'label'       => esc_html__( 'Default Settings', 'authentic' ),
	'description' => esc_html__( 'You may change the default settings in Layout &rarr; ', 'authentic' ) . esc_html__( 'Page Layout', 'authentic' ),
	'section'     => 'post',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'radio-image',
	'settings'    => 'post_layout',
	'label'       => esc_html__( 'Sidebar', 'authentic' ),
	'section'     => 'post',
	'default'     => 'layout-sidebar-right',
	'priority'    => 10,
	'choices'     => array(
		'layout-sidebar-left'   => $template_directory_uri . '/images/layout-sidebar-left.png',
		'layout-fullwidth'      => $template_directory_uri . '/images/layout-full.png',
		'layout-sidebar-right'  => $template_directory_uri . '/images/layout-sidebar-right.png',
		),
	'active_callback' => array(
		array(
			'setting'  => 'post_layout_default',
			'operator' => '==',
			'value'    => false,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'post_layout_sidebar',
	'label'       => esc_html__( 'Sidebar Post Width', 'authentic' ),
	'section'     => 'post',
	'default'     => '1140px',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'post_layout_default',
			'operator' => '==',
			'value'    => false,
			),
		),
	'output' => array(
		array(
			'element'  => '.single.layout-sidebar .site-content .container',
			'property' => 'width',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'post_layout_sidebar_width',
	'label'       => esc_html__( 'Sidebar Width', 'authentic' ),
	'section'     => 'post',
	'default'     => '300px',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'post_layout_default',
			'operator' => '==',
			'value'    => false,
			),
		array(
			'setting'  => 'post_layout',
			'operator' => '!=',
			'value'    => 'layout-fullwidth',
			),
		),
	'output' => array(
		array(
			'element'  => '.single.layout-sidebar .site-content .content-area',
			'property' => 'flex-basis',
			'value_pattern' => 'calc(100% - 40px - $)',
			'media_query' => '@media ( min-width: 992px )',
			),
		array(
			'element'  => '.single.layout-sidebar .site-content .content-area',
			'property' => 'max-width',
			'value_pattern' => 'calc(100% - 40px - $)',
			'media_query' => '@media ( min-width: 992px )',
			),
		array(
			'element'  => '.single .site-content .sidebar-area',
			'property' => 'flex-basis',
			'value_pattern' => 'calc(40px + $)',
			'media_query' => '@media ( min-width: 992px )',
			),
		array(
			'element'  => '.single .site-content .sidebar-area',
			'property' => 'max-width',
			'value_pattern' => 'calc(40px + $)',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'post_layout_fullwidth',
	'label'       => esc_html__( 'Fullwidth Post Width', 'authentic' ),
	'section'     => 'post',
	'default'     => '940px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.single.layout-fullwidth .site-content .container',
			'property' => 'width',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'post_layout_default',
			'operator' => '==',
			'value'    => false,
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Posts > Page Header ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'post_collapsible_page_header',
	'section'     => 'post',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Page Header', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'post_page_header_default',
	'label'       => esc_html__( 'Default Settings', 'authentic' ),
	'description' => esc_html__( 'You may change the default settings in Layout &rarr; ', 'authentic' ) . esc_html__( 'Page Header', 'authentic' ),
	'section'     => 'post',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'post_page_header',
	'label'       => esc_html__( 'Type', 'authentic' ),
	'description' => esc_html__( 'You may also change the page header type on per post basis, when editing a post.', 'authentic' ),
	'section'     => 'post',
	'default'     => 'simple',
	'priority'    => 10,
	'choices'     => array(
		'none'      => esc_html__( 'None', 'authentic' ),
		'simple'    => esc_html__( 'Simple', 'authentic' ),
		'small'     => esc_html__( 'Small', 'authentic' ),
		'wide'      => esc_html__( 'Wide', 'authentic' ),
		'large'     => esc_html__( 'Large', 'authentic' ),
		),
	'active_callback' => array(
		array(
			'setting'  => 'post_page_header_default',
			'operator' => '==',
			'value'    => false,
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Posts > Author ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'post_collapsible_author',
	'section'     => 'post',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Post Author', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'post_author',
	'label'       => esc_html__( 'Post Author', 'authentic' ),
	'section'     => 'post',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'post_author_type',
	'label'       => esc_html__( 'Type', 'authentic' ),
	'section'     => 'post',
	'default'     => 'default',
	'priority'    => 10,
	'choices'     => array(
		'default'   => esc_html__( 'Default', 'authentic' ),
		'compact'   => esc_html__( 'Compact', 'authentic' ),
		),
	'active_callback' => array(
		array(
			'setting'  => 'post_author',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Posts > Tags ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'post_collapsible_tags',
	'section'     => 'post',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Post Tags', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'post_tags',
	'label'       => esc_html__( 'Post Tags', 'authentic' ),
	'section'     => 'post',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'post_tags_title',
	'label'       => esc_html__( 'Title', 'authentic' ),
	'section'     => 'post',
	'default'     => esc_html__( 'Related Topics', 'authentic' ),
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'post_tags',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Posts > Subscribe ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'post_collapsible_subscribe',
	'section'     => 'post',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Subscribe', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'post_subscribe',
	'label'       => esc_html__( 'Subscribe', 'authentic' ),
	'section'     => 'post',
	'default'     => false,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'post_subscribe_title',
	'label'       => esc_html__( 'Title', 'authentic' ),
	'section'     => 'post',
	'default'     => esc_html__( 'Subscribe', 'authentic' ),
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'post_subscribe',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'post_subscribe_message',
	'label'       => esc_html__( 'Message', 'authentic' ),
	'section'     => 'post',
	'default'     => esc_html__( 'Subscribe now to our newsletter', 'authentic' ),
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'post_subscribe',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Posts > Pagination ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'post_collapsible_pagination',
	'section'     => 'post',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Post Pagination', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'post_pagination',
	'label'       => esc_html__( 'Post Pagination', 'authentic' ),
	'section'     => 'post',
	'default'     => true,
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * |- [ Posts > Post Carousel ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'post_collapsible_carousel',
	'section'     => 'post',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Post Carousel', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'post_carousel',
	'label'       => esc_html__( 'Post Carousel', 'authentic' ),
	'section'     => 'post',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'post_carousel_title',
	'label'       => esc_html__( 'Title', 'authentic' ),
	'section'     => 'post',
	'default'     => esc_html__( 'You May Also Like', 'authentic' ),
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'post_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'post_carousel_source',
	'label'       => esc_html__( 'Source', 'authentic' ),
	'section'     => 'post',
	'default'     => 'all',
	'priority'    => 10,
	'choices'     => csco_get_post_sources(),
	'active_callback' => array(
		array(
			'setting'  => 'post_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'post_carousel_source_category_slug',
	'label'       => esc_html__( 'Slug', 'authentic' ),
	'section'     => 'post',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'post_carousel',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'post_carousel_source',
			'operator' => '==',
			'value'    => 'category',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'post_carousel_current',
	'label'       => esc_html__( 'Display posts from the current post\'s categories only', 'authentic' ),
	'section'     => 'post',
	'default'     => true,
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'post_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'post_carousel_source_tag_slug',
	'label'       => esc_html__( 'Slug', 'authentic' ),
	'section'     => 'post',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'post_carousel',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'post_carousel_source',
			'operator' => '==',
			'value'    => 'tag',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'post_carousel_orderby',
	'label'       => esc_html__( 'Order By', 'authentic' ),
	'section'     => 'post',
	'default'     => 'date',
	'priority'    => 10,
	'choices'     => array(
		'date'      => esc_html__( 'Date', 'authentic' ),
		'views'     => esc_html__( 'Views', 'authentic' ),
		),
	'active_callback' => array(
		array(
			'setting'  => 'post_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'text',
	'settings'    => 'post_carousel_time_frame',
	'label'       => esc_html__( 'Time Frame', 'authentic' ),
	'description' => esc_html__( 'Input period of posts in English, i.e. &laquo;2 months&raquo;, &laquo;14 days&raquo; or even &laquo;1 year&raquo;', 'authentic' ),
	'section'     => 'post',
	'default'     => '',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'post_carousel',
			'operator' => '==',
			'value'    => true,
			),
		array(
			'setting'  => 'post_carousel_orderby',
			'operator' => '==',
			'value'    => 'views',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'post_carousel_columns',
	'label'       => esc_html__( 'Columns', 'authentic' ),
	'section'     => 'post',
	'default'     => '4',
	'priority'    => 10,
	'choices'     => array(
		'2'         => '2',
		'3'         => '3',
		'4'         => '4',
		'6'         => '6',
		),
	'active_callback' => array(
		array(
			'setting'  => 'post_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'post_carousel_padding',
	'label'       => esc_html__( 'Padding', 'authentic' ),
	'section'     => 'post',
	'default'     => '30px',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'post_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'number',
	'settings'    => 'post_carousel_total',
	'label'       => esc_html__( 'Total Slides', 'authentic' ),
	'section'     => 'post',
	'default'     => '8',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'post_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'post_carousel_thumbnail',
	'label'       => esc_html__( 'Image Size', 'authentic' ),
	'section'     => 'post',
	'default'     => 'md-ver',
	'priority'    => 10,
	'choices'     => $registered_image_sizes,
	'active_callback' => array(
		array(
			'setting'  => 'post_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'typography',
	'settings'    => 'post_carousel_heading',
	'label'       => esc_html__( 'Heading', 'authentic' ),
	'section'     => 'post',
	'default'     => array(
		'font-size'      => '1rem',
		'letter-spacing' => '-.025rem',
		),
	'transport'   => 'auto',
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.single .section-carousel article h2',
			'media_query'   => '@media ( min-width: 992px )',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'post_carousel',
			'operator' => '==',
			'value'    => true,
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * [ Pages ]
 * -------------------------------------------------------------------------
 */

Kirki::add_section( 'page', array(
	'title'       => esc_html__( 'Pages', 'authentic' ),
	'priority'    => 6,
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Pages > Page Layout ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'page_collapsible_page_layout',
	'section'     => 'page',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Page Layout', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'page_layout_default',
	'label'       => esc_html__( 'Default Settings', 'authentic' ),
	'description' => esc_html__( 'You may change the default settings in Layout &rarr; ', 'authentic' ) . esc_html__( 'Page Layout', 'authentic' ),
	'section'     => 'page',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'radio-image',
	'settings'    => 'page_layout',
	'label'       => esc_html__( 'Sidebar', 'authentic' ),
	'section'     => 'page',
	'default'     => 'layout-sidebar-right',
	'priority'    => 10,
	'choices'     => array(
		'layout-sidebar-left'   => $template_directory_uri . '/images/layout-sidebar-left.png',
		'layout-fullwidth'      => $template_directory_uri . '/images/layout-full.png',
		'layout-sidebar-right'  => $template_directory_uri . '/images/layout-sidebar-right.png',
		),
	'active_callback' => array(
		array(
			'setting'  => 'page_layout_default',
			'operator' => '==',
			'value'    => false,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'page_layout_sidebar',
	'label'       => esc_html__( 'Sidebar Page Width', 'authentic' ),
	'section'     => 'page',
	'default'     => '1140px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.page.layout-sidebar .site-content .container, .woocommerce.layout-sidebar .site-content .container',
			'property' => 'width',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'page_layout_default',
			'operator' => '==',
			'value'    => false,
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'page_layout_sidebar_width',
	'label'       => esc_html__( 'Sidebar Width', 'authentic' ),
	'section'     => 'page',
	'default'     => '300px',
	'priority'    => 10,
	'active_callback' => array(
		array(
			'setting'  => 'page_layout_default',
			'operator' => '==',
			'value'    => false,
			),
		array(
			'setting'  => 'page_layout',
			'operator' => '!=',
			'value'    => 'layout-fullwidth',
			),
		),
	'output' => array(
		array(
			'element'  => '.page.layout-sidebar .site-content .content-area, .woocommerce.layout-sidebar .site-content .content-area',
			'property' => 'flex-basis',
			'value_pattern' => 'calc(100% - 40px - $)',
			'media_query' => '@media ( min-width: 992px )',
			),
		array(
			'element'  => '.page.layout-sidebar .site-content .content-area, .woocommerce.layout-sidebar .site-content .content-area',
			'property' => 'max-width',
			'value_pattern' => 'calc(100% - 40px - $)',
			'media_query' => '@media ( min-width: 992px )',
			),
		array(
			'element'  => '.page .site-content .sidebar-area, .woocommerce .site-content .sidebar-area',
			'property' => 'flex-basis',
			'value_pattern' => 'calc(40px + $)',
			'media_query' => '@media ( min-width: 992px )',
			),
		array(
			'element'  => '.page .site-content .sidebar-area, .woocommerce .site-content .sidebar-area',
			'property' => 'max-width',
			'value_pattern' => 'calc(40px + $)',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'dimension',
	'settings'    => 'page_layout_fullwidth',
	'label'       => esc_html__( 'Fullwidth Page Width', 'authentic' ),
	'section'     => 'page',
	'default'     => '940px',
	'priority'    => 10,
	'output' => array(
		array(
			'element'  => '.page.layout-fullwidth .site-content .container, .woocommerce.layout-fullwidth .site-content .container',
			'property' => 'width',
			'media_query' => '@media ( min-width: 992px )',
			),
		),
	'active_callback' => array(
		array(
			'setting'  => 'page_layout_default',
			'operator' => '==',
			'value'    => false,
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Pages > Page Header ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'custom',
	'settings'    => 'page_collapsible_page_header',
	'section'     => 'page',
	'default'     => '<div class="customize-collapsible"><h3>' . esc_html__( 'Page Header', 'authentic' ) . '</h3></div>',
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'toggle',
	'settings'    => 'page_page_header_default',
	'label'       => esc_html__( 'Default Settings', 'authentic' ),
	'description' => esc_html__( 'You may change the default settings in Layout &rarr; ', 'authentic' ) . esc_html__( 'Page Header', 'authentic' ),
	'section'     => 'page',
	'default'     => true,
	'priority'    => 10,
) );

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'select',
	'settings'    => 'page_page_header',
	'label'       => esc_html__( 'Type', 'authentic' ),
	'description' => esc_html__( 'You may also change the page header type on per page basis, when editing a page.', 'authentic' ),
	'section'     => 'page',
	'default'     => 'simple',
	'priority'    => 10,
	'choices'     => array(
		'none'      => esc_html__( 'None', 'authentic' ),
		'simple'    => esc_html__( 'Simple', 'authentic' ),
		'small'     => esc_html__( 'Small', 'authentic' ),
		'wide'      => esc_html__( 'Wide', 'authentic' ),
		'large'     => esc_html__( 'Large', 'authentic' ),
		),
	'active_callback' => array(
		array(
			'setting'  => 'page_page_header_default',
			'operator' => '==',
			'value'    => false,
			),
		),
) );

/**
 * -------------------------------------------------------------------------
 * |-- [ Advanced > Pin It ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'pin_it_disabled',
	'label'       => esc_html__( 'Disable Pin It buttons', 'authentic' ),
	'section'     => 'advanced',
	'default'     => false,
	'priority'    => 10,
));

/**
 * -------------------------------------------------------------------------
 * |-- [ Advanced > Lightboxes ]
 * -------------------------------------------------------------------------
 */

Kirki::add_field( 'csco_theme_mod', array(
	'type'        => 'checkbox',
	'settings'    => 'lightbox_disabled',
	'label'       => esc_html__( 'Disable lightbox', 'authentic' ),
	'section'     => 'advanced',
	'default'     => false,
	'priority'    => 10,
) );

/**
 * -------------------------------------------------------------------------
 * [ Hookable Theme Mods ]
 * -------------------------------------------------------------------------
 */

/**
 * Sidebar Select
 */
function csco_widgets_sidebar() {

	$registered_sidebars = csco_get_registered_sidebars();

	$locations = array( 'layout', 'home' );

	foreach ( $locations as $location ) {

		$section = $location;

		if ( 'layout' === $location ) {
			$section = 'archive';
		}

		Kirki::add_field( 'csco_theme_mod', array(
			'type'        => 'select',
			'settings'    => $location . '_widgets_sidebar',
			'label'       => esc_html__( 'Widget Area', 'authentic' ),
			'section'     => $section,
			'default'     => 'sidebar-archive',
			'priority'    => 10,
			'active_callback' => array(
				array(
					'setting'  => $location . '_widgets',
					'operator' => '==',
					'value'    => true,
					),
				),
			'choices'     => $registered_sidebars,
		) );

	}
}
add_action( 'init', 'csco_widgets_sidebar' );

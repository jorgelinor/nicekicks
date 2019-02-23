<?php
/**
 * Include Framework Modules
 *
 * The $csco_includes array determines the code libraries included in your theme.
 *
 * @package Authentic
 * @subpackage Functions
 * @version 1.0.0
 * @since Authentic 2.0.0
 */

$csco_includes = array(
	'arrays.php',
	'init.php',
	'dashboard.php',
	'demo-import/theme-demos.php',
	'demo-import/ocdi-filters.php',
	'demo-import/customizer-demos.php',
	'includes/classes/class-csco-typekit.php',
	'core-functions.php',
	'template-tags.php',
	'filters.php',
	'plugin-filters.php',
	'basic-plugins.php',
	'includes/plugins.php',
	'customizer/color-palettes.php',
	'customizer/kirki.php',
	'custom-fields/acf-pro.php',
	'body-classes.php',
	'actions.php',
	'partials.php',
	'post-meta.php',
	'assets.php',
	'gallery.php',
	'load-more.php',
	'custom-content.php',
	'deprecated.php',
);

// Include WooCommerce features only if WooCommerce is activated.
if ( class_exists( 'woocommerce' ) ) {
	$csco_includes[] = 'woocommerce.php';
}

// Include files from $csco_includes array.
foreach ( $csco_includes as $file ) {
	include_once get_template_directory() . '/framework/' . $file;
}

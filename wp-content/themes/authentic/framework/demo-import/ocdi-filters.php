<?php
/**
 * One Click Demo Import Functions
 *
 * @package Authentic WordPress Theme
 * @subpackage Demo Import
 * @since Authentic 2.0.0
 * @version 1.0.0
 */

/**
 * Settings Page
 *
 * @param array $default_settings Default settings.
 */
function csco_ocdi_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'Demo Content' , 'authentic' );
	$default_settings['menu_title']  = esc_html__( 'Demo Content' , 'authentic' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'csco-demo-content';
	return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'csco_ocdi_plugin_page_setup' );

/**
 * Demo Content
 */
function csco_ocdi_import_files() {
	return array(
		array(
			'import_file_name'             => esc_html__( 'Demo Content', 'authentic' ),
			'local_import_file'            => get_template_directory() . '/demo-content/demo-content.xml',
			'local_import_widget_file'     => get_template_directory() . '/demo-content/widgets.json',
			),
		);
}

add_filter( 'pt-ocdi/import_files', 'csco_ocdi_import_files' );

/**
 * Page Title
 */
function csco_ocdi_page_title() {
	return '<h1>' . esc_html__( 'Demo Content Import' ) . '</h1>';
}
add_filter( 'pt-ocdi/plugin_page_title', 'csco_ocdi_page_title' );

/**
 * Intro Text
 *
 * @param string $default_text Default Intro Text.
 */
function csco_ocdi_plugin_intro_text( $default_text ) {
	ob_start(); ?>
	<div class="about-description">
		<p><?php esc_html_e( 'Clicking the Import Demo Data button will import demo posts, pages, categories, comments, tags and widgets.', 'authentic' ); ?></p>
		<p><?php echo sprintf( wp_kses( __( 'You may switch between different Demos in the <a href="%s">Customize</a> section.', 'authentic' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'customize.php' ) ) ); ?></p>
		</div>
	<?php return $default_text = ob_get_clean();
}
add_filter( 'pt-ocdi/plugin_intro_text', 'csco_ocdi_plugin_intro_text' );

/**
 * Disable Branding
 */
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

/**
 * Menus and Frontpage
 */
function csco_ocdi_after_import_setup() {

	$main_menu = get_term_by( 'name', 'Main', 'nav_menu' );
	$categories_menu = get_term_by( 'name', 'Categories', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
		'primary-menu'   => $main_menu->term_id,
		'footer-menu'    => $categories_menu->term_id,
	));

	update_option( 'show_on_front', 'posts' );

}

add_action( 'pt-ocdi/after_import', 'csco_ocdi_after_import_setup' );

<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Basic Social Accounts
 * @subpackage Public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Basic Social Accounts
 * @subpackage Basic_Social_Accounts/public
 * @author     Code Supply Co. <hello@codesupply.co>
 */
class Basic_Social_Accounts_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name  The name of the plugin.
	 * @param string $version      The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		// Basic Social Accounts Styles.
		$bsa_enqueue = apply_filters( 'bsa_enqueue_styles', true );
		if ( $bsa_enqueue ) {
			wp_register_style( 'bsa_css', plugin_dir_url( __FILE__ ) . 'css/basic-social-accounts-public.css', false, $this->version, 'screen' );
			wp_enqueue_style( 'bsa_css' );
		}
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

	}

}

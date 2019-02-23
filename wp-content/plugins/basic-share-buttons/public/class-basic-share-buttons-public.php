<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Basic Share Buttons
 * @subpackage Public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Basic Share Buttons
 * @subpackage Basic_Share_Buttons/public
 * @author     Code Supply Co. <hello@codesupply.co>
 */
class Basic_Share_Buttons_Public {

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

		// Basic Share Buttons Styles.
		$bsb_enqueue = apply_filters( 'bsb_enqueue_styles', true );
		if ( $bsb_enqueue ) {
			wp_register_style( 'bsb_css', plugin_dir_url( __FILE__ ) . 'css/basic-share-buttons-public.css', false, $this->version, 'screen' );
			wp_enqueue_style( 'bsb_css' );
		}
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

	}

	/**
	 * Add allowed protocols.
	 *
	 * @since    1.0.0
	 *
	 * @param array $protocols Array of allowed protocols e.g. 'http', 'ftp', 'tel', and more.
	 */
	public function allowed_protocols( $protocols ) {
		$protocols[] = 'fb-messenger';
		$protocols[] = 'whatsapp';
		$protocols[] = 'viber';
		$protocols[] = 'tg';

		return $protocols;
	}

	/**
	 * Add Share Buttons after Content.
	 *
	 * @since 1.0.0
	 * @param string $content Post Content.
	 */
	public function after_content_location( $content ) {

		$locations = apply_filters( 'bsb_locations', array() );
		$location  = 'after-content';
		$exists    = false;

		foreach ( $locations as $location_array ) {
			if ( $location === $location_array['location'] ) {
				$exists = true;
				break;
			}
		}

		if ( $exists ) {

			ob_start();
			bsb_display_shares( $location );
			$content .= ob_get_clean();
		}

		return $content;
	}


}

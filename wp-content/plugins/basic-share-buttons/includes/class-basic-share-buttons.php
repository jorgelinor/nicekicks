<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://codesupply.co
 * @since      1.0.0
 *
 * @package    Basic Share Buttons
 * @subpackage Includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Basic Shortcodes
 * @subpackage Includes
 * @author     Code Supply Co. <hello@codesupply.co>
 */
class Basic_Share_Buttons {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Basic_Shortcodes_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The admin-specific functionality of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Basic_Shortcodes_Admin    $admin    All fucntions for the admin panel.
	 */
	protected $admin;

	/**
	 * The public-facing functionality of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Basic_Shortcodes_Public    $public   All fucntions for the site frontend.
	 */
	protected $public;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'basic-share-buttons';
		$this->version     = '1.1.1';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Basic_Shortcodes_Loader. Orchestrates the hooks of the plugin.
	 * - Basic_Shortcodes_i18n. Defines internationalization functionality.
	 * - Basic_Shortcodes_Admin. Defines all hooks for the admin area.
	 * - Basic_Shortcodes_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * Functions for the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/basic-share-buttons-functions.php';

		/**
		 * Social Accounts Counters.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/basic-share-buttons-counters.php';

		/**
		 * Social Accounts.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/basic-share-buttons-accounts.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-basic-share-buttons-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-basic-share-buttons-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-basic-share-buttons-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-basic-share-buttons-public.php';

		/**
		 * Init Classes
		 */
		$this->loader = new Basic_Share_Buttons_Loader();
		$this->admin  = new Basic_Share_Buttons_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->public = new Basic_Share_Buttons_Public( $this->get_plugin_name(), $this->get_version() );
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Basic_Share_Buttons_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Basic_Share_Buttons_I18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Filter Register Locations
	 *
	 * @since    1.0.0
	 * @access   private
	 *
	 * @param array $locations List of Locations.
	 */
	public function bsb_location_default( $locations = array() ) {
		$locations = array(
			array(
				'name'		=> 'After content',
				'location'	=> 'after-content',
				'fields'	=> array(
					'total'			=> true,
					'labels'		=> true,
					'counts'		=> true,
				),
			),
		);

		return $locations;
	}

	/**
	 * Filter Register Schemes
	 *
	 * @since    1.0.0
	 * @access   private
	 *
	 * @param array $schemes List of Schemes.
	 */
	public function bsb_scheme_default( $schemes = array() ) {
		$schemes['default'] = array(
			'name'	=> 'Default',
		);

		return $schemes;
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$this->loader->add_action( 'init', $this, 'register_shortcode' );
		$this->loader->add_action( 'init', $this->admin, 'register_options_default' );
		$this->loader->add_action( 'admin_menu', $this->admin, 'register_options_page' );
		$this->loader->add_action( 'admin_enqueue_scripts', $this->admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $this->admin, 'enqueue_scripts' );

		$this->loader->add_filter( 'bsb_locations', $this, 'bsb_location_default' );
		$this->loader->add_filter( 'bsb_color_schemes', $this, 'bsb_scheme_default' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$this->loader->add_action( 'wp_enqueue_scripts', $this->public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $this->public, 'enqueue_scripts' );

		$this->loader->add_filter( 'kses_allowed_protocols', $this->public, 'allowed_protocols' );
		$this->loader->add_filter( 'the_content', $this->public, 'after_content_location', 100 );
	}

	/**
	 * Register Shortcode
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function register_shortcode() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/basic-share-buttons-shortcode.php';
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Basic_Share_Buttons_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
}

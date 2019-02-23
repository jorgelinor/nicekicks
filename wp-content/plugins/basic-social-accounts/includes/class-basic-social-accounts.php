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
 * @package    Basic Social Accounts
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
class Basic_Social_Accounts {

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

		$this->plugin_name = 'basic-social-accounts';
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
		 * Social Connect.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'extra/class-social-connect.php';

		/**
		 * Social Counter API.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'extra/class-basic-social-counter.php';

		/**
		 * Functions for the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/basic-social-accounts-functions.php';

		/**
		 * Social Counter Accounts List.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/basic-social-accounts-social-list.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-basic-social-accounts-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-basic-social-accounts-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-basic-social-accounts-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-basic-social-accounts-public.php';

		/**
		 * Init Classes
		 */
		$this->loader = new Basic_Social_Accounts_Loader();
		$this->admin  = new Basic_Social_Accounts_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->public = new Basic_Social_Accounts_Public( $this->get_plugin_name(), $this->get_version() );
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Basic_Social_Accounts_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Basic_Social_Accounts_I18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Filter Register Templates
	 *
	 * @since    1.0.0
	 * @access   private
	 *
	 * @param array $templates List of Templates.
	 */
	public function bsa_template_default( $templates = array() ) {
		$templates = array(
			'default' => array(
				'name' => 'Default',
			),
		);

		return $templates;
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$this->loader->add_action( 'init', $this, 'register_social_params' );
		$this->loader->add_action( 'init', $this, 'register_shortcode' );
		$this->loader->add_action( 'widgets_init', $this, 'register_widget' );
		$this->loader->add_action( 'admin_menu', $this->admin, 'register_options_page' );
		$this->loader->add_action( 'admin_enqueue_scripts', $this->admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $this->admin, 'enqueue_scripts' );

		$this->loader->add_filter( 'csco_reset_cache', $this, 'register_reset_cache' );
		$this->loader->add_filter( 'bsa_templates', $this, 'bsa_template_default' );
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
	}

	/**
	 * Register Social Params
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function register_social_params() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/basic-social-accounts-social-params.php';

		$social_connect = new Social_Connect();
	}

	/**
	 * Register Reset Cache
	 *
	 * @since    1.0.0
	 * @param    array $list Change list reset cache.
	 * @access   private
	 */
	public function register_reset_cache( $list ) {
		$list[] = 'bsa_social_counter_';

		return $list;
	}

	/**
	 * Register Shortcode
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function register_shortcode() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/basic-social-accounts-shortcode.php';
	}

	/**
	 * Register Widget
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function register_widget() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-basic-social-accounts-widget.php';

		register_widget( 'Basic_Social_Accounts_Widget' );
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
	 * @return    Basic_Social_Accounts_Loader    Orchestrates the hooks of the plugin.
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

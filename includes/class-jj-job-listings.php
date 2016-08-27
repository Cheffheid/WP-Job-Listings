<?php
/**
 *
 * Core plugin file.
 *
 * @link       http://jeffreydewit.com
 * @since      1.0.0
 *
 * @package    JJ_Job_Listings
 * @subpackage JJ_Job_Listings/includes
 */

/**
 * The core plugin class.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    JJ_Job_Listings
 * @subpackage JJ_Job_Listings/includes
 * @author     Jeffrey de Wit <jeff@jeffreydewit.com>
 */
class JJ_Job_Listings {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Endtime_Additions_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

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
		$this->plugin_name = 'jj-job-listings';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->register_custom_post_types();
		$this->register_widgets();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-jj-job-listings-loader.php';

		/**
		 * The class responsible for registering the custom post type
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-jj-job-listing-registration.php';

		/**
		 * The class responsible for admin specific functionality
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-jj-job-listings-admin.php';

		/**
		 * Job Listings locations widget
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/class-jj-job-listings-location-widget.php';

		$this->loader = new JJ_Job_Listings_Loader();
	}

	/**
	 * Register custom post types
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function register_custom_post_types() {
		$job_listing_registration = new JJ_Job_Listings_Registrations( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'init', $job_listing_registration, 'register' );
	}

	/**
	 * Register custom widget.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function register_widgets() {
		$job_listing_admin = new JJ_Job_Listings_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'widgets_init', $job_listing_admin, 'register_widget_area' );

		$this->loader->add_action( 'widgets_init', $job_listing_admin, 'register_locations_widget' );
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
	 * @return    Endtime_Additions_Loader    Orchestrates the hooks of the plugin.
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

<?php

/**
 *
 * The admin-specific functionality of the plugin.
 *
 * @link       http://jeffreydewit.com
 * @since      1.0.0
 *
 * @package    JJ_Job_Listings
 * @subpackage JJ_Job_Listings/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and a new sidebar area for the category
 * list widget.
 *
 * @since      1.0.0
 * @package    JJ_Job_Listings
 * @subpackage JJ_Job_Listings/admin
 * @author     Jeffrey de Wit <jeff@jeffreydewit.com>
 */
class JJ_Job_Listings_Admin {

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
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function register_widget_area() {

		if ( function_exists( 'genesis_register_sidebar' ) ) {
			genesis_register_sidebar( array(
				'id'          => 'job-listing-archive-widgets',
				'name'        => __( 'Job Listings Archive', $this->plugin_name ),
				'description' => __( 'This is the sidebar for the job listings page', $this->plugin_name ),
			) );
		}

	}

	public function register_locations_widget() {
		register_widget( 'JJ_Job_Locations_Widget' );
	}

}

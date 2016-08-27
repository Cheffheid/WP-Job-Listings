<?php
/**
 *
 * Registers job listing custom post type
 *
 * @link       http://jeffreydewit.com
 * @since      1.0.0
 *
 * @package    JJ_Job_Listings
 * @subpackage JJ_Job_Listings/admin
 */

/**
 * Registers job listing custom post type
 *
 * This class defines all code necessary to register the job listing custom
 * post type
 *
 * @since      1.0.0
 * @package    JJ_Job_Listings
 * @subpackage JJ_Job_Listings/admin
 * @author     Jeffrey de Wit <jeff@jeffreydewit.com>
 */
class JJ_Job_Listings_Registrations {

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
	 * @param    string $plugin_name       The name of this plugin.
	 * @param    string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->post_type = 'job';
		$this->taxonomies = array( 'job-location' );

	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses JJ_Job_Listings_Registrations::register_post_type()
	 * @uses JJ_Job_Listings_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_taxonomy_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Job Listings', 'jj-job-listings' ),
			'singular_name'      => __( 'Job Listing', 'jj-job-listings' ),
			'add_new'            => __( 'Add Job Listing', 'jj-job-listings' ),
			'add_new_item'       => __( 'Add Job Listing', 'jj-job-listings' ),
			'edit_item'          => __( 'Edit Job Listing', 'jj-job-listings' ),
			'new_item'           => __( 'New Job Listing', 'jj-job-listings' ),
			'view_item'          => __( 'View Job Listing', 'jj-job-listings' ),
			'search_items'       => __( 'Search Jobs', 'jj-job-listings' ),
			'not_found'          => __( 'No job listings found', 'jj-job-listings' ),
			'not_found_in_trash' => __( 'No job listings in the trash', 'jj-job-listings' ),
		);

		$supports = array(
			'title',
			'editor',
			'thumbnail',
			'custom-fields',
			'revisions',
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'job' ),
			'menu_position'   => 30,
			'menu_icon'       => 'dashicons-megaphone',
			'has_archive'			=> 'job-listings',
		);

		$args = apply_filters( 'job_post_type_args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for Job Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Job Locations', 'jj-job-listings' ),
			'singular_name'              => __( 'Job Location', 'jj-job-listings' ),
			'menu_name'                  => __( 'Job Locations', 'jj-job-listings' ),
			'edit_item'                  => __( 'Edit Job Location', 'jj-job-listings' ),
			'update_item'                => __( 'Update Job Location', 'jj-job-listings' ),
			'add_new_item'               => __( 'Add New Job Location', 'jj-job-listings' ),
			'new_item_name'              => __( 'New Job Location Name', 'jj-job-listings' ),
			'all_items'                  => __( 'All Job Locations', 'jj-job-listings' ),
			'search_items'               => __( 'Search Job Location', 'jj-job-listings' ),
			'popular_items'              => __( 'Popular Job Locations', 'jj-job-listings' ),
			'separate_items_with_commas' => __( 'Separate job locations with commas', 'jj-job-listings' ),
			'add_or_remove_items'        => __( 'Add or remove job locations', 'jj-job-listings' ),
			'choose_from_most_used'      => __( 'Choose from the most used job locations', 'jj-job-listings' ),
			'not_found'                  => __( 'No job locations found.', 'jj-job-listings' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'job-location' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'job_post_type_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
}

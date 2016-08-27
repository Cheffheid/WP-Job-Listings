<?php
/**
 *
 * Job Listings plugin.
 *
 * @link              http://jeffreydewit.com
 * @since             1.0.0
 * @package           job-listings
 *
 * @isc-early-access
 * Plugin Name:       Job Listings
 * Plugin URI:        http://jeffreydewit.com
 * Description:       Adds an easy way to manage job listings on the website.
 * Version:           1.0.0
 * Author:            Jeffrey de Wit
 * Author URI:        http://jeffreydewit.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       jj-job-listings
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_jj_job_listings() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jj-job-listings-activator.php';
	JJ_Job_Listings_Activator::activate();
}
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_jj_job_listings() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jj-job-listings-deactivator.php';
	JJ_Job_Listings_Deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activate_jj_job_listings' );
register_deactivation_hook( __FILE__, 'deactivate_jj_job_listings' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-jj-job-listings.php';
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_jj_job_listings() {
	$plugin = new JJ_Job_Listings();
	$plugin->run();
}
run_jj_job_listings();

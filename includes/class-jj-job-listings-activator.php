<?php
/**
 *
 * Fired during plugin activation
 *
 * @link       http://jeffreydewit.com
 * @since      1.0.0
 *
 * @package    JJ_Job_Listings
 * @subpackage JJ_Job_Listings/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's
 * activation.
 *
 * @since      1.0.0
 * @package    JJ_Job_Listings
 * @subpackage JJ_Job_Listings/includes
 * @author     Jeffrey de Wit <jeff@jeffreydewit.com>
 */
class JJ_Job_Listings_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$job_listings = new JJ_Job_Listings_Registrations();
		$job_listings->register();

		flush_rewrite_rules();
	}

}

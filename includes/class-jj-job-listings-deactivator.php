<?php
/**
 *
 * Fired during plugin deactivation
 *
 * @link       http://jeffreydewit.com
 * @since      1.0.0
 *
 * @package    JJ_Job_Listings
 * @subpackage JJ_Job_Listings/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's
 * deactivation.
 *
 * @since      1.0.0
 * @package    JJ_Job_Listings
 * @subpackage JJ_Job_Listings/includes
 * @author     Jeffrey de Wit <jeff@jeffreydewit.com>
 */
class JJ_Job_Listings_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}

}

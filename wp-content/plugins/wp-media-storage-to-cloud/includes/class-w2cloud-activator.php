<?php

/**
 * Fired during plugin activation
 *
 * @link       https://rextheme.com
 * @since      1.0.0
 *
 * @package    w2cloud
 * @subpackage w2cloud/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    w2cloud
 * @subpackage w2cloud/includes
 * @author     RexTheme <#>
 */
class w2cloud_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
			add_option('w2cloud_activation_redirect', true);
		  update_option( 'w2cloud_dashboard_option', 0 );
	}

}

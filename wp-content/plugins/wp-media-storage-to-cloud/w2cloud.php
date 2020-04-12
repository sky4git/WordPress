<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://rextheme.com
 * @since             1.0.0
 * @package           w2cloud
 *
 * @wordpress-plugin
 * Plugin Name:       Media Storage to Cloud
 * Plugin URI:        https://rextheme.com/wp-media-storage-to-cloud/
 * Description:       Upload and serve your WordPress media from Amazon S3, Google Cloud Storage & DigitalOcean Space. Boosts site performance and simplifies workflows.
 * Version:           1.7.0
 * Author:            RexTheme
 * Author URI:        https://rextheme.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       w2cloud
 * Domain Path:       /languages
 */

// If this file is called directly, abort.

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */

define( 'w2cloud_VERSION', '1.6.0' );
define( 'w2cloud_PLUGIN', plugin_basename( __FILE__ ));
define( 'w2cloud_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'w2cloud_ON_PRODUCTION', true );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-w2cloud-activator.php
 */

function activate_w2cloud() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-w2cloud-activator.php';
	w2cloud_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-w2cloud-deactivator.php
 */

function deactivate_w2cloud() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-w2cloud-deactivator.php';
	w2cloud_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_w2cloud' );
register_deactivation_hook( __FILE__, 'deactivate_w2cloud' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */

require plugin_dir_path( __FILE__ ) . 'includes/class-w2cloud.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */

function run_w2cloud() {

	$plugin = new w2cloud();
	$plugin->run();

}

run_w2cloud();

/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_wp_media_storage_to_cloud() {

    $client = new Appsero\Client( '5afacdfa-abe4-4167-b51c-48f1de4d3d9a', 'Media Storage to Cloud', __FILE__ );
    $client->insights()->init();

}

appsero_init_tracker_wp_media_storage_to_cloud();

function w2cloud_documentation_link( $links ) {
    $links = array_merge( array(
        '<a href="' . esc_url( 'https://rextheme.com/docs/wp-media-storage-to-cloud/' ) . '" target="_blank">' . __( 'Documentation' ) . '</a>'
    ), $links );
    return $links;
}
add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'w2cloud_documentation_link' );

function w2cloud_avail_channels() {
	$channels = array(
		'gcs' => 'Google Cloud Storage',
		'aws' => 'Amazon S3',
		'do' => 'Digital Ocean Space',
	);
	return $channels;
}

add_action('admin_init', 'w2cloud_plugin_redirect');
function w2cloud_plugin_redirect() {
    if (get_option('w2cloud_activation_redirect', false)) {
        delete_option('w2cloud_activation_redirect');
        wp_redirect("admin.php?page=wp-cloud#/");
        exit;
    }
}

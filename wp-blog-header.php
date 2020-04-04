<?php
/**
 * Loads the WordPress environment and template.
 *
 * @package WordPress
 */
var_dump( isset( $wp_did_header ) );
if ( ! isset( $wp_did_header ) ) {

	$wp_did_header = true;
	echo "I am here";
	// Load the WordPress library.
	//require_once __DIR__ . '/wp-load.php';

	// Set up the WordPress query.
	//wp();

	// Load the theme template.
	//require_once ABSPATH . WPINC . '/template-loader.php';

}

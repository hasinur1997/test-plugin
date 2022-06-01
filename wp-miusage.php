<?php
/**
 * Plugin Name: WP Miusage Plugin
 * Plugin URI: https://github.com/hasinur1997
 * Description: A simple API based plugin for fetching data from miusage
 * Version: 1.0.0
 * Author: Hasinur Rahman
 * Author URI: http://github.com/hasinur1997
 * License: GPL2
 * Text Domain: wp-miusage
 * Domain Path: /languages
 *
 * @package AwesomeMotive\Miusage
 */

namespace AwesomeMotive\Miusage;

use AwesomeMotive\Miusage\Plugin;

// Don't call the file directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Autoload the dependencies
 *
 * @return boolean
 */
function autoload(): bool {
	static $loaded;

	if ( wp_validate_boolean( $loaded ) ) {
		return $loaded;
	}

	$autoload_file = __DIR__ . '/vendor/autoload.php';

	if ( file_exists( $autoload_file ) && is_readable( $autoload_file ) ) {
		require_once $autoload_file;

		$loaded = true;

		return $loaded;
	}

	$loaded = false;

	return $loaded;
}

/**
 * Don't load anything if composer autoload not loaded
 */
if ( ! autoload() ) {
	return;
}

/**
 * Get the main plugin instance.
 *
 * @return Plugin
 */
function plugin(): Plugin {
	static $plugin;

	if ( null !== $plugin ) {
		return $plugin;
	}

	$plugin = new Plugin();

	return $plugin;
}

/**
 * Save settings on plugin activation.
 *
 * @return void
 */
function miusage_save_default_settings() {
	$admin_email = get_option( 'admin_email' );

	$settings = [
		'numrows'   => 5,
		'humandate' => 'yes',
		'emails'    => [ $admin_email ],
	];

	update_option( 'test_project_option', wp_json_encode( $settings ) );
}

/**
 * Initialize the plugin
 */
add_action(
	'plugins_loaded',
	function() {
		plugin()->run();
	}
);

/**
 * Run registation activation hook.
 *
 * Save default settings on plugin activation.
 */
register_activation_hook( __FILE__, __NAMESPACE__ . '\miusage_save_default_settings' );

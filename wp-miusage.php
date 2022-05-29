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

/**
 * Copyright (c) YEAR sabbir1991 (email: sabbir.081070@gmail.com). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

declare(strict_types=1);

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

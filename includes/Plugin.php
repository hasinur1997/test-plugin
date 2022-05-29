<?php
/**
 * Main plugin class
 *
 * @package AwesomeMotive\Miusage
 * @since 1.0.0
 */

namespace AwesomeMotive\Miusage;

use AwesomeMotive\Miusage\Admin\Admin;

/**
 * Class Plugin
 *
 * @package AwesomeMotive\Miusage
 */
class Plugin {

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * Plugin directory path.
	 *
	 * @var string
	 */
	public $path;

	/**
	 * Plugin's url
	 *
	 * @var string
	 */
	public $url;

	/**
	 * Assets directory path
	 *
	 * @var string
	 */
	public $assets_dir;

	/**
	 * Fire the plugin initialize steps.
	 *
	 * @return void
	 */
	public function run(): void {
		$this->path       = dirname( __FILE__, 2 );
		$this->url        = plugin_dir_url( trailingslashit( dirname( __FILE__, 2 ) ) . 'wp-miusage.php' );
		$this->assets_dir = trailingslashit( $this->url ) . 'assets/';

		$this->load_files();
		$this->init_hooks();
	}

	/**
	 * Initialize necessary hooks
	 *
	 * @return void
	 */
	public function init_hooks(): void {
		add_action( 'init', [ $this, 'load_textdomain' ] );
		add_action( 'init', [ $this, 'load_classes' ] );
	}

	/**
	 * Load functions files
	 *
	 * @return void
	 */
	public function load_files(): void {
		require_once $this->path . '/includes/Helpers/functions.php';
	}

	/**
	 * Load the plugin textdomain
	 *
	 * @return void
	 */
	public function load_textdomain(): void {
		load_textdomain( 'wp-miusage', false, basename( $this->path ) . '/languages' . get_locale() );
	}

	/**
	 * Load classes
	 *
	 * @return void
	 */
	public function load_classes(): void {
		Assets::get_instance();
		Ajax::get_instance();

		if ( is_admin() ) {
			Admin::get_instance();
		}
	}
}

<?php
/**
 * Admin class
 *
 * Manage all admin related functionality
 *
 * @package AwesomeMotive\Miusage
 */

namespace AwesomeMotive\Miusage\Admin;

use AwesomeMotive\Miusage\Traits\Singleton;
use function AwesomeMotive\Miusage\plugin;

/**
 * Admin class
 *
 * @package AwesomeMotive\Miusage\Admin
 */
class Admin {

	use Singleton;

	/**
	 * Load automatically when class initiate.
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
	}

	/**
	 * Add admin menu
	 *
	 * @return void
	 */
	public function admin_menu() {
		add_menu_page(
			__( 'Miusage', 'wp-miusage' ),
			__( 'Miusage', 'wp-miusage' ),
			'manage_options',
			'miusage',
			[ $this, 'admin_page' ],
			'dashicons-chart-area'
		);
	}

	/**
	 * Render admin page
	 *
	 * @return void
	 */
	public function admin_page() {
		require_once plugin()->path . '/includes/Views/admin.php';
	}
}

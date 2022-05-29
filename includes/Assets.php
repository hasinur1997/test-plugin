<?php
/**
 * Assets class
 *
 * @package AwesomeMotive\Miusage
 *
 * @since 1.0.0
 */

namespace AwesomeMotive\Miusage;

use AwesomeMotive\Miusage\Traits\Singleton;
use function AwesomeMotive\Miusage\plugin;

/**
 * Class Assets.
 *
 * @package AwesomeMotive\Miusage
 */
class Assets {

	use Singleton;

	/**
	 * Load automatically when class initiate
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
	}

	/**
	 * Enqueue scripts and style in admin area
	 *
	 * @return void
	 */
	public function admin_enqueue_scripts() {
		$current_screen = get_current_screen();

		if ( 'toplevel_page_miusage' === $current_screen->base ) {

			// Styles.
			wp_enqueue_style(
				'miusage-style',
				plugin()->assets_dir . '/css/admin.css'
			);

			// Scripts.
			wp_enqueue_script(
				'miusage-script',
				plugin()->assets_dir . '/js/main.js',
				[],
				plugin()->version,
				true
			);

			wp_localize_script(
				'miusage-script',
				'miusage',
				[
					'ajaxUrl' => admin_url( 'admin-ajax.php' ),
					'nonce'   => wp_create_nonce( 'miusage_action' ),
				]
			);
		}
	}
}

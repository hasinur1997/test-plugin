<?php
/**
 * Ajax class
 *
 * @package AwesomeMotive\Miusage
 * @since 1.0.0
 */

namespace AwesomeMotive\Miusage;

use AwesomeMotive\Miusage\Traits\Singleton;

/**
 * Class Ajax
 *
 * @package AwesomeMotive\Miusage
 */
class Ajax {

	use Singleton;

	/**
	 * Load automatically when class initiate
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'wp_ajax_miusage_table_data', [ $this, 'miusage_data' ] );
		add_action( 'wp_ajax_miusage_get_settings', [ $this, 'get_settings' ] );
		add_action( 'wp_ajax_miusage_update_settings', [ $this, 'update_settings' ] );
	}

	/**
	 * Get data
	 *
	 * @return void
	 */
	public function miusage_data() {
		check_ajax_referer( 'miusage_action' );

		$refresh = isset( $_GET['refresh'] ) ? sanitize_text_field( wp_unslash( $_GET['refresh'] ) ) : 'no';

		wp_send_json_success( miusage_get_data( $refresh ) );
	}

	/**
	 * Get settingns.
	 *
	 * @return void
	 */
	public function get_settings() {
		check_ajax_referer( 'miusage_action' );

		$settings = get_option( 'test_project_option' );

		if ( $settings ) {
			$settings = json_decode( $settings );
		}

		wp_send_json( $settings );
	}

	/**
	 * Update settings.
	 *
	 * @return void
	 */
	public function update_settings() {
		check_ajax_referer( 'miusage_action' );

		// Checking user admin capabilities.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$numrows   = isset( $_POST['numrows'] ) ? intval( $_POST['numrows'] ) : 5;
		$humandate = isset( $_POST['humandate'] ) ? sanitize_text_field( wp_unslash( $_POST['humandate'] ) ) : '';
		$emails    = isset( $_POST['emails'] ) ? array_map( 'sanitize_email', wp_unslash( $_POST['emails'] ) ) : [];
		$updated   = false;
		$message   = __( 'Something went wrong. Please try again.', 'wp-miusage' );

		if ( $numrows > 5 ) {
			return new \WP_Error( 'numrows_error', __( 'Number of rows should be 1 to 5.', 'wp-miusage' ) );
		}

		if ( count( $emails ) > 5 ) {
			return new \WP_Error( 'email_error', __( 'Email address should be maximum of 5.', 'wp-miusage' ) );
		}

		$settings = [
			'numrows'   => $numrows,
			'humandate' => $humandate,
			'emails'    => $emails,
		];

		/**
		 * Update settings.
		 */
		if ( update_option( 'test_project_option', wp_json_encode( $settings ) ) ) {
			$updated = true;
			$message = __( 'Settings has been updated successfully.', 'wp-miusage' );
		}

		wp_send_json(
			[
				'updaed'  => $updated,
				'message' => $message,
			]
		);
	}
}

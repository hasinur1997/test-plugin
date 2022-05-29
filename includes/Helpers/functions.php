<?php
/**
 * All common functions.
 *
 * Handle all common functions for the plugin.
 *
 * @package AwesomeMotive\Miusage
 */

// don't call the file directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get api data from the miusage server.
 *
 * @param string $refresh Human readable date status.
 *
 * @return array
 */
function miusage_get_data( $refresh = 'no' ) {
	$transient_key = 'miusage_data';

	$data = get_transient( $transient_key );

	if ( false === $data || 'yes' === $refresh ) {
		$response = wp_remote_get( 'https://miusage.com/v1/challenge/2/static' );

		if ( ! is_wp_error( $response ) ) {
			$data = json_decode( wp_remote_retrieve_body( $response ), true );

			set_transient( $transient_key, $data, HOUR_IN_SECONDS );
		}
	}

	return $data;
}

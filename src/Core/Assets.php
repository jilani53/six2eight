<?php
/**
 * Register assets for the plugin.
 *
 * @package WooAPB\Core
 * @since 1.0.0
 */

namespace WooAPB\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register assets for the plugin.
 */
class Assets {

	/**
	 * Register styles and scripts.
	 *
	 * @return void
	 */
	public static function register() {

		/* Shared */
		wp_register_style(
			'wooapb-base',
			plugins_url( 'assets/shared/css/base.css', WOOAPB_FILE ),
			array(),
			WOOAPB_VERSION
		);

		/* Tab JS code */
		wp_register_script(
			'wooapb-tab',
			plugins_url( 'assets/shared/js/tab.min.js', WOOAPB_FILE ),
			array(),
			WOOAPB_VERSION,
			true
		);
	}

	/**
	 * Enqueue assets.
	 *
	 * @return void
	 */
	public static function enqueue() {
		wp_enqueue_style( 'wooapb-base' );
		wp_enqueue_script( 'wooapb-tab' );
	}
}

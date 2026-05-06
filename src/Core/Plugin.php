<?php
/**
 * Core entry.
 *
 * @package WooAPB
 * @since 1.0.0
 */

namespace WooAPB\Core;

if ( ! function_exists( 'add_action' ) ) {
	exit;
}

use WooAPB\Core\Assets;
use WooAPB\ElementorAddon\ElementorAddon;

/**
 * Core files entry point.
 */
class Plugin {

	/**
	 * Init files.
	 *
	 * @return void
	 */
	public function init() {
		// Register assets.
		add_action( 'init', array( Assets::class, 'register' ) );

		// Register blocks.
		add_action( 'init', array( BlockRegistry::class, 'register' ) );

		// Load block based inline styles.
		add_action( 'enqueue_block_assets', array( Assets::class, 'enqueue' ), 20 );
		add_action( 'wp_enqueue_scripts', array( Assets::class, 'enqueue' ), 20 );

		add_action( 'elementor/widgets/register', array( ElementorAddon::class, 'register_elementor_widgets' ) );
	}
}

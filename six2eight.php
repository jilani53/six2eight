<?php
/**
 * Plugin Name: six2eight
 * Description: Develop 2 section for gutenberg and elementor.
 * Version: 1.0.0
 * Author: Jilani Ahmed
 * License: GPL-2.0-or-later
 *
 * @package six2eight
 */

defined( 'ABSPATH' ) || exit;

define( 'WOOAPB_FILE', __FILE__ );
define( 'WOOAPB_VERSION', '1.0.0' );

require_once __DIR__ . '/vendor/autoload.php';

use WooAPB\Core\Plugin;

/**
 * Bootstrap plugin safely
 */
function wooapb_init() {
	$plugin = new Plugin();
	$plugin->init();
}
add_action( 'plugins_loaded', 'wooapb_init', 20 );

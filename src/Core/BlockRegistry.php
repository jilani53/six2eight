<?php
/**
 * Regier all blocks
 *
 * @package WooAPB\Core
 * @since 1.0.0
 */

namespace WooAPB\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register blocks.
 */
class BlockRegistry {

	/**
	 * Register blocks.
	 *
	 * @return void
	 */
	public static function register(): void {

		$blocks = glob( plugin_dir_path( WOOAPB_FILE ) . 'blocks/*/block.json' );

		foreach ( $blocks as $block_file ) {

			$block_dir = dirname( $block_file );
			$metadata  = wp_json_file_decode( $block_file, array( 'associative' => true ) );

			if ( empty( $metadata['name'] ) ) {
				continue;
			}

			$block_name = str_replace( 'wooapb/', '', $metadata['name'] );

			// kebab-case → PascalCase.
			$pascal_case = str_replace( ' ', '', ucwords( str_replace( '-', ' ', $block_name ) ) );

			$class_name = "\\WooAPB\\Blocks\\$pascal_case\\Render";

			$args = array();

			// Only attach render_callback if class exists.
			if ( class_exists( $class_name ) ) {
				$args['render_callback'] = array( self::class, 'render_block' );
			}

			register_block_type_from_metadata( $block_dir, $args );
		}
	}

	/**
	 * Render block dynamic callback.
	 *
	 * @param array  $attributes Block attributes.
	 * @param string $content    Block content.
	 * @param object $block      Block instance.
	 * @return string
	 */
	public static function render_block( array $attributes, string $content, $block ): string {

		$name = str_replace( 'wooapb/', '', $block->name );

		$pascal_case = str_replace( ' ', '', ucwords( str_replace( '-', ' ', $name ) ) );

		$class_name = "\\WooAPB\\Blocks\\$pascal_case\\Render";

		if ( class_exists( $class_name ) ) {
			return $class_name::render( $attributes, $content, $block );
		}

		return $content; // Fallback for static safety.
	}
}

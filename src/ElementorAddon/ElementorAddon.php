<?php

namespace WooAPB\ElementorAddon;

use WooAPB\ElementorAddon\Widgets\Accordion;
use WooAPB\ElementorAddon\Widgets\BusinessGrowth;

/**
 * Elementor Addon
 */
class ElementorAddon {

	/**
	 * Register Elementor Widgets
	 *
	 * @param [type] $widgets_manager Elementor widgets manager.
	 * @return void
	 */
	public static function register_elementor_widgets( $widgets_manager ) {
		$widgets_manager->register( new Accordion() );
		$widgets_manager->register( new BusinessGrowth() );
	}
}

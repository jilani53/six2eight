<?php
/**
 * Elementor accordion widget.
 *
 * @package WooAPB\Query
 * @since 1.0.0
 */

namespace WooAPB\ElementorAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Elementor accordion widget.
 */
class Accordion extends Widget_Base {

	/**
	 * Get name.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return 'business_accordion';
	}

	/**
	 * Get title.
	 *
	 * @return string
	 */
	public function get_title(): string {
		return esc_html__( 'six2eight Accordion', 'elementor-addon' );
	}

	/**
	 * Get icon.
	 *
	 * @return string
	 */
	public function get_icon(): string {
		return 'eicon-accordion';
	}

	/**
	 * G
	 *
	 * @return array
	 */
	public function get_categories(): array {
		return array( 'basic' );
	}

	/**
	 * Controls
	 */
	protected function register_controls(): void {

		/**
		 * Header Section
		 */
		$this->start_controls_section(
			'section_header',
			array(
				'label' => esc_html__( 'Header', 'elementor-addon' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'elementor-addon' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'CMO’s <em>Guide</em> to Ecommerce <em>Profitability</em>',
				'label_block' => true,
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => esc_html__( 'Description', 'elementor-addon' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Most consultants create dependency…',
			)
		);

		$this->end_controls_section();

		/**
		 * Accordion Items
		 */
		$this->start_controls_section(
			'section_items',
			array(
				'label' => esc_html__( 'Accordion Items', 'elementor-addon' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_title',
			array(
				'label'       => esc_html__( 'Accordion Title', 'elementor-addon' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Accordion Title',
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'is_default_open',
			array(
				'label'        => esc_html__( 'Default Open', 'elementor-addon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => 'Yes',
				'label_off'    => 'No',
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$repeater->add_control(
			'content',
			array(
				'label'   => esc_html__( 'Content (HTML)', 'elementor-addon' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => '<h4>Title</h4><p>Paragraph</p>',
			)
		);

		$this->add_control(
			'items',
			array(
				'label'       => esc_html__( 'Items', 'elementor-addon' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ item_title }}}',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render
	 */
	protected function render(): void {

		$settings = $this->get_settings_for_display();
		?>

		<section class="wpn-accordion" data-wpn-accordion="true">

			<div class="wpn-accordion__header">
				<h2><?php echo wp_kses_post( $settings['title'] ); ?></h2>
				<p><?php echo esc_html( $settings['description'] ); ?></p>
			</div>

			<div class="wpn-accordion__body">

				<div class="wpn-accordion__nav" data-wpn-nav="true">

					<?php if ( ! empty( $settings['items'] ) ) : ?>
						<?php
						foreach ( $settings['items'] as $index => $item ) :

							$is_open = ( 'yes' === $item['is_default_open'] && 0 === $index );

							$item_classes = 'wpn-accordion-item';
							if ( $is_open ) {
								$item_classes .= ' is-default-open is-open';
							}
							?>

							<div class="<?php echo esc_attr( $item_classes ); ?>" data-wpn-item="true">

								<div class="wpn-accordion-item__nav" aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>">
									<?php echo esc_html( $item['item_title'] ); ?>

									<div class="wpn-accordion-item-icon__container">
										<span class="wpn-accordion-item__icon plus-icon">+</span>
										<span class="wpn-accordion-item__icon minus-icon">–</span>
									</div>
								</div>

								<div class="wpn-accordion-item__panel"
									<?php echo $is_open ? '' : ' hidden'; ?>
									<?php echo $is_open ? 'style="max-height:999px;"' : ''; ?>
								>

									<?php echo wp_kses_post( $item['content'] ); ?>

								</div>

							</div>

						<?php endforeach; ?>
					<?php endif; ?>

				</div>

				<div class="wpn-accordion__content" data-wpn-content="true"></div>

			</div>

		</section>

		<?php
	}

	/**
	 * Editor Preview
	 */
	protected function content_template(): void {
		?>
		<section class="wpn-accordion" data-wpn-accordion="true">

			<div class="wpn-accordion__header">
				<h2>{{{ settings.title }}}</h2>
				<p>{{{ settings.description }}}</p>
			</div>

			<div class="wpn-accordion__body">

				<div class="wpn-accordion__nav" data-wpn-nav="true">

					<# _.each( settings.items, function( item, index ) {

						let isOpen = item.is_default_open === 'yes' && index === 0;
						let classes = 'wpn-accordion-item';

						if ( isOpen ) {
							classes += ' is-default-open is-open';
						}
					#>

					<div class="{{ classes }}" data-wpn-item="true">

						<div class="wpn-accordion-item__nav" aria-expanded="{{ isOpen ? 'true' : 'false' }}">
							{{{ item.item_title }}}

							<div class="wpn-accordion-item-icon__container">
								<span class="wpn-accordion-item__icon plus-icon">+</span>
								<span class="wpn-accordion-item__icon minus-icon">–</span>
							</div>
						</div>

						<div class="wpn-accordion-item__panel" <# if ( ! isOpen ) { #> hidden <# } #>>
							{{{ item.content }}}
						</div>

					</div>

					<# }); #>

				</div>

				<div class="wpn-accordion__content" data-wpn-content="true"></div>

			</div>

		</section>
		<?php
	}
}
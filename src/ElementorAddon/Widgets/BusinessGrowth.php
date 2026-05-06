<?php
namespace WooAPB\ElementorAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Business Growth
 */
class BusinessGrowth extends Widget_Base {

	/**
	 * Get Name
	 *
	 * @return string
	 */
	public function get_name(): string {
		return 'business_growth';
	}

	/**
	 * Get Title
	 *
	 * @return string
	 */
	public function get_title(): string {
		return esc_html__( 'six2eight Business Growth', 'elementor-addon' );
	}

	/**
	 * Get Icon
	 *
	 * @return string
	 */
	public function get_icon(): string {
		return 'eicon-image-rollover';
	}

	/**
	 * Get Categories
	 *
	 * @return array
	 */
	public function get_categories(): array {
		return array( 'basic' );
	}

	/**
	 * Get Keywords
	 *
	 * @return array
	 */
	public function get_keywords(): array {
		return array( 'growth', 'results', 'business' );
	}

	/**
	 * Register Controls
	 */
	protected function register_controls(): void {

		/**
		 * Featured Section
		 */
		$this->start_controls_section(
			'section_featured',
			array(
				'label' => esc_html__( 'Featured', 'elementor-addon' ),
			)
		);

		$this->add_control(
			'featured_title',
			array(
				'label'       => esc_html__( 'Title', 'elementor-addon' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Results that last beyond the <em>next push</em>',
				'label_block' => true,
			)
		);

		$this->add_control(
			'featured_button_text',
			array(
				'label'   => esc_html__( 'Button Text', 'elementor-addon' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'See All Result',
			)
		);

		$this->add_control(
			'featured_button_url',
			array(
				'label'   => esc_html__( 'Button URL', 'elementor-addon' ),
				'type'    => Controls_Manager::URL,
				'default' => array(
					'url' => '#',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Repeater Section
		 */
		$this->start_controls_section(
			'section_items',
			array(
				'label' => esc_html__( 'Growth Items', 'elementor-addon' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'amount',
			array(
				'label'       => esc_html__( 'Amount', 'elementor-addon' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '$10MM',
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'suffix',
			array(
				'label'   => esc_html__( 'Suffix', 'elementor-addon' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '/yr brand',
			)
		);

		$repeater->add_control(
			'growth_text',
			array(
				'label'       => esc_html__( 'Growth Text', 'elementor-addon' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '+47% revenue YOY, -31% CAC',
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'   => esc_html__( 'Description', 'elementor-addon' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Channel and site tuned to work together',
			)
		);

		$this->add_control(
			'items',
			array(
				'label'       => esc_html__( 'Items', 'elementor-addon' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'amount'      => '$10MM',
						'suffix'      => '/yr brand',
						'growth_text' => '+47% revenue YOY, -31% CAC',
						'description' => 'Channel and site tuned to work together',
					),
				),
				'title_field' => '{{{ amount }}}',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render Frontend
	 */
	protected function render(): void {

		$settings = $this->get_settings_for_display();

		$button_url = ! empty( $settings['featured_button_url']['url'] )
			? esc_url( $settings['featured_button_url']['url'] )
			: '#';

		$button_target   = ! empty( $settings['featured_button_url']['is_external'] ) ? ' target="_blank"' : '';
		$button_nofollow = ! empty( $settings['featured_button_url']['nofollow'] ) ? ' rel="nofollow"' : '';
		?>

		<div class="wpn-results-grid">

			<div class="wpn-results-grid__featured">
				<h2>
					<?php echo wp_kses_post( $settings['featured_title'] ); ?>
				</h2>

				<a href="<?php echo $button_url; ?>" class="wpn-results-grid__button"<?php echo $button_target . $button_nofollow; ?>>
					<?php echo esc_html( $settings['featured_button_text'] ); ?>
				</a>
			</div>

			<div class="wpn-results-grid__items">

				<?php if ( ! empty( $settings['items'] ) ) : ?>
					<?php foreach ( $settings['items'] as $item ) : ?>
						<div class="wp-block-wooapb-growth-result-item">

							<h3>
								<?php echo esc_html( $item['amount'] ); ?>
								<span><?php echo esc_html( $item['suffix'] ); ?></span>
							</h3>

							<p class="wpn-result-growth">
								<?php echo esc_html( $item['growth_text'] ); ?>
							</p>

							<p>
								<?php echo esc_html( $item['description'] ); ?>
							</p>

						</div>
					<?php endforeach; ?>
				<?php endif; ?>

			</div>

		</div>

		<?php
	}

	/**
	 * Live Preview (Editor)
	 */
	protected function content_template(): void {
		?>
		<div class="wpn-results-grid">

			<div class="wpn-results-grid__featured">
				<h2>{{{ settings.featured_title }}}</h2>

				<a href="{{ settings.featured_button_url.url }}" class="wpn-results-grid__button">
					{{{ settings.featured_button_text }}}
				</a>
			</div>

			<div class="wpn-results-grid__items">
				<# if ( settings.items.length ) { #>
					<# _.each( settings.items, function( item ) { #>
						<div class="wp-block-wooapb-growth-result-item">

							<h3>
								{{{ item.amount }}}
								<span>{{{ item.suffix }}}</span>
							</h3>

							<p class="wpn-result-growth">
								{{{ item.growth_text }}}
							</p>

							<p>{{{ item.description }}}</p>

						</div>
					<# }); #>
				<# } #>
			</div>

		</div>
		<?php
	}
}

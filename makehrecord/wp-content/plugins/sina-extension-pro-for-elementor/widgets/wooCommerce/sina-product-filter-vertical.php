<?php

/**
 * Product Filter Vertical Widget.
 *
 * @since 1.9.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Product_Filter_Vertical_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.9.0
	 */
	public function get_name() {
		return 'sina_ext_pro_product_filter_vertical';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.9.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Product Filter Vertical', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.9.0
	 */
	public function get_icon() {
		return 'eicon-filter';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.9.0
	 */
	public function get_categories() {
		return [ 'sina-ext-pro-woocommerce' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.9.0
	 */
	public function get_keywords() {
		return [ 'sina filter', 'sina product', 'woocommerce filter', 'woocommerce product' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.9.0
	 */
	public function get_style_depends() {
		return [
			'sina-ext-pro-widgets',
		];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 1.9.0
	 */
	public function get_script_depends() {
		return [
			'sina-ext-pro-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.9.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Content Settings
		// =======================
			Sina_Pro_Woo_Common_Data::get_product_filter_content($this);
		// End Content Settings
		// =====================


		// Start Filter Settings
		// =======================
			$this->start_controls_section(
				'filter_settings',
				[
					'label' => esc_html__( 'Filter Settings', 'sina-ext-pro' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

			$vertical = new Repeater();

			$vertical->add_control(
				'filter_field',
				[
					'label' => esc_html__( 'Select Item', 'sina-ext-pro' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'filter-title' => esc_html__( 'Title', 'sina-ext-pro' ),
						'filter-search' => esc_html__( 'Search', 'sina-ext-pro' ),
						'filter-price' => esc_html__( 'Price', 'sina-ext-pro' ),
						'filter-orderby' => esc_html__( 'Order By', 'sina-ext-pro' ),
						'filter-sort' => esc_html__( 'Sort', 'sina-ext-pro' ),
						'filter-category' => esc_html__( 'Category', 'sina-ext-pro' ),
						'filter-tags' => esc_html__( 'Tags', 'sina-ext-pro' ),
						'filter-color' => esc_html__( 'Color', 'sina-ext-pro' ),
						'filter-size' => esc_html__( 'Size', 'sina-ext-pro' ),
						'filter-action' => esc_html__( 'Action', 'sina-ext-pro' ),
					],
				]
			);
			$vertical->add_control(
				'filter_label',
				[
					'label' => esc_html__( 'Enter Label', 'sina-ext-pro' ),
					'type' => Controls_Manager::TEXT,
				]
			);

			$this->add_control(
				'filters',
				[
					'label' => esc_html__('Add Filter Opton', 'sina-ext-pro'),
					'type' => Controls_Manager::REPEATER,
					'fields' => $vertical->get_controls(),
					'default' => [
						[
							'filter_field' => 'filter-title',
							'filter_label' => 'FILTER',
						],
						[
							'filter_field' => 'filter-search',
							'filter_label' => 'Search...',
						],
						[
							'filter_field' => 'filter-price',
							'filter_label' => 'Price',
						],
						[
							'filter_field' => 'filter-orderby',
							'filter_label' => 'Order',
						],
						[
							'filter_field' => 'filter-sort',
							'filter_label' => 'Sort',
						],
						[
							'filter_field' => 'filter-category',
							'filter_label' => 'Category',
						],
						[
							'filter_field' => 'filter-color',
							'filter_label' => 'Color',
						],
						[
							'filter_field' => 'filter-size',
							'filter_label' => 'Size',
						],
						[
							'filter_field' => 'filter-action',
						],
					],
					'title_field' => '{{{filter_field.replace(/filter-/gi, " ")}}}',
				]
			);

			$this->end_controls_section();
		// End Filter Settings
		// =====================


		// Start Filter Labels Style
		// ===========================
		$this->start_controls_section(
			'filter_labels_style',
			[
				'label' => esc_html__( 'Fields', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'filter_labels_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '14',
						],
					],
					'line_height'   => [
						'default' => [
							'unit' => 'px',
							'size' => '22',
						],
					],
					'font_weight' => [
						'default' => '600',
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-wc-profil-label, {{WRAPPER}} .sina-pro-wc-profil-label span',
			]
		);
		$this->add_control(
			'filter_labels_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-profil-label' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'filter_content_border',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'color' => [
						'default' => '#ccc',
					],
					'width' => [
						'default' => [
							'top' => '0',
							'right' => '0',
							'bottom' => '1',
							'left' => '0',
							'isLinked' => true,
						]
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-wc-profil-content',
			]
		);
		$this->add_responsive_control(
			'filter_content_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '0',
					'bottom' => '10',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-profil-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Filter Labels Style
		// =========================


		Sina_Pro_Woo_Common_Data::filter_title_styles($this);
		Sina_Pro_Woo_Common_Data::filter_search_styles($this);
		Sina_Pro_Woo_Common_Data::filter_price_styles($this);


		// Start Filter Apply Style
		// =========================
		$this->start_controls_section(
			'wc_filter_apply_style',
			[
				'label' => esc_html__( 'Apply', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		Sina_Pro_Woo_Common_Data::buttons_styles($this, '.sina-pro-wc-profil-submit', 'wc_filter_apply_');
		$this->add_responsive_control(
			'wc_filter_apply_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '20',
					'right' => '20',
					'bottom' => '20',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-profil-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Filter Apply Style
		// =========================


		// Start Filter Reset Style
		// =========================
		$this->start_controls_section(
			'wc_filter_reset_style',
			[
				'label' => esc_html__( 'Reset', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		Sina_Pro_Woo_Common_Data::buttons_styles($this, '.sina-pro-wc-profil-reset', 'wc_filter_reset_');
		$this->add_responsive_control(
			'wc_filter_reset_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-profil-reset' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Filter Reset Style
		// =========================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$id = $this->get_id();

		if ( class_exists( 'WooCommerce' ) ):
				?>
				<form class="sina-pro-wc-product-filter-vertical" action="" method="get">
					<?php
						foreach ($data['filters'] as $item) {
							include SINA_EXT_PRO_WOO_PARTIALS.$item['filter_field'].'.php';
						}
					?>
				</form><!-- .sina-pro-wc-product-filter-vertical -->
				<?php
		else:
			printf('<h3>%s</h3>', esc_html__('Please install and activate the WooCommerce plugin to use this feature!', 'sina-ext-pro') );
		endif;
	}


	protected function _content_template() {

	}
}
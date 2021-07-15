<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Pro_Woo_Common_Data Class for Common Controls.
 *
 * @since 1.8.0
 */

class Sina_Pro_Woo_Common_Data{
	public static function get_product_filter_content($obj) {
		// Start Filter Content
		// ======================
		$obj->start_controls_section(
			'product_filter_content',
			[
				'label' => esc_html__( 'Filter Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$obj->add_control(
			'filter_close_icon',
			[
				'label' => esc_html__( 'Close Icon', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
				'default' => 'icofont icofont-rounded-down',
			]
		);
		$obj->add_control(
			'filter_open_icon',
			[
				'label' => esc_html__( 'Open Icon', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
				'default' => 'icofont icofont-rounded-up',
			]
		);
		$obj->add_control(
			'filter_search_icon',
			[
				'label' => esc_html__( 'Search Icon', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
				'default' => 'icofont icofont-search-2',
			]
		);
		$obj->add_control(
			'filter_action_label',
			[
				'label' => esc_html__( 'Action Label', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'APPLY',
			]
		);
		$obj->add_control(
			'filter_reset_label',
			[
				'label' => esc_html__( 'Reset Label', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Reset All',
			]
		);

		$obj->end_controls_section();
		// End Filter Content
		// ====================
	}


	public static function filter_title_styles($obj, $class = '.sina-pro-wc-profil-title', $prefix = 'wc_filter_title_') {
		// Start Filter Title Style
		// =========================
		$obj->start_controls_section(
			$prefix.'style',
			[
				'label' => esc_html__( 'Title', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$obj->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $prefix.'typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '24',
						],
					],
					'line_height'   => [
						'default' => [
							'unit' => 'px',
							'size' => '32',
						],
					],
					'font_weight' => [
						'default' => '600',
					],
				],
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_control(
			$prefix.'color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} '.$class => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'alignment',
			[
				'label' => esc_html__( 'Alignment', 'sina-ext-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'text-align: {{VALUE}};',
				],
			]
		);

		$obj->end_controls_section();
		// End Filter Title Style
		// =======================
	}


	public static function filter_search_styles($obj, $class = '.sina-pro-wc-profil-search', $prefix = 'wc_filter_search_') {
		// Start Filter Search Style
		// ==========================
		$obj->start_controls_section(
			$prefix.'style',
			[
				'label' => esc_html__( 'Search', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$obj->add_control(
			$prefix.'placeholder_color',
			[
				'label' => esc_html__( 'Placeholder Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#aaa',
				'selectors' => [
					'{{WRAPPER}} '.$class. ' input::-webkit-input-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} '.$class. ' input::-moz-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} '.$class. ' input::-ms-placeholder' => 'color: {{VALUE}};',
					'{{WRAPPER}} '.$class. ' input::placeholder' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => $prefix.'border',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'color' => [
						'default' => '#1085e4',
					],
					'width' => [
						'default' => [
							'top' => '1',
							'right' => '1',
							'bottom' => '1',
							'left' => '1',
							'isLinked' => true,
						]
					],
				],
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_responsive_control(
			$prefix.'radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '40',
					'bottom' => '10',
					'left' => '10',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$obj->add_control(
			$prefix.'search_btn_heading',
			[
				'label' => esc_html__( 'Search Button Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$obj->add_responsive_control(
			$prefix.'search_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'unit' => 'px',
					'size' => '16',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' button' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$obj->add_control(
			$prefix.'search_btn_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} '.$class.' button' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $prefix.'search_btn_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} '.$class.' button',
			]
		);
		$obj->add_responsive_control(
			$prefix.'btn_radius',
			[
				'label' => esc_html__( 'Radius', 'wooprofil' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '4',
					'bottom' => '4',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'search_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '8',
					'right' => '12',
					'bottom' => '8',
					'left' => '12',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$obj->end_controls_section();
		// End Filter Search Style
		// =========================
	}


	public static function filter_price_styles($obj, $class = '.sina-pro-wc-profil-price', $prefix = 'wc_filter_price_') {
		// Start Filter Price Style
		// =========================
		$obj->start_controls_section(
			$prefix.'style',
			[
				'label' => esc_html__( 'Price', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$obj->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $prefix.'typography',
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
							'size' => '20',
						],
					],
					'font_weight' => [
						'default' => '400',
					],
				],
				'selector' => '{{WRAPPER}} '.$class.' label',
			]
		);
		$obj->add_control(
			$prefix.'color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} '.$class.' label' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => $prefix.'border',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'color' => [
						'default' => '#ccc',
					],
					'width' => [
						'default' => [
							'top' => '1',
							'right' => '1',
							'bottom' => '1',
							'left' => '1',
							'isLinked' => true,
						]
					],
				],
				'selector' => '{{WRAPPER}} '.$class.' input',
			]
		);
		$obj->add_responsive_control(
			$prefix.'radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '6',
					'right' => '0',
					'bottom' => '6',
					'left' => '6',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'alignment',
			[
				'label' => esc_html__( 'Alignment', 'sina-ext-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' label' => 'text-align: {{VALUE}};',
				],
			]
		);

		$obj->end_controls_section();
		// End Filter Price Style
		// =======================
	}


	public static function get_post_settings($obj, $post_thumb = false, $read_more = false, $paginate = false, $posts_num = 3, $column = 3 ) {
		// Start Product Settings
		// =======================
		$obj->start_controls_section(
			'posts_settings',
			[
				'label' => esc_html__( 'Product Settings', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$post_taxos = sina_pro_woo_get_taxos('product');

		if ( !empty( $post_taxos ) ) {
			$obj->add_control(
				'post_type_product',
				[
					'label' => esc_html__( 'Select Taxonomy', 'sina-ext-pro' ),
					'label_block' => true,
					'type' => Controls_Manager::SELECT2,
					'options' => $post_taxos,
					'multiple' => true,
					'default' => [ 'product_cat' ],
				]
			);

			foreach ($post_taxos as $post_tax => $tax_name) {
				$post_taxos_terms = sina_get_term_lists($post_tax);

				if ( !empty( $post_taxos_terms ) ) {
					$obj->add_control(
						'post_type_product_'.$post_tax,
						[
							'label' => sprintf(esc_html__( 'Select %s', 'sina-ext-pro' ), $tax_name),
							'label_block' => true,
							'type' => Controls_Manager::SELECT2,
							'options' => $post_taxos_terms,
							'condition' => [
								'post_type_product' => $post_tax,
							],
							'multiple' => true,
							'default' => [],
						]
					);
				}
			}
		}

		$obj->add_control(
			'posts_num',
			[
				'label' => esc_html__( 'Number of Products', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 1,
				'max' => 300,
				'default' => $posts_num,
			]
		);
		$obj->add_control(
			'posts_offset',
			[
				'label' => esc_html__( 'Number of Offset', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 0,
				'max' => 50,
				'default' => 0,
			]
		);
		if ($column) {
			$obj->add_control(
				'posts_columns',
				[
					'label' => esc_html__( 'Number of Column', 'sina-ext-pro' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'sina-pro-wc-col-1' => esc_html__( '1', 'sina-ext-pro' ),
						'sina-pro-wc-col-2' => esc_html__( '2', 'sina-ext-pro' ),
						'sina-pro-wc-col-3' => esc_html__( '3', 'sina-ext-pro' ),
						'sina-pro-wc-col-4' => esc_html__( '4', 'sina-ext-pro' ),
					],
					'default' => 'sina-pro-wc-col-'.$column,
				]
			);
		}
		$obj->add_control(
			'posts_order_by',
			[
				'label' => esc_html__( 'Order by', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'date' => esc_html__( 'Date', 'sina-ext-pro' ),
					'title' => esc_html__( 'Title', 'sina-ext-pro' ),
					'modified' => esc_html__( 'Modified', 'sina-ext-pro' ),
				],
				'default' => 'date',
			]
		);
		$obj->add_control(
			'posts_sort',
			[
				'label' => esc_html__( 'Sort', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ASC' => esc_html__( 'ASC', 'sina-ext-pro' ),
					'DESC' => esc_html__( 'DESC', 'sina-ext-pro' ),
				],
				'default' => 'DESC',
			]
		);
		$obj->add_control(
			'posts_date',
			[
				'label' => esc_html__( 'Sale Label', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Sold',
			]
		);
		$obj->add_control(
			'posts_author',
			[
				'label' => esc_html__( 'Show Cart', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		if ($post_thumb) {
			$obj->add_control(
				'posts_thumbnail',
				[
					'label' => esc_html__( 'Show Thumbnail', 'sina-ext-pro' ),
					'type' => Controls_Manager::SWITCHER,
					'default' => 'yes',
				]
			);
		}
		if ($paginate) {
			$obj->add_control(
				'posts_pagination',
				[
					'label' => esc_html__( 'Show Pagination', 'sina-ext-pro' ),
					'type' => Controls_Manager::SWITCHER,
				]
			);
		}
		$obj->add_control(
			'posts_title',
			[
				'label' => esc_html__( 'Show Title', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'posts_title_length',
			[
				'label' => esc_html__( 'Title Length (Word)', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 0,
				'default' => 4,
				'condition' => [
					'posts_title!' => '',
				],
			]
		);
		$obj->add_control(
			'posts_content',
			[
				'label' => esc_html__( 'Show Content', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'posts_excerpt',
			[
				'label' => esc_html__( 'Show Excerpt', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'posts_content!' => '',
				],
			]
		);
		$obj->add_control(
			'posts_content_length',
			[
				'label' => esc_html__( 'Content Length (Word)', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 0,
				'default' => 10,
				'condition' => [
					'posts_content!' => '',
				],
			]
		);
		if ($read_more) {
			$obj->add_control(
				'posts_read_more',
				[
					'label' => esc_html__( 'Show Purchase Button', 'sina-ext-pro' ),
					'type' => Controls_Manager::SWITCHER,
					'condition' => [
						'posts_content!' => '',
					],
					'default' => 'yes',
				]
			);
		}

		$obj->end_controls_section();
		// End Product Settings
		// ======================
	}


	public static function thumbnail_layout($obj) {
		// Start Thumbnail Layout 
		// ========================
		$obj->start_controls_section(
			'thumbnail_layout',
			[
				'label' => esc_html__( 'Thumbnail Layout', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$thumbs_style1 = new Repeater();

		$thumbs_style1->add_control(
			'odd_thumb',
			[
				'label' => esc_html__( 'Select Item', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sale' => esc_html__( 'Sale', 'sina-ext-pro' ),
					'price' => esc_html__( 'Price', 'sina-ext-pro' ),
					'cart' => esc_html__( 'Cart', 'sina-ext-pro' ),
					'blank' => esc_html__( 'Blank', 'sina-ext-pro' ),
				],
			]
		);

		$obj->add_control(
			'odd_thumb_layout',
			[
				'label' => esc_html__('Post Thumb / Odd Post Thumb Layout', 'sina-ext-pro'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $thumbs_style1->get_controls(),
				'default' => [
					[
						'odd_thumb' => 'sale',
					],
					[
						'odd_thumb' => 'blank',
					],
					[
						'odd_thumb' => 'price',
					],
					[
						'odd_thumb' => 'cart',
					],
				],
				'title_field' => '{{{odd_thumb}}}',
			]
		);

		$thumbs_style2 = new Repeater();

		$thumbs_style2->add_control(
			'even_thumb',
			[
				'label' => esc_html__( 'Select Item', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sale' => esc_html__( 'Sale', 'sina-ext-pro' ),
					'price' => esc_html__( 'Price', 'sina-ext-pro' ),
					'cart' => esc_html__( 'Cart', 'sina-ext-pro' ),
					'blank' => esc_html__( 'Blank', 'sina-ext-pro' ),
				],
			]
		);

		$obj->add_control(
			'even_thumb_layout',
			[
				'label' => esc_html__('Even Post Thumb Layout', 'sina-ext-pro'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $thumbs_style2->get_controls(),
				'default' => [
					[
						'even_thumb' => 'sale',
					],
					[
						'even_thumb' => 'blank',
					],
					[
						'even_thumb' => 'price',
					],
					[
						'even_thumb' => 'cart',
					],
				],
				'condition' => [
					'post_style' => 'style2',
				],
				'title_field' => '{{{even_thumb}}}',
			]
		);

		$obj->end_controls_section();
		// End Thumbnail Layout
		// ======================
	}


	public static function carousel_settings( $obj, $show_item = true, $animation = false, $center = true ) {
		if ($show_item) {
			$obj->add_responsive_control(
				'show_item',
				[
					'label' => esc_html__( 'Show Item', 'sina-ext-pro' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'1' => esc_html__( '1', 'sina-ext-pro' ),
						'2' => esc_html__( '2', 'sina-ext-pro' ),
						'3' => esc_html__( '3', 'sina-ext-pro' ),
						'4' => esc_html__( '4', 'sina-ext-pro' ),
						'5' => esc_html__( '5', 'sina-ext-pro' ),
						'6' => esc_html__( '6', 'sina-ext-pro' ),
						'7' => esc_html__( '7', 'sina-ext-pro' ),
						'8' => esc_html__( '8', 'sina-ext-pro' ),
					],
					'desktop_default' => '2',
					'tablet_default' => '2',
					'mobile_default' => '1',
				]
			);
		}
		$obj->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'Off', 'sina-ext-pro' ),
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'pause',
			[
				'label' => esc_html__( 'Pause on Hover', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'Off', 'sina-ext-pro' ),
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'mouse_drag',
			[
				'label' => esc_html__( 'Mouse Drag', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'Off', 'sina-ext-pro' ),
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'touch_drag',
			[
				'label' => esc_html__( 'Touch Drag', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'Off', 'sina-ext-pro' ),
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'loop',
			[
				'label' => esc_html__( 'Infinity Loop', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'Off', 'sina-ext-pro' ),
				'default' => 'yes',
			]
		);
		$obj->add_control(
			'dots',
			[
				'label' => esc_html__( 'Dots', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'Hide', 'sina-ext-pro' ),
			]
		);
		$obj->add_control(
			'nav',
			[
				'label' => esc_html__( 'Navigation', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'Hide', 'sina-ext-pro' ),
				'default' => 'yes',
			]
		);
		if ($center) {
			$obj->add_control(
				'center',
				[
					'label' => esc_html__( 'Center', 'sina-ext-pro' ),
					'type' => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'On', 'sina-ext-pro' ),
					'label_off' => esc_html__( 'Off', 'sina-ext-pro' ),
				]
			);
		}
		$obj->add_control(
			'delay',
			[
				'label' => esc_html__( 'Delay', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 100,
				'min' => 0,
				'max' => 15000,
				'default' => 5000,
			]
		);
		$obj->add_control(
			'speed',
			[
				'label' => esc_html__( 'Speed', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 100,
				'min' => 0,
				'max' => 5000,
				'default' => 500,
			]
		);
		if ($animation) {
			$obj->add_control(
				'slide_in',
				[
					'label' => esc_html__( 'Slide Animation In', 'sina-ext-pro' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'fadeIn',
					'options' => Sina_Common_Data::animation_in(),
				]
			);
			$obj->add_control(
				'slide_out',
				[
					'label' => esc_html__( 'Slide Animation Out', 'sina-ext-pro' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'fadeOut',
					'options' => Sina_Common_Data::animation_out(),
				]
			);
		}
	}


	public static function buttons_styles( $obj, $class = '.sina-read-more', $prefix = 'read_more') {
		$obj->add_responsive_control(
			$prefix.'_width',
			[
				'label' => esc_html__( 'Min Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => $prefix.'_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '15',
						],
					],
					'line_height'   => [
						'default' => [
							'unit' => 'px',
							'size' => '20',
						],
					],
					'font_weight' => [
						'default' => '400',
					],
				],
				'selector' => '{{WRAPPER}} '.$class,
			]
		);

		$obj->start_controls_tabs( $prefix.'_tabs' );

		$obj->start_controls_tab(
			$prefix.'_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);
		$obj->add_control(
			$prefix.'_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} '.$class => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $prefix.'_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $prefix.'_shadow',
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => $prefix.'_border',
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->end_controls_tab();

		$obj->start_controls_tab(
			$prefix.'_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);
		$obj->add_control(
			$prefix.'_hover_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} '.$class.':hover' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => $prefix.'_hover_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} '.$class.':hover',
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => $prefix.'_hover_shadow',
				'selector' => '{{WRAPPER}} '.$class.':hover',
			]
		);
		$obj->add_control(
			$prefix.'_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} '.$class.':hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$obj->end_controls_tab();

		$obj->end_controls_tabs();

		$obj->add_responsive_control(
			$prefix.'_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			$prefix.'_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '15',
					'bottom' => '10',
					'left' => '15',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}


	public static function dots_styles($obj, $class = '') {
		// Start Dots Style
		// ========================
		$obj->start_controls_section(
			'dots_style',
			[
				'label' => esc_html__( 'Dots', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'dots!' => '',
				],
			]
		);

		$obj->add_control(
			'dots_position',
			[
				'label' => esc_html__( 'Position', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-pro-wc-carousel-dots-inside' => esc_html__( 'Inside', 'sina-ext-pro' ),
					'' => esc_html__( 'Outside', 'sina-ext-pro' ),
				],
				'default' => '',
			]
		);
		$obj->add_control(
			'dots_color',
			[
				'label' => esc_html__( 'Dots Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-dot' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} '.$class.' .owl-dot.active' => 'background-color: {{VALUE}}',
				]
			]
		);
		$obj->add_responsive_control(
			'dots_alignment',
			[
				'label' => esc_html__( 'Alignment', 'sina-ext-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-dots' => 'text-align: {{VALUE}};',
				],
			]
		);
		$obj->add_responsive_control(
			'dots_wrap_padding',
			[
				'label' => esc_html__( 'Wrap Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '20',
					'bottom' => '20',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-dots' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$obj->end_controls_section();
		// End Dots Style
		// ================
	}


	public static function nav_styles($obj, $class = '') {
		// Start Nav Style
		// ==================
		$obj->start_controls_section(
			'nav_style',
			[
				'label' => esc_html__( 'Navigation', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'nav!' => '',
				],
			]
		);

		$obj->add_control(
			'nav_font',
			[
				'label' => esc_html__( 'Navigation', 'sina-ext-pro' ),
				'type' => Controls_Manager::FONT,
				'default' => 'Arial',
				'separator' => 'before',
				'condition' => [
					'nav!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next' => 'font-family: {{VALUE}}',
				],
			]
		);
		$obj->add_control(
			'nav_top',
			[
				'label' => esc_html__( 'Nav Top (%)', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => '44',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'nav_font_size',
			[
				'label' => esc_html__( 'Arrow Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 36,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next' => 'font-size: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$obj->add_responsive_control(
			'nav_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '50',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-nav .owl-next, {{WRAPPER}} '.$class.' .owl-nav .owl-prev' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'nav_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '50',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-nav .owl-next, {{WRAPPER}} '.$class.' .owl-nav .owl-prev' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$obj->start_controls_tabs( 'nav_tabs' );

		$obj->start_controls_tab(
			'nav_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$obj->add_control(
			'nav_color',
			[
				'label' => esc_html__( 'Arrow Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next' => 'color: {{VALUE}}'
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nav_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#f8f8f8',
					],
				],
				'selector' => '{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next',
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nav_shadow',
				'selector' => '{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next',
			]
		);
		$obj->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nav_border',
				'selector' => '{{WRAPPER}} '.$class.' .owl-prev, {{WRAPPER}} '.$class.' .owl-next',
			]
		);

		$obj->end_controls_tab();

		$obj->start_controls_tab(
			'nav_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$obj->add_control(
			'nav_hover_color',
			[
				'label' => esc_html__( 'Arrow Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev:hover, {{WRAPPER}} '.$class.' .owl-next:hover' => 'color: {{VALUE}}'
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nav_hover_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} '.$class.' .owl-prev:hover, {{WRAPPER}} '.$class.' .owl-next:hover',
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nav_hover_shadow',
				'selector' => '{{WRAPPER}} '.$class.' .owl-prev:hover, {{WRAPPER}} '.$class.' .owl-next:hover',
			]
		);
		$obj->add_control(
			'nav_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev:hover, {{WRAPPER}} '.$class.' .owl-next:hover' => 'border-color: {{VALUE}}'
				],
			]
		);

		$obj->end_controls_tab();

		$obj->end_controls_tabs();

		$obj->add_responsive_control(
			'nav_next_radius',
			[
				'label' => esc_html__( 'Nav Next Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '40',
					'right' => '40',
					'bottom' => '40',
					'left' => '40',
					'isLinked' => true,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'nav_prev_radius',
			[
				'label' => esc_html__( 'Nav Prev Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '40',
					'right' => '40',
					'bottom' => '40',
					'left' => '40',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .owl-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$obj->end_controls_section();
		// End Nav Style
		// ================
	}


	public static function box_grid_styles($obj, $align = 'left', $note = false) {
		// Start Box Style
		// =================
		$obj->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Box', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		if ($note) {
			$obj->add_control(
				'box_note',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => esc_html__( 'NOTICE: If you change the "Dimension" then the page need to "Refresh" for seeing the actual result.', 'sina-ext-pro' ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				]
			);
		}

		$obj->add_control(
			'box_effects',
			[
				'label' => esc_html__( 'Effects', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-hover-move' => esc_html__( 'Move', 'sina-ext-pro' ),
					'sina-hover-zoom' => esc_html__( 'Zoom', 'sina-ext-pro' ),
					'' => esc_html__( 'None', 'sina-ext-pro' ),
				],
				'default' => 'sina-hover-move',
			]
		);
		$obj->add_responsive_control(
			'box_zoom',
			[
				'label' => esc_html__( 'Scale', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1.05',
				],
				'condition' => [
					'box_effects' => 'sina-hover-zoom',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-hover-zoom:hover' => 'transform: scale({{SIZE}});',
				],
			]
		);
		$obj->add_control(
			'box_move',
			[
				'label' => esc_html__( 'Move', 'sina-ext-pro' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'box_effects' => 'sina-hover-move',
				],
			]
		);

		$obj->start_popover();
			$obj->add_responsive_control(
				'box_translateX',
				[
					'label' => esc_html__( 'Horizontal', 'sina-ext-pro' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'step' => 1,
							'min' => -100,
							'max' => 100,
						],
					],
					'desktop_default' => [
						'size' => '0',
					],
					'tablet_default' => [
						'size' => '0',
					],
					'mobile_default' => [
						'size' => '0',
					],
					'condition' => [
						'box_effects' => 'sina-hover-move',
					],
				]
			);
			$obj->add_responsive_control(
				'box_translateY',
				[
					'label' => esc_html__( 'Vertical', 'sina-ext-pro' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'step' => 1,
							'min' => -100,
							'max' => 100,
						],
					],
					'desktop_default' => [
						'size' => '-10',
					],
					'tablet_default' => [
						'size' => '-10',
					],
					'mobile_default' => [
						'size' => '-10',
					],
					'condition' => [
						'box_effects' => 'sina-hover-move',
					],
					'selectors' => [
						'(desktop){{WRAPPER}} .sina-hover-move:hover' => 'transform: translate({{box_translateX.SIZE || 0}}px, {{box_translateY.SIZE || 0}}px);',
						'(tablet){{WRAPPER}} .sina-hover-move:hover' => 'transform: translate({{box_translateX_tablet.SIZE || 0}}px, {{box_translateY_tablet.SIZE || 0}}px);',
						'(mobile){{WRAPPER}} .sina-hover-move:hover' => 'transform: translate({{box_translateX_mobile.SIZE || 0}}px, {{box_translateY_mobile.SIZE || 0}}px);',
					],
				]
			);
		$obj->end_popover();

		$obj->start_controls_tabs( 'box_tabs' );

		$obj->start_controls_tab(
			'box_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_background',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-wc-post',
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-wc-post',
			]
		);
		$obj->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'color' => [
						'default' => '#f8f8f8',
					],
					'width' => [
						'default' => [
							'top' => '1',
							'right' => '1',
							'bottom' => '1',
							'left' => '1',
							'isLinked' => true,
						]
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-wc-post',
			]
		);

		$obj->end_controls_tab();

		$obj->start_controls_tab(
			'box_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_hover_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-pro-wc-post:hover',
			]
		);
		$obj->add_control(
			'box_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-wc-post:hover',
			]
		);

		$obj->add_control(
			'box_hover_title_heading',
			[
				'label' => esc_html__( 'Title Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'posts_title!' => '',
				],
			]
		);
		$obj->add_control(
			'box_hover_title_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'posts_title!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post:hover .sina-pro-wc-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$obj->add_control(
			'box_hover_content_heading',
			[
				'label' => esc_html__( 'Content Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'posts_content!' => '',
				],
			]
		);
		$obj->add_control(
			'box_hover_content_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'posts_content!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post:hover .sina-pro-wc-content' => 'color: {{VALUE}};',
				],
			]
		);

		$obj->add_control(
			'box_hover_read_more_heading',
			[
				'label' => esc_html__( 'Purchase Button Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'posts_read_more!' => '',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_hover_read_more_bg',
				'types' => [ 'classic', 'gradient' ],
				'condition' => [
					'posts_read_more!' => '',
				],
				'selector' => '{{WRAPPER}} .sina-pro-wc-post:hover .sina-read-more',
			]
		);
		$obj->add_control(
			'box_hover_read_more_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'posts_read_more!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post:hover .sina-read-more' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			'box_hover_read_more_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'posts_read_more!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post:hover .sina-read-more' => 'border-color: {{VALUE}};',
				],
			]
		);

		$obj->add_control(
			'box_hover_terms_heading',
			[
				'label' => esc_html__( 'Price Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$obj->add_control(
			'box_hover_terms_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post:hover .sina-pro-wc-price' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			'box_hover_terms_bg',
			[
				'label' => esc_html__( 'Background Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post:hover .sina-pro-wc-price' => 'background-color: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			'box_hover_terms_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post:hover .sina-pro-wc-price' => 'border-color: {{VALUE}};',
				],
			]
		);

		$obj->add_control(
			'box_hover_author_heading',
			[
				'label' => esc_html__( 'Cart Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'posts_author!' => '',
				],
			]
		);
		$obj->add_control(
			'box_hover_author_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'posts_author!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post:hover .sina-pro-wc-cart a' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			'box_hover_author_bg',
			[
				'label' => esc_html__( 'Background Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'posts_author!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post:hover .sina-pro-wc-cart' => 'background-color: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			'box_hover_author_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'posts_author!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post:hover .sina-pro-wc-cart' => 'border-color: {{VALUE}};',
				],
			]
		);

		$obj->add_control(
			'box_hover_date_heading',
			[
				'label' => esc_html__( 'Sale Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'posts_date!' => '',
				],
			]
		);
		$obj->add_control(
			'box_hover_date_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'posts_date!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post:hover .sina-pro-wc-sale' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			'box_hover_date_bg',
			[
				'label' => esc_html__( 'Background Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'posts_date!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post:hover .sina-pro-wc-sale' => 'background-color: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			'box_hover_date_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'posts_date!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post:hover .sina-pro-wc-sale' => 'border-color: {{VALUE}};',
				],
			]
		);

		$obj->end_controls_tab();

		$obj->end_controls_tabs();

		$obj->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'default' => [
					'top' => '8',
					'right' => '8',
					'bottom' => '8',
					'left' => '8',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'box_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '20',
					'right' => '20',
					'bottom' => '0',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '15',
					'bottom' => '15',
					'left' => '15',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$obj->add_responsive_control(
			'box_alignment',
			[
				'label' => esc_html__( 'Alignment', 'sina-ext-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'justify', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => $align,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-post' => 'text-align: {{VALUE}};',
				],
			]
		);

		$obj->end_controls_section();
		// End Box Style
		// ================
	}


	public static function thumb_styles($obj, $is_thumb = true, $height = false, $width = false) {
		// Start Thumb Style
		// =================
		if ($is_thumb) {
			$obj->start_controls_section(
				'thumb_style',
				[
					'label' => esc_html__( 'Thumbnail', 'sina-ext-pro' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'posts_thumbnail!' => '',
					],
				]
			);
		} else {
			$obj->start_controls_section(
				'thumb_style',
				[
					'label' => esc_html__( 'Thumbnail', 'sina-ext-pro' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
		}

		$obj->add_control(
			'thumb_effects',
			[
				'label' => esc_html__( 'Effects', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-pro-wc-zoomin' => esc_html__( 'Zoom In', 'sina-ext-pro' ),
					'sina-pro-wc-zoomout' => esc_html__( 'Zoom Out', 'sina-ext-pro' ),
					'' => esc_html__( 'None', 'sina-ext-pro' ),
				],
			]
		);
		if ($width) {
			$obj->add_responsive_control(
				'thumb_width',
				[
					'label' => esc_html__( 'Width (%)', 'sina-ext-pro' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ '%' ],
					'desktop_default' => [
						'unit' => '%',
						'size' => $width,
					],
					'tablet_default' => [
						'unit' => '%',
						'size' => $width,
					],
					'mobile_default' => [
						'unit' => '%',
						'size' => '100',
					],
					'selectors' => [
						'{{WRAPPER}} .sina-pro-wc-thumb' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$obj->add_responsive_control(
				'content_width',
				[
					'label' => esc_html__( 'Content Width (%)', 'sina-ext-pro' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ '%' ],
					'desktop_default' => [
						'unit' => '%',
						'size' => (100 - $width),
					],
					'tablet_default' => [
						'unit' => '%',
						'size' => (100 - $width),
					],
					'mobile_default' => [
						'unit' => '%',
						'size' => '100',
					],
					'selectors' => [
						'{{WRAPPER}} .sina-pro-wc-thumb-left' => 'width: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .sina-pro-wc-thumb-right' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$obj->add_responsive_control(
				'thumb_spacing',
				[
					'label' => esc_html__( 'Spacing (PX)', 'sina-ext-pro' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'default' => [
						'size' => 20,
					],
					'selectors' => [
						'{{WRAPPER}} .sina-pro-wc-thumb-left' => 'padding-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .sina-pro-wc-thumb-right' => 'padding-right: {{SIZE}}{{UNIT}};',
					],
				]
			);
		}
		if ($height) {
			$obj->add_responsive_control(
				'thumb_height',
				[
					'label' => esc_html__( 'Height', 'sina-ext-pro' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em' ],
					'range' => [
						'px' => [
							'max' => 1000,
						],
						'em' => [
							'max' => 50,
						],
					],
					'default' => [
						'size' => $height,
					],
					'selectors' => [
						'{{WRAPPER}} .sina-pro-wc-thumb' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
		}
		$obj->add_responsive_control(
			'thumb_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '6',
					'right' => '6',
					'bottom' => '6',
					'left' => '6',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'thumb_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$obj->add_control(
			'thumb_overlay',
			[
				'label' => esc_html__( 'Overlay Background', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'thumb_overlay_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => 'rgba(0,0,0,0.4)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-wc-overlay',
			]
		);

		$obj->end_controls_section();
		// End Thumb Style
		// =================
	}


	public static function content_wrap_styles($obj, $class = '.sina-pro-wc-thumb-inner', $alignment = false) {
		// Start Content Wrap Style
		// ===========================
		$obj->start_controls_section(
			'content_wrap_style',
			[
				'label' => esc_html__( 'Content Wrap', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$obj->add_responsive_control(
			'content_wrap_gap',
			[
				'label' => esc_html__( 'Gap From Bottom', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%'],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '20',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'content_wrap_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '15',
					'bottom' => '15',
					'left' => '15',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		if ($alignment) {
			$obj->add_responsive_control(
				'content_wrap_alignment',
				[
					'label' => esc_html__( 'Alignment', 'sina-ext-pro' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'sina-ext-pro' ),
							'icon' => 'fa fa-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'sina-ext-pro' ),
							'icon' => 'fa fa-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'sina-ext-pro' ),
							'icon' => 'fa fa-align-right',
						],
						'justify' => [
							'title' => esc_html__( 'justify', 'sina-ext-pro' ),
							'icon' => 'fa fa-align-justify',
						],
					],
					'default' => 'center',
					'selectors' => [
						'{{WRAPPER}} '.$class => 'text-align: {{VALUE}};',
					],
				]
			);
		}

		$obj->end_controls_section();
		// End Content Wrap Style
		// ========================
	}


	public static function title_styles($obj, $class = '.sina-pro-wc-title') {
		// Start Title Style
		// ===================
		$obj->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_title!' => '',
				],
			]
		);

		$obj->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '18',
						],
					],
					'line_height'   => [
						'default' => [
							'unit' => 'px',
							'size' => '24',
						],
					],
					'font_weight' => [
						'default' => '400',
					],
				],
				'selector' => '{{WRAPPER}} '.$class.', {{WRAPPER}} '.$class.' a',
			]
		);

		$obj->start_controls_tabs( 'title_tabs' );

		$obj->start_controls_tab(
			'title_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$obj->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} '.$class.' a' => 'color: {{VALUE}};',
				],
			]
		);

		$obj->end_controls_tab();

		$obj->start_controls_tab(
			'title_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$obj->add_control(
			'title_hover_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} '.$class.' a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$obj->end_controls_tab();

		$obj->end_controls_tabs();

		$obj->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '15',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$obj->end_controls_section();
		// End Title Style
		// =================
	}


	public static function content_styles($obj, $class = '.sina-pro-wc-content') {
		// Start Content Style
		// =====================
		$obj->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_content!' => '',
				],
			]
		);

		$obj->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
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
							'size' => '18',
						],
					],
					'font_weight' => [
						'default' => '400',
					],
				],
				'selector' => '{{WRAPPER}} '.$class,
			]
		);

		$obj->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} '.$class => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_control(
			'content_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' .sina-pro-wc-content-text' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$obj->end_controls_section();
		// Start Content Style
		// =====================
	}


	public static function price_styles($obj, $class = '.sina-pro-wc-price') {
		// Start Price Style
		// =================
		$obj->start_controls_section(
			'price_style',
			[
				'label' => esc_html__( 'Price Label', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_date!' => '',
				],
			]
		);

		$obj->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
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
							'size' => '18',
						],
					],
					'font_weight' => [
						'default' => '400',
					],
				],
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_control(
			'price_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} '.$class => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'price_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'price_shadow',
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'price_border',
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_responsive_control(
			'price_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'price_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'price_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$obj->end_controls_section();
		// End Price Style
		// ================
	}


	public static function cart_styles($obj, $class = '.sina-pro-wc-cart') {
		// Start Cart Style
		// ====================
		$obj->start_controls_section(
			'author_style',
			[
				'label' => esc_html__( 'Cart Button', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_author!' => '',
				],
			]
		);

		$obj->add_control(
			'cart_icon',
			[
				'label' => esc_html__( 'Icon', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-shopping-cart',
			]
		);
		$obj->add_responsive_control(
			'cart_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'max' => 400,
					],
				],
				'default' => [
					'size' => '20',
				],
				'selectors' => [
					'{{WRAPPER}} '.$class.' i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$obj->start_controls_tabs( 'author_tabs' );

		$obj->start_controls_tab(
			'author_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$obj->add_control(
			'author_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} '.$class.' a' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'author_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} '.$class.' a',
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'author_shadow',
				'selector' => '{{WRAPPER}} '.$class.' a',
			]
		);
		$obj->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'author_border',
				'selector' => '{{WRAPPER}} '.$class.' a',
			]
		);

		$obj->end_controls_tab();

		$obj->start_controls_tab(
			'author_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$obj->add_control(
			'author_hover_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} '.$class.' a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'author_hover_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} '.$class.' a:hover',
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'author_hover_shadow',
				'selector' => '{{WRAPPER}} '.$class.' a:hover',
			]
		);
		$obj->add_control(
			'author_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} '.$class.' a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$obj->end_controls_tab();

		$obj->end_controls_tabs();

		$obj->add_responsive_control(
			'author_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} '.$class.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'author_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} '.$class.' a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'author_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '20',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$obj->end_controls_section();
		// End Cart Style
		// ===================
	}


	public static function sale_styles($obj, $class = '.sina-pro-wc-sale') {
		// Start Sale Style
		// =================
		$obj->start_controls_section(
			'date_style',
			[
				'label' => esc_html__( 'Sale Label', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_date!' => '',
				],
			]
		);

		$obj->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
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
							'size' => '18',
						],
					],
					'font_weight' => [
						'default' => '400',
					],
				],
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_control(
			'date_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} '.$class => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'date_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'date_shadow',
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'date_border',
				'selector' => '{{WRAPPER}} '.$class,
			]
		);
		$obj->add_responsive_control(
			'date_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'date_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'date_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'date_alignment',
			[
				'label' => esc_html__( 'Alignment', 'sina-ext-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'text-align: {{VALUE}};',
				],
			]
		);

		$obj->end_controls_section();
		// End Sale Style
		// ================
	}


	public static function read_more_styles( $obj, $class = '.sina-read-more', $prefix = 'read_more') {
		// Start Purchase Button Style
		// =======================
		$obj->start_controls_section(
			'read_more_style',
			[
				'label' => esc_html__( 'Purchase Button', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_read_more!' => '',
				],
			]
		);

		self::buttons_styles($obj, $class, $prefix);
		$obj->add_responsive_control(
			$prefix.'_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '20',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} '.$class => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($obj, '.sina-read-more', 'read_btn_bg_layer');

		$obj->end_controls_section();
		// End Purchase Button Style
		// =====================
	}


	public static function pagination_styles($obj) {
		// Start Pagination Style
		// ========================
		$obj->start_controls_section(
			'pagination_style',
			[
				'label' => esc_html__( 'Pagination', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_pagination!' => '',
				],
			]
		);

		$obj->add_control(
			'pagination_position',
			[
				'label' => esc_html__( 'Position', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => esc_html__( 'Top', 'sina-ext-pro' ),
					'bottom' => esc_html__( 'Bottom', 'sina-ext-pro' ),
					'both' => esc_html__( 'Both', 'sina-ext-pro' ),
				],
				'default' => 'bottom',
			]
		);
		$obj->add_responsive_control(
			'pagination_gap',
			[
				'label' => esc_html__( 'Gap From Posts', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '40',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-top-pagination' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-pro-wc-bottom-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'pagination_side_gap',
			[
				'label' => esc_html__( 'Gap From Side', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '10',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-pagination' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'pagi_width',
			[
				'label' => esc_html__( 'Min Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '44',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-pagination .page-numbers' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pagi_typography',
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
							'size' => '40',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-wc-pagination .page-numbers',
			]
		);

		$obj->start_controls_tabs( 'pagi_link_tabs' );

		$obj->start_controls_tab(
			'pagi_link_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);
		$obj->add_control(
			'pagi_link_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-pagination .page-numbers' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			'pagi_link_bg',
			[
				'label' => esc_html__( 'Background', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-pagination .page-numbers' => 'background: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pagi_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-wc-pagination .page-numbers',
			]
		);
		$obj->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'pagi_link_border',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'color' => [
						'default' => '#1085e4',
					],
					'width' => [
						'default' => [
							'top' => '1',
							'right' => '1',
							'bottom' => '1',
							'left' => '1',
							'isLinked' => true,
						]
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-wc-pagination .page-numbers',
			]
		);
		$obj->end_controls_tab();

		$obj->start_controls_tab(
			'pagi_link_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);
		$obj->add_control(
			'pagi_link_hover_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-pagination .page-numbers:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			'pagi_link_hover_bg',
			[
				'label' => esc_html__( 'Background', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-pagination .page-numbers:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pagi_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-wc-pagination .page-numbers:hover',
			]
		);
		$obj->add_control(
			'pagi_link_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-pagination .page-numbers:hover',
				],
			]
		);
		$obj->end_controls_tab();

		$obj->start_controls_tab(
			'pagi_link_current',
			[
				'label' => esc_html__( 'Current', 'sina-ext-pro' ),
			]
		);
		$obj->add_control(
			'pagi_link_current_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-pagination .page-numbers.current' => 'color: {{VALUE}};',
				],
			]
		);
		$obj->add_control(
			'pagi_link_current_bg',
			[
				'label' => esc_html__( 'Background', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-pagination .page-numbers.current' => 'background: {{VALUE}};',
				],
			]
		);
		$obj->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pagi_current_bshadow',
				'selector' => '{{WRAPPER}} .sina-pro-wc-pagination .page-numbers.current',
			]
		);
		$obj->add_control(
			'pagi_link_current_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-pagination .page-numbers.current' => 'border-color: {{VALUE}};',
				],
			]
		);

		$obj->end_controls_tab();

		$obj->end_controls_tabs();

		$obj->add_responsive_control(
			'pagi_link_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-pagination .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'pagi_link_spacing',
			[
				'label' => esc_html__( 'Spacing', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '5',
					'right' => '5',
					'bottom' => '5',
					'left' => '5',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-pagination .page-numbers' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$obj->add_responsive_control(
			'pagi_alignment',
			[
				'label' => esc_html__( 'Alignment', 'sina-ext-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-wc-pagination' => 'text-align: {{VALUE}};',
				],
			]
		);

		$obj->end_controls_section();
		// End Pagination Style
		// ======================
	}

}
<?php

/**
 * Posts Gallery Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Plugin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Posts_Gallery_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_ext_pro_posts_gallery';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Posts Gallery', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-gallery-justified';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return [ 'sina-ext-pro-basic' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'sina posts gallery' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.0.0
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
	 * @since 1.0.0
	 */
	public function get_script_depends() {
		return [
			'imagesLoaded',
			'isotope',
			'sina-ext-pro-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 */
	protected function _register_controls() {
		// Start Posts Content
		// ====================
		$this->start_controls_section(
			'posts_content',
			[
				'label' => esc_html__( 'Posts Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout_type',
			[
				'label' => esc_html__( 'Layout Type', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'sina-ext-pro' ),
					'custom' => esc_html__( 'Custom', 'sina-ext-pro' ),
				],
				'default' => 'default',
			]
		);
		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Layout', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'grid' => esc_html__( 'Grid', 'sina-ext-pro' ),
					'list' => esc_html__( 'List', 'sina-ext-pro' ),
					'thumb' => esc_html__( 'Thumb', 'sina-ext-pro' ),
				],
				'default' => 'grid',
			]
		);
		$this->add_control(
			'custom_columns',
			[
				'label' => esc_html__( 'Custom Column', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'You have to enter a series of comma-separated values. That series represents your custom grid. Possible values: 3,4,5,6,7,8,9,12.', 'sina-ext-pro' ),
				'default' => '6,6,4,4,4',
				'condition' => [
					'layout_type' => 'custom',
				],
			]
		);
		$this->add_control(
			'custom_items',
			[
				'label' => esc_html__( 'Items Number', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter the comma-separated items number, those items use for custom height.', 'sina-ext-pro' ),
				'condition' => [
					'layout_type' => 'custom',
					'layout' => 'thumb',
				],
			]
		);
		$this->add_control(
			'columns',
			[
				'label' => esc_html__( 'Number of Column', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => esc_html__( '1', 'sina-ext-pro' ),
					'2' => esc_html__( '2', 'sina-ext-pro' ),
					'3' => esc_html__( '3', 'sina-ext-pro' ),
					'4' => esc_html__( '4', 'sina-ext-pro' ),
				],
				'condition' => [
					'layout_type' => 'default',
				],
				'default' => '3',
			]
		);
		$this->add_control(
			'reset_text',
			[
				'label' => esc_html__( 'Reset Text', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Reset Text', 'sina-ext-pro' ),
				'default' => 'All',
			]
		);
		$this->add_control(
			'categories',
			[
				'label' => esc_html__( 'Categories', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => sina_get_category_ids(),
			]
		);
		$this->add_control(
			'tags',
			[
				'label' => esc_html__( 'Tags', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => sina_get_tag_ids(),        
			]
		);
		Sina_Common_Data::posts_content($this);

		$this->add_control(
			'thumb_right',
			[
				'label' => esc_html__( 'Thumb Right', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'No', 'sina-ext-pro' ),
				'condition' => [
					'layout' => 'list',
				],
			]
		);
		$this->add_control(
			'is_thumb',
			[
				'label' => esc_html__( 'Feature Image', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'No', 'sina-ext-pro' ),
				'default' => 'yes',
				'condition' => [
					'layout' => 'grid',
				],
			]
		);
		$this->add_control(
			'posts_cats',
			[
				'label' => esc_html__( 'Show Categories', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'No', 'sina-ext-pro' ),
			]
		);
		$this->add_control(
			'posts_meta',
			[
				'label' => esc_html__( 'Show Meta', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'No', 'sina-ext-pro' ),
			]
		);
		$this->add_control(
			'posts_avatar',
			[
				'label' => esc_html__( 'Show Avatar', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'No', 'sina-ext-pro' ),
				'condition' => [
					'layout!' => 'thumb',
					'posts_meta!' => '',
				],
			]
		);
		$this->add_control(
			'posts_text',
			[
				'label' => esc_html__( 'Show Content', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'No', 'sina-ext-pro' ),
			]
		);
		$this->add_control(
			'posts_excerpt',
			[
				'label' => esc_html__( 'Show Excerpt', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'No', 'sina-ext-pro' ),
				'condition' => [
					'posts_text' => 'yes',
				]
			]
		);
		$this->add_control(
			'posts_txt_len',
			[
				'label' => esc_html__( 'Content Length (Word)', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 0,
				'max' => 500,
				'default' => 10,
				'condition' => [
					'posts_text' => 'yes',
				]
			]
		);

		$this->end_controls_section();
		// End Posts Content
		// ==================


		// Start Read More Content
		// ========================
		$this->start_controls_section(
			'read_more_content',
			[
				'label' => esc_html__( 'Read More', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'layout!' => 'thumb',
				],
			]
		);
		Sina_Common_Data::button_content( $this, '.sina-read-more', '', 'read_more', false);

		$this->end_controls_section();
		// End Read More Content
		// ======================


		// Start Menu Wrap Style
		// =======================
		$this->start_controls_section(
			'menu_wrap_style',
			[
				'label' => esc_html__( 'Buttons Wrapper', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btns_wrap_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-gallery-btns',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btns_wrap_border',
				'selector' => '{{WRAPPER}} .sina-gallery-btns',
			]
		);
		$this->add_responsive_control(
			'btns_wrap_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-gallery-btns' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btns_wrap_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-gallery-btns' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btns_wrap_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '15',
					'bottom' => '40',
					'left' => '15',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-gallery-btns' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Menu Wrap Style
		// =====================


		// Start Menu Style
		// =====================
		$this->start_controls_section(
			'menu_style',
			[
				'label' => esc_html__( 'Buttons', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-gallery-btn', 'menu_btn' );
		$this->add_responsive_control(
			'menu_btn_width',
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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-gallery-btn' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_btn_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-gallery-btn, {{WRAPPER}} .sina-gallery-btn:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_btn_padding',
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
					'{{WRAPPER}} .sina-gallery-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_btn_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
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
					'{{WRAPPER}} .sina-gallery-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_alignment',
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
					'{{WRAPPER}} .sina-gallery-btns' => 'text-align: {{VALUE}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-gallery-btn', 'btn_bg_layer');

		$this->end_controls_section();
		// End Menu Style
		// =====================


		// Start Thumb Layout Styles
		// Start Thumb Post Style
		// =======================
		$this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Post', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'thumb',
				]
			]
		);

		$this->add_control(
			'box_note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'NOTICE: If you change the "Dimension" then the page need to "Refresh" for seeing the actual result.', 'sina-ext-pro' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);
		$this->add_responsive_control(
			'custom_height',
			[
				'label' => esc_html__( 'Custom Height', 'sina-ext-pro' ),
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
					'size' => 300,
				],
				'condition' => [
					'layout_type' => 'custom',
					'custom_items!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-custom-height .sina-posts-thumb' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_height',
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
					'size' => 300,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts-thumb' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-posts-thumb',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .sina-posts-thumb',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-posts-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '40',
					'right' => '20',
					'bottom' => '40',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts-thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
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
					'{{WRAPPER}} .sina-posts-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'vertical_align',
			[
				'label' => esc_html__( 'Vertical Align', 'sina-ext-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'sina-ext-pro' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext-pro' ),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'sina-ext-pro' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'flex-end',
				'selectors' => [
					'{{WRAPPER}} .sina-posts-thumb' => 'align-items: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'alignment',
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
					'{{WRAPPER}} .sina-posts-content' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'overlay',
			[
				'label' => esc_html__( 'Overlay Background', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'box_overlay_tabs' );

		$this->start_controls_tab(
			'box_overlay_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => 'rgba(0,0,0,0.4)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-posts-thumb .sina-overlay',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_overlay_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_hover_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => 'rgba(0,0,0,0.6)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-posts-thumb:hover .sina-overlay',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// End Thumb Post Style
		// =====================
		// End Thumb Layout Styles


		// Start Grid & List Layout
		// Start Grid Post Style
		// ======================
		$this->start_controls_section(
			'grid_style',
			[
				'label' => esc_html__( 'Post', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'thumb',
				],
			]
		);

		$this->add_control(
			'grid_note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'NOTICE: If you change the "Dimension" then the page need to "Refresh" for seeing the actual result.', 'sina-ext-pro' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);
		$this->add_control(
			'effects',
			[
				'label' => esc_html__( 'Effects', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-hover-move' => esc_html__( 'Move', 'sina-ext-pro' ),
					'sina-hover-zoom' => esc_html__( 'Zoom', 'sina-ext-pro' ),
					'' => esc_html__( 'None', 'sina-ext-pro' ),
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'zoom',
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
					'effects' => 'sina-hover-zoom',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts-col.sina-hover-zoom:hover' => 'transform: scale({{SIZE}});',
				],
			]
		);
		$this->add_control(
			'move',
			[
				'label' => esc_html__( 'Move', 'sina-ext-pro' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'effects' => 'sina-hover-move',
				],
			]
		);

		$this->start_popover();
		$this->add_responsive_control(
			'translateX',
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
					'effects' => 'sina-hover-move',
				],
			]
		);
		$this->add_responsive_control(
			'translateY',
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
					'size' => '-5',
				],
				'tablet_default' => [
					'size' => '-5',
				],
				'mobile_default' => [
					'size' => '-5',
				],
				'condition' => [
					'effects' => 'sina-hover-move',
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .sina-posts-col:hover' => 'transform: translate({{translateX.SIZE || 0}}px, {{translateY.SIZE || 0}}px);',
					'(tablet){{WRAPPER}} .sina-posts-col:hover' => 'transform: translate({{translateX_tablet.SIZE || 0}}px, {{translateY_tablet.SIZE || 0}}px);',
					'(mobile){{WRAPPER}} .sina-posts-col:hover' => 'transform: translate({{translateX_mobile.SIZE || 0}}px, {{translateY_mobile.SIZE || 0}}px);',
				],
			]
		);
		$this->end_popover();


		$this->start_controls_tabs( 'grid_post_tabs' );

		$this->start_controls_tab(
			'grid_post_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'grid_background',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'selector' => '{{WRAPPER}} .sina-posts',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'grid_box_shadow',
				'selector' => '{{WRAPPER}} .sina-posts',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'grid_box_border',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'color' => [
						'default' => '#fafafa',
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
				'selector' => '{{WRAPPER}} .sina-posts',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'grid_post_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'grid_hover_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-posts:hover',
			]
		);
		$this->add_control(
			'grid_box_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-posts:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'grid_box_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-posts:hover',
			]
		);

		$this->add_control(
			'grid_post_hover_title_heading',
			[
				'label' => esc_html__( 'Title Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'grid_post_hover_title_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-posts:hover .sina-posts-title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'grid_post_hover_title_shadow',
				'selector' => '{{WRAPPER}} .sina-posts:hover .sina-posts-title a',
			]
		);

		$this->add_control(
			'grid_post_hover_cats_heading',
			[
				'label' => esc_html__( 'Categories Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'posts_cats!' => '',
				],
			]
		);
		$this->add_control(
			'grid_post_cats_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'posts_cats!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts:hover .sina-posts-cats, {{WRAPPER}} .sina-posts:hover .sina-posts-cats a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'grid_post_cats_bg',
			[
				'label' => esc_html__( 'Background Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'posts_cats!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts:hover .sina-posts-cats' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'grid_post_cats_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'posts_cats!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts:hover .sina-posts-cats, {{WRAPPER}} .sina-posts-cats a' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'grid_post_hover_content_heading',
			[
				'label' => esc_html__( 'Content Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'grid_post_hover_content_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-posts:hover .sina-posts-content' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'grid_post_hover_content_shadow',
				'selector' => '{{WRAPPER}} .sina-posts:hover .sina-posts-content',
			]
		);
		$this->add_control(
			'grid_post_hover_content_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-posts:hover .sina-posts-content' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'grid_post_hover_btn_heading',
			[
				'label' => esc_html__( 'Button Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'grid_post_hover_btn_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-posts:hover .sina-read-more',
			]
		);
		$this->add_control(
			'grid_post_hover_btn_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-posts:hover .sina-read-more' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'grid_post_hover_btn_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-posts:hover .sina-read-more' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'grid_post_hover_meta_heading',
			[
				'label' => esc_html__( 'Meta Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'grid_post_hover_meta_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-posts:hover .sina-posts-meta' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'grid_post_hover_link_color',
			[
				'label' => esc_html__( 'Link Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-posts:hover .sina-posts-meta a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'grid_box_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-posts' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'grid_box_padding',
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
					'{{WRAPPER}} .sina-posts-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'grid_alignment',
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
						'title' => esc_html__( 'Justify', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts-content' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'grid_overlay',
			[
				'label' => esc_html__( 'Overlay Background', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'grid_overlay_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => 'rgba(0,0,0,0.4)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-bg-thumb .sina-overlay',
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-posts');

		$this->end_controls_section();
		// End Grid Post Style
		// =====================
		// End Grid & List Layout


		// Start Title Style
		// =====================
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'   => [
						'default' => [
							'size' => '24',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '32',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-posts-title, {{WRAPPER}} .sina-posts-title a',
			]
		);

		$this->start_controls_tabs( 'title_tabs' );

		$this->start_controls_tab(
			'title_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-posts-title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-posts-title a',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-posts-title a:hover, {{WRAPPER}} .sina-posts-title a:focus' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-posts-title a:hover',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '10',
					'left' => '0',
					'isLinked' => false,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-posts-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Title Style
		// =====================


		// Start Content Style
		// =====================
		$this->start_controls_section(
			'text_style',
			[
				'label' => esc_html__( 'Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'list_thumb_width',
			[
				'label' => esc_html__( 'Thumb Width (%)', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'desktop_default' => [
					'unit' => '%',
					'size' => '40',
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => '100',
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => '100',
				],
				'condition' => [
					'layout' => 'list',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts-list .sina-bg-thumb' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_thumb_height',
			[
				'label' => esc_html__( 'Thumb Height (px)', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
				],
				'desktop_default' => [
					'size' => 225,
				],
				'tablet_default' => [
					'size' => 250,
				],
				'condition' => [
					'layout' => 'list',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts-list .sina-bg-thumb' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_content_width',
			[
				'label' => esc_html__( 'Content Width (%)', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'desktop_default' => [
					'unit' => '%',
					'size' => '60',
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => '100',
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => '100',
				],
				'condition' => [
					'layout' => 'list',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts-list .sina-posts-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'is_content_height',
			[
				'label' => esc_html__( 'Use content Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'No', 'sina-ext-pro' ),
				'condition' => [
					'layout' => 'list',
				],
			]
		);
		$this->add_responsive_control(
			'list_content_height',
			[
				'label' => esc_html__( 'Content Height (px)', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
				],
				'desktop_default' => [
					'size' => 225,
				],
				'tablet_default' => [
					'size' => 250,
				],
				'condition' => [
					'layout' => 'list',
					'is_content_height' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts-list .sina-posts-inner-content' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'   => [
						'default' => [
							'size' => '15',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '24',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-posts-content',
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-posts-content' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .sina-posts-content',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'grid_content_border',
				'selector' => '{{WRAPPER}} .sina-posts-content',
				'condition' => [
					'layout!' => 'thumb',
					'is_content_height' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'grid_content_padding',
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
				'condition' => [
					'layout!' => 'thumb',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Content Style
		// ===================


		// Start Grid Cats Style
		// =======================
		$this->start_controls_section(
			'grid_cats_style',
			[
				'label' => esc_html__( 'Categories', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_cats' => 'yes',
				],
			]
		);

		$this->add_control(
			'grid_cats_position',
			[
				'label' => esc_html__( 'Position', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'before' => esc_html__( 'Before Title', 'sina-ext-pro' ),
					'after' => esc_html__( 'After Title', 'sina-ext-pro' ),
				],
				'default' => 'after',
			]
		);
		$this->add_control(
			'grid_cats_icon',
			[
				'label' => esc_html__( 'Icon', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-folder-open-o',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'grid_cats_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'   => [
						'default' => [
							'size' => '14',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '24',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-posts-cats, {{WRAPPER}} .sina-posts-cats a',
			]
		);
		$this->add_control(
			'grid_cats_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-posts-cats, {{WRAPPER}} .sina-posts-cats a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'grid_cats_bg',
			[
				'label' => esc_html__( 'Background Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-posts-cats' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'grid_cats_border',
				'selector' => '{{WRAPPER}} .sina-posts-cats',
			]
		);
		$this->add_responsive_control(
			'grid_cats_radius',
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
					'{{WRAPPER}} .sina-posts-cats' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'grid_cats_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-posts-cats' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'grid_cats_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '10',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts-cats' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Grid Cats Style
		// =====================


		// Start Meta Style
		// =====================
		$this->start_controls_section(
			'meta_style',
			[
				'label' => esc_html__( 'Meta', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_meta' => 'yes',
				]
			]
		);

		$this->add_control(
			'meta_position',
			[
				'label' => esc_html__( 'Position', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'before' => esc_html__( 'Before Title', 'sina-ext-pro' ),
					'after' => esc_html__( 'After Title', 'sina-ext-pro' ),
				],
				'default' => 'after',
				'condition' => [
					'layout' => 'thumb',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'   => [
						'default' => [
							'size' => '14',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '18',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-posts-meta, {{WRAPPER}} .sina-posts-meta a',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'meta_shadow',
				'selector' => '{{WRAPPER}} .sina-posts-meta, {{WRAPPER}} .sina-posts-meta a',
			]
		);
		$this->add_control(
			'meta_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-posts-meta' => 'color: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'link_tabs' );

		$this->start_controls_tab(
			'link_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);
		$this->add_control(
			'link_color',
			[
				'label' => esc_html__( 'Link Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-posts-meta a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'link_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);
		$this->add_control(
			'link_hover_color',
			[
				'label' => esc_html__( 'Link Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-posts-meta a:hover, {{WRAPPER}} .sina-posts-meta a:focus' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'meta_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '0',
					'bottom' => '5',
					'left' => '0',
					'isLinked' => false,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-posts-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'grid_meta_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => false,
				],
				'condition' => [
					'layout!' => 'thumb',
					'posts_meta' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'grid_meta_border',
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
							'right' => '0',
							'bottom' => '0',
							'left' => '0',
							'isLinked' => false,
						]
					],
				],
				'condition' => [
					'layout!' => 'thumb',
					'posts_meta' => 'yes',
				],
				'selector' => '{{WRAPPER}} .sina-posts-meta',
			]
		);

		$this->end_controls_section();
		// End Meta Style
		// =====================


		// Start Grid Avatar Style
		// =========================
		$this->start_controls_section(
			'grid_avatar_style',
			[
				'label' => esc_html__( 'Avatar', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'thumb',
					'posts_avatar!' => '',
				],
			]
		);

		$this->add_control(
			'grid_avatar_size',
			[
				'label' => esc_html__( 'Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'default' => [
					'size' => '32',
				],
			]
		);
		$this->add_responsive_control(
			'grid_avatar_gap',
			[
				'label' => esc_html__( 'Spacing', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '8',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts-meta .avatar' => 'margin-right: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .sina-posts-meta .avatar' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: auto;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'grid_avatar_bshadow',
				'selector' => '{{WRAPPER}} .sina-posts-meta .avatar',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'grid_avatar_border',
				'selector' => '{{WRAPPER}} .sina-posts-meta .avatar',
			]
		);
		$this->add_responsive_control(
			'grid_avatar_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '16',
					'right' => '16',
					'bottom' => '16',
					'left' => '16',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts-meta .avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Grid Avatar Style
		// =======================


		// Start Grid Read More Style
		// ===========================
		$this->start_controls_section(
			'grid_read_more_style',
			[
				'label' => esc_html__( 'Read More', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'read_more_text!' => '',
				],
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-posts .sina-read-more' );
		$this->add_responsive_control(
			'grid_read_more_radius',
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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-read-more, {{WRAPPER}} .sina-read-more:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'grid_read_more_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '20',
					'bottom' => '10',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'grid_read_more_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '25',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-read-more', 'read_btn_bg_layer');

		$this->end_controls_section();
		// End Grid Read More Style
		// ==========================
	}


	protected function render() {
		$data = $this->get_settings_for_display();

		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} else if ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}

		$new_offset = (int)$data['offset'] + ( ( $paged - 1 ) * (int)$data['posts_num'] );
		$category	= $data['categories'];
		$tags		= $data['tags'];
		$default	= [
			'category__in'		=> $category,
			'tag__in'			=> $tags,
			'orderby'			=> [ $data['order_by'] => $data['sort'] ],
			'posts_per_page'	=> $data['posts_num'],
			'paged'				=> $paged,
			'offset'			=> $new_offset,
			'has_password'		=> false,
			'post_status'		=> 'publish',
			'post__not_in'		=> get_option( 'sticky_posts' ),
		];
		$cats_ids = sina_get_category_ids();
		$txt_len = $data['posts_txt_len'];
		// Post Query
		$post_query = new WP_Query( $default );
		if ( $post_query->have_posts() ) :
			?>
			<div class="sina-posts-gallery <?php echo esc_attr( 'sina-gallery-'.$this->get_id() ); ?>"
			data-uid="<?php echo esc_attr( $this->get_id() ); ?>">

				<div class="sina-gallery-btns">
					<button class="sina-gallery-btn sina-button is-checked <?php echo esc_attr( $data['btn_bg_layer_effects'] ); ?>" data-filter="*"><?php printf('%s', $data['reset_text']); ?></button>
					<?php
						if ( !empty($category) ):
							foreach ($category as $cat_id):
								?>
								<button class="sina-button sina-gallery-btn <?php echo esc_attr( $data['btn_bg_layer_effects'] ); ?>" data-filter=".sina-<?php echo esc_attr( str_replace(' ', '-', $cats_ids[ $cat_id ]) ); ?>">
									<?php printf( '%s', $cats_ids[ $cat_id ] ); ?>
								</button>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>

				<div class="sina-bp-grid">
					<div class="sina-bp-grid-sizer"></div>
					<?php include SINA_EXT_PRO_LAYOUT.'/gallery/'.$data['layout'].'.php'; ?>
					<?php wp_reset_query(); ?>
				</div>

			</div><!-- .sina-posts-gallery -->
			<?php
		else:
			?>
				<h3><?php _e('No Posts found', 'sina-ext-pro'); ?></h3>
			<?php
		endif;
		if ( Plugin::instance()->editor->is_edit_mode() ) {
			$this->render_editor_script();
		}
	}


	protected function render_editor_script() {
		?>
		<script type="text/javascript">
		jQuery( document ).ready(function( $ ) {
			var sinaGalleryClass = '.sina-gallery-'+'<?php echo $this->get_id(); ?>',
				$this = $(sinaGalleryClass),
				$isoGrid = $this.children('.sina-bp-grid');

			$this.imagesLoaded( function() {
				$isoGrid.isotope({
					itemSelector: '.sina-posts-col',
					percentPosition: true,
					masonry: {
						columnWidth: '.sina-bp-grid-sizer',
					}
				});
			});
		});
		</script>
		<?php
	}


	protected function _content_template() {

	}
}

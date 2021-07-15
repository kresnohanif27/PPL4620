<?php

/**
 * Tab Widget.
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
use \Elementor\Repeater;
use \Elementor\Frontend;
use \Sina_Extension\Sina_Ext_Gradient_Text;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Tab_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_ext_pro_tab';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Tab', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-tabs';
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
		return [ 'sina tab', 'sina advanced tab', 'sina virtual tour' ];
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
			'animate-merge',
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
			'sina-ext-pro-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Tab Content
		// =====================
		$this->start_controls_section(
			'tab_content',
			[
				'label' => esc_html__( 'Tabs Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tab_type',
			[
				'label' => esc_html__( 'Tabs Type', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'horizantal' => esc_html__( 'Horizontal', 'sina-ext-pro' ),
					'vertical' => esc_html__( 'Vertical', 'sina-ext-pro' ),
				],
				'default' => 'horizantal',
			]
		);
		$this->add_control(
			'tab_anim',
			[
				'label' => esc_html__( 'Animation', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => Sina_Common_Data::animation(),
				'default' => 'fadeIn',
			]
		);
		$this->add_responsive_control(
			'tab_anim_speed',
			[
				'label' => esc_html__( 'Animation Speed', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'step' => 50,
						'max' => 2000,
					],
				],
				'default' => [
					'size' => '400',
				],
				'condition' => [
					'tab_anim!' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-wrap.animated' => 'animation-duration: {{SIZE}}ms;',
					'{{WRAPPER}} .sina-pro-tab-wrap.animated' => '-webkit-animation-duration: {{SIZE}}ms;',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Button Icon', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
			]
		);
		$repeater->add_control(
			'save_templates',
			[
				'label' => esc_html__( 'Use Save Templates', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$repeater->add_control(
			'template',
			[
				'label' => esc_html__( 'Choose Template', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => sina_get_page_templates(),
				'condition' => [
					'save_templates!' => '',
				],
				'description' => esc_html__('NOTE: Don\'t try to edit after insertion template. If you need to change the style or layout then you try to change the main template then save and then insert', 'sina-ext-pro'),
			]
		);
		$repeater->add_control(
			'label',
			[
				'label' => esc_html__( 'Button Text', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => 'Sina Pro',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Enter Title', 'sina-ext-pro'),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext-pro' ),
				'default' => 'This is short description',
				'condition' => [
					'save_templates' => '',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'desc',
			[
				'label' => esc_html__('Description', 'sina-ext-pro'),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'description' => esc_html__( 'You can use HTML.', 'sina-ext-pro' ),
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
				'condition' => [
					'save_templates' => '',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);


		$repeater->add_control(
			'single_content_style',
			[
				'label' => esc_html__( 'Content Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'save_templates' => '',
				],
			]
		);

		$repeater->add_control(
			'single_title_color',
			[
				'label' => esc_html__( 'Title Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'save_templates' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-wrap{{CURRENT_ITEM}} > .sina-pro-tab-title' => 'color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'single_desc_color',
			[
				'label' => esc_html__( 'Description Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'save_templates' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-wrap{{CURRENT_ITEM}} > .sina-pro-tab-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'single_wrap_style',
			[
				'label' => esc_html__( 'Content Wrapper Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'single_wrap_bg',
				'types' => [ 'classic' ],
				'selector' => '{{WRAPPER}} .sina-pro-tab-wrap{{CURRENT_ITEM}}',
			]
		);
		$repeater->add_control(
			'single_wrap_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-wrap{{CURRENT_ITEM}}' => 'border-color: {{VALUE}};',
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'single_wrap_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-tab-wrap{{CURRENT_ITEM}}',
			]
		);


		$repeater->add_control(
			'single_btn_style',
			[
				'label' => esc_html__( 'Button Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->start_controls_tabs( 'btn_tabs' );

		$repeater->start_controls_tab(
			'btn_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$repeater->add_control(
			'single_btn_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btn{{CURRENT_ITEM}}' => 'color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'single_btn_bg',
			[
				'label' => esc_html__( 'Background Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btn{{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'single_btn_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btn{{CURRENT_ITEM}}' => 'border-color: {{VALUE}};',
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'single_btn_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-tab-btn{{CURRENT_ITEM}}',
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'btn_active',
			[
				'label' => esc_html__( 'Active', 'sina-ext-pro' ),
			]
		);

		$repeater->add_control(
			'single_active_btn_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btn.active{{CURRENT_ITEM}}' => 'color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'single_active_btn_bg',
			[
				'label' => esc_html__( 'Background Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btn.active{{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'single_active_btn_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btn.active{{CURRENT_ITEM}}' => 'border-color: {{VALUE}};',
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'single_active_btn_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-tab-btn.active{{CURRENT_ITEM}}',
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'tab_items',
			[
				'label' => esc_html__( 'Add item', 'sina-ext-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'label' => 'Graphic Design',
						'title' => 'Title of Graphic Design',
						'desc'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
					],
					[
						'label' => 'Web Design',
						'title' => 'Title of Web Design',
						'desc'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
					],
					[
						'label' => 'Photography',
						'title' => 'Title of Photography',
						'desc'  => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
					],
				],
				'title_field' => '{{{ label || title }}}',
			]
		);

		$this->end_controls_section();
		// End Button Content
		// =====================


		// Start Container Styles
		// ========================
		$this->start_controls_section(
			'container_styles',
			[
				'label' => esc_html__( 'Container', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'container_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-pro-tab',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'container_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-tab',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'container_border',
				'selector' => '{{WRAPPER}} .sina-pro-tab',
			]
		);
		$this->add_responsive_control(
			'container_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'container_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'container_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Container Styles
		// ======================


		// Start Buttons Styles
		// =====================
		$this->start_controls_section(
			'btn_wrap_styles',
			[
				'label' => esc_html__( 'Buttons Wrapper', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'buttons_align',
			[
				'label' => esc_html__( 'Align', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-pro-float-left' => esc_html__( 'Left', 'sina-ext-pro' ),
					'sina-pro-float-right' => esc_html__( 'Right', 'sina-ext-pro' ),
				],
				'condition' => [
					'tab_type' => 'vertical',
				],
				'default' => 'sina-pro-float-left',
			]
		);
		$this->add_responsive_control(
			'btn_wrap_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 500,
					],
					'em' => [
						'max' => 50,
					],
				],
				'desktop_default' => [
					'unit' => '%',
					'size' => '20',
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => '30',
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => '100',
				],
				'condition' => [
					'tab_type' => 'vertical',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btns' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_wrap_width2',
			[
				'type' => Controls_Manager::HIDDEN,
				'default' => '100%',
				'condition' => [
					'tab_type' => 'horizantal',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btns' => 'width: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_wrap_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 100,
					],
				],
				'condition' => [
					'tab_type' => 'vertical',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btns' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_wrap_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-pro-tab-btns',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_wrap_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-tab-btns',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_wrap_border',
				'selector' => '{{WRAPPER}} .sina-pro-tab-btns',
			]
		);
		$this->add_responsive_control(
			'btn_wrap_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btns' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_wrap_padding',
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
					'{{WRAPPER}} .sina-pro-tab-btns' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_wrap_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btns' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_hor_alignment',
			[
				'label' => esc_html__( 'Alignment', 'sina-ext-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'condition' => [
					'tab_type' => 'horizantal',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btns' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_ver_alignment',
			[
				'label' => esc_html__( 'Alignment', 'sina-ext-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'condition' => [
					'tab_type' => 'vertical',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btns' => 'align-items: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'buttons_position',
			[
				'label' => esc_html__( 'Position', 'sina-ext-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Top', 'sina-ext-pro' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Middle', 'sina-ext-pro' ),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => esc_html__( 'Bottom', 'sina-ext-pro' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'center',
				'condition' => [
					'tab_type' => 'vertical',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btns' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Buttons Wrap
		// ==================


		// Start Button Style
		// =====================
		$this->start_controls_section(
			'button_styles',
			[
				'label' => esc_html__( 'Buttons', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_styles',
			[
				'label' => esc_html__( 'Icon', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_position',
			[
				'label' => esc_html__( 'Icon Position', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-icon-left' => esc_html__( 'Left', 'sina-ext-pro' ),
					'sina-icon-right' => esc_html__( 'Right', 'sina-ext-pro' ),
					'sina-icon-top' => esc_html__( 'Top', 'sina-ext-pro' ),
					'sina-icon-bottom' => esc_html__( 'Bottom', 'sina-ext-pro' ),
				],
				'default' => 'sina-icon-left',
			]
		);
		$this->add_responsive_control(
			'icon_space',
			[
				'label' => esc_html__( 'Icon Spacing', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '5',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btn .sina-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-pro-tab-btn .sina-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-pro-tab-btn .sina-icon-top' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-pro-tab-btn .sina-icon-bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .sina-pro-tab-btn .sina-icon-right' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left: auto;',
					'.rtl {{WRAPPER}} .sina-pro-tab-btn .sina-icon-left' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: auto;',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '16',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'icon_tabs' );

		$this->start_controls_tab(
			'icon_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);
		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'icon_color',
				'selector' => '{{WRAPPER}} .sina-pro-tab-btn i',
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fafafa',
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_active',
			[
				'label' => esc_html__( 'Active', 'sina-ext-pro' ),
			]
		);

		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'icon_color_active',
				'selector' => '{{WRAPPER}} .sina-pro-tab-btn.active i',
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fafafa',
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'btn_styles',
			[
				'label' => esc_html__( 'Buttons', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 400,
					],
					'em' => [
						'max' => 40,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '160',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 300,
					],
					'em' => [
						'max' => 30,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '50',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btn' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		Sina_Common_Data::button_style_active( $this, '.sina-pro-tab-btn', 'btn' );
		$this->add_responsive_control(
			'btn_padding',
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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_margin',
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
					'{{WRAPPER}} .sina-pro-tab-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Buttons Style
		// =====================


		// Start Content Wrapper Style
		// ============================
		$this->start_controls_section(
			'content_wrap_styles',
			[
				'label' => esc_html__( 'Content Wrapper', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'wrap_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 600,
					],
					'em' => [
						'max' => 60,
					],
				],
				'desktop_default' => [
					'unit' => '%',
					'size' => '80',
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => '70',
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => '100',
				],
				'condition' => [
					'tab_type' => 'vertical',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-container' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wrap_height',
			[
				'label' => esc_html__( 'Min Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 2000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '180',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-wrap' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'wrap_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-pro-tab-container',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wrap_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-tab-container',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wrap_border',
				'selector' => '{{WRAPPER}} .sina-pro-tab-container',
			]
		);
		$this->add_responsive_control(
			'wrap_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wrap_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '20',
					'bottom' => '15',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_alignment',
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
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Content Wrapper Style
		// ==========================


		// Start Content Style
		// =====================
		$this->start_controls_section(
			'content_styles',
			[
				'label' => esc_html__( 'Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'title_color',
				'selector' => '{{WRAPPER}} .sina-pro-tab-wrap > .sina-pro-tab-title',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
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
					'text_transform' => [
						'default' => 'none',
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-tab-wrap > .sina-pro-tab-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-tab-wrap > .sina-pro-tab-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '10',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-wrap > .sina-pro-tab-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'desc_style',
			[
				'label' => esc_html__( 'Description', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-tab-wrap > .sina-pro-tab-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typo',
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
							'size' => '24',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-tab-wrap > .sina-pro-tab-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-tab-wrap > .sina-pro-tab-desc',
			]
		);

		$this->end_controls_section();
		// End Content Style
		// ===================
	}


	protected function render() {
		$data 	= $this->get_settings_for_display();
		$uid 	= uniqid();
		$is_col = '';
		$is_vertical = '';

		if ( 'sina-icon-top' == $data['icon_position'] || 'sina-icon-bottom' == $data['icon_position'] ) {
			$is_col = 'sina-flex-column';
		}
		if ( 'vertical' == $data['tab_type'] ) {
			$is_vertical = 'sina-flex-column';
		}
		?>
		<div class="sina-pro-tab clearfix sina-pro-fix">
			<div class="sina-pro-tab-btns sina-pro-fix <?php echo esc_attr( $is_vertical.' '.$data['buttons_align'] ); ?>">
				<?php foreach ($data['tab_items'] as $key => $item): ?>
					<?php
						$btn_id 	= $uid.'-'.$item[ '_id' ];
						$btn_class  = $item[ '_id' ].' '.$is_col.' '.(0 == $key ? 'active' : '' );
					?>
					<button class="sina-pro-tab-btn elementor-repeater-item-<?php echo esc_attr( $btn_class ); ?>"
						data-id="#sina-pro-tab-<?php echo esc_attr( $btn_id ); ?>">
						<?php if ( $item['icon'] && ('sina-icon-left' == $data['icon_position'] || 'sina-icon-top' == $data['icon_position']) ): ?>
							<span class="<?php echo esc_attr( $data['icon_position'] ); ?>">
								<i class="<?php echo esc_attr( $item['icon'] ); ?>"></i>
							</span>
						<?php endif ?>
						<?php printf('<span class="sina-pro-btn-label">%s</span>', $item['label']); ?>
						<?php if ( $item['icon'] && ('sina-icon-right' == $data['icon_position'] || 'sina-icon-bottom' == $data['icon_position']) ): ?>
							<span class="<?php echo esc_attr( $data['icon_position'] ); ?>">
								<i class="<?php echo esc_attr( $item['icon'] ); ?>"></i>
							</span>
						<?php endif ?>
					</button>
				<?php endforeach; ?>
			</div>
			<div class="sina-pro-tab-container <?php echo esc_attr( $data['buttons_align'] ); ?>">
				<?php foreach ($data['tab_items'] as $key => $wrap): ?>
					<?php
						$wrap_id 	= $uid.'-'.$wrap[ '_id' ];
						$wrap_class = $wrap[ '_id' ].' '.$data['tab_anim'].' '.(0 == $key ? 'active' : '' );

						$title_key = $this->get_repeater_setting_key( 'title', 'tab_items', $key );
						$desc_key = $this->get_repeater_setting_key( 'desc', 'tab_items', $key );

						$this->add_render_attribute( $title_key, 'class', 'sina-pro-tab-title' );
						$this->add_inline_editing_attributes( $title_key );

						$this->add_render_attribute( $desc_key, 'class', 'sina-pro-tab-desc' );
						$this->add_inline_editing_attributes( $desc_key );
					?>
					<div class="sina-pro-tab-wrap animated elementor-repeater-item-<?php echo esc_attr( $wrap_class ); ?>"
						id="sina-pro-tab-<?php echo esc_attr( $wrap_id ); ?>">
						<?php
							if ( 'yes' == $wrap['save_templates'] && $wrap['template'] ) :
								$frontend = new Frontend;
								echo $frontend->get_builder_content( $wrap['template'], true );
							else:
						?>
							<?php if ( $wrap['title'] ): ?>
								<?php printf('<h3 %2$s>%1$s</h3>', $wrap['title'], $this->get_render_attribute_string( $title_key )); ?>
							<?php endif; ?>

							<?php if ( $wrap['desc'] ): ?>
								<?php printf('<div %2$s>%1$s</div>', $wrap['desc'], $this->get_render_attribute_string( $desc_key )); ?>
							<?php endif ?>
						<?php endif; ?>
					</div>
				<?php endforeach ?>
			</div>
		</div><!-- .sina-pro-tab -->
		<?php
	}


	protected function _content_template() {

	}
}
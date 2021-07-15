<?php

/**
 * Testimonial Widget.
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
use \Sina_Extension\Sina_Ext_Gradient_Text;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Testimonial_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_ext_pro_testimonial';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Testimonial', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-testimonial-carousel';
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
		return [ 'sina pro testimonial', 'sina review' ];
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
	    	'owl-carousel',
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
			'jquery-owl',
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
		// Start Testimonial Content
		// ==========================
		$this->start_controls_section(
			'Testimonial_content',
			[
				'label' => esc_html__( 'Testimonial', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'thumbs_float',
			[
				'label' => esc_html__( 'Thumbs Float', 'sina-ext-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'sina-pro-float-left' => [
						'title' => esc_html__( 'Left', 'sina-ext-pro' ),
						'icon' => 'eicon-h-align-left',
					],
					'sina-pro-float-right' => [
						'title' => esc_html__( 'Right', 'sina-ext-pro' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'sina-pro-float-right',
			]
		);

		$this->add_control(
			'is_big_thumb',
			[
				'label' => esc_html__( 'Big Thumb', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'sina-ext-pro' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/review2.jpg',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'name',
			[
				'label' => esc_html__( 'Name', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Name', 'sina-ext-pro' ),
				'default' => 'Jhon Doe',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'position',
			[
				'label' => esc_html__( 'Position', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Position', 'sina-ext-pro' ),
				'default' => 'CEO',
			]
		);
		$repeater->add_control(
			'company',
			[
				'label' => esc_html__( 'Company', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Company Name', 'sina-ext-pro' ),
				'default' => 'Google',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( 'Content', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter Content', 'sina-ext-pro' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext-pro' ),
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'image_style',
			[
				'label' => esc_html__( 'Image Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 400,
					],
					'em' => [
						'max' => 40,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-thumb-image{{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'image_left',
			[
				'label' => esc_html__( 'Left', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 1000,
						'min' => -1000,
					],
				],
			]
		);
		$repeater->add_responsive_control(
			'image_top',
			[
				'label' => esc_html__( 'Top', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 1000,
						'min' => -1000,
					],
				],
			]
		);

		$repeater->start_controls_tabs( 'single_img_tabs' );

		$repeater->start_controls_tab(
			'single_img_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'single_img_shadow',
				'selector' => '{{WRAPPER}} .sina-thumb-image{{CURRENT_ITEM}}',
			]
		);
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'single_img_border',
				'selector' => '{{WRAPPER}} .sina-thumb-image{{CURRENT_ITEM}}',
			]
		);
		$repeater->add_responsive_control(
			'single_img_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-thumb-image{{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'single_img_current',
			[
				'label' => esc_html__( 'Current', 'sina-ext-pro' ),
			]
		);

		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'single_img_current_shadow',
				'selector' => '{{WRAPPER}} .owl-item.current .sina-thumb-image{{CURRENT_ITEM}}',
			]
		);
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'single_img_current_border',
				'selector' => '{{WRAPPER}} .owl-item.current .sina-thumb-image{{CURRENT_ITEM}}',
			]
		);

		$repeater->add_responsive_control(
			'single_img_current_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .owl-item.current .sina-thumb-image{{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'testimonial',
			[
				'label' => esc_html__( 'Add Item', 'sina-ext-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name' => 'Torny Smith',
						'position' => 'Web Designer',
						'company' => 'Fedex',
						'image_left' => [
							'unit' => 'px',
							'size' => '260',
						],
						'image_top' => [
							'unit' => 'px',
							'size' => '40',
						],
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/review1.jpg',
						]
					],
					[
						'name' => 'Jhon Doe',
						'position' => 'CEO',
						'company' => 'YouTube',
						'image_left' => [
							'unit' => 'px',
							'size' => '180',
						],
						'image_top' => [
							'unit' => 'px',
							'size' => '230',
						],
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/review2.jpg',
						]
					],
					[
						'name' => 'Sania Jain',
						'position' => 'Graphic Designer',
						'company' => 'Adobe',
						'image_left' => [
							'unit' => 'px',
							'size' => '200',
						],
						'image_top' => [
							'unit' => 'px',
							'size' => '135',
						],
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/review3.jpg',
						]
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();
		// End Testimonial Content
		// =========================


		// Start Carousel Settings
		// ========================
		$this->start_controls_section(
			'carousel_settings',
			[
				'label' => esc_html__( 'Carousel Settings', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'Off', 'sina-ext-pro' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'pause',
			[
				'label' => esc_html__( 'Pause on Hover', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'Off', 'sina-ext-pro' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nav',
			[
				'label' => esc_html__( 'Navigation', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'Hide', 'sina-ext-pro' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'mouse_drag',
			[
				'label' => esc_html__( 'Mouse Drag', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'Off', 'sina-ext-pro' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'touch_drag',
			[
				'label' => esc_html__( 'Touch Drag', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'Off', 'sina-ext-pro' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'loop',
			[
				'label' => esc_html__( 'Infinity Loop', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'Off', 'sina-ext-pro' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'speed',
			[
				'label' => esc_html__( 'Speed', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 100,
				'min' => 100,
				'max' => 5000,
				'default' => 300,
			]
		);
		$this->add_control(
			'delay',
			[
				'label' => esc_html__( 'Delay', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 100,
				'min' => 1000,
				'max' => 15000,
				'default' => 5000,
			]
		);

		$this->end_controls_section();
		// End Carousel Settings
		// =======================


		// Start Image Wrap
		// ==================
		$this->start_controls_section(
			'image_wrap_styles',
			[
				'label' => esc_html__( 'Image Wrapper', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_wrap_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
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
				'desktop_default' => [
					'unit' => '%',
					'size' => '50',
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => '100',
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => '100',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-thumb-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_wrap_height',
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
				'desktop_default' => [
					'unit' => 'px',
					'size' => '350',
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => '350',
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => '350',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-thumb-wrap' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-content-wrap' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'image_wrap_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => 'rgba(16,133,228,0.1)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-thumb-wrap',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_wrap_shadow',
				'selector' => '{{WRAPPER}} .sina-thumb-wrap',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_wrap_border',
				'selector' => '{{WRAPPER}} .sina-thumb-wrap',
			]
		);
		$this->add_responsive_control(
			'image_wrap_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-thumb-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_wrap_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-thumb-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Image Wrap
		// ==================


		// Start Thumb Image
		// ==================
		$this->start_controls_section(
			'thumb_img_styles',
			[
				'label' => esc_html__( 'Image', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'thumb_img_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 100,
					],
				],
				'desktop_default' => [
					'unit' => 'px',
					'size' => '80',
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => '80',
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => '80',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-thumb-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'thumb_img_tabs' );

		$this->start_controls_tab(
			'thumb_img_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'thumb_img_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'selector' => '{{WRAPPER}} .sina-thumb-image',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'thumb_img_shadow',
				'selector' => '{{WRAPPER}} .sina-thumb-image',
			]
		);
		$this->add_responsive_control(
			'thumb_img_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
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
					'{{WRAPPER}} .sina-thumb-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_img_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
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
					'{{WRAPPER}} .sina-thumb-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'thumb_img_current_normal',
			[
				'label' => esc_html__( 'Current', 'sina-ext-pro' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'thumb_img_current_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .owl-item.current .sina-thumb-image',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'thumb_img_current_shadow',
				'fields_options' => [
					'box_shadow_type' => [ 
						'default' =>'yes' 
					],
					'box_shadow' => [
						'default' => [
							'horizontal' => '0',
							'vertical' => '0',
							'blur' => '20',
							'color' => 'rgba(0,0,0,0.2)',
						]
					]
				],
				'selector' => '{{WRAPPER}} .owl-item.current .sina-thumb-image',
			]
		);
		$this->add_responsive_control(
			'thumb_img_current_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .owl-item.current .sina-thumb-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_img_current_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .owl-item.current .sina-thumb-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// End Thumb Image
		// =================


		// Start Big Thumb
		// =================
		$this->start_controls_section(
			'big_thumb_styles',
			[
				'label' => esc_html__( 'Big Image', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'is_big_thumb' => 'yes',
				],
			]
		);

		Sina_Common_Data::morphing_animation( $this );

		$this->add_responsive_control(
			'big_thumb_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 100,
					],
				],
				'desktop_default' => [
					'unit' => 'px',
					'size' => '140',
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => '140',
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => '140',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-big-thumb' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'big_thumb_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'selector' => '{{WRAPPER}} .sina-big-thumb img',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'big_thumb_shadow',
				'selector' => '{{WRAPPER}} .sina-big-thumb img',
			]
		);
		$this->add_responsive_control(
			'big_thumb_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '80',
					'right' => '80',
					'bottom' => '80',
					'left' => '80',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-big-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'big_thumb_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '8',
					'right' => '8',
					'bottom' => '8',
					'left' => '8',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-big-thumb img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'big_thumb_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '100',
					'right' => '0',
					'bottom' => '0',
					'left' => '80',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-big-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Thumb Image
		// =================


		// Start Content Wrap
		// ====================
		$this->start_controls_section(
			'content_wrap_styles',
			[
				'label' => esc_html__( 'Content Wrapper', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_wrap_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
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
				'desktop_default' => [
					'unit' => '%',
					'size' => '50',
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => '100',
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => '100',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_wrap_height',
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
				'desktop_default' => [
					'unit' => 'px',
					'size' => '350',
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => '350',
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => '410',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-wrap' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_wrap_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-content-wrap',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_wrap_shadow',
				'selector' => '{{WRAPPER}} .sina-content-wrap',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_wrap_border',
				'selector' => '{{WRAPPER}} .sina-content-wrap',
			]
		);
		$this->add_responsive_control(
			'content_wrap_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_wrap_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '20',
					'right' => '20',
					'bottom' => '20',
					'left' => '20',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_wrap_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .sina-content-item' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .sina-content-wrap .owl-nav' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Content Wrap
		// ==================


		// Start Content
		// ===============
		$this->start_controls_section(
			'content_styles',
			[
				'label' => esc_html__( 'Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_style',
			[
				'label' => esc_html__( 'Name', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'name_color',
				'selector' => '{{WRAPPER}} .sina-testimonial-name',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typo',
				'selector' => '{{WRAPPER}} .sina-testimonial-name',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'name_shadow',
				'selector' => '{{WRAPPER}} .sina-testimonial-name',
			]
		);
		$this->add_responsive_control(
			'name_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '10',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-testimonial-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'position_style',
			[
				'label' => esc_html__( 'Position', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'position_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-testimonial-position' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'position_typo',
				'selector' => '{{WRAPPER}} .sina-testimonial-position',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'position_shadow',
				'selector' => '{{WRAPPER}} .sina-testimonial-position',
			]
		);
		$this->add_responsive_control(
			'position_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-testimonial-position' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'company_style',
			[
				'label' => esc_html__( 'Company', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'company_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-testimonial-company' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'company_typo',
				'selector' => '{{WRAPPER}} .sina-testimonial-company',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'company_shadow',
				'selector' => '{{WRAPPER}} .sina-testimonial-company',
			]
		);
		$this->add_responsive_control(
			'company_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '15',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-testimonial-company' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_style',
			[
				'label' => esc_html__( 'Content', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-testimonial-content' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typo',
				'selector' => '{{WRAPPER}} .sina-testimonial-content',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'content_shadow',
				'selector' => '{{WRAPPER}} .sina-testimonial-content',
			]
		);
		$this->add_control(
			'content_is_top',
			[
				'label' => esc_html__( 'Content Top', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '30',
				],
				'condition' => [
					'content_is_top' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-testimonial-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Content
		// =============


		// Start Navigation
		// =================
		$this->start_controls_section(
			'nav_styles',
			[
				'label' => esc_html__( 'Navigation', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'nav' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'nav_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '60',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-carousel .owl-nav .owl-next, {{WRAPPER}} .sina-content-carousel .owl-nav .owl-prev' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'nav_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '60',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-carousel .owl-nav .owl-next, {{WRAPPER}} .sina-content-carousel .owl-nav .owl-prev' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'nav_arrow_size',
			[
				'label' => esc_html__( 'Arrow Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'size' => '20',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-carousel .owl-nav .owl-next, {{WRAPPER}} .sina-content-carousel .owl-nav .owl-prev' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'nav_tabs' );

		$this->start_controls_tab(
			'nav_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$this->add_control(
			'nav_color',
			[
				'label' => esc_html__( 'Arrow Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .sina-content-carousel .owl-nav .owl-next, {{WRAPPER}} .sina-content-carousel .owl-nav .owl-prev' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nav_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'selector' => '{{WRAPPER}} .sina-content-carousel .owl-nav .owl-next, {{WRAPPER}} .sina-content-carousel .owl-nav .owl-prev',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nav_shadow',
				'fields_options' => [
					'box_shadow_type' => [ 
						'default' =>'yes' 
					],
					'box_shadow' => [
						'default' => [
							'horizontal' => '0',
							'vertical' => '5',
							'blur' => '15',
							'color' => 'rgba(0,0,0,0.05)',
						]
					]
				],
				'selector' => '{{WRAPPER}} .sina-content-carousel .owl-nav .owl-next, {{WRAPPER}} .sina-content-carousel .owl-nav .owl-prev',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nav_border',
				'selector' => '{{WRAPPER}} .sina-content-carousel .owl-nav .owl-next, {{WRAPPER}} .sina-content-carousel .owl-nav .owl-prev',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'nav_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$this->add_control(
			'nav_hover_color',
			[
				'label' => esc_html__( 'Arrow Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-content-carousel .owl-nav .owl-next:hover, {{WRAPPER}} .sina-content-carousel .owl-nav .owl-prev:hover' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nav_hover_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-content-carousel .owl-nav .owl-next:hover, {{WRAPPER}} .sina-content-carousel .owl-nav .owl-prev:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nav_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-content-carousel .owl-nav .owl-next:hover, {{WRAPPER}} .sina-content-carousel .owl-nav .owl-prev:hover',
			]
		);
		$this->add_control(
			'nav_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-content-carousel .owl-nav .owl-next:hover, {{WRAPPER}} .sina-content-carousel .owl-nav .owl-prev:hover' => 'border-color: {{VALUE}}'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'nav_margin_top',
			[
				'label' => esc_html__( 'Gap From Content', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '40',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-content-carousel .owl-nav' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'nav_margin_right',
			[
				'label' => esc_html__( 'Space Between', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '30',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-carousel .owl-nav .owl-prev' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'nav_next_radius',
			[
				'label' => esc_html__( 'Nav Next Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '30',
					'right' => '30',
					'bottom' => '30',
					'left' => '30',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-carousel .owl-nav .owl-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'nav_prev_radius',
			[
				'label' => esc_html__( 'Nav Prev Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '30',
					'right' => '30',
					'bottom' => '30',
					'left' => '30',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-carousel .owl-nav .owl-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Navigation
		// ================
	}


	protected function render() {
		$data 	= $this->get_settings_for_display();
		$uid	= uniqid('sina-thumb-carousel-');
		$desktop_css = '';
		$tablet_css = '';
		$morphing_anim_big_thumb = ('yes' == $data['is_morphing_anim_icon'] && $data['morphing_pattern']) ? $data['morphing_pattern'] : '';

		foreach ($data['testimonial'] as $index => $slide) {
			$desktop_css .= '.'. $uid .' .owl-item:nth-child('. ($index+1) .'){transform: translate('. $slide['image_left']['size'] .'px,'. $slide['image_top']['size'] .'px)}';
			$tablet_css .= '.'. $uid .' .owl-item:nth-child('. ($index+1) .'){transform: translate('. $slide['image_left_tablet']['size'] .'px,'. $slide['image_top_tablet']['size'] .'px)}';
		}
		sina_ext_custom_css($desktop_css, $tablet_css);
		?>
		<div class="sina-pro-testimonial clearfix"
		data-autoplay="<?php echo esc_attr( $data['autoplay'] ); ?>"
		data-pause="<?php echo esc_attr( $data['pause'] ); ?>"
		data-nav="<?php echo esc_attr( $data['nav'] ); ?>"
		data-mouse-drag="<?php echo esc_attr( $data['mouse_drag'] ); ?>"
		data-touch-drag="<?php echo esc_attr( $data['touch_drag'] ); ?>"
		data-loop="<?php echo esc_attr( $data['loop'] ); ?>"
		data-speed="<?php echo esc_attr( $data['speed'] ); ?>"
		data-delay="<?php echo esc_attr( $data['delay'] ); ?>"
		data-slides="<?php echo esc_attr( count($data['testimonial']) ) ?>">
			<div class="sina-thumb-wrap <?php echo esc_attr( $data['thumbs_float'] ); ?>">
				<?php if ( 'yes' == $data['is_big_thumb'] ): ?>
					<div class="sina-big-thumb">
						<img class="<?php echo esc_attr( $morphing_anim_big_thumb ); ?>"
						src="<?php echo esc_url( $data['testimonial'][0]['image']['url'] ); ?>"
						alt="<?php _e( 'Placeholder image', 'sina-ext-pro' ); ?>">
					</div>
				<?php endif; ?>
				<div class="sina-thumb-carousel owl-carousel <?php echo esc_attr( $uid ); ?>">
					<?php foreach ($data['testimonial'] as $item): ?>
						<img class="sina-thumb-image animated zoomIn elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>"
						src="<?php echo esc_attr( $item['image']['url'] ); ?>"
						alt="<?php echo esc_attr( $item['name'] ); ?>">
					<?php endforeach; ?>
				</div>
			</div>
			<div class="sina-content-wrap <?php echo esc_attr( $data['thumbs_float'] ); ?>">
				<div class="sina-content-carousel owl-carousel">
					<?php
						foreach ($data['testimonial'] as $key => $content):
							$content_key = $this->get_repeater_setting_key( 'content', 'testimonial', $key );
							$name_key = $this->get_repeater_setting_key( 'name', 'testimonial', $key );
							$position_key = $this->get_repeater_setting_key( 'position', 'testimonial', $key );
							$company_key = $this->get_repeater_setting_key( 'desc', 'testimonial', $key );

							$this->add_render_attribute( $content_key, 'class', 'sina-testimonial-content' );
							$this->add_inline_editing_attributes( $content_key );

							$this->add_render_attribute( $name_key, 'class', 'sina-testimonial-name' );
							$this->add_inline_editing_attributes( $name_key );

							$this->add_render_attribute( $position_key, 'class', 'sina-testimonial-position' );
							$this->add_inline_editing_attributes( $position_key );

							$this->add_render_attribute( $company_key, 'class', 'sina-testimonial-company' );
							$this->add_inline_editing_attributes( $company_key );
						?>
						<div class="sina-content-item">
							<?php if ( 'yes' == $data['content_is_top'] ): ?>
								<?php printf('<div %2$s>%1$s</div>', $content['content'], $this->get_render_attribute_string( $content_key )); ?>
							<?php endif ?>

							<?php if ( $content['name'] ): ?>
								<?php printf('<h4 %2$s>%1$s</h4>', $content['name'], $this->get_render_attribute_string( $name_key )); ?>
							<?php endif; ?>

							<?php if ( $content['position'] ): ?>
								<?php printf('<p %2$s>%1$s</p>', $content['position'], $this->get_render_attribute_string( $position_key )); ?>
							<?php endif; ?>

							<?php if ( $content['company'] ): ?>
								<?php printf('<p %2$s>%1$s</p>', $content['company'], $this->get_render_attribute_string( $company_key )); ?>
							<?php endif; ?>

							<?php if ( 'yes' != $data['content_is_top'] ): ?>
								<?php printf('<div %2$s>%1$s</div>', $content['content'], $this->get_render_attribute_string( $content_key )); ?>
							<?php endif ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div><!-- .sina-pro-testimonial -->
		<?php
	}


	protected function _content_template() {
		?>
		<#
		 var uid = '<?php echo uniqid('sina-thumb-carousel-') ?>';
		 var desktopCss = '';
		 var tabletCss = '';
		 var morphingAnimBigThumb = ('yes' == settings.is_morphing_anim_icon && settings.morphing_pattern) ? settings.morphing_pattern : '';

		  _.each( settings.testimonial, function( slide, index ) {
		 	desktopCss += '.'+ uid +' .owl-item:nth-child('+ (index+1) +'){transform: translate('+ slide.image_left.size +'px, '+ slide.image_top.size +'px)}';
		 	tabletCss += '.'+ uid +' .owl-item:nth-child('+ (index+1) +'){transform: translate('+ slide.image_left_tablet.size +'px, '+ slide.image_top_tablet.size +'px)}';
		 });

		 var outputCss = desktopCss;
		 if (tabletCss) {
		 	outputCss += '@media (max-width: 1024px) {'+ tabletCss +'}';
		 }
		#>
		<style type="text/css">
			{{{outputCss}}}
		</style>
		<div class="sina-pro-testimonial clearfix"
		data-autoplay="{{{settings.autoplay}}}"
		data-pause="{{{settings.pause}}}"
		data-nav="{{{settings.nav}}}"
		data-mouse-drag="{{{settings.mouse_drag}}}"
		data-touch-drag="{{{settings.touch_drag}}}"
		data-loop="{{{settings.loop}}}"
		data-speed="{{{settings.speed}}}"
		data-delay="{{{settings.delay}}}"
		data-slides="{{{settings.testimonial.length}}}">
			<div class="sina-thumb-wrap {{{settings.thumbs_float}}}">
				<# if ('yes' == settings.is_big_thumb) { #>
					<div class="sina-big-thumb">
						<img class="{{{morphingAnimBigThumb}}}"
						src="{{{settings.testimonial[0].image.url}}}"
						alt="Placeholder image">
					</div>
				<# } #>

				<div class="sina-thumb-carousel owl-carousel {{{uid}}}">
					<# _.each( settings.testimonial, function( item, index ) { #>
						<img class="sina-thumb-image animated zoomIn elementor-repeater-item-{{{item._id}}}"
						src="{{{item.image.url}}}"
						alt="{{{item.name}}}">
					<# }); #>
				</div>
			</div>
			<div class="sina-content-wrap {{{settings.thumbs_float}}}">
				<div class="sina-content-carousel owl-carousel">
					<# _.each( settings.testimonial, function( content, key ) {
						var contentKey = view.getRepeaterSettingKey('content', 'testimonial', key);
						var nameKey = view.getRepeaterSettingKey('name', 'testimonial', key);
						var positionKey = view.getRepeaterSettingKey('position', 'testimonial', key);
						var companyKey = view.getRepeaterSettingKey('company', 'testimonial', key);

						view.addRenderAttribute(contentKey, 'class', 'sina-testimonial-content');
						view.addInlineEditingAttributes( contentKey );

						view.addRenderAttribute(nameKey, 'class', 'sina-testimonial-name');
						view.addInlineEditingAttributes( nameKey );

						view.addRenderAttribute(positionKey, 'class', 'sina-testimonial-position');
						view.addInlineEditingAttributes( positionKey );

						view.addRenderAttribute(companyKey, 'class', 'sina-testimonial-company');
						view.addInlineEditingAttributes( companyKey );
						#>
						<div class="sina-content-item">
							<# if ('yes' == settings.content_is_top) { #>
								<div {{{view.getRenderAttributeString( contentKey )}}}>{{{content.content}}}</div>
							<# } #>

							<# if (content.name) { #>
								<h4 {{{view.getRenderAttributeString( nameKey )}}}>{{{content.name}}}</h4>
							<# } #>

							<# if (content.position) { #>
								<p {{{view.getRenderAttributeString( positionKey )}}}>{{{content.position}}}</p>
							<# } #>

							<# if (content.company) { #>
								<p {{{view.getRenderAttributeString( companyKey )}}}>{{{content.company}}}</p>
							<# } #>

							<# if ('yes' != settings.content_is_top) { #>
								<div {{{view.getRenderAttributeString( contentKey )}}}>{{{content.content}}}</div>
							<# } #>
						</div>
					<# }); #>
				</div>
			</div>
		</div><!-- .sina-pro-testimonial -->
		<?php
	}
}
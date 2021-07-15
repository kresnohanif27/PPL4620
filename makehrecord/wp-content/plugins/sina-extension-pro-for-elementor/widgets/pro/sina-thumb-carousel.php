<?php

/**
 * Thumb Carousel Widget.
 *
 * @since 1.6.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Thumb_Carousel_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 1.6.0
	 */
	public function get_name() {
		return 'sina_ext_pro_thumb_carousel';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.6.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Thumb Carousel', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.6.0
	 */
	public function get_icon() {
		return 'eicon-slider-device';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.6.0
	 */
	public function get_categories() {
		return [ 'sina-ext-pro-basic' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.6.0
	 */
	public function get_keywords() {
		return [ 'sina thumb carousel', 'sina thumb slider' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.6.0
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
	 * @since 1.6.0
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
	 * @since 1.6.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Carousel Content
		// =======================
		$this->start_controls_section(
			'carousel_content',
			[
				'label' => esc_html__( 'Carousel Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'big_image',
			[
				'label' => esc_html__( 'Choose Big Image', 'sina-ext-pro' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
			]
		);
		$repeater->add_control(
			'thumb_image',
			[
				'label' => esc_html__( 'Choose Thumb Image', 'sina-ext-pro' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
			]
		);

		$this->add_control(
			'carousel_items',
			[
				'label' => esc_html__( 'Add Item', 'sina-ext-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'big_image' => [
							'url' => SINA_EXT_PRO_URL .'assets/img/accord1.jpg',
						],
						'thumb_image' => [
							'url' => SINA_EXT_PRO_URL .'assets/img/accord1.jpg',
						]
					],
					[
						'big_image' => [
							'url' => SINA_EXT_PRO_URL .'assets/img/accord2.jpg',
						],
						'thumb_image' => [
							'url' => SINA_EXT_PRO_URL .'assets/img/accord2.jpg',
						]
					],
					[
						'big_image' => [
							'url' => SINA_EXT_PRO_URL .'assets/img/accord3.jpg',
						],
						'thumb_image' => [
							'url' => SINA_EXT_PRO_URL .'assets/img/accord3.jpg',
						]
					],
					[
						'big_image' => [
							'url' => SINA_EXT_PRO_URL .'assets/img/accord4.jpg',
						],
						'thumb_image' => [
							'url' => SINA_EXT_PRO_URL .'assets/img/accord4.jpg',
						]
					],
				],
			]
		);

		$this->end_controls_section();
		// End Carousel Content
		// =====================


		// Start Carousel Settings
		// ========================
		$this->start_controls_section(
			'carousel_settings',
			[
				'label' => esc_html__( 'Carousel Settings', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'thumbs_show',
			[
				'label' => esc_html__( 'Thumbs Show Item', 'sina-ext-pro' ),
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
				'desktop_default' => '4',
				'tablet_default' => '3',
				'mobile_default' => '2',
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
				'default' => 500,
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


		// Start Main Image
		// =================
		$this->start_controls_section(
			'main_image_styles',
			[
				'label' => esc_html__( 'Main Image', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'main_image_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 1500,
					],
					'em' => [
						'max' => 70,
					],
				],
				'desktop_default' => [
					'size' => 600,
				],
				'tablet_default' => [
					'size' => 500,
				],
				'mobile_default' => [
					'size' => 400,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-thumb-carousel-main-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumbs_space',
			[
				'label' => esc_html__( 'Space From Thumbs', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-thumb-carousel-main' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'main_image_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'selector' => '{{WRAPPER}} .sina-thumb-carousel-main',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'main_image_shadow',
				'selector' => '{{WRAPPER}} .sina-thumb-carousel-main',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'main_image_border',
				'selector' => '{{WRAPPER}} .sina-thumb-carousel-main',
			]
		);
		$this->add_responsive_control(
			'main_image_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-thumb-carousel-main' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Main Image
		// ===============


		// Start Thumbs Image
		// ===================
		$this->start_controls_section(
			'thumbs_styles',
			[
				'label' => esc_html__( 'Thumbs', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'thumb_image_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 500,
					],
					'em' => [
						'max' => 30,
					],
				],
				'default' => [
					'size' => 150,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-thumb-carousel-thumb-item .sina-bg-cover' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'thumb_image_tabs' );

		$this->start_controls_tab(
			'thumb_image_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'thumbs_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#222',
					],
				],
				'selector' => '{{WRAPPER}} .sina-thumb-carousel-thumb-item',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'thumb_image_border',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'color' => [
						'default' => '#fff',
					],
					'width' => [
						'default' => [
							'top' => '4',
							'right' => '4',
							'bottom' => '4',
							'left' => '4',
							'isLinked' => true,
						]
					],
				],
				'selector' => '{{WRAPPER}} .sina-thumb-carousel-thumb-item',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'thumbs_hover',
			[
				'label' => esc_html__( 'Current', 'sina-ext-pro' ),
			]
		);

		$this->add_control(
			'thumb_image_current_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .owl-item.current .sina-thumb-carousel-thumb-item' => 'border-color: {{VALUE}};'
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'thumb_image_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-thumb-carousel-thumb-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Thumbs Image
		// =================


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

		$this->add_control(
			'nav_top',
			[
				'label' => esc_html__( 'Nav Top (%)', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => '48',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-next, {{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-prev' => 'top: {{SIZE}}{{UNIT}};',
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
					'size' => '50',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-next, {{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-prev' => 'width: {{SIZE}}{{UNIT}};',
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
					'size' => '50',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-next, {{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-prev' => 'height: {{SIZE}}{{UNIT}};',
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
					'size' => '30',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-next, {{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-prev' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-next, {{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-prev' => 'color: {{VALUE}}'
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
				'selector' => '{{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-next, {{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-prev',
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
				'selector' => '{{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-next, {{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-prev',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nav_border',
				'selector' => '{{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-next, {{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-prev',
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
					'{{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-next:hover, {{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-prev:hover' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nav_hover_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-next:hover, {{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-prev:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nav_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-next:hover, {{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-prev:hover',
			]
		);
		$this->add_control(
			'nav_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-next:hover, {{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-prev:hover' => 'border-color: {{VALUE}}'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .sina-pro-thumb-carousel .owl-nav .owl-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Navigation
		// ================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-pro-thumb-carousel"
		data-item-lg="<?php echo esc_attr( $data['thumbs_show'] ); ?>"
		data-item-md="<?php echo esc_attr( $data['thumbs_show_tablet'] ); ?>"
		data-item-sm="<?php echo esc_attr( $data['thumbs_show_mobile'] ); ?>"
		data-autoplay="<?php echo esc_attr( $data['autoplay'] ); ?>"
		data-pause="<?php echo esc_attr( $data['pause'] ); ?>"
		data-nav="<?php echo esc_attr( $data['nav'] ); ?>"
		data-mouse-drag="<?php echo esc_attr( $data['mouse_drag'] ); ?>"
		data-touch-drag="<?php echo esc_attr( $data['touch_drag'] ); ?>"
		data-loop="<?php echo esc_attr( $data['loop'] ); ?>"
		data-speed="<?php echo esc_attr( $data['speed'] ); ?>"
		data-delay="<?php echo esc_attr( $data['delay'] ); ?>"
		data-slides="<?php echo esc_attr( count($data['carousel_items']) ) ?>">
			<div class="sina-thumb-carousel-main-wrap">
				<div class="sina-thumb-carousel-main owl-carousel">
					<?php
						foreach ($data['carousel_items'] as $item):
						?>
						<div class="sina-thumb-carousel-main-item sina-bg-cover"
						style="background-image: url(<?php echo esc_url( $item['big_image']['url'] ); ?>);">
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="sina-thumb-carousel-thumb-wrap ">
				<div class="sina-thumb-carousel-thumb owl-carousel">
					<?php foreach ($data['carousel_items'] as $item): ?>
						<div class="sina-thumb-carousel-thumb-item">
							<div class="sina-bg-cover"
								style="background-image: url(<?php echo esc_url( $item['thumb_image']['url'] ); ?>);">
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div><!-- .sina-pro-thumb-carousel -->
		<?php
	}


	protected function _content_template() {

	}
}
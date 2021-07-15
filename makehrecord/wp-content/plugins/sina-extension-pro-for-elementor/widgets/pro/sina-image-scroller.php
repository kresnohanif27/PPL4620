<?php

/**
 * Image Scroller Widget.
 *
 * @since 1.4.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Image_Scroller_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.4.0
	 */
	public function get_name() {
		return 'sina_ext_pro_image_scroller';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.4.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Image Scroller', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.4.0
	 */
	public function get_icon() {
		return 'eicon-tv';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.4.0
	 */
	public function get_categories() {
		return [ 'sina-ext-pro-basic' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.4.0
	 */
	public function get_keywords() {
		return [ 'sina image scroller', 'content scroller', 'scroll effect' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.4.0
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
	 * @since 1.4.0
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
	 * @since 1.4.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Scroller Content
		// =======================
		$this->start_controls_section(
			'scroller_content',
			[
				'label' => esc_html__( 'Scroller Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'scroller_effects',
			[
				'label'       => esc_html__( 'Effects', 'sina-ext-pro' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'top-to-bottom' => esc_html__( 'Top to Bottom', 'sina-ext-pro' ),
					'bottom-to-top' => esc_html__( 'Bottom to Top', 'sina-ext-pro' ),
					'left-to-right' => esc_html__( 'Left to Right', 'sina-ext-pro' ),
					'right-to-left' => esc_html__( 'Right to Left', 'sina-ext-pro' ),
				],
				'default'	  => 'top-to-bottom',
			]
		);
		$this->add_control(
			'scroll_speed',
			[
				'label' => esc_html__( 'Scroll Speed', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 100,
				'min' => 0,
				'max' => 50000,
				'default' => 4000,
				'selectors' => [
					'{{WRAPPER}} .sina-image-scroller-inner' => 'transition: background {{VALUE}}ms;',
				],
			]
		);
		$this->add_control(
			'scroller_caption',
			[
				'label' => esc_html__( 'Caption', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Caption', 'sina-ext-pro' ),
				'default' => 'Preview',
			]
		);
		$this->add_control(
			'scroller_image',
			[
				'label' => esc_html__( 'Choose Scroller Image', 'sina-ext-pro' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'device_image',
			[
				'label' => esc_html__( 'Choose Device Image', 'sina-ext-pro' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();
		// End Scroller Content
		// =====================


		// Start Wrap Style
		// ==================
		$this->start_controls_section(
			'wrap_style',
			[
				'label' => esc_html__( 'Wrapper', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'wrap_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 2000,
					],
					'em' => [
						'max' => 200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '280',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-image-scroller, {{WRAPPER}} .sina-image-scroller-device' => 'height: {{SIZE}}{{UNIT}};',
				],
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
						'max' => 2000,
					],
					'em' => [
						'max' => 200,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => '100',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-image-scroller, {{WRAPPER}} .sina-image-scroller-device' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wrap_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-image-scroller' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Wrap Style
		// ================


		// Start Scroller Style
		// ======================
		$this->start_controls_section(
			'scroller_style',
			[
				'label' => esc_html__( 'Scroller', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'scroller_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 2000,
					],
					'em' => [
						'max' => 200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '240',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-image-scroller-inner' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'scroller_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 2000,
					],
					'em' => [
						'max' => 200,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => '100',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-image-scroller-inner, {{WRAPPER}} .sina-image-scroller-caption' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'scroller_padding',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-image-scroller' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'scroller_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-image-scroller-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Scroller Style
		// ====================


		// Start Caption Style
		// ====================
		$this->start_controls_section(
			'caption_style',
			[
				'label' => esc_html__( 'Caption', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'scroller_caption!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'   => [
						'default' => [
							'size' => '16',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-image-scroller-caption',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'caption_shadow',
				'selector' => '{{WRAPPER}} .sina-image-scroller-caption',
			]
		);
		$this->add_control(
			'caption_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-image-scroller-caption' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'caption_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-image-scroller-caption',
			]
		);
		$this->add_responsive_control(
			'caption_padding',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '8',
					'right' => '15',
					'bottom' => '8',
					'left' => '15',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-image-scroller-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'caption_alignment',
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
					'{{WRAPPER}} .sina-image-scroller-caption' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Caption Style
		// ==================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-pro-image-scroller">		
			<?php if ( $data['device_image']['url'] ): ?>
				<div class="sina-image-scroller-device"
				style="background-image: url(<?php echo esc_url( $data['device_image']['url'] ); ?>);"></div>
			<?php endif; ?>

			<div class="sina-image-scroller-inner <?php echo esc_attr( $data['scroller_effects'] ); ?>"
				style="background-image: url(<?php echo esc_url( $data['scroller_image']['url'] ); ?>);">
			</div>

			<?php
				if ( $data['scroller_caption'] ):
					printf('<div class="sina-image-scroller-caption">%1$s</div>', $data['scroller_caption']);
				endif;
			?>
		</div><!-- .sina-pro-image-scroller -->
		<?php
	}


	protected function _content_template() {
		?>
		<div class="sina-pro-image-scroller">
			<# if( settings.device_image.url ) { #>
				<div class="sina-image-scroller-device"
				style="background-image: url({{{settings.device_image.url}}});"></div>
			<# } #>

			<div class="sina-image-scroller-inner {{{settings.scroller_effects}}}"
				style="background-image: url({{{settings.scroller_image.url}}});">
			</div>

			<# if( settings.scroller_caption ) { #>
				<div class="sina-image-scroller-caption">{{{settings.scroller_caption}}}</div>
			<# } #>
		</div><!-- .sina-pro-image-scroller -->
		<?php
	}
}
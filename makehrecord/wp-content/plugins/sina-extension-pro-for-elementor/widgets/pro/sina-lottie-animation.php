<?php

/**
 * Lottie Animation Widget.
 *
 * @since 1.6.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Css_Filter;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Lottie_Animation_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 1.6.0
	 */
	public function get_name() {
		return 'sina_ext_pro_lottie_animation';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.6.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Lottie', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.6.0
	 */
	public function get_icon() {
		return 'eicon-animation';
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
		return [ 'sina lottie animation', 'sina animation' ];
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
			'sina-lottie',
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
		// Start Lottie Content
		// =====================
		$this->start_controls_section(
			'lottie_content',
			[
				'label' => esc_html__( 'Lottie Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'file_path',
			[
				'label' => esc_html__( 'JSON file', 'sina-ext-pro' ),
				'type' => Controls_Manager::MEDIA,
				'media_type'  => Sina_Ext_Pro_Files_Upload::MIME_TYPE['json'],
				'description'   => sprintf(
					__('Discover thousands of %sLottie animations%s ready to use.', 'sina-ext-pro'),
					'<a href="https://lottiefiles.com/featured" target="_blank">',
					'</a>'
				),
			]
		);
		$this->add_control(
			'is_linkable',
			[
				'label' => esc_html__( 'Linkable Entire Box', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'sina-ext-pro' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'condition' => [
					'is_linkable' => 'yes',
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => esc_html__( 'Loop', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'reversed',
			[
				'label' => esc_html__( 'Reversed', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'loop' => 'yes',
				],
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'delay',
			[
				'label' => esc_html__( 'Delay', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 100,
				'min' => 0,
				'max' => 15000,
				'default' => 0,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);
		$this->add_control(
			'speed',
			[
				'label' => esc_html__( 'Speed', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 1,
				'default' => 1,
			]
		);
		$this->add_control(
			'event_on_hover',
			[
				'label' => esc_html__( 'Event on Hover', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'None', 'sina-ext-pro' ),
					'play' => esc_html__( 'Play', 'sina-ext-pro' ),
					'pause' => esc_html__( 'Pause', 'sina-ext-pro' ),
					'stop' => esc_html__( 'Stop', 'sina-ext-pro' ),
					'reverse' => esc_html__( 'Reverse', 'sina-ext-pro' ),
				],
				'default' => '',
			]
		);
		$this->add_control(
			'renderer',
			[
				'label' => esc_html__( 'Render Type', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'svg' => esc_html__( 'SVG', 'sina-ext-pro' ),
					'canvas' => esc_html__( 'Canvas', 'sina-ext-pro' ),
				],
				'default' => 'svg',
			]
		);

		$this->end_controls_section();
		// End Lottie Content
		// ===================


		// Start Lottie Style
		// ===================
		$this->start_controls_section(
			'lottie_style',
			[
				'label' => esc_html__( 'Lottie', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'lottie_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 2000,
					],
					'em' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-lottie' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'alignment',
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
				'selectors' => [
					'{{WRAPPER}} .sina-pro-lottie-animation' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'lottie_tabs' );

		$this->start_controls_tab(
			'lottie_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$this->add_responsive_control(
			'lottie_normal_opacity',
			[
				'label' => esc_html__( 'Opacity', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'step' => 0.1,
						'max' => 1,
					],
				],
				'default' => [
					'size' => '1',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-lottie' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'lottie_normal_filters',
				'selector' => '{{WRAPPER}} .sina-pro-lottie',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'lottie_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$this->add_responsive_control(
			'lottie_hover_opacity',
			[
				'label' => esc_html__( 'Opacity', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'step' => 0.1,
						'max' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-lottie:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'lottie_hover_filters',
				'selector' => '{{WRAPPER}} .sina-pro-lottie:hover',
			]
		);
		$this->add_control(
			'lottie_hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'step' => 0.1,
						'max' => 10,
					],
				],
				'default' => [
					'size' => 0.4,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-lottie' => 'transition-duration: {{SIZE}}s;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// End Lottie Style
		// =================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-pro-lottie-animation sina-flex"
		data-path="<?php echo esc_attr( $data['file_path']['url'] ); ?>"
		data-autoplay="<?php echo esc_attr( $data['autoplay'] ); ?>"
		data-loop="<?php echo esc_attr( $data['loop'] ); ?>"
		data-reversed="<?php echo esc_attr( $data['reversed'] ); ?>"
		data-speed="<?php echo esc_attr( $data['speed'] ); ?>"
		data-delay="<?php echo esc_attr( $data['delay'] ); ?>"
		data-renderer="<?php echo esc_attr( $data['renderer'] ); ?>"
		data-hover-event="<?php echo esc_attr( $data['event_on_hover'] ); ?>">
		<?php
			$html = $start_link = $end_link = '';
			if ( 'yes' == $data['is_linkable'] && $data['link']['url'] ) {
				$start_link = '<a class="sina-pro-lottie-linkable" ';
				$start_link .= 'href="'. esc_url( $data['link']['url'] ) .'" ';

				if ( 'on' == $data['link']['is_external'] ) {
					$start_link .= 'target="_blank" ';
				};
				if ( 'on' == $data['link']['nofollow'] ) {
					$start_link .= 'rel="nofollow"';
				}
				$start_link .= '>';
				$end_link .= '</a>';
			}
			$html = '<div class="sina-pro-lottie"></div>';
			printf('%s%s%s', $start_link,$html,$end_link);
		?>
		</div><!-- .sina-pro-lottie-animation -->
		<?php
	}


	protected function _content_template() {

	}
}
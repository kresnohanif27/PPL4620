<?php

/**
 * Offcanvas Bar Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
use \Elementor\Frontend;
use \Sina_Extension\Sina_Ext_Gradient_Text;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Offcanvas_Bar_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_ext_pro_offcanvas_bar';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Offcanvas Bar', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-sidebar';
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
		return [ 'sina offcanvas bar', 'sina sidebar', 'sina right bar', 'sina left bar' ];
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
		global $wp_registered_sidebars;

		$options = [];

		if ( ! $wp_registered_sidebars ) {
			$options[''] = esc_html__( 'No sidebars were found', 'sina-ext-pro' );
		} else {
			foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
				$options[ $sidebar_id ] = $sidebar['name'];
			}
		}

		$default_key = array_keys( $options );
		$default_key = array_shift( $default_key );


		// Start Offcanvas Content
		// ========================
		$this->start_controls_section(
			'offcanvas_content',
			[
				'label' => esc_html__( 'Offcanvas Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'canvas_alignment',
			[
				'label' => esc_html__( 'Alignment', 'sina-ext-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'sina-offcanvas-left' => [
						'title' => esc_html__( 'Left', 'sina-ext-pro' ),
						'icon' => 'eicon-h-align-left',
					],
					'sina-offcanvas-right' => [
						'title' => esc_html__( 'Right', 'sina-ext-pro' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'sina-offcanvas-left',
				'toggle' => false,
			]
		);
		$this->add_control(
			'is_outside_click',
			[
				'label' => esc_html__( 'Close to click outside', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'is_esc_press',
			[
				'label' => esc_html__( 'Close to press ESC', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'is_close',
			[
				'label' => esc_html__( 'Close Button', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'content_type',
			[
				'label' => esc_html__( 'Use Save Templates', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'wp_widget' => esc_html__( 'WP Widget', 'sina-ext-pro' ),
					'save_template' => esc_html__( 'Saved Templates', 'sina-ext-pro' ),
					'custom_content' => esc_html__( 'Custom Content', 'sina-ext-pro' ),
				],
				'default' => 'custom_content',
			]
		);
		$repeater->add_control(
			'widget',
			[
			'label' => esc_html__( 'Choose Sidebar', 'sina-ext-pro' ),
			'type' => Controls_Manager::SELECT,
			'default' => $default_key,
			'options' => $options,
			'condition' => [
				'content_type' => 'wp_widget',
			],
		] );

		$repeater->add_control(
			'template',
			[
				'label' => esc_html__( 'Choose Template', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => sina_get_page_templates(),
				'condition' => [
					'content_type' => 'save_template',
				],
				'description' => esc_html__('NOTE: Don\'t try to edit after insertion template. If you need to change the style or layout then you try to change the main template then save and then insert', 'sina-ext-pro'),
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
					'content_type' => 'custom_content',
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
					'content_type' => 'custom_content',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'content_items',
			[
				'label' => esc_html__( 'Add content', 'sina-ext-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => 'Title of Web Design',
						'desc'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
					],
					[
						'title' => 'Title of Graphic Design',
						'desc'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
					],
					[
						'title' => 'Title of Photography',
						'desc'  => 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
		// End Offcanvas Content
		// ======================


		// Start Trigger Button Content
		// =============================
		$this->start_controls_section(
			'trigger_button',
			[
				'label' => esc_html__( 'Trigger Button', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		Sina_Common_Data::button_content( $this, '.sina-offcanvas-trigger', 'Clicke Here', 'trigger',  false );
		$this->add_control(
			'trigger_class',
			[
				'label' => esc_html__( 'CSS class', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter CLASS', 'sina-ext-pro' ),
				'description' => esc_html__( 'Make sure this CLASS unique', 'sina-ext-pro' ),
			]
		);
		$this->end_controls_section();
		// End Trigger Button Content
		// ===========================


		// Start Canvas Style
		// ====================
		$this->start_controls_section(
			'canvas_style',
			[
				'label' => esc_html__( 'Canvas', 'sina-ext-pro' ),
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
				'default' => [
					'size' => '300',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-offcanvas-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'wrap_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'selector' => '{{WRAPPER}} .sina-offcanvas-wrap',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wrap_shadow',
				'selector' => '{{WRAPPER}} .sina-offcanvas-wrap',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wrap_border',
				'selector' => '{{WRAPPER}} .sina-offcanvas-wrap',
			]
		);
		$this->add_responsive_control(
			'wrap_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-offcanvas-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'top' => '50',
					'right' => '20',
					'bottom' => '30',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-offcanvas-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'overaly_styles',
			[
				'label' => esc_html__( 'Overlay Style', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overaly_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => 'rgba(0,0,0,0.4)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-offcanvas-overlay',
			]
		);

		$this->end_controls_section();
		// End Canvas Style
		// ===========================


		// Start Close Style
		// ====================
		$this->start_controls_section(
			'close_style',
			[
				'label' => esc_html__( 'Close Button', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'is_close' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'close_size',
			[
				'label' => esc_html__( 'Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '20',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-offcanvas-close' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'close_top',
			[
				'label' => esc_html__( 'Top', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'size' => '25',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-offcanvas-close' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'close_left_right',
			[
				'label' => esc_html__( 'Left or Right', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '20',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-offcanvas-left .sina-offcanvas-close' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-offcanvas-right .sina-offcanvas-close' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'close_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-offcanvas-close' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Close Style
		// ==================


		// Start Content Style
		// ====================
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_styles',
			[
				'label' => esc_html__( 'Title Style', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'title_color',
				'selector' => '{{WRAPPER}} .sina-offcanvas-title',
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#222',
					],
				],
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
						'default' => '400',
					],
					'font_size'   => [
						'default' => [
							'size' => '20',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '24',
						],
					],
					'text_transform' => [
						'default' => 'none',
					],
				],
				'selector' => '{{WRAPPER}} .sina-offcanvas-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-offcanvas-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '15',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-offcanvas-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'desc_styles',
			[
				'label' => esc_html__( 'Description Style', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-offcanvas-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '16',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '24',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-offcanvas-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-offcanvas-desc',
			]
		);
		$this->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '40',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-offcanvas-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'desc_alignment',
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
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .sina-offcanvas-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Content Style
		// ==================


		// Start Trigger Button Style
		// ===========================
		$this->start_controls_section(
			'trigger_btn_style',
			[
				'label' => esc_html__( 'Trigger Button', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-offcanvas-trigger' );
		$this->add_responsive_control(
			'trigger_btn_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
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
					'{{WRAPPER}} .sina-offcanvas-trigger' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'trigger_btn_radius',
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
					'{{WRAPPER}} .sina-offcanvas-trigger, {{WRAPPER}} .sina-offcanvas-trigger:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'trigger_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '12',
					'right' => '25',
					'bottom' => '12',
					'left' => '25',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-offcanvas-trigger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'trigger_alignment',
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
					'{{WRAPPER}} .sina-btn-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-button', 'trigger_bg_layer');

		$this->end_controls_section();
		// End Trigger Button Style
		// =========================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$trigger_class = $data['trigger_class'] ? $data['trigger_class'] : uniqid('sina-offcanvas-');
		?>
		<div class="sina-pro-offcanvas-bar"
		data-click="<?php echo esc_attr( $data['is_outside_click'] ); ?>"
		data-esc="<?php echo esc_attr( $data['is_esc_press'] ); ?>"
		data-offcanvas-id="<?php echo esc_attr( $trigger_class ); ?>">
			<?php if ( $data['trigger_text'] || $data['trigger_icon'] ): ?>
				<div class="sina-btn-wrap">
					<button class="sina-button sina-offcanvas-trigger <?php echo esc_attr( $trigger_class.' '.$data['trigger_effect'].' '.$data['trigger_bg_layer_effects'] ); ?>">
						<?php Sina_Common_Data::button_html($data, 'trigger'); ?>
					</button>
				</div>
			<?php endif; ?>

			<div class="sina-offcanvas-overlay sina-canvas-<?php echo esc_attr( $trigger_class.' '.$data['canvas_alignment'] ); ?>">
				<div class="sina-offcanvas-wrap">
					<?php if ( 'yes' == $data['is_close'] ): ?>
						<button class="sina-button sina-offcanvas-close close-<?php echo esc_attr( $trigger_class ); ?>">
							<i class="icofont icofont-close"></i>
						</button>
					<?php endif; ?>

					<?php foreach ($data['content_items'] as $index => $item): ?>
					<div class="sina-offcanvas-content">
						<?php
							$title_key = $this->get_repeater_setting_key( 'title', 'content_items', $index );
							$desc_key = $this->get_repeater_setting_key( 'desc', 'content_items', $index );

							$this->add_render_attribute( $title_key, 'class', 'sina-offcanvas-title' );
							$this->add_inline_editing_attributes( $title_key );

							$this->add_render_attribute( $desc_key, 'class', 'sina-offcanvas-desc' );
							$this->add_inline_editing_attributes( $desc_key );

							if ( 'save_template' == $item['content_type'] && $item['template'] ) :
								$frontend = new Frontend;
								echo $frontend->get_builder_content( $item['template'], true );
							elseif ( 'wp_widget' == $item['content_type'] && $item['widget'] ):
								dynamic_sidebar( $item['widget'] );
							else:
						?>
							<?php if ( $item['title'] ): ?>
								<?php printf('<h3 %2$s>%1$s</h3>', $item['title'], $this->get_render_attribute_string( $title_key )); ?>
							<?php endif; ?>
							<?php if ( $item['desc'] ): ?>
								<?php printf('<div %2$s>%1$s</div>', $item['desc'], $this->get_render_attribute_string( $desc_key )); ?>
							<?php endif ?>
						<?php endif; ?>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div><!-- .sina-pro-offcanvas-bar -->
		<?php
	}


	protected function _content_template() {

	}
}
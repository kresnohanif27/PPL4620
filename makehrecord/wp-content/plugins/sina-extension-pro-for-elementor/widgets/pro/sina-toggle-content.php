<?php

/**
 * Toggle Content Widget.
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
use \Elementor\Frontend;
use \Sina_Extension\Sina_Ext_Gradient_Text;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Toggle_Content_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_ext_pro_toggle_content';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Toggle Content', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-post-navigation';
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
		return [ 'sina toggle content', 'sina switcher content', 'sina tab' ];
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
		// Start First Toggle Content
		// ============================
		$this->start_controls_section(
			'first_content',
			[
				'label' => esc_html__( 'First Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'first_label',
			[
				'label' => esc_html__( 'Label', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Enter Label', 'sina-ext-pro'),
				'default' => 'Monthly',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'first_is_active',
			[
				'label' => esc_html__( 'Is Active?', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'first_save_templates',
			[
				'label' => esc_html__( 'Use Save Templates', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'first_template',
			[
				'label' => esc_html__( 'Choose Template', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => sina_get_page_templates(),
				'condition' => [
					'first_save_templates!' => '',
				],
				'description' => esc_html__('NOTE: Don\'t try to edit after insertion template. If you need to change the style or layout then you try to change the main template then save and then insert', 'sina-ext-pro'),
			]
		);
		$this->add_control(
			'first_title',
			[
				'label' => esc_html__( 'Title', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Enter Title', 'sina-ext-pro'),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext-pro' ),
				'default' => 'First description',
				'condition' => [
					'first_save_templates' => '',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'first_desc',
			[
				'label' => esc_html__('Description', 'sina-ext-pro'),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'description' => esc_html__( 'You can use HTML.', 'sina-ext-pro' ),
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
				'condition' => [
					'first_save_templates' => '',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();
		// End First Toggle Content
		// =========================


		// Start Second Toggle Content
		// ============================
		$this->start_controls_section(
			'second_content',
			[
				'label' => esc_html__( 'Second Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'second_label',
			[
				'label' => esc_html__( 'Label', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Enter Label', 'sina-ext-pro'),
				'default' => 'Yearly',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'second_save_templates',
			[
				'label' => esc_html__( 'Use Save Templates', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'second_template',
			[
				'label' => esc_html__( 'Choose Template', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => sina_get_page_templates(),
				'condition' => [
					'second_save_templates!' => '',
				],
				'description' => esc_html__('NOTE: Don\'t try to edit after insertion template. If you need to change the style or layout then you try to change the main template then save and then insert', 'sina-ext-pro'),
			]
		);
		$this->add_control(
			'second_title',
			[
				'label' => esc_html__( 'Title', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Enter Title', 'sina-ext-pro'),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext-pro' ),
				'default' => 'Second description',
				'condition' => [
					'second_save_templates' => '',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'second_desc',
			[
				'label' => esc_html__('Description', 'sina-ext-pro'),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'description' => esc_html__( 'You can use HTML.', 'sina-ext-pro' ),
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
				'condition' => [
					'second_save_templates' => '',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();
		// End Second Toggle Content
		// ==========================


		// Start Toggle Style
		// ===================
		$this->start_controls_section(
			'toggle_style',
			[
				'label' => esc_html__( 'Toggle', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'toggle_anim',
			[
				'label' => esc_html__( 'Animation', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => Sina_Common_Data::animation(),
				'default' => 'fadeIn',
			]
		);
		$this->add_responsive_control(
			'toggle_anim_speed',
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
					'toggle_anim!' => 'none',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-toggle-content.animated' => 'animation-duration: {{SIZE}}ms;',
					'{{WRAPPER}} .sina-toggle-content.animated' => '-webkit-animation-duration: {{SIZE}}ms;',
				],
			]
		);
		$this->add_responsive_control(
			'toggle_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'default' => [
					'size' => '200',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-labels-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'toggle_wrap_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-labels-wrap',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'toggle_wrap_shadow',
				'selector' => '{{WRAPPER}} .sina-labels-wrap',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'toggle_wrap_border',
				'selector' => '{{WRAPPER}} .sina-labels-wrap',
			]
		);
		$this->add_responsive_control(
			'toggle_wrap_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
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
					'{{WRAPPER}} .sina-labels-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'toggle_padding',
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
					'{{WRAPPER}} .sina-labels-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'toggle_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
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
					'{{WRAPPER}} .sina-labels-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'toggle_alignment',
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
					'{{WRAPPER}} .sina-toggle-header' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'switch_style',
			[
				'label' => esc_html__( 'Switch Style', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'switch_bg',
			[
				'label' => esc_html__( 'Switch Background', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-toggle-switcher' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'switch_shadow',
				'selector' => '{{WRAPPER}} .sina-toggle-switcher',
			]
		);
		$this->add_responsive_control(
			'switch_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
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
					'{{WRAPPER}} .sina-toggle-switcher' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'label_style',
			[
				'label' => esc_html__( 'Label Style', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typo',
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
					'text_transform' => [
						'default' => 'uppercase',
					],
				],
				'selector' => '{{WRAPPER}} .sina-labels-wrap span',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'label_shadow',
				'selector' => '{{WRAPPER}} .sina-labels-wrap span',
			]
		);
		$this->add_responsive_control(
			'label_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
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
					'{{WRAPPER}} .sina-labels-wrap span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'nav_tabs' );

		$this->start_controls_tab(
			'label_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);
		$this->add_control(
			'label_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-labels-wrap span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'label_active',
			[
				'label' => esc_html__( 'Active', 'sina-ext-pro' ),
			]
		);
		$this->add_control(
			'label_active_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-labels-wrap span.active' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// End Toggle Style
		// =================


		// Start Wrapper Style
		// ===================
		$this->start_controls_section(
			'content_wrap_style',
			[
				'label' => esc_html__( 'Content Wrapper', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_wrap_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-toggle-wrap',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_wrap_shadow',
				'selector' => '{{WRAPPER}} .sina-toggle-wrap',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_wrap_border',
				'selector' => '{{WRAPPER}} .sina-toggle-wrap',
			]
		);
		$this->add_responsive_control(
			'content_wrap_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-toggle-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .sina-toggle-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'justify' => [
						'title' => esc_html__( 'Justify', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-toggle-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_style',
			[
				'label' => esc_html__( 'Title Style', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'title_color',
				'selector' => '{{WRAPPER}} .sina-pro-toggle-title',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'selector' => '{{WRAPPER}} .sina-pro-toggle-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-toggle-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '10',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-toggle-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'desc_style',
			[
				'label' => esc_html__( 'Description Style', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'desc_color',
				'selector' => '{{WRAPPER}} .sina-pro-toggle-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typo',
				'selector' => '{{WRAPPER}} .sina-pro-toggle-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-toggle-desc',
			]
		);

		$this->end_controls_section();
		// End Wrapper Style
		// ===================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$uid = uniqid('sina-toggle-content-');

		$first_active = $first_show = '';
		$second_active = 'active';
		$second_show = 'show';
		if ( 'yes' == $data['first_is_active'] ) {
			$second_active = $second_show = '';
			$first_active = 'active';
			$first_show = 'show';
		}

		$this->add_render_attribute( 'first_title', 'class', 'sina-pro-toggle-title' );
		$this->add_inline_editing_attributes( 'first_title' );

		$this->add_render_attribute( 'first_desc', 'class', 'sina-pro-toggle-desc' );
		$this->add_inline_editing_attributes( 'first_desc' );

		$this->add_render_attribute( 'second_title', 'class', 'sina-pro-tab-title' );
		$this->add_inline_editing_attributes( 'second_title' );

		$this->add_render_attribute( 'second_desc', 'class', 'sina-pro-toggle-desc' );
		$this->add_inline_editing_attributes( 'second_desc' );
		?>
		<div class="sina-pro-toggle-content">
			<div class="sina-toggle-header">
				<div class="sina-labels-wrap">
					<div class="sina-toggle-labels clearfix">
						<span class="sina-pro-float-left <?php echo esc_attr($first_active); ?>" data-id="#<?php echo esc_attr($uid); ?>-1">
							<?php printf('%s', $data['first_label']); ?>
						</span>
						<span class="sina-pro-float-right <?php echo esc_attr($second_active); ?>" data-id="#<?php echo esc_attr($uid); ?>-2">
							<?php printf('%s', $data['second_label']); ?>
						</span>
						<div class="sina-toggle-switcher"></div>
					</div>
				</div>
			</div>
			<div class="sina-toggle-wrap">
				<div class="sina-toggle-content animated <?php echo esc_attr( $data['toggle_anim'].' '.$first_show ); ?>" id="<?php echo esc_attr($uid); ?>-1">
					<?php
					if ( 'yes' == $data['first_save_templates'] && $data['first_template'] ) :
						$frontend = new Frontend;
						echo $frontend->get_builder_content( $data['first_template'], true );
					else:
						?>
						<?php if ( $data['first_title'] ): ?>
							<?php printf('<h3 %2$s>%1$s</h3>', $data['first_title'], $this->get_render_attribute_string( 'first_title' )); ?>
						<?php endif; ?>

						<?php if ( $data['first_desc'] ): ?>
							<?php printf('<div %2$s>%1$s</div>', $data['first_desc'], $this->get_render_attribute_string( 'first_desc' )); ?>
						<?php endif ?>
					<?php endif; ?>
				</div>
				<div class="sina-toggle-content animated <?php echo esc_attr( $data['toggle_anim'].' '.$second_show ); ?>" id="<?php echo esc_attr($uid); ?>-2">
					<?php
					if ( 'yes' == $data['second_save_templates'] && $data['second_template'] ) :
						$frontend = new Frontend;
						echo $frontend->get_builder_content( $data['second_template'], true );
					else:
						?>
						<?php if ( $data['second_title'] ): ?>
							<?php printf('<h3 %2$s>%1$s</h3>', $data['second_title'], $this->get_render_attribute_string( 'second_title' )); ?>
						<?php endif; ?>
						<?php if ( $data['second_desc'] ): ?>
							<?php printf('<div %2$s>%1$s</div>', $data['second_desc'], $this->get_render_attribute_string( 'second_desc' )); ?>
						<?php endif ?>
					<?php endif; ?>
				</div>
			</div>
		</div><!-- .sina-pro-toggle-content -->
		<?php
	}


	protected function _content_template() {

	}
}
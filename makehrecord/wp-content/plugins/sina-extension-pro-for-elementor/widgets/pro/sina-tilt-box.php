<?php

/**
 * Tilt Box Widget.
 *
 * @since 1.4.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
use \Sina_Extension\Sina_Ext_Gradient_Text;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Tilt_Box_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.4.0
	 */
	public function get_name() {
		return 'sina_ext_pro_tilt_box';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.4.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Tilt Box', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.4.0
	 */
	public function get_icon() {
		return 'eicon-image-rollover';
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
		return [ 'sina tilt box', 'interactive tilt card', 'interactive promo box' ];
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
			'jquery-tilt',
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
		// Start Tilt Box Content
		// =======================
		$this->start_controls_section(
			'tilt_box_content',
			[
				'label' => esc_html__( 'Tilt Box Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'content_effects',
			[
				'label' => esc_html__( 'Effects', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Fade', 'sina-ext-pro' ),
					'sina-tilt-top-move' => esc_html__( 'Top Move', 'sina-ext-pro' ),
					'sina-tilt-bottom-move' => esc_html__( 'Bottom Move', 'sina-ext-pro' ),
					'sina-tilt-left-move' => esc_html__( 'Left Move', 'sina-ext-pro' ),
					'sina-tilt-right-move' => esc_html__( 'Right Move', 'sina-ext-pro' ),
					'sina-tilt-none' => esc_html__( 'None', 'sina-ext-pro' ),
				],
				'default' => 'sina-tilt-none',
			]
		);
		$this->add_control(
			'tilt_title',
			[
				'label' => esc_html__( 'Title', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Enter Title', 'sina-ext-pro'),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext-pro' ),
				'default' => 'This is short description',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'tilt_desc',
			[
				'label' => esc_html__('Description', 'sina-ext-pro'),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'description' => esc_html__( 'You can use HTML.', 'sina-ext-pro' ),
				'default' => 'Its a placeholder text commonly used for as dummy text to see the preview layouts.',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();
		// End Tilt Box Content
		// =====================


		// Start Tilt Settings
		// =====================
		$this->start_controls_section(
			'tilt_settings',
			[
				'label' => esc_html__( 'Tilt Settings', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tilt_axis',
			[
				'label' => esc_html__( 'Select Axis', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'x' => esc_html__( 'X Axis', 'sina-ext-pro' ),
					'y' => esc_html__( 'Y Axis', 'sina-ext-pro' ),
					'null' => esc_html__( 'X and Y Axis', 'sina-ext-pro' ),
				],
				'default' => 'null',
			]
		);
		$this->add_control(
			'tilt_max_tilt', [
				'label' => esc_html__('Max Tilt', 'sina-ext-pro'),
				'type' => Controls_Manager::NUMBER,
				'default' => 20,
			]
		);
		$this->add_control(
			'tilt_scale', [
				'label' => esc_html__('Scale Size', 'sina-ext-pro'),
				'type' => Controls_Manager::NUMBER,
				'max' => 10,
				'step' => 0.1,
				'default' => 1,
			]
		);
		$this->add_control(
			'tilt_perspective', [
				'label' => esc_html__('Perspective', 'sina-ext-pro'),
				'type' => Controls_Manager::NUMBER,
				'max' => 3000,
				'step' => 100,
				'default' => '1000',
			]
		);
		$this->add_control(
			'tilt_speed', [
				'label' => esc_html__('Speed', 'sina-ext-pro'),
				'type' => Controls_Manager::NUMBER,
				'max' => 10000,
				'step' => 100,
				'default' => 800,
			]
		);
		$this->add_control(
			'tilt_glare',
			[
				'label' => esc_html__( 'Is Glare?', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'tilt_max_glare', [
				'label' => esc_html__('Max Glare', 'sina-ext-pro'),
				'type' => Controls_Manager::NUMBER,
				'max' => 1,
				'step' => 0.1,
				'default' => 0.2,
				'condition' => [
					'tilt_glare' => 'yes',
				],
			]
		);
		$this->add_control(
			'tilt_reset',
			[
				'label' => esc_html__( 'Is Reset?', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
		// End Tilt Settings
		// ===================


		// Start Tilt Box Style
		// =====================
		$this->start_controls_section(
			'tilt_style',
			[
				'label' => esc_html__( 'Tilt Box', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'tilt_box_height',
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
					'size' => '300',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-tilt-box' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'tilt_box_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-tilt-box',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-tilt-box',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .sina-tilt-box',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-tilt-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'top' => '30',
					'right' => '20',
					'bottom' => '30',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-tilt-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tilt_overlay',
			[
				'label' => esc_html__( 'Overlay', 'sina-ext-pro' ),
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
				'selector' => '{{WRAPPER}} .sina-overlay',
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
						'default' => 'rgba(0,0,0,0.4)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-tilt-box:hover .sina-overlay',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// End Tilt Box Style
		// =====================


		// Start Content Style
		// ====================
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'vertical_align',
			[
				'label' => esc_html__( 'Vertical Align', 'sina-ext-pro' ),
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
				'default' => 'flex-end',
				'selectors' => [
					'{{WRAPPER}} .sina-tilt-box' => 'align-items: {{VALUE}};',
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
					'{{WRAPPER}} .sina-tilt-box-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_styles',
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
				'selector' => '{{WRAPPER}} .sina-tilt-box-title',
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
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
				'selector' => '{{WRAPPER}} .sina-tilt-box-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-tilt-box-title',
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
					'{{WRAPPER}} .sina-tilt-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-tilt-box-desc' => 'color: {{VALUE}};',
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
							'size' => '15',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '24',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-tilt-box-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-tilt-box-desc',
			]
		);

		$this->end_controls_section();
		// End Content Style
		// ==================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$glare = ('yes' == $data['tilt_glare']) ? 'true' : 'false';
		$reset = ('yes' == $data['tilt_reset']) ? 'true' : 'false';
		?>
		<div class="sina-pro-tilt-box">
			<div class="sina-tilt-box sina-flex"
			data-tilt-axis="<?php echo esc_attr( $data['tilt_axis'] ); ?>"
			data-tilt-max="<?php echo esc_attr( $data['tilt_max_tilt'] ); ?>"
			data-tilt-scale="<?php echo esc_attr( $data['tilt_scale'] ); ?>"
			data-tilt-perspective="<?php echo esc_attr( $data['tilt_perspective'] ); ?>"
			data-tilt-speed="<?php echo esc_attr( $data['tilt_speed'] ); ?>"
			data-tilt-maxglare="<?php echo esc_attr( $data['tilt_max_glare'] ); ?>"
			data-tilt-glare="<?php echo esc_attr( $glare ); ?>"
			data-tilt-reset="<?php echo esc_attr( $reset ); ?>"
			data-tilt-easing="cubic-bezier(.3,1,.3,1)">
				<div class="sina-overlay"></div>
				<div class="sina-tilt-box-content <?php echo esc_attr( $data['content_effects'] ); ?>">
					<?php
						if ( $data['tilt_title'] ):
							printf('<h3 class="sina-tilt-box-title">%1$s</h3>', $data['tilt_title'] );
						endif;

						if ( $data['tilt_desc'] ):
							printf('<div class="sina-tilt-box-desc">%1$s</div>', $data['tilt_desc']);
						endif;
					?>
				</div>
			</div>
		</div><!-- .sina-pro-tilt-box -->
		<?php
	}


	protected function _content_template() {
		?>
		<#
			var glare = ('yes' == settings.tilt_glare) ? 'true' : 'false';
			var reset = ('yes' == settings.tilt_reset) ? 'true' : 'false';
		#>
		<div class="sina-pro-tilt-box">
			<div class="sina-tilt-box sina-flex"
			data-tilt-axis="{{{settings.tilt_axis}}}"
			data-tilt-max="{{{settings.tilt_max_tilt}}}"
			data-tilt-scale="{{{settings.tilt_scale}}}"
			data-tilt-perspective="{{{settings.tilt_perspective}}}"
			data-tilt-speed="{{{settings.tilt_speed}}}"
			data-tilt-maxglare="{{{settings.tilt_max_glare}}}"
			data-tilt-glare="{{{glare}}}"
			data-tilt-reset="{{{reset}}}"
			data-tilt-easing="cubic-bezier(.3,1,.3,1)">
				<div class="sina-overlay"></div>
				<div class="sina-tilt-box-content {{{settings.content_effects}}}">
					<# if (settings.tilt_title) { #>
						<h3 class="sina-tilt-box-title">{{{settings.tilt_title}}}</h3>
					<# } #>

					<# if (settings.tilt_desc) { #>
						<div class="sina-tilt-box-desc">{{{settings.tilt_desc}}}</div>
					<# } #>
				</div>
			</div>
		</div><!-- .sina-pro-tilt-box -->
		<?php
	}
}
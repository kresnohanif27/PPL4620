<?php

/**
 * Instant Search Widget.
 *
 * @since 1.2.3
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Instant_Search_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.2.3
	 */
	public function get_name() {
		return 'sina_ext_pro_instant_search';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.2.3
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Instant Search', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.2.3
	 */
	public function get_icon() {
		return 'eicon-search';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.2.3
	 */
	public function get_categories() {
		return [ 'sina-ext-pro-basic' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.2.3
	 */
	public function get_keywords() {
		return [ 'sina search form', 'sina instant search', 'sina form' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.2.3
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
	 * @since 1.2.3
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
	 * @since 1.2.3
	 */
	protected function _register_controls() {
		// Start Form Content
		// ===================
		$this->start_controls_section(
			'form_content',
			[
				'label' => esc_html__( 'Search Settings', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'is_thumb',
			[
				'label' => esc_html__( 'Thumb Show', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'thumb_position',
			[
				'label' => esc_html__( 'Thumb Position', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' => esc_html__( 'Left', 'sina-ext-pro' ),
					'right' => esc_html__( 'Right', 'sina-ext-pro' ),
				],
				'default' => 'left',
				'condition' => [
					'is_thumb' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-inst-search-thumb' => 'float: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'posts',
			[
				'label' => esc_html__( 'Post Types', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT2,
				'options' => get_post_types([
					'public' => true,
				]),
				'default' => 'post',
				'multiple' => true,
			]
		);
		$this->add_control(
			'placeholder',
			[
				'label' => esc_html__( 'Placeholder text', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter placeholder text', 'sina-ext-pro' ),
				'default' => 'Search Here...',
			]
		);
		$this->add_control(
			'processing',
			[
				'label' => esc_html__( 'Processing text', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter processing text', 'sina-ext-pro' ),
				'default' => 'Searching...',
			]
		);

		$this->end_controls_section();
		// End Form Content
		// ==================


		// Start Field Style
		// ===================
		$this->start_controls_section(
			'field_style',
			[
				'label' => esc_html__( 'Field', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::input_fields_style( $this );
		$this->add_responsive_control(
			'field_width',
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
				'desktop_default' => [
					'unit' => 'px',
					'size' => '400',
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => '300',
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => '280',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-instant-search' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'field_radius',
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
					'{{WRAPPER}} .sina-input-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'field_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '50',
					'bottom' => '10',
					'left' => '15',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-input-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'field_margin',
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
					'{{WRAPPER}} .sina-input-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .sina-pro-form' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Field Style
		// =================


		// Start Icon Style
		// ==================
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Search Icon', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'size' => '16',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-search-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-search-icon' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
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
					'{{WRAPPER}} .sina-pro-search-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Icon Style
		// ================


		// Start Result Wrap Style
		// =========================
		$this->start_controls_section(
			'result_wrap_style',
			[
				'label' => esc_html__( 'Result Wrapper', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'result_wrap_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#f8f8f8',
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-search-result',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'result_wrap_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-search-result',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'result_wrap_border',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'color' => [
						'default' => '#f8f8f8',
					],
					'width' => [
						'default' => [
							'top' => '12',
							'right' => '0',
							'bottom' => '12',
							'left' => '12',
							'isLinked' => false,
						]
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-search-result',
			]
		);
		$this->add_responsive_control(
			'result_wrap_height',
			[
				'label' => esc_html__( 'Max-height', 'sina-ext-pro' ),
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
				'default' => [
					'unit' => 'px',
					'size' => '300',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-search-result' => 'max-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'result_wrap_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
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
					'{{WRAPPER}} .sina-pro-search-result' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Result Wrap Style
		// =======================


		// Start Result Thumb Style
		// =========================
		$this->start_controls_section(
			'result_list_style',
			[
				'label' => esc_html__( 'Result List', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'result_content_typography',
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
				],
				'selector' => '{{WRAPPER}} .sina-pro-search-item',
			]
		);

		$this->start_controls_tabs( 'result_list_tabs' );

		$this->start_controls_tab(
			'result_list_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$this->add_control(
			'result_list_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-search-item' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'result_list_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-pro-search-item',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'result_list_tshadow',
				'selector' => '{{WRAPPER}} .sina-pro-search-item',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'result_list_border',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'color' => [
						'default' => '#eee',
					],
					'width' => [
						'default' => [
							'top' => '0',
							'right' => '0',
							'bottom' => '1',
							'left' => '0',
							'isLinked' => true,
						]
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-search-item',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'result_list_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$this->add_control(
			'result_list_color_hover',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-search-item:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'result_list_bg_hover',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#eee',
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-search-item:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'result_list_tshadow_hover',
				'selector' => '{{WRAPPER}} .sina-pro-search-item:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'result_list_border_hover',
				'selector' => '{{WRAPPER}} .sina-pro-search-item:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'result_list_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '12',
					'right' => '12',
					'bottom' => '12',
					'left' => '12',
					'isLinked' => true,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-search-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'result_content_width',
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
					'size' => '80',
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => '70',
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => '70',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-inst-search-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'result_content_padding',
			[
				'label' => esc_html__( 'Content Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '12',
					'bottom' => '0',
					'left' => '12',
					'isLinked' => false,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-inst-search-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'result_content_alignment',
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
					'{{WRAPPER}} .sina-pro-search-item' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Result List Style
		// =======================


		// Start Result Thumb Style
		// =========================
		$this->start_controls_section(
			'result_thumb_style',
			[
				'label' => esc_html__( 'Result Thumb', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'is_thumb' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'result_thumb_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-inst-search-thumb',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'result_thumb_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-inst-search-thumb',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'result_thumb_border',
				'selector' => '{{WRAPPER}} .sina-pro-inst-search-thumb',
			]
		);
		$this->add_responsive_control(
			'result_thumb_width',
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
					'size' => '30',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-inst-search-thumb' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'result_thumb_radius',
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
					'{{WRAPPER}} .sina-pro-inst-search-thumb, {{WRAPPER}} .sina-pro-inst-search-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'result_thumb_padding',
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
					'{{WRAPPER}} .sina-pro-inst-search-thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Result Thumb Style
		// =======================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$uid = uniqid('sina-pro-instant-search-');
		$search_info = [
			'posts'=> $data['posts'],
			'is_thumb'=> $data['is_thumb'],
			'thumb_position'=> $data['thumb_position'],
		];
		?>
		<div class="sina-pro-form">
			<form class="sina-pro-instant-search"
			data-uid="<?php echo esc_attr( $uid ); ?>"
			data-search-info='<?php echo json_encode( $search_info ); ?>'>
				<div class="sina-pro-instant-search-box">
					<input class="sina-input-field sina-pro-instant-search-key" type="search" placeholder="<?php echo esc_attr( $data['placeholder'] ); ?>">
					<i class="icofont icofont-search-1 sina-pro-search-icon"></i>
				</div>
				<div class="sina-pro-search-result"><?php printf('%s', $data['processing']); ?></div>

				<?php wp_nonce_field( 'sina_instant_search', 'sina_instant_search_nonce'.$uid ); ?>
			</form><!-- .sina-pro-instant-search -->
		</div><!-- .sina-pro-form -->
		<?php
	}


	protected function _content_template() {

	}
}

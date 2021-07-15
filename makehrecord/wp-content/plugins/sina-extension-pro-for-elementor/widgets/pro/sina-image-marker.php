<?php

/**
 * Image Marker Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Group_Control_Border;
use \Elementor\Control_Media;
use \Elementor\Repeater;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Image_Marker_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_ext_pro_image_marker';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Image Marker', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-image-rollover';
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
		return [ 'sina image marker', 'sina image tooltip', 'sina image popover' ];
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
			'sina-tooltip',
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
			'sina-tooltip',
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
		// Start Marker Content
		// =====================
		$this->start_controls_section(
			'marker_content',
			[
				'label' => esc_html__( 'Marker', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'sina-ext-pro' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
			]
		);
		$this->add_control(
			'marker_anim',
			[
				'label' => esc_html__( 'Animation Effects', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'None', 'sina-ext-pro' ),
					'sina-rubber-anim' => esc_html__( 'Rubber', 'sina-ext-pro' ),
					'sina-scale-anim' => esc_html__( 'Zoom', 'sina-ext-pro' ),
					'sina-wave-anim' => esc_html__( 'Wave', 'sina-ext-pro' ),
				],
				'default' => '',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'marker_icon',
			[
				'label' => esc_html__( 'Icon', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-plus',
			]
		);
		$repeater->add_control(
			'marker_text',
			[
				'label' => esc_html__( 'Text', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Text', 'sina-ext-pro' ),
			]
		);
		$repeater->add_control(
			'marker_tooltip_text',
			[
				'label' => esc_html__( 'Tooltip Text', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Tooltip Text', 'sina-ext-pro' ),
				'default' => 'Tooltip Text',
			]
		);
		$repeater->add_control(
			'marker_tooltip_pos',
			[
				'label' => esc_html__( 'Tooltip Position', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => esc_html__( 'Top', 'sina-ext-pro' ),
					'right' => esc_html__( 'Right', 'sina-ext-pro' ),
					'bottom' => esc_html__( 'Bottom', 'sina-ext-pro' ),
					'left' => esc_html__( 'Left', 'sina-ext-pro' ),
				],
				'default' => 'top',
				'condition' => [
					'marker_tooltip_text!' => '',
				],
			]
		);

		$repeater->add_control(
			'marker_style',
			[
				'label' => esc_html__( 'Marker Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_responsive_control(
			'marker_pos_left',
			[
				'label' => esc_html__( 'Left', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'max' => 100,
						'min' => -100,
					],
				],
				'default' => [
					'size' => '25',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-image-marker{{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'marker_pos_top',
			[
				'label' => esc_html__( 'Top', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'max' => 100,
						'min' => -100,
					],
				],
				'default' => [
					'size' => '25',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-image-marker{{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_control(
			'single_marker_wave_color',
			[
				'label' => esc_html__( 'Wave Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-image-marker{{CURRENT_ITEM}}:after' => 'color: {{VALUE}};',
				],
			]
		);

		$repeater->start_controls_tabs( 'single_marker_tabs' );

		$repeater->start_controls_tab(
			'single_marker_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$repeater->add_control(
			'single_marker_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-image-marker{{CURRENT_ITEM}}' => 'color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'single_marker_bg',
			[
				'label' => esc_html__( 'Background Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-image-marker{{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'single_marker_shadow',
				'selector' => '{{WRAPPER}} .sina-image-marker{{CURRENT_ITEM}}',
			]
		);
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'single_marker_border',
				'selector' => '{{WRAPPER}} .sina-image-marker{{CURRENT_ITEM}}',
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'single_marker_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$repeater->add_control(
			'single_marker_hover_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-image-marker{{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'single_marker_hover_bg',
			[
				'label' => esc_html__( 'Background Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-image-marker{{CURRENT_ITEM}}:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'single_marker_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-image-marker{{CURRENT_ITEM}}:hover',
			]
		);
		$repeater->add_control(
			'single_marker_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-image-marker{{CURRENT_ITEM}}:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'markers',
			[
				'label' => esc_html__( 'Add Marker', 'sina-ext-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'marker_icon' => 'fa fa-plus',
						'marker_tooltip_text' => 'One Tooltip',
						'marker_pos_left' => [
							'unit' => '%',
							'size' => '25',
						],
						'marker_pos_top' => [
							'unit' => '%',
							'size' => '25',
						],
					],
					[
						'marker_icon' => 'fa fa-plus',
						'marker_tooltip_text' => 'Two Tooltip',
						'marker_pos_left' => [
							'unit' => '%',
							'size' => '75',
						],
						'marker_pos_top' => [
							'unit' => '%',
							'size' => '25',
						],
					],
					[
						'marker_icon' => 'fa fa-plus',
						'marker_tooltip_text' => 'Three Tooltip',
						'marker_pos_left' => [
							'unit' => '%',
							'size' => '50',
						],
						'marker_pos_top' => [
							'unit' => '%',
							'size' => '60',
						],
					],
				],
				'title_field' => '{{{ marker_text || marker_tooltip_text }}}',
			]
		);

		$this->end_controls_section();
		// End Marker Content
		// ===================


		// Start Image Style
		// =================
		$this->start_controls_section(
			'image_styles',
			[
				'label' => esc_html__( 'Image', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'image_filters',
				'selector' => '{{WRAPPER}} .sina-pro-image-marker',
			]
		);

		$this->end_controls_section();
		// End Image Style
		// ================


		// Start Marker Style
		// ====================
		$this->start_controls_section(
			'markers_style',
			[
				'label' => esc_html__( 'Markers', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'single_marker_wave_color',
			[
				'label' => esc_html__( 'Wave Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'condition' => [
					'marker_anim' => 'sina-wave-anim',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-image-marker:after' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'marker_typo',
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
							'size' => '25',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-image-marker',
			]
		);

		$this->start_controls_tabs( 'markers_tabs' );

		$this->start_controls_tab(
			'marker_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$this->add_control(
			'marker_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-image-marker' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'marker_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => 'rgba(16,133,228,0.8)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-image-marker',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'marker_shadow',
				'selector' => '{{WRAPPER}} .sina-image-marker',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'marker_border',
				'selector' => '{{WRAPPER}} .sina-image-marker',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'marker_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$this->add_control(
			'marker_hover_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-image-marker:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'marker_hover_bg',
			[
				'label' => esc_html__( 'Background Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-image-marker:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'marker_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-image-marker:hover',
			]
		);
		$this->add_control(
			'marker_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-image-marker:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'marker_radius',
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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-image-marker, {{WRAPPER}} .sina-image-marker:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'marker_hover_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'desktop_default' => [
					'top' => '8',
					'right' => '15',
					'bottom' => '8',
					'left' => '15',
					'isLinked' => false,
				],
				'tablet_default' => [
					'top' => '8',
					'right' => '15',
					'bottom' => '8',
					'left' => '15',
					'isLinked' => false,
				],
				'mobile_default' => [
					'top' => '1',
					'right' => '8',
					'bottom' => '1',
					'left' => '8',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-image-marker' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Marker Style
		// ==================


		// Start Tooltips Style
		// ======================
		$this->start_controls_section(
			'tooltips_style',
			[
				'label' => esc_html__( 'Tooltips', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::tooltip_style( $this, 'marker', '' );
		$this->end_controls_section();
		// End Tooltips Style
		// ====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$img_alt = Control_Media::get_image_alt( $data['image'] );
		?>
		<div class="sina-pro-image-marker">
			<img src="<?php echo esc_url($data['image']['url']); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
			<?php foreach ($data['markers'] as $marker):
				$tooltip = $marker['marker_tooltip_text'] ? 'sina-tooltip' : '';
			?>
				<div class="sina-image-marker animated zoomIn elementor-repeater-item-<?php echo esc_attr( $marker['_id'].' '.$tooltip.' '.$data['marker_anim'] ); ?>"
				<?php if ( $marker['marker_tooltip_text'] ): ?>
					data-toggle="tooltip"
					data-placement="<?php echo esc_attr( $marker['marker_tooltip_pos'] ); ?>"
					title="<?php echo esc_attr( $marker['marker_tooltip_text'] ); ?>"
				<?php endif; ?>>
					<?php printf('%1$s', $marker['marker_text']); ?>
					<i class="<?php echo esc_attr( $marker['marker_icon'] ); ?>"></i>
				</div>
			<?php endforeach; ?>
		</div><!-- .sina-pro-image-marker -->
		<?php
	}


	protected function _content_template() {
		?>
		<div class="sina-pro-image-marker">
			<img src="{{{settings.image.url}}}">
			<#
				_.each( settings.markers, function( marker, index ) {
					var tooltip = marker.marker_tooltip_text ? 'sina-tooltip' : '';
				#>
				<div class="sina-image-marker animated zoomIn elementor-repeater-item-{{{marker._id + ' ' + tooltip + ' ' + settings.marker_anim}}}"
				<# if ( marker.marker_tooltip_text ) { #>
					data-toggle="tooltip"
					data-placement="{{{marker.marker_tooltip_pos}}}"
					title="{{{marker.marker_tooltip_text}}}"
				<# } #>>
					{{{marker.marker_text}}}
					<i class="{{{marker.marker_icon}}}"></i>
				</div>
			<# }); #>
		</div><!-- .sina-pro-image-marker -->
		<?php
	}
}
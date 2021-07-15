<?php

/**
 * Chart Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Chart_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_ext_pro_chart';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Chart', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-bar-chart';
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
		return [ 'sina chart', 'sina pie chart', 'sina bar chart', 'sina stats' ];
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
			'sina-chart',
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
		// Start Chart Data
		// ==================
		$this->start_controls_section(
			'chart_content',
			[
				'label' => esc_html__( 'Chart Data', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'chart_type',
			[
				'label' => esc_html__( 'Chart Type', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'bar'           => esc_html__( 'Vertical Bar', 'sina-ext-pro' ),
					'horizontalBar' => esc_html__( 'Horizontal Bar', 'sina-ext-pro' ),
					'doughnut'      => esc_html__( 'Doughnut', 'sina-ext-pro' ),
					'line'          => esc_html__( 'Line', 'sina-ext-pro' ),
					'pie'           => esc_html__( 'Pie', 'sina-ext-pro' ),
					'polarArea'     => esc_html__( 'Polar Area', 'sina-ext-pro' ),
					'radar'         => esc_html__( 'Radar', 'sina-ext-pro' ),
				],
				'default' => 'bar',
			]
		);

		$chart_cats = new Repeater();

		$chart_cats->add_control(
			'cats_name',
			[
				'label' => esc_html__('Name', 'sina-ext-pro'),
				'type' => Controls_Manager::TEXT,
				'default' => 'WordPress',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'chart_cats',
			[
				'label' => esc_html__('Add Category', 'sina-ext-pro'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $chart_cats->get_controls(),
				'default' => [
					[
						'cats_name' => 'WordPress',
					],
					[
						'cats_name' => 'Joomla',
					],
					[
						'cats_name' => 'Drupal',
					],
				],
				'condition' => [
					'chart_type' => ['bar', 'horizontalBar', 'line', 'radar'],
				],
				'title_field' => '{{{ cats_name }}}',
			]
		);


		$chart_data = new Repeater();

		$chart_data->add_control(
			'legend_text', [
				'label' => esc_html__('Legend', 'sina-ext-pro'),
				'type' => Controls_Manager::TEXT,
				'default' => 'WordPress',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$chart_data->add_control(
			'data_set', [
				'label' => esc_html__('Data', 'sina-ext-pro'),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'Data must be comma separated.', 'sina-ext-pro' ),
				'default' => '18,28,35',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$chart_data->add_control(
			'data_style',
			[
				'label' => esc_html__( 'Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$chart_data->start_controls_tabs( 'chart_data_tabs' );

		$chart_data->start_controls_tab(
			'label_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$chart_data->add_control(
			'bg_color', [
				'label' => esc_html__('Background Color', 'sina-ext-pro'),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(16,133,228,0.6)',
			]
		);
		$chart_data->add_control(
			'border_color', [
				'label' => esc_html__('Border Color', 'sina-ext-pro'),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(16,133,228,0.6)',
			]
		);

		$chart_data->end_controls_tab();

		$chart_data->start_controls_tab(
			'label_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$chart_data->add_control(
			'bg_hover_color', [
				'label' => esc_html__('Background Color', 'sina-ext-pro'),
				'type' => Controls_Manager::COLOR,
			]
		);
		$chart_data->add_control(
			'border_hover_color', [
				'label' => esc_html__('Border Color', 'sina-ext-pro'),
				'type' => Controls_Manager::COLOR,
			]
		);

		$chart_data->end_controls_tab();

		$chart_data->end_controls_tabs();

		$chart_data->add_control(
			'border_width', [
				'label' => esc_html__('Border Width', 'sina-ext-pro'),
				'type' => Controls_Manager::NUMBER,
				'default' => '1',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'chart_data',
			[
				'label' => esc_html__('Add Data', 'sina-ext-pro'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $chart_data->get_controls(),
				'default' => [
					[
						'legend_text' => 'HTML',
						'data_set' => '12,22,16',
						'bg_color' => 'rgba(16,133,228,0.6)',
						'border_color' => 'rgba(16,133,228,0.6)',
					],
					[
						'legend_text' => 'CSS',
						'data_set' => '36,16,24',
						'bg_color' => 'rgba(222,31,81,0.6)',
						'border_color' => 'rgba(222,31,81,0.6)',
					],
					[
						'legend_text' => 'JavaScript',
						'data_set' => '18,36,14',
						'bg_color' => 'rgba(10,222,81,0.6)',
						'border_color' => 'rgba(10,222,81,0.6)',
					],
					[
						'legend_text' => 'PHP',
						'data_set' => '24,9,44',
						'bg_color' => 'rgba(222,31,222,0.6)',
						'border_color' => 'rgba(222,31,222,0.6)',
					]

				],
				'condition' => [
					'chart_type' => ['bar', 'horizontalBar', 'line', 'radar'],
				],
				'title_field' => '{{{ legend_text }}}',
			]
		);


		$chart_data2 = new Repeater();

		$chart_data2->add_control(
			'legend_text', [
				'label' => esc_html__('Label', 'sina-ext-pro'),
				'type' => Controls_Manager::TEXT,
				'default' => 'WordPress',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$chart_data2->add_control(
			'data_set', [
				'label' => esc_html__('Data', 'sina-ext-pro'),
				'type' => Controls_Manager::NUMBER,
				'default' => '18',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$chart_data2->add_control(
			'data_style',
			[
				'label' => esc_html__( 'Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$chart_data2->start_controls_tabs( 'chart_data2_tabs' );

		$chart_data2->start_controls_tab(
			'label_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$chart_data2->add_control(
			'bg_color', [
				'label' => esc_html__('Background Color', 'sina-ext-pro'),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(16,133,228,0.6)',
			]
		);
		$chart_data2->add_control(
			'border_color', [
				'label' => esc_html__('Border Color', 'sina-ext-pro'),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(16,133,228,0.6)',
			]
		);

		$chart_data2->end_controls_tab();

		$chart_data2->start_controls_tab(
			'label_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$chart_data2->add_control(
			'bg_hover_color', [
				'label' => esc_html__('Background Color', 'sina-ext-pro'),
				'type' => Controls_Manager::COLOR,
			]
		);
		$chart_data2->add_control(
			'border_hover_color', [
				'label' => esc_html__('Border Color', 'sina-ext-pro'),
				'type' => Controls_Manager::COLOR,
			]
		);

		$chart_data2->end_controls_tab();

		$chart_data2->end_controls_tabs();

		$chart_data2->add_control(
			'border_width', [
				'label' => esc_html__('Border Width', 'sina-ext-pro'),
				'type' => Controls_Manager::NUMBER,
				'default' => '1',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'chart_data2',
			[
				'label' => esc_html__('Add Data', 'sina-ext-pro'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $chart_data2->get_controls(),
				'default' => [
					[
						'legend_text' => 'HTML',
						'data_set' => '22',
						'bg_color' => 'rgba(16,133,228,0.6)',
						'border_color' => 'rgba(16,133,228,0.6)',
					],
					[
						'legend_text' => 'CSS',
						'data_set' => '12',
						'bg_color' => 'rgba(222,31,81,0.6)',
						'border_color' => 'rgba(222,31,81,0.6)',
					],
					[
						'legend_text' => 'JavaScript',
						'data_set' => '24',
						'bg_color' => 'rgba(10,222,81,0.6)',
						'border_color' => 'rgba(10,222,81,0.6)',
					],
					[
						'legend_text' => 'PHP',
						'data_set' => '39',
						'bg_color' => 'rgba(222,31,222,0.6)',
						'border_color' => 'rgba(222,31,222,0.6)',
					],
				],
				'condition' => [
					'chart_type' => ['doughnut', 'pie', 'polarArea'],
				],
				'title_field' => '{{{ legend_text }}}',
			]
		);

		$this->end_controls_section();
		// End Chart Data
		// ================


		// Start Chart Settings
		// =====================
		$this->start_controls_section(
			'chart_settings', [
				'label' => esc_html__( 'Settings ', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'is_title',
			[
				'label'   => esc_html__( 'Show Title', 'sina-ext-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'title_text',
			[
				'label'   => esc_html__( 'Title Text', 'sina-ext-pro' ),
				'label_block' => true,
				'type'    => Controls_Manager::TEXT,
				'default' => 'Sina Pro Chart',
				'condition' => [
					'is_title' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'value_prefix',
			[
				'label'   => esc_html__( 'Value Prefix', 'sina-ext-pro' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'is_thousands_separator',
			[
				'label'   => esc_html__( 'Thousands Separator', 'sina-ext-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'is_legend',
			[
				'label'   => esc_html__( 'Legend', 'sina-ext-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'is_tooltip',
			[
				'label'   => esc_html__( 'Tooltip', 'sina-ext-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'grid_lines',
			[
				'label'   => esc_html__( 'Grid Lines', 'sina-ext-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' =>[
					'chart_type' => ['bar', 'horizontalBar', 'line'],
				]
			]
		);
		$this->add_control(
			'grid_color',
			[
				'label'   => esc_html__( 'Grid Color', 'sina-ext-pro' ),
				'type'    => Controls_Manager::COLOR,
				'default' => 'rgba(16,133,228,0.1)',
				'condition' => [
					'chart_type' => ['bar', 'horizontalBar', 'line'],
					'grid_lines' => 'yes',
				]
			]
		);
		$this->add_control(
			'aspect_ratio',
			[
				'label' => esc_html__( 'Aspect Ratio', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0.5,
				'max' => 3,
				'step' => 0.1,
				'default' => 1.5,
			]
		);
		$this->add_control(
			'animation_speed',
			[
				'label' => esc_html__( 'Animation Speed', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 10000,
				'step' => 100,
				'default' => 1200,
			]
		);
		$this->add_control(
			'animation_type',
			[
				'label' => esc_html__( 'Animation Type', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'linear' => 'Linear',
					'easeInQuad' => 'easeInQuad',
					'easeOutQuad' => 'easeOutQuad',
					'easeInOutQuad' => 'easeInOutQuad',
					'easeInCubic' => 'easeInCubic',
					'easeOutCubic' => 'easeOutCubic',
					'easeInOutCubic' => 'easeInOutCubic',
					'easeInQuart' => 'easeInQuart',
					'easeOutQuart' => 'easeOutQuart',
					'easeInOutQuart' => 'easeInOutQuart',
					'easeInQuint' => 'easeInQuint',
					'easeOutQuint' => 'easeOutQuint',
					'easeInOutQuint' => 'easeInOutQuint',
					'easeInSine' => 'easeInSine',
					'easeOutSine' => 'easeOutSine',
					'easeInOutSine' => 'easeInOutSine',
					'easeInExpo' => 'easeInExpo',
					'easeOutExpo' => 'easeOutExpo',
					'easeInOutExpo' => 'easeInOutExpo',
					'easeInCirc' => 'easeInCirc',
					'easeOutCirc' => 'easeOutCirc',
					'easeInOutCirc' => 'easeInOutCirc',
					'easeInElastic' => 'easeInElastic',
					'easeOutElastic' => 'easeOutElastic',
					'easeInOutElastic' => 'easeInOutElastic',
					'easeInBack' => 'easeInBack',
					'easeOutBack' => 'easeOutBack',
					'easeInOutBack' => 'easeInOutBack',
					'easeInBounce' => 'easeInBounce',
					'easeOutBounce' => 'easeOutBounce',
					'easeInOutBounce' => 'easeInOutBounce',
				],
				'default' => 'linear',
			]
		);

		$this->end_controls_section();
		// End Chart Settings
		// ===================


		// Start Chart Styles
		// =====================
		$this->start_controls_section(
			'chart_styles', [
				'label' => esc_html__( 'Chart Style', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'chart_type' => ['line', 'pie', 'radar']
				],
			]
		);

		$this->add_control(
			'radar_chart_fill',
			[
				'label' => esc_html__( 'Fill', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'chart_type' => 'radar',
				]
			]
		);
		$this->add_control(
			'line_chart_stepped',
			[
				'label'   => esc_html__( 'Stepped Line', 'sina-ext-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'chart_type' => ['line', 'radar']
				]
			]
		);
		$this->add_control(
			'line_chart_tension',
			[
				'label'   => esc_html__( 'Tension', 'sina-ext-pro' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 0.5,
				'condition' => [
					'chart_type' => ['line', 'radar'],
					'line_chart_stepped' => 'yes'
				]
			]
		);
		$this->add_control(
			'line_chart_fill',
			[
				'label' => esc_html__( 'Fill', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'false' => 'None',
					'top' => 'Top',
					'bottom' => 'Bottom',
				],
				'default' => 'bottom',
				'condition' => [
					'chart_type' => 'line'
				]
			]
		);
		$this->add_control(
			'pointer_style',
			[
				'label'   => esc_html__( 'Pointer Style', 'sina-ext-pro' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'circle' => 'Circle',
					'cross' => 'Plus',
					'line' => 'Minus',
					'crossRot' => 'Cross',
					'rect' => 'Square',
					'rectRounded' => 'Square Round',
					'rectRot' => 'Square Rotate',
					'triangle' => 'Triangle',
					'star' => 'Asterisk',
				],
				'default' => 'circle',
				'condition' => [
					'chart_type' => ['line', 'radar'],
				],
			]
		);
		$this->add_control(
			'pointer_radius',
			[
				'label'   => esc_html__( 'Size', 'sina-ext-pro' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 5,
				'condition' => [
					'chart_type' => ['line', 'radar'],
				],
			]
		);
		$this->add_control(
			'pointer_hover_radius',
			[
				'label'   => esc_html__( 'Hover Size', 'sina-ext-pro' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 8,
				'condition' => [
					'chart_type' => ['line', 'radar'],
				],
			]
		);
		$this->add_control(
			'pointer_border',
			[
				'label'   => esc_html__( 'Border', 'sina-ext-pro' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 2,
				'condition' => [
					'chart_type' => ['line', 'radar'],
				],
			]
		);
		$this->add_control(
			'pointer_hover_border',
			[
				'label'   => esc_html__( 'Hover Border', 'sina-ext-pro' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 2,
				'condition' => [
					'chart_type' => ['line', 'radar'],
				],
			]
		);
		$this->add_control(
			'pie_border_width',
			[
				'label'   => esc_html__( 'Border Width', 'sina-ext-pro' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 1,
				'condition' => [
					'chart_type' => 'pie'
				]
			]
		);

		$this->end_controls_section();
		// End Chart Styles
		// ==================


		// Start Title Styles
		// =====================
		$this->start_controls_section(
			'title_styles', [
				'label' => esc_html__( 'Title ', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'is_title' => 'yes'
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
			]
		);
		$this->add_control(
			'title_size',
			[
				'label' => esc_html__( 'Font Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 16,
			]
		);
		$this->add_control(
			'title_line_height',
			[
				'label' => esc_html__( 'Line Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 1.5,
			]
		);
		$this->add_control(
			'title_style',
			[
				'label' => esc_html__( 'Font Style', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'bold' => 'Bold',
					'normal' => 'Normal',
				],
				'default' => 'bold',
			]
		);
		$this->add_control(
			'title_position',
			[
				'label'   => esc_html__( 'Position', 'sina-ext-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'sina-ext-pro' ),
						'icon'  => 'fa fa-long-arrow-left',
					],
					'top' => [
						'title' => esc_html__( 'Top', 'sina-ext-pro' ),
						'icon'  => 'fa fa-long-arrow-up',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'sina-ext-pro' ),
						'icon'  => 'fa fa-long-arrow-down',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'sina-ext-pro' ),
						'icon'  => 'fa fa-long-arrow-right',
					],
				],
				'default' => 'top',
				'toggle' => false,
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 15,
			]
		);

		$this->end_controls_section();
		// End Title Styles
		// ===================


		// Start Cats Styles
		// =====================
		$this->start_controls_section(
			'cats_styles', [
				'label' => esc_html__( 'Categories and Step Number', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'chart_type' => ['bar', 'horizontalBar', 'line', 'radar', 'polarArea'],
				],
			]
		);

		$this->add_control(
			'cats_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
			]
		);
		$this->add_control(
			'cats_size',
			[
				'label' => esc_html__( 'Font Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 12,
			]
		);
		$this->add_control(
			'cats_style',
			[
				'label' => esc_html__( 'Font Style', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'bold' => 'Bold',
					'normal' => 'Normal',
				],
				'default' => 'normal',
			]
		);
		$this->add_control(
			'cats_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
				'condition' => [
					'chart_type!' => ['radar', 'polarArea'],
				],
			]
		);

		$this->end_controls_section();
		// End Cats Styles
		// ===================


		// Start Legend Styles
		// =====================
		$this->start_controls_section(
			'legend_styles', [
				'label' => esc_html__( 'Legend ', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'is_legend' => 'yes'
				],
			]
		);

		$this->add_control(
			'legend_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
			]
		);
		$this->add_control(
			'legend_size',
			[
				'label' => esc_html__( 'Font Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 12,
			]
		);
		$this->add_control(
			'legend_style',
			[
				'label' => esc_html__( 'Font Style', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'bold' => 'Bold',
					'normal' => 'Normal',
				],
				'default' => 'normal',
			]
		);
		$this->add_control(
			'legend_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 15,
			]
		);
		$this->add_control(
			'legend_box',
			[
				'label'   => esc_html__( 'Box', 'sina-ext-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'legend_box_width',
			[
				'label' => esc_html__( 'Box Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 30,
				'condition' => [
					'legend_box' => 'yes'
				],
			]
		);
		$this->add_control(
			'legend_position',
			[
				'label'   => esc_html__( 'Position', 'sina-ext-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'sina-ext-pro' ),
						'icon'  => 'fa fa-long-arrow-left',
					],
					'top' => [
						'title' => esc_html__( 'Top', 'sina-ext-pro' ),
						'icon'  => 'fa fa-long-arrow-up',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'sina-ext-pro' ),
						'icon'  => 'fa fa-long-arrow-down',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'sina-ext-pro' ),
						'icon'  => 'fa fa-long-arrow-right',
					],
				],
				'default' => 'right',
				'toggle' => false,
			]
		);

		$this->end_controls_section();
		// End Legend Styles
		// ===================


		// Start Tooltip Styles
		// =====================
		$this->start_controls_section(
			'tooltip_styles', [
				'label' => esc_html__( 'Tooltip ', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'is_tooltip' => 'yes',
				],
			]
		);

		$this->add_control(
			'tooltip_bg',
			[
				'label'   => esc_html__( 'Background Color', 'sina-ext-pro' ),
				'type'    => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.6)',
			]
		);
		$this->add_control(
			'tooltip_title_color',
			[
				'label' => esc_html__( 'Title Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
			]
		);
		$this->add_control(
			'tooltip_title_size',
			[
				'label' => esc_html__( 'Title Font Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 13,
			]
		);
		$this->add_control(
			'tooltip_title_style',
			[
				'label' => esc_html__( 'Title Font Style', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'bold' => 'Bold',
					'normal' => 'Normal',
				],
				'default' => 'normal',
			]
		);
		$this->add_control(
			'tooltip_label_color',
			[
				'label' => esc_html__( 'Label Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
			]
		);
		$this->add_control(
			'tooltip_label_size',
			[
				'label' => esc_html__( 'Label Font Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 12,
			]
		);
		$this->add_control(
			'tooltip_label_style',
			[
				'label' => esc_html__( 'Label Font Style', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'bold' => 'Bold',
					'normal' => 'Normal',
				],
				'default' => 'normal',
			]
		);

		$this->end_controls_section();
		// End Tooltip Styles
		// ===================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$uid = uniqid('sina-chart-');
		$all_data = [];
		$options  = [];
		$options['value_prefix'] = $data['value_prefix'];
		$options['thousands_separator'] = $data['is_thousands_separator'];
		$options['grid_lines'] = $data['grid_lines'];
		$options['aspectRatio'] = $data['aspect_ratio'];

		if ( in_array($data['chart_type'], ['pie', 'doughnut', 'polarArea']) ) {
			$bg_color 			= [];
			$bg_hover_color 	= [];
			$border_color 		= [];
			$border_hover_color = [];
			$data_of_chart 		= [];
			$all_label 			= [];

			foreach ($data['chart_data2'] as $chart_data2) {
				$bg_color[] 		= $chart_data2['bg_color'];
				$bg_hover_color[] 	= $chart_data2['bg_hover_color'] ? $chart_data2['bg_hover_color'] : $chart_data2['bg_color'];
				$border_color[] 	= $chart_data2['border_color'];
				$border_hover_color[] = $chart_data2['border_hover_color'] ? $chart_data2['border_hover_color'] : $chart_data2['border_color'];
				$data_of_chart[] 	= $chart_data2['data_set'];
				$all_label[] 		= $chart_data2['legend_text'];
			}

			$all_data['datasets'][] = [
				'data' 					=> $data_of_chart,
				'backgroundColor'  		=> $bg_color,
				'hoverBackgroundColor'  => $bg_hover_color,
				'borderColor'  			=> $border_color,
				'hoverBorderColor'  	=> $border_hover_color
			];
			$all_data['labels'] 	= $all_label;
		} else {

			foreach ($data['chart_cats'] as $labels) {
				$all_data['labels'][] = $labels['cats_name'];
			}

			foreach ($data['chart_data'] as $key => $chart_data) {
				$bg_color 			= $chart_data['bg_color'];
				$bg_hover_color 	= $chart_data['bg_hover_color'];
				$border_color 	 	= $chart_data['border_color'];
				$border_hover_color = $chart_data['border_hover_color'];
				$border_width 	 	= $chart_data['border_width'];
				$bg_hover_color 	= $bg_hover_color ? $bg_hover_color : $bg_color;
				$border_hover_color = $border_hover_color ? $border_hover_color : $border_color;

				$all_data['datasets'][] = [
					'label' 				=> $chart_data['legend_text'],
					'data'  				=> explode( ',', trim($chart_data['data_set'], ',') ),
					'backgroundColor' 		=> $bg_color,
					'hoverBackgroundColor'  => $bg_hover_color,
					'borderColor'  			=> $border_color,
					'hoverBorderColor'  	=> $border_hover_color,
					'borderWidth'  			=> $border_width,
				];
				if ('radar' == $data['chart_type']) {
					$all_data['datasets'][$key]['fill'] = ($data['radar_chart_fill'] == 'yes') ? true : false;
				}
			}
		}

		// Animation
		$options['animation'] = [
			'duration'  => $data['animation_speed'],
			'easing' 	=> $data['animation_type']
		];

		// Title Styles
		if ( 'yes' == $data['is_title'] && $data['title_text'] ) {
			$options['title'] = [
				'display' 	 => true,
				'text' 		 => $data['title_text'],
				'position' 	 => $data['title_position'],
				'fontColor'  => $data['title_color'],
				'fontSize' 	 => $data['title_size'],
				'lineHeight' => $data['title_line_height'],
				'fontStyle'  => $data['title_style'],
				'padding' 	 => $data['title_padding'],
			];
		}

		// Legend Styles
		$options['legend'] = [ 'display' => false ];
		if ( 'yes' == $data['is_legend'] ) {
			$options['legend'] = [
				'position' => $data['legend_position'] ,
				'labels' => [
					'fontColor' 	=> $data['legend_color'],
					'fontSize'  	=> $data['legend_size'],
					'fontStyle' 	=> $data['legend_style'],
					'padding' 		=> $data['legend_padding'],
					'boxWidth'  	=> $data['legend_box_width'],
					'usePointStyle' => ($data['legend_box'] == 'yes') ? false : true,
				]
			];
		}

		// Tooltip Styles
		$options['tooltips'] = [ 'enabled' => false ];
		if ( 'yes' == $data['is_tooltip'] ) {
			$options['tooltips'] = [
				'intersect' 		=> true,
				'mode' 				=> 'nearest',
				'backgroundColor' 	=> $data['tooltip_bg'],
				'titleFontColor' 	=> $data['tooltip_title_color'],
				'titleFontSize' 	=> $data['tooltip_title_size'],
				'titleFontStyle' 	=> $data['tooltip_title_style'],
				'bodyFontColor' 	=> $data['tooltip_label_color'],
				'bodyFontSize' 		=> $data['tooltip_label_size'],
				'bodyFontStyle' 	=> $data['tooltip_label_style'],
			];
		}

		// Pointer Styles
		if ( in_array($data['chart_type'], ['line', 'radar']) ) {
			$options['elements']['point'] = [
				'pointStyle' 		=> $data['pointer_style'],
				'radius' 			=> $data['pointer_radius'],
				'hoverRadius' 		=> $data['pointer_hover_radius'],
				'borderWidth' 		=> $data['pointer_border'],
				'hoverBorderWidth'  => $data['pointer_hover_border'],
			];
			$options['elements']['line'] = [
				'tension' 		 => $data['line_chart_tension'],
				'stepped' 		 => ($data['line_chart_stepped'] == 'yes') ? false : true,
			];
		}

		// Line Styles
		if ( in_array($data['chart_type'], ['line']) ) {
			$options['elements']['line']['borderCapStyle'] = 'butt';
			$options['elements']['line']['fill'] = $data['line_chart_fill'];
		}

		// Radar Styles
		if ( in_array($data['chart_type'], ['radar']) ) {
			$options['elements']['line'] = [
				'tension' => ($data['line_chart_stepped'] == 'yes') ? $data['line_chart_tension'] : 0,
			];
		}

		// Pie Styles
		if ( in_array($data['chart_type'], ['pie']) ) {
			$options['elements']['arc'] = [
				'backgroundColor' => 'rgba(0, 0, 0, 0.1)',
				'borderColor' 	  => 'rgba(0, 0, 0, 0.1)',
				'borderWidth' 	  => $data['pie_border_width'],
				'borderAlign' 	  => 'right',
			];
		}

		// Grid & Ticks Styles
		if( in_array($data['chart_type'], ['bar', 'horizontalBar', 'line']) && 'yes' == $data['grid_lines'] ) {

			// Ticks Styles
			$ticks_data = [
				'beginAtZero' 	=> true,
				'display' 		=> true,
				'fontColor' 	=> $data['cats_color'],
				'fontSize' 		=> $data['cats_size'],
				'fontStyle' 	=> $data['cats_style'],
				'padding'		=> $data['cats_padding'],
			];

			// Axes Styles
			$options['scales']['xAxes'] = [
				[
					'ticks' => $ticks_data,
					'gridLines' => [
						'drawBorder' => false,
						'color' => $data['grid_color'],
					]
				]
			];
			$options['scales']['yAxes'] = [
				[
					'ticks' => $ticks_data,
					'gridLines' => [
						'drawBorder' => false,
						'color' => $data['grid_color'],
					]
				]
			];
		} elseif( in_array($data['chart_type'], ['radar', 'polarArea']) ) {
			// Ticks Styles
			$ticks_data = [
				'beginAtZero' 	=> true,
				'display' 		=> true,
				'fontColor' 	=> $data['cats_color'],
				'fontSize' 		=> $data['cats_size'],
				'fontStyle' 	=> $data['cats_style'],
				'padding'		=> $data['cats_padding'],
			];

			// Point Labels Styles
			$point_labels = [
				'fontColor' => $data['cats_color'],
				'fontSize' 	=> $data['cats_size'],
				'fontStyle' => $data['cats_style'],
			];
			$options['scale'] = [
				'ticks' => $ticks_data,
				'pointLabels' => $point_labels
			];
		}


		if ( in_array($data['chart_type'], ['doughnut']) ) {
			 $options['cutoutPercentage'] = 50;
		}

		if ( in_array($data['chart_type'], ['pie']) ) {
			 $options['cutoutPercentage'] = 0;
		}

		$options['plugins'] = [
			'deferred' => [
				'xOffset' => 200,
				'yOffset' => '50%',
				'delay' => 200,
			]
		];
		?>
		<div class="sina-pro-chart"
		data-chart-id="<?php echo esc_attr( $uid ); ?>"
		data-chart-type="<?php echo esc_attr( $data['chart_type'] ); ?>"
		data-chart-labels='<?php echo wp_json_encode( $all_data['labels'] ); ?>'
		data-chart-datasets='<?php echo wp_json_encode( $all_data['datasets'] ); ?>'
		data-chart-options='<?php echo wp_json_encode( $options ); ?>'>
			<canvas id="<?php echo esc_attr( $uid ); ?>"></canvas>
		</div><!-- .sina-pro-chart -->
		<?php
	}


	protected function _content_template() {

	}
}
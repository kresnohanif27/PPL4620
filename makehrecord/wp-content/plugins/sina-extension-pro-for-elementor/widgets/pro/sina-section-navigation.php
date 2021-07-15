<?php

/**
 * Section Navigation Widget.
 *
 * @since 1.0.0
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

class Sina_Ext_Pro_Section_Navigation_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_ext_pro_section_nav';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Section Nav', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-ellipsis-v';
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
		return [ 'sina section nav', 'sina navigation', 'sina scroll' ];
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
		// Start Section Nav
		// ===================
		$this->start_controls_section(
			'nav_content',
			[
				'label' => esc_html__( 'Section Nav', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'is_tooltip',
			[
				'label' => esc_html__( 'Tooltip', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'section_title',
			[
				'label' => esc_html__( 'Section Title', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Title', 'sina-ext-pro' ),
				'default' => 'Home',
			]
		);
		$repeater->add_control(
			'section_id',
			[
				'label' => esc_html__( 'Section ID', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter ID', 'sina-ext-pro' ),
				'default' => 'section-home',
			]
		);
		$repeater->add_control(
			'section_icon',
			[
				'label' => esc_html__( 'Select Icon', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-home',
			]
		);

		$repeater->add_control(
			'icon_style',
			[
				'label' => esc_html__( 'Icon Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$repeater->start_controls_tabs( 'single_nav_tabs' );

		$repeater->start_controls_tab(
			'single_nav_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);
		$repeater->add_control(
			'single_icon_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-section-nav {{CURRENT_ITEM}} > a' => 'color: {{VALUE}};',
				],
			]
		);
		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'single_nav_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);
		$repeater->add_control(
			'single_current_icon_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-section-nav {{CURRENT_ITEM}} > a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'section_navs',
			[
				'label' => esc_html__( 'Add Nav', 'sina-ext-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'section_icon' => 'fa fa-home',
						'section_title' => 'Home',
						'section_id' => 'section-home',
					],
					[
						'section_icon' => 'fa fa-user',
						'section_title' => 'About',
						'section_id' => 'section-about',
					],
					[
						'section_icon' => 'fa fa-envelope',
						'section_title' => 'Contact',
						'section_id' => 'section-contact',
					],
				],
				'title_field' => '{{{ section_title }}}',
			]
		);

		$this->end_controls_section();
		// End Section Nav
		// =================


		// Start Wrap Style
		// ===================
		$this->start_controls_section(
			'wrap_style',
			[
				'label' => esc_html__( 'Navigation Wrapper', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'wrap_alignment',
			[
				'label' => esc_html__( 'Alignment', 'sina-ext-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'sina-navs-left' => [
						'title' => esc_html__( 'Left', 'sina-ext-pro' ),
						'icon' => 'eicon-h-align-left',
					],
					'sina-navs-right' => [
						'title' => esc_html__( 'Right', 'sina-ext-pro' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'sina-navs-right',
			]
		);
		$this->add_responsive_control(
			'wrap_side_dist',
			[
				'label' => esc_html__( 'Side Distance', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-section-nav.sina-navs-right' => 'right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-pro-section-nav.sina-navs-left' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wrap_top_dist',
			[
				'label' => esc_html__( 'Top Distance', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'max' => 2000,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-section-nav' => 'top: {{SIZE}}{{UNIT}};',
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
						'default' => 'rgba(16,133,228,0.4)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-section-nav',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'wrap_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-section-nav',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'wrap_border',
				'selector' => '{{WRAPPER}} .sina-pro-section-nav',
			]
		);
		$this->add_responsive_control(
			'wrap_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-section-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'top' => '10',
					'right' => '15',
					'bottom' => '10',
					'left' => '15',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-section-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_style',
			[
				'label' => esc_html__( 'Icon Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '16',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-section-nav li a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
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
					'{{WRAPPER}} .sina-pro-section-nav li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'nav_icon_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-section-nav li a' => 'color: {{VALUE}};',
				],
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
			'nav_hover_icon_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-section-nav li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// End Wrap Style
		// ================


		// Start Tooltip
		// ===============
		$this->start_controls_section(
			'tooltips_style',
			[
				'label' => esc_html__( 'Tooltips', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'is_tooltip' => 'yes',
				],
			]
		);
		Sina_Common_Data::tooltip_style( $this, 'nav', '' );
		$this->end_controls_section();
		// End Tooltip
		// =============
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$tooltip = ( 'yes' == $data['is_tooltip'] ) ? 'sina-tooltip' : '';
		$align = ( 'sina-navs-left' == $data['wrap_alignment'] ) ? 'right' : 'left';
		?>
		<div class="sina-pro-section-nav <?php echo esc_attr( $data['wrap_alignment'] ); ?>">
			<ul>
				<?php foreach ($data['section_navs'] as $key => $nav): ?>
					<li class="elementor-repeater-item-<?php echo esc_attr( $nav['_id'] ); ?>">
						<a class="sina-section-nav <?php echo esc_attr( $tooltip ); ?>"
						<?php if ( 'yes' == $data['is_tooltip'] ): ?>
							data-toggle="tooltip"
							data-placement="<?php echo esc_attr( $align ); ?>"
							title="<?php echo esc_attr( $nav['section_title'] ); ?>" 
						<?php endif; ?>
						href="#<?php echo esc_attr( $nav['section_id'] ); ?>">
							<?php printf('<i class="%s"></i>', $nav['section_icon']); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div><!-- .sina-pro-section-nav -->
		<?php
	}


	protected function _content_template() {
		?>
		<div class="sina-pro-section-nav {{{settings.wrap_alignment}}}">
			<ul>
				<#
					var tooltip = ('yes' == settings.is_tooltip) ? 'sina-tooltip' : '';
					var align = ('sina-navs-left' == settings.wrap_alignment) ? 'right' : 'left';
					_.each( settings.section_navs, function( nav, index ) {
					#>
					<li class="elementor-repeater-item-{{{nav._id}}}">
						<a class="sina-section-nav {{{tooltip}}}"
						<# if ('yes' == settings.is_tooltip) { #>
							data-toggle="tooltip"
							data-placement="{{{align}}}"
							title="{{{nav.section_title}}}" 
						<# } #>
						href="#{{{nav.section_id}}}">
							<i class="{{{nav.section_icon}}}"></i>
						</a>
					</li>
				<# }); #>
			</ul>
		</div><!-- .sina-pro-section-nav -->
		<?php
	}
}
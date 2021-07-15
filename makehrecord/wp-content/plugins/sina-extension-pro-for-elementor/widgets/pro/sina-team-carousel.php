<?php

/**
 * Team Carousel Widget.
 *
 * @since 1.2.9
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Team_Carousel_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.2.9
	 */
	public function get_name() {
		return 'sina_ext_pro_team_carousel';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.2.9
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Team Carousel', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.2.9
	 */
	public function get_icon() {
		return 'eicon-posts-carousel';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.2.9
	 */
	public function get_categories() {
		return [ 'sina-ext-pro-basic' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.2.9
	 */
	public function get_keywords() {
		return [ 'sina pro team carousel', 'sina pro team slider' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.2.9
	 */
	public function get_style_depends() {
		return [
			'owl-carousel',
			'animate-merge',
			'sina-ext-pro-widgets',
		];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 1.2.9
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
	 * @since 1.2.9
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Team Content
		// =====================
		$this->start_controls_section(
			'team_content',
			[
				'label' => esc_html__( 'Member', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Layout', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'thumb' => esc_html__( 'Thumb', 'sina-ext-pro' ),
					'grid' => esc_html__( 'Grid', 'sina-ext-pro' ),
					'list' => esc_html__( 'List', 'sina-ext-pro' ),
				],
				'default' => 'thumb',
			]
		);
		$this->add_control(
			'image_position',
			[
				'label' => esc_html__( 'Image Position', 'sina-ext-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'sina-ext-pro' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'sina-ext-pro' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .sina-team .sina-team-image, {{WRAPPER}} .sina-team .sina-team-content' => 'float: {{VALUE}};',
				],
				'condition' => [
					'layout' => 'list',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'name',
			[
				'label' => esc_html__( 'Name', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Name', 'sina-ext-pro' ),
				'default' => 'Jhon Doe',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'position',
			[
				'label' => esc_html__( 'Position', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Position', 'sina-ext-pro' ),
				'default' => 'CEO',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'desc',
			[
				'label' => esc_html__( 'Description', 'sina-ext-pro' ),
				'lable_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter Description', 'sina-ext-pro' ),
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, autem amet. Labore eos cum at, et illo ducimus.',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'sina-ext-pro' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_PRO_URL .'assets/img/team-1.jpg',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'social_icons',
			[
				'label' => esc_html__( 'Social Links', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'facebook',
			[
				'label' => esc_html__( 'Facebook URL', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => 'https://facebook.com',
				'placeholder' => 'https://your-link.com',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'twitter',
			[
				'label' => esc_html__( 'Twitter URL', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => 'https://twitter.com',
				'placeholder' => 'https://your-link.com',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'linkedin',
			[
				'label' => esc_html__( 'Linkedin URL', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => 'https://linkedin.com',
				'placeholder' => 'https://your-link.com',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'instagram',
			[
				'label' => esc_html__( 'Instagram URL', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => 'https://your-link.com',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'youtube',
			[
				'label' => esc_html__( 'Youtube URL', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => 'https://your-link.com',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'pinterest',
			[
				'label' => esc_html__( 'Pinterest URL', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => 'https://your-link.com',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'dribbble',
			[
				'label' => esc_html__( 'Dribbble URL', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => 'https://your-link.com',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'behance',
			[
				'label' => esc_html__( 'Behance URL', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => 'https://your-link.com',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'tumblr',
			[
				'label' => esc_html__( 'Tumblr URL', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => 'https://your-link.com',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'reddit',
			[
				'label' => esc_html__( 'Reddit URL', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => 'https://your-link.com',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'team_members',
			[
				'label' => esc_html__( 'Add Social Icon', 'sina-ext-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name' => 'Steave Finn',
						'position' => 'CEO',
						'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, autem amet. Labore eos cum at, et illo ducimus.',
						'image' => [
							'url' => SINA_EXT_PRO_URL .'assets/img/team-1.jpg',
						],
						'facebook' => 'https://facebook.com',
						'twitter' => 'https://twitter.com',
						'linkedin' => 'https://linkedin.com',
					],
					[
						'name' => 'Sania Smith',
						'position' => 'Content Writer',
						'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, autem amet. Labore eos cum at, et illo ducimus.',
						'image' => [
							'url' => SINA_EXT_PRO_URL .'assets/img/team-2.jpg',
						],
						'facebook' => 'https://facebook.com',
						'twitter' => 'https://twitter.com',
						'linkedin' => 'https://linkedin.com',
					],
					[
						'name' => 'Jhon Doe',
						'position' => 'Web Designer',
						'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, autem amet. Labore eos cum at, et illo ducimus.',
						'image' => [
							'url' => SINA_EXT_PRO_URL .'assets/img/team-3.jpg',
						],
						'facebook' => 'https://facebook.com',
						'twitter' => 'https://twitter.com',
						'linkedin' => 'https://linkedin.com',
					],
					[
						'name' => 'Tonny Parker',
						'position' => 'Graphic Designer',
						'desc' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, autem amet. Labore eos cum at, et illo ducimus.',
						'image' => [
							'url' => SINA_EXT_PRO_URL .'assets/img/team-4.jpg',
						],
						'facebook' => 'https://facebook.com',
						'twitter' => 'https://twitter.com',
						'linkedin' => 'https://linkedin.com',
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();
		// End Team Content
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
			'show_item',
			[
				'label' => esc_html__( 'Show Item', 'sina-ext-pro' ),
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
				'desktop_default' => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
			]
		);
		Sina_Common_Data::carousel_content( $this );

		$this->end_controls_section();
		// End Carousel Settings
		// ======================


		// Start Box Style
		// =====================
		$this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Box', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_effects',
			[
				'label' => esc_html__( 'Effects', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-team-box-move' => esc_html__( 'Move', 'sina-ext-pro' ),
					'sina-team-box-zoom' => esc_html__( 'Zoom', 'sina-ext-pro' ),
					'' => esc_html__( 'None', 'sina-ext-pro' ),
				],
				'condition' => [
					'layout!' => 'thumb',
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'scale',
			[
				'label' => esc_html__( 'Scale', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1.1',
				],
				'condition' => [
					'layout!' => 'thumb',
					'box_effects' => 'sina-team-box-zoom',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team.sina-team-box-zoom:hover' => 'transform: scale({{SIZE}});',
				],
			]
		);
		$this->add_control(
			'move',
			[
				'label' => esc_html__( 'Move', 'sina-ext-pro' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'layout!' => 'thumb',
					'box_effects' => 'sina-team-box-move',
				],
			]
		);

		$this->start_popover();
		$this->add_responsive_control(
			'translateX',
			[
				'label' => esc_html__( 'Horizontal', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -100,
						'max' => 100,
					],
				],
				'desktop_default' => [
					'size' => '0',
				],
				'tablet_default' => [
					'size' => '0',
				],
				'mobile_default' => [
					'size' => '0',
				],
				'condition' => [
					'layout!' => 'thumb',
					'box_effects' => 'sina-team-box-move',
				],
			]
		);
		$this->add_responsive_control(
			'translateY',
			[
				'label' => esc_html__( 'Vertical', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -100,
						'max' => 100,
					],
				],
				'desktop_default' => [
					'size' => '-10',
				],
				'tablet_default' => [
					'size' => '-10',
				],
				'mobile_default' => [
					'size' => '-10',
				],
				'condition' => [
					'layout!' => 'thumb',
					'box_effects' => 'sina-team-box-move',
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .sina-team-box-move:hover' => 'transform: translate({{translateX.SIZE || 0}}px, {{translateY.SIZE || 0}}px);',
					'(tablet){{WRAPPER}} .sina-team-box-move:hover' => 'transform: translate({{translateX_tablet.SIZE || 0}}px, {{translateY_tablet.SIZE || 0}}px);',
					'(mobile){{WRAPPER}} .sina-team-box-move:hover' => 'transform: translate({{translateX_mobile.SIZE || 0}}px, {{translateY_mobile.SIZE || 0}}px);',
				],
			]
		);
		$this->end_popover();

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'condition' => [
					'layout!' => 'thumb',
				],
				'selector' => '{{WRAPPER}} .sina-team',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-team',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .sina-team',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-team, {{WRAPPER}} .sina-team-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'condition' => [
					'layout!' => 'thumb',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-team' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .sina-team' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Box Style
		// =====================


		// Start Overlay Style
		// =====================
		$this->start_controls_section(
			'overlay_style',
			[
				'label' => esc_html__( 'Overlay', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'thumb',
				],
			]
		);

		$this->add_control(
			'effects',
			[
				'label' => esc_html__( 'Effects', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-team-move' => esc_html__( 'Move', 'sina-ext-pro' ),
					'sina-team-zoom' => esc_html__( 'Zoom', 'sina-ext-pro' ),
					'sina-team-zoom sina-team-move' => esc_html__( 'Move & Zoom', 'sina-ext-pro' ),
					'' => esc_html__( 'None', 'sina-ext-pro' ),
				],
				'default' => 'sina-team-move',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => 'rgba(31,140,231,0.6)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-team-overlay',
			]
		);
		$this->add_responsive_control(
			'overlay_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '60',
					'right' => '20',
					'bottom' => '20',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Overlay Style
		// =====================


		// Start Image Style
		// ====================
		$this->start_controls_section(
			'image_style',
			[
				'label' => esc_html__( 'Image', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'thumb',
				],
			]
		);

		Sina_Common_Data::morphing_animation( $this );

		$this->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'unit' => '%',
					'size' => '50',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-team img, {{WRAPPER}} .sina-team-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '300',
				],
				'condition' => [
					'layout' => 'list',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'image_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-team img, {{WRAPPER}} .sina-team-image',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .sina-team img, {{WRAPPER}} .sina-team-image',
			]
		);
		$this->add_responsive_control(
			'image_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-team img, {{WRAPPER}} .sina-team-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'condition' => [
					'layout' => 'grid',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Image Style
		// =====================


		// Start Content Style
		// =====================
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'thumb',
				],
			]
		);

		$this->add_responsive_control(
			'content_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'unit' => '%',
					'size' => '50',
				],
				'condition' => [
					'layout' => 'list',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team .sina-team-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-team-content',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'selector' => '{{WRAPPER}} .sina-team-content',
			]
		);
		$this->add_responsive_control(
			'content_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-team-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '30',
					'right' => '20',
					'bottom' => '20',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-team-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Content Style
		// =====================


		// Start Name Style
		// =====================
		$this->start_controls_section(
			'name_style',
			[
				'label' => esc_html__( 'Name', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-team-name' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
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
				],
				'selector' => '{{WRAPPER}} .sina-team-name',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'name_shadow',
				'selector' => '{{WRAPPER}} .sina-team-name',
			]
		);
		$this->add_responsive_control(
			'name_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'unit' => 'px',
					'size' => '15',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Name Style
		// =====================


		// Start Position Style
		// =====================
		$this->start_controls_section(
			'position_style',
			[
				'label' => esc_html__( 'Position', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'position_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-team-position' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'position_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'   => [
						'default' => [
							'size' => '14',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-team-position',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'position_shadow',
				'selector' => '{{WRAPPER}} .sina-team-position',
			]
		);
		$this->add_responsive_control(
			'position_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'unit' => 'px',
					'size' => '15',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-position' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Position Style
		// =====================


		// Start Description Style
		// =========================
		$this->start_controls_section(
			'desc_style',
			[
				'label' => esc_html__( 'Description', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-team-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .sina-team-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-team-desc',
			]
		);

		$this->end_controls_section();
		// End Description Style
		// =====================


		// Start Icon Style
		// =====================
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Social Icon', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'font_size',
			[
				'label' => esc_html__( 'Font Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'unit' => 'px',
					'size' => '14',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-social a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'unit' => 'px',
					'size' => '40',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-social a' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'font_line_height',
			[
				'label' => esc_html__( 'Line Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'unit' => 'px',
					'size' => '40',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-social a' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'team_icon_tabs' );

		$this->start_controls_tab(
			'team_icon_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$this->add_control(
			'team_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-team-social a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_icon_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#222',
					],
				],
				'selector' => '{{WRAPPER}} .sina-team-social a',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'team_icon_border',
				'selector' => '{{WRAPPER}} .sina-team-social a',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'team_icon_shadow',
				'selector' => '{{WRAPPER}} .sina-team-social a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'team_icon_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$this->add_control(
			'team_icon_hover_color',
			[
				'label' => esc_html__( 'Icon Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-team-social a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_icon_hover_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fafafa',
					],
				],
				'selector' => '{{WRAPPER}} .sina-team-social a:hover',
			]
		);
		$this->add_control(
			'team_icon_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-team-social a:hover' => 'border-color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'team_icon_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-team-social a:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'unit' => '%',
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50',
					'isLinked' => true,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-team-social a, {{WRAPPER}} .sina-team-social a:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-social li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-team-social li a', 'icon_bg_layer');

		$this->end_controls_section();
		// End Icon Style
		// =====================


		// Start Nav & Dots Style
		// ========================
		$this->start_controls_section(
			'nav_dots_style',
			[
				'label' => esc_html__( 'Nav & Dots', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'nav',
							'operator' => '!=',
							'value' => ''
						],
						[
							'name' => 'dots',
							'operator' => '!=',
							'value' => ''
						]
					]
				],
			]
		);
		Sina_Common_Data::nav_dots_style( $this, '.sina-pro-team-carousel' );

		$this->end_controls_section();
		// End Nav & Dots Style
		// ======================


		// Start Center Style
		// =====================
		$this->start_controls_section(
			'center_item_style',
			[
				'label' => esc_html__( 'Center Item', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'center!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'center_scale',
			[
				'label' => esc_html__( 'Scale', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1',
				],
				'selectors' => [
					'{{WRAPPER}} .active.center.owl-item' => 'transform: scale({{SIZE}}); z-index: 2;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'center_item_border',
				'selector' => '{{WRAPPER}} .active.center  .sina-team, {{WRAPPER}} .active.center  .sina-bp',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'center_item_shadow',
				'selector' => '{{WRAPPER}} .active.center  .sina-team, {{WRAPPER}} .active.center  .sina-bp',
			]
		);

		$this->end_controls_section();
		// End Center Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$box_class = 'clearfix '. $data['box_effects'];
		$content_class = 'sina-team-content';
		$morphing_anim_image = ('yes' == $data['is_morphing_anim_icon'] && $data['morphing_pattern']) ? $data['morphing_pattern'] : '';

		if ( 'thumb' == $data['layout'] ) {
			$box_class = $data['effects'];
			$content_class = 'sina-team-overlay sina-overlay';
		}
		?>
			<div class="sina-pro-team-carousel owl-carousel"
			data-item-lg="<?php echo esc_attr( $data['show_item'] ); ?>"
			data-item-md="<?php echo esc_attr( $data['show_item_tablet'] ); ?>"
			data-item-sm="<?php echo esc_attr( $data['show_item_mobile'] ); ?>"
			data-autoplay="<?php echo esc_attr( $data['autoplay'] ); ?>"
			data-pause="<?php echo esc_attr( $data['pause'] ); ?>"
			data-center="<?php echo esc_attr( $data['center'] ); ?>"
			data-slide-anim="<?php echo esc_attr( $data['slide_anim'] ); ?>"
			data-slide-anim-out="<?php echo esc_attr( $data['slide_anim_out'] ); ?>"
			data-nav="<?php echo esc_attr( $data['nav'] ); ?>"
			data-dots="<?php echo esc_attr( $data['dots'] ); ?>"
			data-mouse-drag="<?php echo esc_attr( $data['mouse_drag'] ); ?>"
			data-touch-drag="<?php echo esc_attr( $data['touch_drag'] ); ?>"
			data-loop="<?php echo esc_attr( $data['loop'] ); ?>"
			data-speed="<?php echo esc_attr( $data['speed'] ); ?>"
			data-delay="<?php echo esc_attr( $data['delay'] ); ?>">
			<?php foreach ($data['team_members'] as $member): ?>
				<div class="sina-team <?php echo esc_attr( $box_class ); ?>">
					<?php if ( $member['image']['url']): ?>
						<?php if ( 'list' == $data['layout'] ): ?>
							<div class="sina-team-image sina-bg-cover <?php echo esc_attr( $morphing_anim_image ); ?>" style="background-image: url(<?php echo esc_url( $member['image']['url'] ); ?>);"></div>
						<?php else: ?>
							<img class="<?php echo esc_attr( $morphing_anim_image ); ?>" src="<?php echo esc_url( $member['image']['url'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>">
						<?php endif; ?>
					<?php endif; ?>

					<div class="<?php echo esc_attr( $content_class ); ?>">
						<?php if ( $member['name'] ): ?>
							<h5 class="sina-team-name">
								<?php printf( '%s', $member['name'] ); ?>
							</h5>
						<?php endif; ?>

						<?php if ( $member['position'] ): ?>
							<h6 class="sina-team-position">
								<?php printf( '%s', $member['position'] ); ?>
							</h6>
						<?php endif; ?>

						<?php if ( $member['desc'] ): ?>
							<div class="sina-team-desc">
								<?php printf( '%s', $member['desc'] ); ?>
							</div>
						<?php endif; ?>

						<ul class="sina-team-social">
						<?php
							if ( $member['facebook'] ) {
								printf('<li><a href="%1$s" class="%2$s"><i class="fab fa fa-facebook"></i></a></li>', esc_url( $member['facebook'] ), esc_attr( $data['icon_bg_layer_effects'] ));
							}
							if ( $member['twitter'] ) {
								printf('<li><a href="%1$s" class="%2$s"><i class="fab fa fa-twitter"></i></a></li>', esc_url( $member['twitter'] ), esc_attr( $data['icon_bg_layer_effects'] ));
							}
							if ( $member['linkedin'] ) {
								printf('<li><a href="%1$s" class="%2$s"><i class="fab fa fa-linkedin fa-linkedin-in"></i></a></li>', esc_url( $member['linkedin'] ), esc_attr( $data['icon_bg_layer_effects'] ));
							}
							if ( $member['instagram'] ) {
								printf('<li><a href="%1$s" class="%2$s"><i class="fab fa fa-instagram"></i></a></li>', esc_url( $member['instagram'] ), esc_attr( $data['icon_bg_layer_effects'] ));
							}
							if ( $member['youtube'] ) {
								printf('<li><a href="%1$s" class="%2$s"><i class="fab fa fa-youtube"></i></a></li>', esc_url( $member['youtube'] ), esc_attr( $data['icon_bg_layer_effects'] ));
							}
							if ( $member['pinterest'] ) {
								printf('<li><a href="%1$s" class="%2$s"><i class="fab fa fa-pinterest-p"></i></a></li>', esc_url( $member['pinterest'] ), esc_attr( $data['icon_bg_layer_effects'] ));
							}
							if ( $member['dribbble'] ) {
								printf('<li><a href="%1$s" class="%2$s"><i class="fab fa fa-dribbble"></i></a></li>', esc_url( $member['dribbble'] ), esc_attr( $data['icon_bg_layer_effects'] ));
							}
							if ( $member['behance'] ) {
								printf('<li><a href="%1$s" class="%2$s"><i class="fab fa fa-behance"></i></a></li>', esc_url( $member['behance'] ), esc_attr( $data['icon_bg_layer_effects'] ));
							}
							if ( $member['tumblr'] ) {
								printf('<li><a href="%1$s" class="%2$s"><i class="fab fa fa-tumblr"></i></a></li>', esc_url( $member['tumblr'] ), esc_attr( $data['icon_bg_layer_effects'] ));
							}
							if ( $member['reddit'] ) {
								printf('<li><a href="%1$s" class="%2$s"><i class="fab fa fa-reddit-alien"></i></a></li>', esc_url( $member['reddit'] ), esc_attr( $data['icon_bg_layer_effects'] ));
							}
						?>
						</ul>
					</div>
				</div>
			<?php endforeach; ?>
			</div><!-- .sina-pro-team-carousel -->
		<?php
	}


	protected function _content_template() {

	}
}
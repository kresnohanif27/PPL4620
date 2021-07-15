<?php

/**
 * Image Accordion Widget.
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
use \Sina_Extension\Sina_Ext_Gradient_Text;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Image_Accordion_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_ext_pro_image_accordion';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Image Accordion', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-featured-image';
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
		return [ 'sina image accordion', 'sina accordion', 'sina image hover' ];
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
		// Start Accordion Style
		// ======================
		$this->start_controls_section(
			'accordion_content',
			[
				'label' => esc_html__( 'Accordion', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'accordion_orientation',
			[
				'label' => esc_html__( 'Orientation', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Horizontal', 'sina-ext-pro' ),
					'sina-pro-accord-vertical' => esc_html__( 'Vertical', 'sina-ext-pro' ),
				],
				'default' => '',
			]
		);
		$this->add_control(
			'accordion_action',
			[
				'label' => esc_html__( 'Action', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'hover' => esc_html__( 'On Hover', 'sina-ext-pro' ),
					'' => esc_html__( 'On Click', 'sina-ext-pro' ),
				],
				'default' => 'hover',
			]
		);
		$this->add_control(
			'active_item',
			[
				'label' => esc_html__( 'Active', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'description' => esc_html__( 'Add item number to make that item active by default.', 'sina-ext-pro' ),
				'condition' => [
					'accordion_action!' => 'hover',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
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
		$repeater->add_control(
			'desc',
			[
				'label' => esc_html__('Description', 'sina-ext-pro'),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'description' => esc_html__( 'You can use HTML.', 'sina-ext-pro' ),
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
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
					'url' => SINA_EXT_PRO_URL .'assets/img/accord1.jpg',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'accordion_items',
			[
				'label' => esc_html__( 'Add item', 'sina-ext-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => 'Short Description',
						'desc'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
						'image' => [
							'url' => SINA_EXT_PRO_URL .'assets/img/accord1.jpg',
						],
					],
					[
						'title' => 'Short Description',
						'desc'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.',
						'image' => [
							'url' => SINA_EXT_PRO_URL .'assets/img/accord2.jpg',
						],
					],
					[
						'title' => 'Short Description',
						'desc'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
						'image' => [
							'url' => SINA_EXT_PRO_URL .'assets/img/accord3.jpg',
						],
					],
					[
						'title' => 'Short Description',
						'desc'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.',
						'image' => [
							'url' => SINA_EXT_PRO_URL .'assets/img/accord4.jpg',
						],
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
		// End Accordion Content
		// ======================


		// Start Box Style
		// =================
		$this->start_controls_section(
			'accordion_style',
			[
				'label' => esc_html__( 'Box', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'wrap_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 100,
					],
				],
				'default' => [
					'size' => '400',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-image-accordion' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-accord-item',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .sina-pro-accord-item',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-accord-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'top' => '20',
					'right' => '30',
					'bottom' => '20',
					'left' => '30',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-accord-item .sina-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .sina-pro-accord-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'default' => 'rgba(0,0,0,0.3)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-accord-item:hover .sina-overlay, {{WRAPPER}} .sina-pro-accord-item.active .sina-overlay',
			]
		);

		$this->end_controls_section();
		// End Box Style
		// ===============


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
				'selector' => '{{WRAPPER}} .sina-pro-accord-title',
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
				'selector' => '{{WRAPPER}} .sina-pro-accord-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-accord-title',
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
					'{{WRAPPER}} .sina-pro-accord-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .sina-pro-accord-desc' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .sina-pro-accord-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-accord-desc',
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
					'justify' => [
						'title' => esc_html__( 'Justify', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'center',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-accord-item' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Content Style
		// ==================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$i = 0;
		?>
		<div class="sina-pro-image-accordion <?php echo esc_attr( $data['accordion_orientation'] ); ?>">
			<?php foreach ($data['accordion_items'] as $item): ?>
				<?php
					$i++;
					$active = ($data['active_item'] == $i) ? 'active' : '';
				?>
				<div class="sina-pro-accord-item <?php echo esc_attr( $data['accordion_action'].' '.$active ); ?>" style="background-image: url(<?php echo esc_url($item['image']['url']); ?>);">
					<div class="sina-overlay">
						<?php
							if ( $item['title'] ):
								printf('<h3 class="sina-pro-accord-title">%s</h3>', $item['title']);
							endif;

							if ( $item['desc'] ):
								printf('<div class="sina-pro-accord-desc">%s</div>', $item['desc']);
							endif;
						?>
					</div>
				</div>
			<?php endforeach; ?>
		</div><!-- .sina-pro-image-accordion -->
		<?php
	}


	protected function _content_template() {
		?>
		<div class="sina-pro-image-accordion {{{settings.accordion_orientation}}}">
			<#
				var i = 0;
				_.each( settings.accordion_items, function( item, index ) {
					i++;
					var active = (settings.active_item == i) ? 'active' : '';
				#>
				<div class="sina-pro-accord-item {{{settings.accordion_action + ' ' + active}}}"
				style="background-image: url({{{item.image.url}}});">
					<div class="sina-overlay">
						<# if ( item.title ) { #>
							<h3 class="sina-pro-accord-title">{{{item.title}}}</h3>
						<# } #>

						<# if ( item.desc ) { #>
							<div class="sina-pro-accord-desc">{{{item.desc}}}</div>
						<# } #>
					</div>
				</div>
			<# }); #>
		</div><!-- .sina-pro-image-accordion -->
		<?php
	}
}
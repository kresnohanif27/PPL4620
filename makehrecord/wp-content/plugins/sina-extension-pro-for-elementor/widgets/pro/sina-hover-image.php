<?php

/**
 * Hover Image Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Control_Media;
use \Sina_Extension\Sina_Ext_Gradient_Text;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Hover_Image_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_ext_hover_image';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Hover Image', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-info-box';
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
		return [ 'sina promo', 'sina image', 'sina hover image', 'sina image hover' ];
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
			'sina-hover-effects',
			'sina-hover-effects-rtl',
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
		// Start Image
		// =============
		$this->start_controls_section(
			'image_content',
			[
				'label' => esc_html__( 'Image', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'effects',
			[
				'label'       => esc_html__( 'Effects', 'sina-ext-pro' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'lily' => esc_html__( 'Lily', 'sina-ext-pro' ),
					'sadie' => esc_html__( 'Sadie', 'sina-ext-pro' ),
					'roxy' => esc_html__( 'Roxy', 'sina-ext-pro' ),
					'bubba' => esc_html__( 'Budda', 'sina-ext-pro' ),
					'romeo' => esc_html__( 'Romeo', 'sina-ext-pro' ),
					'layla' => esc_html__( 'Layla', 'sina-ext-pro' ),
					'honey' => esc_html__( 'Honey', 'sina-ext-pro' ),
					'oscar' => esc_html__( 'Oscar', 'sina-ext-pro' ),
					'marley' => esc_html__( 'Marley', 'sina-ext-pro' ),
					'ruby' => esc_html__( 'Ruby', 'sina-ext-pro' ),
					'milo' => esc_html__( 'Milo', 'sina-ext-pro' ),
					'dexter' => esc_html__( 'Dexter', 'sina-ext-pro' ),
					'sarah' => esc_html__( 'Sarah', 'sina-ext-pro' ),
					'chico' => esc_html__( 'Chico', 'sina-ext-pro' ),
				],
				'default'     => 'lily',
			]
		);
		$this->add_control(
			'is_linkable_box',
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
					'is_linkable_box' => 'yes',
				],
				'dynamic' => [
					'active' => true,
				],
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
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Title', 'sina-ext-pro' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext-pro' ),
				'default' => 'Sina Extension Pro',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'title_span',
			[
				'label' => esc_html__( 'Title Span', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Title Span', 'sina-ext-pro' ),
				'description' => esc_html__( 'You can use SPAN for multi-color title.', 'sina-ext-pro' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'desc',
			[
				'label' => esc_html__( 'Description', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter Description', 'sina-ext-pro' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext-pro' ),
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();
		// End Image
		// ===========


		// Start Image Styles
		// ====================
		$this->start_controls_section(
			'image_style',
			[
				'label' => esc_html__( 'Image', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'image_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-hover-image-effect, {{WRAPPER}} .sina-effect-honey .sina-hover-image-inner::before',
			]
		);

		$this->start_controls_tabs( 'image_tabs' );

		$this->start_controls_tab(
			'image_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$this->add_responsive_control(
			'image_normal_opacity',
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
					'size' => '0.6',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-hover-image-effect img' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'image_normal_filters',
				'selector' => '{{WRAPPER}} .sina-hover-image-effect img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'image_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$this->add_responsive_control(
			'image_hover_opacity',
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
					'size' => '0.8',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-hover-image-effect:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'image_hover_filters',
				'selector' => '{{WRAPPER}} .sina-hover-image-effect:hover img',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// End Image Styles
		// =================


		// Start Title Styles
		// ===================
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typo',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'   => [
						'default' => [
							'size' => '40',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '52',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-hover-image-title',
			]
		);

		$this->start_controls_tabs( 'title_tabs' );

		$this->start_controls_tab(
			'title_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'title_color',
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'selector' => '{{WRAPPER}} .sina-hover-image-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-hover-image-title',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'title_hover_color',
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '',
					],
				],
				'selector' => '{{WRAPPER}} .sina-hover-image-effect:hover .sina-hover-image-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-hover-image-effect:hover .sina-hover-image-title',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// End Title Styles
		// =================


		// Start Title Span Styles
		// ========================
		$this->start_controls_section(
			'title_span_style',
			[
				'label' => esc_html__( 'Title Span', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'title_span!' => '',
				],
			]
		);

		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'title_span_color',
				'selector' => '{{WRAPPER}} .sina-hover-image-title > span',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_span_typography',
				'selector' => '{{WRAPPER}} .sina-hover-image-title > span',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_span_shadow',
				'selector' => '{{WRAPPER}} .sina-hover-image-title > span',
			]
		);

		$this->end_controls_section();
		// End Title Span Styles
		// =======================


		// Start Description Styles
		// =========================
		$this->start_controls_section(
			'desc_style',
			[
				'label' => esc_html__( 'Description', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'desc!' => '',
				],
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-hover-image-desc' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sina-effect-honey h3 small' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typo',
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
							'size' => '20',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-hover-image-desc, {{WRAPPER}} .sina-effect-honey h3 small',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-hover-image-desc, {{WRAPPER}} .sina-effect-honey h3 small',
			]
		);

		$this->start_controls_tabs( 'desc_tabs' );

		$this->start_controls_tab(
			'desc_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$this->add_responsive_control(
			'desc_normal_opacity',
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
					'size' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-hover-image-desc' => 'opacity: {{SIZE}};',
					'{{WRAPPER}} .sina-effect-honey h3 small' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'desc_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$this->add_responsive_control(
			'desc_hover_opacity',
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
					'{{WRAPPER}} .sina-hover-image-effect:hover .sina-hover-image-desc' => 'opacity: {{SIZE}};',
					'{{WRAPPER}} .sina-hover-image-effect.sina-effect-honey:hover h3 small' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// End Description Styles
		// =======================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$title_span = $data['title_span'] ? '<span>'. $data['title_span'] .'</span>' : '';
		$small = ('honey' == $data['effects']) ? '<small>'. $data['desc'] .'</small>' : '';
		$img_alt = $data['title'] ? $data['title'] : Control_Media::get_image_alt( $data['image'] );
		?>
		<div class="sina-pro-hover-image">
			<div class="sina-hover-image">
				<div class="sina-hover-image-effect sina-effect-<?php echo esc_attr( $data['effects'] );?>">
					<img src="<?php echo esc_attr( $data['image']['url'] ); ?>"
						 alt="<?php echo esc_attr( $img_alt ); ?>">

					<?php if ( 'yes' == $data['is_linkable_box'] && $data['link']['url'] ): ?>
						<a class="sina-hover-image-linkable"
						href="<?php echo esc_url( $data['link']['url'] ); ?>"
						<?php if ( 'on' == $data['link']['is_external'] ): ?>
							target="_blank" 
						<?php endif; ?>
						<?php if ( 'on' == $data['link']['nofollow'] ): ?>
							rel="nofollow" 
						<?php endif; ?>></a>
					<?php endif; ?>

					<div class="sina-hover-image-inner">
						<div class="sina-hover-image-content">
							<?php
								printf('<h3 class="sina-hover-image-title">%1$s%2$s%3$s</h3>', $data['title'], $title_span, $small);
								if ( !in_array($data['effects'], ['honey']) ):
									printf('<div class="sina-hover-image-desc">%s</div>', $data['desc']);
								endif;
							?>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .sina-pro-hover-image -->
		<?php
	}


	protected function _content_template() {
		?>
		<#
			var titleSpan = settings.title_span ? '<span>' + settings.title_span + '</span>' : '';
			var small = ('honey' == settings.effects) ? '<small>' + settings.desc + '</small>' : '';
		#>
		<div class="sina-pro-hover-image">
			<div class="sina-hover-image">
				<div class="sina-hover-image-effect sina-effect-{{{settings.effects}}}">
					<img src="{{{settings.image.url}}}"
						alt="{{{settings.title}}}">

					<# if ( 'yes' == settings.is_linkable_box && settings.link.url ) { #>
						<a class="sina-hover-image-linkable"
						href="{{{settings.link.url}}}"
						<# if ( 'on' == settings.link.is_external ) { #>
							target="_blank" 
						<# } if ( 'on' == settings.link.nofollow ) { #>
							rel="nofollow" 
						<# } #>>
						</a>
					<# } #>

					<div class="sina-hover-image-inner">
						<div class="sina-hover-image-content">
							<h3 class="sina-hover-image-title">{{{settings.title + titleSpan + small}}}</h3>
							<# if ( !settings.effects.includes('honey') ) { #>
								<div class="sina-hover-image-desc">{{{settings.desc}}}</div>
							<# } #>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .sina-pro-hover-image -->
		<?php
	}
}
<?php

/**
 * Video Gallery Widget.
 *
 * @since 1.6.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
use \Elementor\Plugin;
use \Sina_Extension\Sina_Ext_Gradient_Text;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Video_Gallery_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 1.6.0
	 */
	public function get_name() {
		return 'sina_ext_pro_video_gallery';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.6.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Video Gallery', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.6.0
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.6.0
	 */
	public function get_categories() {
		return [ 'sina-ext-pro-basic' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.6.0
	 */
	public function get_keywords() {
		return [ 'sina video gallery', 'sina video popup' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.6.0
	 */
	public function get_style_depends() {
		return [
			'venobox',
			'sina-ext-pro-widgets',
		];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 1.6.0
	 */
	public function get_script_depends() {
		return [
			'venobox',
			'imagesLoaded',
			'isotope',
			'sina-ext-pro-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.6.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Video Gallery Content
		// ============================
		$this->start_controls_section(
			'gallery_content',
			[
				'label' => esc_html__( 'Gallery Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => esc_html__( 'Number of Column', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-video-gallery-item-1' => esc_html__( '1', 'sina-ext-pro' ),
					'sina-video-gallery-item-2' => esc_html__( '2', 'sina-ext-pro' ),
					'sina-video-gallery-item-3' => esc_html__( '3', 'sina-ext-pro' ),
					'sina-video-gallery-item-4' => esc_html__( '4', 'sina-ext-pro' ),
					'sina-video-gallery-item-5' => esc_html__( '5', 'sina-ext-pro' ),
					'sina-video-gallery-item-6' => esc_html__( '6', 'sina-ext-pro' ),
				],
				'default' => 'sina-video-gallery-item-3',
			]
		);
		$this->add_control(
			'reset_text',
			[
				'label' => esc_html__( 'Reset Text', 'sina-ext-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Reset Text', 'sina-ext-pro' ),
				'default' => 'all',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title',  'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Title',  'sina-ext-pro' ),
				'description' => esc_html__( 'You can use HTML.',  'sina-ext-pro' ),
			]
		);
		$repeater->add_control(
			'category',
			[
				'label' => esc_html__( 'Category', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'Multiple category must be comma separated!', 'sina-ext-pro' ),
				'default' => 'Web Design',
			]
		);
		$repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon',  'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-play',
			]
		);
		$repeater->add_control(
			'video_link',
			[
				'label' => esc_html__( 'Video Link',  'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter video link',  'sina-ext-pro' ),
			]
		);
		$repeater->add_control(
			'poster_image',
			[
				'label' => esc_html__( 'Poster Image', 'sina-ext-pro' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
			]
		);

		$this->add_control(
			'gallery_items',
			[
				'label' => esc_html__( 'Add Item',  'sina-ext-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'icon' => 'fa fa-play',
						'video_link' => 'https://www.youtube.com/watch?v=4_FEAlX5bz8'
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
		// End Gallery Content
		// ====================


		// Start Menu Style
		// =====================
		$this->start_controls_section(
			'menu_style',
			[
				'label' => esc_html__( 'Menu Buttons', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-video-gallery-btn' );
		$this->add_responsive_control(
			'menu_btn_width',
			[
				'label' => esc_html__( 'Min Width', 'sina-ext-pro' ),
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
					'{{WRAPPER}} .sina-video-gallery-btn' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_btn_gap',
			[
				'label' => esc_html__( 'Gap From Items', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' =>[
					'size' => '40',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-video-gallery-btns' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_btn_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-video-gallery-btn, {{WRAPPER}} .sina-portfolio-btn:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_btn_padding',
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
					'{{WRAPPER}} .sina-video-gallery-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_btn_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
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
					'{{WRAPPER}} .sina-video-gallery-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_alignment',
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
					'{{WRAPPER}} .sina-video-gallery-btns' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Menu Style
		// ================


		// Start Items Style
		// ===================
		$this->start_controls_section(
			'item_style',
			[
				'label' => esc_html__( 'Items', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'NOTICE: If you change the "Dimension" then the page need to "Refresh" for seeing the actual result.', 'sina-ext-pro' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);
		$this->add_responsive_control(
			'items_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 800,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 300,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-video-gallery-item-inner' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'items_shadow',
				'selector' => '{{WRAPPER}} .sina-video-gallery-item-inner',
			]
		);
		$this->add_responsive_control(
			'items_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-video-gallery-item-inner, {{WRAPPER}} .sina-video-gallery-item-inner .sina-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'items_padding',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-video-gallery-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'top' => '10',
					'right' => '15',
					'bottom' => '10',
					'left' => '15',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-video-gallery-item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'overlay',
			[
				'label' => esc_html__( 'Overlay Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
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
						'default' => 'rgba(0,0,0,0.3)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-video-gallery-item-inner .sina-overlay',
			]
		);

		$this->end_controls_section();
		// End Items Style
		// =================


		// Start Content Style
		// ====================
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Title', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
				],
				'selector' => '{{WRAPPER}} .sina-pro-video-title',
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
				'selector' => '{{WRAPPER}} .sina-pro-video-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin Top', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '15',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-video-title' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Content Style
		// ===================


		// Start Icon Style
		// ==================
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Button', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'icon_tabs' );

		$this->start_controls_tab(
			'icon_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext-pro' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'sina-ext-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-video-play',
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-video-play' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-video-play',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .sina-pro-video-play',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext-pro' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'hover_background',
				'label' => esc_html__( 'Background', 'sina-ext-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-pro-video-play:hover',
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label' => esc_html__( 'Icon Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-video-play:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-pro-video-play:hover',
			]
		);
		$this->add_control(
			'icon_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-pro-video-play:hover' => 'border-color: {{VALUE}}'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'font_size',
			[
				'label' => esc_html__( 'Font Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '24',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-pro-video-play' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'em' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '70',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-video-play' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'em' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '70',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-video-play' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'font_line_height',
			[
				'label' => esc_html__( 'Line Height', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 500,
					],
					'em' => [
						'max' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '70',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pro-video-play' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
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
				'selectors' => [
					'{{WRAPPER}} .sina-pro-video-play' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Icon Style
		// ===============
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-pro-video-gallery <?php echo esc_attr( 'sina-pro-video-gallery-'.$this->get_id() ); ?>">
			<div class="sina-video-gallery-btns">
				<button class="sina-video-gallery-btn sina-button is-checked" data-filter="*"><?php printf('%s', $data['reset_text']); ?></button>
				<?php
					$categories = sina_get_portfolio_cat( $data['gallery_items'] );
					foreach ( $categories as $cat ) :
						?>
						<button class="sina-button sina-video-gallery-btn" data-filter=".<?php echo esc_attr( $cat ); ?>">
							<?php printf( '%s', str_replace( '_', ' ', trim( $cat, '_') ) ); ?>
						</button>
				<?php endforeach; ?>
			</div>

			<div class="sina-video-gallery-grid">
				<?php foreach ($data['gallery_items'] as $item):
					$category = strtolower( str_replace( ' ', '_', $item['category'] ) );
					$category =  str_replace( ',', ' ', $category );
					?>
					<div class="sina-video-gallery-item <?php echo esc_attr( $category.' '.$data['columns'] ); ?>">
						<div class="sina-video-gallery-item-inner sina-bg-cover"
						<?php if ($item['poster_image']['url']): ?>
							style="background-image: url(<?php echo esc_url( $item['poster_image']['url'] ); ?>);"
						<?php endif; ?>>
							<div class="sina-overlay">
								<div class="sina-video-gallery-item-content">
									<?php if ( $item['icon'] ): ?>
										<a class="sina-pro-video-play" href="<?php echo esc_url( $item['video_link'] ); ?>" data-vbtype="video" data-gall="<?php echo esc_attr( 'sina-pro-video-gallery-'.$this->get_id() ); ?>">
											<i class="<?php echo esc_attr( $item['icon'] ); ?>"></i>
										</a>
									<?php endif ?>

									<?php if ( $item['title'] ): ?>
										<?php printf( '<h3 class="sina-pro-video-title">%1$s</h3>', $item['title'] ); ?>
									<?php endif ?>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div><!-- .sina-pro-video-gallery -->
		<?php
		if ( Plugin::instance()->editor->is_edit_mode() ) {
			$this->render_editor_script();
		}
	}


	protected function render_editor_script() {
		?>
		<script type="text/javascript">
		jQuery( document ).ready(function( $ ) {
			var sinaVGClass = '.sina-pro-video-gallery-'+'<?php echo $this->get_id(); ?>',
				$this = $(sinaVGClass),
				$isoGrid = $this.children('.sina-video-gallery-grid'),
				$btns = $this.children('.sina-video-gallery-btns');

			$this.imagesLoaded( function() {
				var $grid = $isoGrid.isotope({
					itemSelector: '.sina-video-gallery-item',
					layoutMode: 'fitRows'
				});

				$btns.on('click', 'button', function () {
					var filterValue = $(this).attr('data-filter');
					$grid.isotope({filter: filterValue});
				});

				$btns.each(function (i, btns) {
					var btns = $(btns);

					btns.on('click', '.sina-video-gallery-btn', function () {
						btns.find('.is-checked').removeClass('is-checked');
						$(this).addClass('is-checked');
					});
				});
			});

			$this.find('.sina-pro-video-play').venobox({
				titlePosition: 'bottom',
				bgcolor: '#000000',
			});
		});
		</script>
		<?php
	}


	protected function _content_template() {

	}
}
<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Repeater;

/**
 * Sina_Ext_Pro_Parallax Class
 *
 * @since 1.2.0
 */
Class Sina_Ext_Pro_Parallax{
	/**
	 * Instance
	 *
	 * @since 1.2.2
	 * @var Sina_Ext_Pro_Parallax The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.2
	 * @return Sina_Ext_Pro_Parallax An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_action( 'elementor/element/section/section_effects/after_section_end', [$this, 'register_controls'] );
		add_action( 'elementor/frontend/section/after_render', [$this, 'render_content'] );
		add_action( 'elementor/section/print_template', [$this, 'print_template'], 10, 2 );
	}

	public function register_controls($elems) {

		$elems->start_controls_section(
			'sina_parallax',
			[
				'label' => esc_html__('Sina Parallax', 'sina-ext-pro'),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$elems->add_control(
			'sina_parallax_note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'NOTICE: When you turn enabled or disabled this feature don\'t forget to click the "yes" button to see the actual result!', 'sina-ext-pro' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);
		$elems->add_control(
			'sina_is_parallax',
			[
				'label' => esc_html__( 'Parallax Enable', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'prefix_class'  => 'sina-parallax-',
			]
		);
		$elems->add_control(
			'sina_plx_type',
			[
				'label' => esc_html__( 'Parallax Type', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'onscroll' => esc_html__( 'On Scroll', 'sina-ext-pro' ),
					'mousemove' => esc_html__( 'Mouse Move', 'sina-ext-pro' ),
				],
				'default' => 'onscroll',
				'condition' => [
					'sina_is_parallax' => 'yes',
				],
			]
		);
		$elems->add_control(
			'sina_plx_wrap_overflow',
			[
				'label' => esc_html__( 'Container Overflow', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'description' => esc_html__('For large image(s) you can use "hidden" value.', 'sina-ext-pro'),
				'options' => [
					'hidden' => esc_html__( 'Hidden', 'sina-ext-pro' ),
					'inherit' => esc_html__( 'Default', 'sina-ext-pro' ),
				],
				'default' => 'inherit',
				'condition' => [
					'sina_is_parallax' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} > .sina-parallax-wrapper, {{WRAPPER}} > .sina-parallax-wrap' => 'overflow: {{VALUE}};',
				],
			]
		);
		$elems->add_control(
			'sina_plx_wrap_zindex',
			[
				'label' => esc_html__( 'Container Z-Index', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 1,
				'condition' => [
					'sina_is_parallax' => 'yes',
					'sina_plx_type' => 'mousemove',
				],
				'selectors' => [
					'{{WRAPPER}} > .sina-parallax-wrap' => 'z-index: {{VALUE}};',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'sina_plx_image',
			[
				'label' => esc_html__( 'Choose Image', 'sina-ext-pro' ),
				'type' => Controls_Manager::MEDIA,
			]
		);

		$repeater->start_controls_tabs( 'sina_parallax_tabs' );

		$repeater->start_controls_tab(
			'sina_parallax_effects',
			[
				'label' => esc_html__( 'Effects', 'sina-ext-pro' ),
			]
		);

		$repeater->add_control(
			'sina_plx_move',
			[
				'label' => esc_html__( 'Move', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-plx-moveTop' => esc_html__( 'Bottom to Top', 'sina-ext-pro' ),
					'sina-plx-moveRight' => esc_html__( 'Left to Right', 'sina-ext-pro' ),
					'sina-plx-moveLeft' => esc_html__( 'Right to Left', 'sina-ext-pro' ),
					'sina-plx-moveBottom' => esc_html__( 'Top to Bottom', 'sina-ext-pro' ),
					'' => esc_html__( 'None', 'sina-ext-pro' ),
				],
				'default' => 'sina-plx-moveRight',
			]
		);
		$repeater->add_control(
			'sina_plx_move_size',
			[
				'label' => esc_html__( 'Move Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '300',
				],
				'condition' => [
					'sina_plx_move!' => '',
				],
			]
		);
		$repeater->add_control(
			'sina_plx_zoom',
			[
				'label' => esc_html__( 'Zoom', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-plx-zoomIn' => esc_html__( 'Zoom In', 'sina-ext-pro' ),
					'sina-plx-zoomOut' => esc_html__( 'Zoom Out', 'sina-ext-pro' ),
					'' => esc_html__( 'None', 'sina-ext-pro' ),
				],
				'default' => '',
			]
		);
		$repeater->add_control(
			'sina_plx_zoom_size',
			[
				'label' => esc_html__( 'Zoom Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '3',
				],
				'condition' => [
					'sina_plx_zoom!' => '',
				],
			]
		);
		$repeater->add_control(
			'sina_plx_rotate',
			[
				'label' => esc_html__( 'Rotate', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-plx-rotateX' => esc_html__( 'Rotate X Axis', 'sina-ext-pro' ),
					'sina-plx-rotateY' => esc_html__( 'Rotate Y Axis', 'sina-ext-pro' ),
					'sina-plx-rotateZ' => esc_html__( 'Rotate Z Axis', 'sina-ext-pro' ),
					'' => esc_html__( 'None', 'sina-ext-pro' ),
				],
				'default' => '',
			]
		);
		$repeater->add_control(
			'sina_plx_rotate_size',
			[
				'label' => esc_html__( 'Rotate Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '360',
				],
				'condition' => [
					'sina_plx_rotate!' => '',
				],
			]
		);
		$repeater->add_control(
			'sina_plx_fade',
			[
				'label' => esc_html__( 'Fade', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-plx-fadeIn' => esc_html__( 'Fade In', 'sina-ext-pro' ),
					'sina-plx-fadeOut' => esc_html__( 'Fade Out', 'sina-ext-pro' ),
					'' => esc_html__( 'None', 'sina-ext-pro' ),
				],
				'default' => '',
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'sina_parallax_styles',
			[
				'label' => esc_html__( 'Styles', 'sina-ext-pro' ),
			]
		);

		$repeater->add_control(
			'sina_plx_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Auto', 'sina-ext-pro' ),
					'custom' => esc_html__( 'Custom', 'sina-ext-pro' ),
				],
				'default' => '',
			]
		);
		$repeater->add_responsive_control(
			'sina_plx_width_size',
			[
				'label' => esc_html__( 'Width Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'em', 'px' ],
				'range' => [
					'%' => [
						'max' => 500,
					],
					'em' => [
						'max' => 1000,
					],
					'px' => [
						'max' => 5000,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => '100',
				],
				'condition' => [
					'sina_plx_width' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} > .sina-parallax-wrapper .sina-parallax{{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'sina_plx_pos_left',
			[
				'label' => esc_html__( 'Left', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'em', 'px' ],
				'range' => [
					'%' => [
						'max' => 500,
						'min' => -500,
					],
					'em' => [
						'max' => 1000,
						'min' => -1000,
					],
					'px' => [
						'max' => 5000,
						'min' => -5000,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => '10',
				],
				'selectors' => [
					'{{WRAPPER}} > .sina-parallax-wrapper .sina-parallax{{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'sina_plx_pos_top',
			[
				'label' => esc_html__( 'Top', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'em', 'px' ],
				'range' => [
					'%' => [
						'max' => 200,
						'min' => -100,
					],
					'em' => [
						'max' => 200,
						'min' => -200,
					],
					'px' => [
						'max' => 2000,
						'min' => -2000,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => '25',
				],
				'selectors' => [
					'{{WRAPPER}} > .sina-parallax-wrapper .sina-parallax{{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_control(
			'sina_plx_zindex',
			[
				'label' => esc_html__( 'Z-Index', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'selectors' => [
					'{{WRAPPER}} > .sina-parallax-wrapper .sina-parallax{{CURRENT_ITEM}}' => 'z-index: {{VALUE}};',
				],
			]
		);

		$elems->add_control(
			'sina_plx_images',
			[
				'label' => esc_html__( 'Add item', 'sina-ext-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'prevent_empty' => false,
				'condition' => [
					'sina_is_parallax' => 'yes',
					'sina_plx_type' => 'onscroll',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$repeater2 = new Repeater();

		$repeater2->add_control(
			'sina_plx_image2',
			[
				'label' => esc_html__( 'Choose Image', 'sina-ext-pro' ),
				'type' => Controls_Manager::MEDIA,
			]
		);
		$repeater2->add_control(
			'sina_plx_style2',
			[
				'label' => esc_html__( 'Styles', 'sina-ext-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater2->add_control(
			'sina_plx_width2',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Auto', 'sina-ext-pro' ),
					'custom' => esc_html__( 'Custom', 'sina-ext-pro' ),
				],
				'default' => '',
			]
		);
		$repeater2->add_responsive_control(
			'sina_plx_width_size2',
			[
				'label' => esc_html__( 'Width Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'em', 'px' ],
				'range' => [
					'%' => [
						'max' => 500,
					],
					'em' => [
						'max' => 1000,
					],
					'px' => [
						'max' => 5000,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => '100',
				],
				'condition' => [
					'sina_plx_width2' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} > .sina-parallax-wrap .sina-parallax-item{{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater2->add_responsive_control(
			'sina_plx_pos_left2',
			[
				'label' => esc_html__( 'Left', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'em', 'px' ],
				'range' => [
					'%' => [
						'max' => 500,
						'min' => -500,
					],
					'em' => [
						'max' => 1000,
						'min' => -1000,
					],
					'px' => [
						'max' => 5000,
						'min' => -5000,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => '10',
				],
				'selectors' => [
					'{{WRAPPER}} > .sina-parallax-wrap .sina-parallax-item{{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater2->add_responsive_control(
			'sina_plx_pos_top2',
			[
				'label' => esc_html__( 'Top', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'em', 'px' ],
				'range' => [
					'%' => [
						'max' => 100,
						'min' => -100,
					],
					'em' => [
						'max' => 200,
						'min' => -200,
					],
					'px' => [
						'max' => 2000,
						'min' => -2000,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => '10',
				],
				'selectors' => [
					'{{WRAPPER}} > .sina-parallax-wrap .sina-parallax-item{{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater2->add_control(
			'sina_plx_velocity',
			[
				'label' => esc_html__( 'Velocity', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 500,
					],
				],
				'default' => [
					'size' => '50',
				],
			]
		);
		$repeater2->add_control(
			'sina_plx_zindex2',
			[
				'label' => esc_html__( 'Z-Index', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'selectors' => [
					'{{WRAPPER}} > .sina-parallax-wrap .sina-parallax-item{{CURRENT_ITEM}}' => 'z-index: {{VALUE}};',
				],
			]
		);

		$elems->add_control(
			'sina_plx_images2',
			[
				'label' => esc_html__( 'Add item', 'sina-ext-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater2->get_controls(),
				'prevent_empty' => false,
				'condition' => [
					'sina_is_parallax' => 'yes',
					'sina_plx_type' => 'mousemove',
				],
			]
		);

		$elems->add_control(
			'sina_parallax_apply',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => '<div class="elementor-update-preview" style="background: rgba(0,0,0,0);margin-left: 0;margin-right: 0;"><div class="elementor-update-preview-title">Changes Apply?</div><div class="elementor-update-preview-button-wrapper"><button class="elementor-update-preview-button elementor-button elementor-button-success">Yes</button></div></div>',
			]
		);

		$elems->end_controls_section();
	}

	public function render_content($elems) {
		$data = $elems->get_settings_for_display();

		if ( 'yes' == $data['sina_is_parallax'] ):
			if ( 'onscroll' == $data['sina_plx_type'] ) :
				?>
				<div class="sina-parallax-wrapper sina-parallax-wrap-<?php echo esc_attr( $elems->get_id() ); ?>">
					<?php foreach ($data['sina_plx_images'] as $image) :
						$img_alt = Control_Media::get_image_alt( $image['sina_plx_image'] );
						$classes = $image['_id'].' '.$image['sina_plx_move'].' '.$image['sina_plx_rotate'].' '.$image['sina_plx_zoom'].' '.$image['sina_plx_fade'];
						?>
						<img class="sina-parallax elementor-repeater-item-<?php echo esc_attr($classes); ?>"
						data-move="<?php echo esc_attr($image['sina_plx_move_size']['size']); ?>"
						data-zoom="<?php echo esc_attr($image['sina_plx_zoom_size']['size']); ?>"
						data-rotate="<?php echo esc_attr($image['sina_plx_rotate_size']['size']); ?>"
						src="<?php echo esc_url( $image['sina_plx_image']['url'] ); ?>"
						alt="<?php echo esc_attr( $img_alt ); ?>">
					<?php endforeach; ?>
				</div>
			<?php else: ?>
				<div class="sina-parallax-wrap sina-parallax-wrap-<?php echo esc_attr( $elems->get_id() ); ?>">
					<?php foreach ($data['sina_plx_images2'] as $image) :
						$img_alt = Control_Media::get_image_alt( $image['sina_plx_image2'] );
						?>
						<img class="sina-parallax-item elementor-repeater-item-<?php echo esc_attr($image['_id']); ?>"
						data-velocity="<?php echo esc_attr($image['sina_plx_velocity']['size']); ?>"
						src="<?php echo esc_url( $image['sina_plx_image2']['url'] ); ?>"
						alt="<?php echo esc_attr( $img_alt ); ?>">
					<?php endforeach; ?>
				</div>
			<?php
			endif;
		endif;
	}

	public function print_template( $template, $elems ) {
		$old_template = $template;

		ob_start();
		?>
		<# if ('yes' == settings.sina_is_parallax) {
			if ( 'onscroll' == settings.sina_plx_type ) {
				#>
				<div class="sina-parallax-wrapper sina-parallax-wrap-{{{view.getID()}}}">
					<# _.each(settings.sina_plx_images, function (image, index) {
						var classes = image._id +' '+ image.sina_plx_move +' '+ image.sina_plx_rotate +' '+ image.sina_plx_zoom +' '+ image.sina_plx_fade;
						#>
						<img class="sina-parallax elementor-repeater-item-{{{classes}}}"
						data-move="{{{image.sina_plx_move_size.size}}}"
						data-zoom="{{{image.sina_plx_zoom_size.size}}}"
						data-rotate="{{{image.sina_plx_rotate_size.size}}}"
						src="{{{image.sina_plx_image.url}}}">
					<# }); #>
				</div>
			<# } else { #>
				<div class="sina-parallax-wrap sina-parallax-wrap-{{{view.getID()}}}">
					<# _.each(settings.sina_plx_images2, function (image, index) { #>
						<img class="sina-parallax-item elementor-repeater-item-{{{image._id}}}"
						data-velocity="{{{image.sina_plx_velocity.size}}}"
						src="{{{image.sina_plx_image2.url}}}">
					<# }); #>
				</div>
		<# } } #>
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content . $old_template;
	}

}

Sina_Ext_Pro_Parallax::instance();
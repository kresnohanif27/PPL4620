<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Repeater;

/**
 * Sina_Ext_Pro_Clips_Animation Class
 *
 * @since 1.2.0
 */
Class Sina_Ext_Pro_Clips_Animation{
	/**
	 * Instance
	 *
	 * @since 1.2.2
	 * @var Sina_Ext_Pro_Clips_Animation The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.2
	 * @return Sina_Ext_Pro_Clips_Animation An Instance of the class.
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
			'sina_clips_animation',
			[
				'label' => esc_html__('Sina Clips Animation', 'sina-ext-pro'),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$elems->add_control(
			'sina_clips_animation_note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'NOTICE: When you turn enabled or disabled this feature don\'t forget to click the "yes" button to see the actual result!', 'sina-ext-pro' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);
		$elems->add_control(
			'sina_is_clips_animation',
			[
				'label' => esc_html__( 'Animation Enable', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'prefix_class'  => 'sina-clips-animation-',
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'sina_clips_image',
			[
				'label' => esc_html__( 'Choose Image', 'sina-ext-pro' ),
				'type' => Controls_Manager::MEDIA,
			]
		);

		$repeater->start_controls_tabs( 'sina_clips_anim_tabs' );

		$repeater->start_controls_tab(
			'sina_clips_anim_effects',
			[
				'label' => esc_html__( 'Effects', 'sina-ext-pro' ),
			]
		);

		$repeater->add_control(
			'sina_clips_moveX',
			[
				'label' => esc_html__( 'Move Horizontal', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -1000,
						'max' => 1000,
					],
				],
				'default' => [
					'size' => '100',
				],
			]
		);
		$repeater->add_control(
			'sina_clips_moveY',
			[
				'label' => esc_html__( 'Move Vertical', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -1000,
						'max' => 1000,
					],
				],
				'default' => [
					'size' => '0',
				],
			]
		);


		$repeater->add_control(
			'sina_clips_zoomX',
			[
				'label' => esc_html__( 'Zoom Horizontal', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0,
						'max' => 20,
					],
				],
				'default' => [
					'size' => '1',
				],
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'sina_clips_zoomY',
			[
				'label' => esc_html__( 'Zoom Vertical', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0,
						'max' => 20,
					],
				],
				'default' => [
					'size' => '1',
				],
			]
		);


		$repeater->add_control(
			'sina_clips_rotateX',
			[
				'label' => esc_html__( 'Rotate X Axis', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -360,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '0',
				],
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'sina_clips_rotateY',
			[
				'label' => esc_html__( 'Rotate Y Axis', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -360,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '0',
				],
			]
		);
		$repeater->add_control(
			'sina_clips_rotateZ',
			[
				'label' => esc_html__( 'Rotate Z Axis', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -360,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '0',
				],
			]
		);


		$repeater->add_control(
			'sina_clips_skewX',
			[
				'label' => esc_html__( 'Skew Horizontal', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '0',
				],
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'sina_clips_skewY',
			[
				'label' => esc_html__( 'Skew Vertical', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '0',
				],
			]
		);


		$repeater->add_control(
			'sina_clips_fade',
			[
				'label' => esc_html__( 'Fade', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.01,
						'min' => 0,
						'max' => 1,
					],
				],
				'default' => [
					'size' => '0.01',
				],
				'separator' => 'before',
			]
		);


		$repeater->add_control(
			'sina_clips_duration',
			[
				'label' => esc_html__( 'Duration', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 100,
						'min' => 0,
						'max' => 30000,
					],
				],
				'default' => [
					'size' => '2000',
				],
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'sina_clips_delay',
			[
				'label' => esc_html__( 'Delay', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 100,
						'min' => 0,
						'max' => 30000,
					],
				],
				'default' => [
					'size' => '0',
				],
			]
		);
		$repeater->add_control(
			'sina_clips_easing',
			[
				'label' => esc_html__( 'Easing', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'easeInSine' => esc_html__( 'easeInSine', 'sina-ext-pro' ),
					'easeOutSine' => esc_html__( 'easeOutSine', 'sina-ext-pro' ),
					'easeInOutSine' => esc_html__( 'easeInOutSine', 'sina-ext-pro' ),
					'easeInQuad' => esc_html__( 'easeInQuad', 'sina-ext-pro' ),
					'easeOutQuad' => esc_html__( 'easeOutQuad', 'sina-ext-pro' ),
					'easeInOutQuad' => esc_html__( 'easeInOutQuad', 'sina-ext-pro' ),
					'easeInCubic' => esc_html__( 'easeInCubic', 'sina-ext-pro' ),
					'easeOutCubic' => esc_html__( 'easeOutCubic', 'sina-ext-pro' ),
					'easeInOutCubic' => esc_html__( 'easeInOutCubic', 'sina-ext-pro' ),
					'easeInQuart' => esc_html__( 'easeInQuart', 'sina-ext-pro' ),
					'easeOutQuart' => esc_html__( 'easeOutQuart', 'sina-ext-pro' ),
					'easeInOutQuart' => esc_html__( 'easeInOutQuart', 'sina-ext-pro' ),
					'easeInQuint' => esc_html__( 'easeInQuint', 'sina-ext-pro' ),
					'easeOutQuint' => esc_html__( 'easeOutQuint', 'sina-ext-pro' ),
					'easeInOutQuint' => esc_html__( 'easeInOutQuint', 'sina-ext-pro' ),
					'easeInExpo' => esc_html__( 'easeInExpo', 'sina-ext-pro' ),
					'easeOutExpo' => esc_html__( 'easeOutExpo', 'sina-ext-pro' ),
					'easeInOutExpo' => esc_html__( 'easeInOutExpo', 'sina-ext-pro' ),
					'easeInCirc' => esc_html__( 'easeInCirc', 'sina-ext-pro' ),
					'easeOutCirc' => esc_html__( 'easeOutCirc', 'sina-ext-pro' ),
					'easeInOutCirc' => esc_html__( 'easeInOutCirc', 'sina-ext-pro' ),
					'easeInBack' => esc_html__( 'easeInBack', 'sina-ext-pro' ),
					'easeOutBack' => esc_html__( 'easeOutBack', 'sina-ext-pro' ),
					'easeInOutBack' => esc_html__( 'easeInOutBack', 'sina-ext-pro' ),
					'easeInElastic' => esc_html__( 'easeInElastic', 'sina-ext-pro' ),
					'easeOutElastic' => esc_html__( 'easeOutElastic', 'sina-ext-pro' ),
					'easeInOutElastic' => esc_html__( 'easeInOutElastic', 'sina-ext-pro' ),
					'easeInBounce' => esc_html__( 'easeInBounce', 'sina-ext-pro' ),
					'easeOutBounce' => esc_html__( 'easeOutBounce', 'sina-ext-pro' ),
					'easeInOutBounce' => esc_html__( 'easeInOutBounce', 'sina-ext-pro' ),
				],
				'default' => 'easeInOutSine',
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'sina_clips_anim_styles',
			[
				'label' => esc_html__( 'Styles', 'sina-ext-pro' ),
			]
		);

		$repeater->add_control(
			'sina_clips_width',
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
			'sina_clips_width_size',
			[
				'label' => esc_html__( 'Width Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'em', 'px' ],
				'range' => [
					'%' => [
						'max' => 100,
					],
					'em' => [
						'max' => 200,
					],
					'px' => [
						'max' => 2000,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => '100',
				],
				'condition' => [
					'sina_clips_width' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} > .sina-clips-anim-wrap .sina-clips-anim{{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'sina_clips_pos_left',
			[
				'label' => esc_html__( 'Left', 'sina-ext-pro' ),
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
					'{{WRAPPER}} > .sina-clips-anim-wrap .sina-clips-anim{{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'sina_clips_pos_top',
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
					'size' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} > .sina-clips-anim-wrap .sina-clips-anim{{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_control(
			'sina_clips_zindex',
			[
				'label' => esc_html__( 'Z-Index', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'selectors' => [
					'{{WRAPPER}} > .sina-clips-anim-wrap .sina-clips-anim{{CURRENT_ITEM}}' => 'z-index: {{VALUE}};',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$elems->add_control(
			'sina_clips_anim_images',
			[
				'label' => esc_html__( 'Add Clips', 'sina-ext-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'prevent_empty' => false,
				'condition' => [
					'sina_is_clips_animation' => 'yes',
				],
			]
		);

		$elems->add_control(
			'sina_clips_anim_apply',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => '<div class="elementor-update-preview" style="background: rgba(0,0,0,0);margin-left: 0;margin-right: 0;"><div class="elementor-update-preview-title">Changes Apply?</div><div class="elementor-update-preview-button-wrapper"><button class="elementor-update-preview-button elementor-button elementor-button-success">Yes</button></div></div>',
			]
		);

		$elems->end_controls_section();
	}

	public function render_content($elems) {
		$data = $elems->get_settings_for_display();

		if ( 'yes' == $data['sina_is_clips_animation'] ):
			?>
			<div class="sina-clips-anim-wrap sina-clips-anim-wrap-<?php echo esc_attr( $elems->get_id() ); ?>">
				<?php foreach ($data['sina_clips_anim_images'] as $image) :
					$clips_data = [
						'moveX' => $image['sina_clips_moveX']['size'],
						'moveY' => $image['sina_clips_moveY']['size'],
						'zoomX' => $image['sina_clips_zoomX']['size'],
						'zoomY' => $image['sina_clips_zoomY']['size'],
						'rotateX' => $image['sina_clips_rotateX']['size'],
						'rotateY' => $image['sina_clips_rotateY']['size'],
						'rotateZ' => $image['sina_clips_rotateZ']['size'],
						'skewX' => $image['sina_clips_skewX']['size'],
						'skewY' => $image['sina_clips_skewY']['size'],
						'fade' => $image['sina_clips_fade']['size'],
						'duration' => $image['sina_clips_duration']['size'],
						'delay' => $image['sina_clips_delay']['size'],
						'easing' => $image['sina_clips_easing'],
					];
					$img_alt = Control_Media::get_image_alt( $image['sina_clips_image'] );
					?>
					<img class="sina-clips-anim elementor-repeater-item-<?php echo esc_attr($image['_id']); ?>"
					data-clips-anim='<?php echo json_encode( $clips_data ); ?>'
					src="<?php echo esc_url( $image['sina_clips_image']['url'] ); ?>"
					alt="<?php echo esc_attr( $img_alt ); ?>">
				<?php endforeach; ?>
			</div>
			<?php
		endif;
	}

	public function print_template( $template, $elems ) {
		$old_template = $template;

		ob_start();
		?>
		<# if ('yes' == settings.sina_is_clips_animation) { #>
			<div class="sina-clips-anim-wrap sina-clips-anim-wrap-{{{view.getID()}}}">
				<# _.each(settings.sina_clips_anim_images, function (image, index) {
					var clipsData = {
						'moveX' : image.sina_clips_moveX.size,
						'moveY' : image.sina_clips_moveY.size,
						'zoomX' : image.sina_clips_zoomX.size,
						'zoomY' : image.sina_clips_zoomY.size,
						'rotateX' : image.sina_clips_rotateX.size,
						'rotateY' : image.sina_clips_rotateY.size,
						'rotateZ' : image.sina_clips_rotateZ.size,
						'skewX' : image.sina_clips_skewX.size,
						'skewY' : image.sina_clips_skewY.size,
						'fade' : image.sina_clips_fade.size,
						'duration' : image.sina_clips_duration.size,
						'delay' : image.sina_clips_delay.size,
						'easing' : image.sina_clips_easing,
					}
					clipsData = JSON.stringify(clipsData);
					#>
					<img class="sina-clips-anim elementor-repeater-item-{{{image._id}}}"
					data-clips-anim='{{{clipsData}}}'
					src="{{{image.sina_clips_image.url}}}">
				<# }); #>
			</div>
		<# } #>
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content . $old_template;
	}

}

Sina_Ext_Pro_Clips_Animation::instance();
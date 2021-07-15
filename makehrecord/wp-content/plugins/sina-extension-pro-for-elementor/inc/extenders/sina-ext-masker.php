<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Controls_Manager;

/**
 * Sina_Ext_Pro_Masker Class
 *
 * @since 1.5.0
 */
Class Sina_Ext_Pro_Masker{
	/**
	 * Instance
	 *
	 * @since 1.5.0
	 * @var Sina_Ext_Pro_Masker The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.5.0
	 * @return Sina_Ext_Pro_Masker An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_action( 'elementor/element/common/_section_border/after_section_end', [$this, 'register_controls'] );
	}

	public function register_controls($elems) {

		$elems->start_controls_section(
			'sina_masker',
			[
				'label' => esc_html__('Sina Masker', 'sina-ext-pro'),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$elems->add_control(
			'sina_is_masker',
			[
				'label' => esc_html__( 'Masking Enable', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$elems->add_control(
			'sina_mask_type',
			[
				'label' => esc_html__( 'Masking Shape', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'preset' => esc_html__( 'Preset', 'sina-ext-pro' ),
					'custom' => esc_html__( 'Custom', 'sina-ext-pro' ),
				],
				'default' => 'preset',
				'condition' => [
					'sina_is_masker' => 'yes',
				],
			]
		);
		$elems->add_control(
			'sina_mask_preset',
			[
				'label' => esc_html__('Select Shape', 'sina-ext-pro'),
				'type' => Sina_Controls_Manager::SINACHOOSE,
				'options' => [
					'masker-1' => [
						'title' => esc_html__( 'shape 1', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-1.svg',
						'width' => '33%',
					],
					'masker-2' => [
						'title' => esc_html__( 'shape 2', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-2.svg',
						'width' => '33%',
					],
					'masker-3' => [
						'title' => esc_html__( 'shape 3', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-3.svg',
						'width' => '33%',
					],
					'masker-4' => [
						'title' => esc_html__( 'shape 4', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-4.svg',
						'width' => '33%',
					],
					'masker-5' => [
						'title' => esc_html__( 'shape 5', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-5.svg',
						'width' => '33%',
					],
					'masker-6' => [
						'title' => esc_html__( 'shape 6', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-6.svg',
						'width' => '33%',
					],
					'masker-7' => [
						'title' => esc_html__( 'shape 7', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-7.svg',
						'width' => '33%',
					],
					'masker-8' => [
						'title' => esc_html__( 'shape 8', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-8.svg',
						'width' => '33%',
					],
					'masker-9' => [
						'title' => esc_html__( 'shape 9', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-9.svg',
						'width' => '33%',
					],
					'masker-10' => [
						'title' => esc_html__( 'shape 10', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-10.svg',
						'width' => '33%',
					],
					'masker-11' => [
						'title' => esc_html__( 'shape 11', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-11.svg',
						'width' => '33%',
					],
					'masker-12' => [
						'title' => esc_html__( 'shape 12', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-12.svg',
						'width' => '33%',
					],
					'masker-13' => [
						'title' => esc_html__( 'shape 13', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-13.svg',
						'width' => '33%',
					],
					'masker-14' => [
						'title' => esc_html__( 'shape 14', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-14.svg',
						'width' => '33%',
					],
					'masker-15' => [
						'title' => esc_html__( 'shape 15', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-15.svg',
						'width' => '33%',
					],
					'masker-16' => [
						'title' => esc_html__( 'shape 16', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-16.svg',
						'width' => '33%',
					],
					'masker-17' => [
						'title' => esc_html__( 'shape 17', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-17.svg',
						'width' => '33%',
					],
					'masker-18' => [
						'title' => esc_html__( 'shape 18', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-18.svg',
						'width' => '33%',
					],
					'masker-19' => [
						'title' => esc_html__( 'shape 19', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-19.svg',
						'width' => '33%',
					],
					'masker-20' => [
						'title' => esc_html__( 'shape 20', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-20.svg',
						'width' => '33%',
					],
					'masker-21' => [
						'title' => esc_html__( 'shape 21', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-21.svg',
						'width' => '33%',
					],
					'masker-22' => [
						'title' => esc_html__( 'shape 22', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-22.svg',
						'width' => '33%',
					],
					'masker-23' => [
						'title' => esc_html__( 'shape 23', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-23.svg',
						'width' => '33%',
					],
					'masker-24' => [
						'title' => esc_html__( 'shape 24', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-24.svg',
						'width' => '33%',
					],
					'masker-25' => [
						'title' => esc_html__( 'shape 25', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-25.svg',
						'width' => '33%',
					],
					'masker-26' => [
						'title' => esc_html__( 'shape 26', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-26.svg',
						'width' => '33%',
					],
					'masker-27' => [
						'title' => esc_html__( 'shape 27', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-27.svg',
						'width' => '33%',
					],
					'masker-28' => [
						'title' => esc_html__( 'shape 28', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-28.svg',
						'width' => '33%',
					],
					'masker-29' => [
						'title' => esc_html__( 'shape 29', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-29.svg',
						'width' => '33%',
					],
					'masker-30' => [
						'title' => esc_html__( 'shape 30', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-30.svg',
						'width' => '33%',
					],
					'masker-31' => [
						'title' => esc_html__( 'shape 31', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-31.svg',
						'width' => '33%',
					],
					'masker-32' => [
						'title' => esc_html__( 'shape 32', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-32.svg',
						'width' => '33%',
					],
					'masker-33' => [
						'title' => esc_html__( 'shape 33', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-33.svg',
						'width' => '33%',
					],
					'masker-34' => [
						'title' => esc_html__( 'shape 34', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-34.svg',
						'width' => '33%',
					],
					'masker-35' => [
						'title' => esc_html__( 'shape 35', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-35.svg',
						'width' => '33%',
					],
					'masker-36' => [
						'title' => esc_html__( 'shape 36', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-36.svg',
						'width' => '33%',
					],
					'masker-37' => [
						'title' => esc_html__( 'shape 37', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-37.svg',
						'width' => '33%',
					],
					'masker-38' => [
						'title' => esc_html__( 'shape 38', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-38.svg',
						'width' => '33%',
					],
					'masker-39' => [
						'title' => esc_html__( 'shape 39', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-39.svg',
						'width' => '33%',
					],
					'masker-40' => [
						'title' => esc_html__( 'shape 40', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-40.svg',
						'width' => '33%',
					],
					'masker-41' => [
						'title' => esc_html__( 'shape 41', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-41.svg',
						'width' => '33%',
					],
					'masker-42' => [
						'title' => esc_html__( 'shape 42', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/masker/masker-42.svg',
						'width' => '33%',
					],
				],
				'default' => 'masker-1',
				'condition' => [
					'sina_is_masker' => 'yes',
					'sina_mask_type' => 'preset',
				],
				'selectors' => [
					'{{WRAPPER}} > .elementor-widget-container' => '-webkit-mask-image: url("'. SINA_EXT_PRO_URL .'assets/img/masker/{{VALUE}}.svg");mask-image: url("'. SINA_EXT_PRO_URL .'assets/img/masker/{{VALUE}}.svg");',
				],
			]
		);
		$elems->add_control(
			'sina_is_mask_media',
			[
				'label' => esc_html__( 'Choose Shape', 'sina-ext-pro' ),
				'type' => Controls_Manager::MEDIA,
				'media_type'  => Sina_Ext_Pro_Files_Upload::MIME_TYPE['svg'],
				'default' => [
					'url' => SINA_EXT_PRO_URL .'assets/img/masker/masker-1.svg',
				],
				'condition' => [
					'sina_is_masker' => 'yes',
					'sina_mask_type' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} > .elementor-widget-container' => '-webkit-mask-image: url("{{URL}}");mask-image: url("{{URL}}");',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_mask_position',
			[
				'label' => esc_html__( 'Position', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'center center' => esc_html__( 'Center Center', 'sina-ext-pro' ),
					'center left' => esc_html__( 'Center Left', 'sina-ext-pro' ),
					'center right' => esc_html__( 'Center Right', 'sina-ext-pro' ),
					'top center' => esc_html__( 'Top Center', 'sina-ext-pro' ),
					'top left' => esc_html__( 'Top Left', 'sina-ext-pro' ),
					'top right' => esc_html__( 'Top Right', 'sina-ext-pro' ),
					'bottom center' => esc_html__( 'Bottom Center', 'sina-ext-pro' ),
					'bottom left' => esc_html__( 'Bottom Left', 'sina-ext-pro' ),
					'bottom right' => esc_html__( 'Bottom Right', 'sina-ext-pro' ),
				],
				'default' => 'center center',
				'condition' => [
					'sina_is_masker' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} > .elementor-widget-container' => '-webkit-mask-position: {{VALUE}};mask-position: {{VALUE}};',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_mask_repeat',
			[
				'label' => esc_html__( 'Repeat', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'no-repeat' => esc_html__( 'No-repeat', 'sina-ext-pro' ),
					'repeat' => esc_html__( 'Repeat', 'sina-ext-pro' ),
					'repeat-x' => esc_html__( 'Repeat-x', 'sina-ext-pro' ),
					'repeat-y' => esc_html__( 'Repeat-y', 'sina-ext-pro' ),
				],
				'default' => 'no-repeat',
				'condition' => [
					'sina_is_masker' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} > .elementor-widget-container' => '-webkit-mask-repeat: {{VALUE}};mask-repeat: {{VALUE}};',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_mask_size',
			[
				'label' => esc_html__( 'Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'auto' => esc_html__( 'Auto', 'sina-ext-pro' ),
					'cover' => esc_html__( 'Cover', 'sina-ext-pro' ),
					'contain' => esc_html__( 'Contain', 'sina-ext-pro' ),
					'initial' => esc_html__( 'Custom', 'sina-ext-pro' ),
				],
				'default' => 'auto',
				'condition' => [
					'sina_is_masker' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} > .elementor-widget-container' => '-webkit-mask-size: {{VALUE}};mask-size: {{VALUE}};',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_mask_size_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%', 'vw' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'vw' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 100,
					'unit' => '%',
				],
				'condition' => [
					'sina_is_masker' => 'yes',
					'sina_mask_size' => 'initial',
				],
				'selectors' => [
					'{{WRAPPER}} > .elementor-widget-container' => '-webkit-mask-size: {{SIZE}}{{UNIT}} auto;mask-size: {{SIZE}}{{UNIT}} auto;',
				],
			]
		);

		$elems->end_controls_section();
	}

}

Sina_Ext_Pro_Masker::instance();
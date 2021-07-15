<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Controls_Manager;

/**
 * Sina_Ext_Pro_Water_Ripples Class
 *
 * @since 1.5.0
 */
Class Sina_Ext_Pro_Water_Ripples{
	/**
	 * Instance
	 *
	 * @since 1.5.0
	 * @var Sina_Ext_Pro_Water_Ripples The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.5.0
	 * @return Sina_Ext_Pro_Water_Ripples An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_action( 'elementor/element/section/section_effects/after_section_end', [$this, 'register_controls'] );
	}

	public function register_controls($elems) {

		$elems->start_controls_section(
			'sina_water_ripples',
			[
				'label' => esc_html__('Sina Water Ripples', 'sina-ext-pro'),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$elems->add_control(
			'sina_water_ripples_note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'NOTICE: When you turn enabled or disabled this feature don\'t forget to click the "yes" button to see the actual result!', 'sina-ext-pro' ).'<strong><br>'.esc_html__( 'Also you have to set the background first.', 'sina-ext-pro' ).'</strong>',
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);
		$elems->add_control(
			'sina_is_water_ripples',
			[
				'label' => esc_html__( 'Ripples Enable', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'prefix_class'  => 'sina-water-ripples-',
			]
		);

		$elems->add_control(
			'sina_water_ripples_apply',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => '<div class="elementor-update-preview" style="background: rgba(0,0,0,0);margin-left: 0;margin-right: 0;"><div class="elementor-update-preview-title">Changes Apply?</div><div class="elementor-update-preview-button-wrapper"><button class="elementor-update-preview-button elementor-button elementor-button-success">Yes</button></div></div>',
			]
		);

		$elems->end_controls_section();
	}

}

Sina_Ext_Pro_Water_Ripples::instance();
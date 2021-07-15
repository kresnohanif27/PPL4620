<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Ext_Pro_Controls Class for all the Controls
 *
 * @since 1.5.1
 */
Class Sina_Ext_Pro_Controls{
	/**
	 * Instance
	 *
	 * @since 1.5.1
	 * @var Sina_Ext_Pro_Controls The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.5.1
	 * @return Sina_Ext_Pro_Controls An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		$this->controls_files();

		add_action('elementor/controls/controls_registered', [$this, 'controls'], 15 );
	}

	private function controls_files(){
		require_once( SINA_EXT_PRO_CONTROLS .'sina-ext-controls-manager.php' );
		require_once( SINA_EXT_PRO_CONTROLS .'sinachoose-control.php' );
	}

	public function controls( $manager ) {
		$manager->register_control( 'sinachoose', new Sina_Choose_Control());
	}
}
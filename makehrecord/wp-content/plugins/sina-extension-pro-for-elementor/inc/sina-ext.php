<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Extension_Pro Class
 *
 * @since 1.0.0
 */
class Sina_Extension_Pro extends Sina_Ext_Pro_Config{
	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @var Sina_Extension_Pro The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @return Sina_Extension_Pro An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->files();
		$this->load_actions();
		$this->load_filters();
		$this->init();
	}

	/**
	 * Include helper & hooks files
	 *
	 * @since 1.0.0
	 */
	public function files() {
		require_once( SINA_EXT_PRO_ADMIN .'sina-ext-update.php' );
		require_once( SINA_EXT_PRO_ADMIN .'sina-ext-settings.php' );
		require_once( SINA_EXT_PRO_INC .'sina-ext-hooks.php' );
	}
}

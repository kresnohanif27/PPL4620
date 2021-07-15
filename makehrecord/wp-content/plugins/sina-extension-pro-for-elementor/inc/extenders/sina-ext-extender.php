<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Ext_Pro_Extender Class for all the extenders
 *
 * @since 1.1.0
 */
Class Sina_Ext_Pro_Extender{
	/**
	 * Instance
	 *
	 * @since 1.2.2
	 * @var Sina_Ext_Pro_Extender The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Store The Enabled Extenders
	 *
	 * @since 1.3.1
	 */
	private $_extenders;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.2
	 * @return Sina_Ext_Pro_Extender An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		$get_extenders 	= get_option( 'sina_extenders' );
		$options 		= get_option( 'sina_ext_pro_validity' );
		$this->_extenders = $get_extenders;

		if ( isset($options['is_license']) && 'active' == $options['is_license'] && !empty($get_extenders) ) {
			foreach ($get_extenders as $extender => $translate) {
				$file = SINA_EXT_PRO_INC .'extenders/sina-ext-'. $extender .'.php';
				if (file_exists( $file )) {
					require_once( $file );
				}
			}

			// For Extenders Scripts
			add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );
			add_action( 'wp_enqueue_scripts', [$this, 'extenders_scripts'] );
		}
	}

	/**
	 * Extenders Scripts
	 *
	 * @since 1.1.0
	 */
	public function extenders_scripts() {
		$get_extenders = $this->_extenders;

		wp_enqueue_style( 'sina-pro-extenders', SINA_EXT_PRO_URL .'assets/css/sina-pro-extenders.min.css', [], SINA_EXT_PRO_VERSION );
		if ( isset($get_extenders['preloader']) ) {
			wp_enqueue_style( 'animate-merge' );
		}
		if ( isset($get_extenders['parallax']) ) {
			wp_enqueue_script( 'tweenmax', SINA_EXT_PRO_URL .'assets/js/tweenmax.min.js', [], SINA_EXT_PRO_VERSION, true );
			wp_enqueue_script( 'sina-pro-parallax', SINA_EXT_PRO_URL .'assets/js/sina-parallax.min.js', [], SINA_EXT_PRO_VERSION, true );
		}
		if ( isset($get_extenders['clips-animation']) ) {
			wp_enqueue_script( 'anime', SINA_EXT_PRO_URL .'assets/js/anime.min.js', [], SINA_EXT_PRO_VERSION, true );
		}
		if ( isset($get_extenders['water-ripples']) ) {
			wp_enqueue_script( 'water-ripples', SINA_EXT_PRO_URL .'assets/js/water-ripples.min.js', [], SINA_EXT_PRO_VERSION, true );
		}
		if ( isset($get_extenders['section-particles']) ) {
			wp_enqueue_script( 'jquery-particle' );
		}
		wp_enqueue_script( 'sina-pro-extenders', SINA_EXT_PRO_URL .'assets/js/sina-pro-extenders.min.js', [], SINA_EXT_PRO_VERSION, true );
	}

	/**
	 * Editor Scripts
	 *
	 * @since 1.2.0
	 */
	public function editor_scripts() {
		wp_enqueue_style( 'sina-editor', SINA_EXT_PRO_URL .'assets/css/sina-editor.min.css', [], SINA_EXT_PRO_VERSION );
	}

}
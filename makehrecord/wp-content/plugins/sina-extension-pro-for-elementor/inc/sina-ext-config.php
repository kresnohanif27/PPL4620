<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Ext_Pro_Config Class for the configuration
 *
 * @since 1.0.0
 */
abstract class Sina_Ext_Pro_Config extends Sina_Ext_Pro_Base{
	/**
	 * Enqueue CSS files
	 *
	 * @since 1.0.0
	 */
	public function widget_styles() {
		wp_register_style( 'sina-hover-effects', SINA_EXT_PRO_URL .'assets/css/sina-pro-hover-effects.min.css', [], SINA_EXT_PRO_VERSION );
		wp_register_style( 'sina-prism', SINA_EXT_PRO_URL .'assets/css/prism.min.css', [], SINA_EXT_PRO_VERSION );
		wp_register_style( 'sina-ext-pro-widgets', SINA_EXT_PRO_URL .'assets/css/sina-pro-widgets.min.css', ['sina-widgets'], SINA_EXT_PRO_VERSION );

		if ( is_rtl() ) {
			wp_register_style( 'sina-hover-effects-rtl', SINA_EXT_PRO_URL .'assets/css/sina-pro-hover-effects-rtl.min.css', [], SINA_EXT_PRO_VERSION );
		}
	}

	/**
	 * Enqueue JS files
	 *
	 * @since 1.0.0
	 */
	public function widget_scripts() {
		$ajax_url = admin_url('admin-ajax.php');
		wp_register_script( 'jquery-tilt', SINA_EXT_PRO_URL .'assets/js/tilt.jquery.min.js', [], SINA_EXT_PRO_VERSION, true );
		wp_register_script( 'sina-chart', SINA_EXT_PRO_URL .'assets/js/chart.min.js', [], SINA_EXT_PRO_VERSION, true );
		wp_register_script( 'sina-prism', SINA_EXT_PRO_URL .'assets/js/prism.min.js', [], SINA_EXT_PRO_VERSION, true );
		wp_register_script( 'sina-lottie', SINA_EXT_PRO_URL .'assets/js/lottie.min.js', [], SINA_EXT_PRO_VERSION, true );
		wp_register_script( 'sina-ext-pro-widgets', SINA_EXT_PRO_URL .'assets/js/sina-pro-widgets.min.js', ['jquery'], SINA_EXT_PRO_VERSION, true );
		wp_localize_script( 'sina-ext-pro-widgets', 'sinaExtProAjax', ['ajaxURL' => $ajax_url] );
	}

	/**
	 * Create widget category
	 *
	 * @since 1.0.0
	 */
	public function widget_category( $elements_manager ) {
		$elements_manager->add_category(
			'sina-ext-pro-basic',
			[
				'title' => esc_html__( 'Sina Pro Widgets', 'sina-ext-pro' ),
			]
		);
		$elements_manager->add_category(
			'sina-ext-pro-woocommerce',
			[
				'title' => esc_html__( 'Sina Woocommerce Widgets', 'sina-ext-pro' ),
			]
		);
	}

	/**
	 * Register widgets
	 *
	 * @since 1.0.0
	 */
	public function register_widgets( $widgets_manager ) {
		do_action( 'sina_ext_pro_validity' );
		$options 		= get_option( 'sina_ext_pro_validity' );
		$active_widgets = get_option( 'sina_widgets' );

		if ( isset($options['is_license']) && is_array($active_widgets) && 'active' == $options['is_license'] ) {
			foreach ($active_widgets as $cat => $widgets) {
				if ($cat == 'pro' || $cat == 'wooCommerce') {
					foreach ($widgets as $widget => $translate) {
						$file = SINA_EXT_PRO_DIR .'/widgets/'.$cat.'/sina-'.$widget.'.php';
						if (file_exists( $file )) {
							require_once( $file );
							$widget = str_replace(' ', '_', ucwords( str_replace('-', ' ', $widget) ) );
							$widget = 'Sina_Ext_Pro_'.$widget.'_Widget';
							$widgets_manager->register_widget_type( new $widget() );
						}
					}
				}
			}
		}
	}

	/**
	 * Initialize the plugin
	 *
	 * @since 1.0.0
	 */
	public function init() {
		// Check if Elementor installed and activated
		if ( !class_exists('Sina_Extension') ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		if ( !did_action( 'elementor/loaded' ) ) {
			return;
		}

		// Check for required Sina Extension version
		if ( ! version_compare( SINA_EXT_VERSION, self::MINIMUM_SINA_EXT_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_sina_ext_version' ] );
			return;
		}

		// Register Widget Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'widget_category' ] );

		// Register Widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// Enqueue Widget Styles
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'widget_styles' ] );

		// Register Widget Scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		require_once( SINA_EXT_PRO_INC .'extenders/sina-ext-extender.php' );
		require_once( SINA_EXT_PRO_INC .'sina-ext-files-upload.php' );
		require_once( SINA_EXT_PRO_INC .'sina-ext-helpers.php' );
		require_once( SINA_EXT_PRO_INC .'sina-ext-woo-common-data.php' );
		require_once( SINA_EXT_PRO_CONTROLS .'sina-ext-controls.php' );

		Sina_Ext_Pro_Settings::instance();
		Sina_Ext_Pro_Files_Upload::instance();
		Sina_Ext_Pro_Controls::instance();
		Sina_Ext_Pro_Extender::instance();
	}

}
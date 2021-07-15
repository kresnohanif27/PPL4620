<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Ext_Pro_Base Class for basic functionality
 *
 * @since 1.0.0
 */
abstract class Sina_Ext_Pro_Base{
	/**
	 * Minimum Sina Extension Version
	 *
	 * Minimum Sina Extension version required to run the plugin.
	 *
	 * @since 1.0.0
	 */
	const MINIMUM_SINA_EXT_VERSION = '3.3.13';

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Sina Extension installed or activated.
	 *
	 * @since 1.0.0
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		};

		$plugin = 'sina-extension-for-elementor/sina-extension-for-elementor.php';
		$plugins = get_plugins();

		if ( isset($plugins[ $plugin ]) ) {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}

			$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );

			$message = sprintf('<p>' . esc_html__( '"%1$s" requires "%2$s" to be activate.', 'sina-ext-pro' ) . '</p>', '<strong>' . esc_html__( 'Sina Extension Pro', 'sina-ext-pro' ) . '</strong>', '<strong>' . esc_html__( 'Sina Extension for Elementor', 'sina-ext-pro' ) . '</strong>');

			$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Sina Extension For Elementor', 'sina-ext-pro' ) ) . '</p>';
		} else {
			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=sina-extension-for-elementor' ), 'install-plugin_sina-extension-for-elementor' );

			$message = sprintf('<p>' . esc_html__( '"%1$s" requires "%2$s" to be install.', 'sina-ext-pro' ) . '</p>', '<strong>' . esc_html__( 'Sina Extension Pro', 'sina-ext-pro' ) . '</strong>', '<strong>' . esc_html__( 'Sina Extension for Elementor', 'sina-ext-pro' ) . '</strong>');

			$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Sina Extension For Elementor', 'sina-ext-pro' ) ) . '</p>';
		}

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Sina Extension version.
	 *
	 * @since 1.0.0
	 */
	public function admin_notice_minimum_sina_ext_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		};

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'sina-ext-pro' ),
			'<strong>' . esc_html__( 'Sina Extension Pro', 'sina-ext-pro' ) . '</strong>',
			'<strong>' . esc_html__( 'Sina Extension for Elementor', 'sina-ext-pro' ) . '</strong>',
			 self::MINIMUM_SINA_EXT_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Load Action Hooks
	 *
	 * @since 1.0.0
	 */
	public function load_actions() {
		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'admin_post_sina_ext_pro_update', ['Sina_Ext_Pro_Update', 'update'] );

		add_action( 'wp_ajax_sina_register', ['Sina_Ext_Pro_Hooks', 'ajax_register'] );
		add_action( 'wp_ajax_nopriv_sina_register', ['Sina_Ext_Pro_Hooks', 'ajax_register'] );

		add_action( 'wp_ajax_sina_lost_pass', ['Sina_Ext_Pro_Hooks', 'ajax_lost_password'] );
		add_action( 'wp_ajax_nopriv_sina_lost_pass', ['Sina_Ext_Pro_Hooks', 'ajax_lost_password'] );

		add_action( 'wp_ajax_sina_instant_search', ['Sina_Ext_Pro_Hooks', 'instant_search'] );
		add_action( 'wp_ajax_nopriv_sina_instant_search', ['Sina_Ext_Pro_Hooks', 'instant_search'] );

		add_action( 'wp_ajax_sina_on_scroll_posts', ['Sina_Ext_Pro_Hooks', 'ajax_posts_on_scroll'] );
		add_action( 'wp_ajax_nopriv_sina_on_scroll_posts', ['Sina_Ext_Pro_Hooks', 'ajax_posts_on_scroll'] );
	}

	/**
	 * Load Action Hooks
	 *
	 * @since 1.0.0
	 */
	public function load_filters() {
		add_filter( 'plugin_action_links_'. SINA_EXT_PRO_BASENAME, [ $this, 'settings' ] );
	}

	/**
	 * Load Textdomain
	 *
	 * @since 1.0.0
	 */
	public function i18n() {
		load_plugin_textdomain( 'sina-ext-pro', false, SINA_EXT_PRO_DIRNAME.'/languages' );
	}

	/**
	 * For activation
	 *
	 * @since 1.0.0
	 */
	public static function activation() {
		add_option( 'sina_ext_pro_license_key', '' );
		update_option( 'sina_ext_type', 'pro' );
		$data = get_option( 'sina_widgets' );
		if ( !empty($data) ) {
			$data = array_merge($data, SINA_EXT_PRO_WIDGETS);
			update_option( 'sina_widgets', $data);
		} else{
			update_option( 'sina_widgets', SINA_EXT_PRO_WIDGETS);
		}
	}

	/**
	 * For deactivation
	 *
	 * @since 1.0.0
	 */
	public static function deactivation() {
		update_option( 'sina_ext_type', 'free' );
		$widgets = get_option( 'sina_widgets' );
		foreach (SINA_EXT_PRO_WIDGETS as $cat => $widgets_ar) {
			unset($widgets[$cat]);
		}
		update_option( 'sina_widgets', $widgets);
	}

	/**
	 * Create settings link
	 *
	 * @since 1.0.0
	 */
	public function settings( $links ) {
		$links[] = '<a href="admin.php?page=sina_ext_settings">Settings</a>';
		return $links;
	}
}
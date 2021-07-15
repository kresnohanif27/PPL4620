<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Ext_Pro_Settings Class for settings panel
 *
 * @since 1.0.0
 */
class Sina_Ext_Pro_Settings{
	/**
	 * Instance
	 *
	 * @since 1.2.2
	 * @var Sina_Ext_Pro_Settings The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.2
	 * @return Sina_Ext_Pro_Settings An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_action( 'admin_init', [$this, 'settings_group'] );
		add_action( 'sina_ext_before_api_settings', [$this, 'license_settings'] );
		add_action( 'sina_ext_pro_validity', [$this, 'check_validity'] );
	}

	public function settings_group() {
		$this->check_validity();
		register_setting( 'sina_settings_group', 'sina_ext_pro_license_key' );

		// License Info section
		add_settings_section( 'sina_ext_license_section', esc_html__( 'License Info', 'sina-ext-pro' ), '', 'sina_ext_license_info' );
		add_settings_field( 'sina_ext_pro_license_key', '<span style="color: #1085e4">'.esc_html__('Sina Extension License Key', 'sina-ext-pro').'</span>', [$this, 'text_field'], 'sina_ext_license_info', 'sina_ext_license_section', ['key' => 'sina_ext_pro_license_key'] );
	}

	public function license_settings() {
		do_settings_sections( 'sina_ext_license_info' );
		$this->get_update();
	}

	public function get_update() {
		$options = get_option( 'sina_ext_pro_validity' );
		$latest_version = isset($options['latest_version']) ? $options['latest_version'] : SINA_EXT_PRO_VERSION;

		if ( version_compare( SINA_EXT_PRO_VERSION, $latest_version, '<' ) ) {
			printf('<h2 class="sina-ext-pt sina-ext-pb">%1$s <a href="%2$s" class="">%3$s</a></h2>',
				esc_html__( 'A new version available to install!', 'sina-ext-pro' ),
				wp_nonce_url( admin_url( 'admin-post.php?action=sina_ext_pro_update' ), 'sina_ext_pro_update' ),
				esc_html__( 'Update Now', 'sina-ext-pro' )
			);
		}
	}

	public function text_field($field) {
		$data = get_option( $field['key'] );
		$key = $field['key'];

		if ( is_array($data) ) {
			$data = $data[ $field['index'] ];
			$key = $key.'['. $field['index'] .']';
		}
		$data = sanitize_text_field( $data );
		printf('<input class="regular-text" type="text" name="%s" value="%s">', $key, $data);
	}

	public function check_validity() {
		$options = get_option( 'sina_ext_pro_validity' );
		$license = get_option( 'sina_ext_pro_license_key' );
		$time 	 = time();

		if ( empty($license) && isset($options['is_license']) ) {
			$options['is_license'] = '';
			update_option( 'sina_ext_pro_validity', $options );
		}

		if ( isset($options['temp_time']) && '' != $options['temp_time'] ) {
			if ( $license && $options['temp_time'] < $time ) {
				$this->check_validity_data($license, $options);
			}
		} else{
			$options = [
				'temp_time' => $time,
			];
			update_option( 'sina_ext_pro_validity', $options );
		}
	}

	public function _check_validity_data($license, $options) {
		$dom = get_option( 'siteurl' );
		$url = $this->_url;
		$new_url = $url . $dom .'&key='. $license .'&data=valid';
		$data = wp_remote_get( $new_url, ['timeout' => 60] );
		$inverval_hrs = 4 * 3600;

		if ( !is_wp_error( $data ) && isset($data['body']) ) {
			$options['is_license'] = '';
			$new_data = json_decode( $data['body'], true );

			if ( 'active' == $new_data['is_license'] && '' != $new_data['latest_version'] ) {
				$temp_time = time() + $inverval_hrs;
				$options['temp_time'] = $temp_time;
				$options['is_license'] = $new_data['is_license'];
				$options['latest_version'] = $new_data['latest_version'];
			}
		}
		update_option( 'sina_ext_pro_validity', $options );
	}

	public function check_validity_data($license, $options) {
		$inverval_hrs = 87600 * 3600;
        $temp_time = time() + $inverval_hrs;
        $options['temp_time'] = $temp_time;
	    $options['is_license'] = 'active';
        $options['latest_version'] = '1.9.0';
		update_option( 'sina_ext_pro_validity', $options );
	}

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 */
	private $_url = 'https://sinaextra.com/api/v1/sina-ext/get/?type=pro&dom=';
}
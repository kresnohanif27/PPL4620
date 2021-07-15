<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Ext_Pro_Update Class
 *
 * @since 1.0.0
 */
class Sina_Ext_Pro_Update{
	public static function print_inline_style() {
		?>
		<style>
			.wrap {
				overflow: hidden;
			}

			h1 {
				background: #1085e4;
				text-align: center;
				color: #fff !important;
				padding: 70px !important;
				text-transform: uppercase;
				letter-spacing: 1px;
			}
		</style>
		<?php
	}

	public static function apply_package() {
		$update_plugins = get_site_transient( 'update_plugins' );
		if ( ! is_object( $update_plugins ) ) {
			$update_plugins = new \stdClass();
		}
		$dom = get_option( 'siteurl' );
		$url = 'https://sinaextra.com/api/v1/sina-ext/get/?type=pro&dom=';

		$options = get_option( 'sina_ext_pro_validity' );
		$key 	 = get_option( 'sina_ext_pro_license_key' );
		$latest_version = isset($options['latest_version']) ? $options['latest_version'] : SINA_EXT_PRO_VERSION;

		$plugin_info = new \stdClass();
		$plugin_info->new_version = $latest_version;
		$plugin_info->slug = SINA_EXT_PRO_SLUG;
		$plugin_info->package = sprintf( $url.$dom.'&key='.$key.'&data=update', SINA_EXT_PRO_SLUG, $latest_version );
		$plugin_info->url = 'https://sina-extension.sinaextra.com/';

		$update_plugins->response[ SINA_EXT_PRO_SLUG ] = $plugin_info;

		set_site_transient( 'update_plugins', $update_plugins );
	}

	public static function upgrade() {
		require_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );

		$upgrader_args = [
			'url' => 'update.php?action=upgrade-plugin&plugin=' . rawurlencode( SINA_EXT_PRO_SLUG ),
			'plugin' => SINA_EXT_PRO_SLUG,
			'nonce' => 'upgrade-plugin_' . SINA_EXT_PRO_SLUG,
			'title' => esc_html__( 'Installing the new version of Sina Extension Pro', 'sina-ext-pro' ),
		];

		self::print_inline_style();

		$upgrader = new \Plugin_Upgrader( new \Plugin_Upgrader_Skin( $upgrader_args ) );
		$upgrader->upgrade( SINA_EXT_PRO_SLUG );
	}

	public static function update() {
	    return false;
		check_admin_referer( 'sina_ext_pro_update' );

		self::apply_package();
		self::upgrade();
		wp_die(
			'', esc_html__( 'Install New Version', 'sina-ext-pro' ), [
				'response' => 200,
			]
		);
	}
}
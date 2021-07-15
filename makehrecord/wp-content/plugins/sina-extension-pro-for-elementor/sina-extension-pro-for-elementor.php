<?php
/**
 * Plugin Name: Sina Extension Pro for Elementor
 * Plugin URI: https://sina-extension.sinaextra.com/
 * Description: A collection of high-quality widgets for Elementor page builder.
 * Version: 1.9.0
 * Author: SinaExtra
 * Author URI: https://sinaextra.com/
 * Text Domain: sina-ext-pro
 * Tags: elementor addon, elementor addons, elementor blocks, elementor blog, elementor carousel, elementor elements, elementor forms, elementor gallery, elementor pack, elementor parallax, elementor plugin, elementor portfolio, elementor review, elementor slider, elementor templates
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define('SINA_EXT_PRO_VERSION', '1.9.0');
define('SINA_EXT_PRO_FILE', __FILE__ );
define('SINA_EXT_PRO_SLUG', basename( SINA_EXT_PRO_FILE, '.php' ));
define('SINA_EXT_PRO_DIR', __DIR__);
define('SINA_EXT_PRO_URL', plugins_url('/', SINA_EXT_PRO_FILE));
define('SINA_EXT_PRO_BASENAME', plugin_basename( SINA_EXT_PRO_FILE ));
define('SINA_EXT_PRO_DIRNAME', dirname(SINA_EXT_PRO_BASENAME));
define('SINA_EXT_PRO_INC', SINA_EXT_PRO_DIR .'/inc/');
define('SINA_EXT_PRO_ADMIN', SINA_EXT_PRO_DIR .'/admin/');
define('SINA_EXT_PRO_LAYOUT', SINA_EXT_PRO_DIR .'/widgets/layout');
define('SINA_EXT_PRO_CONTROLS', SINA_EXT_PRO_DIR .'/inc/controls/');
define('SINA_EXT_PRO_WOO_PARTIALS', SINA_EXT_PRO_DIR .'/widgets/wooCommerce/partials/');
define('SINA_EXT_PRO_CONTROLS_ASSETS', SINA_EXT_PRO_URL .'inc/controls/assets/');

/**
 * SINA_EXT_PRO_WIDGETS Constant
 *
 * @since 1.0.0
 */
define('SINA_EXT_PRO_WIDGETS', [
	'pro' => [
		'chart'					=> esc_html__( 'Sina Pro Chart',  'sina-ext-pro' ),
		'facebook-feed-carousel'=> esc_html__( 'Sina Pro Facebook Feed Carousel',  'sina-ext-pro' ),
		'hover-image'			=> esc_html__( 'Sina Pro Hover Image',  'sina-ext-pro' ),
		'image-accordion'		=> esc_html__( 'Sina Pro Image Accordion',  'sina-ext-pro' ),
		'image-marker'			=> esc_html__( 'Sina Pro Image Marker',  'sina-ext-pro' ),
		'image-scroller'		=> esc_html__( 'Sina Pro Image Scroller',  'sina-ext-pro' ),
		'instant-search'		=> esc_html__( 'Sina Pro Instant Search',  'sina-ext-pro' ),
		'lost-password-form'	=> esc_html__( 'Sina Pro Lost Password Form',  'sina-ext-pro' ),
		'lottie-animation'		=> esc_html__( 'Sina Pro Lottie Animation',  'sina-ext-pro' ),
		'offcanvas-bar'			=> esc_html__( 'Sina Pro Offcanvas Bar',  'sina-ext-pro' ),
		'posts-gallery'			=> esc_html__( 'Sina Pro Posts Gallery',  'sina-ext-pro' ),
		'posts-on-scroll'		=> esc_html__( 'Sina Pro Posts on Scroll',  'sina-ext-pro' ),
		'register-form'			=> esc_html__( 'Sina Pro Register Form',  'sina-ext-pro' ),
		'section-navigation'	=> esc_html__( 'Sina Pro Section Navigation',  'sina-ext-pro' ),
		'source-code'			=> esc_html__( 'Sina Pro Source Code',  'sina-ext-pro' ),
		'tab' 					=> esc_html__( 'Sina Pro Tab',  'sina-ext-pro' ),
		'team-carousel'			=> esc_html__( 'Sina Pro Team Carousel',  'sina-ext-pro' ),
		'testimonial'			=> esc_html__( 'Sina Pro Testimonial',  'sina-ext-pro' ),
		'thumb-carousel'		=> esc_html__( 'Sina Pro Thumb Carousel',  'sina-ext-pro' ),
		'tilt-box'				=> esc_html__( 'Sina Pro Tilt Box',  'sina-ext-pro' ),
		'toggle-content'		=> esc_html__( 'Sina Pro Toggle Content',  'sina-ext-pro' ),
		'twitter-feed-carousel'	=> esc_html__( 'Sina Pro Twitter Feed Carousel',  'sina-ext-pro' ),
		'video-gallery'			=> esc_html__( 'Sina Pro Video Gallery',  'sina-ext-pro' ),
	],
	'wooCommerce' => [
		'shop-box-grid'			=> esc_html__( 'Sina Pro Shop Box Grid',  'sina-ext-pro' ),
		'shop-list-grid'		=> esc_html__( 'Sina Pro Shop List Grid',  'sina-ext-pro' ),
		'shop-thumb-grid'		=> esc_html__( 'Sina Pro Shop Thumb Grid',  'sina-ext-pro' ),
		'shop-box-carousel'		=> esc_html__( 'Sina Pro Shop Box Carousel',  'sina-ext-pro' ),
		'shop-list-carousel'	=> esc_html__( 'Sina Pro Shop List Carousel',  'sina-ext-pro' ),
		'shop-thumb-carousel'	=> esc_html__( 'Sina Pro Shop Thumb Carousel',  'sina-ext-pro' ),
		'product-filter-vertical'=> esc_html__( 'Sina Pro Product Filter Vertical',  'sina-ext-pro' ),
		'product-filter-horizontal'=> esc_html__( 'Sina Pro Product Filter Horizontal',  'sina-ext-pro' ),
	],
]);


/**
 * SINA_EXT_PRO_EXTENDERS Constant
 *
 * @since 1.1.0
 */
define('SINA_EXT_PRO_EXTENDERS', [
	'pro' => [
		'masker'				=> esc_html__( 'Sina Pro Masker',  'sina-ext-pro' ),
		'parallax'				=> esc_html__( 'Sina Pro Parallax',  'sina-ext-pro' ),
		'section-particles'		=> esc_html__( 'Sina Pro Section Particles',  'sina-ext-pro' ),
		'water-ripples'			=> esc_html__( 'Sina Pro Water Ripples',  'sina-ext-pro' ),
		'clips-animation'		=> esc_html__( 'Sina Pro Clips Animation',  'sina-ext-pro' ),
		'colors-animation'		=> esc_html__( 'Sina Pro Colors Animation',  'sina-ext-pro' ),
		'conditional-publish'	=> esc_html__( 'Sina Pro Conditional Publish',  'sina-ext-pro' ),
		'content-protection'	=> esc_html__( 'Sina Pro Content Protection',  'sina-ext-pro' ),
		'preloader'				=> esc_html__( 'Sina Pro Preloader',  'sina-ext-pro' ),
		'reading-progressbar'	=> esc_html__( 'Sina Pro Reading Progressbar',  'sina-ext-pro' ),
	],
]);


require SINA_EXT_PRO_INC . 'sina-ext-base.php';
require SINA_EXT_PRO_INC . 'sina-ext-config.php';
require SINA_EXT_PRO_INC . 'sina-ext.php';

add_action('plugins_loaded', function () {
	Sina_Extension_Pro::instance();
});

register_activation_hook( SINA_EXT_PRO_FILE, function() {
	Sina_Extension_Pro::activation();
	flush_rewrite_rules();
});

register_deactivation_hook( SINA_EXT_PRO_FILE, function() {
	Sina_Extension_Pro::deactivation();
	flush_rewrite_rules();
});
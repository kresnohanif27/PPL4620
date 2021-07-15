<?php
if (!defined('ABSPATH')) {
	exit;
}

use \Elementor\Core\Settings\Manager;
use \Elementor\Controls_Manager;
use \Elementor\Plugin;

/**
 * Sina_Ext_Pro_Reading_Progressbar Class
 *
 * @since 1.1.0
 */
class Sina_Ext_Pro_Reading_Progressbar{
	/**
	 * Instance
	 *
	 * @since 1.2.2
	 * @var Sina_Ext_Pro_Reading_Progressbar The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.2
	 * @return Sina_Ext_Pro_Reading_Progressbar An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_action( 'elementor/documents/register_controls', [$this, 'register_controls'] );
		add_action( 'elementor/editor/after_save', [ $this, 'save_setting_values' ], 10, 2 );
		add_action( 'wp_footer', [$this, 'render_html'] );
	}

	public function register_controls($elems) {

		$elems->start_controls_section(
			'sina_reading_progressbar',
			[
				'label' => esc_html__('Sina Reading Progressbar', 'sina-ext-pro'),
				'tab' => Controls_Manager::TAB_SETTINGS,
			]
		);

		$elems->add_control(
			'sina_reading_progressbar_options',
			[
				'label' => esc_html__( 'Progressbar', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'globally' => esc_html__( 'Globally', 'sina-ext-pro' ),
					'this_post' => esc_html__( 'This Page or Post', 'sina-ext-pro' ),
					'none' => esc_html__( 'None', 'sina-ext-pro' ),
				],
				'default' => 'none',
			]
		);
		$elems->add_control(
			'sina_reading_progressbar_condition',
			[
				'label' => esc_html__('Show on', 'sina-ext-pro'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'posts' => esc_html__('All Posts', 'sina-ext-pro'),
					'pages' => esc_html__('All Pages', 'sina-ext-pro'),
					'all' => esc_html__('All Posts & Pages', 'sina-ext-pro'),
				],
				'default' => 'all',
				'condition' => [
					'sina_reading_progressbar_options' => 'globally',
				],
			]
		);
		$elems->add_control(
			'sina_reading_progressbar_position',
			[
				'label' => esc_html__('Position', 'sina-ext-pro'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => esc_html__( 'Top', 'sina-ext-pro' ),
						'icon'  => 'fa fa-long-arrow-up',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'sina-ext-pro' ),
						'icon'  => 'fa fa-long-arrow-down',
					],
				],
				'default' => 'top',
				'toggle' => false,
				'condition' => [
					'sina_reading_progressbar_options!' => 'none',
				],
				'selectors' => [
					'.sina-pro-reading-progressbar-wrap.custom' => '{{VALUE}}: 0px',
				],
			]
		);
		$elems->add_control(
			'sina_reading_progressbar_height',
			[
				'label' => esc_html__('Height', 'sina-ext-pro'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default' => [
					'unit' => 'px',
					'size' => 4,
				],
				'condition' => [
					'sina_reading_progressbar_options!' => 'none',
				],
				'selectors' => [
					'.sina-pro-reading-progressbar-wrap.custom .sina-reading-progressbar' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$elems->add_control(
			'sina_reading_progressbar_bg',
			[
				'label' => esc_html__('Background Color', 'sina-ext-pro'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'sina_reading_progressbar_options!' => 'none',
				],
				'selectors' => [
					'.sina-pro-reading-progressbar-wrap.custom' => 'background-color: {{VALUE}}',
				],
			]
		);
		$elems->add_control(
			'sina_reading_progressbar_color',
			[
				'label' => esc_html__('Bar Color', 'sina-ext-pro'),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'condition' => [
					'sina_reading_progressbar_options!' => 'none',
				],
				'selectors' => [
					'.sina-pro-reading-progressbar-wrap.custom .sina-reading-progressbar' => 'background-color: {{VALUE}}',
				],
			]
		);

		$elems->end_controls_section();
	}

	/**
	 * For Save Settings Value
	 *
	 * @since 1.1.0
	 */
	public function save_setting_values($post_id, $data) {
		$page_settings_manager 	= Manager::get_settings_managers('page');
		$page_settings_model 	= $page_settings_manager->get_model($post_id);
		$global_settings 		= get_option('sina_global_settings');

		if( $page_settings_model->get_settings('sina_reading_progressbar_options') == 'globally' ) {
			$global_settings['reading_progressbar'] = [
				'post_id' => $post_id,
				'globally' => ($page_settings_model->get_settings('sina_reading_progressbar_options') == 'globally' ? true : false),
				'display_condition' => $page_settings_model->get_settings('sina_reading_progressbar_condition'),
				'position' => $page_settings_model->get_settings('sina_reading_progressbar_position'),
				'height' => $page_settings_model->get_settings('sina_reading_progressbar_height'),
				'bg_color' => $page_settings_model->get_settings('sina_reading_progressbar_bg'),
				'bar_color' => $page_settings_model->get_settings('sina_reading_progressbar_color'),
			];
		} else {
			if ( isset($global_settings['reading_progressbar']['post_id']) && $global_settings['reading_progressbar']['post_id'] == $post_id ) {
				$global_settings['reading_progressbar'] = [];
			}
		}

		update_option('sina_global_settings', $global_settings);
	}

	/**
	 * For Render Mark up
	 *
	 * @since 1.1.0
	 */
	public static function render_html() {
		if ( is_singular() ) {
			$page_settings_manager 	= Manager::get_settings_managers('page');
			$page_settings_model 	= $page_settings_manager->get_model(get_the_ID());
			$is_reading_progressbar	= $page_settings_model->get_settings('sina_reading_progressbar_options');
			$global_settings 		= get_option('sina_global_settings');

			$html = '<div class="sina-pro-reading-progressbar-wrap custom"><div class="sina-reading-progressbar"></div></div>';

			if ( $is_reading_progressbar != 'none' || isset($global_settings['reading_progressbar']['globally']) ) {

				$position 	= isset($global_settings['reading_progressbar']['position']) ? $global_settings['reading_progressbar']['position'] : 'top';
				$height 	= isset($global_settings['reading_progressbar']['height']['size']) ? $global_settings['reading_progressbar']['height']['size'].'px' : '4px';
				$bg_color 	= isset($global_settings['reading_progressbar']['bg_color']) ? $global_settings['reading_progressbar']['bg_color'] : 'rgba(0,0,0,0)';
				$bar_color 	= isset($global_settings['reading_progressbar']['bar_color']) ? $global_settings['reading_progressbar']['bar_color'] : '#1085e4';

				if ( Plugin::$instance->preview->is_preview_mode() != true && isset($global_settings['reading_progressbar']['globally']) ) {
					$html = '<div class="sina-pro-reading-progressbar-wrap global '. $position .'" style="background-color:'. $bg_color .';"><div class="sina-reading-progressbar" style="height:'. $height .';background-color:'. $bar_color .';"></div></div>';
				}

				if ( isset($global_settings['reading_progressbar']['globally']) ) {
					if ( $global_settings['reading_progressbar']['display_condition'] == 'all' && (is_page() || is_single()) ) {
						printf($html);
					} elseif ( $global_settings['reading_progressbar']['display_condition'] == 'pages' && is_page() ) {
						printf($html);
					} elseif ( $global_settings['reading_progressbar']['display_condition'] == 'posts' && is_single() ) {
						printf($html);
					}
				} elseif ( 'this_post' == $is_reading_progressbar ) {
					printf($html);
				}

			}

			if ( Plugin::$instance->preview->is_preview_mode() ) {
				printf($html);
			}
		}
	}

}

Sina_Ext_Pro_Reading_Progressbar::instance();
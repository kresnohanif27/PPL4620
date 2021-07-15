<?php
if (!defined('ABSPATH')) {
	exit;
}

use \Elementor\Core\Settings\Manager;
use \Elementor\Controls_Manager;
use \Elementor\Plugin;

/**
 * Sina_Ext_Pro_Preloader Class
 *
 * @since 1.6.0
 */
class Sina_Ext_Pro_Preloader{
	/**
	 * Instance
	 *
	 * @since 1.6.0
	 * @var Sina_Ext_Pro_Preloader The single instance of the class.
	 */
	private $global_settings = [];


	public function __construct() {
		add_action( 'elementor/documents/register_controls', [$this, 'register_controls'] );
		add_action( 'elementor/editor/after_save', [ $this, 'save_setting_values' ], 10, 2 );
		add_action( 'wp_footer', [$this, 'render_html'] );

		$data 	  = get_option('sina_global_settings');
		$enable   = isset($data['preloader']['enable']) ? $data['preloader']['enable'] : 'no';
		$effect   = isset($data['preloader']['effect']) ? $data['preloader']['effect'] : 'fadeOut';
		$bg_color = isset($data['preloader']['bg_color']) ? $data['preloader']['bg_color'] : '#fff';
		$loader   = isset($data['preloader']['loader']) ? $data['preloader']['loader'] : 'preloader-1';

		$this->global_settings = [
			'enable' 	=> $enable,
			'effect' 	=> $effect,
			'bg_color' 	=> $bg_color,
			'loader' 	=> $loader
		];
	}

	public function register_controls($elems) {
		$elems->start_controls_section(
			'sina_preloader',
			[
				'label' => esc_html__('Sina Preloader', 'sina-ext-pro'),
				'tab' => Controls_Manager::TAB_SETTINGS,
			]
		);

		$elems->add_control(
			'sina_preloader_note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'NOTICE: Preloader has to enable when all of the work has done (if you want to use it)! Also you have to refresh the page (in the editor) to change the setting.', 'sina-ext-pro' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);
		$elems->add_control(
			'sina_is_preloader',
			[
				'label' => esc_html__( 'Preloader Enable', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'yes' => esc_html__( 'Yes', 'sina-ext-pro' ),
					'no' => esc_html__( 'No', 'sina-ext-pro' ),
				],
				'default' => $this->global_settings['enable'],
			]
		);
		$elems->add_control(
			'sina_preloader_effect',
			[
				'label' => esc_html__('Effects', 'sina-ext-pro'),
				'type' => Controls_Manager::SELECT,
				'options' => Sina_Common_Data::animation_out(),
				'default' => $this->global_settings['effect'],
				'condition' => [
					'sina_is_preloader' => 'yes',
				],
			]
		);
		$elems->add_control(
			'sina_preloader_bg',
			[
				'label' => esc_html__('Background Color', 'sina-ext-pro'),
				'type' => Controls_Manager::COLOR,
				'default' => $this->global_settings['bg_color'],
				'condition' => [
					'sina_is_preloader' => 'yes',
				],
			]
		);
		$elems->add_control(
			'sina_preloader_loader',
			[
				'label' => esc_html__('Select Loader', 'sina-ext-pro'),
				'type' => Sina_Controls_Manager::SINACHOOSE,
				'options' => [
					'preloader-1' => [
						'title' => esc_html__( 'Loader 1 Dark', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-1.gif',
						'width' => '33%',
					],
					'preloader-2' => [
						'title' => esc_html__( 'Loader 2 Dark', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-2.gif',
						'width' => '33%',
					],
					'preloader-3' => [
						'title' => esc_html__( 'Loader 3 Dark', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-3.gif',
						'width' => '33%',
					],
					'preloader-4' => [
						'title' => esc_html__( 'Loader 1 Light', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-4.gif',
						'width' => '33%',
					],
					'preloader-5' => [
						'title' => esc_html__( 'Loader 2 Light', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-5.gif',
						'width' => '33%',
					],
					'preloader-6' => [
						'title' => esc_html__( 'Loader 3 Light', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-6.gif',
						'width' => '33%',
					],
					'preloader-13' => [
						'title' => esc_html__( 'Loader 4 Dark', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-13.gif',
						'width' => '33%',
					],
					'preloader-19' => [
						'title' => esc_html__( 'Loader 5', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-19.gif',
						'width' => '33%',
					],
					'preloader-20' => [
						'title' => esc_html__( 'Loader 6', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-20.gif',
						'width' => '33%',
					],
					'preloader-16' => [
						'title' => esc_html__( 'Loader 4 Light', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-16.gif',
						'width' => '33%',
					],
					'preloader-7' => [
						'title' => esc_html__( 'Loader 7', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-7.gif',
						'width' => '33%',
					],
					'preloader-8' => [
						'title' => esc_html__( 'Loader 8', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-8.gif',
						'width' => '33%',
					],
					'preloader-9' => [
						'title' => esc_html__( 'Loader 9', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-9.gif',
						'width' => '33%',
					],
					'preloader-14' => [
						'title' => esc_html__( 'Loader 10 dark', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-14.gif',
						'width' => '33%',
					],
					'preloader-15' => [
						'title' => esc_html__( 'Loader 11 dark', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-15.gif',
						'width' => '33%',
					],
					'preloader-17' => [
						'title' => esc_html__( 'Loader 10 Light', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-17.gif',
						'width' => '33%',
					],
					'preloader-18' => [
						'title' => esc_html__( 'Loader 11 Light', 'sina-ext-pro' ),
						'image' => SINA_EXT_PRO_URL .'assets/img/preloader/preloader-18.gif',
						'width' => '33%',
					],
				],
				'default' => $this->global_settings['loader'],
				'condition' => [
					'sina_is_preloader' => 'yes',
				],
			]
		);

		$elems->end_controls_section();
	}

	/**
	 * For Save Settings Value
	 *
	 * @since 1.6.0
	 */
	public function save_setting_values($post_id, $data) {
		$page_settings_manager 	= Manager::get_settings_managers('page');
		$page_settings_model 	= $page_settings_manager->get_model($post_id);
		$global_settings 		= get_option('sina_global_settings');

		$global_settings['preloader'] = [
			'enable' => $page_settings_model->get_settings('sina_is_preloader'),
			'effect' => $page_settings_model->get_settings('sina_preloader_effect'),
			'bg_color' => $page_settings_model->get_settings('sina_preloader_bg'),
			'loader' => $page_settings_model->get_settings('sina_preloader_loader'),
		];

		update_option('sina_global_settings', $global_settings);
	}

	/**
	 * For Render Mark up
	 *
	 * @since 1.6.0
	 */
	public static function render_html() {
		$global_settings = get_option('sina_global_settings');

		if ( isset($global_settings['preloader']['enable']) && $global_settings['preloader']['enable'] == 'yes' ) {

			$effect 	= isset($global_settings['preloader']['effect']) ? $global_settings['preloader']['effect'] : 'fadeOut';
			$bg_color 	= isset($global_settings['preloader']['bg_color']) ? $global_settings['preloader']['bg_color'] : '#fff';
			$loader 	= isset($global_settings['preloader']['loader']) ? $global_settings['preloader']['loader'] : 'preloader-1';

			$html = '<div class="sina-ext-pro-preloader-wrap" style="background-color:'. $bg_color .';" data-effect="'. $effect .'"><div class="sina-ext-pro-preloader"><img src="'.esc_url( SINA_EXT_PRO_URL .'assets/img/preloader/'.$loader.'.gif' ).'" alt="sina preloader"></div></div>';

			printf($html);
		}
	}
}

new Sina_Ext_Pro_Preloader();
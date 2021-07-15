<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Controls_Manager;
use \Elementor\frontend;

/**
 * Sina_Ext_Pro_Content_Protection Class
 *
 * @since 1.1.0
 */
Class Sina_Ext_Pro_Content_Protection{
	/**
	 * Instance
	 *
	 * @since 1.2.2
	 * @var Sina_Ext_Pro_Content_Protection The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.2
	 * @return Sina_Ext_Pro_Content_Protection An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_action( 'elementor/element/section/section_effects/after_section_end', [$this, 'register_controls'] );
		add_action( 'elementor/element/common/_section_border/after_section_end', [$this, 'register_controls'] );
		add_action( 'elementor/widget/render_content', [$this, 'render_content'], 10, 2 );
		add_action( 'elementor/frontend/section/should_render', [$this, 'render_content'], 10, 2 );
	}

	public function register_controls($elems) {

		$elems->start_controls_section(
			'sina_content_protector',
			[
				'label' => esc_html__('Sina Content Protection', 'sina-ext-pro'),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$elems->add_control(
			'sina_is_content_protect',
			[
				'label' => esc_html__( 'Content Protect', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$elems->add_control(
			'sina_content_protection_role',
			[
				'label' => esc_html__('Select Roles', 'sina-ext-pro'),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => sina_get_user_roles(),
				'condition' => [
					'sina_is_content_protect' => 'yes',
				],
			]
		);

		if ( 'section' != $elems->get_name() ) {
			$elems->add_control(
				'sina_content_protection_data',
				[
					'label' => esc_html__('Show Template', 'sina-ext-pro'),
					'type' => Controls_Manager::SELECT,
					'description' => esc_html__('You can set a template when the content is protected.', 'sina-ext-pro'),
					'options' => [
						'none' => esc_html__('None', 'sina-ext-pro'),
						'template' => esc_html__('Saved Templates', 'sina-ext-pro'),
					],
					'condition' => [
						'sina_is_content_protect' => 'yes',
					],
					'default' => 'none',
				]
			);
			$elems->add_control(
				'sina_content_protection_template',
				[
					'label' => esc_html__('Choose Template', 'sina-ext-pro'),
					'type' => Controls_Manager::SELECT,
					'options' => sina_get_page_templates(),
					'condition' => [
						'sina_is_content_protect' => 'yes',
						'sina_content_protection_data' => 'template',
					],
				]
			);
		}

		$elems->end_controls_section();
	}

	public function render_content($content, $elems) {
		$data = $elems->get_settings_for_display();

		if ( 'yes' == $data['sina_is_content_protect'] ) {
			$roles = wp_get_current_user();
			$user_role = reset($roles->roles);
			$need_roles = $data['sina_content_protection_role'];

			if ( !empty($need_roles) && in_array($user_role, $need_roles) ) {
				return $content;
			} elseif ( 'section' != $elems->get_name() && 'template' == $data['sina_content_protection_data'] ) {
				$frontend = new Frontend;
				return $frontend->get_builder_content( $data['sina_content_protection_template'], true );
			}
			return;
		}
		return $content;
	}

}

Sina_Ext_Pro_Content_Protection::instance();
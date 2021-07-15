<?php

/**
 * Register Form Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Register_Form_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_ext_pro_register_form';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Register Form', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return [ 'sina-ext-pro-basic' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'sina form', 'sina register form', 'sina signup form' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_style_depends() {
		return [
			'sina-ext-pro-widgets',
		];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_script_depends() {
		return [
			'sina-google-recaptcha-api',
			'sina-ext-pro-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Form Content
		// ====================
		$this->start_controls_section(
			'form_content',
			[
				'label' => esc_html__( 'Form Settings', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'is_recaptcha',
			[
				'label' => esc_html__( 'Google Recaptcha', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'recaptcha_key',
			[
				'label' => 'For add/change the <strong>Site Key</strong> & <strong>Secret Key</strong><br><a target="_blank" href="admin.php?page=sina_ext_settings">click here</a>',
				'type' => Controls_Manager::RAW_HTML,
				'condition' => [
					'is_recaptcha' => 'yes',
				],
			]
		);
		$this->add_control(
			'email_placeholder',
			[
				'label' => esc_html__( 'Email Placeholder Text', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Placeholder Text', 'sina-ext-pro' ),
				'separator' => 'before',
				'default' => 'Enter Email *',
			]
		);
		$this->add_control(
			'username_placeholder',
			[
				'label' => esc_html__( 'Username Placeholder Text', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Placeholder Text', 'sina-ext-pro' ),
				'default' => 'Enter Username *',
			]
		);
		$this->add_control(
			'successs_message',
			[
				'label' => esc_html__( 'Success Message', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Success Message', 'sina-ext-pro' ),
				'default' => 'Registration success! <strong>Please check your email for the confirmation.</strong>',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();
		// End Form Content
		// =====================


		// Start Button Content
		// =====================
		$this->start_controls_section(
			'btn_content',
			[
				'label' => esc_html__( 'Submit Button', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		Sina_Common_Data::button_content($this, '.sina-register-btn', 'Register', 'btn', false);
		$this->end_controls_section();
		// End Button Content
		// ====================


		// Start Fields Style
		// ====================
		$this->start_controls_section(
			'fields_style',
			[
				'label' => esc_html__( 'Fields', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		Sina_Common_Data::input_fields_style( $this );
		$this->add_responsive_control(
			'fields_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => true,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-input-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'fields_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '12',
					'bottom' => '10',
					'left' => '12',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-input-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'fields_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-input-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Fields Style
		// ==================


		// Start Email Style
		// ===================
		$this->start_controls_section(
			'email_style',
			[
				'label' => esc_html__( 'Email', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::input_style( $this, '.sina-input-email' );
		$this->end_controls_section();
		// End Email Style
		// =================


		// Start Username Style
		// =====================
		$this->start_controls_section(
			'username_style',
			[
				'label' => esc_html__( 'Username', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::input_style( $this, '.sina-input-username', 'username' );
		$this->end_controls_section();
		// End Username Style
		// ====================


		// Start Button Style
		// =====================
		$this->start_controls_section(
			'btn_style',
			[
				'label' => esc_html__( 'Submit Button', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-register-btn' );
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 50,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-register-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-register-btn, {{WRAPPER}} .sina-register-btn:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '13',
					'right' => '25',
					'bottom' => '13',
					'left' => '25',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-register-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '20',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-register-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'alignment',
			[
				'label' => esc_html__( 'Alignment', 'sina-ext-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'sina-ext-pro' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-register-form' => 'text-align: {{VALUE}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-button', 'btn_bg_layer');

		$this->end_controls_section();
		// End Button Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$uid = uniqid('sina-rgs-');
		$recaptcha_key = get_option( 'sina_ext_pro_recaptcha_key' );
		?>
		<div class="sina-pro-register-form">
			<form class="sina-register-form"
			data-uid="<?php echo esc_attr( $uid ); ?>"
			data-captcha="<?php echo esc_attr( $data['is_recaptcha'] ); ?>">

				<input class="sina-input-field sina-input-email" type="email" placeholder="<?php echo esc_attr( $data['email_placeholder'] ); ?>" >
				<input class="sina-input-field sina-input-username" type="text" placeholder="<?php echo esc_attr( $data['username_placeholder'] ); ?>" >

				<!-- For Google Recaptcha -->
				<?php if ( 'yes' == $data['is_recaptcha'] ): ?>
					<div class="sina-google-recaptcha">
						<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $recaptcha_key ); ?>"></div>
					</div>
				<?php endif; ?>

				<button type="submit" class="sina-button sina-register-btn <?php echo esc_attr( $data['btn_effect'].' '.$data['btn_bg_layer_effects'] ); ?>">
					<?php Sina_Common_Data::button_html($data); ?>
				</button>

				<?php printf('<p class="sina-success-text">%s</p>', $data['successs_message']); ?>
				<p class="sina-error-text"></p>
				<p class="sina-process-text"><?php _e( 'Processing...', 'sina-ext-pro' ); ?></p>

				<?php wp_nonce_field( 'sina_register', 'sina_register_nonce'.$uid ); ?>
			</form><!-- .sina-register-form -->
		</div><!-- .sina-pro-register-form -->
		<?php
	}


	protected function _content_template() {

	}
}
<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Controls_Manager;

/**
 * Sina_Ext_Pro_Section_Particles Class
 *
 * @since 1.4.0
 */
Class Sina_Ext_Pro_Section_Particles{
	/**
	 * Instance
	 *
	 * @since 1.4.0
	 * @var Sina_Ext_Pro_Section_Particles The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.4.0
	 * @return Sina_Ext_Pro_Section_Particles An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_action( 'elementor/element/section/section_effects/after_section_end', [$this, 'register_controls'] );
		add_action( 'elementor/frontend/section/after_render', [$this,'after_render'] );
		add_action( 'elementor/section/print_template', [$this, 'print_template'], 10, 2 );
	}

	public function register_controls($elems) {

		$elems->start_controls_section(
			'sina_section_particles',
			[
				'label' => esc_html__('Sina Particles', 'sina-ext-pro'),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$elems->add_control(
			'sina_section_particles_note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'NOTICE: When you turn enabled or disabled this feature don\'t forget to click the "yes" button to see the actual result!', 'sina-ext-pro' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);
		$elems->add_control(
			'sina_is_section_particles',
			[
				'label' => esc_html__( 'Particles Enable', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'prefix_class'  => 'sina-section-particles-',
			]
		);
		$elems->add_control(
			'sina_sp_zindex',
			[
				'label' => esc_html__( 'Z-Index', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
				'condition' => [
					'sina_is_section_particles' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-section-particles' => 'z-index: {{VALUE}};',
				],
			]
		);
		$elems->add_control(
			'sina_sp_link_color',
			[
				'label' => esc_html__( 'Link Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'condition' => [
					'sina_is_section_particles' => 'yes',
				],
			]
		);
		$elems->add_control(
			'sina_sp_ball_color',
			[
				'label' => esc_html__( 'Ball Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'condition' => [
					'sina_is_section_particles' => 'yes',
				],
			]
		);
		$elems->add_control(
			'sina_sp_particle_number',
			[
				'label' => esc_html__( 'Particles Number', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 150,
				'step' => 1,
				'min' => 50,
				'max' => 500,
				'condition' => [
					'sina_is_section_particles' => 'yes',
				],
			]
		);
		$elems->add_control(
			'sina_sp_particle_link_width',
			[
				'label' => esc_html__( 'Link Width', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 1,
				'step' => 1,
				'min' => 1,
				'max' => 20,
				'condition' => [
					'sina_is_section_particles' => 'yes',
				],
			]
		);
		$elems->add_control(
			'sina_sp_particle_link',
			[
				'label' => esc_html__( 'Link Distance', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 50,
				'step' => 1,
				'min' => 10,
				'max' => 200,
				'condition' => [
					'sina_is_section_particles' => 'yes',
				],
			]
		);
		$elems->add_control(
			'sina_sp_particle_create_link',
			[
				'label' => esc_html__( 'Create Link', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 100,
				'step' => 1,
				'min' => 50,
				'max' => 200,
				'condition' => [
					'sina_is_section_particles' => 'yes',
				],
			]
		);
		$elems->add_control(
			'sina_sp_particle_ball',
			[
				'label' => esc_html__( 'Ball Max Size', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
				'step' => 1,
				'min' => 10,
				'max' => 100,
				'condition' => [
					'sina_is_section_particles' => 'yes',
				],
			]
		);
		$elems->add_control(
			'sina_sp_anim_speed',
			[
				'label' => esc_html__( 'Animation Speed', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 20,
				'step' => 10,
				'min' => 10,
				'max' => 100,
				'condition' => [
					'sina_is_section_particles' => 'yes',
				],
			]
		);
		$elems->add_control(
			'sina_sp_link_state',
			[
				'label' => esc_html__( 'Disable Links', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'No', 'sina-ext-pro' ),
				'condition' => [
					'sina_is_section_particles' => 'yes',
				],
			]
		);
		$elems->add_control(
			'sina_sp_mouse_state',
			[
				'label' => esc_html__( 'Disable Mouse', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext-pro' ),
				'label_off' => esc_html__( 'No', 'sina-ext-pro' ),
				'condition' => [
					'sina_is_section_particles' => 'yes',
				],
			]
		);

		$elems->add_control(
			'sina_section_particles_apply',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => '<div class="elementor-update-preview" style="background: rgba(0,0,0,0);margin-left: 0;margin-right: 0;"><div class="elementor-update-preview-title">Changes Apply?</div><div class="elementor-update-preview-button-wrapper"><button class="elementor-update-preview-button elementor-button elementor-button-success">Yes</button></div></div>',
			]
		);

		$elems->end_controls_section();
	}

	public function after_render($elems) {
		$data = $elems->get_settings_for_display();

		if ( 'yes' == $data['sina_is_section_particles'] ) {
			$particles_data = [
				'link_color' => $data['sina_sp_link_color'],
				'ball_color' => $data['sina_sp_ball_color'],
				'number' 	 => $data['sina_sp_particle_number'],
				'link' 		 => $data['sina_sp_particle_link'],
				'clink' 	 => $data['sina_sp_particle_create_link'],
				'linkw' 	 => $data['sina_sp_particle_link_width'],
				'size' 		 => $data['sina_sp_particle_ball'],
				'speed' 	 => $data['sina_sp_anim_speed'],
				'dlink' 	 => $data['sina_sp_link_state'],
				'dmouse' 	 => $data['sina_sp_mouse_state'],
			];
			?>
				<div class="sina-section-particles sina-section-particles-wrap-<?php echo esc_attr( $elems->get_id() ); ?>"
				data-section-particles='<?php echo json_encode( $particles_data ); ?>'></div>
			<?php
		}
	}

	public function print_template( $template, $elems ) {
		$old_template = $template;

		ob_start();
		?>
		<# if ('yes' == settings.sina_is_section_particles) {
			var particlesData = {
				'link_color' : settings.sina_sp_link_color,
				'ball_color' : settings.sina_sp_ball_color,
				'number' 	 : settings.sina_sp_particle_number,
				'link' 		 : settings.sina_sp_particle_link,
				'clink' 	 : settings.sina_sp_particle_create_link,
				'linkw' 	 : settings.sina_sp_particle_link_width,
				'size' 		 : settings.sina_sp_particle_ball,
				'speed' 	 : settings.sina_sp_anim_speed,
				'dlink' 	 : settings.sina_sp_link_state,
				'dmouse' 	 : settings.sina_sp_mouse_state,
			}
			particlesData = JSON.stringify(particlesData);
			#>
				<div class="sina-section-particles sina-section-particles-wrap-{{{view.getID()}}}"
				data-section-particles='{{{particlesData}}}'></div>
		<# } #>
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content . $old_template;
	}
}

Sina_Ext_Pro_Section_Particles::instance();
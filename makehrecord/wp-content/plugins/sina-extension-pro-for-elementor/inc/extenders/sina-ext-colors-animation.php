<?php
if (!defined('ABSPATH')) {
	exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Repeater;

/**
 * Sina_Ext_Pro_Colors_Animation Class
 *
 * @since 1.1.0
 */
class Sina_Ext_Pro_Colors_Animation{
	/**
	 * Instance
	 *
	 * @since 1.2.2
	 * @var Sina_Ext_Pro_Colors_Animation The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.2
	 * @return Sina_Ext_Pro_Colors_Animation An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_action( 'elementor/element/section/section_effects/after_section_end', [$this, 'register_controls'] );
		add_action( 'elementor/frontend/section/before_render', [$this,'before_render'] );
		add_action( 'elementor/section/print_template', [$this, 'print_template'], 10, 2 );
	}

	public function register_controls($elems) {

		$elems->start_controls_section(
			'sina_colors_animation',
			[
				'label' => esc_html__('Sina Colors Animation', 'sina-ext-pro'),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);

		$elems->add_control(
			'sina_animation_colors_notice',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'NOTICE: Please remove Elementor\'s background image/gradient for this section.', 'sina-ext-pro' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition' => [
					'sina_is_animation' => 'yes',
				],
			]
		);

		$elems->add_control(
			'sina_is_animation',
			[
				'label' => esc_html__( 'Animation Enable', 'sina-ext-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'prefix_class'  => 'sina-colors-anim-',
			]
		);
		$elems->add_control(
			'sina_animation_type',
			[
				'label' => esc_html__( 'Animation Type', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'fade' => esc_html__( 'Fade', 'sina-ext-pro' ),
					'hor-moving' => esc_html__( 'Horizontal Moving', 'sina-ext-pro' ),
					'ver-moving' => esc_html__( 'Vertical Moving', 'sina-ext-pro' ),
				],
				'default' => 'hor-moving',
				'prefix_class'  => 'sina-colors-anim-',
				'condition' => [
					'sina_is_animation' => 'yes',
				],
			]
		);
		$elems->add_control(
			'sina_animation_duration',
			[
				'label' => esc_html__( 'Duration', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1000,
				'min' => 5000,
				'max' => 60000,
				'default' => 20000,
				'condition' => [
					'sina_is_animation' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'animation-duration: {{VALUE}}ms;',
				],
			]
		);
		$elems->add_control(
			'sina_animation_delay',
			[
				'label' => esc_html__( 'Delay', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 100,
				'max' => 60000,
				'default' => 10,
				'condition' => [
					'sina_is_animation' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => 'animation-delay: {{VALUE}}ms;',
				],
			]
		);
		$elems->add_control(
			'sina_colors_angle',
			[
				'label' => esc_html__( 'Angle (deg)', 'sina-ext-pro' ),
				'type' => Controls_Manager::NUMBER,
				'min' => -180,
				'max' => 180,
				'default' => 90,
				'condition' => [
					'sina_is_animation' => 'yes',
					'sina_animation_type!' => 'fade',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'sina_animation_color',
			[
				'label' => esc_html__( 'Select Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
			]
		);
		$elems->add_control(
			'sina_animation_colors',
			[
				'label' => esc_html__( 'Add color', 'sina-ext-pro' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'sina_animation_color' => '#1085e4',
					],
				],
				'prevent_empty' => true,
				'condition' => [
					'sina_is_animation' => 'yes',
				],
				'title_field' => '{{{ sina_animation_color }}}',
			]
		);

		$elems->add_control(
			'sina_animation_apply',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => '<div class="elementor-update-preview" style="background: rgba(0,0,0,0);margin-left: 0;margin-right: 0;"><div class="elementor-update-preview-title">Changes Apply?</div><div class="elementor-update-preview-button-wrapper"><button class="elementor-update-preview-button elementor-button elementor-button-success">Yes</button></div></div>',
			]
		);

		$elems->end_controls_section();
	}

	public function before_render( $elems ) {
		$data = $elems->get_settings_for_display();

		if ( 'yes' == $data['sina_is_animation'] ) {
			$colors = [];
			foreach( $data['sina_animation_colors'] as $color ) {
				$colors[] = $color['sina_animation_color'];
			}

			if ( 'fade' == $data['sina_animation_type'] ) {
				$id = $elems->get_id();
				$count = count($colors);
				$step = 100 / $count;
				$pos = 0;
				$bg_colors = '@keyframes sina_colors_anim_fade-'. $id .'{ 0%, 100% {background-color: '. $colors[0] .';} ';

				for ($i = 1; $i < $count ; $i++) {
					$pos += $step;
					$bg_colors .= $pos. '% {background-color: '. $colors[$i] .';} ';
				}
				$bg_colors .= ' }';
				?>
				<style type="text/css">
					.sina-colors-anim-fade.elementor-element-<?php echo esc_attr( $id ); ?>{
						animation-name: sina_colors_anim_fade-<?php echo esc_attr( $id ); ?>;
					}
					<?php echo esc_attr( $bg_colors ); ?>
				</style>
				<?php
			}

			$colors = [
				'type'		=> $data['sina_animation_type'],
				'angle'		=> $data['sina_colors_angle'],
				'colors'	=> $colors
			];

			$elems->add_render_attribute( '_wrapper','data-sina-anim-colors', wp_json_encode( $colors ) );
		}

	}

	public function print_template( $template, $elems ) {
		$old_template = $template;
		ob_start();
		?>
		<#
			if ( 'yes' == settings.sina_is_animation ) {
				var type = settings.sina_animation_type;
				var angle = settings.sina_colors_angle;
				var colors = [];
				var id = view.getID();
				var i = 0;
				var bgSize = '100%';

				_.each(settings.sina_animation_colors, function (color, index) {
					colors[i] = color.sina_animation_color;
					i++;
				});

				if ( 'hor-moving' == type ) {
					bgSize = colors.length +'00% 100%';
				} else if ( 'ver-moving' == type ) {
					bgSize = '100% '+ colors.length +'00%';
				}

				if ( 'fade' == type ) {
					var length = colors.length;
					var step = 100 / length;
					var pos = 0;
					var bgColors = '@keyframes sina_colors_anim_fade-'+ id +'{ 0%, 100% {background-color: '+ colors[0] +';} ';

					var j;
					for (j = 1; j < length; j++) {
					    pos += step;
					    bgColors += pos +'% {background-color: '+ colors[j] +';} ';
					}
					bgColors += ' }';
					#>
					<style type="text/css">
						.sina-colors-anim-fade.elementor-element-{{{ id }}} {
							animation-name: sina_colors_anim_fade-{{{ id }}};
						}
						{{{ bgColors }}}
					</style>
					<#
				} else {
					#>
					<style type="text/css">
						.elementor .elementor-element-{{{ id }}}{
							background-color: {{{colors[0]}}};
							background-image : linear-gradient({{{angle}}}deg, {{{colors.toString()}}});
							background-size : {{{bgSize}}};
						}
					</style>
					<#
				}
			}
		#>
		<?php
		$content = ob_get_contents();
		ob_end_clean();

		return $content . $old_template;
	}

}

Sina_Ext_Pro_Colors_Animation::instance();
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use \Elementor\Base_Data_Control;

/**
 * Sina Choose control.
 *
 * @since 1.5.1
 */
class Sina_Choose_Control extends Base_Data_Control{

	public function get_type() {
		return 'sinachoose';
	}

	public function enqueue() {
		// Styles
		wp_enqueue_style( 'sinachoose', SINA_EXT_PRO_CONTROLS_ASSETS .'css/sinachoose-control.min.css', [], SINA_EXT_PRO_VERSION );

		// Scripts
		wp_enqueue_script( 'sinachoose', SINA_EXT_PRO_CONTROLS_ASSETS .'js/sinachoose-control.min.js', ['jquery'], SINA_EXT_PRO_VERSION );
	}

	protected function get_default_settings() {
		return [
			'label_block' => true,
			'wrap_height' => '235px',
			'options' => []
		];
	}

	public function content_template() {
		$control_uid = $this->get_control_uid( '{{value}}' );
		?>
		<div class="elementor-control-field">
			<label class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<div class="sina-image-choices" style="height:{{ data.wrap_height }}">
					<# _.each( data.options, function( options, value ) { #>
					<div class="sina-choose-label-block" 
					style="width:{{ options.width }}">
						<input id="<?php echo esc_attr($control_uid); ?>" type="radio" name="elementor-choose-{{ data.name }}-{{ data._cid }}" value="{{ value }}">
						<label for="<?php echo esc_attr($control_uid); ?>" title="{{ options.title }}">
							<img class="sina-choose-image" src="{{ options.image }}" alt="{{ options.title }}" />
							<span class="elementor-screen-only">{{{ options.title }}}</span>
						</label>
					</div>
					<# } ); #>
				</div>
			</div>
		</div>

		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}
}

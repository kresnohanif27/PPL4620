<?php

/**
 * Source Code Widget.
 *
 * @since 1.5.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Ext_Pro_Source_Code_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.5.0
	 */
	public function get_name() {
		return 'sina_ext_pro_source_code';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.5.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Pro Source Code', 'sina-ext-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.5.0
	 */
	public function get_icon() {
		return 'eicon-editor-code';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.5.0
	 */
	public function get_categories() {
		return [ 'sina-ext-pro-basic' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.5.0
	 */
	public function get_keywords() {
		return [ 'sina source code highlighter', 'sina code highlighter'];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.5.0
	 */
	public function get_style_depends() {
		return [
			'sina-prism',
			'sina-ext-pro-widgets',
		];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 1.5.0
	 */
	public function get_script_depends() {
		return [
			'sina-prism',
			'sina-ext-pro-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Code Content
		// ====================
		$this->start_controls_section(
			'code_content',
			[
				'label' => esc_html__( 'Code Content', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'lang_type',
			[
				'label' => esc_html__( 'Choose Language', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'css'				=> esc_html__( 'CSS', 'sina-ext-pro' ),
					'css-extras'		=> esc_html__( 'CSS-Extras', 'sina-ext-pro' ),
					'less'				=> esc_html__( 'LESS', 'sina-ext-pro' ),
					'sass'				=> esc_html__( 'SASS', 'sina-ext-pro' ),
					'scss'				=> esc_html__( 'SCSS', 'sina-ext-pro' ),
					'javascript'		=> esc_html__( 'JavaScript', 'sina-ext-pro' ),
					'coffeescript'		=> esc_html__( 'CoffeeScript', 'sina-ext-pro' ),
					'typescript'		=> esc_html__( 'TypeScript', 'sina-ext-pro' ),
					'json'				=> esc_html__( 'JSON', 'sina-ext-pro' ),
					'jsx'				=> esc_html__( 'JSX', 'sina-ext-pro' ),
					'markup'			=> esc_html__( 'Markup', 'sina-ext-pro' ),
					'markup-templating'	=> esc_html__( 'Markup-Templating', 'sina-ext-pro' ),
					'markdown'			=> esc_html__( 'Markdown', 'sina-ext-pro' ),
					'sql'				=> esc_html__( 'SQL', 'sina-ext-pro' ),
					'php'				=> esc_html__( 'PHP', 'sina-ext-pro' ),
					'perl'				=> esc_html__( 'Perl', 'sina-ext-pro' ),
					'python'			=> esc_html__( 'Python', 'sina-ext-pro' ),
					'pascal'			=> esc_html__( 'Pascal', 'sina-ext-pro' ),
					'ruby'				=> esc_html__( 'Ruby', 'sina-ext-pro' ),
					'django'			=> esc_html__( 'Django', 'sina-ext-pro' ),
					'go'				=> esc_html__( 'Go', 'sina-ext-pro' ),
					'git'				=> esc_html__( 'Git', 'sina-ext-pro' ),
					'java'				=> esc_html__( 'Java', 'sina-ext-pro' ),
					'kotlin'			=> esc_html__( 'Kotlin', 'sina-ext-pro' ),
					'c'					=> esc_html__( 'C', 'sina-ext-pro' ),
					'c++'				=> esc_html__( 'C++', 'sina-ext-pro' ),
					'csharp'			=> esc_html__( 'Csharp', 'sina-ext-pro' ),
					'clike'				=> esc_html__( 'Clike', 'sina-ext-pro' ),
					'regex'				=> esc_html__( 'Regex', 'sina-ext-pro' ),
				],
				'default' => 'css',
			]
		);
		$this->add_control(
			'btn_copy_text',
			[
				'label' => esc_html__('Button Copy Text', 'sina-ext-pro'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Copy to Clipboard',
			]
		);
		$this->add_control(
			'btn_after_copy_text',
			[
				'label' => esc_html__('Button Copied Text', 'sina-ext-pro'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Copied',
			]
		);
		$this->add_control(
			'code',
			[
				'label' => esc_html__( 'Code', 'sina-ext-pro' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'default' => ".sina-overlay{\n\tposition: absolute;\n\ttop: 0;\n\tleft: 0;\n\twidth: 100%;\n\theight: 100%;\n\topacity: 0;\n\ttransition: all 0.4s;\n}\n.sina-flex{\n\tdisplay: flex;\n}\n.clearfix::after{\n\tcontent: '';\n\tclear: both;\n\tdisplay: table;\n}",
				'placeholder' => esc_html__( 'Enter Your Code', 'sina-ext-pro' ),
			]
		);

		$this->end_controls_section();
		// End Code Content
		// =====================


		// Start Settings
		// =====================
		$this->start_controls_section(
			'code_settings',
			[
				'label' => esc_html__( 'Settings', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'theme_type',
			[
				'label' => esc_html__( 'Choose Theme', 'sina-ext-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default'		=> esc_html__( 'Default', 'sina-ext-pro' ),
					'dark'			=> esc_html__( 'Dark', 'sina-ext-pro' ),
					'funky'			=> esc_html__( 'Funky', 'sina-ext-pro' ),
					'okaidia'		=> esc_html__( 'Okaidia', 'sina-ext-pro' ),
					'twilight'		=> esc_html__( 'Twilight', 'sina-ext-pro' ),
					'coy'			=> esc_html__( 'Coy', 'sina-ext-pro' ),
					'solarizedlight'=> esc_html__( 'Solarized Light', 'sina-ext-pro' ),
					'tomorrow'		=> esc_html__( 'Tomorrow Night', 'sina-ext-pro' ),
				],
				'default' => 'default',
			]
		);
		$this->add_control(
			'is_match_braces',
			[
				'label'   => esc_html__( 'Show Matching Braces', 'sina-ext-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'is_line_numbers',
			[
				'label'   => esc_html__( 'Show Line Numbers', 'sina-ext-pro' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'is_line_highlight',
			[
				'label'   => esc_html__( 'Show Line Highlight', 'sina-ext-pro' ),
				'type'    => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'line_highlight',
			[
				'label' => esc_html__('Enter Line Numbers', 'sina-ext-pro'),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'Line Numbers must be comma separated (Ex: 1-5,11-14).', 'sina-ext-pro' ),
				'condition' => [
					'is_line_highlight' => 'yes',
				]
			]
		);

		$this->end_controls_section();
		// End Settings
		// ====================


		// Start Button Style
		// =====================
		$this->start_controls_section(
			'btn_style',
			[
				'label' => esc_html__( 'Copy Button', 'sina-ext-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '14',
						],
					],
					'line_height'   => [
						'default' => [
							'unit' => 'px',
							'size' => '18',
						],
					],
					'font_weight' => [
						'default' => '400',
					],
				],
				'selector' => '{{WRAPPER}} .sina-code-copy-btn',
			]
		);
		$this->add_control(
			'btn_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-code-copy-btn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-code-copy-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_border',
				'selector' => '{{WRAPPER}} .sina-code-copy-btn',
			]
		);
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
				'selectors' => [
					'{{WRAPPER}} .sina-code-copy-btn' => 'min-width: {{SIZE}}{{UNIT}};',
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
					'top' => '30',
					'right' => '30',
					'bottom' => '30',
					'left' => '30',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-code-copy-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'top' => '10',
					'right' => '18',
					'bottom' => '10',
					'left' => '18',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-code-copy-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Button Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$line_highlight = ('yes' == $data['is_line_highlight']) ? $data['line_highlight']: '';
		$line_numbers = ('yes' == $data['is_line_numbers']) ? 'line-numbers' : '';
		$match_braces = ('yes' == $data['is_match_braces']) ? 'match-braces' : '';
		?>
		<div class="sina-pro-source-code prism prism-<?php echo esc_attr( $data['theme_type'] ); ?>"
		data-code-lang="<?php echo esc_attr( $data['lang_type'] ); ?>"
		data-copy-text="<?php echo esc_attr( $data['btn_after_copy_text'] ); ?>">
			<pre class="language-<?php echo esc_attr( $data['lang_type'].' '.$line_numbers.' '.$match_braces ); ?>"
			data-line="<?php echo esc_attr( $line_highlight ); ?>">
				<button class="sina-button sina-code-copy-btn"><?php echo esc_html($data['btn_copy_text']); ?></button>
				<code class="language-<?php echo esc_attr( $data['lang_type'] ); ?>">
					<?php printf('%s', $data['code']); ?>
				</code>
			</pre>
		</div><!-- .sina-pro-source-code -->
		<?php
	}


	protected function _content_template() {
		?>
		<#
			var lineHighlight = ('yes' == settings.is_line_highlight) ? settings.line_highlight : '';
			var lineNumbers = ('yes' == settings.is_line_numbers) ? 'line-numbers' : '';
			var matchBraces = ('yes' == settings.is_match_braces) ? 'match-braces' : '';
		#>
		<div class="sina-pro-source-code prism prism-{{{settings.theme_type}}}"
		data-code-lang="{{{settings.lang_type}}}"
		data-copy-text="{{{settings.btn_after_copy_text}}}">
			<pre class="language-{{{settings.lang_type+' '+lineNumbers+' '+matchBraces}}}"
			data-line="{{{lineHighlight}}}">
				<button class="sina-button sina-code-copy-btn">{{{settings.btn_copy_text}}}</button>
				<code class="language-{{{settings.lang_type}}}">
					{{{settings.code}}}
				</code>
			</pre>
		</div><!-- .sina-pro-source-code -->
		<?php
	}
}